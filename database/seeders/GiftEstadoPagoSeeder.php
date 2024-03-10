<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftEstadosPago;
class GiftEstadoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['estado_pago'=>'PENDIENTE',],
            ['estado_pago'=>'PAGADA',],
            ['estado_pago'=>'ANULADA',],
            ['estado_pago'=>'RECHAZADO',],

        ];
        foreach ($items as $item) {
            GiftEstadosPago::firstOrcreate($item);
        }
    }
}
