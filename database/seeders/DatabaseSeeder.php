<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Admin::truncate();
        User::truncate();
        Country::truncate();
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            CategorySeeder::class,
            AdminUserSeeder::class,
            userSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
        ]);
    }
}
