<x-app-layout>
    <style>
        .input-with-border {
                border: 1px solid black;
            }
            table {
  width: 100%;
}

.sticky-column {
  position: sticky;
  background-color: #fff; /* Ajusta el color de fondo según tu diseño */
}

.sticky-column:nth-child(1) {
  left: 0;
}

.sticky-column:nth-child(2) {
  left: 70px; /* Ajusta el valor para el ancho de la primera columna */
}

.sticky-column th {
  top: 0;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Autorización De Liberacion De Unidades </div>
					
				</div>
				
				
				<div class="card-body">
                @if ($mensaje!="")
                    
                    <div class="alert alert-{{ $color }} alert-dismissible" data-dismiss="alert">
                        
                        {{ $mensaje }}.
                        
                    </div>
                @endif
              
          
					
                    <div class="row">
								

                               
							</div>
							
							
							<br>
                            <div class="row">
								<div class="col-md-12">
                                    <div class="table-responsive" >
                                    <table class="table  " id="autoerizacion">
                                        <thead><tr>
                                            
                                                <td class="sticky-column bg-danger sorting " style="color:#ffffff; width: 6%;" ><center>ID bitacora</center></td>
                                                <td class=" bg-danger sorting " style="color:#ffffff; width: 6%;" ><center>Estatus</center></td>
                                                <td class="bg-danger " style="color:#ffffff; width: 6%;"><center>Eco</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Mecanico</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Supervisor</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Km</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bares</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Aceite de motor</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Aceite de motor (Lt)</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Aceite de motor observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Refrigerante</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Refrigerante (Lt)</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Refrigerante observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Aceite hidraulico</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Aceite hidraulico (Lt)</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Aceite hidraulico observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hidroventilador</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hidroventilador (Lt)</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Hidroventilador observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Servicio</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Servicio falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Servicio observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Emergencia</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Emergencia falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Emergencia observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje direccional izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje direccional izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje direccional izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje direccional izquierdo derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje direccional izquierdo derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje direccional izquierdo derecho observacion</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje intermedio izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje intermedio izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje intermedio izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje intermedio derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje intermedio derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje intermedio derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje motriz izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje motriz izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Neumatico eje motriz izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje motriz derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje motriz derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Neumatico eje motriz derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje direccional izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje direccional izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje direccional izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje direccional derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje direccional derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje direccional derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje intermedio izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje intermedio izquierdo fallas</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje intermedio izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje intermedio derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje intermedio derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje intermedio derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje motriz izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje motriz izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Balatas eje motriz izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje motriz derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje motriz derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Balatas eje motriz derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje direccional izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje direccional izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje direccional izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje direccional derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje direccional derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje direccional derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje intermedio izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje intermedio izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje intermedio izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje intermedio derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje intermedio derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje intermedio derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje motriz izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje motriz izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Bolsa de aire eje motriz izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje motriz derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje motriz derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Bolsa de aire eje motriz derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Asiento del conductor</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Asiento del conductor falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Asiento del conductor observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Asiento del carro 1</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Asiento del carro 1 falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Asiento del carro 1 observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Asiento del carro 2</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Asiento del carro 2 falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Asiento del carro 2 observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Codigo del display</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Codigo del display observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Articulación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Articulación falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Articulación observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Articulación soporte</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Articulación soporte falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Articulación soporte observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Articulación granada</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Articulación granada falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Articulación granada observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Calibración de neumatico modulo </center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Calibración de neumatico modulo falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Calibración de neumatico modulo observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje direccional izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje direccional izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje direccional izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje direccional derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje direccional derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje direccional derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje intermedio izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje intermedio izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje intermedio izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje intermedio derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje intermedio derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje intermedio derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje motriz izquierdo</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje motriz izquierdo falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Eje motriz izquierdo observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje motriz derecho</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje motriz derecho falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Eje motriz derecho observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Suspensión eje 1</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Suspensión eje 1 falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Suspensión eje 1 observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Suspensión eje 2</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Suspensión eje 2 falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Suspensión eje 2 observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Suspensión eje 3</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Suspensión eje 3 falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Suspensión eje 3 observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tanque drenado</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tanque drenado falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tanque drenado observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tanque chicote</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tanque chicote falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tanque chicote observación</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Soporte motor</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Soporte motor falla</center></td>
                                                <td class="bg sorting" style="color:#ffffff; width: 6%; background-color:#D9C3A0;"><center>Soporte motor observación</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Soporte transmisión</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Soporte transmisión falla</center></td>
                                                <td class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Soporte transmisión observación</center></td>
</tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                        @php
                                          $i=0;
                                          @endphp
                                        @foreach($consulta as $fila)
                                         @if($i % 2 == 0)
                                        <tr style="background-color:white; color:black;">
                                        @else
                                        
                                        <tr style="background-color:#aaa; color:white;">
                                        @endif
                                        <form method="post" id="exampleValidation" action="{{url('/Autorizacion_check_mantenimiento')}}">
					@csrf
                                              <td class="sticky-column" style="color:black;">{{$fila->id_bitacora_liberacion_unidades}}</td>
                                                <td class="sticky-column">
                                                <input type="submit" class="btn btn-success" name="Aprobar" id="Aprobar" value="Aprobar">
                                                <input type="submit" class="btn btn-danger" name="Rechazar" id="Rechazar" value="Rechazar">
                                                <input type="submit" class="btn btn-warning" name="pendientes" id="pendientes" value="Aprobar con pendientes">
                                                
                                                <input type="submit" class="btn btn-info" name="previo" id="previo" value="Ver previo">
                                                <input type="hidden" value="{{$fila->id_bitacora_liberacion_unidades}}" name="id" id="id">
                                            </td>
                                            
						
                        </form>
                                              <td>{{$fila->n_economico}}</td>
                                              <td>{{$fila->n_mecanico}}</td>
                                              <td>{{$fila->nom_supervisor}}</td>
                                              <td>{{$fila->fecha_creacion}}</td>
                                              <td>{{ number_format($fila->km, 0, '.', ',') }}</td>
                                              <td>{{$fila->bares}}</td>
                                              <td><center>@if($fila->aceite_motor=='ok')Ok @elseif($fila->aceite_motor=='cambio') Cambio @else N/A @endif </center></td>
                                              <td>{{$fila->aceite_motor_lt}}</td>
                                              <td>@if($fila->aceite_motor_o== NULL) <center> S/O </center>  @else {{$fila->aceite_motor_o}} @endif </td>
                                              <td><center>@if($fila->refrigerante=='ok')Ok @elseif($fila->refrigerante=='cambio') Cambio @else N/A @endif </center></td>
                                              <td>{{$fila->refrigerante_lt}}</td>
                                              <td>@if($fila->refrigerante_o== NULL) <center> S/O </center>  @else {{$fila->refrigerante_o}} @endif </td>
                                              <td><center>@if($fila->aceite_hidra=='ok')Ok @elseif($fila->aceite_hidra=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td>{{$fila->aceite_hidra_lt}}</td>
                                              <td>@if($fila->aceite_hidra_o== NULL) <center> S/O </center>  @else {{$fila->aceite_hidra_o}} @endif </td>
                                              <td><center>@if($fila->hidroven=='ok')Ok @elseif($fila->hidroven=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td>{{$fila->hidroven_lt}}</td>
                                              <td>@if($fila->hidroven_o== NULL) <center> S/O </center>  @else {{$fila->hidroven_o}} @endif </td>
                                              <td><center>@if($fila->servicio=='ok')Ok @elseif($fila->servicio=='cambio') Cambio @else N/A @endif  </center></td>

                                              <td><center> @if($consulta_fallas[$i]->Puertas__SERVICIO==null) Sin fallas @else {{$consulta_fallas[$i]->Puertas__SERVICIO}} @endif  </center></td>

                                              <td>@if($fila->servicio_o== NULL) <center> S/O </center>  @else {{$fila->servicio_o}} @endif </td>
                                              <td><center>@if($fila->emergencia=='ok')Ok @elseif($fila->emergencia=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->Puertas__EMERGENCIA==null) Sin fallas @else {{$consulta_fallas[$i]->Puertas__EMERGENCIA}} @endif  </center></td>

                                              <td>@if($fila->emergencia_o== NULL) <center> S/O </center>  @else {{$fila->emergencia_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_dir_izq=='ok')Ok @elseif($fila->neu_eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_dir_der=='ok')Ok @elseif($fila->neu_eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_int_izq=='ok')Ok @elseif($fila->neu_eje_int_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_int_izq_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_int_izq_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_int_der=='ok')Ok @elseif($fila->neu_eje_int_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_int_der_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_int_der_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_motr_izq=='ok')Ok @elseif($fila->neu_eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->neu_eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->neu_eje_motr_der=='ok')Ok @elseif($fila->neu_eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                               <td>@if($fila->neu_eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->neu_eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_dir_izq=='ok')Ok @elseif($fila->bal_eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->bal_eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_dir_der=='ok')Ok @elseif($fila->bal_eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_DERECHO}} @endif  </center></td>

                                              <td>@if($fila->bal_eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_int_izq=='ok')Ok @elseif($fila->bal_eje_int_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO}} @endif  </center></td>

                                              <td>@if($fila->bal_eje_int_izq_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_int_izq_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_int_der=='ok')Ok @elseif($fila->bal_eje_int_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bal_eje_int_der_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_int_der_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_motr_izq=='ok')Ok @elseif($fila->bal_eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bal_eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->bal_eje_motr_der=='ok')Ok @elseif($fila->bal_eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bal_eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->bal_eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_dir_izq=='ok')Ok @elseif($fila->bols_air_eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_dir_der=='ok')Ok @elseif($fila->bols_air_eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_int_izq=='ok')Ok @elseif($fila->bols_air_eje_int_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_int_izq_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_int_izq_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_int_der=='ok')Ok @elseif($fila->bols_air_eje_int_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_int_der_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_int_der_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_motr_izq=='ok')Ok @elseif($fila->bols_air_eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->bols_air_eje_motr_der=='ok')Ok @elseif($fila->bols_air_eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->bols_air_eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->bols_air_eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->asiento_conductor=='ok')Ok @elseif($fila->asiento_conductor=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ASIENTOS__CONDUCTOR==null) Sin fallas @else {{$consulta_fallas[$i]->ASIENTOS__CONDUCTOR}} @endif  </center></td>

                                              
                                              <td>@if($fila->asiento_conductor_o== NULL) <center> S/O </center>  @else {{$fila->asiento_conductor_o}} @endif </td>
                                              <td><center>@if($fila->asiento_carro1=='ok')Ok @elseif($fila->asiento_carro1=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ASIENTOS__CARRO_1==null) Sin fallas @else {{$consulta_fallas[$i]->ASIENTOS__CARRO_1}} @endif  </center></td>

                                              
                                              <td>@if($fila->asiento_carro1_o== NULL) <center> S/O </center>  @else {{$fila->asiento_carro1_o}} @endif </td>
                                              <td><center>@if($fila->asiento_carro2=='ok')Ok @elseif($fila->asiento_carro2=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ASIENTOS__CARRO_2==null) Sin fallas @else {{$consulta_fallas[$i]->ASIENTOS__CARRO_2}} @endif  </center></td>

                                              
                                              <td>@if($fila->asiento_carro2_o== NULL) <center> S/O </center>  @else {{$fila->asiento_carro2_o}} @endif </td>
                                             
                                              <td>{{$fila->codigo_display}}</td>
                                              
                                              <td>@if($fila->codigo_display_o== NULL) <center> S/O </center>  @else {{$fila->codigo_display_o}} @endif </td>
                                              <td><center>@if($fila->articulacion=='ok')Ok @elseif($fila->articulacion=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ARTICULACION__ARTICULACION==null) Sin fallas @else {{$consulta_fallas[$i]->ARTICULACION__ARTICULACION}} @endif  </center></td>

                                              
                                              <td>@if($fila->articulacion_o== NULL) <center> S/O </center>  @else {{$fila->articulacion_o}} @endif </td>
                                              <td><center>@if($fila->articulacion_soporte=='ok')Ok @elseif($fila->articulacion_soporte=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ARTICULACION__SOPORTE==null) Sin fallas @else {{$consulta_fallas[$i]->ARTICULACION__SOPORTE}} @endif  </center></td>

                                              
                                              <td>@if($fila->articulacion_soporte_o== NULL) <center> S/O </center>  @else {{$fila->articulacion_soporte_o}} @endif </td>
                                              <td><center>@if($fila->articulacion_granada=='ok')Ok @elseif($fila->articulacion_granada=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->ARTICULACION__GRANADAS==null) Sin fallas @else {{$consulta_fallas[$i]->ARTICULACION__GRANADAS}} @endif  </center></td>

                                              
                                              <td>@if($fila->articulacion_granada_o== NULL) <center> S/O </center>  @else {{$fila->articulacion_granada_o}} @endif </td>
                                              <td><center>@if($fila->calibracion_neum_granada=='ok')Ok @elseif($fila->calibracion_neum_granada=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->CALIBRACION_DE_NEUMATICOS__GRANADAS==null) Sin fallas @else {{$consulta_fallas[$i]->CALIBRACION_DE_NEUMATICOS__GRANADAS}} @endif  </center></td>

                                              
                                              <td>@if($fila->calibracion_neum_granada_o== NULL) <center> S/O </center>  @else {{$fila->calibracion_neum_granada_o}} @endif </td>
                                              <td><center>@if($fila->eje_dir_izq=='ok')Ok @elseif($fila->eje_dir_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_dir_izq_o== NULL) <center> S/O </center>  @else {{$fila->eje_dir_izq_o}} @endif </td>
                                              <td><center>@if($fila->eje_dir_der=='ok')Ok @elseif($fila->eje_dir_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_dir_der_o== NULL) <center> S/O </center>  @else {{$fila->eje_dir_der_o}} @endif </td>
                                              <td><center>@if($fila->eje_inter_izq=='ok')Ok @elseif($fila->eje_inter_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_INTERMEDIO__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_INTERMEDIO__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_inter_izq_o== NULL) <center> S/O </center>  @else {{$fila->eje_inter_izq_o}} @endif </td>
                                              <td><center>@if($fila->eje_inter_der=='ok')Ok @elseif($fila->eje_inter_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_INTERMEDIO__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_INTERMEDIO__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_inter_der_o== NULL) <center> S/O </center>  @else {{$fila->eje_inter_der_o}} @endif </td>
                                              <td><center>@if($fila->eje_motr_izq=='ok')Ok @elseif($fila->eje_motr_izq=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_MOTRIZ__LADO_IZQUIERDO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_MOTRIZ__LADO_IZQUIERDO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_motr_izq_o== NULL) <center> S/O </center>  @else {{$fila->eje_motr_izq_o}} @endif </td>
                                              <td><center>@if($fila->eje_motr_der=='ok')Ok @elseif($fila->eje_motr_der=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->EJE_MOTRIZ__LADO_DERECHO==null) Sin fallas @else {{$consulta_fallas[$i]->EJE_MOTRIZ__LADO_DERECHO}} @endif  </center></td>

                                              
                                              <td>@if($fila->eje_motr_der_o== NULL) <center> S/O </center>  @else {{$fila->eje_motr_der_o}} @endif </td>
                                              <td><center>@if($fila->susp_eje1=='ok')Ok @elseif($fila->susp_eje1=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SUSPENCION__EJE_1==null) Sin fallas @else {{$consulta_fallas[$i]->SUSPENCION__EJE_1}} @endif  </center></td>

                                              
                                              <td>@if($fila->susp_eje1_o== NULL) <center> S/O </center>  @else {{$fila->susp_eje1_o}} @endif </td>
                                              <td><center>@if($fila->susp_eje2=='ok')Ok @elseif($fila->susp_eje2=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SUSPENCION__EJE_2==null) Sin fallas @else {{$consulta_fallas[$i]->SUSPENCION__EJE_2}} @endif  </center></td>

                                              
                                              <td>@if($fila->susp_eje2_o== NULL) <center> S/O </center>  @else {{$fila->susp_eje2_o}} @endif </td>
                                              <td><center>@if($fila->susp_eje3=='ok')Ok @elseif($fila->susp_eje3=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SUSPENCION__EJE_3==null) Sin fallas @else {{$consulta_fallas[$i]->SUSPENCION__EJE_3}} @endif  </center></td>

                                              
                                              <td>@if($fila->susp_eje3_o== NULL) <center> S/O </center>  @else {{$fila->susp_eje3_o}} @endif </td>
                                              <td><center>@if($fila->tan_drenado=='ok')Ok @elseif($fila->tan_drenado=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->TANQUE__DRENADO==null) Sin fallas @else {{$consulta_fallas[$i]->TANQUE__DRENADO}} @endif  </center></td>

                                              
                                              <td>@if($fila->tan_drenado_o== NULL) <center> S/O </center>  @else {{$fila->tan_drenado_o}} @endif </td>
                                              <td><center>@if($fila->tan_chicote=='ok')Ok @elseif($fila->tan_chicote=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->TANQUE__CHICOTES==null) Sin fallas @else {{$consulta_fallas[$i]->TANQUE__CHICOTES}} @endif  </center></td>

                                              
                                              <td>@if($fila->tan_chicote_o== NULL) <center> S/O </center>  @else {{$fila->tan_chicote_o}} @endif </td>
                                              <td><center>@if($fila->soport_motor=='ok')Ok @elseif($fila->soport_motor=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SOPORTES__MOTOR==null) Sin fallas @else {{$consulta_fallas[$i]->SOPORTES__MOTOR}} @endif  </center></td>

                                              
                                              <td>@if($fila->soport_motor_o== NULL) <center> S/O </center>  @else {{$fila->soport_motor_o}} @endif </td>
                                              <td><center>@if($fila->soport_transmi=='ok')Ok @elseif($fila->soport_transmi=='cambio') Cambio @else N/A @endif  </center></td>
                                              <td><center> @if($consulta_fallas[$i]->SOPORTES__TRANSMISION==null) Sin fallas @else {{$consulta_fallas[$i]->SOPORTES__TRANSMISION}} @endif  </center></td>

                                              
                                              <td>@if($fila->soport_transmi_o== NULL) <center> S/O </center>  @else {{$fila->soport_transmi_o}} @endif </td>
                                          </tr>
                                          @php
                                          $i=$i+1;
                                          @endphp
                                      @endforeach
                                    </tbody>

                                    </table>

                                    </div>
								</div>
							</div>
							
						</div>
						<div class="card-footer">{{-- inicio del row --}}
							
							{{-- fin del row --}}
						</div>

					</div>
					

        </div>
    </div>

	
@section('jscustom')
<script type="text/javascript">
	
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
	var table = $('#autoerizacion').DataTable({
        scrollX: false, // Habilita el desplazamiento horizontal
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[7, 14, 21, 28, 35, -1], [7, 14, 21, 28, 35, "Todos"]],
        iDisplayLength: 7,
        dom: 'lBfrtip', // Agrega los elementos que quieres mostrar y sus ubicaciones
        buttons: [ // Configura los botones de descarga
            'excel' // Agrega el botón de Excel
        ],
        fixedColumns: {
            leftColumns: 2 // Fija las dos primeras columnas
        },
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

</script>
@endsection
</x-app-layout>
