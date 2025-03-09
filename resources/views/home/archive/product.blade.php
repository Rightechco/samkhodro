@extends('home.master')

@section('active' , 1)
@section('title' , $name .' - ')
@section('content')
    <div class="allProductArchive width">
        <div class="productArchive">
            <div class="productTitle">
                <div class="right">
                    <div class="name">
                        <span>محصولات</span>
                        <h1>{{$name}}</h1>
                    </div>
                </div>
                <div class="left">
                    <div class="top">
                        <span>0</span>
                    </div>
                    <h4>محصول</h4>
                </div>
            </div>
            <div class="productLists"></div>
        </div>
        <div class="description">
            <h3>{{$name}}</h3>
            <p>{{$body}}</p>
        </div>
    </div>
@endsection


@section('script1')
    <script>
        $(document).ready(function(){
            var urls = {!! json_encode($urls, JSON_HEX_TAG) !!};
            getUrl();
            function getUrl(){
                $('.allLoading').show();
                $(".allPaginateHome").remove();
                $(".productLists").children(".productList").remove();
                $.ajax({
                    url: urls,
                    type: "get",
                    success: function (data) {
                        $('.allLoading').hide();
                        getList(data.data);
                        $('.left .top span').text(data.total);
                        $('.productArchive').append(
                            $(
                                (data.last_page >= 2 ?
                                    '<div class="allPaginateHome">'+
                                    '<div class="pages"></div>'+
                                    '</div>'
                                    : '')
                            )
                        );
                        $.each(data.links , function() {
                            if (this.label == 'قبلی' && this.url != null){
                                $('.allPaginateHome .pages').append(
                                    '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                )
                                    .on('click' , '#'+this.label , function() {
                                        $(".productLists").children(".productList").remove();
                                        $.ajax({
                                            url: $(this).attr('name'),
                                            type: "get",
                                            success: function (data) {
                                                getList(data.data);
                                                $.each(data.links , function() {
                                                    if (this.label == 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                                        )
                                                    }
                                                    if (this.label == 'بعدی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                                        );
                                                    }
                                                    if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                                        );
                                                    }
                                                    $(".allPaginateHome .pages :first").remove();
                                                })
                                            }
                                        })
                                    });
                            }
                            if (this.label == 'بعدی' && this.url != null){
                                $('.allPaginateHome .pages').append(
                                    '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                )
                                    .on('click' , '#'+this.label , function() {
                                        $(".productLists").children(".productList").remove();
                                        $.ajax({
                                            url: $(this).attr('name'),
                                            type: "get",
                                            success: function (data) {
                                                getList(data.data);
                                                $.each(data.links , function() {
                                                    if (this.label == 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                                        )
                                                    }
                                                    if (this.label == 'بعدی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                                        );
                                                    }
                                                    if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                                        );
                                                    }
                                                    $(".allPaginateHome .pages :first").remove();
                                                })
                                            }
                                        })
                                    });
                            }
                            if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                $('.allPaginateHome .pages').append(
                                    '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                )
                                    .on('click' , '#'+this.label , function() {
                                    });
                            }
                        })
                    },
                });
                $(document).on('click', '.allPaginateHome .pages div', function(){
                    $(".productLists").children(".productList").remove();
                    $(".allPaginateHome").remove();
                    $('.allLoading').show();
                    $.ajax({
                        url: $(this).attr('name'),
                        type: "get",
                        success: function (data) {
                            $('.allLoading').hide();
                            getList(data.data);
                            $('.productArchive').append(
                                $(
                                    (data.last_page >= 2 ?
                                        '<div class="allPaginateHome">'+
                                        '<div class="pages"></div>'+
                                        '</div>'
                                        : '')
                                )
                            );
                            $.each(data.links , function() {
                                if (this.label == 'قبلی' && this.url != null){
                                    $('.allPaginateHome .pages').append(
                                        '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                    )
                                }
                                if (this.label == 'بعدی' && this.url != null){
                                    $('.allPaginateHome .pages').append(
                                        '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                    );
                                }
                                if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                    $('.allPaginateHome .pages').append(
                                        '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                    );
                                }
                            })
                        }
                    })
                });
            }
            function makePrice(price){
                price += '';
                x = price.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            function getList(data){
                $.each(data , function(){
                    $('.productLists').append(
                        $(
                            '<a class="productList" title="'+this.title+'" href="'+'/product/'+this.slug+'">'+
                            '<div class="pic">'+
                            '<img src="'+this.image+'" alt="'+this.imageAlt+'">'+
                            '</div>'+
                            '<div class="titleTop">'+
                            `<i>
                                                <svg class="icon">
                                                    <use xlink:href="#globe"></use>
                                                </svg>
                                            </i>`+
                            '<div class="title">'+
                            '<h3>'+this.title+'</h3>'+
                            '</div>'+
                            '</div>'+
                            '<p>'+(this.bodySeo?this.bodySeo:'')+'</p>'+
                            '<div class="options">'+
                            '<div class="option">'+
                                '<span>'+makePrice(this.priceF)+'</span>'+
                                '<span> تومان</span>'+
                            `</div>
                            <div class="option">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <h4>مشاهده بیشتر</h4>
                            </div>
                        </div>
                    </a>`
                        )
                    );
                })
            }
        })
    </script>
@endsection

