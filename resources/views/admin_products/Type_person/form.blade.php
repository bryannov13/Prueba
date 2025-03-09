<!--Type_person_model -->
@extends('layouts.app')
@section('top-title', 'Type_person')
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
											<label>name: <span style="color:red">*</span></label>
											<input title="name" type="text" name="name" maxlength="100" data-parsley-maxlength="100" data-parsley-required value="{{old("name", isset($record) ? $record->name : "")}}" class="form-control">
										</div>
									</div>
									<div class="form-group m-t-1">
										<div class="pull-right">
											<a class="btn btn-default btn-wd" href="{{url("/Type_person")}}">Cancelar</a>
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
	{!!Html::script("assets/js/Type_person.js")!!}
@endsection
