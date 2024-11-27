<x-app-layout>
	<style>
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
        

	</style>
	<div class="card">
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Consultar biométrico </div>
		</div>
		<div class="card-body">
            @if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
                <form method="post" id="contratoForm" action="{{url('/consultar_biometrico2')}}">
                    @csrf
                    <div class="form-group row " >
                        <div class="col-md-2">
                            <div class="form-group form-group-default">
                                <label><br>ID empleado <span class="required-label"></span></label>
                                <select  id="id_empleado" name="id_empleado" class="form-control" >
                                        <option value="-Selecciona-">-Selecciona-</option>
                                    @foreach($elementos as $elemento)

                                        @if(isset($id_empleado))
                                            @if($elemento->id_elemento == $id_empleado)
                                                <option selected value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>
                                            @else
                                                <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                            @endif
                                        @else
                                            <option value="{{$elemento->id_elemento}}">{{$elemento->id_elemento}}</option>  
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
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
                        <div class="col-md-4">
                            <div class="form-group form-group-default">
                                <label><br>Qna <span class="required-label"></span></label>
                                <select  class="form-control" id="qna" name="qna">
                                <option value="-Selecciona-">-Selecciona-</option>
                                </option>
                                    @foreach ($quincenas as $quincena)
                                        <option value="{{ $quincena['value'] }}" @if($qna == $quincena['value']) selected @endif 
                                        @if($quincena['value'] == $selectedQna) 
                                            @if($qna == $quincena['value'])
                                            @else
                                            selected
                                            @endif 
                                            style="background-color:green; color:#fff;" 
                                        @endif>
                                            {{ $quincena['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <hr>
                                <input type="submit" value="Consultar" class="btn btn-primary btn-sm" id="Consultar_gif" name="Consultar">
                            </center>
                        </div>
                    </div>
				</div>
		</div>
	</div>
    <div class="card">
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Consultar biométrico </div>
		</div>
		<div class="card-body">
            @if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
                    <div class="form-group row " >
                        
                        <div class="col-md-2">
                            <label>
                            <table >
                                <tr style="width:25px;">
                                    <td style="font-size: 10px; background-color: rgba(0,128,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="border:1px white solid;">&nbsp;Salio bien / Llego bien</td>
                                </tr>
                            </table>    
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label>
                            <table>
                                <tr style="width:25px;">
                                    <td style="font-size: 10px; background-color: rgba(255,255,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="border:1px white solid;">&nbsp;Descanso</td>
                                </tr>
                            </table>    
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label>
                            <table>
                                <tr style="width:25px;">
                                    <td style="font-size: 10px; background-color: rgba(254,0,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="border:1px white solid;">&nbsp;Falta</td>
                                </tr>
                            </table>    
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label>
                            <table>
                                <tr style="width:25px;"> 
                                    <td style="font-size: 10px; background-color: rgba(255,128,0,.2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="border:1px white solid;">&nbsp;Salio antes</td>
                                </tr>
                            </table>    
                           </label>
                        </div>
                        
                        <div class="col-md-2">
                            <label>
                            <table>
                                <tr style="width:25px;"> 
                                    <td style="font-size: 10px; background-color: rgba(174,204,204,1);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="border:1px white solid;">&nbsp;Trabajo en descanso</td>
                                </tr>
                            </table>    
                           </label>
                        </div>
                        <div class="col-xl-4">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-sm"  style="background-color: #2d572c; color:#fff;" name="Excel2" id="Excel2">
                                <b>
                                    <span class="btn-label">
                                        <i class="la la-file-excel-o"></i>
                                    </span>Excel
                                </b>
							</button>
                        </div>
                    </div>
                </form>
                <div class="form-group row " >
                    <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display dataTable no-footer" id="list_user2">
                            <thead>
                                <tr>
                                    <th class="sorting" style="font-size: 9px; color:#ffffff; background-color:#872637; width: 5%;"><center>Empleado</center></th>
                                    @foreach($fechas_qna as $qna)
                                    <th class="sorting" style="font-size: 9px; color:#ffffff; background-color:#872637; width: 450px;">
                                        <center>{{ \Carbon\Carbon::parse($qna->fecha)->locale('es')->translatedFormat('l, d \d\e F \d\e\l Y ') }}</center>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id="llenaTabla">
                                @php $i = 1; @endphp
                                @if(isset($id_empleado) && $id_empleado!= "-Selecciona-")
                                <tr>
                                                <td  style="font-size: 9px; ">
                                                    <center>
                                                        {{$id_empleado}}
                                                    </center>
                                                </td>
                                                @php 
                                                for($i=0 ; count($fechas_qna)>$i ; $i++)
                                                {
                                                @endphp
                                                @if(isset($array_completo[$id_empleado]))
                                                <td>
                                                    <table>
                                                        
                                                            @if($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Descanso")
                                                            <tr>
                                                                @if($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_r'] == "Descanso")
                                                                <td  style="font-size: 9px; background-color: rgba(255,255,0,.2);">
                                                                    <center>  
                                                                        {!! $array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_r'] !!}
                                                                    </center> 
                                                                </td>
                                                                @else
                                                                <td  style="font-size: 9px; background-color: rgba(174,204,204,1);">
                                                                    <center>  
                                                                        {!! $array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_r'] !!}
                                                                    </center> 
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @elseif($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Llego tarde")
                                                            <tr>
                                                                <td  style="font-size: 9px;  background-color: rgba(255,128,0,.2);"> <center>Llego tarde</center> </td>
                                                            </tr>
                                                            @elseif($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Falta")
                                                            <tr>
                                                                <td  style="font-size: 9px; background-color: rgba(254,0,0,.2);"> <center>Falta</center> </td>
                                                            </tr>
                                                            @elseif($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Sin datos")
                                                            <tr>
                                                                <td  style="font-size: 9px; background-color: rgba(161,130,98,.2);"> <center>Sin datos</center> </td>
                                                            </tr>
                                                            @else
                                                            <tr style="border-bottom: 1px solid black;">
                                                                <td  style="font-size: 9px;"> Rol: 
                                                                {!! \Carbon\Carbon::parse($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_j'])
                                                                    ->locale('es') 
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                <hr> Real: 
                                                                {!! \Carbon\Carbon::parse($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_r'])
                                                                    ->locale('es') 
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                </td>
                                                                
                                                                @if($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_estatus']=="Llego bien")
                                                                <td  style="font-size: 9px; background-color: rgba(0,128,0,.2);"> <br>
                                                                Diferencia: 
                                                                    {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_dif_llegada']}}<hr>    
                                                                Estatus: 
                                                                    {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_estatus']}}
                                                                </td>
                                                                @elseif($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_estatus']=="Llego tarde")
                                                                <td  style="font-size: 9px; background-color: rgba(255,128,0,.2);"> <br>
                                                                Diferencia: 
                                                                    {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_dif_llegada']}}<hr>   
                                                                     Estatus: 
                                                                    {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_llegada_estatus']}}
                                                                </td>
                                                                @endif
                                                               
                                                                
                                                            </tr>
                                                            <tr>
                                                            @if($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_j'] == "Sin datos")
                                                                <tr>
                                                                    <td  style="font-size: 9px; background-color: rgba(161,130,98,.2);"> Sin datos </td>
                                                                </tr>
                                                            @else
                                                                <td  style="font-size: 9px;"> 
                                                                    Rol: 
                                                                    {!! \Carbon\Carbon::parse($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_j'])
                                                                    ->locale('es') // Configurar idioma a español
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                    <hr>
                                                                    Real: 
                                                                    {!! \Carbon\Carbon::parse($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_r'])
                                                                    ->locale('es') // Configurar idioma a español
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                </td>
                                                                
                                                                @if($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_estatus']=="Salio bien")
                                                                <td  style="font-size: 9px; background-color: rgba(0,128,0,.2);"><br>
                                                                Diferencia:  {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_dif_salida']}}<hr>
                                                                 Estatus: 
                                                                    {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_estatus']}}
                                                                </td>
                                                                @elseif($array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_estatus']=="Salio antes")
                                                                <td  style="font-size: 9px; background-color: rgba(255,128,0,.2);"> <br>
                                                                Diferencia:  {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_dif_salida']}}<hr>
                                                                Estatus: 
                                                                    {{$array_completo[$id_empleado][$fechas_qna[$i]->fecha]['hora_salida_estatus']}}
                                                                </td>
                                                                @endif
                                                                
                                                            @endif
                                                            </tr>
                                                            @endif
                                                    </table>
                                                   
                                                </td>
                                                @else
                                                <td>
                                                    Sin horario asignado
                                                   
                                                </td>
                                                @endif
                                                @php 
                                                }
                                                @endphp
                                            </tr>
                                @elseif($array_completo !== null)
                                    @foreach($elementos as $elem)
                                            <tr>
                                                <td>{{$elem->id_elemento}} </td>
                                                @php 
                                                for($i=0 ; count($fechas_qna)>$i ; $i++)
                                                {
                                                @endphp
                                                @if(isset($array_completo[$elem->id_elemento]))
                                                <td>
                                                    <table>
                                                        
                                                            @if($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Descanso")
                                                            <tr>
                                                                @if($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_r'] == "Descanso")
                                                                <td  style="font-size: 9px; background-color: rgba(255,255,0,.2);">
                                                                    <center>  
                                                                        {!! $array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_r'] !!}
                                                                    </center> 
                                                                </td>
                                                                @else
                                                                <td  style="font-size: 9px; background-color: rgba(174,204,204,1);">
                                                                    <center>  
                                                                        {!! $array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_r'] !!}
                                                                    </center> 
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @elseif($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Llego tarde")
                                                            <tr>
                                                                <td  style="font-size: 9px;  background-color: rgba(255,128,0,.2);"> <center>Llego tarde</center> </td>
                                                            </tr>
                                                            @elseif($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Falta")
                                                            <tr>
                                                                <td  style="font-size: 9px; background-color: rgba(254,0,0,.2);"> <center>Falta</center> </td>
                                                            </tr>
                                                            @elseif($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_j'] == "Sin datos")
                                                            <tr>
                                                                <td  style="font-size: 9px; background-color: rgba(161,130,98,.2);"> <center>Sin datos</center> </td>
                                                            </tr>
                                                            @else
                                                            <tr style="border-bottom: 1px solid black;">
                                                                <td  style="font-size: 9px;"> Rol: 
                                                                {!! \Carbon\Carbon::parse($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_j'])
                                                                    ->locale('es') 
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                <hr> Real: 
                                                                {!! \Carbon\Carbon::parse($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_r'])
                                                                    ->locale('es') 
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                </td>
                                                                
                                                                @if($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_estatus']=="Llego bien")
                                                                <td  style="font-size: 9px; background-color: rgba(0,128,0,.2);"> <br>
                                                                Diferencia: 
                                                                    {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_dif_llegada']}}<hr>    
                                                                Estatus: 
                                                                    {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_estatus']}}
                                                                </td>
                                                                @elseif($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_estatus']=="Llego tarde")
                                                                <td  style="font-size: 9px; background-color: rgba(255,128,0,.2);"> <br>
                                                                Diferencia: 
                                                                    {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_dif_llegada']}}<hr>   
                                                                     Estatus: 
                                                                    {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_llegada_estatus']}}
                                                                </td>
                                                                @endif
                                                               
                                                                
                                                            </tr>
                                                            <tr>
                                                            @if($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_j'] == "Sin datos")
                                                                <tr>
                                                                    <td  style="font-size: 9px; background-color: rgba(161,130,98,.2);"> Sin datos </td>
                                                                </tr>
                                                            @else
                                                                <td  style="font-size: 9px;"> 
                                                                    Rol: 
                                                                    {!! \Carbon\Carbon::parse($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_j'])
                                                                    ->locale('es') // Configurar idioma a español
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                    <hr>
                                                                    Real: 
                                                                    {!! \Carbon\Carbon::parse($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_r'])
                                                                    ->locale('es') // Configurar idioma a español
                                                                    ->translatedFormat('l, d F Y - <b>H:i:s</b>') !!}
                                                                </td>
                                                                
                                                                @if($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_estatus']=="Salio bien")
                                                                <td  style="font-size: 9px; background-color: rgba(0,128,0,.2);"><br>
                                                                Diferencia:  {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_dif_salida']}}<hr>
                                                                 Estatus: 
                                                                    {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_estatus']}}
                                                                </td>
                                                                @elseif($array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_estatus']=="Salio antes")
                                                                <td  style="font-size: 9px; background-color: rgba(255,128,0,.2);"> <br>
                                                                Diferencia:  {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_dif_salida']}}<hr>
                                                                Estatus: 
                                                                    {{$array_completo[$elem->id_elemento][$fechas_qna[$i]->fecha]['hora_salida_estatus']}}
                                                                </td>
                                                                @endif
                                                                
                                                            @endif
                                                            </tr>
                                                            @endif
                                                    </table>
                                                   
                                                </td>
                                                @else
                                                <td>
                                                    Sin horario asignado
                                                   
                                                </td>
                                                @endif
                                                @php 
                                                }
                                                @endphp
                                            </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
					    </div>
                    </div>
				</div>
		</div>
	</div>


@section('jscustom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye moment.js con locales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

<script type="text/javascript">
	$('#Consultar_gif').on('click', function() {
        $('#overlay').css('display', 'block');
    });
    $(document).ready(function() {
        $('#id_empleados').select2();
        moment.locale('es');
        $('td[data-fecha-inicio]').each(function() {
            var fechaRegistro = $(this).data('fecha-inicio');
            var fechaFormateada = moment(fechaRegistro).format('dddd, D [de] MMMM [de] YYYY');
            fechaFormateada = fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1);
            $(this).html( '<b>'+fechaFormateada+'</b>');
        });
        $('#list_user2').DataTable({
    scrollX: false,
    scrollCollapse: true,
    filter: true,
    fixedHeader: true, // Activa el encabezado fijo
    lengthMenu: [[5, 10, 15, 20, 25, -1], [5, 10, 15, 20, 25, "Todos"]],
    iDisplayLength: 5,
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
    },
    "order": [], // Esto deshabilita el ordenamiento automático
    initComplete: function () {
        this.api().columns().every(function () {
            var column = this;
            var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });
        });
    }
});

    }); 

</script>
@endsection
</x-app-layout>
