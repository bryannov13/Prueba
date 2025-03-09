<!--Product_model -->
@extends('layouts.app')
@section('top-title', 'Product')
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
										<div class="col-6">
											<label>name: <span style="color:red">*</span></label>
											<input title="name" type="text" name="name" maxlength="100" data-parsley-maxlength="100" data-parsley-required value="{{old("name", isset($record) ? $record->name : "")}}" class="form-control">
										</div>
										<div class="col-6">
											<label>category: <span style="color:red">*</span></label>
											<select title="category" type="text" class="form-control" name="category" id="category" >
												<option value="">- Seleccione -</option>
												@isset($Category_product)
													@foreach($Category_product as $item)
														<option @if(isset($record) && $record->category == $item->id) selected @endif value="{{$item->id}}">{{ $item->id }}</option>
													@endforeach
												@endisset
											</select>
										</div>
										<div class="col-6">
											<label>Store_id: <span style="color:red">*</span></label>
											<select title="Store_id" type="text" class="form-control" name="Store_id" id="Store_id" >
												<option value="">- Seleccione -</option>
												@isset($Store)
													@foreach($Store as $item)
														<option @if(isset($record) && $record->Store_id == $item->id) selected @endif value="{{$item->id}}">{{ $item->id }}</option>
													@endforeach
												@endisset
											</select>
										</div>
										<div class="col-6">
											<label>stock: <span style="color:red">*</span></label>
											<input title="stock" type="number" name="stock" id="stock" class="form-control change_salary" value="{{old("stock", isset($record) ? $record->stock : "")}}" data-parsley-required data-parsley-type="number" min="0" max="9999" maxlength="12">
										</div>
										<div class="col-6">
											<label>price: <span style="color:red">*</span></label>
											<input title="price" type="number" name="price" id="price" class="form-control change_salary" value="{{old("price", isset($record) ? $record->price : "")}}" data-parsley-required data-parsley-type="number" min="0" max="9999" maxlength="12">
										</div>
										<div class="col-6">
											<label>description: <span style="color:red">*</span></label>
											<input title="description" type="text" name="description" maxlength="100" data-parsley-maxlength="100" data-parsley-required value="{{old("description", isset($record) ? $record->description : "")}}" class="form-control">
										</div>
									</div>
									<div class="form-group m-t-1">
										<div class="pull-right">
											<a class="btn btn-default btn-wd" href="{{url("/Product")}}">Cancelar</a>
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
	{!!Html::script("assets/js/Product.js")!!}
@endsection
