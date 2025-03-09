@extends('admin.master')

@section('title' , 'تنظیمات سایت')
@section('tab',21)
@section('content')
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/manage">تنظیمات سایت</a>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="forms">
            <div>
                <form method="post" action="/admin/setting/manage" class="settingMangeItems">
                    @csrf
                    <h3>مدیریت سایت</h3>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">نام وبسایت</label>
                            <input type="text" name="name" value="{{$name}}" placeholder="نام را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">عنوان فعالیت</label>
                            <input type="text" name="title" value="{{$title}}" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="addImageButton">برای افزودن تصویر کلیک کنید</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">آدرس وبسایت</label>
                            <input type="text" name="address" value="{{$address}}" placeholder="https://example.ir/">
                        </div>
                        <div class="settingItem">
                            <label for="">ایمیل وبسایت</label>
                            <input type="text" name="email" value="{{$email}}" placeholder="email@example.ir">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">رنگ هدر</label>
                            <input type="color" name="headerColor" value="{{$headerColor}}" placeholder="کد را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">رنگ ساید بار</label>
                            <input type="color" name="sideColor" value="{{$sideColor}}" placeholder="کد را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">کد نماد فناوری اطلاعات</label>
                            <input type="text" name="fanavari" value="{{$fanavari}}" placeholder="کد را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">کد نماد اعتماد</label>
                            <input type="text" name="etemad" value="{{$etemad}}" placeholder="کد را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">شماره تماس (ارسال پیامک به مدیر)</label>
                            <input type="text" name="number" value="{{$number}}" placeholder="شماره را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">شماره تماس (نمایش در سایت)</label>
                            <input type="text" name="number2" value="{{$number2}}" placeholder="شماره را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">صفحه واتساپ</label>
                            <input type="text" name="facebook" value="{{$facebook}}" placeholder="لینک را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">صفحه اینستاگرام</label>
                            <input type="text" name="instagram" value="{{$instagram}}" placeholder="لینک را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">صفحه توییتر</label>
                            <input type="text" name="twitter" value="{{$twitter}}" placeholder="لینک را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">صفحه تلگرام</label>
                            <input type="text" name="telegram" value="{{$telegram}}" placeholder="لینک را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItem">
                        <label for="">درباره ما</label>
                        <textarea name="about" placeholder="توضیحات را وارد کنید">{{$about}}</textarea>
                    </div>
                    <div class="settingItemChecked">
                        <label for="s3" class="item">
                            فعال شدن فرانت سایت
                            <input id="s3" type="checkbox" name="frontStatus" class="switch">
                        </label>
                    </div>
                    <button>ثبت اطلاعات</button>
                </form>
            </div>
            <div>
                <form method="post" action="/admin/setting/pop-up" class="settingMangeItems">
                    @csrf
                    <h3>تنظیمات پاپ آپ</h3>
                    <div class="settingItem">
                        <label>لینک تصویر را قرار بدید</label>
                        <input type="text" name="imagePopUp" value="{{$imagePopUp}}" placeholder="مثال : example.com/test.jpg">
                    </div>
                    <div class="settingItem">
                        <label>عنوان پاپ آپ*</label>
                        <input type="text" name="titlePopUp" value="{{$titlePopUp}}" placeholder="مثال : عنوان">
                    </div>
                    <div class="settingItem">
                        <label>آدرس (url) انتقال</label>
                        <input type="text" name="addressPopUp" value="{{$addressPopUp}}" placeholder="مثال : example.com/products">
                    </div>
                    <div class="settingItem">
                        <label>توضیحات پاپ آپ</label>
                        <textarea name="descriptionPopUp" placeholder="توضیحات را وارد کنید ...">{{$descriptionPopUp}}</textarea>
                    </div>
                    <div class="settingItem">
                        <label>عنوان دکمه</label>
                        <input type="text" name="buttonPopUp" value="{{$buttonPopUp}}" placeholder="مثال : مشاهده">
                    </div>
                    <div class="settingItemChecked">
                        <label for="s4" class="item">
                            فعال شدن پاپ آپ
                            <input id="s4" type="checkbox" name="popUpStatus" class="switch">
                        </label>
                    </div>
                    <button>ثبت اطلاعات</button>
                </form>
            </div>
        </div>
        <div class="filemanager">
            @include('admin.filemanager')
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var images = {!! json_encode($logo, JSON_HEX_TAG) !!};
            var popUpStatus = {!! json_encode($popUpStatus, JSON_HEX_TAG) !!};
            var frontStatus = {!! json_encode($frontStatus, JSON_HEX_TAG) !!};
            if(popUpStatus == 1){
                $("input[name='popUpStatus']").prop("checked", true );
            }else{
                $("input[name='popUpStatus']").prop("checked", false );
            }
            if(frontStatus == 1){
                $("input[name='frontStatus']").prop("checked", true );
            }else{
                $("input[name='frontStatus']").prop("checked", false );
            }
            $('.filemanager').hide();
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            if(images){
                $('.getImageItem').append(
                    $('<div class="getImagePic"><input type="hidden" name="image" value="'+images+'"><i><svg class="deleteImg"><use xlink:href="#trash"></use></svg></i><img src="'+images+'"></div>')
                        .on('click' , '.deleteImg',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
                $("input[name='image']").val(images);
            }
        })
    </script>
@endsection
