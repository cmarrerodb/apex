<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('giftcard_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('estado_pago_id')->nullable();
            $table->bigInteger('forma_pago_id')->nullable();
            $table->float('monto');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('cod_transbank', 100)->nullable();
            $table->string('url_adjunto', 100)->nullable();
            $table->jsonb('resultado')->nullable();
            $table->smallInteger('status_pago')->nullable()->default(0);
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('pagos');
    }
}
