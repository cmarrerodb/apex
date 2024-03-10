<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResMesas extends Model
{
    use HasFactory;    use SoftDeletes;
    /*
    * @var string
    */
    protected $table = 'res_mesas';
    
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
        "mesa",
        "sucursal_id",
        "salon_id",
        "capacidad",
        "created_at",
        "updated_at"
    ];


    public function sucursal() {
        // return $this->hasMany('App\Models\ResSalones');
        return $this->belongsTo(ResSucursales::class);
    }

    public function salon() {
        // return $this->hasMany('App\Models\ResSalones');
        return $this->belongsTo(ResSucursales::class);
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