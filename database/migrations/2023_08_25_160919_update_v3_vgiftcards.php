<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateV3Vgiftcards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS vgiftcard CASCADE;');
        DB::statement("CREATE OR REPLACE VIEW vgiftcards as
              SELECT a.id,
                  a.codigo,
                  a.estado_id,
                  h.estado,
                  a.estado_pago_id,
                  b.estado_pago,
                  a.credito_id,
                  c.credito,
                  a.forma_pago_id,
                  d.forma_pago,
                  a.beneficiario,
                  a.email,
                  a.telefono,
                  a.mesonero_id,
                  a.fecha_canje,
                  f.mesonero,
                  a.vendido_por,
                  a.created_at::date AS fecha_creacion,
                  a.fecha_vencimiento,
                  ( SELECT string_agg(json_each_text.key, ', '::text) AS string_agg
                      FROM json_each_text(a.dias_uso) json_each_text(key, value)
                      WHERE json_each_text.value = 'true'::text) AS dias_uso,
                  (a.horario_uso_desde || '-'::text) || a.horario_uso_hasta AS horario_uso,
                  a.platos_excluidos,
                  CASE
                      WHEN ben_porcentaje IS NOT NULL THEN '% DE DESCUENTO'
                      WHEN ben_monto IS NOT NULL THEN 'MONTO DE DESCUENTO'
                      WHEN ben_plato IS NOT NULL THEN 'PLATO GRATIS'
                  END AS tipo_beneficio,
                  COALESCE(a.ben_porcentaje, a.ben_monto, a.ben_plato) AS beneficio,
                      CASE
                          WHEN a.factura THEN 'SI'::text
                          ELSE 'NO'::text
                      END AS factura,
                  a.num_factura,
                  a.fecha_factura,
                  a.monto_factura,
                  a.razon_social,
                  a.rut,
                  a.giro,
                  a.direccion,
                  a.created_id,
                  g.name AS creado_por,
                  a.anulado_por_id,
                  i.name as anulado_por,
                  a.fecha_anulacion,
                  a.motivo_anulacion,
                  a.mesonero as gift_mesonero,
                  a.tipo_beneficio as gift_tipo_beneficio,
                  a.beneficio as gift_beneficio,
                  a.mesa_id,
                  m.mesa,
                  a.n_cuenta,
                  a.adjunto,
                  a.nombre_comprador,
                  a.email_comprador,
                  a.telefono_comprador

              FROM giftcards a
                  LEFT JOIN gift_estados_pagos b ON b.id = a.estado_pago_id
                  LEFT JOIN gift_credito c ON c.id = a.credito_id
                  LEFT JOIN gift_formas_pagos d ON d.id = a.forma_pago_id
                  LEFT JOIN gift_mesoneros f ON f.id = a.mesonero_id
                  LEFT JOIN users g ON g.id = a.created_id
                  LEFT JOIN gift_estados h ON h.id = a.estado_id
                  LEFT JOIN users i ON  i.id = a.anulado_por_id
                  LEFT JOIN res_mesas m ON m.id = a.mesa_id

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
        Schema::dropIfExists('view_vgiftcards');
    }
}
