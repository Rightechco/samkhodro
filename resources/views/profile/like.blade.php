@extends('home.master')

@section('active' , 1)
@section('title' , $title . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('profile.list' , ['tab' => $tab])
        <div class="profileIndexLike">
            <label>{{$title}}</label>
            <ul>
                @foreach($likePosts as $item)
                    <li>
                        <a href="/product/{{$item->slug}}">
                            <div class="userItemPic">
                                <img src="{{$item->image}}" alt="{{$item->titleSeo}}">
                            </div>
                            <div class="userItemSubject">
                                <div class="userItemSubjectTitle">{{$item->title}}</div>
                                <div class="postPriceItem">
                                    <h3>{{number_format($item->priceF)}} تومان</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
