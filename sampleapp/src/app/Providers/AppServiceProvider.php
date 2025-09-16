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
