@extends('home.master')

@section('title' , ' - ورود / ثبت نام ')
@section('active' , 1)
@section('content')
    <div class="authIndex width">
        <div class="wrapper">
            <div class="sign-panels">
                <div class="login">
                    <div class="title">
                        <span>ورود / ثبت نام</span>
                        <p>خوش آمدید، لطفا به حساب کاربری خود وارد شوید. شما می توانید با گوگل یا حالت عادی وارد شوید</p>
                    </div>

                    <div>
                        <a href="/google-login" class="btn-face">ورود از طریق گوگل</a>
                    </div>

                    <div class="or"><span>یا</span></div>

                    <div class="level1">
                        <input type="text" name="authData" placeholder="ایمیل یا شماره تماس">
                        <input type="checkbox" id="remember">
                        <label for="remember">مرا بخاطر بسپار</label>
                        <button class="btn-signin">ورود</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var preAddress = {!! json_encode($pre, JSON_HEX_TAG) !!};
            number = $("input[name='authData']").val('');
            var number ='';
            var code ='';
            var buttons = '';
            $('.level1 button').click(function(){
                $(this).text('صبر کنید ...');
                buttons = $(this);
                if(number == ''){
                    number = $("input[name='authData']").val();
                    var form = {
                        "_token": "{{ csrf_token() }}",
                        "authData": number,
                    };

                    $.ajax({
                        url: "/check-auth",
                        type: "post",
                        data: form,
                        success: function (data) {
                            if(data[1] == 0){
                                number = '';
                                buttons.text('تایید');
                                $.toast({
                                    text: "شماره تماس یا ایمیل درست را وارد کنید",
                                    heading: "دقت کنید",
                                    icon: 'error',
                                    showHideTransition: 'fade',
                                    allowToastClose: true,
                                    hideAfter: 3000,
                                    stack: 5,
                                    position: 'bottom-left',
                                    textAlign: 'left',
                                    loader: true,
                                    loaderBg: '#c60000',
                                });
                            }
                            else{
                                if(data == 'exist'){
                                    $('.level1').remove();
                                    $('.login').append(
                                        $('<div class="level2">'+
                                            '<input type="password" id="authPassword" name="password" placeholder="رمز ورود را وارد کنید ...">'+
                                            '<button class="btn-signin">ورود</button>'+
                                            '<button class="forget">رمز عبورتان را فراموش کردید؟</button>'+
                                            '</div>')
                                            .on('click' , '.btn-signin',function(ss){
                                                var password = $("input[name='password']").val();
                                                var form = {
                                                    "_token": "{{ csrf_token() }}",
                                                    "authData": number,
                                                    "password": password,
                                                };
                                                $.ajax({
                                                    url: "/enter-auth",
                                                    type: "post",
                                                    data: form,
                                                    success: function (data) {
                                                        if(data == 'success'){
                                                            $.toast({
                                                                heading: "انجام شد",
                                                                text: 'ورود با موفقیت انجام شد',
                                                                icon: 'success',
                                                                showHideTransition: 'fade',
                                                                allowToastClose: true,
                                                                hideAfter: 3000,
                                                                stack: 5,
                                                                position: 'bottom-left',
                                                                textAlign: 'left',
                                                                loader: true,
                                                                loaderBg: '#9EC600',
                                                            });
                                                            window.location.href=preAddress;
                                                        }
                                                        if(data == 'format'){
                                                            $.toast({
                                                                heading: "اطلاعات اشتباه",
                                                                text: 'شماره تماس یا ایمیل شما اشتباه میباشد',
                                                                icon: 'error',
                                                                showHideTransition: 'fade',
                                                                allowToastClose: true,
                                                                hideAfter: 3000,
                                                                stack: 5,
                                                                position: 'bottom-left',
                                                                textAlign: 'left',
                                                                loader: true,
                                                                loaderBg: '#c60000',
                                                            });
                                                        }
                                                        if(data == 'no'){
                                                            $.toast({
                                                                heading: "اطلاعات اشتباه",
                                                                text: 'رمز ورود اشتباه هست',
                                                                icon: 'error',
                                                                showHideTransition: 'fade',
                                                                allowToastClose: true,
                                                                hideAfter: 3000,
                                                                stack: 5,
                                                                position: 'bottom-left',
                                                                textAlign: 'left',
                                                                loader: true,
                                                                loaderBg: '#c60000',
                                                            });
                                                        }
                                                    },
                                                })
                                            })
                                            .on('click' , '.forget',function(ss){
                                                var form = {
                                                    "_token": "{{ csrf_token() }}",
                                                    "authData": number,
                                                };
                                                $.ajax({
                                                    url: "/change-password",
                                                    type: "post",
                                                    data: form,
                                                    success: function (data) {
                                                        $('.authIndex .level2').remove();
                                                        $('.login').append(
                                                            $(
                                                                '<div class="level2">'+
                                                                '<input type="text" id="authNumber" name="code" placeholder="کد ورود را وارد کنید ...">'+
                                                                '<button class="btn-signin">تایید</button>'+
                                                                '</div>')
                                                                .on('click' , 'button',function(){
                                                                    code=$("input[name='code']").val();
                                                                    var form = {
                                                                        "_token": "{{ csrf_token() }}",
                                                                        "authData": number,
                                                                        "code": code,
                                                                    };
                                                                    $.ajax({
                                                                        url: "/check-pass-code",
                                                                        type: "post",
                                                                        data: form,
                                                                        success: function (data) {
                                                                            if(data == 'ok'){
                                                                                $('.level2').remove();
                                                                                $('.login').append(
                                                                                    $(
                                                                                        '<div class="level3">'+
                                                                                        '<input type="password" id="authPassword" name="password" placeholder="رمز عبور را وارد کنید ...">'+
                                                                                        '<input type="password" id="authConfirmed" name="confirmed" placeholder="رمز عبور را وارد کنید ...">'+
                                                                                        '<button class="btn-signin">تایید</button>'+
                                                                                        '</div>')
                                                                                        .on('click' , 'button',function(){
                                                                                            var form = {
                                                                                                "_token": "{{ csrf_token() }}",
                                                                                                "authData": number,
                                                                                                "code": code,
                                                                                                "password": $("input[name='password']").val(),
                                                                                                "confirmed": $("input[name='confirmed']").val(),
                                                                                            };
                                                                                            $.ajax({
                                                                                                url: "/change-user-password",
                                                                                                type: "post",
                                                                                                data: form,
                                                                                                success: function (data) {
                                                                                                    if(data == 'time'){
                                                                                                        $.toast({
                                                                                                            heading: "اتمام زمان",
                                                                                                            text: 'زمان ثبت نام شما به پایان رسید مجدد تست کنید',
                                                                                                            icon: 'error',
                                                                                                            showHideTransition: 'fade',
                                                                                                            allowToastClose: true,
                                                                                                            hideAfter: 3000,
                                                                                                            stack: 5,
                                                                                                            position: 'bottom-left',
                                                                                                            textAlign: 'left',
                                                                                                            loader: true,
                                                                                                            loaderBg: '#c60000',
                                                                                                        });
                                                                                                    }
                                                                                                    if(data == 'format'){
                                                                                                        $.toast({
                                                                                                            heading: "اطلاعات اشتباه",
                                                                                                            text: 'شماره تماس یا ایمیل شما اشتباه میباشد',
                                                                                                            icon: 'error',
                                                                                                            showHideTransition: 'fade',
                                                                                                            allowToastClose: true,
                                                                                                            hideAfter: 3000,
                                                                                                            stack: 5,
                                                                                                            position: 'bottom-left',
                                                                                                            textAlign: 'left',
                                                                                                            loader: true,
                                                                                                            loaderBg: '#c60000',
                                                                                                        });
                                                                                                    }
                                                                                                    if(data == 'success'){
                                                                                                        $.toast({
                                                                                                            heading: "انجام شد",
                                                                                                            text: 'ثبت نام شما با موفقیت انجام شد',
                                                                                                            icon: 'success',
                                                                                                            showHideTransition: 'fade',
                                                                                                            allowToastClose: true,
                                                                                                            hideAfter: 3000,
                                                                                                            stack: 5,
                                                                                                            position: 'bottom-left',
                                                                                                            textAlign: 'left',
                                                                                                            loader: true,
                                                                                                            loaderBg: '#9EC600',
                                                                                                        });
                                                                                                        window.location.href=preAddress;
                                                                                                    }
                                                                                                },
                                                                                                error: function (errors) {
                                                                                                    if(errors.responseJSON.errors['password']){
                                                                                                        $.toast({
                                                                                                            heading: "رمز عبور",
                                                                                                            text: errors.responseJSON.errors['password'],
                                                                                                            icon: 'error',
                                                                                                            showHideTransition: 'fade',
                                                                                                            allowToastClose: true,
                                                                                                            hideAfter: 3000,
                                                                                                            stack: 5,
                                                                                                            position: 'bottom-left',
                                                                                                            textAlign: 'left',
                                                                                                            loader: true,
                                                                                                            loaderBg: '#c60000',
                                                                                                        });
                                                                                                    }
                                                                                                    if(errors.responseJSON.errors['name']){
                                                                                                        $.toast({
                                                                                                            text: "نام",
                                                                                                            heading: errors.responseJSON.errors['name'],
                                                                                                            icon: 'error',
                                                                                                            showHideTransition: 'fade',
                                                                                                            allowToastClose: true,
                                                                                                            hideAfter: 3000,
                                                                                                            stack: 5,
                                                                                                            position: 'bottom-left',
                                                                                                            textAlign: 'left',
                                                                                                            loader: true,
                                                                                                            loaderBg: '#c60000',
                                                                                                        });
                                                                                                    }
                                                                                                }
                                                                                            })
                                                                                        })
                                                                                );
                                                                            }else{
                                                                                $.toast({
                                                                                    text: "کد تایید",
                                                                                    title: "کد تاییدی که وارد کردید اشتباه است",
                                                                                    icon: 'error',
                                                                                    showHideTransition: 'fade',
                                                                                    allowToastClose: true,
                                                                                    hideAfter: 3000,
                                                                                    stack: 5,
                                                                                    position: 'bottom-left',
                                                                                    textAlign: 'left',
                                                                                    loader: true,
                                                                                    loaderBg: '#c60000',
                                                                                });
                                                                            }
                                                                        },
                                                                        error: function (xhr) {
                                                                            $.toast({
                                                                                text: "کد تایید اشتباه است", // Text that is to be shown in the toast
                                                                                heading: 'دقت کنید', // Optional heading to be shown on the toast
                                                                                icon: 'error', // Type of toast icon
                                                                                showHideTransition: 'fade', // fade, slide or plain
                                                                                allowToastClose: true, // Boolean value true or false
                                                                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                                                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                                                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                                                                textAlign: 'left',
                                                                                loader: true,
                                                                                loaderBg: '#c60000',
                                                                            });
                                                                        }
                                                                    })
                                                                })
                                                        );
                                                    },
                                                })
                                            })
                                    );
                                }
                                if(data == 'code'){
                                    $('.level1').remove();
                                    $('.login').append(
                                        $(
                                            '<div class="authItems level2">'+
                                            '<input type="text" id="authNumber" name="code" placeholder="کد ورود را وارد کنید ...">'+
                                            '<button class="btn-signin">تایید</button>'+
                                            '</div>')
                                            .on('click' , 'button',function(){
                                                code=$("input[name='code']").val();
                                                var form = {
                                                    "_token": "{{ csrf_token() }}",
                                                    "authData": number,
                                                    "code": code,
                                                };
                                                $.ajax({
                                                    url: "/check-code",
                                                    type: "post",
                                                    data: form,
                                                    success: function (data) {
                                                        if(data == 'ok'){
                                                            $('.level2').remove();
                                                            $('.login').append(
                                                                $(
                                                                    '<div class="authItems level3">'+
                                                                    '<input type="text" id="authUser" name="name" placeholder="نام کاربری را وارد کنید ...">'+
                                                                    '<input type="password" id="authPassword" name="password" placeholder="رمز عبور را وارد کنید ...">'+
                                                                    '<input type="password" id="authConfirmed" name="confirmed" placeholder="تکرار رمز عبور را وارد کنید ...">'+
                                                                    '<button class="btn-signin">تایید</button>'+
                                                                    '</div>')
                                                                    .on('click' , 'button',function(){
                                                                        $(this).text('صبر کنید ...');
                                                                        buttons = $(this);
                                                                        var form = {
                                                                            "_token": "{{ csrf_token() }}",
                                                                            "authData": number,
                                                                            "code": code,
                                                                            "user": $("input[name='name']").val(),
                                                                            "password": $("input[name='password']").val(),
                                                                            "confirmed": $("input[name='confirmed']").val(),
                                                                            "referral": $("input[name='referral']").val(),
                                                                        };
                                                                        $.ajax({
                                                                            url: "/add-user",
                                                                            type: "post",
                                                                            data: form,
                                                                            success: function (data) {
                                                                                if(data == 'time'){
                                                                                    $.toast({
                                                                                        heading: "اتمام زمان",
                                                                                        text: 'زمان ثبت نام شما به پایان رسید مجدد تست کنید',
                                                                                        icon: 'error',
                                                                                        showHideTransition: 'fade',
                                                                                        allowToastClose: true,
                                                                                        hideAfter: 3000,
                                                                                        stack: 5,
                                                                                        position: 'bottom-left',
                                                                                        textAlign: 'left',
                                                                                        loader: true,
                                                                                        loaderBg: '#c60000',
                                                                                    });
                                                                                }
                                                                                if(data == 'format'){
                                                                                    $.toast({
                                                                                        heading: "اطلاعات اشتباه",
                                                                                        text: 'شماره تماس یا ایمیل شما اشتباه میباشد',
                                                                                        icon: 'error',
                                                                                        showHideTransition: 'fade',
                                                                                        allowToastClose: true,
                                                                                        hideAfter: 3000,
                                                                                        stack: 5,
                                                                                        position: 'bottom-left',
                                                                                        textAlign: 'left',
                                                                                        loader: true,
                                                                                        loaderBg: '#c60000',
                                                                                    });
                                                                                }
                                                                                if(data == 'success'){
                                                                                    $.toast({
                                                                                        heading: "انجام شد",
                                                                                        text: 'ثبت نام شما با موفقیت انجام شد',
                                                                                        icon: 'success',
                                                                                        showHideTransition: 'fade',
                                                                                        allowToastClose: true,
                                                                                        hideAfter: 3000,
                                                                                        stack: 5,
                                                                                        position: 'bottom-left',
                                                                                        textAlign: 'left',
                                                                                        loader: true,
                                                                                        loaderBg: '#9EC600',
                                                                                    });
                                                                                    window.location.href=preAddress;
                                                                                }
                                                                            },
                                                                            error: function (errors) {
                                                                                buttons.text('تایید');
                                                                                if(errors.responseJSON.errors['password']){
                                                                                    $.toast({
                                                                                        heading: "رمز عبور",
                                                                                        text: errors.responseJSON.errors['password'],
                                                                                        icon: 'error',
                                                                                        showHideTransition: 'fade',
                                                                                        allowToastClose: true,
                                                                                        hideAfter: 3000,
                                                                                        stack: 5,
                                                                                        position: 'bottom-left',
                                                                                        textAlign: 'left',
                                                                                        loader: true,
                                                                                        loaderBg: '#c60000',
                                                                                    });
                                                                                }
                                                                                if(errors.responseJSON.errors['user']){
                                                                                    $.toast({
                                                                                        heading: "نام",
                                                                                        text: errors.responseJSON.errors['user'],
                                                                                        icon: 'error',
                                                                                        showHideTransition: 'fade',
                                                                                        allowToastClose: true,
                                                                                        hideAfter: 3000,
                                                                                        stack: 5,
                                                                                        position: 'bottom-left',
                                                                                        textAlign: 'left',
                                                                                        loader: true,
                                                                                        loaderBg: '#c60000',
                                                                                    });
                                                                                }
                                                                            }
                                                                        })
                                                                    })
                                                            );
                                                        }else{
                                                            $.toast({
                                                                heading: "کد تایید",
                                                                text: "کد تاییدی که وارد کردید اشتباه است",
                                                                icon: 'error',
                                                                showHideTransition: 'fade',
                                                                allowToastClose: true,
                                                                hideAfter: 3000,
                                                                stack: 5,
                                                                position: 'bottom-left',
                                                                textAlign: 'left',
                                                                loader: true,
                                                                loaderBg: '#c60000',
                                                            });
                                                        }
                                                    },
                                                    error: function (xhr) {
                                                        $.toast({
                                                            text: "کد تایید اشتباه است", // Text that is to be shown in the toast
                                                            heading: 'دقت کنید', // Optional heading to be shown on the toast
                                                            icon: 'error', // Type of toast icon
                                                            showHideTransition: 'fade', // fade, slide or plain
                                                            allowToastClose: true, // Boolean value true or false
                                                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                                            textAlign: 'left',
                                                            loader: true,
                                                            loaderBg: '#c60000',
                                                        });
                                                    }
                                                })
                                            })
                                    );
                                }
                                if(data == 'ban'){
                                    $.toast({
                                        text: "حساب کاربری شما به حالت تعلیق در آمده",
                                        heading: "تعلیق موقت",
                                        icon: 'error',
                                        showHideTransition: 'fade',
                                        allowToastClose: true,
                                        hideAfter: 3000,
                                        stack: 5,
                                        position: 'bottom-left',
                                        textAlign: 'left',
                                        loader: true,
                                        loaderBg: '#c60000',
                                    });
                                }
                            }
                        },
                        error: function (xhr) {
                            buttons.text('تایید');
                            number = '';
                            if(xhr.responseJSON.errors['g-recaptcha-response']){
                                $.toast({
                                    text: "فیلد کپچا الزامی است",
                                    heading: "دقت کنید",
                                    icon: 'error',
                                    showHideTransition: 'fade',
                                    allowToastClose: true,
                                    hideAfter: 3000,
                                    stack: 5,
                                    position: 'bottom-left',
                                    textAlign: 'left',
                                    loader: true,
                                    loaderBg: '#c60000',
                                });
                            }
                            else{
                                $.toast({
                                    text: "شماره تماس یا ایمیل درست را وارد کنید",
                                    heading: "دقت کنید",
                                    icon: 'error',
                                    showHideTransition: 'fade',
                                    allowToastClose: true,
                                    hideAfter: 3000,
                                    stack: 5,
                                    position: 'bottom-left',
                                    textAlign: 'left',
                                    loader: true,
                                    loaderBg: '#c60000',
                                });
                            }
                        }
                    });
                }
            })
        })
    </script>
@endsection
