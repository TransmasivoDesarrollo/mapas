<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
    <div class="h4"> Solicitud de herramientas</div>
    <div class=" row form-group " >
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"> Busqueda de herramientas </div>
                </div>
                <div class="card-body">
                    @if (session('mensaje'))
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        {{ session('mensaje') }}.
                    </div>
                    @endif
                        <div class=" row form-group " >
                        
                            <div class="col-md-12">
                                <table class=" table table-responsive" id="t_inventario">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary sorting" style="color:#fff;">ID inventario</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Refaccion</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Cantidad</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Foto</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inventario as $t_inventario)
                                            <tr>
                                                <td>HER0000{{$t_inventario->id}}</td>
                                                <td>{{$t_inventario->Refaccion}}</td>
                                                <td  id="id_{{$t_inventario->id}}">{{$t_inventario->Cantidad}}</td>
                                                <td>
                                                    <center>
                                                        <img width="80px" src="{{url('/images/Caja de herramienta/')}}/{{$t_inventario->Foto}}">
                                                    </center>
                                                </td> 
                                                @php 
                                                    $refaccion = $t_inventario->Refaccion;
                                                    $refaccion = str_replace("'", "\\'", $refaccion);
                                                @endphp

                                                <td><button id="agregar_herramienta_{{$t_inventario->id}}" name="agregar_herramienta_{{$t_inventario->id}}" class="btn btn-primary" 
                                                onclick="abrirModal('{{$t_inventario->Cantidad}}','{{$refaccion}}','{{$t_inventario->id}}','{{$t_inventario->Foto}}')" > <i class="la flaticon-signs-2"> Agregar</i> </button></td>          
                                            </tr>
                                        @endforeach          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cantidad de herramientas que necesitas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Cantidad que requieres de <b id="herramienta_modal"></b></label>
                                <input type="number" class="form-control" id="cantidad_modal" name="cantidad_modal" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="boton_agregar" onclick="">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
        @if(session('pdf_url'))
                            
        <div class="modal fade" id="otroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitud creada correctamente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><a href="{{ session('pdf_url') }}" target="_blank" class="btn btn-primary">Descargar PDF</a></center> 
            </div>
        </div>
    </div>
</div>


        @endif

        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Herramienta por solicitar </div>
                </div>
                <div class="card-body">
                    @if (session('mensaje'))
                    <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                        {{ session('mensaje') }}.
                    </div>
                    @endif
                        <div class=" row form-group " >
                        
                        <div class="col-md-12 text-right">
                            <a class="btn btn-warning" href="{{url('/Solicitar_herramienta')}}">Limpiar</a>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" style="width:100%;" id="">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary sorting" style="color:#fff;">ID inventario</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Refaccion</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Cantidad</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Foto</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_llenar">
                                        <!-- Contenido de la tabla aquí -->
                                    </tbody>
                                </table>
                            </div>
                            
                            
                        </div>
                        <form method="post" id="acceso" action="{{url('/Solicitar_herramienta')}}">
                                @csrf
                                <center>
                                    <input type="submit" value="Solicitar prestamo" class="btn btn-primary" id="solicitar_prestamo" name="solicitar_prestamo">
                                    <input type="hidden" id="arreglo_pedidos" name="arreglo_pedidos">
                                </center>
                            </form>
                           
                        </div>
                       
                </div>
            </div>
        </div>
    </div>

	



@section('jscustom')
<script type="text/javascript">
    
    @if(session('pdf_url'))
    $('#otroModal').modal('show');
    $('#otroModal').modal({
            backdrop: 'static',
            keyboard: false
        });

    @endif
	
	$('#n_economico').select2();
	$('#nom_supervisor').select2();
	$('#n_mecanico').select2();
    $('#t_inventario').DataTable({
        scrollX: false,
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[12, 24, 36, 48, 60, -1], [12, 24, 36, 48, 60, "Todos"]],
        iDisplayLength: 12,
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
    function abrirModal(cantidad, refaccion, id,foto) {
        $('#herramienta_modal').html(refaccion);
        refaccion = refaccion.replace(/'/g, "\\'");
        $('#cantidad_modal').attr('max', cantidad);
        $('#cantidad_modal').val(''); // Resetea el valor del input
        $('#exampleModal').modal('show');
        $('#boton_agregar').attr('onclick',"agregarTabla('"+cantidad+"','"+refaccion+"','"+id+"','"+foto+"')");
        
        $('#cantidad_modal').on('input change', function() {
            let max = $(this).attr('max');
            let value = $(this).val();
            
            // Solo permitir números positivos
            if (value < 0) {
                $(this).val('');
            }
            
            // No permitir valores mayores al máximo
            if (parseInt(value) > parseInt(max)) {
                $(this).val(max);
            }
        });
    } 
    var tabla_pedido = [];

    function agregarTabla(cantidad, refaccion, id, foto) {
        // Inicializar correctamente la variable html
        var cantidad_or = parseInt($('#cantidad_modal').val(), 10);
        var res = cantidad - cantidad_or;
        var html = "";
        html += "<tr>";
        html += "<td>HER0000" + id + "</td>";
        html += "<td>" + refaccion + "</td>";
        html += "<td id='id_res" + id + "'>" + $('#cantidad_modal').val() + "</td>";
        var imagen = "{{url('/images/Caja de herramienta/')}}/" + foto;
        html += "<td><center><img width='100px' src='" + imagen + "'></center></td>";
        html += '<td><button id="quitar_herramienta_'+id+'" name="quitar_herramienta_'+id+'" class="btn btn-danger"> <i class="la flaticon-line-1"> Eliminar</i> </button></td></tr>';

        refaccion = refaccion.replace(/'/g, "\\'");

        $('#agregar_herramienta_' + id).attr('onclick', "abrirModal('" + res + "','" + refaccion + "','" + id + "','" + foto + "')");
        var idElement = $('#id_' + id);
        if (idElement.length) {
            idElement.html(res);
        }

        tabla_pedido.push({
            cantidad: cantidad_or,
            refaccion: refaccion,
            id: id,
            foto: foto
        });
        console.log(tabla_pedido);
        
        $('#arreglo_pedidos').val(JSON.stringify(tabla_pedido));

        $('#tabla_llenar').append(html);
        $('#exampleModal').modal('hide');
        $('#quitar_herramienta_'+id).attr('onclick',"quitarTabla('"+res+"','"+refaccion+"','"+id+"','"+foto+"')");
    }

    function quitarTabla(cantidad, refaccion, id, foto) {
        var cantidad_sumar = parseInt($('#id_res' + id).html(), 10);
        var cantidad_or = parseInt($('#id_' + id).html(), 10);
        var res = cantidad_sumar + cantidad_or;
        //console.log(res);

        // Filtrar el arreglo para eliminar el objeto con el id especificado
        tabla_pedido = tabla_pedido.filter(function(item) {
            return item.id !== id;
        });
        
        $('#arreglo_pedidos').val(JSON.stringify(tabla_pedido));
        console.log(tabla_pedido);
        var html = "";
        for (var i = 0; i < tabla_pedido.length; i++)

        {
            html += "<tr>";
            html += "<td>HER0000" + tabla_pedido[i]['id'] + "</td>";
            html += "<td>" + tabla_pedido[i]['refaccion'] + "</td>";
            html += "<td id='id_res" + tabla_pedido[i]['id'] + "'>" + tabla_pedido[i]['cantidad'] + "</td>";
            var imagen = "{{url('/images/Caja de herramienta/')}}/" + tabla_pedido[i]['foto'];
            html += "<td><center><img width='100px' src='" + imagen + "'></center></td>";
            html += '<td><button id="quitar_herramienta_'+tabla_pedido[i]['id']+'" name="quitar_herramienta_'+tabla_pedido[i]['id']+'" class="btn btn-danger"> <i class="la flaticon-line-1"> Eliminar</i> </button></td></tr>';
             var refacciones = tabla_pedido[i]['refaccion'] ;
        refacciones = refacciones.replace(/'/g, "\\'");
            $('#agregar_herramienta_' + tabla_pedido[i]['id']).attr('onclick', "abrirModal('" + tabla_pedido[i]['cantidad'] + "','" +  refacciones+ "','" + tabla_pedido[i]['id'] + "','" + tabla_pedido[i]['foto'] + "')");
        }
        
        
        refaccion = refaccion.replace(/'/g, "\\'");
        $('#agregar_herramienta_' + id).attr('onclick', "abrirModal('" + res + "','" + refaccion + "','" + id + "','" + foto + "')");
        $('#tabla_llenar').html(html);
        for (var i = 0; i < tabla_pedido.length; i++)
        {
            var refacciones = tabla_pedido[i]['refaccion'] ;
        refacciones = refacciones.replace(/'/g, "\\'");
            $('#quitar_herramienta_'+tabla_pedido[i]['id']).attr('onclick',"quitarTabla('"+tabla_pedido[i]['cantidad']+"','"+refacciones+"','"+tabla_pedido[i]['id'] +"','"+tabla_pedido[i]['foto'] +"')");
        }
        $('#id_' + id).html(res);
    }



    // Limpiar eventos al cerrar el modal
    $('#exampleModal').on('hidden.bs.modal', function () {
        $('#cantidad_modal').off('input change');
    });


    $('#t_inventario2').DataTable({
        scrollX: false,
        scrollCollapse: true,
        filter: true,
        lengthMenu: [[12, 24, 36, 48, 60, -1], [12, 24, 36, 48, 60, "Todos"]],
        iDisplayLength: 12,
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
