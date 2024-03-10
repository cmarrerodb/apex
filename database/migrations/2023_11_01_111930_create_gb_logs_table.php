<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGbLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gb_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vista_id')->comment('Identificador de la vista');
            $table->text('descripcion')->comment('Descripción');
            $table->json('datos_previos')->nullable()->comment('Data antes de cambio');
            $table->json('datos_nuevos')->nullable()->comment('Data nueva');
            $table->bigInteger('user_id')->nullable()->comment('Usuario que ejecuta Accion');
            $table->integer('accion_tipo_id')->comment('Tipo de Accion ejecutada');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gb_logs');
    }
}
