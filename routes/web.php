<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PostingController;
use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\RegulasiController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegulasiController as PublicRegulasiController;

// ==================== PUBLIC ROUTES (Tanpa Session) ====================
Route::get('/', function () {
    return view('home');
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
    return view('data-informasi');
});
Route::get('/lk-pih', function () {
    return view('lk-pih');
});
Route::get('/berita', function () {
    return view('berita.berita');
});
Route::get('/pengumuman', function () {
    return view('berita.pengumuman');
});
Route::get('/siaran-pers', function () {
    return view('berita.siaran-pers');
});
Route::get('/klarifikasi-hoax', function () {
    return view('berita.klarifikasi-hoax');
});
Route::get('/kontak', function () {
    return view('profil.kontak');
});
Route::get('/struktur-organisasi', function () {
    return view('profil.struktur-organisasi');
});
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
        Route::get('/', [PostingController::class, 'index'])->name('index');
        Route::get('/category', [PostingController::class, 'category'])->name('category');
        Route::get('/berita', [PostingController::class, 'berita'])->name('berita');
        Route::get('/pengumuman', [PostingController::class, 'pengumuman'])->name('pengumuman');
        Route::get('/siaran-pers', [PostingController::class, 'siaranPers'])->name('siaran-pers');
        Route::get('/hoax', [PostingController::class, 'hoax'])->name('hoax');
    });
    
    // Halaman - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('halaman')->name('halaman.')->group(function () {
        Route::get('/create', [HalamanController::class, 'create'])->name('create');
        Route::get('/', [HalamanController::class, 'index'])->name('index');
    });
    
    // Galeri - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('galeri')->name('galeri.')->group(function () {
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
    
    // Panduan - Semua Role
    Route::get('/pengaturan/panduan', [PengaturanController::class, 'panduan'])->name('pengaturan.panduan');
    
    // Pengaturan - Admin Only
    Route::middleware(['role:admin'])->prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/umum', [PengaturanController::class, 'umum'])->name('umum');
        Route::post('/umum', [PengaturanController::class, 'updateUmum'])->name('umum.update');
        Route::get('/modul', [PengaturanController::class, 'modul'])->name('modul');
        Route::get('/tampilan', [PengaturanController::class, 'tampilan'])->name('tampilan');
        Route::get('/slideshow', [PengaturanController::class, 'slideshow'])->name('slideshow');
        
        // Manajemen Pengguna - Admin Only
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });
});