<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsV3ToGiftcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('giftcards', function (Blueprint $table) {
            $table->string('nombre_comprador')->nullable();
            $table->string('email_comprador')->nullable();
            $table->string('telefono_comprador')->nullable();
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

            $table->dropColumn([
                'nombre_comprador',
                'email_comprador',
                'telefono_comprador'
            ]);
        });
    }
}
