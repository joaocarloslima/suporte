<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
</script>
<script src="semanticui/semantic.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">


$(document).ready( function () {
		$('#datatable').DataTable({
			"pagingType": "numbers",
			"dom": '<"toolbar">frtip',
			language: {
				search: "_INPUT_",
				searchPlaceholder: "buscar...",
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Nenhum registro encontrado",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro",
				"infoFiltered": "(filtrado de _MAX_ registros)",
				"paginate": {
					"next": "próxima",
					"last": "última",
					"first": "primeira",
					"previous": "anterior"
				}
			}
		});
		$('#datatable_filter').children('label').addClass("ui input");
	} );




</script>