<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegulasiController extends Controller
{
    public function index()
    {
        $regulations = Regulation::orderBy('regulation_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.regulasi.index', compact('regulations'));
    }

    public function create()
    {
        return view('admin.regulasi.create');
    }

    public function store(Request $request)
    {
        if (isset($_FILES['file']) && isset($_FILES['file']['error']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadError = $_FILES['file']['error'];
            if ($uploadError !== UPLOAD_ERR_OK) {
                $maxUpload = ini_get('upload_max_filesize');
                $maxPost = ini_get('post_max_size');
                $message = 'File gagal di-upload.';
                if ($uploadError === UPLOAD_ERR_INI_SIZE || $uploadError === UPLOAD_ERR_FORM_SIZE) {
                    $message = "File gagal di-upload. Ukuran file melebihi batas PHP (upload_max_filesize: {$maxUpload}, post_max_size: {$maxPost}).";
                } elseif ($uploadError === UPLOAD_ERR_PARTIAL) {
                    $message = 'File hanya terupload sebagian. Coba ulangi.';
                } elseif ($uploadError === UPLOAD_ERR_NO_TMP_DIR) {
                    $message = 'Folder sementara (tmp) tidak tersedia.';
                } elseif ($uploadError === UPLOAD_ERR_CANT_WRITE) {
                    $message = 'Gagal menulis file ke disk.';
                } elseif ($uploadError === UPLOAD_ERR_EXTENSION) {
                    $message = 'Upload diblok oleh ekstensi PHP.';
                }
                return back()->with('error', $message)->withInput();
            }
        }

        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'nullable|string',
            'category' => 'required|in:uu,perpres,lainnya',
            'regulation_date' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
        ], [
            'title.required' => 'Judul regulasi wajib diisi',
            'category.required' => 'Kategori wajib dipilih',
            'category.in' => 'Kategori tidak valid',
            'regulation_date.required' => 'Tanggal regulasi wajib diisi',
            'regulation_date.date' => 'Tanggal tidak valid',
            'file.mimes' => 'File harus berupa PDF',
            'file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'regulation_date' => $request->regulation_date,
                'is_active' => true,
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Ensure directory exists
                $directory = public_path('regulations');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $fileName = 'regulations/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move($directory, basename($fileName));
                $data['file_path'] = $fileName;
            }

            Regulation::create($data);

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan regulasi: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $regulation = Regulation::findOrFail($id);
        return view('admin.regulasi.edit', compact('regulation'));
    }

    public function update(Request $request, $id)
    {
        $regulation = Regulation::findOrFail($id);

        if (isset($_FILES['file']) && isset($_FILES['file']['error']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadError = $_FILES['file']['error'];
            if ($uploadError !== UPLOAD_ERR_OK) {
                $maxUpload = ini_get('upload_max_filesize');
                $maxPost = ini_get('post_max_size');
                $message = 'File gagal di-upload.';
                if ($uploadError === UPLOAD_ERR_INI_SIZE || $uploadError === UPLOAD_ERR_FORM_SIZE) {
                    $message = "File gagal di-upload. Ukuran file melebihi batas PHP (upload_max_filesize: {$maxUpload}, post_max_size: {$maxPost}).";
                } elseif ($uploadError === UPLOAD_ERR_PARTIAL) {
                    $message = 'File hanya terupload sebagian. Coba ulangi.';
                } elseif ($uploadError === UPLOAD_ERR_NO_TMP_DIR) {
                    $message = 'Folder sementara (tmp) tidak tersedia.';
                } elseif ($uploadError === UPLOAD_ERR_CANT_WRITE) {
                    $message = 'Gagal menulis file ke disk.';
                } elseif ($uploadError === UPLOAD_ERR_EXTENSION) {
                    $message = 'Upload diblok oleh ekstensi PHP.';
                }
                return back()->with('error', $message)->withInput();
            }
        }

        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'nullable|string',
            'category' => 'required|in:uu,perpres,lainnya',
            'regulation_date' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
        ], [
            'title.required' => 'Judul regulasi wajib diisi',
            'category.required' => 'Kategori wajib dipilih',
            'category.in' => 'Kategori tidak valid',
            'regulation_date.required' => 'Tanggal regulasi wajib diisi',
            'regulation_date.date' => 'Tanggal tidak valid',
            'file.mimes' => 'File harus berupa PDF',
            'file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'regulation_date' => $request->regulation_date,
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                // Delete old file
                if ($regulation->file_path && file_exists(public_path($regulation->file_path))) {
                    unlink(public_path($regulation->file_path));
                }
                
                $file = $request->file('file');
                
                // Ensure directory exists
                $directory = public_path('regulations');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $fileName = 'regulations/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move($directory, basename($fileName));
                $data['file_path'] = $fileName;
            }

            $regulation->update($data);

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui regulasi: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $regulation = Regulation::findOrFail($id);
            
            // Delete file if exists
            if ($regulation->file_path && file_exists(public_path($regulation->file_path))) {
                unlink(public_path($regulation->file_path));
            }
            
            $regulation->delete();

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus regulasi: ' . $e->getMessage());
        }
    }
}
