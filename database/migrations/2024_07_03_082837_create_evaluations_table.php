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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->string('id');
            $table->string('evaluatorId')->foreign('evaluatorId')->references('id')->on('evaluators');
            $table->string('projectId')->foreign('projectId')->references('id')->on('projects');
            $table->integer('phase');
            $table->string('finalgrade')->nullable();
            $table->string('feedback')->nullable();
            $table->string('reportMarks')->nullable();
            $table->string('presentationMarks')->nullable();
            $table->string('qaMarks')->nullable();
            $table->string('demoMarks')->nullable();
            $table->string('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};
