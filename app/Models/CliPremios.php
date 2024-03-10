<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CliPremios extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cli_premios';
    
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
    protected $fillable=["categoria_id","premio","usuario_id","created_at","updated_at"];
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

    public function categoria_cliente() {
        return $this->belongsTo(CliClientesCategoria::class,'categoria_id'); 
    }    
    public function usuario() {
        return $this->belongsTo(User::class,'usuario_id'); 
    }    
}
