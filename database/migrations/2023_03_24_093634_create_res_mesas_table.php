<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_mesas', function (Blueprint $table) {
            $table->id();
            $table->integer('mesa');
            $table->integer('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('res_sucursales');
            $table->integer('salon_id');
            $table->foreign('salon_id')->references('id')->on('res_salones');
            $table->integer('capacidad');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_mesas');
    }
}
