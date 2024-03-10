<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GiftMesonero extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'gift_mesoneros';
    protected $primaryKey = 'id';
    public $incrementing = true;
	protected $fillable=[
		"mesonero",
		"created_at",
		"updated_at"
	];
	public $timestamps = false;
	protected $dateFormat = 'U';
	protected $date =['deleted_at'];  
}
