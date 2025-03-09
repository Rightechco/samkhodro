<style>
    nav {
        position: relative;
    }

    nav ul li:hover .underMenu {
        opacity: 1;
    }

    .underMenu {
        position: absolute;
        display: block !important;
        opacity: 0;
        margin-top: 5px;
        background-color: rgba(221, 227, 237,0.8);
        padding: 5px;
        min-width: 150px;
        border-radius: 12px;
        -webkit-transition: all 0.2s ease-in;
        -moz-transition: all 0.2s ease-in;
        -o-transition: all 0.2s ease-in;
        -ms-transition: all 0.2s ease-in;
        transition: all 0.2s ease-in;
    }

    .underMenu li {
        color: black;
        padding: 4px 0;
        margin: 7px;
    }

    .underMenu li a {
        color: black !important;
        font-size: 14px !important;
    }
</style>
<div class="allHeaderHome {{app()->view->getSections()['active'] ? 'active' : ''}}">
    <div class="top">
        <div class="width">
            <div class="right">
                <!--@foreach(\App\Models\Page::get() as $item)-->
                <!--<a href="/page/{{$item->slug}}">{{$item->title}}</a>-->
                <!--@endforeach-->
            </div>
            <div class="left">
                @if(auth()->user())
                    <a href="/profile">پروفایل</a>
                @else
                    <a href="/login">ورود / ثبت نام</a>
                @endif
                <a href="{{\App\Models\Setting::where('key' , 'facebook')->pluck('value')->first()}}">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#whatsapp"></use>
                        </svg>
                    </i>
                </a>
                <a href="{{\App\Models\Setting::where('key' , 'instagram')->pluck('value')->first()}}">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#instagram"></use>
                        </svg>
                    </i>
                </a>
                <a href="{{\App\Models\Setting::where('key' , 'telegram')->pluck('value')->first()}}">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#telegram"></use>
                        </svg>
                    </i>
                </a>
            </div>
        </div>
    </div>
    <div class="bottom width">
        <div class="right">
            <figure>
                <a href="/" class="pic">
                    <img class="lazyload" src="{{\App\Models\Setting::where('key' , 'logo')->pluck('value')->first()}}" alt="{{\App\Models\Setting::where('key' , 'title')->pluck('value')->first()}}">
                </a>
            </figure>
            <nav>
                <ul>
                    @if(auth()->user())
                        @if(auth()->user()->level == 2 || auth()->user()->level == 3)
                            <li>
                                <a href="/admin">داشبورد پنل مدیریت</a>
                            </li>
                        @endif
                    @endif
                    @foreach(\App\Models\Link::where('type' , 0)->get() as $item)
                        <li>
                            <a href="{{$item->slug}}">{{$item->name}}</a>
                            @if($item->childs->count())
                                <ul class="underMenu">
                                    @foreach($item->childs as $child)
                                        <li><a href="{{ $child->slug }}">{{ $child->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="left">
            <a href="tel:{{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}" class="callHeader">
                {{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}
                <i>
                    <svg class="icon">
                        <use xlink:href="#phone-call"></use>
                    </svg>
                </i>
            </a>
            <div class="sendHeader">
                <i>
                    <svg class="icon">
                        <use xlink:href="#search"></use>
                    </svg>
                </i>
            </div>
        </div>
    </div>
    <div class="allSearch">
        <div class="topSearch">
            <label for="">
                <input type="text" name="search" placeholder="جستجو بلاگ , برگه و محصولات ...">
                <i>
                    <svg class="icon">
                        <use xlink:href="#search"></use>
                    </svg>
                </i>
            </label>
            <button>جستجو</button>
            <i class="closeSearch">
                <svg class="icon">
                    <use xlink:href="#cancel"></use>
                </svg>
            </i>
        </div>
        <ul></ul>
    </div>
    <div class="categoryHeaderResponsive">
        <div class="title">
            <span>منو سریع</span>
            <i id="btnShowMenu">
                <svg class="icon">
                    <use xlink:href="#cancel"></use>
                </svg>
            </i>
        </div>
        <ul class="allCats">
            <li>
                <div class="allCatsTitle">
                    <a href="/login" name="ثبت نام / ورود" title="ثبت نام / ورود">ثبت نام / ورود</a>
                </div>
            </li>
            @foreach(\App\Models\Link::where('type' , 0)->get() as $item)
                <li>
                    <div class="allCatsTitle">
                        <a href="{{$item->slug}}" name="{{$item->name}}" title="{{$item->name}}">
                            {{$item->name}}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    var activeH = {!! json_encode(app()->view->getSections()['active'], JSON_HEX_TAG) !!};
    var lastScrollTop = 0;
    var dd = 0;
    var gg = $("body").height();
    var st = $("body").scrollTop();
    $(window).scroll(function(event){
        if(activeH != 1){
            var st = $(this).scrollTop();
            if(st >= 1){
                $(".allHeaderHome").attr('class','allHeaderHome active');
            }else{
                $(".allHeaderHome").attr('class','allHeaderHome');
            }
            lastScrollTop = st;
        }
        $.each($(".allIndexWidgets .indexData"),function (){
            if (st + gg >= $(this).offset().top && $(this).attr('id') != 'done') {
                $(this).attr('id','done');
                $(this).animate({"opacity":"1","margin-top":"2"},500);
                $.each($(this).find('.allWorkIndex .botItem'),function () {
                    $(this).animate({'width' : $(this).attr('data-num')+'%'},1000)
                })
                if($(this).find('.allNumberIndex').length >= 1){
                    $('.numberCount').each(function () {
                        var $this = $(this);
                        $({ Counter: 0 }).animate({ Counter: $this.text() }, {
                            duration: 3000,
                            easing: 'swing',
                            step: function () {
                                $this.text(Math.ceil(this.Counter));
                            }
                        });
                    });
                }
            }
        })
    });
    $(document).ready(function(){
        $.each($(".allIndexWidgets .indexData"),function (){
            if(window.innerWidth >= 800){
                if (st + gg>= $(this).offset().top && $(this).attr('id') != 'done') {
                    $(this).attr('id','done');
                    $(this).animate({"opacity":"1"},500);
                }
            }else{
                $(this).attr('id','done');
                $(this).animate({"opacity":"1"},500);
            }
        })
        $('.allHeaderHome .closeSearch,.allHeaderHome .bottom .left .sendHeader').click(function (){
            $('.allSearch').toggle();
        })
        $('.allHeaderHome .categoryHeaderResponsive #btnShowMenu , .allCats li , .fixedTab .resAlign').on('click' ,function(){
            $('.categoryHeaderResponsive').toggle();
        })
        $('.allHeaderHome .resAlign').on('click' ,function(){
            $('.categoryHeaderResponsive').toggle();
        })
        $('.allHeaderHome .topSearch button').click(function () {
            var form = {
                "_token": "{{ csrf_token() }}",
                'search' : $(".allHeaderHome .topSearch input[name='search']").val(),
            };
            $.ajax({
                url: "/search",
                type: "post",
                data: form,
                success: function (data) {
                    $('.allSearch ul').children('li').remove();
                    $.each(data[0],function(){
                        $('.allSearch ul').append(
                        '<li>'+
                        '<a href="/product/'+this.slug+'">'+
                        '<h4>'+this.title+'</h4>'+
                        '<h5>/product/'+this.slug+'</h5>'+
                        '<p>'+(this.bodySeo?this.bodySeo:'')+'</p>'+
                        '</a>'+
                        '</li>');
                    })
                    $.each(data[1],function(){
                        $('.allSearch ul').append(
                        '<li>'+
                        '<a href="/blog/'+this.slug+'">'+
                        '<h4>'+this.title+'</h4>'+
                        '<h5>/blog/'+this.slug+'</h5>'+
                        '<p>'+(this.bodySeo?this.bodySeo:'')+'</p>'+
                        '</a>'+
                        '</li>');
                    })
                    $.each(data[2],function(){
                        $('.allSearch ul').append(
                        '<li>'+
                        '<a href="/page/'+this.slug+'">'+
                        '<h4>'+this.title+'</h4>'+
                        '<h5>/page/'+this.slug+'</h5>'+
                        '<p>'+(this.bodySeo?this.bodySeo:'')+'</p>'+
                        '</a>'+
                        '</li>');
                    })
                },
            });
        })
    });
</script>
