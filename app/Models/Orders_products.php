<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Orders_products_model 
class Orders_products extends Model
{

	protected $table= 'orders_products';

	protected $fillable = [
		'order_id',
		'Product_id',
		'quantity',
		'price',
		'total'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

	public function orders()
	{
		return $this->BelongsTo('App\Models\Orders','order_id');
	}
	public function product()
	{
		return $this->BelongsTo('App\Models\Product','Product_id');
	}
}