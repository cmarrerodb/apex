<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewVmesasTodas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW vmesas_todas as 
            SELECT 
            b.id AS sucursal_id,
            b.sucursal,
            c.id AS salon_id,
            c.salon,
            a.id AS mesa_id,
            a.mesa,
            a.capacidad
            FROM res_mesas a 
            LEFT JOIN res_sucursales b ON b.id =a.sucursal_id
            LEFT JOIN res_salones c ON b.id =a.sucursal_id 
                AND c.id = a.salon_id
            ORDER BY b.sucursal,c.salon,a.mesa
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vmesas_todas;");
    }
}
