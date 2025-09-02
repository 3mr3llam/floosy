<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => 'client',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => 'merchant',
            'guard_name' => 'web',
        ]);
    }
}
