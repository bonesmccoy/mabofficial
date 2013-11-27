function activateStage() {
    scene = $('#scene').parallax();
    $("#counter").fadeOut("slow", function(){
        $("#container").fadeIn();
    });
}

$(window).resize(function(){

    $('#scene').height(window.innerHeight);
    $('#scene').width(window.innerWidth*2);
    $("#container").height(window.innerHeight);
    $("#container").width(window.innerWidth);
})