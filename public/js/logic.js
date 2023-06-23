$(document).ready(function(){

    console.log("Dentro");

    //Control registro usuario (no existencia del correo en base)
    $("#btn_crear").click(function(){
        console.log("VariablesNuevo");
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
        console.log(ing_usu);
        let ing_tel = $("#telefono").val();
        let ing_nac = $("#nacimiento").val();
        console.log(ing_pass);
        console.log("Antes Comparacion");

        if(ing_pass == ing_repass){
            console.log("Contraseñas iguales");
            $("#lbPass").css("color","black");
            $("#lbRePass").css("color","black");

            
            console.log("Antes Ajax");
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
                    }else{
                        $("#email_error_1").text("");
                        $("#email_error_2").text("");
                    }
                }
            })
        }, 500);
    });

});