<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegulasiController extends Controller
{
    public function index()
    {
        $regulations = Regulation::orderBy('order', 'asc')
            ->orderBy('regulation_date', 'desc')
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
        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'nullable|string',
            'category' => 'required|in:uu,perpres,lainnya',
            'regulation_date' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'order' => 'nullable|integer|min:0',
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
                'order' => $request->order ?? 0,
                'is_active' => true,
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Ensure directory exists
                $directory = 'public/regulations';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                
                $fileName = 'regulations/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('', $fileName, 'public');
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

        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'nullable|string',
            'category' => 'required|in:uu,perpres,lainnya',
            'regulation_date' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'order' => 'nullable|integer|min:0',
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
                'order' => $request->order ?? 0,
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                // Delete old file
                if ($regulation->file_path && Storage::disk('public')->exists($regulation->file_path)) {
                    Storage::disk('public')->delete($regulation->file_path);
                }
                
                $file = $request->file('file');
                
                // Ensure directory exists
                $directory = 'public/regulations';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                
                $fileName = 'regulations/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('', $fileName, 'public');
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
            if ($regulation->file_path && Storage::disk('public')->exists($regulation->file_path)) {
                Storage::disk('public')->delete($regulation->file_path);
            }
            
            $regulation->delete();

            return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus regulasi: ' . $e->getMessage());
        }
    }
}
