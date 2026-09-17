<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun admin (untuk login ke /admin/dashboard)
        User::updateOrCreate(
            ['email' => 'admin@dkacademy.test'],
            [
                'name' => 'Admin DK Academy',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );

        // Akun user biasa (untuk login biasa, tidak bisa akses /admin)
        User::updateOrCreate(
            ['email' => 'user@dkacademy.test'],
            [
                'name' => 'User Biasa',
                'password' => bcrypt('user123'),
                'role' => 'user',
            ]
        );
    }
}