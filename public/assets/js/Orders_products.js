//Orders_products_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Orders_products-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Orders_products/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'order_id', name: 'order_id', title: 'order_id'},
				{data: 'Product_id', name: 'Product_id', title: 'Product_id'},
				{data: 'quantity', name: 'quantity', title: 'quantity'},
				{data: 'price', name: 'price', title: 'price'},
				{data: 'total', name: 'total', title: 'total'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
