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
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script src="<?php echo JS.'logic.js' ?>"></script>
</head>
<body>
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
        <a href="#">Nombre del Usuario</a>
    </nav>

    <aside>
        <a href="#">BUSCAR</a>
        <a href="#">RECOMENDADAS</a>
        <a href="#">MI BIBLIOTECA</a>
    </aside>

    <section id="section_principal">

        <section id="section_buscar" class="class_buscar">
            <p>BUSCAR</p>
        </section>

        <section id="section_recomendadas" class="class_recomendadas">
            <p>RECOMENDADAS</p>
        </section>

        <section id="section_biblioteca" class="class_biblioteca">
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