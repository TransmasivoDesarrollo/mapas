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
                                    <label>Terminal</label>
                                    <select required class="form-control input-with-border" id="terminal" name="terminal">
                                        <option>-Selecciona-</option>
                                        @foreach($terminal as $term)
                                        <option value="{{$term->id_terminal}}">{{$term->terminal}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-2">
                                    <label>Hora de llegada  <span class="required-label">*</span></label>
                                    <input required type="time" class="form-control input-with-border" id="hora_llegada" name="hora_llegada">
                            </div>
                            
                            <div class="col-md-3">
                                <label>Servicio<span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="serv" name="serv">
                            </div>
                            <div class="col-md-3">
                                <label>Jornada<span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="jorn" name="jorn">
                            </div>
                            </div>
                            <div class="form-group row " >
                            <div class="col-md-3">
                                <label>Economico <span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="eco" name="eco">
                            </div>
                            <div class="col-md-2">
                                <label>Credencial <span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="credencial" name="credencial">
                            </div>
                            <div class="col-md-2">
                                <label>Kilometraje <span class="required-label">*</span></label>
                                <input required type="number" class="form-control input-with-border" id="km" name="km">
                            </div>
                            <div class="col-md-2">
                                <label>Hora de salida <span class="required-label">*</span></label>
                                <input required type="time" class="form-control input-with-border" id="hora_salida" name="hora_salida">
                            </div> 
                        </div>
                            <div class="form-group row " >
                            <div class="col-md-6">
                                <label>Comentario  <span class="required-label"></span></label>
                                <textarea  type="text" class="form-control input-with-border" id="comentarios" name="comentarios"></textarea>
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
                                    <table class="table table-bordered  " id="list_user">
                                        <thead>
                                            <tr>
                                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de llegada</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Servicio</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Jornada</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Economico</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Credencial</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Km</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hora de salida</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 30%;"><center>Comentarios</center></th>
                                            </tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                        @if(null !== $consulta)
                                        
                                        
                                            @foreach($consulta as $fila)
                                          
                                                <tr >
                                                    <td>{{$fila->hora_llegada}}</td>
                                                    <td>{{$fila->Servicio}}</td>
                                                    <td>{{$fila->Jornada}}</td>
                                                    <td>{{$fila->eco}}</td>
                                                    <td>{{$fila->credencial}}</td>
                                                    <td>{{$fila->kilometraje}}</td>
                                                    <td>{{$fila->hora_salida}}</td>
                                                    <td>{{$fila->comentario}}</td>
                                                    
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
        
        $(document).ready(function() {
            function actualizarFecha() {
                var fecha = new Date();
                var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                var fechaFormateada = fecha.getDate().toString().padStart(2, '0') + ' ' + meses[fecha.getMonth()] + ' ' + fecha.getFullYear();
                var horaFormateada = fecha.getHours().toString().padStart(2, '0') + ':' + fecha.getMinutes().toString().padStart(2, '0') + ':' + fecha.getSeconds().toString().padStart(2, '0');
                $('#fecha').text('Fecha y Hora: ' + fechaFormateada + ' ' + horaFormateada);
            }

            // Actualizar la fecha cada segundo
            setInterval(actualizarFecha, 1000);
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
            var minutes = now.getMinutes().toString().padStart(2, '0'); // Agregar un 0 delante si es necesario
            var horaActual = hours + ':' + minutes;

            // Establecer la hora actual en el campo de entrada
            $('#hora_llegada').val(horaActual);
            $('#hora_salida').val(horaActual);
            
        });
        
    </script>
	@endsection
</x-app-layout>
