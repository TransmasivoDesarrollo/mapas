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
			<div class="card-title"> Encuesta de salida</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="contratoForm" action="{{url('/Encuesta_de_renuncia')}}">
				@csrf
				<div class="form-group row " >
					<div class="col-md-12">
						<p>1.- ¿Cuantos tiempo has laborado en esta empresa?	 <span class="required-label"></span></p>
					</div>
					<div class="col-md-6">
					<br>
						<c>Años	 <span class="required-label"></span></c>
						<select required type="number" style="width:90%" class="form-control input-with-border" id="tiempo_año" name="tiempo_año" >
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
							<option>16</option>
							<option>17</option>
							<option>18</option>
							<option>19</option>
							<option>20</option>
							<option>21</option>
							<option>22</option>
							<option>23</option>
							<option>24</option>
							<option>25</option>
							<option>26</option>
							<option>27</option>
							<option>28</option>
							<option>29</option>
							<option>30</option>
							<option>31</option>
							<option>32</option>
							<option>33</option>
							<option>34</option>
							<option>35</option>
							<option>36</option>
							<option>37</option>
							<option>38</option>
							<option>39</option>
							<option>40</option>
							<option>41</option>
							<option>42</option>
							<option>43</option>
							<option>44</option>
							<option>45</option>
						</select>
					</div>
					<div class="col-md-6">
					<br>
						<c>Meses <span class="required-label"></span></c>
						<select required type="number" style="width:90%" class="form-control input-with-border"  id="tiempo_meses" name="tiempo_meses" >
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
						</select>
						
					<br>
					</div>
				</div>
                <div class="form-group row " >
					<div class="col-md-12">
						
					<br><p>2.- ¿En promedio, cuántas horas trabajabas al día?	 <span class="required-label"></span></p>
						<input required type="number" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>                
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
					<br><p class="form-check-label">3.- ¿Cómo fue tu relación laboral con tu jefe directo?<span class="required-label"></span></p><br>
                        <div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="relacion1" name="relacion" class="custom-control-input" value="Excelente">
								<label class="custom-control-label" for="relacion1">Excelente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="relacion2" name="relacion" class="custom-control-input" value="Muy buena">
								<label class="custom-control-label" for="relacion2">Muy buena</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="relacion3" name="relacion" class="custom-control-input" value="Buena">
								<label class="custom-control-label" for="relacion3">Buena</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="relacion4" name="relacion" class="custom-control-input" value="Regular">
								<label class="custom-control-label" for="relacion4">Regular</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="relacion5" name="relacion" class="custom-control-input" value="Mala">
								<label class="custom-control-label" for="relacion5">Mala</p>
							</div>     
					    </div>
					</div>
                    
				</div>
                <div class="form-group row " >
				<div class="col-md-12">
					<div class="question-wrapper">
						
					<br><p >4.- ¿Tu labor tuvo reconocimiento por parte de tu (s) jefe (s)? <span class="required-label">*</span></p>
						<br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="reconocimiento_jefe1" name="reconocimiento_jefe" class="custom-control-input" value="Excelente">
								<label class="custom-control-label" for="reconocimiento_jefe1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="reconocimiento_jefe2" name="reconocimiento_jefe" class="custom-control-input" value="Muy buena">
								<label class="custom-control-label" for="reconocimiento_jefe2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="reconocimiento_jefe3" name="reconocimiento_jefe" class="custom-control-input" value="Buena">
								<label class="custom-control-label" for="reconocimiento_jefe3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="reconocimiento_jefe4" name="reconocimiento_jefe" class="custom-control-input" value="Regular">
								<label class="custom-control-label" for="reconocimiento_jefe4">Nunca</p>
							</div>
						</div>
					</div>
				</div>

                    
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<p>5.- ¿Tu labor tuvo reconocimiento por parte de la empresa?		 <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="reconocimiento_empresa1" name="reconocimiento_empresa" class="custom-control-input" value="Excelente">
								<label class="custom-control-label" for="reconocimiento_empresa1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="reconocimiento_empresa2" name="reconocimiento_empresa" class="custom-control-input" value="Muy buena">
								<label class="custom-control-label" for="reconocimiento_empresa2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="reconocimiento_empresa3" name="reconocimiento_empresa" class="custom-control-input" value="Buena">
								<label class="custom-control-label" for="reconocimiento_empresa3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="reconocimiento_empresa4" name="reconocimiento_empresa" class="custom-control-input" value="Regular">
								<label class="custom-control-label" for="reconocimiento_empresa4">Nunca</p>
							</div>
					    </div>
						
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<p>6.- ¿Participaste en la toma de decisiones respecto a la mejoría de tu ambiente de  trabajo? <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="decisiones1" name="decisiones" class="custom-control-input" value="Excelente">
								<label class="custom-control-label" for="decisiones1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="decisiones2" name="decisiones" class="custom-control-input" value="Muy buena">
								<label class="custom-control-label" for="decisiones2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="decisiones3" name="decisiones" class="custom-control-input" value="Buena">
								<label class="custom-control-label" for="decisiones3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="decisiones4" name="decisiones" class="custom-control-input" value="Regular">
								<label class="custom-control-label" for="decisiones4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<p>7.- ¿Qué tan importante consideras la labor que desempeñaste?	 <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="labor_desempeña1" name="labor_desempeña" class="custom-control-input" value="Excelente">
								<label class="custom-control-label" for="labor_desempeña1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="labor_desempeña2" name="labor_desempeña" class="custom-control-input" value="Muy buena">
								<label class="custom-control-label" for="labor_desempeña2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="labor_desempeña3" name="labor_desempeña" class="custom-control-input" value="Buena">
								<label class="custom-control-label" for="labor_desempeña3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="labor_desempeña4" name="labor_desempeña" class="custom-control-input" value="Regular">
								<label class="custom-control-label" for="labor_desempeña4">Nunca</p>
							</div>
					    </div>
						
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>8.- El sueldo que percibiste te pareció:	 <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="sueldo_parecio1" name="sueldo_parecio" class="custom-control-input" value="Excelente">
								<label class="custom-control-label" for="sueldo_parecio1">Excelente </p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="sueldo_parecio2" name="sueldo_parecio" class="custom-control-input" value="Muy bueno">
								<label class="custom-control-label" for="sueldo_parecio2">Muy bueno      </p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="sueldo_parecio3" name="sueldo_parecio" class="custom-control-input" value="Suficiente">
								<label class="custom-control-label" for="sueldo_parecio3">Suficiente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="sueldo_parecio4" name="sueldo_parecio" class="custom-control-input" value="Malo">
								<label class="custom-control-label" for="sueldo_parecio4">Malo </p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="sueldo_parecio5" name="sueldo_parecio" class="custom-control-input" value="Pésimo">
								<label class="custom-control-label" for="sueldo_parecio5">Pésimo</p>
							</div>
					    </div>
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
					<p>9.- ¿Tuviste oportunidades de crecimiento laboral dentro de la empresa?	 <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="crecimiento_laboral1" name="crecimiento_laboral" class="custom-control-input" value="Muchas">
								<label class="custom-control-label" for="crecimiento_laboral1">Muchas</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="crecimiento_laboral2" name="crecimiento_laboral" class="custom-control-input" value="Bastantes">
								<label class="custom-control-label" for="crecimiento_laboral2">Bastantes</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="crecimiento_laboral3" name="crecimiento_laboral" class="custom-control-input" value="Pocas">
								<label class="custom-control-label" for="crecimiento_laboral3">Pocas</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="crecimiento_laboral4" name="crecimiento_laboral" class="custom-control-input" value="Ninguna">
								<label class="custom-control-label" for="crecimiento_laboral4">Ninguna</p>
							</div>
					    </div>
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>10.- ¿Las instrucciones que recibías referente a tus labores fueron claras?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="instrucciones_claras1" name="instrucciones_claras" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="instrucciones_claras1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="instrucciones_claras2" name="instrucciones_claras" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="instrucciones_claras2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="instrucciones_claras3" name="instrucciones_claras" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="instrucciones_claras3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="instrucciones_claras4" name="instrucciones_claras" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="instrucciones_claras4">Nunca</p>
							</div>
					    </div>
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>11.- ¿La carga de trabajo que se te imponía fue justa?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="carga_trabajo1" name="carga_trabajo" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="carga_trabajo1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="carga_trabajo2" name="carga_trabajo" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="carga_trabajo2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="carga_trabajo3" name="carga_trabajo" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="carga_trabajo3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="carga_trabajo4" name="carga_trabajo" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="carga_trabajo4">Nunca</p>
							</div>
					    </div>
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>12.- Las juntas o reuniones de trabajo ¿fueron funcionales?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input  required type="radio" id="juntas_reuniones1" name="juntas_reuniones" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="juntas_reuniones1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="juntas_reuniones2" name="juntas_reuniones" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="juntas_reuniones2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="juntas_reuniones3" name="juntas_reuniones" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="juntas_reuniones3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="juntas_reuniones4" name="juntas_reuniones" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="juntas_reuniones4">Nunca</p>
							</div>
					    </div>
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>13.- ¿Cumplió con tus aspiraciones personales el laborar en esta empresa?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="aspiraciones_personales1" name="aspiraciones_personales" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="aspiraciones_personales1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="aspiraciones_personales2" name="aspiraciones_personales" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="aspiraciones_personales2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="aspiraciones_personales3" name="aspiraciones_personales" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="aspiraciones_personales3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input  required type="radio" id="aspiraciones_personales4" name="aspiraciones_personales" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="aspiraciones_personales4">Nunca</p>
							</div>
					    </div>
					</div>
					
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>14.- Tus relaciones personales con tus compañeros de trabajo fueron:<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="relaciones_personales1" name="relaciones_personales" class="custom-control-input" value="Excelentes">
								<label class="custom-control-label" for="relaciones_personales1">Excelentes</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="relaciones_personales2" name="relaciones_personales" class="custom-control-input" value="Muy buenas">
								<label class="custom-control-label" for="relaciones_personales2">Muy buenas</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="relaciones_personales3" name="relaciones_personales" class="custom-control-input" value="Buenas">
								<label class="custom-control-label" for="relaciones_personales3">Buenas</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="relaciones_personales4" name="relaciones_personales" class="custom-control-input" value="Malas">
								<label class="custom-control-label" for="relaciones_personales4">Malas</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="relaciones_personales5" name="relaciones_personales" class="custom-control-input" value="Muy malas">
								<label class="custom-control-label" for="relaciones_personales5">Muy malas</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>15.- ¿Tenias más responsabilidades de las que podias asumir (conjuntando hogar y trabajo)?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="responsabilidad_asumir1" name="responsabilidad_asumir" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="responsabilidad_asumir1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="responsabilidad_asumir2" name="responsabilidad_asumir" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="responsabilidad_asumir2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="responsabilidad_asumir3" name="responsabilidad_asumir" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="responsabilidad_asumir3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="responsabilidad_asumir4" name="responsabilidad_asumir" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="responsabilidad_asumir4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>16.-Al terminar el día ¿te sentías satisfecho con lo que habías logrado?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="terminar_dia1" name="terminar_dia" class="custom-control-input" value="Muy satisfecho">
								<label class="custom-control-label" for="terminar_dia1">Muy satisfecho</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="terminar_dia2" name="terminar_dia" class="custom-control-input" value="Bastante satisfecho">
								<label class="custom-control-label" for="terminar_dia2">Bastante satisfecho</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="terminar_dia3" name="terminar_dia" class="custom-control-input" value="Poco satisfecho">
								<label class="custom-control-label" for="terminar_dia3">Poco satisfecho</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="terminar_dia4" name="terminar_dia" class="custom-control-input" value="Nada satisfecho">
								<label class="custom-control-label" for="terminar_dia4">Nada satisfecho</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>17.- En el último mes ¿Te has sentido cansado y con falta de energía?<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="cansado1" name="cansado" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="cansado1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="cansado2" name="cansado" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="cansado2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="cansado3" name="cansado" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="cansado3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="cansado4" name="cansado" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="cansado4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>18.- En el último mes ¿Has perdido el entusiasmo, en tus actividades favoritas?	<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="entusiasmo1" name="entusiasmo" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="entusiasmo1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="entusiasmo2" name="entusiasmo" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="entusiasmo2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="entusiasmo3" name="entusiasmo" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="entusiasmo3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="entusiasmo4" name="entusiasmo" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="entusiasmo4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>19.- En las últimas semanas ¿has tenido pérdida de apetito?		<span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="apetito1" name="apetito" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="apetito1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="apetito2" name="apetito" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="apetito2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="apetito3" name="apetito" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="apetito3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="apetito4" name="apetito" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="apetito4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>20.- En las últimas semanas ¿Te has sentido irritado extremadamente porque te levanten la voz? <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="irritado1" name="irritado" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="irritado1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="irritado2" name="irritado" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="irritado2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="irritado3" name="irritado" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="irritado3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="irritado4" name="irritado" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="irritado4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>21.- En promedio ¿Cuántos días al mes faltabas? <span class="required-label">*</span></p><br>
						<input required type="number" class="form-control input-with-border" id="faltas_mes" name="faltas_mes" >
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
					<br><p>22.- Los cursos de capacitación ¿te fueron funcionales? <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="capacitacion_funcionales1" name="capacitacion_funcionales" class="custom-control-input" value="Muy frecuentemente">
								<label class="custom-control-label" for="capacitacion_funcionales1">Muy frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="capacitacion_funcionales2" name="capacitacion_funcionales" class="custom-control-input" value="Frecuentemente">
								<label class="custom-control-label" for="capacitacion_funcionales2">Frecuentemente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="capacitacion_funcionales3" name="capacitacion_funcionales" class="custom-control-input" value="Ocasionalmente">
								<label class="custom-control-label" for="capacitacion_funcionales3">Ocasionalmente</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="capacitacion_funcionales4" name="capacitacion_funcionales" class="custom-control-input" value="Nunca">
								<label class="custom-control-label" for="capacitacion_funcionales4">Nunca</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>23.- Su baja es por: <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="baja_es_por1" name="baja_es_por" class="custom-control-input" value="Término de contrato">
								<label class="custom-control-label" for="baja_es_por1">Término de contrato</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="baja_es_por2" name="baja_es_por" class="custom-control-input" value="Recisión de contrato">
								<label class="custom-control-label" for="baja_es_por2">Recisión de contrato</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="baja_es_por3" name="baja_es_por" class="custom-control-input" value="Decisión propia">
								<label class="custom-control-label" for="baja_es_por3">Decisión propia</p>
							</div>
							
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>24.- En caso de baja por decisión propia ¿Cuál es el motivo? <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="motivo_renuncia1" name="motivo_renuncia" class="custom-control-input" value="Cuestiones familiares">
								<label class="custom-control-label" for="motivo_renuncia1">Cuestiones familiares</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="motivo_renuncia2" name="motivo_renuncia" class="custom-control-input" value="Un trabajo mejor">
								<label class="custom-control-label" for="motivo_renuncia2">Un trabajo mejor</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="motivo_renuncia3" name="motivo_renuncia" class="custom-control-input" value="Cambio de domicilio">
								<label class="custom-control-label" for="motivo_renuncia3">Cambio de domicilio</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="motivo_renuncia4" name="motivo_renuncia" class="custom-control-input" value="Desmotivación">
								<label class="custom-control-label" for="motivo_renuncia4">Desmotivación</p>
							</div>
							
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>25.- ¿Volverías a laborar con nosotros si tuvieras la oportunidad? <span class="required-label">*</span></p><br>
						<div class="form-check form-check-inline">
							<div class="custom-control custom-radio">
								<input required type="radio" id="volverias_laborar1" name="volverias_laborar" class="custom-control-input" value="Si">
								<label class="custom-control-label" for="volverias_laborar1">Si</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="volverias_laborar2" name="volverias_laborar" class="custom-control-input" value="Muy probablemente">
								<label class="custom-control-label" for="volverias_laborar2">Muy probablemente </p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="volverias_laborar3" name="volverias_laborar" class="custom-control-input" value="Poco probable">
								<label class="custom-control-label" for="volverias_laborar3">Poco probable</p>
							</div>
							<div class="custom-control custom-radio">
								<input required type="radio" id="volverias_laborar4" name="volverias_laborar" class="custom-control-input" value="No">
								<label class="custom-control-label" for="volverias_laborar4">No</p>
							</div>
					    </div>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
						<p>Observaciones, dudas y/ó sugerencias:<span class="required-label">*</span></p><br>
						<textarea  class="form-control input-with-border" id="Observaciones" name="Observaciones" ></textarea>
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-12">
					<p>Sexo <span class="required-label">*</span></p>
						<select required class="form-control input-with-border" id="Sexo" name="Sexo">
							<option value="MASCULINO">Masculino</option>
							<option value="FEMENINO">Femenino</option>
						</select>
					</div>
				</div>
				<div class="form-group row " >
					<div class="col-md-12">
						<p>Edad <span class="required-label">*</span></p>
						<input required type="text" class="form-control input-with-border" id="Edad" name="Edad" >
					</div>
				</div>
			</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<center>
						<input required type="submit" class="btn btn-success" id="Guardar_encuesta" name="Guardar_encuesta" value="Guardar encuesta" >
                        </center>
					</div>
				</div>

			</form>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
	$('#tiempo_año').select2();
	$('#tiempo_meses').select2();

</script>
@endsection
</x-app-layout>
