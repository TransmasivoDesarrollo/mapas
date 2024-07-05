<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Transmasivo</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{url('/assets')}}/img/mexibus2024.ico" type="image/x-icon"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

    <!-- Fonts and icons -->
    <script src="{{url('/assets')}}/js/plugin/webfont/webfont.min.js"></script>
    <style type="text/css">
    .li_hover:hover{background-color:#2C3E50;}
</style>
<script>
    WebFont.load({
        google: {"families":["Montserrat:100,200,300,400,500,600,700,800,900"]},
        custom: {"families":["Flaticon", "LineAwesome"], urls: ['{{url('/assets')}}/css/fonts.css']},
        active: function() {
            sessionStorage.fonts = true;
        }
    });


</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{url('/assets')}}/css/bootstrap.min.css">
<link rel="stylesheet" href="{{url('/assets')}}/css/ready.css">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{url('/assets')}}/css/demo.css">

</head>
        <center>
            <h2>Economico 93</h2>
        <div id="countdown">10</div> <!-- Contador regresivo -->
        
        <button style="width:80%; height:40%;" class="btn btn-danger"><h2>Siniestro</h2></button>
        <br><br><br>
        <button style="width:80%; height:40%;" class="btn btn-danger"><h2>Falla Eco</h2></button>
         <br><br><br>
        <button style="width:80%; height:40%;" class="btn btn-danger"><h2>Manifestación</h2></button>
        </center>
    </body>

<script src="{{url('/assets')}}/js/core/jquery.3.2.1.min.js"></script>
<script src="{{url('/assets')}}/js/core/popper.min.js"></script>
<script src="{{url('/assets')}}/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="{{url('/assets')}}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{url('/assets')}}/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{url('/assets')}}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="{{url('/assets')}}/js/plugin/moment/moment.min.js"></script>


<!-- jQuery Vector Maps -->
<script src="{{url('/assets')}}/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('/assets')}}/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="{{url('/assets')}}/js/plugin/gmaps/gmaps.js"></script>

<!-- jQuery Validation -->
<script src="{{url('/assets')}}/js/plugin/jquery.validate/jquery.validate.min.js"></script>

<!-- Summernote -->
<script src="{{url('/assets')}}/js/plugin/summernote/summernote-bs4.min.js"></script>


<!-- Ready Pro JS -->
<script src="{{url('/assets')}}/js/ready.min.js"></script>
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
                        url: '{{ url("/geo24i") }}',
                        type: 'get',
                        data: {
                            'lat': lat,
                            'log': lon,
                            'eco': '93'
                        },
                        success: function(response) {
                           
                        },
                        error: function(xhr, status, error) {
                            alert('Error en la solicitud: ' + error);
                        }
                    });

                    

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
            updateLocation();
        }, 10000); // Cada 10 segundos
    </script>
