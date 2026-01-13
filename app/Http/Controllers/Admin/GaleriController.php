<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    // Foto
    public function fotoCreate()
    {
        return view('admin.galeri.foto.create');
    }

    public function fotoStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|in:kegiatan,pelayanan,pembinaan',
            'file' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Judul wajib diisi',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berformat JPEG, JPG, atau PNG',
            'file.max' => 'Ukuran file maksimal 5MB',
            'url.url' => 'URL tidak valid',
        ]);

        $data = [
            'type' => 'foto',
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_active' => true,
        ];

        try {
            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Ensure directory exists
                $directory = storage_path('app/public/foto');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $filename = 'foto/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                // Store to public disk explicitly
                $path = $file->storeAs('', $filename, 'public');
                
                // Verify file was saved
                if (!Storage::disk('public')->exists($filename)) {
                    return back()->with('error', 'Gagal menyimpan file. Pastikan folder storage memiliki permission yang benar.')->withInput();
                }
                
                $data['file_path'] = $filename;
            } elseif ($request->url) {
                $data['url'] = $request->url;
            } else {
                return back()->with('error', 'Harus mengupload file atau memasukkan URL')->withInput();
            }

            Gallery::create($data);

            return redirect()->route('admin.galeri.foto.index')->with('success', 'Foto berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan foto: ' . $e->getMessage())->withInput();
        }
    }

    public function fotoIndex()
    {
        $fotos = Gallery::where('type', 'foto')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.galeri.foto.index', compact('fotos'));
    }

    public function fotoDestroy($id)
    {
        $foto = Gallery::findOrFail($id);
        
        if ($foto->file_path && Storage::exists('public/' . $foto->file_path)) {
            Storage::delete('public/' . $foto->file_path);
        }
        
        $foto->delete();
        
        return redirect()->route('admin.galeri.foto.index')->with('success', 'Foto berhasil dihapus');
    }

    // Video
    public function videoCreate()
    {
        return view('admin.galeri.video.create');
    }

    public function videoStore(Request $request)
    {
        // Jika user memasukkan URL, skip validasi file upload
        $hasUrl = !empty($request->url);
        $hasFile = $request->hasFile('file');
        
        // Hanya cek error upload jika user benar-benar mencoba upload file (bukan hanya URL)
        // Skip pengecekan ini jika user hanya memasukkan URL
        if ($hasUrl) {
            // User hanya memasukkan URL, skip semua pengecekan file upload
        } elseif (!$hasFile && isset($_FILES['file']) && isset($_FILES['file']['error'])) {
            // Check if there was an upload attempt that failed
            $uploadError = $_FILES['file']['error'];
            if ($uploadError === UPLOAD_ERR_INI_SIZE || $uploadError === UPLOAD_ERR_FORM_SIZE) {
                $maxUpload = ini_get('upload_max_filesize');
                $maxPost = ini_get('post_max_size');
                return back()->with('error', "File gagal di-upload. Ukuran file melebihi batas PHP (upload_max_filesize: {$maxUpload}, post_max_size: {$maxPost}). Silakan gunakan URL video atau perbesar batas upload di PHP.")->withInput();
            }
        }

        // Get PHP upload limits (hanya jika diperlukan)
        $maxUploadBytes = $this->convertToBytes(ini_get('upload_max_filesize'));
        $maxPostBytes = $this->convertToBytes(ini_get('post_max_size'));
        $maxAllowed = min($maxUploadBytes, $maxPostBytes) / 1024; // Convert to KB

        // Validasi dasar
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|in:kegiatan,informasi,tutorial',
            'duration' => 'nullable|string|max:20',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];

        // Hanya validasi file jika user upload file (bukan URL)
        if ($hasFile && !$hasUrl) {
            $rules['file'] = 'required|mimes:mp4|max:' . $maxAllowed;
        } else {
            $rules['file'] = 'nullable|mimes:mp4|max:' . $maxAllowed;
        }

        // Validasi URL
        if ($hasUrl) {
            $rules['url'] = 'required|url';
        } else {
            $rules['url'] = 'nullable|url';
        }

        $request->validate($rules, [
            'title.required' => 'Judul wajib diisi',
            'file.required' => 'Harus mengupload file atau memasukkan URL video',
            'file.mimes' => 'File harus berformat MP4',
            'file.max' => 'Ukuran file melebihi batas maksimal (' . ini_get('upload_max_filesize') . '). Silakan gunakan URL video atau perbesar batas upload di PHP.',
            'url.required' => 'Harus mengupload file atau memasukkan URL video',
            'url.url' => 'URL tidak valid',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
        ]);

        $data = [
            'type' => 'video',
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'duration' => $request->duration,
            'is_active' => true,
        ];

        try {
            // Handle file upload atau URL
            if ($hasFile && !$hasUrl) {
                // User upload file (bukan URL)
                $file = $request->file('file');
                
                // Check file size again
                if ($file->getSize() > $maxUploadBytes) {
                    return back()->with('error', 'Ukuran file melebihi batas maksimal (' . ini_get('upload_max_filesize') . '). Silakan gunakan URL video atau perbesar batas upload di PHP.')->withInput();
                }
                
                // Ensure directory exists
                $directory = storage_path('app/public/video');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $filename = 'video/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                // Store to public disk explicitly
                $path = $file->storeAs('', $filename, 'public');
                
                // Verify file was saved
                if (!Storage::disk('public')->exists($filename)) {
                    return back()->with('error', 'Gagal menyimpan file. Pastikan folder storage memiliki permission yang benar.')->withInput();
                }
                
                $data['file_path'] = $filename;
            } elseif ($hasUrl) {
                // User memasukkan URL (prioritas URL jika keduanya ada)
                $url = $request->url;
                $isValidVideoUrl = false;
                
                // Check if it's YouTube or Vimeo URL
                if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false || strpos($url, 'vimeo.com') !== false) {
                    $isValidVideoUrl = true;
                }
                
                if (!$isValidVideoUrl) {
                    return back()->with('error', 'URL video tidak valid. Gunakan link YouTube atau Vimeo.')->withInput();
                }
                
                $data['url'] = $url;
            } else {
                // Tidak ada file dan tidak ada URL
                return back()->with('error', 'Harus mengupload file atau memasukkan URL video (YouTube/Vimeo)')->withInput();
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                
                // Ensure directory exists
                $thumbnailDir = storage_path('app/public/video/thumbnails');
                if (!file_exists($thumbnailDir)) {
                    mkdir($thumbnailDir, 0755, true);
                }
                
                $thumbnailName = 'video/thumbnails/' . Str::random(20) . '.' . $thumbnail->getClientOriginalExtension();
                // Store to public disk explicitly
                $thumbnail->storeAs('', $thumbnailName, 'public');
                $data['thumbnail'] = $thumbnailName;
            }

            Gallery::create($data);

            return redirect()->route('admin.galeri.video.index')->with('success', 'Video berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan video: ' . $e->getMessage())->withInput();
        }
    }

    // Helper function to convert PHP size string to bytes
    private function convertToBytes($size)
    {
        $size = trim($size);
        $last = strtolower($size[strlen($size) - 1]);
        $size = (int) $size;
        
        switch ($last) {
            case 'g':
                $size *= 1024;
            case 'm':
                $size *= 1024;
            case 'k':
                $size *= 1024;
        }
        
        return $size;
    }

    public function videoIndex()
    {
        $videos = Gallery::where('type', 'video')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.galeri.video.index', compact('videos'));
    }

    public function videoDestroy($id)
    {
        $video = Gallery::findOrFail($id);
        
        if ($video->file_path && Storage::exists('public/' . $video->file_path)) {
            Storage::delete('public/' . $video->file_path);
        }
        
        if ($video->thumbnail && Storage::exists('public/' . $video->thumbnail)) {
            Storage::delete('public/' . $video->thumbnail);
        }
        
        $video->delete();
        
        return redirect()->route('admin.galeri.video.index')->with('success', 'Video berhasil dihapus');
    }

    // Infografis
    public function infografisCreate()
    {
        return view('admin.galeri.infografis.create');
    }

    public function infografisStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|in:haji,umrah,informasi',
            'file' => 'nullable|image|mimes:jpeg,jpg,png|max:10240', // 10MB max
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Judul wajib diisi',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berformat JPEG, JPG, atau PNG',
            'file.max' => 'Ukuran file maksimal 10MB',
            'url.url' => 'URL tidak valid',
        ]);

        $data = [
            'type' => 'infografis',
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_active' => true,
        ];

        try {
            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Ensure directory exists
                $directory = storage_path('app/public/infografis');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $filename = 'infografis/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                // Store to public disk explicitly
                $path = $file->storeAs('', $filename, 'public');
                
                // Verify file was saved
                if (!Storage::disk('public')->exists($filename)) {
                    return back()->with('error', 'Gagal menyimpan file. Pastikan folder storage memiliki permission yang benar.')->withInput();
                }
                
                $data['file_path'] = $filename;
            } elseif ($request->url) {
                $data['url'] = $request->url;
            } else {
                return back()->with('error', 'Harus mengupload file atau memasukkan URL')->withInput();
            }

            Gallery::create($data);

            return redirect()->route('admin.galeri.infografis.index')->with('success', 'Infografis berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan infografis: ' . $e->getMessage())->withInput();
        }
    }

    public function infografisIndex()
    {
        $infografis = Gallery::where('type', 'infografis')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.galeri.infografis.index', compact('infografis'));
    }

    public function infografisDestroy($id)
    {
        $infografis = Gallery::findOrFail($id);
        
        if ($infografis->file_path && Storage::exists('public/' . $infografis->file_path)) {
            Storage::delete('public/' . $infografis->file_path);
        }
        
        $infografis->delete();
        
        return redirect()->route('admin.galeri.infografis.index')->with('success', 'Infografis berhasil dihapus');
    }
}
