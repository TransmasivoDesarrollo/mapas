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
            <form method="post" id="exampleValidation" action="{{ url('/Reporte_de_estado_fisico_y_funcionamiento') }}">
                @csrf
                <div class="form-group row " >
					{{-- 
					<div class="col-md-2">
						<label>Economico <span class="required-label">*</span></label>
						<input  required type="text" class="form-control  input-with-border" style="width:100%; height:100%; border:black 1px solid;" id="n_economico" name="n_economico">
					</div>
					--}}
					<div class="col-md-2">
						<label>Economico <span class="required-label">*</span></label>
						<select  required type="text" class="form-control  input-with-border" id="n_economico" name="n_economico">
							@foreach($unidades as $unidad)
							<option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
							@endforeach
						</select>
					</div>
					{{--
					<div class="col-md-4">
						<label>Mecanico<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="n_mecanico" name="n_mecanico">
					</div>
					--}}
					<div class="col-md-4">
                            <label>Mecanico</label>
                            <select   class="form-control input-with-border"  id="n_mecanico" name="n_mecanico">
								
                                @foreach($mecanicos as $mecanico)
                                <option>{{$mecanico->nombre}}</option>
                                @endforeach
								
							<option>Corina Jared López</option>
                            </select>
                        </div>
					<div class="col-md-4">
						<label>Supervisor <span class="required-label">*</span></label>
						<select   class="form-control input-with-border"  id="nom_supervisor" name="nom_supervisor">
                                @foreach($mecanicos as $mecanico)
                                <option>{{$mecanico->nombre}}</option>
								
                                @endforeach
								
							<option>Corina Jared López</option>
                        </select>
						{{--
						<input required type="text" class="form-control input-with-border" id="nom_supervisor" name="nom_supervisor">
						--}}
					</div>
					
				</div>
				{{-- fin del row --}}
				{{-- inicio del row --}}

				<div class="form-group row " >
                    <div class="col-md-3">
						<label>Ultima fecha <br> de fumigación<span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border"  id="fecha_fumigacion" name="fecha_fumigacion" max="" >
					</div>
                    <div class="col-md-3">
						<label>Fecha ultimo  <br> mantenimiento preventivo<span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="Fecha_preventivo" name="Fecha_preventivo" >
					</div>
                    <div class="col-md-3">
						<label>Fecha de mantenimiento  <br> a la articulación<span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="Fecha_articulacion" name="Fecha_articulacion" >
					</div>
                    <div class="col-md-2">
						<label>Consumo promedio  <br>de display o calculado<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border"  id="Consumo" name="Consumo" max="" >
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-3">
						<label>Fecha del reporte<span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="Fecha" name="Fecha" value="{{ now()->format('Y-m-d') }}">
					</div>
                    
					<div class="col-md-3">
						<label>Agregar kilometraje<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border"  id="km" name="km" max="" >
					</div>
					<div class="col-md-3">
						<label>Carga de bares<span class="required-label">*</span></label>
						<input  required type="number" class="form-control input-with-border" id="bares" name="bares"  >
					</div>

				</div>
                <div id="reportes-container">
                    
                    <div class="form-group row">          
                        @php $i = 1; @endphp 
                     
                        <div class="form-group form-show-validation row">
                        @foreach ($c_reporte as $c_report)
                            
                       
                            <div class="col-md-6">
                                <label>{{ $c_report->id_c_reporte }}.-{{ $c_report->reporte }} </label>
								<div class="custom-control custom-radio">
                                    <input type="radio" id="{{ $c_report->id_c_reporte }}_ok" required name="{{ $c_report->id_c_reporte }}" value="Ok" checked class="custom-control-input"
                                        {{ (isset($form_data[$c_report->id_c_reporte]) && $form_data[$c_report->id_c_reporte] == 'ok') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $c_report->id_c_reporte }}_ok">Ok </label>
								</div>
								<div class="custom-control custom-radio">
                                    <input type="radio" id="{{ $c_report->id_c_reporte }}_mal" required name="{{ $c_report->id_c_reporte }}" value="Falla" class="custom-control-input"
                                        {{ (isset($form_data[$c_report->id_c_reporte]) && $form_data[$c_report->id_c_reporte] == 'mal') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $c_report->id_c_reporte }}_mal">Falla</label>
								</div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="{{ $c_report->id_c_reporte }}_no_aplica" required name="{{ $c_report->id_c_reporte }}" value="No aplica" class="custom-control-input"
                                        {{ (isset($form_data[$c_report->id_c_reporte]) && $form_data[$c_report->id_c_reporte] == 'mal') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $c_report->id_c_reporte }}_no_aplica">No aplica</label>
								</div>
                                <br>
                                    <textarea id="{{ $c_report->id_c_reporte }}_obs" name="{{ $c_report->id_c_reporte }}_obs" style="width:80%;">{{ $form_data[$c_report->id_c_reporte.'_obs'] ?? '' }}</textarea>
                                <br>
                                <br>
                            <hr>
							</div>
                            @php $i++; @endphp 
                        @endforeach
                        <div class="col-md-12">
                        <label class="">Observaciones extras</label>
                        <textarea class="form-control" id="obs_extras" name="obs_extras" style="width:80%; border:1px black solid;"></textarea>
                             
                        </div>
                        
                        </div>      
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <center>
                    <br>
                            <input type="submit" class="btn btn-success" value="Registrar">
                        </center>
                    </div>
                </div>
            </form>

            <!-- Paginación -->
            
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
