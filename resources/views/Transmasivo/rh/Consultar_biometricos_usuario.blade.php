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
	<div class="card">
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Consultar biométrico </div>
		</div>
		<div class="card-body">
            @if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
                <form method="post" id="contratoForm" action="{{url('/Consultar_biometricos_usuario')}}">
                    @csrf
                    <div class="form-group row " >
                        
                        
                        <div class="col-md-3">
                            <label>Fecha inicio <span class="required-label"></span></label>
                            <input type="date" style="border: 1px solid black;" class="form-control" id="fecha_inicio" name="fecha_inicio"  max="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha fin <span class="required-label"></span></label>
                            <input type="date" style="border:1px black solid;" class="form-control" id="fecha_fin" name="fecha_fin"  max="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-12">
                            <center>
                                <br>
                                <input type="submit" value="Consultar" class="btn btn-primary" id="Consultar" name="Consultar">
                            </center>
                        </div>
                    </div>
                </form>
                <div class="form-group row " >
                    
                    <div class="col-md-12">
                        <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-striped table-bordered" id="list_user2">
                            <thead>
                                <tr>
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 5%;"><center>Empleado</center></th>
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Día</center></th>
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Entrada oficina</center></th>
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Salida oficina</center></th>
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Tiempo de trabajo</center></th>
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Retardo</center></th>
                                    
                                    <th class="bg-danger sorting" style="color:#ffffff; width: 10%;"><center>Todas las fechas del día</center></th>
                                </tr>
                            </thead>
                            <tbody id="llenaTabla">
                                @php $i = 1; @endphp
                                @if(isset($consulta))
                                    @if($consulta !== "")
                                        @foreach($consulta as $consul)
                                            @if($i % 2 == 0)
                                                <tr style="background-color: rgba(237,28,36,.1);">
                                            @else
                                                <tr style="background-color: #fff;">
                                            @endif
                                                    <td>{{$consul->id_elemento}}</td>
                                                    <td data-fecha-inicio="{{$consul->dia}}">{{$consul->dia}}</td>
                                                    <td>{{$consul->inicio}}</td>
                                                    <td>{{$consul->fin}}</td>
                                                    <td>{{$consul->tiempo_trabajado}}</td>
                                                    <td>{{$consul->estado}}</td>
                                                   <td>{!! $consul->todas_las_fechas !!}</td>
                                                </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    @endif
                                @endif
                            </tbody>
                        </table>

					    </div>
                    </div>
				</div>
		</div>
	</div>

@section('jscustom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye moment.js con locales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

<script type="text/javascript">
	
    $(document).ready(function() {
        $('#id_empleados').select2();
        moment.locale('es');
        $('td[data-fecha-inicio]').each(function() {
            var fechaRegistro = $(this).data('fecha-inicio');
            var fechaFormateada = moment(fechaRegistro).format('dddd, D [de] MMMM [de] YYYY');
            fechaFormateada = fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1);
            $(this).html( '<b>'+fechaFormateada+'</b>');
        });
        $('#list_user2').DataTable({
            scrollX: false,
            scrollCollapse: true,
            filter: true,
            lengthMenu: [[8,16 , 24, 32, 40, -1], [8, 16, 24, 32, 40, "Todos"]],
            iDisplayLength: 8,
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
            }
        });
    }); 

</script>
@endsection
</x-app-layout>
