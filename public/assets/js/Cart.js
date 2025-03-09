//Cart_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Cart-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Cart/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'quantity', name: 'quantity', title: 'quantity'},
				{data: 'Product_id', name: 'Product_id', title: 'Product_id'},
				{data: 'Person_id', name: 'Person_id', title: 'Person_id'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
