<!-- resources/views/map.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Recorrido</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        $(document).ready(function() {
            // Inicializar el mapa
            const map = L.map('map').setView([19.61788, -99.011616], 15);

            // Cargar capa base de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            // Cargar los datos GeoJSON
            $.ajax({
                url: '/geodata',
                dataType: 'json',
                success: function(data) {
                    // Añadir puntos al mapa
                    L.geoJSON(data, {
                        pointToLayer: function (feature, latlng) {
                            return L.circleMarker(latlng);
                        }
                    }).addTo(map);

                    // Calcular y añadir la línea del recorrido
                    var line = turf.lineString(data.features.map(f => f.geometry.coordinates));
                    var lineLayer = L.geoJSON(line).addTo(map);

                    // Ajustar el mapa para mostrar todos los puntos
                    map.fitBounds(lineLayer.getBounds());
                },
                error: function() {
                    alert('Error al cargar los datos.');
                }
            });
        });
    </script>
</body>
</html>
