<?php

namespace App\Filament\Masyarakat;

use Filament\FilamentServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MasyarakatServiceProvider extends FilamentServiceProvider

{
    public function register()
    {
        parent::register();

        // Menyesuaikan route untuk panel masyarakat
        Route::get('/masyarakat', function () {
            return redirect()->route('filament.masyarakat.pages.dashboard');
        });

    }

    public function boot()
    {
        parent::boot();
    }
}
