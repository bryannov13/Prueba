<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\ProductRequest;
use Admin_products\Models\Product;
use Admin_products\Models\Category_product;
use Admin_products\Models\Store;
use Yajra\Datatables\Datatables;

//Product_model 
class ProductController extends Controller
{
	function __construct(){parent::__construct('Product');}

	public function index()
	{
		return view('admin_products.Product.index');
	}

	public function grid(ProductRequest $request)
	{
		$records = Product::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Product',
					'permission' => 'Product',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Product';
		$Category_product = Category_product::all()->where('status','1');
		$Store = Store::all()->where('status','1');

		return view('admin_products.Product.form',[
			'Category_product' => $Category_product,
			'Store' => $Store,
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(ProductRequest $request){
		try {
			$item = new Product($request->all());
			$item->save();
			$out = redirect('/Product')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Product::find($id);
		$action = 'show';
		$url    = '';
		$Category_product = Category_product::all()->where('status','1');
		$Store = Store::all()->where('status','1');

		return view('admin_products.Product.form', [
			'Category_product' => $Category_product,
			'Store' => $Store,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Product::find($id);
		$action = 'edit';
		$url    = '/Product/'.$item->id;
		$Category_product = Category_product::all()->where('status','1');
		$Store = Store::all()->where('status','1');

		return view('admin_products.Product.form', [
			'Category_product' => $Category_product,
			'Store' => $Store,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, ProductRequest $request){
		try {
			$item = Product::find($id);
			if($item){
				$item->fill($request->all());
				$item->save();
				$out = redirect('/Product')->with('message', 'Información actualizada correctamente');
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
			$item = Product::find($id);
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
			$item = Product::find($id);
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

	public function getAll()
	{
		try {
			$items = Product::with(['category_product', 'store'])->get();
			$out = response()->json(['data' => $items, 'status' => 200], 200);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}

	public function getSingle($id)
	{
		try {
			$item = Product::with(['category_product', 'store'])->find($id);
			if ($item) {
				$out = response()->json(['data' => $item, 'status' => 200], 200);
			} else {
				$out = response()->json(['errors' => ['Item not found']], 404);
			}
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}

	public function storeApi(ProductRequest $request){
		try {
			$item = new Product($request->all());
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 201], 201);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}
}
?>