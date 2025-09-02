<?php

namespace App\Livewire\Merchant;

use App\Models\Invoice;
use App\Services\InvoiceStatusTransitionService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InvoicesTable extends Component
{
    use WithPagination;

    public string $statusFilter = '';

    public function updateStatus(int $invoiceId, string $status, InvoiceStatusTransitionService $transition): void
    {
        $merchantId = Auth::id();
        $invoice = Invoice::where('merchant_id', $merchantId)->findOrFail($invoiceId);
        if ($status === 'paid') {
            $transition->markPaid($invoice);
        } elseif ($status === 'not_received') {
            $transition->markNotReceived($invoice);
        }
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
        $invoices = $query->paginate(3)->withQueryString();
        return view('livewire.merchant.invoices-table', compact('invoices'));
    }
}
