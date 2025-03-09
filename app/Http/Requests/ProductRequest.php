<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Product_model 
class ProductRequest extends FormRequest
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
					'category' => 'required',
					'Store_id' => 'required',
					'stock' => 'required|integer|max:9999|min:0',
					'price' => 'required|numeric|max:9999|min:0',
					'description' => 'required|string|max:255'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'name' => 'required|string|max:255',
					'category' => 'required',
					'Store_id' => 'required',
					'stock' => 'required|integer|max:9999|min:0',
					'price' => 'required|numeric|max:9999|min:0',
					'description' => 'required|string|max:255'
				];
			}
			default:break;
		}
	}
}
