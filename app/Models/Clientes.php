<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{
    use HasFactory;
    use SoftDeletes;
    /*
    * @var string
    */
    protected $table = 'clientes';
    
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
        "nombre",
        "rut",
        "fecha_nacimiento",
        "telefono",
        "direccion",
        "comuna_id",
        "categoria_id",
        "numero_tarjeta",
        "email",
        "empresa",
        "hotel",
        "vino_favorito_1",
        "vino_favorito_2",
        "vino_favorito_3",
        "foto",
        "referencia",
        "info_vina",
        "club",
        "created_at",
        "updated_at",
        "tipo_id"
    ];
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