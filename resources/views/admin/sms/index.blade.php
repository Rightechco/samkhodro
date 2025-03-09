@extends('admin.master')

@section('title' , 'قالب پیامک')
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
                            <th>متغیرها</th>
                            <th>پترن</th>
                            <th>زمان ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($sms as $item)
                            <tr>
                                <td>{{$item->body}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="buttons">
                                        @if(auth()->user()->can('ویرایش پیامک') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                        @endif
                                        @if(auth()->user()->can('حذف پیامک') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $sms->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/sms" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>پترن*</label>
                        <input type="text" name="name" placeholder="کد قالب را وارد کنید">
                        @error('name')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>
                            متغیر ها به ترتیب*
                            <span class="showVar">نمایش متغیر ها</span>
                        </label>
                        <input type="text" name="body" style="direction: ltr" placeholder="متغیر ها با , جدا کنید (مثال : user,admin)">
                        @error('body')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="dataLearn">
                        <ul style="display: none">
                            <li>کد تایید: <span>active</span></li>
                            <li>نام کاربر: <span>user</span></li>
                            <li>نام مدیر اصلی: <span>admin</span></li>
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
            var sms = {!! $sms->toJson() !!};
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
                let bodyData = $(".filledItem input[name='body']");
                if(bodyData.val() == ''){
                    bodyData.val(bodyData.val() + $(this)[0].firstElementChild.textContent);
                }else{
                    bodyData.val(bodyData.val() + ','+$(this)[0].firstElementChild.textContent);
                }
            });
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/sms/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    sms:post,
                };
                $.ajax({
                    url: '/admin/sms/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/sms/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/sms/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='name']").val('');
                                $("input[name='body']").val('');
                            })
                        )
                        $("input[name='name']").val(data.name);
                        $("input[name='body']").val(data.body);
                    },
                });
            })
        })
    </script>
@endsection
