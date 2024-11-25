<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
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
                <h4 class="page-title">Enrolar horarios</h4>
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
                    <form method="post" id="contratoForm" action="{{url('/Enrolar_horarios')}}">
                        @csrf
                        <div class=" row form-group " >
                            <div class="col-md-2">
                                <div class="form-group form-group-default">
                                    <label><br>ID empleado <span class="required-label"></span></label>
                                    <select  id="id_empleado" name="id_empleado" class="form-control" >
                                        <option value="-Selecciona-">-Selecciona-</option>
                                        @foreach($elementos as $elemento)
                                            @if($elemento->id_elemento == ''||$elemento->id_elemento == null)
                                            @else
                                                @if($elemento->id_elemento == $id_ele)
                                                    <option selected value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>
                                                @else
                                                    <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                                @endif
                                            @endif
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="form-group form-group-default">
                                    <label><br>Horarios<span class="required-label"></span></label>
                                    <select  id="id_horarios" name="id_horarios" class="form-control" >
                                        <option value="Sin asignar">Sin asignar</option>
                                        @foreach($consulta as $cons)
                                            <option  value="{{$cons->id_t_horarios_personal}}">{{$cons->nombre_horario}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-group-default">
                                    <label><br>Día que comienza a aplicar <span class="required-label"></span></label>
                                    <input type="date" id="dia_aplica" name="dia_aplica" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <br>
                                    <input type="submit" value="Registrar" class="btn btn-primary" id="registrar" name="registrar">
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer">
                    <div class="col-md-12">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover table-striped table-bordered display dataTable no-footer  " id="list_user">
                                <thead>
                                    <tr>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>#</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Nombre empleado</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Nombre horario</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Fecha de que aplica</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Lunes</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Martes</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Miércoles</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Jueves</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Viernes</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Sábado</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Domingo</center></th>
                                        <th class=" sorting" style="color: rgb(255, 255, 255); background-color: rgb(135, 38, 55); width: 322.984px;"><center>Estatus</center></th>
                                    </tr>
                                </thead>
                                <tbody id="llenaTabla">
                                    @if($consulta_tabla !== "")
                                    @php $i = 1; @endphp
                                        @foreach($consulta_tabla as $consul)
                                        <tr >
                                            <td>{{$i}}</td>
                                            <td>{{$consul->id_empleado}} - {{$consul->name}}</td>
                                            <td>{{$consul->nombre_horario}}</td>
                                            <td>{{$consul->fecha_inicio}}</td>
                                            @if($consul->jornada_l == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_l}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_l}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_l}}<hr>
                                                    Salida: {{$consul->hora_salida_l}}
                                                </td>
                                            @endif
                                            @if($consul->jornada_m == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_m}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_m}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_m}}<hr>
                                                    Salida: {{$consul->hora_salida_m}}
                                                </td>
                                            @endif
                                            @if($consul->jornada_mi == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_mi}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_mi}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_mi}}<hr>
                                                    Salida: {{$consul->hora_salida_mi}}
                                                </td>
                                            @endif
                                            @if($consul->jornada_j == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_j}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_j}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_j}}<hr>
                                                    Salida: {{$consul->hora_salida_j}}
                                                </td>
                                            @endif
                                            @if($consul->jornada_v == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_v}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_v}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_v}}<hr>
                                                    Salida: {{$consul->hora_salida_v}}
                                                </td>
                                            @endif
                                            @if($consul->jornada_s == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_s}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_s}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_s}}<hr>
                                                    Salida: {{$consul->hora_salida_s}}
                                                </td>
                                            @endif
                                            @if($consul->jornada_d == "Descanso")
                                                <td>
                                                    Descanso
                                                </td>
                                            @else
                                                <td>Llegada: {{$consul->hora_llegada_d}}<hr>
                                                    Comida inicio: {{$consul->hora_inicio_comida_d}}<hr>
                                                    Comida fin: {{$consul->hora_fin_comida_d}}<hr>
                                                    Salida: {{$consul->hora_salida_d}}
                                                </td>
                                            @endif
                                            
                                            <td>{{$consul->estatus}}</td>
                                        </tr>
                                    @php $i++; @endphp
                                        @endforeach
                                    @endif                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        
    </div>

	



@section('jscustom')
<script type="text/javascript">
    
    
	
</script>
@endsection
</x-app-layout>
