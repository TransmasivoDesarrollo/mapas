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
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 12%;"><center>Día</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 7%;"><center>Eco.</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 7%;"><center>Serv.</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 37%;"><center>Salida</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 37%;"><center>Llegada mitad de recorrido</center></th>
                                </tr>
                            </thead>
                            <tbody id="llenaTabla" >
                                @php $contador=0 @endphp
                                @php $anterior=0 @endphp
                                @php $repetido=0 @endphp
                                @php $naranja=0 @endphp
                                @if(null !== $consulta)

                                    @foreach($consulta as $fila)
                                    
                                    @php $naranja=0 @endphp
                                            @if($fila['posicion'] % 2 == 0)
                                                @if($anterior==$fila['credencial'])
                                                
                                                <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <table style="border : 1px #ffffff solid;">
                                                                    <tr>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                            </div>    
                                                                            </center>
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                            </div>   
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                            <span class="badge " style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_salida_rol']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                            @endif
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                        <div class="card-body" >
                                                                            @if($fila['estatus']=="Retardo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="Sobretiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="En tiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @endif
                                                                        </div>  
                                                                        </center>
                                                                        </td>
                                                                        <td rowspan="3" style="border: 1px #ffffff solid;">

                                                                        @if($fila['comentario'] != null)
                                                                            <div class="col-md-12">
                                                                                <div class="card-body">
                                                                                    Observación: {{$fila['comentario']}}
                                                                                </div>  
                                                                            </div>
                                                                        @endif  
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </div>
                                                    </td>
                                                            
                                                    </tr>
                                                    
                                                    @php $naranja=0 @endphp
                                                    @php $repetido=1 @endphp
                                                @else
                                                
                                                    @php $repetido=0 @endphp
                                                        <td  >
                                                        <center style="font-size:10px;">
                                                                Sin registro
                                                            </center>
                                                        </td>
                                                            
                                                    </tr>
                                                
                                                @endif
                                                
                                                @php $anterior=$fila['credencial'] @endphp
                                            @else
                                            
                                                
                                                @if($anterior != $fila['credencial'])
                                                    @if($repetido==1)
                                                        <tr  >
                                                        <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                            <td><center>{{$fila['eco']}}</center></td>
                                                            @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <table style="border : 1px #ffffff solid;">
                                                                    <tr >
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                            </div>    
                                                                            </center>
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                            </div>   
                                                                            </center> 
                                                                        </td >
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                            <span class="badge " style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_salida_rol']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                            @endif
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        
                                                                        <td  style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                        <div class="card-body" >
                                                                            @if($fila['estatus']=="Retardo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="Sobretiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="En tiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @endif
                                                                        </div>  
                                                                        </center>
                                                                        </td>
                                                                        <td rowspan="3" style="border: 1px #ffffff solid;">
                                                                        @if($fila['comentario'] != null)
                                                                            <div class="col-md-12">
                                                                                <div class="card-body">
                                                                                    Observación: {{$fila['comentario']}}
                                                                                </div>  
                                                                            </div>
                                                                        @endif  
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </div>
                                                    </td>
                                                          
                                                        @php $naranja=1 @endphp
                                                    @else
                                                        @if($anterior == 0)
                                                        
                                                            
                                                        <tr >
                                                            <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                            <td><center>{{$fila['eco']}}</center></td>
                                                            @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <table style="border : 1px #ffffff solid;">
                                                                    <tr>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                            </div>    
                                                                            </center>
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                            </div>   
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                            <span class="badge " style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_salida_rol']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                            @endif
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                        <div class="card-body" >
                                                                            @if($fila['estatus']=="Retardo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="Sobretiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="En tiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @endif
                                                                        </div>  
                                                                        </center>
                                                                        </td>
                                                                        <td rowspan="3" style="border: 1px #ffffff solid;">
                                                                            @if($fila['comentario'] != null)
                                                                                <div class="col-md-12">
                                                                                    <div class="card-body">
                                                                                        Observación: {{$fila['comentario']}}
                                                                                    </div>  
                                                                                </div>
                                                                            @endif  
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </div>
                                                    </td>
                                                                @php $naranja=0 @endphp
                                                        @else
                                                        <td >  <center style="font-size:10px;">
                                                                Sin registro
                                                            </center></td>
                                                                    
                                                                    </tr>
                                                            <tr>
                                                            <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                            <td><center>{{$fila['eco']}}</center></td>
                                                            @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <table style="border : 1px #ffffff solid;">
                                                                    <tr>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                            </div>    
                                                                            </center>
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                            </div>   
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                            <span class="badge " style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_salida_rol']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                            @endif
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                        <div class="card-body" >
                                                                            @if($fila['estatus']=="Retardo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="Sobretiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="En tiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @endif
                                                                        </div>  
                                                                        </center>
                                                                        </td>
                                                                        <td rowspan="3" style="border: 1px #ffffff solid;">
                                                                        @if($fila['comentario'] != null)
                                                                            <div class="col-md-12">
                                                                                <div class="card-body">
                                                                                    Observación: {{$fila['comentario']}}
                                                                                </div>  
                                                                            </div>
                                                                        @endif  

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </div>
                                                    </td>
                                                                @php $naranja=1 @endphp
                                                        @endif
                                                    @endif
                                                    
                                                    @php $repetido=0 @endphp
                                                    @php $anterior=$fila['credencial'] @endphp
                                                    
                                                    
                                                @else
                                                @php $anterior=$fila['credencial'] @endphp

                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($fila['dia'])->translatedFormat('l, d F Y') }}</td>
                                                        <td><center>{{$fila['eco']}}</center></td>
                                                        @if($fila['Servicio']=="TR1")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #e5be01; color:black; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR1-R")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #FF0080; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR3")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #008f39; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @elseif($fila['Servicio']=="TR4")
                                                            <td>
                                                                <center>
                                                                    <span class="badge" style="background-color: #0000ff; color:#fff; font-size:10px;">
                                                                        {{$fila['Servicio']}}
                                                                    </span>
                                                                </center>
                                                            </td>
                                                            @endif
                                                            <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-sub">
                                                                        <center>Terminal: {{$fila['terminal']}}<br>
                                                                        <div class="icon-preview"><i class="la flaticon-user">{{$fila['credencial']}} - {{$fila['name']}}</i></div>
                                                                      </center> 
                                                                    
                                                                    </div>
                                                                </div>
                                                                <table style="border: 1px #ffffff solid;">
                                                                    <tr>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Llegada<br> {{$fila['hora_llegada']}} hrs.</span>
                                                                            </div>    
                                                                            </center>
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            <div class="card-body">
                                                                                <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida<br> {{$fila['hora_salida']}} hrs.</span>
                                                                            </div>   
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                            <center>
                                                                            @if($fila['hora_salida_rol']=="Fuera de jornada")
                                                                            <span class="badge " style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_salida_rol']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success" style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Salida rol<br> {{$fila['hora_salida_rol']}} hrs.</span>
                                                                            @endif
                                                                            </center> 
                                                                        </td>
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                            @if($fila['hora_diferencia']=="Fuera de jornada")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['hora_diferencia']}}</span>
                                                                            @else
                                                                            <span class="badge badge-success"  style="background-color: #ffffff; color:black"><i class="la la-bus"></i> Dif. <br>{{$fila['hora_diferencia']}} hrs.</span>
                                                                            @endif
                                                                        </center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                       
                                                                        <td style="border: 1px #ffffff solid;">
                                                                        <center>
                                                                        <div class="card-body" >
                                                                            @if($fila['estatus']=="Retardo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="Sobretiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @elseif($fila['estatus']=="En tiempo")
                                                                            <span class="badge "  style="background-color: #ffffff; color:black; font-size:10px;"> {{$fila['estatus']}}</span>
                                                                            @endif
                                                                        </div>  
                                                                        </center>
                                                                        </td>
                                                                        <td rowspan="3" style="border: 1px #ffffff solid;">
                                                                        @if($fila['comentario'] != null)
                                                                            <div class="col-md-12">
                                                                                <div class="card-body">
                                                                                    Observación: {{$fila['comentario']}}
                                                                                </div>  
                                                                            </div>
                                                                        @endif  
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </div>
                                                    </td>
                                                        
                                                    @php $naranja=1 @endphp
                                                    @php $repetido=0 @endphp
                                                @endif
                                            @endif
                                            
                                            @php $anterior=$fila['credencial'] @endphp
                                    @endforeach
                                    @if($naranja==1)
                                        <td  >   <center style="font-size:10px;">
                                                                Sin registro
                                                            </center>
                                                        </td>
                                    </tr>
                                     @endif
                                     
                                @endif
                                
                            </tbody>
                        </table>
    <br>
    
    


</body>