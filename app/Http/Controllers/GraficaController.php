<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function index()
    {
        $data1 = DB::select('SELECT estatus, total_casos FROM total_por_estatus');
        $jsonData1 = json_encode($data1);
    
        $data2 = DB::select('SELECT municipio, estatus, count(*) AS total_casos FROM casos GROUP BY municipio, estatus ORDER BY municipio DESC');
        $jsonData2 = json_encode($data2);

        $data3 = DB::select('SELECT genero, cant FROM vtotal_genero');
        $jsonData3 = json_encode($data3);

        $data4 = DB::select('SELECT grupo_etario, cantidad FROM vgrupos_etarios');
        $jsonData4 = json_encode($data4);

        return view('grafica', compact('jsonData1', 'jsonData2', 'jsonData3', 'jsonData4'));
    }
}
