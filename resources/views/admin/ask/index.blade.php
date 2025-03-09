@extends('admin.master')

@section('title' , 'سوالات متداول')
@section('tab',18)
@section('content')
    <div class="allLicence">
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/ask">همه سوال ها</a>
            </div>
            <div class="allTopTableItem">
                @if(auth()->user()->can('افزودن سوال متداول') || auth()->user()->level == 3)
                    <a href="/admin/ask/create">افزودن سوال متداول</a>
                @endif
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/ask" class="filterContent">
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
            <table class="grid5">
                <tr>
                    <th><h4>آیدی</h4></th>
                    <th><h4>عنوان</h4></th>
                    <th><h4>زمان ثبت</h4></th>
                    <th><h4>عملیات</h4></th>
                </tr>
                @foreach($asks as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <div class="buttons">
                                <a href="/admin/ask/{{$item->id}}/edit">ویرایش</a>
                                <button id="{{$item->id}}">حذف</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $asks->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف سوال مطمئن هستید؟</div>
                <p>با حذف سوال اطلاعات سوال به طور کامل حذف میشوند</p>
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
                $('.buttonsPop form').attr('action' , '/admin/ask/' + post+'/delete');
            })
        })
    </script>
@endsection
