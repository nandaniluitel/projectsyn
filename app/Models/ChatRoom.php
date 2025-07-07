<?php 

// app/Models/ChatRoom.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = ['project_group_id'];

    public function projectGroup()
    {
        return $this->belongsTo(ProjectGroup::class, 'project_group_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_room_users', 'chat_room_id', 'user_id')
                    ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_room_id');
    }
}
