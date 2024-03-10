<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateView2VresHistorial extends Migration
{
   
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS vres_historial_cambios;');
        DB::statement("CREATE OR REPLACE VIEW vres_historial_cambios as 
            SELECT a.id,
                a.reserva_id,
                a.vestado_actual ->> 'nombre_cliente'::text AS nombre_cliente,
                a.vestado_actual ->> 'fecha_reserva'::text AS fecha_reserva,
                a.vestado_actual ->> 'hora_reserva'::text AS hora_reserva,                     
                d.estado AS estado_previo,
                e.estado AS estado_actual,
                a.fecha_cambio,
                a.created_at,
                a.tipo_cambio,
                c.name as usuario,
                c.id as usuario_id,                 
                CASE WHEN a.tipo_cambio = 1 THEN 'EDICIÓN'
                WHEN a.tipo_cambio = 2 THEN 'ROLLBACK' WHEN a.tipo_cambio = 3 THEN 'CREACIÓN' END AS ttipo_cambio,
                a.estado_previo AS registro_previo,
                a.estado_actual AS registro_actual,
                a.vestado_previo AS vregistro_previo,
                a.vestado_actual AS vregistro_actual
            FROM res_historial_cambios a
                LEFT JOIN reservas b ON b.id = a.reserva_id
                LEFT JOIN users c ON c.id = a.usuario_id
                LEFT JOIN res_estados_reservas d ON d.id = a.valor_previo
                LEFT JOIN res_estados_reservas e ON e.id = a.valor_actual
            ORDER BY a.id;"
        );   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_vres_historial');
    }
   
}
