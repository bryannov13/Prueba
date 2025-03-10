<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\Type_personRequest;
use Admin_products\Models\Type_person;
use Yajra\Datatables\Datatables;

//Type_person_model 
class Type_personController extends Controller
{
	function __construct(){parent::__construct('Type_person');}

	public function index()
	{
		return view('admin_products.Type_person.index');
	}

	public function grid(Type_personRequest $request)
	{
		$records = Type_person::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Type_person',
					'permission' => 'Type_person',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Type_person';

		return view('admin_products.Type_person.form',[
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(Type_personRequest $request){
		try {
			$item = new Type_person($request->all());
			$item->save();
			$out = redirect('/Type_person')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Type_person::find($id);
		$action = 'show';
		$url    = '';

		return view('admin_products.Type_person.form', [
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Type_person::find($id);
		$action = 'edit';
		$url    = '/Type_person/'.$item->id;

		return view('admin_products.Type_person.form', [
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, Type_personRequest $request){
		try {
			$item = Type_person::find($id);
			if($item){
				$item->fill($request->all());
				$item->save();
				$out = redirect('/Type_person')->with('message', 'Información actualizada correctamente');
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
			$item = Type_person::find($id);
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
			$item = Type_person::find($id);
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
			$items = Type_person::all();
			$out = response()->json(['data' => $items, 'status' => 200], 200);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}

	public function getSingle($id)
	{
		try {
			$item = Type_person::find($id);
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

	public function storeApi(Type_personRequest $request){
		try {
			$item = new Type_person($request->all());
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 201], 201);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}

	public function storeApi(Type_personRequest $request){
		try {
			$item = new Type_person($request->all());
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 201], 201);
		} catch (\Throwable $th) {
			$out = response()->json(['errors' => ['Bad Request']], 400);
		}
		return $out;
	}
}
?>