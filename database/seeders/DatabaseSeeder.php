<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data admin
        $username = 'admin';
        $password = 'admin';
        
        User::create([
            'username' => $username,
            'password' => Hash::make($password),
            'telp'     => '000000000',
            'role'     => 'admin',
        ]);
    }
}
