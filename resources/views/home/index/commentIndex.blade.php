<div class="allComment width">
    <div class="top">
        <h3>{{$data['title']}}</h3>
        <p>{{$data['description']}}</p>
    </div>
    <div class="slider-comment owl-carousel owl-theme">
        @foreach($data['ads3'] as $item)
            <div class="commentItem">
                <div class="pic">
                    <img class="lazyload" src="/img/404Image.png" data-src="{{$item->image}}" alt="{{$item->name}}">
                </div>
                <div class="comment">
                    <p>{{$item->body}}</p>
                    <div class="user">
                        <h5>{{$item->name}} ,</h5>
                        <span>{{$item->job}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
