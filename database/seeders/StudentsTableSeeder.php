<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [];
        $users = [];
        $startId = 20319; // Start ID as an integer
        $endId = 20330;   // End ID as an integer

        for ($i = $startId; $i < $endId; $i++) {
            $users[] = [
                'id' => $i,
                'name' => 'Student '.$i,
                'email' => 'student'.$i.'@example.com',
                'password' => Hash::make('password'), // Use a proper password hashing mechanism
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $students[] = [
                'id' => $i,
                'userId' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users); // Insert users first
        DB::table('students')->insert($students); // Insert students next
    }
}
