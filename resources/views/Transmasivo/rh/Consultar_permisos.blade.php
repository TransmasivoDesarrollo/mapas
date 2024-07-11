<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}.custom-icon {
			font-size: 22px;
		}

	</style>
	<div class="card">
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="la la-calendar-o custom-icon"></i> Consulta de permisos</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
				<div class="form-group row " >
					<div class="col-md-3">
						<label>Nombre completo <span class="required-label"></span></label>
						<input  type="text" value="{{$nombre}}" class="form-control input-with-border" id="nombre" name="nombre" disabled>
					</div>
					<div class="col-md-2">
						<label>ID empleado <span class="required-label"></span></label>
						<input  type="text" class="form-control input-with-border" id="id_empleado" name="id_empleado" value="{{$id}}" disabled>
						<input  type="hidden" class="form-control input-with-border" id="id_empleado_h" name="id_empleado_h" value="{{$id}}">
					</div>
					<div class="col-md-4">
						<label>Areá <span class="required-label"></span></label>
						<input  type="text" class="form-control input-with-border" id="area" name="area" disabled value="{{$tipo_usuario}}">
					</div>
            	</div>
				<div class="form-group row " >
					<div class="col-md-12">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-bordered  " id="list_user">
                                <thead>
                                    <tr>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Incidencia</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha de inicio</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha de termino</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha de captura de incidencia</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus jefe directo</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus Recur. Human.</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus Dirección</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus General</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Observaciones</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Descargar permiso</center></th>
                                    </tr>
                                </thead>
                                <tbody id="llenaTabla">
                                    @if($consulta !== "")
                                        @foreach($consulta as $consul)
                                        <tr>
                                            <td>{{$consul->Incidencia}}</td>
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
                                                <form method="post" id="contratoForm" action="{{url('/Consultar_permisos')}}">
                                                    @csrf
                                                    <input type="hidden" id="id_h" name="id_h" value="{{$consul->id}}"> 
                                                    @if($consul->estatus_jefe_directo == "Aprobado" && $consul->estatus_rh == "Aprobado" && $consul->estatus_direccion == "Aprobado")  <input type="submit" class="btn btn-primary" value="Descargar formato"> 
                                                @elseif($consul->estatus_jefe_directo == "Rechazado" || $consul->estatus_rh == "Rechazado" || $consul->estatus_direccion == "Rechazado") <b style="color:red;">Rechazado</b> 
                                                @else  <input type="submit" class="btn btn-primary" value="Descargar formato"> @endif
                                                   
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye moment.js con locales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

<script type="text/javascript">
	
	
    $(document).ready(function() {
        // Establece el idioma a español en moment.js
        moment.locale('es');

        // Itera sobre cada celda que contiene una fecha de registro
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
