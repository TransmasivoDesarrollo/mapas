<x-app-layout>
	
	<div class="card">
    </div>



@section('jscustom')
<script type="text/javascript">
	
		if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            sendCoordinatesToServer(lat, lon);
            alert('Error al obtener la ubicación: ' + lat);
            alert('Error al obtener la ubicación: ' + lon);
        }, function(error) {
            alert('Error al obtener la ubicación: ' + error.message);
        });
    } else {
        alert('Geolocalización no es soportada por este navegador.');
    }
    function sendCoordinatesToServer(lat, lon) {
        $.ajax({
            url: '/check-location',
            type: 'get',
            data: {
                latitude: lat,
                longitude: lon,
                _token: '{{ csrf_token() }}' // Laravel CSRF token
            },
            success: function(response) {
                if (response.status === 'inside') {
                    alert('El dispositivo está dentro del rango.');
                } else {
                    alert('El dispositivo está fuera del rango.');
                }
            },
            error: function() {
                alert('Error al verificar la ubicación.');
            }
        });
    }
</script>
@endsection
</x-app-layout>
