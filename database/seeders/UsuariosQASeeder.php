<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
 use App\Models\User;
 use Illuminate\Support\Facades\Hash;
class UsuariosQASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = [
             [
                'id'=>2,
                'name' => 'Reinaldo Castellanos',
                'email' => 'reinaldo.castellano.coneduca@gmail.com',
                'password' => Hash::make('123456'),
                'email_verified_at'=>'2022-01-02 17:04:58',
                'avatar' => 'avatar-1.jpg',
                // 'created_at' => now(),
                'giftcard_ver' => 1,
                'giftcard_crear' => 1,
                'giftcard_anular' => 1,
                'noti_prereserva' => true,
                'noti_reserva' => true,
             ],
            [
                'id'=>3,
                'name' => 'Alberto Bitran',
                'email' => 'abitran@zlogistik.com',
                'password' => Hash::make('bGmN%9C#'),
                'email_verified_at'=>'2022-01-02 17:04:58',
                'avatar' => 'avatar-1.jpg',
                // 'created_at' => now(),
                'giftcard_ver' => 1,
                'giftcard_crear' => 1,
                'giftcard_anular' => 1,
                'noti_prereserva' => true,
                'noti_reserva' => true,
            ],             
         ];

         foreach ($items as $item) {
             User::updateOrCreate(
                 ['id' => $item['id'] ],
                 $item
             );
         }
    }
}
