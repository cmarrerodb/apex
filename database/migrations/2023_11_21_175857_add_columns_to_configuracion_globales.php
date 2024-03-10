<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToConfiguracionGlobales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracion_globales', function (Blueprint $table) {
            $table->text('descripcion')->nullable();
            $table->string('email')->nullable();
            $table->string('duracion', 20)->nullable()->comment('Para definir los tipos: Segundos, minutos, horas, dias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracion_globales', function (Blueprint $table) {
            $table->dropColumn(['descripcion', 'email','duracion']);
        });
    }
}
