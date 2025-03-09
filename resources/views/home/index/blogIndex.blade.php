<div class="allBlogIndex width">
    <div class="title">
        <h3>{{$data['title']}}</h3>
        <a href="/blogs">{{$data['more']}}</a>
    </div>
    <div class="slider-blogs owl-carousel owl-theme">
        @foreach($data['post'] as $item)
            <article class="blogItem">
                <a href="/blog/{{$item->slug}}">
                    <div class="pic">
                        <img class="lazyload" src="/img/404Image.png" data-src="{{$item->image}}" alt="{{$item->titleSeo}}">
                        <span>{{$item->time}} دقیقه</span>
                    </div>
                    <div class="options">
                        <div class="option">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#clock"></use>
                                </svg>
                            </i>
                            {{$item->created_at}}
                        </div>
                        @if($item->category()->count() >= 1)
                            <div class="option">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#globe"></use>
                                    </svg>
                                </i>
                                {{$item->category()->pluck('name')->first()}}
                            </div>
                        @endif
                    </div>
                    <h4>{{$item->title}}</h4>
                    <h5>مشاهده بلاگ</h5>
                </a>
            </article>
        @endforeach
    </div>
</div>
