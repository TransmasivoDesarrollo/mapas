<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Bitácora liberación de unidades mantenimiento eléctrico</div>
					
				</div>
				
				
				<div class="card-body">
                @if (session('mensaje'))
                    
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        
                        {{ session('mensaje') }}.
                        
                    </div>
                @endif

                <form method="post" id="exampleValidation" action="{{url('/Bitacora_Liberacion_De_Unidades_electrico')}}">
					@csrf
					{{-- inicio del row --}}

					<div class="form-group row " >
                        
                        <div class="col-md-2">
                            <label>Numero de economico</label>
                            <select   type="text" class="form-control  input-with-border" id="n_economico" name="n_economico">
                                <option value="">-Todos-</option>
                                @foreach($unidades as $unidad)
                                    @if(session('n_economico')== $unidad->consecutivo)
                                        <option value="{{$unidad->consecutivo}}" selected="">{{$unidad->consecutivo}}</option>
                                    @else
                                        <option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{--
                        <div class="col-md-4">
                            <label>Nombre del  mecanico</label>
                            <input  type="text" class="form-control input-with-border" value="{{session('n_mecanico')}}" id="n_mecanico" name="n_mecanico">
                        </div>
                        --}}
                        <div class="col-md-4">
                            <label>Nombre del  mecanico</label>
                            <select   class="form-control input-with-border"  id="n_mecanico" name="n_mecanico">
                                <option value='-Selecciona-' >-Selecciona-</option>
                                @foreach($mecanicos as $mecanico)
                                    @if(session('n_mecanico')== $mecanico->nombre)
                                    <option selected="">{{$mecanico->nombre}}</option>
                                    @else
                                    <option>{{$mecanico->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label>Nombre del supervisor </label>
                            <select   class="form-control input-with-border"  id="nom_supervisor" name="nom_supervisor">
                                <option value='-Selecciona-' >-Selecciona-</option>
                                @foreach($mecanicos as $mecanico)
                                <option>{{$mecanico->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Del </label>
                            <input  type="date" class="form-control input-with-border" id="del" name="del" value="{{session('del')}}">
                        </div>
                        
					</div>
						{{-- fin del row --}}
						{{-- inicio del row --}}

					<div class="form-group row " >
                    <div class="col-md-2">
                            <label>Al </label>
                            <input  type="date" class="form-control input-with-border" id="al" name="al" value="{{session('al')}}">
                        </div>
						<div class="col-md-2">
							<label>Agregar kilometraje</label>
							<input  type="number" class="form-control input-with-border"  value="{{session('km')}}" id="km" name="km"  >
						</div>
						

					</div>
                    <div class="row">
								<div class="col-md-12">
									<center>
										<input  type="submit" class="btn btn-success" value="Consultar" >
									</center>
								</div>
                                @if(session('consulta2') !== null)
                                    @php
                                    $consulta2 = json_decode(session('consulta2'), true); // Decodificar el JSON almacenado en la sesión
                                    $consulta_fallas2 = json_decode(session('consulta_fallas2'), true); // Decodificar el JSON almacenado en la sesión
                                    
                                    @endphp

                                    @if( count($consulta2) != 0)
                                        <div class="col-md-12 text-right">
                                            <br>
                                            <input type="hidden" id="consulta" name="consulta" value="{{ json_encode($consulta2) }}"> <!-- Corregir el valor del atributo value -->
                                            <input type="hidden" id="consulta_fallas" name="consulta_fallas" value="{{ json_encode($consulta_fallas2) }}"> <!-- Corregir el valor del atributo value -->
                                            <button type="submit" align="right" class="btn btn-success" id="Exportar_excel" name="Exportar_excel" >
                                                <i class="la la-file-excel-o"></i> Exportar excel
                                            </button>
                                             <button type="submit" align="right" class="btn btn-danger" style="color:#ffffff;" id="Exportar_pdf" name="Exportar_pdf" >
                                                <i class="la la-file-excel-o"></i> Exportar PDF
                                            </button>
                                        </div>
                                    @endif
                                @endif

                               
							</div>
							<br>
                            <div class="row">
								<div class="col-md-12">
                                    <div class="table-responsive" >
                                    <table class="table table-bordered  " id="list_user">
                                        <thead>
                                            <tr>
                                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>ID bitacora</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>n_economico</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>nom_mecanico</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>nom_supervisor</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>km</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>aceite_motor</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>aceite_motor_lt</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>aceite_motor_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>refrigerante</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>refrigerante_lt</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>refrigerante_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>aceite_hidra</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>aceite_hidra_lt</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>aceite_hidra_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>hidroventilador</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>hidroventilador_lt</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>hidroven_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>servicio</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>servicio_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>servicio_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>emergencia</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>emergencia_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>emergencia_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_dir_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_dir_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_dir_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_dir_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_dir_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_dir_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_int_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_int_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_int_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_int_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_int_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_int_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_motr_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_motr_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>neu_eje_motr_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_motr_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_motr_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>neu_eje_motr_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_dir_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_dir_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_dir_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_dir_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_dir_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_dir_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_int_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_int_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_int_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_int_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_int_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_int_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_motr_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_motr_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bal_eje_motr_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_motr_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_motr_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bal_eje_motr_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_dir_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_dir_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_dir_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_dir_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_dir_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_dir_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_int_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_int_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_int_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_int_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_int_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_int_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_motr_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_motr_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>bols_air_eje_motr_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_motr_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_motr_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bols_air_eje_motr_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>asiento_conductor</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>asiento_conductor_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>asiento_conductor_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>asiento_carro1</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>asiento_carro1_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>asiento_carro1_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>asiento_carro2</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>asiento_carro2_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>asiento_carro2_o</center></th>
                                                
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>codigo_display</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>codigo_display_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>articulacion</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>articulacion_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>articulacion_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>articulacion_soporte</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>articulacion_soporte_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>articulacion_soporte_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>articulacion_granada</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>articulacion_granada_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>articulacion_granada_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>calibracion_neum_granada</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>calibracion_neum_granada_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>calibracion_neum_granada_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_dir_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_dir_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_dir_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_dir_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_dir_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_dir_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_inter_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_inter_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_inter_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_inter_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_inter_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_inter_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_motr_izq</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_motr_izq_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>eje_motr_izq_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_motr_der</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_motr_der_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>eje_motr_der_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>susp_eje1</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>susp_eje1_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>susp_eje1_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>susp_eje2</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>susp_eje2_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>susp_eje2_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>susp_eje3</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>susp_eje3_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>susp_eje3_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>tan_drenado</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>tan_drenado_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>tan_drenado_o</center></th>
                                                
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>tan_chicote</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>tan_chicote_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>tan_chicote_o</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>soport_motor</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>soport_motor_falla</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>soport_motor_o</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>soport_transmi</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>soport_transmi_falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>soport_transmi_o</center></th>
                                            </tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                        @if(null !== session('consulta'))
                                        <?php $consulta=session('consulta') ?>
                                        <?php $consulta_fallas=session('consulta_fallas') ?>
                                        @php
                                          $i=0;
                                          @endphp
                                        @foreach($consulta as $fila)
                                         
                                        <tr >
                                              <td>{{$fila->id_bitacora_liberacion_unidades}}</td>
                                              <td>{{$fila->n_economico}}</td>
                                              <td>{{$fila->n_mecanico}}</td>
                                              <td>{{$fila->nom_supervisor}}</td>
                                              <td>{{$fila->fecha_creacion}}</td>
                                              <td>{{ number_format($fila->km, 0, '.', ',') }}</td>
                                              <td><center>@if($fila->aceite_motor=='ok')Ok @elseif($fila->aceite_motor=='cambio') Cambio @else N/A @endif </center></td>
                                              <td>{{$fila->aceite_motor_lt}}</td>
                                              <td>@if($fila->aceite_motor_o== NULL) <center> S/O </center>  @else {{$fila->aceite_motor_o}} @endif </td>
                                              <td><center>@if($fila->refrigerante=='ok')Ok @elseif($fila->refrigerante=='cambio') Cambio @else N/A @endif </center></td>
                                              <td>{{$fila->refrigerante_lt}}</td>
                                              <td>@if($fila->refrigerante_o== NULL) <center> S/O </center>  @else {{$fila->refrigerante_o}} @endif </td>
                                              <td><center>@if($fila->aceite_hidra=='ok')Ok @elseif($fila->aceite_hidra=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td>{{$fila->aceite_hidra_lt}}</td>
                                              <td>@if($fila->aceite_hidra_o== NULL) <center> S/O </center>  @else {{$fila->aceite_hidra_o}} @endif </td>
                                              <td><center>@if($fila->hidroven=='ok')Ok @elseif($fila->hidroven=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td>{{$fila->hidroven_lt}}</td>
                                              <td>@if($fila->hidroven_o== NULL) <center> S/O </center>  @else {{$fila->hidroven_o}} @endif </td>
                                              <td><center>@if($fila->servicio=='ok')Ok @elseif($fila->servicio=='cambio') Cambio @else N/A @endif  </center></td>

                                              <td><center> @if($consulta_fallas[$i]->Puertas__SERVICIO==null) Sin fallas @else {{$consulta_fallas[$i]->Puertas__SERVICIO}} @endif  </center></td>

                                              <td>@if($fila->servicio_o== NULL) <center> S/O </center>  @else {{$fila->servicio_o}} @endif </td>
                                              <td><center>@if($fila->emergencia=='ok')Ok @elseif($fila->emergencia=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->Puertas__EMERGENCIA==null) Sin fallas @else {{$consulta_fallas[$i]->Puertas__EMERGENCIA}} @endif  </center></td>

                                              <td>@if($fila->emergencia_o== NULL) <center> S/O </center>  @else {{$fila->emergencia_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_dir_izq=='ok')Ok @elseif($fila->neu_eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_dir_der=='ok')Ok @elseif($fila->neu_eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_int_izq=='ok')Ok @elseif($fila->neu_eje_int_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_int_izq_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_int_izq_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_int_der=='ok')Ok @elseif($fila->neu_eje_int_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_int_der_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_int_der_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_motr_izq=='ok')Ok @elseif($fila->neu_eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_motr_der=='ok')Ok @elseif($fila->neu_eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                               <td>@if($fila->neu_eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_dir_izq=='ok')Ok @elseif($fila->bal_eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->bal_eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_dir_der=='ok')Ok @elseif($fila->bal_eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_DERECHO}} @endif  </center></td>

                                              <td>@if($fila->bal_eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_int_izq=='ok')Ok @elseif($fila->bal_eje_int_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->bal_eje_int_izq_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_int_izq_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_int_der=='ok')Ok @elseif($fila->bal_eje_int_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bal_eje_int_der_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_int_der_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_motr_izq=='ok')Ok @elseif($fila->bal_eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bal_eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_motr_der=='ok')Ok @elseif($fila->bal_eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bal_eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_dir_izq=='ok')Ok @elseif($fila->bols_air_eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_dir_der=='ok')Ok @elseif($fila->bols_air_eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_int_izq=='ok')Ok @elseif($fila->bols_air_eje_int_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_int_izq_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_int_izq_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_int_der=='ok')Ok @elseif($fila->bols_air_eje_int_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_int_der_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_int_der_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_motr_izq=='ok')Ok @elseif($fila->bols_air_eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_motr_der=='ok')Ok @elseif($fila->bols_air_eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->asiento_conductor=='ok')Ok @elseif($fila->asiento_conductor=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ASIENTOS__CONDUCTOR==null) Sin fallas @else {{$consulta_fallas[$i]->ASIENTOS__CONDUCTOR}} @endif  </center></td>

                                              
                                              <td>@if($fila->asiento_conductor_o== NULL) <center> S/O </center>  @else {{$fila->asiento_conductor_o}} @endif </td>
                                              <td><center>@if($fila->asiento_carro1=='ok')Ok @elseif($fila->asiento_carro1=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ASIENTOS__CARRO_1==null) Sin fallas @else {{$consulta_fallas[$i]->ASIENTOS__CARRO_1}} @endif  </center></td>

                                              
                                              <td>@if($fila->asiento_carro1_o== NULL) <center> S/O </center>  @else {{$fila->asiento_carro1_o}} @endif </td>
                                              <td><center>@if($fila->asiento_carro2=='ok')Ok @elseif($fila->asiento_carro2=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ASIENTOS__CARRO_2==null) Sin fallas @else {{$consulta_fallas[$i]->ASIENTOS__CARRO_2}} @endif  </center></td>

                                              
                                              <td>@if($fila->asiento_carro2_o== NULL) <center> S/O </center>  @else {{$fila->asiento_carro2_o}} @endif </td>
                                             
                                              <td>{{$fila->codigo_display}}</td>
                                              
                                              <td>@if($fila->codigo_display_o== NULL) <center> S/O </center>  @else {{$fila->codigo_display_o}} @endif </td>
                                              <td><center>@if($fila->articulacion=='ok')Ok @elseif($fila->articulacion=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ARTICULACION__ARTICULACION==null) Sin fallas @else {{$consulta_fallas[$i]->ARTICULACION__ARTICULACION}} @endif  </center></td>

                                              
                                              <td>@if($fila->articulacion_o== NULL) <center> S/O </center>  @else {{$fila->articulacion_o}} @endif </td>
                                              <td><center>@if($fila->articulacion_soporte=='ok')Ok @elseif($fila->articulacion_soporte=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ARTICULACION__SOPORTE==null) Sin fallas @else {{$consulta_fallas[$i]->ARTICULACION__SOPORTE}} @endif  </center></td>

                                              
                                              <td>@if($fila->articulacion_soporte_o== NULL) <center> S/O </center>  @else {{$fila->articulacion_soporte_o}} @endif </td>
                                              <td><center>@if($fila->articulacion_granada=='ok')Ok @elseif($fila->articulacion_granada=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ARTICULACION__GRANADAS==null) Sin fallas @else {{$consulta_fallas[$i]->ARTICULACION__GRANADAS}} @endif  </center></td>

                                              
                                              <td>@if($fila->articulacion_granada_o== NULL) <center> S/O </center>  @else {{$fila->articulacion_granada_o}} @endif </td>
                                              <td><center>@if($fila->calibracion_neum_granada=='ok')Ok @elseif($fila->calibracion_neum_granada=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->CALIBRACION_DE_NEUMATICOS__GRANADAS==null) Sin fallas @else {{$consulta_fallas[$i]->CALIBRACION_DE_NEUMATICOS__GRANADAS}} @endif  </center></td>

                                              
                                              <td>@if($fila->calibracion_neum_granada_o== NULL) <center> S/O </center>  @else {{$fila->calibracion_neum_granada_o}} @endif </td>
                                              <td><center>@if($fila->eje_dir_izq=='ok')Ok @elseif($fila->eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->eje_dir_der=='ok')Ok @elseif($fila->eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->eje_inter_izq=='ok')Ok @elseif($fila->eje_inter_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_INTERMEDIO__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_INTERMEDIO__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_inter_izq_o== NULL) <center> S/O </center>  @else {{$fila->eje_inter_izq_o}} @endif </td>
                                              <td><center>@if($fila->eje_inter_der=='ok')Ok @elseif($fila->eje_inter_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_INTERMEDIO__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_INTERMEDIO__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_inter_der_o== NULL) <center> S/O </center>  @else {{$fila->eje_inter_der_o}} @endif </td>
                                              <td><center>@if($fila->eje_motr_izq=='ok')Ok @elseif($fila->eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->eje_motr_der=='ok')Ok @elseif($fila->eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->susp_eje1=='ok')Ok @elseif($fila->susp_eje1=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SUSPENCION__EJE_1==null) Sin fallas @else {{$consulta_fallas[$i]->SUSPENCION__EJE_1}} @endif  </center></td>

                                              
                                              <td>@if($fila->susp_eje1_o== NULL) <center> S/O </center>  @else {{$fila->susp_eje1_o}} @endif </td>
                                              <td><center>@if($fila->susp_eje2=='ok')Ok @elseif($fila->susp_eje2=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SUSPENCION__EJE_2==null) Sin fallas @else {{$consulta_fallas[$i]->SUSPENCION__EJE_2}} @endif  </center></td>

                                              
                                              <td>@if($fila->susp_eje2_o== NULL) <center> S/O </center>  @else {{$fila->susp_eje2_o}} @endif </td>
                                              <td><center>@if($fila->susp_eje3=='ok')Ok @elseif($fila->susp_eje3=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SUSPENCION__EJE_3==null) Sin fallas @else {{$consulta_fallas[$i]->SUSPENCION__EJE_3}} @endif  </center></td>

                                              
                                              <td>@if($fila->susp_eje3_o== NULL) <center> S/O </center>  @else {{$fila->susp_eje3_o}} @endif </td>
                                              <td><center>@if($fila->tan_drenado=='ok')Ok @elseif($fila->tan_drenado=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->TANQUE__DRENADO==null) Sin fallas @else {{$consulta_fallas[$i]->TANQUE__DRENADO}} @endif  </center></td>

                                              
                                              <td>@if($fila->tan_drenado_o== NULL) <center> S/O </center>  @else {{$fila->tan_drenado_o}} @endif </td>
                                              <td><center>@if($fila->tan_chicote=='ok')Ok @elseif($fila->tan_chicote=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->TANQUE__CHICOTES==null) Sin fallas @else {{$consulta_fallas[$i]->TANQUE__CHICOTES}} @endif  </center></td>

                                              
                                              <td>@if($fila->tan_chicote_o== NULL) <center> S/O </center>  @else {{$fila->tan_chicote_o}} @endif </td>
                                              <td><center>@if($fila->soport_motor=='ok')Ok @elseif($fila->soport_motor=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SOPORTES__MOTOR==null) Sin fallas @else {{$consulta_fallas[$i]->SOPORTES__MOTOR}} @endif  </center></td>

                                              
                                              <td>@if($fila->soport_motor_o== NULL) <center> S/O </center>  @else {{$fila->soport_motor_o}} @endif </td>
                                              <td><center>@if($fila->soport_transmi=='ok')Ok @elseif($fila->soport_transmi=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SOPORTES__TRANSMISION==null) Sin fallas @else {{$consulta_fallas[$i]->SOPORTES__TRANSMISION}} @endif  </center></td>

                                              
                                              <td>@if($fila->soport_transmi_o== NULL) <center> S/O </center>  @else {{$fila->soport_transmi_o}} @endif </td>
                                          </tr>
                                          @php
                                          $i=$i+1;
                                          @endphp
                                      @endforeach
                                        @endif
                                    </tbody>

                                    </table>

                                    </div>
								</div>
							</div>
							
						</div>
						<div class="card-footer">{{-- inicio del row --}}
							
							{{-- fin del row --}}
						</div>

						
                        </form>
					</div>
					

        </div>
    </div>

	
@section('jscustom')
<script type="text/javascript">
	
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
	
	
</script>
@endsection
</x-app-layout>
