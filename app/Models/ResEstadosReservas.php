<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResEstadosReservas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'res_estados_reservas';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable=[
        "estado",
        "created_at",
        "updated_at",
    ];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $date =['deleted_at'];
}
