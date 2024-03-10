<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnToGiftcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giftcards', function (Blueprint $table) {
            $table->integer('cliente_id')->nullable()->change();
            $table->integer('mesonero_id')->nullable()->change();
            $table->text('platos_excluidos')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('giftcards', function (Blueprint $table) {
            $table->integer('cliente_id')->nullable(false)->change();
            $table->integer('mesonero_id')->nullable(false)->change();
            $table->text('platos_excluidos')->nullable(false)->change();
        });
    }
}
