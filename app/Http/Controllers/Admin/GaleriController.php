<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GaleriController extends Controller
{
    // Foto
    public function fotoCreate()
    {
        return view('admin.galeri.foto.create');
    }

    public function fotoIndex()
    {
        return view('admin.galeri.foto.index');
    }

    // Video
    public function videoCreate()
    {
        return view('admin.galeri.video.create');
    }

    public function videoIndex()
    {
        return view('admin.galeri.video.index');
    }

    // Infografis
    public function infografisCreate()
    {
        return view('admin.galeri.infografis.create');
    }

    public function infografisIndex()
    {
        return view('admin.galeri.infografis.index');
    }
}
