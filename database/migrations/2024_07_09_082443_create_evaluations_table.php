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
            $table->id();
            $table->unsignedBigInteger('evaluatorId');
            $table->unsignedBigInteger('projectId');
            $table->foreign('evaluatorId')->references('id')->on('evaluators');
            $table->foreign('projectId')->references('id')->on('projects');
            $table->string('phase');
            $table->string('reportMarks')->nullable();
            $table->string('presentationMarks')->nullable();
            $table->string('qaMarks')->nullable();
            $table->string('demoMarks')->nullable();
            $table->string('feedback')->nullable();

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
        Schema::dropIfExists('evaluations');
    }
};
