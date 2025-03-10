@extends('home.master')

@section('active' , 1)
@section('title' , $title . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('profile.list' , ['tab' => $tab])
        <div class="profileIndexLike">
            <label>{{$title}}</label>
            <ul>
                @foreach($orders as $item)
                    <li>
                        <a href="/product/{{$item->product->slug}}" style="position: relative">
                            <div class="userItemPic">
                                <img src="{{$item->product->image}}" alt="{{$item->product->titleSeo}}">
                            </div>
                            <span class="spanStatus badge-{{ $item->classStatus() }}">{{ $item->nameStatus() }}</span>
                            <div class="userItemSubject">
                                <div class="userItemSubjectTitle">{{$item->product->title}}</div>
                                <div class="postPriceItem">
                                    <h3>{{number_format($item->product->priceF)}} تومان</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="box" style="margin-top: 20px">
                <h2>ثبت سفارش جدید</h2>
            <form action="newOrder" method="post">
                @csrf
                @if(!isset(auth()->user()->number))
                    <div class="filledItem">
                        <label>شماره موبایل* :</label>
                        <input type="text" name="number" placeholder="شماره موبایل">
                        @error('number')
                        <div class="alert-danger" style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="filledItem">
                    <label>محصول را انتخاب کنید*</label>
                    <select name="product">
                        <option value="">انتخاب کنید</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                        @endforeach
                    </select>
                    @error('product')
                    <div class="alert-danger" style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <button>ثبت</button>
            </form>
            </div>
        </div>
    </div>
@endsection
