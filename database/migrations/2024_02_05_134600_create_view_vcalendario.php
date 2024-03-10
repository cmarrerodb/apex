<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewVcalendario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement('DROP VIEW IF EXISTS vcalendario CASCADE;');
        DB::statement("CREATE OR REPLACE VIEW vcalendario as 
            SELECT a.id,
            a.fecha_reserva,
            a.hora_reserva,           
            CASE
                WHEN a.dianoche = 1 THEN
                'TARDE' :: TEXT ELSE'NOCHE' :: TEXT 
            END AS dianoche,
            a.nombre_cliente,
            a.cantidad_pasajeros,
            a.tipo_reserva,
            a.estado as estado,
            b.estado AS tipo,
            C.estado AS testado,
            a.sucursal,
            d.sucursal AS tsucursal,
            b.color_class AS classname, 
            (SELECT SUM(cantidad_pasajeros) FROM reservas 
                WHERE fecha_reserva = a.fecha_reserva AND estado NOT IN (4, 7, 8)
            ) AS total_pax
            FROM reservas a 
                LEFT JOIN res_tipo_reservas b ON b.id = a.tipo_reserva
                LEFT JOIN res_estados_reservas C ON C.id = a.estado
                LEFT JOIN res_sucursales d ON d.id = a.sucursal
            ORDER BY a.id; "
         );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {       
        DB::statement('DROP VIEW vcalendario');        
    }
}
