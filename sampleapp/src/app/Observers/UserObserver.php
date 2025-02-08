<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        ActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'user_created',
            'description' => 'User created: ' . $user->name,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        ActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'user_updated',
            'description' => 'User updated: ' . $user->name,
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        ActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'user_deleted',
            'description' => 'User deleted: ' . $user->name,
        ]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
