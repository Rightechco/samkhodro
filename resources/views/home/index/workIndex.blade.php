<div class="allWorkIndex">
    <div class="width">
        <div class="right">
            <h3>{{$data['title']}}</h3>
            <p>{{$data['description']}}</p>
        </div>
        <div class="left">
            <ul>
                @foreach(\App\Models\Ability::get() as $item)
                    <li>
                        <div class="top">
                            <span>{{$item->name}}</span>
                            <span>{{$item->percent}}%</span>
                        </div>
                        <div class="bot">
                            <div class="botItem" data-num="{{$item->percent}}">
                                <div></div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
