<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Funciones;

class EmailEnviadoController extends Controller
{
    use Funciones;

    public function index (Request $request){

        // return env('SENDINBLUE_API_KEY');
        // return env('SENDINBLUE_API_KEY_ESTADISTICA');
       

        return view('email-enviados.index');

    }

    public function list(Request $request){

        $default = [
            'limit'=> 2000,
            'offset' => 0,
            'sort' => 'desc',
        ];
        $filter = $request->all();

        $filter_result = array_merge($default, $filter);

        $result  = $this->sendEstadisticas($filter_result);

        $datos = json_decode($result);

        $data=[];

        // return $result;

        // $data=[
        //     [
        //         'email'=>'admin@mi.com',
        //         'name' =>'Nombres'
        //     ],
        //     [
        //         'email'=>'admin2@mi.com',
        //         'name' =>'Nombres2222'
        //     ]
        // ];

        // return $data;

        foreach ($datos as $key => $value) {
           $data=$value;
        }

        return $data;

    }
}
