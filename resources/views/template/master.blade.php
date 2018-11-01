<!doctype html>

<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="Content-Language" content="en" />

<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="theme-color" content="#4188c9">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<title>SI MANAJEMEN PROYEK | @yield('title')</title>
@include('template.library')
@yield('css')
</head>
<body class="">
    <div class="page">
    <div class="page-main">
    @include('template.header')
    @include('template.menu')
    <div class="my-3 my-md-5">
        @yield('content')
    </div>
    </div>
    @include('template.footer')
    @yield('js')
    </div>
    <script>
        
        @if(Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}";
          switch(type){
              case 'info':
                  toastr.info("{{ Session::get('message') }}");
                  break;
              
              case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
      
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
      
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif
      </script>
</body>
</html>