<div class="allSideBar" style="background:{{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
    <div class="logoHeaderPanel">
        <a href="/">
            <img src="{{\App\Models\Setting::where('key' , 'logo')->pluck('value')->first()}}">
        </a>
    </div>
    <div class="allSideBarItem">
        <a href="/admin" class="allSideBarIconsText">
            <div class="active" style="display:none;" id="showList1">
                <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                    <svg class="icon">
                        <use xlink:href="#home"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">داشبورد</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList1">
                <i>
                    <svg class="icon">
                        <use xlink:href="#home"></use>
                    </svg>
                </i>
                داشبورد
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
        </a>
        <a href="/admin/learn" class="allSideBarIconsText">
            <div class="active" style="display:none;" id="showList26">
                <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                    <svg class="icon">
                        <use xlink:href="#learn"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">آموزش پنل مدیریت</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList26">
                <i>
                    <svg class="icon">
                        <use xlink:href="#learn"></use>
                    </svg>
                </i>
                آموزش پنل مدیریت
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
        </a>
        @if(auth()->user()->can('افزودن مشتریان') || auth()->user()->can('مشتریان') || auth()->user()->can('جزییات مشتریان') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList2">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#customer"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">مشتری ها</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList2">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#customer"></use>
                        </svg>
                    </i>
                    مشتری ها
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList2" class="active">
                    @if(auth()->user()->can('افزودن مشتریان') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/customer/create">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن مشتری
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('مشتریان') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/customer">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                همه مشتریان
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('افزودن محصول') || auth()->user()->can('محصول') || auth()->user()->can('ویرایش محصول') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList11">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#luggage-cart"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">محصولات</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList11">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#luggage-cart"></use>
                        </svg>
                    </i>
                    محصولات
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList11" class="active">
                    @if(auth()->user()->can('افزودن محصول') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/product/create">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن محصول
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('محصول') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/product">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                همه محصولات
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('افزودن بلاگ') || auth()->user()->can('بلاگ') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList17">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#blog"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">بلاگ ها</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList17">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#blog"></use>
                        </svg>
                    </i>
                    بلاگ ها
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList17" class="active">
                    @if(auth()->user()->can('افزودن بلاگ') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/blog/create">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن بلاگ
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('بلاگ') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/blog">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                همه بلاگ ها
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('سفارش') || auth()->user()->level == 3)
            <a href="/admin/order" class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList26">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#notebook"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">سفارش</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList26">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#notebook"></use>
                        </svg>
                    </i>
                    سفارش
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('نوبت') || auth()->user()->level == 3)
            <a href="/admin/appointment" class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList27">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#notebook"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">سفارش</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList27">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#notebook"></use>
                        </svg>
                    </i>
                    نوبت
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('یادداشت') || auth()->user()->level == 3)
            <a href="/admin/note" class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList3">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#notebook"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">یادداشت</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList3">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#notebook"></use>
                        </svg>
                    </i>
                    یادداشت
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('گالری') || auth()->user()->level == 3)
            <a href="/admin/gallery" class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList4">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#file1"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">گالری</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList4">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#file1"></use>
                        </svg>
                    </i>
                    گالری
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('افزودن کارمندان') || auth()->user()->can('کارمندان') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList19">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#worker"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">کارمندان</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList19">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#worker"></use>
                        </svg>
                    </i>
                    کارمندان
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList19" class="active">
                    @if(auth()->user()->can('افزودن کارمندان') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/employee/create">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن کارمند
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('کارمندان') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/employee">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                همه کارمندان
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('تیکت') || auth()->user()->level == 3)
            <a href="/admin/ticket" class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList5">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#ticket"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">تیکت ها</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList5">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#ticket"></use>
                        </svg>
                    </i>
                    تیکت ها
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('فعالیت ها') || auth()->user()->can('پیامک') || auth()->user()->can('ایمیل') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList16">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#notice"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">اعلان ها</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList16">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#notice"></use>
                        </svg>
                    </i>
                    اعلان ها
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList16" class="active">
                    @if(auth()->user()->can('فعالیت ها') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/event">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                فعالیت ها
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('پیامک') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/sms">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                قالب های پیامک
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('ایمیل') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/email">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                قالب های ایمیل
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('مقام') || auth()->user()->level == 3)
            <a href="/admin/role" class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList20">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#role"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">مقام ها</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList20">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#role"></use>
                        </svg>
                    </i>
                    مقام ها
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('تاکسونامی') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList23">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#box"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">تاکسونامی</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList23">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#box"></use>
                        </svg>
                    </i>
                    تاکسونامی
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList23" class="active">
                    <li>
                        <a href="/admin/category">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            دسته بندی ها
                        </a>
                    </li>
                    <li>
                        <a href="/admin/tag">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            برچسب ها
                        </a>
                    </li>
                    <li>
                        <a href="/admin/ability">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            توانایی ها
                        </a>
                    </li>
                    <li>
                        <a href="/admin/service">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            خدمات
                        </a>
                    </li>
                    <li>
                        <a href="/admin/team">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            تیم ما
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('افزودن لینک') || auth()->user()->can('لینک') || auth()->user()->can('افزودن ویجت') || auth()->user()->can('ویجت') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList18">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#globe"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">فرانت سایت</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList18">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#globe"></use>
                        </svg>
                    </i>
                    فرانت سایت
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList18" class="active">
                    @if(auth()->user()->can('افزودن لینک') || auth()->user()->can('لینک') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/link">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                لینک ها
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('افزودن برگه ها') || auth()->user()->can('برگه ها') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/page">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن و نمایش برگه ها
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('ویجت') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/widget">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن و نمایش ویجت ها
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('سوالات متداول') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/ask">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن و نمایش سوالات متداول
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('درخواست مشتریان') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/demand">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                درخواست مشتریان
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('درخواست مشتریان') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/subscribe">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                درخواست مشترک شدن
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->can('تنظیمات درگاه') || auth()->user()->can('تنظیمات پیامک') || auth()->user()->can('تنظیمات اسکریپت') || auth()->user()->level == 3)
            <div class="allSideBarIconsText">
                <div class="active" style="display:none;" id="showList21">
                    <i style="background: {{\App\Models\Setting::where('key' , 'sideColor')->pluck('value')->first()}}">
                        <svg class="icon">
                            <use xlink:href="#settings"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">تنظیمات</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList21">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#settings"></use>
                        </svg>
                    </i>
                    تنظیمات
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList21" class="active">
                    @if(auth()->user()->can('تنظیمات سئو') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/setting/seo">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                تنظیمات سئو
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/setting/manage">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                تنظیمات سایت
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('تنظیمات پیامک') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/setting/message">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                تنظیمات پیامک
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('تنظیمات اسکریپت') || auth()->user()->level == 3)
                        <li>
                            <a href="/admin/setting/script">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                تنظیمات اسکریپت
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</div>
@section('script2')
    <script>
        $(document).ready(function(){
            var tab = '{!! app()->view->getSections()['tab'] !!}';
            $('.allSideBarIconsText>.active').hide();
            if(tab == 0){
                $('.allSideBarIconsText>#showList1').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 2){
                $('.allSideBarIconsText>#showList2').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 3){
                $('.allSideBarIconsText>#showList3').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 4){
                $('.allSideBarIconsText>#showList4').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 5){
                $('.allSideBarIconsText>#showList5').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 6){
                $('.allSideBarIconsText>#showList6').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 7){
                $('.allSideBarIconsText>#showList7').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 8){
                $('.allSideBarIconsText>#showList8').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 9){
                $('.allSideBarIconsText>#showList9').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 10){
                $('.allSideBarIconsText>#showList10').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 11){
                $('.allSideBarIconsText>#showList11').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 12){
                $('.allSideBarIconsText>#showList12').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 13){
                $('.allSideBarIconsText>#showList13').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 14){
                $('.allSideBarIconsText>#showList14').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 15){
                $('.allSideBarIconsText>#showList15').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 16){
                $('.allSideBarIconsText>#showList16').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 17){
                $('.allSideBarIconsText>#showList17').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 18){
                $('.allSideBarIconsText>#showList18').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 19){
                $('.allSideBarIconsText>#showList19').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 20){
                $('.allSideBarIconsText>#showList20').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 21){
                $('.allSideBarIconsText>#showList21').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 22){
                $('.allSideBarIconsText>#showList22').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 23){
                $('.allSideBarIconsText>#showList23').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 24){
                $('.allSideBarIconsText>#showList24').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 25){
                $('.allSideBarIconsText>#showList25').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 26){
                $('.allSideBarIconsText>#showList28').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 27){
                $('.allSideBarIconsText>#showList27').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            $('.allSideBarIconsText>#showList1').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList1').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList2').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList2').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList3').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList3').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList4').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList4').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList5').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList5').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList6').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList6').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList7').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList7').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList8').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList8').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList9').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList9').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList10').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList10').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList11').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList11').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList12').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList12').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList13').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList13').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList14').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList14').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList15').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList15').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList16').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList16').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList17').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList17').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList18').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList18').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList19').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList19').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList20').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList20').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList21').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList21').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList22').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList22').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList23').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList23').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList24').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList24').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList25').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList25').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList26').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList26').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList27').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList27').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
        })
    </script>
@endsection
