<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResTipoReservas;
use Illuminate\Support\Facades\DB;
class ResTipoReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE TABLE res_tipo_reservas RESTART IDENTITY;');
        $items = [
            ['id'=>1,'estado'=>'REGULAR','color_class'=>'bg-success'],
            ['id'=>2,'estado'=>'EVENTO','color_class'=>'bg-secondary'],
            ['id'=>3,'estado'=>'CORTESIA','color_class'=>'bg-danger'],
            ['id'=>4,'estado'=>'RESTORANDO','color_class'=>'bg-dark'],
            ['id'=>5,'estado'=>'FERIA','color_class'=>'bg-ocre1'],
            ['id'=>6,'estado'=>'PRESENTADOR','color_class'=>'bg-ocre2'],
            ['id'=>7,'estado'=>'DELIVERY','color_class'=>'bg-primary'],
            ['id'=>8,'estado'=>'PRERESERVA','color_class'=>'bg-grey1'],
        ];

        foreach ($items as $item) {
            ResTipoReservas::updateOrCreate(
                ['id' => $item['id'] ],
                $item
            );
        }
    }
}
