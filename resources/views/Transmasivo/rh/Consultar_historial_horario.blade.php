<x-app-layout>
	<style>
		table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
              }
        td, th {
            border: 1px solid #000000;
            text-align: right;
            padding: 2px;
        }

	</style>
    <div class="form-group row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header" style="font-family: Arial; font-size: 15px;">
                    <div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Busqueda de horario </div>
                </div>
                        <form method="post" id="contratoForm" action="{{url('/Consultar_historial_horario')}}">
                        @csrf
                <div class="card-body">
                    <div class="form-group row " >
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>ID empleado <span class="required-label"></span></label>
                                    <select  id="id_empleado" name="id_empleado" class="form-control" >
                                            <option value="-Selecciona-">-Selecciona-</option>
                                        @foreach($elementos as $elemento)
                                            @if(isset($id_empleado))
                                                @if($elemento->id_elemento == $id_empleado)
                                                    <option selected value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>
                                                @else
                                                    <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                                @endif
                                            @else
                                                <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <center>
                                    <input type="submit" class="btn btn-primary" value="Buscar" id="Buscar" name="Buscar">
                                </center>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
            <div class="card">
                <div class="card-header" style="font-family: Arial; font-size: 15px;">
                    <div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Enrolar horarios </div>
                </div>
                    <form method="post" id="contratoForm" action="{{url('/Consultar_historial_horario')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row " >
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>ID empleado <span class="required-label"></span></label>
                                    <select  id="id_empleado" name="id_empleado" class="form-control" >
                                            <option value="-Selecciona-">-Selecciona-</option>
                                        @foreach($elementos as $elemento)
                                            @if(isset($id_empleado))
                                                @if($elemento->id_elemento == $id_empleado)
                                                    <option selected value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>
                                                @else
                                                    <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                                @endif
                                            @else
                                                <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Horarios<span class="required-label"></span></label>
                                    <select  id="id_horarios" name="id_horarios" class="form-control" >
                                        <option value="Sin asignar">Sin asignar</option>
                                        @foreach($consulta as $cons)
                                            <option  value="{{$cons->id_t_horarios_personal}}">{{$cons->nombre_horario}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Día que comienza a aplicar <span class="required-label"></span></label>
                                    <input type="date" id="dia_aplica" name="dia_aplica" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <center>
                                    <input type="submit" class="btn btn-primary" value="Enrolar" id="Enrolar" name="Enrolar">
                                </center>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header" style="font-family: Arial; font-size: 15px;">
                    <div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Resultados de horarios </div>
                </div>
                <div class="card-body">
                    @if (session('mensaje'))
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        {{ session('mensaje') }}.
                    </div>
                    @endif
                    <div id="overlay" class="overlay">
                        <div class="gif-container">
                            <img src="{{url('/carga.gif')}}" alt="Cargando...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-12">
                            <div id="calendar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	

@section('jscustom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye moment.js con locales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
			$calendar = $('#calendar');
			$calendar.fullCalendar({
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'], 
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'], 
                locale: 'es', 
                header: {
                    left: 'prev,next today',
                    center: 'title',
                },
                selectable: true,
                selectHelper: true,
				events: [
				@if(isset($fechas))
                    @foreach($fechas as $fecha)
                    @php $fecha_array = $fecha['fecha']; @endphp
                    @php $llegada = $fecha['llegada']; @endphp
                    @php $comida = $fecha['comida']; @endphp
                    @php $fin_comida = $fecha['fin_comida']; @endphp
                    @php $salida = $fecha['salida']; @endphp
                        @if($fecha['nombre']== "Descanso")
                            {
                                title: "{{$fecha['nombre']}}",
                                start: new Date({{ substr($fecha_array, 0, 4) }}, {{ substr($fecha_array, 5, 2) }} - 1, {{ substr($fecha_array, 8, 2) }}),
                                allDay: true,
                                className: 'fc-warning'
                            },
                        @else
                            {
                                title: '{{ substr($llegada, 0, 5) }} - Entrada',
                                start: new Date({{ substr($fecha_array, 0, 4) }}, {{ substr($fecha_array, 5, 2) }} - 1, {{ substr($fecha_array, 8, 2) }}),
                                allDay: true,
                                className: 'fc-info'
                            },

                            @if($comida!==null && $fin_comida!==null )
                                {
                                    title: '{{ substr($comida, 0, 5) }} - Comida',
                                    start: new Date({{ substr($fecha_array, 0, 4) }}, {{ substr($fecha_array, 5, 2) }} - 1, {{ substr($fecha_array, 8, 2) }}),
                                    allDay: true,
                                    className: 'fc-success'
                                },
                                {
                                    title: '{{ substr($fin_comida, 0, 5) }} - Fin comida',
                                    start: new Date({{ substr($fecha_array, 0, 4) }}, {{ substr($fecha_array, 5, 2) }} - 1, {{ substr($fecha_array, 8, 2) }}),
                                    allDay: true,
                                    className: 'fc-success'
                                },
                            @endif
                            
                            {
                                title: '{{ substr($salida, 0, 5) }} - Salida',
                                start: new Date({{ substr($fecha_array, 0, 4) }}, {{ substr($fecha_array, 5, 2) }} - 1, {{ substr($fecha_array, 8, 2) }}),
                                allDay: true,
                                className: 'fc-info'
                            },
                        @endif
                    @endforeach
				@endif
				],
			});
		});
</script>
@endsection
</x-app-layout>
