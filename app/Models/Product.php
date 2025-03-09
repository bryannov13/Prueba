<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Product_model 
class Product extends Model
{

	protected $table= 'product';

	protected $fillable = [
		'name',
		'category',
		'Store_id',
		'stock',
		'price',
		'description'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

	public function category_product()
	{
		return $this->BelongsTo('App\Models\Category_product','category');
	}
	public function store()
	{
		return $this->BelongsTo('App\Models\Store','Store_id');
	}
}