<!--Person_model -->
@extends('layouts.app')
@section('top-title', 'Person')
@section('content')

@include('alerts.message')
@include('alerts.request')
	<div class="card">
		<div class="card-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12-lg container">
						<div class="catalog-modal">
							<div class="card card-body">
								<form action="{{$url}}"  method="POST" class="form-view">
									{{ csrf_field() }}
									@if($action == "edit")
										<input name="_method" type="hidden" value="PUT">
										<input name="id" type="hidden" value="{{$record->id}}">
									@endif
									<div class="row">
										<div class="col-12">
											<label>email: <span style="color:red">*</span></label>
											<input title="email" type="text" name="email" maxlength="100" data-parsley-maxlength="100" data-parsley-required value="{{old("email", isset($record) ? $record->email : "")}}" class="form-control">
										</div>
										<div class="col-12">
											<label>password: <span style="color:red">*</span></label>
											<input title="password" type="text" name="password" maxlength="100" data-parsley-maxlength="100" data-parsley-required value="{{old("password", isset($record) ? $record->password : "")}}" class="form-control">
										</div>
										<div class="col-12">
											<label>type_id: <span style="color:red">*</span></label>
											<select title="type_id" type="text" class="form-control" name="type_id" id="type_id" >
												<option value="">- Seleccione -</option>
												@isset($Type_person)
													@foreach($Type_person as $item)
														<option @if(isset($record) && $record->type_id == $item->id) selected @endif value="{{$item->id}}">{{ $item->id }}</option>
													@endforeach
												@endisset
											</select>
										</div>
										<div class="col-12">
											<label>username: <span style="color:red">*</span></label>
											<input title="username" type="text" name="username" maxlength="100" data-parsley-maxlength="100" data-parsley-required value="{{old("username", isset($record) ? $record->username : "")}}" class="form-control">
										</div>
									</div>
									<div class="form-group m-t-1">
										<div class="pull-right">
											<a class="btn btn-default btn-wd" href="{{url("/Person")}}">Cancelar</a>
											@if($action != "show")
												<button type="submit" class="btn btn-primary-ws btn-wd">Guardar</button>
											@endif
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection
@section("js")
	{!!Html::script("assets/js/Person.js")!!}
@endsection
