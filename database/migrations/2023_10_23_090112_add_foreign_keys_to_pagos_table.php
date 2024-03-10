<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->foreign(['estado_pago_id'], 'fk_estado_pago_id')->references('id')->on('gift_estados_pagos');
            $table->foreign(['forma_pago_id'], 'fk_forma_pago_id')->references('id')->on('gift_formas_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign('fk_estado_pago_id');
            $table->dropForeign('fk_forma_pago_id');
        });
    }
}
