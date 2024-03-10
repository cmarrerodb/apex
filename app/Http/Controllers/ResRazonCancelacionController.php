<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ResRazonCancelacion;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResRazonCancelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware(['permission:ver razones cancelacion'])->only(['index']);
    }
    public function index()
    {
        $razones = ResRazonCancelacion::all('id','razon','notificar_cliente');
        $data = [];
        foreach ($razones as $key => $razon) {
            $data[$key]['id'] = $razon['id'];
            $data[$key]['razon'] = $razon['razon'];
            $data[$key]['notificar_cliente'] = $razon['notificar_cliente'];
        }
        return view('reservas.razones')->with('razones',$data);
    }
    public function list() {
        $user = Auth::user();
        $razones = ResRazonCancelacion::all('id','razon','notificar_cliente');
        // dd($razones);
        $data = [];
        $n =1;
        foreach ($razones as $key => $razon) {
            $editar ="";
            $eliminar ="";

            if($user->can('editar razones cancelacion')){
                $editar ='<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$n.'"><i class="fas fa-edit"></i></button>';
            }

            if($user->can('eliminar razones cancelacion')){
                $eliminar ='<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$n.'"><i class="fas fa-trash"></i></button>';
            }
            $data[$key]['id'] = $razon['id'];
            $data[$key]['razon'] = $razon['razon'];
            $data[$key]['notificar_cliente'] = $razon['notificar_cliente'];
            $data[$key]['acciones'] = $editar . $eliminar;
            $n++;
        }
        return(json_encode($data));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
            'razon' => strtoupper($request->razon),
            'notificar_cliente' => strtoupper($request->notificar_cliente),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        try {
            ResRazonCancelacion::create($data);
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
     * Display the specified resource.
     *
     * @param  \App\Models\ResRazonCancelacion  $resRazonCancelacion
     * @return \Illuminate\Http\Response
     */
    public function show(ResRazonCancelacion $resRazonCancelacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResRazonCancelacion  $resRazonCancelacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ResRazonCancelacion $resRazonCancelacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResRazonCancelacion  $resRazonCancelacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResRazonCancelacion $resRazonCancelacion)
    {
        $data = ([
            'razon' => $request->razon,
            'notificar_cliente' => $request->notificar_cliente,
            'updated_at' => Carbon::now(),
        ]);
        try {
            $mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
             ResRazonCancelacion::where("id","=",$request->id)->update($data);
            return($res);
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
     * @param  \App\Models\ResRazonCancelacion  $resRazonCancelacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval($id);
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            ResRazonCancelacion::where("id","=",$id)->update($data);
            $mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
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
