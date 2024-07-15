<?php

// app/Models/Evaluation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluatorId',
        'projectId',
        'phase',
        'reportMarks',
        'presentationMarks',
        'qaMarks',
        'demoMarks',
        'feedback',
        'status',
    ];

    public function project()
{
    return $this->belongsTo(Project::class, 'projectId');
}

public function evaluator()
{
    return $this->belongsTo(Evaluator::class, 'evaluatorId');
}
}
