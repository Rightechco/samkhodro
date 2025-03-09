@extends('admin.master')

@section('title' , 'همه محصولات')
@section('tab' , 11)
@section('content')
    <div class="allLicence">
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/product">همه محصولات</a>
            </div>
            <div class="allTopTableItem">
                @if(auth()->user()->can('افزودن محصول') || auth()->user()->level == 3)
                    <a href="/admin/product/create">افزودن محصول</a>
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
                    <form method="GET" action="/admin/product" class="filterContent" style="display:none;">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و sku</label>
                            <input type="text" name="title" placeholder="عنوان یا sku را وارد کنید" value="{{$title}}">
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
            <table class="contact1">
                <tr>
                    <th><h4>عنوان</h4></th>
                    <th><h4>sku</h4></th>
                    <th><h4>قیمت</h4></th>
                    <th><h4>تعداد</h4></th>
                    <th><h4>عملیات</h4></th>
                </tr>
                @foreach($products as $item)
                    <tr>
                        <td>
                            {{$item->title}}
                        </td>
                        <td>
                            {{$item->sku}}
                        </td>
                        <td>{{number_format($item->priceF)}} تومان</td>
                        <td>
                            {{$item->count}}
                        </td>
                        <td>
                            <div class="buttons">
                                @if(auth()->user()->can('ویرایش محصول') || auth()->user()->level == 3)
                                    <a href="/admin/product/{{$item->id}}/edit">ویرایش</a>
                                @endif
                                @if(auth()->user()->can('حذف محصول') || auth()->user()->level == 3)
                                    <button id="{{$item->id}}">حذف</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $products->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف محصول مطمئن هستید؟</div>
                <p>با حذف محصول اطلاعات محصول به طور کامل حذف میشوند</p>
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
                $('.buttonsPop form').attr('action' , '/admin/product/' + post+'/delete');
            })
        })
    </script>
@endsection
