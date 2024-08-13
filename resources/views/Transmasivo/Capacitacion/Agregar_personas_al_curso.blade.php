<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inscribir personas al curso. </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form method="post" id="exampleValidation" action="{{url('/Agregar_personas_al_curso')}}" enctype="multipart/form-data">
				@csrf
				<div class="form-group row " >
					<div class="col-md-3">
						<label><br>Cursos disponibles <span class="required-label">*</span></label>
						<select required  class="form-control input-with-border" id="Curso" name="Curso" >
                            @foreach($c_cursos as $curso)
                                <option value="{{$curso->id_curso_capacitacion}}">{{$curso->curso}}</option>
                            @endforeach
                        </select>
					</div>
					<div class="col-md-4">
						<label><br>Nombre del participante<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="participante" name="participante" >
					</div>
                    <div class="col-md-3">
						<label><br>Área<span class="required-label">*</span></label>
						<input required type="text" class="form-control input-with-border" id="area" name="area" >
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
