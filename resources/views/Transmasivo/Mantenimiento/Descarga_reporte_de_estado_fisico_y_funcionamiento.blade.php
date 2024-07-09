<x-app-layout>
    <style>
        .pagination-wrapper .pagination {
            font-size: 30px;
        }
        svg {
            width: 20px;
            height: auto; /* Mantiene la relación de aspecto */
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-title" style="display: inline-block;">Reporte de estado físico y funcionamiento</div>
            <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
                <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                    {{ session('mensaje') }}.
                </div>
            @endif
            <form method="post" id="exampleValidation" action="{{ url('/Descarga_reporte_de_estado_fisico_y_funcionamiento') }}">
                @csrf
               
                <div class="row">
								<div class="col-md-12">
                                    <div class="table-responsive" >
                                    <table class="table table-bordered  " id="list_user">
                                        <thead>
                                            <tr>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Economico</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Mecanico</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Supervisor</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Km</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Consumo promedio</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>bares</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Observaciones</center></th>
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Fecha de creación</center></th>
                                                
                                                <th class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Acción</center></th>
                                            </tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                       
                                        @foreach($t_reportes as $fila)
                                         
                                        <tr >
                                              <td>{{$fila->economico}}</td>
                                              <td>{{$fila->mecanico}}</td>
                                              <td>{{$fila->supervisor}}</td>
                                              <td>{{$fila->km}}</td>
                                              <td>{{$fila->consumo_promedio}}</td>
                                              <td>{{$fila->bares}}</td>
                                              <td>{{$fila->obs_extras}}</td>
                                              <td>{{$fila->fecha_creacion}}</td>
                                              <td>
                                              <input type="submit" value="Descargar reporte" class="btn btn-danger"></td>
                                              <input type="hidden" value="{{$fila->id}}" name="id_reporte" id="id_reporte">
                                              
                                          </tr>
                                      @endforeach
                                    </tbody>

                                    </table>

                                    </div>
								</div>
               
            </form>

        </div>
    </div>

    @section('jscustom')
    <script type="text/javascript">
        $(document).ready(function() {
            function actualizarFecha() {
                var fecha = new Date();
                var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                var fechaFormateada = fecha.getDate().toString().padStart(2, '0') + ' ' + meses[fecha.getMonth()] + ' ' + fecha.getFullYear();
                var horaFormateada = fecha.getHours().toString().padStart(2, '0') + ':' + fecha.getMinutes().toString().padStart(2, '0') + ':' + fecha.getSeconds().toString().padStart(2, '0');
                $('#fecha').text('Fecha y Hora: ' + fechaFormateada + ' ' + horaFormateada);
            }

            setInterval(actualizarFecha, 1000);
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var horaActual = hours + ':' + minutes;

            $('#hora_llegada').val(horaActual);
            $('#hora_salida').val(horaActual);

          
        });
    </script>
    @endsection

</x-app-layout>
