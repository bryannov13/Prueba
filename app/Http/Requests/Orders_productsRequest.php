<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Orders_products_model 
class Orders_productsRequest extends FormRequest
{

	public function authorize(){return true;}

	public function rules()
	{
		switch($this->method()){
			case 'GET':
			case 'DELETE':{return [];}
			case 'POST':{
				return [
					'order_id' => 'required',
					'Product_id' => 'required',
					'quantity' => 'required|integer|max:9999|min:0',
					'price' => 'required|numeric|max:9999|min:0',
					'total' => 'required|numeric|max:9999|min:0'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'order_id' => 'required',
					'Product_id' => 'required',
					'quantity' => 'required|integer|max:9999|min:0',
					'price' => 'required|numeric|max:9999|min:0',
					'total' => 'required|numeric|max:9999|min:0'
				];
			}
			default:break;
		}
	}
}
