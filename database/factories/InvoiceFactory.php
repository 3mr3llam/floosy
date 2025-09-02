<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        $gross = $this->faker->randomFloat(2, 5, 500);
        $fee = round($gross * 0.02, 2);
        $net = $gross - $fee;

        return [
            'merchant_id' => User::factory(),
            'client_id' => null,
            'cycle_id' => null,
            'reference' => Str::upper(Str::random(10)),
            'gross_amount' => $gross,
            'fee_amount' => $fee,
            'net_amount' => $net,
            'status' => 'pending',
            'entered_at' => now(),
        ];
    }
}
