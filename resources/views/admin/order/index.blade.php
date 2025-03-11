@extends('admin.master')

@section('title' , 'همه سفارشات')
@section('tab',26)
@section('content')
    <div class="allLicence">
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/order">همه سفارشات</a>
            </div>
            <div class="allTopTableItem">
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allData">
            <table class="contact1">
                <tr>
                    <th><h4>آیدی</h4></th>
                    <th><h4>کاربر</h4></th>
                    <th><h4>محصول</h4></th>
                    <th><h4>وضعیت</h4></th>
                    <th><h4>عملیات</h4></th>
                </tr>
                @foreach($orders as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->product->title}}</td>
                        <td><span class="span badge-{{ $item->classStatus() }}">{{ $item->nameStatus() }}</span></td>
                        <td>
                            <div class="buttons">
                                @if(auth()->user()->can('ویرایش سفارش') || auth()->user()->level == 3)
                                    <a href="/admin/order/{{$item->id}}/edit">ویرایش</a>
                                @endif
                                @if(auth()->user()->can('حذف سفارش') || auth()->user()->level == 3)
                                    <button id="{{$item->id}}">حذف</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $orders->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف سفارش مطمئن هستید؟</div>
                <p>با حذف سفارش اطلاعات سفارش به طور کامل حذف میشوند</p>
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
            $('.filterContent').hide();
            $('.filemanager').show();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , 'button' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/order/' + post+'/delete');
            })
        })
    </script>
@endsection
