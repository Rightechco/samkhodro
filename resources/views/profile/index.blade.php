@extends('home.master')

@section('active' , 1)
@section('title' , 'داشبورد - ')
@section('content')
    <div class="allProfileIndex width">
        @include('profile.list' , ['tab' => 0])
        <div class="profileIndex">
            <div class="profileIndexTop">
                <div class="profileIndexTopItem">
                    <label>آخرین علاقه مندی ها</label>
                    <ul>
                        @foreach($likePost as $item)
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
                    <div class="profileIndexTopItemAddress">
                        <a href="/profile/like">همه علاقه مندی ها</a>
                    </div>
                </div>
                <div class="profileIndexTopItem">
                    <label>آخرین تیکت ها</label>
                    <table>
                        <tr>
                            <th>پیام</th>
                            <th>فایل</th>
                            <th>زمان ثبت</th>
                        </tr>
                        @foreach($tickets as $item)
                            <tr>
                                <td>
                                    <span>{{$item->body}}</span>
                                </td>
                                <td>
                                    @if($item->image)
                                        <a download href="{{$item->image->url}}"><i><svg class="icon"><use xlink:href="#files"></use></svg></i></a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span>{{$item->created_at}}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
