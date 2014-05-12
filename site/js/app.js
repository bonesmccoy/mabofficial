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
    //"js/main.js",


    "css/keyframes.css",
    "css/style.css"

];
var max_res_w = 1920;
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


