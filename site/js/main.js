var max_res_w = 1600;
var min_res_w = 1024;
var min_res_h = 768;

function activateStage() {

    scene = $('#scene').parallax();
    $("#loader").fadeOut(500, function(){
        $("#container").fadeIn(3000);
    });
    $(window).resize(function(){
        resizeScene()
    });

    $("#mail").click(function(){
        $c_container = $("#contact-form-container");

        $c_container.css({
            width: 0,
            height: 0,
            opacity: 0
        }).show();

        $c_container.stop().animate({
            width: 600,
            height: 400,
            "marginLeft":  -300,
            "marginTop":  -200,
            opacity: 1
        }, 500, 'linear', function(){
            $("#contact-form").fadeIn();
        })

        
    })

    $("#contact-form #close-btn").click(function(){
        $("#contact-form-container").fadeOut();
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
    //console.log(scala, current_width, window.innerWidth);

    $(".stars.stars_background").css("background-size", (400*scala) + "px");
    $(".stars.back").css("background-size", (1757*scala) + "px");
    $(".stars.middle").css("background-size", (1354*scala) + "px");
    $(".stars.front").css("background-size", (1431*scala) + "px");
    $(".moon").width(370*scala).height(519*scala);
    $(".boat").width(572*scala).height(337*scala);
    //$(".cracken").width(300*scala).height(388*scala);
    $(".tentacle").width(200*scala).height(235*scala);
    $(".tentacle-big").width(248*scala).height(340*scala);


    $(".wave").height(260*scala);
    $(".wave.front").css("background-size", (790*scala) + "px");
    $(".wave.medium").css("background-size", (1048*scala) + "px");
    $(".wave.medium-back").css("background-size", (758*scala) + "px");
    $(".wave.far").css("background-size", (115*scala) + "px");
}
