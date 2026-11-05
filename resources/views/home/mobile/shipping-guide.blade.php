@extends('home.mobile.layout')

@section('title', 'نکات مهم فرآیند پذیرش و ارسال پستی محصولات | سام موبایل')

@section('content')
<div class="container">
    <div class="page-header-card">
        <span class="section-tag">دستورالعمل پذیرش</span>
        <h1>نکات مهم در فرآیند پذیرش و تعمیر محصولات ارسالی</h1>
        <p>لطفاً قبل از ارسال دستگاه یا مراجعه حضوری، دستورالعمل ۱۳ گانه زیر را به دقت مطالعه فرمایید</p>
    </div>

    <!-- Alert Box: Call Before Sending -->
    <div class="call-first-box">
        <div style="font-size: 28px; color: #fde047;">📞</div>
        <div>
            <h3 style="color:#fff; font-size:17px; font-weight:800; margin-bottom:4px;">لطفاً قبل از ارسال دستگاه خود، طی تماس با شرکت هماهنگی لازم را انجام دهید</h3>
            <p style="font-size: 13.5px; color: #bae6fd; margin: 0;">
                شماره تماس پذیرش و هماهنگی ارسال پستی: <strong>۰۲۱-۶۵۰۲۱۰۸۵ / ۰۲۱-۸۸۹۹۰۰۲۱</strong> (ساعات پاسخگویی: ۹ الی ۱۷)
            </p>
        </div>
    </div>

    <!-- 13 Golden Points from PDF Page 23 -->
    <div class="guide-points-list">
        <div class="glass-card guide-point-item">
            <span class="pt-number">۱</span>
            <div>
                <h4>کپی کارت ملی مالک دستگاه</h4>
                <p>حتماً کپی خوانای کارت ملی آورنده یا ارسال‌کننده دستگاه را داخل جعبه گوشی قرار دهید.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۲</span>
            <div>
                <h4>عدم مسئولیت در قبال قاب و گلس</h4>
                <p>شرکت تامین کانی سام بابت محافظ صفحه نمایش (گلس)، قاب محافظ گوشی و هر نوع لوازم جانبی متفرقه که در زمان خرید داخل کارتن دستگاه نبوده، هیچ‌گونه مسئولیتی ندارد.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۳</span>
            <div>
                <h4>پشتیبان‌گیری (بک‌آپ) از اطلاعات شخصی</h4>
                <p>پشتیبان‌گیری از اطلاعات، عکس‌ها و مخاطبین بر عهده مشتری است. حذف اطلاعات گوشی در صورت نیاز جهت تعمیر، تعویض بورد یا فلش توسط شرکت بلامانع است.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۴</span>
            <div>
                <h4>خروج از حساب‌های کاربری و حذف قفل صفحه</h4>
                <p>قبل از تحویل یا ارسال دستگاه، رمز شخصی (الگو، پین، اثر انگشت) و حساب‌های Google Account، Mi Account و Apple ID را حتماً حذف نمایید.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۵</span>
            <div>
                <h4>بسته‌بندی ایمن پستی</h4>
                <p>شرکت مسئولیتی در قبال بسته‌بندی نامناسب و آسیب‌دیدگی کالا حین حمل‌ونقل ندارد. بنابراین حتماً از کارتن‌های استاندارد اداره پست و محافظ حباب‌دار استفاده شود.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۶</span>
            <div>
                <h4>دریافت گوشی به منزله تایید قطعی گارانتی نیست</h4>
                <p>پذیرش اولیه تنها به منزله دریافت فیزیکی دستگاه بوده و شمول گارانتی منوط به کارشناسی فنی و سلامت مدارک دستگاه می‌باشد.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۷</span>
            <div>
                <h4>درج مکتوب مشکلات گوشی</h4>
                <p>در صورت ارسال پستی، لطفاً شرح کامل مشکلات گوشی، نحوه بروز عیب و شماره تماس در دسترس را روی یک برگه کاغذ یادداشت نموده و داخل جعبه قرار دهید.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۸</span>
            <div>
                <h4>عدم ارسال کابل، شارژر و هندزفری</h4>
                <p>هنگام ارسال پستی، فقط دستگاه + جعبه اصلی + کارت گارانتی ارسال شود و از فرستادن سیم‌کارت، کارت حافظه، کابل و شارژر خودداری فرمایید.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۹</span>
            <div>
                <h4>ارسال از طریق اداره پست پیشتاز</h4>
                <p>لطفاً کالای خود را با هماهنگی تلفنی قبلی، تنها از طریق شرکت ملی پست جمهوری اسلامی ایران (پست پیشتاز) ارسال فرمایید.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۱۰</span>
            <div>
                <h4>مهلت اعلام نظر اولیه تکنسین</h4>
                <p>از زمان تحویل دستگاه به مرکز، حداکثر ظرف ۷۲ ساعت الی ۷ روز کاری تکنسین نظر فنی خود را اعلام نموده و جهت هماهنگی با شما تماس حاصل خواهد شد.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۱۱</span>
            <div>
                <h4>مدت زمان فرآیند تعمیر</h4>
                <p>بازه زمانی پذیرش تا تعمیر نهایی بسته به نوع عیب و موجودی قطعه بین چند ساعت تا حداکثر ۳۰ روز زمان می‌برد (بیش از ۱۴ روز مشمول افزایش دوره گارانتی است).</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۱۲</span>
            <div>
                <h4>تحویل حضوری صرفاً با ارائه کارت ملی</h4>
                <p>تحویل حضوری دستگاه تنها به شخصی داده می‌شود که قبض پذیرش معتبر و کارت ملی اصل آورنده را ارائه دهد.</p>
            </div>
        </div>

        <div class="glass-card guide-point-item">
            <span class="pt-number">۱۳</span>
            <div>
                <h4>ارسال مجدد به آدرس دقیق فرستنده</h4>
                <p>پس از اتمام مراحل تعمیر یا تعویض، دستگاه صرفاً به همان آدرس و کد پستی ثبت‌شده در بخش فرستنده قبض پستی ارسال خواهد شد.</p>
            </div>
        </div>
    </div>

    <!-- Postal Address Card -->
    <div class="glass-card address-box" style="margin-top: 30px;">
        <h3 style="font-size: 17px; font-weight: 800; color: var(--text-main); margin-bottom: 10px;">آدرس و اطلاعات پستی دفتر مرکزی جهت ارسال مرسولات:</h3>
        <p style="font-size: 14.5px; color: var(--text-main); line-height: 1.8;">
            <strong>گیرنده:</strong> تهران، میدان فردوسی، مرکز تجارت جهانی، ورودی اداری، طبقه ۵، واحد ۵۱۵ - واحد خدمات پس از فروش سام موبایل (تامین کانی سام)<br>
            <strong>کد پستی ۱۰ رقمی:</strong> ۱۱۴۵۹۸۲۱۳۱ | <strong>تلفن:</strong> ۰۲۱-۶۵۰۲۱۰۸۵
        </p>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-header-card { text-align: center; padding: 40px 20px 20px; margin-bottom: 20px; }
    .page-header-card h1 { font-size: 26px; font-weight: 900; color: var(--text-main); margin: 12px 0 8px; }
    .page-header-card p { font-size: 14.5px; color: var(--text-muted); max-width: 680px; margin: 0 auto; }

    .call-first-box {
        background: linear-gradient(135deg, #0369a1, #1e3a8a);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 18px;
        padding: 22px 28px;
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 30px;
        box-shadow: 0 12px 30px rgba(3, 105, 161, 0.3);
    }

    .guide-points-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .guide-point-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px 24px;
    }
    .pt-number {
        font-size: 17px;
        font-weight: 900;
        color: var(--primary);
        background: rgba(56, 189, 248, 0.12);
        border: 1px solid rgba(56, 189, 248, 0.3);
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .guide-point-item h4 { font-size: 16px; font-weight: 800; color: var(--text-main); margin-bottom: 6px; }
    .guide-point-item p { font-size: 13.5px; color: var(--text-muted); line-height: 1.7; margin: 0; }

    .address-box {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(6, 9, 19, 0.95));
        border-color: rgba(56, 189, 248, 0.35);
        padding: 28px;
    }
</style>
@endpush
