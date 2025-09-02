<?php

namespace Database\Seeders;

use App\Models\Cycle;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;

class CycleInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch any merchants/clients created earlier
        $merchants = User::role('merchant')->get();
        $clients = User::role('client')->get();

        if ($merchants->isEmpty()) {
            $merchants = User::factory()->count(2)->create();
            foreach ($merchants as $m) $m->assignRole('merchant');
        }
        if ($clients->isEmpty()) {
            $clients = User::factory()->count(5)->create();
            foreach ($clients as $c) $c->assignRole('client');
        }

        // Create cycles
        $cycles = Cycle::factory()->count(3)->create();

        // Create invoices and randomly attach to cycles
        foreach ($cycles as $cycle) {
            foreach (range(1, 8) as $i) {
                $merchant = $merchants->random();
                $client = $clients->random();
                $invoice = Invoice::factory()
                    ->create([
                        'merchant_id' => $merchant->id,
                        'client_id' => $client->id,
                        'cycle_id' => $cycle->id,
                        'entered_at' => $cycle->window_start->copy()->addMinutes(rand(0, 9)),
                    ]);
            }
        }
    }
}
