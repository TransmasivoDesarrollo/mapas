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
                  border: 2px solid #fe8863;
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
                <a  class="big-logo">
                    <img src="<?php echo $imagenBase64 ?>" alt="logo img" style="width:200px;" class="logo-img">
                </a>
            </td>
            <td style="width: 70%; border: 1px #ffffff; solid; font-size: 18px;"><center><b>PRÉSTAMO DE HERRAMIENTA</b></center></td>

        </tr>
        <tr>
            <td  style="width: 30%; border: 1px #ffffff; solid; text-align: left;">
                <label class="text-left" style="font-size: 14px;">FOLIO: {{$folio}}</label>
            </td>
            <td style="width: 70%; border: 1px #ffffff; solid;"></td>
        </tr>
        <tr>
            <td style="width: 30%; border: 1px #ffffff; solid; text-align: left;">
            <label class="text-left" style="font-size: 14px;">FECHA: {{$hora_formateada}}</label>
            </td>
            <td style="width: 70%; border: 1px #ffffff; solid; text-align: left;"></td>
        </tr>
        <tr>
            <td style="width: 30%; border: 1px #ffffff; solid; text-align: left;">
                <label class="text-left" style="font-size: 14px;">CLIENTE:</label>
            </td>
            <td style="width: 70%; border: 1px #ffffff; solid;"></td>
        </tr>
        <tr>
            <td style="width: 30%; border: 1px #ffffff; solid; text-align: left;">
                <label class="text-left" style="font-size: 14px;">UNIDAD O AUTOBÚS:</label>
            </td>
            <td style="width: 70%; border: 1px #ffffff; solid;"></td>
        </tr>
    </table>
    <br>
    <table style="border: 2px solid #fe8863;">
        <tr style="border: 2px solid #fe8863;">
            <td style="border: 2px solid #fe8863; background-color: #fff; font-size: 14px; width: 10%;"><center>CANTIDAD</center></td>
            <td style="border: 2px solid #fe8863; background-color: #fff; font-size: 14px; width: 10%;"><center>CLAVE</center></td>
            <td style="border: 2px solid #fe8863; background-color: #fff; font-size: 14px; width: 80%;"><center>DESCRIPCIÓN</center></td>
        </tr>
        @php $i=1; @endphp
        @foreach($refacciones as $refaccion)
        @if($i % 2 == 0)
        <tr>
            <td style=" background-color: #fff; font-size: 14px; width: 10%; border: 2px solid #fe8863;"><center>{{$refaccion->cantidad}}</center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 10%; border: 2px solid #fe8863;"><center>HER0000{{$refaccion->id}}</center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 80%; border: 2px solid #fe8863;"><center>{{$refaccion->refaccion}}</center></td>
        </tr>
        @else
        <tr>
            <td style=" background-color: #febaad; font-size: 14px; width: 10%; border: 2px solid #fe8863;"><center>{{$refaccion->cantidad}}</center></td>
            <td style=" background-color: #febaad; font-size: 14px; width: 10%; border: 2px solid #fe8863;"><center>HER0000{{$refaccion->id}}</center></td>
            <td style=" background-color: #febaad; font-size: 14px; width: 80%; border: 2px solid #fe8863;"><center>{{$refaccion->refaccion}}</center></td>
        </tr>
        
        @endif
        
        @php $i++; @endphp
        @endforeach       
    </table>
    <br> 
    <table>
        <tr>
            <td style="width: 100%; border: 1px #ffffff; solid; text-align: left;">
                <label class="text-left" style="font-size: 14px;">OBSERVACIONES:_________________________________________________________________________________________________________</label>
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #fff; font-size: 14px; width: 30%; border: 1px solid #fff;"><center>SALIDA DE ALMACÉN</center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 30%; border: 1px solid #fff;"><center></center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 30%; border: 1px solid #fff;"><center>ENTREGA A ALMACÉN</center></td>
        </tr>
        <tr>
            <td style=" background-color: #febaad; font-size: 14px; width: 30%; border: 2px solid #fe8863;"><center><br><br>NOMBRE Y FIRMA DE RECIBIDO</center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 40%; border: 1px solid #fff;"><center></center></td>
            <td style=" background-color: #febaad; font-size: 14px; width: 30%; border: 2px solid #fe8863;"><center><br><br>NOMBRE Y FIRMA DE RECIBIDO</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 14px; width: 40%; border: 1px solid #fff;"><center></center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 40%; border: 1px solid #fff;"><center><br></center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 40%; border: 1px solid #fff;"><center></center></td>
        </tr>
        <tr>
            <td style=" background-color: #febaad; font-size: 14px; width: 30%; border: 2px solid #fe8863;"><center><br><br>NOMBRE Y FIRMA DE RECIBIDO</center></td>
            <td style=" background-color: #fff; font-size: 14px; width: 40%; border: 1px solid #fff;"><center></center></td>
            <td style=" background-color: #febaad; font-size: 14px; width: 30%; border: 2px solid #fe8863;"><center><br><br>NOMBRE Y FIRMA DE RECIBIDO</center></td>
        </tr>
     
    </table>

</body>
</html>






