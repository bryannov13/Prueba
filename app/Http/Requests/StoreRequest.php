<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Store_model 
class StoreRequest extends FormRequest
{

	public function authorize(){return true;}

	public function rules()
	{
		switch($this->method()){
			case 'GET':
			case 'DELETE':{return [];}
			case 'POST':{
				return [
					'name' => 'required|string|max:255',
					'address' => 'required|string|max:255',
					'seller' => 'required'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'name' => 'required|string|max:255',
					'address' => 'required|string|max:255',
					'seller' => 'required'
				];
			}
			default:break;
		}
	}
}
