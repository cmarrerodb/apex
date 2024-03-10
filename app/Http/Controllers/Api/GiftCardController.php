<?php

namespace App\Http\Controllers\Api;


use File;
use App\Models\Giftcard;
use Illuminate\Http\Request;
use App\Http\Traits\Funciones;
use App\Http\Traits\DigOceSpaces;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class GiftCardController extends Controller
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
        $data = DB::table('vgiftcards')->get()->collect()->toArray();
        return(json_encode($data));
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

        // return $giftcard;

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
            $gift->fecha_factura = $giftcard['fecha_factura'];
            $gift->monto_factura = $giftcard['monto_factura'];
            $gift->tipo_beneficio = $giftcard['tipo_beneficio'];
            $gift->beneficio = $giftcard['beneficio'];
            $gift->vendido_por = $giftcard['vendido_por'];

            $gift->nombre_comprador = $giftcard['nombre_comprador'];
            $gift->email_comprador = $giftcard['email_comprador'];
            $gift->telefono_comprador = $giftcard['telefono_comprador'];


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


            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
            ];
            /* PREPARANDO EL EMAIL */
            $cuerpo = "<p>Se ha generado una Gitcard con los siguientes datos:</p>";
            $cuerpo.= "<p>Nombre del beneficiario: ".$giftcard['beneficiario']."</p>";
            $cuerpo.= "<p>Email email del beneficiario: ".$giftcard['email']."</p>";
            $cuerpo.= "<p>Télefono: ".$giftcard['telefono']."</p>";

            $email               = (object)[];
            /* $email->email        = $request->correo ."; karen.milgram@gmail.com"; Se comento esta linea
            para poder realizar pruebas */
            $email->email        = 'felixjm@gmail.com';
            $email->destinatario = $giftcard['beneficiario'];
            $email->asunto       = 'Creación de Gitcard';
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
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];
            DB::rollback();
            return json_encode($res);
        }
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

    public function generar_qr(Request $request) {
        $hash = str_replace('.','',uniqid('',true));
        $url=url('/').'/giftcard/giftcard_check/'.$hash;
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

    public function estado_pago(Request $request){

        $data = $request->all();

        try {

            // Todo: Usar metodo para actualizar, ya que solo actualiza uno solo
            $giftcard = Giftcard::where('session_id', $data['session_id'])->get();

            $giftcard->estado_pago_id = $request['estado_pago_id'];

            if($giftcard->save()){

                $giftcard->refresh();

                $res =[
                    'resultado' => 202,
                    'status' => "1",
                    'data' => $giftcard,
                ];
            }else{

                $res =[
                    'resultado' => 204,
                    'status' => "0",
                    'error' => 'Ha ocurrido un error',
                ];
            }

            DB::commit();
            return $res;

        } catch (\Exception $e) {
            $res = [
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

    public function guardar_masivo(Request $request)
    {


        DB::beginTransaction();
        try {
            // dd($request);
            // return $request->all();

            $giftcard =  $request->formdata;

            // dd($request->all());

            // // $archivo = $request->file('adjunto');
            // $archivo = $giftcard->file('adjunto');
            // return $archivo;

            $email_beneficiario = $giftcard['email_bene'];
            $telefono_beneficiario = $giftcard['telefono_bene'];
            $nombre_beneficiario = $giftcard['nombre_bene'];
            $mensaje_beneficiario = $giftcard['mensaje_bene'];
            $monto_beneficiario = $giftcard['monto_ben'];
            $notifica_beneficiario = isset($giftcard['notificar']) ? $giftcard['notificar']:[0];

            $dias_uso =[
                'domingo'   => true,
                'lunes'     => true,
                "martes"    => true,
                "miercoles" => true,
                "jueves"    => true,
                "viernes"   => true,
                "sabado"    => true,
            ];
            // $gift = Giftcard::create($giftcard); De esta forma no estaba tomando todos los campos enviados.

            $url_adjunto ="";

            if($giftcard['pago_tipo_id'] == 1){ // Transferencia
                $forma_pago_id = 4; // Transferencia
            }
            else {
                $forma_pago_id = 3; // Tarjeta de credito
            }

            if(count($nombre_beneficiario)>0){

                foreach ($nombre_beneficiario as $key => $value) {

                    $gift = new Giftcard;
                    // Si el beneficiario es distinto a vacio
                    if($value!=""){

                        $giftcard['created_id']=1000;

                        $hash = str_replace('.','',uniqid('',true));
                        $url=url('/').'/giftcard/giftcard_check/'.$hash;
                        $fecha_vencimiento = Carbon::now()->addDays(182);  // 6 meses

                        $gift->codigo = $hash;
                        $gift->credito_id = 2; // NO es credito
                        $gift->estado_pago_id = 1; //Estado Pendiente
                        $gift->estado_id = 5; // Pendiente de pago
                        $gift->session_id = $giftcard['session_id'];

                        $gift->forma_pago_id = $forma_pago_id;

                        $gift->beneficiario = $value;
                        $gift->email = $email_beneficiario[$key];
                        $gift->telefono = $telefono_beneficiario[$key];
                        $gift->mensaje_beneficiario = $mensaje_beneficiario[$key];

                        $gift->ben_monto = $monto_beneficiario[$key];


                        $gift->factura = isset($giftcard['factura']) ? true: false;
                        $gift->fecha_vencimiento = $fecha_vencimiento;
                        $gift->dias_uso = json_encode($dias_uso);
                        $gift->horario_uso_desde = '08:00:00';
                        $gift->horario_uso_hasta = '23:00:00';
                        // $gift->platos_excluidos = $giftcard['platos_excluidos'];
                        $gift->created_id = $giftcard['created_id'];
                        // $gift->num_factura = $giftcard['num_factura'];
                        $gift->razon_social = $giftcard['razon_social'];
                        $gift->rut = $giftcard['rut'];
                        $gift->giro = $giftcard['giro'];
                        $gift->direccion = $giftcard['direccion'];
                        // $gift->fecha_factura = $giftcard['fecha_factura'];
                        $gift->monto_factura =  $monto_beneficiario[$key];
                        $gift->tipo_beneficio = "MONTO";
                        $gift->beneficio = $monto_beneficiario[$key];
                        $gift->vendido_por = "Web";

                        $gift->nombre_comprador = $giftcard['nombre_comprador'];
                        $gift->email_comprador = $giftcard['email_comprador'];
                        $gift->telefono_comprador = $giftcard['telefono_comprador'];

                        $gift->save();


                        if( $notifica_beneficiario[$key] == true){
                             /* PREPARANDO EL EMAIL */
                            // if($email_beneficiario[$key]!=""){

                                $cuerpo = "<p>Se ha generado una Gitcard con los siguientes datos:</p>";
                                $cuerpo.= "<p>Nombre del beneficiario: ".$value."</p>";
                                $cuerpo.= "<p>Email email del beneficiario: ".$email_beneficiario[$key]."</p>";
                                $cuerpo.= "<p>Télefono: ".$telefono_beneficiario[$key]."</p>";

                                if($mensaje_beneficiario[$key]){
                                    $cuerpo.="<p>Mensaje:".$mensaje_beneficiario[$key]."</p>";
                                }

                                $email               = (object)[];
                                /* $email->email        = $request->correo ."; karen.milgram@gmail.com"; Se comento esta linea
                                para poder realizar pruebas */
                                $email->email        = $email_beneficiario[$key];
                                $email->destinatario = $nombre_beneficiario[$key];
                                $email->asunto       = 'Creación de Gitcard';
                                $email->cuerpo       = $cuerpo;
                                $correox             = $this->sendemail($email);
                                $correox             = json_decode($correox);

                                if(isset($correox->code)) trigger_error($correox->message);
                            // }
                        }

                    }

                }// End Foreach


            }

            // if ($giftcard->hasFile('adjunto')){
            //     $archivox   = $giftcard->file('adjunto');
            //     $content    = File::get($archivox);
            //     $extension  = $archivox->getClientOriginalExtension();
            //     $fileUpload = $this->uploadFile("b94_reservas2/giftcard/pagos", $content,$extension,null,true);
            //     if(!$fileUpload->saved) trigger_error('error-upload-archivo');
            //     $url_adjunto = $fileUpload->privateUrl;
            // }

            $giftcards = Giftcard::select('beneficiario','codigo','ben_monto')->where('session_id', $giftcard['session_id'])->get();

            $res = [
                'resultado' => 202,
                'mensaje'=> "Se ha(n) creado(s) la(s) giftcard(s) Exitosamente",
                'status' => "1",
                'data'=> $giftcards,
            ];

            DB::commit();
            return json_encode($res);

        } catch(\Exception $e) {
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

    private function constructorEmail($asunto, $cuerpo, $correo, $destinatario ){

        $email               = (object)[];
        $email->email        = $correo;
        $email->destinatario = $destinatario ; // Prueba de beneficiario
        $email->asunto       = $asunto;
        $email->cuerpo       = $cuerpo;
        $correox             = $this->sendemail($email);
        $correox             = json_decode($correox);

        if(isset($correox->code)) {
            trigger_error($correox->message);
        }
        else{
            return true;
        }
    }


    public function show($id)
    {
        //
    }


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
