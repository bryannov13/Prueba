//Category_product_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Category_product-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Category_product/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'name', name: 'name', title: 'name'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
