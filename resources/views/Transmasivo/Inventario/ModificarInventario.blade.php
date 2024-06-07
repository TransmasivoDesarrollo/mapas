<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
        table {
                  font-family: arial, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
              }
	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inventario</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			
                {{--
				<div class="form-group row " >
					<div class="col-md-4">
						<label>Código  <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="codigo" name="codigo" >
					</div>
					<div class="col-md-4">
						<label>Pasillo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Pasillo" name="Pasillo" value="" >
					</div>
					<div class="col-md-4">
						<label>Anaquel <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="Anaquel" name="Anaquel" value="" >
					</div>
                   
                    
				</div>
				<div class="form-group row " >
					
                    <div class="col-md-4">
						<label>Nivel <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="Nivel" name="Nivel" value="" >
					</div>
				</div>
				
                <div class="form-group row " >
                    <div class="col-md-12">
						<center>
						<input required type="submit" class="btn btn-success" id="Consultar" name="Consultar" value="Consultar" >
                        </center>
					</div>
				</div>
                --}}
                <form method="post" id="exampleValidation" action="{{url('/ModificarInventario')}}" enctype="multipart/form-data">
				@csrf
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cambios</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="form-group row " >
                                <div class="col-md-4">
                                    <label>Código  <span class="required-label">*</span></label>
                                    <input required type="text" class="form-control input-with-border" id="codigo_m" name="codigo_m" >
                                </div>
                                <div class="col-md-4">
                                    <label>Nombre refacción   <span class="required-label">*</span></label>
                                    <input required type="text" class="form-control input-with-border" id="refaccion_m" name="refaccion_m" >
                                </div>
                                <div class="col-md-4">
                                    <label>Cantidad <span class="required-label">*</span></label>
                                    <input required type="number" class="form-control input-with-border" id="cantidad_m" name="cantidad_m" >
                                    <input  type="hidden" class="form-control input-with-border" id="id_inventario_m" name="id_inventario_m" >
                                    
                                </div>
                            </div>
                            <div class="form-group row " >
                                <div class="col-md-4">
                                    <label>Pasillo <span class="required-label">*</span></label>
                                    <input required type="text" class="form-control input-with-border" id="Pasillo_m" name="Pasillo_m" value="" >
                                </div>
                                <div class="col-md-4">
                                    <label>Anaquel <span class="required-label">*</span></label>
                                    <input  type="text" class="form-control input-with-border" id="Anaquel_m" name="Anaquel_m" value="" >
                                </div>
                                <div class="col-md-4">
                                    <label>Nivel <span class="required-label">*</span></label>
                                    <input  type="text" class="form-control input-with-border" id="Nivel_m" name="Nivel_m" value="" >
                                </div>
                            </div>
                            <div class="form-group row " >
                                <div class="col-md-4">
                                    <label>Charola <span class="required-label">*</span></label>
                                    <input  type="text" class="form-control input-with-border" id="Charola_m" name="Charola_m" value="" >
                                </div>
                                <div class="col-md-4">
                                    <label>Foto  <span class="required-label">*</span></label>
                                    <img src="{{url('/images/Inventario')}}" id="Foto_m" name="Foto_m" width="150px;" accept=" .jpeg, .jpg, .png">
                                    <input  type="file" class="form-control input-with-border" id="Foto_mo" name="Foto_mo" accept=" .jpeg, .jpg, .png">

                                </div>
                                <div class="col-md-4">
                                    <label>Quien conto  <span class="required-label">*</span></label>
                                    <input  type="text" class="form-control input-with-border" id="Name_m" name="Name_m"  disabled>

                                </div>
                            </div>
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <input type="submit" id="cambios" name="cambios" class="btn btn-primary" value="Guardar cambios">
                            </div>
                            </div>
                        </div>
                    </div>
                    
			    </form>
                    <form method="post" id="exampleValidation" action="{{url('/ModificarInventario')}}" enctype="multipart/form-data">
				@csrf
                <div class="form-group row " >
                    <div class="col-md-12">
                        <center>
                        <input type="submit" id="pdf" name="pdf" class="btn btn-danger" value="Generar PDF">
                        
                        <input  type="hidden" class="form-control input-with-border" id="ID_CONTO" name="ID_CONTO" value="{{ auth()->user()->id }}">
                        </center>
                    </div>
                </div>
			    </form>
				<div class="form-group row table-responsive" >
                    <table class="table" id="t_inventario">
                    <thead>
                        <tr>
                            <th class="bg-primary sorting" style="color:#fff;">ID inventario</th>
                            <th class="bg-primary sorting" style="color:#fff;">Codigo</th>
                            <th class="bg-primary sorting" style="color:#fff;">Refaccion</th>
                            <th class="bg-primary sorting" style="color:#fff;">Cantidad</th>
                            <th class="bg-primary sorting" style="color:#fff;">Pasillo</th>
                            <th class="bg-primary sorting" style="color:#fff;">Anaquel</th>
                            <th class="bg-primary sorting" style="color:#fff;">Nivel</th>
                            <th class="bg-primary sorting" style="color:#fff;">Charola</th>
                            <th class="bg-primary sorting" style="color:#fff;">Foto</th>
                            <th class="bg-primary sorting" style="color:#fff;">Fecha</th>
                            <th class="bg-primary sorting" style="color:#fff;">Acción</th>
                        </tr>
            </thead>
            <tbody>
                
                        @foreach($t_inventarios as $t_inventario)
                        <tr>
                            <td>{{$t_inventario->id_inventario}}</td>
                            <td>{{$t_inventario->Codigo}}</td>
                            <td>{{$t_inventario->Refaccion}}</td>
                            <td>{{$t_inventario->Cantidad}}</td>
                            <td>{{$t_inventario->Pasillo}}</td>
                            <td>{{$t_inventario->Anaquel}}</td>
                            <td>{{$t_inventario->Nivel}}</td>
                            <td>{{$t_inventario->Charola}}</td>
                            <td><a target="_blank" href="{{url('/images/Inventario/')}}/{{$t_inventario->Foto}}">{{$t_inventario->Foto}}</a></td>
                            <td class="fecha" data-fecha="{{ $t_inventario->Fecha }}"></td>

                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="llenarModal('{{$t_inventario->id_inventario}}','{{$t_inventario->Codigo}}','{{$t_inventario->Refaccion}}',
                            '{{$t_inventario->Cantidad}}','{{$t_inventario->Pasillo}}','{{$t_inventario->Anaquel}}','{{$t_inventario->Nivel}}','{{$t_inventario->Charola}}',
                            '{{$t_inventario->Foto}}','{{$t_inventario->Fecha}}','{{$t_inventario->name}}')" data-target="#exampleModal">
                                Modificar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        
            </tbody>
                    </table>
				</div>
		</div>
	</div>




@section('jscustom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript">
	  document.addEventListener("DOMContentLoaded", function() {
        // Selecciona todos los elementos con la clase 'fecha'
        var fechaElements = document.querySelectorAll('.fecha');

        // Recorre cada uno de los elementos
        fechaElements.forEach(function(element) {
            // Obtén la fecha del atributo 'data-fecha'
            var fecha = element.getAttribute('data-fecha');

            // Convierte la fecha a un objeto Date
            var dateObj = new Date(fecha);

            // Formatea la fecha como desees
            var formattedDate = dateObj.toLocaleString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Inserta la fecha formateada en el elemento
            element.textContent = formattedDate;
        });
    });
    $('#t_inventario').DataTable({
        scrollX: false,
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[7, 14, 21, 28, 35, -1], [7, 14, 21, 28, 35, "Todos"]],
        iDisplayLength: 7,
        dom: 'lBfrtip', // Agrega los elementos que quieres mostrar y sus ubicaciones
       
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
    function llenarModal(id_inventario,Codigo,Refaccion,Cantidad,Pasillo,Anaquel,Nivel,Charola,Foto,Fecha,name)
    {
        $('#id_inventario_m').val(id_inventario);
        $('#codigo_m').val(Codigo);
        $('#refaccion_m').val(Refaccion);
        $('#cantidad_m').val(Cantidad);
        $('#Pasillo_m').val(Pasillo);
        $('#Anaquel_m').val(Anaquel);
        $('#Nivel_m').val(Nivel);
        $('#Charola_m').val(Charola);
        $('#Foto_m').attr('src','{{url("/images/Inventario/")}}/'+Foto);
        $('#Name_m').val(name); 
    }
</script>
@endsection
</x-app-layout>
