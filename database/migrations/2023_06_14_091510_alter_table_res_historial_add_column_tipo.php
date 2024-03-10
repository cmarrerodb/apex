<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableResHistorialAddColumnTipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()   {
        Schema::table('res_historial_cambios', function (Blueprint $table) {
            $columns = Schema::getColumnListing('res_historial_cambios');
            
            if (!in_array('tipo_cambio', $columns)) {
                Schema::table('res_historial_cambios', function (Blueprint $table) {
                    $table->integer('tipo_cambio');
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('res_historial_cambios', function (Blueprint $table) {
            Schema::table('res_historial_cambios', function (Blueprint $table) {
                $table->dropColumn(['tipo_cambio']);
            });            
        });
    }}
