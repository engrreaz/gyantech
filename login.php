<?php
session_start();
$usr = $_SESSION["user"];

if ($usr != '' || $usr != NULL) {
    header("Location:index.php");
}

// include_once 'auth/gpConfig.php';
// $authUrl = $gClient->createAuthUrl();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Gyantech - A Skill Developement Platform</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body class="app sidebar-mini">



    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <img src="images/logo.png" />
        </div>
        <div class="login-box">
            <form class="login-form" method="POST" onsubmit="login(this);" autocomplete="on">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
                <div class="form-group">
                    <label class="control-label">USERNAME</label>
                    <input class="form-control" type="text" id="username" name="username" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">PASSWORD</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="utility">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox"><span class="label-text">Stay Signed in</span>
                            </label>
                        </div>
                        <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"
                            onclick="loginx();"></i>SIGN IN</button>
                </div>
            </form>
            <form class="forget-form" action="index.html">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>
                            Back
                            to Login</a></p>
                </div>
            </form>
        </div>
    </section>

    <div id="status">ttt</div>

    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function () {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>


    <script>
        function login() {
            // alert(3)
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var infor = "user=" + username + "&otp=" + password;
            // alert(infor);
            $("#status").html("");

            $.ajax({
                type: "POST",
                url: "checklogin.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#status').html('<span class=""><center>Processing....</center></span>');
                },
                success: function (html) {
                    $("#status").html(html);
                }
            });
        }
    </script>



    <?php include 'footer.php';



