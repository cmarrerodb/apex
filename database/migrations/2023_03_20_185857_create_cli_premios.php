<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliPremios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cli_premios', function (Blueprint $table) {
            $table->id();
            $table->integer('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('cli_categoria_clientes')->onDelete("cascade");;
            $table->string('premio',75);
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
        Schema::dropIfExists('cli_premios');
    }
}
