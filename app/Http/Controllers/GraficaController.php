<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT estatus, total_casos FROM total_por_estatus');
        $jsonData = json_encode($data);
        return view('grafica', compact('jsonData'));
    }
}
