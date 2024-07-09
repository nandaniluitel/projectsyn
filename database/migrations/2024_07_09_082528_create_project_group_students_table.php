<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_group_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_group_id');
            $table->unsignedBigInteger('student_id');

            $table->foreign('project_group_id')->references('id')->on('project_groups')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();

            // Ensure these columns are indexed
            $table->index('project_group_id');
            $table->index('student_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_group_students');
    }
};
