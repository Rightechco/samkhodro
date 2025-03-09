@extends('admin.master')

@section('title' , 'ویرایش ' . $users->name)
@section('tab' , 2)
@section('content')
    <div class="allCustomer">
        @include('admin.customers.show.header' , ['tab' => 13,'users' => $user])
        <div class="allCreatePost">
            <form action="/admin/customer/{{$user->id}}/contact/{{$users->id}}/edit" method="post" class="allCreatePostData">
                @csrf
                {{ method_field('PUT') }}
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>نام شرکت / شخص :</label>
                        <input type="text" name="name" value="{{$users->name}}" placeholder="نام را وارد کنید">
                        @error('name')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>شماره موبایل :</label>
                            <input type="text" name="number" value="{{$users->number}}" placeholder="شماره موبایل">
                            @error('number')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>ایمیل :</label>
                            <input type="text" name="email" value="{{$users->email}}" placeholder="ایمیل">
                            @error('email')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>شماره ثبت مالیات :</label>
                            <input type="text" name="registration_number" value="{{$users->registration_number}}" placeholder="شماره را وارد کنید">
                            @error('registration_number')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>وبسایت :</label>
                            <input type="text" name="website" value="{{$users->website}}" placeholder="www.example.com">
                            @error('website')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>رمز عبور (در صورت تغییر) :</label>
                            <input type="password" name="password" placeholder="رمز عبور">
                        </div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>آدرس :</label>
                        <textarea name="address" placeholder="آدرس را وارد کنید">{{$users->address}}</textarea>
                        @error('address')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>کشور :</label>
                            <select name="country">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="allCreatePostItem">
                            <label>استان :</label>
                            <input type="text" value="{{$users->state}}" name="state" placeholder="استان را وارد کنید">
                            @error('state')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>شهر :</label>
                            <input type="text" value="{{$users->city}}" name="city" placeholder="شهر را وارد کنید">
                            @error('city')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>کد پستی :</label>
                            <input type="text" name="postal" value="{{$users->postal}}" placeholder="کد پستی را وارد کنید">
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
            var users = {!! $users->toJson() !!};
            $("select[name='gender']").val(users.gender);
            $("input[name='password']").val('');
            if(users.language.length >= 1){
                $("select[name='language']").val(users.language[0].id);
            }
            if(users.currency.length >= 1){
                $("select[name='currency']").val(users.currency[0].id);
            }
            if(users.type_customer.length >= 1){
                $("select[name='type']").val(users.type_customer[0].id);
            }
            if(users.country.length >= 1){
                $("select[name='country']").val(users.country[0].id);
            }
            var groups = [];
            if(users.group){
                $.each(users.group,function(){
                    groups.push(this.id);
                });
                $('.group-multiple').val(groups);
            }
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
