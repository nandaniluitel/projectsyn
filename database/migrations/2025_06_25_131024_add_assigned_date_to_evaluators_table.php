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
        Schema::table('evaluators', function (Blueprint $table) {
            $table->date('assigned_date')->after('teacherId');
        });
    }
    
    public function down()
    {
        Schema::table('evaluators', function (Blueprint $table) {
            $table->dropColumn('assigned_date');
        });
    }
};
