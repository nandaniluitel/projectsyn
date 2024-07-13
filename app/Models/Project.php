<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor;
use App\Models\User;

class project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    // Define the fillable attributes
    protected $fillable = [
        'groupId',
        'report_file',
        'slides_file',
        'report_type',
        'supervisor_id',
        'status'
    ];
// Define the relationships
public function group()
{
    return $this->belongsTo(ProjectGroup::class, 'groupId');
}

public function supervisor()
{
    return $this->belongsTo(Supervisor::class, 'supervisor_id');
}
}

