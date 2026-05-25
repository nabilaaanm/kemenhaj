<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use App\Models\PostingKategori;
use Illuminate\Support\Facades\Schema;

class PostingPublicController extends Controller
{
    protected function listByCategory(?string $slug, string $title, string $subtitle)
    {
        $posts = collect();
        $category = null;

        if (Schema::hasTable('postings')) {
            $query = Posting::with('category')->where('is_active', true);

            if ($slug) {
                $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
                $category = Schema::hasTable('posting_kategori')
                    ? PostingKategori::where('slug', $slug)->first()
                    : null;
            }

            $posts = $query->orderByDesc('published_at')->orderByDesc('id')->get();
        }

        return view('berita.listing', compact('posts', 'title', 'subtitle', 'category'));
    }

    public function berita()
    {
        return $this->listByCategory('berita', 'Berita', 'Berita Terkini');
    }

    public function terbaru()
    {
        return $this->listByCategory(null, 'Berita Terkini', 'Semua kategori terbaru');
    }

    public function siaranPers()
    {
        return $this->listByCategory('siaran-pers', 'Siaran Pers', 'Siaran Pers Resmi Kementerian Haji dan Umrah');
    }

    public function pengumuman()
    {
        return $this->listByCategory('pengumuman', 'Pengumuman', 'Informasi Pengumuman Terbaru');
    }

    public function klarifikasiHoax()
    {
        return $this->listByCategory('klarifikasi-hoax', 'Klarifikasi Hoax', 'Informasi Klarifikasi Hoax');
    }

    public function show(string $slug)
    {
        if (!Schema::hasTable('postings')) {
            abort(404);
        }

        $post = Posting::with('category')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $post->increment('views');

        return view('berita.show', compact('post'));
    }
}
