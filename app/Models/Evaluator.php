<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Evaluator extends Model
{
    use HasFactory;
    protected $table = 'evaluators';
    protected $fillable = ['teacherId'];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
