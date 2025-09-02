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

Route::get('/', PortalLanding::class)->name('portal');
Route::get('/client', ClientCreateInvoice::class)->middleware(['auth'])->name('client.portal');
Route::get('/merchant', MerchantInvoicesTable::class)->middleware(['auth'])->name('merchant.portal');

Route::get('/art', function () {
    Artisan::call('optimize');
});




// require __DIR__ . '/auth.php';
