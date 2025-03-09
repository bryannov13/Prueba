//Product_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Product-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Product/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'name', name: 'name', title: 'name'},
				{data: 'category', name: 'category', title: 'category'},
				{data: 'Store_id', name: 'Store_id', title: 'Store_id'},
				{data: 'stock', name: 'stock', title: 'stock'},
				{data: 'price', name: 'price', title: 'price'},
				{data: 'description', name: 'description', title: 'description'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
