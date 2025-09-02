<?php

namespace App\Providers;

use App\Policies\ActivityPolicy;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\RateLimited;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;

use Illuminate\Support\{Facades\App, Facades\DB, Facades\Gate, Facades\RateLimiter, Facades\Route, ServiceProvider};
use App\Contracts\FeePolicy;
use App\Services\DefaultFeePolicy;
use App\Contracts\Repositories\InvoiceRepository;
use App\Repositories\EloquentInvoiceRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FeePolicy::class, DefaultFeePolicy::class);
        $this->app->bind(InvoiceRepository::class, EloquentInvoiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // add all the needed policies here
        Gate::policy(Activity::class, ActivityPolicy::class,);

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // also accepts a closure
        });

        // this will fix livewire issue with xampp
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post(env('LIVEWIRE_UPDATE_PATH'), $handle)->name('custom-livewire.update');
        });


        Livewire::setScriptRoute(function ($handle) {
            return Route::get(env('LIVEWIRE_JAVASCRIPT_PATH'), $handle);
        });
    }
}
