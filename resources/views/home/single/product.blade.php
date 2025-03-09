@extends('home.master')

@section('active' , 1)
@section('title' , $post->title . ' - ')
@section('content')
    <div class="allProductSingle width">
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
                        @if($post->user)
                            <h5>{{$post->user->name}}</h5>
                        @endif
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
                    <a href="#">
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
            
            <div class="resOp" style="display:none;">
                <a href="tel:{{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#phone-call"></use>
                        </svg>
                    </i>
                    تماس با ما
                </a>
                <div class="price">
                    {{number_format($post->priceF)}}
                    <span>تومان</span>
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
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
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
