<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ProjectGroup;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function showImportForm()
    {
        return view('users.import');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);
    
        Excel::import(new UsersImport, $request->file('file'));
    
        return redirect()->back()->with('success', 'Users imported successfully!');
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'userId');
    }

    public function student()
    {
        return $this->hasOne(Student::class,'userId');
    }

    public function supervisorProjects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'name', 'Photo', 'Phone_number', 'semester', 'email', 'password',
    ];
    public $incrementing = false;
    protected $keyType = 'int';

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
    public function isTeacher()
{
    return Teacher::where('userId', $this->id)->exists();
}

public function isStudent()
{
    return Student::where('userId', $this->id)->exists();
}
public function chatRooms()
{
    return $this->belongsToMany(
        ChatRoom::class,
        'chat_room_users',
        'user_id',
        'chat_room_id'
    );
}

public function messages()
{
    return $this->hasMany(Message::class, 'sender_id');
}


}
