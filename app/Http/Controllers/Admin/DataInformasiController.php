<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerhakLunas;
use App\Models\Kbihu;
use App\Models\Ppiu;
use Illuminate\Http\Request;

class DataInformasiController extends Controller
{
    // ==================== BERHAK LUNAS ====================
    public function berhakLunasIndex()
    {
        $data = BerhakLunas::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.data-informasi.berhak-lunas.index', compact('data'));
    }

    public function berhakLunasCreate()
    {
        return view('admin.data-informasi.berhak-lunas.create');
    }

    public function berhakLunasStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_porsi' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'status' => 'required|in:Berhak Lunas,Menunggu,Tidak Berhak',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nomor_porsi.required' => 'Nomor porsi wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            BerhakLunas::create([
                'nama' => $request->nama,
                'nomor_porsi' => $request->nomor_porsi,
                'provinsi' => $request->provinsi,
                'status' => $request->status,
                'order' => $request->order ?? 0,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function berhakLunasEdit($id)
    {
        $data = BerhakLunas::findOrFail($id);
        return view('admin.data-informasi.berhak-lunas.edit', compact('data'));
    }

    public function berhakLunasUpdate(Request $request, $id)
    {
        $data = BerhakLunas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_porsi' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'status' => 'required|in:Berhak Lunas,Menunggu,Tidak Berhak',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nomor_porsi.required' => 'Nomor porsi wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            $data->update([
                'nama' => $request->nama,
                'nomor_porsi' => $request->nomor_porsi,
                'provinsi' => $request->provinsi,
                'status' => $request->status,
                'order' => $request->order ?? 0,
            ]);

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function berhakLunasDestroy($id)
    {
        try {
            $data = BerhakLunas::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ==================== KBIHU ====================
    public function kbihuIndex()
    {
        $data = Kbihu::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.data-informasi.kbihu.index', compact('data'));
    }

    public function kbihuCreate()
    {
        return view('admin.data-informasi.kbihu.create');
    }

    public function kbihuStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            Kbihu::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'order' => $request->order ?? 0,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function kbihuEdit($id)
    {
        $data = Kbihu::findOrFail($id);
        return view('admin.data-informasi.kbihu.edit', compact('data'));
    }

    public function kbihuUpdate(Request $request, $id)
    {
        $data = Kbihu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $data->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'order' => $request->order ?? 0,
            ]);

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function kbihuDestroy($id)
    {
        try {
            $data = Kbihu::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ==================== PPIU ====================
    public function ppiuIndex()
    {
        $data = Ppiu::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.data-informasi.ppiu.index', compact('data'));
    }

    public function ppiuCreate()
    {
        return view('admin.data-informasi.ppiu.create');
    }

    public function ppiuStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_izin' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama PPIU wajib diisi',
            'no_izin.required' => 'Nomor izin wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            Ppiu::create([
                'nama' => $request->nama,
                'no_izin' => $request->no_izin,
                'alamat' => $request->alamat,
                'status' => $request->status,
                'order' => $request->order ?? 0,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function ppiuEdit($id)
    {
        $data = Ppiu::findOrFail($id);
        return view('admin.data-informasi.ppiu.edit', compact('data'));
    }

    public function ppiuUpdate(Request $request, $id)
    {
        $data = Ppiu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_izin' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama PPIU wajib diisi',
            'no_izin.required' => 'Nomor izin wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            $data->update([
                'nama' => $request->nama,
                'no_izin' => $request->no_izin,
                'alamat' => $request->alamat,
                'status' => $request->status,
                'order' => $request->order ?? 0,
            ]);

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function ppiuDestroy($id)
    {
        try {
            $data = Ppiu::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
