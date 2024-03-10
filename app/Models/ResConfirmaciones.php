<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResConfirmaciones extends Model
{
    use HasFactory;
    protected $table = 'res_confirmaciones';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable=[
        'fecha_confirmacion',
        'sucursal_id',
        'turno',
        'pax',
    ];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $date =['deleted_at'];    
    // public function salon_confirmación()
    // {
    //     return $this->belongsTo(ResSalones::class,'sucursal_id','id');
    // }
}