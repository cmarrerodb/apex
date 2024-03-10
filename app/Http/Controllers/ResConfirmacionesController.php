<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ResSucursales;
use App\Models\ResConfirmaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResConfirmacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:ver configuraciones automaticas'])->only(['index']);
    }

    public function index()
    {
        // $data = ResConfirmaciones::get()->collect()->toArray();
        $sucursales = ResSucursales::get()->collect()->toArray();
        // dd($data);
        return view('confirmaciones.index', compact('sucursales'));
        // return view('confirmaciones.index')->with('confirmaciones',$data);
    }
    public function list() {
        $user = auth()->user();

        $data = ResConfirmaciones::select('res_confirmaciones.id', 'res_sucursales.sucursal', 'res_confirmaciones.fecha_confirmacion', 'res_confirmaciones.pax',
            DB::raw("CASE WHEN res_confirmaciones.turno = 1 THEN 'TARDE' WHEN res_confirmaciones.turno = 2 THEN 'NOCHE' ELSE '' END AS turno"),
            DB::raw("CASE WHEN res_confirmaciones.deleted_at IS NULL AND res_confirmaciones.fecha_confirmacion >= CURRENT_DATE  THEN 'ACTIVO' WHEN res_confirmaciones.deleted_at IS NOT NULL THEN 'INACTIVO' WHEN res_confirmaciones.fecha_confirmacion < CURRENT_DATE THEN 'PASADO' ELSE '' END AS estado")
        )->leftJoin('res_sucursales', 'res_sucursales.id', '=', 'res_confirmaciones.sucursal_id')
        ->orderBy('res_confirmaciones.id','DESC')
        ->get();

        $suc = $data;
        foreach ($suc as $key => $sc) {
            $editar = "";
            $eliminar ="";

            if($user->can('editar configuraciones automaticas')){
                $editar = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$data[$key]->id.'"><i class="fas fa-edit"></i></button>';
            }
            if($user->can('eliminar configuraciones automaticas')){
                $eliminar ='<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$data[$key]->id.'"><i class="fas fa-trash"></i></button>';
            }

            $data[$key]->acciones = $editar.$eliminar;
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
        $fechainicio = Carbon::parse($request->finicio);
        $fechafin = Carbon::parse($request->ffin);
        $diferencia_en_dias = $fechainicio->diffInDays($fechafin);
        DB::beginTransaction();
        try {
            $fecha_actual = $fechainicio;
            $fallos = [];
            for($i = 0; $i <= $diferencia_en_dias; $i++) {
                $data=[
                    'fecha_confirmacion'=> $fecha_actual,
                    'sucursal_id'=> $request->sucursal,
                    'turno'=> $request->turno,
                ];

                $registro = ResConfirmaciones::where($data)->first();
                if (!$registro) {
                    $data=[
                        'fecha_confirmacion'=> $fecha_actual,
                        'sucursal_id'=> $request->sucursal,
                        'turno'=> $request->turno,
                        'pax'=> $request->pax,
                    ];
                    $registro = ResConfirmaciones::create($data);
                } else {
                    array_push($fallos,$fecha_actual);
                }
                $fecha_actual = $fecha_actual->addDays(1);
            }
            $fechaInicio = Carbon::createFromFormat('Y-m-d', $request->finicio);
            $fechaFin = Carbon::createFromFormat('Y-m-d', $request->ffin);
            $fechaInicioFormateada = $fechaInicio->format('d/m/Y');
            $fechaFinFormateada = $fechaFin->format('d/m/Y');
            if (count($fallos) >0) {
                $mensaje = "Algunas de las confirmaciones no fueron creadas ya que existian previamente";
            } else {
                $mensaje = "Se han creado exitosamente las confirmaciones automáticas desde $fechaInicioFormateada hasta $fechaFinFormateada";
            }
             $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>$mensaje,
                'fallos' => count($fallos),
            ];
            DB::commit();
            return json_encode($res);
        } catch(\Exception $e) {
            DB::rollback();
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'mensaje' => 'error',
                'fallos' => 0,
            ];
            return json_encode($res);
        }
    }

    public function filtros(Request $request){

        $turno = $request->turno;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $estado = $request->estados;
        $sucursales = $request->sucursales;

        $rango = $desde && $hasta?[$desde,$hasta]:null;

        $data = ResConfirmaciones::select('res_confirmaciones.id', 'res_sucursales.sucursal', 'res_confirmaciones.fecha_confirmacion', 'res_confirmaciones.pax',
        DB::raw("CASE WHEN res_confirmaciones.turno = 1 THEN 'TARDE' WHEN res_confirmaciones.turno = 2 THEN 'NOCHE' ELSE '' END AS turno"),
        DB::raw("CASE WHEN res_confirmaciones.deleted_at IS NULL AND res_confirmaciones.fecha_confirmacion >= CURRENT_DATE  THEN 'ACTIVO' WHEN res_confirmaciones.deleted_at IS NOT NULL THEN 'INACTIVO' WHEN res_confirmaciones.fecha_confirmacion < CURRENT_DATE THEN 'PASADO' ELSE '' END AS estado")
        )
            ->when($turno, function ($query, $turno) {
                if ($turno == 'TARDE') {
                    return $query->where('turno', 1);
                } elseif ($turno == 'NOCHE') {
                    return $query->where('turno', 2);
                }
            })
            ->when($rango, function ($query, $rango) {
                return $query->whereBetween('fecha_confirmacion', $rango);
            })
            ->when($estado, function ($query, $estado) {
                if($estado=='ACTIVO'){
                    return $query->where('res_confirmaciones.deleted_at',NULL)->where('fecha_confirmacion','>=',date('Y-m-d'));
                }
                elseif($estado=='INACTIVO'){
                    return $query->where('res_confirmaciones.deleted_at',"!=",NULL) ;
                }
                elseif($estado=='PASADO'){

                    return $query->where('res_confirmaciones.deleted_at',NULL)->where('fecha_confirmacion','<',date('Y-m-d'));
                }

            })
            ->when($sucursales, function ($query, $sucursales) {
                return $query->where('sucursal_id', $sucursales);
            })
            ->leftJoin('res_sucursales', 'res_sucursales.id', '=', 'res_confirmaciones.sucursal_id')
            ->get();

            $suc = $data;
            foreach ($suc as $key => $sc) {
                $data[$key]->acciones = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$data[$key]->id.'"><i class="fas fa-edit"></i></button>'.'<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$data[$key]->id.'"><i class="fas fa-trash"></i></button>';
            }
            return(json_encode($data));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=[
            'fecha_confirmacion'=> $request->finicio,
            'sucursal_id'=> $request->sucursal,
            'turno'=> $request->turno,
        ];
        $fechaInicio = Carbon::createFromFormat('Y-m-d', $request->finicio);
        $fechaInicioFormateada = $fechaInicio->format('d/m/Y');
        DB::beginTransaction();
        try {

        $registro = ResConfirmaciones::where('id', '!=', $request->id)->where($data)->first();
        if (!$registro) {
            $data=[
                'fecha_confirmacion'=> $request->finicio,
                'sucursal_id'=> $request->sucursal,
                'turno'=> $request->turno,
                'pax'=> $request->pax,
            ];
            // $registro = ResConfirmaciones::create($data);
            $confirmaciones= ResConfirmaciones::where('id','=',$request->id)->update($data);
            $mensaje = "Se ha actualizado exitosamente la confirmación para la fecha $fechaInicioFormateada";
             $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>$mensaje,
            ];
            DB::commit();
            return json_encode($res);
        } else {
            DB::rollback();
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => 'No se pudo actualizar la confirmación porque ya existe una en la misma fecha, turno y sucursal',
                'mensaje' => 'Mensaje'
            ];
            return json_encode($res);
        }

        } catch(\Exception $e) {
            DB::rollback();
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
     * @param  int  $id
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
            ResConfirmaciones::where("id","=",$id)->update($data);
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
