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

function close_form() {
     $("#contact-form").fadeOut('100', function() {
            $c_container = $("#contact-form-container");
            $c_container.stop().animate({
                width: 0,
                height: 0,
                "marginLeft":  0,
                "marginTop":  0,
                opacity: 1
            }, 400, 'linear', function() {
                $("#form_container").show();
                $("#thank-message").hide();
                $("#form_container input, #form_container textarea").each(function(i, el){ $(el).val('')});
            })
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
        $.post("inc/writemab.php", $("#contact-form").serialize(), function(data){
            console.log(data)
            $("#form_container").fadeOut('fast', function(){
                $("#thank-message").show();
                setTimeout(close_form, 5000)
            })
        })
    }
    
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
