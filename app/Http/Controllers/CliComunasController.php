<?php

namespace App\Http\Controllers;

use App\Models\CliComunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class CliComunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = CliComunas::all('id','comuna');
        $data = [];
        foreach ($comunas as $key => $comuna) {
            $data[$key]['id'] = $comuna['id'];
            $data[$key]['comuna'] = $comuna['comuna'];
        }
        return view('clientes.comunas')->with('comunas',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $comunas = CliComunas::all('id','comuna');

        return $comunas;
        
        $data = [];
        $n =1;
        foreach ($comunas as $key => $comuna) {
            $data[$key]['id'] = $comuna['id'];
            $data[$key]['comuna'] = $comuna['comuna'];
            $data[$key]['acciones'] = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$n.'"><i class="fas fa-edit"></i></button>'.'<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$n.'"><i class="fas fa-trash"></i></button>';
            $n++;
        }
        return(json_encode($data));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = ([
                'comuna' => strtoupper($request->comuna),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            CliComunas::create($data);
			$message = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];            
            return(json_encode($res));
		} catch(\Exception $e) {
			$res[] = [
				'resultado' => 204,
				'status' => "0",
				'error' => $e->getMessage(),
				'mensaje' => 'error'
			];
			return json_encode($res);
		}        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CliComunas  $CliComunas
     * @return \Illuminate\Http\Response
     */
    public function show(CliComunas $CliComunas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CliComunas  $CliComunas
     * @return \Illuminate\Http\Response
     */
    public function edit(CliComunas $CliComunas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CliComunas  $CliComunas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CliComunas $CliComunas)
    {
        $data = ([
            'comuna' => strtoupper($request->comuna),
            'updated_at' => Carbon::now(),
        ]);
        try {
            CliComunas::where("id","=",$request->id)->update($data);
            $message = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            return($data);
        }catch(\Exception $e) {
			$res[] = [
				'resultado' => 204,
				'status' => "0",
				'error' => $e->getMessage(),
				'mensaje' => 'error'
			];
			return json_encode($res);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CliComunas  $CliComunas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval($id);
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            $message = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            $comuna = CliComunas::where("id","=",$id)->update($data);
            return json_encode($res);
		} catch(\Exception $e) {
			$res[] = [
				'resultado' => 204,
				'status' => "0",
				'error' => $e->getMessage(),
				'mensaje' => 'error'
			];
			return json_encode($res);
		}        
    }
}
