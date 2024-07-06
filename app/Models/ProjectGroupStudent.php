<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGroupStudent extends Model
{
    protected $table = 'project_group_students';
    use HasFactory;
    protected $fillable = ['project_group_id', 'student_id'];
}
