<div class="allTeamIndex width">
    <div class="title">
        <h3>{{$data['title']}}</h3>
    </div>
    <div class="allTeamItems slider-team owl-carousel owl-theme">
        @foreach(\App\Models\Team::get() as $item)
            <div class="allTeamItem">
                <div class="pic">
                    <img src="/img/404Image.png" data-src="{{$item->image}}" class="lazyload" alt="{{$item->name}}">
                </div>
                <h4>{{$item->name}}</h4>
                <h5>{{$item->body}}</h5>
            </div>
        @endforeach
    </div>
</div>
