<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use App\Models\Galeri;
use App\Models\LkPihDocument;
use App\Models\Posting;
use App\Models\Regulasi;
use App\Models\Layanan;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Dashboard admin
     */
    public function dashboard()
    {
        $user = Session::get('user');

        $now = Carbon::now();
        $monthStart = $now->copy()->subDays(30);
        $recentCutoff = $now->copy()->subDays(7);

        $stats = [
            'total' => 0,
            'active' => 0,
            'publication_rate' => 0,
            'total_views' => 0,
        ];

        $recentItems = collect();

        if (Schema::hasTable('postings')) {
            $postingsTotal = Posting::count();
            $postingsActive = Posting::where('is_active', true)->count();
            $postingsMonthlyTotal = Posting::where('created_at', '>=', $monthStart)->count();
            $postingsMonthlyActive = Posting::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $postingsTotal;
            $stats['active'] += $postingsActive;
            $stats['total_views'] += (int) Posting::sum('views');
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $postingsMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $postingsMonthlyActive;

            $recentItems = $recentItems->concat(
                Posting::with('category')
                    ->orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($post) {
                        return [
                            'type' => 'Berita',
                            'title' => $post->title,
                            'description' => Str::limit(strip_tags((string) $post->content), 140),
                            'date' => $post->created_at,
                            'image' => $post->cover_url ?: null,
                            'url' => route('admin.posting.edit', $post->id),
                        ];
                    })
            );
        }

        if (Schema::hasTable('galeri')) {
            $galleryTotal = Galeri::count();
            $galleryActive = Galeri::where('is_active', true)->count();
            $galleryMonthlyTotal = Galeri::where('created_at', '>=', $monthStart)->count();
            $galleryMonthlyActive = Galeri::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $galleryTotal;
            $stats['active'] += $galleryActive;
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $galleryMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $galleryMonthlyActive;

            $recentItems = $recentItems->concat(
                Galeri::orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($item) {
                        $label = $item->type === 'video'
                            ? 'Galeri Video'
                            : ($item->type === 'infografis' ? 'Galeri Infografis' : 'Galeri Foto');
                        $image = $item->type === 'video'
                            ? ($item->video_thumbnail_url ?: $item->image_url)
                            : $item->image_url;
                        $editRoute = match ($item->type) {
                            'video' => route('admin.galeri.video.edit', $item->id),
                            'infografis' => route('admin.galeri.infografis.edit', $item->id),
                            default => route('admin.galeri.foto.edit', $item->id),
                        };

                        return [
                            'type' => $label,
                            'title' => $item->title,
                            'description' => Str::limit((string) $item->description, 140),
                            'date' => $item->created_at,
                            'image' => $image ?: null,
                            'url' => $editRoute,
                        ];
                    })
            );
        }

        if (Schema::hasTable('lk_pih_documents')) {
            $lkTotal = LkPihDocument::count();
            $lkActive = LkPihDocument::where('is_active', true)->count();
            $lkMonthlyTotal = LkPihDocument::where('created_at', '>=', $monthStart)->count();
            $lkMonthlyActive = LkPihDocument::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $lkTotal;
            $stats['active'] += $lkActive;
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $lkMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $lkMonthlyActive;

            $recentItems = $recentItems->concat(
                LkPihDocument::orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($doc) {
                        return [
                            'type' => 'LK & PIH',
                            'title' => $doc->title,
                            'description' => Str::limit((string) $doc->description, 140),
                            'date' => $doc->created_at,
                            'image' => null,
                            'url' => route('admin.lk-pih.index'),
                        ];
                    })
            );
        }

        if (Schema::hasTable('regulasi')) {
            $regTotal = Regulasi::count();
            $regActive = Regulasi::where('is_active', true)->count();
            $regMonthlyTotal = Regulasi::where('created_at', '>=', $monthStart)->count();
            $regMonthlyActive = Regulasi::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $regTotal;
            $stats['active'] += $regActive;
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $regMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $regMonthlyActive;

            $recentItems = $recentItems->concat(
                Regulasi::orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($regulation) {
                        return [
                            'type' => 'Regulasi',
                            'title' => $regulation->title,
                            'description' => Str::limit((string) $regulation->description, 140),
                            'date' => $regulation->created_at,
                            'image' => null,
                            'url' => route('admin.regulasi.edit', $regulation->routeParams()),
                        ];
                    })
            );
        }

        if (Schema::hasTable('layanan')) {
            $servicesTotal = Layanan::count();
            $servicesActive = Layanan::where('is_active', true)->count();
            $servicesMonthlyTotal = Layanan::where('created_at', '>=', $monthStart)->count();
            $servicesMonthlyActive = Layanan::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $servicesTotal;
            $stats['active'] += $servicesActive;
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $servicesMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $servicesMonthlyActive;

            $recentItems = $recentItems->concat(
                Layanan::orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($service) {
                        return [
                            'type' => 'Layanan',
                            'title' => $service->name,
                            'description' => Str::limit((string) $service->description, 140),
                            'date' => $service->created_at,
                            'image' => $service->icon_url ?: null,
                            'url' => route('admin.layanan.edit', $service->name),
                        ];
                    })
            );
        }

        if (Schema::hasTable('custom_pages')) {
            $pagesTotal = CustomPage::count();
            $pagesActive = CustomPage::where('is_active', true)->count();
            $pagesMonthlyTotal = CustomPage::where('created_at', '>=', $monthStart)->count();
            $pagesMonthlyActive = CustomPage::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $pagesTotal;
            $stats['active'] += $pagesActive;
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $pagesMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $pagesMonthlyActive;

            $recentItems = $recentItems->concat(
                CustomPage::orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($page) {
                        return [
                            'type' => 'Halaman',
                            'title' => $page->title,
                            'description' => Str::limit((string) $page->description, 140),
                            'date' => $page->created_at,
                            'image' => $page->cover_url ?: null,
                            'url' => route('admin.halaman.edit', $page->slug),
                        ];
                    })
            );
        }

        if (Schema::hasTable('slideshows')) {
            $slidesTotal = Slideshow::count();
            $slidesActive = Slideshow::where('is_active', true)->count();
            $slidesMonthlyTotal = Slideshow::where('created_at', '>=', $monthStart)->count();
            $slidesMonthlyActive = Slideshow::where('is_active', true)
                ->where('created_at', '>=', $monthStart)
                ->count();
            $stats['total'] += $slidesTotal;
            $stats['active'] += $slidesActive;
            $stats['monthly_total'] = ($stats['monthly_total'] ?? 0) + $slidesMonthlyTotal;
            $stats['monthly_active'] = ($stats['monthly_active'] ?? 0) + $slidesMonthlyActive;

            $recentItems = $recentItems->concat(
                Slideshow::orderByDesc('created_at')
                    ->take(5)
                    ->get()
                    ->map(function ($slide) {
                        return [
                            'type' => 'Slideshow',
                            'title' => $slide->title,
                            'description' => Str::limit((string) $slide->description, 140),
                            'date' => $slide->created_at,
                            'image' => $slide->image_url ?: null,
                            'url' => route('admin.pengaturan.slideshow.edit', $slide->title),
                        ];
                    })
            );
        }

        $monthlyTotal = $stats['monthly_total'] ?? 0;
        if ($monthlyTotal > 0) {
            $stats['publication_rate'] = (int) round((($stats['monthly_active'] ?? 0) / $monthlyTotal) * 100);
        }

        $recentItems = $recentItems
            ->filter(fn ($item) => !empty($item['date']) && Carbon::parse($item['date'])->greaterThanOrEqualTo($recentCutoff))
            ->sortByDesc('date')
            ->take(6)
            ->values();

        $canEditDashboardItems = in_array($user['role'] ?? 'kontributor', ['admin', 'editor'], true);

        return view('admin.dashboard', compact('user', 'stats', 'recentItems', 'canEditDashboardItems'));
    }
}
