<?php
/*
 * Creado Felix Martinez
 * Sistema Barrica94
 * 2023
 */
namespace App\Http\Traits;
use View;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Reservas;

use App\Http\Traits\SToken;
use App\Http\Traits\JsEncode;
use App\Http\Traits\DO_Spaces;
use Illuminate\Support\Facades\DB;
use App\Models\ResHistorialCambios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait Funciones
{
    public function sendemail($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sendinblue.com/v3/smtp/email',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "sender":{
                "name":"BARRICA94",
                "email":"info@barrica94.cl"
            },
            "to":[
                {
                    "email":"'.$data->email.'",
                    "name":"'.$data->destinatario.'"
                }
            ],
            "subject":"'.$data->asunto.'",
            "htmlContent":"'.$data->cuerpo.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'api-key:'.env('SENDINBLUE_API_KEY')
            ),
        ));

        //$response = (curl_exec($curl) === false) ? curl_error($curl) : true;

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function sendemailGift($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sendinblue.com/v3/smtp/email',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "sender":{
                "name":"BARRICA94",
                "email":"giftcard@barrica94.cl"
            },
            "to":[
                {
                    "email":"'.$data->email.'",
                    "name":"'.$data->destinatario.'"
                }
            ],
            "subject":"'.$data->asunto.'",
            "htmlContent":"'.$data->cuerpo.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'api-key:'.env('SENDINBLUE_API_KEY')
            ),
        ));

        //$response = (curl_exec($curl) === false) ? curl_error($curl) : true;

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function sendEstadisticas($data){

        $filters ="";

        foreach ($data as $key => $value) {
            $filters .= '&'.$key.'='.$value;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.brevo.com/v3/smtp/statistics/events?'.$filters,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'api-key:'.env('SENDINBLUE_API_KEY_ESTADISTICA')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }



    public function in_arreglo($valor, $array ,$columna)
    {
        foreach ($array as $key => $val)
        {
            if ($val[$columna] === $valor)
            {
                return true;
            }
        }
        return false;
    }

    public function formatNumberEs($valor){

        return number_format($valor, 2, ',', '.'); 
    }

    public function aasort (&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
        return $array;
    }

    public function make_pin()
    {
        $numbers    = "0123456789";
        $leters     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $characters = "+-*/=";
        $pin        = str_shuffle($numbers.$leters.$characters);
        $pin        = substr($pin, 0, 16);
        return  $pin;
    }

    public function date_toBD($date,$time=false)
    {
        $format = 'Y-m-d';
        if($time) $format .= ' H:i';
        return Carbon::parse($date)->format($format);
    }

    public function date_toFront($date,$time=false)
    {
        $format = 'd-m-Y';
        if($time) $format .= ' H:i';
        return Carbon::parse($date)->format($format);
    }

    public function hour_toFront($hour)
    {
        return Carbon::parse($hour)->format('H:i');
    }

    public function envioEmailCompradorPagoRechazadoTransBank($datos){

        $correo = $correo = $datos->email_comprador;
        $destinatario = $datos->nombre_comprador;
        $encryptedEmail = Crypt::encrypt($correo); 

        $url= env('URL_API')."/historial-compras?token_compra=".$encryptedEmail;

        $asunto="Pago no procesado";
        $url_modal_id = $url."&i=".$datos->compras_id."&m=".$datos->monto."&pt=".$datos->pago_tipos_id."&mmf=0#mdl-pagar";

        $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica

        $cuerpo .="<p>Lamentamos mucho pero el proceso de compra fue rechazado por Transbank o por su Banco.</p><br>";
        $cuerpo.="<p>Hemos enviado un link a su correo con el proceso de compra con los datos ingresados por ud. </p>";
      
        $cuerpo.="<p>Este es el link del proceso de compra <a href='{$url_modal_id}'>{$url_modal_id}</a>.</p>";

        $cuerpo.="<p>Agradeceríamos pueda volver a intentar usando otra tarjeta o puede modificar el medio de pago por transferencia bancaria.</p>";

        // $cuerpo .="<p>Hemos enviado un email con los detalles de la compra y los links (QR) de cada giftcard comprada, así también hemos enviado un email con el Link (QR) a cada uno de los beneficiarios de la(s) giftcard compradas</p>";
        $cuerpo .="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";
        // Envio los datos del Email          

        $this->constructorEmail($asunto,$cuerpo,$correo,$destinatario);
    }

    public function envioEmailCompradorPagoRechazado($datos){

        $correo = $correo = $datos->email_comprador;
        $destinatario = $datos->nombre_comprador;
        $encryptedEmail = Crypt::encrypt($correo); 

        $url= env('URL_API')."/historial-compras?token_compra=".$encryptedEmail;

        $asunto="Pago Rechazado";
        $url_modal_id = $url."&i=".$datos->compras_id."&m=".$datos->monto."&pt=".$datos->pago_tipos_id."&mmf=0#mdl-pagar";

        $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica

        $cuerpo .="<p>Lamentamos mucho pero el proceso de compra fue rechazado por la administración de Barrica 94.</p><br>";
        $cuerpo.="<p>Hemos enviado un link a su correo con el proceso de compra con los datos ingresados por ud. </p>";
      
        $cuerpo.="<p>Este es el link del proceso de compra <a href='{$url_modal_id}'>{$url_modal_id}</a>.</p>";

        $cuerpo.="<p>Agradeceríamos pueda volver a intentar nuevamente con el metodo de pago seleccionado por ud.</p>";
        $cuerpo .="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";
      
        // Envio los datos del Email          

        $this->constructorEmail($asunto,$cuerpo,$correo,$destinatario);

    }

    public function envioEmailCompradorPagoExitoso($datos, $local=""){
        $correo = $correo = $datos->email_comprador;
        $destinatario = $datos->nombre_comprador;

        $total = $local!="" ? $datos->new_ben_monto : $datos->monto;

        $encryptedEmail = Crypt::encrypt($correo);
        $url= env('URL_API')."?token_compra=".$encryptedEmail;

        $asunto="Confirmación de pago Exitosa";
        $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
        $cuerpo .= "<p>Muchas gracias por su compra, el monto total $". $total." ha sido cursado exitosamente. </p>";

        // $cuerpo .="<p>Hemos enviado un email con los detalles de la compra y los links (QR) de cada giftcard comprada, así también hemos enviado un email con el Link (QR) a cada uno de los beneficiarios de la(s) giftcard compradas</p>";   
        $cuerpo .= "<p>Hemos enviado un email con el Link (QR) a cada uno de los beneficiarios de la(s) giftcard(s) comprada(s)</p>";

        $cuerpo .="<p>En este link podrá ver su historial de compras: <a href='{$url}'>Ver mi historial </a> </p>";

        $cuerpo.= "<h4>Detalle de Giftcard(s)</h4>";
        $cuerpo.="<table border='1'>";
        $cuerpo.="<tr>";
        $cuerpo.="<td>Nombre del beneficiario</td>";
        $cuerpo.="<td>Monto</td>";
        $cuerpo.="<td>Accion</td>";
        $cuerpo.="</tr>";

        if($local==""){
            
            $giftcards = json_decode($datos->request);
    
    
            foreach ($giftcards as $key => $value) {
    
                $url_gif = route('giftcard_check', ['codigo' => $value->codigo]);
    
                $cuerpo.="<tr>";
                    $cuerpo.="<td>{$value->nombre_bene}</td>";
                    $cuerpo.="<td>$ {$value->monto_bene}</td>";
                    $cuerpo.="<td> <a href='".$url_gif."'>Ver Giftcard  </a></td>"; // No abre la url desde el Email
                $cuerpo.="</tr>";
            }

        }else{

            $url_gif = route('giftcard_check', ['codigo' => $datos->codigo]);    
            $cuerpo.="<tr>";
                $cuerpo.="<td>{$datos->beneficiario}</td>";
                $cuerpo.="<td>$ {$datos->new_ben_monto}</td>";
                $cuerpo.="<td> <a href='".$url_gif."'>Ver Giftcard  </a></td>"; // No abre la url desde el Email
            $cuerpo.="</tr>";
        }

        $cuerpo.= "</table>";

        $cuerpo .="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";
        // Envio los datos del Email       
        $this->constructorEmail($asunto,$cuerpo,$correo,$destinatario);
    }

    public function envioEmailCompradorPagoExitososo2($datos){
        $correo = $correo = $datos->email_comprador;
        $destinatario = $datos->nombre_comprador;

        $encryptedEmail = Crypt::encrypt($correo);
        $url= env('URL_API')."?token_compra=".$encryptedEmail;
      

        $asunto="Confirmación de pago Exitosa";
        $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
        $cuerpo .= "<p>Muchas gracias por su compra, el monto total $". $datos->monto." ha sido cursado exitosamente. </p>";

        $cuerpo .= "<p>Hemos enviado un email con el Link (QR) a cada uno de los beneficiarios de la(s) giftcard compradas</p>";

        $cuerpo .="<p>En este link podrá ver su historial de compras: <a href='{$url}'>Ver mi historial </a> </p>";

        $cuerpo.= "<h4>Detalle de Giftcard(s)</h4>";
        $cuerpo.="<table border='1'>";
        $cuerpo.="<tr>";
        $cuerpo.="<td>Nombre del beneficiario</td>";
        $cuerpo.="<td>Monto</td>";
        $cuerpo.="<td>Accion</td>";
        $cuerpo.="</tr>";

        $giftcards = json_decode($datos->request);


        foreach ($giftcards as $key => $value) {

            $url_gif = route('giftcard_check', ['codigo' => $value->codigo]);

            $cuerpo.="<tr>";
                $cuerpo.="<td>{$value->nombre_bene}</td>";
                $cuerpo.="<td>$  {$value->monto_bene}</td>";
                $cuerpo.="<td> <a href='".$url_gif."'>Ver Giftcard  </a></td>"; // No abre la url desde el Email
            $cuerpo.="</tr>";
        }
        $cuerpo.= "</table>";

        // $cuerpo .="<p>Hemos enviado un email con los detalles de la compra y los links (QR) de cada giftcard comprada, así también hemos enviado un email con el Link (QR) a cada uno de los beneficiarios de la(s) giftcard compradas</p>";  
        
        $cuerpo .="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";
                         
        // Envio los datos del Email       
        $this->constructorEmail($asunto,$cuerpo,$correo,$destinatario);
    }

    // Funcion envio de Email al comprador
    public function envioEmailComprador($datos){
        // Se crea el email para el comprador 
        $correo = $datos->email_comprador;

        $destinatario = $datos->nombre_comprador;

        $encryptedEmail = Crypt::encrypt($correo);
        $url= env('URL_API')."?token_compra=".$encryptedEmail;
        $asunto="Compra de giftcard(s)";

        $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
        $cuerpo.= "<p>Gracias por comprar con nosotros giftcard(s):</p>";
        $cuerpo.= "<h3>Datos de la(s) giftcard(s)</h3>";

        $cuerpo .= "<p>Monto de la compra: $". $datos->monto ."</p>";
        $cuerpo .="<p>En este link podrá ver su historial de compras: <a href='{$url}'>Ver mi historial </a> </p>";

        if($datos->pago_tipos_id==1){ //Transferencia
            $cuerpo .= "<p>Su transacción ha sido enviada</p>";
        }
        $cuerpo.= "<h4>Detalle de Giftcard";
        $cuerpo.="<table border='1'>";
        $cuerpo.="<tr>";
        $cuerpo.="<td>Nombre del beneficiario</td>";
        $cuerpo.="<td>Monto</td>";
        $cuerpo.="<td>Accion</td>";
        $cuerpo.="</tr>";

        $giftcards = json_decode($datos->request);


        foreach ($giftcards as $key => $value) {

            $url_gif = route('giftcard_check', ['codigo' => $value->codigo]);

            $cuerpo.="<tr>";
                $cuerpo.="<td>{$value->nombre_bene}</td>";
                $cuerpo.="<td>$  {$value->monto_bene}</td>";
                $cuerpo.="<td> <a href='".$url_gif."'>Ver Giftcard  </a></td>"; // No abre la url desde el Email
            $cuerpo.="</tr>";
        }
        $cuerpo.= "</table>";

        $cuerpo .="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";

        $this->constructorEmail($asunto,$cuerpo,$correo,$destinatario);
    }

    public function envioEmailCompradorPendientePago($datos){

        $correo = $correo = $datos->email_comprador;
        $destinatario = $datos->nombre_comprador;
        $asunto="Pago de Giftcard(s) Pendiente por confirmar";

        $cuerpo= "<p align='center'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";// Logo de barrica
        $cuerpo.="<p>Muchas gracias por su compra, hemos recibido su solicitud de compra mediante transferencia bancaria.</p>";
        // $cuerpo.="<p>Hemos enviado un email con los detalles de la compra y los links (QR) de cada giftcard comprada en estado pendiente activar.</p>";
        $cuerpo.="<p>Enviaremos un email con el Link (QR) a cada uno de los beneficiarios de la(s) giftcard compradas una vez que estén activas</p>";
        $cuerpo.="<p>Revisaremos y confirmaremos cuanto antes la transferencia realizada.</p>" ;            
        $cuerpo.="<p>Una vez confirmada la(s) Giftcard compradas serán activadas inmediatamente.</p>";
        $cuerpo .="<br><p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";

        $this->constructorEmail($asunto,$cuerpo,$correo,$destinatario);
    }

    // Envio de email al administrador
    public function envioEmailGiftcadCanjeadaAdmin($datos){

    }

    // Envio de email a Comprador y beneficiario 
    public function envioEmailGiftcadCanjeada($datos, $tipo=""){

        $url = route('giftcard_check', ['codigo' => $datos->codigo]);
        $qr = QrCode::format('png')->size(85)->generate($url);
        $base64=base64_encode($qr);

        $correo ="";
         
        $asunto = "Giftcard Canjeada";

        if($tipo=="" || $tipo =='beneficiario'){
            $destinatario = $datos->beneficiario ? $datos->beneficiario: "Sin nombre";
            $correo = $datos->email;
        }

        else if($tipo=='comprador'){
            $destinatario = $datos->nombre_comprador ? $datos->nombre_comprador: "Sin nombre";
            $correo = $datos->email_comprador;

        }else{

            $destinatario = "Adminstrador del sistema de Reserva";
            $correo = "felixjm@gmail.com"; // Coloco mi email para realizar las pruebas 
        }

        $emailView = View::make('emails.giftcard-canjeada', ['gift' => $datos, 'qr'=> $base64, 'tipo'=>$tipo])->render();
        $emailView = str_replace("\n", "", $emailView);
        $emailView = str_replace("\t", "", $emailView);
        $emailView = str_replace("\r", "", $emailView);
        $emailView = str_replace("\"", "'", $emailView);

        if($correo!=""){

            $this->constructorEmail($asunto, $emailView, $correo, $destinatario);            
        }
    }

    public function envioEmailNoticacionSincroniza($email){

        $asunto ="Notificación por giftcard no sincronizadas";

        $cuerpo = "<p>Se ha enviado este email porque existen 2 o mas giftcards que aun no han sido sincronizadas.</p>" ;
        $cuerpo .= "<p>Se recomienda revisar o intentar nuevamente correr la url y ver el resultado.</p>";
        $cuerpo .= "<p>Es posible que ya se haya sincronizado todo lo que estaba pendiente.</p>" ;
        $cuerpo .= "<p>Url para revisar giftcards: <a href='".route('giftcard.get.sincronizar.post')."'>".route('giftcard.get.sincronizar.post')."</a></p>" ;

        $destinatario = "Administrado del sistema";

        $correo = $email; 

        $this->constructorEmail($asunto, $cuerpo, $correo, $destinatario);  
    }

    


    public function constructorEmail($asunto, $cuerpo, $correo, $destinatario ){


        $email               = (object)[];
        $email->email        = $correo;
        $email->destinatario = $destinatario ; // Prueba de beneficiario
        $email->asunto       = $asunto;
        $email->cuerpo       = $cuerpo;
        $correox             = $this->sendemailGift($email);
        $correox             = json_decode($correox);

        if(isset($correox->code)) {
            trigger_error($correox->message);
        }
        else{
            return true;
        }
    }

    public function constructorEmailBarrica($asunto, $cuerpo, $correo, $destinatario ){


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

    public function registro_historial($req){

        if(Auth::check()){
            $usuario = auth()->user()->id; 

        }else{            
            $user = User::select('id','name')->where('username', 'sistemas_reserva')->first();

            if($user){
                $usuario = $user->id;
            }else{
                $usuario = 1000; // Usuario sin registro
            }
        }

        $actual = DB::select(DB::raw("SELECT row_to_json(reservas) AS estado_actual FROM reservas WHERE id = $req->id"));
        $vactual = DB::select(DB::raw("SELECT row_to_json(vreservas) AS estado_actual FROM vreservas WHERE id = $req->id"));
        $estado = Reservas::where("id","=",$req->id)->pluck('estado')->toArray();;
        $data = ([
            'reserva_id' => $req->id,
            'usuario_id' => $usuario,
            'fecha_cambio' => Carbon::now(),
            'estado_actual' => $actual[0]->estado_actual,
            'vestado_actual' => $vactual[0]->estado_actual,
            'valor_actual' => $estado[0],
            'tipo_cambio' =>  3, //Creación
            'created_at' => Carbon::now(),
        ]);

        $nuevoId = ResHistorialCambios::insertGetId($data); 
        
        // return;

    }
}
