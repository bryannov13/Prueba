//Orders_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Orders-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Orders/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'Person_id', name: 'Person_id', title: 'Person_id'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
