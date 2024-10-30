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
                    
                    @php
                    $currentYear = \Carbon\Carbon::now()->year;
                    $today = \Carbon\Carbon::today()->format('Y-m-d');
                    $quincenas = [];
                    $j = 1;
                    $selectedQna = '';
                    // Generar todas las quincenas del año
                    for ($month = 1; $month <= 12; $month++) {
                        // Primera quincena del mes
                        $startFirstHalf = \Carbon\Carbon::create($currentYear, $month, 1)->format('Y-m-d');
                        $endFirstHalf = \Carbon\Carbon::create($currentYear, $month, 15)->format('Y-m-d');
                        $quincenaValueFirstHalf = "'$startFirstHalf 00:00:00' AND '$endFirstHalf 23:59:59'";
                        $quincenas[] = [
                        'label' => "Qna ".$j." - 1 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " - 15 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " $currentYear",
                        'value' => $quincenaValueFirstHalf
                        ];
                        if ($today >= $startFirstHalf && $today <= $endFirstHalf) {
                            $selectedQna = $quincenaValueFirstHalf;
                        }
                        $j++;
                        // Segunda quincena del mes
                        $startSecondHalf = \Carbon\Carbon::create($currentYear, $month, 16)->format('Y-m-d');
                        $endSecondHalf = \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth()->format('Y-m-d');
                        $quincenaValueSecondHalf = "'$startSecondHalf 00:00:00' AND '$endSecondHalf 23:59:59'";
                        $quincenas[] = [
                        'label' => "Qna ".$j." - 16 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " - " . \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth()->day . " de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " $currentYear",
                        'value' => $quincenaValueSecondHalf
                        ];
                        if ($today >= $startSecondHalf && $today <= $endSecondHalf) {
                            $selectedQna = $quincenaValueSecondHalf;
                        }
                        $j++;
                    }
                    @endphp
                    <div class="col-xl-4">
                        <label><br>Qna <span class="required-label"></span></label>
                        <select style="border:1px black solid;" class="form-control" id="qna" name="qna">
                            <option value="-Selecciona-">-Selecciona-</option>
                            @foreach ($quincenas as $quincena)
                            <option value="{{ $quincena['value'] }}" @if($quincena['value'] == $selectedQna)  style="background-color:green; color:#fff;" @endif  >
                                {{ $quincena['label'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-2">
                        <center>
                            <input  type="submit" class="btn btn-success" value="Consultar" >
                        </center>
                    </div>
					<div class="col-md-12">
                        <div class="chart-container">
							<canvas id="multipleLineChart"></canvas>
						</div>
                        <div class="chart-container">
							<canvas id="multipleLineChart2"></canvas>
						</div>
			    	</div>
                </div>
                
            </div>
        </form>
    </div>
    

</div>

</div>



@section('jscustom')
    <script type="text/javascript">
    
		var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
		var multipleLineChart2 = document.getElementById('multipleLineChart2').getContext('2d');

        var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
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
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [{{$total_ciclos_lv}}, {{$total_ciclos_lv}}, {{$total_ciclos_lv}}, {{$total_ciclos_lv}}, {{$total_ciclos_lv}},
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
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [{{$registro_l[0]->conteo}}, {{$registro_m[0]->conteo}}, {{$registro_mi[0]->conteo}}, {{$registro_j[0]->conteo}}, {{$registro_v[0]->conteo}},
                    {{$registro_s[0]->conteo}},  {{$registro_d[0]->conteo}}]
				}, {
					label: "Ciclos no realizados",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [{{$total_ciclos_lv - $registro_l[0]->conteo }}, {{$total_ciclos_lv - $registro_m[0]->conteo}}, 
                    {{$total_ciclos_lv - $registro_mi[0]->conteo}}, {{$total_ciclos_lv - $registro_j[0]->conteo}}, {{$total_ciclos_lv - $registro_v[0]->conteo}},
                    {{$total_ciclos_s - $registro_s[0]->conteo}},  {{$total_ciclos_d - $registro_d[0]->conteo}}]
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

        var myMultipleLineChart2 = new Chart(multipleLineChart2, {
			type: 'line',
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
					backgroundColor: 'transparent',
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
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [{{$registro_t_l}}, {{$registro_t_m}}, {{$registro_t_mi}}, {{$registro_t_j}}, {{$registro_t_v}},
                    {{$registro_t_s}},  {{$registro_t_d}}]
				}, {
					label: "Km no realizados",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [{{$total_ciclos_lv - $registro_l[0]->conteo }}, {{$total_ciclos_lv - $registro_m[0]->conteo}}, 
                    {{$total_ciclos_lv - $registro_mi[0]->conteo}}, {{$total_ciclos_lv - $registro_j[0]->conteo}}, {{$total_ciclos_lv - $registro_v[0]->conteo}},
                    {{$total_ciclos_s - $registro_s[0]->conteo}},  {{$total_ciclos_d - $registro_d[0]->conteo}}]
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
