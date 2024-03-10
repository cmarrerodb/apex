<?php

namespace Database\Seeders;

use App\Models\Vista;
use Illuminate\Database\Seeder;

class VistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vista::truncate();
        
        $items = [
            ['modulo' => 'Reservar', 'vista'               => 'Inicio'],
            ['modulo' => 'Reservar', 'vista'               => 'Listado de reservas'],
            ['modulo' => 'Reservar', 'vista'               => 'Extras'],
            ['modulo' => 'Reservar', 'vista'               => 'Bloqueos'],
            ['modulo' => 'Reservar', 'vista'               => 'Historial'],
            ['modulo' => 'Reservar', 'vista'               => 'Confirmaciones Automaticas'],
            ['modulo' => 'Giftcards', 'vista'              => 'Giftcards'],
            ['modulo' => 'Reservas', 'vista'               => 'Sucursales'],
            ['modulo' => 'Reservas', 'vista'               => 'Salones'],
            ['modulo' => 'Reservas', 'vista'               => 'Mesas'],
            ['modulo' => 'Reservas', 'vista'               => 'Tipo de Reservas'],
            ['modulo' => 'Reservas', 'vista'               => 'Razones de cancelación'],
            ['modulo' => 'Roles', 'vista'                  => 'Roles'],
            ['modulo' => 'Permisos', 'vista'               => 'Permisos'],
            ['modulo' => 'Asignar permisos a rol', 'vista' => 'Asignar permisos a rol'],
            ['modulo' => 'Usuarios', 'vista'               => 'Usuarios'],
            ['modulo' => 'Crm', 'vista'                    => 'Crm'],
            ['modulo' => 'Clientes', 'vista'               => 'Clientes'],
            ['modulo' => 'Clientes', 'vista'               => 'Tipos de Clientes'],
            ['modulo' => 'Clientes', 'vista'               => 'Categoría de Clientes'],
            ['modulo' => 'Giftcards', 'vista'              => 'Sincronizar'],
            ['modulo' => 'Giftcards', 'vista'              => 'Pagos'],
           
        ];

        foreach ($items as $item) {
            Vista::updateOrCreate(
                ['vista' => $item['vista'] ],
                $item
            );
        }
    }
}
