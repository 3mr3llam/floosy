<?php

namespace App\Livewire\Merchant;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InvoicesTable extends Component
{
    use WithPagination;

    public string $statusFilter = '';

    public function updateStatus(int $invoiceId, string $status): void
    {
        $merchantId = Auth::id();
        $invoice = Invoice::where('merchant_id', $merchantId)->findOrFail($invoiceId);

        $allowed = ['paid', 'not_received'];
        if (! in_array($status, $allowed, true)) return;

        $updates = ['status' => $status];
        if ($status === 'paid') $updates['paid_at'] = now();
        if ($status === 'not_received') $updates['not_received_at'] = now();

        $invoice->update($updates);
        session()->flash('success', 'Invoice updated.');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $merchantId = Auth::id();
        $query = Invoice::where('merchant_id', $merchantId)->latest();
        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }
        $invoices = $query->paginate(10);
        return view('livewire.merchant.invoices-table', compact('invoices'));
    }
}
