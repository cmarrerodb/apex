<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Giftcard extends Model
{
    use HasFactory;
    protected $table = 'giftcards';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $guarded = ['id'];


    // protected $fillable = [
    //     'codigo',
    //     'estado_pago_id',
    //     'estado_id',
    //     'forma_pago_id',
    //     'cliente_id',
    //     'mesonero_id',
    //     'fecha_canje',
    //     'credito_id',
    //     'vendido_por',
    //     'fecha_vencimiento',
    //     'dias_uso',
    //     'horario_uso_desde',
    //     'horario_uso_hasta',
    //     'platos_excluidos',
    //     'ben_porcentaje',
    //     'ben_monto',
    //     'ben_plato',
    //     'factura',
    //     'num_factura',
    //     'razon_social',
    //     'rut',
    //     'giro',
    //     'direccion',
    //     'created_id',
    // ];

    protected $appends = ['format_monto'];

    public function getFormatMontoAttribute(){

        $format = "$" .number_format($this->new_ben_monto, 0, ',', '.' );

        return $format;

    }

    
    public function estado_pago() {
        return $this->belongsTo(GiftEstadosPago::class);
    }
    public function estado() {
        return $this->belongsTo(GiftEstados::class);
    }
    public function forma_pago() {
        return $this->belongsTo(GiftFormasPago::class);
    }
    public function cliente() {
        return $this->belongsTo(Clientes::class);
    }
    public function mesonero() {
        return $this->belongsTo(GiftMesonero::class);
    }
    public function credito() {
        return $this->belongsTo(GiftCredito::class);
    }

    public function pago(){
        
        return $this->belongsTo(Pago::class,'pago_id','id');
        
        // return $this->hasMany(Pago::class)->orderBy('id', 'desc');
    }

    
    public function historial(): HasMany
    {
        return $this->hasMany(GiftHistoria::class, 'giftcard_id', 'id');

    }

  

    
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $date =['deleted_at'];
}