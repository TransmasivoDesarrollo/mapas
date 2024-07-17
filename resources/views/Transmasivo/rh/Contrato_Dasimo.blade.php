<x-app-layout>

    <style>
        .input-with-border {
            border:1px solid black;
        }
    </style>
    <div class ="card">
    <div class ="card-header">
        <div class ="card-title"> Contrato Dasimo </div>
        </div>
    <div class="card-body">
        @if (session('mensaje'))
        <div class="alert alert-{{session('color')}} alert-dismissible" data-dismiss="alert">

            {{session('mensaje')}}.
        </div>
        @endif
        <form method="post" id="contratoForm" action="{{url('/Contrato_Dasimo')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-3">
                    <label> Nombre Completo<span class="requiered-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="nombre" name="nombre">
                </div>
                <div class="col-md-3">
                    <label>Fecha de nacimiento <span class=requiered-label">*</span></label>
                    <input requiered type="date" class="form-control input-with-border" id="nacimiento" name="nacimiento">
                </div>
                <div class="col-md-3">
                    <label>Edad<span class="required label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="edad" name="edad">
                </div>
                <div class="col-md-3">
                    <label>Puesto<span class="required label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="puesto" name="puesto">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label> Nacionalidad<span class="requiered-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="Nacionalidad" name="Nacionalidad" value="Mexicana">
                </div>
                <div class="col-md-3">
                    <label>Sexo <span class=" requiered-label">*</span></label>
                    <select required class="form-control input-with-border" id="Sexo" name="Sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Estado civil <span class="required-label">*</span></label>
                    <select required class="form-control input-with-border" id="Civil" name="Civil">
                        <option value="">Seleccione una opcion</option>
                        <option value="SOLTERO">Soltero</option>
                        <option value="CASADO">Casado</option>
                        <option value="DIVORCIADO">Divorciado</option>
                        <option value="VIUDO">Viudo</option>
                        <option value="UNION LIBRE">Union Libre</option>
                        <option value="SEPARADO">Separado</option>
                        <option value="COMPROMETIDO">Comprometido</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label> Credencial<span class="requiered-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="id_empleado" name="id_empleado" value="">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <hr>
                    <center><b>Domicilio</b></center>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                </div>
                <div class="col-md-2">
                    <label>Calle<span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="calle" name="calle">
                </div>
                <div class="col-md-2">
                    <label>Numero<span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="numero" name="numero">
                </div>
                <div class="col-md-2">
                    <label>Colonia<span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="colonia" name="colonia">
                </div>
                <div class="col-md-2">
                    <label>Alcaldía/Municipio <span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="Alcaldia" name="Alcaldia"  >
                </div>
                <div class="col-md-2">
                    <label>Estado <span class="required-label">*</span></label>
                    <select required class="form-control input-with-border" id="Estado" name="Estado">
                        <option value="">SELECCIONE UN ESTADO</option>
                        <option value="AGUASCALIENTES">Aguascalientes</option>
                        <option value="BAJA CALIFORNIA">Baja California</option>
                        <option value="BAJA CALIFORNIA SUR">Baja California Sur</option>
                        <option value="CAMPECHE">Campeche</option>
                        <option value="CHIAPAS">Chiapas</option>
                        <option value="CHIHUAHUA">Chihuahua</option>
                        <option value="CIUDAD DE MEXICO">Ciudad de México</option>
                        <option value="COAHUILA">Coahuila</option>
                        <option value="COLIMA">Colima</option>
                        <option value="DURANGO">Durango</option>
                        <option value="GUANAJUATO">Guanajuato</option>
                        <option value="GUERRERO">Guerrero</option>
                        <option value="HIDALGO">Hidalgo</option>
                        <option value="JALISCO">Jalisco</option>
                        <option value="ESTADO DE MEXICO" selected>Estado de México</option>
                        <option value="MICHOACAN">Michoacán</option>
                        <option value="MORELOS">Morelos</option>
                        <option value="NAYARIT">Nayarit</option>
                        <option value="NUEVO LEON">Nuevo León</option>
                        <option value="OAXACA">Oaxaca</option>
                        <option value="PUEBLA">Puebla</option>
                        <option value="QUERÉTARO">Querétaro</option>
                        <option value="QUINTANA ROO">Quintana Roo</option>
                        <option value="SAN LUIS POTOSÍ">San Luis Potosí</option>
                        <option value="SINALOA">Sinaloa</option>
                        <option value="SONORA">Sonora</option>
                        <option value="TABASCO">Tabasco</option>
                        <option value="TAMAULIPAS">Tamaulipas</option>
                        <option value="TLAXCALA">Tlaxcala</option>
                        <option value="VERACRUZ">Veracruz</option>
                        <option value="YUCATÁN">Yucatán</option>
                        <option value="ZACATECAS">Zacatecas</option>
                    </select>

                </div>
                <div class="col-md-2">
                    <label>Código postal <span class="required-label">*</span></label>
                    <input required type="text" class="form-control input-with-border" id="postal" name="postal"  >
                </div>

                <div class="col-md-12">
                    
                    <hr>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>RFC<span class="required-label">*</span>  </label>
                    <input required type="text" class="form-control input-with-border" id="rfc" name="rfc">
                </div>

                <div class="col-md-2">
                    <label>IMSS<span class="required-label">*</span>  </label>
                    <input required type="text" class="form-control input-with-border" id="imss" name="imss">
                </div>
                <div class="col-md-2">
                    <label>CURP<span class="required-label">*</span>  </label>
                    <input required type="text" class="form-control input-with-border" id="curp" name="curp">
                </div>
                <div class="col-md-2">
                    <label>Correo<span class="required-label">*</span>  </label>
                    <input required type="text" class="form-control input-with-border" id="correo" name="correo">
                </div>
                <div class="col-md-3">
                    <label>Fecha de contrato <span class="required-label">*</span></label>
                    <input required type="date" class="form-control input-with-border" id="fecha_contrato" name="fecha_contrato" value="{{ now()->format('Y-m-d') }}">
                    <input  type="hidden" class="form-control input-with-border" id="fecha_contrato_hidden" name="fecha_contrato_hidden" >

                </div>
            </div>
            
            <div class="form-group row " >
                <div class="col-md-12">
                    <center>
                        <input required type="submit" class="btn btn-success" id="Generar" name="Generar" value="Generar" >
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>


@section('jscustom')
<script type="text/javascript">
    
    
    
    
    
    $(document).ready(function() {
        $('#contratoForm').on('submit', function(event) {
            console.log('a');
            {{--
                setTimeout(function(){
                $('#contratoForm')[0].reset();
            }, 2000);
                --}}
            
            
        });
        $('#nacimiento').on('change', function() {
            var nacimiento = $(this).val();
            if (nacimiento) {
                var hoy = new Date();
                var cumpleanos = new Date(nacimiento);
                var edad = hoy.getFullYear() - cumpleanos.getFullYear();
                var mes = hoy.getMonth() - cumpleanos.getMonth();
                if (mes < 0 || (mes === 0 && hoy.getDate() < cumpleanos.getDate())) {
                    edad--;
                }
                $('#edad').val(edad);
            } else {
                $('#edad').val('');
            }
        });
        const fecha = new Date($('#fecha_contrato').val());
        const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        const diaSemana = dias[fecha.getUTCDay()];
        const dia = fecha.getUTCDate();
        const mes = meses[fecha.getUTCMonth()];
        const año = fecha.getUTCFullYear();

        const fechaTexto = `${diaSemana}, ${dia} de ${mes} de ${año}`;
        $('#fecha_contrato_hidden').val(fechaTexto);
        
    });
    $('#fecha_contrato').on('change', function() {
        const fecha = new Date($('#fecha_contrato').val());
        const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        const diaSemana = dias[fecha.getUTCDay()];
        const dia = fecha.getUTCDate();
        const mes = meses[fecha.getUTCMonth()];
        const año = fecha.getUTCFullYear();

        const fechaTexto = `${diaSemana}, ${dia} de ${mes} de ${año}`;
        $('#fecha_contrato_hidden').val(fechaTexto);
        
    });
    document.getElementById('Sexo').addEventListener('change', function() {
        const sexo = this.value;
        console.log('hie');
        const estadoCivilSelect = document.getElementById('Civil');
        estadoCivilSelect.innerHTML = ''; // Limpiar opciones anteriores
        // Agregar opciones según el sexo seleccionado 
        if (sexo === 'Masculino') {
            estadoCivilSelect.innerHTML = `
            <option value="">Seleccione una opción</option>
            <option value="SOLTERO">Soltero</option>
            <option value="CASADO">Casado</option>
            <option value="DIVORCIADO">Divorciado</option>
            <option value="VIUDO">Viudo</option>
            <option value="UNIÓN LIBRE">Unión libre</option>
            <option value="SEPARADO">Separado</option>
            <option value="COMPROMETIDO">Comprometido</option>
            `;
        } else if (sexo === 'Femenino') {
            estadoCivilSelect.innerHTML = `
            <option value="">Seleccione una opción</option>
            <option value="SOLTERA">Soltera</option>
            <option value="CASADA">Casada</option>
            <option value="DIVORCIADA">Divorciada</option>
            <option value="VIUDA">Viuda</option>
            <option value="UNIÓN LIBRE">Unión libre</option>
            <option value="SEPARADA">Separada</option>
            <option value="COMPROMETIDA">Comprometida</option>
            `;
        }
    });

</script>
@endsection
</x-app-layout>
