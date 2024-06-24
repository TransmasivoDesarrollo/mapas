<x-app-layout>
    <style>
        .input-with-border {
    border: 1px solid black;
}

    </style>
        <div class="card">
        <div class="card-header">
            <div class="card-title" style="display: inline-block;">Alta bitacora de operaciones</div>
            <div class="card-title" id="fecha" style="display: inline-block; float: right;"></div>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
                <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                     {{ session('mensaje') }}.
                </div>
            @endif
        </div>
        <div class="table-responsive" >
            <table class="table table-bordered  " id="list_user2">
                <thead>
                    <tr>
                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Orden</center></th>
                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Subir/Bajar</center></th>
                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Imagenes</center></th>
                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tiempo en pantalla</center></th>
                        <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus</center></th>
                    </tr>
                </thead>
                <tbody id="llenaTabla">
                    @if(null !== $images)
                    @php $contador=1;@endphp
                        @foreach($images as $fila)
                        @if($fila->estatus=="Activo" || $fila->estatus=="Inactivo")
                            <tr >
                            <td> {{$fila->orden}}</td>
                                <td> 
                                @if($fila->estatus=="Activo")
                                @if($contador<=$cuenta[0]->cuenta)
                                    <form method="post" id="exampleValidation" action="{{url('/modificar_banner_200')}}">
					                    @csrf
                                        <input type="hidden" class="btn btn-success" value="{{$fila->id}}" id="id_subir_bajar"  name="id_subir_bajar">
                                        <input type="hidden" class="btn btn-success" value="{{$fila->orden}}" id="orden_subir_bajar"  name="orden_subir_bajar">
                                            @if($contador==1)
                                                <input type="submit" class="btn btn-primary" value="Bajar" id="Bajar"  name="Bajar">
                                            @elseif($contador==$cuenta[0]->cuenta)
                                                <input type="submit" class="btn btn-primary" value="Subir" id="Subir"  name="Subir">
                                               
                                                
                                            @else
                                                
                                                <input type="submit" class="btn btn-primary" value="Subir" id="Subir"  name="Subir">
                                               <input type="submit" class="btn btn-primary" value="Bajar" id="Bajar"  name="Bajar">
                                            @endif
                                            @php $contador++;@endphp
                                    </form>
                                    @endif
                                    @endif
                                </td>
                                <td><img src="{{url('/images/Operaciones/')}}/{{$fila->imagen}}"   width="160" ></td>
                                <td>{{$fila->pantalla}} segundos</td>
                                <td>
                                    <form method="post" id="exampleValidation" action="{{url('/modificar_banner_200')}}">
					                    @csrf
                                            @if($fila->estatus=="Activo")
                                            
                                            <center><b style="color:green;">{{$fila->estatus}}</b></center><br>
                                                <input type="submit" class="btn btn-primary" value="Desactivar" id="Desactivar"  name="Desactivar">
                                                <input type="submit" class="btn btn-danger" value="Eliminar" id="Eliminar"  name="Eliminar">
                                                <input type="hidden" class="btn btn-success" value="{{$fila->id}}" id="id"  name="id">
                                                <button id="modifySecondsBtn{{$fila->id}}" type="button" class="btn btn-success" >Modificar Segundos</button>      
                                            @elseif($fila->estatus=="Inactivo")
                                            <center><b style="color:red;">{{$fila->estatus}}</b></center><br>
                                                
                                                
                                                <input type="hidden" class="btn btn-success" value="{{$fila->id}}" id="id"  name="id">
                                                <input type="submit" class="btn btn-primary" value="Activar" id="Activo"  name="Activo">
                                                <input type="submit" class="btn btn-danger" value="Eliminar" id="Eliminar"  name="Eliminar">
                                            @endif
                                    </form>
                                    <form method="post" id="exampleValidation" action="{{url('/modificar_banner_200')}}">
					                    @csrf
                                            <div class="modal fade" id="modifySecondsModal{{$fila->id}}" tabindex="-1" role="dialog" aria-labelledby="modifySecondsModalLabel{{$fila->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modifySecondsModalLabel">Modificar Segundos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" class="btn btn-primary" value="{{$fila->id}}" id="id2"  name="id2">
                                                            <div class="form-group">
                                                                <label for="secondsInput">Segundos:</label>
                                                                <input required type="number" class="form-control input-with-border" id="pantalla" name="pantalla" value="{{$fila->pantalla}}">
                                                            </div>
                                                                <input type="submit" class="btn btn-primary" id="cambiar_segundos" name="cambiar_segundos" value="Guardar">                                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </td>
                            </tr>
                            @endif
                         @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
    
    
        
	@section('jscustom')
    <script type="text/javascript">
        @foreach($images as $fila)
         $('#modifySecondsBtn{{$fila->id}}').click(function() {
                $('#modifySecondsModal{{$fila->id}}').modal('show');
            });
            @endforeach
        $('#list_user2').DataTable({
            scrollX: false,
            scrollCollapse: true,
            filter: true,
            lengthMenu: [[10, 20, 30, 40, 50, -1], [10, 20, 30, 40, 50, "Todos"]],
            iDisplayLength: 10,
            ordering: false, // Desactiva el ordenamiento

            "language": {
                "lengthMenu": "Mostrar _MENU_ datos",
                "zeroRecords": "No existe el dato introducido",
                "info": "Página _PAGE_ de _PAGES_ ",
                "infoEmpty": "Sin datos disponibles",
                "infoFiltered": "(mostrando los datos filtrados: _MAX_)",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "search": "Buscar",
                "processing": "Buscando...",
                "loadingRecords": "Cargando..."
            }
        });
    </script>
	@endsection
</x-app-layout>
