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
            <td style="width: 70%; border: 1px #ffffff; solid;"><center><b>Inventario</b></center></td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 5%;"><center>CÓDIGO</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 28%;"><center>NOMBRE REFACCIÓN</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 5%;"><center>CANTIDAD</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 5%;"><center>PASILLO</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 5%;"><center>ANAQUEL</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 5%;"><center>NIVEL</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 5%;"><center>CHAROLA</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>QUIEN CONTO</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 17%;"><center>FECHA</center></td>
        </tr>
    @foreach($t_inventarios as $respuesta)
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;"><center>{{$respuesta->Codigo}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 28%;"><center>{{$respuesta->Refaccion}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;"><center>{{$respuesta->Cantidad}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;"><center>{{$respuesta->Pasillo}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;"><center>{{$respuesta->Anaquel}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;"><center>{{$respuesta->Nivel}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;"><center>{{$respuesta->Charola}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta->name}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 17%;"><center>{{$respuesta->Fecha}}</center></td>
        </tr>
       
    @endforeach       
    </table>
    <br> 


</body>
</html>






