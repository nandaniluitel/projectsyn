<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_groups extends Model
{
    use HasFactory;

    protected $table = 'project_groups';
    protected $fillable = ['title', 'description', 'level'];

    public function students()
    {
        return $this->belongsToMany(Students::class, 'project_group_student', 'project_group_id', 'student_id');
    }


    public function evaluators()
    {
        return $this->hasMany(Evaluators::class, 'groupId');
    }
    public function projects()
    {
        return $this->hasMany(Projects::class, 'groupId');
    }
    use HasFactory;
}
