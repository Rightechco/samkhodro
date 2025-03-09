@extends('admin.master')

@section('title' , 'نوع مشتری')
@section('tab' , 23)
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
                            <th>نام</th>
                            <th>آیدی</th>
                            <th>زمان ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($typeCustomers as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="buttons">
                                        @if(auth()->user()->can('تاکسونامی') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                        @endif
                                        @if(auth()->user()->can('تاکسونامی') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $typeCustomers->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/type-customer" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>نام*</label>
                        <input type="text" name="name" placeholder="نام را وارد کنید">
                        @error('name')
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
                <div class="title">آیا از حذف نوع مشتری مطمئن هستید؟</div>
                <p>با حذف نوع مشتری اطلاعات نوع مشتری به طور کامل حذف میشوند</p>
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
                $('.buttonsPop form').attr('action' , '/admin/type-customer/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    note:post,
                };
                $.ajax({
                    url: '/admin/type-customer/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/type-customer/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/type-customer/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='name']").val('');
                            })
                        )
                        $("input[name='name']").val(data.name);
                    },
                });
            })
        })
    </script>
@endsection
