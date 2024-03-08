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
        return view('grafica', compact('jsonData1', 'jsonData2'));
    }
}
