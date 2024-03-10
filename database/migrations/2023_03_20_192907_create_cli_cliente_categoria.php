<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliClienteCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cli_cliente_categoria', function (Blueprint $table) {
            $table->id();

            $table->integer('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('cli_categoria_clientes')->onDelete("cascade");
            $table->integer('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete("cascade");

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
        Schema::dropIfExists('cli_cliente_categoria');
    }
}
