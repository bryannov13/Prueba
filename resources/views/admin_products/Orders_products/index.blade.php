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
					<div class="col-12">
						@if(auth()->user()->hasPermission("Agregar-Orders_products"))
							<a href="/Orders_products/create" class="btn btn-primary-ws pull-right btn-wd">
								<i class="fa fa-plus-circle"></i><span>Agregar</span>
							</a>
						@endif
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<form method="POST" id="search-form" class="form-inline" role="form">
									<div class="form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox" id="showInactive" name="showInactive" value="1">
											<span class="form-check-sign"></span>Inactivos
										</label>
									</div>
								</form>
							</div>
						</div>
						<table class="table table-bordered table-grid table-general" id="Orders_products-table" style="width:100%"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section("js")
	{!!Html::script("assets/js/Orders_products.js")!!}
@endsection
