<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeysToGbLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gb_logs', function (Blueprint $table) {
            $table->dropForeign('fk_vista_id');
            $table->foreign('vista_id', 'fk_vista_id')->references('id')->on('vistas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gb_logs', function (Blueprint $table) {
            $table->dropForeign('fk_vista_id');
            $table->foreign('vista_id', 'fk_vista_id')->references('id')->on('gb_vistas');
        });
    }
}
