<div class="allProductIndex">
    <div class="width">
        <div class="right">
            <h4>{{$data['title']}}</h4>
            <p>{{$data['description']}}</p>
            <ul>
                @foreach($data['post'] as $item)
                    <li class="{{ $loop->index == 0 ? 'active' : '' }}" id="cat{{$item->id}}">{{$item->name}}</li>
                @endforeach
            </ul>
        </div>
        <div class="left">
            @foreach($data['post'] as $item)
                <div class="lists cat{{$item->id}}" style="{{ $loop->index == 0 ? '' : 'display:none;' }}">
                    <div class="slider-products owl-carousel owl-theme">
                        @foreach($item['product'] as $val)
                            <article class="blogItem">
                                <a href="/product/{{$val->slug}}">
                                    <div class="pic">
                                        <img class="lazyload" src="/img/404Image.png" data-src="{{$val->image}}" alt="{{$val->titleSeo}}">
                                    </div>
                                    <div class="options">
                                        <div class="option">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#globe"></use>
                                                </svg>
                                            </i>
                                            {{$val->category()->pluck('name')->first()}}
                                        </div>
                                        <div class="option">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#price"></use>
                                                </svg>
                                            </i>
                                            {{number_format($val->priceF)}} تومان
                                        </div>
                                    </div>
                                    <h4>{{$val->title}}</h4>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
