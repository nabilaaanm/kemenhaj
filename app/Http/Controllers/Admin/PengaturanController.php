<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function umum()
    {
        return view('admin.pengaturan.umum');
    }

    public function modul()
    {
        return view('admin.pengaturan.modul');
    }

    public function tampilan()
    {
        return view('admin.pengaturan.tampilan');
    }

    public function slideshow()
    {
        return view('admin.pengaturan.slideshow');
    }

    public function pengguna()
    {
        return view('admin.pengaturan.pengguna');
    }

    public function panduan()
    {
        return view('admin.pengaturan.panduan');
    }

    public function updateUmum(Request $request)
    {
        // Simpan pengaturan umum (nama kemenhaj, kota, lambang)
        // Untuk demo, kita simpan ke session atau file config
        // Dalam production, simpan ke database
        
        $request->validate([
            'nama_kemenhaj' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'lambang' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Handle upload lambang jika ada
        if ($request->hasFile('lambang')) {
            $file = $request->file('lambang');
            $filename = 'lambang.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $filename);
        }

        return redirect()->route('admin.pengaturan.umum')
            ->with('success', 'Pengaturan umum berhasil disimpan.');
    }
}
