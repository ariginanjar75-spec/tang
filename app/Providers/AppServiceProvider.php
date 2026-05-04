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

        // Konfigurasi khusus Vercel untuk sistem file read-only
        if (env('VERCEL')) {
            // Alihkan view cache ke /tmp
            config(['view.compiled' => '/tmp/storage/framework/views']);
            
            // Gunakan cookie untuk session dan array untuk cache agar tidak menulis ke file
            config(['session.driver' => 'cookie']);
            config(['cache.default' => 'array']);
            
            // Buat folder jika belum ada
            if (!is_dir('/tmp/storage/framework/views')) {
                mkdir('/tmp/storage/framework/views', 0755, true);
            }
        }
    }
}
