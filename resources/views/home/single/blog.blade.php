@extends('home.master')

@section('active' , 1)
@section('title' , $post->title . ' - ')
@section('content')
    <div class="allBlogSingle width">
        <div class="right">
            <div class="pic">
                <img class="lazyload" src="/img/404Image.png" data-src="{{$post->image}}" alt="{{$post->titleSeo}}">
            </div>
            <div class="options">
                <div class="option">
                    <div class="userPic">
                        <img class="lazyload" src="/img/404Image.png" data-src="/img/user.png" alt="{{$post->user->name}}">
                    </div>
                    <div class="optionDes">
                        <h4>نویسنده</h4>
                        <h5>{{$post->user->name}}</h5>
                    </div>
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#globe"></use>
                        </svg>
                    </i>
                    <div class="optionDes">
                        <h4>دسته بندی</h4>
                        <a href="/blog/category/{{$post->category()->pluck('slug')->first()}}">{{$post->category()->pluck('name')->first()}}</a>
                    </div>
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#clock"></use>
                        </svg>
                    </i>
                    <div class="optionDes">
                        <h4>زمان مطالعه</h4>
                        <h5>{{$post->time}} دقیقه</h5>
                    </div>
                </div>
                <div class="option">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#clock"></use>
                        </svg>
                    </i>
                    <div class="optionDes">
                        <h4>زمان انتشار</h4>
                        <h5>{{$post->created_at}}</h5>
                    </div>
                </div>
            </div>
            <h1>{{$post->title}}</h1>
            <div class="body">
                {!! $post->body !!}
            </div>
        </div>
        <div class="left">
            <div class="categories">
                <div class="title">دسته بندی ها</div>
                @foreach(\App\Models\Category::where('type' , 5)->get() as $item)
                    <a href="/blog/category/{{$item->slug}}" class="item">
                        <span>{{$item->name}}</span>
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                    </a>
                @endforeach
            </div>
            <div class="tags">
                <div class="title">برچسب ها</div>
                <ul>
                    @foreach(\App\Models\Tag::get() as $item)
                        <li>
                            <a href="/blog/tag/{{$item->slug}}" class="item">{{$item->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="postsList">
                <div class="titleList">
                    مطالب مرتبط
                </div>
                <ul>
                    @foreach($related as $item)
                        <li>
                            <a href="/blog/{{$item->slug}}" title="{{$item->titleSeo}}">
                                <img class="lazyload" src="/img/404Image.png" data-src="{{$item->image}}" alt="{{$item->imageAlt}}">
                                <div class="showInfo">
                                    <h4>{{$item->title}}</h4>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var post = {!! $post->toJson() !!};
            var form = {
                "_token": "{{ csrf_token() }}",
                "productId": post.id,
                "productType": 'App\\Models\\Blog',
            };

            $.ajax({
                url: "/view",
                type: "post",
                data: form,
            });
        })
    </script>
@endsection
