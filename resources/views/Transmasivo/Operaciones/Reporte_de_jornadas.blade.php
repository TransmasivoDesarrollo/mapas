<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }

    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-title" style="display: inline-block;">Reporte semanal </div>
            <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
        </div>

        
        
        <div class="card-body">
            @if (session('mensaje'))
            
            <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                
                {{ session('mensaje') }}.
                
            </div>
            @endif

            <form method="post" id="formPDF" action="{{url('/Reporte_de_jornadas')}}">
                @csrf
                {{-- inicio del row --}}

                <div class="form-group row " >
				@php
					$currentYear = \Carbon\Carbon::now()->year;
					$today = \Carbon\Carbon::today()->format('Y-m-d');
					$semanas = [];
					$j = 1;
					$selectedSemana = '';
					$semana_nombre = '';

					// Encontrar el primer lunes del año actual
					$startOfWeek = \Carbon\Carbon::create($currentYear, 1, 1)->startOfWeek(\Carbon\Carbon::MONDAY);

					// Generar todas las semanas del año
					while ($startOfWeek->year == $currentYear) {
						// Fecha de inicio y fin de la semana
						$endOfWeek = $startOfWeek->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);
						$semanaValue = "'{$startOfWeek->format('Y-m-d')} 00:00:00' AND '{$endOfWeek->format('Y-m-d')} 23:59:59'";

						// Crear etiqueta para la semana en español
						$semanas[] = [
							'label' => "Semana $j - " . $startOfWeek->translatedFormat('l, d \\d\\e F') . " al " . $endOfWeek->translatedFormat('l, d \\d\\e F') . " $currentYear",
							'value' => $semanaValue,
						];

						// Seleccionar la semana actual
						if ($today >= $startOfWeek->format('Y-m-d') && $today <= $endOfWeek->format('Y-m-d')) {
							$selectedSemana = $semanaValue;
							$semana_nombre ="Semana $j - " . $startOfWeek->translatedFormat('l, d \\d\\e F') . " al " . $endOfWeek->translatedFormat('l, d \\d\\e F') . " $currentYear" ;
						}

						// Avanzar al siguiente lunes
						$startOfWeek->addWeek();
						$j++;
					}
					@endphp

					<div class="col-xl-5">
						<label>Semana <span class="required-label"></span></label>
						<select style="border:1px black solid;" class="form-control" id="semana" name="semana">
							<option value="-Selecciona-">-Selecciona-</option>
							@foreach ($semanas as $semana)
								<option value="{{ $semana['value'] }}" @if($semana['value'] == $selectedSemana) selected style="background-color:green; color:#fff;" @endif>
									{{ $semana['label'] }}
								</option>
							@endforeach
						</select>
					</div>



                    <div class="col-xl-2">
                        <center>
							<br>
                            <input  type="submit" class="btn btn-success" value="Consultar" >
                        </center>
                    </div>
					<div class="col-xl-5">
						    <div class=" card-stats">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6">
										</div>
										<div class="col-xl-6">

    									<input type="hidden" id="imagenBase64" name="imagenBase64">
    									<input type="hidden" id="imagenBase642" name="imagenBase642">
											<button type="button" style="border:1px #fff solid; backgroud-color:#fff; " name="generarPDF" id="generarPDF">
												<div class="icon-big text-center icon-warning" style="background-color: red; cursor: pointer;">
													<i class="la la-file-pdf-o text-warning"></i>
												</div>
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-12">
					<br>
					<br>
					<center style="font-family: Arial, sans-serif; font-size: 16px;">Ciclos del {{$semana_nombre}}</center>
                        <div class="chart-container">
							<canvas style="height:90%" name="multipleLineChart" id="multipleLineChart"></canvas>

						</div>
					</div>
					
					<div class="col-md-12 table-responsive" >
						<table class="table" style="width:100%; ">
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;"><center>Lunes</center></td>
								<td style="width:14.2%;"><center>Martes</center></td>
								<td style="width:14.2%;"><center>Miércoles</center></td>
								<td style="width:14.2%;"><center>Jueves</center></td>
								<td style="width:14.2%;"><center>Viernes</center></td>
								<td style="width:14.2%;"><center>Sábado</center></td>
								<td style="width:14.2%;"><center>Domingo</center></td>
							</tr>
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_l}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_m}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_mi}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_j}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_v}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_s}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_d}} </b> </td>
							</tr>
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_l}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_m}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_mi}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_j}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_v}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_s}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_d}} </b> </td>
							</tr>
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_l -$registro_l}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_m -$registro_m}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_mi -$registro_mi}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_j -$registro_j}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_v -$registro_v}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_s -$registro_s}} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_d -$registro_d}} </b> </td>
							</tr>
						</table>
					</div>
					<div class="col-md-12">
					<hr>
					
					<br>
					<br>
					<center style="font-family: Arial, sans-serif; font-size: 16px;">Kilometros de la {{$semana_nombre}}</center>
                        <div class="chart-container">
							
							<canvas id="multipleLineChart2"></canvas>
						</div>
			    	</div>
					<div class="col-md-12 table-responsive" >
						<table class="table" style="width:100%;">
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;"><center>Lunes</center></td>
								<td style="width:14.2%;"><center>Martes</center></td>
								<td style="width:14.2%;"><center>Miércoles</center></td>
								<td style="width:14.2%;"><center>Jueves</center></td>
								<td style="width:14.2%;"><center>Viernes</center></td>
								<td style="width:14.2%;"><center>Sábado</center></td>
								<td style="width:14.2%;"><center>Domingo</center></td>
							</tr>
							<tr>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_s, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_d, 2, '.', ',') }} </b> </td>
							</tr>
							<tr>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_m, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_mi, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_j, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_v, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_s, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_d, 2, '.', ',') }} </b> </td>
							</tr>
							<tr>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_l_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_m_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_mi_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_j_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_v_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_s_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%; font-family: Arial, sans-serif; font-size: 12px;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_d_no, 2, '.', ',') }} </b> </td>
							</tr>


						</table>
					</div>
                </div>
                
            </div>
    </div>
    

</div>

</div>



@section('jscustom')
    <script type="text/javascript">
    
		var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
		var multipleLineChart2 = document.getElementById('multipleLineChart2').getContext('2d');
		
		multipleLineChart.width = 1800;  // Aumenta el ancho del lienzo
		multipleLineChart.height = 1600; // Aumenta la altura del lienzo

        var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'bar',
			data: {
				labels: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado",'Domingo'],
				datasets: [{
					label: "Ciclos programados",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "#1d7af3",
					fill: true,
					borderWidth: 2,
					data: [{{$total_ciclos_l}}, {{$total_ciclos_m}}, {{$total_ciclos_mi}}, {{$total_ciclos_j}}, {{$total_ciclos_v}},
                    {{$total_ciclos_s}},  {{$total_ciclos_d}}]
				},{
					label: "Ciclos realizados",
					borderColor: "#59d05d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#59d05d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "#59d05d",
					fill: true,
					borderWidth: 2,
					data: [{{$registro_l}}, {{$registro_m}}, {{$registro_mi}}, {{$registro_j}}, {{$registro_v}},
                    {{$registro_s}},  {{$registro_d}}]
				}, {
					label: "Ciclos no realizados",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "#f3545d",
					fill: true,
					borderWidth: 2,
					data: [{{$total_ciclos_l - $registro_l }}, {{$total_ciclos_m - $registro_m}}, 
                    {{$total_ciclos_mi - $registro_mi}}, {{$total_ciclos_j - $registro_j}}, {{$total_ciclos_v - $registro_v}},
                    {{$total_ciclos_s - $registro_s}},  {{$total_ciclos_d - $registro_d}}]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});
		var image = myMultipleLineChart.toBase64Image();

		document.getElementById('generarPDF').addEventListener('click', function() {
			const canvas = document.getElementById('multipleLineChart');
			const imageData = canvas.toDataURL('image/png');
			
			// Asigna el base64 al campo oculto en el formulario
			document.getElementById('imagenBase64').value = imageData;

			const canvas2 = document.getElementById('multipleLineChart2');
			const imageData2 = canvas2.toDataURL('image/png');
			
			// Asigna el base64 al campo oculto en el formulario
			document.getElementById('imagenBase642').value = imageData2;
			
			// Envía el formulario
			document.getElementById('formPDF').submit();
		});

        var myMultipleLineChart2 = new Chart(multipleLineChart2, {
			type: 'bar',
			data: {
				labels: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado",'Domingo'],
				datasets: [{
					label: "Km programados",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "#1d7af3",
					fill: true,
					borderWidth: 2,
					data: [{{$total_km_tr1_l}}, {{$total_km_tr1_l}}, {{$total_km_tr1_l}}, {{$total_km_tr1_l}}, {{$total_km_tr1_l}},
                    {{$total_km_tr1_s}},  {{$total_km_tr1_d}}]
				},{
					label: "Km realizados",
					borderColor: "#59d05d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#59d05d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "#59d05d",
					fill: true,
					borderWidth: 2,
					data: [{{$km_t_l}}, {{$km_t_m}}, {{$km_t_mi}}, {{$km_t_j}}, {{$km_t_v}},
                    {{$km_t_s}},  {{$km_t_d}}]
				}, {
					label: "Km no realizados",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "#f3545d",
					fill: true,
					borderWidth: 2,data: [{{$km_t_l_no}}, {{$km_t_m_no}}, {{$km_t_mi_no}}, {{$km_t_j_no}}, {{$km_t_v_no}},
                    {{$km_t_s_no}},  {{$km_t_d_no}}]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});
        
    </script>
    @endsection
</x-app-layout>
