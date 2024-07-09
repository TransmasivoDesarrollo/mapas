<!DOCTYPE html>
<html>
<head>
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

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <?php
        $nombreImagen = url('')."/assets/img/transmasivo.png";
        $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
    ?>
    <table style="border: 1px solid #ffffff;">
        <tr>
            <td style="width: 30%; border: 1px solid #ffffff;">
                <a href="{{ url('/') }}" class="big-logo">
                    <img src="<?php echo $imagenBase64; ?>" alt="logo img" style="width:200px;" class="logo-img">
                </a>
            </td>
            <td style="width: 70%; border: 1px solid #ffffff;">
                <center><b>CHECK DE LIBERACIÓN DE UNIDADES</b></center>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="background-color: #dddddd; font-size: 9px; width: 15%;">
                <center>Economico</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 35%;">
                <center>{{ $encabezado[0]->economico }}</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 15%;">
                <center>Fecha del reporte</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 35%;">
                <center>{{ $encabezado[0]->fecha_reporte }}</center>
            </td>
            
        </tr>
        <tr>
            <td style="background-color: #dddddd; font-size: 9px; width: 15%;">
                <center>Mecanico</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 35%;">
                <center>{{ $encabezado[0]->mecanico }}</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 15%;">
                <center>Supervisor</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 35%;">
                <center>{{ $encabezado[0]->supervisor }}</center>
            </td>
            
        </tr>
    </table>
    <table>
        <tr>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center>Fecha del ultimo mantenimiento preventivo</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 25%;">
                <center>{{ $encabezado[0]->fecha_ultimo_preventivo }}</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center>Fecha del ultimo mantenimiento articulación</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 25%;">
                <center>{{ $encabezado[0]->fecha_ultimo_articulacion }}</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center>Fecha del ultima fumigacion</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 25%;">
                <center>{{ $encabezado[0]->fecha_ultima_fumigación }}</center>
            </td>
            
        </tr>
    </table>
    <table>
        <tr>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center>Kilometraje   </center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 25%;">
                <center>{{ $encabezado[0]->km }}</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center>Bares  </center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 25%;">
                <center>{{ $encabezado[0]->bares }}</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center></center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center></center>
            </td>
            
        </tr>
    </table>
    <br>
    <table>
    <tr>
        <td style="background-color: #dddddd; font-size: 9px; width: 5%;">
                <center>#</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;">
                <center>Elemento</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 25%;">
                <center>Estatus</center>
            </td>
            <td style="background-color: #dddddd; font-size: 9px; width: 20%;">
                <center>Observaciones</center>
            </td>
    </tr>
        @php $i = 1; @endphp
        @php $j = 0; @endphp
        @php $k = 0; @endphp
        @foreach($c_reporte_fisico_funcionalidad as $pregunta)
        <tr>
            <td style="background-color: #fff; font-size: 9px; width: 5%;">
                <center>{{ $i }}</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;">
                <center>{{ $pregunta->reporte }}</center>
            </td>
            <td style="background-color: #fff; font-size: 9px; width: 25%;">
            <center>{{$preguntas[$j]->respuesta}}</center>
            </td>
            
        @php $k++; @endphp
            <td style="background-color: #fff; font-size: 9px; width: 20%;" colspan="2">
                <center>{{$preguntas[$k]->respuesta}}</center>
            </td>
        </tr>
        @php $i++; @endphp
        @php $j++; @endphp
        @php $j++; @endphp
        @php $k++; @endphp
        @endforeach    
    </table>
    <br>
    <br>
</body>
</html>
