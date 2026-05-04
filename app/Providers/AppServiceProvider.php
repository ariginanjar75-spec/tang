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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Memastikan path public mengarah ke lokasi yang benar di Vercel
        $this->app->bind('path.public', function() {
            return base_path('public');
        });
    }
}
