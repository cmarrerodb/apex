<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableResBloqueos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_bloqueos', function (Blueprint $table) {
            $table->id();
            $table->integer("tipo")->default(1);
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->time("hora_inicio");
            $table->time("hora_fin");
            $table->integer("usuario_registro");
            $table->string("nombre_bloqueo",150);
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
        Schema::table('res_bloqueos', function (Blueprint $table) {
            Schema::dropIfExists('res_bloqueos');
        });
    }
}
