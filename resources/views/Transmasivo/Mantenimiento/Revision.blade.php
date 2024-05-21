<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Bitacora De Liberacion De Unidades </div>
					
				</div>
				
				
				<div class="card-body">
                @if (session('mensaje'))
                    
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        
                        {{ session('mensaje') }}.
                        
                    </div>
                @endif

                <form method="post" id="exampleValidation" action="{{url('/Bitacora_De_Liberacion_De_Unidades')}}">
					@csrf
					{{-- inicio del row --}}

					<div class="form-group row " >
                    {{-- <div class="col-md-2">
                            <label>Numero de economico <span class="required-label">*</span></label>
                            <input  required type="text" class="form-control  input-with-border" style="width:100%; height:100%; border:black 1px solid;" id="n_economico" name="n_economico">
                        </div>--}}
                        <div class="col-md-2">
                            <label>Numero de economico <span class="required-label">*</span></label>
                            <select  required type="text" class="form-control  input-with-border" id="n_economico" name="n_economico">
                                @foreach($unidades as $unidad)
                                <option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Nombre del mecanico<span class="required-label">*</span></label>
                            <input required type="text" class="form-control input-with-border" id="n_mecanico" name="n_mecanico">
                        </div>
                        <div class="col-md-4">
                            <label>Nombre del supervisor <span class="required-label">*</span></label>
                            <input required type="text" class="form-control input-with-border" id="nom_supervisor" name="nom_supervisor">
                        </div>
                        <div class="col-md-2">
                            <label>Fecha <span class="required-label">*</span></label>
                            <input required type="date" class="form-control input-with-border" id="Fecha" name="Fecha" value="{{ now()->format('Y-m-d') }}">
                        </div>
					</div>
						{{-- fin del row --}}
						{{-- inicio del row --}}

					<div class="form-group row " >
						<div class="col-md-2">
							<label>Agregar kilometraje<span class="required-label">*</span></label>
							<input required type="text" class="form-control input-with-border"  id="km" name="km"  >
						</div>
						<div class="col-md-2">
							<label>Carga de bares<span class="required-label">*</span></label>
							<input  required type="number" class="form-control input-with-border" id="bares" name="bares"  >
						</div>

					</div>
                    {{-- inicio del row --}}

					<div class="form-group row " >
						<div class="col-md-12">
                            
						</div>
					
                        <div class="col-md-4">
                        <center>
                                <h5>NIVELES Y FUGAS</h5>
                            </center>
                            <table width="100%;">
                                <tr>
                                    <td align="center" colspan="4">ACEITE DE MOTOR</td>
                                </tr>
                                <tr>
                                    <td align="center">OK</td>
                                    <td align="center">Rep.</td>
                                    <td align="center">Catal.</td>
                                    <td>Observ.</td>
                                </tr>
                                <tr>
                                    <td align="center"><input type="radio" class="form-control" id="aceite_motor" name="aceite_motor" value="ok" ></td>
                                    <td align="center"><input type="radio" class="form-control" id="aceite_motor" name="aceite_motor" value="rep"></td>
                                    <td align="center"><input type="checkbox" class="form-control" id="aceite_motor" name="aceite_motor" value="ok"></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="aceite_motor_o" name="aceite_motor_o"></td>
                                </tr>
                                <table width="100%;">
                                    <br>
                                </table>
                                <tr>
                                    <td align="right">REFRIGERANTE </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="refrigerante" name="refrigerante" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="refrigerante_o" name="refrigerante_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">ACEITE HIDRAULICO </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="aceite_hidra" name="aceite_hidra" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="aceite_hidra_o" name="aceite_hidra_o"></td>
                                </tr>
                                <tr id="ocultarhidro">
                                    <td align="right">HIDROVENTILADOR </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="hidroven" name="hidroven" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="hidroven_o" name="hidroven_o"></td>
                                </tr>
                                
                            </table>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <h5>PUERTAS</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">SERVICIO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="servicio" name="servicio" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="servicio_o" name="servicio_o"></td>
                            </tr>
                            <tr>
                                <td align="right">EMERGENCIA  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="emergencia" name="emergencia" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="emergencia_o" name="emergencia_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
                        </div>
                        <div class="col-md-4">
                        <center>
                                <h5>NEUMATICOS - EJE DIRECCIONAL</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">LADO IZQUIERDO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="neu_eje_dir_izq" name="neu_eje_dir_izq" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_dir_izq_o" name="neu_eje_dir_izq_o"></td>
                            </tr>
                            <tr>
                                <td align="right">LADO DERECHO  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="neu_eje_dir_der" name="neu_eje_dir_der" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_dir_der_o" name="neu_eje_dir_der_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
                        </div>
                    </div>
                    <div class="form-group row " >
						<div class="col-md-4" id="neumaticos_eje_intermedio">
                            <center>
                                <h5>NEUMATICOS - EJE INTERMEDIO</h5>
                            </center>
                            <table width="100%;">
                                <tr>
                                    <td align="right">LADO IZQUIERDO </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="neu_eje_int_izq" name="neu_eje_int_izq" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_int_izq_o" name="neu_eje_int_izq_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">LADO DERECHO  </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="neu_eje_int_der" name="neu_eje_int_der" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_int_der_o" name="neu_eje_int_der_o"></td>
                                </tr>
                            
                                
                            </table>
                            <br>
						</div>
                        <div class="col-md-4">
                            <center>
                                <h5>NEUMATICOS - EJE MOTRIZ</h5>
                            </center>
                            <table width="100%;">
                                <tr>
                                    <td align="right">LADO IZQUIERDO </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="neu_eje_motr_izq" name="neu_eje_motr_izq" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_motr_izq_o" name="neu_eje_motr_izq_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">LADO DERECHO  </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="neu_eje_motr_der" name="neu_eje_motr_der" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="neu_eje_motr_der_o" name="neu_eje_motr_der_o"></td>
                                </tr>
                            
                                
                            </table>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <h5>BALATAS  - EJE DIRECCIONAL</h5>
                            </center>
                            <table width="100%;">
                                <tr>
                                    <td align="right">LADO IZQUIERDO </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="bal_eje_dir_izq" name="bal_eje_dir_izq" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_dir_izq_o" name="bal_eje_dir_izq_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">LADO DERECHO  </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="bal_eje_dir_der" name="bal_eje_dir_der" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_dir_der_o" name="bal_eje_dir_der_o"></td>
                                </tr>
                            
                                
                            </table>
                            <br>
                        </div>
                    </div>
                    
                   
                    <div class="form-group row " >
						<div class="col-md-4" id="balatas_eje_intermedio">
                            <center>
                                <h5>BALATAS  - EJE INTERMEDIO</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">LADO IZQUIERDO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bal_eje_int_izq" name="bal_eje_int_izq" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_int_izq_o" name="bal_eje_int_izq_o"></td>
                            </tr>
                            <tr>
                                <td align="right">LADO DERECHO  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bal_eje_int_der" name="bal_eje_int_der" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_int_der_o" name="bal_eje_int_der_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
						</div>
                        <div class="col-md-4">
                            <center>
                                <h5>BALATAS  - EJE MOTRIZ</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">LADO IZQUIERDO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bal_eje_motr_izq" name="bal_eje_motr_izq" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_motr_izq_o" name="bal_eje_motr_izq_o"></td>
                            </tr>
                            <tr>
                                <td align="right">LADO DERECHO  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bal_eje_motr_der" name="bal_eje_motr_der" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bal_eje_motr_der_o" name="bal_eje_motr_der_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <h5>BOLSA DE AIRE - EJE DIRECCIONAL</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">LADO IZQUIERDO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bols_air_eje_dir_izq" name="bols_air_eje_dir_izq" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_dir_izq_o" name="bols_air_eje_dir_izq_o"></td>
                            </tr>
                            <tr>
                                <td align="right">LADO DERECHO  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bols_air_eje_dir_der" name="bols_air_eje_dir_der" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_dir_der_o" name="bols_air_eje_dir_der_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
                        </div>
                    </div>
                    
                  
                  
                    <div class="form-group row " >
						<div class="col-md-4" id="aire_eje_intermedio">
                            <center>
                                <h5>BOLSA DE AIRE - EJE INTERMEDIO</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">LADO IZQUIERDO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bols_air_eje_int_izq" name="bols_air_eje_int_izq" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_int_izq_o" name="bols_air_eje_int_izq_o"></td>
                            </tr>
                            <tr>
                                <td align="right">LADO DERECHO  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bols_air_eje_int_der" name="bols_air_eje_int_der" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_int_der_o" name="bols_air_eje_int_der_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
						</div>
                        <div class="col-md-4">
                            <center>
                                <h5>BOLSA DE AIRE - EJE MOTRIZ</h5>
                            </center>
                            <table width="100%;">
                            <tr>
                                <td align="right">LADO IZQUIERDO </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bols_air_eje_motr_izq" name="bols_air_eje_motr_izq" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_motr_izq_o" name="bols_air_eje_motr_izq_o"></td>
                            </tr>
                            <tr>
                                <td align="right">LADO DERECHO  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="bols_air_eje_motr_der" name="bols_air_eje_motr_der" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="bols_air_eje_motr_der_o" name="bols_air_eje_motr_der_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <h5>ASIENTOS </h5>
                            </center>
                            <table width="100%;">
                                <tr>
                                    <td align="right">CONDUCTOR  </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="asiento_conductor" name="asiento_conductor" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="asiento_conductor_o" name="asiento_conductor_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">CARRO 1  </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="asiento_carro1" name="asiento_carro1" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="asiento_carro1_o" name="asiento_carro1_o"></td>
                                </tr>
                                <tr id="asi_carro_2">
                                    <td align="right">CARRO 2  </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="asiento_carro2" name="asiento_carro2" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="asiento_carro2_o" name="asiento_carro2_o"></td>
                                </tr>
                            
                                
                            </table>
                            <br>
                        </div>
                    </div>
                    
                  
                    <div class="form-group row " >
						<div class="col-md-4">
                            <center>
                                <h5>PASAMANOS  </h5>
                            </center>
                            <table width="100%;">
                           
                            <tr>
                                <td align="right">CARRO 1  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="pasamanos_carro1" name="pasamanos_carro1" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="pasamanos_carro1_o" name="pasamanos_carro1_o"></td>
                            </tr>
                            <tr id="pasa_carro_2">
                                <td align="right">CARRO 2  </td>
                                <td align="left"><input type="checkbox" class="form-control" id="pasamanos_carro2" name="pasamanos_carro2" ></td>
                                <td><input type="text" class="form-control" placeholder="Observaciones" id="pasamanos_carro2_o" name="pasamanos_carro2_o"></td>
                            </tr>
                          
                            
                        </table>
                            <br>
						</div>
                        <div class="col-md-4">
                        <table width="100%;">
                           
                           <tr width="100%;">
                               <td  width="100%;">
                                   <label>CÓDIGO EN DISPLAY <span class="required-label"></span></label>
                                   <input type="text" class="form-control input-with-border" id="codigo_display" name="codigo_display">  
                               </td>
                               
                           </tr>
                           <tr width="100%;">
                               <td  width="100%;">
                                   <label>OBSERVACIONES <span class="required-label"></span></label>
                                   <input type="text" class="form-control input-with-border" id="codigo_display_o" name="codigo_display_o">  
                               </td>
                               
                           </tr>
                         
                           
                       </table>
                            <br>
                        </div>
                        <div class="col-md-4" id="articu">
                            <center>
                                <h5>ARTICULACION   </h5>
                            </center>
                            <table width="100%;">
                           
                                <tr>
                                    <td align="right">ARTICULACION   </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="articulacion" name="articulacion" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="articulacion_o" name="articulacion_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">SOPORTE   </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="articulacion_soporte" name="articulacion_soporte" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="articulacion_soporte_o" name="articulacion_soporte_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">GRANADAS    </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="articulacion_granada" name="articulacion_granada" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="articulacion_granada_o" name="articulacion_granada_o"></td>
                                </tr>
                            
                                
                            </table>
                            <br>
                        </div>
                    </div>
                   
                   
                    
                    <div class="form-group row " >
						<div class="col-md-4">
                            <center>
                                <h5>CALIBRACION DE NEUMATICOS   </h5>
                            </center>
                            <table width="100%;">
                           
                                <tr>
                                    <td align="right">GRANADAS    </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="calibracion_neum_granada" name="calibracion_neum_granada" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="calibracion_neum_granada_o" name="calibracion_neum_granada_o"></td>
                                </tr>
                            
                            </table>
                            <br>
						</div>
                        <div class="col-md-4">
                            <center>
                                <h5>EJE DIRECCIONAL  </h5>
                            </center>
                            <table width="100%;">
                            
                                <tr>
                                    <td align="right">LADO IZQUIERDO    </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="eje_dir_izq" name="eje_dir_izq" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="eje_dir_izq_o" name="eje_dir_izq_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">LADO DERECHO     </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="eje_dir_der" name="eje_dir_der" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="eje_dir_der_o" name="eje_dir_der_o"></td>
                                </tr>
                            
                            </table>
                            <br>
                        </div>
                        <div class="col-md-4" id="eje_int">
                            <center>
                                <h5>EJE INTERMEDIO  </h5>
                            </center>
                            <table width="100%;">
                           
                                <tr>
                                    <td align="right">LADO IZQUIERDO    </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="eje_inter_izq" name="eje_inter_izq" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="eje_inter_izq_o" name="eje_inter_izq_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">LADO DERECHO     </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="eje_inter_der" name="eje_inter_der" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="eje_inter_der_o" name="eje_inter_der_o"></td>
                                </tr>
                            
                            </table>
                            <br>
                        </div>
                    </div>
                   
                    <div class="form-group row " >
						<div class="col-md-4">
                            <center>
                                <h5>EJE MOTRIZ  </h5>
                            </center>
                            <table width="100%;">
                                
                                <tr>
                                    <td align="right">LADO IZQUIERDO    </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="eje_motr_izq" name="eje_motr_izq" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="eje_motr_izq_o" name="eje_motr_izq_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">LADO DERECHO     </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="eje_motr_der" name="eje_motr_der" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="eje_motr_der_o" name="eje_motr_der_o"></td>
                                </tr>
                                
                            </table>
                            <br>
						</div>
                        <div class="col-md-4">
                            <center>
                                <h5>SUSPENCION   </h5>
                            </center>
                            <table width="100%;">
                           
                                <tr>
                                    <td align="right">EJE 1   </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="susp_eje1" name="susp_eje1" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="susp_eje1_o" name="susp_eje1_o"></td>
                                </tr>
                                <tr id="eje2">
                                    <td align="right">EJE 2     </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="susp_eje2" name="susp_eje2" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="susp_eje2_o" name="susp_eje2_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">EJE 3     </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="susp_eje3" name="susp_eje3" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="susp_eje3_o" name="susp_eje3_o"></td>
                                </tr>
                            
                            </table>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <h5>TANQUE    </h5>
                            </center>
                            <table width="100%;">
                            
                                <tr>
                                    <td align="right">DRENADO    </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="tan_drenado" name="tan_drenado" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="tan_drenado_o" name="tan_drenado_o"></td>
                                </tr>
                                
                            
                            </table>
                            <br>
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group row " >
						<div class="col-md-4">
                            <center>
                                <h5>SOPORTES    </h5>
                            </center>
                                <table width="100%;">
                            
                                
                                <tr>
                                    <td align="right">MOTOR     </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="soport_motor" name="soport_motor" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="soport_motor_o" name="soport_motor_o"></td>
                                </tr>
                                <tr>
                                    <td align="right">TRANSMISION      </td>
                                    <td align="left"><input type="checkbox" class="form-control" id="soport_transmi" name="soport_transmi" ></td>
                                    <td><input type="text" class="form-control" placeholder="Observaciones" id="soport_transmi_o" name="soport_transmi_o"></td>
                                </tr>
                                
                            
                            </table>
                            <br>
						</div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                        </div>
                        <div class="col-md-4">
                        
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
        
    $('#n_economico').select2();
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
