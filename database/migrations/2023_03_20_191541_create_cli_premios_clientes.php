<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliPremiosClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cli_premios_clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete("cascade");
            $table->integer('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('cli_categoria_clientes')->onDelete("cascade");
            $table->integer('premio_id');
            $table->foreign('premio_id')->references('id')->on('cli_premios')->onDelete("cascade");
            $table->smallinteger('estado_entrega');
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cli_premios_clientes');
    }
}
