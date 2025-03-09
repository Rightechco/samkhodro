@extends('admin.master')

@section('title' , 'افزودن مخاطب')
@section('tab' , 2)
@section('content')
    <div class="allCustomer">
        @include('admin.customers.show.header' , ['tab' => 13,'users' => $user])
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>افزودن مخاطب</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/customer/{{$user->id}}/contact">همه مخاطب ها</a>
                    <span>/</span>
                    <a href="/admin/customer/{{$user->id}}/contact/create">افزودن مخاطب</a>
                </div>
            </div>
            <form action="/admin/customer/{{$user->id}}/contact/create" method="post" class="allCreatePostData">
                @csrf
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>نام شرکت / شخص :</label>
                        <input type="text" name="name" placeholder="نام را وارد کنید">
                        @error('name')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>شماره موبایل :</label>
                            <input type="text" name="number" placeholder="شماره موبایل">
                            @error('number')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>ایمیل :</label>
                            <input type="text" name="email" placeholder="ایمیل">
                            @error('email')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>شماره ثبت مالیات :</label>
                            <input type="text" name="registration_number" placeholder="شماره را وارد کنید">
                            @error('registration_number')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>وبسایت :</label>
                            <input type="text" name="website" placeholder="www.example.com">
                            @error('website')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>رمز عبور :</label>
                            <input type="password" name="password" placeholder="رمز عبور">
                            @error('password')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>آدرس :</label>
                        <textarea name="address" placeholder="آدرس را وارد کنید"></textarea>
                        @error('address')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>کشور :</label>
                            <select name="country" id="country">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="allCreatePostItem">
                            <label>استان :</label>
                            <input type="text" name="state" placeholder="استان را وارد کنید">
                            @error('state')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>شهر :</label>
                            <input type="text" name="city" placeholder="شهر را وارد کنید">
                            @error('city')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>کد پستی :</label>
                            <input type="text" name="postal" placeholder="کد پستی را وارد کنید">
                            @error('postal')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button class="button" type="submit">ارسال اطلاعات</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            فیلد های اختصاصی
                        </div>
                        <div class="allCreatePostDetailItems">
                        </div>
                    </div>
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            تاکسونامی
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>جنسیت :</label>
                                <select name="gender">
                                    <option value="0" selected>مرد</option>
                                    <option value="1">زن</option>
                                    <option value="2">سایر</option>
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>نوع :</label>
                                <select name="type">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>ارز :</label>
                                <select name="currency">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>گروه :</label>
                                <select class="group-multiple" name="group[]" multiple="multiple">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>زبان :</label>
                                <select name="language">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            $('.group-multiple').select2({
                placeholder: 'گروه را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
        })
    </script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <script src="/js/select2.min.js"></script>
@endsection
