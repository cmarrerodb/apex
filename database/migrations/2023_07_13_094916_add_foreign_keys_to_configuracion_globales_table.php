<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConfiguracionGlobalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracion_globales', function (Blueprint $table) {
            $table->foreign(['vista_id'], 'fk_vista_id')->references(['id'])->on('vistas');
            $table->foreign(['tipo_id'], 'fk_tipo_id')->references(['id'])->on('conf_tipos');
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
            $table->dropForeign('fk_vista_id');
            $table->dropForeign('fk_tipo_id');
        });
    }
}
