<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert users data
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'role' => 'Admin',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'role' => 'User',
                'password' => Hash::make('password456'),
            ],
            [
                'name' => 'Alex Johnson',
                'email' => 'alex@example.com',
                'role' => 'User',
                'password' => Hash::make('password789'),
            ],
        ]);

        // Insert password reset tokens data
        DB::table('password_reset_tokens')->insert([
            [
                'email' => 'john@example.com',
                'token' => 'reset-token-123',
                'created_at' => now(),
            ],
            [
                'email' => 'jane@example.com',
                'token' => 'reset-token-456',
                'created_at' => now(),
            ],
        ]);

        // Insert session data
        DB::table('sessions')->insert([
            [
                'id' => 'session-id-1',
                'user_id' => 1, // Assuming user with ID 1 exists
                'ip_address' => '192.168.1.1',
                'user_agent' => 'Mozilla/5.0',
                'payload' => 'session-payload-1',
                'last_activity' => time(),
            ],
            [
                'id' => 'session-id-2',
                'user_id' => 2, // Assuming user with ID 2 exists
                'ip_address' => '192.168.1.2',
                'user_agent' => 'Mozilla/5.0',
                'payload' => 'session-payload-2',
                'last_activity' => time(),
            ],
        ]);
    }
}
