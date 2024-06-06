<x-app-layout>
            <style>
                table {
                  font-family: arial, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
              }

              td, th {
                  border: 1px solid #000000;
                  text-align: right;
                  padding: 2px;
              }

        .input-with-border {
            border: 1px solid black;
        }
        #list_user22 th:nth-child(1),
        #list_user22 td:nth-child(1) {
            position: sticky;
            left: 0;
            background-color: #f8f9fa; /* Puedes cambiar el color de fondo si lo deseas */
            z-index: 1; /* Asegura que la columna fija esté por encima del resto de la tabla */
        }

    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Reporte de personal </div>
            
        </div>
        
        
        <div class="card-body">
            @if (isset($mensaje))
            
            <div class="alert alert-{{ $color }} alert-dismissible" data-dismiss="alert">
                
                {{ $mensaje }}.
                
            </div>
            @endif

           
            
            <div class="table-responsive" style="overflow-x: auto;">
            <table class="table table-bordered  " id="list_user22">
                    <thead>
                        <tr>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Nombre</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Edad</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Sexo</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estado civil</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Calle</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Numero </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Colonia </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Alcaldia municipio </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estado </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Codigo postal </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>RFC </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>NSS  </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>CURP </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Correo </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Puesto  </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha_contrato </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Fecha_real </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Quien registro </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Estatus </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>Acción </center></th>
                        </tr>
                    </thead>

                    <tbody id="llenaTabla">
                        @if($consulta !== "")
                        @foreach($consulta as $consul)
                        <tr>
                            <td>{{$consul->Nombre}}</td>
                            <td>{{$consul->Edad}}</td>
                            <td>{{$consul->Sexo}}</td>
                            <td>{{$consul->Estado_civil}}</td>
                            <td>{{$consul->Calle}}</td>
                            <td>{{$consul->Numero}}</td>
                            <td>{{$consul->Colonia}}</td>
                            <td>{{$consul->Alcaldia_municipio}}</td>
                            <td>{{$consul->Estado}}</td>
                            <td>{{$consul->Codigo_postal}}</td>
                            <td>{{$consul->RFC}}</td>
                            <td>{{$consul->NSS}}</td>
                            <td>{{$consul->CURP}}</td>
                            <td>{{$consul->Correo}}</td>
                            <td>{{$consul->Puesto}}</td>
                            <td>{{$consul->Fecha_contrato}}</td>
                            <td>{{$consul->Fecha_real}}</td>
                            <td>{{$consul->name}}</td>
                            <td>{{$consul->Estatus}}</td>
                            <td><input type='submit' value="Eliminar" class="btn btn-danger"></td>
                        </tr>
                        @endforeach
                      @endif
                        
                    </tbody>

                </table>

            </div>
        </div>

        
    </div>
    


@section('jscustom')
<script type="text/javascript">
        $('#list_user22').DataTable({
        scrollX: false,
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[7, 14, 21, 28, 35, -1], [7, 14, 21, 28, 35, "Todos"]],
        iDisplayLength: 7,
        dom: 'lBfrtip', // Agrega los elementos que quieres mostrar y sus ubicaciones
        buttons: [ // Configura los botones de descarga
            'excel' // Agrega el botón de Excel
        ],
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
