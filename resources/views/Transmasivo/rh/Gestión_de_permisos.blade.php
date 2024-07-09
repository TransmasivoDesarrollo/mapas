<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
        
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="flaticon-list custom-icon"></i>  Gestión de permisos</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
				
				<div class="form-group row " >
					<div class="col-md-12">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-bordered  " id="list_user">
                                <thead>
                                    <tr>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>Incidencia</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>Nombre</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha de inicio</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha de termino</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha de captura de incidencia</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus jefe directo</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus Recur. Human.</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus Dirección</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus General</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Observaciones </center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Descargar permiso</center></th>
                                    </tr>
                                </thead>
                                <tbody id="llenaTabla">
                                    @if($consulta !== "")
                                        @foreach($consulta as $consul)
                                        <tr >
                                            <td>{{$consul->Incidencia}}</td>
                                            <td>{{$consul->name}}</td>
                                            <td data-fecha-inicio="{{$consul->fecha_inicio}}">{{$consul->fecha_inicio}}</td>
                                            <td data-fecha-termino="{{$consul->fecha_termino}}">{{$consul->fecha_termino}}</td>
                                            <td data-fecha-registro="{{$consul->fecha_registro}}">{{$consul->fecha_registro}}</td>
                                            <td>{{$consul->estatus_jefe_directo}}</td>
                                            <td>{{$consul->estatus_rh}}</td>
                                            <td>{{$consul->estatus_direccion}}</td>
                                            <td>@if($consul->estatus_jefe_directo == "Aprobado" && $consul->estatus_rh == "Aprobado" && $consul->estatus_direccion == "Aprobado") <b style="color:green;">Aprobado </b>
                                                @elseif($consul->estatus_jefe_directo == "Rechazado" || $consul->estatus_rh == "Rechazado" || $consul->estatus_direccion == "Rechazado") <b style="color:red;">Rechazado</b> 
                                                @else <b style="color:orange;">Pendiente </b>@endif</td>
                                            <td>{{$consul->observaciones}}</td>
                                            <td> 
                                            <form method="post" id="contratoForm" action="{{url('/Gestión_de_permisos')}}">
                                            @csrf
                                                <input type="hidden" id="id_h" name="id_h" value="{{$consul->id}}"> 
                                                <input type="submit" class="btn btn-primary" value="Aprobar" id="Aprobado" name="Aprobado">
                                            </form>
                                                <button type="button" class="btn btn-danger" id="Rechazado" onclick="abrirModal('{{$consul->id}}')">Rechazar</button> 
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif                                    
                                </tbody>
                            </table>
                                                <form method="post" id="contratoForm" action="{{url('/Gestión_de_permisos')}}">
                                                    @csrf
                                                    <div class="modal fade" id="rechazarModal" tabindex="-1" role="dialog" aria-labelledby="rechazarModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="rechazarModalLabel">Confirmar Rechazo</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>¿Estás seguro de que deseas rechazar?</p>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label>Observaciones</label>
                                                                            
                                                                            <input type="hidden" id="id_h_m" name="id_h_m" > 
                                                                            <textarea class="form-control"  id="observaciones" name="observaciones">Sin observaciones</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                    <input type="submit" class="btn btn-primary" value="Confirmar" id="Rechazar" name="Rechazar"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
			                                    </form>
                        </div>
					</div>
				</div>                
		</div>
	</div>




@section('jscustom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye moment.js con locales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

<script type="text/javascript">
	
    function abrirModal(id)
    {
        $('#rechazarModal').modal('show');
        $('#id_h_m').val(id);
        
    }
	
    $(document).ready(function() {
        $('#Rechazado').on('click', function(event) {
            event.preventDefault(); // Previene el envío del formulario

            // Mostrar el modal
            $('#rechazarModal').modal('show');
        });

        // Establece el idioma a español en moment.js
        moment.locale('es');

        $('td[data-fecha-registro]').each(function() {
            var fechaRegistro = $(this).data('fecha-registro');
            var fechaFormateada = moment(fechaRegistro).format('dddd, D [de] MMMM [de] YYYY, H:mm [hrs]');
            $(this).text(fechaFormateada);
        });
        $('td[data-fecha-termino]').each(function() {
            var fechaRegistro = $(this).data('fecha-termino');
            var fechaFormateada = moment(fechaRegistro).format('dddd, D [de] MMMM [de] YYYY');
            $(this).text(fechaFormateada);
        });
        $('td[data-fecha-inicio]').each(function() {
            var fechaRegistro = $(this).data('fecha-inicio');
            var fechaFormateada = moment(fechaRegistro).format('dddd, D [de] MMMM [de] YYYY');
            $(this).text(fechaFormateada);
        });
    });
</script>
@endsection
</x-app-layout>
