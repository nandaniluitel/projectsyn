<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor;

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
    return $this->belongsTo(ProjectGroup::class, 'groupId');
}

public function supervisor()
{
    return $this->belongsTo(Supervisor::class, 'supervisor_id');
}
}

