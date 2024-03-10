<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_reserva');
            $table->integer('razon_cancelacion')->nullable();
            $table->text('observacion_cancelacion')->nullable();
            $table->time('hora_reserva');
            $table->string('nombre_cliente', 100);
            $table->string('nombre_empresa', 100)->nullable();
            $table->timestamp('fecha_ultima_modificacion')->nullable();
            $table->integer('usuario_ultima_modificacion')->nullable();
            $table->string('nombre_hotel', 100)->nullable();
            $table->integer('cantidad_pasajeros');
            $table->string('telefono_cliente', 50)->nullable();
            $table->integer('tipo_reserva');
            $table->string('email_cliente', 150)->nullable();
            $table->integer('salon')->nullable();
            $table->integer('mesa');
            $table->integer('estado');
            $table->text('observaciones')->nullable();
            $table->integer('usuario_registro');
            $table->string('clave_usuario', 10)->nullable();
            $table->integer('sucursal');
            $table->smallInteger('dianoche')->default(1);
            $table->string('archivo_1', 150)->nullable();
            $table->string('archivo_2', 150)->nullable();
            $table->string('archivo_3', 150)->nullable();
            $table->string('archivo_4', 150)->nullable();
            $table->string('archivo_5', 150)->nullable();
            $table->integer('cliente_id')->nullable();
            $table->string('evento_nombre_adicional', 50)->nullable();
            $table->string('evento_pax', 20)->nullable();
            $table->string('evento_valor_menu', 20)->nullable();
            $table->string('evento_total_sin_propina', 20)->nullable();
            $table->string('evento_total_propina', 20)->nullable();
            $table->string('evento_email_contacto', 150)->nullable();
            $table->string('evento_telefono_contacto', 50)->nullable();
            $table->string('evento_anticipo', 20)->nullable();
            $table->smallInteger('evento_paga_en_local')->nullable();
            $table->smallInteger('evento_audio')->nullable();
            $table->smallInteger('evento_video')->nullable();
            $table->smallInteger('evento_video_audio')->nullable();
            $table->smallInteger('evento_restriccion_alimenticia')->nullable();
            $table->string('evento_ubicacion', 250)->nullable();
            $table->string('evento_monta', 250)->nullable();
            $table->text('evento_detalle_restriccion')->nullable();
            $table->string('ambiente', 150)->nullable();
            $table->integer('usuario_confirmacion')->nullable();
            $table->integer('usuario_rechazo')->nullable();
            $table->timestamp('fecha_confirmacion')->nullable();
            $table->timestamp('fecha_rechazo')->nullable();
            $table->text('razon_rechazo')->nullable();
            $table->text('evento_comentarios')->nullable();
            $table->string('evento_nombre_contacto', 100)->nullable();
            $table->string('evento_idioma', 50)->nullable();
            $table->string('evento_cristaleria', 50)->nullable();
            $table->text('evento_decoracion')->nullable();
            $table->smallInteger('evento_mesa_soporte_adicional')->nullable();
            $table->smallInteger('evento_extra_permitido')->nullable();
            $table->smallInteger('evento_menu_impreso')->nullable();
            $table->smallInteger('evento_table_tent')->nullable();
            $table->string('evento_logo', 150)->nullable();
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
        Schema::dropIfExists('reservas');
    }
};
