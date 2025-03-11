@extends('admin.master')

@section('title' , 'همه نوبت ها')
@section('tab',27)
@section('content')
    <div class="allLicence">
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/appointment">همه نوبت ها</a>
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
                    <th><h4>زمان</h4></th>
                    <th><h4>وضعیت</h4></th>
                    <th><h4>عملیات</h4></th>
                </tr>
                @foreach($appointments as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user->name}}</td>
                        <td style="direction: ltr">{{verta($item->time)->format('Y-n-j H:i')}}</td>
                        <td><span class="span badge-{{ $item->classStatus() }}">{{ $item->nameStatus() }}</span></td>
                        <td>
                            <div class="buttons">
                                @if(auth()->user()->can('ویرایش سفارش') || auth()->user()->level == 3)
                                    <a href="/admin/appointment/{{$item->id}}/edit">ویرایش</a>
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
        {{ $appointments->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف نوبت مطمئن هستید؟</div>
                <p>با حذف نوبت اطلاعات نوبت به طور کامل حذف میشوند</p>
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
                $('.buttonsPop form').attr('action' , '/admin/appointment/' + post+'/delete');
            })
        })
    </script>
@endsection
