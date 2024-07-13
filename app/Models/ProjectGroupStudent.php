<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGroupStudent extends Model
{
    protected $table = 'project_group_students';
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function group()
    {
        return $this->belongsTo(ProjectGroup::class, 'project_group_id');
    }

    protected $fillable = ['project_group_id', 'student_id'];
}
