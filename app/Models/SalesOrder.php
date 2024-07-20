<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
	protected $fillable = [
		'unit_price',
		'quantity',
		'total_amt',
	];
}
