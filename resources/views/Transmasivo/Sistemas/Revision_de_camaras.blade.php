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
						<br>
					</div>
					<div class="col-md-3">
						<label>Fecha de mantenimiento <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="inicio" name="inicio" value="{{now()->format('Y-m-d')}}" >
						<br>
					</div>
                    <div class="col-md-4">
						<label>Económico <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Puesto" name="Puesto" >
						<br>
					</div>
                    <div class="col-md-6">
					<br>
						<p>¿Equipo DVR(DVR Móvil) enciende?<span class="required-label">*</span></p>
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
					<div class="col-md-6" id="remplazo_dvr" style="display:none;">
					<br>
						<p>Se remplazo el DVR<span class="required-label">*</span></p>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="remplazo_dvr1" name="remplazo_dvr" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="remplazo_dvr1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="remplazo_dvr2" name="remplazo_dvr" class="custom-control-input" value="No">
								<label class="custom-control-label" for="remplazo_dvr2">No</p>
							</div>
							
					    </div>
						<div class="form-check form-check-inline" id="remplazo_dvr_si" style="display:none;">
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="dvr_primer_camion1" name="dvr_primer_camion" class="custom-control-input" value="Primer carro">
								<label class="custom-control-label" for="dvr_primer_camion1">Primer carro</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="dvr_primer_camion2" name="dvr_segundo_camion" class="custom-control-input" value="Segundo carro">
								<label class="custom-control-label" for="dvr_primer_camion2">Segundo carro</p>
							</div>
					    </div>
					</div>
                    <div class="col-md-6"><br>
						<p>¿Imagen se muestra correctamente?<span class="required-label">*</span></p>
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
					<div class="col-md-6" id="remplaza_arnes" style="display:none;"><br>
						<p>Se remplaza arnes <span class="required-label">*</span></p>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="remplaza_arnes1" name="remplaza_arnes" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="remplaza_arnes1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="remplaza_arnes2" name="remplaza_arnes" class="custom-control-input" value="No">
								<label class="custom-control-label" for="remplaza_arnes2">No</p>
							</div>
					    </div>
						<div class="form-check form-check" id="remplaza_arnes_si" style="display:none;">
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes1" name="arnes1" class="custom-control-input" value="Arnes 1">
								<label class="custom-control-label" for="arnes1">Frontal </p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes2" name="arnes2" class="custom-control-input" value="Arnes 2">
								<label class="custom-control-label" for="arnes2">Lateral izquierdo</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes3" name="arnes3" class="custom-control-input" value="Arnes 3">
								<label class="custom-control-label" for="arnes3">Conductor</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes4" name="arnes4" class="custom-control-input" value="Arnes 4">
								<label class="custom-control-label" for="arnes4">Carro 1</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes5" name="arnes5" class="custom-control-input" value="Arnes 5">
								<label class="custom-control-label" for="arnes5">Carro 2</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes6" name="arnes6" class="custom-control-input" value="Arnes 6">
								<label class="custom-control-label" for="arnes6">Lateral derecho</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes7" name="arnes7" class="custom-control-input" value="Arnes 7">
								<label class="custom-control-label" for="arnes7">Trasera</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="arnes8" name="arnes8" class="custom-control-input" value="Arnes 8">
								<label class="custom-control-label" for="arnes8">Puerta 4</p>
							</div>
					    </div>
					</div>
                    <div class="col-md-6"><br>
						<p>¿Equipo graba correctamente?<span class="required-label">*</span></p>
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
					<div class="col-md-6" id="remplaza_disco" style="display:none;"><br>
						<p>Se remplaza el disco duro<span class="required-label">*</span></p>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="remplaza_disco1" name="remplaza_disco" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="remplaza_disco1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="remplaza_disco2" name="remplaza_disco" class="custom-control-input" value="No">
								<label class="custom-control-label" for="remplaza_disco2">No</p>
							</div>
							
					    </div>
					</div>
                    <div class="col-md-6"><br>
						<p>¿Fecha y hora son correctos?<span class="required-label">*</span></p>
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
					<div class="col-md-6" id="actualiza_fecha" style="display:none;"><br>
						<p>Se actualiza la fecha y hora<span class="required-label">*</span></p>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="actualiza_fecha1" name="actualiza_fecha" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="actualiza_fecha1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="actualiza_fecha2" name="actualiza_fecha" class="custom-control-input" value="No">
								<label class="custom-control-label" for="actualiza_fecha2">No</p>
							</div>
							
					    </div>
					</div>
                    <div class="col-md-6"><br>
						<p>¿Cámaras limpias?                        <span class="required-label">*</span></p>
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
					<div class="col-md-6" id="limpian_camaras" style="display:none;"><br>
						<p>Se limpian las camaras                      <span class="required-label">*</span></p>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="limpian_camaras1" name="limpian_camaras" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="limpian_camaras1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="limpian_camaras2" name="limpian_camaras" class="custom-control-input" value="No">
								<label class="custom-control-label" for="limpian_camaras2">No</p>
							</div>
							
					    </div>
						<div class="form-check form-check" id="limpian_camaras_div" style="display:none;">
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara1" name="camara1" class="custom-control-input" value="Camara 1">
								<label class="custom-control-label" for="camara1">Frontal </p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara2" name="camara2" class="custom-control-input" value="Camara 2">
								<label class="custom-control-label" for="camara2">Lateral izquierdo</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara3" name="camara3" class="custom-control-input" value="Camara 3">
								<label class="custom-control-label" for="camara3">Conductor</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara4" name="camara4" class="custom-control-input" value="Camara 4">
								<label class="custom-control-label" for="camara4">Carro 1</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara5" name="camara5" class="custom-control-input" value="Camara 5">
								<label class="custom-control-label" for="camara5">Carro 2</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara6" name="camara6" class="custom-control-input" value="Camara 6">
								<label class="custom-control-label" for="camara6">Lateral derecho</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara7" name="camara7" class="custom-control-input" value="Camara 7">
								<label class="custom-control-label" for="camara7">Trasera</p>
							</div>
							<div class="custom-control custom-checkbox">
								<input required type="checkbox" id="camara8" name="camara8" class="custom-control-input" value="Camara 8">
								<label class="custom-control-label" for="camara8">Puerta 4</p>
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
	
	$(document).ready(function() {
            $('input[name="radio_dvr"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#remplazo_dvr').hide();
                } else if ($(this).val() === 'No') {
                    $('#remplazo_dvr').show();
                }
            });
			$('input[name="radio_imagenes"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#remplaza_arnes').hide();
                } else if ($(this).val() === 'No') {
                    $('#remplaza_arnes').show();
                }
            });
			$('input[name="radio_graba"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#remplaza_disco').hide();
                } else if ($(this).val() === 'No') {
                    $('#remplaza_disco').show();
                }
            });
			$('input[name="radio_fecha"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#actualiza_fecha').hide();
                } else if ($(this).val() === 'No') {
                    $('#actualiza_fecha').show();
                }
            });
			$('input[name="radio_limpias"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#limpian_camaras').hide();
                } else if ($(this).val() === 'No') {
                    $('#limpian_camaras').show();
                }
            });
			$('input[name="remplazo_dvr"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#remplazo_dvr_si').show();
                } else if ($(this).val() === 'No') {
                    $('#remplazo_dvr_si').hide();
                }
            });
			$('input[name="remplaza_arnes"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#remplaza_arnes_si').show();
                } else if ($(this).val() === 'No') {
                    $('#remplaza_arnes_si').hide();
                }
            });
			$('input[name="limpian_camaras"]').change(function() {
                if ($(this).val() === 'Si') {
                    $('#limpian_camaras_div').show();
                } else if ($(this).val() === 'No') {
                    $('#limpian_camaras_div').hide();
                }
            });
			
			
        });
</script>
@endsection
</x-app-layout>
