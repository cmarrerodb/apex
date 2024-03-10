<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbAccionTipo extends Model
{
    use HasFactory;
    // Para la asignación masiva
    protected $guarded = ['id'];
}
