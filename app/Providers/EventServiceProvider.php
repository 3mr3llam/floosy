<?php

namespace App\Providers;

use App\Listeners\LogDomainEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        LogDomainEvent::class,
    ];
}


