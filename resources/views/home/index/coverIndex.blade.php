<div class="allCoversIndex">
    <div class="slider-cover owl-carousel owl-theme">
        @foreach($data['ads2'] as $item)
            <div class="allCoverIndex" style="{{'background-image: url('.$item->image.')'}}">
                <div class="width">
                    <div class="container">
                        <h3>{{$item->title}}</h3>
                        <p>{{$item->body}}</p>
                        <a href="{{$item->address}}" class="sendHeader">
                            مشاهده بیشتر
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="downCover">
        <img src="/img/wave.png" alt="wave">
    </div>
</div>
