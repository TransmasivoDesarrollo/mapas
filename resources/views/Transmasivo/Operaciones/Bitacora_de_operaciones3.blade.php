<x-app-layout>
        <style>
            .input-with-border {
                border: 1px solid black;
            }
        </style>
        <div class="col-12 col-md-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade active show" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                    <div class="accordion accordion-secondary">
                        

                        <div class="card" style="background-color: #fff;">
                                <div class="card-header">
                                    <div class="card-title" style="display: inline-block;">Bitácora de operaciones</div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Día <span class="required-label">*</span></label>
                                                        <input type="date" 
                                                            class="form-control input-with-border" 
                                                            id="dia" 
                                                            name="dia" 
                                                            value="{{ \Carbon\Carbon::now('America/Mexico_City')->format('Y-m-d') }}" 
                                                            onchange="buscar()">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default">
                                                        <label>Servicio</label>
                                                        <select    class="form-control input-with-border" id="servicio" name="servicio">
                                                            
                                                            <option value="TR1">TR1 / TR1-R</option>
                                                            <option value="TR3">TR3</option>
                                                            <option value="TR4">TR4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group-default" style="border:1px #fff solid;">
                                                        <label>&nbsp;</label>
                                                        <input type="submit" class="btn btn-success" value="Buscar" id="Buscar" onclick="llenar_tabla()" name="Buscar">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="card card-stats ">
                                                        <div class="card-body ">
                                                            <div class="row">
                                                                <div class="col-4" style="cursor: pointer"  onclick="openPopup()">
                                                                    <div class="icon-big text-center icon-warning" style="cursor: pointer; 
                                                                    border: 1px black solid; background: linear-gradient(to right, #e5be01 50%, #FF0080 50%); 
                                                                    cursor: pointer;">
                                                                        <i class="la la-bus text-warning"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4" style="cursor: pointer" onclick="openPopup2()">
                                                                    <div class="icon-big text-center icon-warning" style="cursor: pointer; 
                                                                    border:1px black solid; background-color: #008f39;">
                                                                        <i class="la la-bus text-warning"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4" style="cursor: pointer" onclick="openPopup3()">
                                                                    <div class="icon-big text-center icon-warning" style="cursor: pointer; 
                                                                    border:1px black solid; background-color: #0000ff;">
                                                                        <i class="la la-bus text-warning"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="table-responsive" >
                                            <table class="table table-hover table-bordered table-striped" id="list_user2">
                                                    <thead>
                                                        <tr>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Ciclo</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 15%;"><center>Datos de serv.</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Cred.</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 20%;"><center>Salida 1</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 15%;"><center>Llegada 1</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 20%;"><center>Salida 2</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 15%;"><center>Llegada 2</center></th>
                                                            <th class=" sorting" style="color:#ffffff; background-color:#872637; width: 5%;"><center>Km circuito</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="llenaTabla">
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
   
    </div>
    @section('jscustom')
    <script type="text/javascript">

        function openPopup() {
            // Abre una nueva ventana emergente
            window.open(
                "Bitacora_de_operaciones3_tr1_tr1_r", // URL de la página a abrir
                "_blank", // Para abrir en una nueva ventana o pestaña
                "width=1200,height=600,resizable=yes,scrollbars=yes,status=yes" // Especifica las características de la ventana
            );
        }
        function openPopup2() {
            // Abre una nueva ventana emergente
            window.open(
                "Bitacora_de_operaciones3_tr3", // URL de la página a abrir
                "_blank", // Para abrir en una nueva ventana o pestaña
                "width=1200,height=600,resizable=yes,scrollbars=yes,status=yes" // Especifica las características de la ventana
            );
        }
        function openPopup3() {
            // Abre una nueva ventana emergente
            window.open(
                "Bitacora_de_operaciones3_tr4", // URL de la página a abrir
                "_blank", // Para abrir en una nueva ventana o pestaña
                "width=1200,height=600,resizable=yes,scrollbars=yes,status=yes" // Especifica las características de la ventana
            );
        }
        $(document).ready(function() {
    // Llama a la función inmediatamente al cargar la página
    

    // Ejecuta la función cada 10 segundos (10,000 milisegundos)
    setInterval(function() {
                    llenar_tabla();
                }, 10000);
            });

        function llenar_tabla()
        {
            var dia = $('#dia').val();
            var servicio = $('#servicio').val();
            $.ajax({
                    url: '{{ route("llenar_tabla_bitacora_3") }}',
                    data: { 
                        'dia': dia ,
                        'servicio': servicio ,
                    },
                    type: 'GET',
                    success: function (json) {
                        var html='';
                        console.log(json);
                        
                        for(var i=0; json.length>i ; i++)
                        {
                            var salida_base = json[i].salida_base;      // Hora esperada (ej: "12:30:00")
                            var hora_salida_1 = json[i].hora_salida_1;  
                            var minutos_esperados ="";
                            if(salida_base!==null){
                                minutos_esperados = convertirATotalMinutos(salida_base);
                            }
                            
                            var minutos_reales ='';
                            if(hora_salida_1!==null){
                                minutos_reales = convertirATotalMinutos(hora_salida_1);
                            }

                            var diferencia = minutos_reales - minutos_esperados;
                            var estado;
                            if(hora_salida_1!==null)
                            {
                                if (diferencia == 0) {
                                    estado = "<b style='color:green;'>En tiempo</b>";
                                } else if (diferencia > 0) {
                                    estado = "<b style='color:orange;'>Retrasado </b>" + diferencia + " min.";
                                } else {
                                    estado = "<b style='color:orange;'> Adelantado </b>" + Math.abs(diferencia) + " min.";
                                }

                            }else{
                                estado="<center style='color:red;'>Sin registro</center>";
                            }
                            
                            var salida_base_2 = json[i].salida_mitad_recorrido;     
                            var hora_salida_1_2 = json[i].hora_salida_2;  
                            
                            var minutos_esperados_2 ='';
                            if(salida_base_2!==null){
                                minutos_esperados_2 = convertirATotalMinutos(salida_base_2);
                            }
                            
                            var minutos_reales_2 ='';
                            if(hora_salida_1_2!==null){
                                minutos_reales_2 = convertirATotalMinutos(hora_salida_1_2);
                            }
                            var diferencia_2 = minutos_reales_2 - minutos_esperados_2;
                            var estado_2;
                            if (diferencia_2 == 0) {
                                estado_2 = "<b style='color:green;'>En tiempo</b>";
                            } else if (diferencia_2 > 0) {
                                estado_2 = "<b style='color:orange;'>Retrasado </b>" + diferencia_2 + " min.";
                            } else {
                                estado_2 = "<b style='color:orange;'>Adelantado </b>" + Math.abs(diferencia_2) + " min.";
                            }
                            var Ojo_De_Agua_1 = 0; 
                            var Esmeralda_1 = 1.47; 
                            var Cuauhtemoc_Norte_1 = 2; 
                            var Cuauhtemoc_Sur_1 = 3.05; 
                            var Hidalgo_1 = 3.58; 
                            var Insurgentes_1 = 4.39; 
                            var Central_De_Abastos_1 = 5.3; 
                            var e_19_De_Septiembre_1 = 6.62; 
                            var Palomas_1 = 7.6; 
                            var Jardines_De_Morelos_1 = 8; 
                            var Aquiles_Serdan_1 = 8.26; 
                            var Hospital_1 = 8.77; 
                            var e_1ro_De_Mayo_1 = 9.6; 
                            var Las_Americas_1 = 10.55; 
                            var Valle_De_Ecatepec_1 = 11.64; 
                            var Vocacional_3_1 = 12.4; 
                            var Adolfo_Lopez_Mateos_1 = 12.5; 
                            var Zodiaco_1 = 13; 
                            var Alfredo_Torres_1 = 13.58; 
                            var Unitec_1 = 14.02; 
                            var Estacion_Industrial_1 = 14.5; 
                            var Josefa_Ortiz_De_Dominguez_1 = 15; 
                            var Quinto_Sol_1 = 15.83; 
                            var Ciudad_Azteca_1 = 16.5; 

                            var Ojo_De_Agua_2 = 17.1; 
                            var Esmeralda_2 = 15; 
                            var Cuauhtemoc_Norte_2 = 14.5; 
                            var Cuauhtemoc_Sur_2 = 13.47; 
                            var Hidalgo_2 = 12.9; 
                            var Insurgentes_2 = 12.04; 
                            var Central_De_Abastos_2 = 11.3; 
                            var e_19_De_Septiembre_2 = 9.8; 
                            var Palomas_2 = 9.39; 
                            var Jardines_De_Morelos_2 = 8.45; 
                            var Aquiles_Serdan_2 = 8.18; 
                            var Hospital_2 = 7.66; 
                            var e_1ro_De_Mayo_2 = 6.73; 
                            var Las_Americas_2 = 5.88; 
                            var Valle_De_Ecatepec_2 = 4.8; 
                            var Vocacional_3_2 = 4.31; 
                            var Adolfo_Lopez_Mateos_2 = 3.93; 
                            var Zodiaco_2 = 3.45; 
                            var Alfredo_Torres_2 = 2.86; 
                            var Unitec_2 = 2.34; 
                            var Estacion_Industrial_2 = 1.86; 
                            var Josefa_Ortiz_De_Dominguez_2 = 1.41; 
                            var Quinto_Sol_2 = 0.6; 
                            var Ciudad_Azteca_2 = 0; 


                            
                            html+="<tr>";
                            html+="<td><center>"+json[i].numero+"</center></td>";
                            html+="<td>"+json[i].turno+"<br>Jorna: "+json[i].jornada+"<br>Ciclo: "+json[i].ciclo;
                            if(json[i].servicio =="TR1-R")
                            {
                                html += "<br>Servicio: <b style='color: rgb(255,0,128)'>"+json[i].servicio+"</b></td>";
                            }
                            if(json[i].servicio =="TR1")
                            {
                                html += "<br>Servicio: <b style='color: rgb(251,177,23)'>"+json[i].servicio+"</b></td>";
                            }
                            if(json[i].servicio =="TR3")
                            {
                                html += "<br>Servicio: <b style='color: rgb(0,143,57)'>"+json[i].servicio+"</b></td>";
                            }
                            if(json[i].servicio =="TR4")
                            {
                                html += "<br>Servicio: <b style='color: rgb(0,0,255)'>"+json[i].servicio+"</b></td>";
                            }

                            if(json[i].conductor_registrado==null)
                            {
                                html+="<td><center  style='color:red;'>Sin registro</center></td>";
                            }else{
                                html+="<td>"+json[i].conductor_registrado+"</td>";
                            }
                            html += "<td><table style='width:100%;'><tr>"+
                                    "<td>";
                                    if(json[i].salida_base !== null)
                                    {
                                        html += "Espe:<b> " + json[i].salida_base.substring(0, 5) +"</b>";
                                    }else{

                                        html += "" ;
                                    }
                            html += "</td><td>";
                           
                                    if(json[i].hora_salida_1 !== null)
                                    {
                                        html += "Real:<b> " + json[i].hora_salida_1.substring(0, 5)+"</b>" ;
                                    }else{

                                        html += "" ;
                                    }
                            html += "</td></tr><tr><td colspan='2'><center>";
                            var terminal_1no = json[i].terminal_1;
                            if(terminal_1no ==null)
                            {
                                html +=" <br> "+estado+"<center></td></tr>";

                            }else{
                                
                            html += json[i].terminal_1+" <br> "+estado+"<center></td></tr>";
                            }
                                    html +="</table></td>";
                                    if(json[i].hora_llegada_1 ==null){
                                        html+="<td><center  style='color:red;'>Sin registro</center></td>";
                                    }else{
                                        html+="<td><center>Real:<b>"+json[i].hora_llegada_1.substring(0, 5)+"</b></center></td>";
                                    }

                            html += "<td><table style='width:100%;'><tr>"+
                                    "<td>";

                                    if(json[i].salida_mitad_recorrido !== null)
                                    {
                                        html += "Espe:<b> " + json[i].salida_mitad_recorrido.substring(0, 5)+"</b>" ;
                                    }else{

                                        html += "" ;
                                    }
                            html += "</td><td>";
                                    if(json[i].hora_salida_2 !== null)
                                    {
                                        html += "Real:<b> " + json[i].hora_salida_2.substring(0, 5) +"</b>";
                                        html += "</td></tr><tr><td colspan='2'><center>"+json[i].terminal_2+" <br> "+estado_2+"<center></td></tr>"
                                    +"</table></td>";
                                    }else{

                                        html += "<center  style='color:red;'>Sin registro </center>" ;
                                        html += "</td></tr><tr><td colspan='2'><center  style='color:red;'>Sin registro</center></td></tr>"
                                    +"</table></td>";
                                    }
                            
                                    if(json[i].hora_llegada_2 !== null)
                                    {
                                        
                            html+="<td><center>Real:<b> "+json[i].hora_llegada_2.substring(0, 5)+"</b></center></td>";
                                    }else{

                                       
                            html+="<td><center style='color:red;'>Sin registro</center></td>";
                                    }
                                    
                            html+="<td>Km:"+json[i].fk_terminal_s1+"</td>";
                            html+="</tr>";
                        }
                        $('#llenaTabla').html(html);
                        //console.log(json.length);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Disculpe, existió un problema.');
                    }
                }); 
        }
        function convertirATotalMinutos(hora) {
            var partes = hora.split(":"); // Divide en [HH, MM, SS]
            var horas = parseInt(partes[0], 10);
            var minutos = parseInt(partes[1], 10);
            return horas * 60 + minutos; // Convierte horas a minutos y suma
        }
    </script>
    @endsection
    </x-app-layout>
