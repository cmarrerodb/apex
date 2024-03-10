<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliCategoriaClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cli_categoria_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('categoria',50);
            $table->integer('monto');
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
        Schema::dropIfExists('cli_categoria_clientes');
    }
}
