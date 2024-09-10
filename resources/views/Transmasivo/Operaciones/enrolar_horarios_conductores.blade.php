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
                            $semanaValue = "'$startOfWeek 00:00:00' AND '$endOfWeek 23:59:59'";
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
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="flaticon-user"></i>
											</div>
										</div>
										<div class="col-8 col-stats">
											<div class="numbers">
												<p class="card-category">Conductores enrolados</p>
												<h4 class="card-title">{{$conductores_enrolados}} de {{$conductores_totales}}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="la la-bus"></i>
											</div>
										</div>
										<div class="col-8 col-stats">
											<div class="numbers">
												<p class="card-category">Servicio TR1</p>
												<h4 class="card-title">{{$conductores_enrolados}} de 30</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="la la-bus"></i>
											</div>
										</div>
										<div class="col-8 col-stats">
											<div class="numbers">
												<p class="card-category">Servicio TR3</p>
												<h4 class="card-title">{{$conductores_enrolados}} de 34</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="la la-bus"></i>
											</div>
										</div>
										<div class="col-8 col-stats">
											<div class="numbers">
												<p class="card-category">Servicio TR4</p>
												<h4 class="card-title">{{$conductores_enrolados}} de 30</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
                    </div>
                   
                            <div class="col-md-5">
                            <form method="post" id="contratoForm" action="{{url('/enrolar_horarios_conductores')}}">
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
                                <form method="post" id="contratoForm" action="{{url('/enrolar_horarios_conductores')}}">
                                @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Enrolar conductor </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="hidden_id_rol_operador" name="hidden_id_rol_operador">
                                        <input type="hidden" id="semana_hidden" name="semana_hidden">
                                        <div class="col-md-12">
                                            <label>Conductores <span class="required-label"></span></label>
                                            <select style="border:1px black solid;" class="form-control" id="conductores" name="conductores">
                                                @foreach ($conductores as $conductor)
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
                           


                    <div class="col-md-12">
                        <div class="table-responsive" >
                            <table class="table table-bordered  " id="list_user2">
                                <thead>
                                    <tr>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 3%;"><center>#</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 13%;"><center>Conductor</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Servicio</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Posición</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 4%;"><center>Ciclos</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 4%;"><center>Turno</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Lunes</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Martes</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Miercoles</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Jueves</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Viernes</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Sabado</center></th>
                                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Domingo</center></th>
                                    </tr>
                                </thead>
                                <tbody id="llenaTabla">
                                    @foreach($consulta as $cons)
                                    @if($cons->servicio=="TR3-R")
                                         <tr style="background-color: rgba(228, 0, 124,.3);">
                                    @endif
                                    @if($cons->servicio=="TR3")
                                         <tr style="background-color: rgba(0, 128, 0,.2);">
                                    @endif
                                    @if($cons->servicio=="TR1")
                                         <tr style="background-color: rgba(255, 255, 0,.2);">
                                    @endif
                                    @if($cons->servicio=="TR4")
                                         <tr style="background-color: rgba(255, 102, 0,.2);">
                                    @endif
                                            <td><center>{{$cons->id_rol_operador}}</center></td>
                                            <td>
                                                @if($cons->id_conductor==null)
                                                <button type="button" class="btn btn-primary" onclick="abrirModal({{$cons->id_rol_operador}})" data-toggle="modal" data-target="#exampleModal">
                                                    Asignar conductor
                                                </button>
                                                @else
                                                    {{$cons->id_conductor}} 
                                                @endif
                                            </td>
                                            <td><center>{{$cons->servicio}}</center></td>
                                            <td>{{$cons->posicion}}</td>
                                            <td>{{$cons->ciclos}}</td>
                                            <td>{{$cons->turno}}</td>
                                            <td>@if($cons->lunes=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->lunes}} - {{$cons->lunes_total}}
                                                @endif
                                            </td>
                                            <td>@if($cons->martes=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->martes}} - {{$cons->martes_total}}
                                                @endif
                                            </td>
                                            <td>@if($cons->miercoles=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->miercoles}} - {{$cons->miercoles_total}}
                                                @endif
                                            </td>
                                            <td>@if($cons->jueves=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->jueves}} - {{$cons->jueves_total}}
                                                @endif
                                            </td>
                                            <td>@if($cons->viernes=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->viernes}} - {{$cons->viernes_total}}
                                                @endif
                                            </td>
                                            <td>@if($cons->sabado=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->sabado}} - {{$cons->sabado_total}}
                                                @endif
                                            </td>
                                            <td>@if($cons->domingo=='02:02:02')
                                                <b>Descanso<b>
                                                @else
                                                {{$cons->domingo}} - {{$cons->domingo_total}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
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
            // Manejar el evento de finalización de la carga
            
        });
        
        function abrirModal(id_rol_operador)
        {
            $('#hidden_id_rol_operador').val(id_rol_operador);
            var semana = $('#semana').val();
            $('#semana_hidden').val(semana);
            
            $('#modal_conductores').modal('show');
        }
    </script>
	@endsection
</x-app-layout>
