<x-app-layout>
    <head>
        <title>Visualizar Polígono en el Mapa</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <style>
            #map { height: 550px; width: 100%; }
        </style>
    </head>
    <body>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Mapas unidades
                </div>
            </div>
            <div class="card-body">
                <div id="map"></div>
                <br>
                <br>
                <div class="row form-control">
                    <div class="col-md-12"  class="table-responsive">
                        <center>
                            Linea de mexibus
                        </center>
                <br>
                <br>
                <br>
                <br>
                        <table class="table-responsive">
                            <tr>
                                <td rowspan="2" ><img src="{{url('/assets/img/ico_cdazteca.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/quinto_sol.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/josefa.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/industrial.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/unitec.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/torres.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/zodiaco.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/adolfo_lopez.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/vocacional.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/valle_ecatepec.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/las_americas.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/1_mayo.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/hospital.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/aquiles_cerdan.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/jardines.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/palomas.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/19_sep.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/central_abastos.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/insurgentes.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/hidalgo.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/cuau_sur.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/cuau_nor.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/esmeralda.ico')}}" width="50px;"></td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td rowspan="2" style=""><img src="{{url('/assets/img/ojo_agua.ico')}}" width="50px;"></td>
                            </tr>
                            <tr>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>

                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>

                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                                <td style="border-top:1px black solid;"><img src="{{url('/assets/img/zvacio.png')}}" width="40px;"></td>
                            </tr>
                            <tr>
                                <td rowspan="2" id="93"></td>
                                <td id="92"></td>
                                <td id="91"></td>
                                <td id="90"></td>
                                <td rowspan="2" id="89"></td>
                                <td id="88"></td>
                                <td id="87"></td>
                                <td id="86"></td>
                                <td id="85"></td>
                                <td id="84"></td>
                                <td id="83"></td>
                                <td rowspan="2" id="82"></td>
                                <td id="81"></td>
                                <td id="80"></td>
                                <td id="79"></td>
                                <td rowspan="2" id="78"></td>
                                <td id="77"></td>
                                <td id="76"></td>
                                <td id="75"></td>
                                <td rowspan="2" id="74"></td>
                                <td id="73"></td>
                                <td id="72"></td>
                                <td rowspan="2" id="71"></td>
                                <td id="70"></td>
                                <td id="69"></td>
                                <td id="68"></td>
                                <td rowspan="2" id="67"></td>
                                <td id="66"></td>
                                <td id="65"></td>
                                <td rowspan="2" id="64"></td>
                                <td id="63"></td>
                                <td rowspan="2" id="62"></td>
                                <td id="61"></td>
                                <td id="60"></td>
                                <td rowspan="2" id="59"></td>
                                <td id="58"></td>
                                <td id="57"></td>
                                <td id="56"></td>
                                <td id="55"></td>
                                <td id="54"></td>
                                <td rowspan="2" id="53"></td>{{--americas--}}
                                <td id="52"></td>
                                <td id="51"></td>
                                <td id="50"></td>
                                <td rowspan="2" id="49"></td>
                                <td id="48"></td>
                                <td id="47"></td>
                                <td id="46"></td>
                                <td rowspan="2" id="45"></td>
                                <td id="44"></td>
                                <td id="43"></td>
                                <td rowspan="2" id="42"></td>
                                <td id="41"></td>
                                <td id="40"></td>
                                <td rowspan="2" id="39"></td>
                                <td id="38"></td>
                                <td id="37"></td>
                                <td id="36"></td>
                                <td id="35"></td>
                                <td rowspan="2" id="34"></td>
                                <td id="33"></td>
                                <td id="32"></td>
                                <td id="31"></td>
                                <td rowspan="2" id="30"></td>
                                <td id="29"></td>
                                <td id="28"></td>
                                <td id="27"></td>
                                <td id="26"></td>
                                <td rowspan="2" id="1"></td>
                                <td id="2"></td>
                                <td id="3"></td>
                                <td id="4"></td>
                                <td id="5"></td>
                                <td rowspan="2" id="6"></td>
                                <td id="7"></td>
                                <td id="8"></td>
                                <td id="9"></td>
                                <td id="10"></td>
                                <td id="11"></td>
                                <td rowspan="2" id="12"></td>
                                <td id="13"></td>
                                <td rowspan="2" id="14"></td>
                                <td id="15"></td>
                                <td id="16"></td>
                                <td id="17"></td>
                                <td rowspan="2" id="18"></td>
                                <td id="19"></td>
                                <td id="20"></td>
                                <td rowspan="2" id="21"></td>
                                <td id="22"></td>
                                <td id="23"></td>
                                <td id="24"></td>
                                <td id="25"></td>
                                <td rowspan="2" id="1111"></td>
                            </tr>
                            
                        </table>
                        
                <br>
                <br>
                <br>
                <br>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
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
                @if($seccion->cord1 != null) [{{$seccion->cord1}}], @endif
                @if($seccion->cord2 != null) [{{$seccion->cord2}}], @endif
                @if($seccion->cord3 != null) [{{$seccion->cord3}}], @endif
                @if($seccion->cord4 != null) [{{$seccion->cord4}}], @endif
                @if($seccion->cord5 != null) [{{$seccion->cord5}}], @endif
                @if($seccion->cord6 != null) [{{$seccion->cord6}}], @endif
                @if($seccion->cord7 != null) [{{$seccion->cord7}}], @endif
                @if($seccion->cord8 != null) [{{$seccion->cord8}}], @endif
            ];
            @if($i==93)
                const polygon{{$i}} = L.polygon(polygonCoordinates{{$i}}, {
                    color: 'red',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2
                }).addTo(allPolygons); // Agregar cada polígono al grupo
            @else
                const polygon{{$i}} = L.polygon(polygonCoordinates{{$i}}, {
                    color: 'blue',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2
                }).addTo(allPolygons); // Agregar cada polígono al grupo
            @endif
            @php $i++; @endphp
        @endforeach

        @php $i=1; @endphp
        allPolygons.addTo(map); 
        map.fitBounds(allPolygons.getBounds()); 

        async function eco1000() {
            $.ajax({url: '{{ url("/geo_eco1000") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$i}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$i}}').append('<center>1000</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1000');
                                console.log('entro1000');
                            } 
                            @php $i++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error en la solicitud: ' + error);
                }
            });
        }
        async function eco65() {
            $.ajax({url: '{{ url("/geo_eco65") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center>65</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 65');
                                console.log('65');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });
        }
        async function eco66() {
            $.ajax({url: '{{ url("/geo_eco66") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center>66</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 66');
                                console.log('66');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco67() {
            $.ajax({url: '{{ url("/geo_eco67") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>67</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 67');
                                console.log('67');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}





            async function eco68() {
            $.ajax({url: '{{ url("/geo_eco68") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center>68</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 68');
                                console.log('68');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco69() {
            $.ajax({url: '{{ url("/geo_eco69") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>69</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 69');
                                console.log('69');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco70() {
            $.ajax({url: '{{ url("/geo_eco70") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>70</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 70');
                                console.log('70');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco71() {
            $.ajax({url: '{{ url("/geo_eco71") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>71</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 71');
                                console.log('71');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco72() {
            $.ajax({url: '{{ url("/geo_eco72") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>72</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 72');
                                console.log('72');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco73() {
            $.ajax({url: '{{ url("/geo_eco73") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                
                                $('#{{$a}}').append('<center>73</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 73');
                                console.log('73');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco74() {
            $.ajax({url: '{{ url("/geo_eco74") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>74</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 74');
                                console.log('74');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco75() {
            $.ajax({url: '{{ url("/geo_eco75") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>75</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 75');
                                console.log('75');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco76() {
            $.ajax({url: '{{ url("/geo_eco76") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>76</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 76');
                                console.log('76');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco77() {
            $.ajax({url: '{{ url("/geo_eco77") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>77</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 77');
                                console.log('77');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco78() {
            $.ajax({url: '{{ url("/geo_eco78") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>78</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 78');
                                console.log('78');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco79() {
            $.ajax({url: '{{ url("/geo_eco79") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>79</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 79');
                                console.log('79');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}









            async function eco80() {
            $.ajax({url: '{{ url("/geo_eco80") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>80</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 80');
                                console.log('80');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco81() {
            $.ajax({url: '{{ url("/geo_eco81") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>81</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 81');
                                console.log('81');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco82() {
            $.ajax({url: '{{ url("/geo_eco82") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>82</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 82');
                                console.log('82');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco83() {
            $.ajax({url: '{{ url("/geo_eco83") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>83</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 83');
                                console.log('83');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco84() {
            $.ajax({url: '{{ url("/geo_eco84") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>84</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 84');
                                console.log('84');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco85() {
            $.ajax({url: '{{ url("/geo_eco85") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>85</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 85');
                                console.log('85');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco86() {
            $.ajax({url: '{{ url("/geo_eco86") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>86</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 86');
                                console.log('86');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco87() {
            $.ajax({url: '{{ url("/geo_eco87") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>87</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 87');
                                console.log('87');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco88() {
            $.ajax({url: '{{ url("/geo_eco88") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>88</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 88');
                                console.log('88');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco89() {
            $.ajax({url: '{{ url("/geo_eco89") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>89</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 89');
                                console.log('89');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco90() {
            $.ajax({url: '{{ url("/geo_eco90") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>90</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 90');
                                console.log('90');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco91() {
            $.ajax({url: '{{ url("/geo_eco91") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>91</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 91');
                                console.log('91');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco92() {
            $.ajax({url: '{{ url("/geo_eco92") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>92</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 92');
                                console.log('92');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco93() {
            $.ajax({url: '{{ url("/geo_eco93") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>93</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 93');
                                console.log('93');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco94() {
            $.ajax({url: '{{ url("/geo_eco94") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>94</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 94');
                                console.log('94');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco95() {
            $.ajax({url: '{{ url("/geo_eco95") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>95</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 95');
                                console.log('95');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco96() {
            $.ajax({url: '{{ url("/geo_eco96") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>96</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 96');
                                console.log('96');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco97() {
            $.ajax({url: '{{ url("/geo_eco97") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>97</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 97');
                                console.log('97');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco98() {
            $.ajax({url: '{{ url("/geo_eco98") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>98</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 98');
                                console.log('98');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco99() {
            $.ajax({url: '{{ url("/geo_eco99") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>99</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 99');
                                console.log('99');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}


            async function eco1001() {
            $.ajax({url: '{{ url("/geo_eco1001") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1001</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1001');
                                console.log('1001');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1002() {
            $.ajax({url: '{{ url("/geo_eco1002") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1002</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1002');
                                console.log('1002');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1003() {
            $.ajax({url: '{{ url("/geo_eco1003") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1003</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1003');
                                console.log('1003');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1004() {
            $.ajax({url: '{{ url("/geo_eco1004") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1004</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1004');
                                console.log('1004');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1005() {
            $.ajax({url: '{{ url("/geo_eco1005") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1005</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1005');
                                console.log('1005');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1006() {
            $.ajax({url: '{{ url("/geo_eco1006") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1006</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1006');
                                console.log('1006');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1007() {
            $.ajax({url: '{{ url("/geo_eco1007") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1007</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1007');
                                console.log('1007');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1008() {
            $.ajax({url: '{{ url("/geo_eco1008") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1008</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1008');
                                console.log('1008');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1009() {
            $.ajax({url: '{{ url("/geo_eco1009") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1009</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1009');
                                console.log('1009');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1012() {
            $.ajax({url: '{{ url("/geo_eco1012") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1012</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 12');
                                console.log('1012');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco1() {
            $.ajax({url: '{{ url("/geo_eco1") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 1');
                                console.log('1');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco15() {
            $.ajax({url: '{{ url("/geo_eco15") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>15</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 15');
                                console.log('15');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco24() {
            $.ajax({url: '{{ url("/geo_eco24") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>24</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 24');
                                console.log('24');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco25() {
            $.ajax({url: '{{ url("/geo_eco25") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>25</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 25');
                                console.log('25');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco35() {
            $.ajax({url: '{{ url("/geo_eco35") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>35</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 35');
                                console.log('35');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco41() {
            $.ajax({url: '{{ url("/geo_eco41") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>41</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 41');
                                console.log('41');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}

            async function eco45() {
            $.ajax({url: '{{ url("/geo_eco45") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>45</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 45');
                                console.log('45');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
            async function eco46() {
            $.ajax({url: '{{ url("/geo_eco46") }}',type: 'POST',data: {'_token': '{{ csrf_token() }}' },
                success: function(response) { navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];const lon = response['lon'];const point = turf.point([lon, lat]);@php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); 
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>46</center>');
                                const customIcon = L.icon({iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [45, 45], iconAnchor: [22, 38], popupAnchor: [-3, -76] });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map).bindPopup('Tu ubicación actual 46');
                                console.log('46');} 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {console.log('Error al obtener la ubicación: ' + error.message);}); },
                error: function(xhr, status, error) { console.log('Error en la solicitud: ' + error); }
            });}
           
        async function eco1011() {
            $.ajax({
                url: '{{ url("/geo_eco1011") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}' // Necesario para Laravel
                },
                success: function(response) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];
                        const lon = response['lon'];
                        const point = turf.point([lon, lat]);
                        @php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        const poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]);
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1011</center>');
                                const customIcon = L.icon({
                                    iconUrl: '{{url("/assets/img/mexibus2024.ico")}}', iconSize: [45, 45], iconAnchor: [22, 38],  popupAnchor: [-3, -76] 
                                });
                                const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map)
                                    .bindPopup('Tu ubicación actual 1011');
                                console.log('entro1011');
                            } 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                },
                error: function(xhr, status, error) {
                }
            });
        }

        async function eco1010() {
            $.ajax({
                url: '{{ url("/geo_eco1010") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}' // Necesario para Laravel
                },
                success: function(response) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = response['lat'];
                        const lon = response['lon'];
                        const point = turf.point([lon, lat]);
                        @php $a=1; @endphp
                        @foreach($secciones as $seccion)
                        var poly{{$i}} = turf.polygon([polygonCoordinates{{$a}}.map(coord => [coord[1], coord[0]])]); // Invertir las coordenadas para Turf.js
                            if (turf.booleanPointInPolygon(point, poly{{$i}})) {
                                $('#{{$a}}').append('<center>1010</center>');
                                const customIcon = L.icon({ iconUrl: '{{url("/assets/img/mexibus2024.ico")}}',iconSize: [60, 60],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                        const userLocation = L.marker([lat, lon], { icon: customIcon }).addTo(map)
                                    .bindPopup('Tu ubicación actual 1010');  
                        console.log('entro1010');
                            } 
                            @php $i++;
                            $a++; @endphp
                        @endforeach
                    }, function(error) {
                        console.log('Error al obtener la ubicación: ' + error.message);
                    });
                },
                error: function(xhr, status, error) {
                }
            });
        }
        async function estaciones() {
            navigator.geolocation.getCurrentPosition(function(position) {
                const ico_cdazteca = L.icon({ iconUrl: '{{url("/assets/img/ico_cdazteca.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_quinto = L.icon({ iconUrl: '{{url("/assets/img/quinto_sol.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_josefa = L.icon({ iconUrl: '{{url("/assets/img/josefa.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_industrial = L.icon({ iconUrl: '{{url("/assets/img/industrial.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_unitec = L.icon({ iconUrl: '{{url("/assets/img/unitec.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_torres = L.icon({ iconUrl: '{{url("/assets/img/torres.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_zodiaco = L.icon({ iconUrl: '{{url("/assets/img/zodiaco.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_adolfo = L.icon({ iconUrl: '{{url("/assets/img/adolfo_lopez.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_vocacional = L.icon({ iconUrl: '{{url("/assets/img/vocacional.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_ecatepec = L.icon({ iconUrl: '{{url("/assets/img/valle_ecatepec.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_americas = L.icon({ iconUrl: '{{url("/assets/img/las_americas.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_mayo = L.icon({ iconUrl: '{{url("/assets/img/1_mayo.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_hospital = L.icon({ iconUrl: '{{url("/assets/img/hospital.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_aquiles = L.icon({ iconUrl: '{{url("/assets/img/aquiles_cerdan.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_jardines = L.icon({ iconUrl: '{{url("/assets/img/jardines.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_palomas = L.icon({ iconUrl: '{{url("/assets/img/palomas.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico__sep_19 = L.icon({ iconUrl: '{{url("/assets/img/19_sep.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_ojo_agua = L.icon({ iconUrl: '{{url("/assets/img/ojo_agua.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_esmeralda = L.icon({ iconUrl: '{{url("/assets/img/esmeralda.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_cuauhtemocN = L.icon({ iconUrl: '{{url("/assets/img/cuau_nor.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_cuauhtemoc = L.icon({ iconUrl: '{{url("/assets/img/cuau_sur.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_Hidalgo = L.icon({ iconUrl: '{{url("/assets/img/hidalgo.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_insurgentes = L.icon({ iconUrl: '{{url("/assets/img/insurgentes.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const ico_estacionCentralA = L.icon({ iconUrl: '{{url("/assets/img/central_abastos.ico")}}',iconSize: [30, 30],iconAnchor: [22, 38],popupAnchor: [-3, -76] });
                const estacionCentralA = L.marker([19.616544424211213, -99.00803461449348], { icon: ico_estacionCentralA }).addTo(map).bindPopup('central');
                const insurgentes = L.marker([19.62539866895445, -99.00321162537098], { icon: ico_insurgentes }).addTo(map).bindPopup('insurgentes');
                const Hidalgo = L.marker([19.6335203965161, -99.00211895374885], { icon: ico_Hidalgo }).addTo(map).bindPopup('Hidalgo');
                const cuauhtemoc = L.marker([19.63818593844235, -99.00269947952754], { icon: ico_cuauhtemoc }).addTo(map).bindPopup('cuauhtemoc');
                const cuauhtemocN = L.marker([19.646488969117716, -99.00501819540179], { icon: ico_cuauhtemocN }).addTo(map).bindPopup('cuauhtemoc norte');
                const esmeralda = L.marker([19.651573299383497, -99.00508713918252], { icon: ico_esmeralda }).addTo(map).bindPopup('esmeralda');
                const ojo_agua = L.marker([19.66164577747433, -99.00125243200863], { icon: ico_ojo_agua }).addTo(map).bindPopup('ojo_agua');
                const _sep_19 = L.marker([19.610504659452694, -99.00931282896268], { icon: ico__sep_19 }).addTo(map).bindPopup('19_sep');                                
                const palomas = L.marker([19.607286596652425, -99.01159622487319], { icon: ico_palomas }).addTo(map).bindPopup('palomas');                                
                const jardines = L.marker([19.60064682598177, -99.01620617049123], { icon: ico_jardines }).addTo(map).bindPopup('jardines de morelos');
                const aquiles = L.marker([19.598452753663285, -99.01789483961944], { icon: ico_aquiles }).addTo(map).bindPopup('aquiles serdan');
                const hospital = L.marker([19.595194875743143, -99.01970904847443], { icon: ico_hospital }).addTo(map).bindPopup('hospital');
                const mayo = L.marker([19.588066122635382, -99.02445145403411], { icon: ico_mayo }).addTo(map).bindPopup('primero de mayo');
                const americas = L.marker([19.580643820091627, -99.02455850687326], { icon: ico_americas }).addTo(map).bindPopup('las americas');
                const ecatepec = L.marker([19.57300215007808, -99.02084490199081], { icon: ico_ecatepec }).addTo(map).bindPopup('valle de ecatepec');
                const vocacional = L.marker([19.57038443723783, -99.0183186579712], { icon: ico_vocacional }).addTo(map).bindPopup('vocacional 3');
                const adolfo = L.marker([19.567055250848544, -99.01552906612326], { icon: ico_adolfo }).addTo(map).bindPopup('adolfo lopez mateos');
                const zodiaco = L.marker([19.563166908362554, -99.0153123864357], { icon: ico_zodiaco }).addTo(map).bindPopup('zodiaco');
                const torres = L.marker([19.55775409434341, -99.01765080455169], { icon: ico_torres }).addTo(map).bindPopup('torres');
                const unitec = L.marker([19.554853971883578, -99.01914250009727], { icon: ico_unitec }).addTo(map).bindPopup('unitec');
                const industrial = L.marker([19.5502755054604, -99.0211687043753], { icon: ico_industrial }).addTo(map).bindPopup('industrial');
                const josefa = L.marker([19.546560376652867, -99.02278397780064], { icon: ico_josefa }).addTo(map).bindPopup('josefa ortiz');
                const quinto = L.marker([19.5396424745568, -99.0257623772034], { icon: ico_quinto }).addTo(map).bindPopup('quinto sol');
                const azteca = L.marker([19.534824127431403, -99.02695087270375], { icon: ico_cdazteca }).addTo(map).bindPopup('cd azteca');
            });
        }
        estaciones();        eco65();        eco66();        eco67();         eco68();         eco69();         eco70();         eco71();         eco72(); 
        eco73();         eco74();         eco75();         eco76();         eco77();         eco78();         eco79();         eco80();         eco81(); 
        eco82();         eco83();         eco84();         eco85();         eco86();         eco87();         eco88();         eco89();         eco90(); 
        eco91();         eco92();         eco93();         eco94();         eco95();         eco96();         eco97();         eco98();         eco99(); 
        eco1000();        eco1001();        eco1002();        eco1003();        eco1004();        eco1005();        eco1006();        eco1007();        eco1008();
        eco1009();        eco1012();        eco1();        eco15();        eco24();        eco25();        eco35();        eco41();        eco45();        eco46();
        eco1011();        eco1010();

        @php $i=1; @endphp

       async function unifiedInterval() {
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
                console.log('limpio');
                @php 
                for($r=1; $r<=93;$r++){
                @endphp
                    $('#{{$r}}').html('');
                @php 
                }
                @endphp
            }
        });
                        
        estaciones();
        setInterval(await eco65(), 100);
        setInterval(await eco66(), 100);
        setInterval(await eco67(), 100);
        setInterval(await eco68(), 100);
        setInterval(await eco69(), 100);
        setInterval(await eco70(), 100);
        setInterval(await eco71(), 100);
        setInterval(await eco72(), 100);
        setInterval(await eco73(), 100);
        setInterval(await eco74(), 100);
        setInterval(await eco75(), 100);
        setInterval(await eco76(), 100);
        setInterval(await eco77(), 100);
        setInterval(await eco78(), 100);
        setInterval(await eco79(), 100);
        setInterval(await eco80(), 100);
        setInterval(await eco81(), 100);
        setInterval(await eco82(), 100);
        setInterval(await eco83(), 100);
        setInterval(await eco84(), 100);
        setInterval(await eco85(), 100);
        setInterval(await eco86(), 100);
        setInterval(await eco87(), 100);
        setInterval(await eco88(), 100);
        setInterval(await eco89(), 100);
        setInterval(await eco90(), 100);
        setInterval(await eco91(), 100);
        setInterval(await eco92(), 100);
        setInterval(await eco93(), 100);
        setInterval(await eco94(), 100);
        setInterval(await eco95(), 100);
        setInterval(await eco96(), 100);
        setInterval(await eco97(), 100);
        setInterval(await eco98(), 100);
        setInterval(await eco99(), 100);
        setInterval(await eco1001(), 100);
        setInterval(await eco1002(), 100);
        setInterval(await eco1003(), 100);
        setInterval(await eco1004(), 100);
        setInterval(await eco1005(), 100);
        setInterval(await eco1006(), 100);
        setInterval(await eco1007(), 100);
        setInterval(await eco1008(), 100);
        setInterval(await eco1009(), 100);
        setInterval(await eco1012(), 100);
        setInterval(await eco1(), 100);
        setInterval(await eco15(), 100);
        setInterval(await eco24(), 100);
        setInterval(await eco25(), 100);
        setInterval(await eco35(), 100);
        setInterval(await eco41(), 100);
        setInterval(await eco45(), 100);
        setInterval(await eco46(), 100);
        setInterval(await eco1000(), 100);
        setInterval(await eco1011(), 100);
        setInterval(await eco1010(), 100);
        
        }


        setInterval(unifiedInterval, 10000);
    </script>
    @endsection
</x-app-layout>
