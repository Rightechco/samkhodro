@extends('home.mobile.layout')

@section('title', 'راهنمای پذیرش، بسته‌بندی و ارسال کالا به مرکز خدمات | سام موبایل')
@section('meta_description', 'راهنمای گام به گام پذیرش، بسته‌بندی ایمن و ارسال پستی گوشی همراه به دفتر مرکزی خدمات پس از فروش شرکت تامین کانی سام در تبریز')

@section('content')
<div class="container" style="max-width: 1280px; margin: 0 auto; padding: 24px 16px 60px;">

    <!-- Page Header -->
    <div class="sg-page-header">
        <span class="sg-badge-pill">راهنمای مراجعین و ارسال پستی</span>
        <h1 class="sg-title">راهنمای پذیرش حضوری و ارسال پستی دستگاه به مرکز خدمات</h1>
        <p class="sg-subtitle">راهنمای گام به گام مراحل ثبت درخواست، بسته‌بندی اصولی، ارسال پستی و پیگیری لحظه‌ای تعمیرات در سام موبایل</p>
    </div>

    <!-- Official Shipping Address Card (Tabriz Official Address) -->
    <div class="sg-address-box">
        <div class="sg-address-header">
            <span class="sg-badge-green">نشانی رسمی جهت ارسال پستی یا مراجعه حضوری</span>
            <h2 class="sg-address-title">دفتر مرکزی خدمات پس از فروش و تعمیرگاه مرکزی سام موبایل</h2>
        </div>

        <div class="sg-address-grid">
            <div class="sg-addr-item">
                <span class="sg-addr-lbl">استان و شهرستان:</span>
                <strong class="sg-addr-val">آذربایجان شرقی - تبریز</strong>
            </div>
            <div class="sg-addr-item">
                <span class="sg-addr-lbl">کد پستی ۱۰ رقمی:</span>
                <strong class="sg-addr-val" style="font-family: monospace;">۵۱۵۷۹۷۴۷۱۱</strong>
            </div>
            <div class="sg-addr-item">
                <span class="sg-addr-lbl">تلفن مرکز تماس:</span>
                <strong class="sg-addr-val" style="color:#2563eb;">۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)</strong>
            </div>
            <div class="sg-addr-item">
                <span class="sg-addr-lbl">گیرنده بسته:</span>
                <strong class="sg-addr-val">واحد پذیرش و گارانتی سام موبایل (تامین کانی سام)</strong>
            </div>
        </div>

        <div class="sg-full-address-row">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span><strong>نشانی دقیق پستی:</strong> تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</span>
        </div>
    </div>

    <!-- 5-Step Process Roadmap (Crisp Light Theme) -->
    <div style="margin-top: 40px;">
        <div class="sg-section-head">
            <span class="sg-badge-pill">مراحل خدمت</span>
            <h2 class="sg-section-title">فرایند ۵ مرحله‌ای پذیرش و تعمیر گوشی همراه</h2>
            <p class="sg-section-desc">از ثبت در سامانه تا دریافت مجدد دستگاه سالم درب منزل:</p>
        </div>

        <div class="sg-steps-container">
            <div class="sg-step-card">
                <div class="sg-step-badge">۱</div>
                <div class="sg-step-content">
                    <h3 class="sg-step-title">ثبت اولیه در سامانه خدمات</h3>
                    <p class="sg-step-desc">پیش از ارسال، وارد بخش «سامانه خدمات» در سایت شده و درخواست پذیرش را با درج شماره سریال (IMEI) و شرح ایراد ثبت فرمایید تا کد رهگیری موقت صادر گردد.</p>
                </div>
            </div>

            <div class="sg-step-card">
                <div class="sg-step-badge">۲</div>
                <div class="sg-step-content">
                    <h3 class="sg-step-title">تهیه نسخه پشتیبان و خروج از حساب‌ها</h3>
                    <p class="sg-step-desc">به منظور حفظ امنیت اطلاعات، از اطلاعات شخصی بکاپ تهیه کرده و حتماً از حساب کاربری خود (Google Account یا Apple ID یا سامسونگ اکانت) خارج شوید و قفل صفحه را بردارید.</p>
                </div>
            </div>

            <div class="sg-step-card">
                <div class="sg-step-badge">۳</div>
                <div class="sg-step-content">
                    <h3 class="sg-step-title">بسته‌بندی ایمن و مقاوم</h3>
                    <p class="sg-step-desc">دستگاه را به همراه جعبه اصلی و کارت گارانتی در بسته‌بندی ضدضربه (کارتن استاندارد پستی و پلاستیک حباب‌دار) قرار داده و کد رهگیری سامانه را روی بسته یادداشت نمایید.</p>
                </div>
            </div>

            <div class="sg-step-card">
                <div class="sg-step-badge">۴</div>
                <div class="sg-step-content">
                    <h3 class="sg-step-title">ارسال رایگان از طریق پست پیشتاز یا تیپاکس</h3>
                    <p class="sg-step-desc">بسته را به آدرس دفتر خدمات تبریز ارسال نمایید. برای کالاهای تحت گارانتی در شهرهای فاقد نمایندگی، هزینه ارسال پس از تحویل مسترد می‌گردد.</p>
                </div>
            </div>

            <div class="sg-step-card">
                <div class="sg-step-badge">۵</div>
                <div class="sg-step-content">
                    <h3 class="sg-step-title">کارشناسی، تعمیر و ارسال بازگشت</h3>
                    <p class="sg-step-desc">به محض ورود کالا، پیامک ثبت پرونده ارسال شده و پس از عیب‌یابی، تعویض قطعه و QC نهایی، دستگاه با بسته‌بندی پلمپ به نشانی شما برگشت داده می‌شود.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Important Shipping Rules (Clean Light Cards) -->
    <div style="margin-top: 48px;">
        <div class="sg-section-head">
            <span class="sg-badge-pill" style="background:#fef3c7; color:#92400e; border-color:#fde68a;">نکات کلیدی ارسال</span>
            <h2 class="sg-section-title">توصیه‌های ضروری پیش از تحویل کالا به پست</h2>
        </div>

        <div class="sg-tips-grid">
            <div class="sg-tip-item">
                <div class="sg-tip-icon" style="background:#eff6ff; color:#2563eb;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div>
                    <h4 class="sg-tip-title">ارسال کارت گارانتی فیزیکی</h4>
                    <p class="sg-tip-desc">حتماً کارت گارانتی هولوگرام‌دار سام موبایل را درون جعبه گوشی قرار دهید.</p>
                </div>
            </div>

            <div class="sg-tip-item">
                <div class="sg-tip-icon" style="background:#ecfdf5; color:#059669;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div>
                    <h4 class="sg-tip-title">خارج کردن سیم‌کارت و کارت حافظه</h4>
                    <p class="sg-tip-desc">پیش از ارسال، سیم‌کارت‌ها و کارت حافظه رم را از دستگاه خارج نمایید.</p>
                </div>
            </div>

            <div class="sg-tip-item">
                <div class="sg-tip-icon" style="background:#fef3c7; color:#d97706;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <div>
                    <h4 class="sg-tip-title">عدم مسئولیت در قبال اطلاعات شخصی</h4>
                    <p class="sg-tip-desc">به دلیل احتمال نیاز به فلش نرم‌افزاری یا تعویض برد، حتماً از داده‌ها پشتیبان تهیه فرمایید.</p>
                </div>
            </div>

            <div class="sg-tip-item">
                <div class="sg-tip-icon" style="background:#ede9fe; color:#7c3aed;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <div>
                    <h4 class="sg-tip-title">درج شماره همراه در دسترس</h4>
                    <p class="sg-tip-desc">یک برگه حاوی شماره تلفن تماس و شرح ایراد را درون جعبه کالا قرار دهید.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* =========================================================================
       100% PURE LIGHT EXECUTIVE THEME FOR SHIPPING GUIDE
       ========================================================================= */
    .sg-page-header {
        text-align: center;
        padding: 30px 20px 20px;
        margin-bottom: 24px;
    }
    .sg-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 99px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        font-size: 0.78rem;
        font-weight: 800;
        margin-bottom: 12px;
    }
    .sg-title {
        font-size: 1.85rem;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .sg-subtitle {
        font-size: 0.94rem;
        color: #475569;
        max-width: 720px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* Address Card */
    .sg-address-box {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        margin-bottom: 36px;
    }
    .sg-address-header {
        margin-bottom: 20px;
    }
    .sg-badge-green {
        display: inline-flex;
        padding: 4px 12px;
        border-radius: 99px;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        font-size: 0.76rem;
        font-weight: 800;
        margin-bottom: 10px;
    }
    .sg-address-title {
        font-size: 1.35rem;
        font-weight: 900;
        color: #0f172a;
    }
    .sg-address-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        padding: 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 18px;
    }
    .sg-addr-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .sg-addr-lbl {
        font-size: 0.74rem;
        color: #64748b;
        font-weight: 700;
    }
    .sg-addr-val {
        font-size: 0.88rem;
        color: #0f172a;
        font-weight: 800;
    }
    .sg-full-address-row {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        color: #334155;
        line-height: 1.8;
        padding-top: 10px;
    }
    .sg-full-address-row svg {
        color: #2563eb;
        flex-shrink: 0;
    }

    /* Section Head */
    .sg-section-head {
        text-align: right;
        margin-bottom: 24px;
    }
    .sg-section-title {
        font-size: 1.35rem;
        font-weight: 900;
        color: #0f172a;
        margin-top: 8px;
    }
    .sg-section-desc {
        font-size: 0.86rem;
        color: #64748b;
        margin-top: 4px;
    }

    /* Roadmap */
    .sg-steps-container {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .sg-step-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 22px 26px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.02);
        transition: transform 0.2s, border-color 0.2s;
    }
    .sg-step-card:hover {
        transform: translateY(-2px);
        border-color: #bfdbfe;
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.06);
    }
    .sg-step-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        font-weight: 900;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
    }
    .sg-step-content {
        flex: 1;
    }
    .sg-step-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }
    .sg-step-desc {
        font-size: 0.85rem;
        color: #475569;
        line-height: 1.8;
    }

    /* Tips Grid */
    .sg-tips-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
    .sg-tip-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
    }
    .sg-tip-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .sg-tip-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .sg-tip-desc {
        font-size: 0.82rem;
        color: #64748b;
        line-height: 1.7;
    }

    @media (max-width: 800px) {
        .sg-address-grid {
            grid-template-columns: 1fr 1fr;
        }
        .sg-tips-grid {
            grid-template-columns: 1fr;
        }
        .sg-title {
            font-size: 1.4rem;
        }
    }
</style>
@endpush
