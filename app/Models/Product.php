<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'quantity',
        'price',
    ];
/**
     * Interact with the title.
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucfirst($value),
        );
    }
	public function user():BelongsToMany
	{
		return $this->belongsToMany(User::class)
		->withTimestamps()
		->withpivot('id')
		->withpivot('quantity');
		;
	}
	public function users():BelongsToMany
	{
		return $this->belongsToMany(User::class,'sales_orders')
		->withTimestamps()
		->withpivot('unit_price')
		->withpivot('quantity')
		->withpivot('total_amt');
	}
}
