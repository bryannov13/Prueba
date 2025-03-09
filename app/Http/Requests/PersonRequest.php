<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Person_model 
class PersonRequest extends FormRequest
{

	public function authorize(){return true;}

	public function rules()
	{
		switch($this->method()){
			case 'GET':
			case 'DELETE':{return [];}
			case 'POST':{
				return [
					'email' => 'required|string|max:255',
					'password' => 'required|string|max:255',
					'type_id' => 'required',
					'username' => 'required|string|max:255'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'email' => 'required|string|max:255',
					'password' => 'required|string|max:255',
					'type_id' => 'required',
					'username' => 'required|string|max:255'
				];
			}
			default:break;
		}
	}
}
