<?php
    session_start();
    if (!isset($_SESSION['EXPIRES']) || $_SESSION['EXPIRES'] < time()+120) {
        session_destroy();
        $_SESSION = array();
    }
    $_SESSION['EXPIRES'] = time() + 120;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>シャインエアー</title>
    <!-- Custom Theme files -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="Login On Webapp Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Nunito:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <!--web-fonts-->

    {{--favicon--}}
    <link rel="shortcut icon" href="{!! asset('assets/images/favicon.ico')  !!} ">



    {{--site.css(Custom Populate Css)--}}
    {!! Html::style('assets/css/site.css') !!}

    {{--admin.css(Merged Plugin CSSs)--}}
    {!! Html::style('assets/css/admin.css') !!}

    {{--Sass(Custom Css)--}}
    {!! Html::style('css/app.css') !!}



    {{--site.js--}}
    <script src="{!! asset('assets/js/site.js') !!}"></script>

    {{--admin.js(Merged Plugin JSs)--}}
    <script src="{!! asset('assets/js/admin.js') !!}"></script>

    {{--CoffeeScript(Main Custom JS)--}}
    <script src="{!! asset('js/module.js') !!}"></script>

    <script>
        $(document).ready(function(c) {
            $('.close').on('click', function(c){
                $('.mail-section').fadeOut('slow', function(c){
                    $('.mail-section').remove();
                });
            });
        });
    </script>

    @yield('styles')
    @yield('scripts')
</head>
<body>
<div class="header">
    @yield('header')
</div>
<div class="content">
    @yield('content')
</div>
<div class="footer">
    @yield('footer')
</div>

</body>
</html>
