<x-app-layout>
    <style>
        .input-with-border {
            border: 1px solid black;
        }
        .loading-screen {
            display: none; /* Oculto por defecto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo gris semitransparente */
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .loading-screen img {
            width: 100px; /* Ajusta el tamaño del GIF */
            height: 100px;
        }
        /* Ajusta el tamaño de las imágenes en la tabla */
        .table img {
            max-width: 150px; /* Ajusta el ancho máximo de las imágenes */
            max-height: 150px; /* Ajusta la altura máxima de las imágenes */
            object-fit: cover; /* Asegura que la imagen se recorte de manera uniforme */
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Inventario para caja de herramientas</div>
            <div class="loading-screen" id="loadingScreen">
                <img src="{{ asset('carga.gif') }}" alt="Cargando...">
            </div>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
            <div class="alert alert-{{ session('color') }} alert-dismissible" data-dismiss="alert">
                {{ session('mensaje') }}.
            </div>
            @endif
            <div class="row form-group">
                <div class="col-md-12 text-right">
                    <form method="post" id="acceso" action="{{url('/Consultar_caja_herramienta')}}">
                        @csrf
                        <input type="submit" class="btn btn-success" id="Exportar" name="Exportar" value="Exportar excel">
                        <br>
                    </form>
                </div>
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-8">
                    <table class="table table-responsive" id="t_inventario">
                        <thead>
                            <tr>
                                <th class="bg-primary sorting" style="color:#fff;">ID inventario</th>
                                <th class="bg-primary sorting" style="color:#fff;">Refaccion</th>
                                <th class="bg-primary sorting" style="color:#fff;">Cantidad</th>
                                <th class="bg-primary sorting" style="color:#fff;">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventario as $t_inventario)
                                <tr>
                                    <td>HER0000{{$t_inventario->id}}</td>
                                    <td>{{$t_inventario->Refaccion}}</td>
                                    <td>{{$t_inventario->Cantidad}}</td>
                                    <td>
                                        <center>
                                            <img src="{{url('/images/Caja de herramienta/')}}/{{$t_inventario->Foto}}" alt="Foto">
                                        </center>
                                    </td>           
                                </tr>
                            @endforeach          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('jscustom')
    <script type="text/javascript">
        document.getElementById('acceso').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma tradicional

            // Mostrar la pantalla de carga
            document.getElementById('loadingScreen').style.display = 'flex';

            // Crear un formulario de datos
            var formData = new FormData(this);

            // Enviar solicitud AJAX
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                // Enviar el archivo al cliente (esto puede variar según tu implementación)
                if (response.ok) {
                    return response.blob(); // Obtener el archivo como un blob
                }
                throw new Error('Error en la solicitud');
            })
            .then(blob => {
                // Crear un enlace para descargar el archivo
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'inventario de caja de herramienta.xlsx'; // Puedes cambiar el nombre del archivo si es necesario
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                // Ocultar la pantalla de carga
                document.getElementById('loadingScreen').style.display = 'none';
            });
        });
        
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
    </script>
    @endsection
</x-app-layout>
