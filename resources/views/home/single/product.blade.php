@extends('home.master')

@section('active' , 1)
@section('title' , $post->title . ' - ')
@section('content')

<style>
    /* ==========================================================================
       Premium Corporate Styles for Product Page
       ========================================================================== */
    :root {
        --corp-primary: #1e3a8a; /* آبی تیره سازمانی */
        --corp-primary-light: #2563eb;
        --corp-secondary: #f1f5f9;
        --corp-text-main: #0f172a;
        --corp-text-muted: #64748b;
        --corp-border: #e2e8f0;
        --corp-bg-card: #ffffff;
        --corp-radius: 16px;
        --corp-radius-sm: 10px;
        --corp-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
        --corp-shadow-hover: 0 20px 40px -10px rgba(0, 0, 0, 0.12);
    }

    .premium-corp-wrapper {
        font-family: inherit;
        color: var(--corp-text-main);
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        margin-top: 30px;
        margin-bottom: 40px;
    }

    /* Desktop Layout */
    .premium-corp-wrapper .right {
        width: calc(68% - 15px);
        background: var(--corp-bg-card);
        border-radius: var(--corp-radius);
        padding: 32px;
        box-shadow: var(--corp-shadow);
        border: 1px solid rgba(0,0,0,0.02);
    }

    .premium-corp-wrapper .left {
        width: calc(32% - 15px);
    }

    /* Main Featured Image Styling */
    .premium-corp-wrapper .pic img {
        width: 100%;
        border-radius: var(--corp-radius);
        object-fit: cover;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    /* Product Options Bar (Seller, Category, Status) */
    .premium-corp-wrapper .right .options {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin: 24px 0;
        padding: 20px;
        background: #f8fafc;
        border-radius: var(--corp-radius-sm);
        border: 1px solid var(--corp-border);
    }

    .premium-corp-wrapper .option {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .premium-corp-wrapper .option i,
    .premium-corp-wrapper .userPic img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        color: var(--corp-primary-light);
    }
    
    .premium-corp-wrapper .option svg {
        width: 20px;
        height: 20px;
    }

    .premium-corp-wrapper .optionDes h4 {
        font-size: 0.85rem;
        color: var(--corp-text-muted);
        margin: 0 0 4px 0;
        font-weight: 500;
    }

    .premium-corp-wrapper .optionDes h5,
    .premium-corp-wrapper .optionDes a {
        font-size: 1rem;
        font-weight: 700;
        color: var(--corp-text-main);
        margin: 0;
        text-decoration: none;
    }

    /* Titles and Body Content */
    .premium-corp-wrapper h1 {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--corp-primary);
        margin-bottom: 24px;
        line-height: 1.4;
    }

    .premium-corp-wrapper .body {
        font-size: 1.05rem;
        line-height: 1.9;
        color: #334155;
    }

    /* ==========================================================================
       کنترل سایز و جلوگیری کامل از کشیدگی تصاویر داخل متن (Content Images)
       ========================================================================== */
    .premium-corp-wrapper .body img {
        display: block !important;
        max-width: 100% !important;
        height: auto !important;
        object-fit: cover !important;
        margin: 24px auto !important;
        border-radius: var(--corp-radius);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--corp-border);
    }

    .premium-corp-wrapper .body p:has(img) {
        text-align: center;
    }

    /* Left Sidebar Sticky Styling */
    .premium-corp-wrapper .left > .options {
        background: var(--corp-bg-card);
        padding: 28px;
        border-radius: var(--corp-radius);
        box-shadow: var(--corp-shadow);
        position: sticky;
        top: 20px;
        border: 1px solid rgba(0,0,0,0.02);
    }

    .premium-corp-wrapper .price {
        text-align: center;
        padding-bottom: 24px;
        margin-bottom: 24px;
        border-bottom: 1px dashed var(--corp-border);
    }

    .premium-corp-wrapper .price h4 {
        font-size: 0.95rem;
        color: var(--corp-text-muted);
        margin-bottom: 8px;
    }

    .premium-corp-wrapper .price h3 {
        font-size: 2rem;
        font-weight: 900;
        color: var(--corp-text-main);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .premium-corp-wrapper .price h3 span {
        font-size: 1rem;
        font-weight: 500;
        color: var(--corp-text-muted);
    }

    /* Corporate Buttons */
    .premium-corp-wrapper .left .options > .option {
        margin-bottom: 16px;
        color: var(--corp-text-main);
        font-weight: 600;
    }

    .premium-corp-wrapper .buttons {
        margin-top: 16px;
        display: flex;
        gap: 10px;
    }

    .premium-corp-wrapper .buttons a {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 20px;
        border-radius: var(--corp-radius-sm);
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 1rem;
    }

    .premium-corp-wrapper .buttons a[href*="tel"] {
        background: var(--corp-secondary);
        color: var(--corp-text-main);
    }

    .premium-corp-wrapper .buttons a[href*="tel"]:hover {
        background: #e2e8f0;
    }

    .premium-corp-wrapper .buttons a[href*="pdf"],
    .premium-corp-wrapper .buttons a[href*="catalog"],
    .premium-corp-wrapper .buttons a[href*=".html"],
    .premium-corp-wrapper .buttons a[href="#"] {
        background: var(--corp-primary-light);
        color: white;
        box-shadow: 0 8px 16px -4px rgba(37, 99, 235, 0.3);
    }

    .premium-corp-wrapper .buttons a[href*="pdf"]:hover,
    .premium-corp-wrapper .buttons a[href*="catalog"]:hover,
    .premium-corp-wrapper .buttons a[href*=".html"]:hover,
    .premium-corp-wrapper .buttons a[href="#"]:hover {
        background: var(--corp-primary);
        transform: translateY(-2px);
        box-shadow: 0 12px 20px -4px rgba(37, 99, 235, 0.4);
    }

    .premium-corp-wrapper .likeBtn {
        background: var(--corp-secondary);
        width: 52px;
        border-radius: var(--corp-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        color: #ef4444;
    }
    
    .premium-corp-wrapper .likeBtn:hover {
        background: #fee2e2;
    }

    /* Related Products List */
    .premium-corp-wrapper .postsList {
        margin-top: 30px;
        background: var(--corp-bg-card);
        border-radius: var(--corp-radius);
        padding: 24px;
        box-shadow: var(--corp-shadow);
    }

    .premium-corp-wrapper .titleList {
        font-size: 1.2rem;
        font-weight: 800;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--corp-secondary);
    }

    .premium-corp-wrapper .postsList ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .premium-corp-wrapper .postsList li a {
        display: flex;
        gap: 12px;
        align-items: center;
        text-decoration: none;
        padding: 12px 0;
        border-bottom: 1px solid var(--corp-secondary);
        transition: all 0.3s;
    }

    .premium-corp-wrapper .postsList li a:hover {
        transform: translateX(-5px);
    }

    .premium-corp-wrapper .postsList img {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
    }

    .premium-corp-wrapper .postsList .showInfo h4 {
        color: var(--corp-text-main);
        font-size: 0.95rem;
        margin: 0 0 8px 0;
        font-weight: 700;
    }

    .premium-corp-wrapper .postsList .showInfo span {
        color: var(--corp-primary-light);
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* ==========================================================================
       MOBILE PREMIUM STICKY FOOTER (.resOp)
       ========================================================================== */
    .resOp { display: none; } /* Hidden on desktop */

    @media (max-width: 991px) {
        .premium-corp-wrapper .right,
        .premium-corp-wrapper .left {
            width: 100%;
        }
        
        .premium-corp-wrapper .right { padding: 20px; }
        
        /* بهینه‌سازی مارجین تصاویر داخل متن در تبلت و موبایل */
        .premium-corp-wrapper .body img {
            margin: 16px auto !important;
            border-radius: var(--corp-radius-sm);
        }

        /* Padding bottom to prevent content hiding behind sticky footer */
        .allProductSingle { padding-bottom: 100px; }
        
        .premium-corp-wrapper .left > .options { display: none; } /* Hide desktop side options on mobile */

        /* Super Premium Mobile Footer */
        .resOp {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-top: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.08);
            padding: 16px 20px;
            z-index: 9999;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-radius: 24px 24px 0 0;
        }

        .resOp > a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            background: var(--corp-secondary);
            color: var(--corp-text-main);
            padding: 10px 16px;
            border-radius: 14px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            flex-shrink: 0;
            min-width: 85px;
        }

        .resOp > a svg {
            width: 22px;
            height: 22px;
            fill: var(--corp-text-main);
        }

        .resOp .buttons {
            margin: 0;
            flex-grow: 1;
        }

        .resOp .buttons a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--corp-primary), var(--corp-primary-light));
            color: white;
            padding: 14px 20px;
            border-radius: 14px;
            font-size: 1.05rem;
            font-weight: 800;
            text-decoration: none;
            width: 100%;
            box-shadow: 0 8px 20px -6px rgba(37, 99, 235, 0.5);
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .resOp .buttons a svg {
            width: 22px;
            height: 22px;
            fill: white;
        }
    }
</style>

    @php
        // محاسبه آخرین آیدی موجود در جدول محصولات برای تشخیص مطمئن جدیدترین محصول
        $maxProductId = class_exists('\App\Models\Product') ? \App\Models\Product::max('id') : null;
        $titleNormalized = mb_strtolower($post->title ?? '');

        // بررسی هوشمند برای تویوتا کرولا ۲۰۲۶ نیوفیس:
        // ۱. اگر آیدی محصول برابر با بالاترین آیدی باشد
        // ۲. یا آیدی محصول بزرگتر یا مساوی ۱۱ باشد
        // ۳. یا کلمات "نیوفیس" / "نیو فیس" و "2026" / "۲۰۲۶" در عنوان محصول باشد
        if (
            ($maxProductId && $post->id >= $maxProductId) ||
            ($post->id > 10) ||
            (str_contains($titleNormalized, 'نیوفیس') || str_contains($titleNormalized, 'نیو فیس') || str_contains($titleNormalized, '2026') || str_contains($titleNormalized, '۲۰۲۶'))
        ) {
            $catalogPath = "/upload/newface2026.pdf";
        } elseif ($post->id == 10) {
            $catalogPath = "https://taminkanisam.co.ir/catalog/corolla-2026/index.html";
        } elseif ($post->id == 8) {
            $catalogPath = "/upload/newcatalog.pdf";
        } else {
            $catalogPath = "https://taminkanisam.co.ir/upload/catalog.pdf";
        }
    @endphp

    <div class="allProductSingle premium-corp-wrapper width">
        <div class="right">
            <div class="pic">
                <img class="lazyload" src="/img/404Image.png" data-src="{{$post->image}}" alt="{{$post->titleSeo}}">
            </div>
            <div class="options">
                <div class="option">
                    <div class="userPic">
                        <img class="lazyload" src="/img/404Image.png" data-src="/img/user.png" alt="{{$post->title}}">
                    </div>
                    <div class="optionDes">
                        <h4>فروشنده</h4>
                        <h5>تامین کانی سام</h5>
                    </div>
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#globe"></use>
                        </svg>
                    </i>
                    <div class="optionDes">
                        <h4>دسته بندی</h4>
                        <a href="/product/category/{{$post->category()->pluck('slug')->first()}}">{{$post->category()->pluck('name')->first()}}</a>
                    </div>
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#box"></use>
                        </svg>
                    </i>
                    <div class="optionDes">
                        <h4>وضعیت</h4>
                        @if($post->count >= 1)
                            <h5>موجود</h5>
                        @else
                            <h5>ناموجود</h5>
                        @endif
                    </div>
                </div>
            </div>
            <h1>{{$post->title}}</h1>
            <div class="body">
                {!! $post->body !!}
            </div>
        </div>
        
        <div class="left">
            <div class="options">
                <div class="price">
                    <h4>مبلغ</h4>
                    <h3>
                        {{number_format($post->priceF)}}
                        <span>تومان</span>
                    </h3>
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#phone-call"></use>
                        </svg>
                    </i>
                    {{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#email"></use>
                        </svg>
                    </i>
                    {{\App\Models\Setting::where('key' , 'email')->pluck('value')->first()}}
                </div>
                
                <div class="buttons">
                    <a href="tel:{{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#phone-call"></use>
                            </svg>
                        </i>
                        تماس با ما
                    </a>
                    <i class="likeBtn">
                        @if($like)
                            <svg class="icon">
                                <use xlink:href="#like"></use>
                            </svg>
                        @else
                            <svg class="icon">
                                <use xlink:href="#unlike"></use>
                            </svg>
                        @endif
                    </i>
                </div>
                
                <div class="buttons">
                    <a href="{{ $catalogPath }}" target="_blank">
                        <i>
                            <svg class="icon">
                                <use xlink:href="fa-download"></use>
                            </svg>
                        </i>
                         دریافت کاتالوگ
                    </a>
                </div>
                
                <div class="buttons">
                    <a href="#">
                        <i>
                            <svg class="icon">
                                <use xlink:href="fa-download"></use>
                            </svg>
                        </i>
                         دریافت دفترچه راهنمای مالک
                    </a>
                </div>
            </div>
            
            <div class="postsList">
                <div class="titleList">
                    محصولات مرتبط
                </div>
                <ul>
                    @foreach($related as $item)
                        <li>
                            <a href="/product/{{$item->slug}}" title="{{$item->titleSeo}}">
                                <img class="lazyload" src="/img/404Image.png" data-src="{{$item->image}}" alt="{{$item->imageAlt}}">
                                <div class="showInfo">
                                    <h4>{{$item->title}}</h4>
                                    <span>{{number_format($item->priceF)}} تومان</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <div class="resOp">
        <a href="tel:{{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}">
            <i>
                <svg class="icon">
                    <use xlink:href="#phone-call"></use>
                </svg>
            </i>
            تماس
        </a>
        <div class="buttons">
            <a href="{{ $catalogPath }}" target="_blank">
                <i>
                    <svg class="icon">
                        <use xlink:href="fa-download"></use>
                    </svg>
                </i>
                دانلود کاتالوگ
            </a>
        </div>
    </div>

@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var post = {!! $post->toJson() !!};
            $('.fixedTab').hide();
            $('.likeBtn').click(function (){
                var form = {
                    "_token": "{{ csrf_token() }}",
                    "model": post.id,
                };

                $.ajax({
                    url: "/like",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'success'){
                            $.toast({
                                text: "به علاقه مندی اضافه شد", // Text that is to be shown in the toast
                                heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('.likeBtn svg').remove();
                            $('.likeBtn').append(
                                $('<svg class="icon"><use xlink:href="#like"></use></svg>')
                            );
                        }
                        if(data == 'noUser'){
                            $.toast({
                                text: "ابتدا عضو شوید", // Text that is to be shown in the toast
                                heading: 'عضو شوید', // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                        if(data == 'delete'){
                            $.toast({
                                text: "از علاقه مندی حذف شد", // Text that is to be shown in the toast
                                heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('.likeBtn svg').remove();
                            $('.likeBtn').append(
                                $('<svg class="icon"><use xlink:href="#unlike"></use></svg>')
                            );
                        }
                    },
                });
            });
            var form = {
                "_token": "{{ csrf_token() }}",
                "productId": post.id,
                "productType": 'App\\Models\\Product',
            };

            $.ajax({
                url: "/view",
                type: "post",
                data: form,
            });
        })
    </script>
@endsection