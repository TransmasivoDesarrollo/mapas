<x-app-layout>
    <head>
        <title>Visualizar Polígono en el Mapa</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <style>
            #map { height: 650px; width: 100%; }
        </style>
    </head>
    <body>
        <div id="map"></div>
    </body>

    @section('jscustom')
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>

    <script type="text/javascript">
        const map = L.map('map').setView([19.61788, -99.011616], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const allPolygons = L.featureGroup(); // Usar FeatureGroup en lugar de LayerGroup

        @php $i=1; @endphp
        @foreach($secciones as $seccion)
            const polygonCoordinates{{$i}} = [
                [{{$seccion->cord1}}],
                [{{$seccion->cord2}}],
                [{{$seccion->cord3}}],
                [{{$seccion->cord4}}],
                @if($seccion->cord5 != null) [{{$seccion->cord5}}], @endif
                @if($seccion->cord6 != null) [{{$seccion->cord6}}], @endif
                @if($seccion->cord7 != null) [{{$seccion->cord7}}], @endif
                @if($seccion->cord8 != null) [{{$seccion->cord8}}], @endif
            ];

            const polygon{{$i}} = L.polygon(polygonCoordinates{{$i}}, {
                color: 'blue',
                fillColor: '#3388ff',
                fillOpacity: 0.2
            }).addTo(allPolygons); // Agregar cada polígono al grupo

            @php $i++; @endphp
        @endforeach

        allPolygons.addTo(map); // Agregar el grupo de polígonos al mapa
        map.fitBounds(allPolygons.getBounds()); // Ajustar el mapa a los límites del grupo de polígonos

        function eco100() {
            $.ajax({
                url: '{{ url("/geo_eco1000") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}' // Necesario para Laravel
                },
                success: function(response) {
                    console.log(response);
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];
                        const lon = response['lon'];

                        const point = turf.point([lon, lat]);
                        const poly = turf.polygon([polygonCoordinates1.map(coord => [coord[1], coord[0]])]); // Invertir las coordenadas para Turf.js

                        map.eachLayer(function(layer) {
                            if (layer instanceof L.Marker) {
                                map.removeLayer(layer);
                            }
                        });

                        if (turf.booleanPointInPolygon(point, poly)) {
                            const userLocation = L.marker([lat, lon]).addTo(map)
                                .bindPopup('Tu ubicación actual, dentro')
                                .openPopup();
                        } else {
                            const userLocation = L.marker([lat, lon]).addTo(map)
                                .bindPopup('Tu ubicación actual, fuera')
                                .openPopup();
                        }
                    }, function(error) {
                        alert('Error al obtener la ubicación: ' + error.message);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error en la solicitud: ' + error);
                }
            });
        }

        eco100();
        setInterval(eco100, 10000); // Cada 10 segundos
    </script>
    @endsection
</x-app-layout>
