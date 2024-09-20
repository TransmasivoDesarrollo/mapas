<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }

    </style>
        <div class="card">
        <div class="card-header">
            <div class="card-title" style="display: inline-block;">Generador de QR</div>
            <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
        </div>
        <div class="card-body">
            @if (session('mensaje'))      
                <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                    {{ session('mensaje') }}.
                 </div>
            @endif
            <form method="post" id="exampleValidation" action="{{url('/Generador_qr')}}">
				@csrf
                    <div class="form-group row " >
                        <div class="col-md-3">
                            <label>Unidad  <span class="required-label">*</span></label>
                            <input required type="text" class="form-control input-with-border" id="unidad" name="unidad">
                        </div>
                        <div class="col-md-3">
                            <label>Carro  <span class="required-label">*</span></label>
                            <select required type="time" class="form-control input-with-border" id="carro" name="carro">
                                <option value="1">Carro 1</option>
                                <option value="2">Carro 2</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row " >
                        <div class="col-md-12">
                            <center>
                                <input type="submit" class="btn btn-primary" id="Generar" name="Generar" value="Generar">
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
