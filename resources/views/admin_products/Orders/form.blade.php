<!--Orders_model -->
@extends('layouts.app')
@section('top-title', 'Orders')
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
											<label>Person_id: <span style="color:red">*</span></label>
											<select title="Person_id" type="text" class="form-control" name="Person_id" id="Person_id" >
												<option value="">- Seleccione -</option>
												@isset($Person)
													@foreach($Person as $item)
														<option @if(isset($record) && $record->Person_id == $item->id) selected @endif value="{{$item->id}}">{{ $item->id }}</option>
													@endforeach
												@endisset
											</select>
										</div>
									</div>
									<div class="form-group m-t-1">
										<div class="pull-right">
											<a class="btn btn-default btn-wd" href="{{url("/Orders")}}">Cancelar</a>
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
	{!!Html::script("assets/js/Orders.js")!!}
@endsection
