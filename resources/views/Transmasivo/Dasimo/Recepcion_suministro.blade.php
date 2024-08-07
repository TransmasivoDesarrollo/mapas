<x-app-layout>
	<style>
		.input-with-border {
			border: 1px solid black;
		}

	</style>
	<div class="card">
		<div class="card-header">
			<div class="card-title"> Recepción de suministros </div>
		</div>
		<div class="card-body">
			@if (session('mensaje'))
			<div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
				{{ session('mensaje') }}.
			</div>
			@endif
			
				<div class="form-group row " >
					
					<div class="col-md-12">
						
					</div>
                    <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" style="width:100%;" id="table">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary sorting" style="color:#fff;">Folio</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Fecha</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Cliente</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Estatus</th>
                                            <th class="bg-primary sorting" style="color:#fff;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_llenar">
                                        @foreach($consulta as $consul)
                                        <tr>
                                            <td>{{$consul->id}}</td>
                                            <td>{{$consul->fecha}}</td>
                                            <td>{{$consul->name}}</td>
                                            <td>
                                                @if($consul->estatus=="Devuelto")
                                                <b style="color:green;">{{$consul->estatus}}</b>
                                                @elseif($consul->estatus=="Prestado")
                                                    <b style="color:orange;">{{$consul->estatus}}</b>
                                                @endif
                                            </td>
                                            <td><button class="btn btn-primary" onclick="abrirModal('{{$consul->id}}')">Ver suministro</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
	
	$('#table').DataTable({
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
            url : '{{url("/buscar_solicitud_suministro")}}',
            data : { 'id_solicitud_herramienta' : id_solicitud_herramienta },
            type : 'GET',
            success : function(json) {
                console.log(json);
                var html ="";
                for(var i=0; i < json.length; i++){
                    html += '<div class="col-md-6">';
                    html += '<div class="card">';
                    html += '<div class="card-header" style="border: 1px black solid">';
                    html += '<center>Herramienta: '+json[i].nombre+'</center>';
                    html += '</div>';
                    html += '<div class="card-body" style="border: 1px black solid">';
                    if(json[i].foto==null || json[i].foto==""){
                        var imagen = "{{url('/images/')}}/sin_imagen.jpg" ;
                        html += "<center><img width='100px' src='" + imagen + "'></center>";
                            
                    }else{
                        var imagen = "{{url('/images/Inventario_dasimo/')}}/" + foto;
                        html += "<center><img width='150px' src='" + imagen + "'></center>";
                    }
                    
                    html += '</div>';
                    html += '<div class="card-footer" style="border: 1px black solid">';
                    html += '<center>Cantidad: '+json[i].cantidad+'<br>';
                    if(json[i].estatus == "Devuelto")
                    {
                        html += '<b style="color:green;">'+json[i].estatus+'</b><br>';
                    }else if(json[i].estatus == "Prestado")
                    {
                        html += '<b style="color:orange;">'+json[i].estatus+'</b><br>';
                    }
                    html += '<input type="submit" value="Validar entrega" onclick="validar_cambio('+id_solicitud_herramienta+','+json[i].id+')" class="btn btn-primary">';
                    html += '<br>';
                    html += '<br>';
                    html += '<input type="submit" value="Validar entrega con fin de vida util" onclick="validar_cambio_fin_de_vida_util('+id_solicitud_herramienta+','+json[i].id+')" class="btn btn-warning">';
                    html +=' </center>';
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
    
    function validar_cambio_fin_de_vida_util(id_solicitud_herramienta, t_herramienta_solicitud) {
        $.ajax({
            url: '{{url("/validar_cambio_solicitud_suministro_vida_util")}}',
            data: {
                't_herramienta_solicitud': t_herramienta_solicitud,
            },
            type: 'GET',
            success: function(json) {
                if(json=="termino"){
                    location.reload();
                }else{
                    abrirModal(id_solicitud_herramienta);
                }
                
            },
            error: function(xhr, status) {
                alert('Disculpe, existió un problema');
            },
            complete: function(xhr, status) {
                // Código a ejecutar después de la llamada AJAX
            }
        });
    }
    function validar_cambio(id_solicitud_herramienta, t_herramienta_solicitud) {
        $.ajax({
            url: '{{url("/validar_cambio_solicitud_suministro")}}',
            data: {
                't_herramienta_solicitud': t_herramienta_solicitud,
            },
            type: 'GET',
            success: function(json) {
                if(json=="termino"){
                    location.reload();
                }else{
                    abrirModal(id_solicitud_herramienta);
                }
                
            },
            error: function(xhr, status) {
                alert('Disculpe, existió un problema');
            },
            complete: function(xhr, status) {
                // Código a ejecutar después de la llamada AJAX
            }
        });
    }

	
</script>
@endsection
</x-app-layout>
