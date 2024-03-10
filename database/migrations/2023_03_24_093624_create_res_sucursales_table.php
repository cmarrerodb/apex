<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('sucursal',150);
            $table->integer('calendario')->nullable;
            $table->date('fecha_inicio_calendario')->nullable;
            $table->date('fecha_fin_calendario')->nullable;
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
        Schema::dropIfExists('res_sucursales');
    }
}
