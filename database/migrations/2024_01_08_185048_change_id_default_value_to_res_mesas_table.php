<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdDefaultValueToResMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        DB::statement('ALTER SEQUENCE res_mesas_id_seq RESTART WITH 130');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER SEQUENCE res_mesas_id_seq RESTART WITH 1');
    }

    // public function up()
    // {
    //     DB::statement('ALTER TABLE res_mesas AUTO_INCREMENT = 130;');
    // }

    // public function down()
    // {
    //     DB::statement('ALTER TABLE res_mesas AUTO_INCREMENT = 1;');
    // }
}
