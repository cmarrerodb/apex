<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsV2ToComensales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comensales', function (Blueprint $table) {
            $table->string('apellido')->nullable();
            $table->string('registro_hash', 10)->nullable();
            $table->string('parent_registro_hash', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comensales', function (Blueprint $table) {
            $table->dropColumn([
                'apellido',
                'registro_hash',
                'parent_registro_hash'
            ]);
        });
    }
}
