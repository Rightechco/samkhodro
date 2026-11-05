@extends('home.mobile.layout')

@section('title', 'ضوابط اجرایی خدمات پس از فروش وزارت صمت | سام موبایل')

@section('content')
<div class="container">
    <div class="page-header-card">
        <span class="section-tag">دستورالعمل‌های قانونی</span>
        <h1>ضوابط اجرایی خدمات پس از فروش وزارت صنعت، معدن و تجارت</h1>
        <p>مصوب کارگروه خدمات پس از فروش و ضوابط اختصاصی کالاهای الکتریکی، الکترونیکی و وسایل ارتباطی در ۴۰ ماده و ۴ پیوست</p>
    </div>

    <div class="glass-card regulations-card">
        <div class="reg-intro-box">
            <h3 style="color:#fff; font-size:17px; font-weight:800; margin-bottom:8px;">مقدمه و استناد قانونی:</h3>
            <p style="font-size:13.5px; line-height:1.8; color:var(--text-muted); margin:0;">
                به استناد تکالیف ناشی از مواد ۳، ۴ و ۲۱ قانون حمایت از حقوق مصرف‌کنندگان مصوب ۱۳۸۸/۰۷/۱۵ مجلس شورای اسلامی و ضوابط اختصاصی گروه کالایی لوازم‌خانگی، برقی و الکترونیک موضوع ماده ۲ تبصره ۴ ماده ۱۸ قانون مبارزه با قاچاق کالا و ارز ابلاغی مورخ ۱۳۹۸/۰۳/۰۱ ریاست محترم جمهوری، دستورالعمل شماره ۶۰/۲۰۷۸۶۸ و اصلاحیه ابلاغیه شماره ۶۰/۲۰۲۰۲۳ مورخ ۱۴۰۱/۰۸/۲۲ تحت عنوان <strong>«ضوابط اجرایی خدمات پس از فروش مصنوعات الکتریکی، الکترونیکی و وسایل ارتباطی»</strong> به شرح زیر در تمامی شعب و نمایندگی‌های شرکت تامین کانی سام لازم‌الاجرا می‌باشد.
            </p>
        </div>

        <!-- Highlight of Article 13 -->
        <div class="article-13-highlight" id="article13">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                <h3 style="color:#38bdf8; font-size:19px; font-weight:900;">ماده ۱۳ - ضوابط اجرائی سامانه مدیریت خدمات پس از فروش</h3>
                <span style="font-size:12px; padding:3px 10px; border-radius:12px; background:rgba(56,189,248,0.2); color:#38bdf8; font-weight:700;">مبنای سامانه مدیریت خدمات سام موبایل</span>
            </div>
            <p style="font-size:14.5px; line-height:1.85; color:#f8fafc; margin-bottom:14px;">
                عرضه‌کنندگان و واسطه خدمات پس از فروش مکلف به راه‌اندازی و بکارگیری سیستم‌های مبتنی بر فناوری اطلاعات جهت خدمات پس از فروش با قابلیت اتصال به «سامانه» و انتقال برخط و بهنگام اطلاعات می‌باشند. سیستم مذکور باید علاوه بر پایش قطعات مورد نیاز و تجهیز انبار قطعات و پایش و بهبود بخش‌های مختلف واحد خدمات پس از فروش، زمان دقیق مراجعه، تاریخ پذیرش و نوع خدمات ارائه شده را به طور کامل در سیستم تعریف نماید.
            </p>
            <div class="sub-rules-list">
                <div><strong>تبصره ۱:</strong> واسطه خدمات پس از فروش موظف به راه‌اندازی سامانه تلفنی جهت ثبت درخواست بوده که در آن زمان تماس و صدای مصرف‌کننده (حداقل یکماه) ذخیره گردد.</div>
                <div><strong>تبصره ۲:</strong> عرضه کنندگان موظف به ارائه آدرس اینترنتی لینک دسترسی به قانون حمایت از حقوق مصرف‌کنندگان در راهنمای محصول می‌باشند.</div>
                <div><strong>تبصره ۳:</strong> سیستم‌های خدمات پس از فروش باید حاوی بخش نظارت بر عملکرد نمایندگی‌های مجاز و کیفیت خدمات ارائه شده در شبکه تحت پوشش باشد.</div>
                <div><strong>تبصره ۴:</strong> سیستم‌ها باید حاوی بخش اخذ بازخورد در رابطه با کیفیت محصولات و خدمات و رسیدگی به شکایات و نظام نظرسنجی از مشتریان باشد.</div>
                <div><strong>تبصره ۵:</strong> واسطه خدمات پس از فروش باید هرگونه اطلاع‌رسانی در خصوص تشخیص عیب یا نقص کالا و یا اعلام دقیق زمان تحویل کالاهای مشمول تعمیر را از طریق سیستم خدمات پس از فروش به مصرف‌کننده اعلام نماید.</div>
            </div>
            <div style="margin-top:16px;">
                <a href="{{ route('mob.service-portal') }}" class="btn-glow" style="padding:10px 22px; font-size:13.5px;">
                    ورود به سامانه مدیریت خدمات منطبق بر ماده ۱۳
                </a>
            </div>
        </div>

        <!-- Highlight of Article 28 -->
        <div class="article-box" style="margin-top:24px;">
            <h3 style="color:#f59e0b; font-size:17px; font-weight:800; margin-bottom:8px;">ماده ۲۸ - حداقل مدت زمان ضمانت و تبصره‌های قانونی</h3>
            <p style="font-size:14px; line-height:1.8; color:var(--text-muted);">
                حداقل مدت زمان ضمانت برای کالاهای مشمول، ۲۴ ماه و برای تلفن همراه، تبلت و لوازم جانبی <strong>۱۸ ماه</strong> می‌باشد.<br>
                <strong>تبصره ۵ ماده ۲۸:</strong> مبنای محاسبه زمان شروع گارانتی برای کالاهای تلفن همراه و تبلت، زمان فعال‌سازی در سامانه همتا و <strong>حداکثر ۶ ماه پس از زمان اظهار واردات در سامانه جامع تجارت</strong> خواهد بود.
            </p>
        </div>

        <!-- Highlight of Article 16 -->
        <div class="article-box" style="margin-top:20px;">
            <h3 style="color:#10b981; font-size:17px; font-weight:800; margin-bottom:8px;">ماده ۱۶ - صورتحساب دقیق خدمات و ضمانت ۶ ماهه</h3>
            <p style="font-size:14px; line-height:1.8; color:var(--text-muted);">
                واسطه خدمات پس از فروش و نمایندگی مجاز تعمیر موظف هستند پیش از ارائه خدمات، تخمین هزینه‌ها را در اختیار مصرف‌کننده قرار داده و در صورت تأیید مصرف‌کننده اقدام نمایند. در پایان ارائه خدمات، باید صورتحساب دقیق شامل انواع خدمات یا قطعات استاندارد ارائه شده، بهای هر یک، نوع عیب، تاریخ شروع و خاتمه خدمات و توضیحات مرتبط با تضمین خدمت ارائه گردد. <strong>کلیه قطعات تعویضی و خدمات تعمیری دارای ۶ ماه ضمانت می‌باشند.</strong>
            </p>
        </div>

        <!-- Highlight of Article 38 -->
        <div class="article-box" style="margin-top:20px;">
            <h3 style="color:#818cf8; font-size:17px; font-weight:800; margin-bottom:8px;">ماده ۳۸ - نظام رسیدگی به شکایات</h3>
            <p style="font-size:14px; line-height:1.8; color:var(--text-muted);">
                مسئولیت رسیدگی به شکایات مصرف‌کنندگان و جلب رضایت ایشان در مرحله اول بر عهده عرضه‌کننده می‌باشد. در صورت عدم رفع اختلاف، از طریق انجمن تخصصی ذیربط و سازمان حمایت مصرف‌کنندگان و تولیدکنندگان قابل پیگیری خواهد بود.
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-header-card { text-align: center; padding: 40px 20px 20px; margin-bottom: 20px; }
    .page-header-card h1 { font-size: 26px; font-weight: 900; color: #fff; margin: 12px 0 8px; }
    .page-header-card p { font-size: 14.5px; color: var(--text-muted); max-width: 720px; margin: 0 auto; }

    .regulations-card { max-width: 960px; margin: 0 auto 40px; padding: 40px; }
    .reg-intro-box {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border-light);
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 26px;
    }

    .article-13-highlight {
        background: linear-gradient(135deg, rgba(3, 105, 161, 0.25), rgba(15, 23, 42, 0.9));
        border: 1px solid rgba(56, 189, 248, 0.45);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }
    .sub-rules-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-size: 13.5px;
        color: #cbd5e1;
        line-height: 1.7;
        background: rgba(0, 0, 0, 0.25);
        padding: 16px;
        border-radius: 12px;
    }
    .sub-rules-list strong { color: #38bdf8; }

    .article-box {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-light);
        border-radius: 16px;
        padding: 22px;
    }
</style>
@endpush
