<?php
namespace admin_products\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//Orders_model 
class OrdersRequest extends FormRequest
{

	public function authorize(){return true;}

	public function rules()
	{
		switch($this->method()){
			case 'GET':
			case 'DELETE':{return [];}
			case 'POST':{
				return [
					'Person_id' => 'required'
				];
			}
			case 'PUT':
			case 'PATCH':{
				return [
					'Person_id' => 'required'
				];
			}
			default:break;
		}
	}
}
