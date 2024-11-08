<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Contratos</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="contratoForm" action="{{url('/Contratos')}}">
				@csrf
				<div class="form-group row " >
                    
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>ID Empleado<span class="required-label">*</span></label>
                            <input id="empleado" name="empleado"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Nombre(s)<span class="required-label">*</span></label>
                            <input id="nombre" name="nombre"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Apellido paterno<span class="required-label">*</span></label>
                            <input id="apellido_p" name="apellido_p"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Apellido materno<span class="required-label">*</span></label>
                            <input id="apellido_m" name="apellido_m"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Fecha de nacimiento<span class="required-label">*</span></label>
                            <input id="nacimiento" name="nacimiento"  type="date" class="form-control" required>
                        </div>
					</div>
                    
                    <div class="col-md-1">
                        <div class="form-group form-group-default">
                            <label>Edad<span class="required-label">*</span></label>
                            <input id="Edad" name="Edad"  type="text" class="form-control" required>
                        </div>
					</div>
                    
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Puesto<span class="required-label">*</span></label>
                            <input id="Puesto" name="Puesto"  type="text" class="form-control" required>
                        </div>
					</div>
					<div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Nacionalidad<span class="required-label">*</span></label>
                            <input id="Nacionalidad" name="Nacionalidad"  type="text" class="form-control" required value="Mexicana">
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Sexo<span class="required-label">*</span></label>
                            <select required class="form-control input-with-border" id="Sexo" name="Sexo">
                                <option value="MASCULINO">Masculino</option>
                                <option value="FEMENINO">Femenino</option>
                            </select>
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Estado Civil<span class="required-label">*</span></label>
                            <select required class="form-control" id="Civil" name="Civil">
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
				</div>
                <hr>	
				<div class="form-group row " >
					<div class="col-md-12">
						<center><b>Domicilio</b></center>
					</div>
				</div>
				<div class="form-group row " >
					<div class="col-md-12">
							
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Calle<span class="required-label">*</span></label>
                            <input id="Calle" name="Calle"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Numero<span class="required-label">*</span></label>
                            <input id="Numero" name="Numero"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-4">
                        <div class="form-group form-group-default">
                            <label>Colonia<span class="required-label">*</span></label>
                            <input id="Colonia" name="Colonia"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-4">
                        <div class="form-group form-group-default">
                            <label>Alcaldía/Municipio<span class="required-label">*</span></label>
                            <input id="Alcaldia" name="Alcaldia"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Estado<span class="required-label">*</span></label>
                            <select required class="form-control" id="Estado" name="Estado">
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
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Código postal<span class="required-label">*</span></label>
                            <input id="postal" name="postal"  type="text" class="form-control" required >
                        </div>
					</div>
                   
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>RFC<span class="required-label">*</span></label>
                            <input id="RFC" name="RFC"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>IMSS<span class="required-label">*</span></label>
                            <input id="IMSS" name="IMSS"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>CURP<span class="required-label">*</span></label>
                            <input id="CURP" name="CURP"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Correo<span class="required-label">*</span></label>
                            <input id="Correo" name="Correo"  type="text" class="form-control" required >
                        </div>
					</div>
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Salario diario <span class="required-label">*</span></label>
                            <input id="Salario_diario" name="Salario_diario"  type="text" class="form-control" required  oninput="validateAndConvertSalary()" >
                        </div>
					</div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Salario en letras  <span class="required-label">*</span></label>
                            <input id="Salario_diario_letras" name="Salario_diario_letras"  type="text" class="form-control" required  >
                        </div>
					</div>
                    <div class="col-md-2">
                        <div class="form-group form-group-default">
                            <label>Fecha de contrato <span class="required-label">*</span></label>
                            <input required type="date" class="form-control input-with-border" id="fecha_contrato" name="fecha_contrato" value="{{ now()->format('Y-m-d') }}">
						    <input  type="hidden" class="form-control input-with-border" id="fecha_contrato_hidden" name="fecha_contrato_hidden" >
                        </div>
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
		setTimeout(function(){
			$('#contratoForm')[0].reset();
}, 2000);
                
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
                $('#Edad').val(edad);
            } else {
                $('#Edad').val('');
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
	
function validateAndConvertSalary() {
    const salaryInput = document.getElementById('Salario_diario');
    const salaryInWords = document.getElementById('Salario_diario_letras');
    const salary = salaryInput.value;

    // Validar que el valor es un número
    const isValidNumber = /^\d*\.?\d*$/.test(salary);

    if (isValidNumber) {
        salaryInWords.value = numberToWords(parseFloat(salary));
    } else {
        salaryInWords.value = '';
		$('#Salario_diario').val('');
    }
}

function numberToWords(num) {
    const units = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
    const teens = ["diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve"];
    const tens = ["", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
    const hundreds = ["", "cien", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos"];

    if (num === 0) return "cero";

    const integerPart = Math.floor(num);
    const decimalPart = Math.round((num - integerPart) * 100);

    let words = convertIntegerToWords(integerPart);

    if (decimalPart > 0) {
        words += " con " + convertIntegerToWords(decimalPart) + " centavos";
    }

    return words.trim().toUpperCase();
}

function convertIntegerToWords(num) {
    const units = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
    const teens = ["diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve"];
    const tens = ["", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
    const hundreds = ["", "cien", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos"];

    let words = '';

    if (num >= 1000) {
        words += "mil ";
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

    return words.trim();
}
</script>
@endsection
</x-app-layout>
