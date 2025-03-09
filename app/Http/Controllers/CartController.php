<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\CartRequest;
use Admin_products\Models\Cart;
use Admin_products\Models\Product;
use Admin_products\Models\Person;
use Yajra\Datatables\Datatables;

//Cart_model 
class CartController extends Controller
{
	function __construct(){parent::__construct('Cart');}

	public function index()
	{
		return view('admin_products.Cart.index');
	}

	public function grid(CartRequest $request)
	{
		$records = Cart::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Cart',
					'permission' => 'Cart',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Cart';
		$Product = Product::all()->where('status','1');
		$Person = Person::all()->where('status','1');

		return view('admin_products.Cart.form',[
			'Product' => $Product,
			'Person' => $Person,
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(CartRequest $request){
		try {
			$item = new Cart($request->all());
			$item->save();
			$out = redirect('/Cart')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Cart::find($id);
		$action = 'show';
		$url    = '';
		$Product = Product::all()->where('status','1');
		$Person = Person::all()->where('status','1');

		return view('admin_products.Cart.form', [
			'Product' => $Product,
			'Person' => $Person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Cart::find($id);
		$action = 'edit';
		$url    = '/Cart/'.$item->id;
		$Product = Product::all()->where('status','1');
		$Person = Person::all()->where('status','1');

		return view('admin_products.Cart.form', [
			'Product' => $Product,
			'Person' => $Person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, CartRequest $request){
		$item = Cart::find($id);
		if($item){
			$item->fill($request->all());
			$item->save();
			$out = redirect('/Cart')->with('message', 'Información actualizada correctamente');
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function destroy($id){
		$item = Cart::find($id);
		if($item){
			$item->status = 0;
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 200], 200);
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function recover($id){
		$item = Cart::find($id);
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
