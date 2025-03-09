@extends('admin.master')

@section('title' , 'مخاطبان')
@section('tab' , 2)
@section('content')
    <div class="allLicence">
        @include('admin.customers.show.header' , ['tab' => 13,'users' => $user])
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="{{url()->current()}}">همه مخاطبان</a>
            </div>
            <div class="allTopTableItem">
                @if(auth()->user()->can('افزودن مخاطبان') || auth()->user()->level == 3)
                    <a href="/admin/customer/{{$user->id}}/contact/create">افزودن مخاطبان</a>
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
                    <form method="GET" action="/admin/licence" class="filterContent" style="display:none;">
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
            <table class="contact1">
                <tr>
                    <th>
                        <h4>نام</h4>
                    </th>
                    <th>
                        <h4>ایمیل</h4>
                    </th>
                    <th>
                        <h4>شماره تماس</h4>
                    </th>
                    <th>
                        <h4>جنسیت</h4>
                    </th>
                    <th>
                        <h4>عملیات</h4>
                    </th>
                </tr>
                @foreach($users as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->email}}
                        </td>
                        <td>
                            {{$item->number}}
                        </td>
                        <td>
                            @if($item->gender == 0)
                                مرد
                            @elseif($item->gender == 1)
                                زن
                            @else
                                سایر
                            @endif
                        </td>
                        <td>
                            <div class="buttons">
                                @if(auth()->user()->can('ویرایش مخاطبان') || auth()->user()->level == 3)
                                    <a href="/admin/customer/{{$user->id}}/contact/{{$item->id}}/edit">ویرایش</a>
                                @endif
                                @if(auth()->user()->can('حذف مخاطبان') || auth()->user()->level == 3)
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
                <div class="title">آیا از حذف لایسنس مطمئن هستید؟</div>
                <p>با حذف لایسنس اطلاعات لایسنس به طور کامل حذف میشوند</p>
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
