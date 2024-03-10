<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsuarioRolUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            'name'            => 'Cliente User',
            'email'           => 'usuario@admin.com',
            'password'        => Hash::make('123456'),
            'avatar'          => 'avatar-1.jpg',
            'giftcard_ver'    => 1,
            'giftcard_crear'  => 1,
            'giftcard_anular' => 1,
            'noti_prereserva' => true,
            'noti_reserva'    => true,
        ];

        $usuario= User::updateOrCreate(
            ['email' => $data['email'] ],
            $data
        );
        $usuario->assignRole('Consulta');


        // $tecnico= User::updateOrCreate(
        //     ['email' => "tecnico@admin.com"],
        //     [
        //         'name'            => 'Tecnico User',
        //         'email'           => 'tecnico@admin.com',
        //         'password'        => Hash::make('123456'),
        //         'avatar'          => 'avatar-1.jpg',
        //         'giftcard_ver'    => 1,
        //         'giftcard_crear'  => 1,
        //         'giftcard_anular' => 1,
        //         'noti_prereserva' => true,
        //         'noti_reserva'    => true,
        //     ]
        // );

    }
}
