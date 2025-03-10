<!doctype html>
<html lang="en">
<head>
    <title>@yield('title'){{\App\Models\Setting::where('key' , 'title')->pluck('value')->first()}}</title>
    @laravelPWA
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery-3.6.4.min.js"></script>
    <script src="/js/lazyload.min.js"></script>
    @yield('links')
    @yield('links2')
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
    <link rel="stylesheet" href="/css/home.css" type="text/css">
    <link rel="stylesheet" href="/css/icons.min.css" type="text/css">
    @yield('myMeta')
</head>
<body>
@include('icons')
@include('home.header.index')
<div class="allHome">
    @yield('content')
</div>
@include('home.footer.index')
@yield('script1')
@yield('script2')
</body>
</html>

<script>
    $(document).ready(function (){
        let lazy = lazyload();
        $("img.lazyload").lazyload();
    })
</script>
