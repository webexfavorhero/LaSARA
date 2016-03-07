<!DOCTYPE HTML>
<html>
<head>
    <title>シャインエアー</title>
    <!-- Custom Theme files -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Login On Webapp Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Nunito:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <!--web-fonts-->
    {{--favicon--}}
    <link rel="shortcut icon" href="{!! asset('assets/images/favicon.ico')  !!} ">
    {{--favicon--}}
    {{--site.css--}}
    {!! Html::style('assets/css/site.css') !!}
    {{--admin.css--}}
    {!! Html::style('assets/css/admin.css') !!}
    {{--site.js--}}
    <script src="{!! asset('assets/js/site.js') !!}"></script>
    {{--admin.js--}}
    <script src="{!! asset('assets/js/admin.js') !!}"></script>
    <script>$(document).ready(function(c) {
            $('.close').on('click', function(c){
                $('.mail-section').fadeOut('slow', function(c){
                    $('.mail-section').remove();
                });
            });
        });
    </script>

    {{--CoffeeScript--}}
    <script src="{!! asset('js/module.js') !!}"></script>

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
