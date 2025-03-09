@extends('admin.master')

@section('title' , 'تنظیمات سئو')
@section('tab' , 21)
@section('content')
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/seo">تنظیمات سئو</a>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <form method="post" action="/admin/setting/seo" class="settingMangeItems">
            @csrf
            <div class="settingItem">
                <label>عنوان فعالیت سایت</label>
                <input type="text" name="titleSeo" value="{{$titleSeo}}" placeholder="نام را وارد کنید">
            </div>
            <div class="settingItem">
                <label>متن تگ h1 در صفحه اصلی</label>
                <input type="text" name="h1Seo" value="{{$h1Seo}}" placeholder="متن را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کلمات کلیدی سایت</label>
                <input type="text" name="keyword" value="{{$keyword}}" placeholder="با , جدا کنید">
            </div>
            <div class="settingItem">
                <label>توضیحات سئو سایت</label>
                <textarea name="aboutSeo" placeholder="توضیحات را وارد کنید">{{$aboutSeo}}</textarea>
            </div>
            <div class="settingItem">
                <label>متاتگ های دلخواه صفحه اصلی</label>
                <textarea name="metaSeo" placeholder="متاتگ هایتان را وارد کنید">{{$metaSeo}}</textarea>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
@endsection
