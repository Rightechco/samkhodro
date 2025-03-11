@extends('admin.master')

@section('title' , 'مقام ها')
@section('tab' , 20)
@section('content')
    <div class="allCost">
        @if (\Session::has('message'))
            <div class="success">
                {!! \Session::get('message') !!}
            </div>
        @endif
        @if(auth()->user()->can('افزودن مقام') || auth()->user()->level == 3)
            <div class="costIndex">
                <div class="addCost">افزودن مقام</div>
            </div>
        @endif
        <div class="allTables">
            <div class="allData allData2">
                <table class="grid5">
                    <tr>
                        <th>آیدی</th>
                        <th>مقام</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($roles as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <div class="buttons">
                                    @if(auth()->user()->can('ویرایش مقام') || auth()->user()->level == 3)
                                        <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                    @endif
                                    @if(auth()->user()->can('حذف مقام') || auth()->user()->level == 3)
                                        <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="addField" style="display:none;">
                <form action="/admin/role" method="post">
                    @csrf
                    <div class="allForms">
                        <div class="formItem">
                            <label>نام مقام*</label>
                            <input type="text" name="name" placeholder="نام را وارد کنید ...">
                        </div>
                        <div class="allData">
                            <table class="grid5">
                                <tr>
                                    <th>دسترسی</th>
                                    <th>نمایش</th>
                                    <th>افزودن</th>
                                    <th>ویرایش</th>
                                    <th>جزییات</th>
                                    <th>حذف</th>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        مقام ها
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="role" value="مقام">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="role" value="افزودن مقام">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="role" value="ویرایش مقام">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="role" value="حذف مقام">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        بلاگ
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="blog" value="بلاگ">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="blog" value="افزودن بلاگ">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="blog" value="ویرایش بلاگ">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="blog" value="جزییات بلاگ">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="blog" value="حذف بلاگ">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        پیامک
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="sms" value="پیامک">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="sms" value="افزودن پیامک">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="sms" value="ویرایش پیامک">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="sms" value="حذف پیامک">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        ایمیل
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="email" value="ایمیل">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="email" value="افزودن ایمیل">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="email" value="ویرایش ایمیل">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="email" value="حذف ایمیل">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        مشتریان
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="customer" value="مشتریان">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="customer" value="افزودن مشتریان">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="customer" value="ویرایش مشتریان">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="customer" value="حذف مشتریان">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        کارمندان
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="employee" value="کارمندان">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="employee" value="افزودن کارمندان">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="employee" value="ویرایش کارمندان">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="employee" value="حذف کارمندان">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        یادداشت
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="note" value="یادداشت">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="note" value="افزودن یادداشت">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="note" value="ویرایش یادداشت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="note" value="حذف یادداشت">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        محصول
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="product" value="محصول">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="product" value="افزودن محصول">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="product" value="ویرایش محصول">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="product" value="حذف محصول">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        لینک
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="link" value="لینک">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="link" value="افزودن لینک">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="link" value="ویرایش لینک">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="link" value="حذف لینک">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        ویجت
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="widget" value="ویجت">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="widget" value="افزودن ویجت">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="widget" value="ویرایش ویجت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="widget" value="حذف ویجت">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        تیکت
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="ticket" value="تیکت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="ticket" value="بستن تیکت">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        فعالیت ها
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="event" value="فعالیت ها">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="event" value="افزودن فعالیت ها">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="event" value="ویرایش فعالیت ها">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="event" value="حذف فعالیت ها">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        سفارش
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="order" value="سفارش">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="order" value="ویرایش سفارش">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="order" value="حذف سفارش">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        نوبت
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="appointment" value="نوبت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="appointment" value="ویرایش نوبت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="appointment" value="حذف نوبت">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        برگه ها
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="page" value="برگه ها">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="page" value="افزودن برگه ها">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="page" value="ویرایش برگه ها">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="page" value="حذف برگه ها">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        سوالات متداول
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="ask" value="سوالات متداول">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s2d" type="checkbox" class="switch" name="ask" value="افزودن سوالات متداول">
                                        </label>
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s3d" type="checkbox" class="switch" name="ask" value="ویرایش سوالات متداول">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="ask" value="حذف سوالات متداول">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        درخواست مشتریان
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="demand" value="درخواست مشتریان">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="demand" value="حذف درخواست مشتریان">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        گالری
                                    </td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s1d" type="checkbox" class="switch" name="gallery" value="گالری">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd">
                                        <label>
                                            <input id="s4d" type="checkbox" class="switch" name="gallery" value="حذف گالری">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        تنظیمات سئو
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="setting1" value="تنظیمات سئو">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        تنظیمات سایت
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="setting2" value="تنظیمات سایت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        تنظیمات پیامک
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="setting4" value="تنظیمات پیامک">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        تنظیمات اسکریپت
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="setting5" value="تنظیمات اسکریپت">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                </tr>
                                <tr>
                                    <td class="roleTd">
                                        تاکسونامی
                                        <label>
                                            <input id="s0d" type="checkbox" class="switch" name="tax" value="تاکسونامی">
                                        </label>
                                    </td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                    <td class="roleTd"></td>
                                </tr>
                            </table>
                        </div>
                        <button class="addBtn">ثبت مقام</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف مقام مطمئن هستید؟</div>
                <p>با حذف مقام اطلاعات مقام به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.popUp').hide();
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/role/' + post+'/delete');
            })
            $('.selectAll').click(function() {
                if ($(this).is(':checked')) {
                    $.each($("input[name="+this.name+"]") , function (){
                        $(this).prop('checked', true);
                    })
                } else {
                    $.each($("input[name="+this.name+"]") , function (){
                        $(this).prop('checked', false);
                    })
                }
            });
            $('.buttons').on('click' , '.editButton' ,function(){
                $("input[type='checkbox']").prop('checked' , false);
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    role:post,
                };
                $.ajax({
                    url: '/admin/role/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.allData2').toggle();
                        $('.addField').toggle();
                        $("input[name='name']").val(data.name);
                        $('.addCost').text('مشاهده همه مقام ها');
                        $.each($("input[type='checkbox']"),function (){
                            if($.inArray($(this).attr('value'), $.map(data.permissions, function(o) { return o["name"]; })) !== -1){
                                $(this).prop('checked' , true);
                            }
                        })
                    },
                });
            })
            $('.addBtn').click(function (e) {
                e.preventDefault();
                var name = $("input[name='name']").val();
                var permissions = [];
                $.each($("input[type='checkbox']") , function () {
                    if($(this).prop('checked')){
                        if($(this)[0]['defaultValue']){
                            permissions.push($(this)[0]['defaultValue']);
                        }
                    }
                })

                var form = {
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    permissions:JSON.stringify(permissions),
                };

                $.ajax({
                    url: post >= 1 ? '/admin/role/' + post+'/edit' : "/admin/role",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $("button[class='addBtn']").text('ثبت مقام');
                        window.location.reload();
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
                        $("button[class='addBtn']").text('ثبت مقام');
                    }
                });
            })
            $('.addCost').click(function (){
                $("input[type='checkbox']").prop('checked' , false);
                $('.allData2').toggle();
                $('.addField').toggle();
                post = 0;
                $("input[name='name']").val('');
                if($('.addCost').text() == 'افزودن مقام'){
                    $('.addCost').text('مشاهده همه مقام ها');
                }else{
                    $('.addCost').text('افزودن مقام');
                }
            })
        })
    </script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
@endsection
