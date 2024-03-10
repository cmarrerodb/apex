<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CliCategoriaClientes;

class CliCategoriaClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['categoria'=>'RESERVA','monto'=>250000,],
            ['categoria'=>'GRAN RESERVA','monto'=>500000,],
            ['categoria'=>'ICONO','monto'=>800000,],
        ];
        foreach ($items as $item) {

            CliCategoriaClientes::updateOrCreate(
                ['categoria' => $item['categoria'] ],
                $item
            );
        }
    }
}
