<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
		.custom-icon {
			font-size: 22px;
		}

	</style>
	<div class="card">
		<div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Solicitar permiso</div>
		</div>

		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="contratoForm" action="{{url('/Permisos')}}">
				@csrf
				<div class="form-group row " >
					<div class="col-md-3">
						<label>Nombre completo <span class="required-label">*</span></label>
						<input  type="text" value="{{$nombre}}" class="form-control input-with-border" id="nombre" name="nombre" disabled>
					</div>
					<div class="col-md-2">
						<label>ID empleado <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="id_empleado" name="id_empleado" value="{{$id}}" disabled>
						<input  type="hidden" class="form-control input-with-border" id="id_empleado_h" name="id_empleado_h" value="{{$id}}">
					</div>
					<div class="col-md-3">
						<label>Areá <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="area" name="area" disabled value="{{$tipo_usuario}}">
					</div>
                    <div class="col-md-3">
						<label>Jefe inmediato <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="jefe_inmediato" name="jefe_inmediato" >
					</div>
				</div>
				<div class="form-group row " >
					<div class="col-md-3">
						<label>Autorización de recursos humanos <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="autorizacion_rh" name="autorizacion_rh" value="Omar" disabled >
						<input  type="hidden" class="form-control input-with-border" id="autorizacion_rh_h" name="autorizacion_rh_h" value="Omar"  >
					</div>
                    <div class="col-md-3">
						<label>Autorización de dirección <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="autorizacion_dir" name="autorizacion_dir" value="Wendy" disabled>
						<input  type="hidden" class="form-control input-with-border" id="autorizacion_dir_h" name="autorizacion_dir_h" value="Wendy" >
					</div>
                    <div class="col-md-3">
						<label>Incidencia <span class="required-label">*</span></label>
						<select   class="form-control input-with-border" id="incidencia" name="incidencia" onchage="cambioIncidencia()">
                            <option value="Permiso especial">Permiso especial</option>
                            {{-- <option>Días de duelo</option> --}}
                            <option value="Vacaciones">Vacaciones</option>
                        </select>
					</div>
					<div class="col-md-3">
						<label>Fecha inicio <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="fecha_inicio" name="fecha_inicio" min="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}">
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-3">
						<label>Fecha fin <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="fecha_fin" name="fecha_fin"  min="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}">
					</div>
					<div class="col-md-4" id="motivo_s">
						<label>Motivo de solicitud <span class="required-label">*</span></label>
						<textarea required type="date" class="form-control input-with-border" id="motivo_solicitud" name="motivo_solicitud" ></textarea>
					</div>
					<div class="col-md-4" id="soporte_a">
						<label>Soportes anexos <span class="required-label"></span></label>
						<textarea  type="date" class="form-control input-with-border" id="soportes_anexos" name="soportes_anexos" ></textarea>
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<center>
						<input required type="submit" class="btn btn-success" id="Generar" name="Generar" value="Generar" >
                        </center>
					</div>
				</div>
			</form>
		</div>
	</div>

@section('jscustom')
<script type="text/javascript">
	$('#incidencia').on('change', function() {
    var incidencia = $(this).val();
    
    if (incidencia == "Permiso especial") {
        console.log(incidencia);
        $('#motivo_s').css('display', 'block');
        $('#soporte_a').css('display', 'block');
        $('#motivo_solicitud').attr('required', true);
    } else if (incidencia == "Vacaciones") {
        console.log(incidencia);
        $('#motivo_s').css('display', 'none');
        $('#soporte_a').css('display', 'none');
        $('#motivo_solicitud').attr('required', false);
    }
});

</script>
@endsection
</x-app-layout>
