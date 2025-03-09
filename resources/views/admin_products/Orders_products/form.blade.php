<!--Orders_products_model -->
@extends('layouts.app')
@section('top-title', 'Orders_products')
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
											<label>order_id: <span style="color:red">*</span></label>
											<select title="order_id" type="text" class="form-control" name="order_id" id="order_id" >
												<option value="">- Seleccione -</option>
												@isset($Orders)
													@foreach($Orders as $item)
														<option @if(isset($record) && $record->order_id == $item->id) selected @endif value="{{$item->id}}">{{ $item->id }}</option>
													@endforeach
												@endisset
											</select>
										</div>
										<div class="col-12">
											<label>Product_id: <span style="color:red">*</span></label>
											<select title="Product_id" type="text" class="form-control" name="Product_id" id="Product_id" >
												<option value="">- Seleccione -</option>
												@isset($Product)
													@foreach($Product as $item)
														<option @if(isset($record) && $record->Product_id == $item->id) selected @endif value="{{$item->id}}">{{ $item->id }}</option>
													@endforeach
												@endisset
											</select>
										</div>
										<div class="col-12">
											<label>quantity: <span style="color:red">*</span></label>
											<input title="quantity" type="number" name="quantity" id="quantity" class="form-control change_salary" value="{{old("quantity", isset($record) ? $record->quantity : "")}}" data-parsley-required data-parsley-type="number" min="0" max="9999" maxlength="12">
										</div>
										<div class="col-12">
											<label>price: <span style="color:red">*</span></label>
											<input title="price" type="number" name="price" id="price" class="form-control change_salary" value="{{old("price", isset($record) ? $record->price : "")}}" data-parsley-required data-parsley-type="number" min="0" max="9999" maxlength="12">
										</div>
										<div class="col-12">
											<label>total: <span style="color:red">*</span></label>
											<input title="total" type="number" name="total" id="total" class="form-control change_salary" value="{{old("total", isset($record) ? $record->total : "")}}" data-parsley-required data-parsley-type="number" min="0" max="9999" maxlength="12">
										</div>
									</div>
									<div class="form-group m-t-1">
										<div class="pull-right">
											<a class="btn btn-default btn-wd" href="{{url("/Orders_products")}}">Cancelar</a>
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
	{!!Html::script("assets/js/Orders_products.js")!!}
@endsection
