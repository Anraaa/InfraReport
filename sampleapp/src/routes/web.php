<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Masyarakat\Pages\Dashboard;

Route::middleware(['auth'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', Dashboard::class);
});

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/about-me', function () {
    return view('about-me');
})->name('about-me');

Route::get('/company', function () {
    return view('company');
})->name('company');
Route::get('storage/{file}', function ($file) {
    // Akses file dengan middleware auth
})->middleware('auth');

Route::get('/debug-session', function () {
    session()->put('test', 'Session Works!');
    return response()->json([
        'csrf_token' => csrf_token(),
        'session_test' => session()->get('test'),
        'cookies' => request()->cookies->all()
    ]);
});



//Route::get('/sse/komentar', [SSEController::class, 'streamKomentar']);


Route::get('/', function () {
    return view('welcome');
});
