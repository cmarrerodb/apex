<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesResEstadosReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('res_estados_reservas', function (Blueprint $table) {
            $table->index('id');
            $table->index('estado'); 
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('res_estados_reserva', function (Blueprint $table) {
            $table->dropIndex('res_estados_reservas_id_index');
            $table->dropIndex('res_estados_reservas_estado_index');
        });
    }
}
