<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [];
        $users = [];
        
        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'id' => $i,
                'name' => 'Teacher '.$i,
                'email' => 'teacher'.$i.'@example.com',
                'password' => Hash::make('password'), // Use a proper password hashing mechanism
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $teachers[] = [
                'userId' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users); // Insert users first
        DB::table('teachers')->insert($teachers); // Insert teachers next
    }
}
