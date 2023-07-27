<!DOCTYPE html>
<html>
<head>
    <title>Correo de Confirmación de Correo Electrónico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css%22%3E">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h4 class="card-title">¡HOLA <?=$Nombre?> <?=$Apellido?>! Bienvenido a VideoTrends</h4>
                <p class="card-text">Has creado tu cuenta, ahora solo queda un paso más.</p>
                <p class="card-text">Por favor valida tu correo electrónico presionando el siguiente enlace: <a href="<?=$linkValidCuenta?>">VALIDAR CORREO</a></p>
                <p class="card-text">El enlace tiene un período de validez de 1 mes.</p>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js%22%3E"></script>
</body>
</html>