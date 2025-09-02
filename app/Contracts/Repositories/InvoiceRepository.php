<?php

namespace App\Contracts\Repositories;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Support\CycleWindow;
use App\Support\Money;
use Illuminate\Support\Collection;

/**
 * Repository abstraction for querying and updating invoices with safe locking.
 */
interface InvoiceRepository
{
    public function createPending(int $clientId, int $merchantId, Money $gross, Money $fee, Money $net): Invoice;

    public function sumNetByStatusInWindow(InvoiceStatus $status, CycleWindow $window): float;
    public function idsByStatusInWindow(InvoiceStatus $status, CycleWindow $window): array;

    public function sumNetByStatus(InvoiceStatus $status): float;
    public function idsByStatus(InvoiceStatus $status): array;

    /**
     * Lock the given invoices for update and return them.
     */
    public function lockAndGetByIds(array $ids): Collection;

    /**
     * Bulk update status and extra timestamp fields for the given ids.
     */
    public function bulkUpdateStatus(array $ids, InvoiceStatus $status, array $extra = []): void;

    /**
     * Find an invoice by id that belongs to a merchant or fail.
     */
    public function findForMerchantOrFail(int $merchantId, int $invoiceId): Invoice;
}


