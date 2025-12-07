<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create the super_admin role
        $superAdminRole = Role::firstOrCreate(
            ['name' => config('filament-shield.super_admin.name', 'super_admin')],
            ['guard_name' => 'web']
        );

        // Create or update the super admin user
        $user = User::updateOrCreate(
            ['email' => env('SUPER_ADMIN_EMAIL', 'admin@example.com')],
            [
                'name' => env('SUPER_ADMIN_NAME', 'Super Admin'),
                'password' => Hash::make(env('SUPER_ADMIN_PASSWORD', 'Meherehussain@Gaus2025!!XX')),
                'email_verified_at' => now(),
            ]
        );

        // Assign the super_admin role if not already assigned
        if (!$user->hasRole($superAdminRole)) {
            $user->assignRole($superAdminRole);
        }

        $this->command->info('Super Admin user created/updated successfully!');
        $this->command->info('Email: ' . $user->email);
        $this->command->info('Name: ' . $user->name);
    }
}

