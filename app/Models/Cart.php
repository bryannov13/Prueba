<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Cart_model 
class Cart extends Model
{

	protected $table= 'cart';

	protected $fillable = [
		'quantity',
		'Product_id',
		'Person_id'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

	public function product()
	{
		return $this->BelongsTo('App\Models\Product','Product_id');
	}
	public function person()
	{
		return $this->BelongsTo('App\Models\Person','Person_id');
	}
}