<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inventario para caja de herramientas </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			    <div class=" row form-group " >
                   
                        <div class="col-md-12 text-right"> <form method="post" id="acceso" action="{{url('/Consultar_caja_herramienta')}}">
                        @csrf
                            <input type="submit" class="btn btn-success" id="Exportar" name="Exportar" value="Exportar excel">
                            <br>
                    </form>
                        </div>
                    <div class="col-md-2">
                        &nbsp;
                    </div>
                    <div class="col-md-8">
                        <table class=" table table-responsive" id="t_inventario">
                            <thead>
                                <tr>
                                    <th class="bg-primary sorting" style="color:#fff;">ID inventario</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Refaccion</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Cantidad</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventario as $t_inventario)
                                    <tr>
                                        <td>HER0000{{$t_inventario->id}}</td>
                                        <td>{{$t_inventario->Refaccion}}</td>
                                        <td>{{$t_inventario->Cantidad}}</td>
                                        <td>
                                            <center>
                                                <img width="150px" src="{{url('/images/Caja de herramienta/')}}/{{$t_inventario->Foto}}">
                                            </center>
                                        </td>           
                                    </tr>
                                @endforeach          
                            </tbody>
                        </table>
			        </div>
			    </div>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
    $('#t_inventario').DataTable({
        scrollX: false,
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[12, 24, 36, 48, 60, -1], [12, 24, 36, 48, 60, "Todos"]],
        iDisplayLength: 12,
        "language": {
            "lengthMenu": "Mostrar _MENU_ datos",
            "zeroRecords": "No existe el dato introducido",
            "info": "Página _PAGE_ de _PAGES_ ",
            "infoEmpty": "Sin datos disponibles",
            "infoFiltered": "(mostrando los datos filtrados: _MAX_)",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "search": "Buscar",
            "processing": "Buscando...",
            "loadingRecords": "Cargando..."
        }
    });
	
</script>
@endsection
</x-app-layout>
