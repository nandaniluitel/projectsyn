<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Coordinator;
use App\Models\Evaluator;
use App\Models\Supervisor;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [ 'userId'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coordinator()
    {
        return $this->hasMany(Coordinator::class);
    }

    public function evaluator()
    {
        return $this->hasMany(Evaluator::class);
    }

    public function supervisors()
    {
        return $this->hasMany(Supervisor::class);
    }
}
