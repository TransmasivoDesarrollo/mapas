<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }
        @keyframes biper {
            0% {
                opacity: 0;
                transform: translateX(-5px);
            }
            50% {
                opacity: 1;
                transform: translateX(0px);
            }
            100% {
                opacity: 0;
                transform: translateX(5px);
            }
        }

        .biper {
            display: inline-block;
            animation: biper 5s infinite;
        }

        .texto-hover {
            color: black; /* Color del texto por defecto */
            transition: color 0.3s ease; /* Transición suave */
        }

        .texto-hover:hover {
            color: gray; /* Color gris cuando el cursor pasa por encima */
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
            <div class="form-group row " >
                
                @php
                $currentYear = \Carbon\Carbon::now()->year;
                $today = \Carbon\Carbon::today()->format('Y-m-d');
                $semanas = [];
                $j = 1;
                $selectedSemana = '';

                // Generar todas las semanas del año
                for ($week = 1; $week <= 52; $week++) {
                    $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
                    $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
                    $semanaValue = "$startOfWeek 00:00:00 al $endOfWeek 23:59:59";
                    $semanas[] = [
                    'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                    'value' => $semanaValue
                    ];
                    if ($today >= $startOfWeek && $today <= $endOfWeek) {
                        $selectedSemana = $semanaValue;
                    }
                    $j++;
                }
                @endphp

                <div class="col-md-12">
                    <div class="row">
                        
                    </div>
                </div>
                
                <div class="col-md-5">
                    <form method="post" id="contratoForm" action="{{url('/enrolar_horarios_conductores_2')}}">
                        @csrf
                        <label>Semana <span class="required-label"></span></label>
                        <select style="border:1px black solid;" class="form-control" id="semana" name="semana">
                            <option value="-Selecciona-">-Selecciona-</option>
                            @foreach ($semanas as $semana)
                            <option value="{{ $semana['value'] }}" @if($semana['value'] == $semana_seleccionada) selected style="background-color:green; color:#fff;" @endif @if($semana['value'] == $semana_seleccionada) selected @endif >
                                {{ $semana['label'] }}
                            </option>
                            @endforeach
                        </select>
                        <br><br>
                    </div>
                    <div class="col-md-5">
                        <label><br><br>&nbsp; <span class="required-label"></span></label>
                        <input type="submit" value="Buscar" id="Buscar" name="Buscar" class="btn btn-primary" >
                    </div>
                </form>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="contratoForm" action="{{url('/enrolar_horarios_conductores_2')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Enrolar conductor (Lunes a Viernes)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="hidden_servicio" name="hidden_servicio">
                                    <input type="hidden" id="hidden_dia_servicio" name="hidden_dia_servicio">
                                    <input type="hidden" id="hidden_turno" name="hidden_turno">
                                    <input type="hidden" id="hidden_jornada" name="hidden_jornada">
                                    <input type="hidden" id="hidden_id_jornada_pk" name="hidden_id_jornada_pk">
                                    
                                    <input type="hidden" id="semana_hidden" name="semana_hidden">
                                    <input type="hidden" id="dia_inicio_lv" name="dia_inicio_lv" value="{{$dia_inicio}}">
                                    <input type="hidden" id="dia_fin_lv" name="dia_fin_lv" value="{{$dia_fin}}">
                                    
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Conductores <span class="required-label"></span></label>
                                        <div class="select2-input">
                                            <select id="conductores" name="conductores" class="form-control">
                                                @foreach ($conductores as $conductor)
                                                <option value="{{ $conductor->id }}"  >
                                                    {{ $conductor->id }} - {{ $conductor->name }}
                                                </option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="enrolar" id="enrolar" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal_s" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_s" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="contratoForm" action="{{url('/enrolar_horarios_conductores_2')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel_s">Enrolar conductor Sabado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="hidden_servicio_s" name="hidden_servicio_s">
                                    <input type="hidden" id="hidden_dia_servicio_s" name="hidden_dia_servicio_s">
                                    <input type="hidden" id="hidden_turno_s" name="hidden_turno_s">
                                    <input type="hidden" id="hidden_jornada_s" name="hidden_jornada_s">
                                    <input type="hidden" id="semana_hidden_s" name="semana_hidden_s">
                                    
                                    <input type="hidden" id="hidden_id_jornada_pk_s" name="hidden_id_jornada_pk_s">
                                    <input type="hidden" id="dia_inicio_s" name="dia_inicio_s" value="{{$dia_inicio}}">
                                    <input type="hidden" id="dia_fin_s" name="dia_fin_s" value="{{$dia_fin}}">
                                    
                                    <div class="col-md-12">
                                        <label>Conductores <span class="required-label"></span></label>
                                        <select style="border:1px black solid; width:100%;" class="form-control" id="conductores_s" name="conductores">
                                            @foreach ($conductores_s as $conductor)
                                            <option value="{{ $conductor->id }}"  >
                                                {{ $conductor->id }} - {{ $conductor->name }}
                                            </option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="enrolar" id="enrolar" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal_d" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_d" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="contratoForm" action="{{url('/enrolar_horarios_conductores_2')}}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel_d">Enrolar conductor Domingo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="hidden_servicio_d" name="hidden_servicio_d">
                                    <input type="hidden" id="hidden_dia_servicio_d" name="hidden_dia_servicio_d">
                                    <input type="hidden" id="hidden_turno_d" name="hidden_turno_d">
                                    <input type="hidden" id="hidden_jornada_d" name="hidden_jornada_d">
                                    <input type="hidden" id="hidden_id_jornada_pk_d" name="hidden_id_jornada_pk_d">
                                    <input type="hidden" id="semana_hidden_d" name="semana_hidden_d">
                                    <input type="hidden" id="dia_inicio_d" name="dia_inicio_d" value="{{$dia_inicio}}">
                                    <input type="hidden" id="dia_fin_d" name="dia_fin_d" value="{{$dia_fin}}">
                                    
                                    <div class="col-md-12">
                                        <label>Conductores <span class="required-label"></span></label>
                                        <select style="border:1px black solid; width:100%;" class="form-control" id="conductores_d" name="conductores">
                                            @foreach ($conductores_d as $conductor)
                                            <option value="{{ $conductor->id }}"  >
                                                {{ $conductor->id }} - {{ $conductor->name }}
                                            </option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="enrolar" id="enrolar" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <b>Rol</b> 
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-12 " >
                                        <div class="table table-responsive">
                                            <table class="table table-bordered  " id="resultados">
                                                <thead>
                                                    <tr>
                                                        <th class="bg-danger sorting" style="color:#ffffff; width: 3%;"><center>#</center></th>
                                                        <th class="bg-danger sorting" style="color:#ffffff; width: 8%;"><center>Servicio</center></th>
                                                        <th class="bg-danger sorting" style="color:#ffffff; width: 8%;"><center>Jornada</center></th>
                                                        <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Turno</center></th>
                                                        <th class="bg-danger sorting" style="color:#ffffff; width: 17%;"><center>Día de servicio</center></th>
                                                        <th class="bg-danger sorting" style="color:#ffffff; width: 22%;"><center>Horario</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="llenaTablamodal">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                


                

                    <div class="col-md-12">
							
								<div class="card-body">
									<ul class="nav nav-pills nav-primary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">TR1</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">TR1-R</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">TR3</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR4-tab-nobd" data-toggle="pill" href="#pills-TR4-nobd" role="tab" aria-controls="pills-TR4-nobd" aria-selected="false">TR4</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR1-S-tab-nobd" data-toggle="pill" href="#pills-TR1-S-nobd" role="tab" aria-controls="pills-TR1-S-nobd" aria-selected="false">TR1 Sabado</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR1-R-S-tab-nobd" data-toggle="pill" href="#pills-TR1-R-S-nobd" role="tab" aria-controls="pills-TR1-R-S-nobd" aria-selected="false">TR1-R Sabado</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR3-S-tab-nobd" data-toggle="pill" href="#pills-TR3-S-nobd" role="tab" aria-controls="pills-TR3-S-nobd" aria-selected="false">TR3 Sabado</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR4-S-tab-nobd" data-toggle="pill" href="#pills-TR4-S-nobd" role="tab" aria-controls="pills-TR4-S-nobd" aria-selected="false">TR4 Sabado</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR1-D-tab-nobd" data-toggle="pill" href="#pills-TR1-D-nobd" role="tab" aria-controls="pills-TR1-D-nobd" aria-selected="false">TR1 Domingo</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR1-R-D-tab-nobd" data-toggle="pill" href="#pills-TR1-R-D-nobd" role="tab" aria-controls="pills-TR1-R-D-nobd" aria-selected="false">TR1-R Domingo</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR3-D-tab-nobd" data-toggle="pill" href="#pills-TR3-D-nobd" role="tab" aria-controls="pills-TR3-D-nobd" aria-selected="false">TR3 Domingo</a>
										</li>
                                        <li class="nav-item">
											<a class="nav-link" id="pills-TR4-D-tab-nobd" data-toggle="pill" href="#pills-TR4-D-nobd" role="tab" aria-controls="pills-TR4-D-nobd" aria-selected="false">TR4 Domingo</a>
										</li>
                                        
									</ul>
									<div class="tab-content mb-3" id="pills-without-border-tabContent">
										<div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                            <div class="col-md-12">
                                                <center><b>TR1</b><br><br> </center>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="table-responsive" >
                                                    <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                        <tbody id="llenaTablaas" style="">
                                                            @php $contador=1; @endphp
                                                            @php $contador_matutino=1; @endphp
                                                            <tr style="background-color: #e5be01; color:black; border:1px black solid; ">
                                                                @foreach($jornadas_m as $cons)
                                                                    @if($cons->turno=="Matutino" && $cons->servicio=="TR1")
                                                                    <td >
                                                                        <center>
                                                                        <b style="size:16px; color:black;">Jornada {{$cons->jornada}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @php $contador_matutino++; @endphp
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                            <tr style=" border:1px black solid; background-color: rgba(229,190,1,.1);">
                                                                @foreach($jornadas_m as $cons)
                                                                @if($cons->turno=="Matutino"  && $cons->servicio=="TR1")
                                                                <td >
                                                                    @if($cons->conductor=="Sin conductor")
                                                                        <center>
                                                                            <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                            class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                        </center><hr>
                                                                    @else
                                                                        <center><b>{{$cons->conductor}}</b></center><hr>
                                                                    @endif
                                                                    <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                    <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                    <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                    </center>
                                                                </td>
                                                                @endif
                                                                @if($cons->turno=="Vespertino"  && $cons->servicio=="TR1")
                                                                @if($contador== 1)
                                                                    </tr>
                                                                    <tr style="background-color: rgba(229,190,1,1);">
                                                                        <td colspan="{{$contador_matutino}}">
                                                                            <center><b class="biper">Cambio de turno</b></center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style=" background-color: rgba(229,190,1,.2);">
                                                                        <td >
                                                                            <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                            <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                            <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                            </center>
                                                                    @if($cons->conductor=="Sin conductor")
                                                                    <hr><center>
                                                                    <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                            class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                        </center>
                                                                    @else
                                                                    <hr><center><b>{{$cons->conductor}}</b></center>
                                                                    @endif
                                                                </td>
                                                                @php 
                                                                $contador=2;
                                                                @endphp
                                                                @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR1")
                                                                <td >
                                                                    <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                    <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                    <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                    @if($cons->conductor=="Sin conductor")
                                                                    <hr><center>
                                                                            <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                            class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                        </center>
                                                                    @else
                                                                    <hr><center><b>{{$cons->conductor}}</b></center>
                                                                    @endif
                                                                </td>
                                                                @endif
                                                                @endif
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
										<div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                            <div class="col-md-12">
                                                    <center><b>TR1-R</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #FF0080; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_m as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR1-R")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(255,0,128,.1);">
                                                                    @foreach($jornadas_m as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR1-R")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR1-R")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(255,0,128,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(255,0,128,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR1-R")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
										<div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
                                            <div class="col-md-12">
                                                    <center><b>TR3</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #008f39; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_m as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR3")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(0,143,57,.1);">
                                                                    @foreach($jornadas_m as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR3")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR3")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(0,143,57,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(0,143,57,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR3")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="tab-pane fade" id="pills-TR4-nobd" role="tabpanel" aria-labelledby="pills-TR4-tab-nobd">
                                            <div class="col-md-12">
                                                    <center><b>TR4</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #0000ff; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_m as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR4")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(0,0,255,.1);">
                                                                    @foreach($jornadas_m as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR4")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR4")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(0,0,255,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(0,0,255,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR4")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" data-target="#exampleModal"
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <div class="tab-pane fade" id="pills-TR1-S-nobd" role="tabpanel" aria-labelledby="pills-TR1-S-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR1 Sabado</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #e5be01; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_s as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR1")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(229,190,1,.1);">
                                                                    @foreach($jornadas_s as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR1")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR1")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(229,190,1,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(229,190,1,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR1")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                        </div>
									
                                            <div class="tab-pane fade" id="pills-TR1-R-S-nobd" role="tabpanel" aria-labelledby="pills-TR1-R-S-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR1-R Sabado</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #FF0080; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_s as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR1-R")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(255,0,128,.1);">
                                                                    @foreach($jornadas_s as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR1-R")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR1-R")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(255,0,128,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(255,0,128,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR1-R")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-TR3-S-nobd" role="tabpanel" aria-labelledby="pills-TR3-S-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR3 Sabado</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #008f39; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_s as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR3")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(0,143,57,.1);">
                                                                    @foreach($jornadas_s as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR3")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR3")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(0,143,57,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(0,143,57,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR3")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-TR4-S-nobd" role="tabpanel" aria-labelledby="pills-TR4-S-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR4 Sabado</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #0000ff; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_s as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR4")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(0,0,255,.1);">
                                                                    @foreach($jornadas_s as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR4")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR4")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(0,0,255,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(0,0,255,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR4")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                                <button  onclick="abrirModal_s('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="tab-pane fade" id="pills-TR1-D-nobd" role="tabpanel" aria-labelledby="pills-TR1-D-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR1 Domingo</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #e5be01; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_d as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR1")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(229,190,1,.1);">
                                                                    @foreach($jornadas_d as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR1")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                                <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR1")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(229,190,1,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(229,190,1,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR1")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                        class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
									
                                            <div class="tab-pane fade" id="pills-TR1-R-D-nobd" role="tabpanel" aria-labelledby="pills-TR1-R-D-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR1-R Domingo</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #FF0080; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_d as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR1-R")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(255,0,128,.1);">
                                                                    @foreach($jornadas_d as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR1-R")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                            <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                            class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR1-R")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(255,0,128,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(255,0,128,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR1-R")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                        class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-TR3-D-nobd" role="tabpanel" aria-labelledby="pills-TR3-D-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR3 Domingo</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #008f39; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_d as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR3")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(0,143,57,.1);">
                                                                    @foreach($jornadas_d as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR3")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                            <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                            class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR3")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(0,143,57,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(0,143,57,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                        class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR3")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                        class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-TR4-D-nobd" role="tabpanel" aria-labelledby="pills-TR4-D-tab-nobd">
                                                <div class="col-md-12">
                                                    <center><b>TR4 Domingo</b><br><br> </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered  " style="border:1px black solid;" id="list_user22">
                                                            <tbody id="llenaTablaas" style="">
                                                                @php $contador=1; @endphp
                                                                @php $contador_matutino=1; @endphp
                                                                <tr style="background-color: #0000ff; color:black; border:1px white solid; ">
                                                                    @foreach($jornadas_d as $cons)
                                                                        @if($cons->turno=="Matutino" && $cons->servicio=="TR4")
                                                                        <td >
                                                                            <center>
                                                                            <b style="size:16px; color:white;">Jornada {{$cons->jornada}}</b>
                                                                            </center>
                                                                        </td>
                                                                        @php $contador_matutino++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                                <tr style=" border:1px black solid; background-color: rgba(0,0,255,.1);">
                                                                    @foreach($jornadas_d as $cons)
                                                                    @if($cons->turno=="Matutino"  && $cons->servicio=="TR4")
                                                                    <td >
                                                                        @if($cons->conductor=="Sin conductor")
                                                                            <center>
                                                                            <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                            class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center><hr>
                                                                        @else
                                                                            <center><b>{{$cons->conductor}}</b></center><hr>
                                                                        @endif
                                                                        <center style="cursor: pointer; " class="texto-hover"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <br><b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                        </center>
                                                                    </td>
                                                                    @endif
                                                                    @if($cons->turno=="Vespertino"  && $cons->servicio=="TR4")
                                                                    @if($contador== 1)
                                                                        </tr>
                                                                        <tr style="background-color: rgba(0,0,255,1);">
                                                                            <td colspan="{{$contador_matutino}}">
                                                                                <center><b class="biper" style="color:#fff;">Cambio de turno</b></center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style=" background-color: rgba(0,0,255,.2);">
                                                                            <td >
                                                                                <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                                <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                                <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b>
                                                                                </center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                                class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @php 
                                                                    $contador=2;
                                                                    @endphp
                                                                    @elseif($cons->turno=="Vespertino"  && $cons->servicio=="TR4")
                                                                    <td >
                                                                        <center style="cursor: pointer"  onclick="ver_jornadacompleta('{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')">
                                                                        <b class="texto-hover">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->primera_salida_base)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $cons->ultima_salida_base)->format('h:i A') }}</b>
                                                                        <hr><b class="texto-hover">Ciclos {{$cons->total_ciclos}}</b><br></center>
                                                                        @if($cons->conductor=="Sin conductor")
                                                                        <hr><center>
                                                                        <button  onclick="abrirModal_d('{{$cons->id_jornada_pk}}','{{$cons->servicio}}','{{$cons->dia_servicio}}','{{$cons->turno}}','{{$cons->jornada}}')" data-toggle="modal" 
                                                                        class="btn btn-default btn-border" type="button"><i class="la flaticon-add-user"></i></button>
                                                                            </center>
                                                                        @else
                                                                        <hr><center><b>{{$cons->conductor}}</b></center>
                                                                        @endif
                                                                    </td>
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                    </div>
								</div>
					</div>



            </div>
        </div>
    </div>
    
    
    
    @section('jscustom')
    <script type="text/javascript">
        
        $('#list_user2').DataTable({
            scrollX: false,
            scrollCollapse: true,
            filter: true,
            lengthMenu: [[10,20, 30, 40, 50, -1], [10, 20, 30, 40, 50, "Todos"]],
            iDisplayLength: 10,
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
            },
            
        });
        $('#conductores').select2({
            dropdownParent: $('#exampleModal'), 
            width: '100%' 
        });
        $('#conductores_s').select2({
            dropdownParent: $('#exampleModal_s'), 
            width: '100%' 
        });
        $('#conductores_d').select2({
            dropdownParent: $('#exampleModal_d'), 
            width: '100%' 
        });
        function abrirModal(id_jornada_pk,servicio, dia_servicio, turno, jornada)
        {
            console.log(servicio);
            console.log(dia_servicio);
            console.log(turno);
            console.log(jornada);
            $('#hidden_servicio').val(servicio);
            $('#hidden_dia_servicio').val(dia_servicio);
            $('#hidden_turno').val(turno);
            $('#hidden_jornada').val(jornada);
            $('#hidden_id_jornada_pk').val(id_jornada_pk);
            var semana = $('#semana').val();
            $('#semana_hidden').val(semana);
            
            $('#modal_conductores').modal('show');
        }

        function abrirModal_s(id_jornada_pk,servicio, dia_servicio, turno, jornada)
        {
            console.log(servicio);
            console.log(dia_servicio);
            console.log(turno);
            console.log(jornada);
            $('#hidden_servicio_s').val(servicio);
            $('#hidden_dia_servicio_s').val(dia_servicio);
            $('#hidden_turno_s').val(turno);
            $('#hidden_jornada_s').val(jornada);
            $('#hidden_id_jornada_pk_s').val(id_jornada_pk);
            var semana = $('#semana').val();
            $('#semana_hidden_s').val(semana);
            
            $('#exampleModal_s').modal('show');
        }
        function abrirModal_d(id_jornada_pk,servicio, dia_servicio, turno, jornada)
        {
            console.log(servicio);
            console.log(dia_servicio);
            console.log(turno);
            console.log(jornada);
            $('#hidden_servicio_d').val(servicio);
            $('#hidden_dia_servicio_d').val(dia_servicio);
            $('#hidden_turno_d').val(turno);
            $('#hidden_jornada_d').val(jornada);
            $('#hidden_id_jornada_pk_d').val(id_jornada_pk);
            var semana = $('#semana').val();
            $('#semana_hidden_d').val(semana);
            
            $('#exampleModal_d').modal('show');
        }

        function ver_jornadacompleta(servicio, dia_servicio, turno, jornada)
        {
            $.ajax({
                url: '/buscar_horario_completo', // La ruta que hemos definido en web.php
                type: 'GET', // Método de la petición
                data:{
                    'servicio':servicio,
                    'dia_servicio':dia_servicio,
                    'turno':turno,
                    'jornada':jornada,
                },
                success: function(response) {
                    // Manejar el éxito, aquí puedes manipular el DOM o mostrar los resultados
                    console.log(response);

                    var html='';
                    var j;
                    for(var i = 0; response.length > i; i++)
                    {
                        j= i+1;
                        html+='<tr>';
                        html+='<td>'+ j + '</td>';
                        html+='<td>'+ response[i].servicio+ '</td>';
                        html+='<td>'+ response[i].jornada+ '</td>';
                        html+='<td>'+ response[i].turno+ '</td>';
                        html+='<td>'+ response[i].dia_servicio+ '</td>';
                        html+='<td>'+ response[i].salida_base+' '+ response[i].salida_mitad_recorrido + '</td>';
                        html+='</tr>';
                    }
                    $('#llenaTablamodal').html(html);
                },
                error: function(xhr, status, error) {
                    // Manejar el error
                    console.error("Ocurrió un error: " + error);
                }
            });
            $('#exampleModal2').modal('show');
        }
    </script>
    @endsection
</x-app-layout>
