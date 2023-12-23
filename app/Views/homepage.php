<script>
    base_url = "<?php echo base_url();?>";
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
        <link rel="stylesheet" type="text/css" href="<?php echo CSS.'homepage.css' ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
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
    
    <nav>
        <!-- Agregar tuerquita de configuración -->
        <a id="NombreUsuario" href="#"><script>cookie_usuario</script></a>
    </nav>
    
    <aside>
        <a id="aBuscar" href="javascript:void(0);" onclick="display('buscar')">BUSCAR</a>
        <a id="aRecomendadas" href="javascript:void(0);" onclick="display('recomendadas')">RECOMENDADAS</a>
        <a id="aBiblioteca" href="javascript:void(0);" onclick="display('biblioteca')">MI BIBLIOTECA</a>
    </aside>
    
    <section id="section_principal">
        
        <section id="section_buscar" class="class_container">
            <p>BUSCAR</p>
            
            <div class="input-group mb-3 mt-4 w-75 mx-auto" id="search-bar">
                <button class="btn btn-outline-secondary dropdown-toggle" id="btn-categories" type="button" data-bs-toggle="dropdown" aria-expanded="false">Genero</button>
                <ul class="dropdown-menu container-categories">
                    <li><a class="dropdown-item category" href="#">Acción</a></li>
                    <li><a class="dropdown-item category" href="#">Anime</a></li>
                    <li><a class="dropdown-item category" href="#">Ciencia-Ficción</a></li>
                    <li><a class="dropdown-item category" href="#">Fantasía</a></li>
                    <li><a class="dropdown-item category" href="#">Crimen</a></li>
                    <li><a class="dropdown-item category" href="#">Thriller</a></li>
                    <li><a class="dropdown-item category" href="#">Superhéroes</a></li>
                    <li><a class="dropdown-item category" href="#">Aventura</a></li>
                    <li><a class="dropdown-item category" href="#">Familia</a></li>
                    <li><a class="dropdown-item category" href="#">Comedia</a></li>
                </ul>
                <input type="text" class="form-control" id="input-find" aria-label="Text input with dropdown button">
                <button class="btn btn-outline-secondary" type="button" id="btn-find" aria-expanded="false">Buscar</button>
            </div>
            
            <div id="container-result-find" class="mb-5"> </div>
            
            
        </section>
        
        <section id="section_recomendadas" class="visually-hidden class_container">
            <p>RECOMENDADAS</p>
        </section>
        
        <section id="section_biblioteca" class="visually-hidden class_container">
            <p>BIBLIOTECA</p>
        </section>
        
    </section>
    
    <footer>
        <a href="https://trakt.docs.apiary.io/" target="_blank">Trakt API</a>
        <span> - </span>
        <a href="https://ugd.edu.ar/" target="_blank">U.G.D.</a>
        <span> - </span>
        <a href="https://campusvirtual.ugd.edu.ar/" target="_blank">Campus Virtual</a>
    </footer>
</body>
</html>