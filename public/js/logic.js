$(document).ready(function(){

    console.log("Dentro");

    $("#btn_crear").click(function(){
        let ing_usu = $("#nombre_usu").val();
        let ing_email = $("#email").val();
        let ing_pass = $("#pass").val();
        let ing_repass = $("#pass_rep").val();
        let ing_nom = $("#nombre_per").val();
        let ing_ape = $("#apellido").val();
        let ing_dir = $("#direccion").val();
        let ing_gen_m = $("#gen_masculino").val();
        let ing_gen_f = $("#gen_femenino").val();
        let ing_tel = $("#telefono").val();
        let ing_nac = $("#nacimiento").val();

        $.ajax({
            type: 'POST',
            url: base_url + 'register/test',
            dataType: 'json',
            data:{
                usuario: ing_usu
            },
            success: function(dato){
                console.log(dato);
                
            }
        })

    });

});