<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Services\InvoiceStatusTransitionService;
use Illuminate\Console\Scheduling\Schedule;
use App\Services\BatchAggregatorService;
use App\Services\CycleBucketing;
use App\Support\CycleWindow;
use Carbon\CarbonImmutable;
use App\Models\Invoice;
use App\Enums\InvoiceStatus;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserRole::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        // Evaluate the window that just ended every minute
        $schedule->call(function (BatchAggregatorService $aggregator, CycleBucketing $bucketing) {
            $now = now()->second(0);
            $current = CycleWindow::forTime(arbonImmutable::instance($now));
            $previous = new CycleWindow($current->start->subMinutes(10), $current->start);
            $aggregator->evaluateWindow($previous);
        })->everyMinute();

        // Move Scheduled invoices to Overdue after one cycle (10 minutes)
        $schedule->call(function (InvoiceStatusTransitionService $transition) {
            $tenMinutesAgo = now()->subMinutes(10);
            $ids = Invoice::query()
                ->where('status', InvoiceStatus::Scheduled)
                ->where('scheduled_at', '<=', $tenMinutesAgo)
                ->pluck('id')
                ->all();
            if (! empty($ids)) {
                $transition->markOverdue($ids);
            }
        })->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
