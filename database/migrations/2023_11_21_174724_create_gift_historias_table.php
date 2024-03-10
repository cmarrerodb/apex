<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_historias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('giftcard_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('descripcion')->nullable();                        
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
        Schema::dropIfExists('gift_historias');
    }
}
