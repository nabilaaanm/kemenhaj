<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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

        $categories = [];
        if (Schema::hasTable('gallery_categories')) {
            $categories = GalleryCategory::where('type', 'foto')->orderBy('name')->get();
        }

        return view('galeri.foto', compact('fotos', 'categories'));
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

        $categories = [];
        if (Schema::hasTable('gallery_categories')) {
            $categories = GalleryCategory::where('type', 'video')->orderBy('name')->get();
        }

        return view('galeri.video', compact('videos', 'categories'));
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

        $categories = [];
        if (Schema::hasTable('gallery_categories')) {
            $categories = GalleryCategory::where('type', 'infografis')->orderBy('name')->get();
        }

        return view('galeri.infografis', compact('infografis', 'categories'));
    }
}
