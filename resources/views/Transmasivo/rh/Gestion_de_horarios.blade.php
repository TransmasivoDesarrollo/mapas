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
                        <div class=" row form-group " >
                            <div class="col-md-3">
                                <label><br>Nombre del horario<span class="required-label"></span></label>
                                <input type="text"  id="nombre_h" name="nombre_h" class="form-control" >
                                    
                            </div>
                            <div class="col-md-2">
                                <label><br>Hora llegada<span class="required-label"></span></label>
                                <input type="time"  id="h_llegada" name="h_llegada" class="form-control" >
                                    
                            </div>
                            <div class="col-md-2">
                                <label><br>Hora de inicio de comida<span class="required-label"></span></label>
                                <input type="time"  id="h_i_comida" name="h_i_comida" class="form-control" >
                                    
                            </div>
                            <div class="col-md-2">
                                <label><br>Hora de fin de comida<span class="required-label"></span></label>
                                <input type="time"  id="h_f_comida" name="h_f_comida" class="form-control" >
                                    
                            </div>
                            <div class="col-md-2">
                                <label><br>Hora salida<span class="required-label"></span></label>
                                <input type="time"  id="h_salida" name="h_salida" class="form-control" >
                                    
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
                    <div class="col-md-12">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-bordered  " id="list_user">
                                <thead>
                                    <tr>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>#</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%; "><center>Nombre horario</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de llegada</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de inicio comida</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de fin comida</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de salida</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus</center></th>
                                    </tr>
                                </thead>
                                <tbody id="llenaTabla">
                                    @if($consulta !== "")
                                    @php $i = 1; @endphp
                                        @foreach($consulta as $consul)
                                        <tr >
                                            <td>{{$i}}</td>
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
