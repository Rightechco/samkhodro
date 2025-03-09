@extends('admin.master')

@section('title' , 'قالب ایمیل')
@section('tab' , 16)
@section('content')
    <div class="allNote">
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTables">
            <div>
                <div class="allData">
                    <table>
                        <tr>
                            <th>متن</th>
                            <th>عنوان</th>
                            <th>زمان ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($email as $item)
                            <tr>
                                <td>{{$item->body}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="buttons">
                                        @if(auth()->user()->can('ویرایش ایمیل') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                        @endif
                                        @if(auth()->user()->can('حذف ایمیل') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $email->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/sms" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>عنوان*</label>
                        <input type="text" name="name" placeholder="عنوان را وارد کنید">
                        @error('name')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>
                            متن و قالب ایمیل*
                            <span class="showVar">نمایش متغیر ها</span>
                        </label>
                        <textarea type="text" name="body" placeholder="متغیر ها را درون {} بزارید (مثال : {user})"></textarea>
                        @error('body')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="dataLearn">
                        <ul style="display: none">
                            <li>کد تایید: <span>active</span></li>
                            <li>نام کاربر: <span>user</span></li>
                            <li>نام مدیر: <span>admin</span></li>
                            <li>نام سایت: <span>title</span></li>
                            <li>آدرس سایت: <span>webUrl</span></li>
                            <li>شماره تماس شما: <span>adminNumber</span></li>
                            <li>شماره تماس کاربر: <span>userNumber</span></li>
                            <li>ایمیل شما: <span>adminEmail</span></li>
                            <li>ایمیل کاربر: <span>userEmail</span></li>
                            <li>شماره فاکتور: <span>factorNumber</span></li>
                            <li>نام پروژه: <span>projectName</span></li>
                            <li>شماره قرارداد: <span>contractId</span></li>
                            <li>زمان شروع: <span>startTime</span></li>
                            <li>زمان پایان: <span>contractExpire</span></li>
                        </ul>
                    </div>
                    <div class="buttonForm">
                        <button type="submit">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف پترن مطمئن هستید؟</div>
                <p>با حذف پترن اطلاعات پترن به طور کامل حذف میشوند</p>
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
            $('.showVar').click(function(){
                $('.dataLearn ul').toggle();
            });
            $('.dataLearn ul li').click(function(){
                let bodyData = $(".filledItem textarea[name='body']");
                bodyData.val(bodyData.val() + '{'+$(this)[0].firstElementChild.textContent+'}');
            });
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/email/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    sms:post,
                };
                $.ajax({
                    url: '/admin/email/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/email/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/email/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='name']").val('');
                                $("textarea[name='body']").val('');
                            })
                        )
                        $("input[name='name']").val(data.name);
                        $("textarea[name='body']").val(data.body);
                    },
                });
            })
        })
    </script>
@endsection
