<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Gestión de cursos. </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="exampleValidation" action="{{url('/Validar_horas_de_curso')}}" enctype="multipart/form-data">
				@csrf
				<div class="form-group row " >
					<div class="col-md-3">
						<label><br>Cursos <span class="required-label">*</span></label>
						<select required  class="form-control input-with-border" id="Curso" name="Curso" >
                            @foreach($c_cursos as $curso)
                                <option value="{{$curso->id_curso_capacitacion}}">{{$curso->curso}}</option>
                            @endforeach
                        </select>
					</div>
					<div class="col-md-12">
						<br>
						<center><input type="submit" class="btn btn-primary" value="Buscar" id="Buscar" name="Buscar"></center>
					</div>

				</div>
			</form>
            <div class="form-group row " >
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" style="width:100%;" id="table">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary sorting" style="color:#fff;">Curso</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Partisipantes</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Área</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Horas tomadas</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Calificación final</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Fecha de registro</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_llenar">
                                        @if($consulta != "")
                                            @foreach($consulta as $consul)
                                            <tr>
                                                <td>{{$consul->id_t_curso}}</td>
                                                <td>{{$consul->participante}}</td>
                                                <td>{{$consul->area}}</td>
                                                <td>{{$consul->horas_tomadas}} de {{$consul->horas}}</td>
                                                <td>{{$consul->calificacion_final}}</td>
                                                <td>{{$consul->fecha_creacion}}</td>
                                            
                                                <td>
                                                    <button class="btn btn-primary" onclick="abrirModal('')">Validar horas</button>
                                                    <hr>
                                                    <button class="btn btn-primary" onclick="abrirModal('')">Registrar calificacion del curso</button>
                                                    <hr>
                                                    <form method="post" id="exampleValidation" action="{{url('/Validar_horas_de_curso')}}" enctype="multipart/form-data">
				                                    @csrf
                                                        <input type="submit" class="btn btn-primary" value="Descargar comprobante" id="Comprobante" name="Comprobante">
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
	$('#table').DataTable({
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
