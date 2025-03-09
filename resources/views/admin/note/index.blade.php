@extends('admin.master')

@section('title' , 'یادداشت')
@section('tab' , 3)
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
                            <th>یادداشت</th>
                            <th>ثبت کننده</th>
                            <th>زمان ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($notes as $item)
                            <tr>
                                <td>{{$item->body}}</td>
                                @if($item->user)
                                    <td>{{$item->user->name}}</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="buttons">
                                        @if(auth()->user()->can('ویرایش یادداشت') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                        @endif
                                        @if(auth()->user()->can('حذف یادداشت') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $notes->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/note" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>یادداشت*</label>
                        <textarea name="body" placeholder="یادداشت را وارد کنید"></textarea>
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
                <div class="title">آیا از حذف یادداشت مطمئن هستید؟</div>
                <p>با حذف یادداشت اطلاعات یادداشت به طور کامل حذف میشوند</p>
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
                $('.buttonsPop form').attr('action' , '/admin/note/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    note:post,
                };
                $.ajax({
                    url: '/admin/note/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/note/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/note/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("textarea[name='body']").val('');
                            })
                        )
                        $("textarea[name='body']").val(data.body);
                    },
                });
            })
        })
    </script>
@endsection
