<?php

namespace App\Console\Commands;

use App\Models\Reservas;
use App\Http\Traits\Funciones;
use Illuminate\Console\Command;

class SendDailyEmail extends Command
{

    use Funciones;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de email diario cuando exista una prereserva';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $prereservas = Reservas::where('tipo_reserva', 8 )->get();

        if($prereservas){

            // Todo por revisar
            foreach ($prereservas as $prereserva) {
                // Mail::to($user->email)->send(new DailyEmail())
                /* PREPARANDO EL EMAIL */
                $cuerpo = "<p>Se Le recuerda que existen reservas en estado de prereserva:</p>";
                $cuerpo.= "<p>Por favor tomar las medidas correspondientes</p>";
                $cuerpo.= "<p>Cliente: ".$prereserva->nombre_cliente."</p>";
                $cuerpo.= "<p>Télefono del cliente: ".$prereserva->telefono_cliente."</p>";
                $cuerpo.= "<p>Email del cliente: ".$prereserva->email_cliente."</p>";

                $email               = (object)[];
                // $email->email        = $prereserva->correo ."; karen.milgram@gmail.com"; Para cuando estemos en desarrollo
                $email->email        = "felixjm@gmail.com";

                $email->destinatario = 'Karen';
                $email->asunto       = 'Recordatorio de Prereserva';
                $email->cuerpo       = $cuerpo;
                $correox             = $this->sendemail($email);
                $correox             = json_decode($correox);
                if(isset($correox->code)) trigger_error($correox->message);

            }

        }
    }
}
