<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fountain</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="Basic-fancyBox-Gallery-v2.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/helpers.css">
    <link rel="stylesheet" href="css/landing-2.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Team-Boxed.css">
    <link rel="stylesheet" href="css/Dark-footer.css">
    <link rel="shortcut icon" type="image/jpg" href="img/logo.jpg">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,600,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/law-icons/font/flaticon.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" />
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">

    @yield('contents')

{{--<!-- END section -->--}}



    <footer class="pb_footer bg-light" role="contentinfo">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <img src="img/fountainlogo.png" style="height: 108px;" />
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <p class="pb_font-14">&copy; 2019. All Rights Reserved. <br>  Fountain <a href="https://buzzdroid.bss.design/">Powered by Buzzdroid</a> </p>
                </div>
            </div>
        </div>
    </footer>

<div id="pb_loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#33CC72"/>
    </svg></div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>


</html>

