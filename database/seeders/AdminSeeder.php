<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Address;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'profile_image' => '',
            'password' => Hash::make('12345678'),
        ]);
    }
}
