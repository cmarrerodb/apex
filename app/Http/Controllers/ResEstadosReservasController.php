<?php

namespace App\Http\Controllers;

use App\Models\ResEstadosReservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class ResEstadosReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = ResEstadosReservas::all('id','estado');
        $data = [];
        foreach ($estados as $key => $estado) {
            $data[$key]['id'] = $estado['id'];
            $data[$key]['estado'] = $estado['estado'];
        }
        return view('reservas.estados')->with('estados',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $estados = ResEstadosReservas::all('id','estado');
        $data = [];
        $n =1;
        foreach ($estados as $key => $estado) {
            $data[$key]['id'] = $estado['id'];
            $data[$key]['estado'] = $estado['estado'];
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
        $data = ([
            'estado' => strtoupper($request->tipo),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        try {
            ResEstadosReservas::create($data);
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
     * @param  \App\Models\ResEstadosReservas  $resEstadosReservas
     * @return \Illuminate\Http\Response
     */
    public function show(ResEstadosReservas $resEstadosReservas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResEstadosReservas  $resEstadosReservas
     * @return \Illuminate\Http\Response
     */
    public function edit(ResEstadosReservas $resEstadosReservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResEstadosReservas  $resEstadosReservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResEstadosReservas $resEstadosReservas)
    {
        $data = ([
            'estado' => $request->estado,
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
            ResEstadosReservas::where("id","=",$request->id)->update($data);
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
     * @param  \App\Models\ResEstadosReservas  $resEstadosReservas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval($id);
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
            ResEstadosReservas::where("id","=",$id)->update($data);
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
