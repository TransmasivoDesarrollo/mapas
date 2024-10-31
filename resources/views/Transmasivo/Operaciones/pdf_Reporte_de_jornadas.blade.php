<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="form-group row " >
                  <center  style=" font-family: Arial, sans-serif; font-size: 18px;">
                    Reporte {{$cadena_resultado}}
                  </center>
                    <br>
					<div class="col-md-11">
                        <div class="chart-container">
                            <img src="{{ $imagenBase64 }}" alt="Gráfica"  style="width: 100%;">
						</div>
					</div>
					<div class="col-md-12 table-responsive" >
                        <table class="table" style="width:100%; font-family: Arial, sans-serif; font-size: 10px;">
                            <tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;">Lunes</td>
								<td style="width:14.2%;">Martes</td>
								<td style="width:14.2%;">Miércoles</td>
								<td style="width:14.2%;">Jueves</td>
								<td style="width:14.2%;">Viernes</td>
								<td style="width:14.2%;">Sábado</td>
								<td style="width:14.2%;">Domingo</td>
							</tr>
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_lv}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_lv}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_lv}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_lv}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_lv}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_s}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Ciclos programados: <b>{{$total_ciclos_d}} </b> </td>
							</tr>
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_l[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_m[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_mi[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_j[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_v[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_s[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Ciclos realizados: <b>{{$registro_d[0]->conteo}} </b> </td>
							</tr>
							<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_lv -$registro_l[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_lv -$registro_m[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_lv -$registro_mi[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_lv -$registro_j[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_lv -$registro_v[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_s -$registro_s[0]->conteo}} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Ciclos no realizados: <b>{{$total_ciclos_d -$registro_d[0]->conteo}} </b> </td>
							</tr>
						</table>
					</div>
					<div class="col-md-11">
					<br>
					<br>
					<br>
                        <div class="chart-container">
                        <img src="{{ $imagenBase642 }}" alt="Gráfica" style="width: 100%;">
						</div>
			    	</div>
					<div class="col-md-12 table-responsive" >
                    <table class="table" style="width:100%; font-family: Arial, sans-serif; font-size: 10px;">
						<tr>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:1.2%;">&nbsp;</td>
								<td  style="width:14.2%;">Lunes</td>
								<td style="width:14.2%;">Martes</td>
								<td style="width:14.2%;">Miércoles</td>
								<td style="width:14.2%;">Jueves</td>
								<td style="width:14.2%;">Viernes</td>
								<td style="width:14.2%;">Sábado</td>
								<td style="width:14.2%;">Domingo</td>
							</tr>
							<tr>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_s, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#1d7af3;">&nbsp;</span> Km programados: <b>{{ number_format($total_km_tr1_d, 2, '.', ',') }} </b> </td>
							</tr>
							<tr>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_l, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_m, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_mi, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_j, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_v, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_s, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#59d05d;">&nbsp;</span> Km realizados: <b>{{ number_format($km_t_d, 2, '.', ',') }} </b> </td>
							</tr>
							<tr>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:1.2%;">&nbsp;</td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_l_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_m_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_mi_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_j_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_v_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_s_no, 2, '.', ',') }} </b> </td>
								<td style="width:14.2%;"><span class="badge" style="background-color:#f3545d;">&nbsp;</span> Km no realizados: <b>{{ number_format($km_t_d_no, 2, '.', ',') }} </b> </td>
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
        document.getElementById('generarPDF').addEventListener('click', function() {
            const canvas = document.getElementById('multipleLineChart');
            const imageData = canvas.toDataURL('image/png');
            
            // Asigna el base64 al campo oculto en el formulario
            document.getElementById('imagenBase64').value = imageData;
            
            // Envía el formulario
            document.getElementById('formPDF').submit();
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
					backgroundColor: 'transparent',
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
</body>
</html>