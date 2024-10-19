<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }
    </style>
    <div class="col-12 col-md-12">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade active show" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                <div class="accordion accordion-secondary">
                    <div class="card" style="background-color: #fff;">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" role="button">
                            <div class="card-title" style="display: inline-block;">Consulta bitacora de operaciones</div>
                            
                            <div class="span-mode" style="color:#000000;" id="fecha" ></div>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
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
                                        
                                        <div class="col-md-2">
                                            <label>Día <span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="dia" name="dia" value="{{now()->format('Y-m-d')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Credencial <span class="required-label">*</span></label>
                                            <select required type="text" style=" width:90%;" class="form-control input-with-border" id="credencial" name="credencial">
                                                @foreach($credencial as $cred)
                                                <option value="{{$cred->id}}">{{$cred->id}} - {{$cred->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label>&nbsp;<br><br><br></label>
                                            <button class="btn btn-primary btn-sm" id="buscar" onclick=""><i class="la flaticon-search-2"></i></button>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Terminal</label>
                                            <select required class="form-control input-with-border" id="terminal_c" name="terminal_c">
                                                @foreach($terminal as $term)
                                                <option value="{{$term->id_terminal}}">{{$term->terminal}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Servicio<span class="required-label">*</span></label>
                                            
                                            
                                            <input type="hidden" name="id_jornada_sem" id="id_jornada_sem">
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
                                            <label>Llegada/Salida  <span class="required-label">*</span></label>
                                            <select required class="form-control input-with-border" id="llegada_salida" name="llegada_salida">
                                                <option value="1">Salida 1</option>
                                                <option value="2">Llegada 1</option>
                                                <option value="3">Salida 2</option>
                                                <option value="4">Llegada 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Hora  <span class="required-label">*</span></label>
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="card-title" style="display: inline-block;">Consulta bitacora de operaciones</div>
        <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
    </div>
    <div class="card-body">
        <div class="row form-group">
            <div class="col-sm-3 col-md-2">
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
                                    <h4 class="card-title">{{$tr1_registro / 2}}/{{$tr1_ciclos[0]->conteo}} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-2">
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
                                    <h4 class="card-title">{{$tr1_r_registro / 2 }}/{{$tr1_r_ciclos[0]->conteo }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-2">
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
                                    <h4 class="card-title">{{$tr3_registro / 2 }}/{{$tr3_ciclos[0]->conteo}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-2">
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
                                    <h4 class="card-title">{{$tr4_registro / 2}}/{{$tr4_ciclos[0]->conteo}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-2">
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
                                    <h4 class="card-title">{{$total_registros / 2}}/{{$tr4_ciclos[0]->conteo + $tr3_ciclos[0]->conteo + $tr1_r_ciclos[0]->conteo + $tr1_ciclos[0]->conteo}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="pdf" value="pdf" id="pdf-input">
            <div class="col-sm-3 col-md-2">
                <div class=" card-stats">
                    <div class="card-body" >
                        <form method="post" id="exampleValidation" action="{{url('/Bitacora_de_operaciones')}}">
                            @csrf
                            <div class="row">
                                <button type="submit" style="border:1px #fff solid; backgroud-color:#fff; " class="col-6" name="pdf" id="pdf">
                                    <div class="icon-big text-center icon-warning" style="background-color: red; cursor: pointer;">
                                        <i class="la la-file-pdf-o text-warning"></i>
                                    </div>
                                </button>
                                <button type="submit" style="border:1px #fff solid; backgroud-color:#fff;  " class="col-6" name="Excel" id="Excel">
                                    <div class="icon-big text-center icon-warning" style="background-color: #2d572c; cursor: pointer;">
                                        <i class="la la-file-excel-o text-warning"></i>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive" >
            <table class="table table-hover table-striped table-bordered display  "  id="list_user2">
                <thead>
                    <tr>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 6%;"><center>Serv.</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 6%;"><center>Credencial</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 4%;"><center>Ciclo</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 22%;"><center>Salida 1</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 20%;"><center>Llegada 1</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 22%;"><center>Salida 2</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 20%;"><center>Llegada 2</center></th>
                        <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 2%;"><center>Km circuito</center></th>
                    </tr>
                </thead>
                <tbody id="llenaTabla" >
                    @php $contador = 0; @endphp
                    @php $anterior_ciclo = 0; @endphp
                    @php $anterior_credencial = 0; @endphp
                    @php $repetido = 0; @endphp
                    @php $naranja = 0; @endphp

                    
                    @php $Ojo_De_Agua_1 = 0; @endphp
                    @php $Esmeralda_1 = 1.47; @endphp
                    @php $Cuauhtemoc_Norte_1 = 2; @endphp
                    @php $Cuauhtemoc_Sur_1 = 3.05; @endphp
                    @php $Hidalgo_1 = 3.58; @endphp
                    @php $Insurgentes_1 = 4.39; @endphp
                    @php $Central_De_Abastos_1 = 5.3; @endphp
                    @php $e_19_De_Septiembre_1 = 6.62; @endphp
                    @php $Palomas_1 = 7.6; @endphp
                    @php $Jardines_De_Morelos_1 = 8; @endphp
                    @php $Aquiles_Serdan_1 = 8.26; @endphp
                    @php $Hospital_1 = 8.77; @endphp
                    @php $e_1ro_De_Mayo_1 = 9.6; @endphp
                    @php $Las_Americas_1 = 10.55; @endphp
                    @php $Valle_De_Ecatepec_1 = 11.64; @endphp
                    @php $Vocacional_3_1 = 12.4; @endphp
                    @php $Adolfo_Lopez_Mateos_1 = 12.5; @endphp
                    @php $Zodiaco_1 = 13; @endphp
                    @php $Alfredo_Torres_1 = 13.58; @endphp
                    @php $Unitec_1 = 14.02; @endphp
                    @php $Estacion_Industrial_1 = 14.5; @endphp
                    @php $Josefa_Ortiz_De_Dominguez_1 = 15; @endphp
                    @php $Quinto_Sol_1 = 15.83; @endphp
                    @php $Ciudad_Azteca_1 = 16.5; @endphp

                    @php $Ojo_De_Agua_2 = 17.1; @endphp
                    @php $Esmeralda_2 = 15; @endphp
                    @php $Cuauhtemoc_Norte_2 = 14.5; @endphp
                    @php $Cuauhtemoc_Sur_2 = 13.47; @endphp
                    @php $Hidalgo_2 = 12.9; @endphp
                    @php $Insurgentes_2 = 12.04; @endphp
                    @php $Central_De_Abastos_2 = 11.3; @endphp
                    @php $e_19_De_Septiembre_2 = 9.8; @endphp
                    @php $Palomas_2 = 9.39; @endphp
                    @php $Jardines_De_Morelos_2 = 8.45; @endphp
                    @php $Aquiles_Serdan_2 = 8.18; @endphp
                    @php $Hospital_2 = 7.66; @endphp
                    @php $e_1ro_De_Mayo_2 = 6.73; @endphp
                    @php $Las_Americas_2 = 5.88; @endphp
                    @php $Valle_De_Ecatepec_2 = 4.8; @endphp
                    @php $Vocacional_3_2 = 4.31; @endphp
                    @php $Adolfo_Lopez_Mateos_2 = 3.93; @endphp
                    @php $Zodiaco_2 = 3.45; @endphp
                    @php $Alfredo_Torres_2 = 2.86; @endphp
                    @php $Unitec_2 = 2.34; @endphp
                    @php $Estacion_Industrial_2 = 1.86; @endphp
                    @php $Josefa_Ortiz_De_Dominguez_2 = 1.41; @endphp
                    @php $Quinto_Sol_2 = 0.6; @endphp
                    @php $Ciudad_Azteca_2 = 0; @endphp

                    @if(null !== $consulta)
                    @foreach($consulta as $fila)
                    @php $salida_1=0; @endphp
                    @php $llegada_1=0; @endphp
                    @php $salida_2=0; @endphp
                    @php $llegada_2=0; @endphp
                    <tr>
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
                            <center>
                                <span class="" style=" color: black; font-size:12px;">
                                    Ciclo {{$fila['ciclo']}}
                                </span>
                            </center>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                            <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                            <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_1_eco']}}</i> - Terminal: {{$fila['terminal1']}}</div>
                                        </center> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body">
                                            <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['salida_1']}} hrs.</span>
                                        </div>   
                                    </center> 
                                </div>
                                <div class="col-md-6"> 
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
                                <div class="col-md-6">    
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
                                <div class="col-md-6">
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
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        {{$fila['salida_1_com']}}
                                    </div>  
                                </div>
                            </div>
                        </td> 
                        @if($fila['salida_1_ter']==1)  @php $salida_1 = $Ojo_De_Agua_1; @endphp
                        @elseif($fila['salida_1_ter']==2)  @php $salida_1 = $Central_De_Abastos_1; @endphp
                        @elseif($fila['salida_1_ter']==3)  @php $salida_1 = $Ciudad_Azteca_1 @endphp
                        @elseif($fila['salida_1_ter']==4)  @php $salida_1 = $Esmeralda_1; @endphp
                        @elseif($fila['salida_1_ter']==5)  @php $salida_1 = $Cuauhtemoc_Norte_1; @endphp
                        @elseif($fila['salida_1_ter']==6)  @php $salida_1 = $Cuauhtemoc_Sur_1; @endphp
                        @elseif($fila['salida_1_ter']==7)  @php $salida_1 = $Hidalgo_1; @endphp
                        @elseif($fila['salida_1_ter']==8)  @php $salida_1 = $Insurgentes_1; @endphp
                        @elseif($fila['salida_1_ter']==9)  @php $salida_1 = $e_19_De_Septiembre_1; @endphp
                        @elseif($fila['salida_1_ter']==10)  @php $salida_1 = $Palomas_1; @endphp
                        @elseif($fila['salida_1_ter']==11)  @php $salida_1 = $Jardines_De_Morelos_1; @endphp
                        @elseif($fila['salida_1_ter']==12)  @php $salida_1 = $Aquiles_Serdan_1; @endphp
                        @elseif($fila['salida_1_ter']==13)  @php $salida_1 = $Hospital_1; @endphp
                        @elseif($fila['salida_1_ter']==14)  @php $salida_1 = $e_1ro_De_Mayo_1; @endphp
                        @elseif($fila['salida_1_ter']==15)  @php $salida_1 = $Las_Americas_1; @endphp
                        @elseif($fila['salida_1_ter']==16)  @php $salida_1 = $Valle_De_Ecatepec_1; @endphp
                        @elseif($fila['salida_1_ter']==17)  @php $salida_1 = $Vocacional_3_1; @endphp
                        @elseif($fila['salida_1_ter']==18)  @php $salida_1 = $Adolfo_Lopez_Mateos_1; @endphp
                        @elseif($fila['salida_1_ter']==19)  @php $salida_1 = $Zodiaco_1; @endphp
                        @elseif($fila['salida_1_ter']==20)  @php $salida_1 = $Alfredo_Torres_1; @endphp
                        @elseif($fila['salida_1_ter']==21)  @php $salida_1 = $Unitec_1 ; @endphp
                        @elseif($fila['salida_1_ter']==22)  @php $salida_1 = $Estacion_Industrial_1; @endphp
                        @elseif($fila['salida_1_ter']==23)  @php $salida_1 = $Josefa_Ortiz_De_Dominguez_1; @endphp
                        @elseif($fila['salida_1_ter']==24)  @php $salida_1 = $Quinto_Sol_1; @endphp
                        @endif


                        @if($fila['llegada_1']=="Sin datos")
                        <td>
                            <center> Sin datos</center>
                        </td>
                        @else
                        
                        @if($fila['salida_2_ter']==1)  @php $llegada_1 = $Ojo_De_Agua_1; @endphp
                        @elseif($fila['salida_2_ter']==2)  @php $llegada_1 = $Central_De_Abastos_1; @endphp
                        @elseif($fila['salida_2_ter']==3)  @php $llegada_1 = $Ciudad_Azteca_1 @endphp
                        @elseif($fila['salida_2_ter']==4)  @php $llegada_1 = $Esmeralda_1; @endphp
                        @elseif($fila['salida_2_ter']==5)  @php $llegada_1 = $Cuauhtemoc_Norte_1; @endphp
                        @elseif($fila['salida_2_ter']==6)  @php $llegada_1 = $Cuauhtemoc_Sur_1; @endphp
                        @elseif($fila['salida_2_ter']==7)  @php $llegada_1 = $Hidalgo_1; @endphp
                        @elseif($fila['salida_2_ter']==8)  @php $llegada_1 = $Insurgentes_1; @endphp
                        @elseif($fila['salida_2_ter']==9)  @php $llegada_1 = $e_19_De_Septiembre_1; @endphp
                        @elseif($fila['salida_2_ter']==10)  @php $llegada_1 = $Palomas_1; @endphp
                        @elseif($fila['salida_2_ter']==11)  @php $llegada_1 = $Jardines_De_Morelos_1; @endphp
                        @elseif($fila['salida_2_ter']==12)  @php $llegada_1 = $Aquiles_Serdan_1; @endphp
                        @elseif($fila['salida_2_ter']==13)  @php $llegada_1 = $Hospital_1; @endphp
                        @elseif($fila['salida_2_ter']==14)  @php $llegada_1 = $e_1ro_De_Mayo_1; @endphp
                        @elseif($fila['salida_2_ter']==15)  @php $llegada_1 = $Las_Americas_1; @endphp
                        @elseif($fila['salida_2_ter']==16)  @php $llegada_1 = $Valle_De_Ecatepec_1; @endphp
                        @elseif($fila['salida_2_ter']==17)  @php $llegada_1 = $Vocacional_3_1; @endphp
                        @elseif($fila['salida_2_ter']==18)  @php $llegada_1 = $Adolfo_Lopez_Mateos_1; @endphp
                        @elseif($fila['salida_2_ter']==19)  @php $llegada_1 = $Zodiaco_1; @endphp
                        @elseif($fila['salida_2_ter']==20)  @php $llegada_1 = $Alfredo_Torres_1; @endphp
                        @elseif($fila['salida_2_ter']==21)  @php $llegada_1 = $Unitec_1 ; @endphp
                        @elseif($fila['salida_2_ter']==22)  @php $llegada_1 = $Estacion_Industrial_1; @endphp
                        @elseif($fila['salida_2_ter']==23)  @php $llegada_1 = $Josefa_Ortiz_De_Dominguez_1; @endphp
                        @elseif($fila['salida_2_ter']==24)  @php $llegada_1 = $Quinto_Sol_1; @endphp
                        @endif
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                            <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                            <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_2_eco']}}</i> - Terminal: {{$fila['terminal2']}}</div>
                                        </center> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <div class="card-body">
                                            <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['llegada_1']}} hrs.</span>
                                        </div>   
                                    </center> 
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        {{$fila['salida_2_com']}}
                                    </div>  
                                </div>
                            </div>
                        </td> 
                        @endif

                        @if($fila['salida_2']=="Sin datos")
                        <td>
                            <center> Sin datos</center>
                        </td>
                        @else

                        @if($fila['salida_3_ter']==1)  @php $salida_2 = $Ojo_De_Agua_2; @endphp
                        @elseif($fila['salida_3_ter']==2)  @php $salida_2 = $Central_De_Abastos_2; @endphp
                        @elseif($fila['salida_3_ter']==3)  @php $salida_2 = $Ciudad_Azteca_2 @endphp
                        @elseif($fila['salida_3_ter']==4)  @php $salida_2 = $Esmeralda_2; @endphp
                        @elseif($fila['salida_3_ter']==5)  @php $salida_2 = $Cuauhtemoc_Norte_2; @endphp
                        @elseif($fila['salida_3_ter']==6)  @php $salida_2 = $Cuauhtemoc_Sur_2; @endphp
                        @elseif($fila['salida_3_ter']==7)  @php $salida_2 = $Hidalgo_2; @endphp
                        @elseif($fila['salida_3_ter']==8)  @php $salida_2 = $Insurgentes_2; @endphp
                        @elseif($fila['salida_3_ter']==9)  @php $salida_2 = $e_19_De_Septiembre_2; @endphp
                        @elseif($fila['salida_3_ter']==10)  @php $salida_2 = $Palomas_2; @endphp
                        @elseif($fila['salida_3_ter']==11)  @php $salida_2 = $Jardines_De_Morelos_2; @endphp
                        @elseif($fila['salida_3_ter']==12)  @php $salida_2 = $Aquiles_Serdan_2; @endphp
                        @elseif($fila['salida_3_ter']==13)  @php $salida_2 = $Hospital_2; @endphp
                        @elseif($fila['salida_3_ter']==14)  @php $salida_2 = $e_1ro_De_Mayo_2; @endphp
                        @elseif($fila['salida_3_ter']==15)  @php $salida_2 = $Las_Americas_2; @endphp
                        @elseif($fila['salida_3_ter']==16)  @php $salida_2 = $Valle_De_Ecatepec_2; @endphp
                        @elseif($fila['salida_3_ter']==17)  @php $salida_2 = $Vocacional_3_2; @endphp
                        @elseif($fila['salida_3_ter']==18)  @php $salida_2 = $Adolfo_Lopez_Mateos_2; @endphp
                        @elseif($fila['salida_3_ter']==19)  @php $salida_2 = $Zodiaco_2; @endphp
                        @elseif($fila['salida_3_ter']==20)  @php $salida_2 = $Alfredo_Torres_2; @endphp
                        @elseif($fila['salida_3_ter']==21)  @php $salida_2 = $Unitec_2 ; @endphp
                        @elseif($fila['salida_3_ter']==22)  @php $salida_2 = $Estacion_Industrial_2; @endphp
                        @elseif($fila['salida_3_ter']==23)  @php $salida_2 = $Josefa_Ortiz_De_Dominguez_2; @endphp
                        @elseif($fila['salida_3_ter']==24)  @php $salida_2 = $Quinto_Sol_2; @endphp
                        @endif

                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                            <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                            <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_3_eco']}}</i> - Terminal: {{$fila['terminal3']}} </div>
                                        </center> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body">
                                            <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['salida_2']}} hrs.</span>
                                        </div>   
                                    </center> 
                                </div>
                                <div class="col-md-6"> 
                                    <div class="card-body">
                                        <center>
                                            @if($fila['hora_salida_rol_2']=="Fuera de jornada")
                                            <span class="badge" style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol_2']}}</span>
                                            @else
                                            <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol_2']}} hrs.</span>
                                            @endif
                                        </center>
                                    </div>    
                                </div>
                                <div class="col-md-6">    
                                    <div class="card-body">
                                        <center>
                                            @if($fila['hora_diferencia_2']=="Fuera de jornada")
                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia_2']}}</span>
                                            @else
                                            <span class="badge badge-success"  style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia_2']}} hrs.</span>
                                            @endif
                                        </center>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body" >
                                            @if($fila['estatus_2']=="Retardo")
                                            <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus_2']}}</span>
                                            @elseif($fila['estatus_2']=="Sobretiempo")
                                            <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus_2']}}</span>
                                            @elseif($fila['estatus_2']=="En tiempo")
                                            <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus_2']}}</span>
                                            @endif
                                        </div>  
                                    </center>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        {{$fila['salida_3_com']}}
                                    </div>  
                                </div>
                            </div>
                        </td> 
                        @endif
                        @if($fila['llegada_2']=="Sin datos")
                        <td>
                         <center> Sin datos</center>
                     </td>
                     @else


                     @if($fila['salida_4_ter']==1)  @php $llegada_2 = $Ojo_De_Agua_2; @endphp
                     @elseif($fila['salida_4_ter']==2)  @php $llegada_2 = $Central_De_Abastos_2; @endphp
                     @elseif($fila['salida_4_ter']==3)  @php $llegada_2 = $Ciudad_Azteca_2 @endphp
                     @elseif($fila['salida_4_ter']==4)  @php $llegada_2 = $Esmeralda_2; @endphp
                     @elseif($fila['salida_4_ter']==5)  @php $llegada_2 = $Cuauhtemoc_Norte_2; @endphp
                     @elseif($fila['salida_4_ter']==6)  @php $llegada_2 = $Cuauhtemoc_Sur_2; @endphp
                     @elseif($fila['salida_4_ter']==7)  @php $llegada_2 = $Hidalgo_2; @endphp
                     @elseif($fila['salida_4_ter']==8)  @php $llegada_2 = $Insurgentes_2; @endphp
                     @elseif($fila['salida_4_ter']==9)  @php $llegada_2 = $e_19_De_Septiembre_2; @endphp
                     @elseif($fila['salida_4_ter']==10)  @php $llegada_2 = $Palomas_2; @endphp
                     @elseif($fila['salida_4_ter']==11)  @php $llegada_2 = $Jardines_De_Morelos_2; @endphp
                     @elseif($fila['salida_4_ter']==12)  @php $llegada_2 = $Aquiles_Serdan_2; @endphp
                     @elseif($fila['salida_4_ter']==13)  @php $llegada_2 = $Hospital_2; @endphp
                     @elseif($fila['salida_4_ter']==14)  @php $llegada_2 = $e_1ro_De_Mayo_2; @endphp
                     @elseif($fila['salida_4_ter']==15)  @php $llegada_2 = $Las_Americas_2; @endphp
                     @elseif($fila['salida_4_ter']==16)  @php $llegada_2 = $Valle_De_Ecatepec_2; @endphp
                     @elseif($fila['salida_4_ter']==17)  @php $llegada_2 = $Vocacional_3_2; @endphp
                     @elseif($fila['salida_4_ter']==18)  @php $llegada_2 = $Adolfo_Lopez_Mateos_2; @endphp
                     @elseif($fila['salida_4_ter']==19)  @php $llegada_2 = $Zodiaco_2; @endphp
                     @elseif($fila['salida_4_ter']==20)  @php $llegada_2 = $Alfredo_Torres_2; @endphp
                     @elseif($fila['salida_4_ter']==21)  @php $llegada_2 = $Unitec_2 ; @endphp
                     @elseif($fila['salida_4_ter']==22)  @php $llegada_2 = $Estacion_Industrial_2; @endphp
                     @elseif($fila['salida_4_ter']==23)  @php $llegada_2 = $Josefa_Ortiz_De_Dominguez_2; @endphp
                     @elseif($fila['salida_4_ter']==24)  @php $llegada_2 = $Quinto_Sol_2; @endphp
                     @endif

                     <td>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-sub">
                                    <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                        <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_4_eco']}}</i> - Terminal: {{$fila['terminal4']}}</div>
                                    </center> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <div class="card-body">
                                        <span class="badge badge-success" style="background-color: #a9e9a9; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['llegada_2']}} hrs.</span>
                                    </div>   
                                </center> 
                            </div>
                            <div class="col-md-12">
                                <div class="card-sub">
                                    {{$fila['salida_4_com']}}
                                </div>  
                            </div>
                        </div>
                    </td> 
                    @endif
                    <td>

                        @php $km_1 = $llegada_1 - $salida_1; @endphp
                        @php $km_2 = $llegada_2 - $salida_2; @endphp
                        @php $km_t = $km_1 + $km_2; @endphp
                        {{$km_t}}
                    </td>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



@section('jscustom')
<script type="text/javascript">
    $('#terminal_c').select2();
    $(document).ready(function() {
        function actualizarFecha() {
            var fecha = new Date();
            var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            var fechaFormateada = fecha.getDate().toString().padStart(2, '0') + ' ' + meses[fecha.getMonth()] + ' ' + fecha.getFullYear();
            var horaFormateada = fecha.getHours().toString().padStart(2, '0') + ':' + fecha.getMinutes().toString().padStart(2, '0') + ':' + fecha.getSeconds().toString().padStart(2, '0');
            $('#fecha').html('&nbsp;&nbsp;&nbsp; Fecha y Hora: ' + fechaFormateada + ' ' + horaFormateada);
        }
        function minutos() {
            var now = new Date();
                    var hours = now.getHours().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                    var minutes = now.getMinutes().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                    var horaActual = hours + ':' + minutes;
                    $('#hora_salida').val(horaActual);
                }
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
        $('#boton_registra').attr('disabled','true');
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
        $.ajax({
                    url: '{{url("/buscar_rol_operador")}}', // Reemplaza con la URL de tu endpoint
                    type: 'GET', // Puedes cambiar a POST si es necesario
                    data: {
                        'credencial': $('#credencial').val(), // Envía los parámetros necesarios
                        'dia': $('#dia').val(),
                    },
                    success: function(response) {
                        console.log(response);
                        if(response['conteo_jornada_total']){
                            $('#boton_registra').removeAttr('disabled');
                            var conteo_jornada_total = response['conteo_jornada_total'];
                            var conteo_jornada_hecha = response['conteo_jornada_hecha'];
                            conteo_jornada_total = conteo_jornada_total/2;
                            conteo_jornada_hecha = conteo_jornada_hecha/4;
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
                            $('#id_jornada_sem').val(response['id_jornada']); 
                        } else if(response['error']) {
                            $('#boton_registra').attr('disabled','true');
                            var conteo_jornada_total = response['conteo_jornada_total'];
                            var conteo_jornada_hecha = response['conteo_jornada_hecha'];
                            conteo_jornada_total = conteo_jornada_total/2;
                            conteo_jornada_hecha = conteo_jornada_hecha/4;
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
</script>
@endsection
</x-app-layout>
