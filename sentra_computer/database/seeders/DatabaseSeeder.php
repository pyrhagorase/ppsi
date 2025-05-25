<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Akun test user biasa
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'), // tambahkan password
            'role' => 'user',
        ]);

        // Akun admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // ganti password sesuai kebutuhan
            'role' => 'admin',
        ]);

        // Akun owner
        User::create([
            'name' => 'Owner',
            'email' => 'ownersentra@gmail.com',
            'password' => Hash::make('owner123'), // ganti password sesuai kebutuhan
            'role' => 'owner',
        ]);
    }
}
