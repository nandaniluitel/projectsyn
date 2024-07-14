<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Evaluator;
use App\Models\Project;
use App\Models\User; // Assuming User model is used for teachers
use App\Models\Supervisor;

class ProjectGroup extends Model
{
    use HasFactory;

    protected $table = 'project_groups';
    protected $fillable = ['title', 'description', 'level'];

    // Relationship with students (many-to-many)

    public function projectGroupStudents()
    {
        return $this->hasMany(ProjectGroupStudent::class, 'project_group_id');
    }
    public function students()
    {
        return $this->hasMany(ProjectGroupStudent::class, 'project_group_id');
    }

    // Relationship with evaluators (one-to-many)
    public function evaluators()
    {
        return $this->hasMany(Evaluator::class, 'groupId');
    }

    // Relationship with projects (one-to-many)
    public function projects()
    {
        return $this->hasMany(Project::class, 'groupId');
    }

    // Relationship with supervisors (many-to-many through User model)
    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'supervisors', 'groupId', 'teacherId');
    }

    // Relationship with supervisors via Supervisor model (one-to-many)
    public function supervisorsViaModel()
    {
        return $this->hasMany(Supervisor::class, 'groupId');
    }

    public function feedbacks()
    {
    return $this->hasMany(Feedback::class, 'group_id');
    }

}