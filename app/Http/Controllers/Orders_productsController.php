<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\Orders_productsRequest;
use Admin_products\Models\Orders_products;
use Admin_products\Models\Orders;
use Admin_products\Models\Product;
use Yajra\Datatables\Datatables;

//Orders_products_model 
class Orders_productsController extends Controller
{
	function __construct(){parent::__construct('Orders_products');}

	public function index()
	{
		return view('admin_products.Orders_products.index');
	}

	public function grid(Orders_productsRequest $request)
	{
		$records = Orders_products::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Orders_products',
					'permission' => 'Orders_products',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Orders_products';
		$Orders = Orders::all()->where('status','1');
		$Product = Product::all()->where('status','1');

		return view('admin_products.Orders_products.form',[
			'Orders' => $Orders,
			'Product' => $Product,
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(Orders_productsRequest $request){
		try {
			$item = new Orders_products($request->all());
			$item->save();
			$out = redirect('/Orders_products')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Orders_products::find($id);
		$action = 'show';
		$url    = '';
		$Orders = Orders::all()->where('status','1');
		$Product = Product::all()->where('status','1');

		return view('admin_products.Orders_products.form', [
			'Orders' => $Orders,
			'Product' => $Product,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Orders_products::find($id);
		$action = 'edit';
		$url    = '/Orders_products/'.$item->id;
		$Orders = Orders::all()->where('status','1');
		$Product = Product::all()->where('status','1');

		return view('admin_products.Orders_products.form', [
			'Orders' => $Orders,
			'Product' => $Product,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, Orders_productsRequest $request){
		try {
			$item = Orders_products::find($id);
			if($item){
				$item->fill($request->all());
				$item->save();
				$out = redirect('/Orders_products')->with('message', 'Información actualizada correctamente');
			}
			else {
				$out = response()->json(['errors' => ['Item not found']], 404);
			}
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}

		return $out;
	}

	public function destroy($id){
		try {
			$item = Orders_products::find($id);
			if($item){
				$item->status = 0;
				$item->save();
				$out = response()->json(['data' => $item, 'status' => 200], 200);
			}
			else {
				$out = response()->json(['errors' => ['Item not found']], 404);
			}
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}

		return $out;
	}

	public function recover($id){
		try {
			$item = Orders_products::find($id);
			if($item){
				$item->status = 1;
				$item->save();
				$out = response()->json(['data' => $item, 'status' => 200], 200);
			}
			else {
				$out = response()->json(['errors' => ['Item not found']], 404);
			}
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}

		return $out;
	}

}

public function getAll()
{
	try {
		$items = Orders_products::with(['orders', 'product'])->get();
		return response()->json(['data' => $items, 'status' => 200], 200);
	} catch (\Throwable $th) {
		return response()->json(['errors' => ['Bad Request']], 400);
	}
}

public function getSingle($id)
{
	try {
		$item = Orders_products::with(['orders', 'product'])->find($id);
		if ($item) {
			return response()->json(['data' => $item, 'status' => 200], 200);
		} else {
			return response()->json(['errors' => ['Item not found']], 404);
		}
	} catch (\Throwable $th) {
		return response()->json(['errors' => ['Bad Request']], 400);
	}
}

public function storeApi(Orders_productsRequest $request)
{
	try {
		$item = new Orders_products($request->all());
		$item->save();
		return response()->json(['data' => $item, 'status' => 201], 201);
	} catch (\Throwable $th) {
		return response()->json(['errors' => ['Bad Request']], 400);
	}
}