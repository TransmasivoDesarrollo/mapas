<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Revisión de camaras</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="contratoForm" action="{{url('/Renuncias')}}">
				@csrf
				<div class="form-group row " >
					<div class="col-md-4">
						<label>Nombre completo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="nombre" name="nombre" >
					</div>
					<div class="col-md-3">
						<label>Fecha de mantenimiento <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>
                    <div class="col-md-4">
						<label>Económico <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Puesto" name="Puesto" >
					</div>
                    
				</div>
                
				<div class="form-group row " >
                    <div class="col-md-6">
						<p>¿Equipo MDVR(DVR Móvil) enciende?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="responsabilidad_asumir1" name="radio_dvr" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="responsabilidad_asumir1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="responsabilidad_asumir2" name="radio_dvr" class="custom-control-input" value="No">
								<label class="custom-control-label" for="responsabilidad_asumir2">No</p>
							</div>
							
					    </div>
					</div>
                    <div class="col-md-6">
						<p>¿Imagen se muestra correctamente?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="radio_imagenes1" name="radio_imagenes" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="radio_imagenes1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="radio_imagenes2" name="radio_imagenes" class="custom-control-input" value="No">
								<label class="custom-control-label" for="radio_imagenes2">No</p>
							</div>
							
					    </div>
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-6">
						<p>¿Equipo graba correctamente?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="graba1" name="radio_graba" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="graba1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="graba2" name="radio_graba" class="custom-control-input" value="No">
								<label class="custom-control-label" for="graba2">No</p>
							</div>
							
					    </div>
					</div>
                    <div class="col-md-6">
						<p>¿Fecha y hora son correctos?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="fecha_correcta1" name="radio_fecha" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="fecha_correcta1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="fecha_correcta2" name="radio_fecha" class="custom-control-input" value="No">
								<label class="custom-control-label" for="fecha_correcta2">No</p>
							</div>
							
					    </div>
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-6">
						<p>¿Cámaras limpias?                        <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="radio_limpias1" name="radio_limpias" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="radio_limpias1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="radio_limpias2" name="radio_limpias" class="custom-control-input" value="No">
								<label class="custom-control-label" for="radio_limpias2">No</p>
							</div>
							
					    </div>
					</div>
                    <div class="col-md-6">
						<p>¿Tiempo de grabación correcta? <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="tiempo_grabacion1" name="radio_tiempo_grabacion" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="tiempo_grabacion1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="tiempo_grabacion2" name="radio_tiempo_grabacion" class="custom-control-input" value="No">
								<label class="custom-control-label" for="tiempo_grabacion2">No</p>
							</div>
							
					    </div>
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
	
	
</script>
@endsection
</x-app-layout>
