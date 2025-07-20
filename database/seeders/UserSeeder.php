<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles (only roles, no permissions for now)
        $roles = ['admin', 'support', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@citwam.org'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Remove all existing roles and assign only admin role
        $admin->syncRoles(['admin']);

        // Create Support User
        $support = User::firstOrCreate(
            ['email' => 'pastor@citwam.org'],
            [
                'name' => 'Pastor Support',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Remove all existing roles and assign only support role
        $support->syncRoles(['support']);

        // Create Regular User
        $member = User::firstOrCreate(
            ['email' => 'member@citwam.org'],
            [
                'name' => 'Church Member',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Remove all existing roles and assign only user role
        $member->syncRoles(['user']);

        // Create some additional test users
        $testUsers = [
            ['name' => 'Test Admin', 'email' => 'test-admin@citwam.org', 'role' => 'admin'],
            ['name' => 'Test Support', 'email' => 'test-support@citwam.org', 'role' => 'support'],
            ['name' => 'Test User 1', 'email' => 'test-user1@citwam.org', 'role' => 'user'],
            ['name' => 'Test User 2', 'email' => 'test-user2@citwam.org', 'role' => 'user'],
        ];

        foreach ($testUsers as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $user->syncRoles([$userData['role']]);
        }

        $this->command->info('Users seeded successfully with roles!');
        $this->command->info('Login credentials:');
        $this->command->info('Admin: admin@citwam.org / password');
        $this->command->info('Support: pastor@citwam.org / password');
        $this->command->info('User: member@citwam.org / password');
    }
}