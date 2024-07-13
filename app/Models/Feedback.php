<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'supervisor_id',
        'group_id',
        'feedback_text',
    ];
    public function supervisor()
{
    return $this->belongsTo(Supervisor::class);
}

public function group()
{
    return $this->belongsTo(ProjectGroup::class, 'group_id');
}

}
