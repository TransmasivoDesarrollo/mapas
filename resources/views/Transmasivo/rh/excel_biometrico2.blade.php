<!-- resources/views/Transmasivo/rh/excel_biometrico.blade.php -->

<table>
    <thead>
    <tr>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Empleado</center></th>
                                    @foreach($fechas_formateadas as $fecha)
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>{{$fecha}}</center></th>
                                    @endforeach
                                </tr>
    </thead>
    <tbody>
        @if($elementos !== "")
            @foreach($elementos as $elem)
                @php
                    $eleme = $elem->id_elemento;
                @endphp
                @if($eleme == null || $eleme == "" ||  $eleme == "null")
                @php
                
                @endphp
                @else
                    <tr>
                        <td>{{$elem->id_elemento}}</td>
                    
                        @php $i = 0; @endphp
                        @foreach($fechas_formateadas as $fecha)
                            @if(isset($acomodado[$eleme][$i]))
                                <td
                                    @if($acomodado[$eleme][$i]['horas_trabajo_esperadas'] == 'Descanso')
                                        style="background-color: orange;"
                                    @elseif($acomodado[$eleme][$i]['horas_trabajo_esperadas'] == 'Falta')
                                        style="background-color: red;"
                                    @else
                                        @if($acomodado[$eleme][$i]['tiempo_trabajado'] > $acomodado[$eleme][$i]['horas_trabajo_esperadas'])
                                            style="background-color: green;"
                                        @else
                                            style="background-color: yellow;"
                                        @endif
                                    @endif
                                >
                                Esperado: {{$acomodado[$eleme][$i]['horas_trabajo_esperadas']}} <br> Trabajado: {{$acomodado[$eleme][$i]['tiempo_trabajado']}}
                                </td>
                            @else
                                <td>Sin datos</td>
                            @endif


                            @php $i++; @endphp
                        @endforeach                  
                    </tr>
                @endif
                
            @endforeach
        @endif
    </tbody>
</table>
