<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_group_id');
            $table->timestamps();

            $table->foreign('project_group_id')
                  ->references('id')->on('project_groups')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_rooms');
    }
};
