<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Sesuaikan public_path bila aplikasi dideploy dengan public_html terpisah di luar folder aplikasi
        if (!file_exists(base_path('public/index.php')) && is_dir(base_path('../public_html'))) {
            $this->app->usePublicPath(realpath(base_path('../public_html')));
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
