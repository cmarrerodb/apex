<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement('DROP VIEW IF EXISTS vgiftcards');
        DB::statement('DROP TABLE IF EXISTS giftcards CASCADE');
        Schema::create('giftcards', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',23);
            $table->integer('estado_pago_id')->index();
            $table->foreign('estado_pago_id')->references('id')->on('gift_estados_pagos');
            $table->integer('estado_id')->index();
            $table->foreign('estado_id')->references('id')->on('gift_estados');
            $table->integer('credito_id')->index();
            $table->foreign('credito_id')->references('id')->on('gift_credito');
            $table->integer('forma_pago_id')->index(); 
            $table->foreign('forma_pago_id')->references('id')->on('gift_formas_pagos');
            $table->integer('cliente_id')->nullable();
            // $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string('beneficiario',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('telefono',20)->nullable();
            /*----------------------------------------------------------------------*/
            $table->integer('mesonero_id')->nullable();
            $table->foreign('mesonero_id')->references('id')->on('gift_mesoneros');
            $table->timestamp('fecha_canje')->nullable();
            /*----------------------------------------------------------------------*/
            $table->string('vendido_por',50)->nullable();
            $table->date('fecha_vencimiento')->index();
            $table->json('dias_uso',50);
            $table->time('horario_uso_desde');
            $table->time('horario_uso_hasta');
            $table->text('platos_excluidos')->fullText('platos_excluidos')->nullable();
            $table->string('ben_porcentaje',3)->nullable();
            $table->string('ben_monto',5)->nullable();
            $table->string('ben_plato',100)->nullable();
            $table->boolean('factura'); //si verdadero, los siguientes campos son obligatorios
            /*----------------------------------------------------------------------*/
            $table->string('num_factura',20)->nullable();
            $table->string('razon_social',50)->nullable();
            $table->string('rut',20)->nullable();
            $table->string('giro',30)->nullable();
            $table->text('direccion')->nullable();
            $table->date('fecha_factura')->nullable();
            $table->integer('monto_factura')->nullable();
            /*----------------------------------------------------------------------*/
            $table->integer('created_id')->index(); //usuario del sistema
            $table->integer('anulado_por_id')->nullable(); //usuario del sistema
            $table->date('fecha_anulacion')->nullable(); 
            $table->text('motivo_anulacion')->nullable(); 
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->index([
                'estado_pago_id',
                'estado_id',
                'credito_id',
                'forma_pago_id',
                'mesonero_id',
                // 'cliente_id',
                'fecha_vencimiento',
                'created_at',
                'created_id'
            ]);     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giftcards');
    }
}
