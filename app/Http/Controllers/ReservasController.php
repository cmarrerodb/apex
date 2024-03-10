<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Clientes;
use App\Models\Reservas;
use App\Models\ResExtras;
use Illuminate\Http\Request;
use App\Models\ResSucursales;
use App\Http\Traits\Funciones;
use App\Models\ResTipoReservas;
use App\Http\Traits\DigOceSpaces;
use App\Models\ResEstadosReservas;
use Illuminate\Support\Facades\DB;
use App\Models\ResHistorialCambios;
use App\Models\ResRazonCancelacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Events\QueryExecuted;


class ReservasController extends Controller
{
    use DigOceSpaces;
    use Funciones;
    private $hasUploadFiles = false;
    private $rollbackDocs   = "";

    public function __construct()
    {
        $this->middleware(['permission:crear reservas'])->only(['index','store']);
        // $this->middleware(['permission:ver administrar'])->only(['crm']);
        $this->middleware(['permission:ver extras'])->only(['extras']);
        $this->middleware(['permission:ver historial'])->only(['historial']);
        /* Declarar variables para rollback */
        $this->rollbackDocs   = null;
        $this->hasUploadFiles = false;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('reservar.index');
    }

    public function reservar_tab(){
        
        return view('reservar.reservar-tab');
    }

    public function lista() {
        return view('reservar.listado');
    }
    public function crm() {
        return view('crm.listado');
    }

    public function ver($id){
        return Reservas::select('id','mesa', 'salon','estado', 'observaciones','sucursal')->findOrfail($id);
    }

    public function crmUpdateTipo(Request $request, $id){

        // return $request->all();
        $res = [
            'resultado' => 204,
            'status' => "0",
            'error' => 'Ha ocurrido un error',
        ];

        $reserva = Reservas::find($id);
        $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
        $id_historial = $this->previo($estado,$request);

        if($id){

            if($request->tipo_update == 1){

                
                $reserva->cantidad_pasajeros = $request->pax_edit;

                $reserva->save();

                $this->actual($id_historial,$request);

                $res = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                    'message' => 'Se actualizó el pax exitosamente'
                ];

            }

            else if($request->tipo_update == 2){

               
                $reserva->mesa = $request->mesa_edit;
                $reserva->save();

                $this->actual($id_historial,$request);

                $res = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                    'message' => 'Se actualizó la mesa exitosamente'
                ];

            }

            else if($request->tipo_update == 3){             
                

                if($request->estado_edit==3){
                    
                    $reserva->usuario_confirmacion =  auth()->user()->id;

                    $reserva->fecha_confirmacion = Carbon::now();

                    if($reserva->estado==9){

                        $this->envioEmailConfirmacionReserva($reserva);
    
                        $this->envioEmailConfirmacionReservaUser($reserva);
                    }

                }
                $reserva->estado = $request->estado_edit;

                $reserva->save();

                $this->actual($id_historial,$request);

                $res = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                    'message' => 'Se actualizó el estado exitosamente'
                ];
            }

            else if ($request->tipo_update==4){
                
                $reserva->observaciones = $request->obs_edit;
                $reserva->save();

                $this->actual($id_historial,$request);

                $res = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                    'message' => 'Se actualizó la observación exitosamente'
                ];

            }
        }

        return $res;

    }


    public function bloqueos()
    {
        return view('reservas.bloqueos');
    }


    public function auxiliares() {
        // dd("pepe");
        // $resSucursalesController = new ResSucursalesController();
        // $resultado = $resSucursalesController->list();

        $data= [
            'razones' => $this->razones(),
            'estados' => $this->estados(),
            'tipos' => $this->tipos(),
            'sucursales' => ResSucursales::get(),
        ];
        return $data;
    }

    public function extras() {
        return view('reservas.extras');
    }

    public function list(Request $request) {
        $data = DB::table('vreservas')
        // ->select('id','nombre_cliente','telefono_cliente','email_cliente','hora_reserva',
        // 'cantidad_pasajeros','sucursal','tsucursal','salon','mesa','tsalon','tmesa','testado','estado','tipo','archivo_1','archivo_2',
        // 'observaciones','ambiente','fecha_confirmacion','usuario_confirmacion','usuario_rechazo','fecha_rechazo')
        ->select(['id',
        'nombre_cliente', 'telefono_cliente','email_cliente','hora_reserva','fecha_reserva',
        'cantidad_pasajeros','sucursal','tsucursal','salon','mesa','tsalon','tmesa','testado','estado','tipo','archivo_1','archivo_2','observaciones','ambiente','fecha_confirmacion','usuario_confirmacion','usuario_rechazo','fecha_rechazo', DB::raw("to_char(fecha_reserva, 'DD-MM-YYYY') as fecha_reserva_formateada"), ])
         
        ->when($request->has('fecha'), function ($query) use ($request) {
            return $query->where('fecha_reserva', $request->input('fecha'));
        })
        ->orderBy('fecha_reserva','DESC')
        ->orderBy('hora_reserva','DESC')->get();

        return(json_encode($data));
    }
    // public function list_administrar(Request $request) {

    //     $data = DB::table('vreservas')->get()->collect()->toArray();

    //     $query->when($request->has('fecha'), function ($query) use ($request) {
    //         $query->where('fecha', $request->input('fecha'));

    //     });
    //     return(json_encode($data));
    // }

    public function list_fecha($fecha) {
        $data = DB::table('vreservas')
        ->select('id', 'fecha_reserva','nombre_cliente','telefono_cliente','email_cliente','hora_reserva',
        'cantidad_pasajeros','sucursal','salon','mesa','tsucursal','tsalon','tmesa','testado','estado','tipo','archivo_1','archivo_2',
        'observaciones','ambiente','fecha_confirmacion','usuario_confirmacion','usuario_rechazo','fecha_rechazo')
        ->where('fecha_reserva','=',$fecha)->get()->collect()->toArray();
        return(json_encode($data));
    }
    public function opc_filtro_reservas(Request $request, $tipo) {
        if($request->fecha){
            
            $data['clientes'] = DB::select(DB::raw("SELECT ROW_NUMBER() OVER(ORDER BY nombre_cliente) AS value,nombre_cliente AS label FROM vreservas WHERE fecha_reserva='".$request->fecha."' GROUP BY nombre_cliente"));

            $data['telefono'] = DB::select(DB::raw("SELECT ROW_NUMBER() OVER(ORDER BY telefono_cliente) AS value,telefono_cliente AS label FROM vreservas WHERE fecha_reserva='".$request->fecha."' GROUP BY telefono_cliente"));

            $data['correo'] = DB::select(DB::raw("SELECT ROW_NUMBER() OVER(ORDER BY email_cliente) AS value,email_cliente AS label FROM vreservas WHERE fecha_reserva='".$request->fecha."' GROUP BY email_cliente"));

            $data['empresa'] = DB::select(DB::raw("SELECT ROW_NUMBER() OVER(ORDER BY nombre_empresa) AS value,nombre_empresa AS label FROM vreservas WHERE fecha_reserva='".$request->fecha."' GROUP BY nombre_empresa"));

            $data['hotel'] = DB::select(DB::raw("SELECT ROW_NUMBER() OVER(ORDER BY nombre_hotel) AS value,nombre_hotel AS label FROM vreservas WHERE fecha_reserva='".$request->fecha."' GROUP BY nombre_hotel"));

            return(json_encode($data, JSON_UNESCAPED_UNICODE));            
        }
    }

    public function get_reserva($id) {
    $data = DB::table('vreservas')->select(
    'id', 
    'fecha_reserva', 
    'hora_reserva', 
    'cantidad_pasajeros', 
    'tipo', 
    'tipo_reserva',
    'sucursal',
    'salon',
    'nombre_cliente', 
    'nombre_empresa', 
    'nombre_hotel', 
    'telefono_cliente', 
    'email_cliente',
    'tsucursal', 
    'tsalon', 
    'observaciones', 
    'evento_nombre_adicional', 
    'evento_pax', 
    'evento_nombre_contacto', 
    'evento_telefono_contacto', 
    'evento_email_contacto', 
    'evento_idioma', 
    'evento_cristaleria', 
    'evento_anticipo', 
    'evento_valor_menu', 
    'evento_total_sin_propina', 
    'evento_total_propina', 
    'tevento_paga_en_local',
    'tevento_audio', 
    'tevento_video', 
    'tevento_video_audio', 
    'tevento_mesa_soporte_adicional', 
    'autoriza', 
    'telefono_autoriza', 
    'monto_autorizado',
    'tevento_menu_impreso', 
    'tevento_table_tent', 
    'tevento_restriccion_alimenticia', 
    'evento_detalle_restriccion', 
    'evento_decoracion', 
    'evento_monta', 
    'evento_ubicacion', 
    'evento_comentarios', 
    'salon', 
    'mesa', 
    'archivo_1', 
    'archivo_2', 
    'archivo_3', 
    'archivo_4', 
    'archivo_5', 
    'evento_logo')
    ->where('id','=',$id)->get();
        return(json_encode($data));
    }
    public function get_reservas_sucursal($id) {
        if ($id=='Todas') {
            $data = DB::table('vreservas')->get();
        } else {
            $data = DB::table('vreservas')->where('sucursal','=',$id)->get();
        }
        return(json_encode($data));
    }

    public function get_reservas_sucursal_fecha($id,$fecha) {
        if ($id=='Todas') {
            $data = DB::table('vreservas')->
            select('id','fecha_reserva','nombre_cliente','hora_reserva','cantidad_pasajeros','tsucursal','sucursal','tmesa', 'testado','tipo','archivo_1','archivo_2','observaciones','estado','tipo_reserva')
            ->where('fecha_reserva','=',$fecha)->orderBy('hora_reserva','desc')->get();
        } else {
            $data = DB::table('vreservas')
            ->select('id','fecha_reserva','nombre_cliente','hora_reserva','cantidad_pasajeros','tsucursal','sucursal','tmesa', 'testado','tipo','archivo_1','archivo_2','observaciones','estado','tipo_reserva')
            ->where('fecha_reserva','=',$fecha)->where('sucursal','=',$id)->orderBy('hora_reserva','desc')->get();
        }
        return(json_encode($data));
    }

    public function tipos() {
        $tipos = ResTipoReservas::whereNull('deleted_at')->distinct()->get();
        return $tipos;
    }
    public function cliente(Request $request) {
        $data=[];
        $ultimosSeisMeses = Carbon::now()->subMonths(6);
        $data['reservas_cliente']=DB::table('vreservas')
        ->select('fecha_reserva','cantidad_pasajeros','testado','razon','observacion_cancelacion')
        ->where('nombre_cliente','=',$request->cliente)
        ->orderBy('fecha_reserva','desc')
        ->get();
        $data['cliente_noshow']=DB::table('vreservas')
        ->where('nombre_cliente','=',$request->cliente)
        ->where('fecha_reserva', '>', $ultimosSeisMeses)
        ->where('estado', '=', 7)
        ->count();
        $data['cliente']=Clientes::where('nombre','=',$request->cliente)->orderBy('nombre')
        ->get();

        return json_encode($data);
    }
    public function razones() {
        $razones = ResRazonCancelacion::select('id', 'razon')->whereNull('deleted_at')->distinct()->get();
        return $razones;
    }
    public function get_turno_fecha($fecha,$turno) {
        switch ($turno) {
            case 1:
                $trn = 'TARDE';
                break;
            case 2:
                $trn = 'NOCHE';
                break;
        }
        if ($turno !=="3") {
            $data = DB::table('vreservas')
            ->select('id','fecha_reserva','nombre_cliente','hora_reserva','cantidad_pasajeros','tsucursal','sucursal','tmesa', 'testado','tipo','archivo_1','archivo_2','observaciones','estado','tipo_reserva')
            ->where('fecha_reserva','=',$fecha)
            ->where('dianoche', '=', $trn)
            ->orderBy('hora_reserva','desc')
            ->get()
            ->collect()
            ->toArray();
        } else {
            $data = DB::table('vreservas')
            ->select('id','fecha_reserva','nombre_cliente','hora_reserva','cantidad_pasajeros','tsucursal','sucursal','tmesa', 'testado','tipo','archivo_1','archivo_2','observaciones','estado','tipo_reserva')
            ->where('fecha_reserva','=',$fecha)->orderBy('hora_reserva','desc')->get();
        }
        return(json_encode($data));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }


    public function filtros(Request $request) {
        
        $turno = $request->turno;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $estados = $request->estados;
        $tipos = $request->tipos;
        $sucursales = $request->sucursales;
        $salones = $request->salones;
        $mesas = $request->mesas;
        $clientes = $request->clientes;
        $cancelacion = $request->cancelacion;
        $rango = $desde && $hasta?[$desde,$hasta]:null;

        if($turno=="TODOS" && !$desde && !$hasta && !$estados && !$tipos && !$sucursales && !$mesas && !$clientes && !$cancelacion ){
            
            $reservas = DB::table('vreservas')
            ->select('id','hora_reserva','estado','fecha_reserva', 'tipo_reserva','tipo','tsucursal','tsalon','mesa','salon','sucursal','tmesa','nombre_cliente','razon_cancelacion','cantidad_pasajeros','telefono_cliente','observacion_cancelacion','testado','ambiente','observaciones','fecha_rechazo','tusuario_rechazo','fecha_confirmacion','tusuario_confirmacion','razon_rechazo', DB::raw("to_char(fecha_reserva, 'DD-MM-YYYY') as fecha_reserva_formateada") )
            ->where('fecha_reserva', date('Y-m-d'))
            ->orderBy('fecha_reserva','DESC')
            ->orderBy('hora_reserva','DESC')->get();
        }
        else{

            $reservas = DB::table('vreservas')
            ->select('id','hora_reserva','fecha_reserva','estado','tipo_reserva','tipo','tsucursal','tsalon','mesa','salon','sucursal','tmesa','nombre_cliente','razon_cancelacion','cantidad_pasajeros','telefono_cliente','observacion_cancelacion','testado','ambiente','observaciones','fecha_rechazo','tusuario_rechazo','fecha_confirmacion','tusuario_confirmacion','razon_rechazo', DB::raw("to_char(fecha_reserva, 'DD-MM-YYYY') as fecha_reserva_formateada") )
            ->when($turno, function ($query, $turno) {
                if ($turno == 'TARDE') {
                    return $query->where('hora_reserva', '<=', '16:00');
                } elseif ($turno == 'NOCHE') {
                    return $query->where('hora_reserva', '>=', '18:00');
                }
            })
            ->when($rango, function ($query, $rango) {
                return $query->whereBetween('fecha_reserva', $rango);
            })
            ->when($estados, function ($query, $estados) {
                return $query->whereIn('estado', $estados);
            })
            ->when($tipos, function ($query, $tipos) {
                return $query->whereIn('tipo_reserva', $tipos);
            })
            ->when($sucursales, function ($query, $sucursales) {
                return $query->where('sucursal', $sucursales);
            })
            ->when($salones, function ($query, $salones) {
                return $query->whereIn('salon', $salones);
            })
            ->when($mesas, function ($query, $mesas) {
                return $query->whereIn('mesa', $mesas);
            })
            // ->when($clientes, function ($query, $clientes) {
            //     return $query->whereIn('cliente_id', $clientes);
            // }) // Se realizo este cambio ya que la columna cliente_id esta vacia 

            // Todo: esta parte se edito para conseguir los clientes con like 
            // ->when($clientes, function ($query, $clientes) {
            //     return $query->whereIn('nombre_cliente', $clientes);
            // })

             ->when($clientes, function ($query, $clientes) {           
                return $query->where('nombre_cliente', 'like', "%$clientes%");
            })


            // ->when($clientes, function ($query, $clientes) {
            //     return $query->where('nombre_cliente', $clientes);
            // })

            ->when($cancelacion, function ($query, $cancelacion) {
                return $query->where('razon_cancelacion', $cancelacion);
            })
            ->orderBy('fecha_reserva','DESC')
            ->orderBy('hora_reserva','DESC')->get();
        }        
        
        return json_encode($reservas);
    }
    public function pax_fecha(Request $request, $id,$fecha,$turno="") {   

        $estado ="";
        
        if($request->estado!=""){
            $estado = ResEstadosReservas::where('estado',$request->estado)->pluck('id');
        }
       
        if ($id=='Todas') {
            $data = Reservas::selectRaw('sum(cantidad_pasajeros)')
           
            ->when($turno != "" && $turno!=3 , function($query) use ($turno) {
                return $query->where("dianoche", $turno);
            })
            ->where('estado','!=', 4)
            ->where('estado','!=', 7)
            ->where('estado','!=', 8)

            ->when($estado != "" , function($query) use ($estado) {
                return $query->where("estado", $estado);
            })
            ->where('fecha_reserva','=',$fecha)->get();
        } else {
            $data = Reservas::selectRaw('sum(cantidad_pasajeros)')    
           
            ->when($turno != "" && $turno!=3, function($query) use ($turno) {               
                return $query->where("dianoche", $turno);
            })
      
            ->where('estado','!=', 4)
            ->where('estado','!=', 7)
            ->where('estado','!=', 8)
            
            ->when($estado != "" , function($query) use ($estado) {
                return $query->where("estado", $estado);
            })
            ->where('fecha_reserva','=',$fecha)->where('sucursal','=',$id)->get();

        }
        return(json_encode($data));
    }
    public function verificar_clave(Request $request) {
        $clave = trim($request->clave);
        $passwd = auth()->user()->password;
        
        if (Hash::check($clave,$passwd)) {
            $data[] = ['respuesta' => 1,];
        } else {
            $data[] = ['respuesta' => 0,];
        }
        return json_encode($data);
    }
    public function estados() {

        $data = ResEstadosReservas::select('id','estado')->whereNull('deleted_at')->orderBy('estado','ASC')->get();
        // $data = DB::table('res_estados_reservas')->select('id','estado')->whereNull('deleted_at')->orderBy('estado','ASC')->get()->collect()->toArray();
        return $data;
    }
    public function check_bloqueo($fecha,$hora) {
        $sql = "SELECT COUNT(*) AS bloqueos FROM res_bloqueos WHERE deleted_at IS NULL AND'$fecha' BETWEEN fecha_inicio AND fecha_fin
        AND '$hora' BETWEEN hora_inicio AND hora_fin " ;
        $bloqueo = DB::select(DB::raw($sql));
        return json_encode($bloqueo);
    }

    public function check_bloq(Request $request) {

        $id = $request->data[4];
        $fecha1 = $request->data[0];
        $fecha2 = $request->data[2];
        $hora1 = $request->data[1];
        $hora2 = $request->data[3];
        $sql = "SELECT COUNT ( * ) AS bloqueos FROM res_bloqueos WHERE id != $id AND deleted_at  IS NULL AND (('$fecha1' BETWEEN fecha_inicio AND fecha_fin AND '$hora1' BETWEEN hora_inicio AND hora_fin) OR ('$fecha2' BETWEEN fecha_inicio AND fecha_fin AND '$hora2' BETWEEN hora_inicio AND hora_fin)) " ;
        $bloqueo = DB::select(DB::raw($sql));
        return json_encode($bloqueo);
    }

    public function unset_bloqueo($id) {
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            $bloqueo = DB::table('res_bloqueos')->where('id','=',$id)->update($data);
            $mensaje = 'éxito';
             $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>$mensaje,
            ];
            return json_encode($res);
            // return json_encode($bloqueo);
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
    public function listabloqueos() {
        $bloqueo = DB::table('res_bloqueos')
        ->select("res_bloqueos.id","res_bloqueos.fecha_inicio","res_bloqueos.hora_inicio","res_bloqueos.fecha_fin","res_bloqueos.hora_fin","users.name as usuario_registro","res_bloqueos.nombre_bloqueo")
        ->leftJoin('users','users.id','=','res_bloqueos.usuario_registro')
        ->whereNull('deleted_at')
        ->get()
        ->collect()
        ->toArray();
        return json_encode($bloqueo);
    }

    public function listaextras() {
        $extras = ResExtras::select("res_extras.id","vreservas.nombre_cliente","vreservas.fecha_reserva","vreservas.hora_reserva","vreservas.tsucursal","vreservas.tsalon","vreservas.tmesa","vreservas.tusuario_registro","res_extras.telefono_autoriza","res_extras.monto_autorizado","res_extras.created_at")
        ->leftJoin('vreservas','vreservas.id','=','res_extras.reserva_id')
        ->whereNull('res_extras.deleted_at')
        ->get()
        ->collect()
        ->toArray();
        return json_encode($extras);
    }

    public function get_bloqueos($fecha) {
        $anio = Carbon::createFromFormat('Y-m-d', $fecha)->format('Y');
        $mes = Carbon::createFromFormat('Y-m-d', $fecha)->format('m');
        $sql = "select * from res_bloqueos where extract(MONTH from fecha_inicio)::int=$mes
        AND extract(YEAR from fecha_inicio)::int=$anio AND deleted_at is null" ;
        $bloqueo = DB::select(DB::raw($sql));
        return json_encode($bloqueo);
    }
    public function get_bloqueo($fecha) {
        $sql = "SELECT * FROM res_bloqueos WHERE deleted_at IS NULL AND fecha_inicio='$fecha'" ;
        $bloqueo = DB::select(DB::raw($sql));
        return json_encode($bloqueo);
    }
    public function get_bloq($id) {
        $bloqueo = DB::table('res_bloqueos')
        ->whereNull('deleted_at')
        ->where('id','=',$id)
        ->get()
        ->collect()
        ->toArray();
        return json_encode($bloqueo);
    }
    public function set_bloqueo(Request $request) {
        $usuario = auth()->user()->id;
        $data = ([
            'fecha_inicio'=> $request->data[1],
            'hora_inicio'=> $request->data[2],
            'fecha_fin'=> $request->data[3],
            'hora_fin'=> $request->data[4],
            'usuario_registro'=> $usuario,
            'nombre_bloqueo'=> $request->data[5],
        ]);
        try {
            if ($request->data[0]==0) {
                $bloqueo= DB::table('res_bloqueos')->insert($data);
                $mensaje = "Fecha bloqueada exitosamente";
            } else {
                $bloqueo= DB::table('res_bloqueos')->where('id','=',$request->data[0])->update($data);
                $mensaje = "Bloqueo editado exitosamente";
            }
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>$mensaje,
            ];
            $jres=json_encode($res);
            return $jres;
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

    public function store(Request $request)  {

        // return $request->all();
        $cliente="";

       
        $usuario = auth()->user()->id;
        $archivo_1 = "";
        $archivo_2 = "";
        $archivo_3 = "";
        $archivo_4 = "";
        $archivo_5 = "";
        $evento_logo ="";
        if ($request->hasFile('archivo_1')){
            $archivox   = $request->file('archivo_1');
            $content    = File::get($archivox);
            $extension  = $archivox->getClientOriginalExtension();
            $fileUpload = $this->uploadFile("b94_reservas2/reserva/1", $content,$extension,null,true);
            if(!$fileUpload->saved) trigger_error('error-upload-archivo');
            $archivo_1 = $fileUpload->privateUrl;
        }
        if ($request->hasFile('archivo_2')){
            $archivox2   = $request->file('archivo_2');
            $content2    = File::get($archivox2);
            $extension2  = $archivox2->getClientOriginalExtension();
            $fileUpload2 = $this->uploadFile("b94_reservas2/reserva/2", $content2, $extension2,null,true);
            if(!$fileUpload2->saved) trigger_error('error-upload-archivo');
            $archivo_2 = $fileUpload2->privateUrl;
        }
        if ($request->hasFile('archivo_3')){
            $archivox3   = $request->file('archivo_3');
            $content3    = File::get($archivox3);
            $extension3  = $archivox3->getClientOriginalExtension();
            $fileUpload3 = $this->uploadFile("b94_reservas2/reserva/3", $content3, $extension3,null,true);
            if(!$fileUpload3->saved) trigger_error('error-upload-archivo');
            $archivo_3 = $fileUpload3->privateUrl;
        }
        if ($request->hasFile('archivo_4')){
            $archivox4   = $request->file('archivo_4');
            $content4    = File::get($archivox4);
            $extension4  = $archivox4->getClientOriginalExtension();
            $fileUpload4 = $this->uploadFile("b94_reservas2/reserva/4", $content4, $extension4,null,true);
            if(!$fileUpload4->saved) trigger_error('error-upload-archivo');
            $archivo_4 = $fileUpload4->privateUrl;
        }
        if ($request->hasFile('archivo_5')){
            $archivox5   = $request->file('archivo_5');
            $content5    = File::get($archivox5);
            $extension5 = $archivox5->getClientOriginalExtension();
            $fileUpload5 = $this->uploadFile("b94_reservas2/reserva/5", $content5, $extension5,null,true);
            if(!$fileUpload5->saved) trigger_error('error-upload-archivo');
            $archivo_5 = $fileUpload5->privateUrl;
        }

        if ($request->hasFile('evento_logo')){
            $archivox6   = $request->file('evento_logo');
            $content6    = File::get($archivox6);
            $extension6  = $archivox6->getClientOriginalExtension();
            $fileUpload6 = $this->uploadFile("b94_reservas2/reserva/6", $content6, $extension6,null,true);
            if(!$fileUpload6->saved) trigger_error('error-upload-archivo');
            $evento_logo = $fileUpload6->privateUrl;
        }

        $data = ([
            "fecha_reserva" => $request->fecha_reserva,
            "hora_reserva" => $request->hora_reserva.":00",
            "cantidad_pasajeros" => $request->pasajeros,
            "tipo_reserva" => $request->tipo,           
            "nombre_cliente" => $request->cliente,
            "nombre_empresa" => $request->empresa,
            "estado" => 3,
            "usuario_registro" =>$usuario,
            "clave_usuario" => "abc",
            "nombre_hotel" => $request->hotel,
            "telefono_cliente" => $request->telefono,
            "email_cliente" => $request->correo,
            "sucursal" => $request->sucursal,
            "salon" => $request->salon,
            "mesa" => $request->mesa,
            "observaciones" => $request->observaciones,
            "archivo_1" =>$archivo_1,
            "archivo_2" =>$archivo_2,
            "archivo_3" =>$archivo_3,
            "archivo_4" =>$archivo_4,
            "archivo_5" =>$archivo_5,
            "evento_logo" =>$evento_logo,
            "evento_nombre_adicional" =>$request->evento_nombre_adicional,
            "evento_pax" =>$request->evento_pax,
            "evento_nombre_contacto" =>$request->evento_nombre_contacto,
            "evento_telefono_contacto" =>$request->evento_telefono_contacto,
            "evento_email_contacto" =>$request->evento_correo_contacto,
            "evento_idioma" =>$request->evento_idioma,
            "evento_cristaleria" =>$request->evento_cristaleria,
            "evento_anticipo" =>$request->evento_anticipo,
            "evento_valor_menu" =>$request->evento_valor_menu,
            "evento_total_sin_propina" =>$request->evento_total_sin_propina,
            "evento_total_propina" =>$request->evento_total_propina,
            "evento_paga_en_local" =>$request->evento_paga_en_local,
            "evento_audio" =>$request->evento_audio,
            "evento_video" =>$request->evento_video,
            "evento_video_audio" =>$request->evento_video_audio,
            "evento_mesa_soporte_adicional" =>$request->evento_mesa_soporte_adicional,
            "evento_ubicacion" =>$request->evento_ubicacion,
            "evento_menu_impreso" =>$request->evento_menu_impreso,
            "evento_table_tent" =>$request->evento_table_tent,
            "evento_restriccion_alimenticia" =>$request->evento_restriccion_alimenticia,
            "evento_extra_permitido" =>$request->evento_extra_permitido,
            "evento_detalle_restriccion" =>$request->evento_detalle_restriccion,
            "evento_decoracion" =>$request->evento_decoracion,
            "ambiente" =>$request->ambiente,
            "evento_monta" =>$request->evento_monta,
            "evento_comentarios" =>$request->evento_comentarios,
            "dianoche" =>$request->dianoche,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $id_cliente = Clientes::where("nombre","=",$request->cliente)->pluck('id')->toArray();
        if(count($id_cliente)>0){
            $cliente = $id_cliente[0];

            $datac = [
                "cliente_id" => $cliente, 
            ];

            $data = array_merge($data, $datac);
        }      


        DB::beginTransaction();
        try {
            $reserva= Reservas::firstOrCreate($data);

            $this->registro_historial($reserva); // Historial Creación


            $mensaje = "Reserva creada exitosamente";
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
            ];

            // Prereserva
            if($request->tipo==8){
                /* PREPARANDO EL EMAIL */
                $cuerpo = "<p>Se ha creado una pre-reserva con los siguientes datos:</p>";
                $cuerpo.= "<p>Nombre del cliente:".$request->cliente."</p>";
                $cuerpo.= "<p>Email email del cliente:".$request->correo."</p>";
                $cuerpo.= "<p>Télefono:".$request->telefono."</p>";

                $email               = (object)[];
                /* $email->email        = $request->correo ."; karen.milgram@gmail.com"; Se comento esta linea
                para poder realizar pruebas */
                $email->email        = 'felixjm@gmail.com';
                $email->destinatario = $request->cliente;
                $email->asunto       = 'Creación de Prereserva';
                $email->cuerpo       = $cuerpo;
                $correox             = $this->sendemail($email);
                $correox             = json_decode($correox);
                if(isset($correox->code)) trigger_error($correox->message);

            }


            if($request->monto_autorizado !== null && $request->telefono_autoriza !== null && $request->monto_autorizado !== null) {
                $extra = ([
                    'reserva_id' => DB::getPdo()->lastInsertId(),
                    'autoriza' => $request->autoriza,
                    'telefono_autoriza' => $request->telefono_autoriza,
                    'monto_autorizado' => $request->monto_autorizado,
                    'created_at' => Carbon::now(),
                ]);
                $reserva= ResExtras::firstOrCreate($extra);
            }

            DB::commit();
            return json_encode($res);
        }
        catch(\Exception $e) {
            DB::rollback();
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }

    public function actualizar(Request $request) {
        $id_cliente = Clientes::where("nombre","=",$request->cliente)->pluck('id')->toArray();
        $usuario = auth()->user()->id;
        $archivo_1 = "";
        $archivo_2 = "";
        $archivo_3 = "";
        $archivo_4 = "";
        $archivo_5 = "";
        $evento_logo ="";

        if ($request->hasFile('archivo_1')){
            $archivox   = $request->file('archivo_1');
            $content    = File::get($archivox);
            $extension  = $archivox->getClientOriginalExtension();
            $fileUpload = $this->uploadFile("b94_reservas2/reserva/1", $content, $extension ,null,true);
            if(!$fileUpload->saved) trigger_error('error-upload-archivo');
            $archivo_1 = $fileUpload->privateUrl;


        }
        if ($request->hasFile('archivo_2')){
            $archivox2   = $request->file('archivo_2');
            $content2    = File::get($archivox2);
            $extension2  = $archivox2->getClientOriginalExtension();
            $fileUpload2 = $this->uploadFile("b94_reservas2/reserva/2", $content2, $extension2,null,true);
            if(!$fileUpload2->saved) trigger_error('error-upload-archivo');
            $archivo_2 = $fileUpload2->privateUrl;


        }
        if ($request->hasFile('archivo_3')){
            $archivox3   = $request->file('archivo_3');
            $content3    = File::get($archivox3);
            $extension3  = $archivox3->getClientOriginalExtension();
            $fileUpload3 = $this->uploadFile("b94_reservas2/reserva/3", $content3, $extension3,null,true);
            if(!$fileUpload3->saved) trigger_error('error-upload-archivo');
            $archivo_3 = $fileUpload3->privateUrl;


        }
        if ($request->hasFile('archivo_4')){
            $archivox4   = $request->file('archivo_4');
            $content4    = File::get($archivox4);
            $extension4  = $archivox4->getClientOriginalExtension();
            $fileUpload4 = $this->uploadFile("b94_reservas2/reserva/4", $content4, $extension4,null,true);
            if(!$fileUpload4->saved) trigger_error('error-upload-archivo');
            $archivo_4 = $fileUpload4->privateUrl;


        }
        if ($request->hasFile('archivo_5')){
            $archivox5   = $request->file('archivo_5');
            $content5    = File::get($archivox5);
            $extension5 = $archivox5->getClientOriginalExtension();
            $fileUpload5 = $this->uploadFile("b94_reservas2/reserva/5", $content5, $extension5,null,true);
            if(!$fileUpload5->saved) trigger_error('error-upload-archivo');
            $archivo_5 = $fileUpload5->privateUrl;


        }

        if ($request->hasFile('evento_logo')){
            $archivox6   = $request->file('evento_logo');
            $content6    = File::get($archivox6);
            $extension6  = $archivox6->getClientOriginalExtension();
            $fileUpload6 = $this->uploadFile("b94_reservas2/reserva/6", $content6, $extension6,null,true);
            if(!$fileUpload6->saved) trigger_error('error-upload-archivo');
            $evento_logo = $fileUpload6->privateUrl;


        }


        $data = ([
            "fecha_reserva" => $request->fecha_reserva,
            "hora_reserva" => $request->hora_reserva,
            "cantidad_pasajeros" => $request->pasajeros,
            "tipo_reserva" => $request->tipo,
            // "cliente_id" => $id_cliente[0],
            "nombre_cliente" => $request->cliente,
            "nombre_empresa" => $request->empresa,
            // "estado" => 1, //
            "usuario_registro" =>$usuario,
            "clave_usuario" => "abc",
            "nombre_hotel" => $request->hotel,
            "telefono_cliente" => $request->telefono,
            "email_cliente" => $request->correo,
            "sucursal" => $request->sucursal,
            "salon" => $request->salon,
            "mesa" => $request->mesa,
            "observaciones" => $request->observaciones,
            "evento_nombre_adicional" =>$request->tipo !=2?null:$request->evento_nombre_adicional,
            "evento_pax" =>$request->tipo !=2?null:$request->evento_pax,
            "evento_nombre_contacto" =>$request->tipo !=2?null:$request->evento_nombre_contacto,
            "evento_telefono_contacto" =>$request->tipo !=2?null:$request->evento_telefono_contacto,
            "evento_email_contacto" =>$request->tipo !=2?null:$request->evento_correo_contacto,
            "evento_idioma" =>$request->tipo !=2?null:$request->evento_idioma,
            "evento_cristaleria" =>$request->tipo !=2?null:$request->evento_cristaleria,
            "evento_anticipo" =>$request->tipo !=2?null:$request->evento_anticipo,
            "evento_valor_menu" =>$request->tipo !=2?null:$request->evento_valor_menu,
            "evento_total_sin_propina" =>$request->tipo !=2?null:$request->evento_total_sin_propina,
            "evento_total_propina" =>$request->tipo !=2?null:$request->evento_total_propina,
            "evento_paga_en_local" =>$request->tipo !=2?null:$request->evento_paga_en_local,
            "evento_audio" =>$request->tipo !=2?null:$request->evento_audio,
            "evento_video" =>$request->tipo !=2?null:$request->evento_video,
            "evento_video_audio" =>$request->tipo !=2?null:$request->evento_video_audio,
            "evento_mesa_soporte_adicional" =>$request->tipo !=2?null:$request->evento_mesa_soporte_adicional,
            "evento_ubicacion" =>$request->tipo !=2?null:$request->evento_ubicacion,
            "evento_menu_impreso" =>$request->tipo !=2?null:$request->evento_menu_impreso,
            "evento_table_tent" =>$request->tipo !=2?null:$request->evento_table_tent,
            "evento_restriccion_alimenticia" =>$request->tipo !=2?null:$request->evento_restriccion_alimenticia,
            "evento_extra_permitido" =>$request->tipo !=2?null:$request->evento_extra_permitido,
            "evento_detalle_restriccion" =>$request->tipo !=2?null:$request->evento_detalle_restriccion,
            "evento_decoracion" =>$request->tipo !=2?null:$request->evento_decoracion,
            "ambiente" =>$request->tipo !=2?null:$request->ambiente,
            "evento_monta" =>$request->tipo !=2?null:$request->evento_monta,
            "evento_comentarios" =>$request->tipo !=2?null:$request->evento_comentarios,
            "dianoche" =>$request->dianoche,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($request->hasFile('archivo_1')){
            $data['archivo_1'] = $archivo_1;
        }
        if ($request->hasFile('archivo_2')){
            $data['archivo_2'] = $archivo_2;
        }
        if ($request->hasFile('archivo_3')){
            $data['archivo_3'] = $archivo_3;
        }
        if ($request->hasFile('archivo_4')){
            $data['archivo_4'] = $archivo_4;
        }
        if ($request->hasFile('archivo_5')){
            $data['archivo_5'] = $archivo_5;
        }
        if ($request->hasFile('evento_logo')){
            $data["evento_logo"]= $evento_logo;
        }

        DB::beginTransaction();
        try {
            $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
            $id_historial = $this->previo($estado,$request);
            $reserva= Reservas::find($request->id)->update($data);
            $this->actual($id_historial,$request);


            $mensaje = "Reserva actualizada exitosamente";
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
            ];
            if($request->monto_autorizado !== null && $request->telefono_autoriza !== null && $request->monto_autorizado !== null) {
                $extra = [
                    'autoriza' => $request->autoriza,
                    'telefono_autoriza' => $request->telefono_autoriza,
                    'monto_autorizado' => $request->monto_autorizado,
                    'created_at' => Carbon::now(),
                ];
                $ext = ResExtras::where("reserva_id","=",$request->id)->pluck('id')->toArray();
                if ($request->tipo ==2) {
                    $reserva= ResExtras::updateOrCreate(
                        ['reserva_id' => $request->id],
                        $extra
                    );
                } else if ($request->tipo !=2) {
                    ResExtras::where("reserva_id","=",$request->id)->delete();
                }
            }
            DB::commit();
            return json_encode($res);
        }
        catch(\Exception $e) {
            DB::rollback();
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }
 

    public function rollback($id) {
        $historial = DB::table('res_historial_cambios')
        ->where('id', '=',$id)
        ->get()
        ->toArray();
        $reserva = Reservas::find($historial[0]->reserva_id);
        $estado_previo = json_decode($historial[0]->estado_previo,true);
        unset($estado_previo['id']);
        $vprev = DB::select(DB::raw("SELECT row_to_json(vreservas) AS estado_previo FROM vreservas WHERE id = ".$historial[0]->reserva_id));
        DB::beginTransaction();
        try {
            $reserva->update($estado_previo);
            $vactual = DB::select(DB::raw("SELECT row_to_json(vreservas) AS estado_actual FROM vreservas WHERE id = ".$historial[0]->reserva_id));
            $hist = DB::table('res_historial_cambios')->insert([
                'reserva_id' => $historial[0]->reserva_id,
                'estado_previo' => $historial[0]->estado_actual,
                'estado_actual' => $historial[0]->estado_previo,
                'valor_previo' => $historial[0]->valor_actual,
                'valor_actual' => $historial[0]->valor_previo,
                'vestado_previo' => $vprev[0]->estado_previo,
                'vestado_actual' => $vactual[0]->estado_actual,
                'usuario_id' => auth()->user()->id,
                'fecha_cambio' => Carbon::now(),
                'tipo_cambio' => 2,
            ]);
            $mensaje = "Se realizó adecuadamente el rollback de la reserva";
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
            ];
            DB::commit();
            return json_encode($res);
        }
        catch(\Exception $e) {
            DB::rollback();
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function reserva_check(Request $request)
    {       
        try {
            $token_reserva = $request->token_reserva;
            $id = Crypt::decrypt($token_reserva);

            $reserva = DB::table('vreservas')
            ->select('id','hora_reserva','fecha_reserva','estado','tipo_reserva','tipo','tsucursal','tsalon','mesa','salon','sucursal','tmesa','nombre_cliente','razon_cancelacion','cantidad_pasajeros','telefono_cliente','observacion_cancelacion','testado','ambiente','observaciones','fecha_rechazo','tusuario_rechazo','fecha_confirmacion','tusuario_confirmacion','razon_rechazo')->find($id);

            if($reserva){
                return view('reservar.show', compact('reserva'));
            }else{
                return view('errors.404');
            }

        } catch (\Throwable $e) {

            $respuesta =[
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            return view('errors.404');

            return $respuesta;

        }

    }


    public function update(Request $request, Reservas $reservas)
    {
        //
    }
    public function update_canc(Request $request) {
    // public function update_canc(Request $request, Reservas $reservas) {
    // public function cancelar(Request $request) {
        $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
        $id_historial = $this->previo($estado,$request);
        $data = ([
            'razon_cancelacion' => $request->razon_cancelacion,
            'observacion_cancelacion' => $request->observacion_cancelacion,
            'estado' => 4,
            'updated_at' => Carbon::now(),
        ]);
        DB::beginTransaction();
        try {
            Reservas::where("id","=",$request->id)->update($data);
            $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
            $this->actual($id_historial,$request);
            $reserva = Reservas::select('email_cliente','nombre_cliente','fecha_reserva','hora_reserva')->find($request->id);
            $razon_cancelacion = ResRazonCancelacion::find($request->razon_cancelacion);
            /* PREPARANDO EL EMAIL */
            $cuerpo = "<p>Se ha cancelado la reserva n°:".$request->id."</p>";
            $cuerpo.= "<p>Con fecha: ". Carbon::parse($reserva->fecha_reserva)->format('d-m-Y')." y Hora: ".$reserva->hora_reserva."</p>";
            $cuerpo.= "<p>Por la siguiente razon: ".$razon_cancelacion->razon."</p>";
            if($request->observacion_cancelacion){
                $cuerpo.= "<p>Observaciones: ".$request->observacion_cancelacion."</p>";
            }
            // Envio Email
            $this->envioEmail('felixjm@gmail.com', $reserva->nombre_cliente, 'Reserva Cancelada', $cuerpo );
            $mensaje = 'éxito';
			 $res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            DB::commit();
			return json_encode($res);
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
    public function rechazo(Request $request, Reservas $reservas) {

        // return $request->all();

        $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
        $id_historial = $this->previo($estado,$request);
        $data = ([
            'fecha_rechazo' => Carbon::now(),
            'razon_rechazo' => $request->razon_rechazo,
            'estado' => 8,
            'usuario_rechazo' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        DB::beginTransaction();
        try {
            Reservas::where("id",$request->id)->update($data);

            $this->actual($id_historial,$request);

            $reserva = Reservas::select('id','email_cliente','nombre_cliente','fecha_reserva','hora_reserva')->find($request->id);
            /* PREPARANDO EL EMAIL */         

            if($estado == 9){ // Solicitud web
                // Enviar email al cliente
                $this->envioEmailRechazoCliente($request, $reserva);
            }
            $this->envioEmailRechazoUser($request, $reserva);
           

            $mensaje = 'éxito';
			 $res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
			DB::commit();
            return($res);
        } catch(\Exception $e) {
			DB::rollback();
			$res[] = [
                'resultado' => 204,
                'status'    => "0",
                'error'     => $e->getMessage(),
                'mensaje'   => 'error',
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
			];
			return json_encode($res);
		}
    }

    public function aceptar(Request $request){

        $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
        
        $id_historial = $this->previo($estado,$request);
        $data = ([
            'fecha_confirmacion' => Carbon::now(),            
            'estado' => 3, //Aceptada
            'usuario_confirmacion' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        DB::beginTransaction();
        try {
            Reservas::where("id",$request->id)->update($data);  
            
            $this->actual($id_historial,$request);

            $reserva = Reservas::select('id','email_cliente','nombre_cliente','fecha_reserva','hora_reserva','cantidad_pasajeros','sucursal')->find($request->id);
            /* PREPARANDO EL EMAIL */

            // Si su estado estado anterior es Solicitud_Web  id = 9 se envia email al cliente
            if($estado==9){
                // envia el emailCliente al solicitante de la reserva
                $this->envioEmailConfirmacionReserva($reserva);
                //Todo Envia email al usuario que acepto la confirmacion, preguntar si es al usuario o si se le envia el email al admnistrador del sistema.
                $this->envioEmailConfirmacionReservaUser($reserva);           
            }

            $mensaje = 'éxito';
			 $res[] = [
				'resultado' => 202,
				'status' => "1",                
				'error' => '',
				'mensaje' =>$mensaje,
			];
			DB::commit();
            return($res);
        } catch(\Exception $e) {
			DB::rollback();
			$res[] = [
                'resultado' => 204,
                'status'    => "0",
                'error'     => $e->getMessage(),
                'mensaje'   => 'error',
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
			];
			return json_encode($res);
		}
    }

    public function cambio_estado(Request $request, Reservas $reservas)   {
        $estado=Reservas::where('id','=',$request->id)->pluck('estado')[0];
        $id_historial = $this->previo($estado,$request);
        $data = ([
            'estado' => $request->estado,
            'updated_at' => Carbon::now(),
        ]);
        DB::beginTransaction();
        try {
            Reservas::where("id","=",$request->id)->update($data);
            $this->actual($id_historial,$request);
            $reserva = Reservas::select('email_cliente','nombre_cliente','estado','fecha_reserva')
            ->with('estado_reserva')
            ->find($request->id);
            /* PREPARANDO EL EMAIL */
            $cuerpo = "<p>Se ha actualizado la reserva n°: ".$request->id."</p>";
            $cuerpo .= "<p>De fecha: ".Carbon::parse($reserva->fecha_reserva)->format('d-m-Y')."</p>";
            $cuerpo .= "<p>A estado: ".$reserva->estado_reserva->estado."</p>";
            // Envio Email
            $this->envioEmail('felixjm@gmail.com', $reserva->nombre_cliente, 'Actualización de reserva', $cuerpo );
			$mensaje = 'éxito';
			 $res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
			DB::commit();
			return json_encode($res);
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

    public function previo($estado,$req) {
        $id = $req->id;
        $usuario = auth()->user()->id;
        $prev = DB::select(DB::raw("SELECT row_to_json(reservas) AS estado_anterior FROM reservas WHERE id = $id"));
        $vprev = DB::select(DB::raw("SELECT row_to_json(vreservas) AS estado_anterior FROM vreservas WHERE id = $id"));
        // dd($vprev);
        $est = Reservas::where('id','=',$req->id)->pluck('estado')[0];
        $data = ([
            'reserva_id' => $id,
            'usuario_id' => $usuario,
            'fecha_cambio' => Carbon::now(),
            'estado_previo' => $prev[0]->estado_anterior,
            'vestado_previo' => $vprev[0]->estado_anterior,
            'valor_previo' =>$est,
            'created_at' => Carbon::now(),
            'tipo_cambio' => 1,
        ]);
        $nuevoId = ResHistorialCambios::insertGetId($data);
        return $nuevoId;

    }
    public function actual($id_historial,$req) {
        $actual = DB::select(DB::raw("SELECT row_to_json(reservas) AS estado_actual FROM reservas WHERE id = $req->id"));
        $vactual = DB::select(DB::raw("SELECT row_to_json(vreservas) AS estado_actual FROM vreservas WHERE id = $req->id"));
        $estado = Reservas::where("id","=",$req->id)->pluck('estado')->toArray();;
        $data = ([
            'estado_actual' => $actual[0]->estado_actual,
            'vestado_actual' => $vactual[0]->estado_actual,
            'valor_actual' => $estado[0],
            'updated_at' => Carbon::now(),
        ]);
        ResHistorialCambios::where("id","=",$id_historial)->update($data);
        return;
    } 



    public function historial() {
        return view('reservar.historial');
    }
    public function historial_cambios() {
        $hist = DB::table('vres_historial_cambios')->get()->collect()->toArray();
        return json_encode($hist);
    }
    public function historial_cambio($id) {
        $hist = DB::table('vres_historial_cambios')->where('reserva_id','=',$id)->get()->collect()->toArray();
        return json_encode($hist);
    }

    public function registro_cambio($id) {
        $reg = DB::table('vres_historial_cambios')->where('id','=',$id)->pluck('registro_previo')->toArray();
        $jreg1 = $reg[0];
        $jreg = json_decode($jreg1);
        return json_encode($reg);
    }

    function borrar_archivo(Request $request){

        try{
            DB::beginTransaction();

            if($request->id){



                $reserva = Reservas::find($request->id);

                if($request->columna=="archivo_1"){

                    if($reserva->archivo_1!=""){
                        $borrar = $this->deleteFile($reserva->archivo_1);

                        if($borrar->success){
                            $reserva->archivo_1 = "";
                            $reserva->save();
                            $reserva->refresh();
                            $res =[
                                'resultado' => 202,
                                'status' => "1",
                                'data' => $reserva,
                            ];
                        }
                    }else{

                        $res =[
                            'resultado' => 202,
                            'status' => "2",
                        ];
                    }
                }
                else if($request->columna=="archivo_2"){
                    if($reserva->archivo_2!=""){
                        $borrar = $this->deleteFile($reserva->archivo_2);

                        if($borrar->success){
                            $reserva->archivo_2 = "";
                            $reserva->save();
                            $reserva->refresh();
                            $res =[
                                'resultado' => 202,
                                'status' => "1",
                                'data' => $reserva,
                            ];
                        }
                    }else{

                        $res =[
                            'resultado' => 202,
                            'status' => "2",
                        ];
                    }
                }

                else if($request->columna=="archivo_3"){
                    if($reserva->archivo_3!=""){
                        $borrar = $this->deleteFile($reserva->archivo_3);

                        if($borrar->success){
                            $reserva->archivo_3 = "";
                            $reserva->save();
                            $reserva->refresh();
                            $res =[
                                'resultado' => 202,
                                'status' => "1",
                                'data' => $reserva,
                            ];
                        }
                    }else{

                        $res =[
                            'resultado' => 202,
                            'status' => "2",
                        ];
                    }
                }
                else if($request->columna=="archivo_4"){
                    if($reserva->archivo_4!=""){
                        $borrar = $this->deleteFile($reserva->archivo_4);

                        if($borrar->success){
                            $reserva->archivo_4 = "";
                            $reserva->save();
                            $reserva->refresh();
                            $res =[
                                'resultado' => 202,
                                'status' => "1",
                                'data' => $reserva,
                            ];
                        }
                    }else{

                        $res =[
                            'resultado' => 202,
                            'status' => "2",
                        ];
                    }
                }
                else if($request->columna=="archivo_5"){
                    if($reserva->archivo_5!=""){
                        $borrar = $this->deleteFile($reserva->archivo_5);

                        if($borrar->success){
                            $reserva->archivo_5 = "";
                            $reserva->save();
                            $reserva->refresh();
                            $res =[
                                'resultado' => 202,
                                'status' => "1",
                                'data' => $reserva,
                            ];
                        }
                    }else{

                        $res =[
                            'resultado' => 202,
                            'status' => "2",
                        ];
                    }
                }
                else if($request->columna=="evento_logo"){
                    if($reserva->evento_logo!=""){
                        $borrar = $this->deleteFile($reserva->evento_logo);

                        if($borrar->success){
                            $reserva->evento_logo = "";
                            $reserva->save();
                            $reserva->refresh();
                            $res =[
                                'resultado' => 202,
                                'status' => "1",
                                'data' => $reserva,
                            ];
                        }
                    }else{

                        $res =[
                            'resultado' => 202,
                            'status' => "2",
                        ];
                    }
                }
            }else{
                $res =[
                    'resultado' => 204,
                    'status' => "0",
                    'error' => 'No se ha enviado el id',
                ];
            }

            DB::commit();
            return $res;


        }catch(\Exception $e) {

            DB::rollback();
			$res= [
				'resultado' => 204,
				'status' => "0",
				'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
				'mensaje' => 'error',
			];

			return $res;
        }


    }

    public function actualiza_salon_mesa(Request $request, $id){
      

        $validator = Validator::make($request->all(), [
            'salon' => 'required',
        ]);
    
        if ($validator->fails()) {

            return response()->json([
                'resultado' => 422,
                'status' => "0",
                'errors' => $validator->errors(),
            ], 422);
        }

        $res =[
            'resultado' => 204,
            'status'    => "0",
            'mensaje'   => "No se ha seleccionado un salon",   
            "error"     => "Hubo un error",       
        ];

        if($id){
            $reserva = Reservas::find($id);   
            $id_historial = $this->previo($reserva->estado,$request);

            $reserva->salon = $request->salon;
            $reserva->mesa = $request->mesa;
            $reserva->save();

            $this->actual($id_historial,$request);
            

            $res =[
                'resultado' => 202,
                'status' => "1",
                'mensaje'=>"Salon y mesa actualizado"                
            ];
        } 

        return $res;       
    }

    public function admin_page(Request $request){

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            // 'login'    => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {

            return response()->json([
                'resultado' => 422,
                'status' => "0",
                'errors' => $validator->errors(),
            ], 422);
        }
        // $user = User::where('username', $request->login)
        // ->orWhere('email', $request->login)->first();

        $resp =[
            'resultado' => 422,
            'status' => "0",
            'mensaje' =>'No existe ninguna coincidencia, vuelva intentar '
        ];        

        $users = User::get();        

        if(count($users)>0){

            $status = 0;
            $usuario_encontrado ="";

            foreach($users as $user){

                if(Hash::check($request->password, $user->password)){

                    if($user->hasRole('SuperUsuario') || $user->hasRole('Administrador Reservas')){
                        // Si consigue una coincidencia evalua el rol si es correcto le cambia el status a 1
                        $status = 1;
                        $usuario_encontrado = $user;  
                        
                        $resp =[
                            'resultado' => 200,
                            'status' => $status,
                            'cod'=> 'confirm-reservas2-24',
                            'mensaje' =>'Usuario garantizado',
                            'usuario' => $user,
                        ];

                        return $resp;

                    }else{

                        $resp =[
                            'resultado' => 422,
                            'status' => "0",
                            'mensaje' =>'Clave no autorizada para administrar reservas',
                        ];

                        return $resp;
                    }
                    // Detendo al conseguir el usuario 
                    break;
                }
            }            
        }

        return $resp;       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservas $reservas)
    {
        //
    }

    private function envioEmailConfirmacionReserva($reserva){

        $sucursal = ResSucursales::find($reserva->sucursal);

        
        $fechaCarbon = Carbon::parse( $reserva->fecha_reserva);
        Carbon::setLocale('es');
        $fechaEspanol = $fechaCarbon->format('d \d\e F \d\e Y');

        $horaCarbon = Carbon::parse($reserva->hora_reserva);
        $horaFormateada = $horaCarbon->format('g:i A');

        $asunto = "BARRICA 94 - SOLICITUD DE RESERVA N° ".$reserva->id." - ACEPTADA";
        $cuerpo = "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica

        $cuerpo.="<p>Estimado(a) ".$reserva->nombre_cliente."</p>";
        $cuerpo.="<p>Hemos aceptado su reservacion. De acuerdo a la informacion detallada abajo. ";

        $cuerpo.= "<p>__________________________________________________________________________________</p>";
        $cuerpo.= "<p>N° de Reserva: ". $reserva->id ."</p>";
        $cuerpo.= "<p>Fecha: ". $fechaEspanol  ."</p>";
        $cuerpo.= "<p>Hora: ". $horaFormateada ."</p>";
        $cuerpo.= "<p>Sucursal: ". $sucursal->sucursal ."</p>";
        $cuerpo.= "<p>Personas: ". $reserva->cantidad_pasajeros."</p>";
        $cuerpo.= "<p>Fecha: ". $fechaEspanol ." a las: ".$horaFormateada ."</p>"; 

        if($reserva->email_cliente!=""){

            $this->constructorEmailBarrica($asunto, $cuerpo, $reserva->email_cliente, $reserva->nombre_cliente );            
        }

    }

    private function envioEmailConfirmacionReservaUser($reserva){

        $sucursal = ResSucursales::find($reserva->sucursal);

        $fechaCarbon = Carbon::parse( $reserva->fecha_reserva);
        Carbon::setLocale('es');
        $fechaEspanol = $fechaCarbon->format('d \d\e F \d\e Y');

        $horaCarbon = Carbon::parse($reserva->hora_reserva);
        $horaFormateada = $horaCarbon->format('g:i A');

        $asunto ="Reserva aceptada";

        $cuerpo = "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica

        $cuerpo.= "<p>Usted acepto la reserva N°:". $reserva->id."</p>";
        $cuerpo.= "<p>Información detallada de la reserva</p>";

        $cuerpo.= "<p>____________________________________________________________</p>";
        $cuerpo.= "<p>N° de Reserva: ". $reserva->id ."</p>";
        $cuerpo.= "<p>Fecha: ". $fechaEspanol  ."</p>";
        $cuerpo.= "<p>Hora: ". $horaFormateada ."</p>";
        $cuerpo.= "<p>Sucursal: ". $sucursal->sucursal ."</p>";
        $cuerpo.= "<p>Personas: ". $reserva->cantidad_pasajeros."</p>";
        $cuerpo.= "<p>Fecha: ". $fechaEspanol ." a las: ".$horaFormateada ."</p>"; 

        // $email = auth()->user()->email;
        $email = 'felixjm@gmail.com';

        if($email !=""){           

            $this->constructorEmailBarrica($asunto, $cuerpo, $email, auth()->user()->name ); 
            
        }

    }

    private function envioEmailRechazoCliente(Request $request, $reserva){

        $asunto ="BARRICA 94 - SOLICITUD DE RESERVA N° ".$reserva->id." - RECHAZADA";       

        $cuerpo = "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
        $cuerpo.= "<p>Ha sido rechazada su reserva con  N°:".$request->id."</p>";
        $cuerpo.= "<p>Con fecha de reserva para el dia: ". Carbon::parse($request->fecha_reserva)->format('d-m-Y')." y Hora: ".$reserva->hora_reserva."</p>";
        $cuerpo.="<p>Fecha de rechazo: ".Carbon::parse($request->fecha_rechazo)->format('d-m-Y');
        $cuerpo.= "<p>Por la siguiente razon: ".$request->razon_rechazo."</p>";

        if($reserva->email_cliente !=""){
            $this->constructorEmailBarrica($asunto, $cuerpo, $reserva->email_cliente, $reserva->nombre_cliente );
        }
    }

    private function envioEmailRechazoUser(Request $request, $reserva){

        $asunto ="BARRICA 94 - SOLICITUD DE RESERVA N° ".$reserva->id." - RECHAZADA";       

        $cuerpo = "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
        $cuerpo.= "<p>Se ha rechazado la reserva N°:".$request->id."</p>";
        $cuerpo.= "<p>Con fecha de reserva para el dia: ". Carbon::parse($request->fecha_reserva)->format('d-m-Y')." y Hora: ".$reserva->hora_reserva."</p>";
        $cuerpo.="<p>Fecha de rechazo: ".Carbon::parse($request->fecha_rechazo)->format('d-m-Y');
        $cuerpo.= "<p>Por la siguiente razon: ".$request->razon_rechazo."</p>";
        $cuerpo.="<p>Usuario Responsable: ".auth()->user()->name."</p>";
        $cuerpo.="<p>Username: ".auth()->user()->username."</p>";

        //Todo: Momentaneamente se enviara a mi email mientras se hace el cambio en configuracion global          
        $this->constructorEmailBarrica($asunto, $cuerpo, 'felix.martinez@devox.cl', 'Felix');

    }

    

    private function envioEmail($correo, $destinatario, $asunto, $cuerpo ){
        $email               = (object)[];
        $email->email        = $correo;
        // Todo se comenta el email de envio verdadero, mientras se realizan pruebas
        // $email->email        = $reserva->email_cliente.";"."karen.milgram@gmail.com";
        $email->destinatario = $destinatario;
        $email->asunto       = $asunto;
        $email->cuerpo       = $cuerpo;
        $correox             = $this->sendemail($email);
        $correox             = json_decode($correox);
        if(isset($correox->code)) trigger_error($correox->message);
    }

    public function valida_estado(){
        // return  Reservas::select('id','estado')->with('estado')->get();
        $reserva = Reservas::select('email_cliente','nombre_cliente','estado')
        ->with('estado_reserva')->find(1);
        return $reserva;

    }


}
