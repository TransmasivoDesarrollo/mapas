<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        /* Estilo del contenedor de notificación */
        .notify {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745; /* Verde */
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            display: none; /* Ocultar por defecto */
        }

        .notify.show {
            display: block; /* Mostrar cuando se agrega la clase "show" */
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            
            <div class="col-md-12">
                <div class="card-title h4">
                    <center>
                        Bitácora de operaciones (TR4)
                    </center>
                </div>
                <br>
                <div id="notification" class="notify">
                    Se agregó correctamente
                </div>
            </div>
            <!-- Día -->
             
            <div class="col-md-2">
                <div class="form-group form-group-default">
                    <label>Día <span class="required-label">*</span></label>
                    <input  type="date" class="form-control input-with-border" id="dia" name="dia" value="{{ \Carbon\Carbon::now('America/Mexico_City')->format('Y-m-d') }}" onchange="buscar()">
                </div>
            </div>

            <!-- Llegada/Salida -->
            <div class="col-md-2">
                <div class="form-group form-group-default">
                    <label>Llegada/Salida <span class="required-label">*</span></label>
                    <select   class="form-control input-with-border" id="llegada_salida" name="llegada_salida" onchange="buscar()">
                        <option value="1">Salida 1 / Llegada 2</option>
                        <option value="2">Llegada 1 / Salida 2</option>
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group form-group-default">
                    <label>Ciclo <span class="required-label">*</span></label>
                    <input  type="number" class="form-control input-with-border" id="ciclo" name="ciclo" onchange="buscar()" onkeyup="buscar()">
                </div>
            </div>


            <!-- Credencial -->
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label id="credencial_esperada">Credencial <span class="required-label">*</span></label>
                    <input  type="text" class="form-control input-with-border" id="credencial" name="credencial">
                </div>
            </div>


            <!-- Hora -->
            <div class="col-md-2" id="valida_completo_1">
                <div class="form-group form-group-default">
                    <label id="salida1">Hora salida 1<span class="required-label">*</span></label>
                    <input   type="time" class="form-control input-with-border" id="hora_salida" name="hora_salida">
                </div>
            </div>
            <div class="col-md-2" id="valida_completo_2">
                <div class="form-group form-group-default">
                    <label>Hora llegada 2<span class="required-label">*</span></label>
                    <input   type="time" class="form-control input-with-border" id="hora_llegada" name="hora_llegada">
                </div>
            </div>

            <!-- Hora Llegada -->
            <div class="col-md-2" id="valida_mitad_1" hidden>
                <div class="form-group form-group-default">
                    <label>Hora llegada 1 <span class="required-label">*</span></label>
                    <input  type="time" class="form-control input-with-border" id="hora_ll" name="hora_ll">
                </div>
            </div>

            <!-- Hora Salida -->
            <div class="col-md-2" id="valida_mitad_2" hidden>
                <div class="form-group form-group-default">
                    <label  id="salida2">Hora salida 2 <span class="required-label">*</span></label>
                    <input  type="time" class="form-control input-with-border" id="hora_s" name="hora_s">
                </div>
            </div>

            <!-- Económico -->
            <div class="col-md-2">
                <div class="form-group form-group-default">
                    <label id="eco_esperado">Económico <span class="required-label">*</span></label>
                    <input  type="text"  class="form-control input-with-border" id="eco" name="eco">
                </div>
            </div>

            <!-- Terminal -->
            <div class="col-md-2">
                <div class="form-group form-group-default">
                    <label>Terminal</label>
                    <select    class="form-control input-with-border" id="terminal_c" name="terminal">
                        @foreach($terminal as $term)
                        <option value="{{$term->id_terminal}}">{{$term->terminal}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Servicio -->
            <div class="col-md-2">
                <div class="form-group form-group-default">
                    <label>Servicio  <span class="required-label">*</span></label>
                    <input  type="text"  class="form-control input-with-border" id="serv" name="serv">
                    <input  type="hidden"  class="form-control input-with-border" id="serv_h" name="serv_h">
                    <input  type="hidden"  class="form-control input-with-border" id="id_jornada" name="id_jornada">
                </div>
            </div>

            <!-- Comentario -->
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label>Comentario</label>
                    <textarea  class="form-control input-with-border" id="comentarios" name="comentarios"></textarea>
                </div>
            </div>

            <!-- Oper. Apoyo -->
            

            <div class="col-md-12">
                <div class="card-title h4">
                    <br>
                    <center>
                        <input type="submit" value="Registrar" class="btn btn-success" id="Registrar" onclick="registrarFormulario()" name="Registrar">
                    </center>
                </div>
                <br>
            </div>


        </div>
    </div>
</body>

<script src="{{url('/assets')}}/js/core/jquery.3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $('#ciclo').focus();
            $(document).on('keydown', function(event) {
                // Detecta si se presionan Ctrl + Q (keyCode para 'Q' es 81)
                if (event.ctrlKey && event.key === 'q') {
                    event.preventDefault(); // Evita cualquier comportamiento predeterminado
                    $('#boton_registra').click(); // Simula un clic en el botón con el id 'guardarFormulario'
                }
                
            });

            document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.key === 'a') {
                event.preventDefault(); // Previene el comportamiento por defecto de Ctrl + A
                document.getElementById('Registrar').click(); // Simula un clic en el botón
            }
        });
    $('#llegada_salida').on('change', function() {
            var llegada_salida = $(this).val();
            var serv = $('#serv').val();
            if(llegada_salida == "2")
            {
                $('#valida_mitad_1').removeAttr('hidden');
                $('#valida_mitad_2').removeAttr('hidden');
                $('#valida_completo_1').attr('hidden', true);
                $('#valida_completo_2').attr('hidden', true);

            }
            else{
                
                $('#valida_completo_1').removeAttr('hidden');
                $('#valida_completo_2').removeAttr('hidden');
                $('#valida_mitad_2').attr('hidden', true);
                $('#valida_mitad_1').attr('hidden', true);
                
            }
            
            if(serv == "TR4")
            {
                if(llegada_salida == "1" || llegada_salida == "4")
                {
                    $('#terminal_c').val('2'); 
                }else{
                    $('#terminal_c').val('3'); 
                }

            }
            
        });
        // Tu código aquí

        function registrarFormulario()
        {
            var dia = $('#dia').val();
            var llegada_salida = $('#llegada_salida').val();
            var ciclo = $('#ciclo').val();
            var credencial = $('#credencial').val();
            var hora_salida_1 = $('#hora_salida').val();
            var hora_llegada_2 = $('#hora_llegada').val();

            var hora_salida_2 = $('#hora_s').val();
            var hora_llegada_1 = $('#hora_ll').val();

            var eco = $('#eco').val();
            var terminal_c = $('#terminal_c').val();
            var serv = $('#serv').val();
            var comentarios = $('#comentarios').val();
            var id_jornada = $('#id_jornada').val();

             if(eco=="" || eco==null)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta llenar el economico',
                    text: 'Por favor, selecciona una credencial antes de continuar.',
                    confirmButtonText: 'Entendido'
                });
            } else if(ciclo=="" || ciclo==null)
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta llenar el ciclo',
                    text: 'Por favor, selecciona una credencial antes de continuar.',
                    confirmButtonText: 'Entendido'
                });
            }else
            {
                $.ajax({
                    url: '{{ route("insertar_bitacora_operaciones") }}',
                    data: { 
                        'dia': dia ,
                        'llegada_salida': llegada_salida ,
                        'ciclo': ciclo ,
                        'credencial': credencial ,
                        'hora_salida_1': hora_salida_1 ,
                        'hora_llegada_1': hora_llegada_1 ,
                        'eco': eco ,
                        'terminal': terminal_c ,
                        'serv': serv ,
                        'comentarios': comentarios ,
                        'hora_llegada_2': hora_llegada_2 ,
                        'hora_salida_2': hora_salida_2 ,
                        'id_jornada': id_jornada ,
                        
                    },
                    type: 'GET',
                    success: function (json) {
                        console.log('conteo'+json.length);
                        const notification = document.getElementById("notification");
                        notification.classList.add("show");

                        // Ocultar la notificación después de 3 segundos
                        setTimeout(() => {
                            notification.classList.remove("show");
                        }, 3000);
                        var ciclo = $('#ciclo').val();
                        ciclo = +ciclo + 1;
                        $('#ciclo').val( ciclo);
                        $('#ciclo').focus();
                        buscar();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Disculpe, existió un problema.');
                    }
                }); 
            }

            
        }

        function buscar() {
            var ciclo = $('#ciclo').val();
            var dia = $('#dia').val();
            var llegada_salida = $('#llegada_salida').val();
            
            if(ciclo !== null && dia !== null)
            {
                $.ajax({
                    url: '{{ route("buscar_por_ciclo_tr4") }}',
                    data: { 
                        'ciclo': ciclo ,
                        'dia': dia ,
                        'llegada_salida': llegada_salida ,
                    },
                    type: 'GET',
                    
                    success: function (json) {

                        
                        if(json['consulta'].length>0)
                        {
                            console.log(json[ciclo-1]);
                            if (json['consulta'][ciclo-1] !== undefined) {
                                $('#eco').val(json['consulta'][ciclo-1]['eco_registrado']);
                                $('#serv').val(json['consulta'][ciclo-1]['servicio']);
                                $('#id_jornada').val(json['consulta'][ciclo-1]['id_jornada']);

                                var conductor_esperado = json['consulta'][ciclo-1]['id_conductor'];
                                var conductor_regi = json['consulta'][ciclo-1]['conductor_registrado'];
                                var eco = json['consulta'][ciclo-1]['eco'];
                                var eco_registrado = json['consulta'][ciclo-1]['eco_registrado'];
                                
                                if(conductor_esperado!== null)
                                {
                                    $('#credencial_esperada').html('Credencial (esperada ' +conductor_esperado+') <span class="required-label">*</span>');
                                    if(conductor_regi==null)
                                    {

                                        $('#credencial').val(json['consulta'][ciclo-1]['id_conductor']);
                                    }else{

                                        $('#credencial').val(json['consulta'][ciclo-1]['conductor_registrado']);
                                    }
                                }else{
                                    
                                    $('#credencial').val(json['consulta'][ciclo-1]['conductor_registrado']);
                                    $('#credencial_esperada').html('Credencial <span class="required-label">*</span>');
                                }
                                if(eco!== null)
                                {
                                    $('#eco_esperado').html('Eco. (esperada ' +eco+') <span class="required-label">*</span>');
                                    
                                    if(eco_registrado==null)
                                    {

                                        $('#eco').val(json['consulta'][ciclo-1]['eco']);
                                    }else{

                                        $('#eco').val(json['consulta'][ciclo-1]['eco_registrado']);
                                    }
                                }else{
                                    
                                    $('#eco_esperado').html('Eco. <span class="required-label">*</span>');
                                }
                                
                                


                                if(llegada_salida==1)
                                {
                                    
                                    var hora_salida_1 = json['consulta'][ciclo-1]['hora_salida_1'];
                                    var hora_llegada_2 = json['consulta'][ciclo-1]['hora_llegada_2'];

                                    var servicio = json['consulta'][ciclo-1]['servicio'];
                                    if(servicio=='TR4' ){
                                        
                                        var fk_terminal = json['consulta'][ciclo-1]['fk_terminal_s1'];
                                        if(fk_terminal!==null){
                                            
                                        $('#terminal_c').val(fk_terminal).trigger('change');
                                        }else{
                                            $('#terminal_c').val('1').trigger('change');
                                        }
                                    }

                                    if(hora_salida_1!== null){
                                        $('#hora_salida').val(hora_salida_1);
                                    }else{
                                        $('#salida1').html('Hora salida 1 ('+json['consulta'][ciclo-1]['salida_base']+')');
                                        $('#hora_salida').val(json['consulta'][ciclo-1]['salida_base']);
                                    }
                                    if(hora_llegada_2!== null){
                                        $('#hora_llegada').val(hora_llegada_2);
                                    }else{
                                        
                                        $('#hora_llegada').val(null);
                                    }
                                    
                                    
                                }else if(llegada_salida==2)
                                {
                                    
                                    var hora_llegada_1 = json['consulta'][ciclo-1]['hora_llegada_1'];
                                    var hora_salida_2 = json['consulta'][ciclo-1]['hora_salida_2'];
                                    var servicio = json['consulta'][ciclo-1]['servicio'];
                                    if(servicio=='TR4' ){
                                        
                                        var fk_terminal = json['consulta'][ciclo-1]['fk_terminal_s2'];
                                        if(fk_terminal!==null){
                                            
                                        $('#terminal_c').val(fk_terminal).trigger('change');
                                        }else{
                                            $('#terminal_c').val('3').trigger('change');
                                        }
                                    }
                                    if(hora_salida_2!== null){
                                        $('#hora_s').val(hora_salida_2);
                                    }else{
                                        $('#salida2').html('Hora salida 2 ('+json['consulta'][ciclo-1]['salida_mitad_recorrido']+')');
                                        $('#hora_s').val(json['consulta'][ciclo-1]['salida_mitad_recorrido']);
                                    }
                                    if(hora_llegada_1!== null){
                                        $('#hora_ll').val(hora_llegada_1);
                                    }else{
                                        
                                        $('#hora_ll').val(null);
                                    }

                                }
                            }else{
                                
                                $('#salida1').html('Hora salida 1 ');
                                $('#hora_salida').val(null);
                                $('#hora_llegada').val(null);
                                $('#salida2').html('Hora salida 2 ');
                                $('#hora_s').val(null);
                                $('#hora_ll').val(null);

                                $('#credencial_esperada').html('Credencial <span class="required-label">*</span>');
                                $('#credencial').val('');
                                $('#eco').val('');
                                $('#serv').val('');
                            }
                        }else{
                            
                            $('#credencial').val('');
                            $('#eco').val('');
                            $('#serv').val('');
                            $('#hora_s').val(null);
                            $('#hora_salida').val(null);
                            $('#hora_llegada').val(null);
                            $('#hora_ll').val(null);
                        }
                        
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Disculpe, existió un problema.');
                    }
                }); 
            }else{
                $('#comentarios').html('no hay');
            }

            
        }
        

</script>
</html>
