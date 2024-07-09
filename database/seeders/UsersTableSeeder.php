<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First set of users with IDs starting from 020319
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'id' => 20319 + $i,
                'name' => 'User ' . (20319 + $i),
                'email' => 'user' . (20319 + $i) . '@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'Photo' => null,
                'Phone_number' => '1234567890',
                'semester' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Second set of users with IDs starting from 1
        for ($i = 2; $i <= 10; $i++) {
            $users[] = [
                'id' => $i,
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'Photo' => null,
                'Phone_number' => '0987654321',
                'semester' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
