<?php

namespace Database\Seeders;

use App\Models\GbVista;
use Illuminate\Database\Seeder;

class GbVistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name'=>'Giftcards', 'modulo'=>'Giftcard',],
            ['name'=>'Sinronizar', 'modulo'=>'Giftcard',],
            ['name'=>'Pagos', 'modulo'=>'Giftcard',],           
        ];
        foreach ($items as $item) {
            GbVista::firstOrcreate($item);
        }
    }
}
