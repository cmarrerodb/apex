<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResEstadosReservas;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller {
    public function index()
    {
        $data1 = DB::select('SELECT estatus, total_casos FROM total_por_estatus');
        $jsonData1 = json_encode($data1);
    
        $data2 = DB::select('SELECT municipio, estatus, count(*) AS total_casos FROM casos GROUP BY municipio, estatus ORDER BY municipio DESC');
        $jsonData2 = json_encode($data2);
        return view('grafica', compact('jsonData1', 'jsonData2'));
    }    
}
