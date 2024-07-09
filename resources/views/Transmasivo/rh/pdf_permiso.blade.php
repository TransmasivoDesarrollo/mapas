</html>
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
                <a href="{{url('/')}}" class="big-logo">
                    <img src="<?php echo $imagenBase64 ?>" alt="logo img" style="width:200px;" class="logo-img">
                </a>
            </td>
            <td style="width: 70%; border: 1px #ffffff; solid;"><center><b></b></center></td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td colspan="6"><center><b>FORMATO DE REPORTE DE PERMISO LABORAL</b></center></td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 14px; width: 25%;">&nbsp;Fecha<br>&nbsp;&nbsp;&nbsp;{{$result[0]->fecha_registro}}</td>
            <td style="text-align: left; font-size: 14px; width: 25%;">&nbsp;Fecha de permiso<br>&nbsp;&nbsp;&nbsp;{{$result[0]->fecha_inicio}}</td>
            <td style="text-align: left; font-size: 14px; width: 25%;" colspan="2">&nbsp;Puesto<br>&nbsp;&nbsp;&nbsp;{{$result[0]->id_elemento}}</td>
            <td style="text-align: left; font-size: 14px; width: 25%;" colspan="2">&nbsp;Área<br>&nbsp;&nbsp;&nbsp;{{$result[0]->id_elemento}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: left; vertical-align: top; font-size: 14px;">&nbsp;Nombre del colaborador que solicita<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->id_elemento}}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: left; vertical-align: top; font-size: 14px;"width="50%">&nbsp;Nombre del jefe directo<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->id_elemento}}</td>
            <td colspan="4" style="text-align: left; vertical-align: top; font-size: 14px;"width="50%">&nbsp;Fecha de aprobación<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->id_elemento}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: left; vertical-align: top; font-size: 14px;">&nbsp;Motivo de solicitud<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->motivo_solicitud}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: left; vertical-align: top; font-size: 14px;">&nbsp;Soportes anexos<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->soporte_anexo}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: left; vertical-align: top; font-size: 14px;">&nbsp;Observaciones <br><br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->observaciones}}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: left; vertical-align: top; font-size: 14px; "width="50%">&nbsp;Firma de autorización por el jefe de área<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->estatus_jefe_directo}}</td>
            <td colspan="4" style="text-align: left; vertical-align: top; font-size: 14px; " width="50%">&nbsp;Firma de dirección<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->estatus_direccion}}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: left; vertical-align: top; font-size: 14px; "width="50%">&nbsp;Firma del colaborador solicitante<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->id_elemento}}</td>
            <td colspan="4" style="text-align: left; vertical-align: top; font-size: 14px; "width="50%">&nbsp;Firma de autorización de recursos humanos<br><br>&nbsp;&nbsp;&nbsp;{{$result[0]->estatus_rh}}</td>
        </tr>

    
    </table>
    <br> 


</body>
</html>






