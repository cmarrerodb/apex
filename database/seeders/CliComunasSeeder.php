<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CliComunas;
class CliComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' =>1,'comuna'=>'antiago',],
            ['id' =>2,'comuna'=>'errillos',],
            ['id' =>3,'comuna'=>'erro Navia',],
            ['id' =>4,'comuna'=>'onchalí',],
            ['id' =>5,'comuna'=>'l Bosque',],
            ['id' =>6,'comuna'=>'stación Central',],
            ['id' =>7,'comuna'=>'uechuraba',],
            ['id' =>8,'comuna'=>'ndependencia',],
            ['id' =>9,'comuna'=>'a Cisterna',],
            ['id' =>10,'comuna'=>'La Florida',],
            ['id' =>11,'comuna'=>'La Granja',],
            ['id' =>12,'comuna'=>'La Pintana',],
            ['id' =>13,'comuna'=>'La Reina',],
            ['id' =>14,'comuna'=>'Las Condes',],
            ['id' =>15,'comuna'=>'Lo Barnechea',],
            ['id' =>16,'comuna'=>'Lo Espejo',],
            ['id' =>17,'comuna'=>'Lo Prado',],
            ['id' =>18,'comuna'=>'Macul',],
            ['id' =>19,'comuna'=>'Maipú',],
            ['id' =>20,'comuna'=>'Ñuñoa',],
            ['id' =>21,'comuna'=>'Pedro Aguirre Cerda',],
            ['id' =>22,'comuna'=>'Peñalolén',],
            ['id' =>23,'comuna'=>'Providencia',],
            ['id' =>24,'comuna'=>'Pudahuel',],
            ['id' =>25,'comuna'=>'Quilicura',],
            ['id' =>26,'comuna'=>'Quinta Normal',],
            ['id' =>27,'comuna'=>'Recoleta',],
            ['id' =>28,'comuna'=>'Renca',],
            ['id' =>29,'comuna'=>'San Joaquín',],
            ['id' =>30,'comuna'=>'San Miguel',],
            ['id' =>31,'comuna'=>'San Ramón',],
            ['id' =>32,'comuna'=>'Vitacura',],
            ['id' =>33,'comuna'=>'Puente Alto',],
            ['id' =>34,'comuna'=>'Pirque',],
            ['id' =>35,'comuna'=>'San José de Maipo',],
            ['id' =>36,'comuna'=>'Colina',],
            ['id' =>37,'comuna'=>'Lampa',],
            ['id' =>38,'comuna'=>'Til til',],
            ['id' =>39,'comuna'=>'San Bernardo',],
            ['id' =>40,'comuna'=>'Buin',],
            ['id' =>41,'comuna'=>'Calera de Tango',],
            ['id' =>42,'comuna'=>'Paine',],
            ['id' =>43,'comuna'=>'Melipilla',],
            ['id' =>44,'comuna'=>'Alhué',],        
        ];
        foreach ($items as $item) {
            CliComunas::firstOrcreate($item);
        }
    }
}
