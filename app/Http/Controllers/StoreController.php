<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\StoreRequest;
use Admin_products\Models\Store;
use Admin_products\Models\Person;
use Yajra\Datatables\Datatables;

//Store_model 
class StoreController extends Controller
{
	function __construct(){parent::__construct('Store');}

	public function index()
	{
		return view('admin_products.Store.index');
	}

	public function grid(StoreRequest $request)
	{
		$records = Store::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Store',
					'permission' => 'Store',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Store';
		$Person = Person::all()->where('status','1');

		return view('admin_products.Store.form',[
			'Person' => $Person,
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(StoreRequest $request){
		try {
			$item = new Store($request->all());
			$item->save();
			$out = redirect('/Store')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Store::find($id);
		$action = 'show';
		$url    = '';
		$Person = Person::all()->where('status','1');

		return view('admin_products.Store.form', [
			'Person' => $Person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Store::find($id);
		$action = 'edit';
		$url    = '/Store/'.$item->id;
		$Person = Person::all()->where('status','1');

		return view('admin_products.Store.form', [
			'Person' => $Person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, StoreRequest $request){
		$item = Store::find($id);
		if($item){
			$item->fill($request->all());
			$item->save();
			$out = redirect('/Store')->with('message', 'Información actualizada correctamente');
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function destroy($id){
		$item = Store::find($id);
		if($item){
			$item->status = 0;
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 200], 200);
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function recover($id){
		$item = Store::find($id);
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
