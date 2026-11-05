@extends('home.mobile.layout')

@section('title', 'منشور حقوق مشتریان | سام موبایل (تامین کانی سام)')

@section('content')
<div class="container">
    <div class="page-header-card">
        <span class="section-tag">حقوق مصرف‌کنندگان</span>
        <h1>منشور حقوق مشتریان شرکت تامین کانی سام (سام موبایل)</h1>
        <p>به منظور شفافیت در خدمات پس از فروش و آگاهی کامل مشتریان از حقوق قانونی خود منطبق بر ضوابط اجرایی وزارت صمت</p>
    </div>

    <!-- Alert Box: Tabreh 5 Madeh 28 -->
    <div class="law-alert-box">
        <div class="law-alert-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="law-alert-content">
            <h4>نکته بسیار مهم پیرامون تاریخ شروع گارانتی ۱۸ ماهه (تبصره ۵ ماده ۲۸ ضوابط صمت):</h4>
            <p>
                طبق تبصره ۵ ماده ۲۸ ضوابط اجرایی سازمان فنی و مهندسی وزارت صنعت، معدن و تجارت؛ در صورتی که دستگاه‌های وارداتی پس از <strong>۶ ماه از تاریخ ترخیص</strong> فعال‌سازی نشوند، گارانتی آنها به صورت خودکار به مدت ۱۸ ماه آغاز می‌گردد. جهت اطلاع از تاریخ ترخیص کالا، وارد سامانه جامع گارانتی (ایران گارانتی) شده و با ورود شناسه IMEI تاریخ ترخیص کالا را مشاهده فرمایید.
            </p>
        </div>
    </div>

    <!-- 10 Principles of Customer Rights -->
    <div class="charter-grid">
        <!-- Principle 1 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۱</div>
            <div class="charter-content">
                <h3>ضمانت ۶ ماهه کلیه خدمات و قطعات</h3>
                <p>کلیه خدمات فنی ارائه شده و قطعات تعویض شده در تمامی شعب و نمایندگی‌های سام موبایل تا ۶ ماه دارای ضمانت رسمی می‌باشند.</p>
            </div>
        </div>

        <!-- Principle 2 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۲</div>
            <div class="charter-content">
                <h3>تعهد ۵ ساله پشتیبانی و تأمین قطعات</h3>
                <p>مدت زمان پشتیبانی و تعهد تأمین قطعات یدکی استاندارد تلفن همراه، ۵ سال از تاریخ فروش کالا می‌باشد.</p>
            </div>
        </div>

        <!-- Principle 3 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۳</div>
            <div class="charter-content">
                <h3>ارائه رسید پذیرش رسمی</h3>
                <p>شرکت در قبال دریافت فرم تکمیل‌شده اظهارات مشتری و دریافت گوشی، موظف به صدور آنی رسید پذیرش معتبر و کد رهگیری یکتا است.</p>
            </div>
        </div>

        <!-- Principle 4 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۴</div>
            <div class="charter-content">
                <h3>الزام صدور فاکتور رسمی</h3>
                <p>صدور رسید و صورتحساب رسمی برای هرگونه ارائه خدمت (خواه دستگاه تحت گارانتی باشد یا نباشد) با ذکر مشخصات قطعات و دستمزد الزامی است.</p>
            </div>
        </div>

        <!-- Principle 5 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۵</div>
            <div class="charter-content">
                <h3>اعلام حدود هزینه پیش از تعمیر</h3>
                <p>شرکت و نمایندگی‌ها موظف به اعلام حدود هزینه قبل از شروع تعمیرات هستند. در صورتی که حین تعمیر عیب جدیدی مشاهده شود، مراتب حداکثر ظرف ۳ روز کاری به مشتری اعلام می‌گردد.</p>
            </div>
        </div>

        <!-- Principle 6 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۶</div>
            <div class="charter-content">
                <h3>پاسخ‌دهی اولیه حداکثر ظرف ۲ روز کاری</h3>
                <p>بیشترین زمان در خصوص تعیین وضعیت اولیه کالا، عیب‌یابی فنی و پاسخ‌دهی اولیه به مشتری حداکثر ۲ روز کاری خواهد بود.</p>
            </div>
        </div>

        <!-- Principle 7 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۷</div>
            <div class="charter-content">
                <h3>تعویض دستگاه غیرقابل تعمیر با گوشی آکبند</h3>
                <p>در طول دوره ۱۸ ماهه گارانتی، چنانچه اطمینان حاصل گردد ایراد با تعمیرات قابل رفع نبوده و کالا مشمول ابطال گارانتی نباشد، دستگاه با مدل آکبند تعویض، یا وجه فاکتور پس از کارشناسی عودت داده می‌شود.</p>
            </div>
        </div>

        <!-- Principle 8 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۸</div>
            <div class="charter-content">
                <h3>تعویض کالا در تکرار عیب (مرتبه سوم)</h3>
                <p>چنانچه در دوره ۱۸ ماهه ضمانت، بعد از ۲ بار تعمیر (مرتبه سوم مراجعه) از یک ایراد سخت‌افزاری مشخص مشکل پابرجا باشد، شرکت متعهد به تعویض با دستگاه همسان و آکبند می‌باشد.</p>
            </div>
        </div>

        <!-- Principle 9 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۰۹</div>
            <div class="charter-content">
                <h3>افزایش دوره گارانتی به ازای تأخیر</h3>
                <p>در صورت طولانی شدن تعمیرات بیش از ۱۴ روز در شرکت، به ازای هر روز تأخیر، ۴ روز به دوره گارانتی دستگاه افزوده خواهد شد. همچنین در صورت تعلیق فعالیت، مدت تعلیق به دوره گارانتی اضافه می‌گردد.</p>
            </div>
        </div>

        <!-- Principle 10 -->
        <div class="glass-card charter-card">
            <div class="charter-num">۱۰</div>
            <div class="charter-content">
                <h3>جبران خسارت حین تعمیرات</h3>
                <p>در صورتی که حین فرایند تعمیرات به دستگاه آسیبی وارد گردد، جبران خسارت وارده تا حصول رضایت کامل مشتری بر عهده شرکت تامین کانی سام می‌باشد.</p>
            </div>
        </div>
    </div>

    <!-- Loaner Device Section -->
    <div class="glass-card loaner-card" style="margin-top: 30px;">
        <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div class="loaner-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
            </div>
            <div style="flex: 1; min-width: 260px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #fff; margin-bottom: 6px;">تخصیص گوشی امانی موقت به مشتریان</h3>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.7;">
                    چنانچه زمان انتظار پذیرش حضوری در دفاتر خدمات بیش از ۳ ساعت به طول بینجامد یا زمان تأمین قطعه بیش از ۶ روز کاری شود، با درخواست مشتری، سام موبایل یک دستگاه تلفن همراه به صورت امانی در اختیار ایشان قرار می‌دهد.
                </p>
            </div>
            <a href="{{ route('mob.service-portal') }}" class="btn-glow">
                <span>سامانه مدیریت خدمات</span>
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-header-card {
        text-align: center;
        padding: 40px 20px;
        margin-bottom: 24px;
    }
    .page-header-card h1 {
        font-size: 28px;
        font-weight: 900;
        color: #fff;
        margin: 12px 0 10px;
    }
    .page-header-card p {
        font-size: 15px;
        color: var(--text-muted);
        max-width: 700px;
        margin: 0 auto;
    }

    .law-alert-box {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.15));
        border: 1px solid rgba(245, 158, 11, 0.4);
        border-radius: 18px;
        padding: 22px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        margin-bottom: 32px;
        color: #fef3c7;
    }
    .law-alert-icon {
        color: #f59e0b;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .law-alert-content h4 {
        font-size: 15px;
        font-weight: 800;
        color: #fbbf24;
        margin-bottom: 6px;
    }
    .law-alert-content p {
        font-size: 13.5px;
        line-height: 1.8;
        color: #fef3c7;
    }

    .charter-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .charter-card {
        display: flex;
        align-items: flex-start;
        gap: 18px;
        padding: 24px;
    }
    .charter-num {
        font-size: 22px;
        font-weight: 900;
        color: var(--primary);
        font-family: monospace;
        background: rgba(56, 189, 248, 0.12);
        border: 1px solid rgba(56, 189, 248, 0.25);
        border-radius: 12px;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .charter-content h3 {
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
    }
    .charter-content p {
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.7;
    }

    .loaner-card {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(6, 9, 19, 0.95));
        border-color: rgba(56, 189, 248, 0.35);
        padding: 30px;
    }
    .loaner-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: rgba(56, 189, 248, 0.15);
        border: 1px solid rgba(56, 189, 248, 0.3);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    @media (max-width: 800px) {
        .charter-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
