<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfiguracionGlobal;

class ConfiguracionGlobalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =[
            [
                'name'        => 'Recordatorio de Giftcard no usada del beneficiario',
                'tipo_id'     => 4, // Notificación giftcard no usada - beneficiario
                'valor'       => 15, //   
                'vista_id'    => 7, //Giftcard
                'descripcion' => 'Esta notificación envía recordatorio al beneficiario que no ha usada su giftcard, antes de vencerse los días indicados en el valor del formulario',
                'email'       => '',
                'duracion'    => 'Dias',
                'activo'      => 1,

            ],
            [
                'name'        => 'Revisión de compra con transferencia',
                'tipo_id'     => 5, // Notificación compra transferencia
                'valor'       => "",                
                'vista_id'    => 7, //Giftcard
                'descripcion' => 'Enviar email a administradores informando revisión de compra con transferencia',
                'email'       => 'karen.milgram@gmail.com',
                'duracion'    => '',
                'activo'      => 1,
            ],           
            
        ];
    
        foreach ($items as $item) {
            ConfiguracionGlobal::updateOrCreate(
                ['name' => $item['name'] ],
                $item
            );
        }

    }
}
