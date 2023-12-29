<script>
    base_url = "<?php echo base_url();?>";
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>VideoTrends</title>
    <meta charset="UTF-8">
    <meta name="description" content="Cuenta no válida">
    <meta name="author" content="Mirko Czajkowski">
    <meta http-equiv="refresh" content="1800">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS.'login.css' ?>">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script src="<?php echo JS.'logic.js' ?>"></script>
</head>
<body>
    <header>
        <div>
            <a href="<?php echo BASEURL?>">
                <img src="img/playicon.png" alt="Imagen título: logo play">
            </a>
            <a href="<?php echo BASEURL?>">
                <h1>VideoTrends</h1>
            </a>
        </div>
        <p>La <span class="negrita">biblioteca</span> de tus pelis!</p>
    </header>

    <section id="section_cuenta_no_valida">
        <p>¡Hola <?php echo $_COOKIE["cookie_usuario"];?>! Tu cuenta excedió el tiempo para su validación.</p>
        <p>Por favor, REENVIA el correo a la misma dirección para confirmarlo o CAMBIA de dirección.</p>
        <div id="opciones">
            <button id="btn_reenviar_correo">REENVIAR CORREO</button>
            <div id="reenvio_email">
                <input type="email" id="email_reenvio" name="email" placeholder="Direccion@email.com">
                <button id="btn_cambiar_correo">CAMBIAR CORREO</button>
            </div>
        </div>
    </section>

    <footer>
        <a href="https://trakt.docs.apiary.io/" target="_blank">Trakt API</a>
        <span> - </span>
        <a href="https://ugd.edu.ar/" target="_blank">U.G.D.</a>
        <span> - </span>
        <a href="https://campusvirtual.ugd.edu.ar/" target="_blank">Campus Virtual</a>
    </footer>
    
    <script>
        setEventClickReenviarCorreo();
        setEventClickCambiarCorreo();
    </script>

</body>
</html>