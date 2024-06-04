<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transmasivo</title>
<meta http-equiv="refresh" content="300"> <!-- Opción 1: Recargar usando meta tag -->
<style type="text/css">
    
    .banner-content {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        color: #FFF;
        background-color: rgba(0, 0, 0, 0);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .banner-content h1 {
        margin: 0;
        padding: 0;
        padding-bottom: 30px;
        font-size: 40px;
        text-align: center;
    }

    @keyframes banner {
        @php 
          $segundos = 0;
        @endphp
          @foreach($images as $image)
          
            @php $segundos = $segundos + $image->pantalla ; @endphp
          @endforeach

        @php 
          $count = 0;
          $primer = 1;
          
        @endphp
        @foreach($images as $image)
            @if($primer == 1)
                0% {
                background-image: url('images/Operaciones/{{$image->imagen}}');
                }
                @php $primer = 2; @endphp
            @else
            
            @php $count2 = 100*$image->pantalla / $segundos @endphp
            
            @php $count = $count + $count2; @endphp
                {{$count}}% {
                background-image: url('images/Operaciones/{{$image->imagen}}');
                }
            @endif
        @endforeach
    }
    
    .banner {
        position: relative;
        width: 100%;
        height: calc(95vh - 0px);
        background-color: #F5F5F5;
        background-size: contain; /* Cambiado de cover a contain */
        background-position: center;
        background-repeat: no-repeat; /* Para evitar que la imagen se repita */
        animation: banner  {{$segundos}}s infinite steps(1);
    }

</style>
</head>
<body>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <section class="banner">
          <div class="banner-content">
            
       
          </div>
        </section>
      </div>
    </div>
  </div>
</div>

<!-- Opción 2: Recargar usando JavaScript -->
<script type="text/javascript">
  setTimeout(function() {
    window.location.reload();
  },  {{$segundos}}000); // 300000 milisegundos = 5 minutos
</script>

</body>
</html>
