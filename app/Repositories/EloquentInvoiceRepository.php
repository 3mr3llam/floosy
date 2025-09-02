<?php

namespace App\Repositories;

use App\Contracts\Repositories\InvoiceRepository;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Support\CycleWindow;
use App\Support\Money;
use Illuminate\Support\Collection;

class EloquentInvoiceRepository implements InvoiceRepository
{
    public function createPending(int $clientId, int $merchantId, Money $gross, Money $fee, Money $net): Invoice
    {
        return Invoice::create([
            'merchant_id' => $merchantId,
            'client_id' => $clientId,
            'reference' => strtoupper(bin2hex(random_bytes(5))),
            'gross_amount' => $gross->toFloat(),
            'fee_amount' => $fee->toFloat(),
            'net_amount' => $net->toFloat(),
            'status' => InvoiceStatus::Pending,
            'entered_at' => now(),
        ]);
    }

    public function sumNetByStatusInWindow(InvoiceStatus $status, CycleWindow $window): float
    {
        return (float) Invoice::query()
            ->where('status', $status)
            ->whereBetween('entered_at', [$window->start, $window->end])
            ->sum('net_amount');
    }

    public function idsByStatusInWindow(InvoiceStatus $status, CycleWindow $window): array
    {
        return Invoice::query()
            ->where('status', $status)
            ->whereBetween('entered_at', [$window->start, $window->end])
            ->pluck('id')
            ->all();
    }

    public function sumNetByStatus(InvoiceStatus $status): float
    {
        return (float) Invoice::query()->where('status', $status)->sum('net_amount');
    }

    public function idsByStatus(InvoiceStatus $status): array
    {
        return Invoice::query()->where('status', $status)->pluck('id')->all();
    }

    public function lockAndGetByIds(array $ids): Collection
    {
        return Invoice::whereIn('id', $ids)->lockForUpdate()->get();
    }

    public function bulkUpdateStatus(array $ids, InvoiceStatus $status, array $extra = []): void
    {
        if (empty($ids)) return;
        Invoice::whereIn('id', $ids)->update(array_merge(['status' => $status], $extra));
    }

    public function findForMerchantOrFail(int $merchantId, int $invoiceId): Invoice
    {
        return Invoice::where('merchant_id', $merchantId)->findOrFail($invoiceId);
    }
}


