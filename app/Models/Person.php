<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Person_model 
class Person extends Model
{

	protected $table= 'person';

	protected $fillable = [
		'email',
		'password',
		'type_id',
		'username'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

	public function type_person()
	{
		return $this->BelongsTo('App\Models\Type_person','type_id');
	}
}