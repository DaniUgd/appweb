<script>
    base_url = "<?php echo base_url();?>";
    correo = "<?php echo $_COOKIE["cookie_usuario"];?>";
</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>VideoTrends</title>
        <meta charset="UTF-8">
        <meta name="description" content="Home Page VideoTrends">
        <meta name="author" content="Mirko Czajkowski">
        <meta http-equiv="refresh" content="1800">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="<?php echo CSS.'homepage.css' ?>">
        <script src="<?php echo JS.'logic.js' ?>"></script>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <header>
        <div>
            <a href="">
                <img src="img/playicon.png" alt="Imagen título: logo play">
            </a>
            <a href="">
                <h1>VideoTrends</h1>
            </a>
        </div>
        <p>La <span class="negrita">biblioteca</span> de tus pelis!</p>
    </header>

    <nav class="navbar" style="align-items=end;">
        <div class="ms-auto ml-auto">
            <i class="bi bi-gear"></i>
            <a id="NombreUsuario" href="#" data-bs-toggle="offcanvas" data-bs-target="#menuLateral"> <?php echo $_COOKIE["cookie_usuario"];?> </a>
        </div>
        <section class="offcanvas offcanvas-end bg-dark" id="menuLateral">
            <div class="offcanvas-header" data-bs-theme="dark">
                <h5 class="offcanvas-title text-info"> <?php echo $_COOKIE["cookie_usuario"];?> </h5>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul>
                    <li><a href="" data-bs-toggle="modal" data-bs-target="#modificarPerfilModal" onclick="cargarModificarDatos()">Modificar Perfil</a></li>
                    <li><a id="CerrarLaSesion" href="javascript:void(0);">Cerrar Sesión</a></li>
                </ul>
            </div>
        </section>
    </nav>

    <div class="modal fade" id="modificarPerfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Perfil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <h5>Datos de Inicio de Sesión</h5>
                <input type="text" id="home_nombre_usu" placeholder="Usuario" required>
                <label for="home_nombre_usu" class="negrita">Nombre de Usuario</label>
                <br>
                <input type="email" id="email" placeholder="Direccion@email.com" >
                <label for="email" class="negrita">E-mail</label>
                <span id="email_error_1" class="Error"></span>
                <span id="email_error_2" class="Error"></span>
                <br>
                <input type="password" id="home_pass" placeholder="Contraseña" >
                <label id="lbPass" for="home_pass" class="negrita">Contraseña</label>
                <br>
                <input type="password" id="home_pass_rep" placeholder="Contraseña" >
                <label id="lbRePass" for="home_pass_rep" class="negrita">Repetir Contraseña</label>
                <span id="pass_error_1" class="Error"></span>
                <br>
                <span class="negrita">Introducir contraseña solo si desea cambiarla</span>
                <br><br>

                <h5>Datos Personales</h5>
                <input type="text" id="home_nombre_per" placeholder="Nombre" maxlength="60">
                <label for="home_nombre_per" class="negrita">Nombre</label>
                <br>
                <input type="text" id="home_apellido" placeholder="Apellido" maxlength="60">
                <label for="home_apellido" class="negrita">Apellido</label>
                <br>
                <input type="text" id="home_direccion" placeholder="Dirección">
                <label for="home_direccion" class="negrita">Dirección</label>
                <br>
                <input type="radio" id="home_gen_masculino" name="genero" value="Masculino">
                <label for="home_gen_masculino">Masculino</label>
                <input type="radio" id="home_gen_femenino" name="genero" value="Femenino">
                <label for="home_gen_femenino">Femenino</label>
                <label class="negrita">Género</label>
                <br>
                <input type="tel" id="home_telefono" placeholder="">
                <label for="home_telefono" class="negrita">Número de Teléfono</label>
                <br>
                <input type="date" id="home_nacimiento" placeholder="Teléfono">
                <label for="home_nacimiento" class="negrita">Fecha de Nacimiento</label>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="btnGuardarCambios" type="button" class="btn btn-primary" onclick="guardarModificarDatos()">Guardar Cambios</button>
            </div>
            </div>
        </div>
    </div>
 
    <aside class="navbar navbar-expand-lg bg-body-tertiary bg-primary" data-bs-theme="dark">

        <div class="container-fluid collapse navbar-collapse" id="navbarNav">
        
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item me-4">
                    <a id="aBuscar" class="nav-link" aria-current="page" href="javascript:void(0);" onclick="display('buscar')">BUSCAR</a>
                </li>
                <li class="nav-item me-4">
                    <a id="aRecomendadas" class="nav-link" href="javascript:void(0);" onclick="display('recomendadas')">RECOMENDADAS</a>
                </li>
                <li class="nav-item ">
                    <a id="aBiblioteca" class="nav-link" href="javascript:void(0);" onclick="display('biblioteca')">MI BIBLIOTECA</a>
                </li>
            </ul>
        </div>
    </aside>
    
    <section id="section_principal">
        
        <div id="spinner" class="spinner-border text-primary mt-5 mx-auto" role="status" style="display: none;">
            <span class="visually-hidden">Loading...</span>
        </div>

        <section id="section_buscar" class="class_container">
            <p class="text-center fs-2 text-primary">BUSCAR UNA PELÍCULA</p>
            
            <div class="input-group mb-3 mt-4 w-75 mx-auto" id="search-bar">
                <button class="btn btn-outline-secondary dropdown-toggle" id="btn-categories" type="button" data-bs-toggle="dropdown" aria-expanded="false">Genero</button>
                <ul class="dropdown-menu container-categories">
                    <li><a class="dropdown-item category" href="#">action</a></li>
                    <li><a class="dropdown-item category" href="#">adventure</a></li>
                    <li><a class="dropdown-item category" href="#">anime</a></li>
                    <li><a class="dropdown-item category" href="#">comedy</a></li>
                    <li><a class="dropdown-item category" href="#">crime</a></li>
                    <li><a class="dropdown-item category" href="#">family</a></li>
                    <li><a class="dropdown-item category" href="#">fantasy</a></li>
                    <li><a class="dropdown-item category" href="#">thriller</a></li>
                    <li><a class="dropdown-item category" href="#">romance</a></li>
                    <li><a class="dropdown-item category" href="#">science-fiction</a></li>
                    <li><a class="dropdown-item category" href="#">superhero</a></li>
                </ul>
                <input type="text" class="form-control" id="input-find" aria-label="Text input with dropdown button">
                <button class="btn btn-outline-secondary" type="button" id="btn-find" aria-expanded="false">Buscar</button>
            </div>
            
            <div id="container-result-find" class="mb-5"> </div>
            
            
        </section>
        
        <section id="section_recomendadas" class="class_container">
            <p class="text-center fs-2 text-primary">PELICULAS RECOMENDADAS</p>
            <div id="container-recommended-movies" class="mb-5"> </div>
        </section>
        
        <section id="section_biblioteca" class="class_container">
            <p class="text-center fs-2 text-primary">MI BIBLIOTECA DE PELICULAS</p>

            <div id="container-library-movies" class="mb-5"> </div>
        </section>
        
    </section>
    
    <footer>
        <a href="https://trakt.docs.apiary.io/" target="_blank">Trakt API</a>
        <span> - </span>
        <a href="https://ugd.edu.ar/" target="_blank">U.G.D.</a>
        <span> - </span>
        <a href="https://campusvirtual.ugd.edu.ar/" target="_blank">Campus Virtual</a>
    </footer>

    <script>
        cargarRecommendedMovies();
        cargarMyLibrary();
        setEventToBtnFind();
        setEventClickCerrarSesion();
    </script>

</body>
</html>