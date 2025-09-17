<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\PengaduanResource;
use Filament\Facades\Filament;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\URL;
use App\Filament\Responses\CustomLoginResponse;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Pastikan tidak ada binding yang salah
    $this->app->bind(
        \Illuminate\Contracts\Queue\Factory::class,
        \Illuminate\Queue\QueueManager::class
    );

    $this->app->bind(
        \Illuminate\Contracts\Queue\Monitor::class,
        \Illuminate\Queue\QueueManager::class
    );

    if (isset($_ENV['VERCEL'])) {
        $this->app->useStoragePath($_ENV['VERCEL_TMP_DIR'] . '/storage');
    }

    if (env('VERCEL_ENV')) {
        // Arahkan path storage utama ke direktori /tmp
        $this->app->useStoragePath(env('VERCEL_TMP_DIR') . '/storage');

        // Arahkan path bootstrap/cache ke direktori /tmp
        $this->app->useBootstrapPath(env('VERCEL_TMP_DIR') . '/bootstrap/cache');
    }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::registerResources([
            PengaduanResource::class,
            // Other resources...
        ]);

       
        //$this->app->bind(LoginResponse::class, CustomLoginResponse::class);

        URL::forceRootUrl(config('app.url'));

        User::observe(UserObserver::class);



    }
}
