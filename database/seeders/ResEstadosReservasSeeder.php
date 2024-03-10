<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResEstadosReservas;
class ResEstadosReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id'=>1,'estado'=>'Pendiente'],
            ['id'=>2,'estado'=>'Confirmada'],
            ['id'=>3,'estado'=>'Aceptada'], // cambiada de Realizada a Aceptada
            ['id'=>4,'estado'=>'Cancelada'],
            ['id'=>5,'estado'=>'Sentada'],
            ['id'=>6,'estado'=>'Pagada'],
            ['id'=>7,'estado'=>'No Show'],
            ['id'=>8,'estado'=>'Rechazada'],
            ['id'=>9,'estado'=>'Solicitud_Web'],
            ['id'=>10,'estado'=>'Por Despachar'],
            ['id'=>11,'estado'=>'Despachada'],
            ['id'=>12,'estado'=>'Lista Espera'],
        ];
        foreach ($items as $item) {
            ResEstadosReservas::firstOrcreate($item);
        }
    }
}
