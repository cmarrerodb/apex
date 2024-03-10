<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ResMesas;
use App\Models\ResSalones;
use Illuminate\Http\Request;
use App\Models\ResSucursales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResSalonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:ver salones'])->only(['index']);
    }
    public function index()
    {
        $data = DB::table('vsalones')->get()->collect()->toArray();
        return view('reservas.salones')->with('salones',$data);
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
        $data = DB::table('vsalones')->get()->collect()->toArray();
        $suc = $data;
        foreach ($suc as $key => $sc) {
            $editar ="";
            $eliminar ="";

            if($user->can('editar salones')){

                $editar = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$data[$key]->id.'"><i class="fas fa-edit"></i></button>';
            }

            if($user->can('eliminar salones')){
                $eliminar = '<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$data[$key]->id.'"><i class="fas fa-trash"></i></button>';
            }

            $data[$key]->acciones = $editar. $eliminar ;
        }
        return(json_encode($data));
    }

    public function sucursal_salones($id) {
        // $sucursales = ResSucursales::find($id);

        $sucursales_salones = ResSalones::whereSucursalId($id)->get();

        return $sucursales_salones;

        // return json_encode($sucursales->salones->all());
    }

    public function salones_mesas($id="") {
        $salones = DB::table('vmesas')->select('mesa_id','mesa')
        ->when($id, function ($query, $id) {
            return $query->where('salon_id', $id);
        })
        ->orderBy('mesa')
        ->get()
        ->collect()
        ->toArray();

        return json_encode($salones);
    }

    public function salones_mesas_crm($id) {
        $said = explode(",", $id);
        $iaid = array_map('intval',$said);
        $mesas = DB::table('res_mesas')->whereIn('salon_id',$iaid)->get()->collect()->toArray();
        return json_encode($mesas);
    }

    public function store(Request $request)
    {
        $data = ([
            "salon" => $request->salon,
            "sucursal_id" => $request->sucursal,
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
            ResSalones::insert($data);
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
     * @param  \App\Models\ResSalones  $resSalones
     * @return \Illuminate\Http\Response
     */
    public function show(ResSalones $resSalones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResSalones  $resSalones
     * @return \Illuminate\Http\Response
     */
    public function edit(ResSalones $resSalones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResSalones  $resSalones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResSalones $resSalones)
    {
        $data = ([
            "salon" => $request->salon,
            "sucursal_id" => $request->sucursal,
            'updated_at' => Carbon::now(),
        ]);
        try {
            ResSalones::where("id","=",$request->id)->update($data);
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
     * @param  \App\Models\ResSalones  $resSalones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            ResSalones::where("id","=",$id)->update($data);
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
