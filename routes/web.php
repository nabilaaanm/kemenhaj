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
use App\Http\Controllers\Admin\LkPihController;
use App\Http\Controllers\Admin\DataInformasiController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\PageController;
use App\Models\Slideshow;
use App\Models\Posting;
use App\Models\Regulasi;
use App\Models\Galeri;
use App\Models\Kbihu;
use App\Models\Ppiu;
use App\Models\LkPihDocument;
use App\Models\BerhakLunas;
use App\Models\HajiJamaah;
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

        if (Schema::hasTable('galeri')) {
            $homeVideos = Galeri::where('type', 'video')->where('is_active', true)
                ->orderByDesc('created_at')->take(3)->get();
            $homeInfografis = Galeri::where('type', 'infografis')->where('is_active', true)
                ->orderByDesc('created_at')->take(3)->get();
            $homeFotos = Galeri::where('type', 'foto')->where('is_active', true)
                ->orderByDesc('created_at')->take(3)->get();
        }

        if (Schema::hasTable('regulasi')) {
            $homeRegulations = Regulasi::where('is_active', true)
                ->orderByDesc('regulation_date')
                ->take(3)
                ->get();
        }

        return view('home', compact('slides', 'popularPosts', 'latestPosts', 'announcementPosts', 'pressPosts', 'hoaxPosts', 'homeVideos', 'homeInfografis', 'homeFotos', 'homeRegulations'));
    }

    $slides = Slideshow::where('is_active', true)
        ->orderBy('order')
        ->orderBy('title')
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

    if (Schema::hasTable('galeri')) {
        $homeVideos = Galeri::where('type', 'video')->where('is_active', true)
            ->orderByDesc('created_at')->take(3)->get();
        $homeInfografis = Galeri::where('type', 'infografis')->where('is_active', true)
            ->orderByDesc('created_at')->take(3)->get();
        $homeFotos = Galeri::where('type', 'foto')->where('is_active', true)
            ->orderByDesc('created_at')->take(3)->get();
    }

    if (Schema::hasTable('regulasi')) {
        $homeRegulations = Regulasi::where('is_active', true)
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
Route::get('/kemenhaj-admin-secure/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/kemenhaj-admin-secure/forgot-password', [AuthController::class, 'processForgotPassword'])->name('password.update');


Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/regulasi', [PublicRegulasiController::class, 'index'])->name('regulasi');
Route::get('/layanan', [ServiceController::class, 'index'])->name('layanan');
Route::get('/data-informasi', function () {
    $kbihuData = collect();
    $ppiuData = collect();
    $berhakLunasResults = collect();
    $berhakLunasQuery = request()->query('nomor_porsi');
    $berhakLunasSearched = false;
    $statTotals = [
        'total' => 0,
        'total_departed' => 0,
        'total_year_selected' => 0,
        'total_year_previous' => 0,
        'year_selected' => null,
        'year_previous' => null,
        'latest_year' => null,
    ];
    $statChartData = [
        'perYear' => ['labels' => [], 'data' => []],
        'gender' => ['labels' => [], 'data' => []],
        'age' => ['labels' => [], 'data' => []],
        'education' => ['labels' => [], 'data' => []],
        'kecamatan' => ['labels' => [], 'data' => []],
    ];
    $statYearOptions = [];
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
    if (Schema::hasTable('berhak_lunas')) {
        $query = trim((string) $berhakLunasQuery);
        if ($query !== '') {
            $berhakLunasSearched = true;
            $berhakLunasResults = BerhakLunas::where('is_active', true)
                ->where('nomor_porsi', $query)
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    if (Schema::hasTable('haji_jamaahs')) {
        $statTotals['total'] = HajiJamaah::count();

        $perYearRows = HajiJamaah::selectRaw('tahun_keberangkatan as label, COUNT(*) as total')
            ->whereNotNull('tahun_keberangkatan')
            ->groupBy('tahun_keberangkatan')
            ->orderBy('tahun_keberangkatan')
            ->get();
        $statChartData['perYear'] = [
            'labels' => $perYearRows->pluck('label')->map(fn ($v) => (string) $v)->toArray(),
            'data' => $perYearRows->pluck('total')->toArray(),
        ];

        $statYearOptions = HajiJamaah::whereNotNull('tahun_keberangkatan')
            ->distinct()
            ->orderBy('tahun_keberangkatan', 'desc')
            ->pluck('tahun_keberangkatan')
            ->map(fn ($v) => (int) $v)
            ->values()
            ->toArray();

        $selectedYear = request()->query('tahun');
        if ($selectedYear !== null && $selectedYear !== '') {
            $selectedYear = (int) $selectedYear;
        } else {
            $selectedYear = $statYearOptions[0] ?? null;
        }

        $statTotals['year_selected'] = $selectedYear;
        $statTotals['latest_year'] = $statYearOptions[0] ?? null;

        $yearIndex = $selectedYear !== null ? array_search($selectedYear, $statYearOptions, true) : false;
        $previousYear = ($yearIndex !== false && isset($statYearOptions[$yearIndex + 1])) ? $statYearOptions[$yearIndex + 1] : null;
        $statTotals['year_previous'] = $previousYear;

        if ($selectedYear !== null) {
            $statTotals['total_year_selected'] = HajiJamaah::where('tahun_keberangkatan', $selectedYear)->count();
            $statTotals['total_departed'] = $statTotals['total_year_selected'];
        }
        if ($previousYear !== null) {
            $statTotals['total_year_previous'] = HajiJamaah::where('tahun_keberangkatan', $previousYear)->count();
        }

        $baseQuery = HajiJamaah::query();
        if ($selectedYear !== null) {
            $baseQuery->where('tahun_keberangkatan', $selectedYear);
        }

        $genderRows = (clone $baseQuery)->selectRaw("COALESCE(NULLIF(jenis_kelamin, ''), 'Tidak diketahui') as label, COUNT(*) as total")
            ->groupBy('label')
            ->orderByDesc('total')
            ->get();
        $statChartData['gender'] = [
            'labels' => $genderRows->pluck('label')->toArray(),
            'data' => $genderRows->pluck('total')->toArray(),
        ];

        $ageBuckets = [
            '<20' => 0,
            '20-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60+' => 0,
        ];
        $ages = (clone $baseQuery)->whereNotNull('usia')->pluck('usia');
        foreach ($ages as $age) {
            $age = (int) $age;
            if ($age < 20) {
                $ageBuckets['<20']++;
            } elseif ($age < 30) {
                $ageBuckets['20-29']++;
            } elseif ($age < 40) {
                $ageBuckets['30-39']++;
            } elseif ($age < 50) {
                $ageBuckets['40-49']++;
            } elseif ($age < 60) {
                $ageBuckets['50-59']++;
            } else {
                $ageBuckets['60+']++;
            }
        }
        $statChartData['age'] = [
            'labels' => array_keys($ageBuckets),
            'data' => array_values($ageBuckets),
        ];

        $eduRows = (clone $baseQuery)->selectRaw("COALESCE(NULLIF(pendidikan, ''), 'Tidak diketahui') as label, COUNT(*) as total")
            ->groupBy('label')
            ->orderByDesc('total')
            ->get();
        $eduTop = $eduRows->take(8);
        $eduOthers = $eduRows->slice(8)->sum('total');
        $eduLabels = $eduTop->pluck('label')->toArray();
        $eduData = $eduTop->pluck('total')->toArray();
        if ($eduOthers > 0) {
            $eduLabels[] = 'Lainnya';
            $eduData[] = $eduOthers;
        }
        $statChartData['education'] = [
            'labels' => $eduLabels,
            'data' => $eduData,
        ];

        $allowedKecamatan = [
            'Harjamukti',
            'Kejaksan',
            'Lemahwungkuk',
            'Pekalipan',
            'Kesambi',
        ];
        $kecamatanRows = (clone $baseQuery)->selectRaw("COALESCE(NULLIF(kecamatan, ''), 'Tidak diketahui') as label, COUNT(*) as total")
            ->groupBy('label')
            ->get();
        $kecamatanMap = array_fill_keys($allowedKecamatan, 0);
        $kecamatanMap['Lainnya'] = 0;
        foreach ($kecamatanRows as $row) {
            $label = (string) $row->label;
            $total = (int) $row->total;
            $normalized = \Illuminate\Support\Str::title($label);
            if (in_array($normalized, $allowedKecamatan, true)) {
                $kecamatanMap[$normalized] += $total;
            } else {
                $kecamatanMap['Lainnya'] += $total;
            }
        }
        $statChartData['kecamatan'] = [
            'labels' => array_keys($kecamatanMap),
            'data' => array_values($kecamatanMap),
        ];
    }

    return view('data-informasi', compact(
        'kbihuData',
        'ppiuData',
        'berhakLunasResults',
        'berhakLunasQuery',
        'berhakLunasSearched',
        'statTotals',
        'statChartData',
        'statYearOptions'
    ));
});
// Route::get('/dokumen/lk-pih', function () {
//     $lkDocuments = collect();
//     $pihDocuments = collect();
//     if (Schema::hasTable('lk_pih_documents')) {
//         $lkDocuments = LkPihDocument::where('type', 'lk')
//             ->where('is_active', true)
//             ->orderBy('order')
//             ->orderByDesc('document_date')
//             ->orderByDesc('created_at')
//             ->get();
//         $pihDocuments = LkPihDocument::where('type', 'pih')
//             ->where('is_active', true)
//             ->orderBy('order')
//             ->orderByDesc('document_date')
//             ->orderByDesc('created_at')
//             ->get();
//     }
//
//     return view('lk-pih', compact('lkDocuments', 'pihDocuments'));
// })->name('lk-pih');
Route::get('/berita', [PostingPublicController::class, 'berita'])->name('berita');
Route::get('/berita-terkini', [PostingPublicController::class, 'terbaru'])->name('berita.terkini');
Route::get('/pengumuman', [PostingPublicController::class, 'pengumuman'])->name('pengumuman');
Route::get('/siaran-pers', [PostingPublicController::class, 'siaranPers'])->name('siaran-pers');
Route::get('/klarifikasi-hoax', [PostingPublicController::class, 'klarifikasiHoax'])->name('klarifikasi-hoax');
Route::get('/posting/{slug}', [PostingPublicController::class, 'show'])->name('posting.show');
Route::get('/kontak', [ProfilController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
Route::get('/galeri/foto', [GalleryController::class, 'foto'])->name('galeri.foto');
Route::get('/galeri/video', [GalleryController::class, 'video'])->name('galeri.video');
Route::get('/galeri/infografis', [GalleryController::class, 'infografis'])->name('galeri.infografis');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== PROTECTED ROUTES (Perlu Session) ====================
Route::middleware(['auth.session'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard - bisa diakses semua role yang sudah login
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Akun - semua role (profil masing-masing)
    Route::get('/akun', [AkunController::class, 'show'])->name('akun.profil');
    Route::post('/akun', [AkunController::class, 'update'])->name('akun.update');
    Route::post('/akun/password', [AkunController::class, 'updatePassword'])->name('akun.password');
    Route::post('/akun/avatar/delete', [AkunController::class, 'destroyAvatar'])->name('akun.avatar.delete');
    
    // Posting - Admin, Editor, Kontributor
    Route::middleware(['role:admin,editor,kontributor'])->prefix('posting')->name('posting.')->group(function () {
        Route::get('/create', [PostingController::class, 'create'])->name('create');
        Route::post('/create', [PostingController::class, 'store'])->name('store');
        Route::post('/upload-editor-image', [PostingController::class, 'uploadEditorImage'])->name('upload-editor-image');
        Route::get('/', [PostingController::class, 'index'])->name('index');
    });

    // Posting - Admin & Editor only
    Route::middleware(['role:admin,editor'])->prefix('posting')->name('posting.')->group(function () {
        Route::get('/{id}/edit', [PostingController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [PostingController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostingController::class, 'destroy'])->name('destroy');
        Route::get('/category', [PostingController::class, 'category'])->name('category');
        Route::post('/category', [PostingController::class, 'categoryStore'])->name('category.store');
        Route::delete('/category/{slug}', [PostingController::class, 'categoryDestroy'])->name('category.destroy');
    });
    
    // Halaman - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('halaman')->name('halaman.')->group(function () {
        Route::post('/create', [HalamanController::class, 'store'])->name('store');
        Route::get('/create', [HalamanController::class, 'create'])->name('create');
        Route::get('/', [HalamanController::class, 'index'])->name('index');
        Route::get('/{slug}/edit', [HalamanController::class, 'edit'])->name('edit');
        Route::post('/{slug}/edit', [HalamanController::class, 'update'])->name('update');
        Route::delete('/{slug}', [HalamanController::class, 'destroy'])->name('destroy');
    });
    
    // Galeri - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('galeri')->name('galeri.')->group(function () {
        Route::get('/kategori', [GaleriController::class, 'kategoriIndex'])->name('kategori');
        Route::post('/kategori', [GaleriController::class, 'kategoriStore'])->name('kategori.store');
        Route::delete('/kategori/{type}/{name}', [GaleriController::class, 'kategoriDestroy'])->name('kategori.destroy');
        // Foto
        Route::prefix('foto')->name('foto.')->group(function () {
            Route::get('/create', [GaleriController::class, 'fotoCreate'])->name('create');
            Route::post('/create', [GaleriController::class, 'fotoStore'])->name('store');
            Route::get('/', [GaleriController::class, 'fotoIndex'])->name('index');
            Route::get('/{id}/edit', [GaleriController::class, 'fotoEdit'])->name('edit');
            Route::post('/{id}/edit', [GaleriController::class, 'fotoUpdate'])->name('update');
            Route::delete('/{id}', [GaleriController::class, 'fotoDestroy'])->name('destroy');
        });
        // Video
        Route::prefix('video')->name('video.')->group(function () {
            Route::get('/create', [GaleriController::class, 'videoCreate'])->name('create');
            Route::post('/create', [GaleriController::class, 'videoStore'])->name('store');
            Route::get('/', [GaleriController::class, 'videoIndex'])->name('index');
            Route::get('/{id}/edit', [GaleriController::class, 'videoEdit'])->name('edit');
            Route::post('/{id}/edit', [GaleriController::class, 'videoUpdate'])->name('update');
            Route::delete('/{id}', [GaleriController::class, 'videoDestroy'])->name('destroy');
        });
        // Infografis
        Route::prefix('infografis')->name('infografis.')->group(function () {
            Route::get('/create', [GaleriController::class, 'infografisCreate'])->name('create');
            Route::post('/create', [GaleriController::class, 'infografisStore'])->name('store');
            Route::get('/', [GaleriController::class, 'infografisIndex'])->name('index');
            Route::get('/{id}/edit', [GaleriController::class, 'infografisEdit'])->name('edit');
            Route::post('/{id}/edit', [GaleriController::class, 'infografisUpdate'])->name('update');
            Route::delete('/{id}', [GaleriController::class, 'infografisDestroy'])->name('destroy');
        });
    });
    
    // Layanan - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/', [LayananController::class, 'index'])->name('index');
        Route::get('/create', [LayananController::class, 'create'])->name('create');
        Route::post('/create', [LayananController::class, 'store'])->name('store');
        Route::get('/{name}/edit', [LayananController::class, 'edit'])->name('edit');
        Route::post('/{name}/edit', [LayananController::class, 'update'])->name('update');
        Route::delete('/{name}', [LayananController::class, 'destroy'])->name('destroy');
    });
    
    // Regulasi - Admin, Editor
    Route::middleware(['role:admin,editor'])->prefix('regulasi')->name('regulasi.')->group(function () {
        Route::get('/', [RegulasiController::class, 'index'])->name('index');
        Route::get('/create', [RegulasiController::class, 'create'])->name('create');
        Route::post('/create', [RegulasiController::class, 'store'])->name('store');
        Route::get('/{judul}/{tanggal}/edit', [RegulasiController::class, 'edit'])->name('edit');
        Route::post('/{judul}/{tanggal}/edit', [RegulasiController::class, 'update'])->name('update');
        Route::delete('/{judul}/{tanggal}', [RegulasiController::class, 'destroy'])->name('destroy');
    });

    // LK & PIH - Admin (disabled)
    // Route::middleware(['role:admin'])->prefix('lk-pih')->name('lk-pih.')->group(function () {
    //     Route::get('/', [LkPihController::class, 'index'])->name('index');
    //     Route::post('/upload', [LkPihController::class, 'store'])->name('store');
    //     Route::delete('/{id}', [LkPihController::class, 'destroy'])->name('destroy');
    // });
    
    // Data Informasi - Admin only
    Route::middleware(['role:admin'])->prefix('data-informasi')->name('data-informasi.')->group(function () {
        // Berhak Lunas
        Route::prefix('berhak-lunas')->name('berhak-lunas.')->group(function () {
            Route::get('/', [DataInformasiController::class, 'berhakLunasIndex'])->name('index');
            Route::get('/create', [DataInformasiController::class, 'berhakLunasCreate'])->name('create');
            Route::post('/create', [DataInformasiController::class, 'berhakLunasStore'])->name('store');
            Route::post('/import', [DataInformasiController::class, 'berhakLunasImport'])->name('import');
            Route::get('/template', [DataInformasiController::class, 'berhakLunasTemplate'])->name('template');
            Route::get('/{nomor_porsi}/edit', [DataInformasiController::class, 'berhakLunasEdit'])->name('edit');
            Route::post('/{nomor_porsi}/edit', [DataInformasiController::class, 'berhakLunasUpdate'])->name('update');
            Route::delete('/{nomor_porsi}', [DataInformasiController::class, 'berhakLunasDestroy'])->name('destroy');
            Route::delete('/', [DataInformasiController::class, 'berhakLunasDestroyAll'])->name('destroy-all');
        });
        // Statistik
        Route::get('/statistik', [DataInformasiController::class, 'statistikIndex'])->name('statistik.index');
        Route::post('/statistik/import', [DataInformasiController::class, 'statistikImport'])->name('statistik.import');
        Route::get('/statistik/template', [DataInformasiController::class, 'statistikTemplate'])->name('statistik.template');
        Route::get('/statistik/export', [DataInformasiController::class, 'statistikExportAll'])->name('statistik.export');
        Route::post('/statistik/delete-year', [DataInformasiController::class, 'statistikDeleteYear'])->name('statistik.delete-year');
        // KBIHU
        Route::prefix('kbihu')->name('kbihu.')->group(function () {
            Route::get('/', [DataInformasiController::class, 'kbihuIndex'])->name('index');
            Route::get('/create', [DataInformasiController::class, 'kbihuCreate'])->name('create');
            Route::post('/create', [DataInformasiController::class, 'kbihuStore'])->name('store');
            Route::post('/import', [DataInformasiController::class, 'kbihuImport'])->name('import');
            Route::get('/template', [DataInformasiController::class, 'kbihuTemplate'])->name('template');
            Route::get('/{nama}/edit', [DataInformasiController::class, 'kbihuEdit'])->name('edit');
            Route::post('/{nama}/edit', [DataInformasiController::class, 'kbihuUpdate'])->name('update');
            Route::delete('/{nama}', [DataInformasiController::class, 'kbihuDestroy'])->name('destroy');
        });
        // PPIU
        Route::prefix('ppiu')->name('ppiu.')->group(function () {
            Route::get('/', [DataInformasiController::class, 'ppiuIndex'])->name('index');
            Route::get('/create', [DataInformasiController::class, 'ppiuCreate'])->name('create');
            Route::post('/create', [DataInformasiController::class, 'ppiuStore'])->name('store');
            Route::post('/import', [DataInformasiController::class, 'ppiuImport'])->name('import');
            Route::get('/template', [DataInformasiController::class, 'ppiuTemplate'])->name('template');
            Route::get('/{no_izin}/edit', [DataInformasiController::class, 'ppiuEdit'])->name('edit');
            Route::post('/{no_izin}/edit', [DataInformasiController::class, 'ppiuUpdate'])->name('update');
            Route::delete('/{no_izin}', [DataInformasiController::class, 'ppiuDestroy'])->name('destroy');
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
        Route::get('/sejarah', [PengaturanController::class, 'profilSejarah'])->name('sejarah');
        Route::post('/sejarah', [PengaturanController::class, 'updateProfil'])->name('sejarah.update');
        Route::get('/visi-misi', [PengaturanController::class, 'profilVisiMisi'])->name('visi-misi');
        Route::post('/visi-misi', [PengaturanController::class, 'updateProfil'])->name('visi-misi.update');
        Route::post('/tim', [PengaturanController::class, 'timStore'])->name('tim.store');
        Route::put('/tim/{nama}/{jabatan}', [PengaturanController::class, 'timUpdate'])->name('tim.update');
        Route::delete('/tim/{nama}/{jabatan}', [PengaturanController::class, 'timDestroy'])->name('tim.destroy');
    });

    // Pengaturan - Admin & Editor
    Route::middleware(['role:admin,editor'])->prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/umum', [PengaturanController::class, 'umum'])->name('umum');
        Route::post('/umum', [PengaturanController::class, 'updateUmum'])->name('umum.update');
        Route::get('/tampilan', [PengaturanController::class, 'tampilan'])->name('tampilan');
        Route::post('/tampilan', [PengaturanController::class, 'updateTampilan'])->name('tampilan.update');
        Route::get('/slideshow', [SlideshowController::class, 'index'])->name('slideshow');
        Route::get('/slideshow/create', [SlideshowController::class, 'create'])->name('slideshow.create');
        Route::post('/slideshow', [SlideshowController::class, 'store'])->name('slideshow.store');
        Route::get('/slideshow/{title}/edit', [SlideshowController::class, 'edit'])->name('slideshow.edit');
        Route::put('/slideshow/{title}', [SlideshowController::class, 'update'])->name('slideshow.update');
        Route::delete('/slideshow/{title}', [SlideshowController::class, 'destroy'])->name('slideshow.destroy');
    });

    // Pengaturan - Admin Only (Pengguna)
    Route::middleware(['role:admin'])->prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('/pengguna/{email}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/pengguna/{email}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{email}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
        // Route::get('/backup', [PengaturanController::class, 'backup'])->name('backup');
        // Route::post('/backup', [PengaturanController::class, 'downloadBackup'])->name('backup.download');
    });
});