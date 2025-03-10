<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @laravelPWA
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery-3.6.4.min.js"></script>
    @yield('links')
    @yield('links2')
    <link rel="stylesheet" href="/css/admin.css" type="text/css">
    <link rel="stylesheet" href="/css/icons.min.css" type="text/css">
</head>
<body>
    @include('icons')
    @include('admin.side.sidebar')
    @include('admin.header.header')
    <div class="allPanel">
        @yield('content')
    </div>
    @yield('script1')
    @yield('script2')
    @yield('scripts3')
    @yield('scripts4')
</body>
</html>
