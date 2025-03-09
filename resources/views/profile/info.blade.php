@extends('home.master')

@section('active' , 1)
@section('title' , 'ویرایش کاربر - ')
@section('content')
    <div class="allProfileIndex width">
        @include('profile.list' , ['tab' => 8])
        <div class="allUserIndexInfo">
            <form method="post" id="upload-image-form" enctype="multipart/form-data">
                @csrf
                <div class="sendImage">
                    <input type="file" id="post_cover" class="dropify" name="image"/>
                </div>
                <button type="submit" id="upload-image">آپلود</button>
            </form>
            <form action="/profile/change-all-user-info" method="POST">
                @csrf
                @method('post')
                <div class="allUserIndexInfoPersonal">
                    <div class="allUserIndexInfoPersonalItems">
                        <div class="allUserIndexInfoPersonalItem">
                            <label>نام کاربری</label>
                            <input type="text" placeholder="نام کاربری" name="name" value="{{auth()->user()->name}}">
                        </div>
                        <div class="allUserIndexInfoPersonalItem">
                            <label>شهر</label>
                            <input type="text" placeholder="شهر" value="{{auth()->user()->city}}" name="city">
                        </div>
                    </div>
                    <div class="allUserIndexInfoPersonalItems">
                        <div class="allUserIndexInfoPersonalItem">
                            <label>جنسیت</label>
                            <select name="gender">
                                <option value="0">مرد</option>
                                <option value="1">زن</option>
                            </select>
                        </div>
                        <div class="allUserIndexInfoPersonalItem">
                            <label>ویرایش رمز عبور (در صورت تغییر وارد کنید)</label>
                            <input type="password" placeholder="ویرایش رمز عبور" name="password">
                        </div>
                    </div>
                </div>
                <button class="infoButton">ویرایش حساب</button>
            </form>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var user = {!! json_encode(auth()->user(), JSON_HEX_TAG) !!};
            $(".allUserIndexInfoPersonalItem select[name='gender']").val(user.gender);
            $('#upload-image-form').submit(function(e) {
                $(".upload-image-form button").text('صبر کنید ...');
                if($(".upload-image-form button").text() != 'صبر کنید ...'){
                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type:'POST',
                        url: `/profile/upload-profile`,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (response) => {
                            $(".upload-image-form button").text('آپلود');
                            if (response) {
                                $.toast({
                                    text: "لوگوی شما انتخاب شد", // Text that is to be shown in the toast
                                    heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                                    icon: 'success', // Type of toast icon
                                    showHideTransition: 'fade', // fade, slide or plain
                                    allowToastClose: true, // Boolean value true or false
                                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                    textAlign: 'left',  // Text alignment i.e. left, right or center
                                    loader: true,  // Whether to show loader or not. True by default
                                    loaderBg: '#9EC600',  // Background color of the toast loader
                                });
                            }
                        },
                        error: function(response){
                            $('#image-input-error').text(response.responseJSON.errors.file);
                        }
                    });
                }else{
                    e.preventDefault();
                    let formData = new FormData(this);
                    $.ajax({
                        type:'get',
                        url: `/`,
                        data: formData,
                        contentType: false,
                        processData: false,
                    });
                }
            });
            $('.dropify').dropify({
                messages: {
                    default: "لوگو خود را انتخاب کنید",
                    replace: "لوگو خود را انتخاب کنید",
                    remove: "حذف تصویر",
                    error: "خطایی به وجود آمده است. دوباره تلاش کنید.",
                }
            });
        })
    </script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/dropify.min.css"/>
    <script src="/js/dropify.min.js"></script>
@endsection
