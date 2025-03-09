<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Category_product_model 
class Category_product extends Model
{

	protected $table= 'category_product';

	protected $fillable = [
		'name'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

}