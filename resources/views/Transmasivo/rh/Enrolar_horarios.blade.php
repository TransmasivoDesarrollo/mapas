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
                           
                            <div class="col-md-3">
                                <label><br>Horarios<span class="required-label"></span></label>
                                <select  id="id_horarios" name="id_horarios" class="form-control" >
                                    <option value="Sin asignar">Sin asignar</option>
                                    @foreach($consulta as $cons)
                                        <option  value="{{$cons->id_t_horarios_personal}}">{{$cons->nombre_horario}} ({{$cons->hora_llegada}} - {{$cons->hora_inicio_comida}} - {{$cons->hora_fin_comida}} - {{$cons->hora_salida}})</option>
                                        
                                       
                                    @endforeach
                                </select>
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
                            <table class="table table-bordered  " id="list_user">
                                <thead>
                                    <tr>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>#</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>Nombre empleado</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>Nombre horario</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de llegada</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de inicio comida</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de fin comida</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de salida</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus</center></th>
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
                                            <td>{{$consul->hora_llegada}}</td>
                                            <td>{{$consul->hora_inicio_comida}}</td>
                                            <td>{{$consul->hora_fin_comida}}</td>
                                            <td>{{$consul->hora_salida}}</td>
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
