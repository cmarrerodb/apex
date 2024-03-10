<?php
// 2023_04_10_054934_create_res_historial_cambios_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableResHistorialCambios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS vres_historial_cambios;');
        DB::statement('DROP TABLE IF EXISTS res_historial_cambios CASCADE;');
        Schema::create('res_historial_cambios', function (Blueprint $table) {
            $table->id();
            $table->integer('reserva_id');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamp("fecha_cambio");
            $table->json('estado_previo')->nullable();
            $table->json('estado_actual')->nullable();
            $table->integer('valor_previo')->nullable();
            $table->integer('valor_actual')->nullable();
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
        Schema::dropIfExists('res_historial_cambios');
    }
}
