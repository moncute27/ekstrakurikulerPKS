<?php

namespace App\Providers;

use App\Models\Profil;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Profil dipakai hampir di semua halaman, jadi cukup diambil sekali per request.
        $this->app->singleton(Profil::class, function () {
            try {
                if (! Schema::hasTable('profils')) {
                    return new Profil();
                }

                return Profil::get();
            } catch (\Throwable $e) {
                return new Profil();
            }
        });
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        // Tampilan pagination kustom (bahasa Indonesia, tanpa Tailwind).
        Paginator::defaultView('vendor.pagination.pks');
        Paginator::defaultSimpleView('vendor.pagination.pks');

        // $profil tersedia di semua view (layout maupun halaman turunannya).
        View::composer('*', function ($view) {
            $view->with('profil', app(Profil::class));
        });
    }
}
