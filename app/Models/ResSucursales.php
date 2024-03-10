<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResSucursales extends Model
{
    use HasFactory;
    use SoftDeletes;
    /*
    * @var string
    */
    protected $table = 'res_sucursales';
    
    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
    * Indicates if the model's ID is auto-incrementing.
    *
    * @var bool
    */
    public $incrementing = true;
    protected $fillable=[
        "sucursal",
        "calendario",
        "fecha_inicio_calendario",
        "fecha_fin_calendario",
        "created_at",
        "updated_at"
    ];
    public function salones() {
        return $this->hasMany(ResSalones::class,"sucursal_id");
    }

    public function mesas() {
        return $this->hasMany(ResMesas::class,"sucursal_id");
    }
    
    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';
    protected $date =['deleted_at'];
}