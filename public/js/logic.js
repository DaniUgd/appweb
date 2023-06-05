$(document).ready(function(){

    console.log("Dentro");

    $("#btn_crear").click(function(){
        console.log("Variables");
        let ing_usu = $("#nombre_usu").val();
        let ing_email = $("#email").val();
        let ing_pass = $("#pass").val();
        let ing_repass = $("#pass_rep").val();
        let ing_nom = $("#nombre_per").val();
        let ing_ape = $("#apellido").val();
        let ing_dir = $("#direccion").val();
        let ing_gen;
        let ing_gen_m = $("#gen_masculino").val();
        let ing_gen_f = $("#gen_femenino").val();
        let ing_tel = $("#telefono").val();
        let ing_nac = $("#nacimiento").val();

        if(ing_pass == ing_repass){
            console.log("Contraseñas iguales");
            $("#lbPass").css("color","black");
            $("#lbRePass").css("color","black");

            if(ing_gen_m){
                ing_gen = 1;
            }else if(ing_gen_f){
                ing_gen = 0;
            }
            console.log("Antes Ajax");
            console.log(base_url);
            $.ajax({
                type: 'POST',
                url: base_url + 'home/insert_usuario',
                dataType: 'json',
                data:{
                    usuario: ing_usu,
                    email: ing_email,
                    contrasena: ing_pass,
                    nombre: ing_nom,
                    apellido: ing_ape,
                    direccion: ing_dir,
                    genero: ing_gen,
                    telefono: ing_tel,
                    nacimiento: ing_nac
                },
                success: function(dato){
                    console.log(dato);
                    // let resultado = JSON.stringify(dato);
                    // $("#resultado_consulta").text(resultado);
                }
            })

        }else{
            console.log("Error: Contraseñas distintas");
            $("#lbPass").css("color","red");
            $("#lbRePass").css("color","red");
        }

    });

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
                    }else{
                        $("#email_error_1").text("");
                        $("#email_error_2").text("");
                    }
                }
            })
        }, 500);
    });

});