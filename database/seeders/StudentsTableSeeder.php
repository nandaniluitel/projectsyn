<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $startId = 20319; // Start ID as an integer
        $endId = 20330;   // End ID as an integer

        for ($i = $startId; $i < $endId; $i++) {
            $students[] = [
                'id'=>$i,
                'userId' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}
