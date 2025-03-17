@extends('home.master')

@section('active',1)
@section('title' , ' - ' . $page->title)
@section('content')
    <main class="allPageIndex width">
        <figure class="pic">
            <img src="/img/back.jpg" alt="{{$page->titleSeo}}">
        </figure>
        <h1>{{$page->title}}</h1>
        <div class="description formPage" style="padding: 15px">
            {!! $page->body !!}
        </div>
        @if($page->contact)
            @if (\Session::has('message'))
                <div class="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="success">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            <form method="post" action="/send-contact">
                @csrf
                <input type="hidden" name="redirect" value="/page/{{$page->slug}}">
                <div class="items">
                    <div class="item">
                        <label for="title">عنوان درخواست*</label>
                        <input type="text" name="title" required id="title" placeholder="عنوان درخواست را وارد کنید">
                    </div>
                    <div class="item">
                        <label for="number">شماره تماس*</label>
                        <input type="text" name="number" required id="number" placeholder="شماره تماس را وارد کنید">
                    </div>
                </div>
                <div class="item">
                    <label for="body">درخواست*</label>
                    <textarea name="body" id="body" required placeholder="درخواست را وارد کنید"></textarea>
                </div>
                <div class="ticketButtons">
                    <button>ارسال درخواست</button>
                </div>
            </form>
        @endif
    </main>
@endsection
