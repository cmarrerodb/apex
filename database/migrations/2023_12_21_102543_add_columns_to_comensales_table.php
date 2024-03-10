<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToComensalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comensales', function (Blueprint $table) {
            $table->bigInteger('cuenta_id')->nullable();
            $table->bigInteger('mesa_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
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
        Schema::table('comensales', function (Blueprint $table) {
            $table->dropColumn([
               'cuenta_id',
               'mesa_id',
               'parent_id',
               'delete_at',
            ]);            
        });
    }
}
