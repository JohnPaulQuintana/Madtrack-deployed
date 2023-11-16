<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'administrator@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Change this to the desired password
            'remember_token' => Str::random(10),
            'role' => 'admin', // Assign the admin role
        ]);
    }
}
