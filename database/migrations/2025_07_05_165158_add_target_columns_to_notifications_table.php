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
        Schema::table('notifications', function (Blueprint $table) {
            $table->enum('target_audience', ['students', 'teachers', 'both'])->default('both');
            $table->unsignedTinyInteger('student_year')->nullable(); // Only applies if target_audience includes students            
        });
    }
    
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['target_audience', 'student_year']);
        });
    }
};
