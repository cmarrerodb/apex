<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Clientes;
use App\Models\Reservas;
use App\Models\ResExtras;
use Illuminate\Http\Request;
use App\Models\ResSucursales;
use App\Http\Traits\Funciones;
use App\Models\ResConfirmaciones;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;



class ReservaController extends Controller
{
    use Funciones;

    public function index()
    {
        return Reservas::all();
    }


    public function store(Request $request)
    {

        // $validateData = $request->validate([
        //     'fecha_reserva'=>'required',
        //     'hora_reserva' =>'required',
        //     'email'=>'required',
        //     'nombre' =>'required',
        //     'telefono'=>'required',
        //     'pax' => 'numeric|required|min:1',
        //     // 'password'=>'required|string|min:8',
        // ]);

    

        $rules = [
            'fecha' => 'required',
            'hora' => 'required',
            'email' => 'required',
            'nombre' =>'required',
            'telefono'=>'required',
            'pax' => 'numeric|required|min:1',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            // Return the validation errors in JSON format
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $bloqueo = $this->check_bloqueo($request->fecha, $request->hora);

        $estado = 9; //Solicitud_Web
        $fecha_rechazo="";
        $estado_title ="";

        $cuerpo_title = "Su solicitud ha sido recibida";
        $cuerpo_subtitle = "Dentro de poco le contestaremos su solicitud";

        if($bloqueo > 0)  {
            $estado = 8; // Rechazada
            $fecha_rechazo = Carbon::now();

            $estado_title = "- RECHAZADA";

            $cuerpo_title = "Su solicitud ha sido recibida y rechazada";
            $cuerpo_subtitle = "";
        }

        $id_cliente = Clientes::where("nombre","=",$request->nombre)->pluck('id')->toArray();
        // $usuario = auth()->user()->id;


        DB::beginTransaction();
        try {

            $tipo_reserva = 1 ; // Valor predeterminado Regular

            $hora_inicio = Carbon::parse($request->hora);
            $hora_fin = Carbon::parse('16:00:00');

            if($hora_inicio->isBefore($hora_fin)){
                $diaNoche = 1;
            }else{
                $diaNoche = 2;
            }         
            

            $reserva                     = new Reservas;
            $reserva->fecha_reserva      = $request->fecha;
            $reserva->hora_reserva       = $request->hora;
            $reserva->cantidad_pasajeros = $request->pax;            

            if(count($id_cliente)>0){
                $reserva->cliente_id     = $id_cliente[0];
            }
            $reserva->nombre_cliente     = $request->nombre;            
            $reserva->usuario_registro   = 1000; //Usuario no existe es solo para crear desde la web
            // $reserva->clave_usuario      = "abc";
            // $reserva->nombre_hotel       = $request->hotel;
            $reserva->telefono_cliente   = $request->telefono;
            $reserva->email_cliente      = $request->email;
            $reserva->sucursal           = $request->has('sucursal')? $request->sucursal: 2; // VIVO = 2
            $reserva->observaciones      = "Creado desde la web fecha: ". date("d/m/Y")." hora: ".date('H:i');
            $reserva->ambiente           = $request->ambiente;
            if($bloqueo > 0)  {
                $reserva->fecha_rechazo      = Carbon::now();
            }
            $reserva->dianoche           = $request->has('dianoche')? $request->dianoche : $diaNoche; 
            $reserva->created_at         = Carbon::now();
            $reserva->updated_at         = Carbon::now();            

            if($bloqueo==0){
                // Evaluo si existe coincidencia
                $conf_auto_count = ResConfirmaciones::
                where('fecha_confirmacion',">=", date('Y-m-d'))
                ->where('fecha_confirmacion',">=", $request->fecha)
                ->where('sucursal_id', $request->has('sucursal')? $request->sucursal: 2)
                ->where('turno', $diaNoche )
                ->where('pax','>=',$request->pax )
                ->whereNull('deleted_at')
                ->count();
                
                // Si cumple alguna de las reglas se pasa a estado "Realizado"
                if($conf_auto_count > 0 ){

                    $estado = 3; // Realizada = 3
                    $cuerpo_title = "Su solicitud recibida y aceptada";   
                    $cuerpo_subtitle = "";
                    
                    $estado_title = "- ACEPTADA";

                    $tipo_reserva = 1; // Regular

                    $reserva->usuario_confirmacion = 1000; //User Web

                    $reserva->fecha_confirmacion = Carbon::now();

                }
            }

            $reserva->estado = $estado;
            $reserva->tipo_reserva = $tipo_reserva;       
            $reserva->save();          

            $this->registro_historial($reserva); // Historial Creación


            $sucursal = ResSucursales::find($reserva->sucursal);

            $mensaje = "Reserva creada exitosamente";

            $fechaCarbon = Carbon::parse( $request->fecha);
            Carbon::setLocale('es');
            $fechaEspanol = $fechaCarbon->format('d \d\e F \d\e Y');

            $horaCarbon = Carbon::parse($request->hora);
            $horaFormateada = $horaCarbon->format('g:i A');

            $encrypReserva = Crypt::encrypt($reserva->id);
            $url= route('reservar.check')."?token_reserva=".$encrypReserva;

            $asunto = "BARRICA 94 - SOLICITUD DE RESERVA N° ".$reserva->id." - CREADA ".$estado_title ;
            $cuerpo ="<p>Estimado(a) ".$reserva->nombre_cliente."</p>";
            $cuerpo.="<p>Muchas gracias por contactarnos. ".$cuerpo_title." de acuerdo a la informacion detallada abajo. ".$cuerpo_subtitle."</p>";
            
            $cuerpo.= "<p>En este link podra ver el estatus de su reserva <a href='".$url."'>Pinche aquí</a></p>";
            
            $cuerpo.= "<p>__________________________________________________________________________________</p>";
            $cuerpo.= "<p>N° de Reserva: ". $reserva->id ."</p>";
            $cuerpo.= "<p>Fecha: ". $fechaEspanol  ."</p>";
            $cuerpo.= "<p>Hora: ". $horaFormateada ."</p>";
            $cuerpo.= "<p>Sucursal: ". $sucursal->sucursal ."</p>";
            $cuerpo.= "<p>Personas: ". $reserva->cantidad_pasajeros."</p>";
            $cuerpo.= "<p>".$cuerpo_title."</p><p>Fecha: ". $fechaEspanol ." a las: ".$horaFormateada ."</p>";
            

            if($bloqueo > 0){

                $asunto  = "Email de Rechazo al tratar de crear reserva";
                $cuerpo = "<p>Reserva ha sido creada, sin embargo se cuentra en estado de rechazo, le avisaremos cuando este disponible.</p><p>Fecha: ". $fechaEspanol ." a las: ".$horaFormateada ."</p>";
                $cuerpo.="<p>Motivo del rechazo: La fecha y hora seleccionada estan bloquedas</p>";             
                $mensaje = "Reserva creada exitosamente con estado de Rechazo";
            }

            /* PREPARANDO EL EMAIL */
            $email               = (object)[];
            $email->email        = $request->email;
            $email->destinatario = $request->nombre;
            $email->asunto       = $asunto;
            $email->cuerpo       = $cuerpo;
            $correox             = $this->sendemail($email);
            $correox             = json_decode($correox);
            if(isset($correox->code)) trigger_error($correox->message);


            $res = [
                'resultado' => 202,
                'status' => "1",
                'message' => $mensaje,
                'registro'=> $reserva,
            ];
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

            return response()->json($res);

        }
        catch(\Exception $e) {
            DB::rollback();
            $res = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'file'=>$e->getFile(),
                'line' =>$e->getLine(),
            ];
            return response()->json($res);
        }
    }

    private function check_bloqueo($fecha,$hora) {
        $sql = "SELECT COUNT(*) AS bloqueos FROM res_bloqueos WHERE deleted_at IS NULL AND'$fecha' BETWEEN fecha_inicio AND fecha_fin
        AND '$hora' BETWEEN hora_inicio AND hora_fin " ;
        $bloqueo = DB::select(DB::raw($sql));

        return $bloqueo[0]->bloqueos;
    }

    private function envioEmailSolicitudReserva(){



        
    }

    private function envioEmailConfirmacion(){


    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function estadisticas(Request $request)
    {
        // $filters ="";

        // foreach ($request->all() as $key => $value) {
        //     $filters .= '&'.$key.'='.$value;
        // }

        // $client = new Client();

        // $response = $client->get('https://api.brevo.com/v3/smtp/statistics/events?'.$filters,[
        //     'headers' => [
        //         'api-key' => env('SENDINBLUE_API_KEY_ESTADISTICA'),
        //         'Accept' => 'application/json'
        //     ]
        // ]);

        // $body = $response->getBody();

        // return json_decode($body);


        $data  = $this->sendEstadisticas($request->all());
        return json_decode($data);

    }

}
