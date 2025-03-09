@extends('admin.master')

@section('title' , 'تنظیمات پیامک')
@section('tab',21)
@section('content')
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/message">تنظیمات پیامک</a>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <form method="post" action="/admin/setting/message" class="settingMangeItems">
            @csrf
            <div class="settingItem">
                <label>پترن پیامک ثبت نام / ورود</label>
                <select name="loginSms" id="">
                    @foreach($patternSms as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="settingItem">
                <label>ایمیل ثبت نام / ورود</label>
                <select name="loginEmail">
                    @foreach($patternEmail as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="settingItem">
                <label for="">مرچنت قاصدک</label>
                <input type="text" name="ghasedak" value="{{$ghasedak}}" placeholder="مرچنت آیدی">
            </div>
            <div class="settingItem">
                <label for="">نام کاربری ملی پیامک</label>
                <input type="text" name="userSms" value="{{$userSms}}" placeholder="نام کاربری">
            </div>
            <div class="settingItem">
                <label for="">رمز عبور ملی پیامک</label>
                <input type="text" name="passSms" value="{{$passSms}}" placeholder="رمز عبور">
            </div>
            <div class="settingItem">
                <label for="">کلید کاوه نگار</label>
                <input type="text" name="kaveKey" value="{{$kaveKey}}" placeholder="API Key">
            </div>
            <div class="settingItem">
                <label for="">نام کاربری فراز</label>
                <input type="text" name="userFaraz" value="{{$userFaraz}}" placeholder="نام کاربری">
            </div>
            <div class="settingItem">
                <label for="">رمز عبور فراز</label>
                <input type="text" name="passFaraz" value="{{$passFaraz}}" placeholder="رمز عبور">
            </div>
            <div class="settingItem">
                <label for="">شماره تماس فراز</label>
                <input type="text" name="numberFaraz" value="{{$numberFaraz}}" placeholder="شماره">
            </div>
            <div class="settingItem">
                <label for="">سامانه پیامکی شما</label>
                <select name="typeSms">
                    <option value="0" selected>قاصدک</option>
                    <option value="1">ملی پیامک</option>
                    <option value="2">کاوه نگار</option>
                    <option value="3">فراز اس ام اس</option>
                </select>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var typeSms = {!! json_encode($typeSms, JSON_HEX_TAG) !!};
            $("select[name='typeSms']").val(typeSms);
        })
    </script>
@endsection
