<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Category_product_model 
class Category_productRequest extends FormRequest
{

	public function authorize(){return true;}

	public function rules()
	{
		switch($this->method()){
			case 'GET':
			case 'DELETE':{return [];}
			case 'POST':{
				return [
					'name' => 'required|string|max:255'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'name' => 'required|string|max:255'
				];
			}
			default:break;
		}
	}
}
