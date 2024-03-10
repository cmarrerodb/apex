<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use App\Models\Pago;
use App\Models\Giftcard;
use App\Models\GiftCredito;
use App\Models\GiftEstados;
use App\Models\GiftHistoria;
use App\Models\GiftMesonero;
use Illuminate\Http\Request;
use App\Http\Traits\Funciones;
use App\Models\GiftFormasPago;
use App\Models\GiftEstadosPago;
use App\Http\Traits\DigOceSpaces;
use Illuminate\Support\Facades\DB;
use App\Models\ConfiguracionGlobal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GiftcardController extends Controller
{
    use DigOceSpaces;
    use Funciones;

    private $hasUploadFiles = false;
    private $rollbackDocs   = "";

    public function __construct()
    {
         /* Declarar variables para rollback */
         $this->rollbackDocs   = null;
         $this->hasUploadFiles = false;
    }

    public function index()
    {
        // dd(auth()->user()->giftcard_ver);
        return view('giftcards.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $data = DB::table('vgiftcards')
        ->select('id','codigo','estado_id','estado','estado_pago',
        'fecha_creacion','hora_creacion','fecha_canje',
        'fecha_anulacion','fecha_vencimiento','beneficiario',
        'email','dias_uso','horario_uso','mesonero','mesa','n_cuenta',
        'adjunto','rut','telefono')
        ->orderBy('id', 'desc')->get()->collect()->toArray();
        return(json_encode($data));
    }
    public function auxiliares() {
        $data = [];
        $data['credito']=GiftCredito::get()->collect()->toArray();
        $data['estado']=GiftEstados::get()->collect()->toArray();
        $data['estado_pago']=GiftEstadosPago::get()->collect()->toArray();
        $data['forma_pago']=GiftFormasPago::get()->collect()->toArray();
        // $data['mesoneros']=GifMesonero::get()->collect()->toArray();
        return(json_encode($data));
    }
    public function generar_qr(Request $request) {
        $hash = str_replace('.','',uniqid('',true));
        $url=url('/').'/giftcard/giftcard_check/'.$hash;
        // $qr="";
       
        $qr = QrCode::format('png')->size(75)->generate($url);
        $base64=base64_encode($qr);
        return response()->json(['qr'=>$base64,'url'=>$url,'codigo'=>$hash]);
    }

    public function revisar_qr(Request $request,$id) {
        $giftcard = DB::table('vgiftcards')->where('id','=',$id)->get()->collect()->toArray();

        $url=url('/').'/giftcard/giftcard_check/'.$giftcard[0]->codigo;
        $qr = QrCode::format('png')->size(75)->generate($url);
        $base64=base64_encode($qr);
        // $base64="";
        return response()->json(['qr'=>$base64,'url'=>$url,'giftcard'=>$giftcard]);
    }
    public function filtros($id,$tipo) {

        switch($tipo) {
            case 'sel_estado':
                if ($id==="0")
                    return json_encode(DB::table('vgiftcards')->get());
                return json_encode(DB::table('vgiftcards')->where('estado_id','=',$id)->get());
                break;
            case 'sel_pago':
                if ($id==="0")
                    return json_encode(DB::table('vgiftcards')->get());
                return json_encode(DB::table('vgiftcards')->where('estado_pago_id','=',$id)->get());
                break;
        }
    }
    public function giftcard_check($codigo) {

        $giftcard = DB::table('vgiftcards')->where('codigo', $codigo)->first();
        if($giftcard){

            $fecha_vencimiento = Carbon::parse($giftcard->fecha_vencimiento);
            $fecha_actual = Carbon::now();

            // Si la giftcard ha sido usada no actualiza el estado a vencido, su estado queda igual
            if($giftcard->estado_id !=2 ){

                if ($fecha_vencimiento->isBefore($fecha_actual)) {
                    Giftcard::where('id', $giftcard->id)->update([
                        'estado_id' => 4
                    ]);
                }
            }
        }
        // $giftcard = DB::table('vgiftcards')->where('codigo', $codigo)->first();

        if (!$giftcard) {
            // return abort(404, 'Giftcard not found');
            return view('errors.gift_not_found');
        }



        // Enviamos la session_id a la Api para validar el pago

        $pago_valido=0;

        //Todo falta aun esta parte

        // if($giftcard->credito_id!=1){ // Si Credito es No

        //     $giftcard_valida = Gitfcard::where('codigo', $codigo )->first();

        //     if($giftcard_valida->session_id){

        //         $response = Http::post( env('URL_API')."/api/validar_pago", [
        //             'session_id' => $giftcard_valida->session_id
        //         ]);

        //         $resultado = $response->object();

        //         $pago_valido = $resultado->status_pago;
        //     }
        // }

        // Todo: Esta pendiente enviar validacion de pago a la vista

        $url_gif = route('giftcard_check', ['codigo' => $giftcard->codigo]);    
        $qr = QrCode::format('png')->size(98)->generate($url_gif);
        $base64 = base64_encode($qr);  


        if (Auth::check()) {
            return view('giftcards.edit', ['giftcard' => $giftcard, 'pago_valido' => $pago_valido, 'img_qr'=> $base64 ]);
        } else {
            return view('giftcards.show', ['giftcard' => $giftcard, 'pago_valido' => $pago_valido, 'img_qr'=> $base64]);
        }
    }
    public function anular_giftcard(Request $request) {

        DB::beginTransaction();
        try {

            $giftcard =  Giftcard::find($request->id);
            $giftcard->estado_id = 3;
            $giftcard->anulado_por_id = auth()->user()->id;
            $giftcard->fecha_anulacion = Carbon::now();
            $giftcard->motivo_anulacion= $request->motivo_anulacion;

            if($giftcard->save()){

                $giftcard->refresh();

                $gift_history              = new GiftHistoria;
                $gift_history->giftcard_id = $giftcard->id;
                $gift_history->user_id     = $giftcard->anulado_por_id;
                $gift_history->descripcion = "Anulada";
                $gift_history->save();

                $res[] = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                ];
            }else{

                $res[] = [
                    'resultado' => 204,
                    'status' => "0",
                    'error' => 'Ha ocurrido un error',
                ];
            }

            /* PREPARANDO EL EMAIL */
            $cuerpo = "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
            $cuerpo.= "<p>Se ha anulado una Giftcard:</p>";
            $cuerpo.= "<p>Numero: ".$request->id."</p>";
            $cuerpo.= "<p>Motivo de la anulación: ".$request->motivo_anulacion."</p>";

            $email               = (object)[];
            /* $email->email        = $request->correo ."; karen.milgram@gmail.com"; Se comento esta linea
            para poder realizar pruebas */
            $email->email        = 'felixjm@gmail.com';
            $email->destinatario = $giftcard->beneficiario ? $giftcard->beneficiario:" Sin Nombre" ;
            $email->asunto       = 'Anulacion de Giftcard';
            $email->cuerpo       = $cuerpo;
            $correox             = $this->sendemail($email);
            $correox             = json_decode($correox);
            if(isset($correox->code)) trigger_error($correox->message);

            DB::commit();

            return json_encode($res);

        } catch(\Exception $e) {
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }
    public function canjear_giftcard(Request $request) {

        // return $request->all();
        // Realizar ajustes de caso de uso aqui 

        DB::beginTransaction();
        try {

            $giftcard = Giftcard::with('estado')->find($request->id);
            $giftcard->estado_id = 2;
            $giftcard->mesonero_id = auth()->user()->id;
            $giftcard->mesonero = auth()->user()->name;
            $giftcard->fecha_canje = Carbon::now();
            $giftcard->n_cuenta = $request->n_cuenta;
            $giftcard->mesa_id = $request->mesa_id;

            if ($request->hasFile('adjunto')){

                $archivox   = $request->file('adjunto');
                $content    = File::get($archivox);
                $extension  = $archivox->getClientOriginalExtension();
                $fileUpload = $this->uploadFile("b94_reservas2/giftcard", $content,$extension,null,true);
                if(!$fileUpload->saved) trigger_error('error-upload-archivo');
                $adjunto = $fileUpload->privateUrl;

                $giftcard->adjunto = $adjunto;
            }
            $giftcard->save();
            $giftcard->refresh();

            $gift_history              = new GiftHistoria;
            $gift_history->giftcard_id = $giftcard->id;
            $gift_history->user_id     = auth()->user()->id;
            $gift_history->descripcion = "Canjeada";
            $gift_history->save();

            //Envio email a beneficiario
            $this->envioEmailGiftcadCanjeada($giftcard);
            //Envio email al comprador
            $this->envioEmailGiftcadCanjeada($giftcard,'comprador');
            //Envio email al comprador
            $this->envioEmailGiftcadCanjeada($giftcard,'administrador');
           
             //Todo: Simulando webhook para actualizar los datos de uso en sistema giftcard 
            // Un vez canjeada la giftcard el webhook se ejecuta           
            $response = Http::post( env('URL_API')."/api/sincroniza-caso-uso", [                
                'session_id'=> $giftcard->session_id,
            ]);
            $respuesta_api = $response->object();      
          

            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'data' => $giftcard,
                'error' => '',
            ];

            DB::commit();

            return json_encode($res);
        } catch(\Exception $e) {
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }


    public function cambiar_estado(Request $request){
        // dd($request->all());

        DB::beginTransaction();

        try {

            $giftcard = Giftcard::find($request->id);
            $giftcard->estado_id = $request->estado_id;
            $giftcard->updated_at = Carbon::now();
            $giftcard->save();

            $res =[
                'resultado' => 202,
                'status' => "1",
                'mensaje' => 'Actualizado exitosamente',
            ];

            DB::commit();
            return json_encode($res);

        } catch (\Throwable $e) {
            $res = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }

    public function cambiar_vencimiento(Request $request){


        DB::beginTransaction();

        try {

            $giftcard = Giftcard::find($request->id);
            $giftcard->fecha_vencimiento =  Carbon::now()->addDays($request->fecha_vencimiento);
            $giftcard->estado_id = 1; // Estado disponible
            $giftcard->updated_at = Carbon::now();
            $giftcard->save();

            $res =[
                'resultado' => 202,
                'status' => "1",
                'mensaje' => 'Giftcard actualizada exitosamente',
            ];

            DB::commit();
            return json_encode($res);

        } catch (\Throwable $e) {
            $res = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }

    public function enviar_email(Request $request){

        // dd($request->all());


        DB::beginTransaction();

        try {

            $giftcard = Giftcard::find($request->id);

            $url = route('giftcard_check', ['codigo' => $giftcard->codigo]);
            $qr = QrCode::format('png')->size(85)->generate($url);
            $base64=base64_encode($qr);
            

            $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
            $cuerpo.= "<p align='center' style='padding:10px;'><img width='100px' src='data:image/png;base64,".$base64."'></p>";

            $cuerpo.= "<p>Se le ha enviado una giftcard realizada el dia ". Carbon::parse($giftcard->created_at)->format('d-m-Y') .".</p>";
            $cuerpo.= "<p>A travez de este link podra ver el detalle de la misma: <a href='".$url."'>".$url."</a></p>";

            $destinatario =  $giftcard->destinatario !=""? $giftcard->destinatario: "Sin nombre de destinatario";

            if($request->email_beneficiario){
                $this->constructorEmail('Envio de Giftcard', $cuerpo, $request->email_beneficiario, $destinatario);
            }

            if($request->email_otro){
                $this->constructorEmail('Envio de Giftcard', $cuerpo, $request->email_otro, $destinatario);
            }


            $res =[
                'resultado' => 202,
                'status' => "1",
                'mensaje' => 'Giftcard enviada exitosamente',
            ];

            DB::commit();
            return json_encode($res);

        } catch (\Throwable $e) {
            $res = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }


    function creacion_masiva(){

        $data ="";

        return view('giftcards.creacion-masiva', compact('data'));


    }
   

    public function listar_mesoneros() {
        return json_encode(GiftMesonero::get()->collect()->toArray());

    }
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $giftcard = $request->all();
       
        /** */
        // unset($giftcard['beneficio'], $giftcard['tipo_beneficio']);

        $giftcard['created_id']=auth()->user()->id;
        DB::beginTransaction();
        try {
            // $gift = Giftcard::create($giftcard); De esta forma no estaba tomando todos los campos enviados.
            $gift = new Giftcard;
            $gift->codigo = $giftcard['codigo'];
            $gift->estado_pago_id = $giftcard['estado_pago_id'];

            if($giftcard['credito_id']==1){ // Si Credito es Sí

                $gift->estado_id = 1; // ESTADO  DISPONIBLE

            }
            elseif($giftcard['credito_id']== 2){ // Si Credito es No

                if($giftcard['estado_pago_id'] == 1 ){ //Si el estado de pago es PENDIENTE

                    $gift->estado_id = 5; // ESTADO PENDIENTE PAGO

                }elseif($giftcard['estado_pago_id'] == 2){ //Si el estado de pago es PAGADA

                    $gift->estado_id = 1; // ESTADO  DISPONIBLE
                }
            }
            elseif($giftcard['credito_id']== 3){ // Si Credito es REGALO

                if($giftcard['estado_pago_id'] == 1 ){ //Si el estado de pago es PENDIENTE

                    $gift->estado_id = 5; // ESTADO PENDIENTE PAGO

                }elseif($giftcard['estado_pago_id'] == 2){ //Si el estado de pago es PAGADA

                    $gift->estado_id = 1; // ESTADO  DISPONIBLE
                }
            }

            if( $giftcard['fecha_vencimiento'] == 6  ){
                $giftcard['fecha_vencimiento'] = 182;
            }else if($giftcard['fecha_vencimiento'] == 1){
                $giftcard['fecha_vencimiento'] = 365;
            }else{
                $giftcard['fecha_vencimiento'] = $giftcard['fecha_vencimiento'];
            }

            $fecha_vencimiento = Carbon::now()->addDays($giftcard['fecha_vencimiento']);

            $gift->credito_id = $giftcard['credito_id'];
            $gift->forma_pago_id = $giftcard['forma_pago_id'];
            $gift->beneficiario = $giftcard['beneficiario'];
            $gift->email = $giftcard['email'];
            $gift->telefono = $giftcard['telefono'];
            $gift->factura = $giftcard['factura'];
            $gift->fecha_vencimiento = $fecha_vencimiento;
            $gift->dias_uso = $giftcard['dias_uso'];
            $gift->horario_uso_desde = $giftcard['horario_uso_desde'];
            $gift->horario_uso_hasta = $giftcard['horario_uso_hasta'];
            $gift->platos_excluidos = $giftcard['platos_excluidos'];
            $gift->created_id = $giftcard['created_id'];
            $gift->num_factura = $giftcard['num_factura'];
            $gift->razon_social = $giftcard['razon_social'];
            $gift->rut = $giftcard['rut'];
            $gift->giro = $giftcard['giro'];
            $gift->direccion = $giftcard['direccion'];
            // $gift->fecha_factura = $giftcard['fecha_factura'];
            $gift->monto_factura = $giftcard['monto_factura'];
            $gift->tipo_beneficio = $giftcard['tipo_beneficio'];
            $gift->beneficio = $giftcard['beneficio'];
            $gift->new_ben_monto = $giftcard['beneficio'];

            $gift->vendido_por = $giftcard['vendido_por'];

            $gift->nombre_comprador = $giftcard['nombre_comprador'];
            $gift->email_comprador = $giftcard['email_comprador'];
            $gift->telefono_comprador = $giftcard['telefono_comprador'];
            $gift->session_id = $giftcard['session_id'];


            if ($request->hasFile('adjunto_menu')){
                $archivox   = $request->file('adjunto_menu');
                $content    = File::get($archivox);
                $extension  = $archivox->getClientOriginalExtension();
                $fileUpload = $this->uploadFile("b94_reservas2/giftcard", $content,$extension,null,true);
                if(!$fileUpload->saved) trigger_error('error-upload-archivo');
                $adjunto_menu = $fileUpload->privateUrl;
                $gift->adjunto_menu = $adjunto_menu;
            }

            $gift->save();

            // Genero un nuevo registro en la historia de la giftcard
            $gift_history              = new GiftHistoria;
            $gift_history->giftcard_id = $gift->id;
            $gift_history->user_id     = $gift->created_id;
            $gift_history->descripcion = "Creada";
            $gift_history->save();
            

            $url=url('/').'/giftcard/giftcard_check/'.$gift->codigo;             
            $qr = QrCode::format('png')->size(75)->generate($url);
            $base64=base64_encode($qr);

            // Todo me quede aqui falta  validar y enviar informacion al response 
            
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'data'=> $gift, 
                'qr' => $base64,
            ];

            /* PREPARANDO EL EMAIL */
            $cuerpo = "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
            $cuerpo.= "<p align='center' style='padding:10px;'><img width='100px' src='data:image/png;base64,".$base64."'></p>";
            $cuerpo.= "<p>Se ha generado una Giftcard con los siguientes datos:</p>";
            $cuerpo.= "<p>Nombre del beneficiario: ".$giftcard['beneficiario']."</p>";
            $cuerpo.= "<p>Email email del beneficiario: ".$giftcard['email']."</p>";
            $cuerpo.= "<p>Télefono: ".$giftcard['telefono']."</p>";

            $cuerpo.= "<p>En este link podra ver la giftcard creada: <a href='{$url}'>Ver giftcard</a></p>";

            $email               = (object)[];
            /* $email->email        = $request->correo ."; karen.milgram@gmail.com"; Se comento esta linea
            para poder realizar pruebas */
            $email->email        = 'felixjm@gmail.com'; // "karen.milgram@gmail.com"
            $email->destinatario = $giftcard['beneficiario'] ? $giftcard['beneficiario']:'Sin Beneficiario' ;
            $email->asunto       = 'Creación de Giftcard';
            $email->cuerpo       = $cuerpo;
            $correox             = $this->sendemail($email);
            $correox             = json_decode($correox);
            if(isset($correox->code)) trigger_error($correox->message);
            
            DB::commit();

            //Todo: Simulando webhook para actualizar los datos en sistema giftcard 
            // Un vez creada la giftcard el webhook se ejecuta           
            $response = Http::post( env('URL_API')."/api/sincroniza-crea-gift", [                
                'data'=> $gift,
            ]);
            $respuesta_api = $response->object();      
            // return $respuesta_api;


            return json_encode($res);

        } catch(\Exception $e) {
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }

    // Todo: Hacer ajustes de envio de email y/u otros
    public function guardar_masivo(Request $request)
    {
        $giftcard = $request->all();

        $nombre_beneficiario = json_decode($giftcard['nombre_beneficiario']);
        $email_beneficiario = json_decode($giftcard['email_beneficiario']);
        $telefono_beneficiario = json_decode($giftcard['telefono_beneficiario']);
        $mensaje_beneficiario = json_decode($giftcard['mensaje_beneficiario']);
        $notifica_beneficiario = json_decode($giftcard['notifica_beneficiario']);

        $giftcard['created_id']=auth()->user()->id;
        DB::beginTransaction();
        try {
            // $gift = Giftcard::create($giftcard); De esta forma no estaba tomando todos los campos enviados.

            if(count($nombre_beneficiario)>0){

                foreach ($nombre_beneficiario as $key => $value) {

                    $gift = new Giftcard;

                    // Si el beneficiario es distinto a vacio
                    if($value!=""){

                        $hash = str_replace('.','',uniqid('',true));
                        $url=url('/').'/giftcard/giftcard_check/'.$hash;

                        $gift->codigo = $hash;

                        $gift->estado_pago_id = $giftcard['estado_pago_id'];

                        if($giftcard['credito_id']==1){ // Si Credito es Sí

                            $gift->estado_id = 1; // ESTADO  DISPONIBLE

                        }

                        elseif($giftcard['credito_id']== 2){ // Si Credito es No

                            if($giftcard['estado_pago_id'] == 1 ){ //Si el estado de pago es PENDIENTE

                                $gift->estado_id = 5; // ESTADO PENDIENTE PAGO

                            }elseif($giftcard['estado_pago_id'] == 2){ //Si el estado de pago es PAGADA

                                $gift->estado_id = 1; // ESTADO  DISPONIBLE
                            }
                        }
                        elseif($giftcard['credito_id']== 3){ // Si Credito es REGALO

                            if($giftcard['estado_pago_id'] == 1 ){ //Si el estado de pago es PENDIENTE

                                $gift->estado_id = 5; // ESTADO PENDIENTE PAGO

                            }elseif($giftcard['estado_pago_id'] == 2){ //Si el estado de pago es PAGADA

                                $gift->estado_id = 1; // ESTADO  DISPONIBLE
                            }
                        }

                        if( $giftcard['fecha_vencimiento'] == 6  ){
                            $giftcard['fecha_vencimiento'] = 182;
                        }else if($giftcard['fecha_vencimiento'] == 1){
                            $giftcard['fecha_vencimiento'] = 365;
                        }else{
                            $giftcard['fecha_vencimiento'] = $giftcard['fecha_vencimiento'];
                        }

                        $fecha_vencimiento = Carbon::now()->addDays($giftcard['fecha_vencimiento']);

                        $gift->credito_id = $giftcard['credito_id'];
                        $gift->forma_pago_id = $giftcard['forma_pago_id'];

                        $gift->beneficiario = $value;
                        $gift->email = $email_beneficiario[$key];
                        $gift->telefono = $telefono_beneficiario[$key];
                        $gift->mensaje_beneficiario = $mensaje_beneficiario[$key];

                        $gift->factura = $giftcard['factura'];
                        $gift->fecha_vencimiento = $fecha_vencimiento;
                        $gift->dias_uso = $giftcard['dias_uso'];
                        $gift->horario_uso_desde = $giftcard['horario_uso_desde'];
                        $gift->horario_uso_hasta = $giftcard['horario_uso_hasta'];
                        $gift->platos_excluidos = $giftcard['platos_excluidos'];
                        $gift->created_id = $giftcard['created_id'];
                        $gift->num_factura = $giftcard['num_factura'];
                        $gift->razon_social = $giftcard['razon_social'];
                        $gift->rut = $giftcard['rut'];
                        $gift->giro = $giftcard['giro'];
                        $gift->direccion = $giftcard['direccion'];
                        $gift->email_dte = $giftcard['email_dte'];

                        // $gift->fecha_factura = $giftcard['fecha_factura'];
                        $gift->monto_factura = $giftcard['monto_factura'];
                        $gift->tipo_beneficio = $giftcard['tipo_beneficio'];
                        $gift->beneficio = $giftcard['beneficio'];
                        $gift->new_ben_monto = $giftcard['beneficio'];
                        $gift->vendido_por = $giftcard['vendido_por'];

                        $gift->nombre_comprador = $giftcard['nombre_comprador'];
                        $gift->email_comprador = $giftcard['email_comprador'];
                        $gift->telefono_comprador = $giftcard['telefono_comprador'];
                        $gift->session_id = $giftcard['session_id_masivo'];

                        if ($request->hasFile('adjunto_menu')){
                            $archivox   = $request->file('adjunto_menu');
                            $content    = File::get($archivox);
                            $extension  = $archivox->getClientOriginalExtension();
                            $fileUpload = $this->uploadFile("b94_reservas2/giftcard", $content,$extension,null,true);
                            if(!$fileUpload->saved) trigger_error('error-upload-archivo');
                            $adjunto_menu = $fileUpload->privateUrl;
                            $gift->adjunto_menu = $adjunto_menu;
                        }

                        $gift->save();

                        //Nuevo registro para el historial de giftcard
                        $gift_history              = new GiftHistoria;
                        $gift_history->giftcard_id = $gift->id;
                        $gift_history->user_id     = auth()->user()->id;
                        $gift_history->descripcion = "Creada";
                        $gift_history->save();


                        if( $notifica_beneficiario[$key] == true){
                             /* PREPARANDO EL EMAIL */
                            // if($email_beneficiario[$key]!=""){
                                $url_gif = route('giftcard_check', ['codigo' => $gift->codigo]);
                                $qr = QrCode::format('png')->size(85)->generate($url_gif);
                                $base64=base64_encode($qr);

                                $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica

                                $cuerpo.= "<p align='center' style='padding:10px;'><img width='100px' src='data:image/png;base64,".$base64."'></p>";

                                $cuerpo.= "<p>Se ha generado una Giftcard con los siguientes datos:</p>";
                                $cuerpo.= "<p>Nombre del beneficiario: ".$value."</p>";
                                $cuerpo.= "<p>Email email del beneficiario: ".$email_beneficiario[$key]."</p>";
                                $cuerpo.= "<p>Télefono: ".$telefono_beneficiario[$key]."</p>";
                                $cuerpo.= "<p>Monto: $". $this->formatNumberEs($gift->new_ben_monto)."</p>"; 
                                // Todo:me quede aqui 


                                if($mensaje_beneficiario[$key]){
                                    $cuerpo.="<p>Mensaje:".$mensaje_beneficiario[$key]."</p>";
                                }

                                $email               = (object)[];
                                /* $email->email        = $request->correo ."; karen.milgram@gmail.com"; Se comento esta linea
                                para poder realizar pruebas */
                                $email->email        = $email_beneficiario[$key];
                                $email->destinatario = $nombre_beneficiario[$key];
                                $email->asunto       = 'Creación de Giftcard';
                                $email->cuerpo       = $cuerpo;
                                $correox             = $this->sendemailGift($email);
                                $correox             = json_decode($correox);

                                if(isset($correox->code)) trigger_error($correox->message);
                            // }

                        }

                        //Todo: Simulando webhook para actualizar los datos en sistema giftcard 
                        // Un vez creada la giftcard el webhook se ejecuta           
                        $response = Http::post( env('URL_API')."/api/sincroniza-crea-gift", [                
                            'data'=> $gift,
                        ]);
                        $respuesta_api = $response->object();      
                    }

                }// End Foreach
            }

            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
            ];

            DB::commit();
            return json_encode($res);

        } catch(\Exception $e) {
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
    }

    public function sincronizar(){

        return view('giftcards.sincronizar');

    }

    public function get_sincronizar(Request $request){

        // Reviso el listado de sincronizacion de la api de giftcard_pay
  
        $apiResponse = Http::get(env('URL_API').'/api/sincroniza');

        $respuesta_obtenida =[];

        if ($apiResponse->successful()) {
            // El API
            $data =  $apiResponse->object();

            if( $data->status==1){

                // return $data->data;
                $datos = $data->data;

                // Si hay mas de 1 registro por sincronizar enviar mensaje de alerta 
                if(count($datos)>1){

                    $this->envioEmailNoticacionSincroniza('felixjm@gmail.com'); //Todo: he colocado este email para realizar las pruebas; debe ser el administrador.

                }

                // Guardo la informacón de las giftcard en reservas2
                $sincronizacion = $this->guardar_sincronizacion($datos);

                $resultado = json_decode($sincronizacion);

                // Si no tengo errores continuo
                if( $resultado->status == 1 ){

                    //Envio la respuesta obtenida a la api de giftcard_pay
                    $apiActualiza = Http::post(env('URL_API').'/api/sincroniza-response',[
                        'datos' => $resultado,
                    ]);

                    $respuesta_obtenida = $apiActualiza->object();

                }else{ // Si no, envío los errores que genera la creacion de la(s) giftcard(s)

                    $respuesta_obtenida = $sincronizacion;
                }

            }
            else{ //Si no existes datos por sincronizar

                $respuesta_obtenida = [
                    'respuesta' => 204,
                    'status' => 0,
                    'mensaje' => 'No hay datos a sincronizar, todo esta al dia'
                ];
            }

        } else {
            // Hubo un error en la respuesta del API
            return 'Hubo un error';
        }

        if($request->tipo){ // Devuelvo una vista

            return redirect()->route('giftcard.sincronizar')->with('respuesta', $respuesta_obtenida );
        }else{

            return $respuesta_obtenida ;
        }
    }


    private function guardar_sincronizacion($datos){

        DB::beginTransaction();

        //Todo: Esta pendiente validar si status_sync es 2 o 0
        // Si es 0 genera tod el codigo si no, solo editar las giftcard

        try {

            $dias_uso =[
                'domingo'   => true,
                'lunes'     => true,
                "martes"    => true,
                "miercoles" => true,
                "jueves"    => true,
                "viernes"   => true,
                "sabado"    => true,
            ];

            $compra_id=[];

            foreach ($datos as $key => $dato) {                

                $compra_id[] = [
                    'compra_id'=> $dato->compras_id
                ];  

                // Todo: este primer email se envia desde giftcard_pay 
                // Envio de email indicando que realizó una compra
                // $this->envioEmailComprador($dato);            
 
                //Preparo Email para el comprador si ha sido pagada  // Estado pagado
                if($dato->status_sync!=2){ // status_sync = 2 es zsolo para editar beneficiarios
                    
                    if($dato->pago_estados_id == 3){
                        $this->envioEmailCompradorPagoExitoso($dato);
                    }
    
                    if($dato->pago_estados_id == 4){ //Estado Rechazado en compra
                       
                        // $this->envioEmailCompradorPagoRechazadoTransBank($dato);
                    }
                }                   
                

                // Todo: Pendiente ajustar la entrada de datos a mostrar

                $session_id = $dato->session_id;

                if($dato->pago_tipos_id == 1 ){ // Transferencia
                    $forma_pago_id = 4; // Transferencia       
                    if($dato->status_sync!=2){
                        // Ya que es transferencia se envia el email al comprador indicando que su pago esta pendiente 
                        $this->envioEmailCompradorPendientePago($dato);                    

                    }                
                }
                else {
                    $forma_pago_id = 3; // Tarjeta de credito
                }

                $pago_estado_id = 1; // Pendiente
                if($dato->pago_estados_id == 2 || $dato->pago_estados_id ==1 ){ // En revisión 2 o Pendiente 1 desde api
                    $pago_estado_id = 1; //Pendiente
                }
                else if( $dato->pago_estados_id == 3 ){ // Pagado desde Api
                    $pago_estado_id = 2; //Pagado
                }
                else if( $dato->pago_estados_id == 5){ // Anulado desde desde Api
                    $pago_estado_id = 3; // Anulada

                    
                }          

                // Todo de momento usarlo de esta forma implemetar la funcion privada agregaOanulaPago
                if($dato->status_sync!=2){

                    $pago = Pago::create([                
                        'estado_pago_id' => $pago_estado_id, 
                        'forma_pago_id'  => $forma_pago_id, 
                        'monto'          => $dato->monto, // Monto general de la compra
                        'fecha'          => $dato->fecha, // Monto general de la compra
                        'hora'           => $dato->hora, // Monto general de la compra
                        'cod_transbank'  => $dato->cod_transbank1,
                        'url_adjunto'    => $dato->url_adjunto, //Todo no esta guardando el adjunto, revisar
                        'status_pago'    => $dato->status_validacion_pago == ""?0: $dato->status_validacion_pago,
                        'observaciones'  => $dato->observaciones,  
                        'session_id'     => $dato->session_id,                
                    ]); 
                    
                }

                // Datos de beficiarios para las giftcards       
                $beneficiarios = json_decode($dato->request);

                foreach ($beneficiarios as $key2 => $beneficiario){

                    $fecha_vencimiento = Carbon::now()->addDays(182); // 6 meses

                    $gift = new Giftcard;

                    $motivo_anulacion ="";                    
                    $anulado_por = "";
                    $url_gif = route('giftcard_check', ['codigo' => $beneficiario->codigo]);

                    if($dato->pago_estados_id == 5){ // Estado anulada 

                        $estado_id = 3; // Cambia su estado a anulada
                        $motivo_anulacion = $dato->observaciones;                        
                        $anulado_por = 1000; 

                        // Envio email indicando que su giftcard fue anulado 
                        if($beneficiario->email_bene !=""){

                            $asunto = "Anulacion de Giftcard";
                            $cuerpo= "<p align='center' style='padding:10px;'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>"; 
                            $cuerpo.= "<p>Se ha anulado  una Gfitcard con los siguientes datos:</p>";
                            $cuerpo.= "<p>Nombre del beneficiario: ".$beneficiario->nombre_bene."</p>";
                            $cuerpo.= "<p>Email email del beneficiario: ".$beneficiario->email_bene."</p>";
                            $cuerpo.= "<p>Télefono: ".$beneficiario->telefono_bene."</p>";
                            $cuerpo.= "<p>En este link podra ver la giftcard anulada: <a href='{$url_gif}'>Ver mi giftcard</a></p>";

                            if($beneficiario->mensaje_bene){
                                $cuerpo.="<p>Mensaje:".$beneficiario->mensaje_bene."</p>";
                            }
                            // Envio los datos del Email  
                            if($dato->status_sync!=2){

                                $this->constructorEmail($asunto, $cuerpo, $beneficiario->email_bene, $beneficiario->nombre_bene);

                            }                             
                        }         


                    }else if($dato->pago_estados_id == 3){ // Estado pagado

                        $estado_id = 1; // cambia su estado a Disponible

                        // Envio Email de la giftcard ya esta disponible                        

                        if($beneficiario->email_bene !=""){
                           

                            $qr = QrCode::format('png')->size(85)->generate($url_gif);
                            $base64=base64_encode($qr);

                            $asunto = "Creación de Giftcard";

                            $cuerpo= "<p align='center' style='padding:10px;'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";                           
                            $cuerpo.= "<p align='center' style='padding:10px;'><img width='100px' src='data:image/png;base64,".$base64."'></p>";
                            

                            $cuerpo.= "<p><b>Se ha generado una Giftcard con los siguientes datos:</b></p>";
                            $cuerpo.= "<p>Nombre del beneficiario: ".$beneficiario->nombre_bene."</p>";
                            $cuerpo.= "<p>Email email del beneficiario: ".$beneficiario->email_bene."</p>";
                            $cuerpo.= "<p>Télefono: ".$beneficiario->telefono_bene."</p>";
                            $cuerpo.= "<p>En este link podra ver su giftcard: <a href='{$url_gif}'>Ver mi giftcard</a></p>";

                            if($beneficiario->mensaje_bene){
                                $cuerpo.="<p>Mensaje:".$beneficiario->mensaje_bene."</p>";
                            }
                            // Envio los datos del Email  
                            if($dato->status_sync!=2){

                                $this->constructorEmail($asunto, $cuerpo, $beneficiario->email_bene, $beneficiario->nombre_bene);

                            }                             
                        }         


                    }else{

                        $estado_id = 5; // cambia su estado a Pendiente de Pago
                    }
                    //Reviso que la giftcard no esté creada
                    // $valida_giftcard = Giftcard::where('codigo', $beneficiario->codigo)->count();
                   
                                  
                    $giftcard = Giftcard::where('codigo', $beneficiario->codigo)->first();
                    // Si existe la giftcard actualizamos los datos 
                    if($giftcard){

                        if($dato->status_sync==2){ // status_sync = 2 solo es para poder editar beneficiarios
                            
                            $giftcard->beneficiario         = $beneficiario->nombre_bene;   
                            $giftcard->email                = $beneficiario->email_bene;   
                            $giftcard->mensaje_beneficiario = $beneficiario->mensaje_bene;   
                                               
                        }else{                          
                         
                            $giftcard->forma_pago_id  = $forma_pago_id;   
                            $giftcard->estado_pago_id = $dato->pago_estados_id == 3 ? 2 : 1;  // Estado Pagado= 2, Estado Pendiente = 1 ;   

                            if($dato->pago_estados_id == 3  || $dato->pago_estados_id == 5 ){  
                                $gift_history = new GiftHistoria;
                                $gift_history->giftcard_id = $giftcard->id;
                                $gift_history->user_id     = $giftcard->created_id;                         

                                if($dato->pago_estados_id == 3){ /*Pagada*/
                                    $gift_history->descripcion = "Compra exitosa";
                                }

                                else if($dato->pago_estados_id == 5 ){ /*Anulada*/
                                    $giftcard->motivo_anulacion  = $dato->observaciones;
                                    $giftcard->fecha_anulacion   =  date('Y-m-d');

                                    $gift_history->descripcion = "Anulada";
                                }
                                // Genero un nuevo registro en el historial de giftcard
                                $gift_history->save();
                            }
                           
                             //Evaluar si fue USADA o si estaba Disponible antes,  ya que pudo haber sido Crédito y esta disponible
                            if( $giftcard->estado_id != 1 || $giftcard->estado_id != 2 ){ // Estado disponible = 1, Estado Usada = 2                            
                                $giftcard->estado_id = $estado_id;
                            }
    
                            if($forma_pago_id == 4  ){ // Transferencia
                                $giftcard->adjunto_pago = $dato->url_adjunto;
                            }
    
                            $giftcard->pago_id = $pago->id;  
                        }
                        //Actualizo la giftcard
                        $giftcard->save();
                        

                    }else{

                        $gift = Giftcard::create(
                            // ['codigo' => $beneficiario->codigo],
                            [
                                'credito_id'           => 2,
                                'estado_pago_id'       => $dato->pago_estados_id == 3 ? 2 : 1, // Estado Pagado= 2, Estado Pendiente = 1 ; 
                                'estado_id'            => $estado_id, // Estado Disponible = 1 , Pendiente de pago = 5, anulado = 3
                                'session_id'           => $session_id,
                                'forma_pago_id'        => $forma_pago_id,
            
                                'codigo'               => $beneficiario->codigo,
                                'beneficiario'         => $beneficiario->nombre_bene,
                                'email'                => $beneficiario->email_bene,
                                'telefono'             => $beneficiario->telefono_bene,
                                'mensaje_beneficiario' => $beneficiario->mensaje_bene,
                                'new_ben_monto'        => $beneficiario->monto_bene,
                                'motivo_anulacion'     => $motivo_anulacion,
            
                                'factura'              => $dato->rut !="" ? true:false,
                                'fecha_vencimiento'    => $fecha_vencimiento,
                                'dias_uso'             => json_encode($dias_uso),
                                'horario_uso_desde'    => '08:00:00',
                                'horario_uso_hasta'    => '23:00:00',
                                'created_id'           => 1000,
            
                                'razon_social'         => $dato->razon_social,
                                'rut'                  => $dato->rut,
                                'giro'                 => $dato->giro,
                                'direccion'            => $dato->direccion,
    
                                'monto_factura'        => $beneficiario->monto_bene,
                                'tipo_beneficio'       => "MONTO",
                                'beneficio'            => $beneficiario->monto_bene,
                                'vendido_por'          => 'WEB',
            
                                'nombre_comprador'     => $dato->nombre_comprador,
                                'email_comprador'      => $dato->email_comprador,
                                'telefono_comprador'   => $dato->telefono_comprador,
                                'adjunto_pago'         => $dato->url_adjunto, 
                                'pago_id' => $pago->id
                            
                            ]
                        ); 
                        
                        //Genero un nuevo registro de creación
                        $gift_historia = GiftHistoria::create([
                            'giftcard_id'=> $gift->id,
                            'user_id'=> $gift->created_id,
                            'descripcion' =>'Creada',
                        ]);

                        if($dato->pago_estados_id == 3){ // Pagado 
                            //Genero un nuevo registro si la  de compra es exitosa
                            $gift_history = new GiftHistoria;
                            $gift_history->giftcard_id= $gift->id;
                            $gift_history->user_id= $gift->created_id;
                            $gift_history->descripcion = "Compra exitosa";
                            $gift_history->save();
                        }

                    }

                }
                
                DB::commit();

                // Busco giftcard creadas para generales sua pagos 
                //Agrego pago si tengo  resultado 

                // $this->agregaOanulaPago($dato);             

            } // End Foreach sincroniza

            $res = [
                'resultado' => 202,
                'status'    => "1",
                'mensaje'   => 'Se realizó la sincfronizacion exitosamente',
                'compras'      => $compra_id,
            ];

            // DB::commit();

            return json_encode($res);
        }

        catch (\Throwable $e) {
            $res = [
                'resultado' => 500,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];

            DB::rollback();

            return json_encode($res);
        }

    }

    // TODO: Faltando probar el envio de los emails 

    

    private function agregaOanulaPago($dato ){

        DB::beginTransaction();
        try{

            if($dato->pago_tipos_id == 1 ){ // Transferencia
                $forma_pago_id = 4; // Transferencia
            }
            else {
                $forma_pago_id = 3; // Tarjeta de credito
            }

            $pago_estado_id = 1; // Pendiente
            if($dato->pago_estados_id == 2 || $dato->pago_estados_id ==1 ){ // En revisión 2 o Pendiente 1 desde api
                $pago_estado_id = 1; //Pendiente
            }
            else if( $dato->pago_estados_id == 3 ){ // Pagado desde Api
                $pago_estado_id = 2; //Pagado
            }
            else if( $dato->pago_estados_id == 5){ // Anulado desde desde Api
                $pago_estado_id = 3; // Anulada
            }  
            
            $pago = Pago::create([                
                'estado_pago_id' => $pago_estado_id, 
                'forma_pago_id'  => $forma_pago_id, 
                'monto'          => $dato->monto, // Monto general de la compra
                'fecha'          => $dato->fecha, 
                'hora'           => $dato->hora, 
                'cod_transbank'  => $dato->cod_transbank1,
                'url_adjunto'    => $dato->url_adjunto,
                'status_pago'    => $dato->status_validacion_pago == ""?0: $dato->status_validacion_pago,
                'observaciones'  => $dato->observaciones,  
                'session_id'     => $dato->session_id,                
            ]); 
            
        
            Giftcard::where('session_id', $dato->session_id)->update(['pago_id' =>  $pago->id]);
           
            $res = [
                'resultado' => 202,
                'status'    => "1",
                'mensaje'   => 'Se crearon los pagos correspondiente a cada giftcard',  
                'data' => $pago,              
            ];
            DB::commit();

            return json_encode($res);

        }
        catch (\Throwable $e) {
            $res = [
                'resultado' => 500,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];

            DB::rollback();

            return json_encode($res);
        }

    }

    private function agregaOanulaPago2($dato ){

        DB::beginTransaction();
        try{
            
            $gift_pagos = Giftcard::where('session_id', $dato->session_id)->get();
    
            if(count($gift_pagos)>0){
    
                foreach ($gift_pagos as $gift_pago){

                    if($dato->pago_estados_id == 5){ // Estado anulada 

                        Pago::where('giftcard_id', $gift_pago->id)->update(['estado_pago_id' => 3]); // Cambio el estado a anulado
                    
                    }else{ // Si el pago no es anulado 

                        $pago = Pago::create([
                            'giftcard_id'=> $gift_pago->id,
                            'estado_pago_id' => $gift_pago->estado_pago_id, 
                            'forma_pago_id' => $gift_pago->forma_pago_id, 
                            'monto' =>  $dato->monto, // Monto general de la compra
                            'fecha' =>  $dato->fecha, // Monto general de la compra
                            'hora' =>  $dato->hora, // Monto general de la compra
                            'cod_transbank' => $dato->cod_transbank1,
                            'url_adjunto' => $dato->url_adjunto,
                            'status_pago' => $dato->status_validacion_pago ==""?0:$dato->status_validacion_pago,
                            'observaciones' => $dato->observaciones,                   
                        ]);
                    }
                }
            }

            $res = [
                'resultado' => 202,
                'status'    => "1",
                'mensaje'   => 'Se crearon los pagos correspondiente a cada giftcard',                
            ];
            DB::commit();
            return json_encode($res);

        }
        catch (\Throwable $e) {
            $res = [
                'resultado' => 500,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];

            DB::rollback();

            return json_encode($res);
        }

    }

    public function buscarGiftcards($session_id){

        if($session_id){

            $giftcards = Giftcard::where('session_id', $session_id)->get();
            return $giftcards;
        }

    }

    public function historial($codigo){

        $gift = Giftcard::with('historial')->where('codigo', $codigo)->firstOrFail();

        return view('giftcards.historial',compact('gift'));

    }

    //Todo: Funcion para enviar emal el beneficiario antes de vencerse su giftcard -usar cron job diario

    public function verificaGiftcarsEmail(){   

        try {
            
            $where =[
                ['tipo_id', 4], // Notificación giftcard no usada - beneficiario
                ['activo', 1],  // Notificacion Activa "Prendida"
            ];
            //Válido que exista información 
            $configura = ConfiguracionGlobal::where($where)->first();
    
            if($configura){
    
                $fecha_actual = Carbon::now();// Obtengo la fecha actual    
                // $fecha = Carbon::parse($registro->created_at);
                // $fechaEnEspanol = $fecha->format('d-m-Y');
                // $fecha_actual = date('Y-m-d');// Obtengo la fecha actual              
                // $fechaMenosDias = $fecha_actual->subDays($configura->valor);// Resta los dias a la fecha actual
                // $fechaMas3Meses = $fecha_actual->addMonths(5); // Suma 3 meses a la fecha actual
                // $fechaMasDias->toDateString();
                // $diferencia = $fecha_actual->diffInDays($giftcards->fecha_vencimiento);
                
                $fechaMasDias = $fecha_actual->addDays($configura->valor); // Suma los dias de la configuracion a la fecha actual
    
                $fechaMasDias = Carbon::parse( $fechaMasDias)->format('Y-m-d'); // Transformo la fecha para poder comprarla con el query
                
                $giftcards= Giftcard::whereDate('fecha_vencimiento',$fechaMasDias )->orderBy('id','DESC')->get();
             
                
                //Si existe coincidencia enviara el email a los beneficiaros
                if(count($giftcards)>0){
    
                    foreach($giftcards as $gift){  
                        
                        if($gift->estado_id == 1){ //Giftcard debe estar en Estado Disponible = 1
    
                            $this->enviaEmailBeneficiarioGiftcard($gift, $configura->valor);
                            
                            // if($gift->estado_pago_id == 2){ //estado_pago_id = 2 Pagada , 
                            //     // Enviar Email a los Beneficiarios que tengan giftcard por vencerce
                            //     $this->enviaEmailBeneficiarioGiftcard($gift, $configura->valor);
        
                            // }else if($gift->estado_pago_id==1 ){ //Pendiente
                            //     // Si credito es distinto a 2 la giftcard esta disponible para consumir y se puede envia email igualmente al beneficiario
                            //     if($gift->credito_id!= 2){ // No credito
                            //         // Enviar email al beneficiario
                            //         $this->enviaEmailBeneficiarioGiftcard($gift, $configura->$valor);
                                    
                            //     }
                            // }
                        }
                    }

                    $resp=[
                        'resultado' => 200,
                        'status'    => "1",
                        'mensaje'   => 'Se enviaron los emails a los beneficiarios encontrados',   
                    ]; 

                }else{

                    $resp=[
                        'resultado' => 204,
                        'status'    => "0",
                        'mensaje'   => 'Ningun email enviado por el dia de hoy',   
                    ];  
                }

            }else{
                $resp=[
                    'resultado' => 204,
                    'status'    => "0",
                    'mensaje'   => 'No fue posible enviar emails; no existe la configuracion solicitada ',   
                ];

            }

            return $resp;

        } catch (\Throwable $e) {

            $resp = [
                'resultado' => 500,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];

            return $resp;
        }

    }

    private function enviaEmailBeneficiarioGiftcard($data, $valor){

        if($data->email!=""){

            $fecha_actual = Carbon::now();
            $fechaMasDias = $fecha_actual->addDays($valor);

            $fechaEsp = Carbon::parse( $fechaMasDias)->format('d-m-Y');

            $url_gif = route('giftcard_check', ['codigo' => $data->codigo]);

            $qr = QrCode::format('png')->size(85)->generate($url_gif);
            $base64=base64_encode($qr);
            
            $correo = $data->email;
            $asunto="Notificacion por vencimiento de Giftcard";
            $destinatario = $data->beneficiario!=""?$data->beneficiario:"Sin Nombre";    

            $cuerpo= "<p align='center' style='padding:10px;'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";                           
            $cuerpo.= "<p align='center' style='padding:10px;'><img width='100px' src='data:image/png;base64,".$base64."'></p>";
            
            $cuerpo.="<p>Su giftcard esta por vencerse dentro de ".$valor." Día(s)</p>";

            $cuerpo.="<p>Fecha de vencimiento:".$fechaEsp."</p>";
            $cuerpo.="<p>Es importante que pueda consumirla antes de la fecha de vencimiento, ya que de lo contrario no podrá canjearla.</p>";        

            $cuerpo.= "<p><b>Datos de giftcard:</b></p>";
            $cuerpo.= "<p>Nombre del beneficiario: ".$destinatario."</p>";
            $cuerpo.= "<p>Email del beneficiario: ".$correo."</p>";
            $cuerpo.= "<p>Télefono: ".$data->telefono."</p>";
            $cuerpo.= "<p>En este link podra ver su giftcard: <a href='{$url_gif}'>Ver mi giftcard</a></p>";

            $this->constructorEmail($asunto, $cuerpo, $correo, $destinatario); 

        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Giftcard  $giftcard
     * @return \Illuminate\Http\Response
     */
    public function show(Giftcard $giftcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Giftcard  $giftcard
     * @return \Illuminate\Http\Response
     */
    public function edit(Giftcard $giftcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Giftcard  $giftcard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Giftcard $giftcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Giftcard  $giftcard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Giftcard $giftcard)
    {
        //
    }
}
