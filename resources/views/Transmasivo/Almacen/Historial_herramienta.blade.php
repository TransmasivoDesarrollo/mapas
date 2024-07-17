<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Inventario para caja de herramientas </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			    <div class=" row form-group " >
                   
                        
                   
                    <div class="col-md-12">
                        <table class=" table " id="t_inventario">
                            <thead>
                                <tr>
                                    <th class="bg-primary sorting" style="color:#fff;">ID </th>
                                    <th class="bg-primary sorting" style="color:#fff;">Nombre</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Economico</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Fecha</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Estatus</th>
                                    <th class="bg-primary sorting" style="color:#fff;">Ver herramientas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consulta as $consul)
                                    <tr>
                                        <td>{{$consul->id_solicitud_herramienta}}</td>
                                        <td>{{$consul->name}}</td>
                                        <td>{{$consul->Economico}}</td>
                                        <td>{{$consul->Fecha}}</td>
                                        <td>@if($consul->estatus=="Devuelto")
                                                <b style="color:green;">{{$consul->estatus}}</b>
                                            @elseif($consul->estatus=="Prestado")
                                                <b style="color:orange;">{{$consul->estatus}}</b>
                                            @endif
                                        </td>
                                        <td><input type="submit" value="Ver herramienta"  onclick="abrirModal('{{$consul->id_solicitud_herramienta}}')" class="btn btn-primary" id="ver_herramienta" name="ver_herramienta"></td>
                                    </tr>
                                @endforeach          
                            </tbody>
                        </table>
			        </div>
                    <div class="modal fade bd-example-modal-lg" id="modal_herramienta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            Herramientas prestadas
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" >
                                        <div class="row form-group" id="llenarFormulario">
                                            
                                        </div>
                                    </div>
                                                                       
                                </div>
                            </div>
                        </div>
                    </div>
			    </div>
		</div>
	</div>




@section('jscustom')
<script type="text/javascript">
	
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
    function abrirModal(id_solicitud_herramienta)
    {
        $('#modal_herramienta').modal('show');
        
        $('#llenarFormulario').html('');
        $.ajax({
            url : '{{url("/buscar_Historial_herramienta")}}',
            data : { 'id_solicitud_herramienta' : id_solicitud_herramienta },
            type : 'GET',
            success : function(json) {
                console.log(json);
                var html ="";
                for(var i=0; i < json.length; i++){
                    html += '<div class="col-md-6">';
                    html += '<div class="card">';
                    html += '<div class="card-header" style="border: 1px black solid">';
                    html += '<center>Herramienta: '+json[i].Refaccion+'</center>';
                    html += '</div>';
                    html += '<div class="card-body" style="border: 1px black solid">';
                    html += '<center><img  width="150px;" src="'+'{{url("/images/Caja de herramienta/")}}'+'/'+json[i].Foto+'"></center>';
                    html += '</div>';
                    html += '<div class="card-footer" style="border: 1px black solid">';
                    html += '<center>Cantidad: '+json[i].cantidad+'<br>';
                    if(json[i].estatus == "Devuelto")
                    {
                        html += '<b style="color:green;">'+json[i].estatus+'</b></center>';
                    }else if(json[i].estatus == "Prestado")
                    {
                        html += '<b style="color:orange;">'+json[i].estatus+'</b></center>';
                    }
                    
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#llenarFormulario').html(html);
            },
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
            },
            complete : function(xhr, status) {
                
            }
        });
    }
	
</script>
@endsection
</x-app-layout>
