<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleLoginController;

use App\Livewire\PortalLanding;
use App\Livewire\Client\CreateInvoice as ClientCreateInvoice;
use App\Livewire\Merchant\InvoicesTable as MerchantInvoicesTable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


Route::get('/', PortalLanding::class)->name('portal');
Route::get('/client', ClientCreateInvoice::class)->middleware(['auth', 'role:client'])->name('client.portal');
Route::get('/merchant', MerchantInvoicesTable::class)->middleware(['auth', 'role:merchant'])->name('merchant.portal');

// Ensure auth middleware can redirect to a login route
Route::get('/login', function () {
    return redirect()->route('portal');
})->name('login');

// Simple GET logout for portal dropdown convenience
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('portal');
})->middleware('auth')->name('logout.get');

Route::get('/art', function () {
    Artisan::call('optimize');
});




// require __DIR__ . '/auth.php';
