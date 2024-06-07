<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Liberacion de unidades express</div>
			
		</div>
		
		
		<div class="card-body">
			@if (session('mensaje'))
			
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				
				{{ session('mensaje') }}.
				
			</div>
			<div class="modal fade show" id="modalWhatsApp" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Registro con exito</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Un correo fue enviado al área de supervisión, pero puedes enviar un mensaje de WhatsApp oprimiendo el botón
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						<a href="whatsapp://send?phone=5515688077&text=Se abrió un nuevo reporte de mantenimiento con el folio" class="btn btn-success">Enviar mensaje por WhatsApp</a>
					</div>
					</div>
				</div>
				</div>
			@endif

			<form method="post" id="exampleValidation" action="{{url('/Bitacora_De_Liberacion_De_Unidades_express')}}">
				@csrf
				{{-- inicio del row --}}

				<div class="form-group row " >
					{{-- 
					<div class="col-md-2">
						<label>Numero de economico <span class="required-label">*</span></label>
						<input  required type="text" class="form-control  input-with-border" style="width:100%; height:100%; border:black 1px solid;" id="n_economico" name="n_economico">
					</div>
					--}}
					<div class="col-md-2">
						<label>Numero de economico <span class="required-label">*</span></label>
						<select  required type="text" class="form-control  input-with-border" id="n_economico" name="n_economico">
							@foreach($unidades as $unidad)
							<option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
							@endforeach
						</select>
					</div>
					{{--
					<div class="col-md-4">
						<label>Nombre del mecanico<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="n_mecanico" name="n_mecanico">
					</div>
					--}}
					<div class="col-md-4">
                            <label>Nombre del  mecanico</label>
                            <select   class="form-control input-with-border"  id="n_mecanico" name="n_mecanico">
								
                                @foreach($mecanicos as $mecanico)
                                <option>{{$mecanico->nombre}}</option>
                                @endforeach
								
							<option>Corina Jared López</option>
                            </select>
                        </div>
					<div class="col-md-4">
						<label>Nombre del supervisor <span class="required-label">*</span></label>
						<select   class="form-control input-with-border"  id="nom_supervisor" name="nom_supervisor">
                                @foreach($mecanicos as $mecanico)
                                <option>{{$mecanico->nombre}}</option>
								
                                @endforeach
								
							<option>Corina Jared López</option>
                        </select>
						{{--
						<input required type="text" class="form-control input-with-border" id="nom_supervisor" name="nom_supervisor">
						--}}
					</div>
					
				</div>
				{{-- fin del row --}}
				{{-- inicio del row --}}

				<div class="form-group row " >
                	<div class="col-md-3">
						<label>Fecha <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="Fecha" name="Fecha" value="{{ now()->format('Y-m-d') }}">
					</div>
					<div class="col-md-2">
						<label>Agregar kilometraje<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border"  id="km" name="km" max="" >
					</div>
					<div class="col-md-2">
						<label>Carga de bares<span class="required-label">*</span></label>
						<input  required type="number" class="form-control input-with-border" id="bares" name="bares"  >
					</div>

				</div>
			</div>
		</div>
		<div class="form-group row " >
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseniveles" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>NIVELES Y FUGAS</h5>
							</center>
						</div>
					</div>
					<div id="collapseniveles" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="4"><b>ACEITE DE MOTOR</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Relleno</td>
											<td align="center" width="20%">Total (en litros)</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="aceite_motor" name="aceite_motor" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="aceite_motor" name="aceite_motor" value="cambio"></td>
											<td align="center"><input type="text" class="form-control" id="aceite_motor_lt" name="aceite_motor_lt" ></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="aceite_motor_o" name="aceite_motor_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>REFRIGERANTE</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Relleno</td>
											<td align="center" width="20%">Total (en litros)</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="refrigerante" name="refrigerante" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="refrigerante" name="refrigerante" value="cambio"></td>
											<td align="center"><input type="text" class="form-control" id="refrigerante_lt" name="refrigerante_lt" ></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="refrigerante_o" name="refrigerante_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>ACEITE HIDRAULICO</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Relleno</td>
											<td align="center" width="20%">Total (en litros)</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="aceite_hidra" name="aceite_hidra" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="aceite_hidra" name="aceite_hidra" value="cambio"></td>
											<td align="center"><input type="text" class="form-control" id="aceite_hidra_lt" name="aceite_hidra_lt" ></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="aceite_hidra_o" name="aceite_hidra_o"></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="4"><b>HIDROVENTILADOR</b></td>
										</tr>
										<tr>
											<td align="center" width="20%">OK</td>
											<td align="center" width="20%">Relleno</td>
											<td align="center" width="20%">Total (en litros)</td>
											<td width="60%">Observ.</td>
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="hidroven" name="hidroven" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="hidroven" name="hidroven" value="cambio"></td>
											<td align="center"><input type="text" class="form-control" id="hidroven_lt" name="hidroven_lt" ></td>
											<td><input type="text" class="form-control" placeholder="Observaciones" id="hidroven_o" name="hidroven_o"></td>
										</tr>
										
									</table>
									
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsPuertas" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>PUERTAS</h5>
							</center>
						</div>
					</div>
					<div id="collapsPuertas" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
										
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>SERVICIO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="servicio" name="servicio" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="servicio" name="servicio" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 5)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="servicio_o" name="servicio_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>EMERGENCIA</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="emergencia" name="emergencia" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="emergencia" name="emergencia" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 6)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="emergencia_o" name="emergencia_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>

					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsNeumaticosEjeDireccional" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>NEUMATICOS - EJE DIRECCIONAL</h5>
							</center>
						</div>
					</div>
					<div id="collapsNeumaticosEjeDireccional" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
										
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_dir_izq" name="neu_eje_dir_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_dir_izq" name="neu_eje_dir_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 7)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_dir_izq_o" name="neu_eje_dir_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_dir_der" name="neu_eje_dir_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_dir_der" name="neu_eje_dir_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 8)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_dir_der_o" name="neu_eje_dir_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsNeumaticosEjeIntermedio" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>NEUMATICOS - EJE INTERMEDIO</h5>
							</center>
						</div>
					</div>
					<div id="collapsNeumaticosEjeIntermedio" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_int_izq" name="neu_eje_int_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_int_izq" name="neu_eje_int_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 9)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_int_izq_o" name="neu_eje_int_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_int_der" name="neu_eje_int_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_int_der" name="neu_eje_int_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 10)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_int_der_o" name="neu_eje_int_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsNeumaticosEjeMotriz" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>NEUMATICOS - EJE MOTRIZ</h5>
							</center>
						</div>
					</div>
					<div id="collapsNeumaticosEjeMotriz" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
										
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_motr_izq" name="neu_eje_motr_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_motr_izq" name="neu_eje_motr_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 11)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_motr_izq_o" name="neu_eje_motr_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_motr_der" name="neu_eje_motr_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="neu_eje_motr_der" name="neu_eje_motr_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 12)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_motr_der_o" name="neu_eje_motr_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsBalatasEjeDireccional" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>BALATAS  - EJE DIRECCIONAL</h5>
							</center>
						</div>
					</div>
					<div id="collapsBalatasEjeDireccional" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_dir_izq" name="bal_eje_dir_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_dir_izq" name="bal_eje_dir_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 13)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_dir_izq_o" name="bal_eje_dir_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_dir_der" name="bal_eje_dir_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_dir_der" name="bal_eje_dir_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 14)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_dir_der_o" name="bal_eje_dir_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsBalatasEjeIntermedio" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>BALATAS - EJE INTERMEDIO</h5>
							</center>
						</div>
					</div>
					<div id="collapsBalatasEjeIntermedio" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
										
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_int_izq" name="bal_eje_int_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_int_izq" name="bal_eje_int_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 15)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_int_izq_o" name="bal_eje_int_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_int_der" name="bal_eje_int_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_int_der" name="bal_eje_int_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 16)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_int_der_o" name="bal_eje_int_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsBalatasEjeMotriz" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>BALATAS - EJE MOTRIZ</h5>
							</center>
						</div>
					</div>
					<div id="collapsBalatasEjeMotriz" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
										
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_motr_izq" name="bal_eje_motr_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_motr_izq" name="bal_eje_motr_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 17)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_motr_izq_o" name="bal_eje_motr_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_motr_der" name="bal_eje_motr_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bal_eje_motr_der" name="bal_eje_motr_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 18)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_motr_der_o" name="bal_eje_motr_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsBolsaAireEjeDire" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>BOLSA DE AIRE - EJE DIRECCIONAL</h5>
							</center>
						</div>
					</div>
					<div id="collapsBolsaAireEjeDire" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_dir_izq" name="bols_air_eje_dir_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_dir_izq" name="bols_air_eje_dir_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 19)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_dir_izq_o" name="bols_air_eje_dir_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_dir_der" name="bols_air_eje_dir_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_dir_der" name="bols_air_eje_dir_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 20)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_dir_der_o" name="bols_air_eje_dir_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsBolsaAireEjeIntermedio" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>BOLSA DE AIRE - EJE INTERMEDIO</h5>
							</center>
						</div>
					</div>
					<div id="collapsBolsaAireEjeIntermedio" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
										
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_int_izq" name="bols_air_eje_int_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_int_izq" name="bols_air_eje_int_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 21)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_int_izq_o" name="bols_air_eje_int_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_int_der" name="bols_air_eje_int_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_int_der" name="bols_air_eje_int_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 22)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_int_der_o" name="bols_air_eje_int_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsBolsaAireEjeMotriz" aria-expanded="true" aria-controls="collapseOne" role="button">
						
						<div class="span-title">
							<center>
								<h5>BOLSA DE AIRE - EJE MOTRIZ</h5>
							</center>
						</div>
					</div>
					<div id="collapsBolsaAireEjeMotriz" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						
						<div class="card-body">
							{{-- inicio del row --}}

							<div class="form-group row " >
								
								
								<div class="col-md-12">
									<center>
									</center>
									<table width="100%;">
										<tr>
											<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_motr_izq" name="bols_air_eje_motr_izq" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_motr_izq" name="bols_air_eje_motr_izq" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 23)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_motr_izq_o" name="bols_air_eje_motr_izq_o">
											</td>
										</tr>
										
										<tr>
											<td align="center" colspan="4"><hr></td>
										</tr>
										<tr>
											<td align="center" colspan="3"><b>LADO DERECHO</b></td>
										</tr>
										<tr>
											<td align="center" width="15%">OK</td>
											<td align="center" width="15%">Rep.</td>
											<td align="center" width="70%">Listado</td>
											
										</tr>
										<tr>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_motr_der" name="bols_air_eje_motr_der" value="ok" ></td>
											<td align="center"><input type="radio"  class="form-control" id="bols_air_eje_motr_der" name="bols_air_eje_motr_der" value="cambio"></td>
											<td align="rigth">
												<div class="form-check">
													@foreach($fallas as $falla)
													@if($falla->id_subseccion == 24)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
													@endif
													@endforeach
													
													
												</div>
												<input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_motr_der_o" name="bols_air_eje_motr_der_o">
											</td>
										</tr>
										
										
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="card"> <div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsAsientos" aria-expanded="true" aria-controls="collapseOne" role="button">
					
					<div class="span-title">
						<center>
							<h5>ASIENTOS</h5>
						</center>
					</div>
				</div>
				<div id="collapsAsientos" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
					
					<div class="card-body">
						{{-- inicio del row --}}

						<div class="form-group row " >
							
							
							<div class="col-md-12">
								<center>
									
								</center>
								<table width="100%;">
									<tr>
										<td align="center" colspan="3"><b>CONDUCTOR	</b></td>
									</tr>
									<tr>
										<td align="center" width="15%">OK</td>
										<td align="center" width="15%">Rep.</td>
										<td align="center" width="70%">Listado</td>
										
									</tr>
									<tr>
										<td align="center"><input type="radio"  class="form-control" id="asiento_conductor" name="asiento_conductor" value="ok" ></td>
										<td align="center"><input type="radio"  class="form-control" id="asiento_conductor" name="asiento_conductor" value="cambio"></td>
										<td align="rigth">
											<div class="form-check">
												@foreach($fallas as $falla)
												@if($falla->id_subseccion == 25)
												<label class="form-check-label">
													<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
													<span class="form-check-sign">{{$falla->falla}}</span>
												</label>
												@endif
												@endforeach
												
												
											</div>
											<input type="text" class="form-control" placeholder="Observaciones" id="asiento_conductor_o" name="asiento_conductor_o">
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><hr></td>
										
									</tr>
									<tr>
										<td align="center" colspan="3"><b>CARRO 1		</b></td>
									</tr>
									<tr>
										<td align="center" width="15%">OK</td>
										<td align="center" width="15%">Rep.</td>
										<td align="center" width="70%">Listado</td>
										
									</tr>
									<tr>
										<td align="center"><input type="radio"  class="form-control" id="asiento_carro1" name="asiento_carro1" value="ok" ></td>
										<td align="center"><input type="radio"  class="form-control" id="asiento_carro1" name="asiento_carro1" value="cambio"></td>
										<td align="rigth">
											<div class="form-check">
												@foreach($fallas as $falla)
												@if($falla->id_subseccion == 26)
												<label class="form-check-label">
													<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
													<span class="form-check-sign">{{$falla->falla}}</span>
												</label>
												@endif
												@endforeach
												
												
											</div>
											<input type="text" class="form-control" placeholder="Observaciones" id="asiento_carro1_o" name="asiento_carro1_o">
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><hr></td>
										
									</tr>
									<tr>
										<td align="center" colspan="3"><b>CARRO 2		</b></td>
									</tr>
									<tr>
										<td align="center" width="15%">OK</td>
										<td align="center" width="15%">Rep.</td>
										<td align="center" width="70%">Listado</td>
										
									</tr>
									<tr>
										<td align="center"><input type="radio"  class="form-control" id="asiento_carro2" name="asiento_carro2" value="ok" ></td>
										<td align="center"><input type="radio"  class="form-control" id="asiento_carro2" name="asiento_carro2" value="cambio"></td>
										<td align="rigth">
											<div class="form-check">
												@foreach($fallas as $falla)
												@if($falla->id_subseccion == 27)
												<label class="form-check-label">
													<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
													<span class="form-check-sign">{{$falla->falla}}</span>
												</label>
												@endif
												@endforeach
												
												
											</div>
											<input type="text" class="form-control" placeholder="Observaciones" id="asiento_carro2_o" name="asiento_carro2_o">
										</td>
									</tr>
									
									
									
									
								</table>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-md-6">
			
			<div class="card"> <div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsDisplay" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>CÓDIGO EN DISPLAY</h5>
					</center>
				</div>
			</div>
			<div id="collapsDisplay" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr width="100%;">
									<td  width="100%;">
										<label>CÓDIGO EN DISPLAY <span class="-label"></span></label>
										<input type="text" class="form-control input-with-border" id="codigo_display" name="codigo_display">  
									</td>
									
								</tr>
								<tr width="100%;">
									<td  width="100%;">
										<label>OBSERVACIONES <span class="-label"></span></label>
										<input type="text" class="form-control input-with-border" id="codigo_display_o" name="codigo_display_o">  
									</td>
									
								</tr>
								
								
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsArticulacion" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>ARTICULACION</h5>
					</center>
				</div>
			</div>
			<div id="collapsArticulacion" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>ARTICULACION	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="articulacion" name="articulacion" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="articulacion" name="articulacion" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 29)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="articulacion_o" name="articulacion_o">
									</td>
								</tr>
								<tr>
									<td align="center" colspan="3"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>SOPORTE	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="articulacion_soporte" name="articulacion_soporte" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="articulacion_soporte" name="articulacion_soporte" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 30)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										
										<input type="text" class="form-control" placeholder="Observaciones" id="articulacion_soporte_o" name="articulacion_soporte_o">
									</td>
								</tr>
								<tr>
									<td align="center" colspan="3"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>GRANADAS	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="articulacion_granada" name="articulacion_granada" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="articulacion_granada" name="articulacion_granada" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 31)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="articulacion_granada_o" name="articulacion_granada_o">
									</td>
								</tr>
								<tr>
									<td align="center" colspan="3"><hr></td>
								</tr>
								
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsCalibracionNeu" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>CALIBRACION DE NEUMATICOS</h5>
					</center>
				</div>
			</div>
			<div id="collapsCalibracionNeu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>GRANADAS	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="calibracion_neum_granada" name="calibracion_neum_granada" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="calibracion_neum_granada" name="calibracion_neum_granada" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 32)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="calibracion_neum_granada_o" name="calibracion_neum_granada_o">
									</td>
								</tr>
								
								
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsEjeDireccional" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>EJE DIRECCIONAL </h5>
					</center>
				</div>
			</div>
			<div id="collapsEjeDireccional" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="eje_dir_izq" name="eje_dir_izq" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="eje_dir_izq" name="eje_dir_izq" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 33)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="eje_dir_izq_o" name="eje_dir_izq_o">
									</td>
								</tr>
								<tr>
									<td align="center" width="15%"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>LADO DERECHO</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="eje_dir_der" name="eje_dir_der" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="eje_dir_der" name="eje_dir_der" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 34)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="eje_dir_der_o" name="eje_dir_der_o">
									</td>
								</tr>
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsEjeIntermedio" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>EJE INTERMEDIO </h5>
					</center>
				</div>
			</div>
			<div id="collapsEjeIntermedio" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="eje_inter_izq" name="eje_inter_izq" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="eje_inter_izq" name="eje_inter_izq" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 35)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="eje_inter_izq_o" name="eje_inter_izq_o">
									</td>
								</tr>
								<tr>
									<td align="center" width="15%"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>LADO DERECHO</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="eje_inter_der" name="eje_inter_der" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="eje_inter_der" name="eje_inter_der" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 36)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="eje_inter_der_o" name="eje_inter_der_o">
									</td>
								</tr>
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>  
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsEjeMotriz" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>EJE MOTRIZ </h5>
					</center>
				</div>
			</div>
			<div id="collapsEjeMotriz" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>LADO IZQUIERDO</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="eje_motr_izq" name="eje_motr_izq" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="eje_motr_izq" name="eje_motr_izq" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 37)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="eje_motr_izq_o" name="eje_motr_izq_o">
									</td>
								</tr>
								<tr>
									<td align="center" width="15%"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>LADO DERECHO</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="eje_motr_der" name="eje_motr_der" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="eje_motr_der" name="eje_motr_der" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 38)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="eje_motr_der_o" name="eje_motr_der_o">
									</td>
								</tr>
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapssuspencion" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>SUSPENCION</h5>
					</center>
				</div>
			</div>
			<div id="collapssuspencion" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>EJE 1</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="susp_eje1" name="susp_eje1" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="susp_eje1" name="susp_eje1" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 39)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="susp_eje1_o" name="susp_eje1_o">
									</td>
								</tr>
								
								<tr>
									<td align="center" colspan="4"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>EJE 2</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="susp_eje2" name="susp_eje2" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="susp_eje2" name="susp_eje2" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 40)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="susp_eje2_o" name="susp_eje2_o">
									</td>
								</tr>
								
								<tr>
									<td align="center" colspan="4"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>EJE 3</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="susp_eje3" name="susp_eje3" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="susp_eje3" name="susp_eje3" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 41)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="susp_eje3_o" name="susp_eje3_o">
									</td>
								</tr>
								
								<tr>
									<td align="center" colspan="4"><hr></td>
								</tr>
								
								
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsTanque" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>TANQUE</h5>
					</center>
				</div>
			</div>
			<div id="collapsTanque" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>DRENADO	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="tan_drenado" name="tan_drenado" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="tan_drenado" name="tan_drenado" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 42)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="tan_drenado_o" name="tan_drenado_o">
									</td>
								</tr>
								<tr>
									<td align="center" colspan="4"><hr></td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>CHICOTES	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="tan_chicotes" name="tan_chicotes" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="tan_chicotes" name="tan_chicotes" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
												@if($falla->id_subseccion == 46)
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
														<span class="form-check-sign">{{$falla->falla}}</span>
													</label>
												@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="tan_chicotes_o" name="tan_chicotes_o">
									</td>
								</tr>
								
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" id="headingOne" style="cursor: pointer;" data-toggle="collapse" data-target="#collapsSoportes" aria-expanded="true" aria-controls="collapseOne" role="button">
				
				<div class="span-title">
					<center>
						<h5>SOPORTES</h5>
					</center>
				</div>
			</div>
			<div id="collapsSoportes" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				
				<div class="card-body">
					{{-- inicio del row --}}

					<div class="form-group row " >
						
						
						<div class="col-md-12">
							<center>
								
							</center>
							<table width="100%;">
								<tr>
									<td align="center" colspan="3"><b>MOTOR	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="soport_motor" name="soport_motor" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="soport_motor" name="soport_motor" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 43)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="soport_motor_o" name="soport_motor_o">
									</td>
								</tr>
								<tr>
									<td align="center" colspan="3"><b>TRANSMISION	</b></td>
								</tr>
								<tr>
									<td align="center" width="15%">OK</td>
									<td align="center" width="15%">Rep.</td>
									<td align="center" width="70%">Listado</td>
									
								</tr>
								<tr>
									<td align="center"><input type="radio"  class="form-control" id="soport_transmi" name="soport_transmi" value="ok" ></td>
									<td align="center"><input type="radio"  class="form-control" id="soport_transmi" name="soport_transmi" value="cambio"></td>
									<td align="rigth">
										<div class="form-check">
											@foreach($fallas as $falla)
											@if($falla->id_subseccion == 44)
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" id="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" name="{{$falla->id_fallas_subseccion_liberacion_unidades}}_{{$falla->falla}}" value="">
												<span class="form-check-sign">{{$falla->falla}}</span>
											</label>
											@endif
											@endforeach
											
											
										</div>
										<input type="text" class="form-control" placeholder="Observaciones" id="soport_transmi_o" name="soport_transmi_o">
									</td>
								</tr>
								
								
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>


</div>













<br>

</div>
<div class="card-footer">{{-- inicio del row --}}
	<div class="row">
		<div class="col-md-12">
			<center>
				<input  type="submit" class="btn btn-success" value="Validar" onclick="ValidarInofrmacion()">
			</center>
		</div>
	</div>
	{{-- fin del row --}}
</div>


</form>
</div>


</div>
</div>


@section('jscustom')
<script type="text/javascript">
	@if (session('mensaje'))
$('#modalWhatsApp').modal('show');
	@endif
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
	
	$('#n_economico').change(cambioEARTBUS);
	$(document).ready(function() {
		$('#km').on('input', function () {
			var inputValue = $(this).val().replace(/,/g, ''); 
			var intValue = parseInt(inputValue); 
			if (!isNaN(intValue)) {
				var formattedValue = intValue.toLocaleString();
				$(this).val(formattedValue);
			}
		});
		setTimeout(function() {
			cambioEARTBUS();
		}, 1000);
	});

	function cambioEARTBUS(){
		var economico=$('#n_economico').val();
		
		consultakm();
		if (economico == 89 || economico == 90 || economico == 91|| economico == 92|| economico == 93|| economico == 94|| economico == 95|| economico == 96|| economico == 97) {
			
			$('#ocultarhidro').hide();
			$('#balatas_eje_intermedio').hide();
			$('#neumaticos_eje_intermedio').hide();
			$('#aire_eje_intermedio').hide();
			$('#asi_carro_2').hide();
			$('#pasa_carro_2').hide();
			$('#articu').hide();
			$('#eje2').hide();
			$('#eje_int').hide();
			
		}else{
			$('#ocultarhidro').show();
			$('#balatas_eje_intermedio').show();
			$('#neumaticos_eje_intermedio').show();
			$('#aire_eje_intermedio').show();
			$('#asi_carro_2').show();
			$('#pasa_carro_2').show();
			$('#articu').show();
			$('#eje2').show();
			$('#eje_int').show();
		}

	}
	function consultakm()
	{
		var economico=$('#n_economico').val();
		$.ajax({
			url: '{{url("/Bitacora_De_Liberacion_De_Unidades/km")}}',
                method: 'get', // o 'GET' según corresponda
                data: {'economico': economico},
                success: function(response){
                	
                	if(response.length){
                		var kmEntradaFloat = parseFloat(response[0]['KmEntrada'].replace(/,/g, ''));

                		var kmEntradaInt = parseInt(kmEntradaFloat);

                		var formattedKmEntrada = kmEntradaInt.toLocaleString();

                		$('#km').val(formattedKmEntrada);
						$('#km').on('blur', function() {
							var inputValue = $('#km').val();
							var inputValues = parseFloat(inputValue.replace(/,/g, ''));
							console.log(inputValues);
							var minAllowedValue = kmEntradaFloat;
{{--
							if (parseInt(inputValues) < minAllowedValue) {
								$(this).val(formattedKmEntrada);
								alert('El valor mínimo permitido es '+kmEntradaFloat+'.');
							}
							--}}
						});
                	}
                	else
                	{
                		$('#km').val('');
                	}
                	
                },
                error: function(xhr, status, error){
                    console.error(error); // Manejar errores
                    $('#km').val('0');
                }
            });
	}
</script>
@endsection
</x-app-layout>
