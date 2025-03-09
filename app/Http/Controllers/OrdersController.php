<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\OrdersRequest;
use Admin_products\Models\Orders;
use Admin_products\Models\Person;
use Yajra\Datatables\Datatables;

//Orders_model 
class OrdersController extends Controller
{
	function __construct(){parent::__construct('Orders');}

	public function index()
	{
		return view('admin_products.Orders.index');
	}

	public function grid(OrdersRequest $request)
	{
		$records = Orders::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Orders',
					'permission' => 'Orders',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Orders';
		$Person = Person::all()->where('status','1');

		return view('admin_products.Orders.form',[
			'Person' => $Person,
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(OrdersRequest $request){
		try {
			$item = new Orders($request->all());
			$item->save();
			$out = redirect('/Orders')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Orders::find($id);
		$action = 'show';
		$url    = '';
		$Person = Person::all()->where('status','1');

		return view('admin_products.Orders.form', [
			'Person' => $Person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Orders::find($id);
		$action = 'edit';
		$url    = '/Orders/'.$item->id;
		$Person = Person::all()->where('status','1');

		return view('admin_products.Orders.form', [
			'Person' => $Person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, OrdersRequest $request){
		$item = Orders::find($id);
		if($item){
			$item->fill($request->all());
			$item->save();
			$out = redirect('/Orders')->with('message', 'Información actualizada correctamente');
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function destroy($id){
		$item = Orders::find($id);
		if($item){
			$item->status = 0;
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 200], 200);
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function recover($id){
		$item = Orders::find($id);
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
