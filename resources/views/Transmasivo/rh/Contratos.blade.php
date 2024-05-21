<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Contratos</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="exampleValidation" action="{{url('/Contratos')}}">
				@csrf
				<div class="form-group row " >
					<div class="col-md-3">
						<label>Nombre completo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="nombre" name="nombre" >
					</div>
					<div class="col-md-2">
						<label>Edad <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Edad" name="Edad" >
					</div>
                    <div class="col-md-3">
						<label>Puesto <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Puesto" name="Puesto" >
					</div>
                    <div class="col-md-2">
						<label>Sueldo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Sueldo" name="Sueldo" >
					</div>
                    
				</div>
				<div class="form-group row " >
					<div class="col-md-3">
						<label>Nacionalidad <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Nacionalidad" name="Nacionalidad" value="Mexicana" >
					</div>
					<div class="col-md-3">
						<label>Sexo <span class="required-label">*</span></label>
						<select  required  class="form-control input-with-border" id="Sexo" name="Sexo" >
							<option>Masculino</option>
							<option>Femenino</option>
						</select>
					</div>
                    <div class="col-md-3">
					<label>Estado Civil <span class="required-label">*</span></label>
						<select required class="form-control input-with-border" id="Civil" name="Civil">
							<option value="">Seleccione una opción</option>
							<option value="soltero">Soltero/a</option>
							<option value="casado">Casado/a</option>
							<option value="divorciado">Divorciado/a</option>
							<option value="viudo">Viudo/a</option>
							<option value="union_libre">Unión libre</option>
							<option value="separado">Separado/a</option>
							<option value="comprometido">Comprometido/a</option>
						</select>

					</div>
                    <div class="col-md-3">
						<label>RFC <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="RFC" name="RFC" >
					</div>
                    
				</div>
				<div class="form-group row " >
					<div class="col-md-12">
						<hr>	
						<center><b>Domicilio</b></center>
						
					</div>
				</div>
				<div class="form-group row " >
					<div class="col-md-12">
							
					</div>
					<div class="col-md-3">
						<label>Calle <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Calle" name="Calle"  >
					</div>
					<div class="col-md-3">
						<label>Numero <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Numero" name="Numero"  >
					</div>
					<div class="col-md-4">
						<label>Colonia <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Colonia" name="Colonia"  >
					</div>
                    
                    
				</div>
				<div class="form-group row " >
					
					<div class="col-md-3">
						<label>Alcaldia/Municipio <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Alcaldia" name="Alcaldia"  >
					</div>
					<div class="col-md-3">
						<label>Estado <span class="required-label">*</span></label>
						<select required class="form-control input-with-border" id="Estado" name="Estado">
							<option value="">Seleccione un estado</option>
							<option value="aguascalientes">Aguascalientes</option>
							<option value="baja_california">Baja California</option>
							<option value="baja_california_sur">Baja California Sur</option>
							<option value="campeche">Campeche</option>
							<option value="chiapas">Chiapas</option>
							<option value="chihuahua">Chihuahua</option>
							<option value="ciudad_de_mexico">Ciudad de México</option>
							<option value="coahuila">Coahuila</option>
							<option value="colima">Colima</option>
							<option value="durango">Durango</option>
							<option value="guanajuato">Guanajuato</option>
							<option value="guerrero">Guerrero</option>
							<option value="hidalgo">Hidalgo</option>
							<option value="jalisco">Jalisco</option>
							<option value="mexico">Estado de México</option>
							<option value="michoacan">Michoacán</option>
							<option value="morelos">Morelos</option>
							<option value="nayarit">Nayarit</option>
							<option value="nuevo_leon">Nuevo León</option>
							<option value="oaxaca">Oaxaca</option>
							<option value="puebla">Puebla</option>
							<option value="queretaro">Querétaro</option>
							<option value="quintana_roo">Quintana Roo</option>
							<option value="san_luis_potosi">San Luis Potosí</option>
							<option value="sinaloa">Sinaloa</option>
							<option value="sonora">Sonora</option>
							<option value="tabasco">Tabasco</option>
							<option value="tamaulipas">Tamaulipas</option>
							<option value="tlaxcala">Tlaxcala</option>
							<option value="veracruz">Veracruz</option>
							<option value="yucatan">Yucatán</option>
							<option value="zacatecas">Zacatecas</option>
						</select>

					</div>
					<div class="col-md-4">
						<label>Codigo postal <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="postal" name="postal"  >
					</div>
					<div class="col-md-2">
						<label>RFC <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="RFC" name="RFC"  >
					</div>
                    
                    
				</div>
				<div class="form-group row " >
					<div class="col-md-4">
						<label>IMSS <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="IMSS" name="IMSS"  >
					</div>
					<div class="col-md-4">
						<label>CURP <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="CURP" name="CURP"  >
					</div>
					<div class="col-md-4">
						<label>Correo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Correo" name="Correo"  >
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
	
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
	$('#n_economico').change(cambioEARTBUS);
	
</script>
@endsection
</x-app-layout>
