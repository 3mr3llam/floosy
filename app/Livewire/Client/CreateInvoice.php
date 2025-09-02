<?php

namespace App\Livewire\Client;

use App\Models\Invoice;
use App\Models\User;
use App\Services\BatchAggregatorService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateInvoice extends Component
{
    #[Validate('required|exists:users,id')]
    public $merchant_id = '';

    #[Validate('required|numeric|min:1')]
    public $amount = '';

    public function create(BatchAggregatorService $aggregator)
    {
        $this->validate();
        $client = Auth::user();

        $invoice = $aggregator->createPendingInvoice($client->id, (int) $this->merchant_id, (float) $this->amount);
        $aggregator->attemptCarryOverWithNewInvoice($invoice);

        session()->flash('success', 'Invoice created.');
        $this->reset(['merchant_id', 'amount']);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $client = Auth::user();
        // Show only merchants related to this client via pivot
        $merchants = $client->merchants()->select('users.id', 'users.name')->get();
        return view('livewire.client.create-invoice', compact('merchants'));
    }
}
