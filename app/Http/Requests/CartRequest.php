<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Cart_model 
class CartRequest extends FormRequest
{

	public function authorize(){return true;}

	public function rules()
	{
		switch($this->method()){
			case 'GET':
			case 'DELETE':{return [];}
			case 'POST':{
				return [
					'quantity' => 'required|integer|max:9999|min:0',
					'Product_id' => 'required',
					'Person_id' => 'required'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'quantity' => 'required|integer|max:9999|min:0',
					'Product_id' => 'required',
					'Person_id' => 'required'
				];
			}
			default:break;
		}
	}
}
