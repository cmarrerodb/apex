<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftEstados;

class GiftEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['estado'=>'DISPONIBLE',],
            ['estado'=>'USADA',],
            ['estado'=>'ANULADA',],
            ['estado'=>'VENCIDA',],
            ['estado'=>'PENDIENTE PAGO',],

        ];
        foreach ($items as $item) {
            GiftEstados::firstOrcreate($item);
        }
    }
}
