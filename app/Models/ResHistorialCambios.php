<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ResHistorialCambios extends Model
{
    use HasFactory;
    protected $table = 'res_historial_cambios';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable=[
            'reserva_id',
            'usuario_id',
            'usuario_id',
            "fecha_cambio",
            'estado_previo',
            'estado_actual',
            'valor_previo',
            'valor_actual',
            'tipo_cambio',
    ];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $date =['deleted_at'];


}
