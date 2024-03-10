<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CliTiposClientes;
class CliTiposClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id'=>1,'tipo'=>'REGULAR',],
            ['id'=>4,'tipo'=>'CENA MARIDAJE',],
        ];
        foreach ($items as $item) {
            CliTiposClientes::firstOrcreate($item);
        }
    }
}
