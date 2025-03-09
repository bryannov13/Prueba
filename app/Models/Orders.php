<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Orders_model 
class Orders extends Model
{

	protected $table= 'orders';

	protected $fillable = [

		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

	public function person()
	{
		return $this->BelongsTo('App\Models\Person','Person_id');
	}
}