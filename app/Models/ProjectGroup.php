<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Evaluator;
use App\Models\Project;

class ProjectGroup extends Model
{
    use HasFactory;

    protected $table = 'project_groups';
    protected $fillable = ['title', 'description', 'level','supervisor_id'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'project_group_students', 'project_group_id', 'student_id');
    }


    public function evaluators()
    {
        return $this->hasMany(Evaluator::class, 'groupId');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'groupId');
    }
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'groupId');
    }
}
