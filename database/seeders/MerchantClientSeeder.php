<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MerchantClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist via UserRoleSeeder
        // Create merchants
        $merchants = User::factory()->merchant()->count(5)->create();
        foreach ($merchants as $merchant) {
            $merchant->forceFill(['role' => 'merchant'])->save();
            $merchant->assignRole('merchant');
        }

        // Create clients and link each to 1-3 merchants
        $clients = User::factory()->client()->count(15)->create();
        foreach ($clients as $client) {
            $client->forceFill(['role' => 'client'])->save();
            $client->assignRole('client');
        }
        foreach ($clients as $client) {
            $attach = $merchants->random(rand(1, min(3, $merchants->count())))->pluck('id');
            $client->merchants()->syncWithoutDetaching($attach);
        }
    }
}
