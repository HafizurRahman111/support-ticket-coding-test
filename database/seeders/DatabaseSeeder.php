<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'phone' => '1234567890',
            'role_id' => 1,
            'password' => Hash::make('a12345'),
            'is_active' => 1,
        ]);

        // customer - 1
        User::create([
            'name' => 'Test Customer-1',
            'email' => 'customer1@test.com',
            'phone' => '9876543211',
            'role_id' => 2,
            'password' => Hash::make('c12345'),
            'is_active' => 1,
        ]);

        // customer - 2
        User::create([
            'name' => 'Test Customer-2',
            'email' => 'customer2@test.com',
            'phone' => '5678901234',
            'role_id' => 2,
            'password' => Hash::make('c54321'),
            'is_active' => 1,
        ]);

        $this->call([
            RoleSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
