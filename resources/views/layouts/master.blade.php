<!doctype html>
<?php
$userInfo = \Session::pull('user_info');
//dd($userInfo);
?>
<html lang="{{ App::getLocale() }}" class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noodp,nodir,noydir" />
        <link rel="shortcut icon" href="/favicon.ico?v={{time()}}" type="image/x-icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta name="description" content="@yield('meta_description')" />
        <meta name="keywords" content="keywords" />
        <meta name="format-detection" content="telephone=no">
        <meta name="google-site-verification" content="gJAZnoeO_GwykypEiULMmaFbUkB6YGImjeuyoWe1doY" />
        <meta name="msvalidate.01" content="03707142D2C2289D40FC962742B0F1C1" />
        <meta name="alexaVerifyID" content="ruyLCdtWDOvhejYJOStjR_okCBY"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="alternate" href="http://viecbonus.com/vi" hreflang="vi-vn" />
        @if(env('APP_ENV')==='product')
        @yield('codeFbWC')
        @include('includes.partials.fb_code_tracking')
        @yield('codeAppliedJob')  
        @include('includes.ga')
        @endif

        @yield('meta')
        <title>Thông tin nhà trọ toàn quốc | cập nhật 24/7</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,500,400italic,100italic,100,500italic,700,700italic,900,900italic&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
        <link rel="canonical" href="{{Request::url()}}" />
        <link href="/css/home.css" rel="stylesheet">
        @yield('custom_style')
        <style>
            body{
                color: black !important;
            }
        </style>
    </head>
    <body>
        @include('layouts.menu')
        <div class="container-fluid" style="min-height: 500px">
            @yield('content')
        </div>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"  crossorigin="anonymous"></script>
        @include('includes.footer')
        @yield('js')
    </body>
</html>
