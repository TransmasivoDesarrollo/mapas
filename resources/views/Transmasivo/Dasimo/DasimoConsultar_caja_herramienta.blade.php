<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inventario Dasimo </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			    <div class=" row form-group " >
                   
                        <div class="col-md-12 text-right"> 
                            
                        </div>
                    <div class="col-md-2">
                        &nbsp;
                    </div>
                    <div class="col-md-8">
                        <table class=" table table-responsive"  id="t_inventario">
                            <thead>
                                <tr>
                                    <th class="bg-primary sorting" style="color:#fff;">ID</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Producto</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Cantidad</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Categoria</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Foto</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventario as $t_inventario)
                                    <tr>
                                        <td>{{$t_inventario->id_inventario_dasimo}}</td>
                                        <td>{{$t_inventario->nombre}}</td>
                                        <td>{{$t_inventario->cantidad}}</td>
                                        <td>{{$t_inventario->categoria}}</td>
                                        <td>
                                            <center>
                                                <img width="150px" src="{{ $t_inventario->foto ? url('/images/Inventario_dasimo/' . $t_inventario->foto) : url('/images/sin_imagen.jpg') }}">
                                            </center>
                                        </td>     
                                        
                                        <td><button class="btn btn-primary" onclick="abrirModal('{{$t_inventario->id_inventario_dasimo}}','{{$t_inventario->nombre}}','{{$t_inventario->cantidad}}','{{$t_inventario->categoria}}' )">Actualizar info</button></td>      
                                    </tr>
                                @endforeach          
                            </tbody>
                        </table>
                        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                    <form method="post" id="exampleValidation" action="{{url('/DasimoConsultar_caja_herramienta')}}" enctype="multipart/form-data">
                                    @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar información</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row " >
                                                <div class="col-md-6">
                                                    <label><br>Nombre de inventario <span class="required-label">*</span></label>
                                                    <input required type="text" class="form-control input-with-border" id="Inventario_m" name="Inventario_m" >
                                                    <input type="hidden" class="form-control input-with-border" id="Inventario_hiden" name="Inventario_hiden" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label><br>Cantidad <span class="required-label">*</span></label>
                                                    <input required type="number" class="form-control input-with-border" id="Cantidad_m" name="Cantidad_m" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label><br>Categoria <span class="required-label">*</span></label>
                                                    <select required class="form-control input-with-border" id="Categoria_m" name="Categoria_m" >
                                                        <option value="Jarciería">Jarciería</option>
                                                        <option value="Herramientas">Herramientas</option>
                                                        <option value="Quimicos">Quimicos</option>
                                                        <option value="Equipo de protección personal">Equipo de protección personal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            <input type="submit" class="btn btn-primary" id="Guardar" name="Guardar" value="Guardar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
			        </div>
			    </div>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
	function abrirModal(id, nombre, cantidad, categoria)
    {
        $('#Inventario_m').val(nombre);
        $('#Inventario_hiden').val(id);
        $('#Cantidad_m').val(cantidad);

    $("#Categoria_m option").removeAttr("selected");
        $("#Categoria_m option[value='"+ categoria +"']").attr("selected",true);

        $('#modal').modal('show');
    }
    

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
