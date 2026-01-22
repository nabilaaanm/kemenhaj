<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PostingController;
use App\Http\Controllers\PostingPublicController;
use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\RegulasiController;
use App\Http\Controllers\Admin\DataInformasiController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Models\Slideshow;
use App\Models\Posting;
use App\Models\Regulation;
use App\Models\Gallery;
use App\Models\Kbihu;
use App\Models\Ppiu;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegulasiController as PublicRegulasiController;
use Illuminate\Support\Facades\Schema;

// ==================== PUBLIC ROUTES (Tanpa Session) ====================
Route::get('/', function () {
    if (!Schema::hasTable('slideshows')) {
        $slides = collect();
        $popularPosts = collect();
        $latestPosts = collect();
        $announcementPosts = collect();
        $hoaxPosts = collect();
        $pressPosts = collect();
        $homeVideos = collect();
        $homeInfografis = collect();
        $homeFotos = collect();
        $homeRegulations = collect();

        if (Schema::hasTable('postings')) {
            $popularPosts = Posting::with('category')
                ->where('is_active', true)
                ->orderByDesc('views')
                ->orderByDesc('published_at')
                ->take(2)
                ->get();

            $latestPosts = Posting::with('category')
                ->where('is_active', true)
                ->orderByDesc('created_at')
                ->take(3)
                ->get();

            $announcementPosts = Posting::with('category')
                ->where('is_active', true)
                ->whereHas('category', function ($q) {
                $q->where('slug', 'pengumuman');
            })
                ->orderByDesc('created_at')
                ->take(3)
                ->get();

            $hoaxPosts = Posting::with('category')
                ->where('is_active', true)
                ->whereHas('category', function ($q) {
                $q->where('slug', 'klarifikasi-hoax');
            })
                ->orderByDesc('created_at')
                ->take(3)
                ->get();

            $pressPosts = Posting::with('category')
                ->where('is_active', true)
                ->whereHas('category', function ($q) {
                $q->where('slug', 'siaran-pers');
            })
                ->orderByDesc('created_at')
                ->take(3)
                ->get();
        }

        if (Schema::hasTable('galleries')) {
            $homeVideos = Gallery::where('type', 'video')->where('is_active', true)
                ->orderByDesc('created_at')->take(3)->get();
            $homeInfografis = Gallery::where('type', 'infografis')->where('is_active', true)
                ->orderByDesc('created_at')->take(3)->get();
            $homeFotos = Gallery::where('type', 'foto')->where('is_active', true)
                ->orderByDesc('created_at')->take(3)->get();
        }

        if (Schema::hasTable('regulations')) {
            $homeRegulations = Regulation::where('is_active', true)
                ->orderBy('order')
                ->orderByDesc('regulation_date')
                ->take(3)
                ->get();
        }

        return view('home', compact('slides', 'popularPosts', 'latestPosts', 'announcementPosts', 'pressPosts', 'hoaxPosts', 'homeVideos', 'homeInfografis', 'homeFotos', 'homeRegulations'));
    }

    $slides = Slideshow::where('is_active', true)
        ->orderBy('order')
        ->orderBy('id')
        ->get();

    $popularPosts = collect();
    $latestPosts = collect();
    $announcementPosts = collect();
    $hoaxPosts = collect();
    $pressPosts = collect();
    $homeVideos = collect();
    $homeInfografis = collect();
    $homeFotos = collect();
    $homeRegulations = collect();

    if (Schema::hasTable('postings')) {
        $popularPosts = Posting::with('category')
            ->where('is_active', true)
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(2)
            ->get();

        $latestPosts = Posting::with('category')
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $announcementPosts = Posting::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'pengumuman');
            })
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $hoaxPosts = Posting::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'klarifikasi-hoax');
            })
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $pressPosts = Posting::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'siaran-pers');
            })
            ->orderByDesc('created_at')
            ->take(3)
            ->get();
    }
    if (Schema::hasTable('postings')) {
        $popularPosts = Posting::with('category')
            ->where('is_active', true)
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(2)
            ->get();

        $latestPosts = Posting::with('category')
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $announcementPosts = Posting::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'pengumuman');
            })
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $hoaxPosts = Posting::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'klarifikasi-hoax');
            })
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $pressPosts = Posting::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'siaran-pers');
            })
            ->orderByDesc('created_at')
            ->take(3)
            ->get();
    }

    if (Schema::hasTable('galleries')) {
        $homeVideos = Gallery::where('type', 'video')->where('is_active', true)
            ->orderByDesc('created_at')->take(3)->get();
        $homeInfografis = Gallery::where('type', 'infografis')->where('is_active', true)
            ->orderByDesc('created_at')->take(3)->get();
        $homeFotos = Gallery::where('type', 'foto')->where('is_active', true)
            ->orderByDesc('created_at')->take(3)->get();
    }

    if (Schema::hasTable('regulations')) {
        $homeRegulations = Regulation::where('is_active', true)
            ->orderBy('order')
            ->orderByDesc('regulation_date')
            ->take(3)
            ->get();
    }

    return view('home', compact('slides', 'popularPosts', 'latestPosts', 'announcementPosts', 'pressPosts', 'hoaxPosts', 'homeVideos', 'homeInfografis', 'homeFotos', 'homeRegulations'));
})->name('home');

// ==================== AUTH ROUTES (Login) ====================
// Login - Hidden route dengan path yang susah ditebak (tidak ditampilkan di menu)
Route::get('/kemenhaj-admin-secure', [AuthController::class, 'showLogin'])->name('login');
Route::post('/kemenhaj-admin-secure', [AuthController::class, 'login'])->name('login.post');


Route::get('/visi-misi', function () {
    return view('profil.visi-misi');
});
Route::get('/regulasi', [PublicRegulasiController::class, 'index'])->name('regulasi');
Route::get('/layanan', [ServiceController::class, 'index'])->name('layanan');
Route::get('/data-informasi', function () {
    $kbihuData = collect();
    $ppiuData = collect();
    if (Schema::hasTable('kbihu')) {
        $kbihuData = Kbihu::where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();
    }
    if (Schema::hasTable('ppiu')) {
        $ppiuData = Ppiu::where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();
    }

    return view('data-informasi', compact('kbihuData', 'ppiuData'));
});
Route::get('/lk-pih', function () {
    return view('lk-pih');
});
Route::get('/berita', [PostingPublicController::class, 'berita'])->name('berita');
Route::get('/pengumuman', [PostingPublicController::class, 'pengumuman'])->name('pengumuman');
Route::get('/siaran-pers', [PostingPublicController::class, 'siaranPers'])->name('siaran-pers');
Route::get('/klarifikasi-hoax', [PostingPublicController::class, 'klarifikasiHoax'])->name('klarifikasi-hoax');
Route::get('/posting/{slug}', [PostingPublicController::class, 'show'])->name('posting.show');
Route::get('/kontak', [ProfilController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/sejarah', function () {
    return view('profil.sejarah');
});
Route::get('/foto', [GalleryController::class, 'foto'])->name('galeri.foto');
Route::get('/video', [GalleryController::class, 'video'])->name('galeri.video');
Route::get('/infografis', [GalleryController::class, 'infografis'])->name('galeri.infografis');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== PROTECTED ROUTES (Perlu Session) ====================
Route::middleware(['auth.session'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard - bisa diakses semua role yang sudah login
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Posting - Admin, Editor, Kontributor
    Route::middleware(['role:admin,editor,kontributor'])->prefix('posting')->name('posting.')->group(function () {
        Route::get('/create', [PostingController::class, 'create'])->name('create');
        Route::post('/create', [PostingController::class, 'store'])->name('store');
        Route::get('/', [PostingController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [PostingController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [PostingController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostingController::class, 'destroy'])->name('destroy');
        Route::get('/category', [PostingController::class, 'category'])->name('category');
        Route::post('/category', [PostingController::class, 'categoryStore'])->name('category.store');
        Route::delete('/category/{id}', [PostingController::class, 'categoryDestroy'])->name('category.destroy');
    });
    
    // Halaman - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('halaman')->name('halaman.')->group(function () {
        Route::get('/create', [HalamanController::class, 'create'])->name('create');
        Route::get('/', [HalamanController::class, 'index'])->name('index');
    });
    
    // Galeri - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('galeri')->name('galeri.')->group(function () {
        Route::get('/kategori', [GaleriController::class, 'kategoriIndex'])->name('kategori');
        Route::post('/kategori', [GaleriController::class, 'kategoriStore'])->name('kategori.store');
        Route::delete('/kategori/{id}', [GaleriController::class, 'kategoriDestroy'])->name('kategori.destroy');
        // Foto
        Route::prefix('foto')->name('foto.')->group(function () {
            Route::get('/create', [GaleriController::class, 'fotoCreate'])->name('create');
            Route::post('/create', [GaleriController::class, 'fotoStore'])->name('store');
            Route::get('/', [GaleriController::class, 'fotoIndex'])->name('index');
            Route::delete('/{id}', [GaleriController::class, 'fotoDestroy'])->name('destroy');
        });
        // Video
        Route::prefix('video')->name('video.')->group(function () {
            Route::get('/create', [GaleriController::class, 'videoCreate'])->name('create');
            Route::post('/create', [GaleriController::class, 'videoStore'])->name('store');
            Route::get('/', [GaleriController::class, 'videoIndex'])->name('index');
            Route::delete('/{id}', [GaleriController::class, 'videoDestroy'])->name('destroy');
        });
        // Infografis
        Route::prefix('infografis')->name('infografis.')->group(function () {
            Route::get('/create', [GaleriController::class, 'infografisCreate'])->name('create');
            Route::post('/create', [GaleriController::class, 'infografisStore'])->name('store');
            Route::get('/', [GaleriController::class, 'infografisIndex'])->name('index');
            Route::delete('/{id}', [GaleriController::class, 'infografisDestroy'])->name('destroy');
        });
    });
    
    // Layanan - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/', [LayananController::class, 'index'])->name('index');
        Route::get('/create', [LayananController::class, 'create'])->name('create');
        Route::post('/create', [LayananController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LayananController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [LayananController::class, 'update'])->name('update');
        Route::delete('/{id}', [LayananController::class, 'destroy'])->name('destroy');
    });
    
    // Regulasi - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('regulasi')->name('regulasi.')->group(function () {
        Route::get('/', [RegulasiController::class, 'index'])->name('index');
        Route::get('/create', [RegulasiController::class, 'create'])->name('create');
        Route::post('/create', [RegulasiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RegulasiController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [RegulasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [RegulasiController::class, 'destroy'])->name('destroy');
    });
    
    // Data Informasi - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('data-informasi')->name('data-informasi.')->group(function () {
        // Berhak Lunas
        Route::prefix('berhak-lunas')->name('berhak-lunas.')->group(function () {
            Route::get('/', [DataInformasiController::class, 'berhakLunasIndex'])->name('index');
            Route::get('/create', [DataInformasiController::class, 'berhakLunasCreate'])->name('create');
            Route::post('/create', [DataInformasiController::class, 'berhakLunasStore'])->name('store');
            Route::get('/{id}/edit', [DataInformasiController::class, 'berhakLunasEdit'])->name('edit');
            Route::post('/{id}/edit', [DataInformasiController::class, 'berhakLunasUpdate'])->name('update');
            Route::delete('/{id}', [DataInformasiController::class, 'berhakLunasDestroy'])->name('destroy');
        });
        // KBIHU
        Route::prefix('kbihu')->name('kbihu.')->group(function () {
            Route::get('/', [DataInformasiController::class, 'kbihuIndex'])->name('index');
            Route::get('/create', [DataInformasiController::class, 'kbihuCreate'])->name('create');
            Route::post('/create', [DataInformasiController::class, 'kbihuStore'])->name('store');
            Route::post('/import', [DataInformasiController::class, 'kbihuImport'])->name('import');
            Route::get('/{id}/edit', [DataInformasiController::class, 'kbihuEdit'])->name('edit');
            Route::post('/{id}/edit', [DataInformasiController::class, 'kbihuUpdate'])->name('update');
            Route::delete('/{id}', [DataInformasiController::class, 'kbihuDestroy'])->name('destroy');
        });
        // PPIU
        Route::prefix('ppiu')->name('ppiu.')->group(function () {
            Route::get('/', [DataInformasiController::class, 'ppiuIndex'])->name('index');
            Route::get('/create', [DataInformasiController::class, 'ppiuCreate'])->name('create');
            Route::post('/create', [DataInformasiController::class, 'ppiuStore'])->name('store');
            Route::post('/import', [DataInformasiController::class, 'ppiuImport'])->name('import');
            Route::get('/{id}/edit', [DataInformasiController::class, 'ppiuEdit'])->name('edit');
            Route::post('/{id}/edit', [DataInformasiController::class, 'ppiuUpdate'])->name('update');
            Route::delete('/{id}', [DataInformasiController::class, 'ppiuDestroy'])->name('destroy');
        });
    });
    
    // Panduan - Semua Role
    Route::get('/pengaturan/panduan', [PengaturanController::class, 'panduan'])->name('pengaturan.panduan');
    
    // Profil - Admin Only
    Route::middleware(['role:admin'])->prefix('profil')->name('profil.')->group(function () {
        Route::get('/struktur', [PengaturanController::class, 'profilStruktur'])->name('struktur');
        Route::post('/struktur', [PengaturanController::class, 'updateProfil'])->name('struktur.update');
        Route::get('/kontak', [PengaturanController::class, 'profilKontak'])->name('kontak');
        Route::post('/kontak', [PengaturanController::class, 'updateProfil'])->name('kontak.update');
        Route::post('/tim', [PengaturanController::class, 'timStore'])->name('tim.store');
        Route::put('/tim/{id}', [PengaturanController::class, 'timUpdate'])->name('tim.update');
        Route::delete('/tim/{id}', [PengaturanController::class, 'timDestroy'])->name('tim.destroy');
    });

    // Pengaturan - Admin Only
    Route::middleware(['role:admin'])->prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/umum', [PengaturanController::class, 'umum'])->name('umum');
        Route::post('/umum', [PengaturanController::class, 'updateUmum'])->name('umum.update');
        Route::get('/modul', [PengaturanController::class, 'modul'])->name('modul');
        Route::get('/tampilan', [PengaturanController::class, 'tampilan'])->name('tampilan');
        Route::get('/slideshow', [SlideshowController::class, 'index'])->name('slideshow');
        Route::get('/slideshow/create', [SlideshowController::class, 'create'])->name('slideshow.create');
        Route::post('/slideshow', [SlideshowController::class, 'store'])->name('slideshow.store');
        Route::get('/slideshow/{id}/edit', [SlideshowController::class, 'edit'])->name('slideshow.edit');
        Route::put('/slideshow/{id}', [SlideshowController::class, 'update'])->name('slideshow.update');
        Route::delete('/slideshow/{id}', [SlideshowController::class, 'destroy'])->name('slideshow.destroy');
        
        // Manajemen Pengguna - Admin Only
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });
});