<!DOCTYPE html>
<html>
<head>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;

            font-family: Arial, sans-serif;
        }

        .background-img {
            position: absolute;
            top: 0px;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
        }

        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #000;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <?php
        $nombreImagen = url('') . "/images/Cursos/diploma.png";
        $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

        $nombreImagen_2 = url('') . "/assets/img/transmasivo.png";
        $imagenBase64_2 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen_2));
    ?>

    <img src="<?php echo $imagenBase64; ?>" alt="Background" class="background-img">

    <div class="content">
        <div class="text-overlay">
       
            <center>
                <h2>Reconocimiento a la perseverancia<br>_____________________________________</h2>
                <h5>Esta mención se concede a: </h5><h3 style="color: rgb(134,37,54);  text-decoration: underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Luis Enrique Camarena Serratos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><h5>como reconocimiento por completar el curso</h5><h4 style="color: rgb(134,37,54);  text-decoration: underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prueba del curso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                <p> <br><img src="<?php echo $imagenBase64_2; ?>" width="250px" style="position: 120px 0 0 120px ; "></p>
                </center>
            
        </div>
    </div>
</body>
</html>
