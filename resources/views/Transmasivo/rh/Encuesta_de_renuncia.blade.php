<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Encuesta de salida</div>
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
					<div class="col-md-12">
						<label>1.- ¿Cuantos tiempo has laborado en esta empresa?	 <span class="required-label"></span></label>
						<input required type="number" class="form-control input-with-border" id="tiempo" name="tiempo" >
					</div>
				</div>
                <div class="form-group row " >
					<div class="col-md-12">
						<label>2.- ¿En promedio, cuántas horas trabajabas al día?	 <span class="required-label"></span></label>
						<input required type="number" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>                
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<label>3.- ¿Cómo fue tu relación laboral con tu jefe directo?<span class="required-label"></span></label><br>
                        <div class="form-check">
						                <label class="form-check-label">
											<input class="form-check-input" id="relacion" name="relacion" type="radio" value="">
											<span class="form-check-sign">Excelente &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
										</label>
                                        <label class="form-check-label">
											<input class="form-check-input" id="relacion" name="relacion" type="radio" value="">
											<span class="form-check-sign">Muy buena&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
										</label>
                                        <label class="form-check-label">
											<input class="form-check-input" id="relacion" name="relacion" type="radio" value="">
											<span class="form-check-sign">Buena&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
										</label>
                                        <label class="form-check-label">
											<input class="form-check-input" id="relacion" name="relacion" type="radio" value="">
											<span class="form-check-sign">Regular&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
										</label>
                                        <label class="form-check-label">
											<input class="form-check-input" id="relacion" name="relacion" type="radio" value="">
											<span class="form-check-sign">Mala&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
										</label>
                                       
					    </div>
					</div>
                    
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<label>2.- ¿En promedio, cuántas horas trabajabas al día?	 <span class="required-label">*</span></label>
						<input required type="number" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>
                    
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<label>2.- ¿En promedio, cuántas horas trabajabas al día?	 <span class="required-label">*</span></label>
						<input required type="number" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<label>2.- ¿En promedio, cuántas horas trabajabas al día?	 <span class="required-label">*</span></label>
						<input required type="number" class="form-control input-with-border" id="inicio" name="inicio" >
					</div>
				</div>
                <div class="form-group row " >
                    <div class="col-md-12">
						<label>2.- ¿En promedio, cuántas horas trabajabas al día?	 <span class="required-label">*</span></label>
						<input required type="number" class="form-control input-with-border" id="inicio" name="inicio" >
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
	
	

</script>
@endsection
</x-app-layout>
