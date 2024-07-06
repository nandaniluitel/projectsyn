<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\Evaluators;
use App\Models\Project;

class ProjectGroup extends Model
{
    use HasFactory;

    protected $table = 'project_groups';
    protected $fillable = ['title', 'description', 'level'];

    public function students()
    {
        return $this->belongsToMany(Students::class, 'project_group_students', 'project_group_id', 'student_id');
    }


    public function evaluators()
    {
        return $this->hasMany(Evaluators::class, 'groupId');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'groupId');
    }
    use HasFactory;
}
