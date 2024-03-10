<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pagos';
    

    protected $appends = ['format_monto'];


    public function getFormatMontoAttribute(){

        $format = "$" .number_format($this->monto, 0, ',', '.' );

        return $format;

    }

    // public function giftcard() {
    //     return $this->belongsTo(Giftcard::class);
    // }



    /**
     * Get all of the comments for the Pago
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function giftcards(): HasMany
    {
        return $this->hasMany(Giftcard::class);
    }

    /**
     * Get the user that owns the Pago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_pago()
    {
        return $this->belongsTo(GiftEstadosPago::class, 'estado_pago_id', 'id');
    }

    public function forma_pago()
    {
        return $this->belongsTo(GiftFormasPago::class, 'forma_pago_id', 'id');
    }
    
}
