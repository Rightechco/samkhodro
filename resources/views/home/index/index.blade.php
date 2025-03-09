@extends('home.master')

@section('active' , \App\Models\Widget::where('status' , 1)->orderBy('number')->pluck('name')->first() == 'cover' ? 0 : 1)
@section('content')
    <div class="allIndexWidgets" style="{{\App\Models\Widget::where('status' , 1)->orderBy('number')->pluck('name')->first() == 'cover' ? '' : 'margin-top: 9rem'}}">
        <h1 class="seoTag">{{\App\Models\Setting::where('key' , 'h1Seo')->pluck('value')->first()}}</h1>
        @foreach($widget as $item)
            @if($item['name'] == 'cover')
                <div class="indexData">
                    @include('home.index.coverIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'option')
                <div class="indexData">
                    @include('home.index.numberIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'service')
                <div class="indexData">
                    @include('home.index.serviceIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'ability')
                <div class="indexData">
                    @include('home.index.workIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'team')
                <div class="indexData">
                    @include('home.index.teamIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'product')
                <div class="indexData">
                    @include('home.index.productIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'blog')
                <div class="indexData">
                    @include('home.index.blogIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'comment')
                <div class="indexData">
                    @include('home.index.commentIndex',['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'sendReq')
                <div class="indexData">
                    @include('home.index.contactIndex')
                </div>
            @endif
        @endforeach
        @if($popUp == 1)
            @include('home.index.popUp',['imagePopUp' => $imagePopUp,'descriptionPopUp' => $descriptionPopUp,'buttonPopUp' => $buttonPopUp,'titlePopUp' => $titlePopUp,'addressPopUp' => $addressPopUp,'popUpStatus'=>$popUpStatus])
        @endif
    </div>
@endsection
@section('myMeta')
    {!! \App\Models\Setting::where('key' , 'metaSeo')->pluck('value')->first() !!}
@endsection

@section('links')
    <link rel="stylesheet" href="/css/owl.carousel.min.css"/>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            $('.slider-cover').owlCarousel({
                loop:true,
                touchDrag: true,
                lazyLoad: true,
                autoplay:true,
                autoplayTimeout:4000,
                items:1,
                nav:true,
                margin:0,
            })
            $('.slider-comment').owlCarousel({
                loop:false,
                rtl:true,
                touchDrag: true,
                lazyLoad: true,
                autoplay:true,
                autoplayTimeout:5000,
                nav:true,
                margin:100,
                responsive:{
                    0:{
                        items:1,
                    },
                    800:{
                        items:2,
                    }
                }
            })
            $('.slider-blogs').owlCarousel({
                loop:false,
                rtl:true,
                touchDrag: true,
                lazyLoad: true,
                nav:true,
                margin:20,
                responsive:{
                    0:{
                        items:2,
                    },
                    800:{
                        items:4,
                    }
                }
            })
            $('.slider-products').owlCarousel({
                loop:false,
                rtl:true,
                touchDrag: true,
                lazyLoad: true,
                nav:true,
                responsive:{
                    0:{
                        margin:20,
                        items:2,
                    },
                    800:{
                        margin:30,
                        items:3,
                    }
                }
            })
            $('.slider-service').owlCarousel({
                loop:false,
                rtl:true,
                touchDrag: true,
                lazyLoad: true,
                nav:true,
                margin:30,
                responsive:{
                    0:{
                        items:2,
                    },
                    800:{
                        items:3,
                    }
                }
            })
            $('.slider-team').owlCarousel({
                loop:false,
                rtl:true,
                touchDrag: true,
                lazyLoad: true,
                nav:true,
                margin:30,
                responsive:{
                    0:{
                        items:2,
                    },
                    800:{
                        items:4,
                    }
                }
            })
            $('.allProductIndex ul li').click(function(){
                $('.allProductIndex ul').children('li').attr('class' , '');
                $('.allProductIndex .left').children('.lists').hide();
                $(this).attr('class' , 'active');
                $('.'+$(this).attr('id')).show();
            })
            $('.AllPopUpIndex').click(function(){
                this.remove();
                $.cookie('popUp' , 1);
            })
        })
    </script>
@endsection

