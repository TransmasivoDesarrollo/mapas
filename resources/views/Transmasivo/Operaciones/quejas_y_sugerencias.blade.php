<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Quejas y Sugerencias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h2>Quejas y Sugerencias</h2>
            <input type="hidden" id="unidad" name="unidad" value="{{$unidad}}">
            <input type="hidden" id="carro" name="carro" value="{{$carro}}">
        
            <p>Nos importa tu opinión. Por favor, comparte tus quejas o sugerencias.</p>
        </div>
        <form  method="post" id="exampleValidation" action="{{url('/quejas_y_sugerencias_')}}{{$unidad}}_{{$carro}}">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre (Opcional)</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" >
            </div>

            <!-- Correo Electrónico -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico (Opcional)</label>
                <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo" >
            </div>

            <!-- Tipo de Mensaje -->
            <div class="mb-3">
                <label for="tipoMensaje" class="form-label">Tipo de Mensaje  <b style="color:red;">*</b></label>
                <select class="form-select" id="tipoMensaje" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="queja">Queja</option>
                    <option value="sugerencia">Sugerencia</option>
                </select>
            </div>

            <!-- Mensaje -->
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje <b style="color:red;">*</b></label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu queja o sugerencia aquí" required></textarea>
            </div>
            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies (Popper.js and Bootstrap's JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
