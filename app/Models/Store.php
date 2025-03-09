<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Store_model 
class Store extends Model
{

	protected $table= 'store';

	protected $fillable = [
		'name',
		'address',
		'seller'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

	public function person()
	{
		return $this->BelongsTo('App\Models\Person','seller');
	}
}