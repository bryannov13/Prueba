//Store_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Store-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Store/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'name', name: 'name', title: 'name'},
				{data: 'address', name: 'address', title: 'address'},
				{data: 'seller', name: 'seller', title: 'seller'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
