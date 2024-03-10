<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('rut',12)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono',15);
            $table->text('direccion')->nullable();
            $table->integer('comuna_id')->nullable();
            $table->foreign('comuna_id')->references('id')->on('cli_comunas')->onDelete("cascade");
            $table->integer('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('cli_categoria_clientes')->onDelete("cascade");
            $table->integer('tipo_id')->nullable();
            $table->foreign('tipo_id')->references('id')->on('cli_tipos_clientes')->onDelete("cascade");            
            $table->string('numero_tarjeta',8)->nullable();
            $table->string('email',50);
            $table->string('empresa',50)->nullable();
            $table->string('hotel',50)->nullable();
            $table->string('vino_favorito_1',50)->nullable();
            $table->string('vino_favorito_2',50)->nullable();
            $table->string('vino_favorito_3',50)->nullable();
            $table->string('foto',150)->nullable();
            $table->text('referencia')->nullable();
            $table->smallinteger('info_vina')->nullable();
            $table->smallinteger('club')->nullable();

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
        Schema::dropIfExists('clientes');
    }
}
