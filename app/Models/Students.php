<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectGroup;


class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = ['id','name','semester','email','phone_number'];

    public function project_groups()
    {
        return $this->belongsToMany(ProjectGroup::class, 'project_group_students','student_id', 'project_group_id');
    }
}
