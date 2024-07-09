<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}.custom-icon {
			font-size: 22px;
		}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Alta de personal  </div>
					
				</div>
				
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
                    <div class="col-md-4">
                        <label>Nombres(s) <span class="required-label">*</span></label>
                        <input required="" type="text" class="form-control  input-with-border" id="Nombre" name="Nombre">
                        <span class="required-label" id="validaN" style="color:red; display: none;"><font size="1">Es necesario llenar este campo</font></span>
                    </div>
                    <div class="col-md-4">
                        <label>Apellido Paterno<span class="required-label">*</span></label>
                        <input required="" type="text" class="form-control input-with-border" id="Apellido_Paterno" name="Apellido_Paterno">
                        <span class="required-label" id="validaP" style="color:red; display: none;"><font size="1">Es necesario llenar este campo</font></span>
                    </div>
                    <div class="col-md-4">
                        <label>Apellido Materno<span class="required-label">*</span></label>
                        <input type="text" class="form-control input-with-border" id="Apellido_Materno" name="Apellido_Materno">
                        <span class="required-label" id="validaM" style="color:red; display: none;"><font size="1">Es necesario llenar este campo</font></span>
                    </div>

						</div>
						{{-- fin del row --}}
						{{-- inicio del row --}}

						<div class="form-group row " >

								<div class="col-md-3" >
									<label>Teléfono 1(Celular)  <span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="Telefono1" name="Telefono1" >
								</div>
								<div class="col-md-3">
									<label>Teléfono 2(Casa)<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border"  id="Telefono2" name="Telefono2"  >
								</div>
								<div class="col-md-3">
									<label>Calle<span class="required-label">*</span></label>
									<input  type="text" class="form-control input-with-border" id="Calle" name="Calle"  >
								</div>

							</div>
							{{-- fin del row --}}
							{{-- inicio del row --}}

							<div class="form-group row " >
								<div class="col-md-2">
									<label>Num. Interior<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="Ninterior" name="Ninterior"  >
								</div>
								<div class="col-md-2">
									<label>Num. Exterior<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="NExterior" name="NExterior"  >
								</div>
								<div class="col-md-4">
									<label>Colonia<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="Colonia" name="Colonia"  >
								</div>
								<div class="col-md-4">
									<label>Alcaldía/Municipio<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="Municipio" name="Municipio"  >
								</div>
								
							</div>

							{{-- fin del row --}}
							{{-- inicio del row --}}

							<div class="form-group row " >
								<div class="col-md-4">
									<label>Estado<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="Estado" name="Estado"  >
								</div>
								<div class="col-md-2">
									<label>Código Postal<span class="required-label">*</span></label>
									<input required="" type="text" class="form-control input-with-border" id="cp" name="cp"  >
								</div>
								<div class="col-md-6">
									<label>Referencia<span class="required-label">*</span></label>
									<textarea class="form-control" id="Referencia " style="border:1px black solid" name="Referencia"  >
									</textarea>
								</div>
								
							</div>
							{{-- fin del row --}}
							
							
							
							
							<br>
							
						</div>
						<div class="card-footer">{{-- inicio del row --}}
							<div class="row">
								<div class="col-md-12">
									<center>
										<input  type="submit" class="btn btn-success" value="Registrar" onclick="Registrar()">
									</center>
								</div>
							</div>
							{{-- fin del row --}}
						</div>

						
					</div>
					

				</div>
        </div>

</x-app-layout>
