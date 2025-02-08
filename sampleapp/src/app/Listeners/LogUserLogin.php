<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserLoggedIn;
use App\Models\ActivityLog;

class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    /**
     * Handle the event.
     */
    }
    
    public function handle(UserLoggedIn $event)
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'activity_type' => 'login',
            'description' => 'User logged in: ' . $event->user->name,
        ]);
    }
}
