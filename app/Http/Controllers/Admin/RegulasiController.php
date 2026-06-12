<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegulasiController extends Controller
{
    public function index()
    {
        $regulations = Regulasi::orderBy('regulation_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        
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
            'category' => 'required|in:' . implode(',', Regulasi::categoryKeys()),
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
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('regulations')->putFileAs('', $file, $fileName);
                $data['file_path'] = 'regulations/' . $fileName;
            }

            Regulasi::create($data);

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal menambahkan regulasi: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($judul, $tanggal)
    {
        $regulation = $this->findRegulasi($judul, $tanggal);
        return view('admin.regulasi.edit', compact('regulation'));
    }

    public function update(Request $request, $judul, $tanggal)
    {
        $regulation = $this->findRegulasi($judul, $tanggal);

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
            'category' => 'required|in:' . implode(',', Regulasi::categoryKeys()),
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
                if ($regulation->file_path && str_starts_with($regulation->file_path, 'regulations/')) {
                    $oldName = substr($regulation->file_path, strlen('regulations/'));
                    if ($oldName !== '') {
                        Storage::disk('regulations')->delete($oldName);
                    }
                }
                
                $file = $request->file('file');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('regulations')->putFileAs('', $file, $fileName);
                $data['file_path'] = 'regulations/' . $fileName;
            }

            $currentDate = $regulation->regulation_date instanceof \Carbon\Carbon
                ? $regulation->regulation_date->format('Y-m-d')
                : (string) $regulation->regulation_date;

            $pkChanged = $data['title'] !== $regulation->title
                || $data['regulation_date'] !== $currentDate;

            if ($pkChanged) {
                $data['is_active'] = $regulation->is_active;
                if (!isset($data['file_path'])) {
                    $data['file_path'] = $regulation->file_path;
                }
                $regulation->delete();
                Regulasi::create($data);
            } else {
                $regulation->update($data);
            }

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal memperbarui regulasi: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($judul, $tanggal)
    {
        try {
            $regulation = $this->findRegulasi($judul, $tanggal);
            
            // Delete file if exists
            if ($regulation->file_path && str_starts_with($regulation->file_path, 'regulations/')) {
                $oldName = substr($regulation->file_path, strlen('regulations/'));
                if ($oldName !== '') {
                    Storage::disk('regulations')->delete($oldName);
                }
            }
            
            $regulation->delete();

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal menghapus regulasi: ' . $e->getMessage());
        }
    }

    private function findRegulasi(string $judul, string $tanggal): Regulasi
    {
        $candidates = array_unique([
            Regulasi::decodeRouteTitle($judul),
            urldecode($judul),
        ]);

        foreach ($candidates as $title) {
            $regulation = Regulasi::where('title', $title)
                ->whereDate('regulation_date', $tanggal)
                ->first();

            if ($regulation) {
                return $regulation;
            }
        }

        abort(404);
    }
}
