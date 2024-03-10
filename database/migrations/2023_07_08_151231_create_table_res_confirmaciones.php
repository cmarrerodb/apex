<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableResConfirmaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_confirmaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_confirmacion');
            $table->integer('sucursal_id')->references('id')->on('res_sucursales');
            $table->smallInteger('turno');
            $table->bigInteger('pax');
            $table->index(['id', 'fecha_confirmacion', 'sucursal_id']);
            $table->index('fecha_confirmacion');            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('res_confirmaciones');
    }
}
