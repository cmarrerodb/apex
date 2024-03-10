<?php

namespace Database\Seeders;

use File;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserReservaPrincipalSeeder extends Seeder
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

        $user_id = 5; // Empieza en 5

        foreach ($data as $obj) {

            $email = strtolower($obj->usuario). "@admin.com";
           
            $usuario= User::updateOrCreate(

                ['email' => $email],
                [
                    'id'              => $user_id,
                    'name'            => $obj->usuario,
                    'email'           => $email,
                    'password'        => Hash::make('123456'),
                    'avatar'          => 'avatar-1.jpg',
                    'giftcard_ver'    => 1,
                    'giftcard_crear'  => 1,
                    'giftcard_anular' => 1,
                    'noti_prereserva' => true,
                    'noti_reserva'    => true,
                ]
            );

            $usuario->assignRole('Consulta');

            $user_id++;
        }       
    }

}
