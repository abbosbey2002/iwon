<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'solowifi',
            'email' => 'abbosbeyqudratov@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('woloiwonpassword'),  // Hash the password for security
        ]);
    }
}
