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
        // Cek apakah user sudah ada, jika belum maka buat
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@kemenhaj.go.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@kemenhaj.go.id',
                'password' => Hash::make('editor123'),
                'role' => 'editor',
            ],
            [
                'name' => 'Kontributor',
                'email' => 'kontributor@kemenhaj.go.id',
                'password' => Hash::make('kontributor123'),
                'role' => 'kontributor',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
