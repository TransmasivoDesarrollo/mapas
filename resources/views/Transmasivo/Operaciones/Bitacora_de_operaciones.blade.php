<x-app-layout>
        <style>
            .input-with-border {
        border: 1px solid black;
    }

        </style>
            <div class="card">
            <div class="card-header">
                <div class="card-title" style="display: inline-block;">Alta bitacora de operaciones</div>
                <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
            </div>

                    
                    
                    <div class="card-body">
                    @if (session('mensaje'))
                        
                        <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                            
                            {{ session('mensaje') }}.
                            
                        </div>
                    @endif

                    <form method="post" id="exampleValidation" action="{{url('/Bitacora_de_operaciones')}}">
                        @csrf
                        {{-- inicio del row --}}

                            <div class="form-group row " >
                                
                                <div class="col-md-3">
                                    <label>Credencial <span class="required-label">*</span></label>
                                    <select required type="text" style="width:90%;" class="form-control input-with-border" id="credencial" name="credencial">
                                        @foreach($credencial as $cred)
                                            <option value="{{$cred->id}}">{{$cred->id}} - {{$cred->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <label>Día <span class="required-label">*</span></label>
                                    <input required type="date" class="form-control input-with-border" id="dia" name="dia" value="{{now()->format('Y-m-d')}}">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;<br><br><br></label>
                                    <button class="btn btn-primary btn-sm" id="buscar" class="buscar"><i class="la flaticon-search-2"></i></button>
                                </div>
                                <div class="col-md-3">
                                        <label>Terminal</label>
                                        <select required class="form-control input-with-border" id="terminal" name="terminal">
                                            @foreach($terminal as $term)
                                            <option value="{{$term->id_terminal}}">{{$term->terminal}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Servicio<span class="required-label">*</span></label>
                                    <select required class="form-control input-with-border" id="serv" name="serv">
                                        <option value="TR1">TR1 - Ordinario Ojo de agua - Ciudad azteca</option>
                                        <option value="TR1-R">TR1-R - Ordinario Ojo de agua - Ciudad azteca</option>
                                        <option value="TR3">TR3 - Express Ojo de agua - Ciudad azteca</option>
                                        <option value="TR4">TR4 - Express Central de abastos - Ciudad azteca</option>
                                    </select>
                                </div>

                               
                                
                                
                                
                            </div>
                            <div class="form-group row " >
                                
                                <div class="col-md-2">
                                    <label>Economico <span class="required-label">*</span></label>
                                    <input required type="text" class="form-control input-with-border" id="eco" name="eco">
                                </div>
                                <div class="col-md-2">
                                        <label>Hora de llegada  <span class="required-label">*</span></label>
                                        <input required type="time" class="form-control input-with-border" id="hora_llegada" name="hora_llegada">
                                </div>
                                <div class="col-md-2">
                                    <label>Hora de salida <span class="required-label">*</span></label>
                                    <input required type="time" class="form-control input-with-border" id="hora_salida" name="hora_salida">
                                </div> 
                               
                               
                                <div class="col-md-4">
                                    <label>Comentario  <span class="required-label"></span></label>
                                    <textarea  type="text" class="form-control input-with-border" id="comentarios" name="comentarios"></textarea>
                                </div>
                            </div>
                            <div class="form-group row " >
                                <div class="col-md-12">
                                    <div class="demo">
                                        <div class="progress-card">
                                            <div class="progress-status">
                                                <span class="text-muted" id="progreso">Sin informacion</span>
                                                <span id="ciclos_span" class="text-muted fw-bold">Ciclo 0 de 0 </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" id="bar" style="width: 0%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <input  type="submit" class="btn btn-success" id="boton_registra" disabled="true" class="boton_registra" value="Registrar" >
                                        </center>
                                    </div>
                                </div>
                                
                            </div>
                            </form>
                        </div>
                        

            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="display: inline-block;">Consulta bitacora de operaciones</div>
                    <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
                </div>
                <div class="card-body">
                <form method="post" id="exampleValidation" action="{{url('/Bitacora_de_operaciones')}}">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-2">
                            <div class=" card-stats">
								<div class="card-body" style="border-right:1px black solid;">
									
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center icon-warning" style="background-color: #e5be01;">
												<i class=" la la-bus text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Ciclos TR1</p>
												<h4 class="card-title">{{$tr1_registro}}/{{$tr1_ciclos[0]->conteo}}</h4>
											</div>
										</div>
									</div>
									
								</div>
							</div>
                        </div>
                        <div class="col-md-2">
                            <div class=" card-stats">
								<div class="card-body" style="border-right:1px black solid;">
									
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center icon-warning" style="background-color: #FF0080;">
												<i class="la la-bus text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Ciclos TR1-R</p>
												<h4 class="card-title">{{$tr1_r_registro}}/{{$tr1_r_ciclos[0]->conteo}}</h4>
											</div>
										</div>
									</div>
									
								</div>
							</div>
                        </div>
                        <div class="col-md-2">
                            <div class=" card-stats">
								<div class="card-body" style="border-right:1px black solid;" >
									
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center icon-warning" style="background-color: #008f39;">
												<i class="la la-bus text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Ciclos TR3</p>
												<h4 class="card-title">{{$tr3_registro}}/{{$tr3_ciclos[0]->conteo}}</h4>
											</div>
										</div>
									</div>
									
								</div>
							</div>
                        </div>
                        <div class="col-md-2">
                            <div class=" card-stats">
								<div class="card-body" style="border-right:1px black solid;">
									
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center icon-warning" style="background-color: #0000ff;">
												<i class="la la-bus text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Ciclos TR4</p>
												<h4 class="card-title">{{$tr4_registro}}/{{$tr4_ciclos[0]->conteo}}</h4>
											</div>
										</div>
									</div>
									
								</div>
							</div>
                        </div>
                        <div class="col-md-2">
                            
                            <div class=" card-stats">
								<div class="card-body" style="border-right:1px black solid;">
									
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center icon-warning" style="background-color: rgb(135, 38, 55);">
												<i class="la la-bus text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Ciclos totales</p>
												<h4 class="card-title">{{$total_registros}}/{{$total_ciclos}}</h4>
											</div>
										</div>
									</div>
									
								</div>
							</div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-danger" value="PDF" name="pdf" id="pdf">
                            <input type="submit" class="btn btn-success" value="Excel" name="Excel" id="Excel">
                        </div>
                    </div>
                </form>
                <br>
                    <div class="table-responsive" >
                        <table class="table table-hover table-striped table-bordered display  "  id="list_user2">
                            <thead>
                                <tr>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 11%;"><center>Día</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Eco.</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Serv.</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Credencial</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 37%;"><center>Salida</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 37%;"><center>Llegada mitad de recorrido</center></th>
                                </tr>
                            </thead>
                            <tbody id="llenaTabla" >
                                @php $contador=0 @endphp
                                @php $anterior=0 @endphp
                                @php $repetido=0 @endphp
                                @php $naranja=0 @endphp
                                @if(null !== $consulta)

                                    @foreach($consulta as $fila)
                                    
                                    @php $naranja=0 @endphp
                                            @if($fila['posicion'] % 2 == 0)
                                                @if($anterior==$fila['credencial'])
                                                
                                                <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                    </div>    
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                    </div>   
                                                                    </center> 
                                                                     
                                                                </div>
                                                                <div class="col-md-3"> 
                                                                    <div class="card-body">
                                                                    <center>
                                                                        @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                        <span class="badge " style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol']}}</span>
                                                                        @else
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                        @endif
                                                                        </center>
                                                                    </div>    
                                                                </div>
                                                                <div class="col-md-3">    
                                                                    <div class="card-body">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                    </div>    
                                                                     
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <center>
                                                                    <div class="card-body" >
                                                                        @if($fila['estatus']=="Retardo")
                                                                        <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="Sobretiempo")
                                                                        <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="En tiempo")
                                                                        <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @endif
                                                                    </div>  
                                                                    </center>
                                                                </div>
                                                                @if($fila['comentario'] != null)
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            {{$fila['comentario']}}
                                                                        </div>  
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            Sin Observaciones
                                                                        </div>  
                                                                    </div>
                                                                @endif 
                                                                
                                                            </div>
                                                    </td>
                                                            
                                                    </tr>
                                                    
                                                    @php $naranja=0 @endphp
                                                    @php $repetido=1 @endphp
                                                @else
                                                
                                                    @php $repetido=0 @endphp
                                                        <td  >
                                                        <center style="font-size:18px;">
                                                                Sin registro
                                                            </center>
                                                        </td>
                                                            
                                                    </tr>
                                                
                                                @endif
                                                
                                                @php $anterior=$fila['credencial'] @endphp
                                            @else
                                            
                                                
                                                @if($anterior != $fila['credencial'])
                                                    @if($repetido==1)
                                                        <tr  >
                                                        <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                            <td><center>{{$fila['eco']}}</center></td>
                                                            @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                                <center>
                                                                    <span class="" style=" color: black; font-size:12px;">
                                                                        Cred. {{$fila['credencial']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                    </div>    
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-2">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                    </div>   
                                                                    </center> 
                                                                     
                                                                </div>
                                                                <div class="col-md-3"> 
                                                                    <div class="card-body">
                                                                    <center>
                                                                        @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                        <span class="badge" style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol']}}</span>
                                                                        @else
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                        @endif
                                                                        </center>
                                                                    </div>    
                                                                </div>
                                                                <div class="col-md-3">    
                                                                    <div class="card-body">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                    </div>    
                                                                     
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <center>
                                                                    <div class="card-body" >
                                                                        @if($fila['estatus']=="Retardo")
                                                                        <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="Sobretiempo")
                                                                        <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="En tiempo")
                                                                        <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @endif
                                                                    </div>  
                                                                    </center>
                                                                    
                                                                </div>
                                                                @if($fila['comentario'] != null)
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            {{$fila['comentario']}}
                                                                        </div>  
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            Sin Observaciones
                                                                        </div>  
                                                                    </div>
                                                                @endif  
                                                            </div>
                                                    </td>
                                                          
                                                        @php $naranja=1 @endphp
                                                    @else
                                                        @if($anterior == 0)
                                                        
                                                            
                                                        <tr >
                                                            <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                            <td><center>{{$fila['eco']}}</center></td>
                                                            @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                                <center>
                                                                    <span class="" style=" color: black; font-size:12px;">
                                                                        Cred. {{$fila['credencial']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                                <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                    </div>    
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                    </div>   
                                                                    </center> 
                                                                     
                                                                </div>
                                                                <div class="col-md-3"> 
                                                                    <div class="card-body">
                                                                    <center>
                                                                        @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                        <span class="badge " style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol']}}</span>
                                                                        @else
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                        @endif
                                                                        </center>
                                                                    </div>    
                                                                </div>
                                                                <div class="col-md-3">    
                                                                    <div class="card-body">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                    </div>    
                                                                     
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <center>
                                                                    <div class="card-body" >
                                                                        @if($fila['estatus']=="Retardo")
                                                                        <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="Sobretiempo")
                                                                        <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="En tiempo")
                                                                        <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @endif
                                                                    </div>  
                                                                    </center>
                                                                   
                                                                </div>
                                                                @if($fila['comentario'] != null)
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            {{$fila['comentario']}}
                                                                        </div>  
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            Sin Observaciones
                                                                        </div>  
                                                                    </div>
                                                                @endif 
                                                            </div>
                                                    </td>
                                                                @php $naranja=0 @endphp
                                                        @else
                                                        <td >  <center style="font-size:18px;">
                                                                Sin registro
                                                            </center></td>
                                                                    
                                                                    </tr>
                                                            <tr>
                                                            <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                            <td><center>{{$fila['eco']}}</center></td>
                                                            @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                                <center>
                                                                    <span class="" style=" color: black; font-size:12px;">
                                                                        Cred. {{$fila['credencial']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                                <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                    </div>    
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                    </div>   
                                                                    </center> 
                                                                     
                                                                </div>
                                                                <div class="col-md-3"> 
                                                                    <div class="card-body">
                                                                    <center>
                                                                        @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                        <span class="badge " style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol']}}</span>
                                                                        @else
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                        @endif
                                                                        </center>
                                                                    </div>    
                                                                </div>
                                                                <div class="col-md-3">    
                                                                    <div class="card-body">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                    </div>    
                                                                     
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <center>
                                                                    <div class="card-body" >
                                                                        @if($fila['estatus']=="Retardo")
                                                                        <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="Sobretiempo")
                                                                        <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="En tiempo")
                                                                        <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @endif
                                                                    </div>  
                                                                    </center>
                                                                   
                                                                </div>
                                                                @if($fila['comentario'] != null)
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            {{$fila['comentario']}}
                                                                        </div>  
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            Sin Observaciones
                                                                        </div>  
                                                                    </div>
                                                                @endif 
                                                            </div>
                                                    </td>
                                                                @php $naranja=1 @endphp
                                                        @endif
                                                    @endif
                                                    
                                                    @php $repetido=0 @endphp
                                                    @php $anterior=$fila['credencial'] @endphp
                                                    
                                                    
                                                @else
                                                @php $anterior=$fila['credencial'] @endphp

                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                        <td><center>{{$fila['eco']}}</center></td>
                                                        @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:12px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                                <center>
                                                                    <span class="" style=" color: black; font-size:12px;">
                                                                        Cred. {{$fila['credencial']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                    </div>    
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <center>
                                                                    <div class="card-body">
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                    </div>   
                                                                    </center> 
                                                                     
                                                                </div>
                                                                <div class="col-md-3"> 
                                                                    <div class="card-body">
                                                                    <center>
                                                                        @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                        <span class="badge " style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol']}}</span>
                                                                        @else
                                                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                        @endif
                                                                        </center>
                                                                    </div>    
                                                                </div>
                                                                <div class="col-md-3">    
                                                                    <div class="card-body">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                    </div>    
                                                                     
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <center>
                                                                    <div class="card-body" >
                                                                        @if($fila['estatus']=="Retardo")
                                                                        <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="Sobretiempo")
                                                                        <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @elseif($fila['estatus']=="En tiempo")
                                                                        <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                                                        @endif
                                                                    </div>  
                                                                    </center>
                                                                   
                                                                </div>
                                                                @if($fila['comentario'] != null)
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            {{$fila['comentario']}}
                                                                        </div>  
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-9">
                                                                        <div class="card-sub">
                                                                            Sin Observaciones
                                                                        </div>  
                                                                    </div>
                                                                @endif  
                                                            </div>
                                                    </td>
                                                        
                                                    @php $naranja=1 @endphp
                                                    @php $repetido=0 @endphp
                                                @endif
                                            @endif
                                            
                                            @php $anterior=$fila['credencial'] @endphp
                                    @endforeach
                                    @if($naranja==1)
                                        <td  >   <center style="font-size:18px;">
                                                                Sin registro
                                                            </center>
                                                        </td>
                                    </tr>
                                     @endif
                                     
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
            
        @section('jscustom')
        <script type="text/javascript">
            $('#credencial').select2();
            $('#list_user2').DataTable({
                scrollX: false,
                scrollCollapse: true,
                filter: true,
                lengthMenu: [[15, 30, 45, 60, 75, -1], [15, 30, 45, 60, 75, "Todos"]],
                iDisplayLength: 15,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ datos",
                    "zeroRecords": "No existe el dato introducido",
                    "info": "Página _PAGE_ de _PAGES_ ",
                    "infoEmpty": "Sin datos disponibles",
                    "infoFiltered": "(mostrando los datos filtrados: _MAX_)",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "search": "Buscar",
                    "processing": "Buscando...",
                    "loadingRecords": "Cargando..."
                },initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
            });
            
            $(document).ready(function() {
                function actualizarFecha() {
                    var fecha = new Date();
                    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                    var fechaFormateada = fecha.getDate().toString().padStart(2, '0') + ' ' + meses[fecha.getMonth()] + ' ' + fecha.getFullYear();
                    var horaFormateada = fecha.getHours().toString().padStart(2, '0') + ':' + fecha.getMinutes().toString().padStart(2, '0') + ':' + fecha.getSeconds().toString().padStart(2, '0');
                    $('#fecha').text('Fecha y Hora: ' + fechaFormateada + ' ' + horaFormateada);
                }
                function minutos() {
                    var now = new Date();
                    var hours = now.getHours().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                    var minutes = now.getMinutes().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                    var horaActual = hours + ':' + minutes;
                    $('#hora_salida').val(horaActual);
                }

                // Actualizar la fecha cada segundo
                setInterval(actualizarFecha, 1000);
                setInterval(minutos, 60000);
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                var minutes = now.getMinutes().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                var horaActual = hours + ':' + minutes;

                // Establecer la hora actual en el campo de entrada
                $('#hora_llegada').val(horaActual);
                $('#hora_salida').val(horaActual);
                
            });
            $('#credencial').on('change', function() {
                // Código que se ejecutará cuando cambie el valor del elemento
                var valorCredencial = $(this).val();
                console.log("El valor ha cambiado: " + valorCredencial);
                $('#boton_registra').attr('disabled','true');
                            console.log('nada');
                            var conteo_jornada_total ;
                            var conteo_jornada_hecha ;
                            conteo_jornada_total = conteo_jornada_total/2;
                            conteo_jornada_hecha = conteo_jornada_hecha/2;
                            var Nombre ;
                            var servicio ;
                            var ciclos_texto = conteo_jornada_hecha + ' de ' + conteo_jornada_total + ' ciclos';
                            var ciclos_porcentaje = 100 / (conteo_jornada_total);
                            ciclos_porcentaje = conteo_jornada_hecha * ciclos_porcentaje;
                            
                            $('#bar').attr('data-original-title', ciclos_texto);
                            $('#bar').attr('style', 'width: ' + ciclos_porcentaje + '%');
                            $('#ciclos_span').html(ciclos_texto);
                            $('#progreso').html('Sin asignar');
                            $('#serv').val(servicio); 
                // Aquí puedes agregar más lógica para manejar el nuevo valor
            });
            $('#buscar').click(function(event) {
                event.preventDefault();

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{url("/buscar_rol_operador")}}', // Reemplaza con la URL de tu endpoint
                    type: 'GET', // Puedes cambiar a POST si es necesario
                    data: {
                        'credencial': $('#credencial').val(), // Envía los parámetros necesarios
                        'dia': $('#dia').val(),
                    },
                    success: function(response) {
                        console.log(response['error'] );
                        console.log(response['conteo_jornada_total'] );
                        if(response['conteo_jornada_total']){
                            $('#boton_registra').removeAttr('disabled');
                            console.log('tiene');
                            var conteo_jornada_total = response['conteo_jornada_total'];
                            var conteo_jornada_hecha = response['conteo_jornada_hecha'];
                            conteo_jornada_total = conteo_jornada_total/2;
                            conteo_jornada_hecha = conteo_jornada_hecha/2;
                            var Nombre = response['Nombre'];
                            var servicio = response['servicio'];
                            var ciclos_texto = conteo_jornada_hecha + ' de ' + conteo_jornada_total + ' ciclos';
                            var ciclos_porcentaje = 100 / (conteo_jornada_total);
                            ciclos_porcentaje = conteo_jornada_hecha * ciclos_porcentaje;
                            
                            $('#bar').attr('data-original-title', ciclos_texto);
                            $('#bar').attr('style', 'width: ' + ciclos_porcentaje + '%');
                            $('#ciclos_span').html(ciclos_texto);
                            $('#progreso').html(Nombre);
                            $('#serv').val(servicio); 
                        } else if(response['error']) {
                            $('#boton_registra').attr('disabled','true');
                            console.log('nada');
                            var conteo_jornada_total = response['conteo_jornada_total'];
                            var conteo_jornada_hecha = response['conteo_jornada_hecha'];
                            conteo_jornada_total = conteo_jornada_total/2;
                            conteo_jornada_hecha = conteo_jornada_hecha/2;
                            var Nombre = response['Nombre'];
                            var servicio = response['servicio'];
                            var ciclos_texto = conteo_jornada_hecha + ' de ' + conteo_jornada_total + ' ciclos';
                            var ciclos_porcentaje = 100 / (conteo_jornada_total);
                            ciclos_porcentaje = conteo_jornada_hecha * ciclos_porcentaje;
                            
                            $('#bar').attr('data-original-title', ciclos_texto);
                            $('#bar').attr('style', 'width: ' + ciclos_porcentaje + '%');
                            $('#ciclos_span').html(ciclos_texto);
                            $('#progreso').html('Sin asignar');
                            $('#serv').val(servicio); 
                        }

                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud:', error);
                    }
                });
            });

            
        </script>
        @endsection
    </x-app-layout>
