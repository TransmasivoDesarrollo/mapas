<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Liberacion de unidades </div>
					
				</div>
				
				
				<div class="card-body">
                @if (session('mensaje'))
                    
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        
                        {{ session('mensaje') }}.
                        
                    </div>
                @endif

                <form method="post" id="exampleValidation" action="{{url('/Alta_de_unidades')}}">
					@csrf
					{{-- inicio del row --}}

					<div class="form-group row " >
                        <div class="col-md-2">
                            <label>Numero de economico</label>
                            <input  type="text" class="form-control  input-with-border" value="{{session('n_economico')}}" id="n_economico" name="n_economico">
                        </div>
                        <div class="col-md-2">
                            <label>Marca</label>
                            <select  class="form-control input-with-border"  id="marca" name="marca">
                                @foreach($con as $marca)
                                    <option value="{{$marca->id_marca}}">{{$marca->marca}}</option>
                                @endforeach                     
                            </select>
                        </div>
                        <div class="col-md-2">
							<label>Agregar kilometraje</label>
							<input  type="number" class="form-control input-with-border"  value="{{session('km')}}" id="km" name="km"  >
						</div>
						<div class="col-md-2">
							<label>Carga de bares</label>
							<input   type="number" class="form-control input-with-border"   value="{{session('bares')}}" id="bares" name="bares"  >
						</div>
					</div>
						
                    <div class="row">
							<div class="col-md-12">
									<center>
										<input  type="submit" class="btn btn-success" value="Registrar" >
									</center>
								</div>
							</div>
							
							
							<br>
                            
							
					</div>
						<div class="card-footer">{{-- inicio del row --}}
							
							{{-- fin del row --}}
						</div>

						
                        </form>
					</div>
					

        </div>
    </div>

	<script type="text/javascript">
        
        
        
        </script>
</x-app-layout>
