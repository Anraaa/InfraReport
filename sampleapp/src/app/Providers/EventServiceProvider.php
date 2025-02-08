<?php

namespace App\Providers;

use App\Events\PengaduanBaruEvent;
use App\Listeners\KirimNotifikasiAdmin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserLoggedIn;
use App\Listeners\LogUserLogin; // Ensure this class exists in the specified namespace

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PengaduanBaruEvent::class => [
            KirimNotifikasiAdmin::class,
        ],  
        UserLoggedIn::class => [
            LogUserLogin::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}

