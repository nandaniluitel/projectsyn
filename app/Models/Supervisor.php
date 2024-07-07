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
    public function projectGroup()
    {
        return $this->hasMany(ProjectGroup::class, 'groupId');
    }
}
