<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'reservas';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable=[
        "fecha_reserva",
        "razon_cancelacion",
        "observacion_cancelacion",
        "hora_reserva",
        "nombre_cliente",
        "nombre_empresa",
        "fecha_ultima_modificacion",
        "usuario_ultima_modificacion",
        "nombre_hotel",
        "cantidad_pasajeros",
        "telefono_cliente",
        "tipo_reserva",
        "email_cliente",
        "salon",
        "mesa",
        "estado",
        "observaciones",
        "usuario_registro",
        "clave_usuario",
        "sucursal",
        "dianoche",
        "archivo_1",
        "archivo_2",
        "archivo_3",
        "archivo_4",
        "archivo_5",
        "cliente_id",
        "evento_nombre_adicional",
        "evento_pax",
        "evento_valor_menu",
        "evento_total_sin_propina",
        "evento_total_propina",
        "evento_email_contacto",
        "evento_telefono_contacto",
        "evento_anticipo",
        "evento_paga_en_local",
        "evento_audio",
        "evento_video",
        "evento_video_audio",
        "evento_restriccion_alimenticia",
        "evento_ubicacion",
        "evento_monta",
        "evento_detalle_restriccion",
        "ambiente",
        "usuario_confirmacion",
        "usuario_rechazo",
        "fecha_confirmacion",
        "fecha_rechazo",
        "razon_rechazo",
        "evento_comentarios",
        "evento_nombre_contacto",
        "evento_idioma",
        "evento_cristaleria",
        "evento_decoracion",
        "evento_mesa_soporte_adicional",
        "evento_extra_permitido",
        "evento_menu_impreso",
        "evento_table_tent",
        "evento_logo",
    ];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $date =['deleted_at'];


    public function estado_reserva()
    {
        return $this->belongsTo(ResEstadosReservas::class,'estado','id');
    }

    public function tipo_reserva(){
       
        return $this->belongsTo(ResTipoReservas::class,'tipo_reserva','id');
        
    }



}
