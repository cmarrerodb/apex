<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ResTipoReservas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResTipoReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:ver tipos de reservas'])->only(['index']);
    }

    public function index()
    {
        $tipos = ResTipoReservas::all('id','estado','color_class');
        $data = [];
        foreach ($tipos as $key => $tipo) {
            $data[$key]['id'] = $tipo['id'];
            $data[$key]['estado'] = $tipo['estado'];
            $data[$key]['color_class'] = $tipo['color_class'];
        }
        return view('reservas.tipos')->with('tipos',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $user = Auth::user();
        $tipos = ResTipoReservas::all('id','estado','color_class');
        $data = [];
        $n =1;

        foreach ($tipos as $key => $tipo) {
            $editar ="";
            $eliminar ="";


            if($user->can('editar tipos de reservas')){
                $editar ='<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$n.'" data-tipo="'.$tipo['estado'].'" data-color="'.$tipo['color_class'].'"><i class="fas fa-edit"></i></button>';
            }

            if($user->can('eliminar tipos de reservas')){
                $eliminar ='<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$n.'"><i class="fas fa-trash"></i></button>';
            }

            $data[$key]['id'] = $tipo['id'];
            $data[$key]['tipo'] = $tipo['estado'];
            $data[$key]['color_class'] = $tipo['color_class'];

            $data[$key]['acciones'] = $editar . $eliminar;
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
            'color_class' => strtolower($request->color_class),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        try {
            ResTipoReservas::create($data);
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
     * @param  \App\Models\ResTipoReservas  $resTipoReservas
     * @return \Illuminate\Http\Response
     */
    public function show(ResTipoReservas $resTipoReservas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResTipoReservas  $resTipoReservas
     * @return \Illuminate\Http\Response
     */
    public function edit(ResTipoReservas $resTipoReservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResTipoReservas  $resTipoReservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResTipoReservas $resTipoReservas)
    {
        $data = ([
            'estado' => strtoupper($request->tipo),
            'color_class' => strtolower($request->color_class),
            'updated_at' => Carbon::now(),
        ]);
        try {
            $tipo = ResTipoReservas::where("id","=",$request->id)->update($data);
			$mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
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
     * @param  \App\Models\ResTipoReservas  $resTipoReservas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval($id);
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            ResTipoReservas::where("id","=",$id)->update($data);
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
