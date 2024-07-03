<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_groups extends Model
{
    protected $table = 'project_groups';

    public function students()
    {
        return $this->belongsToMany(Student::class, 'project_group_student');
    }

    public function evaluators()
    {
        return $this->hasMany(Evaluator::class, 'groupId');
    }

    public function coordinator()
    {
        return $this->belongsTo(Teacher::class, 'coordinatorId');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'groupId');
    }
    use HasFactory;
}
