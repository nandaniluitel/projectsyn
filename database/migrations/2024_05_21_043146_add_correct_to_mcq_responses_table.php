<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorrectToMcqResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mcq_responses', function (Blueprint $table) {
            $table->integer('correct')->default(0)->after('selected_option');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mcq_responses', function (Blueprint $table) {
            $table->dropColumn('correct');
        });
    }
}
