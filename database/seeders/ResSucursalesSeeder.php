<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResSucursales;
class ResSucursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id'=>1,'sucursal'=>'PATIO','calendario'=>1,'fecha_inicio_calendario'=>'2018-08-01','fecha_fin_calendario'=>'2030-12-31'],
            ['id'=>2,'sucursal'=>'VIVO','calendario'=>1,'fecha_inicio_calendario'=>'2018-09-01','fecha_fin_calendario'=>'2030-12-31'],
            ['id'=>4,'sucursal'=>'FERIA','calendario'=>1,'fecha_inicio_calendario'=>'2020-03-21','fecha_fin_calendario'=>'2020-03-21'],        
        ];
        foreach ($items as $item) {
            ResSucursales::firstOrcreate($item);
        }
    }
}
