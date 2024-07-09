<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Coordinator extends Model
{
   
    use HasFactory;
    protected $table = 'coordinator';
    protected $fillable = ['teacherId'];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherId');
    }
}
