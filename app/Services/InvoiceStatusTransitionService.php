<?php

namespace App\Services;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

/**
 * Encapsulates invoice state transitions and stamps lifecycle timestamps,
 * validating legal moves according to the domain rules.
 */
class InvoiceStatusTransitionService
{
    /**
     * Promote Pending/Suspended invoices to Scheduled and set scheduled_at.
     */
    public function markScheduled(array $invoiceIds): array
    {
        $errors = [];
        DB::transaction(function () use ($invoiceIds, &$errors) {
            $invoices = Invoice::whereIn('id', $invoiceIds)->lockForUpdate()->get();
            foreach ($invoices as $invoice) {
                if (! in_array($invoice->status, [InvoiceStatus::Pending, InvoiceStatus::Suspended], true)) {
                    $errors[$invoice->id] = 'Invalid transition to scheduled.';
                    continue;
                }
                $invoice->update([
                    'status' => InvoiceStatus::Scheduled,
                    'scheduled_at' => now(),
                ]);
            }
        });
        return $errors;
    }

    /**
     * Move Pending invoices to Suspended.
     */
    public function markSuspended(array $invoiceIds): array
    {
        $errors = [];
        DB::transaction(function () use ($invoiceIds, &$errors) {
            $invoices = Invoice::whereIn('id', $invoiceIds)->lockForUpdate()->get();
            foreach ($invoices as $invoice) {
                if ($invoice->status !== InvoiceStatus::Pending) {
                    $errors[$invoice->id] = 'Invalid transition to suspended.';
                    continue;
                }
                $invoice->update([
                    'status' => InvoiceStatus::Suspended,
                ]);
            }
        });
        return $errors;
    }

    /**
     * Move Scheduled invoices to Overdue and set overdue_at.
     */
    public function markOverdue(array $invoiceIds): array
    {
        $errors = [];
        DB::transaction(function () use ($invoiceIds, &$errors) {
            $invoices = Invoice::whereIn('id', $invoiceIds)->lockForUpdate()->get();
            foreach ($invoices as $invoice) {
                if ($invoice->status !== InvoiceStatus::Scheduled) {
                    $errors[$invoice->id] = 'Invalid transition to overdue.';
                    continue;
                }
                $invoice->update([
                    'status' => InvoiceStatus::Overdue,
                    'overdue_at' => now(),
                ]);
            }
        });
        return $errors;
    }

    /**
     * Mark an Overdue invoice as Paid and set paid_at.
     */
    /**
     * Mark an Overdue invoice as Paid, update timestamps, and process payment withdrawal.
     * 
     * Note: This is where we would typically integrate with a payment gateway to
     * transfer the funds to the merchant's account. The actual implementation
     * would depend on the payment provider's API.
     * 
     * Example:
     * $paymentGateway->transfer($invoice->merchant->payment_account_id, $invoice->net_amount);
     */
    public function markPaid(Invoice $invoice): ?string
    {
        if ($invoice->status !== InvoiceStatus::Overdue) {
            return 'Only overdue invoices can be marked paid.';
        }
        
        $invoice->update([
            'status' => InvoiceStatus::Paid,
            'paid_at' => now(),
            'withdrawn_at' => now(), // Record when the money was withdrawn to the merchant
        ]);
        
        // TODO: Implement actual payment gateway integration here
        // Example:
        // try {
        //     $paymentGateway = app(PaymentGateway::class);
        //     $paymentGateway->transfer(
        //         $invoice->merchant->payment_account_id,
        //         $invoice->net_amount,
        //         'Payment for invoice ' . $invoice->reference
        //     );
        // } catch (PaymentGatewayException $e) {
        //     Log::error('Payment gateway error: ' . $e->getMessage());
        //     return 'Payment processing failed. Please try again later.';
        // }
        
        return null;
    }

    /**
     * Mark an Overdue invoice as Not Received and set not_received_at.
     */
    public function markNotReceived(Invoice $invoice): ?string
    {
        if ($invoice->status !== InvoiceStatus::Overdue) {
            return 'Only overdue invoices can be marked not received.';
        }
        $invoice->update([
            'status' => InvoiceStatus::NotReceived,
            'not_received_at' => now(),
        ]);
        return null;
    }
}
