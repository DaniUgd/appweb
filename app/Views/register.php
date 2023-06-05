<script>
    base_url = "<?php echo base_url();?>";
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>VideoTrends</title>
    <meta charset="UTF-8">
    <meta name="description" content="Registro de Usuario">
    <meta name="author" content="Mirko Czajkowski">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS.'register.css' ?>">
    <link rel="icon" href="<?php echo BASEURL.'favicon.ico' ?>" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="<?php echo JS.'logic.js' ?>"></script>

</head>
<body>
    <header>
        <!-- <p><?php echo base_url();?></p> -->
        <h1>REGISTRO DE USUARIOS</h1>
    </header>

    <nav>
        <a href="index.html">Iniciar Sesión</a>
    </nav>

    <section id="section_principal">
    <section id="section_datos">
            <form id="form_reg" >
                <h4>Datos de Inicio de Sesión</h4>
                <div class="datos">
                    <div class="etiquetas">
                        <label for="nombre_usu">Nombre de Usuario*</label>
                        <br>
                        <label for="email">E-mail*</label>
                        <span id="email_error_1" class="Error"></span>
                        <br>
                        <label id="lbPass" for="pass">Contraseña*</label>
                        <br>
                        <label id="lbRePass" for="pass_rep">Repetir Contraseña*</label>
                        <!-- <span id="pass_error_1" class="Error"></span> -->
                    </div>
                    <div class="entradas">
                        <div class="tooltip">
                            <input type="text" id="nombre_usu" placeholder="Usuario" required>
                            <span class="tooltiptext">Ingresar Usuario</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <input type="email" id="email" placeholder="Direccion@email.com" >
                            <span class="tooltiptext">Ingresar E-mail</span>
                        </div>
                        <span id="email_error_2" class="Error"></span>
                        <br>
                        <div class="tooltip">
                            <input type="password" id="pass" placeholder="Contraseña" >
                            <span class="tooltiptext">Ingresar Contraseña</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <input type="password" id="pass_rep" placeholder="Contraseña" >
                            <span class="tooltiptext">Ingresar Contraseña nuevamente</span>
                        </div>
                        <!-- <span id="pass_error_2" class="Error"></span> -->
                    </div>
                </div>
                <h4>Datos Personales</h4>
                <div class="datos">
                    <div class="etiquetas">
                        <label for="nombre_per">Nombre</label>
                        <br>
                        <label for="apellido">Apellido</label>
                        <br>
                        <label for="direccion">Dirección</label>
                        <br>
                        <label>Género</label>
                        <br>
                        <label for="telefono">Número de Teléfono</label>
                        <br>
                        <label for="nacimiento">Fecha de Nacimiento</label>
                    </div>
                    <div class="entradas">
                        <div class="tooltip">
                            <input type="text" id="nombre_per" placeholder="Nombre" maxlength="60">
                            <span class="tooltiptext">Ingresar Nombre</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <input type="text" id="apellido" placeholder="Apellido" maxlength="60">
                            <span class="tooltiptext">Ingresar Apellido</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <input type="text" id="direccion" placeholder="Dirección">
                            <span class="tooltiptext">Ingresar Dirección</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <div>
                                <input type="radio" id="gen_masculino" name="genero" value="Masculino">
                                <label for="gen_masculino">Masculino</label>
                                <input type="radio" id="gen_femenino" name="genero" value="Femenino">
                                <label for="gen_femenino">Femenino</label>
                            </div>
                            <span class="tooltiptext">Ingresar Género</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <input type="tel" id="telefono" placeholder="">
                            <span class="tooltiptext">Ingresar Número de Teléfono</span>
                        </div>
                        <br>
                        <div class="tooltip">
                            <input type="date" id="nacimiento" placeholder="">
                            <span class="tooltiptext">Ingresar Fecha de Nacimiento</span>
                        </div>
                    </div>
                </div>
                <span id="ref" class="negrita">(*) Campos obligatorios</span>
                <button type="button" id="btn_crear" class="btn btn-primary"><span class="negrita">CREAR MI CUENTA</span></button>
            </form>
            <div id="resultado_consulta"></div>
        </section>
        <aside>
            <div id="aside_banner">
                <img src="<?php echo IMG.'banner_register.png' ?>" alt="Banner de Registrar Cuenta">
                <p>
                    Al hacer clic en "CREAR MI CUENTA", aceptas las <span class="negrita">Condiciones</span> 
                    y confirmas que leíste nuestra <span class="negrita">Política de Datos</span>, incluido 
                    el uso de cookies.
                </p>
            </div>
        </aside>
    </section>

    <footer>
        <a href="" target="_blank">Trakt API</a>
        <span> - </span>
        <a href="https://ugd.edu.ar/es/" target="_blank">U.G.D.</a>
        <span> - </span>
        <a href="https://campusvirtual.ugd.edu.ar/moodle/" target="_blank">Campus Virtual</a>
    </footer>
</body>
</html>