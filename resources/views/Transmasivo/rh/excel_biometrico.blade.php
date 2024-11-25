<!-- resources/views/Transmasivo/rh/excel_biometrico.blade.php -->

<table>
    <thead>
    <tr>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 9%;"><center>Jornada</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Empleado</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 17%;"><center>Día</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 10%;"><center>Entrada jornada/Entrada biometrico</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 10%;"><center>Salida jornada/Salida biometrico</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 8%;"><center>Tiempo de trabajo</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 10%;"><center>Estatus entrada</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 10%;"><center>Estatus salida</center></th>
                                    <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 16%;"><center>Todas las fechas del día</center></th>
                                </tr>
    </thead>
    <tbody>
    @php $i = 1; @endphp
                                @if($consulta !== "")
                                    @foreach($consulta as $consul)
                                            <tr >
                                                <td>{{$consul->nombre_horario}}</td>
                                                <td>{{$consul->id_empleado}}</td>
                                                <td><b>{{$consul->fecha_formato_largo}}</b></td>
                                                <td>Jornada {{ date('h:i A', strtotime($consul->hora_esperada_llegada)) }} <br><b>Biome. {{ date('h:i A', strtotime( substr($consul->registro_biometrico, 11) ))}}                                                </b></td>
                                                <td>Jornada {{ date('h:i A', strtotime($consul->hora_esperada_salida)) }} <br><b>Biome. {{  date('h:i A', strtotime( substr($consul->ultimo_registro_biometrico, 11) ))}}</b></td>
                                                <td
                                                
                                                @if($consul->horas_trabajo_esperadas < $consul->tiempo_trabajado) 
                                                style=" background-color:rgba(0, 143, 57, 0.2);"
                                                @else
                                                
                                                style=" background-color: rgba(229, 190, 1, 0.2);"
                                                @endif
                                                >Esperado: {{$consul->horas_trabajo_esperadas}}<br> Trabajado: {{$consul->tiempo_trabajado}}</td>
                                                <td>
                                                    @if($consul->estado_llegada == "Tarde")
                                                        <b style="color:orange">{{$consul->estado_llegada}}</b>
                                                        <br><b>{{$consul->registro_biometrico}}</b>
                                                    @elseif($consul->estado_llegada == "A tiempo")
                                                        <b style="color:green">{{$consul->estado_llegada}}</b>
                                                        <br><b>{{$consul->registro_biometrico}}</b>
                                                    @else
                                                        <b style="color:red">Sin horario asignado</b>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($consul->estado_salida == "Salio antes")
                                                        <b style="color:orange">{{$consul->estado_salida}}</b>
                                                        <br><b>{{$consul->ultimo_registro_biometrico}}</b>
                                                    @elseif($consul->estado_salida == "A tiempo")
                                                        <b style="color:green">{{$consul->estado_salida}}</b>
                                                        <br><b>{{$consul->ultimo_registro_biometrico}}</b>
                                                    @else
                                                        <b style="color:red">Sin horario asignado</b>
                                                        <br><b>{{$consul->ultimo_registro_biometrico}}</b>
                                                    @endif
                                                </td>
                                                <td>{!! $consul->todos_registros_dia !!}</td>
                                            </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                @endif
    </tbody>
</table>
