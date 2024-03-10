<?php

namespace Database\Seeders;

use File;
use Throwable;
use App\Models\Clientes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
    
        // Clientes::truncate();

        // Este seeder es importante correrlo solo una vez 

        $json =  File::get("database/data/clientes_202311230849.json");

        $data =  json_decode($json);

        foreach ($data as $obj) { 

            $telefono_sin_espacio = str_replace(" ", "", $obj->telefono);
            $telefonoPreparado = substr( $telefono_sin_espacio, 0, 15);

            $cliente = new Clientes;
            $cliente->nombre           = $obj->nombre;
            $cliente->rut              = $obj->rut;          
            $cliente->telefono         = $telefonoPreparado;
            $cliente->direccion        = $obj->direccion;
            $cliente->nombre           = $obj->nombre;

            if($obj->fecha_nacimiento!=null || $obj->fecha_nacimiento!=""){
                $obj->fecha_nacimiento = $obj->fecha_nacimiento;
            }

            if($obj->comuna!=null || $obj->comuna!=""){
                $cliente->comuna_id = $obj->comuna;
            }

            if($obj->tipo!=null || $obj->tipo!=""){
                if($obj->tipo=="4,1")
                $cliente->tipo_id = $obj->tipo == "4,1" ?4 :$obj->tipo;
            }
            
            $cliente->numero_tarjeta   = $obj->numero_tarjeta;
            $cliente->email            = $obj->email;
            $cliente->empresa          = $obj->empresa;
            $cliente->hotel            = $obj->hotel;
            $cliente->vino_favorito_1  = $obj->vino_favorito_1;
            $cliente->vino_favorito_2  = $obj->vino_favorito_2;
            $cliente->vino_favorito_3  = $obj->vino_favorito_3;
            $cliente->foto             = $obj->foto;
            $cliente->referencia       = $obj->referencia;
            $cliente->info_vina        = $obj->info_vina;
            $cliente->club             = $obj->club;    
            $cliente->save();                
        }

    }
}
