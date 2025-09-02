<?php

namespace App\Services;

use App\Contracts\FeePolicy;
use App\Contracts\Repositories\InvoiceRepository;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\SiteSetting;
use App\Support\CycleWindow;
use App\Support\Money;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use App\Events\{InvoiceCreated, InvoicesOverdue, InvoicesScheduled, InvoicesSuspended};

/**
 * Core batching coordinator:
 * - Creates pending invoices with fee/net
 * - Evaluates a 10-minute window and schedules/suspends as per threshold
 * - Implements carry-over by combining suspended with a new invoice
 */
class BatchAggregatorService
{
    public function __construct(
        private readonly FeePolicy $feePolicy,
        private readonly CycleBucketing $bucketing,
        private readonly InvoiceRepository $invoices,
    ) {
    }

    /**
     * Create a new Pending invoice with calculated fee and net for the current window.
     */
    public function createPendingInvoice(int $clientId, int $merchantId, float $grossSar): Invoice
    {
        $gross = Money::sarFromFloat($grossSar);
        $fee = $this->feePolicy->calculateFee($gross);
        $net = $gross->subtract($fee);

        $window = $this->bucketing->currentWindow();

        $invoice = $this->invoices->createPending($clientId, $merchantId, $gross, $fee, $net);
        InvoiceCreated::dispatch($invoice);
        return $invoice;
    }

    /**
     * Evaluate the given CycleWindow and schedule or suspend all Pending invoices in it
     * based on the configured cumulative threshold.
     */
    public function evaluateWindow(CycleWindow $window): void
    {
        $settings = SiteSetting::first();
        $threshold = (float) ($settings?->invoices_cumulative_value ?? 50.0);

        $total = $this->invoices->sumNetByStatusInWindow(InvoiceStatus::Pending, $window);

        if ($total >= $threshold) {
            $ids = $this->invoices->idsByStatusInWindow(InvoiceStatus::Pending, $window);
            if (! empty($ids)) {
                app(InvoiceStatusTransitionService::class)->markScheduled($ids);
                InvoicesScheduled::dispatch($ids);
            }
        } else {
            DB::transaction(function () use ($window) {
                $ids = $this->invoices->idsByStatusInWindow(InvoiceStatus::Pending, $window);
                if (! empty($ids)) {
                    app(InvoiceStatusTransitionService::class)->markSuspended($ids);
                    InvoicesSuspended::dispatch($ids);
                }
            });
        }
    }

    /**
     * Attempt carry-over: combine all Suspended invoices with a newly created invoice,
     * and if the sum meets the threshold, schedule them all.
     */
    public function attemptCarryOverWithNewInvoice(Invoice $newInvoice): void
    {
        $settings = SiteSetting::first();
        $threshold = (float) ($settings?->invoices_cumulative_value ?? 50.0);

        $suspendedSum = $this->invoices->sumNetByStatus(InvoiceStatus::Suspended);

        $combined = $suspendedSum + (float) $newInvoice->net_amount;

        if ($combined >= $threshold) {
            $ids = $this->invoices->idsByStatus(InvoiceStatus::Suspended);
            $ids[] = $newInvoice->id;
            app(InvoiceStatusTransitionService::class)->markScheduled($ids);
            InvoicesScheduled::dispatch($ids);
        }
    }
}


