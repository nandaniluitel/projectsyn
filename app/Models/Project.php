<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    // Define the fillable attributes
    protected $fillable = [
        'groupId',
        'report_file',
        'slides_file',
        'supervisor_id',
    ];
// Define the relationships
public function group()
{
    return $this->belongsTo(project_groups::class, 'groupId');
}

public function supervisor()
{
    return $this->belongsTo(Supervisors::class, 'supervisor_id');
}
}

