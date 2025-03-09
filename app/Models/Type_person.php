<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

#Type_person_model 
class Type_person extends Model
{

	protected $table= 'type_person';

	protected $fillable = [
		'name'
		];

	protected $hidden = ['created_at', 'updated_at', 'status'];

}