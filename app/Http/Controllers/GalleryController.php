<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GalleryController extends Controller
{
    public function foto()
    {
        try {
            $fotos = Galeri::where('type', 'foto')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $fotos = collect([]);
        }

        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'foto')->orderBy('name')->get();
        }

        return view('galeri.foto', compact('fotos', 'categories'));
    }

    public function video()
    {
        try {
            $videos = Galeri::where('type', 'video')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $videos = collect([]);
        }

        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'video')->orderBy('name')->get();
        }

        return view('galeri.video', compact('videos', 'categories'));
    }

    public function infografis()
    {
        try {
            $infografis = Galeri::where('type', 'infografis')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $infografis = collect([]);
        }

        $categories = [];
        if (Schema::hasTable('galeri_kategori')) {
            $categories = GaleriKategori::where('type', 'infografis')->orderBy('name')->get();
        }

        return view('galeri.infografis', compact('infografis', 'categories'));
    }
}
