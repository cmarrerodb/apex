<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comensales extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'comensales';
    protected $guarded = ['id'];

   
    public function mesa(): BelongsTo
    {
        return $this->belongsTo(ResMesas::class);
    }
    
}
