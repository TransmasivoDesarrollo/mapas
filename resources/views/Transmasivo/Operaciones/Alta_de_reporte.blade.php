<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
            <div class="card-title" style="display: inline-block;">Alta de reporte</div>
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
                            
                            <div class="col-md-2">
                                <label>Numero de economico</label>
                                <select   type="text" class="form-control  input-with-border" id="n_economico" name="n_economico">
                                    
                                    @foreach($unidades as $unidad)
                                    <option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Hora de llegada  <span class="required-label">*</span></label>
                                <input required type="time" class="form-control input-with-border" id="hora_llegada" name="hora_llegada">
                            </div>
                            <div class="col-md-2">
                                <label>Credencial <span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="credencial" name="credencial">
                            </div>
                            
                            <div class="col-md-2">
                                <label>Servicio<span class="required-label">*</span></label>
                                <select   type="text" class="form-control  input-with-border" id="serv" name="serv">
                                    @foreach($servicios as $servicio)
                                    <option value="{{$servicio->idservicio}}">{{$servicio->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Km de entrada a patio <span class="required-label">*</span></label>
                                <input required type="number" class="form-control input-with-border" id="km" name="km">
                            </div>
                           
                            </div>
                            <div class="form-group row " >
                            <div class="col-md-3">
                                <label>Tipo de falla<span class="required-label">*</span></label>
                                <input required type="text" class="form-control input-with-border" id="jorn" name="jorn">
                            </div>
                          
                            <div class="col-md-2">
                                <label>Grupo <span class="required-label">*</span></label>
                                <select   type="text" class="form-control  input-with-border" id="grupo" name="grupo">
                                    @foreach($grupos as $grupo)
                                    <option value="{{$grupo->idFalloGral}}">{{$grupo->nombreFalloGral}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <label for="subgrupo">Subgrupo de falla <span class="required-label">*</span></label>
                                
                                    <select type="text" class="form-control input-with-border" id="subgrupo" name="subgrupo"></select>
                                
                                
                            </div>
                            <div class="col-md-2">
                            <label for="subgrupo">&nbsp;</label>
                            <center>
                            <input type="button" class="btn btn-primary" value="Agregar subgrupo" data-toggle="modal" data-target="#myModal">
                            </center>
                                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo subgrupo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label>Grupo </label>
                                                <input   type="text" class="form-control  input-with-border" disabled id="grupo_modal" name="grupo_modal" >
                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nuevo subgrupo </label>
                                                <input   type="text" class="form-control  input-with-border" id="subgrupo_modal" name="subgrupo_modal" >
                                                   
                                            </div>
                                        </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                            </div>

                        </div>
                            <div class="form-group row " >
                            <div class="col-md-6">
                                <label>Observaciones  <span class="required-label"></span></label>
                                <textarea  type="text" class="form-control input-with-border" id="comentarios" name="comentarios"></textarea>
                            </div>
                            <a href = " https://wa.me/JdSVkLaZSmp4q9G5qnYIhJ?text=Mensaje ">Whatsapp </a>
                            <a href="https://chat.whatsapp.com/JdSVkLaZSmp4q9G5qnYIhJ?text=Mensaje">Enviar mensaje al grupo por WhatsApp</a>


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
     
    </div>
    
    
        
	@section('jscustom')
    <script type="text/javascript">
        $('#n_economico').select2();
        $('#serv').select2();
        $('#grupo').select2();
        
        function subgrupo(seleccionado) {
            $.ajax({
                url: '{{url("/Alta_de_reporte/subgrupo")}}',
                method: 'get', // o 'GET' según corresponda
                data: {'grupo_id': seleccionado},
                success: function(response){
                    var html="";
                    for(var i = 0; i < response.length; i++) { // Corrección aquí
                        html += '<option value="' + response[i]['iddescfallo'] + '">' + response[i]['descfallo'] + '</option>';
                    }
                    
                    $('#subgrupo').html(html);
                },
                error: function(xhr, status, error){
                    console.error(error); // Manejar errores
                }
            });
            
            var opcionSeleccionada = $('#grupo option[value="' + seleccionado + '"]');
            var textoSeleccionado = opcionSeleccionada.text();
            $('#grupo_modal').val(textoSeleccionado);
        }

        $('#grupo').change(function(){
            var seleccionado = $(this).val();
            subgrupo(seleccionado);
            
        });


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
            var seleccionado = $('#grupo').val();
            subgrupo(seleccionado);
        });
        
    </script>
	@endsection
</x-app-layout>
