<?php

namespace App\Http\Controllers;

set_time_limit(100);

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservas;
use App\Models\ResTipoReservas;
use App\Models\ResEstadosReservas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskCases = Reservas::all();
        $actionTypes = ResTipoReservas::orderBy('id','asc')->get();
        $statusTasks = ResEstadosReservas::all();
        return view('calendario.index',compact('actionTypes','taskCases','statusTasks'));
        // return view('calendario.index-2',compact('actionTypes','taskCases','statusTasks'));

    }
    public function randomHexColor()
    {
        return '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    }
    public function task_action_list(Request $request){

        if(!is_null($request->actionValues)){
          $taskActionList =  TaskAction::where('task_id',$request->actionValues['task_id'])->where('action_id',$request->actionValues['action_id'])->orderBy('updated_at','desc')->get();

          return $taskActionList;
        }

        if(!is_null($request->dates)){
            $start = Carbon::parse($request->dates['start'])->startOfDay();
            $end = Carbon::parse($request->dates['end'])->endOfDay();
        }

        $taskActionList =  !is_null($request->dates) ?
        TaskAction::whereDate('due_date','>=',$start )->whereDate('due_date','<=',$end)->orderBy('due_date','desc')->get() :
        TaskAction::orderBy('updated_at','desc')->get();
        return $taskActionList;
    }    

    public function evento_calendario(Request $request) {       

        

        // $data = DB::table('vreservas as a')
        //     ->select(DB::raw("fecha_reserva || 'T' || hora_reserva AS start, fecha_reserva,hora_reserva,nombre_cliente AS title, classname, nombre_cliente AS cliente, tipo, id AS id_reserva, tsucursal, a.testado, tsalon, cantidad_pasajeros AS pax, dianoche, (SELECT SUM(cantidad_pasajeros) FROM vreservas WHERE fecha_reserva = a.fecha_reserva AND estado NOT IN (4, 7, 8)) AS total_pax"))
        //     ->where('fecha_reserva','>=', $fechaActual->format('Y-m-d') )
        //     // ->where('tipo_reserva', '2')
        //     ->orderBy('fecha_reserva')
        //     ->orderBy('hora_reserva')
        //     ->get();
            //  return ($data->toSql());

            // return(json_encode($data)); 


        
        // $data = DB::table('reservas AS a')->select(DB::raw("fecha_reserva || 'T' || hora_reserva AS START,
        // fecha_reserva,
        // hora_reserva,
        // nombre_cliente AS title,
        // b.color_class AS classname,
        // A.nombre_cliente AS cliente,
        // b.estado AS tipo,
        // A.ID AS id_reserva,
        // s.sucursal AS tsucursal,
        // e.estado AS testado,
        // sa.salon AS tsalon,
        // cantidad_pasajeros AS pax,
        // dianoche,
        // ( SELECT SUM ( cantidad_pasajeros ) FROM reservas WHERE fecha_reserva = A.fecha_reserva AND estado NOT IN ( 4, 7, 8 ) ) AS total_pax "))
        // ->leftJoin('res_salones AS sa', 'reservas.salon', '=', 'sa.id')  
        // ->leftJoin('res_sucursales AS s', 'reservas.sucursal', '=', 's.id')
        // ->leftJoin('res_estados_reservas AS e', 'reservas.estado', '=', 'e.id')
        // ->leftJoin('res_tipo_reservas b', 'reservas.tipo_reserva', '=', 'b.id')          
        
        // ->where('fecha_reserva','>=', $fechaActual->format('Y-m-d') )
        // ->orderBy('fecha_reserva')
        // ->orderBy('hora_reserva')
        // ->get(); 

        $fechaActual = Carbon::now(); // Obtiene la fecha actual
        $fechaActual->subYear(); // Resta 1 año a la fecha actual


        $tipo = explode(',', $request->tipo);
        
        // $data = DB::table('reservas as a')
        // ->leftJoin('res_salones as sa', 'a.salon', '=', 'sa.id')
        // ->leftJoin('res_estados_reservas as e', 'a.estado', '=', 'e.id')
        // ->leftJoin('res_tipo_reservas as b', 'a.tipo_reserva', '=', 'b.id')
        // ->leftJoin('res_sucursales as s', 'a.sucursal', '=', 's.id')
        // ->select(
        //     DB::raw("fecha_reserva || 'T' || hora_reserva AS START"),
        //     "fecha_reserva",
        //     "hora_reserva",
        //     "nombre_cliente as title",
        //     "b.color_class as classname",
        //     "a.nombre_cliente as cliente",
        //     "b.estado as tipo",
        //     "a.id as id_reserva",
        //     "s.sucursal as tsucursal",
        //     "e.estado as testado",
        //     "sa.salon as tsalon",
        //     "cantidad_pasajeros as pax",
        //     "dianoche",
        //     DB::raw("(SELECT SUM(cantidad_pasajeros) FROM reservas WHERE fecha_reserva = a.fecha_reserva AND estado NOT IN (4, 7, 8)) AS total_pax")
        // )
        //  ->where('fecha_reserva','>=', $fechaActual->format('Y-m-d') )
        //  ->whereIn('tipo_reserva',$tipo)
        // ->orderBy('fecha_reserva')
        // ->orderBy('hora_reserva')
        // ->get();   
        
        
        $data = DB::table('vcalendario')
        ->select(
            "id as id_reserva",
            "fecha_reserva",
            "hora_reserva",
            "nombre_cliente as title",
            "classname",            
            "tipo",
            "tsucursal",
            "testado",            
            "cantidad_pasajeros as pax",
            'total_pax',
            "dianoche", DB::raw("fecha_reserva || 'T' || hora_reserva AS START"))
        ->where('fecha_reserva','>=', $fechaActual->format('Y-m-d') )
        ->whereIn('tipo_reserva',$tipo)
        ->whereNotIn('estado',[4,7,8])
        ->orderBy('fecha_reserva')
        ->orderBy('hora_reserva')
        ->get();
        
        
        return $data; 
            
        
    }
    public function tipos_mes($fecha) {
        // $carbonFecha = Carbon::parse($fecha);
        $anio = Carbon::parse($fecha)->year;
        $mes = Carbon::parse($fecha)->month;

       

        //Todo: se estuvo probando para revisar la volecidad de ambos query, resulto terner el mismo resultado
        
        // $data= Reservas::
        // leftJoin('res_tipo_reservas as tr','reservas.tipo_reserva', '=','tr.id' )    
        // ->select('tr.estado as tipo', DB::raw("(SELECT COUNT(tr.estado)) AS cant ") )
        // ->where(function ($query) use ($anio, $mes) {
        //     $query->whereRaw("EXTRACT(YEAR FROM fecha_reserva) = ?", [$anio])
        //         ->whereRaw("EXTRACT(MONTH FROM fecha_reserva) = ?", [$mes]);
        // })
        // ->groupBy('tipo')
        // ->whereNotIn('reservas.estado',[4,7,8])->toSql();              
        

        // LEFT JOIN res_tipo_reservas b ON b.id = a.tipo_reserva

        $data = DB::select("
            SELECT tipo, COUNT(tipo) AS cant 
            FROM vcalendario 
            WHERE estado NOT IN (4,7,8) 
            AND EXTRACT(YEAR FROM fecha_reserva) = $anio
            AND EXTRACT(MONTH FROM fecha_reserva) = $mes
            GROUP BY tipo
        ");
        return json_encode($data);
        // $carbonFecha = Carbon::parse($fecha);
        // $anio = $carbonFecha->year;
        // $mes = $carbonFecha->month;
    }
    public function pax_fecha($estado,$turno,$tipo) {
        $atipo = explode(',', $tipo);
        $dianoche=$turno=="Todas"?"":strtoupper($turno);
        $reservas = DB::table('vcalendario')
        ->when($estado != 0, function($query) use ($estado) {
            $aestado = array_map('intval', explode(',', $estado));
            return $query->whereIn('estado', $aestado);
        })
        ->when($dianoche != '', function($query) use ($dianoche) {
            return $query->where('dianoche','=' ,$dianoche);
        })
        ->whereNotIn('estado',[4,7,8])
        ->whereIn('tipo',$atipo)
        ->groupBy('fecha_reserva')
        ->select('fecha_reserva', DB::raw('SUM(cantidad_pasajeros)'))
        ->orderBy('fecha_reserva')
        ->get();
        return json_encode($reservas);
    }
    public function pax_turno($turno) {
        $reservas = DB::table('vcalendario')
            ->when($turno != 0, function($query) use ($turno) {
                return $query->where('estado', '=', $turno);
            })
            ->whereNotIn('estado',[4,7,8])
            ->groupBy('fecha_reserva')
            ->select('fecha_reserva', DB::raw('SUM(cantidad_pasajeros)'))
            ->orderBy('fecha_reserva')
            ->get();
        return json_encode($reservas);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
