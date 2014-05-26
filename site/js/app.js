var assets = [

    { id: "bg", src: "img/bg.jpg"},
    { id: "mooon", src: "img/moon-pj.png"},
    { id: "jd", src: "img/jecky-e-dany.png"},
    { id: "sbg", src: "img/stars_bg.png"},
    { id: "sback", src: "img/stars_back.png"},
    { id: "sfront", src: "img/stars_front.png"},
    { id: "smiddle", src: "img/stars_middle.png"},
    { id: "wfar", src: "img/wave_far.png"},
    { id: "wfront", src: "img/wave_front.png"},
    { id: "wmback", src: "img/wave_medium-back.png"},
    { id: "wmed", src: "img/wave_medium.png"},
    { id: "sicons", src: "img/social-icons.png"},
    { id: "sobg", src: "img/social_bg.png"},

    { id: "px", src: "js/parallax.js"},
    { id: "jpx", src: "js/jquery.parallax.js"},
    { id: "jsng", src: "js/jquery.easing.js"},
    { id: "ckfr", src: "css/keyframes.css"},
    { id: "cstyle", src: "css/style.css"}

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
        }, 400, 'linear', function(){
            $("#contact-form").fadeIn();
        })

        
    })

    $(".required").focus(function(){
        $this = $(this);
        $("#" + $this.attr("id") + "_label").removeClass("error");
    })
    $("#contact-form #close-btn").click(close_form);

    $("#mail-submit").click(sendmail)
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

function close_form() {
     $("#contact-form").fadeOut('100', function() {
            $c_container = $("#contact-form-container");
            $c_container.stop().animate({
                width: 0,
                height: 0,
                "marginLeft":  0,
                "marginTop":  0,
                opacity: 1
            }, 400, 'linear')
        });
}
function sendmail() {
    var req = 0;
    $("#contact-form .required").each(function(){
        $this = $(this);
        if ($this.val().trim() == "") {
            $("#" + $this.attr("id") + "_label").addClass("error");
            req++;
        }
        if (!IsEmail($("#email").val())) {
            $("#email_label").addClass("error");
            req++;
        }
       
    })
    if (req == 0) {
        $.post("/inc/writemab.php", $("#contact-form").serialize(), function(data){
            console.log(data);
        })
    }
    
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}


