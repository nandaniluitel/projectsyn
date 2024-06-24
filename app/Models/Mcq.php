<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    use HasFactory;
    public function quizCategory() {
        return $this->hasOne('App\Models\Category','id','category');
    } 
}
