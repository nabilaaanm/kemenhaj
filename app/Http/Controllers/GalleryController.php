<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function foto()
    {
        try {
            $fotos = Gallery::where('type', 'foto')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $fotos = collect([]);
        }
        
        return view('galeri.foto', compact('fotos'));
    }

    public function video()
    {
        try {
            $videos = Gallery::where('type', 'video')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $videos = collect([]);
        }
        
        return view('galeri.video', compact('videos'));
    }

    public function infografis()
    {
        try {
            $infografis = Gallery::where('type', 'infografis')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $infografis = collect([]);
        }
        
        return view('galeri.infografis', compact('infografis'));
    }
}
