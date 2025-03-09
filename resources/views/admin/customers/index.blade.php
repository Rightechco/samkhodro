@extends('admin.master')

@section('title' , 'مشتری ها')
@section('tab' , 2)
@section('content')
    <div class="allLicence">
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/customer">همه مشتریان</a>
            </div>
            <div class="allTopTableItem">
                <a href="/admin/customer/create">افزودن مشتری</a>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/customer" class="filterContent" style="display:none;">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="title" placeholder="عنوان یا آیدی را وارد کنید" value="{{$title}}">
                        </div>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allData">
            <table class="licence1">
                <tr>
                    <th><h4>شناسه</h4></th>
                    <th><h4>نام</h4></th>
                    <th><h4>شماره</h4></th>
                    <th><h4>ایمیل</h4></th>
                    <th><h4>عملیات</h4></th>
                </tr>
                @foreach($users as $item)
                    <tr>
                        <td>
                            {{$item->id}}
                        </td>
                        <td>
                            <a href="/admin/customer/{{$item->id}}/edit">{{$item->name}}</a>
                        </td>
                        <td>{{$item->number}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            <div class="buttons">
                                @if(auth()->user()->can('ویرایش مشتریان') || auth()->user()->level == 3)
                                    <a href="/admin/customer/{{$item->id}}/edit">ویرایش</a>
                                @endif
                                @if(auth()->user()->can('حذف مشتریان') || auth()->user()->level == 3)
                                    <button id="{{$item->id}}">حذف</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $users->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف مشتری مطمئن هستید؟</div>
                <p>با حذف مشتری اطلاعات مشتری به طور کامل حذف میشوند</p>
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
                $('.buttonsPop form').attr('action' , '/admin/customer/' + post+'/delete');
            })
        })
    </script>
@endsection
