<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inventario para caja de herramientas </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="exampleValidation" action="{{url('/Inventario_caja_herramienta')}}" enctype="multipart/form-data">
				@csrf
				<div class="form-group row " >
					<div class="col-md-3">
						<label><br>Refacción <span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="Refacción" name="Refacción" >
					</div>
					<div class="col-md-2">
						<label><br>Cantidad <span class="required-label">*</span></label>
						<input required type="number" class="form-control input-with-border" id="Cantidad" name="Cantidad" >
					</div>
					<div class="col-md-4">
						<label><br>Foto  <span class="required-label">*</span></label>
						<input type="file" class="form-control input-with-border" id="Foto" name="Foto" accept="image/*" capture="camera">

					</div>
					<div class="col-md-12">
						<br>
						<center><input type="submit" class="btn btn-primary" value="Registrar" id="Registrar" name="Registrar"></center>

					</div>
				</div>
			</form>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
	$('#n_economico').change(cambioEARTBUS);
	
</script>
@endsection
</x-app-layout>
