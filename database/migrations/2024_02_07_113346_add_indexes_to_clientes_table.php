<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->index('telefono');
            $table->index('email');
            $table->index('empresa');
            $table->index('hotel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropIndex([
                'clientes_telefono_index',
                'clientes_email_index',
                'clientes_empresa_index',
                'clientes_hotel_index'
            ]);
        });
    }
}
