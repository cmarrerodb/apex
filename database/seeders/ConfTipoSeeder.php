<?php

namespace Database\Seeders;

use App\Models\ConfTipo;
use Illuminate\Database\Seeder;

class ConfTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre'=>'Refresh'],
            ['nombre'=>'Notificación'],
            ['nombre'=>'Columnas'],
            ['nombre'=>'Notificación giftcard no usada - beneficiario'],
            ['nombre'=>'Notificación compra con transferencia'],            

        ];

        foreach ($items as $item) {
            ConfTipo::updateOrCreate(
                ['nombre' => $item['nombre'] ],
                $item
            );
        }
    }
}
