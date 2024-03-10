<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResRazonCancelacion;
class ResRazonCancelacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id'=>1,'razon'=>'PRUEBA IT','notificar_cliente'=>0],
            ['id'=>2,'razon'=>'CLIENTE AVISA','notificar_cliente'=>0],
            ['id'=>3,'razon'=>'CANCELACION EVENTO','notificar_cliente'=>0],
            ['id'=>4,'razon'=>'RESERVA DUPLICADA','notificar_cliente'=>0],
        ];
        foreach ($items as $item) {
            ResRazonCancelacion::firstOrcreate($item);
        }
    }
}
