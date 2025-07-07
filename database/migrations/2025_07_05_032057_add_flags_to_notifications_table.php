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
        $table->boolean('is_important')->default(false);
        $table->timestamp('expires_at')->nullable(); // only used if is_important = true
    });
}

public function down()
{
    Schema::table('notifications', function (Blueprint $table) {
        $table->dropColumn(['is_important', 'expires_at']);
    });
}

};
