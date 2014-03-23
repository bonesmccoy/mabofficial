var res_graphic = 1600;
var min_res_w = 800;
var min_res_h = 600;

function activateStage() {

    scene = $('#scene').parallax();
    $("#loader").fadeOut(500, function(){
        $("#container").fadeIn(3000);
    });
    $(window).resize(function(){
        resizeScene()
    });
}


function resizeScene() {
	
    console.log($(window).width());


    current_width = Math.max($(window).width() , min_res_w);
    current_height = Math.max($(window).height() , min_res_h);

    //$('#scene').height(current_height);
    //$('#scene').width(current_width*2);
    //$("#container").height(current_height);
    //$("#container").width(current_width);

    scala = (current_width / res_graphic) ;
    console.log(scala);

    $(".stars.stars_background").css("background-size", (320*scala) + "px");
    $(".stars.back").css("background-size", (1406*scala) + "px");
    $(".stars.middle").css("background-size", (1083*scala) + "px");
    $(".stars.front").css("background-size", (1145*scala) + "px");
    $(".moon").width(310*scala).height(334*scala);
    $(".boat").width(458*scala).height(270*scala);
    $(".tentacle").width(160*scala).height(188*scala);
    $(".tentacle-big").width(198*scala).height(272*scala);


    $(".wave").height(200*scala);
    $(".wave.front").css("background-size", (632*scala) + "px");
    $(".wave.medium").css("background-size", (838*scala) + "px");
    $(".wave.medium-back").css("background-size", (606*scala) + "px");
    $(".wave.far").css("background-size", (92*scala) + "px");
}
