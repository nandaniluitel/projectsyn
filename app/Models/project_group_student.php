<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_group_student extends Model
{
    protected $table = 'project_group_student';
    use HasFactory;
    protected $fillable = ['project_group_id', 'student_id'];
}
