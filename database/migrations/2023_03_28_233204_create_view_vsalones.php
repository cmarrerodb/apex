<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewVsalones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW vsalones as 
            SELECT 
                a.id,
                b.id AS sucursal_id,
                b.sucursal,
                a.salon
            FROM res_salones a
            LEFT JOIN res_sucursales b ON b.id = a.sucursal_id
            WHERE a.deleted_at IS NULL
            ORDER BY a.id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vsalones;");
    }
}
