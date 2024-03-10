<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GiftFormasPago extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'gift_formas_pagos';
    protected $primaryKey = 'id';
    public $incrementing = true;
	protected $fillable=[
		"forma_pago",
		"created_at",
		"updated_at"
	];
	public $timestamps = false;
	protected $dateFormat = 'U';
	protected $date =['deleted_at'];      
}
