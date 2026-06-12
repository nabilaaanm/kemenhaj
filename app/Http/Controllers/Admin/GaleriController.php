<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriKategori;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Foto
    public function fotoCreate()
    {
        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'foto')->orderBy('name')->get();
        }

        return view('admin.galeri.foto.create', compact('categories'));
    }

    public function fotoStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'file' => 'required|image|mimes:jpeg,jpg,png|max:5120',
        ], [
            'title.required' => 'Judul wajib diisi',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berformat JPEG, JPG, atau PNG',
            'file.max' => 'Ukuran file maksimal 5MB',
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

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('foto')->putFileAs('', $file, $filename);
                $data['file_path'] = 'foto/' . $filename;
            } else {
                return back()->with('error', 'Harus mengupload file foto.')->withInput();
            }

            Galeri::create($data);

            return redirect()->route('admin.galeri.foto.index')->with('success', 'Foto berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan foto: ' . $e->getMessage())->withInput();
        }
    }

    public function fotoIndex()
    {
        $fotos = Galeri::where('type', 'foto')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.galeri.foto.index', compact('fotos'));
    }

    public function fotoEdit($id)
    {
        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'foto')->orderBy('name')->get();
        }

        $foto = Galeri::where('type', 'foto')->findOrFail($id);
        return view('admin.galeri.foto.edit', compact('foto', 'categories'));
    }

    public function fotoUpdate(Request $request, $id)
    {
        $foto = Galeri::where('type', 'foto')->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ], [
            'title.required' => 'Judul wajib diisi',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berformat JPEG, JPG, atau PNG',
            'file.max' => 'Ukuran file maksimal 5MB',
        ]);

        $hasFile = $request->hasFile('file');
        if (!$hasFile && !$foto->file_path) {
            return back()->with('error', 'Harus mengupload file foto.')->withInput();
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ];

        try {
            if ($hasFile) {
                $oldPath = $this->stripDiskPrefix($foto->file_path, 'foto');
                if ($oldPath) {
                    Storage::disk('foto')->delete($oldPath);
                }

                $file = $request->file('file');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('foto')->putFileAs('', $file, $filename);
                $data['file_path'] = 'foto/' . $filename;
                $data['url'] = null;
            }

            $foto->update($data);

            return redirect()->route('admin.galeri.foto.index')->with('success', 'Foto berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui foto: ' . $e->getMessage())->withInput();
        }
    }

    public function fotoDestroy($id)
    {
        $foto = Galeri::findOrFail($id);
        
        $oldPath = $this->stripDiskPrefix($foto->file_path, 'foto');
        if ($oldPath) {
            Storage::disk('foto')->delete($oldPath);
        }
        
        $foto->delete();
        
        return redirect()->route('admin.galeri.foto.index')->with('success', 'Foto berhasil dihapus');
    }

    // Video
    public function videoCreate()
    {
        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'video')->orderBy('name')->get();
        }

        return view('admin.galeri.video.create', compact('categories'));
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
            'category' => 'nullable|string|max:255',
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
                
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('video')->putFileAs('', $file, $filename);
                $data['file_path'] = 'video/' . $filename;
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

                $thumbnailName = Str::random(20) . '.' . $thumbnail->getClientOriginalExtension();
                Storage::disk('video')->putFileAs('thumbnails', $thumbnail, $thumbnailName);
                $data['thumbnail'] = 'video/thumbnails/' . $thumbnailName;
            }

            Galeri::create($data);

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

    private function stripDiskPrefix(?string $path, string $prefix): ?string
    {
        if (!$path) {
            return null;
        }

        $path = ltrim($path, '/');
        if (str_starts_with($path, $prefix . '/')) {
            return substr($path, strlen($prefix) + 1);
        }

        return $path;
    }

    public function videoIndex()
    {
        $videos = Galeri::where('type', 'video')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.galeri.video.index', compact('videos'));
    }

    public function videoEdit($id)
    {
        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'video')->orderBy('name')->get();
        }

        $video = Galeri::where('type', 'video')->findOrFail($id);
        return view('admin.galeri.video.edit', compact('video', 'categories'));
    }

    public function videoUpdate(Request $request, $id)
    {
        $video = Galeri::where('type', 'video')->findOrFail($id);

        $hasUrl = !empty($request->url);
        $hasFile = $request->hasFile('file');

        if ($hasUrl) {
            // Skip file upload error checks when URL is provided
        } elseif (!$hasFile && isset($_FILES['file']) && isset($_FILES['file']['error'])) {
            $uploadError = $_FILES['file']['error'];
            if ($uploadError === UPLOAD_ERR_INI_SIZE || $uploadError === UPLOAD_ERR_FORM_SIZE) {
                $maxUpload = ini_get('upload_max_filesize');
                $maxPost = ini_get('post_max_size');
                return back()->with('error', "File gagal di-upload. Ukuran file melebihi batas PHP (upload_max_filesize: {$maxUpload}, post_max_size: {$maxPost}). Silakan gunakan URL video atau perbesar batas upload di PHP.")->withInput();
            }
        }

        $maxUploadBytes = $this->convertToBytes(ini_get('upload_max_filesize'));
        $maxPostBytes = $this->convertToBytes(ini_get('post_max_size'));
        $maxAllowed = min($maxUploadBytes, $maxPostBytes) / 1024;

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'file' => 'nullable|mimes:mp4|max:' . $maxAllowed,
            'url' => $hasUrl ? 'required|url' : 'nullable|url',
        ];

        $request->validate($rules, [
            'title.required' => 'Judul wajib diisi',
            'file.mimes' => 'File harus berformat MP4',
            'file.max' => 'Ukuran file melebihi batas maksimal (' . ini_get('upload_max_filesize') . '). Silakan gunakan URL video atau perbesar batas upload di PHP.',
            'url.required' => 'Harus mengupload file atau memasukkan URL video',
            'url.url' => 'URL tidak valid',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
        ]);

        if (!$hasFile && !$hasUrl && !$video->file_path && !$video->url) {
            return back()->with('error', 'Harus mengupload file atau memasukkan URL video (YouTube/Vimeo)')->withInput();
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ];

        try {
            if ($hasFile && !$hasUrl) {
                $file = $request->file('file');
                if ($file->getSize() > $maxUploadBytes) {
                    return back()->with('error', 'Ukuran file melebihi batas maksimal (' . ini_get('upload_max_filesize') . '). Silakan gunakan URL video atau perbesar batas upload di PHP.')->withInput();
                }

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('video')->putFileAs('', $file, $filename);

                $oldPath = $this->stripDiskPrefix($video->file_path, 'video');
                if ($oldPath) {
                    Storage::disk('video')->delete($oldPath);
                }

                $data['file_path'] = 'video/' . $filename;
                $data['url'] = null;
            } elseif ($hasUrl) {
                $url = $request->url;
                $isValidVideoUrl = false;

                if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false || strpos($url, 'vimeo.com') !== false) {
                    $isValidVideoUrl = true;
                }

                if (!$isValidVideoUrl) {
                    return back()->with('error', 'URL video tidak valid. Gunakan link YouTube atau Vimeo.')->withInput();
                }

                $oldPath = $this->stripDiskPrefix($video->file_path, 'video');
                if ($oldPath) {
                    Storage::disk('video')->delete($oldPath);
                }

                $data['url'] = $url;
                $data['file_path'] = null;
            }

            if ($request->hasFile('thumbnail')) {
                $oldThumb = $this->stripDiskPrefix($video->thumbnail, 'video');
                if ($oldThumb) {
                    Storage::disk('video')->delete($oldThumb);
                }

                $thumbnail = $request->file('thumbnail');
                $thumbnailName = Str::random(20) . '.' . $thumbnail->getClientOriginalExtension();
                Storage::disk('video')->putFileAs('thumbnails', $thumbnail, $thumbnailName);
                $data['thumbnail'] = 'video/thumbnails/' . $thumbnailName;
            }

            $video->update($data);

            return redirect()->route('admin.galeri.video.index')->with('success', 'Video berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui video: ' . $e->getMessage())->withInput();
        }
    }

    public function videoDestroy($id)
    {
        $video = Galeri::findOrFail($id);
        
        $oldPath = $this->stripDiskPrefix($video->file_path, 'video');
        if ($oldPath) {
            Storage::disk('video')->delete($oldPath);
        }
        
        $oldThumb = $this->stripDiskPrefix($video->thumbnail, 'video');
        if ($oldThumb) {
            Storage::disk('video')->delete($oldThumb);
        }
        
        $video->delete();
        
        return redirect()->route('admin.galeri.video.index')->with('success', 'Video berhasil dihapus');
    }

    // Infografis
    public function infografisCreate()
    {
        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'infografis')->orderBy('name')->get();
        }

        return view('admin.galeri.infografis.create', compact('categories'));
    }

    public function infografisStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
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

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('infografis')->putFileAs('', $file, $filename);
                $data['file_path'] = 'infografis/' . $filename;
            } elseif ($request->url) {
                $data['url'] = $request->url;
            } else {
                return back()->with('error', 'Harus mengupload file atau memasukkan URL')->withInput();
            }

            Galeri::create($data);

            return redirect()->route('admin.galeri.infografis.index')->with('success', 'Infografis berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan infografis: ' . $e->getMessage())->withInput();
        }
    }

    public function infografisIndex()
    {
        $infografis = Galeri::where('type', 'infografis')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.galeri.infografis.index', compact('infografis'));
    }

    public function infografisEdit($id)
    {
        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'infografis')->orderBy('name')->get();
        }

        $infografis = Galeri::where('type', 'infografis')->findOrFail($id);
        return view('admin.galeri.infografis.edit', compact('infografis', 'categories'));
    }

    public function infografisUpdate(Request $request, $id)
    {
        $infografis = Galeri::where('type', 'infografis')->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Judul wajib diisi',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berformat JPEG, JPG, atau PNG',
            'file.max' => 'Ukuran file maksimal 10MB',
            'url.url' => 'URL tidak valid',
        ]);

        $hasFile = $request->hasFile('file');
        $hasUrl = trim((string) $request->url) !== '';

        if (!$hasFile && !$hasUrl && !$infografis->file_path && !$infografis->url) {
            return back()->with('error', 'Harus mengupload file atau memasukkan URL')->withInput();
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ];

        try {
            if ($hasFile) {
                $oldPath = $this->stripDiskPrefix($infografis->file_path, 'infografis');
                if ($oldPath) {
                    Storage::disk('infografis')->delete($oldPath);
                }

                $file = $request->file('file');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('infografis')->putFileAs('', $file, $filename);
                $data['file_path'] = 'infografis/' . $filename;
                $data['url'] = null;
            } elseif ($hasUrl) {
                $oldPath = $this->stripDiskPrefix($infografis->file_path, 'infografis');
                if ($oldPath) {
                    Storage::disk('infografis')->delete($oldPath);
                }
                $data['url'] = $request->url;
                $data['file_path'] = null;
            }

            $infografis->update($data);

            return redirect()->route('admin.galeri.infografis.index')->with('success', 'Infografis berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui infografis: ' . $e->getMessage())->withInput();
        }
    }

    public function infografisDestroy($id)
    {
        $infografis = Galeri::findOrFail($id);
        
        $oldPath = $this->stripDiskPrefix($infografis->file_path, 'infografis');
        if ($oldPath) {
            Storage::disk('infografis')->delete($oldPath);
        }
        
        $infografis->delete();
        
        return redirect()->route('admin.galeri.infografis.index')->with('success', 'Infografis berhasil dihapus');
    }

    public function kategoriIndex()
    {
        $fotoCategories = [];
        $videoCategories = [];
        $infografisCategories = [];

        if (Schema::hasTable('galeri_kategori')) {
            $fotoCategories = GaleriKategori::where('type', 'foto')->orderBy('name')->get();
            $videoCategories = GaleriKategori::where('type', 'video')->orderBy('name')->get();
            $infografisCategories = GaleriKategori::where('type', 'infografis')->orderBy('name')->get();
        }

        return view('admin.galeri.kategori', compact('fotoCategories', 'videoCategories', 'infografisCategories'));
    }

    public function kategoriStore(Request $request)
    {
        if (!Schema::hasTable('galeri_kategori')) {
            return back()->with('error', 'Tabel kategori galeri belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $data = $request->validate([
            'type' => 'required|string|in:foto,video,infografis',
            'name' => 'required|string|max:255',
        ]);

        GaleriKategori::firstOrCreate([
            'type' => $data['type'],
            'name' => $data['name'],
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriDestroy($type, $name)
    {
        if (!Schema::hasTable('galeri_kategori')) {
            return back()->with('error', 'Tabel kategori galeri belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        GaleriKategori::where('type', $type)->where('name', urldecode($name))->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
