<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectGroup;
use App\Models\ChatRoom;

class ChatRoomSeeder extends Seeder
{
    public function run()
    {
        ProjectGroup::with('students')->get()->each(function($group) {
            // create or fetch the room
            $room = ChatRoom::firstOrCreate(
                ['project_group_id' => $group->id],
                ['project_group_id' => $group->id]
            );

            // all students in that group...
            $studentUserIds = $group->students->pluck('userId')->toArray();

            // and (optionally) the supervisor—if you have that relation:
            // $supervisorUserId = $group->supervisorsViaModel->first()->teacher->userId ?? null;
            // if ($supervisorUserId) {
            //     $studentUserIds[] = $supervisorUserId;
            // }

            $room->users()->sync(array_unique($studentUserIds));
        });
    }
}
