<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'samir',
                'email' => 'samir@example.com',
                'role' => 'User',
                'password' => Hash::make('samir'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alex Johnson',
                'email' => 'alex@example.com',
                'role' => 'User',
                'password' => Hash::make('password789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
