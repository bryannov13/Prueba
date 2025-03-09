<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\Category_productRequest;
use Admin_products\Models\Category_product;
use Yajra\Datatables\Datatables;

//Category_product_model 
class Category_productController extends Controller
{
	function __construct(){parent::__construct('Category_product');}

	public function index()
	{
		return view('admin_products.Category_product.index');
	}

	public function grid(Category_productRequest $request)
	{
		$records = Category_product::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Category_product',
					'permission' => 'Category_product',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Category_product';

		return view('admin_products.Category_product.form',[
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(Category_productRequest $request){
		try {
			$item = new Category_product($request->all());
			$item->save();
			$out = redirect('/Category_product')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Category_product::find($id);
		$action = 'show';
		$url    = '';

		return view('admin_products.Category_product.form', [
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Category_product::find($id);
		$action = 'edit';
		$url    = '/Category_product/'.$item->id;

		return view('admin_products.Category_product.form', [
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, Category_productRequest $request){
		$item = Category_product::find($id);
		if($item){
			$item->fill($request->all());
			$item->save();
			$out = redirect('/Category_product')->with('message', 'Información actualizada correctamente');
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function destroy($id){
		$item = Category_product::find($id);
		if($item){
			$item->status = 0;
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 200], 200);
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function recover($id){
		$item = Category_product::find($id);
		if($item){
			$item->status = 1;
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 200], 200);
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

}
?>
