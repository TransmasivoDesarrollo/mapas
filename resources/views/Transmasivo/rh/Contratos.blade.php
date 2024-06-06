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
					<div class="col-md-3">
						<label>Nombre completo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="nombre" name="nombre" >
					</div>
					<div class="col-md-2">
						<label>Fecha de nacimiento <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="nacimiento" name="nacimiento" >
					</div>
					<div class="col-md-2">
						<label>Edad <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Edad" name="Edad" >
					</div>
                    <div class="col-md-3">
						<label>Puesto <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Puesto" name="Puesto" >
					</div>
                   
                    
				</div>
				<div class="form-group row " >
					<div class="col-md-3">
						<label>Nacionalidad <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Nacionalidad" name="Nacionalidad" value="Mexicana" >
					</div>
					<div class="col-md-3">
						<label>Sexo <span class="required-label">*</span></label>
						<select required class="form-control input-with-border" id="Sexo" name="Sexo">
							<option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
						</select>
					</div>
					<div class="col-md-3">
						<label>Estado Civil <span class="required-label">*</span></label>
						<select required class="form-control input-with-border" id="Civil" name="Civil">
							<option value="">Seleccione una opción</option>
							<option value="Soltero">Soltero</option>
							<option value="Casado">Casado</option>
							<option value="Divorciado">Divorciado</option>
							<option value="Viudo">Viudo</option>
							<option value="Unión libre">Unión libre</option>
							<option value="Separado">Separado</option>
							<option value="Comprometido">Comprometido</option>
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
					<div class="col-md-3">
						<label>Calle <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Calle" name="Calle"  >
					</div>
					<div class="col-md-3">
						<label>Numero <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Numero" name="Numero"  >
					</div>
					<div class="col-md-4">
						<label>Colonia <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Colonia" name="Colonia"  >
					</div>
                    
                    
				</div>
				<div class="form-group row " >
					
					<div class="col-md-3">
						<label>Alcaldía/Municipio <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Alcaldia" name="Alcaldia"  >
					</div>
					<div class="col-md-3">
						<label>Estado <span class="required-label">*</span></label>
						<select required class="form-control input-with-border" id="Estado" name="Estado">
							<option value="">Seleccione un estado</option>
							<option value="Aguascalientes">Aguascalientes</option>
							<option value="Baja California">Baja California</option>
							<option value="Baja California Sur">Baja California Sur</option>
							<option value="Campeche">Campeche</option>
							<option value="Chiapas">Chiapas</option>
							<option value="Chihuahua">Chihuahua</option>
							<option value="Ciudad de México">Ciudad de México</option>
							<option value="Coahuila">Coahuila</option>
							<option value="Colima">Colima</option>
							<option value="Durango">Durango</option>
							<option value="Guanajuato">Guanajuato</option>
							<option value="Guerrero">Guerrero</option>
							<option value="Hidalgo">Hidalgo</option>
							<option value="Jalisco">Jalisco</option>
							<option value="Estado de México" selected>Estado de México</option>
							<option value="Michoacán">Michoacán</option>
							<option value="Morelos">Morelos</option>
							<option value="Nayarit">Nayarit</option>
							<option value="Nuevo León">Nuevo León</option>
							<option value="Oaxaca">Oaxaca</option>
							<option value="Puebla">Puebla</option>
							<option value="Querétaro">Querétaro</option>
							<option value="Quintana Roo">Quintana Roo</option>
							<option value="San Luis Potosí">San Luis Potosí</option>
							<option value="Sinaloa">Sinaloa</option>
							<option value="Sonora">Sonora</option>
							<option value="Tabasco">Tabasco</option>
							<option value="Tamaulipas">Tamaulipas</option>
							<option value="Tlaxcala">Tlaxcala</option>
							<option value="Veracruz">Veracruz</option>
							<option value="Yucatán">Yucatán</option>
							<option value="Zacatecas">Zacatecas</option>
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
				<div class="form-group row " >
					<div class="col-md-2">
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
                    <div class="col-md-3">
						<label>Salario diario <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Salario_diario" name="Salario_diario" oninput="convertSalary()">
					</div>
					<div class="col-md-3">
						<label>Salario en letras <span class="required-label">*</span></label>
						<input type="text" class="form-control input-with-border" id="Salario_diario_letras" name="Salario_diario_letras" >
					</div>
					
				</div>
				<div class="form-group row " >
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
$(document).ready(function() {
	$('#contratoForm').on('submit', function(event) {
		console.log('a');
            // Escuchar el evento de carga en el iframe para saber cuándo se ha descargado el archivo
          
                // Limpiar el formulario
                $('#contratoForm')[0].reset();
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
        if (sexo === 'Masculino') {
            estadoCivilSelect.innerHTML = `
                <option value="">Seleccione una opción</option>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Viudo">Viudo</option>
                <option value="Unión libre">Unión libre</option>
                <option value="Separado">Separado</option>
                <option value="Comprometido">Comprometido</option>
            `;
        } else if (sexo === 'Femenino') {
            estadoCivilSelect.innerHTML = `
                <option value="">Seleccione una opción</option>
                <option value="Soltera">Soltera</option>
                <option value="Casada">Casada</option>
                <option value="Divorciada">Divorciada</option>
                <option value="Viuda">Viuda</option>
                <option value="Unión libre">Unión libre</option>
                <option value="Separada">Separada</option>
                <option value="Comprometida">Comprometida</option>
            `;
        }
    });
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
</script>
@endsection
</x-app-layout>
