<?php

namespace Database\Seeders;

use File;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json =  File::get("database/data/usuarios_202311141855.json");

        $data =  json_decode($json);

        $user_id =  5; // Empieza en 5

        foreach ($data as $obj) {            
           
            $usuario = User::updateOrCreate(

                ['email'              => $obj->email ],
                [
                    'id'              => $user_id,
                    'name'            => $obj->nombre,
                    'username'        => $obj->usuario,
                    'email'           => $obj->email,
                    'password'        => Hash::make($obj->clave),
                    'avatar'          => 'avatar-1.jpg',
                    'giftcard_ver'    => 1,
                    'giftcard_crear'  => 1,
                    'giftcard_anular' => 1,
                    'noti_prereserva' => true,
                    'noti_reserva'    => true,
                    'password_old'    => $obj->clave,
                ]
            );

            switch ($obj->tipo_usuario) {
                case 1 : $usuario->assignRole('SuperUsuario');                   
                    break;

                case 2 : $usuario->assignRole('Administrador Reservas');               
                    break; 
                
                case 3 : $usuario->assignRole('Tomador Reservas');               
                    break; 

                case 4 : $usuario->assignRole('Consulta');               
                    break; 

                default: $usuario->assignRole('Consulta');                                     
                    break;
            }            

            $user_id++;
            
        }       
    
    }
}
