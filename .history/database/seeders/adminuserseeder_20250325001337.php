<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin email from .env file
        $adminEmail = env('APP_EMAIL', 'admin@example.com');
        
        // Check if admin user already exists
        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make('Azerty%1234'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }
    }
}
