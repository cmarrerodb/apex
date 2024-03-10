<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class ResExtras extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'res_extras';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable=[
        'reserva_id',
        'autoriza',
        'telefono_autoriza',
        'monto_autorizado',
        'created_at',
        'updated_at'
    ];
    public $timestamps = false;
    protected $dateFormat = 'U';
    // protected $date =['deleted_at'];    
}
