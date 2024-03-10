<?php

namespace Database\Seeders;

use File;
use App\Models\User;
use App\Models\Reservas;
use App\Models\ResSalones;
use App\Models\ResSucursales;
use App\Models\ResTipoReservas;
use Illuminate\Database\Seeder;
use App\Models\ResEstadosReservas;

class ImportarReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $json = File::get("database/data/reservas_desde_01_09_23.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            // Buscamos el usuario
            $user_id = User::where('name', $obj->usuario)->pluck('id')->first();

            // Buscamos el tipo de reserva
            $tipo_reserva_id = ResTipoReservas::where('estado', $obj->tipo)->pluck('id')->first();

            // Buscamos nuestros estados y lo comparamos
            $estado_id = ResEstadosReservas::where('estado', $obj->estado)->pluck('id')->first();

            //Buscamos la sucursal
            $sucursal_id = ResSucursales::where('sucursal', $obj->sucursal)->pluck('id')->first();

            // Buscamos el salon 
            $salon_id = ResSalones::where('salon', $obj->salon1)->pluck('id')->first();
          

            Reservas::firstOrcreate(
                [
                    'fecha_reserva'                  => $obj->fecha_reserva,
                    'hora_reserva'                   => $obj->hora_reserva.":00",
                    'nombre_cliente'                 => $obj->nombre_cliente,
                    'nombre_empresa'                 => $obj->nombre_empresa,
                    'fecha_ultima_modificacion'      => $obj->fecha_ultima_modificacion,
                    'nombre_hotel'                   => $obj->nombre_hotel,
                    'cantidad_pasajeros'             => $obj->cantidad_pasajeros,
                    'telefono_cliente'               => $obj->telefono_cliente,
                    'salon'                          => $salon_id,
                    'tipo_reserva'                   => $tipo_reserva_id,
                    "email_cliente"                  => $obj->email_cliente,
                    "estado"                         => $estado_id ,
                    "dianoche"                       => $obj->dianoche,
                    "evento_nombre_adicional"        => $obj->evento_nombre_adicional,
                    "evento_pax"                     => $obj->evento_pax ,
                    "evento_valor_menu"              => $obj->evento_valor_menu ,
                    "usuario_registro"               => $user_id,
                    "evento_total_sin_propina"       => $obj->evento_total_sin_propina,                    
                    "evento_total_propina"           => $obj->evento_total_propina,
                    "evento_email_contacto"          => $obj->evento_email_contacto,
                    "evento_anticipo"                => $obj->evento_anticipo,
                    "evento_telefono_contacto"       => $obj->evento_telefono_contacto,

                    // "evento_paga_en_local"           => $obj->evento_paga_en_local==null ?'':$obj->evento_paga_en_local,
                    // "evento_audio"                   => $obj->evento_audio== null ?'':$obj->evento_audio,

                    // "evento_video"                   => $obj->evento_video ==null ?'':$obj->evento_video,
                    // "evento_video_audio"             => $obj->evento_video_audio==null?'':$obj->evento_video_audio,
                    "evento_restriccion_alimenticia" => $obj->evento_restriccion_alimenticia,
                    "evento_monta"                   => $obj->evento_monta,
                    "evento_ubicacion"               => $obj->evento_ubicacion,
                    "evento_detalle_restriccion"     => $obj->evento_detalle_restriccion,
                    "ambiente"                       => $obj->ambiente,
                    "fecha_confirmacion"             => $obj->fecha_confirmacion,
                    "evento_logo"                    => $obj->evento_logo,
                    "evento_table_tent"              => $obj->evento_table_tent,
                    "sucursal"                       => $sucursal_id,
                    "observaciones"                  => $obj->observaciones
                ]
            );
        }
    }
}
