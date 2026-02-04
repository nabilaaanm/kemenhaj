<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LkPihDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LkPihController extends Controller
{
    public function index()
    {
        $lkDocuments = LkPihDocument::where('type', 'lk')
            ->orderBy('order', 'asc')
            ->orderBy('document_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $pihDocuments = LkPihDocument::where('type', 'pih')
            ->orderBy('order', 'asc')
            ->orderBy('document_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.lk-pih.index', compact('lkDocuments', 'pihDocuments'));
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
            'type' => 'required|in:lk,pih',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document_date' => 'required|date',
            'file' => 'required|mimes:pdf|max:10240',
            'order' => 'nullable|integer|min:0',
        ], [
            'type.required' => 'Jenis dokumen wajib dipilih',
            'type.in' => 'Jenis dokumen tidak valid',
            'title.required' => 'Judul dokumen wajib diisi',
            'document_date.required' => 'Tanggal dokumen wajib diisi',
            'document_date.date' => 'Tanggal tidak valid',
            'file.required' => 'File PDF wajib diunggah',
            'file.mimes' => 'File harus berupa PDF',
            'file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $data = [
                'type' => $request->type,
                'title' => $request->title,
                'description' => $request->description,
                'document_date' => $request->document_date,
                'order' => $request->order ?? 0,
                'is_active' => true,
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('lk_pih')->putFileAs('', $file, $fileName);
                $data['file_path'] = 'lk-pih/' . $fileName;
            }

            LkPihDocument::create($data);

            return redirect()->route('admin.lk-pih.index')->with('success', 'Dokumen berhasil diunggah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah dokumen: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $doc = LkPihDocument::findOrFail($id);

            if ($doc->file_path && str_starts_with($doc->file_path, 'lk-pih/')) {
                $oldName = substr($doc->file_path, strlen('lk-pih/'));
                if ($oldName !== '') {
                    Storage::disk('lk_pih')->delete($oldName);
                }
            }

            $doc->delete();

            return redirect()->route('admin.lk-pih.index')->with('success', 'Dokumen berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus dokumen: ' . $e->getMessage());
        }
    }
}
