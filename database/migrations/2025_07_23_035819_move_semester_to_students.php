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
        Schema::table('students', function (Blueprint $table) {
            $table->string('year')->nullable()->after('userId');
        });
    
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('semester')->nullable();
        });
    
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
    
};
