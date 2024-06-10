<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Renuncias</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="contratoForm" action="{{url('/Renuncias')}}">
				@csrf
				<div class="form-group row " >
					<div class="col-md-4">
						<label>Nombre completo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="nombre" name="nombre" >
					</div>
					<div class="col-md-4">
						<label>Fecha de inicio labores <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>
					<div class="col-md-4">
                        <label>Fecha de fin labores <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="fin" name="fin" >
					</div>
                    
				</div>
				<div class="form-group row " >
                    <div class="col-md-4">
                        <label>Fecha de elaboración renuncia <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="elaboracion" name="elaboracion" >
					</div>
                    <div class="col-md-4">
						<label>Puesto <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Puesto" name="Puesto" >
					</div>
					<div class="col-md-4">
						<label>Empresa <span class="required-label">*</span></label>
						<select required class="form-control input-with-border" id="Empresa" name="Empresa">
                            @foreach($c_empresas as $c_empresa)
							    <option value="{{$c_empresa->empresa}}">{{$c_empresa->empresa }}</option>
                            @endforeach
						</select>
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
