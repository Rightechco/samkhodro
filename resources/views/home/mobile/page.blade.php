@extends('home.mobile.layout')

@section('title', ($title ?? 'صفحه اطلاعات') . ' | شرکت تامین کانی سام')

@section('content')
<div class="page-container" style="max-width: 1000px; margin: 30px auto; padding: 0 16px;">
    
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 36px 32px; box-shadow: 0 4px 25px rgba(0,0,0,0.03);">
        
        <!-- Breadcrumbs -->
        <div style="display: flex; gap: 8px; align-items: center; font-size: 0.82rem; color: #64748b; margin-bottom: 24px;">
            <a href="{{ url('/') }}" style="color: #64748b; text-decoration: none;">صفحه اصلی</a>
            <span>›</span>
            <span style="color: #2563eb; font-weight: 700;">{{ $title ?? 'اطلاعات' }}</span>
        </div>

        <h1 style="font-size: 1.65rem; font-weight: 900; color: #0f172a; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid #f1f5f9;">
            {{ $title ?? 'اطلاعات سامانه' }}
        </h1>

        @if(($pageType ?? '') === 'contact')
            <!-- Contact Us Specialized Layout -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 30px;">
                
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            📍
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">نشانی دفتر مرکزی و کارگاه فنی</div>
                            <div style="font-size: 0.78rem; color: #64748b;">مراجعه حضوری و ارسال پستی</div>
                        </div>
                    </div>
                    <p style="font-size: 0.88rem; color: #334155; line-height: 1.8; margin-bottom: 12px;">
                        {{ $settings['address'] ?? 'تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸' }}
                    </p>
                    <div style="font-size: 0.8rem; color: #64748b;">
                        کد پستی: ۵۱۵۸۸۹۴۳۲۱
                    </div>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            📞
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">خطوط تماس مستقیم</div>
                            <div style="font-size: 0.78rem; color: #64748b;">پشتیبانی و استعلام گارانتی</div>
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-size: 0.82rem; color: #64748b;">تلفن سانترال:</span>
                        <a href="tel:04136689000" style="font-weight: 800; color: #2563eb; text-decoration: none; margin-right: 6px; font-size: 0.95rem;">{{ $settings['phone'] ?? '۰۴۱-۳۶۶۸۹۰۰۰' }}</a>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-size: 0.82rem; color: #64748b;">داخلی خدمات پس از فروش:</span>
                        <span style="font-weight: 800; color: #0f172a; margin-right: 6px;">داخلی ۱</span>
                    </div>
                    <div>
                        <span style="font-size: 0.82rem; color: #64748b;">پست الکترونیک:</span>
                        <span style="font-weight: 700; color: #334155; margin-right: 6px;">{{ $settings['email'] ?? 'info@taminkanisam.co.ir' }}</span>
                    </div>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            ⏰
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">ساعات کاری مرکز خدمات</div>
                            <div style="font-size: 0.78rem; color: #64748b;">پذیرش، عیب‌یابی و ترخیص</div>
                        </div>
                    </div>
                    <div style="font-size: 0.88rem; color: #334155; line-height: 1.9;">
                        {{ $settings['work_hours'] ?? 'شنبه تا چهارشنبه ۹ الی ۱۸ | پنج‌شنبه‌ها ۹ الی ۱۴' }}
                    </div>
                    <div style="margin-top: 10px; font-size: 0.78rem; color: #10b981; font-weight: 700;">
                        ● کارگاه فنی در ساعات اداری آماده پذیرش حضوری و فوری می‌باشد.
                    </div>
                </div>

            </div>
        @endif

        @if(!empty($content))
            <div class="cms-page-content" style="font-size: 0.96rem; line-height: 2.1; color: #334155;">
                {!! $content !!}
            </div>
        @endif

        @if(($pageType ?? '') === 'contact')
            <!-- Contact / Inquiry Form -->
            <div style="margin-top: 35px; padding-top: 30px; border-top: 1px solid #e2e8f0;">
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 8px;">ارسال پیام مستقیم به پشتیبانی</h3>
                <p style="font-size: 0.82rem; color: #64748b; margin-bottom: 20px;">
                    چنانچه سوال، پیشنهاد یا استعلامی در خصوص خدمات گارانتی دارید، فرم زیر را تکمیل نمایید.
                </p>

                <form action="{{ url('/complaints/store') }}" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                    @csrf
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 6px;">نام و نام خانوادگی</label>
                        <input type="text" name="full_name" required placeholder="مثال: علی احمدی" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.88rem;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 6px;">شماره همراه</label>
                        <input type="tel" name="phone" required placeholder="۰۹۱۲۳۴۵۶۷۸۹" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.88rem;">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 6px;">موضوع پیام</label>
                        <input type="text" name="subject" required placeholder="استعلام پذیرش / گارانتی / پیشنهاد" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.88rem;">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 6px;">متن پیام</label>
                        <textarea name="description" rows="4" required placeholder="توضیحات خود را بنویسید..." style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.88rem;"></textarea>
                    </div>
                    <div style="grid-column: 1 / -1; text-align: left;">
                        <button type="submit" style="background: #2563eb; color: #ffffff; padding: 12px 28px; border: none; border-radius: 10px; font-weight: 800; font-size: 0.9rem; cursor: pointer;">
                            ارسال پیام به کارشناسان ←
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div style="margin-top: 30px; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 20px;">
            <a href="{{ url('/') }}" style="color: #64748b; font-size: 0.84rem; font-weight: 700; text-decoration: none;">
                ← بازگشت به صفحه اصلی سامانه
            </a>
        </div>

    </div>

</div>
@endsection
