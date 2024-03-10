<?php

namespace Database\Seeders;

use App\Models\GbAccionTipo;
use Illuminate\Database\Seeder;

class GbAccionTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [ 'name' => 'Insert', ],
            [ 'name' => 'Delete', ],
            [ 'name' => 'Update', ],
        ];
        foreach ($items as $item) {
            GbAccionTipo::firstOrcreate($item);
        }
    }
}
