<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First batch: 20319–20330
        for ($id = 20319; $id <= 20328; $id++) {
            if (User::find($id)) {
                DB::table('students')->updateOrInsert(
                    ['id' => $id],
                    [
                        'userId' => $id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            } else {
                echo "Skipping student $id — no matching user found.\n";
            }
        }

        // Second batch: 21319–21328
        for ($id = 21319; $id <= 21328; $id++) {
            if (User::find($id)) {
                DB::table('students')->updateOrInsert(
                    ['id' => $id],
                    [
                        'userId' => $id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            } else {
                echo "Skipping student $id — no matching user found.\n";
            }
        }
        for ($id = 20301; $id <= 20318; $id++) {
            if (User::find($id)) {
                DB::table('students')->updateOrInsert(
                    ['id' => $id],
                    [
                        'userId' => $id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            } else {
                echo "Skipping student $id — no matching user found.\n";
            }
        }
    }
}
