<x-app-layout>
    <head>
        <title>Visualizar Polígono en el Mapa</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <style>
            #map { height: 500px; width: 100%; }
        </style>
    </head>
    <body>
        <div id="map"></div>
    </body>

    @section('jscustom')
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>

    <script type="text/javascript">

        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    
                    const point = turf.point([lon, lat]);

                    // Enviar coordenadas al servidor
                    $.ajax({
                        url: '{{ url("/geo2") }}',
                        type: 'POST',
                        data: {
                            'lat': lat,
                            'log': lon,
                            'eco': 1000,
                            '_token': '{{ csrf_token() }}' // Necesario para Laravel
                        },
                        success: function(response) {

                        },
                        error: function(xhr, status, error) {
                            alert('Error en la solicitud: ' + error);
                        }
                    });

                    const poly = turf.polygon([polygonCoordinates2.map(coord => [coord[1], coord[0]])]); // Invertir las coordenadas para Turf.js

                    let popupMessage;
                    if (turf.booleanPointInPolygon(point, poly)) {
                        popupMessage = 'Tu ubicación actual, dentro';
                    } else {
                        popupMessage = 'Tu ubicación actual, fuera';
                    }

                    L.marker([lat, lon], { icon: carIcon }).addTo(map)
                        .bindPopup(popupMessage)
                        .openPopup();

                }, function(error) {
                    alert('Error al obtener la ubicación: ' + error.message);
                });
            } else {
                alert('Geolocalización no es soportada por este navegador.');
            }
        }

        // Actualizar la ubicación cada 10 segundos
        updateLocation(); // Llamar inmediatamente la primera vez
        setInterval(function() {
            location.reload();
        }, 10000); // Cada 10 segundos
       
    </script>
    @endsection
</x-app-layout>
