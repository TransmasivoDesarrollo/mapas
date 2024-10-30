<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Registro de conductor  </div>
					
				</div>
				<div class="card-body">
                    @if (session('mensaje'))
                        <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                            {{ session('mensaje') }}.
                        </div>
                    @endif
					{{-- inicio del row --}}
                    <form method="post" id="acceso" action="{{url('/Registrar_conductor')}}">
					@csrf

					<div class="form-group row " >
                            <div class="col-md-2" >
                                <label>Numero de empleado  <span class="required-label">*</span></label>
                                <input required="" type="text" class="form-control input-with-border" id="id_empleado" name="id_empleado" >
                            </div>
                            <div class="col-md-3">
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
