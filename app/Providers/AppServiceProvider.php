<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Profil;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $profilGlobal = null;
        if (Schema::hasTable('profil')) {
            $profilGlobal = Profil::first();
        }

        View::share('profilGlobal', $profilGlobal);

        View::share('siteSetting', SiteSetting::current());
    }
}
