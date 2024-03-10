<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterResHistorialAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()   {
        Schema::table('res_historial_cambios', function (Blueprint $table) {
            $columns = Schema::getColumnListing('res_historial_cambios');
            
            if (!in_array('vestado_previo', $columns)) {
                Schema::table('res_historial_cambios', function (Blueprint $table) {
                    $table->json('vestado_previo')->nullable();
                });
            }
            
            if (!in_array('vestado_actual', $columns)) {
                Schema::table('res_historial_cambios', function (Blueprint $table) {
                    $table->json('vestado_actual')->nullable();
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
                $table->dropColumn(['vestado_previo', 'vestado_actual']);
            });            
        });
    }
}
