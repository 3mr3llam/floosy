<?php

namespace App\Services;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * Encapsulates invoice state transitions and stamps lifecycle timestamps,
 * validating legal moves according to the domain rules.
 */
class InvoiceStatusTransitionService
{
    /**
     * Promote Pending/Suspended invoices to Scheduled and set scheduled_at.
     */
    public function markScheduled(array $invoiceIds): void
    {
        DB::transaction(function () use ($invoiceIds) {
            $invoices = Invoice::whereIn('id', $invoiceIds)->lockForUpdate()->get();
            foreach ($invoices as $invoice) {
                if (! in_array($invoice->status, [InvoiceStatus::Pending, InvoiceStatus::Suspended], true)) {
                    throw new InvalidArgumentException('Invalid transition to scheduled.');
                }
                $invoice->update([
                    'status' => InvoiceStatus::Scheduled,
                    'scheduled_at' => now(),
                ]);
            }
        });
    }

    /**
     * Move Pending invoices to Suspended.
     */
    public function markSuspended(array $invoiceIds): void
    {
        DB::transaction(function () use ($invoiceIds) {
            $invoices = Invoice::whereIn('id', $invoiceIds)->lockForUpdate()->get();
            foreach ($invoices as $invoice) {
                if ($invoice->status !== InvoiceStatus::Pending) {
                    throw new InvalidArgumentException('Invalid transition to suspended.');
                }
                $invoice->update([
                    'status' => InvoiceStatus::Suspended,
                ]);
            }
        });
    }

    /**
     * Move Scheduled invoices to Overdue and set overdue_at.
     */
    public function markOverdue(array $invoiceIds): void
    {
        DB::transaction(function () use ($invoiceIds) {
            $invoices = Invoice::whereIn('id', $invoiceIds)->lockForUpdate()->get();
            foreach ($invoices as $invoice) {
                if ($invoice->status !== InvoiceStatus::Scheduled) {
                    throw new InvalidArgumentException('Invalid transition to overdue.');
                }
                $invoice->update([
                    'status' => InvoiceStatus::Overdue,
                    'overdue_at' => now(),
                ]);
            }
        });
    }

    /**
     * Mark an Overdue invoice as Paid and set paid_at.
     */
    public function markPaid(Invoice $invoice): void
    {
        if ($invoice->status !== InvoiceStatus::Overdue) {
            throw new InvalidArgumentException('Only overdue invoices can be marked paid.');
        }
        $invoice->update([
            'status' => InvoiceStatus::Paid,
            'paid_at' => now(),
        ]);
    }

    /**
     * Mark an Overdue invoice as Not Received and set not_received_at.
     */
    public function markNotReceived(Invoice $invoice): void
    {
        if ($invoice->status !== InvoiceStatus::Overdue) {
            throw new InvalidArgumentException('Only overdue invoices can be marked not received.');
        }
        $invoice->update([
            'status' => InvoiceStatus::NotReceived,
            'not_received_at' => now(),
        ]);
    }
}
