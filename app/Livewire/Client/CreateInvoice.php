<?php

namespace App\Livewire\Client;

use App\Models\Invoice;
use App\Models\User;
use App\Services\CycleBucketing;
use App\Contracts\FeePolicy;
use App\Support\Money;
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

    public function create(FeePolicy $feePolicy, CycleBucketing $bucketing)
    {
        $this->validate();
        $client = Auth::user();

        $gross = Money::sarFromFloat((float) $this->amount);
        $fee = $feePolicy->calculateFee($gross);
        $net = $gross->subtract($fee);

        $window = $bucketing->currentWindow();

        Invoice::create([
            'merchant_id' => $this->merchant_id,
            'client_id' => $client->id,
            'reference' => strtoupper(bin2hex(random_bytes(5))),
            'gross_amount' => $gross->toFloat(),
            'fee_amount' => $fee->toFloat(),
            'net_amount' => $net->toFloat(),
            'status' => 'pending',
            'entered_at' => now(),
        ]);

        session()->flash('success', 'Invoice created.');
        $this->reset(['merchant_id', 'amount']);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $client = Auth::user();
        // For now, show all merchants; replace with relation filter later
        $merchants = User::role('merchant')->select('id', 'name')->get();
        return view('livewire.client.create-invoice', compact('merchants'));
    }
}
