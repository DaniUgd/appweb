$(document).ready(function(){

    let valid_email = true;

    //Control registro usuario (no existencia del correo en base)
    $("#btn_crear").click(function(){
        // console.log("VariablesNuevo1");
        let ing_usu = $("#nombre_usu").val();
        let ing_email = $("#email").val();
        let ing_pass = $("#pass").val();
        let ing_repass = $("#pass_rep").val();
        let ing_nom = $("#nombre_per").val();
        let ing_ape = $("#apellido").val();
        let ing_dir = $("#direccion").val();
        let ing_gen;
        if($("#gen_masculino").val()){
            ing_gen = 1;
        }else if($("#gen_femenino").val()){
            ing_gen = 0;
        }
        let ing_tel = $("#telefono").val();
        let ing_nac = $("#nacimiento").val();

        if(ing_pass == ing_repass && valid_email && ing_email!=""){
            console.log("Contraseñas iguales1");
            $("#lbPass").css("color","black");
            $("#lbRePass").css("color","black");
            $("#pass_error_1").text("");
            $("#pass_error_2").text("");

            //Obtener token para confirmacion de email
            let ing_token = generateToken(32);
            console.log(ing_token);
            
            console.log("Antes Ajax");
            $.ajax({
                type: 'POST',
                url: base_url + 'home/insert_usuario',
                dataType: 'json',
                data:{
                    usuario: ing_usu,
                    email: ing_email,
                    contrasena: ing_pass,
                    re_contrasena: ing_repass,
                    nombre: ing_nom,
                    apellido: ing_ape,
                    direccion: ing_dir,
                    genero: ing_gen,
                    telefono: ing_tel,
                    nacimiento: ing_nac,
                    token: ing_token
                },
                success: function(dato){
                    if(dato){
                        console.log(dato);
                        window.location.href = base_url;
                    }else{
                        //INFORMAR ERROR que no se pudo crear la cuenta
                    }
                }
            })

        }else{
            if(!valid_email){
                //INFORMAR ERROR mail no válido
                console.log("Error: Usuario ya registrado");
            }else if(ing_email==""){
                //INFORMAR ERROR falta ingresar usuario
                console.log("Error: Ingrese un usuario");
                }else{
                    console.log("Error: Contraseñas distintas");
                    $("#lbPass").css("color","red");
                    $("#lbRePass").css("color","red");
                    $("#pass_error_1").text("ERROR:");
                    $("#pass_error_2").text("Contraseñas ingresadas distintas.");
                }
            }

    });

    //Control existencia email cuando se completa el campo
    let timer;
    $("#email").on("input",function(){
        clearTimeout(timer);
        timer = setTimeout(function() {
            let ing_email = $("#email").val();
            console.log(ing_email);

            $.ajax({
                type: 'POST',
                url: base_url + 'home/validar_email',
                dataType: 'json',
                data:{
                    email: ing_email
                },
                success: function(dato){
                    if(dato){
                        $("#email_error_1").text("ERROR:");
                        $("#email_error_2").text("Ya está registrado el email ingresado.");
                        valid_email = false;
                    }else{
                        $("#email_error_1").text("");
                        $("#email_error_2").text("");
                        valid_email = true;
                    }
                }
            })
        }, 500);
    });


    //INICIO DE SESIÓN
    $("#btn_ini_ses").click(function(){
        console.log("Inicio_Ses");
        let ses_email = $("#email_login").val();
        let ses_pass = $("#pass_login").val();
        console.log("Hola3");

        $.ajax({
            type: 'POST',
            url: base_url + 'home/iniciar_sesion',
            dataType: 'json',
            data:{
                email: ses_email,
                contrasena: ses_pass
            },
            success: function(dato){
                console.log(dato);
                if(dato){
                    // console.log(dato);
                    $("#txt_error_inicio_sesion").text("");
                    window.location.href = base_url + "homepage";
                }else{
                    $("#txt_error_inicio_sesion").text("E-mail y/o Contraseña incorrectos");
                    $("#txt_error_inicio_sesion").css("color","red");
                }
            }
        })
    });

    //CUENTA NO VALIDA
    $("#btn_reenviar_correo").click(function(){
        console.log("btn_reenviar_correo");
    });

    $("#btn_cambiar_correo").click(function(){
        console.log("btn_cambiar_correo");
        let nuevo_mail = $("#email_reenvio").val();
    });


});

function generateToken(length) {
    var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var token = '';
    for (var i = 0; i < length; i++) {
      token += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return token;
}


//HOMEPAGE
console.log("hola2");
galletitas();
let cookie_usuario;
// let nameUser = document.getElementById("NombreUsuario");

function galletitas(){
    
    cookie_usuario = obtenerCookie("cookie_usuario");
    console.log(cookie_usuario);
    
    // nameUser.textContent = cookie_usuario;
    // console.log(nameUser);

    function obtenerCookie(nombre) {
        // Crea una expresión regular para buscar el nombre de la cookie seguido por el valor
        var nombreEQ = nombre + "=";
        // Divide la cadena de cookies en partes usando el caracter ";"
        var cookies = document.cookie.split(';');
        
        // Itera sobre cada cookie para encontrar la que contiene el nombre buscado
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            // Elimina espacios en blanco al principio de la cookie
            while (cookie.charAt(0) == ' ') {
                cookie = cookie.substring(1, cookie.length);
            }
            // Si la cookie comienza con el nombre buscado, devuelve el valor de la cookie
            if (cookie.indexOf(nombreEQ) == 0) {
                return decodeURIComponent(cookie.substring(nombreEQ.length, cookie.length));
            }
        }
        // Si no se encuentra la cookie, devuelve null
        return null;
    }

}

function display(id){
    
    let div_buscar = document.getElementById("section_buscar");
    let div_recomendadas = document.querySelector("#section_recomendadas");
    let div_biblioteca = document.querySelector("#section_biblioteca");

    switch(id){
        case 'buscar':
            div_buscar.style.display = 'block';
            div_recomendadas.style.display = 'none';
            div_biblioteca.style.display = 'none';
            break;
        case 'recomendadas':
            div_buscar.style.display = 'none';
            div_recomendadas.style.display = 'block';
            div_biblioteca.style.display = 'none';
            ;break;
        case 'biblioteca':
            div_buscar.style.display = 'none';
            div_recomendadas.style.display = 'none';
            div_biblioteca.style.display = 'block';
            ;break;
    }

}

//Consultas de peliculas al servidor


//document.getElementById("aBuscar").addEventListener("click", cargarRecommendedMovies());

//cargarRecommendedMovies();

function cargarRecommendedMovies(){

    //TODO: ver si definimos la animacion de carga mientras se espera la respuesta:

    //const spinner = document.getElementById('spinner');
    //spinner.style.display = 'block';

    fetch(base_url + "home/consult_recomendadas", {
        method: 'GET',
    })

    .then(res => res.json())
    .then(async result => {

        console.log(result);
        const moviePromises = result.data.map(async result => console.log(await getCommentsMovie(result.movie.ids.trakt)));

        /*
        const moviePromises = result.data.map(async result => itemMovie(result.movie, await getCommentsMovie(result.movie.ids.trakt)));
        const movies = await Promise.all(moviePromises);
        
        const fragmento = document.createDocumentFragment();
        movies.forEach(movie => {
            movie.querySelector('#btn-addMovie').addEventListener('click', () => addMylibraryEventClick(movie.getAttribute("key")));
            fragmento.appendChild(movie);
        });
        containerRecommended.appendChild(fragmento);
        spinner.style.display = 'none';*/

    })
    .catch(err => console.log(err));
}

function getCommentsMovie(id) {

    return new Promise((resolve, reject) => {

        fetch(base_url +"home/consult_comentarioID?idMovie="+ id, {
            method: 'GET',
        })
        .then(res => res.json())
        .then(result => resolve(result.data))
        .catch(err => reject(err));
    });
}

//------- Busqueda de peliculas por nombre o por genero:


function setEventToBtnFind(){

    let btnFind = document.getElementById("btn-find");
    let inputFind = document.getElementById("input-find");
    let containerResultFind = document.getElementById('container-result-find');

    let btnFindByCategory = document.querySelectorAll(".container-categories .category");
    
    console.log(btnFindByCategory)
    btnFind.addEventListener("click", async ()=>{
            
            let result = await findMovie(inputFind.value);

            const moviePromises = result.map(async result => itemMovie(result.movie, await getCommentsMovie(result.movie.ids.trakt)));
            const movies = await Promise.all(moviePromises);

            const fragmento = document.createDocumentFragment();
            movies.forEach(movie => {
                movie.querySelector('#btn-addMovie').addEventListener('click', () => addMylibraryEventClick(movie.getAttribute("key")));
                fragmento.appendChild(movie);
            });

            const children = Array.from(containerResultFind.children);
            for (let i = 0; i < children.length; i++) {
                children[i].remove();
            }
            containerResultFind.appendChild(fragmento);
            spinner.style.display = 'none';

    });


    let btnCategories = document.querySelector("#search-bar #btn-categories");
    console.log(btnCategories.innerText);

    btnFindByCategory.forEach((btn,i)=>{
        
        btn.addEventListener('click', async ()=>{

            btnCategories.innerText = btn.innerText;

            let result = await findMovieByGenre(btn.innerText);
            
            //console.log(result.map(console.log("hola")));

            const moviePromises = result.map(async movie =>itemMovie(movie, await getCommentsMovie(movie.ids.trakt)));
            const movies = await Promise.all(moviePromises);

            //console.log("-->"+movies);
            const fragmento = document.createDocumentFragment();
            movies.forEach(movie => {
                //console.log('-->'+movie);
                movie.querySelector('#btn-addMovie').addEventListener('click', () => addMylibraryEventClick(movie.getAttribute("key")));
                fragmento.appendChild(movie);
            });

            const children = Array.from(containerResultFind.children);
            for (let i = 0; i < children.length; i++) {
                children[i].remove();
            }
            containerResultFind.appendChild(fragmento);
            spinner.style.display = 'none';

        });

    });


}
/*
function findMovie(name){

    const spinner = document.getElementById('spinner');
    spinner.style.display = 'block';

    return new Promise((resolve, reject) => {

        fetch('<?= BASE_URL.'api/1.0/user/findMovie?movie=' ?>'+name, {
            method: 'GET',
        })
        .then(res => res.json())
        .then(result => resolve(result.data))
        .catch(err => reject(err));

    });
} 

function findMovieByGenre(genre){

    const spinner = document.getElementById('spinner');
    spinner.style.display = 'block';

    return new Promise((resolve, reject) => {

        fetch('<?= BASE_URL.'api/1.0/user/findMovieByCategory?genre=' ?>'+genre, {
            method: 'GET',
        })
        .then(res => res.json())
        .then(result => resolve(result.data))
        .catch(err => reject(err));

    });

}
*/





function itemMovie(movie , comentarios){
        
    let genero = '';

    if(movie.genres){
        movie.genres.forEach((genere , i)=>{
            genero += " "+genere+" ";
        });
    }
    
    let comentariosHTML="";

    comentarios.forEach((comentario , i)=>{

    const fecha = comentario.created_at;
    const fechaObjeto = new Date(fecha);
    const dia = fechaObjeto.getDate();
    const mes = fechaObjeto.getMonth() + 1; 
    const anio = fechaObjeto.getFullYear();

    comentariosHTML+=`
        <div class="comentario">
            <span class="usuario">${comentario.user.name}</span>
            <span class="fecha mx-2">${dia}-${mes}-${anio}</span>
            <p class="contenido">${comentario.comment}</p>
        </div>
        <hr>\n
        `;
                
    });
    
   let movieHTML = `
        <div class="mt-3 mx-sm-0 me-sm-0 mx-md-5 me-md-5 mb-2 border" id="item-movie" key = "${movie.ids.trakt}">
            
            <div class="row">
                <div class="col mt-4 text-center">
                    <p class="h6">${movie.title}</p>
                    <p class="h6 mx-2">${movie.year}</p>
                </div>

                <div class="col mt-4 text-center">
                    <p class="h6 mx-2">Genero:</p>
                    <p class="h6">[ ${genero} ]</p>
                </div>

                <div class="col mt-4 text-center">
                    <p class="h6">Clasificacion:</p>
                    <p class="h6">${movie.certification}</p>
                </div>

                <div class="col mt-4 text-center">
                    <p class="h6">Rating:</p>
                    <p class="h6 me-2">⭐${movie.rating}</p>
                </div>
            </div>

            <hr>

            <div class="row flex-column flex-sm-row">
                
                <div class="col text-center" id="container-btn-addMovie">
                    <p><a href="#" class="link-success h6" id='btn-addMovie' style="text-decoration: none;">Añadir a biblioteca ✚</a></p>
                </div>

                <div class="col text-center">
                        
                    <div class="accordion text-center" id="accordion">

                        <div class="accordion-item border border-0">
                            <h6 class="accordion-header">
                                <a class="mt-0 mb-2 link-secondary btn-outline-light " style="text-decoration: none;" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne${movie.ids.trakt}" aria-expanded="true" aria-controls="collapseOne${movie.ids.trakt}">
                                    Comentarios ⯯
                                </a>
                            </h6>

                            <div id="collapseOne${movie.ids.trakt}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                <div class="accordion-body" id="container-comentarios">
                                
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div> `;



   let contenedor = document.createElement('div');
   contenedor.innerHTML = movieHTML;
   let itemMovie = contenedor.firstElementChild;
   itemMovie.querySelector('#container-comentarios').innerHTML += comentariosHTML;

   return itemMovie;

}




