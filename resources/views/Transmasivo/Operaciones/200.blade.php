<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transmasivo</title>
<meta http-equiv="refresh" content="300"> <!-- Opción 1: Recargar usando meta tag -->
<style type="text/css">
  html{
    background-color:black;
  }
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

    .banner {
        position: relative;
        width: 100%;
        height: calc(95vh - 0px);
        background-color: black;
        background-size: contain; /* Cambiado de cover a contain */
        background-position: center;
        background-repeat: no-repeat; /* Para evitar que la imagen se repita */
    }

    #videoPlayer {
        width: 100%;
        height: calc(95vh - 0px);
    }

    #startButton {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px 20px;
        font-size: 20px;
        cursor: pointer;
        z-index: 10;
    }
</style>
</head>
<body>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <section class="banner" id="banner">
          <div class="banner-content" id="bannerContent">
            <!-- Contenido dinámico se insertará aquí -->
          </div>
        </section>
        <video id="videoPlayer" muted style="display:none;">
          <source id="videoSource" src="" type="video/mp4">
          Tu navegador no soporta la reproducción de videos.
        </video>
        <button id="startButton">Iniciar Presentación</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
      @php $segundos=0; @endphp
    const content = [
        @foreach($images as $image)
        @if(substr($image->imagen, -4) === '.mp4')
        @php $segundos= $segundos + $image->pantalla ; @endphp
        { type: 'video', src: 'images/Operaciones/{{$image->imagen}}', duration: {{$image->pantalla * 1000}} },
        @else
        
        @php $segundos= $segundos + $image->pantalla ; @endphp
        { type: 'image', src: 'images/Operaciones/{{$image->imagen}}', duration: {{$image->pantalla * 1000}} },
        @endif
        @endforeach
    ];

    let currentIndex = 0;
    const banner = document.getElementById('banner');
    const videoPlayer = document.getElementById('videoPlayer');
    const videoSource = document.getElementById('videoSource');
    const startButton = document.getElementById('startButton');

    function showContent() {
        const item = content[currentIndex];
        if (item.type === 'image') {
            banner.style.backgroundImage = `url(${item.src})`;
            banner.style.display = 'block';
            videoPlayer.style.display = 'none';
        } else if (item.type === 'video') {
            videoSource.src = item.src;
            banner.style.display = 'none';
            videoPlayer.style.display = 'block';
            videoPlayer.load();
              videoPlayer.play().catch(error => {
                console.error('Error playing video:', error);
            });
           
        }
        setTimeout(nextContent, item.duration);
    }

    videoPlayer.onended = function() {
        nextContent();
    };

    function nextContent() {
        currentIndex = (currentIndex + 1) % content.length;
        showContent();
    }

    startButton.addEventListener('click', () => {
        startButton.style.display = 'none';
        showContent();
    });

    window.onload = () => {
      
        startButton.style.display = 'block';
        startButton.click();
    };
    
    setTimeout(function() {
    window.location.reload();
  },  {{$segundos}}000);
</script>

</body>
</html>
