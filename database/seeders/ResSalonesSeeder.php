<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResSalones;
class ResSalonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id'=>7,'salon'=>'SALON PISO 1','sucursal_id'=>2,],
            ['id'=>10,'salon'=>'PATIO STBKS','sucursal_id'=>4,],
            ['id'=>11,'salon'=>'SALON EVENTOS','sucursal_id'=>2,],
            ['id'=>12,'salon'=>'TERRAZA FUMADOR','sucursal_id'=>2,],
            ['id'=>13,'salon'=>'TERRAZA NO FUMADOR','sucursal_id'=>2,],
            ['id'=>14,'salon'=>'TERRAZA TRASERA','sucursal_id'=>2,],
            ['id'=>15,'salon'=>'TERRAZA 2DO PISO','sucursal_id'=>2,],
            ['id'=>16,'salon'=>'SALON PISO 2','sucursal_id'=>2,],
        ];
        foreach ($items as $item) {
            ResSalones::firstOrcreate($item);
        }
    }
}
