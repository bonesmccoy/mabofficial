<?php 
    session_start();
    $token = md5(time());
    $_SESSION['token'] = $token;

?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <!-- Behavioral Meta Data -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    

    <style>
     /* just for site bootstrapping */
        @import url(http://fonts.googleapis.com/css?family=Cabin+Sketch:700|Amatic+SC);
         /*@import url(http://fonts.googleapis.com/css?family=Shadows+Into+Light); */
        /*
        font-family: 'Fredericka the Great', cursive;
        font-family: 'Cabin Sketch', cursive;
        font-family: 'Tangerine', cursive;
        font-family: 'Amatic SC', cursive;
        */
        body {
            background: black;
        }
        #loader {
            z-index: 10000;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
        }
        #counter {
            position: absolute;
            width: 200px;
            height: 154px;
            top: 50%;
            left: 50%;
            font-size: 40px;
            margin: -65px 0 0 -125px;
            line-height: 129px;
            text-align: center;
            color: #FFF;
            font-family: 'Cabin Sketch', cursive;
            text-shadow: 2px 1px 3px #000;
        }
        #perc {
            font-family: de-walpergens-pica, serif;
            width: 200px;
            margin: 0 auto;
        }
        .container {
            display:none;
        }
    </style>
</head>
<body>
<div id="loader">
    <div id="counter"></div>
</div>
<div id="container" class="wrap bg">
    <!-- data-friction-x="0.1" data-friction-y="0.1" data-scalar-x="1" limit-y="0" -->
    <ul id="scene"  data-friction-x="0.1" data-friction-y="0.1" data-scalar-y="3" >
        <li class="layer" data-depth="0.00"></li>
        <li class="layer" data-depth="0.05"><div class="stars stars_background"></div></li>
        <li class="layer" data-depth="0.10"><div class="stars back"></div></li>
        <li class="layer" data-depth="0.20"><div class="stars middle"></div></li>
        <li class="layer" data-depth="0.30"><div class="stars front"></div></li>
        <li class="layer" data-depth="0.20"><div class="wave far waving-2"></div></li>
        <li class="layer" data-depth="0.50"><div class="tentacle swing-3" ></div></li>
        <li class="layer" data-depth="0.50"><div class="tentacle-big swing-2" ></div></li>
        <li class="layer" data-depth="0.40"><div class="wave medium-back waving" ></div></li>
        <li class="layer" data-depth="0.50"><div class="boat waving-2 swing-2" ></div></li>
        <li class="layer" data-depth="0.60"><div class="wave medium waving-2"></div></li>
        <li class="layer" data-depth="1"><div class="wave front waving"></div></li>
        <li class="layer" data-depth="0.35"><div class="moon swing"></div></li>
    </ul>
    <h1 class="mainlogo">Mab</h1>
    <div id="social_bar">
        <a id="facebook" href="https://www.facebook.com/mabofficial" title="Mab Official Facebook Page" target="_blank"></a>
        <a id="mail"></a>
    </div>
    <div id="contact-form-container">
        <form action="javascript:void(0);" method="post" id="contact-form" accept-charset="UTF-8" >
            <div id="mab-stamp"></div>
            <div id="close-btn">X</div>
            <div id="form_container">
                <div class="form-items-left message-container">
                    <h2>Contact Mab</h2>
                    <div class="form-item message">
                        <label for="message" id="message_label">Message *</span></label>
                        <div>
                            <textarea id="message" name="message" class="f required"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-items-left">
                    <div class="name-email-container">
                        <div class="form-item first-name left">
                            <label for="first_name" id="first_name_label">Name<span>*</span></label>
                            <input type="text" id="first_name" name="first_name" class="required">
                        </div>
                       <div class="form-item email right">
                            <label for="email" id="email_label">Email <span>*</span></label>
                            <input type="text" name="email" id="email" class="required">
                        </div>
                        <input type="hidden" name="token" value="<?php echo $token; ?>"/>
                        <div class="form-item submit">
                            <div id="mail-submit">Send</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="thank-message"><h2>Thank you for contacting Mab!</h2><p>We will read your mail soon and give you a reply!</p></div>
            <br style="clear:both"/>
        </form>
    </div>
</div>
<script src="js/createjs.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/app.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-12833462-2', 'mabofficial.com');
  ga('send', 'pageview');

</script>
</body>
</html>