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
                                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>ID</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Imagenes</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Tiempo en pantalla</center></th>
                                                <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus</center></th>
                                            </tr>
                                        </thead>

                                        <tbody id="llenaTabla">
                                        @if(null !== $images)
                                        
                                        
                                            @foreach($images as $fila)
                                           
                                                <tr >
                                                    <td>{{$fila->id}}</td>
                                                    <td><img src="{{url('/images/Operaciones/')}}/{{$fila->imagen}}"   width="160" ></td>
                                                    <td>{{$fila->pantalla}} segundos</td>
                                                    <td>
                                                    <form method="post" id="exampleValidation" action="{{url('/modificar_banner_200')}}">
					                        @csrf
                                                        @if($fila->estatus=="Activo")
                                                        <input type="submit" class="btn btn-primary" value="Desactivar" id="Desactivar"  name="Desactivar">
                                                        <input type="hidden" class="btn btn-primary" value="{{$fila->id}}" id="id"  name="id">
                                                        <button id="modifySecondsBtn{{$fila->id}}" type="button" class="btn btn-primary" >Modificar Segundos</button>
                                                       
                                                        @elseif($fila->estatus=="Inactivo")
                                                        <b style="color:red;">{{$fila->estatus}}</b>
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
                                                                        <!-- Aquí puedes poner el contenido del modal -->
                                                                        <form id="modifySecondsForm">
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
    lengthMenu: [[7, 14, 21, 28, 35, -1], [7, 14, 21, 28, 35, "Todos"]],
    iDisplayLength: 7,
    dom: 'lBfrtip', // Agrega los elementos que quieres mostrar y sus ubicaciones
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
