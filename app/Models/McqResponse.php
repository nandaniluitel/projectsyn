<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mcq_id',
        'selected_option',
        'correct',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mcq()
    {
        return $this->belongsTo(Mcq::class);
    }
}
