<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftCredito;

class GiftCreditosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['credito'=>'SI',],
            ['credito'=>'NO',],
            ['credito'=>'REGALO',],
        ];
        foreach ($items as $item) {
            GiftCredito::firstOrcreate($item);
        }
    }
}
