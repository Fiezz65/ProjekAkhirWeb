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
        \App\Models\User::create([
            'nama' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => 'admin123', // Jangan di-Hash manual karena User model sudah punya cast 'hashed'
            'role' => 'admin',
        ]);
    }
}
