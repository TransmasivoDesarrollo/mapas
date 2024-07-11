<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}
		
		.question-wrapper {
			display: flex;
			flex-direction: column;
		}

		.form-check-inline {
			display: flex;
			flex-wrap: wrap;
		}

		.custom-control {
			margin-right: 20px; /* Ajusta este valor según tus necesidades */
		}


	</style>
	<div class="card">
        <div class="card-header" style="font-family: Arial; font-size: 15px;">
			<div class="card-title"> <i class="la la-calendar-plus-o custom-icon"></i> Subir biométrico </div>
		</div>
		<div class="card-body">
            @if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			<form action="{{ route('subir_biometrico') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group form-show-validation row">
					    <label class="col-lg-5 col-md-3 col-sm-4 mt-sm-2 text-right">Subir excel <span class="required-label">*</span></label>
						<div class="col-lg-6 col-md-9 col-sm-8">
							<div class="input-file input-file-image">
								<input type="file" class="form-control form-control-file" id="uploadImg" name="uploadImg" accept=".xls" required="">
								<label for="uploadImg" class=" label-input-file btn btn-icon btn-primary btn-round btn-lg"><i class="la la-file-image-o"></i>Seleccionar archivo</label>
							</div>
						</div>
				</div>
					
                <div class="form-group row " >
                    <div class="col-md-12">
						<center>
						<input required type="submit" class="btn btn-primary" id="Validar" name="Validar" value="Validar" >
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
