<x-app-layout>
    <style>
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
            <div class="card-title">Reporte de supervisión </div>
            
        </div>
        
        
        <div class="card-body">
            @if (isset($mensaje))
            
            <div class="alert alert-{{ $color }} alert-dismissible" data-dismiss="alert">
                
                {{ $mensaje }}.
                
            </div>
            @endif

            <form method="post" id="exampleValidation" action="{{url('/Reporte_de_supervisión')}}">
                @csrf
                {{-- inicio del row --}}

                <div class="form-group row " >
                    
                    
                 
                    <div class="col-md-2">
                        <label>Folio</label>
                        <input  type="text" class="form-control input-with-border"   id="Folio" name="Folio">
                    </div>
                    <div class="col-md-3">
                        <label>Empresa</label>
                        <select   class="form-control input-with-border"   id="Empresa" name="Empresa">
                            <option value="-Selecciona-">-Selecciona-</option>
                            @foreach($empresas as $empresa)
                            <option value="{{$empresa->idempresa}}">{{$empresa->nombreEmpresa}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Unidad</label>
                        <select   class="form-control input-with-border"   id="Unidad" name="Unidad">
                            <option value="-Selecciona-">-Selecciona-</option>
                            @foreach($unidades as $unidad)
                            <option value="{{$unidad->consecutivo}}">{{$unidad->consecutivo}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Usuario</label>
                        <select  class="form-control input-with-border"   id="Usuario" name="Usuario">
                            <option value="-Selecciona-">-Selecciona-</option>
                            @foreach($personal as $persona)
                            <option value="{{$persona->idPersona}}">{{$persona->nombres}} {{$persona->ApPaterno}} {{$persona->ApMaterno}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row " >
                    <div class="col-md-2">
                        <label>Estatus</label>
                        <select  class="form-control input-with-border"   id="Estatus" name="Estatus">
                            <option value="-Selecciona-">-Selecciona-</option>
                            <option value="En proceso" style="background-color:yellow; color:#000000;">En proceso</option>
                            <option value="Programada" style="background-color:red;  color:#ffffff;">Programada</option>
                            <option value="Liberada" style="background-color:green;  color:#ffffff;">Liberada</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Mes</label>
                        <select class="form-control input-with-border"  id="Mes" name="Mes">
                            <option value="-Selecciona-">-Selecciona-</option>
                            <option value=" between '1-1-{{ now()->format('Y') }}' and '31-1-{{ now()->format('Y') }}'">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                        </select>

                    </div>
                    <div class="col-md-3">
                        <label>Subgrupo</label>
                        <select  class="form-control input-with-border"   id="Subgrupo" name="Subgrupo">
                            <option value="-Selecciona-">-Selecciona-</option>
                            @foreach($fallos as $fallo)
                            <option value="{{$fallo->falloGralfkcfallosgrales}}">{{$fallo->descfallo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>De</label>
                        <input  type="date" class="form-control input-with-border"   id="De" name="De">
                    </div>
                    <div class="col-md-2">
                        <label>Hasta</label>
                        <input  type="date" class="form-control input-with-border"   id="Hasta" name="Hasta">
                    </div>
                </div>
                <div class="form-group row " >
                 
                 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <input  type="submit" class="btn btn-success" value="Consultar" id="Consultar" name="Consultar">
                        </center>
                    </div>
                    

                    
                </div>
                
                
                <br>
                
                
            </div>
            
        </form>
        <div class="card-footer">{{-- inicio del row --}}
            
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered  " id="list_user22">
                    <thead>
                        <tr>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>FOLIO</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>ECO</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>FECHA DE REPORTE</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>PERSONA QUE INSERTO</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>CREDENCIAL DEL CONDUCTOR</center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>SERVICIO </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>HORA DEL REPORTE </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>KILOMETRAJE DE REPORTE </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>TIPO DE FALLA </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>GRUPO DE FALLO </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>SUBGRUPO DE FALLO </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>DESCRIPCION DE FALLO  </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>OBSERVACIONES </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>FECHA/HORA INICIO DE MANT. </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>FECHA/HORA TERMINO  </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>ESTATUS </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>TRABAJO REALIZADO </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>MECANICO QUE REALIZO EL MANT. </center></th>
                            <th class="bg-danger sorting" style="color:#ffffff; width: 6%;"><center>OBSERVACIONES MANT. </center></th>
                        </tr>
                    </thead>

                    <tbody id="llenaTabla">
                        @if($consulta !== "")
                        @foreach($consulta as $consul)
                        <tr>
                            <td>{{$consul->Folio}}</td>
                            <td>{{$consul->UnidadfkCUnidades}}</td>
                            <td>{{$consul->FechaReporte}}</td>
                            <td>{{$consul->supervisor}}</td>
                            <td>{{$consul->CredencialConductorfkCPersonal}}</td>
                            <td>{{$consul->Serviciofkcservicios}}</td>
                            <td>{{$consul->HoraEntrada}}</td>
                            <td>{{$consul->KmEntrada}}</td>
                            <td>{{$consul->TipoFallo}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->CodFallofkcfallosesp}}</td>
                            <td>{{$consul->DescFalloNoCod}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->DescrFallofkcdescfallo}}</td>
                            <td>{{$consul->ObservacionesSupervision}}</td>
                        </tr>
                        @endforeach
                      @endif
                        
                    </tbody>

                </table>

            </div>
        </div>

        
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
