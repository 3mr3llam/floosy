<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'site_name' => 'Floosy',
            'fee_percentage' => 2.00,
            'invoices_cumulative_value' => 50.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
