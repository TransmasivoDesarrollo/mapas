<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header-table, .content-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td, .content-table td, .content-table th {
            border: 1px solid #000000;
            text-align: center;
            padding: 3px;
        }
        .header-table td {
            border: none;
        }
        .content-table th {
            background-color: #f2f2f2;
        }
        .logo-img {
            width: 200px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        .sub-title {
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        $nombreImagen = url('')."/assets/img/transmasivo.png";
        $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
    ?>
    <table class="header-table">
        <tr>
            <td style="width: 30%;">
                <img src="<?php echo $imagenBase64 ?>" alt="logo img" class="logo-img">
            </td>
            <td style="width: 70%;">
                <div class="title">FORMATO DE BIOMETRICO</div>
                <div class="sub-title">Fecha de generación: {{ date('d-m-Y') }}</div>
            </td>
        </tr>
    </table>
    <br>
    <table class="content-table">
        <tr style="background-color: rgba(237,28,36,1); color:#FFF;">
            <td style="text-align: left; font-size: 14px; width: 8%;"><center><b>ID</b></center></td>
            <td style="text-align: left; font-size: 14px; width: 15%;"><center><b>Día</b></center></td>
            <td style="text-align: left; font-size: 14px; width: 15%;" ><center><b>Entrada a la oficina</b></center></td>
            <td style="text-align: left; font-size: 14px; width: 15%;" ><center><b>Salida a la oficina</b></center></td>
            <td style="text-align: left; font-size: 14px; width: 15%;" ><center><b>Tiempo trabajado</b></center></td>
            <td style="text-align: left; font-size: 14px; width: 15%;" ><center><b>Retardo</b></center></td>
            <td style="text-align: left; font-size: 14px; width: 27%;" ><center><b>Todos los registros del día </b></center></td>
        </tr>
        @php $i = 1; @endphp
        @foreach($consulta as $consul)
            @if($i % 2 == 0)
                <tr style="background-color: rgba(237,28,36,.1);">
            @else
                <tr>
            @endif
                    <td style="font-size: 10px;">{{$consul->id_elemento}}</td>
                    <td style="font-size: 10px;">{{$consul->dia[0]}}</td>
                    <td style="font-size: 10px;">{{$consul->inicio[0]}} hrs.</td>
                    <td style="font-size: 10px;">{{$consul->fin[0]}} hrs.</td>
                    <td style="font-size: 10px;">{{$consul->tiempo_trabajado}} hrs.</td>
                    <td style="font-size: 10px;">{{$consul->estado}}</td>
                    <td style="font-size: 10px;">{!! $consul->todas_las_fechas !!}</td>
                </tr>
            @php $i++; @endphp
        @endforeach
    </table>
    <br>
</body>
</html>
