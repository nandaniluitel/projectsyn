<?php

namespace App\Imports;


use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            $user = User::create([
                'id'           => $row['id'],
                'name'         => $row['name'],
                'email'        => $row['email'],
                'password'     => Hash::make($row['password']),
                'Phone_number' => $row['phone'],
            ]);

            $role = strtolower(trim($row['role']));

            Log::info("Created user: {$user->id} with role: {$role}");

            if ($role === 'student') {
                Student::create([
                    'id'         => $user->id,
                    'userId'     => $user->id,
                    'year'       => $row['year'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Log::info("Created student record for user: {$user->id}");
            } elseif ($role === 'teacher') {
                Teacher::create([
                    'id'         => $user->id,
                    'userId'     => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Log::info("Created teacher record for user: {$user->id}");
            } else {
                Log::warning("Unknown role '{$row['role']}' for user: {$user->id}");
            }

            return $user;
        } catch (\Exception $e) {
            Log::error("Failed to import user with email: {$row['email']} — {$e->getMessage()}");
            return null; // skip this row if it fails
        }
    }
}
