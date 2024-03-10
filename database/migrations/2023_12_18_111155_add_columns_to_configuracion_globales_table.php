<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToConfiguracionGlobalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracion_globales', function (Blueprint $table) {
            $table->text('texto_notificacion')->nullable();
            $table->integer('activo')->unsigned()->default(1);
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
            $table->dropColumn([
                'texto_notificacion',
                'activo'
            ]);
        });
    }
}
