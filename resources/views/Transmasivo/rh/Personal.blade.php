<x-app-layout>
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

        .input-with-border {
            border: 1px solid black;
        }
        #list_user22 th:nth-child(1),
        #list_user22 td:nth-child(1) {
            position: sticky;
            left: 0;
            background-color: #f8f9fa; /* Puedes cambiar el color de fondo si lo deseas */
            z-index: 1; /* Asegura que la columna fija esté por encima del resto de la tabla */
        }

    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Reporte de personal </div>
            
        </div>
        
        
        <div class="card-body">
        @if (session('mensaje'))
            <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert" aria-label="Close">
                {{ session('mensaje') }}.
               
            </div>
        @endif

<!-- Your other HTML and Blade code here -->


            <div class="table-responsive" style="overflow-x: auto;">
            <table class="table table-bordered  " id="list_user22">
                    <thead>
                        <tr>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Nombre</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Edad</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Sexo</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estado civil</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Calle</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Numero </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Colonia </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Alcaldia municipio </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estado </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Codigo postal </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>RFC </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>NSS  </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>CURP </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Correo </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Puesto  </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha_contrato </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha_real </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Quien registro </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Acción </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>QR </center></th>
                        </tr>
                    </thead>

                    <tbody id="llenaTabla">
                        @if($consulta !== "")
                        @foreach($consulta as $consul)
                        
                                <tr>
                                    <td>{{$consul->Nombre}}</td>
                                    <td>{{$consul->Edad}}</td>
                                    <td>{{$consul->Sexo}}</td>
                                    <td>{{$consul->Estado_civil}}</td>
                                    <td>{{$consul->Calle}}</td>
                                    <td>{{$consul->Numero}}</td>
                                    <td>{{$consul->Colonia}}</td>
                                    <td>{{$consul->Alcaldia_municipio}}</td>
                                    <td>{{$consul->Estado}}</td>
                                    <td>{{$consul->Codigo_postal}}</td>
                                    <td>{{$consul->RFC}}</td>
                                    <td>{{$consul->NSS}}</td>
                                    <td>{{$consul->CURP}}</td>
                                    <td>{{$consul->Correo}}</td>
                                    <td>{{$consul->Puesto}}</td>
                                    <td>{{$consul->Fecha_contrato}}</td>
                                    <td>{{$consul->Fecha_real}}</td>
                                    <td>{{$consul->name}}</td>
                                    <td>{{$consul->Estatus}}</td>
                                    @if($consul->Estatus=="Baja")
                                    
                                    <td></td>
                                    @elseif($consul->Estatus=="Activo")
                                    <td> 
                                    <form method="post" id="exampleValidation" action="{{url('/Personal')}}">
					                    @csrf
                                        <input type='submit' value="Dar de baja" class="btn btn-danger" id="baja" name="baja">
                                        <input type="hidden" id='id_personal' name='id_personal' value="{{$consul->id_personal}}">
                                        <input type='submit' value="Reimprimir contrato" class="btn btn-success" id="Reimprimir" name="Reimprimir">
                                    </form>
                                        <input type="button" value="Modificar personal" onclick="llenarDatosModal('{{$consul->Nombre}}','{{$consul->Fecha_nacimiento}}','{{$consul->Edad}}','{{$consul->Puesto}}','{{$consul->Nacionalidad}}',
                                            '{{$consul->Sexo}}','{{$consul->Estado_civil}}','{{$consul->Calle}}','{{$consul->Numero}}','{{$consul->Colonia}}','{{$consul->Alcaldia_municipio}}','{{$consul->Estado}}','{{$consul->Codigo_postal}}',
                                            '{{$consul->RFC}}','{{$consul->NSS}}','{{$consul->CURP}}','{{$consul->Correo}}','{{$consul->Salario_diario}}','{{$consul->Fecha_contrato}}','{{$consul->Fecha_contrato_date}}','{{$consul->id_personal}}'
                                        )" class="btn btn-info" data-toggle="modal" data-target="#modificarModal">
                                    </td>
                                    @endif
                                    {{-- <td width="150px">
                                        
    {!! QrCode::size(300)
        ->merge('assets/img/mexibus2024.png', 0.5, true)
        ->generate(url('id=').''.$consul->id_personal) !!}
</td>--}}


                                </tr>
                        @endforeach
                      @endif
                      <div class="modal fade" id="modificarModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modificar Personal</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal Body -->
                            <form method="post" id="exampleValidation" action="{{url('/Personal')}}">
					            @csrf
                                <div class="modal-body">
                                    <div class="form-group row " >
                                        <div class="col-md-4">
                                            <label>Nombre completo <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="nombre" name="nombre" >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Fecha de nacimiento <span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="nacimiento" name="nacimiento" >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Edad <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Edad" name="Edad" >
                                        </div>
                                    </div>
                                    
                                    
                                        
                                    <div class="form-group row " >
                                        <div class="col-md-4">
                                            <label>Puesto <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Puesto" name="Puesto" >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nacionalidad <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Nacionalidad" name="Nacionalidad" value="Mexicana" >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Sexo <span class="required-label">*</span></label>
                                            <select required class="form-control input-with-border" id="Sexo" name="Sexo">
                                                <option value="MASCULINO">Masculino</option>
                                                <option value="FEMENINO">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-4">
                                            <label>Estado Civil <span class="required-label">*</span></label>
                                            <select required class="form-control input-with-border" id="Civil" name="Civil">
                                                <option value="">Seleccione una opción</option>
                                                <option value="SOLTERO">Soltero</option>
                                                <option value="CASADO">Casado</option>
                                                <option value="DIVORCIADO">Divorciado</option>
                                                <option value="VIUDO">Viudo</option>
                                                <option value="UNIÓN LIBRE">Unión libre</option>
                                                <option value="SEPARADO">Separado</option>
                                                <option value="COMPROMETIDO">Comprometido</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-12">
                                            <hr>	
                                            <center><b>Domicilio</b></center>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-12">
                                                
                                        </div>
                                        <div class="col-md-4">
                                            <label>Calle <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Calle" name="Calle"  >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Numero <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Numero" name="Numero"  >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Colonia <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Colonia" name="Colonia"  >
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group row " >
                                        
                                        <div class="col-md-4">
                                            <label>Alcaldía/Municipio <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="Alcaldia" name="Alcaldia"  >
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <label>Código postal <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="postal" name="postal"  >
                                        </div>
                                        
                                        <div class="col-md-12">
                                            
                                        <hr>
                                        </div>
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-4">
                                            <label>RFC <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="RFC" name="RFC"  >
                                        </div>
                                        <div class="col-md-4">
                                            <label>IMSS <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="IMSS" name="IMSS"  >
                                        </div>
                                        <div class="col-md-4">
                                            <label>CURP <span class="required-label">*</span></label>
                                            <input required type="text" class="form-control input-with-border" id="CURP" name="CURP"  >
                                        </div>
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-4">
                                            <label>Correo </label>
                                            <input required type="text" class="form-control input-with-border" id="Correo" name="Correo"  >
                                        </div>
                                        <div class="col-md-4">
                                            <label>Salario diario <span class="required-label">*</span></label>
                                            <input required type="number" step="0.01" class="form-control input-with-border" id="Salario_diario" name="Salario_diario" oninput="convertSalary()">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Salario en letras <span class="required-label">*</span></label>
                                            <input type="text" class="form-control input-with-border" id="Salario_diario_letras" name="Salario_diario_letras" >
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-4">
                                            <label>Fecha de contrato <span class="required-label">*</span></label>
                                            <input required type="date" class="form-control input-with-border" id="fecha_contrato" name="fecha_contrato" value="{{ now()->format('Y-m-d') }}">
                                            <input  type="hidden" class="form-control input-with-border" id="fecha_contrato_hidden" name="fecha_contrato_hidden" >
                                            <input  type="hidden" class="form-control input-with-border" id="id_personal_modal" name="id_personal_modal" >

                                        </div>
                                        
                                    </div>
                                    <div class="form-group row " >
                                        <div class="col-md-12">
                                            <center>
                                            <input required type="submit" class="btn btn-success" id="Actualizar" name="Actualizar" value="Actualizar" >
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                    </div>

                    </tbody>

                </table>

            </div>
        </div>

        
    </div>
    


@section('jscustom')
<script type="text/javascript">
        $('#list_user22').DataTable({
        scrollX: false,
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[7, 14, 21, 28, 35, -1], [7, 14, 21, 28, 35, "Todos"]],
        iDisplayLength: 7,
        dom: 'lBfrtip', // Agrega los elementos que quieres mostrar y sus ubicaciones
        buttons: [ // Configura los botones de descarga
            'excel' // Agrega el botón de Excel
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ datos",
            "zeroRecords": "No existe el dato introducido",
            "info": "Página _PAGE_ de _PAGES_ ",
            "infoEmpty": "Sin datos disponibles",
            "infoFiltered": "(mostrando los datos filtrados: _MAX_)",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "search": "Buscar",
            "processing": "Buscando...",
            "loadingRecords": "Cargando..."
        }
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

    function llenarDatosModal(Nombre,Fecha_nacimiento,Edad,Puesto,Nacionalidad,Sexo,Estado_civil,Calle,Numero,Colonia,Alcaldia_municipio,Estado,Codigo_postal,RFC,NSS,CURP,Correo,Salario_diario,Fecha_contrato,Fecha_contrato_date,id_personal){
        $('#nombre').val(Nombre);
        console.log(Fecha_nacimiento);
        $('#nacimiento').val(Fecha_nacimiento);
        $('#Edad').val(Edad);
        $('#Puesto').val(Puesto);
        $('#Nacionalidad').val(Nacionalidad);
        $('#Sexo').val(Sexo);
        const sexo = Sexo;
		console.log('hie');
        const estadoCivilSelect = document.getElementById('Civil');
        estadoCivilSelect.innerHTML = ''; // Limpiar opciones anteriores

        // Agregar opciones según el sexo seleccionado
        if (sexo === 'MASCULINO') {
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
        } else if (sexo === 'FEMENINO') {
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
        $('#Civil').val(Estado_civil);
        $('#Calle').val(Calle);
        $('#Numero').val(Numero);
        $('#Colonia').val(Colonia);
        $('#Alcaldia').val(Alcaldia_municipio);
        $('#Estado').val(Estado);
        $('#postal').val(Codigo_postal);
        $('#RFC').val(RFC);
        $('#IMSS').val(NSS);
        $('#CURP').val(CURP);
        $('#Correo').val(Correo);
        $('#Salario_diario').val(Salario_diario);
        $('#id_personal_modal').val(id_personal);
        
        convertSalary();
        $('#fecha_contrato').val(Fecha_contrato_date);
        const fecha = new Date(Fecha_contrato_date);
        const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        const diaSemana = dias[fecha.getUTCDay()];
        const dia = fecha.getUTCDate();
        const mes = meses[fecha.getUTCMonth()];
        const año = fecha.getUTCFullYear();

        const fechaTexto = `${diaSemana}, ${dia} de ${mes} de ${año}`;
			$('#fecha_contrato_hidden').val(fechaTexto);
    }

    function convertSalary() {
        const salaryInput = document.getElementById('Salario_diario');
        const salaryInWords = document.getElementById('Salario_diario_letras');
        const salary = parseInt(salaryInput.value);

        if (!isNaN(salary)) {
            salaryInWords.value = numberToWords(salary);
        } else {
            salaryInWords.value = '';
        }
    }
    
        document.getElementById('Sexo').addEventListener('change', function() {
        const sexo = this.value;
        const estadoCivilSelect = document.getElementById('Civil');
        estadoCivilSelect.innerHTML = ''; // Limpiar opciones anteriores

        // Agregar opciones según el sexo seleccionado
		if (sexo === 'MASCULINO') {
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
        } else if (sexo === 'FEMENINO') {
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
	
	function numberToWords(num) {
        const units = ["", "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve"];
        const teens = ["Diez", "Once", "Doce", "Trece", "Catorce", "Quince", "Dieciséis", "Diecisiete", "Dieciocho", "Diecinueve"];
        const tens = ["", "", "Veinte", "Treinta", "Cuarenta", "Cincuenta", "Sesenta", "Setenta", "Ochenta", "Noventa"];
        const hundreds = ["", "Cien", "Doscientos", "Trescientos", "Cuatrocientos", "Quinientos", "Seiscientos", "Setecientos", "Ochocientos", "Novecientos"];

        if (num === 0) return "Cero";

        let words = '';

        if (num >= 1000) {
            words += "Mil ";
            num %= 1000;
        }

        if (num >= 100) {
            words += hundreds[Math.floor(num / 100)] + " ";
            num %= 100;
        }

        if (num >= 20) {
            words += tens[Math.floor(num / 10)] + " ";
            num %= 10;
        } else if (num >= 10) {
            words += teens[num - 10] + " ";
            num = 0;
        }

        if (num > 0) {
            words += units[num] + " ";
        }

        return words.trim().toUpperCase();
    }

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
                $('#Edad').val(edad);
            } else {
                $('#Edad').val('');
            }
        });
</script>
@endsection
</x-app-layout>
