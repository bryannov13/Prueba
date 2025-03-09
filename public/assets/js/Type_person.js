//Type_person_model 
var repository= new Repository();
var dataTable=null;

$(document).ready(function() {
	all();
	$('#showInactive').change(function() {dataTable.draw();});
});

function all(){
	dataTable=$('#Type_person-table').DataTable({
			'processing': true,
			'serverSide': true,
			'ajax':{
				url: '/Type_person/grid',
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
