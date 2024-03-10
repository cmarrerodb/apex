<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewVclientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS vclientes CASCADE;');
        DB::statement("CREATE OR REPLACE VIEW vclientes as 
                SELECT 
                    a.id,
                    a.nombre,
                    a.rut,
                    a.fecha_nacimiento,
                    a.telefono,
                    a.direccion,
                    a.comuna_id,
                    b.comuna,
                    a.categoria_id,
                    c.categoria,
                    a.tipo_id,
	                d.tipo,
                    a.numero_tarjeta,
                    a.email,
                    a.empresa,
                    a.hotel,
                    a.vino_favorito_1,
                    a.vino_favorito_2,
                    a.vino_favorito_3,
                    a.foto,
                    a.referencia,
                    a.info_vina,
                    a.club,
                    a.created_at,
                    a.updated_at
                    FROM clientes a 
                    LEFT JOIN cli_comunas b ON b.id=a.comuna_id
                    LEFT JOIN cli_categoria_clientes c ON c.id=a.categoria_id
                    LEFT JOIN cli_tipos_clientes d ON d.id = a.tipo_id
                    WHERE a.deleted_at IS NULL
                    ORDER BY a.id ASC;
                ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vclientes;");
    }
}
