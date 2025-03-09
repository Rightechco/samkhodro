@extends('admin.master')

@section('title' , 'افزودن ویجت')
@section('tab' , 18)
@section('content')
<div class="allCreateWidget">
    <div class="topProductIndex">
        <div class="right">
            <a href="/admin">داشبورد</a>
            <span>/</span>
            <a href="/admin/widget">ویجت ها</a>
            <span>/</span>
            <a href="/admin/widget/create">افزودن ویجت</a>
        </div>
    </div>
    <div class="createWidget">
        <div class="createItem change1">
            <label for="name">نوع ویجت</label>
            <select name="name">
                <option value="cover">اسلایدر بزرگ</option>
                <option value="service">خدمات</option>
                <option value="sendReq">ارسال درخواست</option>
                <option value="comment">نظرات مشتریان</option>
                <option value="blog">بلاگ</option>
                <option value="product">محصولات</option>
                <option value="team">تیم</option>
                <option value="ability">توانایی</option>
                <option value="option">گزارش</option>
            </select>
        </div>
        <div class="createItems">
            <div class="createItem change2">
                <label>عنوان :</label>
                <input type="text" placeholder="عنوان را وارد کنید" name="title">
            </div>
            <div class="createItem change3">
                <label>عنوان مشاهده بیشتر :</label>
                <input type="text" placeholder="عنوان را وارد کنید" name="more">
            </div>
            <div class="createItem change5">
                <label>توضیحات :</label>
                <input type="text" placeholder="توضیحات را وارد کنید" name="description">
            </div>
            <div class="createItem change7">
                <label>پیوند یکتا (slug) :</label>
                <input type="text" placeholder="پیوند را وارد کنید" name="slug">
            </div>
            <div class="createItem change8">
                <label>آدرس تصویر :</label>
                <input type="text" placeholder="آدرس را وارد کنید" name="background">
            </div>
            <div class="createItem change9">
                <label>تعداد نمایش :</label>
                <input type="text" placeholder="تعداد را وارد کنید" name="count">
            </div>
            <div class="createItem">
                <label>وضعیت نمایش :</label>
                <select name="status">
                    <option value="0">پیشنویس</option>
                    <option value="1" selected>انتشار</option>
                </select>
            </div>
        </div>
        <div class="abilityPost change15">
            <table class="abilityTable" id="ads1">
                <tr>
                    <th>تصویر تبلیغ</th>
                    <th>آدرس تبلیغ</th>
                    <th>
                        <i id="addAd1">
                            <svg class="icon">
                                <use xlink:href="#add"></use>
                            </svg>
                        </i>
                    </th>
                </tr>
            </table>
        </div>
        <div class="abilityPost change17">
            <table class="abilityTable" id="ads3">
                <tr>
                    <th>تصویر مشتری</th>
                    <th>نام مشتری</th>
                    <th>شغل / حرفه</th>
                    <th>دیدگاه مشتری</th>
                    <th>
                        <i id="addAd3">
                            <svg class="icon">
                                <use xlink:href="#add"></use>
                            </svg>
                        </i>
                    </th>
                </tr>
            </table>
        </div>
        <div class="abilityPost change18">
            <table class="abilityTable" id="ads2">
                <tr>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>توضیحات</th>
                    <th>آدرس مشاهده بیشتر</th>
                    <th>
                        <i id="addAd2">
                            <svg class="icon">
                                <use xlink:href="#add"></use>
                            </svg>
                        </i>
                    </th>
                </tr>
            </table>
        </div>
        <button class="button" name="createPost" type="submit">ثبت ویجت</button>
    </div>
</div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            $('#addAd1').click(function (){
                $('#ads1').append(
                    $('<tr><td><input type="text" name="image" placeholder="تصویر را وارد کنید"></td><td><input type="text" name="address" placeholder="آدرس را وارد کنید"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            $('#addAd2').click(function (){
                $('#ads2').append(
                    $('<tr><td><input type="text" name="image" placeholder="تصویر را وارد کنید"></td><td><input type="text" name="title" placeholder="عنوان را وارد کنید"></td><td><input type="text" name="body" placeholder="توضیحات را وارد کنید"></td><td><input type="text" name="address" placeholder="آدرس را وارد کنید"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            $('#addAd3').click(function (){
                $('#ads3').append(
                    $('<tr><td><input type="text" name="image" placeholder="تصویر را وارد کنید"></td><td><input type="text" name="name" placeholder="نام را وارد کنید"></td><td><input type="text" name="job" placeholder="شغل / حرفه را وارد کنید"></td><td><input type="text" name="body" placeholder="دیدگاه را وارد کنید"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            if($("select[name='name']").val() == 'cover'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change5').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
            }
            if($("select[name='name']").val() == 'sendReq'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change5').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change18').hide();
            }
            if($("select[name='name']").val() == 'service'){
                $('.change3').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change14').hide();
                $('.change15').hide();
                $('.change17').hide();
                $('.change18').hide();
            }
            if($("select[name='name']").val() == 'team'){
                $('.change3').hide();
                $('.change5').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change14').hide();
                $('.change15').hide();
                $('.change17').hide();
                $('.change18').hide();
            }
            if($("select[name='name']").val() == 'comment'){
                $('.change3').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
            }
            if($("select[name='name']").val() == 'blog'){
                $('.change5').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change18').hide();
            }
            if($("select[name='name']").val() == 'product'){
                $('.change3').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change18').hide();
            }
            if($("select[name='name']").val() == 'ability' || $("select[name='name']").val() == 'option'){
                $('.change3').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change18').hide();
            }
            $("select[name='name']").change(function (){
                $('.change2').show();
                $('.change3').show();
                $('.change5').show();
                $('.change7').show();
                $('.change8').show();
                $('.change9').show();
                $('.change14').show();
                $('.change15').show();
                $('.change16').show();
                $('.change17').show();
                $('.change18').show();
                if(this.value == 'cover'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change5').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                }
                if(this.value == 'service'){
                    $('.change3').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change15').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
                if(this.value == 'team'){
                    $('.change3').hide();
                    $('.change5').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change15').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
                if(this.value == 'sendReq'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change5').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
                if(this.value == 'comment'){
                    $('.change3').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                }
                if(this.value == 'product'){
                    $('.change3').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
                if(this.value == 'blog'){
                    $('.change5').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
                if(this.value == 'ability' || this.value == 'option'){
                    $('.change3').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
            })
            $("button[name='createPost']").click(function(event){
                var name = $("select[name='name']").val();
                var title = $("input[name='title']").val();
                var more = $("input[name='more']").val();
                var description = $("input[name='description']").val();
                var background = $("input[name='background']").val();
                var slug = $("input[name='slug']").val();
                var count = $("input[name='count']").val();
                var status = $("select[name='status']").val();

                var ads1 = [];
                $("#ads1 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad1 = {
                            image:"",
                            address:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad1.image = this.value;
                            }
                            if (this.name == 'address') {
                                ad1.address = this.value;
                            }
                        })
                        ads1.push(ad1);
                    }
                });

                var ads2 = [];
                $("#ads2 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad2 = {
                            image:"",
                            address:"",
                            title:"",
                            body:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad2.image = this.value;
                            }
                            if (this.name == 'title') {
                                ad2.title = this.value;
                            }
                            if (this.name == 'body') {
                                ad2.body = this.value;
                            }
                            if (this.name == 'address') {
                                ad2.address = this.value;
                            }
                        })
                        ads2.push(ad2);
                    }
                });

                var ads3 = [];
                $("#ads3 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad3 = {
                            image:"",
                            name:"",
                            job:"",
                            body:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad3.image = this.value;
                            }
                            if (this.name == 'name') {
                                ad3.name = this.value;
                            }
                            if (this.name == 'job') {
                                ad3.job = this.value;
                            }
                            if (this.name == 'body') {
                                ad3.body = this.value;
                            }
                        })
                        ads3.push(ad3);
                    }
                });

                var form = {
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    title:title,
                    more:more,
                    description:description,
                    background:background,
                    slug:slug,
                    count:count,
                    status:status,
                    ads1:JSON.stringify(ads1),
                    ads2:JSON.stringify(ads2),
                    ads3:JSON.stringify(ads3),
                };

                $.ajax({
                    url: "/admin/widget/create",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "ویجت اضافه شد", // Text that is to be shown in the toast
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
                        window.location.href="/admin/widget";
                    },
                    error: function (xhr) {
                        $.toast({
                            text: "فیلد های ستاره دار را پر کنید", // Text that is to be shown in the toast
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
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('#validation-' + key).append('<div class="alert alert-danger">'+value+'</div');
                        });
                    }
                });
            });
        })
    </script>
@endsection

@section('links')
    <script src="/js/jquery.toast.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
@endsection
