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
                                                    <button class="btn btn-primary" @php if($consul->horas_tomadas == $consul->horas) { @endphp disabled @php } @endphp onclick="abrirModalvalidar_hora('{{$consul->id_inscripcion_capacitacion}}','{{$consul->participante}}','{{$consul->horas_tomadas}}','{{$consul->horas}}')">Validar horas</button>
                                                    <hr >
                                                    <button class="btn btn-primary" @php if($consul->horas_tomadas == $consul->horas) { @endphp  @php }else{ @endphp disabled @php } @endphp onclick="abrirModal_calificaciones('{{$consul->id_inscripcion_capacitacion}}','{{$consul->participante}}','{{$consul->horas_tomadas}}','{{$consul->horas}}')">Registrar calificacion del curso</button>
                                                    <hr>
                                                    <form method="post" id="exampleValidation" action="{{url('/Validar_horas_de_curso')}}" enctype="multipart/form-data">
				                                    @csrf
                                                        <input type="hidden" id="id_inscripcion_capacitacion" name="id_inscripcion_capacitacion" value="{{$consul->id_inscripcion_capacitacion}}">
                                                        <input type="submit" class="btn btn-primary" @php if($consul->horas_tomadas == $consul->horas && $consul->calificacion_final>=8 ) { @endphp  @php }else{ @endphp disabled @php } @endphp value="Descargar comprobante" id="Comprobante" name="Comprobante">
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" id="abrirModalvalidar_hora" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form method="post" id="exampleValidation" action="{{url('/Validar_horas_de_curso')}}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <p>Validar hora de <b id="modal_nombre"></b></p>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-5">
                                                            <label>Horas tomadas</label>
                                                            <input type="number" onclick="valida()" id="horas_tomadas" class="form-control" name="horas_tomadas" >
                                                            <input type="hidden"  id="hora_max" class="form-control" name="hora_max" >
                                                            <input type="hidden" id="hora_min" class="form-control" name="hora_min" >
                                                            <input type="hidden" id="id_actualizar" class="form-control" name="id_actualizar" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    <input type="submit" class="btn btn-primary" id="boton_agregar" name="boton_agregar" value="Agregar">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" id="abrirModal_calificaciones" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form method="post" id="exampleValidation" action="{{url('/Validar_horas_de_curso')}}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <p>Capturar calificacion <b id="modal_nombre"></b></p>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-5">
                                                            <label>Calificación del curso</label>
                                                            <input type="text" onclick="valida2()" id="calificacion_tomadas" max="10" min="0" class="form-control" name="calificacion_tomadas" >
                                                            <input type="hidden"  id="hora_max2" class="form-control" name="hora_max2" >
                                                            <input type="hidden" id="hora_min2" class="form-control" name="hora_min2" >
                                                            <input type="hidden" id="id_actualizar2" class="form-control" name="id_actualizar2" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    <input type="submit" class="btn btn-primary" id="boton_agregar_calificacion" name="boton_agregar_calificacion" value="Agregar">
                                                </div>
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

    function abrirModal_calificaciones(id, nombre, horas_tomadas, horas_curso)
    {
        
        $('#id_actualizar2').val(id);
        $('#abrirModal_calificaciones').modal('show');
    }
    function abrirModalvalidar_hora(id, nombre, horas_tomadas, horas_curso)
    {
        
        $('#horas_tomadas').val('');
        $('#abrirModalvalidar_hora').modal('show');
        $('#modal_nombre').html(nombre);
        if(horas_tomadas==0)
        { }else{
            $('#horas_tomadas').val(horas_tomadas);
        }
        $('#hora_max').val(horas_curso);
        $('#hora_min').val(horas_tomadas);
        $('#id_actualizar').val(id);
        $('#horas_tomadas').attr('max', horas_curso);
        $('#horas_tomadas').attr('min', horas_tomadas);
        
    }

    function valida2() {
        $('#calificacion_tomadas').on('input change', function() {
            let max = parseFloat($(this).attr('max'));
            let min = parseFloat($(this).attr('min'));
            let value = $(this).val();

            let decimalPattern = /^\d*\.?\d*$/;

            if (!decimalPattern.test(value)) {
                alert('Por favor, ingrese un número decimal válido');
                $(this).val(''); 
                return;
            }
            value = parseFloat(value);
            if (value < min) {
                $(this).val(min);
            }
            if (value > max) {
                $(this).val(max);
            }
        });
    }

    valida2();

    function valida()
    {
        $('#horas_tomadas').on('input change', function() {
            let max = $(this).attr('max');
            let min = $(this).attr('min');
            let value = $(this).val();
           
            if (parseInt(value) > parseInt(max)) {
                $(this).val(max);
            }
        });
    }
</script>
@endsection
</x-app-layout>
