function activateStage() {
    scene = $('#scene').parallax();
    $("#counter").fadeOut("fast", function(){
        $("#container").fadeIn();
    });
}

$(window).resize(function(){

    $('#scene').height(window.innerHeight);
    $('#scene').width(window.innerWidth*2);
    $("#container").height(window.innerHeight);
    $("#container").width(window.innerWidth);
});

function animatePuppets() {

    var bitmap = new createjs.Bitmap("imagePath.jpg");
}