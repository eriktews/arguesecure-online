<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Argue Secure">
  <meta name="author" content="">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
  <title>Argue Secure - @yield('title')</title>
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-extend.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/site.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{asset('vendor/animsition/animsition.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/asscrollable/asScrollable.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/switchery/switchery.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/intro-js/introjs.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/slidepanel/slidePanel.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/flag-icon-css/flag-icon.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.css')}}">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{asset('fonts/font-awesome/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/web-icons/web-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/brand-icons/brand-icons.min.css')}}">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src="{{asset('vendor/html5shiv/html5shiv.min.js')}}"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="{{asset('vendor/media-match/media.match.min.js')}}"></script>
    <script src="{{asset('vendor/respond/respond.min.js')}}"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="{{asset('vendor/modernizr/modernizr.js')}}"></script>
  <script src="{{asset('vendor/breakpoints/breakpoints.js')}}"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="@yield('body_class')" @yield('body_attributes')>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  @section('page')
  @show
  
  <!-- Core  -->
  <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
  <script src="{{asset('vendor/velocity/velocity.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/bootstrap.js')}}"></script>
  <script src="{{asset('vendor/animsition/animsition.js')}}"></script>
  <script src="{{asset('vendor/asscroll/jquery-asScroll.js')}}"></script>
  <script src="{{asset('vendor/mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{asset('vendor/asscrollable/jquery.asScrollable.all.js')}}"></script>
  <script src="{{asset('vendor/ashoverscroll/jquery-asHoverScroll.js')}}"></script>
  <!-- Plugins -->
  <script src="{{asset('vendor/switchery/switchery.min.js')}}"></script>
  <script src="{{asset('vendor/toastr/toastr.js')}}"></script>

  {{-- <script src="{{asset('vendor/intro-js/intro.js')}}"></script> --}}
  <script src="{{asset('vendor/screenfull/screenfull.js')}}"></script>
  <script src="{{asset('vendor/slidepanel/jquery-slidePanel.js')}}"></script>
  <!-- Scripts -->
  <script src="{{asset('js/core.js')}}"></script>
  <script src="{{asset('js/site.js')}}"></script>
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{asset('js/sections/menu.js')}}"></script>
  <script src="{{asset('js/sections/menubar.js')}}"></script>
  <script src="{{asset('js/sections/gridmenu.js')}}"></script>
  <script src="{{asset('js/sections/sidebar.js')}}"></script>
  <script src="{{asset('js/configs/config-colors.js')}}"></script>
  <script src="{{asset('js/configs/config-tour.js')}}"></script>
  <script src="{{asset('js/components/asscrollable.js')}}"></script>
  <script src="{{asset('js/components/animsition.js')}}"></script>
  <script src="{{asset('js/components/slidepanel.js')}}"></script>
  <script src="{{asset('js/components/switchery.js')}}"></script>
  <script src="{{asset('js/components/panel.js')}}"></script>
  <script src="{{asset('js/components/material.js')}}"></script>
  <script src="{{asset('js/components/jquery-placeholder.js')}}"></script>
  <script src="https://cdn.socket.io/socket.io-1.3.7.js"></script>
  @if (Auth::check())
  @include('layout.javascript');
  <script src="{{asset('js/laroute.js')}}"></script>
  <script src="{{asset('js/arsec.js')}}"></script>
  @endif
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
  
</body>
</html>