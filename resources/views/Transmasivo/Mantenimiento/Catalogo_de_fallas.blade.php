<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
					<div class="card-title">Catalogo de fallas</div>
					
				</div>
				
				
				<div class="card-body">
                @if (isset($mensaje))
                    
                    <div class="alert alert-{{ $color }} alert-dismissible" data-dismiss="alert">
                        
                        {{ $mensaje }}.
                        
                    </div>
                @endif

                <form method="post" id="exampleValidation" action="{{url('/Catalogo_de_fallas')}}">
					@csrf
					{{-- inicio del row --}}

					<div class="form-group row " >
                        
                        
                        <div class="col-md-3">
                            <label>Seccion</label>
                            <select   class="form-control input-with-border" id="seccion" name="seccion">
                                @foreach($seccion as $secc)
                                    <option value="{{$secc->id_seccion_liberacion_unidades}}" >{{$secc->seccion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Subseccion</label>
                            <select  class="form-control input-with-border" id="subseccion" name="subseccion">
                                @foreach($subseccion as $sub)
                                    <option valor_seccion="{{$sub->id_seccion_liberacion_unidades}}" value="{{$sub->id_subseccion_liberacion_unidades}}" >{{$sub->subseccion}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Falla</label>
                            <input  type="text" class="form-control input-with-border"  required id="falla" name="falla">
                        </div>
                       
					</div>
					
                    <div class="row">
								<div class="col-md-12">
									<center>
									<button   class="btn btn-primary" id="consultar" >Consultar falla</button>	<input  type="submit" class="btn btn-success" value="Registrar falla" >
									</center>
								</div>
                               

                               
							</div>
							
							
							<br>
                          
							
						</div>
						<div class="card-footer">{{-- inicio del row --}}
							
                        <div class="table-responsive" >
                                    <table class="table table-bordered  " id="list_user22">
                                        <thead>
                                            <tr>
                                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Seccion</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Subseccion</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Falla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Acción</center></th>
                                            </tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                        
                                          
                                                
                                    </tbody>

                                    </table>

                                    </div>
						</div>

						
                        </form>
					</div>
					

        </div>
    </div>

	@section('jscustom')
    <script type="text/javascript">
     $(document).ready(function() {
    // Detectar cambios en el primer select
        $('#seccion').change(function() {
            var idSeleccionado = $(this).val(); 
            
            $('#subseccion option').each(function() {
                if ($(this).attr('valor_seccion') == idSeleccionado) {
                    $(this).show(); // Mostrar la opción si coincide con el valor seleccionado
                } else {
                    $(this).hide(); // Ocultar la opción si no coincide
                }
            });

            $('#subseccion option[valor_seccion="' + idSeleccionado + '"]').eq(0).prop('selected', true);
            $('#subseccion option[valor_seccion="' + idSeleccionado + '"]').eq(0).siblings().prop('selected', false);
        });
        $('#consultar').click(function(event) {
            event.preventDefault();
            var seccion=$('#seccion').val();
            var subseccion=$('#subseccion').val();
            $.ajax({
                    url: '{{url("/Catalogo_de_fallas/consulta")}}',
                    method: 'get', // o 'GET' según corresponda
                    data: {'seccion': seccion,'subseccion': subseccion},
                    success: function(response){
                        console.log(response);
                        var html="";
                        if(response.length > 0){
                            for(var i = 0; i < response.length; i++) { // Corrección aquí
                        
                                html+='<tr >';
                                html+=' <td>'+response[i]['seccion']+'</td>';
                                html+='<td>'+response[i]['subseccion']+'</td>';
                                html+='<td>'+response[i]['falla']+'</td>';
                                html+='<td>'+response[i]['estatus']+'</td>';
                                if(response[i]['estatus']=="Baja"){
                                    html+='<td><input type="submit" id="darBaja" value="Dar de alta" class="btn btn-success" onclick="dar_alta('+response[i]['id_fallas_subseccion_liberacion_unidades']+')"></td>';
                                
                                }else if(response[i]['estatus']=="Activo"){
                                    html+='<td><input type="submit" id="darBaja" value="Dar de baja" class="btn btn-danger" onclick="dar_baja('+response[i]['id_fallas_subseccion_liberacion_unidades']+')"></td>';
                                
                                }
                                html+='</tr>';  
                                $('#llenaTabla').html(html);
                            }  
                        }else{
                            $('#llenaTabla').html('');
                        }
                        

                       
                    },
                    error: function(xhr, status, error){
                        console.error(error); // Manejar errores
                        $('#km').val('0');
                    }
                });
        });
    });
    function dar_alta(id)
    {
        $.ajax({
                    url: '{{url("/Catalogo_de_fallas/alta")}}',
                    method: 'get', // o 'GET' según corresponda
                    data: {'id': id},
                    success: function(response){
                        console.log(response);
                        var html="";
                        $('#consultar').click();
                        
                    },
                    error: function(xhr, status, error){
                        console.error(error); // Manejar errores
                        $('#km').val('0');
                    }
                });
    }
    function dar_baja(id)
    {
        $.ajax({
                    url: '{{url("/Catalogo_de_fallas/baja")}}',
                    method: 'get', // o 'GET' según corresponda
                    data: {'id': id},
                    success: function(response){
                        console.log(response);
                        $('#consultar').click();
                        

                       
                    },
                    error: function(xhr, status, error){
                        console.error(error); // Manejar errores
                        $('#km').val('0');
                    }
                });
    }

        </script>
	@endsection
</x-app-layout>
