<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@reunion.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin'
            ]
        );

        // Moderator
        User::updateOrCreate(
            ['email' => 'moderator@reunion.com'],
            [
                'name' => 'Moderator',
                'password' => Hash::make('password'),
                'role' => 'moderator'
            ]
        );

        // Viewer
        User::updateOrCreate(
            ['email' => 'viewer@reunion.com'],
            [
                'name' => 'Viewer',
                'password' => Hash::make('password'),
                'role' => 'viewer'
            ]
        );
    }
}
