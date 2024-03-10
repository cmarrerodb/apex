<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_extras', function (Blueprint $table) {
            $table->id();
            $table->integer("reserva_id");
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->string("autoriza",50);
            $table->string("telefono_autoriza",20);
            $table->integer("monto_autorizado");
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
        Schema::dropIfExists('res_extras');
    }
}
