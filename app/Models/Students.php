<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = ['id'];

    public function project_groups()
    {
        return $this->belongsToMany(ProjectGroup::class, 'project_group_student','student_id', 'project_group_id');
    }
}
