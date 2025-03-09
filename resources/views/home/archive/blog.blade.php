@extends('home.master')

@section('active',1)
@section('title' , $name . ' - ')
@section('content')
    <div class="allNews width">
        <div class="topBlogs">
            <div class="allNewsRight">
                <div class="allNewsRightItems">
                    @foreach ($blogs as $item)
                        <a class="allNewsRightItem" href="/blog/{{$item->slug}}" title="{{$item->titleSeo}}">
                            <figure>
                                <img class="lazyload" src="/img/404Image.png" data-src="{{$item->image}}" alt="{{$item->imageAlt}}">
                            </figure>
                            <div class="allNewsRightItemOver">
                                <h3>{{$item->title}}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="allNewsSideBar">
                <div class="allNewsSideBarItem">
                    <label>پیشنهادات</label>
                    <ul>
                        @foreach($suggest as $item)
                            <li>
                                <article>
                                    <a href="/blog/{{$item->slug}}" title="{{$item->titleSeo}}">
                                        <img class="lazyload" src="/img/404Image.png" data-src="{{$item->image}}" alt="{{$item->imageAlt}}">
                                        <div class="showInfo">
                                            <h4>{{$item->title}}</h4>
                                            <span>{{$item->created_at}}</span>
                                        </div>
                                    </a>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="description">
            <h1>{{$name}}</h1>
            <p>{{$body}}</p>
        </div>
    </div>
@endsection
