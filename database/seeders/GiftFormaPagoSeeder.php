<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftFormasPago;
class GiftFormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['forma_pago'=>'EFECTIVO'],
            ['forma_pago'=>'DEBITO'],
            ['forma_pago'=>'CRÉDITO'],
            ['forma_pago'=>'TRANSFERENCIA'],
            ['forma_pago'=>'CHEQUE'],
            ['forma_pago'=>'CRÉDITO TIENDA'],
            ['forma_pago'=>'CRÉDITO PORTAL'],
            ['forma_pago'=>'REGALO'],
        ];
        foreach ($items as $item) {
            GiftFormasPago::firstOrcreate($item);
        }
    }
}
