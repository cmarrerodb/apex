<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ResSucursales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResSucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:ver sucursales'])->only(['index']);
    }
    public function index()
    {
        $data = DB::table('res_sucursales')->whereNull('deleted_at')->get()->collect()->toArray();
        return view('reservas.sucursales')->with('sucursales',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $user = Auth::user();

        $data = DB::table('res_sucursales')->select('id','sucursal')->whereNull('deleted_at')->get();

        return $data;
        
        // $suc = $data;
        // foreach ($suc as $key => $sc) {

        //     $editar ="";
        //     $eliminar ="";

        //     if($user->can('editar sucursales')){
        //         $editar = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$data[$key]->id.'"><i class="fas fa-edit"></i></button>';
        //     }
        //     if($user->can('eliminar sucursales')){
        //         $eliminar = '<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$data[$key]->id.'"><i class="fas fa-trash"></i></button>';
        //     }

        //     $data[$key]->acciones =  $editar. $eliminar ;
        // }
        // return(json_encode($data));
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
        $data = ([
            "sucursal" => $request->sucursal,
            "calendario" => 1,
            "fecha_inicio_calendario" => $request->fecha_ini,
            "fecha_fin_calendario" => $request->fecha_fin,
            'created_at' => Carbon::now(),
        ]);
        try {
            $mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            ResSucursales::insert($data);
            return(json_encode($res));
		} catch(\Exception $e) {
            unset($res);
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
     * @param  \App\Models\ResSucursales  $resSucursales
     * @return \Illuminate\Http\Response
     */
    public function show(ResSucursales $resSucursales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResSucursales  $resSucursales
     * @return \Illuminate\Http\Response
     */
    public function edit(ResSucursales $resSucursales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResSucursales  $resSucursales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResSucursales $resSucursales)
    {
        $data = ([
            "sucursal" => $request->sucursal,
            "calendario" => 1,
            "fecha_inicio_calendario" => $request->fecha_ini,
            "fecha_fin_calendario" => $request->fecha_fin,
            'updated_at' => Carbon::now(),
        ]);
        try {
            ResSucursales::where("id","=",$request->id)->update($data);
			$mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            return(json_encode($res));
		} catch(\Exception $e) {
            unset($res);
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
     * @param  \App\Models\ResSucursales  $resSucursales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
			$mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            ResSucursales::where("id","=",$id)->update($data);
            return json_encode($res);
		} catch(\Exception $e) {
            unset($res);
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
