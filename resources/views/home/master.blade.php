@php
    // واکشی هوشمند فاوآیکن و پیش‌گیری قطعی از خطای ۴۰۴ در صفحات داخلی
    $siteFavicon = \App\Models\Setting::where('key', 'favicon')->pluck('value')->first();
    if (!empty($siteFavicon)) {
        $siteFavicon = trim($siteFavicon);
        if (!preg_match('~^(?:f|ht)tps?://~i', $siteFavicon) && strncmp($siteFavicon, '/', 1) !== 0) {
            $siteFavicon = '/' . $siteFavicon;
        }
    } else {
        // در صورت عدم تنظیم فاوآیکن، از لوگوی اصلی سایت یا فایل پیش‌فرض استفاده می‌شود
        $siteLogo = \App\Models\Setting::where('key', 'logo')->pluck('value')->first();
        if (!empty($siteLogo)) {
            $siteLogo = trim($siteLogo);
            if (!preg_match('~^(?:f|ht)tps?://~i', $siteLogo) && strncmp($siteLogo, '/', 1) !== 0) {
                $siteLogo = '/' . $siteLogo;
            }
            $siteFavicon = $siteLogo;
        } else {
            $siteFavicon = '/favicon.ico';
        }
    }
@endphp
<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <title>@yield('title'){{ \App\Models\Setting::where('key' , 'title')->pluck('value')->first() }}</title>
    @laravelPWA
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- اتصال استاندارد فاوآیکن برای کلیه مرورگرها، تب‌ها و دستگاه‌ها -->
    <link rel="shortcut icon" href="{{ $siteFavicon }}" type="image/x-icon">
    <link rel="icon" href="{{ $siteFavicon }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ $siteFavicon }}">

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

{{-- شروع کد شناور اینماد --}}
<style>
    .enamad-floating {
        position: fixed;
        z-index: 9999999 !important; /* اولویت نمایش بسیار بالا */
        bottom: 20px;
        right: 20px;
        width: 130px; /* عرض در دسکتاپ */
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        padding: 8px;
        transition: all 0.3s ease-in-out;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .enamad-floating:hover {
        transform: translateY(-5px); /* انیمیشن هاور */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .enamad-floating img {
        width: 100% !important;
        height: auto !important;
        display: block;
        border-radius: 4px;
        cursor: pointer;
    }

    /* تنظیمات موبایل و تبلت */
    @media only screen and (max-width: 768px) {
        .enamad-floating {
            width: 85px; /* سایز کوچکتر در موبایل */
            bottom: 90px; /* بالاتر قرار گرفتن برای عدم تداخل با منوی پایین (Fixed Tab) */
            right: 15px;
            padding: 5px;
        }
    }
</style>

<div class="enamad-floating">
    <!-- کد اصلاح شده اینماد -->
    <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=694217&Code=XYJ0aJiE6AaVjhFegJiXZnOG9MKmkUR8'>
        <img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=694217&Code=XYJ0aJiE6AaVjhFegJiXZnOG9MKmkUR8' alt='' style='cursor:pointer' code='XYJ0aJiE6AaVjhFegJiXZnOG9MKmkUR8'>
    </a>
</div>
{{-- پایان کد شناور اینماد --}}

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