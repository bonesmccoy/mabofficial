var max_res_w = 1600;
var min_res_w = 1024;
var min_res_h = 768;

function activateStage() {
    scene = $('#scene').parallax();
    $("#counter").fadeOut("fast", function(){
        $("#container").fadeIn();
    });
    $(window).resize(function(){
        resizeScene()
    });
}


function resizeScene() {
	
    current_height = Math.max(window.innerHeight, min_res_h);

    current_width = Math.min(window.innerWidth, max_res_w);
    current_width = Math.max(current_width, min_res_w);

    $('#scene').height(current_height);
    $('#scene').width(current_width*2);
    $("#container").height(current_height);
    $("#container").width(current_width);

    scala = (current_width / max_res_w) ;
    console.log(scala, current_width, window.innerWidth);
    $(".moon").width(370*scala).height(519*scala);
    $(".boat").width(549*scala).height(351*scala);
    $(".cracken").width(413*scala).height(380*scala);


    $(".wave").height(157*scala);
    $(".wave.front").css("background-size", (790*scala) + "px");
    $(".wave.medium").css("background-size", (1048*scala) + "px");
    $(".wave.medium-back").css("background-size", (758*scala) + "px");
    $(".wave.far").css("background-size", (437*scala) + "px");
}
