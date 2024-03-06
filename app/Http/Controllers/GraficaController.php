<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function index()
    {
        // $data = DB::select('SELECT estatus, total_casos FROM total_por_estatus');
        // return view('grafica', ['data' => $data]);
        $data = DB::select('SELECT estatus, total_casos FROM total_por_estatus');
        $jsonData = json_encode($data); // Convertir los datos a formato JSON
        // return view('grafica', ['jsonData' => $jsonData]);        
        return view('grafica', compact('jsonData'));
    }
}
