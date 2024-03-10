<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionGlobalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_globales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vista');
            $table->smallInteger('tipo_id')->nullable();
            $table->integer('valor')->unsigned()->nullable()->default(12);
            $table->jsonb('datos')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracion_globales');
    }
}
