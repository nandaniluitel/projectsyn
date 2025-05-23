<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectGroup;
use App\Models\Teacher;
use App\Models\Project;

class Supervisor extends Model
{
    use HasFactory;
    protected $table = 'supervisors';
    protected $fillable = ['teacherId', 'groupId'];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacherId');
    }
//ansa added projects 
    public function projects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function projectGroup()
    {
        return $this->belongsTo(ProjectGroup::class, 'groupId');
    }
    
    public function feedback()
    {
    return $this->hasMany(Feedback::class);
    }

}
