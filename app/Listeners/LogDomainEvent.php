<?php

namespace App\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class LogDomainEvent
{
    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(\App\Events\InvoiceCreated::class, [$this, 'onInvoiceCreated']);
        $events->listen(\App\Events\InvoicesScheduled::class, [$this, 'onInvoicesScheduled']);
        $events->listen(\App\Events\InvoicesSuspended::class, [$this, 'onInvoicesSuspended']);
        $events->listen(\App\Events\InvoicesOverdue::class, [$this, 'onInvoicesOverdue']);
    }

    public function onInvoiceCreated($event): void
    {
        Log::info('InvoiceCreated', ['invoice_id' => $event->invoice->id]);
    }

    public function onInvoicesScheduled($event): void
    {
        Log::info('InvoicesScheduled', ['ids' => $event->invoiceIds]);
    }

    public function onInvoicesSuspended($event): void
    {
        Log::warning('InvoicesSuspended', ['ids' => $event->invoiceIds]);
    }

    public function onInvoicesOverdue($event): void
    {
        Log::warning('InvoicesOverdue', ['ids' => $event->invoiceIds]);
    }
}


