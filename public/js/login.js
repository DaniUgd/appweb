$(document).ready(function(){
    var band = true;
    $("#img_cinema").click(function(){

        if(band){
            $(this).fadeOut(333, function() {
                $(this).attr("src", "img/cinema2.png").fadeIn(333);
                band = false;
            });
        }else{
            $(this).fadeOut(333, function() {
                $(this).attr("src", "img/cinema.png").fadeIn(333);
                band = true;
            });
        }
    })

});