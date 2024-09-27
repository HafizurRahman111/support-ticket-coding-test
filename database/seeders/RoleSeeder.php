<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'is_active' => 1,
        ]);

        // customer
          Role::create([
            'name' => 'Customer',
            'slug' => 'customer',
            'is_active' => 1,
        ]);

    }
}
