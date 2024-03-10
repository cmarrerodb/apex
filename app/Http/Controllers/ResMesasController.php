<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ResMesas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResMesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:ver mesas'])->only(['index']);
    }

    public function index()
    {
        $data = DB::table('vmesas')->get()->collect()->toArray();
        return view('reservas.mesas')->with('mesas',$data);
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
    public function list() {
        $user = Auth::user();

        $data = DB::table('vmesas')->get()->collect()->toArray();
        $mesas = $data;
        foreach ($mesas as $key => $ms) {

            $editar ="";
            $eliminar ="";

            if($user->can('editar mesas')){
                $editar = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$data[$key]->mesa_id.'" data-sucursal_id="'.$ms->sucursal_id.'" data-salon_id="'.$ms->salon_id.'" data-mesa="'.$ms->mesa.'" data-capacidad="'.$ms->capacidad.'" ><i class="fas fa-edit"></i></button>';
            }

            if($user->can('eliminar mesas')){
                $eliminar = '<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$data[$key]->mesa_id.'"><i class="fas fa-trash"></i></button>';

            }
            $data[$key]->acciones = $editar. $eliminar;
        }
        return(json_encode($data));
    }
    public function store(Request $request)
    {
        $data = ([
            "mesa" => $request->mesa,
            "sucursal_id" => $request->sucursal,
            "salon_id" => $request->salon,
            "capacidad" => $request->capacidad,
            'created_at' => Carbon::now(),
        ]);
        // dd($data);
        try {
            $valida = ResMesas::where('sucursal_id', $request->sucursal)->where('mesa', $request->mesa)->get();

            if(count($valida)>0){
                $res[]=[
                    'resultado' => 204,
                    'status' => "0",
                    'error' => "Ya existe una mesa para esa sucursal, por favor intente con otra",
                    'mensaje' => 'error'
                ];

                return(json_encode($res));
            }

            ResMesas::insert($data);
            $mensaje = 'éxito';
                $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>$mensaje,
            ];
            return(json_encode($res));
        } catch (\Exception $e) {
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
     * @param  \App\Models\ResMesas  $resMesas
     * @return \Illuminate\Http\Response
     */
    public function show(ResMesas $resMesas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResMesas  $resMesas
     * @return \Illuminate\Http\Response
     */
    public function edit(ResMesas $resMesas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResMesas  $resMesas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResMesas $resMesas)
    {
        $data = ([
            "mesa" => $request->mesa,
            "sucursal_id" => $request->sucursal_id,
            "salon_id" => $request->salon_id,
            "capacidad" => $request->capacidad,
            'created_at' => Carbon::now(),
        ]);
        try {
            $valida = ResMesas::where('sucursal_id', $request->sucursal_id)
            ->where('mesa', $request->mesa)
            ->where('id','!=', $request->id)->get();

            if(count($valida)>0){
                $res[]=[
                    'resultado' => 204,
                    'status' => "0",
                    'error' => "Ya existe una mesa para esa sucursal, por favor intente con otra",
                    'mensaje' => 'error'
                ];

                return(json_encode($res));
            }

            ResMesas::where("id","=",$request->id)->update($data);
			$mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
			return json_encode($res);
        } catch (\Exception $e) {
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
     * @param  \App\Models\ResMesas  $resMesas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            ResMesas::where("id","=",$id)->update($data);
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
