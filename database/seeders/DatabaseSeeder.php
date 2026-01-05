<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create the Admin User
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'logicallydebate@gmail.com',
            'password' => Hash::make('logicallydebate'),
            'role' => 'admin', // assuming you might need roles later
        ]);
    }
}