@extends('admin.master')

@section('title' , 'آموزش پنل مدیریت')
@section('tab' , 1)
@section('content')
    <div class="allLearnDash">
        <label class="search">
            <input type="text" name="search" placeholder="عنوان سوال را جستجو کنید">
            <button>پیدا کن!</button>
        </label>
        <div class="questions" id="customer">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد مشتری</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا بر روی
                        <span>"مشتری ها"</span>
                        در سایدبار کلیک کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"افزودن مشتری"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات مشتری خود را وارد کنید و سپس بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div class="questions" id="employee">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد کارمند</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا باید تاکسونامی های
                        <a href="#role">"مقام"</a>
                        را درست کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"کارمندان"</span>
                        در سایدبار کلیک کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"افزودن کارمند"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات مشتری خود را وارد کنید و سپس بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="product" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد محصول</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا باید تاکسونامی
                        <a href="#category">"دسته بندی"</a>
                        را درست کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"محصولات"</span>
                        در سایدبار کلیک کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"افزودن محصول"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات محصول خود را وارد کنید و سپس بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="blog" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد بلاگ</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا باید
                        <a href="#category">"دسته بندی"</a>
                        ,
                        <a href="#tag">"برچسب"</a>
                        را درست کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"بلاگ"</span>
                        در سایدبار کلیک کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"افزودن بلاگ"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات بلاگ خود را وارد کنید و سپس بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="note" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد یادداشت</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا بر روی
                        <span>"یادداشت"</span>
                        در سایدبار کلیک کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات یادداشت خود را وارد کنید و سپس بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="ticket" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد تیکت</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا بر روی
                        <span>"تیکت ها"</span>
                        در سایدبار کلیک کنید
                    </li>
                    <li>
                        سپس سمت راست بر روی گذینه
                        <span>"+"</span>
                        کلیک کنید
                    </li>
                    <li>
                        سپس اطلاعات را وارد کنید و بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="event" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد فعالیت</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        در بخش فعالیت میتوانید
                        <span>"فعالیت های مشتریان"</span>
                        را کنترل و اضافه کنید
                    </li>
                    <li>
                        ابتدا گزینه
                        <span>"اعلان ها"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"فعالیت ها"</span>
                        کلیک کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات فعالیت را وارد کنید و سپس بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="sms" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد قالب پیامکی</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"اعلان ها"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"قالب های پیامک"</span>
                        کلیک کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه بر روی
                        <span>"نمایش متغیر ها"</span>
                        در سمت چپ کلیک کنید
                    </li>
                    <li>
                        با استفاده از این متغیر ها در پنل پیامکی خود پترن درست کنید و متغیر هایی که در آنجا استفاده کردید را
                        <span>"به ترتیب"</span>
                        در بخش متغیر ها در سمت چپ قرار بدید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="email" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد قالب ایمیل</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"اعلان ها"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"قالب های ایمیل"</span>
                        کلیک کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه بر روی
                        <span>"نمایش متغیر ها"</span>
                        در سمت چپ کلیک کنید
                    </li>
                    <li>
                        با استفاده از این متغیر ها متن ایمیل خود را بنویسید و برای بخش های متغیر ایمیلتون از
                        <span>"متغیر ها"</span>
                        استفاده کنید
                    </li>
                    <li>
                        سپس بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="role" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد مقام</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"مقام ها"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی گزینه
                        <span>"افزودن مقام"</span>
                        کلیک کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه
                        <span>"دسترسی"</span>
                        هایی که میخواید را تیک بزنید
                    </li>
                    <li>
                        سپس دکمه
                        <span>"ثبت مقام"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="category" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد دسته بندی</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"تاکسونامی"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"دسته بندی"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات دسته بندی خود را وارد کنید و نوع آن را انتخاب کنید و بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="tag" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد برچسب</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"تاکسونامی"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"برچسب"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات برچسب خود را وارد کنید و نوع آن را انتخاب کنید و بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="ability" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد توانایی ها</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"تاکسونامی"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"توانایی ها"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات توانایی ها خود را وارد کنید و نوع آن را انتخاب کنید و بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="team" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد تیم</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"تاکسونامی"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"تیم"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات تیم خود را وارد کنید و نوع آن را انتخاب کنید و بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="service" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد خدمات</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"تاکسونامی"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"خدمات"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات خدمات خود را وارد کنید و نوع آن را انتخاب کنید و بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="link" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد لینک</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"فرانت سایت"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"لینک ها"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات لینک خود را وارد کنید و بر روی
                        <span>"ثبت اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="page" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد برگه</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"فرانت سایت"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"برگه ها"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی دکمه
                        <span>"افزودن برگه"</span>
                        کلیک کنید
                    </li>
                    <li>
                        بعد از ورود به این صفحه اطلاعات برگه خود را وارد کنید و بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="widget" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد ویجت</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"فرانت سایت"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"ویجت ها"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی دکمه
                        <span>"افزودن ویجت"</span>
                        کلیک کنید
                    </li>
                    <li>
                        در این بخش
                        <span>"نوع ویجت"</span>
                        که میخواید در صفحه اصلی قرار بگیرد را انتخاب کنید
                    </li>
                    <li>
                        سپس اطلاعات ویجت خود را وارد کنید و بر روی
                        <span>"ثبت ویجت"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
        <div id="widget2" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه کنترل ویجت</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"فرانت سایت"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"ویجت ها"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        در این بخش ویجتی که مدنظرتون هست را بکشید به سمت بالا یا پایین تا جا به جا شود
                    </li>
                </ul>
            </div>
        </div>
        <div id="ask" class="questions">
            <div class="title">
                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
                نحوه ایجاد سوالات متداول</div>
            <div class="description" style="display: none">
                <ul>
                    <li>
                        ابتدا گزینه
                        <span>"فرانت سایت"</span>
                        را در سایدبار انتخاب کنید
                    </li>
                    <li>
                        سپس گزینه
                        <span>"سوالات متداول"</span>
                        را انتخاب کنید
                    </li>
                    <li>
                        سپس بر روی دکمه
                        <span>"افزودن سوال متداول"</span>
                        کلیک کنید
                    </li>
                    <li>
                        سپس اطلاعات سوالات متداول خود را وارد کنید و بر روی
                        <span>"ارسال اطلاعات"</span>
                        کلیک کنید
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            $(".allLearnDash .search button").click(function (){
                $(".questions .description").hide();
                var text = $(".allLearnDash .search input").val();
                var gg = $('.title:contains('+text+')');
                $(gg[0]['parentElement']).children('.description').show();
                $('html, body').animate({
                    scrollTop: $(gg).offset().top -100
                }, 1000);
            })
            $(".questions .title").click(function (){
                $(".questions .description").hide();
                $($(this)[0]['parentElement']['lastElementChild']).toggle();
            })
            $(".questions .description a").click(function (e){
                e.preventDefault();
                $(".questions .description").hide();
                $($(this).attr('href')).children('.description').show();
                var dd = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(dd).offset().top -100
                }, 1000);
            })
        })
    </script>
@endsection
