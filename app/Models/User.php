<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Teacher;
use App\Models\Student;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Notifiable;
    // public function hasRole($role)
    // {
    //     switch ($role) {
    //         case 'admin':
    //             return $this->is_admin; // Assuming you have an `is_admin` column
    //         case 'teacher':
    //             return $this->teachers()->exists(); // Check if the user has any related teachers
    //         case 'student':
    //             return $this->students()->exists(); // Check if the user has any related students
    //         default:
    //             return false;
    //     }
    // }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'userId');
    }

    public function student()
    {
        return $this->hasOne(Student::class,'userId');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'Photo', 'Phone_number', 'semester', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
