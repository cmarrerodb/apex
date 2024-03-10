<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexes2ToReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->index('id');
            $table->index('sucursal');
            $table->index('salon');
            $table->index('estado');
            $table->index('tipo_reserva');           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropIndex('reservas_id_index');
            $table->dropIndex('reservas_sucursal_index');
            $table->dropIndex('reservas_salon_index');
            $table->dropIndex('reservas_estado_index');
            $table->dropIndex('reservas_tipo_reserva_index');
        });
    }
}
