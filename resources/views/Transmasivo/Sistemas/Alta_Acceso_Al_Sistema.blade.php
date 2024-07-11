<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Acceso al sistema  </div>
					
				</div>
				
				
				<div class="card-body">
					{{-- inicio del row --}}
                    <form method="post" id="acceso" action="{{url('/AltaAccesoAlSistema')}}">
					@csrf

					<div class="form-group row " >
                            <div class="col-md-4">
                                <label>Nombres(s) <span class="required-label">*</span></label>
                                <input required="" type="text" class="form-control  input-with-border" id="Nombre" name="Nombre">
                                <span class="required-label" id="validaN" style="color:red; display: none;"><font size="1">Es necesario llenar este campo</font></span>
                            </div>
                            <div class="col-md-3">
                                <label>Apellido Paterno<span class="required-label">*</span></label>
                                <input required="" type="text" class="form-control input-with-border" id="Apellido_Paterno" name="Apellido_Paterno">
                                <span class="required-label" id="validaP" style="color:red; display: none;"><font size="1">Es necesario llenar este campo</font></span>
                            </div>
                            <div class="col-md-3">
                                <label>Apellido Materno<span class="required-label">*</span></label>
                                <input type="text" class="form-control input-with-border" id="Apellido_Materno" name="Apellido_Materno">
                                <span class="required-label" id="validaM" style="color:red; display: none;"><font size="1">Es necesario llenar este campo</font></span>
                            </div>
					</div>
					<div class="form-group row " >

						<div class="col-md-3" >
							<label>Correo electronico  <span class="required-label">*</span></label>
							<input required="" type="text" class="form-control input-with-border" id="email" name="email" >
						</div>
						<div class="col-md-2">
							<label>Contraseña<span class="required-label">*</span></label>
							<input required="" type="text" class="form-control input-with-border"  id="contrasena" name="contrasena"  >
						</div>
						<div class="col-md-2">
							<label>Confirmar contraseña<span class="required-label">*</span></label>
							<input  type="text" class="form-control input-with-border" id="contrasena2" name="contrasena2"  >
						</div>
                        <div class="col-md-3">
							<label>Rol<span class="required-label">*</span></label>
							<select class="form-control input-with-border" id="Rol" name="Rol"  >
                                <option value="Sistemas">Sistemas</option>
                                <option value="Recursos humanos">Recursos humanos</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Operaciones">Operaciones</option>
                                <option value="Inventario">Inventario</option>
                                <option value="Almacen">Almacen</option>
								
                            </select>
						</div>
					</div>
							
						<div class="card-footer">{{-- inicio del row --}}
							<div class="row">
								<div class="col-md-12">
									<center>
										<input  type="submit" class="btn btn-success" value="Registrar" name="registrar">
									</center>
								</div>
							</div>
							{{-- fin del row --}}
						</div>

						
					</div>
                    </form>

				</div>
        </div>

</x-app-layout>
