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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slides_file')->nullable();
            $table->string('report_file')->nullable();
           
            $table->unsignedBigInteger('groupId');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('groupId')->references('id')->on('project_groups');
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            // $table->string('report_type')->after('report_file')->nullable();
            // $table->string('status')->default('pending');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
