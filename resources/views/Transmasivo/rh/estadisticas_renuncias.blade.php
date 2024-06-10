<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
		p {
			font-weight: bold;
		}

		.question-wrapper {
			display: flex;
			flex-direction: column;
		}

		.form-check-inline {
			display: flex;
			flex-wrap: wrap;
		}

		.custom-control {
			margin-right: 20px; /* Ajusta este valor según tus necesidades */
		}


	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Estadisticas de renuncias</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
            <div class="form-group row " >
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">3.- ¿Cómo fue tu relación laboral con tu jefe directo?</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">4.- ¿Tu labor tuvo reconocimiento por parte de tu (s) jefe (s)?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart2" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">5.- ¿Tu labor tuvo reconocimiento por parte de la empresa?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart3" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">6.- ¿Participaste en la toma de decisiones respecto a la mejoría de tu ambiente de  trabajo?</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart4" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">7.- ¿Qué tan importante consideras la labor que desempeñaste?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart5" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">8.- El sueldo que percibiste te pareció:	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart6" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">9.- ¿Tuviste oportunidades de crecimiento laboral dentro de la empresa?</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart7" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">10.- ¿Las instrucciones que recibías referente a tus labores fueron claras?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart8" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">11.- ¿La carga de trabajo que se te imponía fue justa?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart9" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">12.- Las juntas o reuniones de trabajo ¿fueron funcionales?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart10" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">13.- ¿Cumplió con tus aspiraciones personales el laborar en esta empresa?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart11" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">14.- Tus relaciones personales con tus compañeros de trabajo fueron:	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart12" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">15.- ¿Tenias más responsabilidades de las que podias asumir (conjuntando hogar y trabajo)?</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart13" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">16.-Al terminar el día ¿te sentías satisfecho con lo que habías logrado?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart14" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">17.- En el último mes ¿Te has sentido cansado y con falta de energía?		</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart15" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">18.- En el último mes ¿Has perdido el entusiasmo, en tus actividades favoritas?		</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart16" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">19.- En las últimas semanas ¿has tenido pérdida de apetito?		</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart17" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">20.- En las últimas semanas ¿Te has sentido irritado extremadamente porque te levanten la voz?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart18" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">21.- En promedio ¿Cuántos días al mes faltabas?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart19" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="card">
						<div class="card-header">22.- Los cursos de capacitación ¿te fueron funcionales?</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart20" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
                    <div class="card">
						<div class="card-header">23.- Su baja es por:</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart21" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
                    <div class="card">
						<div class="card-header">24.- En caso de baja por decisión propia ¿Cuál es el motivo?	</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart22" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
                    <div class="card">
						<div class="card-header">25.- ¿Volverías a laborar con nosotros si tuvieras la oportunidad?</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="doughnutChart23" style="width: 50%; height: 50%"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
	var doughnutChart = document.getElementById('doughnutChart').getContext('2d');
        var myDoughnutChart = new Chart(doughnutChart, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu3 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu3 as $pregu)
                        '{{$pregu->relacion_jefe}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
        var doughnutChart2 = document.getElementById('doughnutChart2').getContext('2d');
        var mydoughnutChart2 = new Chart(doughnutChart2, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu4 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu4 as $pregu)
                        '{{$pregu->reconocimiento_jefe}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart3 = document.getElementById('doughnutChart3').getContext('2d');
        var mydoughnutChart3 = new Chart(doughnutChart3, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu5 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu5 as $pregu)
                        '{{$pregu->reconocimiento_empresa}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart4 = document.getElementById('doughnutChart4').getContext('2d');
        var mydoughnutChart4 = new Chart(doughnutChart4, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu6 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu6 as $pregu)
                        '{{$pregu->toma_decisiones}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart5 = document.getElementById('doughnutChart5').getContext('2d');
        var mydoughnutChart5 = new Chart(doughnutChart5, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu7 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu7 as $pregu)
                        '{{$pregu->importante_labor}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart6 = document.getElementById('doughnutChart6').getContext('2d');
        var mydoughnutChart6 = new Chart(doughnutChart6, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu8 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu8 as $pregu)
                        '{{$pregu->sueldo_parecio}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart7 = document.getElementById('doughnutChart7').getContext('2d');
        var mydoughnutChart7 = new Chart(doughnutChart7, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu9 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu9 as $pregu)
                        '{{$pregu->crecimiento_laboral}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart8 = document.getElementById('doughnutChart8').getContext('2d');
        var mydoughnutChart8 = new Chart(doughnutChart8, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu10 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu10 as $pregu)
                        '{{$pregu->instrucciones_claras}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart9 = document.getElementById('doughnutChart9').getContext('2d');
        var mydoughnutChart9 = new Chart(doughnutChart9, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu11 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu11 as $pregu)
                        '{{$pregu->carga_trabajo}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart10 = document.getElementById('doughnutChart10').getContext('2d');
        var mydoughnutChart10 = new Chart(doughnutChart10, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu12 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu12 as $pregu)
                        '{{$pregu->reuniones_trabajo}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart11 = document.getElementById('doughnutChart11').getContext('2d');
        var mydoughnutChart11 = new Chart(doughnutChart11, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu13 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu13 as $pregu)
                        '{{$pregu->aspiraciones_empresa}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart12 = document.getElementById('doughnutChart12').getContext('2d');
        var mydoughnutChart12 = new Chart(doughnutChart12, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu14 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu14 as $pregu)
                        '{{$pregu->relaciones_personales_compañeros}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart13 = document.getElementById('doughnutChart13').getContext('2d');
        var mydoughnutChart13 = new Chart(doughnutChart13, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu15 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu15 as $pregu)
                        '{{$pregu->responsabilidades_asumir}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart14 = document.getElementById('doughnutChart14').getContext('2d');
        var mydoughnutChart14 = new Chart(doughnutChart14, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu16 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu16 as $pregu)
                        '{{$pregu->satisfecho_trabajo}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart15 = document.getElementById('doughnutChart15').getContext('2d');
        var mydoughnutChart15 = new Chart(doughnutChart15, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu17 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu17 as $pregu)
                        '{{$pregu->cansado_falta_energia}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart16 = document.getElementById('doughnutChart16').getContext('2d');
        var mydoughnutChart16 = new Chart(doughnutChart16, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu18 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu18 as $pregu)
                        '{{$pregu->entusiasmo_perdido}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart17 = document.getElementById('doughnutChart17').getContext('2d');
        var mydoughnutChart17 = new Chart(doughnutChart17, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu19 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu19 as $pregu)
                        '{{$pregu->perdida_apetito}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});

		var doughnutChart18 = document.getElementById('doughnutChart18').getContext('2d');
        var mydoughnutChart18 = new Chart(doughnutChart18, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu20 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu20 as $pregu)
                        '{{$pregu->irritado}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart19 = document.getElementById('doughnutChart19').getContext('2d');
        var mydoughnutChart19 = new Chart(doughnutChart19, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu21 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu21 as $pregu)
                        '{{$pregu->faltas_al_mes}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart20 = document.getElementById('doughnutChart20').getContext('2d');
        var mydoughnutChart20 = new Chart(doughnutChart20, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu22 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu22 as $pregu)
                        '{{$pregu->cursos_funciionales}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart21 = document.getElementById('doughnutChart21').getContext('2d');
        var mydoughnutChart21 = new Chart(doughnutChart21, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu23 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu23 as $pregu)
                        '{{$pregu->baja_es}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart22 = document.getElementById('doughnutChart22').getContext('2d');
        var mydoughnutChart22 = new Chart(doughnutChart22, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu24 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu24 as $pregu)
                        '{{$pregu->baja_motivo}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var doughnutChart23 = document.getElementById('doughnutChart23').getContext('2d');
        var mydoughnutChart23 = new Chart(doughnutChart23, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
                        @foreach($pregu25 as $pregu)
                        {{$pregu->cantidad}},
                        @endforeach
                    ],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#716aca','#59d05d']
				}],
				labels: [
                    @foreach($pregu25 as $pregu)
                        '{{$pregu->volver_laborar}}',
                        @endforeach
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		
</script>
@endsection
</x-app-layout>
