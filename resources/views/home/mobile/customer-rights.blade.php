@extends('home.mobile.layout')

@section('title', 'منشور حقوق مشتریان و مصرف‌کنندگان | تامین کانی سام (موبایل)')
@section('meta_description', 'منشور رسمی حقوق مشتریان و خریداران تلفن همراه شرکت تامین کانی سام (موبایل) منطبق بر ضوابط اجرایی حمایت از حقوق مصرف‌کنندگان')

@push('styles')
<style>
    .cr-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px 16px 80px;
    }
    .cr-hero {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        border: 1px solid #bbf7d0;
        border-radius: 20px;
        padding: 32px 24px;
        margin-bottom: 24px;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.05);
        text-align: center;
    }
    .cr-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        padding: 4px 14px;
        border-radius: 99px;
        font-size: 0.78rem;
        font-weight: 800;
        margin-bottom: 12px;
    }
    .cr-title {
        font-size: 1.7rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0 0 10px 0;
    }
    .cr-subtitle {
        font-size: 0.92rem;
        color: #475569;
        margin: 0;
        line-height: 1.7;
        max-width: 850px;
        margin: 0 auto;
    }

    /* Law Warning Box (Tabreh 5 Madeh 28) */
    .cr-law-box {
        background: #fffbeb;
        border: 1.5px solid #fde68a;
        border-radius: 16px;
        padding: 18px 20px;
        margin-bottom: 28px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .cr-law-icon {
        color: #d97706;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .cr-law-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: #92400e;
        margin: 0 0 6px 0;
    }
    .cr-law-desc {
        font-size: 0.84rem;
        color: #78350f;
        line-height: 1.7;
        margin: 0;
    }

    /* 5 Core Rights Cards Grid */
    .cr-rights-grid {
        display: flex;
        flex-direction: column;
        gap: 18px;
        margin-bottom: 32px;
    }
    .cr-right-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 22px 24px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .cr-right-card:hover {
        border-color: #2563eb;
        box-shadow: 0 8px 30px rgba(37, 99, 235, 0.08);
        transform: translateY(-2px);
    }
    .cr-right-card::before {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, #2563eb, #3b82f6);
        border-radius: 4px 0 0 4px;
    }
    .cr-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .cr-card-num {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .cr-card-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }
    .cr-card-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .cr-card-list li {
        font-size: 0.88rem;
        color: #334155;
        line-height: 1.7;
        position: relative;
        padding-right: 22px;
    }
    .cr-card-list li::before {
        content: '✓';
        position: absolute;
        right: 0;
        top: 0;
        color: #059669;
        font-weight: 900;
    }

    /* Actions Bottom Bar */
    .cr-actions-bar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')
<div class="cr-container">

    <!-- Hero Header -->
    <div class="cr-hero">
        <div class="cr-pill">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>منشور رسمی حقوق مصرف‌کنندگان تلفن همراه و تبلت</span>
        </div>
        <h1 class="cr-title">منشور حقوق مشتریان شرکت تامین کانی سام (موبایل)</h1>
        <p class="cr-subtitle">
            مفاد منشور حقوق مشتریان و مصرف‌کنندگان در شرکت با هدف تکریم مراجعان، جلب رضایت حداکثری، شفافیت در ارائه خدمات و التزام به ضوابط سازمان حمایت از حقوق مصرف‌کنندگان به شرح زیر تدوین و اجرا می‌گردد.
        </p>
    </div>

    <!-- Legal Warning Alert (Tabreh 5 Madeh 28) -->
    <div class="cr-law-box">
        <div class="cr-law-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div>
            <div class="cr-law-title">تبصره ۵ ماده ۲۸ ضوابط اجرایی صمت (تاریخ آغاز گارانتی ۱۸ ماهه):</div>
            <p class="cr-law-desc">
                طبق ضوابط اجرایی وزارت صنعت، معدن و تجارت؛ در صورتی که تلفن همراه پس از <strong>۶ ماه از تاریخ ترخیص رسمی گمرک</strong> فعال‌سازی نگردد، مدت زمان گارانتی کالا از زمان صدور فاکتور معتبر خرید یا ترخیص محاسبه خواهد شد. خریداران محترم حق دارند در زمان خرید، استعلام دقیق تاریخ شروع و پایان گارانتی ۱۸ ماهه را از طریق سامانه استعلام برخط IMEI تامین کانی سام (موبایل) دریافت نمایند.
            </p>
        </div>
    </div>

    <!-- 5 Core Customer Rights (از متن رسمی chaboktondar.ir) -->
    <div class="cr-rights-grid">

        <!-- 1. برخورد محترمانه و عادلانه -->
        <div class="cr-right-card">
            <div class="cr-card-header">
                <span class="cr-card-num">۱</span>
                <h3 class="cr-card-title">حق برخورد محترمانه و عادلانه</h3>
            </div>
            <ul class="cr-card-list">
                <li>پرسنل و همکاران شرکت در کلیه شعب و نمایندگی‌ها موظف‌اند با احترام، ادب، آرامش و حسن نیت کامل با مراجعان و مشتریان برخورد کنند.</li>
                <li>تمامی مراجعان بدون هیچ‌گونه تبعیض و با رعایت کامل عدالت از خدمات شایسته کارگاهی و پذیرش گارانتی بهره‌مند خواهند شد.</li>
                <li>تکریم مراجعان شامل شنیدن دقیق درخواست‌ها، عیوب اظهارشده دستگاه، پاسخ‌گویی مناسب و تلاش برای رفع مشکلات در کوتاه‌ترین زمان ممکن است.</li>
            </ul>
        </div>

        <!-- 2. دریافت اطلاعات روشن و کامل -->
        <div class="cr-right-card">
            <div class="cr-card-header">
                <span class="cr-card-num">۲</span>
                <h3 class="cr-card-title">حق دریافت اطلاعات روشن و کامل</h3>
            </div>
            <ul class="cr-card-list">
                <li>اطلاعات مرتبط با فرایندها، ضوابط، مدارک مورد نیاز، هزینه‌ها، زمان‌بندی و شرایط ارائه خدمات به صورت شفاف در اختیار مشتری قرار می‌گیرد.</li>
                <li>راهنمایی‌های لازم درباره مراحل پیگیری درخواست‌ها و روند پذیرش و ترخیص توسط پرسنل ارائه می‌شود.</li>
                <li>هرگونه تغییر مؤثر در روند رسیدگی، نیاز به تامین قطعه از انبار مرکزی یا زمان‌بندی انجام کار، بلافاصله از طریق پیامک به اطلاع مشتری خواهد رسید.</li>
            </ul>
        </div>

        <!-- 3. دریافت خدمات ساده، شفاف و به‌موقع -->
        <div class="cr-right-card">
            <div class="cr-card-header">
                <span class="cr-card-num">۳</span>
                <h3 class="cr-card-title">حق دریافت خدمات ساده، شفاف و به‌موقع</h3>
            </div>
            <ul class="cr-card-list">
                <li>شرکت متعهد است تا فرایندهای پذیرش، عیب‌یابی اولیه و ترخیص تلفن همراه را تا حد امکان ساده، کوتاه و شفاف نگه دارد.</li>
                <li>درخواست‌های مشتریان در چارچوب ضوابط گارانتی ۱۸ ماهه و فرایندهای استاندارد بررسی شده و در زمان مقرر پاسخ داده می‌شوند.</li>
                <li>در صورت بروز هرگونه تأخیر در تامین قطعات یدکی استاندارد، علت و اطلاعات لازم جهت پیگیری سریعاً به مشتری اعلام می‌گردد.</li>
            </ul>
        </div>

        <!-- 4. ثبت درخواست، نظر، پیشنهاد و شکایت -->
        <div class="cr-right-card">
            <div class="cr-card-header">
                <span class="cr-card-num">۴</span>
                <h3 class="cr-card-title">حق ثبت درخواست، نظر، پیشنهاد و شکایت</h3>
            </div>
            <ul class="cr-card-list">
                <li>مشتریان حق دارند درخواست‌ها، دیدگاه‌ها، پیشنهادها، انتقادها و شکایت‌های خود را از طریق کانال‌ها و فرم‌های ارتباطی اعلام‌شده (فرم شکایت ماده ۱۳ و تیکتینگ) ثبت کنند.</li>
                <li>شرکت متعهد است که درخواست‌ها و شکایت‌های ثبت‌شده را ظرف حداکثر ۲ روز کاری بررسی کرده و پاسخ مستند و قانونی را از مسیرهای تعیین‌شده ارائه دهد.</li>
                <li>راهنمایی‌های لازم درباره نحوه ثبت و پیگیری شکایت یا درخواست به مراجعان ارائه می‌شود و از بازخوردها برای بهبود کیفیت خدمات کارگاه استفاده می‌گردد.</li>
            </ul>
        </div>

        <!-- 5. حفظ حریم خصوصی و محرمانگی اطلاعات -->
        <div class="cr-right-card">
            <div class="cr-card-header">
                <span class="cr-card-num">۵</span>
                <h3 class="cr-card-title">حق حفظ حریم خصوصی و محرمانگی اطلاعات</h3>
            </div>
            <ul class="cr-card-list">
                <li>اطلاعات شخصی، حافظه تلفن همراه و اسناد محرمانه مشتریان با رعایت دقیق اصول و تدابیر امنیتی و حرفه‌ای نگهداری می‌شود.</li>
                <li>این اطلاعات صرفاً در چارچوب ارائه خدمات فنی و انجام تعهدات مربوطه مورد استفاده قرار می‌گیرد و بدون مجوز قانونی یا رضایت مشتری، در اختیار هیچ شخص ثالثی قرار نخواهد گرفت.</li>
            </ul>
        </div>

    </div>

    <!-- Quick Actions Bar -->
    <div class="cr-actions-bar">
        <div>
            <strong style="font-size: 0.92rem; color: #0f172a; display: block; margin-bottom: 4px;">آیا نیاز به ثبت شکایت یا بازرسی دارید؟</strong>
            <span style="font-size: 0.8rem; color: #64748b;">واحد رسیدگی به شکایات تامین کانی سام (موبایل) موظف به پیگیری فوری و ارائه پاسخ مکتوب است.</span>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ url('/complaints') }}" style="background: #dc2626; color: #ffffff; padding: 10px 18px; border-radius: 10px; font-weight: 800; font-size: 0.84rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <span>ثبت شکایت رسمی (ماده ۱۳)</span>
            </a>
            <a href="{{ url('/tickets') }}" style="background: #2563eb; color: #ffffff; padding: 10px 18px; border-radius: 10px; font-weight: 800; font-size: 0.84rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span>ارسال تیکت پشتیبانی</span>
            </a>
        </div>
    </div>

</div>
@endsection
