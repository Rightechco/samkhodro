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

    .spanStatus {
        position: absolute;
        left: 0;
        top: 0;
        padding: 7px;
        border-radius: 10px;
        font-family: irsans,irsans,sans-serif;
    }

    .span {
        padding: 7px;
        border-radius: 10px;
        font-family: irsans,irsans,sans-serif;
    }

    .badge-info {
        background-color: deepskyblue;
        color: white;
    }

    .badge-success {
        background-color: limegreen;
        color: white;
    }

    .badge-danger {
        background-color: darkred;
        color: white;
    }

    .box {
        background: white;
        box-shadow: 0 0 5px #eee;
        border-radius: 10px;
        overflow: hidden;
        padding: 10px 15px;
    }

    .box label {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 1rem;
        color: #475569;
        font-weight: 300;
        font-size: .7rem;
        margin-bottom: .5rem;
    }

    .box input, .box textarea, .box select {
        background: white;
        border: 1px solid #eee;
        padding: .4rem .5rem;
        color: #475569;
        border-radius: .3rem;
        font-size: .7rem;
        width: 100%;
        transition: all .3s ease-in-out;
        outline: transparent;
    }

    .box button {
        margin: 15px 0;
        padding: 15px;
        width: 100%;
        background-color: #0f74a8;
        border-radius: .3rem;
        font-size: .7rem;
        transition: all .3s ease-in-out;
        outline: transparent;
        color: whitesmoke;
        font-size: 16px;
    }

    /* Table Styles */

    .table-wrapper{
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    }

    .fl-table {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td, .fl-table th {
        text-align: center;
        padding: 8px;
    }

    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 12px;
    }

    .fl-table thead th {
        color: #ffffff;
        background: #4FC3A1;
    }


    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }

    /* Responsive */

    @media (max-width: 767px) {
        .fl-table {
            display: block;
            width: 100%;
        }
        .table-wrapper:before{
            content: "Scroll horizontally >";
            display: block;
            text-align: right;
            font-size: 11px;
            color: white;
            padding: 0 0 10px;
        }
        .fl-table thead, .fl-table tbody, .fl-table thead th {
            display: block;
        }
        .fl-table thead th:last-child{
            border-bottom: none;
        }
        .fl-table thead {
            float: left;
        }
        .fl-table tbody {
            width: auto;
            position: relative;
            overflow-x: auto;
        }
        .fl-table td, .fl-table th {
            padding: 20px .625em .625em .625em;
            height: 60px;
            vertical-align: middle;
            box-sizing: border-box;
            overflow-x: hidden;
            overflow-y: auto;
            width: 120px;
            font-size: 13px;
            text-overflow: ellipsis;
        }
        .fl-table thead th {
            text-align: left;
            border-bottom: 1px solid #f7f7f9;
        }
        .fl-table tbody tr {
            display: table-cell;
        }
        .fl-table tbody tr:nth-child(odd) {
            background: none;
        }
        .fl-table tr:nth-child(even) {
            background: transparent;
        }
        .fl-table tr td:nth-child(odd) {
            background: #F8F8F8;
            border-right: 1px solid #E6E4E4;
        }
        .fl-table tr td:nth-child(even) {
            border-right: 1px solid #E6E4E4;
        }
        .fl-table tbody td {
            display: block;
            text-align: center;
        }
    }
</style>
<div class="allHeaderHome {{app()->view->getSections()['active'] ? 'active' : ''}}">
    <div class="top">
        <div class="width">
            <div class="right">
                <!--@foreach(\App\Models\Page::get() as $item)-->
                <!--<a href="/page/{{$item->slug}}">{{$item->title}}</a>-->
                <!--@endforeach-->
                <a href="/form1">پرسشنامه اندازه گیري رضایت مشتریان از خدمات فروش</a>
                <a href="/form2">پرسش نامه اندازه گیری رضایت مشتریان از خدمات پس از فروش</a>
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
                    @foreach(\App\Models\Link::where('type' , 0)->whereNull('parent_id')->get() as $item)
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
