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
        // Sesuaikan public_path bila aplikasi dideploy di cPanel dengan public_html
        $cpanelPublicHtml = realpath(base_path('../../public_html')) ?: realpath(base_path('../public_html'));
        if ($cpanelPublicHtml && is_dir($cpanelPublicHtml) && !file_exists(base_path('public/hot'))) {
            $this->app->usePublicPath($cpanelPublicHtml);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production') || env('APP_ENV') === 'production' || str_starts_with(env('APP_URL', ''), 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
