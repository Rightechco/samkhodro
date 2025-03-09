<div class="allServiceIndex">
    <div class="topService">
        <div class="downCover">
        </div>
    </div>
    <h3>{{$data['title']}}</h3>
    <p>{{$data['description']}}</p>
    <div class="slider-service owl-carousel owl-theme width">
        @foreach(\App\Models\Service::get() as $item)
            <div class="serviceItem" style="background-image: url('{{$item->image}}')">
                <div class="content">
                    <h4>{{$item->name}}</h4>
                    <p>{{$item->body}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
