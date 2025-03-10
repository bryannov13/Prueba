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
	public function getAll()
	{
		try {
			$items = Cart::with(['product', 'person'])->get();
			$out = response()->json(['data' => $items, 'status' => 200], 200);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}

	public function getSingle($id)
	{
		try {
			$item = Cart::with(['product', 'person'])->find($id);
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
	public function storeApi(CartRequest $request){
		try {
			$item = new Cart($request->all());
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 201], 201);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}

	public function update($id, CartRequest $request){
		try {
			$item = Cart::find($id);
			if($item){
				$item->fill($request->all());
				$item->save();
				$out = redirect('/Cart')->with('message', 'Información actualizada correctamente');
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
			$item = Cart::find($id);
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
			$item = Cart::find($id);
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
	
	public function endCart($id)
	{
		try {
			$cart = Cart::find($id);
			if ($cart) {
				// Create a new order from the cart
				$order = new Order();
				$order->person_id = $cart->person_id;
				$order->total = $cart->total;
				$order->status = 'completed';
				$order->save();

				// Add cart items to the order
				foreach ($cart->items as $item) {
					$orderItem = new OrderItem();
					$orderItem->order_id = $order->id;
					$orderItem->product_id = $item->product_id;
					$orderItem->quantity = $item->quantity;
					$orderItem->price = $item->price;
					$orderItem->save();
				}

				// Clear the cart
				$cart->items()->delete();
				$cart->delete();

				$out = response()->json(['data' => $order, 'status' => 200], 200);
			} else {
				$out = response()->json(['errors' => ['Cart not found']], 404);
			}
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}

		return $out;
	}
}
?>
