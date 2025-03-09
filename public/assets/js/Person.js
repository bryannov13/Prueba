//Person_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Person-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Person/grid',
				data:function(d){
					d.inactive=($('#showInactive').is(':checked'))?'1':'0';
				}
			},
			'columns': [
				{data: 'email', name: 'email', title: 'email'},
				{data: 'password', name: 'password', title: 'password'},
				{data: 'type_id', name: 'type_id', title: 'type_id'},
				{data: 'username', name: 'username', title: 'username'},
				{data: 'actions', searchable: false, title: 'Acciones'}
			]
		});
}
