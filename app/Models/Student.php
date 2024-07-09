<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectGroup;
use App\Models\User;


class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = ['id','userId'];

    public function project_groups()
    {
        return $this->belongsToMany(ProjectGroup::class, 'project_group_students','student_id', 'project_group_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'userId');
    }
}
