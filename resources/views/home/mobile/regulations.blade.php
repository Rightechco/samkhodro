@extends('home.mobile.layout')

@section('title', 'ضوابط اجرایی خدمات پس از فروش و ماده ۱۳ قانون حمایت | تامین کانی سام (موبایل)')
@section('meta_description', 'ضوابط رسمی اجرایی خدمات پس از فروش و آیین‌نامه ماده ۱۳ ضوابط فنی مهندسی وزارت صنعت، معدن و تجارت در تامین کانی سام (موبایل)')

@section('content')
<div class="container" style="max-width: 1280px; margin: 0 auto; padding: 24px 16px 60px;">

    <!-- Page Header -->
    <div class="reg-page-header">
        <span class="reg-badge-pill">ضوابط فنی و قانونی وزارت صمت</span>
        <h1 class="reg-title">آیین‌نامه و ضوابط اجرایی سامانه مدیریت خدمات (ماده ۱۳)</h1>
        <p class="reg-subtitle">مجموعه مصوبات رسمی سازمان حمایت از مصرف‌کنندگان و تولیدکنندگان جهت تضمین کیفیت خدمات پس از فروش تلفن همراه</p>
    </div>

    <!-- Main Regulation Card (Pure Light Executive) -->
    <div class="reg-card">
        <div class="reg-header-tag">
            <span class="reg-dot"></span>
            <span>ماده ۱۳ ضوابط اجرایی خدمات پس از فروش</span>
        </div>
        <h2 class="reg-heading">الزامات فنی سامانه مدیریت خدمات و رهگیری یکپارچه</h2>
        <div class="reg-body-text">
            <p>
                مطابق با <strong>ماده ۱۳ ضوابط اجرایی سامانه مدیریت خدمات</strong> ابلاغی وزارت صنعت، معدن و تجارت و سازمان حمایت از حقوق مصرف‌کنندگان؛ کلیه شرکت‌های واردکننده موظف به راه‌اندازی و اتصال برخط سامانه‌ای جامع با قابلیت‌های زیر می‌باشند:
            </p>
        </div>

        <div class="reg-features-grid">
            <div class="reg-feature-item">
                <span class="reg-feat-icon">۱</span>
                <div>
                    <strong>قابلیت ثبت آنلاین پذیرش:</strong>
                    <p>امکان ثبت پرونده با کد رهگیری اختصاصی و ثبت شناسه ۱۵ رقمی IMEI دستگاه به همراه لوازم جانبی تحویلی.</p>
                </div>
            </div>

            <div class="reg-feature-item">
                <span class="reg-feat-icon">۲</span>
                <div>
                    <strong>قابلیت ارجاع و تقسیم کار کارگاهی:</strong>
                    <p>ارجاع مکانیزه دستگاه به کارشناسان و تکنسین‌های فنی مجاز بر اساس نوع تخصص و نظارت بر زمان تعمیر.</p>
                </div>
            </div>

            <div class="reg-feature-item">
                <span class="reg-feat-icon">۳</span>
                <div>
                    <strong>قابلیت ردیابی لحظه‌ای خدمت:</strong>
                    <p>امکان استعلام آنلاین وضعیت پیشرفت تعمیر در ۵ مرحله برای مشتریان و ارسال خودکار پیامک در هر مرحله.</p>
                </div>
            </div>

            <div class="reg-feature-item">
                <span class="reg-feat-icon">۴</span>
                <div>
                    <strong>مدیریت سفارش قطعات یدکی:</strong>
                    <p>ثبت سیستمی درخواست قطعات اورجینال از انبار مرکزی، کنترل اصالت قطعه و تخصیص قطعات تعویض شده.</p>
                </div>
            </div>

            <div class="reg-feature-item">
                <span class="reg-feat-icon">۵</span>
                <div>
                    <strong>اتمام خدمت، صدور فاکتور و کنترل کیفی (QC):</strong>
                    <p>ارزیابی نهایی کیفیت توسط واحد کنترل کیفی، ثبت گزارش داغی قطعات و صدور صورتحساب منطبق با تعرفه رسمی اتحادیه.</p>
                </div>
            </div>

            <div class="reg-feature-item">
                <span class="reg-feat-icon">۶</span>
                <div>
                    <strong>سامانه نظرسنجی و رسیدگی به شکایات:</strong>
                    <p>جمع‌آوری مکانیزه بازخورد مشتریان پس از ترخیص کالا و رسیدگی مستند به شکایات طبق مهلت‌های قانونی ماده ۲۸.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* =========================================================================
       100% PURE LIGHT EXECUTIVE THEME FOR REGULATIONS
       ========================================================================= */
    .reg-page-header {
        text-align: center;
        padding: 30px 20px 20px;
        margin-bottom: 24px;
    }
    .reg-badge-pill {
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
    .reg-title {
        font-size: 1.85rem;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .reg-subtitle {
        font-size: 0.94rem;
        color: #475569;
        max-width: 720px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .reg-card {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
    }
    .reg-header-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 4px 14px;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 800;
        margin-bottom: 14px;
    }
    .reg-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #10b981;
    }
    .reg-heading {
        font-size: 1.35rem;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 16px;
    }
    .reg-body-text {
        font-size: 0.90rem;
        color: #334155;
        line-height: 1.8;
        margin-bottom: 28px;
    }

    .reg-features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .reg-feature-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 22px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: transform 0.2s, border-color 0.2s;
    }
    .reg-feature-item:hover {
        background: #ffffff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }
    .reg-feat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        font-weight: 900;
        font-size: 1.0rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
    }
    .reg-feature-item strong {
        font-size: 0.95rem;
        color: #0f172a;
        display: block;
        margin-bottom: 4px;
    }
    .reg-feature-item p {
        font-size: 0.83rem;
        color: #475569;
        line-height: 1.7;
    }

    @media (max-width: 800px) {
        .reg-features-grid {
            grid-template-columns: 1fr;
        }
        .reg-title {
            font-size: 1.4rem;
        }
    }
</style>
@endpush
