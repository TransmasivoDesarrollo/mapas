<x-app-layout>
	<style>
		table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
              }
        td, th {
            border: 1px solid #000000;
            text-align: right;
            padding: 2px;
        }

	</style>
    <div class="form-group row">

        <div class="col-xl-12">
        <div class="container my-5">
    <h1 class="text-center mb-4">Gestión de Renta</h1>
    <div class="row">
      <!-- Card de ejemplo para una plataforma -->
      <div class="col-md-4">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ99SIU75IK3W-Cly5W__TdfmuErBUyndh5GOppiubkSbPNCxLbKMg_zwT-xHvpb8G5YZA&usqp=CAU" class="card-img-top" alt="Genie S-65">
          <div class="card-body">
            <h5 class="card-title">Genie S-65</h5>
            <p class="card-text">
              <strong>Ficha Técnica:</strong><br>
              Altura de trabajo: 21.8 m<br>
              Alcance horizontal: 17.1 m<br>
              Capacidad de carga: 227 kg
            </p>
            <p>
              <strong>Disponibilidad:</strong> Renta y Venta<br>
              <strong>Estado:</strong> Rentada<br>
              <strong>Disponible a partir de:</strong> 2024-12-15
            </p>
            <a href="#" class="btn btn-primary btn-sm">Ver más detalles</a>
          </div>
        </div>
      </div>

      <!-- Segunda Card de ejemplo -->
      <div class="col-md-4">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ99SIU75IK3W-Cly5W__TdfmuErBUyndh5GOppiubkSbPNCxLbKMg_zwT-xHvpb8G5YZA&usqp=CAU" class="card-img-top" alt="JLG 800AJ">
          <div class="card-body">
            <h5 class="card-title">JLG 800AJ</h5>
            <p class="card-text">
              <strong>Ficha Técnica:</strong><br>
              Altura de trabajo: 26 m<br>
              Alcance horizontal: 15.8 m<br>
              Capacidad de carga: 230 kg
            </p>
            <p>
              <strong>Disponibilidad:</strong> Renta<br>
              <strong>Estado:</strong> Disponible
            </p>
            <a href="#" class="btn btn-primary btn-sm">Ver más detalles</a>
          </div>
        </div>
      </div>

      <!-- Tercera Card de ejemplo -->
      <div class="col-md-4">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ99SIU75IK3W-Cly5W__TdfmuErBUyndh5GOppiubkSbPNCxLbKMg_zwT-xHvpb8G5YZA&usqp=CAU" class="card-img-top" alt="Haulotte HA41PX">
          <div class="card-body">
            <h5 class="card-title">Haulotte HA41PX</h5>
            <p class="card-text">
              <strong>Ficha Técnica:</strong><br>
              Altura de trabajo: 40.5 m<br>
              Alcance horizontal: 20 m<br>
              Capacidad de carga: 450 kg
            </p>
            <p>
              <strong>Disponibilidad:</strong> Venta<br>
              <strong>Estado:</strong> Disponible
            </p>
            <a href="#" class="btn btn-primary btn-sm">Ver más detalles</a>
          </div>
        </div>
      </div>
    </div>
  </div>
        </div>
    </div>

	

@section('jscustom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye moment.js con locales -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
			$calendar = $('#calendar');
			$calendar.fullCalendar({
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'], 
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'], 
                locale: 'es', 
                header: {
                    left: 'prev,next today',
                    center: 'title',
                },
                selectable: true,
                selectHelper: true,
				events: [
				
                                {
                                    title: 'renta GENIE S-65',
                                    start: new Date(2024,11,5),
                                    allDay: true,
                                    className: 'fc-success'
                                },
                                {
                                    title: 'renta GENIE S-65',
                                    start: new Date(2024,11,8),
                                    allDay: true,
                                    className: 'fc-success'
                                },
                        
				],
			});
		});
</script>
@endsection
</x-app-layout>
