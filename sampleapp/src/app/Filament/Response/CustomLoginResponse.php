<?php

namespace App\Filament\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as Responsable;
use Illuminate\Http\RedirectResponse;
use App\Events\UserLoggedIn;

class CustomLoginResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        // Dispatch event setelah login berhasil
        event(new UserLoggedIn(\Illuminate\Support\Facades\Auth::user()));

        // Redirect ke halaman yang diinginkan
        return redirect()->intended(config('filament.home_url'));
    }
}