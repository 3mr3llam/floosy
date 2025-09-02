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
        $merchants = User::factory()->count(3)->create();
        foreach ($merchants as $merchant) {
            $merchant->assignRole('merchant');
        }

        // Create clients
        $clients = User::factory()->count(10)->create();
        foreach ($clients as $client) {
            $client->assignRole('client');
        }
    }
}
