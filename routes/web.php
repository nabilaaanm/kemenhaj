<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PostingController;
use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PengaturanController;

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
Route::get('/regulasi', function () {
    return view('regulasi');
});
Route::get('/layanan', function () {
    return view('layanan');
});
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
Route::get('/foto', function () {
    return view('galeri.foto');
});
Route::get('/video', function () {
    return view('galeri.video');
});
Route::get('/infografis', function () {
    return view('galeri.infografis');
});

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
            Route::get('/', [GaleriController::class, 'fotoIndex'])->name('index');
        });
        // Video
        Route::prefix('video')->name('video.')->group(function () {
            Route::get('/create', [GaleriController::class, 'videoCreate'])->name('create');
            Route::get('/', [GaleriController::class, 'videoIndex'])->name('index');
        });
        // Infografis
        Route::prefix('infografis')->name('infografis.')->group(function () {
            Route::get('/create', [GaleriController::class, 'infografisCreate'])->name('create');
            Route::get('/', [GaleriController::class, 'infografisIndex'])->name('index');
        });
    });
    
    // Layanan - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/create', [LayananController::class, 'create'])->name('create');
        Route::get('/', [LayananController::class, 'index'])->name('index');
    });
    
    // Pengaturan - Admin Only
    Route::middleware(['role:admin'])->prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/umum', [PengaturanController::class, 'umum'])->name('umum');
        Route::post('/umum', [PengaturanController::class, 'updateUmum'])->name('umum.update');
        Route::get('/modul', [PengaturanController::class, 'modul'])->name('modul');
        Route::get('/tampilan', [PengaturanController::class, 'tampilan'])->name('tampilan');
        Route::get('/slideshow', [PengaturanController::class, 'slideshow'])->name('slideshow');
        Route::get('/pengguna', [PengaturanController::class, 'pengguna'])->name('pengguna');
        Route::get('/panduan', [PengaturanController::class, 'panduan'])->name('panduan');
    });
});