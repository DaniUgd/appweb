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

    //MODIFICAR PERFIL
    $("#btnGuardarCambios").click(function(){
        console.log("btn_guardar_cambios");
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
console.log("hola3");

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


function setEventClickCerrarSesion(){
    
    let btnCerrarSesion = document.getElementById("CerrarLaSesion");
    btnCerrarSesion.addEventListener("click", () => {
        cerrarSesion();
    });
}

function cerrarSesion(){
    console.log("Axelisi");
    $.ajax({
        type: 'POST',
        url: base_url + 'home/cerrar_sesion',
        dataType: 'json',
        data:{},
        success: function(result){
            console.log("Redireccindo");
            window.location.href = base_url;
        }
    });
}

let hash_pass;
let correo_actual;

//Modificar datos del perfil
function cargarModificarDatos(){
    let dat_home_nombre_usu = document.getElementById("home_nombre_usu");
    let dat_home_email = document.getElementById("email");
    // let dat_home_pass = document.getElementById("home_pass");
    // let dat_home_pass_rep = document.getElementById("home_pass_rep");
    let dat_home_nombre_per = document.getElementById("home_nombre_per");
    let dat_home_apellido = document.getElementById("home_apellido");
    let dat_home_direccion = document.getElementById("home_direccion");
    let dat_home_gen_masculino = document.getElementById("home_gen_masculino");
    let dat_home_gen_femenino = document.getElementById("home_gen_femenino");
    let dat_home_telefono = document.getElementById("home_telefono");
    let dat_home_nacimiento = document.getElementById("home_nacimiento");

    $.ajax({
        type: 'GET',
        url: base_url + 'home/cargar_datos',
        dataType: 'json',
        data:{},
        success: function(res_usu){
            if(res_usu){
                console.log("Obtuvo");
                console.log(res_usu);

                dat_home_nombre_usu.value = res_usu[0].Usuario;
                dat_home_email.value = res_usu[0].Email;
                // dat_home_pass.value = res_usu[0].;
                // dat_home_pass_rep.value = res_usu[0].;
                dat_home_nombre_per.value = res_usu[0].Nombre;
                dat_home_apellido.value = res_usu[0].Apellido;
                dat_home_direccion.value = res_usu[0].Direccion;
                if(res_usu[0].Genero){
                    dat_home_gen_masculino.checked = true;
                }else{
                    dat_home_gen_femenino.checked = true;
                }
                dat_home_telefono.value = res_usu[0].Telefono;
                dat_home_nacimiento.value = res_usu[0].Nacimiento;
                
                correo_actual = res_usu[0].Email;
                hash_pass = res_usu[0].Contrasena;

            }else{
                console.log("No Obtuvo");
            }
        }
    });
}

let valid_email = true;

function guardarModificarDatos(){
    let nombre_usu = document.getElementById("home_nombre_usu").value;
    let email = document.getElementById("email").value;
    let pass = document.getElementById("home_pass").value;
    let pass_rep = document.getElementById("home_pass_rep").value;
    let nombre_per = document.getElementById("home_nombre_per").value;
    let apellido = document.getElementById("home_apellido").value;
    let direccion = document.getElementById("home_direccion").value;
    let gen_masculino = document.getElementById("home_gen_masculino").checked;
    let gen_femenino = document.getElementById("home_gen_femenino").checked;
    let telefono = document.getElementById("home_telefono").value;
    let nacimiento = document.getElementById("home_nacimiento").value;
    let ing_gen;
    if(gen_masculino){
        ing_gen = 1;
    }else{
        ing_gen = 0;
    }
    
    // console.log(hash_pass);
    // console.log(valid_email);
    // console.log(email);
    // console.log(correo_actual);
    console.log(gen_masculino);
    console.log(ing_gen);
    if(email == correo_actual){
        valid_email = true;
        email = null;
        console.log("Entra por email igual");
    }
    if(pass == pass_rep && valid_email && email!=""){
        console.log("Contraseñas iguales1");
        $("#lbPass").css("color","black");
        $("#lbRePass").css("color","black");
        $("#pass_error_1").text("");
        $("#pass_error_2").text("");
        
        if(pass == ""){
            pass = null;
        }

        //Obtener token para confirmacion de email
        let ing_token = generateToken(32);
        console.log(ing_token);
        
        console.log("Antes Ajax1");
        $.ajax({
            type: 'POST',
            url: base_url + 'home/guardar_datos',
            dataType: 'json',
            data:{
                usuario: nombre_usu,
                email: email,
                contrasena: pass,
                nombre: nombre_per,
                apellido: apellido,
                direccion: direccion,
                genero: ing_gen,
                telefono: telefono,
                nacimiento: nacimiento,
                token: ing_token
            },
            success: function(dato){
                if(dato){
                    console.log(dato);
                }else{
                    //INFORMAR ERROR que no se pudo modificar el perfil
                    console.log("Error en actualizar perfil")
                }
            }
        })
    }else{
        if(!valid_email){
            //INFORMAR ERROR mail no válido
            console.log("Error: Usuario ya registrado");
        }else if(email==""){
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
}

//Consultas de peliculas al servidor

//document.getElementById("aBuscar").addEventListener("click", cargarRecommendedMovies());

function cargarRecommendedMovies(){

    //const spinner = document.getElementById('spinner');
    //spinner.style.display = 'block';
    let containerRecommended = document.getElementById("container-recommended-movies");

    fetch(base_url + "home/consult_recomendadas", {
        method: 'GET',
    })

    .then(res => res.json())
    .then(async result => {

        //const moviePromises = result.data.map(async result => console.log(await getCommentsMovie(result.movie.ids.trakt)));
        
        const moviePromises = result.data.map(async result => itemMovie(result.movie, await getCommentsMovie(result.movie.ids.trakt)));
        const movies = await Promise.all(moviePromises);
        
        const fragmento = document.createDocumentFragment();
        movies.forEach(movie => {
            movie.querySelector('#btn-addMovie').addEventListener('click', () => addMylibraryEventClick(movie.getAttribute("key")));
            fragmento.appendChild(movie);
        });
        containerRecommended.appendChild(fragmento);
        //spinner.style.display = 'none';

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

//Busqueda de peliculas por nombre o por genero

function setEventToBtnFind(){

    let btnFind = document.getElementById("btn-find");
    let inputFind = document.getElementById("input-find");
    let containerResultFind = document.getElementById('container-result-find');

    //Buscamos todo los elementos de dom que se encuentren dentro de un elemento padre con clase .container-categories y la clase .category en el hijo:
    let btnFindByCategory = document.querySelectorAll(".container-categories .category");
    
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
            //spinner.style.display = 'none';

    });


    let btnCategories = document.querySelector("#search-bar #btn-categories");

    btnFindByCategory.forEach((btn,i)=>{
        
        btn.addEventListener('click', async ()=>{

            btnCategories.innerText = btn.innerText;
            let result = await consult_peliculaCATEGORIA(btn.innerText);

            const moviePromises = result.map(async movie => itemMovie(movie, await getCommentsMovie(movie.ids.trakt)));
            //Una vez finalizado la peticion asincrona se retorna una lista de componentes itemMovie:
            const movies = await Promise.all(moviePromises);

            //Nota:
            //A continuacion : Creamos un documentfragment para anadir todo los item movie en ese compoente para luego añadir
            //ese componente al dom, de este modo no se añade de a uno cada componente(lo que significaria recalcular todos los componentes del dom 
            //por cada item movie que se añada), de este modo solo se añde un componete al dom que contendra la lista de movie:

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
            //spinner.style.display = 'none';

        });

    });


}

function findMovie(name){

    //const spinner = document.getElementById('spinner');
    ///spinner.style.display = 'block';

    return new Promise((resolve, reject) => {
        //base_url +"home/consult_comentarioID?idMovie="+ id,
        fetch(base_url +"home/consult_peliculaNAME?movie="+ name, {
            method: 'GET',
        })
        .then(res => res.json())
        .then(result => resolve(result.data))
        .catch(err => reject(err));

    });
} 

function consult_peliculaCATEGORIA(genre){

    //const spinner = document.getElementById('spinner');
    //spinner.style.display = 'block';

    return new Promise((resolve, reject) => {

        fetch(base_url + "home/consult_peliculaCATEGORIA?genre="+genre, {
            method: 'GET',
        })
        .then(res => res.json())
        .then(result => resolve(result.data))
        .catch(err => reject(err));

    });

}

function addMylibraryEventClick(idMovie){

    fetch( base_url + 'home/insert_pelicula', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({'idMovie' : idMovie}) 
    })

    .then(res => res.json())
    .then(data => {

        if(data.stateResult){

            let itemMovie = document.querySelector('#item-movie[key="'+idMovie+'"]');

            let itemMovieCopy = itemMovie.cloneNode(true);

            setMovieInMyLibrary(itemMovieCopy);

            btnAddMovieOrigin =  itemMovie.querySelector('#btn-addMovie');
            btnAddMovieOrigin.classList.remove("link-success");
            btnAddMovieOrigin.classList.add("link-secondary");

        }

    })
    .catch(err => {alert(err);});

}

function setMovieInMyLibrary(itemMovieCopy){

    let btnAddMovie = itemMovieCopy.querySelector('#btn-addMovie')

    btnAddMovie.removeEventListener('click',  () => addMylibraryEventClick(movie.ids.trakt));//TODO: no esta removiendo el evento
    btnAddMovie.textContent = "Eliminar de Biblioteca"
    btnAddMovie.style.color = 'red';

    btnAddMovie.addEventListener('click', () => removeMovieFromLibraryEventClick(itemMovieCopy));
    let containerLibrary = document.getElementById("container-library-movies");
    containerLibrary.appendChild(itemMovieCopy);
     
}

function cargarMyLibrary(){
    fetch(base_url +'home/select_pelicula', {
        method: 'GET',
    })

    .then(res => res.json())
    .then( async result => {

        if(result.stateResult){

                const moviePromises = result.data.map(async movie => itemMovie(movie , await getCommentsMovie(movie.ids.trakt)));
                const movies = await Promise.all(moviePromises);

                const fragmento = document.createDocumentFragment();

                movies.forEach(movie => {

                    setMovieInMyLibrary(movie);
    
                }); 
        } 
    })
    .catch(err => console.log("No se encuentran peliculas en la biblioteca."));
}

function removeMovieFromLibraryEventClick(itemMovie){
    
    fetch(base_url +"home/delete_pelicula?idMovie=" + itemMovie.getAttribute("key"), {
        method: 'DELETE',
    })

    .then(res => res.json())
    .then(result => {

        if(result.stateResult){
            itemMovie.remove();
            console.log("Eliminado con exito");
        } 
    })
    .catch(err => console.log("No se ha podio eliminar la pelicula de la biblioteca. Error: "+err));
}

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
