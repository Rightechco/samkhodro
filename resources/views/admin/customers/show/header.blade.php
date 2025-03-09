<div class="allHeaderCustomer">
    <ul>
        @if(auth()->user()->can('مخاطبان') || auth()->user()->level == 3)
            <li>
                <a href="/admin/customer/{{$users->id}}/contact" class="{{$tab == 13 ? 'active': ''}}">مخاطبین</a>
            </li>
        @endif
        @if(auth()->user()->can('افزودن یادداشت') || auth()->user()->level == 3)
            <li>
                <a href="/admin/customer/{{$users->id}}/note" class="{{$tab == 1 ? 'active': ''}}">یادداشت ها</a>
            </li>
        @endif
        @if(auth()->user()->can('ویرایش مشتریان') || auth()->user()->level == 3)
            <li>
                <a href="/admin/customer/{{$users->id}}/edit" class="{{$tab == 0 ? 'active': ''}}">ویرایش مشتری</a>
            </li>
        @endif
        @if(auth()->user()->can('تیکت') || auth()->user()->level == 3)
            <li>
                <a href="/admin/customer/{{$users->id}}/ticket" class="{{$tab == 12 ? 'active': ''}}">تیکت ها</a>
            </li>
        @endif
        @if(auth()->user()->can('گالری') || auth()->user()->level == 3)
            <li>
                <a href="/admin/customer/{{$users->id}}/file" class="{{$tab == 11 ? 'active': ''}}">فایل ها</a>
            </li>
        @endif
        @if(auth()->user()->can('فعالیت ها') || auth()->user()->level == 3)
            <li>
                <a href="/admin/customer/{{$users->id}}/event" class="{{$tab == 4 ? 'active': ''}}">اعلان ها</a>
            </li>
        @endif
    </ul>
</div>
