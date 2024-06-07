</html>
<!DOCTYPE html>
        <html>
        
      @foreach($res as $respuesta)
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
            <td style="width: 70%; border: 1px #ffffff; solid;"><center><b>CHECK DE LIBERACIÓN DE UNIDADES</b></center></td>
        </tr>
    </table>
      <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;">ECONOMICO:</td>
            <td style="width: 25%;  font-size: 9px; text-align:left;">{{$respuesta['n_economico']}}</td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;">FECHA:</td>
            <td style="width: 25%;  font-size: 9px; text-align:left;">{{$respuesta['Fecha']}}</td>
        </tr>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;">MECANICO:</td>
            <td style="width: 25%;  font-size: 9px; text-align:left;">{{$respuesta['n_mecanico']}}</td>
            <td style="  background-color: #dddddd; font-size: 9px; width: 25%;">KILOMETRAJE:</td>
            <td style="width: 25%;  font-size: 9px; text-align:left;">{{number_format($respuesta['km'], 0, ',');}}</td>
        </tr>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;">SUPERVISOR:</td>
            <td style="width: 25%;  font-size: 9px; text-align:left;">{{$respuesta['nom_supervisor']}}</td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;">CARGA DE BARES:</td>
            <td style="width: 25%;  font-size: 9px; text-align:left;">{{$respuesta['bares']}}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>NIVELES Y FUGAS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>ACEITE DE MOTOR</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['aceite_motor']}} @if($respuesta['aceite_motor_lt'] !== null ) ,{{$respuesta['aceite_motor_lt']}} lt @endif</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['aceite_motor_o']}}</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>REFRIGERANTE</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['refrigerante']}} @if($respuesta['refrigerante_lt'] !== null ) ,{{$respuesta['refrigerante_lt']}} lt @endif</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['refrigerante_o']}}</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>ACEITE HIDRAULICO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['aceite_hidra']}} @if($respuesta['aceite_hidra_lt'] !== null ) ,{{$respuesta['aceite_hidra_lt']}} lt @endif</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['aceite_hidra_o']}}</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>HIDROVENTILADOR</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['hidroven']}} @if($respuesta['hidroven_lt'] !== null ) ,{{$respuesta['hidroven_lt']}} lt @endif</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['hidroven_o']}}</center></td>
        </tr>
        
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>PUERTAS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>SERVICIO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['servicio']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['servicio_o']}} @if($respuesta['servicio_fallas'] !== null ) , Falla(s): {{$respuesta['servicio_fallas']}} @endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>EMERGENCIA</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['emergencia']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['emergencia_o']}} @if($respuesta['emergencia_fallas'] !== null ) , Falla(s): {{$respuesta['emergencia_fallas']}}  @endif</center></td>
        </tr>        
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 15%;"><center>NEUMATICOS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 10%;"><center>LADO</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
        <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE DIRECCIONAL</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['neu_eje_dir_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['neu_eje_dir_izq_o']}} @if($respuesta['neu_eje_dir_izq_fallas'] !== null ) , Falla(s): {{$respuesta['neu_eje_dir_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['neu_eje_dir_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['neu_eje_dir_der_o']}} @if($respuesta['neu_eje_dir_der_fallas'] !== null ) , Falla(s): {{$respuesta['neu_eje_dir_der_fallas']}}@endif</center></td>
        </tr>    
        <tr> 
            <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE INTERMEDIO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['neu_eje_int_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['neu_eje_int_izq_o']}} @if($respuesta['neu_eje_int_izq_fallas'] !== null ) , Falla(s): {{$respuesta['neu_eje_int_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['neu_eje_int_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['neu_eje_int_der_o']}} @if($respuesta['neu_eje_int_der_fallas'] !== null ) , Falla(s): {{$respuesta['neu_eje_int_der_fallas']}}@endif</center></td>
        </tr>  
        <tr>   
            <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE MOTRIZ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['neu_eje_motr_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['neu_eje_motr_izq_o']}}@if($respuesta['neu_eje_motr_izq_fallas'] !== null ) , Falla(s): {{$respuesta['neu_eje_motr_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['neu_eje_motr_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['neu_eje_motr_der_o']}}@if($respuesta['neu_eje_motr_der_fallas'] !== null ) , Falla(s): {{$respuesta['neu_eje_motr_der_fallas']}}@endif</center></td>
        </tr>        
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 15%;"><center>BALATAS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 10%;"><center>LADO</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
        <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE DIRECCIONAL</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bal_eje_dir_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bal_eje_dir_izq_o']}}@if($respuesta['bal_eje_dir_izq_fallas'] !== null ) , Falla(s): {{$respuesta['bal_eje_dir_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bal_eje_dir_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bal_eje_dir_der_o']}}@if($respuesta['bal_eje_dir_der_fallas'] !== null ) , Falla(s): {{$respuesta['bal_eje_dir_der_fallas']}}@endif</center></td>
        </tr>    
        <tr> 
            <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE INTERMEDIO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bal_eje_int_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bal_eje_int_izq_o']}}@if($respuesta['bal_eje_int_izq_fallas'] !== null ) , Falla(s): {{$respuesta['bal_eje_int_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bal_eje_int_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bal_eje_int_der_o']}}@if($respuesta['bal_eje_int_der_fallas'] !== null ) , Falla(s): {{$respuesta['bal_eje_int_der_fallas']}}@endif</center></td>
        </tr>  
        <tr>   
            <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE MOTRIZ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bal_eje_motr_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bal_eje_motr_izq_o']}}@if($respuesta['bal_eje_motr_izq_fallas'] !== null ) , Falla(s): {{$respuesta['bal_eje_motr_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bal_eje_motr_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bal_eje_motr_der_o']}}@if($respuesta['bal_eje_motr_der_fallas'] !== null ) , Falla(s): {{$respuesta['bal_eje_motr_der_fallas']}}@endif</center></td>
        </tr>        
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 15%;"><center>BOLSA DE AIRE</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 10%;"><center>LADO</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
        <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE DIRECCIONAL</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bols_air_eje_dir_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bols_air_eje_dir_izq_o']}}@if($respuesta['bols_air_eje_dir_izq_fallas'] !== null ) , Falla(s): {{$respuesta['bols_air_eje_dir_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bols_air_eje_dir_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bols_air_eje_dir_der_o']}}@if($respuesta['bols_air_eje_dir_der_fallas'] !== null ) , Falla(s): {{$respuesta['bols_air_eje_dir_der_fallas']}}@endif</center></td>
        </tr>    
        <tr> 
            <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE INTERMEDIO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bols_air_eje_int_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bols_air_eje_int_izq_o']}}@if($respuesta['bols_air_eje_int_izq_fallas'] !== null ) , Falla(s): {{$respuesta['bols_air_eje_int_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bols_air_eje_int_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bols_air_eje_int_der_o']}}@if($respuesta['bols_air_eje_int_der_fallas'] !== null ) , Falla(s): {{$respuesta['bols_air_eje_int_der_fallas']}}@endif</center></td>
        </tr>  
        <tr>   
            <td style=" background-color: #fff; font-size: 9px; width: 15%;" rowspan="2"><center>EJE MOTRIZ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bols_air_eje_motr_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bols_air_eje_motr_izq_o']}}@if($respuesta['bols_air_eje_motr_izq_fallas'] !== null ) , Falla(s): {{$respuesta['bols_air_eje_motr_izq_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 10%;"><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['bols_air_eje_motr_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['bols_air_eje_motr_der_o']}}@if($respuesta['bols_air_eje_motr_der_fallas'] !== null ) , Falla(s): {{$respuesta['bols_air_eje_motr_der_fallas']}}@endif</center></td>
        </tr>        
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>ASIENTOS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>CONDUCTOR</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['asiento_conductor']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['asiento_conductor_o']}}@if($respuesta['asiento_conductor_fallas'] !== null ) , Falla(s): {{$respuesta['asiento_conductor_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>CARRO 1</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['asiento_carro1']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['asiento_carro1_o']}}@if($respuesta['asiento_carro1_fallas'] !== null ) , Falla(s): {{$respuesta['asiento_carro1_fallas']}}@endif</center></td>
        </tr>   
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>CARRO 2</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['asiento_carro2']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['asiento_carro2_o']}}@if($respuesta['asiento_carro2_fallas'] !== null ) , Falla(s): {{$respuesta['asiento_carro2_fallas']}}@endif</center></td>
        </tr>        
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>PASAMANOS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>CARRO 1</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['pasamanos_carro1']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['pasamanos_carro1_o']}}</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>CARRO 2</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['pasamanos_carro2']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['pasamanos_carro2_o']}}</center></td>
        </tr>   
              
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 50%;"><center>CODIGO DE DISPLAY</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 50%;"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['codigo_display']}}</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['codigo_display_o']}}</center></td>
        </tr>
        
              
    </table>
              <BR>
             
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>ARTICULACIÓN</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>ARTICULACIÓN</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['articulacion']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['articulacion_o']}}@if($respuesta['articulacion_fallas'] !== null ) , Falla(s): {{$respuesta['articulacion_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>SOPORTE</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['articulacion_soporte']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['articulacion_soporte_o']}}@if($respuesta['articulacion_soporte_fallas'] !== null ) , Falla(s): {{$respuesta['articulacion_soporte_fallas']}}@endif</center></td>
        </tr>   
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>GRANADAS</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['articulacion_granada']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['articulacion_granada_o']}}@if($respuesta['articulacion_granada_fallas'] !== null ) , Falla(s): {{$respuesta['articulacion_granada_fallas']}}@endif</center></td>
        </tr>   
              
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;" colspan="2"><center>CALIBRACION DE NEUMATICOS</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" ><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;" colspan="2"><center>MODULO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['calibracion_neum_granada']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['calibracion_neum_granada_o']}}@if($respuesta['calibracion_neum_granada_fallas'] !== null ) , Falla(s): {{$respuesta['calibracion_neum_granada_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 20%;" rowspan="2"><center>EJE DIRECCIONAL</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;" ><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['eje_dir_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['eje_dir_izq_o']}}@if($respuesta['eje_dir_izq_fallas'] !== null ) , Falla(s): {{$respuesta['eje_dir_izq_fallas']}}@endif</center></td>
        </tr>   
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;" ><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['eje_dir_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['eje_dir_der_o']}}@if($respuesta['eje_dir_der_fallas'] !== null ) , Falla(s): {{$respuesta['eje_dir_der_fallas']}}@endif</center></td>
        </tr>  
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 20%;" rowspan="2"><center>EJE INTERMEDIO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;" ><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['eje_inter_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['eje_inter_izq_o']}}@if($respuesta['eje_inter_izq_fallas'] !== null ) , Falla(s): {{$respuesta['eje_inter_izq_fallas']}}@endif</center></td>
        </tr>   
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;" ><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['eje_inter_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['eje_inter_der_o']}}@if($respuesta['eje_inter_der_fallas'] !== null ) , Falla(s): {{$respuesta['eje_inter_der_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 20%;" rowspan="2"><center>EJE MOTRIZ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;" ><center>IZQ</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['eje_motr_izq']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['eje_motr_izq_o']}}@if($respuesta['eje_motr_izq_fallas'] !== null ) , Falla(s): {{$respuesta['eje_motr_izq_fallas']}}@endif</center></td>
        </tr>   
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 5%;" ><center>DER</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['eje_motr_der']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" ><center>{{$respuesta['eje_motr_der_o']}}@if($respuesta['eje_motr_der_fallas'] !== null ) , Falla(s): {{$respuesta['eje_motr_der_fallas']}}@endif</center></td>
        </tr> 
              
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>SUSPENSIÓN</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>EJE 1</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['susp_eje1']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['susp_eje1_o']}}@if($respuesta['susp_eje1_fallas'] !== null ) , Falla(s): {{$respuesta['susp_eje1_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>EJE 2</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['susp_eje2']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['susp_eje2_o']}}@if($respuesta['susp_eje2_fallas'] !== null ) , Falla(s): {{$respuesta['susp_eje2_fallas']}}@endif</center></td>
        </tr>   
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>EJE 3</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['susp_eje3']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['susp_eje3_o']}}@if($respuesta['susp_eje3_fallas'] !== null ) , Falla(s): {{$respuesta['susp_eje3_fallas']}}@endif</center></td>
        </tr>   
              
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>TANQUE</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>DRENADO</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['tan_drenado']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['tan_drenado_o']}}@if($respuesta['tan_drenado_fallas'] !== null ) , Falla(s): {{$respuesta['tan_drenado_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>CHICOTES</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['tan_chicote']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['tan_chicote_o']}}@if($respuesta['tan_chicote_fallas'] !== null ) , Falla(s): {{$respuesta['tan_chicote_fallas']}}@endif</center></td>
        </tr>       
    </table>
    <br>
    <table>
        <tr>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>SOPORTES</center></td>
            <td style=" background-color: #dddddd; font-size: 9px; width: 25%;"><center>OK</center></td>
            <td style="background-color: #dddddd; font-size: 9px; width: 50%;" colspan="2"><center>OBSERVACIONES</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>MOTOR</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['soport_motor']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['soport_motor_o']}}@if($respuesta['soport_motor_fallas'] !== null ) , Falla(s): {{$respuesta['soport_motor_fallas']}}@endif</center></td>
        </tr>
        <tr>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>TRANSMISION</center></td>
            <td style=" background-color: #fff; font-size: 9px; width: 25%;"><center>{{$respuesta['soport_transmi']}}</center></td>
            <td style="background-color: #fff; font-size: 9px; width: 50%;" colspan="2"><center>{{$respuesta['soport_transmi_o']}}@if($respuesta['soport_transmi_fallas'] !== null ) , Falla(s): {{$respuesta['soport_transmi_fallas']}}@endif</center></td>
        </tr>       
    </table>
    <br> <BR>
    <br> <BR>
    <br> <BR>
    <table>
       
        <tr>
            <td style="border:1px #fff solid; background-color: #fff; font-size: 9px; width: 50%;"><center>_______________________________________</center></td>
            <td style="border:1px #fff solid;  background-color: #fff; font-size: 9px; width: 50%;"><center>_______________________________________</center></td>
        </tr>
        <tr>
            <td style="border:1px #fff solid; background-color: #fff; font-size: 9px; width: 50%;"><center>FIRMA DEL MECANICO<br>{{$respuesta['n_mecanico']}}</center></td>
            <td style="border:1px #fff solid;  background-color: #fff; font-size: 9px; width: 50%;"><center>FIRMA DEL SUPERVISOR<br>{{$respuesta['nom_supervisor']}}</center></td>
        </tr>
        
              
    </table>
    <br>


</body>
@endforeach
</html>






