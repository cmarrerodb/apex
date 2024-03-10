<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResMesas;
use Illuminate\Support\Facades\DB;
class ResMesasSeeder extends Seeder


{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('TRUNCATE TABLE res_mesas RESTART IDENTITY;');
        $items = [
            ['id'=>1,'sucursal_id'=>2,'salon_id'=>13,'mesa'=>97,'capacidad'=>2,],
            ['id'=>2,'sucursal_id'=>2,'salon_id'=>13,'mesa'=>401,'capacidad'=>6,],
            ['id'=>3,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>46,'capacidad'=>6,],
            ['id'=>4,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>78,'capacidad'=>4,],
            ['id'=>5,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>79,'capacidad'=>4,],
            ['id'=>6,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>80,'capacidad'=>4,],
            ['id'=>7,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>81,'capacidad'=>4,],
            ['id'=>8,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>82,'capacidad'=>4,],
            ['id'=>9,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>83,'capacidad'=>4,],
            ['id'=>10,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>84,'capacidad'=>2,],
            ['id'=>11,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>85,'capacidad'=>4,],
            ['id'=>12,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>90,'capacidad'=>4,],
            ['id'=>13,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>91,'capacidad'=>1,],
            ['id'=>14,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>92,'capacidad'=>1,],
            ['id'=>15,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>93,'capacidad'=>1,],
            ['id'=>16,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>94,'capacidad'=>1,],
            ['id'=>17,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>95,'capacidad'=>1,],
            ['id'=>18,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>96,'capacidad'=>1,],
            ['id'=>19,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>98,'capacidad'=>1,],
            ['id'=>20,'sucursal_id'=>2,'salon_id'=>12,'mesa'=>99,'capacidad'=>1,],
            ['id'=>77,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>30,'capacidad'=>8,],
            ['id'=>78,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>33,'capacidad'=>8,],
            ['id'=>79,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>31,'capacidad'=>4,],
            ['id'=>80,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>32,'capacidad'=>4,],
            ['id'=>81,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>10,'capacidad'=>4,],
            ['id'=>82,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>11,'capacidad'=>4,],
            ['id'=>83,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>12,'capacidad'=>4,],
            ['id'=>84,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>13,'capacidad'=>4,],
            ['id'=>85,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>14,'capacidad'=>2,],
            ['id'=>86,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>15,'capacidad'=>4,],
            ['id'=>87,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>20,'capacidad'=>2,],
            ['id'=>88,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>21,'capacidad'=>2,],
            ['id'=>89,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>22,'capacidad'=>4,],
            ['id'=>90,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>23,'capacidad'=>2,],
            ['id'=>91,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>24,'capacidad'=>4,],
            ['id'=>92,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>25,'capacidad'=>4,],
            ['id'=>93,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>1,'capacidad'=>2,],
            ['id'=>94,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>2,'capacidad'=>2,],
            ['id'=>95,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>3,'capacidad'=>2,],
            ['id'=>96,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>4,'capacidad'=>2,],
            ['id'=>97,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>60,'capacidad'=>2,],
            ['id'=>98,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>61,'capacidad'=>2,],
            ['id'=>99,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>62,'capacidad'=>2,],
            ['id'=>100,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>63,'capacidad'=>4,],
            ['id'=>101,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>64,'capacidad'=>4,],
            ['id'=>102,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>200,'capacidad'=>2,],
            ['id'=>122,'sucursal_id'=>2,'salon_id'=>7,'mesa'=>27,'capacidad'=>2,],
        ];
        foreach ($items as $item) {
            ResMesas::firstOrcreate($item);
        }
    }
}