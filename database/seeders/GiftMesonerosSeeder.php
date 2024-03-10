<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftMesonero;
class GiftMesonerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            ['mesonero'=>'JOSÉ PÉREZ',],
            ['mesonero'=>'LUIS GARCÍA',],
            ['mesonero'=>'DAVID NIEVES',],
            ['mesonero'=>'ELENA GÓMEZ',],
            ['mesonero'=>'ANA GARCÍA',],
        ];
        foreach ($items as $item) {
            GiftMesonero::firstOrcreate($item);
        }    
    }
}
