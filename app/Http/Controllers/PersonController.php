<?php
namespace Admin_products\Http\Controllers;
use Admin_products\Http\Requests\PersonRequest;
use Admin_products\Models\Person;
use Admin_products\Models\Type_person;
use Yajra\Datatables\Datatables;

//Person_model 
class PersonController extends Controller
{
	function __construct(){parent::__construct('Person');}

	public function index()
	{
		return view('admin_products.Person.index');
	}

	public function grid(PersonRequest $request)
	{
		$records = Person::select('*');

		if($request->inactive == 0) $records->where('status','1');

		return Datatables::of($records)
			->addColumn('actions',function($record){
				return view('common.buttons',[
					'record'     => $record,
					'url'        => 'Person',
					'permission' => 'Person',
				])->render();
			})
			->escapeColumns([])
			->make(true);
	}

	public function create(){
		$action = 'add';
		$url    = '/Person';
		$Type_person = Type_person::all()->where('status','1');

		return view('admin_products.Person.form',[
			'Type_person' => $Type_person,
			'action' => $action,
			'url'    => $url
		]);
	}

	public function store(PersonRequest $request){
		try {
			$item = new Person($request->all());
			$item->save();
			$out = redirect('/Person')->with('message', 'Información actualizada correctamente');
		}
		catch (\Throwable $th) {$out = response()->json(['errors' => ['Bad Request']], 400);}
		return $out;
	}

	public function show($id){
		$item = Person::find($id);
		$action = 'show';
		$url    = '';
		$Type_person = Type_person::all()->where('status','1');

		return view('admin_products.Person.form', [
			'Type_person' => $Type_person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Ver'
		]);
	}

	public function edit($id){
		$item = Person::find($id);
		$action = 'edit';
		$url    = '/Person/'.$item->id;
		$Type_person = Type_person::all()->where('status','1');

		return view('admin_products.Person.form', [
			'Type_person' => $Type_person,
			'record' => $item,
			'action' => $action,
			'url'    => $url,
			'action_title' => 'Editar'
		]);
	}

	public function update($id, PersonRequest $request){
		$item = Person::find($id);
		if($item){
			$item->fill($request->all());
			$item->save();
			$out = redirect('/Person')->with('message', 'Información actualizada correctamente');
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function destroy($id){
		$item = Person::find($id);
		if($item){
			$item->status = 0;
			$item->save();
			$out = response()->json(['data' => $item, 'status' => 200], 200);
		}
		else $out = response()->json(['errors' => ['Item not found']], 404);

		return $out;
	}

	public function recover($id){
		$item = Person::find($id);
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
