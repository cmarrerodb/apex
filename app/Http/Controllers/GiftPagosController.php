<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use App\Models\Pago;
use App\Models\Giftcard;
use App\Models\GiftHistoria;
use Illuminate\Http\Request;
use App\Http\Traits\Funciones;
use App\Models\GiftFormasPago;
use Illuminate\Validation\Rule;
use App\Http\Traits\DigOceSpaces;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GiftPagosController extends Controller
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


    public function index(){
        return view('pagos.index');
    }

    public function list(){
        $pagos = Pago::with(['estado_pago:id,estado_pago', 'forma_pago:id,forma_pago'])->orderBy('id', 'DESC')->get();
        return $pagos;
    }

    public function create( $codigo ){

        $forma_pagos = GiftFormasPago::get();
        
        //Busco giftcard
        $giftcard = Giftcard::with(['pago'])->where(['codigo' => $codigo])->first();  

        if($giftcard){

            $gifts = Giftcard::with('pago')->select('id','session_id','beneficiario', 'email', 'new_ben_monto','codigo')
            ->where(['session_id'=> $giftcard->session_id,'estado_pago_id' => 1])->get();  

            return view('pagos.create', compact('giftcard','gifts', 'forma_pagos') );   

        }else{

            return view('errors.404');

        }

        
    }

    public function store_proceso_pago(Request $request){       

        
        DB::beginTransaction();
        
        try {

            $request->validate([
                'forma_pago' => 'required',
                'adjunto_pago' => Rule::requiredIf(function () use ($request) {
                    return $request->forma_pago == 4;
                }),
            ]);

            // Nos aseguramos de totalizar las giftcards involucradas
            $total = 0;
    
            $giftcards = Giftcard::where('session_id', $request->session_id)->get();
    
            if(count($giftcards)>0){
    
                foreach ($giftcards as $key => $value) {
                    $total+= $value->new_ben_monto;
                }
            }  
            // Generamos un nuevo pago
            $pago                 = new Pago;
            $pago->session_id     = $request->session_id;
            $pago->forma_pago_id  = $request->forma_pago;
            $pago->user_id        = Auth::user()->id;
            $pago->estado_pago_id = 1; //Establecemos el valor en Pendiente para luego validar para aprobarlo o rechazarlo
            $pago->monto          = $total;
            $pago->fecha = Carbon::now();
            $pago->hora = Carbon::now();
    
            if ($request->hasFile('adjunto_pago')){
    
                $archivox   = $request->file('adjunto_pago');
                $content    = File::get($archivox);
                $extension  = $archivox->getClientOriginalExtension();
                $fileUpload = $this->uploadFile("b94_reservas2/giftcard/pago/", $content,$extension,null,true);
                if(!$fileUpload->saved) trigger_error('error-upload-archivo');
                
                $adjunto = $fileUpload->privateUrl;
                $pago->url_adjunto = $adjunto;
            }
            $pago->save(); 
            
            // Actualizo el pago a la giftcard(s) Involucradas
            $gift = Giftcard::where('session_id', $request->session_id)->update([
                'pago_id' => $pago->id,
                'forma_pago_id' => $request->forma_pago,
            ]);

            DB::commit();

            return redirect()->route('proceso.pago', ['codigo' => $giftcards[0]->codigo ])->with('mensaje', '¡Se ha guardado el pago exitosamente; debe ahora aprobar o rechazar dicho pago!');
               
           
        } catch (\Throwable $e) {
           
            $res = [
                'resultado' => 500,
                'status'    => "0",
                'mensaje'   => 'No se pudo realizar lel pago',
                'error'     => $e->getMessage(),
                'line'      => $e->getLine(),
                'file'      => $e->getFile(),
            ];

            DB::rollback();

            return $res;            
        }       


    }


    public function proceso_pago($codigo){

        if($codigo){
            
            // $giftcard = Giftcard::with(['pago'])->select('id','session_id')->where(['codigo' => $codigo])->first();
            $giftcard = Giftcard::with(['pago'])->where(['codigo' => $codigo])->first();        
            // Si existe la giftcard 
            
            if($giftcard){
                // Todo pendiente validar los otros metodos de pago ANULADO, PENDIENTE, RECHAZADO
                // Busco las gifcards asociadas por su session_id
                $gifts = Giftcard::with('pago')->select('id','session_id','beneficiario', 'email', 'new_ben_monto','codigo')->where(['session_id'=> $giftcard->session_id])->where('estado_pago_id','!=',2)->get();        

                // Si existen giftcard con pagos pendiente
                if(count($gifts)>0){

                    // validar si existe o no pago
                    $pago = Pago::where('session_id', $giftcard->session_id)->where('estado_pago_id','!=',2)->orderBy('id','DESC')->first();
                    
                    if($pago){
                        // Si existe pago hago el proceso para Aprobar o rechazar
                        return view('pagos.aprobar-anular', compact('giftcard','gifts'));   

                    }else{

                        return redirect()->route('proceso.pago.create', ['codigo' => $codigo]);                      
                        
                    }

                }else{
                    // Valido que si no existe la conicidencia con giftcard, chequeo si hay un pago y esta como pagado 
                    $pago = Pago::where('session_id', $giftcard->session_id)->where('estado_pago_id',2)->orderBy('id','DESC')->first();
                    
                    if($pago){
                        
                        return view('pagos.pago-existente', compact('pago'));
                    }
                }
                
            } else{                
                return view('errors.404');
            }    
        }
    }

  
    public function update_proceso_pago(Request $request){   
        
        $request->validate([
            'status_pago' => 'required',
        ]);
        
        DB::beginTransaction();

        try {
            $pago = Pago::where('estado_pago_id','!=',2) // Distinto a pagado 
            ->where('session_id', $request->session_id)->orderBy('id','DESC')->first();
    
            if($pago){
                //Actualizo la tabla de pago 
                $pago->estado_pago_id = $request->status_pago; 
                $pago->user_id = Auth::user()->id;
                $pago->observaciones = $request->observaciones;
                $pago->save();
                $pago->fresh();
                
                // Actualizao la tabla de giftcard con los cambios obtenidos del request
                $gftcard = Giftcard::where(['session_id'=> $request->session_id, 'estado_pago_id'=> 1]) // Estado PENDIENTE
                ->update([
                        'estado_pago_id' => $request->status_pago,
                        'estado_id'      => $request->status_pago == 2 ? 1: 5 // Disponible = 1, Pendiente Pago = 5
                    ]
                ); 

                // Busco giftcard para enviar email 
                $giftcards= Giftcard::where('session_id', $request->session_id)->get();

           
                if($request->status_pago==2 ){ // Si es aprobado envio email a beneficiarios de la giftcards

                     // Realizo el recorrido de las giftcard para agregar un nuevo registro en caso de que el pago sea aprobado
                     if(count($giftcards)>0){

                        foreach ($giftcards as $key => $gift) {

                            $gift_history              = new GiftHistoria;
                            $gift_history->giftcard_id = $gift->id;
                            $gift_history->user_id     = Auth::user()->id;
                            $gift_history->descripcion = "Compra exitosa";
                            
                            $gift_history->save();
                        }
                    }
                    
                    $this->envioEmailCompradorPagoExitoso($giftcards[0], "local");
                    $this->envioEmailBeneficiarios($giftcards);

                }
                else if($request->status_pago==4){ //Pago rechazado
                    // Todo: enviar email de pago rechazado localmente si no existe  ?
                    // Puedo crear una api para validar la session_id de las compras en giftcard
                }
              
                // Comunicacion con api para actualizar el pago en sistema de giftcard     
                //Envio la respuesta obtenida a la api de giftcard_pay
                $apiActualiza = Http::post(env('URL_API').'/api/sincroniza-pago-actualiza',[
                    'session_id' => $pago->session_id,
                    'estado_pago_id' => $pago->estado_pago_id,
                ]); 

                // $apiActualiza->object();
                $apiActualiza->body();

                $res = [
                    'resultado' => 202,
                    'status' => "1",
                    'error'=>'',
                    'mensaje' =>'Se actualizó el pago exitosamente - reserva2',  
                ];

            }else{
                $pago = [];
                $res = [
                    'resultado' => 204,
                    'status' => "0",
                    'error'=>'',
                    'mensaje' =>'No hay coincidencia para actualizar el pago - reserva2',                
                ];       
            }
            
            DB::commit();

            return  view('pagos.resultado', compact('res','pago'));


            
        } catch (\Throwable $e) {

            $res = [
                'resultado' => 500,
                'status'    => "0",
                'mensaje'   => 'No se pudo realizar la actualización',
                'error'     => $e->getMessage(),
                'line'      => $e->getLine(),
                'file'      => $e->getFile(),
            ];

            DB::rollback();

            return $res;
        }
        // Luego enviar a api la actualización de este cambio de pago 
        // Y con esto tenemos cubierto todo lo que nos falta 
    }

    private function envioEmailBeneficiarios($giftcards){

        if(count($giftcards)>0){

          
            $asunto = "Creación de Gitcard";
           
            foreach ($giftcards as $key => $value) {

                if($value->email!=""){

                
                    $cuerpo= "<p align='center' style='padding:10px;'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";

                    $url_gif = route('giftcard_check', ['codigo' => $value->codigo]);    
                    $qr = QrCode::format('png')->size(85)->generate($url_gif);
                    $base64=base64_encode($qr);    
                   
                    $cuerpo.= "<p align='center' style='padding:10px;'><img width='100px' src='data:image/png;base64,".$base64."'></p>";                       
                    $cuerpo.= "<p>Se ha generado una Gitcard con los siguientes datos:</p>";       

                    $cuerpo.= "<p>Nombre del beneficiario: ".$value->beneficiario."</p>";
                    $cuerpo.= "<p>Email email del beneficiario: ".$value->email."</p>";
                    $cuerpo.= "<p>Télefono: ". $value->telefono."</p>";
                    $cuerpo.= "<p>En este link podra ver su giftcard: <a href='{$url_gif}'>Ver mi giftcard</a></p>";
                    $cuerpo.="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";                    

                    if($value->mensaje_beneficiario){
                        $cuerpo.="<p>Mensaje: ".$value->mensaje_beneficiario."</p>";
                    }

                    // return $cuerpo;
                    
                    $this->constructorEmail($asunto, $cuerpo, $value->email, $value->beneficiario);                    

                }                
            }
        }
    }
}
