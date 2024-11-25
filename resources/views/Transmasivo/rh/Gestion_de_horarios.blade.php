<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
        .custom-modal-width {
            max-width: 90%; /* Puedes ajustar el valor al porcentaje o píxeles que prefieras */
            }


	</style>
    <div class="">
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="{{url('/')}}">
					<i class="flaticon-home"></i>
		    	</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="{{url('/Solicitar_suministro')}}"><i class="la la-wrench"></i></a>
			</li>
            <li class="separator">
                <h4 class="page-title">Gestión de horarios</h4>
			</li>				
		</ul>
    </div>
    <div class=" row form-group " >
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                @if (session('mensaje'))
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        {{ session('mensaje') }}.
                    </div>
                @endif
                    <form method="post" id="contratoForm" action="{{url('/Gestion_de_horarios')}}">
                        @csrf
                        <div class="form-group row " >
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Nombre del horario <span class="required-label">*</span></label>
                                    <input required type="text"  id="nombre_h" name="nombre_h" class="form-control input-with-border" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada lunes<span class="required-label"></span></label>
                                    <select id="Jornada_l" name="Jornada_l" class="form-control" >
                                        <option>Jornada de lunes</option>
                                        <option>Jornada de lunes a martes</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada lunes<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_l" name="h_llegada_l" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida lunes<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_l" name="h_i_comida_l" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida lunes<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_l" name="h_f_comida_l" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida lunes<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_l" name="h_salida_l" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas lunes<span class="required-label"></span></label>
                                    <input type="text"  id="horas_l" name="horas_l" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada martes<span class="required-label"></span></label>
                                    <select id="Jornada_m" name="Jornada_m" class="form-control" >
                                        <option>Jornada de martes</option>
                                        <option>Jornada de martes a miércoles</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada martes<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_m" name="h_llegada_m" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida martes<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_m" name="h_i_comida_m" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida martes<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_m" name="h_f_comida_m" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida martes<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_m" name="h_salida_m" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas martes<span class="required-label"></span></label>
                                    <input type="text"  id="horas_m" name="horas_m" class="form-control" >
                                </div>
                            </div>
                            

                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada miércoles<span class="required-label"></span></label>
                                    <select id="Jornada_mi" name="Jornada_mi" class="form-control" >
                                        <option>Jornada de miércoles</option>
                                        <option>Jornada de miércoles a jueves</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada miércoles<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_mi" name="h_llegada_mi" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida miércoles<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_mi" name="h_i_comida_mi" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida miércoles<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_mi" name="h_f_comida_mi" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida miércoles<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_mi" name="h_salida_mi" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas miércoles<span class="required-label"></span></label>
                                    <input type="text"  id="horas_mi" name="horas_mi" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada jueves<span class="required-label"></span></label>
                                    <select id="Jornada_j" name="Jornada_j" class="form-control" >
                                        <option>Jornada de jueves</option>
                                        <option>Jornada de jueves a viernes</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada jueves<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_j" name="h_llegada_j" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida jueves<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_j" name="h_i_comida_j" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida jueves<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_j" name="h_f_comida_j" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida jueves<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_j" name="h_salida_j" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas jueves<span class="required-label"></span></label>
                                    <input type="text"  id="horas_j" name="horas_j" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada viernes<span class="required-label"></span></label>
                                    <select id="Jornada_v" name="Jornada_v" class="form-control" >
                                        <option>Jornada de viernes</option>
                                        <option>Jornada de viernes a sábado</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada viernes<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_v" name="h_llegada_v" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida viernes<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_v" name="h_i_comida_v" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida viernes<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_v" name="h_f_comida_v" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida viernes<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_v" name="h_salida_v" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas viernes<span class="required-label"></span></label>
                                    <input type="text"  id="horas_v" name="horas_v" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada sábado<span class="required-label"></span></label>
                                    <select id="Jornada_s" name="Jornada_s" class="form-control" >
                                        <option>Jornada de sábado</option>
                                        <option>Jornada de sábado a domingo</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada sábado<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_s" name="h_llegada_s" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida sábado<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_s" name="h_i_comida_s" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida sábado<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_s" name="h_f_comida_s" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida sábado<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_s" name="h_salida_s" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas sábado<span class="required-label"></span></label>
                                    <input type="text"  id="horas_s" name="horas_s" class="form-control" >
                                </div>
                            </div>




                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Jornada domingo<span class="required-label"></span></label>
                                    <select id="Jornada_d" name="Jornada_d" class="form-control" >
                                        <option>Jornada de domingo</option>
                                        <option>Jornada de domingo a lunes</option>
                                        <option>Descanso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora llegada domingo<span class="required-label"></span></label>
                                    <input type="time"  id="h_llegada_d" name="h_llegada_d" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Inicio de comida domingo<span class="required-label"></span></label>
                                    <input type="time"  id="h_i_comida_d" name="h_i_comida_d" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Fin de comida domingo<span class="required-label"></span></label>
                                    <input type="time"  id="h_f_comida_d" name="h_f_comida_d" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Hora salida domingo<span class="required-label"></span></label>
                                    <input type="time"  id="h_salida_d" name="h_salida_d" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas domingo<span class="required-label"></span></label>
                                    <input type="text"  id="horas_d" name="horas_d" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>&nbsp;<span class="required-label"></span></label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-default">
                                    <label>Horas trabajadas Totales<span class="required-label"></span></label>
                                    <input type="text"  id="horas_t" name="horas_t" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-12">
                                <center>
                                    <br>
                                    <input type="submit" value="Guardar horario" class="btn btn-primary" id="guardar_nuevo_horario" name="guardar_nuevo_horario">
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer">
                <div class="modal" tabindex="-1" role="dialog" id="modal_eliminar">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar horario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro de querer eliminar el horario?</p>
                        </div>
                        <div class="modal-footer">
                        <form method="post" id="contratoForm" action="{{url('/Gestion_de_horarios')}}">
                        @csrf
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="Eliminar_horario" name="Eliminar_horario" class="btn btn-primary">Eliminar</button>
                            <input type="hidden" id="id_hidden" name="id_hidden">
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover table-striped table-bordered display dataTable no-footer  " id="list_user">
                                <thead>
                                    <tr>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); "><center>#</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); "><center>Nombre horario</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Lunes</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Martes</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Miércoles</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Jueves</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Viernes</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Sábado</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Domingo</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Estatus</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55);"><center>Acción</center></th>
                                    </tr>
                                </thead>
                                <tbody id="llenaTabla">
                                    @if($consulta !== "")
                                    @php $i = 1; @endphp
                                        @foreach($consulta as $consul)
                                        <tr >
                                            <td>{{$i}}</td>
                                            <td>{{$consul->nombre_horario}}</td>
                                            <td>
                                                @if($consul->jornada_l !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_l}}<hr>
                                                    @if($consul->hora_inicio_comida_l !== null)
                                                        Comida: {{$consul->hora_inicio_comida_l}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_l}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_l}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($consul->jornada_m !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_m}}<hr>
                                                    @if($consul->hora_inicio_comida_m !== null)
                                                        Comida: {{$consul->hora_inicio_comida_m}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_m}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_m}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($consul->jornada_mi !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_mi}}<hr>
                                                    @if($consul->hora_inicio_comida_mi !== null)
                                                        Comida: {{$consul->hora_inicio_comida_mi}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_mi}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_mi}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($consul->jornada_j !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_j}}<hr>
                                                    @if($consul->hora_inicio_comida_j !== null)
                                                        Comida: {{$consul->hora_inicio_comida_j}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_j}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_j}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($consul->jornada_v !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_v}}<hr>
                                                    @if($consul->hora_inicio_comida_v !== null)
                                                        Comida: {{$consul->hora_inicio_comida_v}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_v}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_v}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($consul->jornada_s !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_s}}<hr>
                                                    @if($consul->hora_inicio_comida_s !== null)
                                                        Comida: {{$consul->hora_inicio_comida_s}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_s}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_s}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($consul->jornada_d !== "Descanso")
                                                    Llegada: {{$consul->hora_llegada_d}}<hr>
                                                    @if($consul->hora_inicio_comida_d !== null)
                                                        Comida: {{$consul->hora_inicio_comida_d}}<hr>
                                                        Fin comida: {{$consul->hora_fin_comida_d}}<hr>
                                                    @else
                                                        <b>Sin comida</b><hr>
                                                    @endif
                                                    Salida: {{$consul->hora_salida_d}}
                                                @else
                                                    <b>Descanso</b>
                                                @endif
                                            </td>
                                            <td>{{$consul->estatus}}</td>
                                            <td>
                                                <input type="submit" onclick="modalEliminar({{$consul->id_t_horarios_personal}})" class="btn btn-danger" value="Eliminar ">
                                                <hr>
                                                <input type="submit" value="Modificar" onclick="modalModificar({{$consul->id_t_horarios_personal}})"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalModificar">
                                            </td>
                                            
                                        </tr>
                                        
                                    @php $i++; @endphp
                                        @endforeach
                                    @endif                                    
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable custom-modal-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalModificarLabel">Modificar Información</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="post" id="contratoForm" action="{{url('/Gestion_de_horarios')}}">
                                            @csrf
                                            <div class="form-group row " >
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Nombre del horario <span class="required-label">*</span></label>
                                                        <input required type="text"  id="nombre_h_m" name="nombre_h_m" class="form-control input-with-border" >
                                                        <input  type="hidden"  id="id_hidden_m" name="id_hidden_m" >
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada lunes<span class="required-label"></span></label>
                                                        <select id="Jornada_l_m" name="Jornada_l_m" class="form-control" >
                                                            <option>Jornada de lunes</option>
                                                            <option>Jornada de lunes a martes</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada lunes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_l_m" name="h_llegada_l_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida lunes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_l_m" name="h_i_comida_l_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida lunes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_l_m" name="h_f_comida_l_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida lunes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_l_m" name="h_salida_l_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas lunes<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_l_m" name="horas_l_m" class="form-control" >
                                                    </div>
                                                </div>



                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada martes<span class="required-label"></span></label>
                                                        <select id="Jornada_m_m" name="Jornada_m_m" class="form-control" >
                                                            <option>Jornada de martes</option>
                                                            <option>Jornada de martes a miércoles</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada martes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_m_m" name="h_llegada_m_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida martes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_m_m" name="h_i_comida_m_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida martes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_m_m" name="h_f_comida_m_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida martes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_m_m" name="h_salida_m_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas martes<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_m_m" name="horas_m_m" class="form-control" >
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada miércoles<span class="required-label"></span></label>
                                                        <select id="Jornada_mi_m" name="Jornada_mi_m" class="form-control" >
                                                            <option>Jornada de miércoles</option>
                                                            <option>Jornada de miércoles a jueves</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada miércoles<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_mi_m" name="h_llegada_mi_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida miércoles<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_mi_m" name="h_i_comida_mi_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida miércoles<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_mi_m" name="h_f_comida_mi_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida miércoles<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_mi_m" name="h_salida_mi_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas miércoles<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_mi_m" name="horas_mi_m" class="form-control" >
                                                    </div>
                                                </div>



                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada jueves<span class="required-label"></span></label>
                                                        <select id="Jornada_j_m" name="Jornada_j_m" class="form-control" >
                                                            <option>Jornada de jueves</option>
                                                            <option>Jornada de jueves a viernes</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada jueves<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_j_m" name="h_llegada_j_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida jueves<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_j_m" name="h_i_comida_j_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida jueves<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_j_m" name="h_f_comida_j_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida jueves<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_j_m" name="h_salida_j_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas jueves<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_j_m" name="horas_j_m" class="form-control" >
                                                    </div>
                                                </div>


                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada viernes<span class="required-label"></span></label>
                                                        <select id="Jornada_v_m" name="Jornada_v_m" class="form-control" >
                                                            <option>Jornada de viernes</option>
                                                            <option>Jornada de viernes a sábado</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada viernes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_v_m" name="h_llegada_v_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida viernes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_v_m" name="h_i_comida_v_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida viernes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_v_m" name="h_f_comida_v_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida viernes<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_v_m" name="h_salida_v_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas viernes<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_v_m" name="horas_v_m" class="form-control" >
                                                    </div>
                                                </div>



                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada sábado<span class="required-label"></span></label>
                                                        <select id="Jornada_s_m" name="Jornada_s_m" class="form-control" >
                                                            <option>Jornada de sábado</option>
                                                            <option>Jornada de sábado a domingo</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada sábado<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_s_m" name="h_llegada_s_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida sábado<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_s_m" name="h_i_comida_s_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida sábado<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_s_m" name="h_f_comida_s_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida sábado<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_s_m" name="h_salida_s_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas sábado<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_s_m" name="horas_s_m" class="form-control" >
                                                    </div>
                                                </div>




                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Jornada domingo<span class="required-label"></span></label>
                                                        <select id="Jornada_d_m" name="Jornada_d_m" class="form-control" >
                                                            <option>Jornada de domingo</option>
                                                            <option>Jornada de domingo a lunes</option>
                                                            <option>Descanso</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora llegada domingo<span class="required-label"></span></label>
                                                        <input type="time"  id="h_llegada_d_m" name="h_llegada_d_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Inicio de comida domingo<span class="required-label"></span></label>
                                                        <input type="time"  id="h_i_comida_d_m" name="h_i_comida_d_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Fin de comida domingo<span class="required-label"></span></label>
                                                        <input type="time"  id="h_f_comida_d_m" name="h_f_comida_d_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Hora salida domingo<span class="required-label"></span></label>
                                                        <input type="time"  id="h_salida_d_m" name="h_salida_d_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas domingo<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_d_m" name="horas_d_m" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <label>&nbsp;<span class="required-label"></span></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label>Horas trabajadas Totales<span class="required-label"></span></label>
                                                        <input type="text"  id="horas_t_m" name="horas_t_m" class="form-control" >
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Guardar Cambios" id="Guardar_cambio" name="Guardar_cambio">
                                        </div>
                                        
                                        </form>
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
    
    function modalEliminar(id)
    {
        
        $('#id_hidden').val(id);
        $('#modal_eliminar').modal('show');
    }

    $(document).ready(function() {
        function calcula_total(){
            var horas_l = $('#horas_l').val();
            var horas_m = $('#horas_m').val();
            var horas_mi = $('#horas_mi').val();
            var horas_j = $('#horas_j').val();
            var horas_v = $('#horas_v').val();
            var horas_s = $('#horas_s').val();
            var horas_d = $('#horas_d').val();
            var horas_t=0;
           if(horas_l)
           {
                var horas = horas_l.substring(0,2);
                var minutos = horas_l.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           if(horas_m)
           {
                var horas = horas_m.substring(0,2);
                var minutos = horas_m.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           if(horas_mi)
           {
                var horas = horas_mi.substring(0,2);
                var minutos = horas_mi.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           if(horas_j)
           {
                var horas = horas_j.substring(0,2);
                var minutos = horas_j.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           if(horas_v)
           {
                var horas = horas_v.substring(0,2);
                var minutos = horas_v.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           if(horas_s)
           {
                var horas = horas_s.substring(0,2);
                var minutos = horas_s.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           if(horas_d)
           {
                var horas = horas_d.substring(0,2);
                var minutos = horas_d.substring(7,3);
                horas_t += (parseInt(horas) * 60 ) + parseInt(minutos);
           }
           
           var horas_totales = formatearHoras(horas_t);
            $('#horas_t').val(horas_totales);
           
        }
        function formatearHoras(minutos)
        {
            var horas = Math.floor(minutos/60);
            var restante = minutos % 60;
           
            return horas+ ' horas con '+restante+ ' minutos';
        }
        $('#Jornada_l, #h_llegada_l, #h_i_comida_l, #h_f_comida_l, #h_salida_l').on('change', function() {
            var jornada = $('#Jornada_l').val();
            var horaLlegada = $('#h_llegada_l').val();
            var inicioComida = $('#h_i_comida_l').val();
            var finComida = $('#h_f_comida_l').val();
            var horaSalida = $('#h_salida_l').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de lunes a martes') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de lunes a martes' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                console.log(formattedHours);
                console.log(formattedMinutes);
                $('#horas_l').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });


        $('#Jornada_m, #h_llegada_m, #h_i_comida_m, #h_f_comida_m, #h_salida_m').on('change', function() {
            var jornada = $('#Jornada_m').val();
            var horaLlegada = $('#h_llegada_m').val();
            var inicioComida = $('#h_i_comida_m').val();
            var finComida = $('#h_f_comida_m').val();
            var horaSalida = $('#h_salida_m').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de martes a miércoles') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de martes a miércoles' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                $('#horas_m').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });
        $('#Jornada_mi, #h_llegada_mi, #h_i_comida_mi, #h_f_comida_mi, #h_salida_mi').on('change', function() {
            var jornada = $('#Jornada_mi').val();
            var horaLlegada = $('#h_llegada_mi').val();
            var inicioComida = $('#h_i_comida_mi').val();
            var finComida = $('#h_f_comida_mi').val();
            var horaSalida = $('#h_salida_mi').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de miércoles a jueves') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de miércoles a jueves' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                $('#horas_mi').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });
        
        $('#Jornada_j, #h_llegada_j, #h_i_comida_j, #h_f_comida_j, #h_salida_j').on('change', function() {
            var jornada = $('#Jornada_j').val();
            var horaLlegada = $('#h_llegada_j').val();
            var inicioComida = $('#h_i_comida_j').val();
            var finComida = $('#h_f_comida_j').val();
            var horaSalida = $('#h_salida_j').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de jueves a viernes') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de jueves a viernes' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                $('#horas_j').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });
        $('#Jornada_v, #h_llegada_v, #h_i_comida_v, #h_f_comida_v, #h_salida_v').on('change', function() {
            var jornada = $('#Jornada_v').val();
            var horaLlegada = $('#h_llegada_v').val();
            var inicioComida = $('#h_i_comida_v').val();
            var finComida = $('#h_f_comida_v').val();
            var horaSalida = $('#h_salida_v').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de viernes a sábado') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de viernes a sábado' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                $('#horas_v').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });
        $('#Jornada_s, #h_llegada_s, #h_i_comida_s, #h_f_comida_s, #h_salida_s').on('change', function() {
            var jornada = $('#Jornada_s').val();
            var horaLlegada = $('#h_llegada_s').val();
            var inicioComida = $('#h_i_comida_s').val();
            var finComida = $('#h_f_comida_s').val();
            var horaSalida = $('#h_salida_s').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de sábado a domingo') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de sábado a domingo' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                $('#horas_s').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });
        $('#Jornada_d, #h_llegada_d, #h_i_comida_d, #h_f_comida_d, #h_salida_d').on('change', function() {
            var jornada = $('#Jornada_d').val();
            var horaLlegada = $('#h_llegada_d').val();
            var inicioComida = $('#h_i_comida_d').val();
            var finComida = $('#h_f_comida_d').val();
            var horaSalida = $('#h_salida_d').val();
            if (horaLlegada && horaSalida) {
                var inicio = new Date('1970-01-01T' + horaLlegada + ':00');
                var fin = new Date('1970-01-01T' + horaSalida + ':00');
                if (jornada === 'Jornada de domingo a lunes') {
                    fin = new Date('1970-01-02T' + horaSalida + ':00'); // Sumar un día al fin
                }
                var tiempoTrabajadoMs = fin - inicio; // Diferencia en milisegundos
                var tiempoTrabajadoHoras = Math.floor(tiempoTrabajadoMs / (1000 * 60 * 60)); // Horas completas
                var tiempoTrabajadoMinutos = Math.floor((tiempoTrabajadoMs % (1000 * 60 * 60)) / (1000 * 60)); // Minutos restantes
                if (inicioComida && finComida) {
                    var inicioComidaDate = new Date('1970-01-01T' + inicioComida + ':00');
                    var finComidaDate = new Date('1970-01-01T' + finComida + ':00');
                    if (jornada === 'Jornada de domingo a lunes' && finComidaDate < inicioComidaDate) {
                        finComidaDate = new Date('1970-01-02T' + finComida + ':00');
                    }
                    var tiempoComidaMs = finComidaDate - inicioComidaDate; // Tiempo de comida en milisegundos
                    var tiempoComidaHoras = Math.floor(tiempoComidaMs / (1000 * 60 * 60));
                    var tiempoComidaMinutos = Math.floor((tiempoComidaMs % (1000 * 60 * 60)) / (1000 * 60));
                    tiempoTrabajadoHoras -= tiempoComidaHoras;
                    tiempoTrabajadoMinutos -= tiempoComidaMinutos;
                    if (tiempoTrabajadoMinutos < 0) {
                        tiempoTrabajadoHoras -= 1;
                        tiempoTrabajadoMinutos += 60;
                    }
                }
                var formattedHours = tiempoTrabajadoHoras.toString().padStart(2, '0');
                var formattedMinutes = tiempoTrabajadoMinutos.toString().padStart(2, '0');
                $('#horas_d').val(`${formattedHours}:${formattedMinutes}`);
                calcula_total();
            }
        });
        $('#Jornada_l').on('change', function() {
            if ($('#Jornada_l').val() == "Descanso") {
                $('#h_llegada_l').attr('disabled', true);
                $('#h_i_comida_l').attr('disabled', true);
                $('#h_f_comida_l').attr('disabled', true);
                $('#h_salida_l').attr('disabled', true);
                $('#horas_l').attr('disabled', true);
            } else {
                $('#h_llegada_l').removeAttr('disabled');
                $('#h_i_comida_l').removeAttr('disabled');
                $('#h_f_comida_l').removeAttr('disabled');
                $('#h_salida_l').removeAttr('disabled');
                $('#horas_l').removeAttr('disabled');
            }
        });
        $('#Jornada_m').on('change', function() {
            if ($('#Jornada_m').val() == "Descanso") {
                $('#h_llegada_m').attr('disabled', true);
                $('#h_i_comida_m').attr('disabled', true);
                $('#h_f_comida_m').attr('disabled', true);
                $('#h_salida_m').attr('disabled', true);
                $('#horas_m').attr('disabled', true);
            } else {
                $('#h_llegada_m').removeAttr('disabled');
                $('#h_i_comida_m').removeAttr('disabled');
                $('#h_f_comida_m').removeAttr('disabled');
                $('#h_salida_m').removeAttr('disabled');
                $('#horas_m').removeAttr('disabled');
            }
        });
        $('#Jornada_mi').on('change', function() {
            if ($('#Jornada_mi').val() == "Descanso") {
                $('#h_llegada_mi').attr('disabled', true);
                $('#h_i_comida_mi').attr('disabled', true);
                $('#h_f_comida_mi').attr('disabled', true);
                $('#h_salida_mi').attr('disabled', true);
                $('#horas_mi').attr('disabled', true);
            } else {
                $('#h_llegada_mi').removeAttr('disabled');
                $('#h_i_comida_mi').removeAttr('disabled');
                $('#h_f_comida_mi').removeAttr('disabled');
                $('#h_salida_mi').removeAttr('disabled');
                $('#horas_mi').removeAttr('disabled');
            }
        });
        $('#Jornada_j').on('change', function() {
            if ($('#Jornada_j').val() == "Descanso") {
                $('#h_llegada_j').attr('disabled', true);
                $('#h_i_comida_j').attr('disabled', true);
                $('#h_f_comida_j').attr('disabled', true);
                $('#h_salida_j').attr('disabled', true);
                $('#horas_j').attr('disabled', true);
            } else {
                $('#h_llegada_j').removeAttr('disabled');
                $('#h_i_comida_j').removeAttr('disabled');
                $('#h_f_comida_j').removeAttr('disabled');
                $('#h_salida_j').removeAttr('disabled');
                $('#horas_j').removeAttr('disabled');
            }
        });
        $('#Jornada_v').on('change', function() {
            if ($('#Jornada_v').val() == "Descanso") {
                $('#h_llegada_v').attr('disabled', true);
                $('#h_i_comida_v').attr('disabled', true);
                $('#h_f_comida_v').attr('disabled', true);
                $('#h_salida_v').attr('disabled', true);
                $('#horas_v').attr('disabled', true);
            } else {
                $('#h_llegada_v').removeAttr('disabled');
                $('#h_i_comida_v').removeAttr('disabled');
                $('#h_f_comida_v').removeAttr('disabled');
                $('#h_salida_v').removeAttr('disabled');
                $('#horas_v').removeAttr('disabled');
            }
        });
        $('#Jornada_s').on('change', function() {
            if ($('#Jornada_s').val() == "Descanso") {
                $('#h_llegada_s').attr('disabled', true);
                $('#h_i_comida_s').attr('disabled', true);
                $('#h_f_comida_s').attr('disabled', true);
                $('#h_salida_s').attr('disabled', true);
                $('#horas_s').attr('disabled', true);
            } else {
                $('#h_llegada_s').removeAttr('disabled');
                $('#h_i_comida_s').removeAttr('disabled');
                $('#h_f_comida_s').removeAttr('disabled');
                $('#h_salida_s').removeAttr('disabled');
                $('#horas_s').removeAttr('disabled');
            }
        });
        $('#Jornada_d').on('change', function() {
            if ($('#Jornada_d').val() == "Descanso") {
                $('#h_llegada_d').attr('disabled', true);
                $('#h_i_comida_d').attr('disabled', true);
                $('#h_f_comida_d').attr('disabled', true);
                $('#h_salida_d').attr('disabled', true);
                $('#horas_d').attr('disabled', true);
            } else {
                $('#h_llegada_d').removeAttr('disabled');
                $('#h_i_comida_d').removeAttr('disabled');
                $('#h_f_comida_d').removeAttr('disabled');
                $('#h_salida_d').removeAttr('disabled');
                $('#horas_d').removeAttr('disabled');
            }
        });


        $('#Jornada_l_m').on('change', function() {
            if ($('#Jornada_l_m').val() == "Descanso") {
                $('#h_llegada_l_m').attr('disabled', true);
                $('#h_i_comida_l_m').attr('disabled', true);
                $('#h_f_comida_l_m').attr('disabled', true);
                $('#h_salida_l_m').attr('disabled', true);
                $('#horas_l_m').attr('disabled', true);
            } else {
                $('#h_llegada_l_m').removeAttr('disabled');
                $('#h_i_comida_l_m').removeAttr('disabled');
                $('#h_f_comida_l_m').removeAttr('disabled');
                $('#h_salida_l_m').removeAttr('disabled');
                $('#horas_l_m').removeAttr('disabled');
            }
        });
        $('#Jornada_m_m').on('change', function() {
            if ($('#Jornada_m_m').val() == "Descanso") {
                $('#h_llegada_m_m').attr('disabled', true);
                $('#h_i_comida_m_m').attr('disabled', true);
                $('#h_f_comida_m_m').attr('disabled', true);
                $('#h_salida_m_m').attr('disabled', true);
                $('#horas_m_m').attr('disabled', true);
            } else {
                $('#h_llegada_m_m').removeAttr('disabled');
                $('#h_i_comida_m_m').removeAttr('disabled');
                $('#h_f_comida_m_m').removeAttr('disabled');
                $('#h_salida_m_m').removeAttr('disabled');
                $('#horas_m_m').removeAttr('disabled');
            }
        });
        $('#Jornada_mi_m').on('change', function() {
            if ($('#Jornada_mi_m').val() == "Descanso") {
                $('#h_llegada_mi_m').attr('disabled', true);
                $('#h_i_comida_mi_m').attr('disabled', true);
                $('#h_f_comida_mi_m').attr('disabled', true);
                $('#h_salida_mi_m').attr('disabled', true);
                $('#horas_mi_m').attr('disabled', true);
            } else {
                $('#h_llegada_mi_m').removeAttr('disabled');
                $('#h_i_comida_mi_m').removeAttr('disabled');
                $('#h_f_comida_mi_m').removeAttr('disabled');
                $('#h_salida_mi_m').removeAttr('disabled');
                $('#horas_mi_m').removeAttr('disabled');
            }
        });
        $('#Jornada_j_m').on('change', function() {
            if ($('#Jornada_j_m').val() == "Descanso") {
                $('#h_llegada_j_m').attr('disabled', true);
                $('#h_i_comida_j_m').attr('disabled', true);
                $('#h_f_comida_j_m').attr('disabled', true);
                $('#h_salida_j_m').attr('disabled', true);
                $('#horas_j_m').attr('disabled', true);
            } else {
                $('#h_llegada_j_m').removeAttr('disabled');
                $('#h_i_comida_j_m').removeAttr('disabled');
                $('#h_f_comida_j_m').removeAttr('disabled');
                $('#h_salida_j_m').removeAttr('disabled');
                $('#horas_j_m').removeAttr('disabled');
            }
        });
        $('#Jornada_v_m').on('change', function() {
            if ($('#Jornada_v_m').val() == "Descanso") {
                $('#h_llegada_v_m').attr('disabled', true);
                $('#h_i_comida_v_m').attr('disabled', true);
                $('#h_f_comida_v_m').attr('disabled', true);
                $('#h_salida_v_m').attr('disabled', true);
                $('#horas_v_m').attr('disabled', true);
            } else {
                $('#h_llegada_v_m').removeAttr('disabled');
                $('#h_i_comida_v_m').removeAttr('disabled');
                $('#h_f_comida_v_m').removeAttr('disabled');
                $('#h_salida_v_m').removeAttr('disabled');
                $('#horas_v_m').removeAttr('disabled');
            }
        });
        $('#Jornada_s_m').on('change', function() {
            if ($('#Jornada_s_m').val() == "Descanso") {
                $('#h_llegada_s_m').attr('disabled', true);
                $('#h_i_comida_s_m').attr('disabled', true);
                $('#h_f_comida_s_m').attr('disabled', true);
                $('#h_salida_s_m').attr('disabled', true);
                $('#horas_s_m').attr('disabled', true);
            } else {
                $('#h_llegada_s_m').removeAttr('disabled');
                $('#h_i_comida_s_m').removeAttr('disabled');
                $('#h_f_comida_s_m').removeAttr('disabled');
                $('#h_salida_s_m').removeAttr('disabled');
                $('#horas_s_m').removeAttr('disabled');
            }
        });
        $('#Jornada_d_m').on('change', function() {
            if ($('#Jornada_d_m').val() == "Descanso") {
                $('#h_llegada_d_m').attr('disabled', true);
                $('#h_i_comida_d_m').attr('disabled', true);
                $('#h_f_comida_d_m').attr('disabled', true);
                $('#h_salida_d_m').attr('disabled', true);
                $('#horas_d_m').attr('disabled', true);
            } else {
                $('#h_llegada_d_m').removeAttr('disabled');
                $('#h_i_comida_d_m').removeAttr('disabled');
                $('#h_f_comida_d_m').removeAttr('disabled');
                $('#h_salida_d_m').removeAttr('disabled');
                $('#horas_d_m').removeAttr('disabled');
            }
        });
    });


    function modalModificar(id)
    {
        $.ajax({
            url: '{{url("/Gestion_de_horarios_por_id")}}', // Reemplaza con la URL de tu endpoint
            type: 'get', // Puedes cambiar a POST si es necesario
            data: {
                'id': id, 
                },
                success: function(response) {
                    console.log(response);
                    $('#id_hidden_m').val(id);
                    $('#nombre_h_m').val(response[0].nombre_horario);

                    $('#Jornada_l_m').val(response[0].jornada_l);
                    $('#h_llegada_l_m').val(response[0].hora_llegada_l);
                    $('#h_i_comida_l_m').val(response[0].hora_inicio_comida_l);
                    $('#h_f_comida_l_m').val(response[0].hora_fin_comida_l);
                    $('#h_salida_l_m').val(response[0].hora_salida_l);
                    
                    $('#Jornada_m_m').val(response[0].jornada_m);
                    $('#h_llegada_m_m').val(response[0].hora_llegada_m);
                    $('#h_i_comida_m_m').val(response[0].hora_inicio_comida_m);
                    $('#h_f_comida_m_m').val(response[0].hora_fin_comida_m);
                    $('#h_salida_m_m').val(response[0].hora_salida_m);
                    
                    $('#Jornada_mi_m').val(response[0].jornada_mi);
                    $('#h_llegada_mi_m').val(response[0].hora_llegada_mi);
                    $('#h_i_comida_mi_m').val(response[0].hora_inicio_comida_mi);
                    $('#h_f_comida_mi_m').val(response[0].hora_fin_comida_mi);
                    $('#h_salida_mi_m').val(response[0].hora_salida_mi);
                    
                    $('#Jornada_j_m').val(response[0].jornada_j);
                    $('#h_llegada_j_m').val(response[0].hora_llegada_j);
                    $('#h_i_comida_j_m').val(response[0].hora_inicio_comida_j);
                    $('#h_f_comida_j_m').val(response[0].hora_fin_comida_j);
                    $('#h_salida_j_m').val(response[0].hora_salida_j);
                    
                    $('#Jornada_v_m').val(response[0].jornada_v);
                    $('#h_llegada_v_m').val(response[0].hora_llegada_v);
                    $('#h_i_comida_v_m').val(response[0].hora_inicio_comida_v);
                    $('#h_f_comida_v_m').val(response[0].hora_fin_comida_v);
                    $('#h_salida_v_m').val(response[0].hora_salida_v);
                    
                    $('#Jornada_s_m').val(response[0].jornada_s);
                    $('#h_llegada_s_m').val(response[0].hora_llegada_s);
                    $('#h_i_comida_s_m').val(response[0].hora_inicio_comida_s);
                    $('#h_f_comida_s_m').val(response[0].hora_fin_comida_s);
                    $('#h_salida_s_m').val(response[0].hora_salida_s);
                    
                    $('#Jornada_d_m').val(response[0].jornada_d);
                    $('#h_llegada_d_m').val(response[0].hora_llegada_d);
                    $('#h_i_comida_d_m').val(response[0].hora_inicio_comida_d);
                    $('#h_f_comida_d_m').val(response[0].hora_fin_comida_d);
                    $('#h_salida_d_m').val(response[0].hora_salida_d);

                    if ($('#Jornada_l_m').val() == "Descanso") {
                        $('#h_llegada_l_m').attr('disabled', true);
                        $('#h_i_comida_l_m').attr('disabled', true);
                        $('#h_f_comida_l_m').attr('disabled', true);
                        $('#h_salida_l_m').attr('disabled', true);
                        $('#horas_l_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_l_m').removeAttr('disabled');
                        $('#h_i_comida_l_m').removeAttr('disabled');
                        $('#h_f_comida_l_m').removeAttr('disabled');
                        $('#h_salida_l_m').removeAttr('disabled');
                        $('#horas_l_m').removeAttr('disabled');
                    }
                    if ($('#Jornada_m_m').val() == "Descanso") {
                        $('#h_llegada_m_m').attr('disabled', true);
                        $('#h_i_comida_m_m').attr('disabled', true);
                        $('#h_f_comida_m_m').attr('disabled', true);
                        $('#h_salida_m_m').attr('disabled', true);
                        $('#horas_m_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_m_m').removeAttr('disabled');
                        $('#h_i_comida_m_m').removeAttr('disabled');
                        $('#h_f_comida_m_m').removeAttr('disabled');
                        $('#h_salida_m_m').removeAttr('disabled');
                        $('#horas_m_m').removeAttr('disabled');
                    }
                    if ($('#Jornada_mi_m').val() == "Descanso") {
                        $('#h_llegada_mi_m').attr('disabled', true);
                        $('#h_i_comida_mi_m').attr('disabled', true);
                        $('#h_f_comida_mi_m').attr('disabled', true);
                        $('#h_salida_mi_m').attr('disabled', true);
                        $('#horas_mi_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_mi_m').removeAttr('disabled');
                        $('#h_i_comida_mi_m').removeAttr('disabled');
                        $('#h_f_comida_mi_m').removeAttr('disabled');
                        $('#h_salida_mi_m').removeAttr('disabled');
                        $('#horas_mi_m').removeAttr('disabled');
                    }
                    if ($('#Jornada_j_m').val() == "Descanso") {
                        $('#h_llegada_j_m').attr('disabled', true);
                        $('#h_i_comida_j_m').attr('disabled', true);
                        $('#h_f_comida_j_m').attr('disabled', true);
                        $('#h_salida_j_m').attr('disabled', true);
                        $('#horas_j_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_j_m').removeAttr('disabled');
                        $('#h_i_comida_j_m').removeAttr('disabled');
                        $('#h_f_comida_j_m').removeAttr('disabled');
                        $('#h_salida_j_m').removeAttr('disabled');
                        $('#horas_j_m').removeAttr('disabled');
                    }
                    if ($('#Jornada_v_m').val() == "Descanso") {
                        $('#h_llegada_v_m').attr('disabled', true);
                        $('#h_i_comida_v_m').attr('disabled', true);
                        $('#h_f_comida_v_m').attr('disabled', true);
                        $('#h_salida_v_m').attr('disabled', true);
                        $('#horas_v_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_v_m').removeAttr('disabled');
                        $('#h_i_comida_v_m').removeAttr('disabled');
                        $('#h_f_comida_v_m').removeAttr('disabled');
                        $('#h_salida_v_m').removeAttr('disabled');
                        $('#horas_v_m').removeAttr('disabled');
                    }
                    if ($('#Jornada_s_m').val() == "Descanso") {
                        $('#h_llegada_s_m').attr('disabled', true);
                        $('#h_i_comida_s_m').attr('disabled', true);
                        $('#h_f_comida_s_m').attr('disabled', true);
                        $('#h_salida_s_m').attr('disabled', true);
                        $('#horas_s_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_s_m').removeAttr('disabled');
                        $('#h_i_comida_s_m').removeAttr('disabled');
                        $('#h_f_comida_s_m').removeAttr('disabled');
                        $('#h_salida_s_m').removeAttr('disabled');
                        $('#horas_s_m').removeAttr('disabled');
                    }
                    if ($('#Jornada_d_m').val() == "Descanso") {
                        $('#h_llegada_d_m').attr('disabled', true);
                        $('#h_i_comida_d_m').attr('disabled', true);
                        $('#h_f_comida_d_m').attr('disabled', true);
                        $('#h_salida_d_m').attr('disabled', true);
                        $('#horas_d_m').attr('disabled', true);
                    } else {
                        $('#h_llegada_d_m').removeAttr('disabled');
                        $('#h_i_comida_d_m').removeAttr('disabled');
                        $('#h_f_comida_d_m').removeAttr('disabled');
                        $('#h_salida_d_m').removeAttr('disabled');
                        $('#horas_d_m').removeAttr('disabled');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud:', error);
                }
        });

        $('#modalModificar').modal('show');
    }

	
</script>
@endsection
</x-app-layout>
