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
			<form method="post" id="exampleValidation" action="{{url('/Bitacora_De_Liberacion_De_Unidades')}}">
				@csrf
				<div class="form-group row " >
					<div class="col-md-2">
						<label>Fecha <span class="required-label">*</span></label>
						<input required type="date" class="form-control input-with-border" id="Fecha" name="Fecha" value="{{ now()->format('Y-m-d') }}">
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
