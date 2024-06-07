<x-app-layout>
    <style>
        .input-with-border {
                border: 1px solid black;
            }
            table {
  width: 100%;
}

.sticky-column {
  position: sticky;
  background-color: #fff; /* Ajusta el color de fondo según tu diseño */
}

.sticky-column:nth-child(1) {
  left: 0;
}

.sticky-column:nth-child(2) {
  left: 70px; /* Ajusta el valor para el ancho de la primera columna */
}

.sticky-column th {
  top: 0;
}

    </style>
    <div class="card">
        <div class="card-header">
			<div class="card-title">Autorización De Liberacion De Unidades </div>
		</div>
		<div class="card-body">
            @if ( $mensaje!="" )
                <div class="alert alert-{{ $color }} alert-dismissible" data-dismiss="alert">
                    {{ $mensaje }}.
                </div>
            @endif 
            <form method="post" id="exampleValidation" action="{{url('/bannerModulo200')}}" enctype="multipart/form-data">
			    @csrf
                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group form-show-validation row">
                        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Archivo <span class="required-label">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-8">
                                <div class="input-file input-file-image">
                                    <img class="img-upload-preview img" width="100"  src="{{url('/images/sin_imagen.jpg')}}" alt="preview">
                                    <input type="file" class="form-control form-control-file" id="uploadImg" name="uploadImg" accept="image/*, .mp4" required="">
                                    <label for="uploadImg" class=" label-input-file btn btn-primary btn-round btn-lg"> Seleccionar archivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                                <label>Tiempo en pantalla (segundos) <span class="required-label">*</span></label>
                                <input required type="number" class="form-control input-with-border" id="pantalla" name="pantalla" value="30">
                            </div> 
                    <div class="col-md-12">
                        <label>&nbsp;</label>   
                        <center>
                            <input type="submit" class="btn btn-success" id="subir" name="subir" value="Subir"> 
                        </center>  
                    </div>
                </div>
            </form>
							
		</div>
		<div class="card-footer">{{-- inicio del row --}}
							
							{{-- fin del row --}}
		</div>

	</div>
				
@section('jscustom')
<script type="text/javascript">
	
    $('#pantalla').on('input', function() {
                var value = $(this).val();
                // Elimina caracteres no numéricos
                value = value.replace(/[^0-9]/g, '');
                $(this).val(value);
            });
	

</script>
@endsection
</x-app-layout>
