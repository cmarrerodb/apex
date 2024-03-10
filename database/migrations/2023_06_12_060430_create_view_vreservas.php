<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewVReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement('DROP VIEW IF EXISTS vreservas CASCADE;');
       DB::statement("CREATE OR REPLACE VIEW vreservas as 
			SELECT a.id,
				a.fecha_reserva,
				a.razon_cancelacion,
				g.razon,
				a.observacion_cancelacion,
				a.hora_reserva,
					CASE
						WHEN a.dianoche = 0 THEN 'TARDE'::text
						ELSE 'NOCHE'::text
					END AS dianoche,
				a.nombre_cliente,
				a.nombre_empresa,
				a.fecha_ultima_modificacion,
				a.usuario_ultima_modificacion,
				i.name AS tusuario_ultima_modificacion,
				a.nombre_hotel,
				a.cantidad_pasajeros,
				a.telefono_cliente,
				a.tipo_reserva,
				b.estado AS tipo,
				a.email_cliente,
				a.salon,
				e.salon AS tsalon,
				a.mesa,
				d.mesa AS tmesa,
				a.estado,
				c.estado AS testado,
				( SELECT count(x.*) AS count
					FROM res_historial_cambios x
					WHERE x.deleted_at IS NULL AND x.reserva_id = a.id) AS cambios,
				a.observaciones,
				a.usuario_registro,
				h.name AS tusuario_registro,
				a.clave_usuario,
				a.sucursal,
				f.sucursal AS tsucursal,
				a.archivo_1,
				a.archivo_2,
				a.archivo_3,
				a.archivo_4,
				a.archivo_5,
				a.cliente_id,
				a.evento_nombre_adicional,
				a.evento_pax,
				a.evento_valor_menu,
				a.evento_total_sin_propina,
				a.evento_total_propina,
				a.evento_email_contacto,
				a.evento_telefono_contacto,
				a.evento_anticipo,
				a.evento_paga_en_local,
					CASE
						WHEN a.evento_paga_en_local = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_paga_en_local,
				a.evento_audio,
					CASE
						WHEN a.evento_audio = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_audio,
				a.evento_video,
					CASE
						WHEN a.evento_video = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_video,
				a.evento_video_audio,
					CASE
						WHEN a.evento_video_audio = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_video_audio,
				a.evento_restriccion_alimenticia,
					CASE
						WHEN a.evento_restriccion_alimenticia = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_restriccion_alimenticia,
				a.evento_ubicacion,
				a.evento_monta,
				a.evento_detalle_restriccion,
				a.ambiente,
				a.usuario_confirmacion,
				j.name AS tusuario_confirmacion,
				a.usuario_rechazo,
				k.name AS tusuario_rechazo,
				a.fecha_confirmacion,
				a.fecha_rechazo,
				a.razon_rechazo,
				a.evento_comentarios,
				a.evento_nombre_contacto,
				a.evento_idioma,
				a.evento_cristaleria,
				a.evento_decoracion,
				a.evento_mesa_soporte_adicional,
					CASE
						WHEN a.evento_mesa_soporte_adicional = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_mesa_soporte_adicional,
				a.evento_extra_permitido,
					CASE
						WHEN a.evento_extra_permitido = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_extra_permitido,
				l.autoriza,
				l.telefono_autoriza,
				l.monto_autorizado,
				l.created_at AS fecha_autorizacion,
				a.evento_menu_impreso,
					CASE
						WHEN a.evento_menu_impreso = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_menu_impreso,
				a.evento_table_tent,
					CASE
						WHEN a.evento_table_tent = 1 THEN 'SI'::text
						ELSE 'NO'::text
					END AS tevento_table_tent,
				a.evento_logo,
				a.created_at,
				a.updated_at,
				a.deleted_at,
				b.color_class AS classname
			FROM reservas a
				LEFT JOIN res_tipo_reservas b ON b.id = a.tipo_reserva
				LEFT JOIN res_estados_reservas c ON c.id = a.estado
				LEFT JOIN res_mesas d ON d.id = a.mesa
				LEFT JOIN res_salones e ON e.id = a.salon
				LEFT JOIN res_sucursales f ON f.id = a.sucursal
				LEFT JOIN res_razon_cancelacion g ON g.id = a.razon_cancelacion
				LEFT JOIN users h ON h.id = a.usuario_registro
				LEFT JOIN users i ON i.id = a.usuario_ultima_modificacion
				LEFT JOIN users j ON j.id = a.usuario_confirmacion
				LEFT JOIN users k ON k.id = a.usuario_rechazo
				LEFT JOIN res_extras l ON l.reserva_id = a.id
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
        Schema::dropIfExists('view_reservas');
    }
}
