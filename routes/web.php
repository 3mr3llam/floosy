<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleLoginController;

Route::get('/', function () {
    // dd( storage_path('app/public'), env('APP_URL').'/storage');
    return view('welcome');
});

Route::get('/art', function () {
    Artisan::call('optimize');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * socialite
 */

Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('web.google.auth');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('web.google.callback');

require __DIR__ . '/auth.php';
