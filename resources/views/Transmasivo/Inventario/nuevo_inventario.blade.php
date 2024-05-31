<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inventario</div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="exampleValidation" action="{{url('/Inventario')}}" enctype="multipart/form-data">
				@csrf
				<div class="form-group row " >
					<div class="col-md-4">
						<label>Código  <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="codigo" name="codigo" >
					</div>
					<div class="col-md-4">
						<label>Nombre refacción   <span class="required-label">*</span></label>
						<input  required type="text" class="form-control input-with-border" id="refaccion" name="refaccion" >
					</div>
                    <div class="col-md-4">
						<label>Cantidad <span class="required-label">*</span></label>
						<input required type="number" class="form-control input-with-border" id="cantidad" name="cantidad" >
					</div>
                   
                    
				</div>
				<div class="form-group row " >
					<div class="col-md-4">
						<label>Pasillo <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Pasillo" name="Pasillo" value="" >
					</div>
					<div class="col-md-4">
						<label>Anaquel <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="Anaquel" name="Anaquel" value="" >
					</div>
                    <div class="col-md-4">
						<label>Nivel <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="Nivel" name="Nivel" value="" >
					</div>
				</div>
				<div class="form-group row " >
                    <div class="col-md-4">
						<label>Charola <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="Charola" name="Charola" value="" >
					</div>
				</div>
				
				<div class="form-group row " >
					<div class="col-md-4">
						<label>Foto  <span class="required-label">*</span></label>
						<input  type="file" class="form-control input-with-border" id="Foto" name="Foto" accept=" .jpeg, .jpg, .png">

					</div>
                    <div class="col-md-4">
						<label>Quien conto  <span class="required-label">*</span></label>
						<input  type="text" class="form-control input-with-border" id="Name" name="Name" value="{{ auth()->user()->name }}" disabled>
						<input  type="hidden" class="form-control input-with-border" id="id_name" name="id_name" value="{{ auth()->user()->id }}" >

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
