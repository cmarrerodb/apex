<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConfiguracionGlobal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'configuracion_globales';

    /**
     * Get the user that owns the ConfiguracionGlobal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo(): BelongsTo
    {
        return $this->belongsTo(ConfTipo::class, 'tipo_id');
    }

    public function vista(): BelongsTo
    {
        return $this->belongsTo(Vista::class, 'vista_id');
    }

}
