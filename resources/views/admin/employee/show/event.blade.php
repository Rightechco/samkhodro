@extends('admin.master')

@section('title' , 'اعلان های ' . $user->name)
@section('tab' , 19)
@section('content')
    <div class="allNote">
        @include('admin.employee.show.header' , ['tab' => 4,'users' => $user])
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTables">
            <div>
                <table>
                    <tr>
                        <th>عنوان</th>
                        <th>ثبت کننده</th>
                        <th>زمان ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($events as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            @if($item->user)
                                <td>{{$item->user->name}}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>{{$item->created_at}}</td>
                            <td>
                                <div class="buttons">
                                    @if(auth()->user()->can('ویرایش فعالیت ها') || auth()->user()->level == 3)
                                        <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                    @endif
                                    @if(auth()->user()->can('حذف فعالیت ها') || auth()->user()->level == 3)
                                        <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $events->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/employee/{{$user->id}}/event" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>عنوان*</label>
                        <input type="text" name="title" placeholder="عنوان را وارد کنید">
                        @error('title')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>توضیح*</label>
                        <textarea name="body" placeholder="توضیح را وارد کنید"></textarea>
                        @error('body')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="buttonForm">
                        <button type="submit">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف اعلان مطمئن هستید؟</div>
                <p>با حذف اعلان اطلاعات اعلان به طور کامل حذف میشوند</p>
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
            var events = {!! $events->toJson() !!};
            var user = {!! json_encode($user, JSON_HEX_TAG) !!};
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
                $('.buttonsPop form').attr('action' , '/admin/employee/'+user.id+'/event/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    event:post,
                };
                $.ajax({
                    url: '/admin/employee/'+user.id+'/event/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/employee/'+user.id+'/event/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/employee/'+user.id+'/event');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("textarea[name='body']").val('');
                                $("input[name='title']").val('');
                            })
                        )
                        $("textarea[name='body']").val(data.body);
                        $("input[name='title']").val(data.title);
                    },
                });
            })
        })
    </script>
@endsection
