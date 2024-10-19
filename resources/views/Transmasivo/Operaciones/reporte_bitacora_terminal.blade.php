<!DOCTYPE html>
        <html>
      <head>
            <style>
                 body {
                font-size: 10px;
            }
                table {
                  font-family: arial, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
              }

              td, th {
                  border: 1px solid #000000;
                  text-align: right;
                  padding: 2px;
              }

              tr:nth-child(even) {
                 ;
              }
          </style>
      </head>
        <body>
            <?php
                $nombreImagen = url('')."/assets/img/transmasivo.png";
                $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
            ?>
    <table style="border: 1px #ffffff; solid;">
        <tr>
            <td style="width: 30%; border: 1px #ffffff; solid;">
                <a class="big-logo">
                    <img src="<?php echo $imagenBase64 ?>" alt="logo img" style="width:200px;" class="logo-img">
                </a>
            </td>
            <td style="width: 70%; border: 1px #ffffff solid; font-size: 15px;"><center><b>Bitacora de operaciones</b></center></td>
        </tr>
    </table>
    <table class="table table-hover table-striped table-bordered "  id="list_user2">
                            <thead>
                            <tr>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 6%;"><center>Serv.</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 6%;"><center>Credencial</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 4%;"><center>Ciclo</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 22%;"><center>Salida 1</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 20%;"><center>Llegada 1</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 22%;"><center>Salida 2</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 20%;"><center>Llegada 2</center></th>
                                <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 2%;"><center>Km circuito</center></th>
                            </tr>
                            </thead>
                            <tbody id="llenaTabla" >
                            @php $contador = 0; @endphp
                    @php $anterior_ciclo = 0; @endphp
                    @php $anterior_credencial = 0; @endphp
                    @php $repetido = 0; @endphp
                    @php $naranja = 0; @endphp

                    
                    @php $Ojo_De_Agua_1 = 0; @endphp
                    @php $Esmeralda_1 = 1.47; @endphp
                    @php $Cuauhtemoc_Norte_1 = 2; @endphp
                    @php $Cuauhtemoc_Sur_1 = 3.05; @endphp
                    @php $Hidalgo_1 = 3.58; @endphp
                    @php $Insurgentes_1 = 4.39; @endphp
                    @php $Central_De_Abastos_1 = 5.3; @endphp
                    @php $e_19_De_Septiembre_1 = 6.62; @endphp
                    @php $Palomas_1 = 7.6; @endphp
                    @php $Jardines_De_Morelos_1 = 8; @endphp
                    @php $Aquiles_Serdan_1 = 8.26; @endphp
                    @php $Hospital_1 = 8.77; @endphp
                    @php $e_1ro_De_Mayo_1 = 9.6; @endphp
                    @php $Las_Americas_1 = 10.55; @endphp
                    @php $Valle_De_Ecatepec_1 = 11.64; @endphp
                    @php $Vocacional_3_1 = 12.4; @endphp
                    @php $Adolfo_Lopez_Mateos_1 = 12.5; @endphp
                    @php $Zodiaco_1 = 13; @endphp
                    @php $Alfredo_Torres_1 = 13.58; @endphp
                    @php $Unitec_1 = 14.02; @endphp
                    @php $Estacion_Industrial_1 = 14.5; @endphp
                    @php $Josefa_Ortiz_De_Dominguez_1 = 15; @endphp
                    @php $Quinto_Sol_1 = 15.83; @endphp
                    @php $Ciudad_Azteca_1 = 16.5; @endphp

                    @php $Ojo_De_Agua_2 = 17.1; @endphp
                    @php $Esmeralda_2 = 15; @endphp
                    @php $Cuauhtemoc_Norte_2 = 14.5; @endphp
                    @php $Cuauhtemoc_Sur_2 = 13.47; @endphp
                    @php $Hidalgo_2 = 12.9; @endphp
                    @php $Insurgentes_2 = 12.04; @endphp
                    @php $Central_De_Abastos_2 = 11.3; @endphp
                    @php $e_19_De_Septiembre_2 = 9.8; @endphp
                    @php $Palomas_2 = 9.39; @endphp
                    @php $Jardines_De_Morelos_2 = 8.45; @endphp
                    @php $Aquiles_Serdan_2 = 8.18; @endphp
                    @php $Hospital_2 = 7.66; @endphp
                    @php $e_1ro_De_Mayo_2 = 6.73; @endphp
                    @php $Las_Americas_2 = 5.88; @endphp
                    @php $Valle_De_Ecatepec_2 = 4.8; @endphp
                    @php $Vocacional_3_2 = 4.31; @endphp
                    @php $Adolfo_Lopez_Mateos_2 = 3.93; @endphp
                    @php $Zodiaco_2 = 3.45; @endphp
                    @php $Alfredo_Torres_2 = 2.86; @endphp
                    @php $Unitec_2 = 2.34; @endphp
                    @php $Estacion_Industrial_2 = 1.86; @endphp
                    @php $Josefa_Ortiz_De_Dominguez_2 = 1.41; @endphp
                    @php $Quinto_Sol_2 = 0.6; @endphp
                    @php $Ciudad_Azteca_2 = 0; @endphp

                    @if(null !== $consulta)
                    @foreach($consulta as $fila)
                    @php $salida_1=0; @endphp
                    @php $llegada_1=0; @endphp
                    @php $salida_2=0; @endphp
                    @php $llegada_2=0; @endphp
                    <tr>
                        @if($fila['Servicio']=="TR1")
                        <td>
                            <center>
                                <span class="badge" style="background-color: #e5be01; color:black; font-size:12px;">
                                    {{$fila['Servicio']}}
                                </span>
                            </center>
                        </td>
                        @elseif($fila['Servicio']=="TR1-R")
                        <td>
                            <center>
                                <span class="badge" style="background-color: #FF0080; color:#fff; font-size:12px;">
                                    {{$fila['Servicio']}}
                                </span>
                            </center>
                        </td>
                        @elseif($fila['Servicio']=="TR3")
                        <td>
                            <center>
                                <span class="badge" style="background-color: #008f39; color:#fff; font-size:12px;">
                                    {{$fila['Servicio']}}
                                </span>
                            </center>
                        </td>
                        @elseif($fila['Servicio']=="TR4")
                        <td>
                            <center>
                                <span class="badge" style="background-color: #0000ff; color:#fff; font-size:12px;">
                                    {{$fila['Servicio']}}
                                </span>
                            </center>
                        </td>
                        @endif
                        <td>
                            <center>
                                <span class="" style=" color: black; font-size:12px;">
                                    Cred. {{$fila['credencial']}}
                                </span>
                            </center>
                        </td>
                        <td>
                            <center>
                                <span class="" style=" color: black; font-size:12px;">
                                    Ciclo {{$fila['ciclo']}}
                                </span>
                            </center>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                            <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                            <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_1_eco']}}</i> - Terminal: {{$fila['terminal1']}}</div>
                                        </center> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body">
                                            <span class="badge " style=" color:black"><i class="la la-bus"></i> Salida<br> {{$fila['salida_1']}} hrs.</span>
                                        </div>   
                                    </center> 
                                </div>
                                <div class="col-md-6"> 
                                    <div class="card-body">
                                        <center>
                                            @if($fila['hora_salida_rol']=="Fuera de jornada")
                                            <span class="badge" style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol']}}</span>
                                            @else
                                            <span class="badge " style=" color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                            @endif
                                        </center>
                                    </div>    
                                </div>
                                <div class="col-md-6">    
                                    <div class="card-body">
                                        <center>
                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia']}}</span>
                                            @else
                                            <span class="badge "  style="color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                            @endif
                                        </center>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body" >
                                            @if($fila['estatus']=="Retardo")
                                            <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                            @elseif($fila['estatus']=="Sobretiempo")
                                            <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                            @elseif($fila['estatus']=="En tiempo")
                                            <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus']}}</span>
                                            @endif
                                        </div>  
                                    </center>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        {{$fila['salida_1_com']}}
                                    </div>  
                                </div>
                            </div>
                        </td> 
                        @if($fila['salida_1_ter']==1)  @php $salida_1 = $Ojo_De_Agua_1; @endphp
                        @elseif($fila['salida_1_ter']==2)  @php $salida_1 = $Central_De_Abastos_1; @endphp
                        @elseif($fila['salida_1_ter']==3)  @php $salida_1 = $Ciudad_Azteca_1 @endphp
                        @elseif($fila['salida_1_ter']==4)  @php $salida_1 = $Esmeralda_1; @endphp
                        @elseif($fila['salida_1_ter']==5)  @php $salida_1 = $Cuauhtemoc_Norte_1; @endphp
                        @elseif($fila['salida_1_ter']==6)  @php $salida_1 = $Cuauhtemoc_Sur_1; @endphp
                        @elseif($fila['salida_1_ter']==7)  @php $salida_1 = $Hidalgo_1; @endphp
                        @elseif($fila['salida_1_ter']==8)  @php $salida_1 = $Insurgentes_1; @endphp
                        @elseif($fila['salida_1_ter']==9)  @php $salida_1 = $e_19_De_Septiembre_1; @endphp
                        @elseif($fila['salida_1_ter']==10)  @php $salida_1 = $Palomas_1; @endphp
                        @elseif($fila['salida_1_ter']==11)  @php $salida_1 = $Jardines_De_Morelos_1; @endphp
                        @elseif($fila['salida_1_ter']==12)  @php $salida_1 = $Aquiles_Serdan_1; @endphp
                        @elseif($fila['salida_1_ter']==13)  @php $salida_1 = $Hospital_1; @endphp
                        @elseif($fila['salida_1_ter']==14)  @php $salida_1 = $e_1ro_De_Mayo_1; @endphp
                        @elseif($fila['salida_1_ter']==15)  @php $salida_1 = $Las_Americas_1; @endphp
                        @elseif($fila['salida_1_ter']==16)  @php $salida_1 = $Valle_De_Ecatepec_1; @endphp
                        @elseif($fila['salida_1_ter']==17)  @php $salida_1 = $Vocacional_3_1; @endphp
                        @elseif($fila['salida_1_ter']==18)  @php $salida_1 = $Adolfo_Lopez_Mateos_1; @endphp
                        @elseif($fila['salida_1_ter']==19)  @php $salida_1 = $Zodiaco_1; @endphp
                        @elseif($fila['salida_1_ter']==20)  @php $salida_1 = $Alfredo_Torres_1; @endphp
                        @elseif($fila['salida_1_ter']==21)  @php $salida_1 = $Unitec_1 ; @endphp
                        @elseif($fila['salida_1_ter']==22)  @php $salida_1 = $Estacion_Industrial_1; @endphp
                        @elseif($fila['salida_1_ter']==23)  @php $salida_1 = $Josefa_Ortiz_De_Dominguez_1; @endphp
                        @elseif($fila['salida_1_ter']==24)  @php $salida_1 = $Quinto_Sol_1; @endphp
                        @endif


                        @if($fila['llegada_1']=="Sin datos")
                        <td>
                            <center> Sin datos</center>
                        </td>
                        @else
                        
                        @if($fila['salida_2_ter']==1)  @php $llegada_1 = $Ojo_De_Agua_1; @endphp
                        @elseif($fila['salida_2_ter']==2)  @php $llegada_1 = $Central_De_Abastos_1; @endphp
                        @elseif($fila['salida_2_ter']==3)  @php $llegada_1 = $Ciudad_Azteca_1 @endphp
                        @elseif($fila['salida_2_ter']==4)  @php $llegada_1 = $Esmeralda_1; @endphp
                        @elseif($fila['salida_2_ter']==5)  @php $llegada_1 = $Cuauhtemoc_Norte_1; @endphp
                        @elseif($fila['salida_2_ter']==6)  @php $llegada_1 = $Cuauhtemoc_Sur_1; @endphp
                        @elseif($fila['salida_2_ter']==7)  @php $llegada_1 = $Hidalgo_1; @endphp
                        @elseif($fila['salida_2_ter']==8)  @php $llegada_1 = $Insurgentes_1; @endphp
                        @elseif($fila['salida_2_ter']==9)  @php $llegada_1 = $e_19_De_Septiembre_1; @endphp
                        @elseif($fila['salida_2_ter']==10)  @php $llegada_1 = $Palomas_1; @endphp
                        @elseif($fila['salida_2_ter']==11)  @php $llegada_1 = $Jardines_De_Morelos_1; @endphp
                        @elseif($fila['salida_2_ter']==12)  @php $llegada_1 = $Aquiles_Serdan_1; @endphp
                        @elseif($fila['salida_2_ter']==13)  @php $llegada_1 = $Hospital_1; @endphp
                        @elseif($fila['salida_2_ter']==14)  @php $llegada_1 = $e_1ro_De_Mayo_1; @endphp
                        @elseif($fila['salida_2_ter']==15)  @php $llegada_1 = $Las_Americas_1; @endphp
                        @elseif($fila['salida_2_ter']==16)  @php $llegada_1 = $Valle_De_Ecatepec_1; @endphp
                        @elseif($fila['salida_2_ter']==17)  @php $llegada_1 = $Vocacional_3_1; @endphp
                        @elseif($fila['salida_2_ter']==18)  @php $llegada_1 = $Adolfo_Lopez_Mateos_1; @endphp
                        @elseif($fila['salida_2_ter']==19)  @php $llegada_1 = $Zodiaco_1; @endphp
                        @elseif($fila['salida_2_ter']==20)  @php $llegada_1 = $Alfredo_Torres_1; @endphp
                        @elseif($fila['salida_2_ter']==21)  @php $llegada_1 = $Unitec_1 ; @endphp
                        @elseif($fila['salida_2_ter']==22)  @php $llegada_1 = $Estacion_Industrial_1; @endphp
                        @elseif($fila['salida_2_ter']==23)  @php $llegada_1 = $Josefa_Ortiz_De_Dominguez_1; @endphp
                        @elseif($fila['salida_2_ter']==24)  @php $llegada_1 = $Quinto_Sol_1; @endphp
                        @endif
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                            <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                            <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_2_eco']}}</i> - Terminal: {{$fila['terminal2']}}</div>
                                        </center> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <div class="card-body">
                                            <span class="badge " style=" color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['llegada_1']}} hrs.</span>
                                        </div>   
                                    </center> 
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        {{$fila['salida_2_com']}}
                                    </div>  
                                </div>
                            </div>
                        </td> 
                        @endif

                        @if($fila['salida_2']=="Sin datos")
                        <td>
                            <center> Sin datos</center>
                        </td>
                        @else

                        @if($fila['salida_3_ter']==1)  @php $salida_2 = $Ojo_De_Agua_2; @endphp
                        @elseif($fila['salida_3_ter']==2)  @php $salida_2 = $Central_De_Abastos_2; @endphp
                        @elseif($fila['salida_3_ter']==3)  @php $salida_2 = $Ciudad_Azteca_2 @endphp
                        @elseif($fila['salida_3_ter']==4)  @php $salida_2 = $Esmeralda_2; @endphp
                        @elseif($fila['salida_3_ter']==5)  @php $salida_2 = $Cuauhtemoc_Norte_2; @endphp
                        @elseif($fila['salida_3_ter']==6)  @php $salida_2 = $Cuauhtemoc_Sur_2; @endphp
                        @elseif($fila['salida_3_ter']==7)  @php $salida_2 = $Hidalgo_2; @endphp
                        @elseif($fila['salida_3_ter']==8)  @php $salida_2 = $Insurgentes_2; @endphp
                        @elseif($fila['salida_3_ter']==9)  @php $salida_2 = $e_19_De_Septiembre_2; @endphp
                        @elseif($fila['salida_3_ter']==10)  @php $salida_2 = $Palomas_2; @endphp
                        @elseif($fila['salida_3_ter']==11)  @php $salida_2 = $Jardines_De_Morelos_2; @endphp
                        @elseif($fila['salida_3_ter']==12)  @php $salida_2 = $Aquiles_Serdan_2; @endphp
                        @elseif($fila['salida_3_ter']==13)  @php $salida_2 = $Hospital_2; @endphp
                        @elseif($fila['salida_3_ter']==14)  @php $salida_2 = $e_1ro_De_Mayo_2; @endphp
                        @elseif($fila['salida_3_ter']==15)  @php $salida_2 = $Las_Americas_2; @endphp
                        @elseif($fila['salida_3_ter']==16)  @php $salida_2 = $Valle_De_Ecatepec_2; @endphp
                        @elseif($fila['salida_3_ter']==17)  @php $salida_2 = $Vocacional_3_2; @endphp
                        @elseif($fila['salida_3_ter']==18)  @php $salida_2 = $Adolfo_Lopez_Mateos_2; @endphp
                        @elseif($fila['salida_3_ter']==19)  @php $salida_2 = $Zodiaco_2; @endphp
                        @elseif($fila['salida_3_ter']==20)  @php $salida_2 = $Alfredo_Torres_2; @endphp
                        @elseif($fila['salida_3_ter']==21)  @php $salida_2 = $Unitec_2 ; @endphp
                        @elseif($fila['salida_3_ter']==22)  @php $salida_2 = $Estacion_Industrial_2; @endphp
                        @elseif($fila['salida_3_ter']==23)  @php $salida_2 = $Josefa_Ortiz_De_Dominguez_2; @endphp
                        @elseif($fila['salida_3_ter']==24)  @php $salida_2 = $Quinto_Sol_2; @endphp
                        @endif

                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                            <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                            <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_3_eco']}}</i> - Terminal: {{$fila['terminal3']}} </div>
                                        </center> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body">
                                            <span class="badge " style="color:black"><i class="la la-bus"></i> Salida<br> {{$fila['salida_2']}} hrs.</span>
                                        </div>   
                                    </center> 
                                </div>
                                <div class="col-md-6"> 
                                    <div class="card-body">
                                        <center>
                                            @if($fila['hora_salida_rol_2']=="Fuera de jornada")
                                            <span class="badge" style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_salida_rol_2']}}</span>
                                            @else
                                            <span class="badge " style=" color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol_2']}} hrs.</span>
                                            @endif
                                        </center>
                                    </div>    
                                </div>
                                <div class="col-md-6">    
                                    <div class="card-body">
                                        <center>
                                            @if($fila['hora_diferencia_2']=="Fuera de jornada")
                                            <span class="badge "  style="background-color: yellow; color:black; font-size:12px;"> {{$fila['hora_diferencia_2']}}</span>
                                            @else
                                            <span class="badge "  style="color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia_2']}} hrs.</span>
                                            @endif
                                        </center>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <div class="card-body" >
                                            @if($fila['estatus_2']=="Retardo")
                                            <span class="badge "  style="background-color: #fffeba; color:black; font-size:14px;"> {{$fila['estatus_2']}}</span>
                                            @elseif($fila['estatus_2']=="Sobretiempo")
                                            <span class="badge "  style="background-color: #c4dafa; color:black; font-size:14px;"> {{$fila['estatus_2']}}</span>
                                            @elseif($fila['estatus_2']=="En tiempo")
                                            <span class="badge "  style="background-color: #92fd70; color:black; font-size:14px;"> {{$fila['estatus_2']}}</span>
                                            @endif
                                        </div>  
                                    </center>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-sub">
                                        {{$fila['salida_3_com']}}
                                    </div>  
                                </div>
                            </div>
                        </td> 
                        @endif
                        @if($fila['llegada_2']=="Sin datos")
                        <td>
                         <center> Sin datos</center>
                     </td>
                     @else


                     @if($fila['salida_4_ter']==1)  @php $llegada_2 = $Ojo_De_Agua_2; @endphp
                     @elseif($fila['salida_4_ter']==2)  @php $llegada_2 = $Central_De_Abastos_2; @endphp
                     @elseif($fila['salida_4_ter']==3)  @php $llegada_2 = $Ciudad_Azteca_2 @endphp
                     @elseif($fila['salida_4_ter']==4)  @php $llegada_2 = $Esmeralda_2; @endphp
                     @elseif($fila['salida_4_ter']==5)  @php $llegada_2 = $Cuauhtemoc_Norte_2; @endphp
                     @elseif($fila['salida_4_ter']==6)  @php $llegada_2 = $Cuauhtemoc_Sur_2; @endphp
                     @elseif($fila['salida_4_ter']==7)  @php $llegada_2 = $Hidalgo_2; @endphp
                     @elseif($fila['salida_4_ter']==8)  @php $llegada_2 = $Insurgentes_2; @endphp
                     @elseif($fila['salida_4_ter']==9)  @php $llegada_2 = $e_19_De_Septiembre_2; @endphp
                     @elseif($fila['salida_4_ter']==10)  @php $llegada_2 = $Palomas_2; @endphp
                     @elseif($fila['salida_4_ter']==11)  @php $llegada_2 = $Jardines_De_Morelos_2; @endphp
                     @elseif($fila['salida_4_ter']==12)  @php $llegada_2 = $Aquiles_Serdan_2; @endphp
                     @elseif($fila['salida_4_ter']==13)  @php $llegada_2 = $Hospital_2; @endphp
                     @elseif($fila['salida_4_ter']==14)  @php $llegada_2 = $e_1ro_De_Mayo_2; @endphp
                     @elseif($fila['salida_4_ter']==15)  @php $llegada_2 = $Las_Americas_2; @endphp
                     @elseif($fila['salida_4_ter']==16)  @php $llegada_2 = $Valle_De_Ecatepec_2; @endphp
                     @elseif($fila['salida_4_ter']==17)  @php $llegada_2 = $Vocacional_3_2; @endphp
                     @elseif($fila['salida_4_ter']==18)  @php $llegada_2 = $Adolfo_Lopez_Mateos_2; @endphp
                     @elseif($fila['salida_4_ter']==19)  @php $llegada_2 = $Zodiaco_2; @endphp
                     @elseif($fila['salida_4_ter']==20)  @php $llegada_2 = $Alfredo_Torres_2; @endphp
                     @elseif($fila['salida_4_ter']==21)  @php $llegada_2 = $Unitec_2 ; @endphp
                     @elseif($fila['salida_4_ter']==22)  @php $llegada_2 = $Estacion_Industrial_2; @endphp
                     @elseif($fila['salida_4_ter']==23)  @php $llegada_2 = $Josefa_Ortiz_De_Dominguez_2; @endphp
                     @elseif($fila['salida_4_ter']==24)  @php $llegada_2 = $Quinto_Sol_2; @endphp
                     @endif

                     <td>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-sub">
                                    <center>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}<br>
                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['conductor']}}</i></div>
                                        <div class="icon-preview"><i class="la la-bus ">{{$fila['salida_4_eco']}}</i> - Terminal: {{$fila['terminal4']}}</div>
                                    </center> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <div class="card-body">
                                        <span class="badge " style="color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['llegada_2']}} hrs.</span>
                                    </div>   
                                </center> 
                            </div>
                            <div class="col-md-12">
                                <div class="card-sub">
                                    {{$fila['salida_4_com']}}
                                </div>  
                            </div>
                        </div>
                    </td> 
                    @endif
                    <td>

                        @php $km_1 = $llegada_1 - $salida_1; @endphp
                        @php $km_2 = $llegada_2 - $salida_2; @endphp
                        @php $km_t = $km_1 + $km_2; @endphp
                        {{$km_t}}
                    </td>
                    @endforeach
                    @endif
                            </tbody>
                        </table>
    <br>
    
    


</body>