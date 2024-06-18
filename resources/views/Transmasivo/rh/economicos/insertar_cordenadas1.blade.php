<x-app-layout>
    <head>
        <title>Visualizar Polígono en el Mapa</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/@turf/turf/turf.min.js"></script> <!-- Añadir Turf.js -->
        <style>
            #map { height: 500px; width: 100%; }
            #countdown { font-size: 20px; margin: 10px; }
        </style>
    </head>
    <body>
        <div id="countdown">10</div> <!-- Contador regresivo -->
    </body>

    @section('jscustom')

    <script type="text/javascript">
        let countdownElement = document.getElementById('countdown');
        let countdownValue = 10;

        function startCountdown() {
            countdownElement.innerText = countdownValue;
            const interval = setInterval(() => {
                countdownValue--;
                countdownElement.innerText = countdownValue;
                if (countdownValue <= 0) {
                    clearInterval(interval);
                    countdownValue = 10; // Reiniciar el contador
                    startCountdown(); // Reiniciar la cuenta regresiva
                    updateLocation(); // Llamar a la función de actualización de ubicación
                }
            }, 1000);
        }

        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    const point = turf.point([lon, lat]);

                    // Enviar coordenadas al servidor
                    $.ajax({
                        url: '{{ url("/geo1011") }}',
                        type: 'POST',
                        data: {
                            'lat': lat,
                            'log': lon,
                            'eco': 1,
                            '_token': '{{ csrf_token() }}' // Necesario para Laravel
                        },
                        success: function(response) {
                            // Manejo de la respuesta del servidor
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

                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(popupMessage)
                        .openPopup();

                }, function(error) {
                    alert('Error al obtener la ubicación: ' + error.message);
                });
            } else {
                alert('Geolocalización no es soportada por este navegador.');
            }
        }

        // Iniciar la cuenta regresiva y actualizar la ubicación cada 10 segundos
        startCountdown();
        setInterval(function() {
            location.reload();
        }, 10000); // Cada 10 segundos
    </script>
    @endsection
</x-app-layout>
