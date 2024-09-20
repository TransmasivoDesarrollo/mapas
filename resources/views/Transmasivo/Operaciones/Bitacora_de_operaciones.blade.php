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

                <form method="post" id="exampleValidation" action="{{url('/Bitacora_de_operaciones')}}">
					@csrf
					{{-- inicio del row --}}

                        <div class="form-group row " >
                            
                            <div class="col-md-3">
                                <label>Credencial <span class="required-label">*</span></label>
                                <select required type="text" style="width:90%;" class="form-control input-with-border" id="credencial" name="credencial">
                                    @foreach($credencial as $cred)
                                        <option value="{{$cred->id}}">{{$cred->id}} - {{$cred->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <label>Día <span class="required-label">*</span></label>
                                <input required type="date" class="form-control input-with-border" id="dia" name="dia" value="{{now()->format('Y-m-d')}}">
                            </div>
                            <div class="col-md-1">
                                <label>&nbsp;<br><br><br></label>
                                <button class="btn btn-primary btn-sm" id="buscar" class="buscar"><i class="la flaticon-search-2"></i></button>
                            </div>
                            <div class="col-md-3">
                                    <label>Terminal</label>
                                    <select required class="form-control input-with-border" id="terminal" name="terminal">
                                        @foreach($terminal as $term)
                                        <option value="{{$term->id_terminal}}">{{$term->terminal}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-3">
                                <label>Servicio<span class="required-label">*</span></label>
                                <select required class="form-control input-with-border" id="serv" name="serv">
                                    <option value="TR1">TR1 - Ordinario Ojo de agua - Ciudad azteca</option>
                                    <option value="TR3">TR3 - Express Ojo de agua - Ciudad azteca</option>
                                    <option value="TR3-R">TR3-R - Express Ojo de agua - Ciudad azteca</option>
                                    <option value="TR4">TR4 - Express Central de abastos - Ciudad azteca</option>
                                </select>
                            </div>

                           
                            
                            
                            
                        </div>
                        <div class="form-group row " >
                            
                            <div class="col-md-2">
                                    <label>Hora de llegada  <span class="required-label">*</span></label>
                                    <input required type="time" class="form-control input-with-border" id="hora_llegada" name="hora_llegada">
                            </div>
                            <div class="col-md-2">
                                <label>Hora de salida <span class="required-label">*</span></label>
                                <input required type="time" class="form-control input-with-border" id="hora_salida" name="hora_salida">
                            </div> 
                           
                            <div class="col-md-2">
                                <label>Economico <span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="eco" name="eco">
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
										<input  type="submit" class="btn btn-success" value="Registrar" >
									</center>
								</div>
							</div>
							
						</div>
                        </form>
					</div>
					

        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="display: inline-block;">Consulta bitacora de operaciones</div>
                <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
            </div>
            <div class="card-body">
            <form method="post" id="exampleValidation" action="{{url('/Bitacora_de_operaciones')}}">
					@csrf
                    <input type="submit" class="btn btn-danger" value="PDF" name="pdf" id="pdf">
            </form>
            <div class="table-responsive" >
                                    <table class="table table-bordered  " id="list_user2">
                                        <thead>
                                            <tr>
                                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de llegada</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Serv.</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eco.</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Credencial</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Día</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de salida</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora llegada rol</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Difernecia</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 30%;"><center>Comentarios</center></th>
                                            </tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                        @if(null !== $consulta)
                                            @foreach($consulta as $fila)
                                                <tr >
                                                    <td>{{$fila['hora_llegada']}}</td>
                                                    <td>{{$fila['Servicio']}}</td>
                                                    <td>{{$fila['eco']}}</td>
                                                    <td>{{$fila['credencial']}}</td>
                                                    <td>{{$fila['dia']}}</td>
                                                    <td>{{$fila['hora_salida']}}</td>
                                                    <td>{{$fila['hora_salida_rol']}}</td>
                                                    <td>@if($fila['estatus_hora']=="sobretiempo") + @elseif($fila['estatus_hora']=="retardo") - @endif {{$fila['hora_diferencia']}}</td>
                                                    <td>{{$fila['estatus_hora']}}</td>
                                                    <td>{{$fila['comentario']}}</td>
                                                </tr>
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
            }
        });
        
        $(document).ready(function() {
            function actualizarFecha() {
                var fecha = new Date();
                var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                var fechaFormateada = fecha.getDate().toString().padStart(2, '0') + ' ' + meses[fecha.getMonth()] + ' ' + fecha.getFullYear();
                var horaFormateada = fecha.getHours().toString().padStart(2, '0') + ':' + fecha.getMinutes().toString().padStart(2, '0') + ':' + fecha.getSeconds().toString().padStart(2, '0');
                $('#fecha').text('Fecha y Hora: ' + fechaFormateada + ' ' + horaFormateada);
            }
            function minutos() {
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                var minutes = now.getMinutes().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
                var horaActual = hours + ':' + minutes;
                $('#hora_salida').val(horaActual);
            }

            // Actualizar la fecha cada segundo
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
        $('#buscar').click(function() {
            event.preventDefault();

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '{{url("/buscar_rol_operador")}}', // Reemplaza con la URL de tu endpoint
                    type: 'GET', // Puedes cambiar a POST si es necesario
                    data: {
                        'credencial': $('#credencial').val(), // Envía los parámetros necesarios
                        'dia': $('#dia').val(),
                    },
                    success: function(response) {
                        var servicio = response['results'][0]['servicio'];
                        var ciclos = response['results'][0]['ciclos'];
                        var dia;
                        if(response['dia']=='lunes')
                        {
                            dia=response['results'][0]['lunes'];
                        }
                        if(response['dia']=='martes')
                        {
                            dia=response['results'][0]['martes'];
                        }
                        if(response['dia']=='miércoles')
                        {
                            dia=response['results'][0]['miercoles'];
                        }
                        if(response['dia']=='jueves')
                        {
                            dia=response['results'][0]['jueves'];
                        }
                        if(response['dia']=='viernes')
                        {
                            dia=response['results'][0]['viernes'];
                        }
                        if(response['dia']=='sábado')
                        {
                            dia=response['results'][0]['sabado'];
                        }
                        if(response['dia']=='domingo')
                        {
                            dia=response['results'][0]['domingo'];
                        }
                        console.log(response);
                        var cantidad_registros=response['registros_dia'].length;
                        cantidad_registros = cantidad_registros/2;
                        var ciclos_texto= cantidad_registros+' de '+ciclos+' ciclos';
                        var ciclos_porcentaje=100/(ciclos);
                         ciclos_porcentaje=cantidad_registros*ciclos_porcentaje;
                         console.log(ciclos_texto);
                        $('#bar').attr('data-original-title',ciclos_texto);
                        $('#bar').attr('style','width: '+ ciclos_porcentaje +'%');

                        if(servicio == 'TR1')
                        {
                            //39 MINUTOS MAS 
                        }
                        if(servicio == 'TR3')
                        {
                            //30 MINUTOS MAS 
                        }
                        if(servicio == 'TR3-R')
                        {
                            //30 MINUTOS MAS 
                        }
                        if(servicio == 'TR4')
                        {
                            //20 MINUTOS MAS 
                        }
                        
                        $('#progreso').html('Progreso del conductor '+ response['results'][0]['name']);
                        $('#ciclos_span').html(ciclos_texto);
                        
                        console.log('Respuesta recibida:', response['dia']);


                        $('#serv option').removeAttr('selected');
                        $('#serv option[value="' + servicio + '"]').attr('selected', 'selected');
                    


                        // Realiza alguna acción con la respuesta
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores
                        console.error('Error en la solicitud:', error);
                    }
                });
            });
        
    </script>
	@endsection
</x-app-layout>
