var assets = [

    "img/bg.jpg",
    "img/moon-pj.png",
    "img/jecky-e-dany.png",
    "img/stars_bg.png",
    "img/stars_back.png",
    "img/stars_front.png",
    "img/stars_middle.png",
    "img/wave_far.png",
    "img/wave_front.png",
    "img/wave_medium-back.png",
    "img/wave_medium.png",
    "img/social-icons.png",
    "img/social_bg.png",

    "js/parallax.js",
    "js/jquery.parallax.js",
    "js/jquery.easing.js",
    "css/keyframes.css",
    "css/style.css"

];
var max_res_w = 1600;
var min_res_w = 1024;
var min_res_h = 768;


var scene = {};
var onQueueProgress = function () {
    document.getElementById('counter').innerHTML = Math.floor(queue.progress * 100) + '%';
}

var onQueueLoaded = function () {
    resizeScene();
    activateStage();
}

var handleFileLoad = function (e) {
    if (e.item.type === 'javascript') {
        //console.log(e.item.src);
        document.getElementsByTagName('body')[0].appendChild(e.result);
    }
    else if (e.item.type === 'css') {
        document.getElementsByTagName('head')[0].appendChild(e.result);
    }
}


var queue = new createjs.LoadQueue(true);

queue.setMaxConnections(1);
queue.addEventListener("fileload", handleFileLoad);
queue.addEventListener("complete", onQueueLoaded);
queue.addEventListener("progress", onQueueProgress);

for (var n = 0; n < assets.length; n++) {
    queue.loadFile(	assets[n], false);
}

queue.load();



var res_graphic = 1600;
var min_res_w = 800;
var min_res_h = 600;

/** BOOT FUNCTIONS **/
function activateStage() {

    scene = $('#scene').parallax();
    $("#loader").fadeOut(500, function(){
        $("#container").fadeIn(3000, function(){
        });
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


