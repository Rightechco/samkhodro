@extends('home.mobile.layout')

@section('title', 'سام موبایل | خدمات پس از فروش و گارانتی رسمی ۱۸ ماهه تلفن همراه تامین کانی سام')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-glow"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <span class="ping-dot"></span>
                <span>پرتال رسمی خدمات پس از فروش و گارانتی سام موبایل</span>
            </div>
            <h1 class="hero-title">
                آسودگی خاطر با ۱۸ ماه گارانتی معتبر <br>
                <span class="gradient-text">شرکت تامین کانی سام</span>
            </h1>
            <p class="hero-desc">
                پوشش سراسری، تامین قطعات اورجینال، ارائه گوشی امانی موقت، تعویض دستگاه در صورت تکرار عیب و پیگیری برخط تمامی مراحل تعمیرات مطابق ضوابط اجرایی وزارت صمت.
            </p>

            <!-- Quick Inquiry Box (IMEI & Tracking Code) -->
            <div class="inquiry-card">
                <div class="inquiry-tabs">
                    <button type="button" class="inquiry-tab active" data-tab="tab-imei">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                            <path d="M12 18h.01"/>
                        </svg>
                        <span>استعلام اصالت و گارانتی (IMEI)</span>
                    </button>
                    <button type="button" class="inquiry-tab" data-tab="tab-track">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <span>رهگیری پرونده تعمیرات (کد پیگیری)</span>
                    </button>
                </div>

                <div class="inquiry-body">
                    <!-- IMEI Form -->
                    <div class="inquiry-panel active" id="tab-imei">
                        <form id="imeiForm" onsubmit="handleTrack(event, 'imeiInput')">
                            <div class="input-group">
                                <span class="input-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                                        <line x1="9" x2="15" y1="6" y2="6"/>
                                        <line x1="9" x2="15" y1="10" y2="10"/>
                                        <line x1="9" x2="15" y1="14" y2="14"/>
                                    </svg>
                                </span>
                                <input type="text" id="imeiInput" placeholder="شناسه ۱۵ رقمی IMEI دستگاه خود را وارد نمایید (بدون خط فاصله)" required maxlength="20" pattern="[0-9a-zA-Z\-]{10,20}">
                                <button type="submit" class="btn-inquiry-submit">
                                    <span>استعلام گارانتی</span>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="inquiry-hint">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>
                                </svg>
                                <span>برای یافتن IMEI، کد دستوری <strong style="color:#38bdf8; direction:ltr; display:inline-block;">*#06#</strong> را در تلفن همراه خود شماره‌گیری نمایید.</span>
                            </div>
                        </form>
                    </div>

                    <!-- Track Form -->
                    <div class="inquiry-panel" id="tab-track">
                        <form id="trackForm" onsubmit="handleTrack(event, 'trackInput')">
                            <div class="input-group">
                                <span class="input-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                </span>
                                <input type="text" id="trackInput" placeholder="کد رهگیری پذیرش را وارد فرمایید (مثال: SAM-1403-9102)" required maxlength="25">
                                <button type="submit" class="btn-inquiry-submit">
                                    <span>رهگیری وضعیت</span>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="inquiry-hint">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>
                                </svg>
                                <span>کد رهگیری بر روی قبض پذیرش یا در پیامک اولیه ارسالی از سام موبایل درج شده است.</span>
                            </div>
                        </form>
                    </div>

                    <!-- Result Box -->
                    <div id="inquiryResult" class="inquiry-result" style="display: none;"></div>
                </div>
            </div>

            <!-- Quick Action Links -->
            <div class="hero-actions-row">
                <a href="{{ route('mob.service-portal') }}" class="btn-glow">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect width="18" height="18" x="3" y="3" rx="2"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                    <span>ورود به سامانه مدیریت خدمات (ماده ۱۳)</span>
                </a>
                <a href="{{ route('mob.warranty-terms') }}" class="btn-outline">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    <span>شرایط گارانتی و آموزش همتا</span>
                </a>
                <a href="{{ route('mob.customer-rights') }}" class="btn-outline">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 1 0-16 0"/>
                    </svg>
                    <span>منشور حقوق مشتریان</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Key Advantages (4 Pillars from PDF) -->
    <section class="section-container">
        <div class="section-header">
            <span class="section-tag">استانداردهای سام موبایل</span>
            <h2 class="section-title">مزایای منحصر‌به‌فرد گارانتی تامین کانی سام</h2>
            <p class="section-subtitle">تعهد ما به کیفیت، سرعت و حفظ حقوق مصرف‌کننده در تمامی شعب و نمایندگی‌های سراسر کشور</p>
        </div>

        <div class="features-grid">
            <div class="glass-card feature-card">
                <div class="feature-icon icon-cyan">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>۱۸ ماه گارانتی رسمی و معتبر</h3>
                <p>پوشش جامع سخت‌افزاری، باتری‌های غیرقابل تعویض و سیستم‌عامل با ضمانت قطعات اورجینال از بدو فعال‌سازی کالا.</p>
                <div class="feature-badge">مطابق تبصره ۵ ماده ۲۸</div>
            </div>

            <div class="glass-card feature-card">
                <div class="feature-icon icon-indigo">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                        <path d="M12 18h.01"/>
                    </svg>
                </div>
                <h3>ارائه دستگاه امانی موقت</h3>
                <p>چنانچه زمان انتظار پذیرش حضوری یا تعمیر بیش از ۳ ساعت طول بکشد، با درخواست مشتری یک دستگاه امانی تقدیم می‌گردد.</p>
                <div class="feature-badge">ماده ۱ مزایای گارانتی</div>
            </div>

            <div class="glass-card feature-card">
                <div class="feature-icon icon-emerald">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
                    </svg>
                </div>
                <h3>تعویض با دستگاه آکبند</h3>
                <p>در صورت بروز عیب تکراری (مرتبه سوم) یا عدم امکان تعمیر در دوره ضمانت، کالا با دستگاه نو آکبند تعویض می‌گردد.</p>
                <div class="feature-badge">ماده ۹ و ۱۵ ضوابط صمت</div>
            </div>

            <div class="glass-card feature-card">
                <div class="feature-icon icon-amber">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h3>افزایش دوره در صورت تأخیر</h3>
                <p>در صورتی که تعمیر دستگاه بیش از ۱۵ روز کاری زمان ببرد، روزهای مازاد به مدت زمان گارانتی دستگاه افزوده خواهد شد.</p>
                <div class="feature-badge">ماده ۲ مزایای گارانتی</div>
            </div>
        </div>
    </section>

    <!-- 4-Step Process Section -->
    <section class="section-container">
        <div class="glass-card process-wrapper">
            <div class="section-header" style="margin-bottom: 30px;">
                <span class="section-tag">فرآیند شفاف</span>
                <h2 class="section-title">مراحل گام‌به‌گام پذیرش و ترخیص دستگاه</h2>
                <p class="section-subtitle">از لحظه تحویل تا اتمام خدمت با بالاترین استانداردهای فنی و نظارتی</p>
            </div>

            <div class="process-steps-grid">
                <div class="step-card">
                    <div class="step-number">۱</div>
                    <h4>پذیرش و صدور رسید رسمی</h4>
                    <p>ثبت مشخصات، سریال IMEI، ایراد اظهارشده و وضعیت ظاهری با صدور رسید معتبر و کد رهگیری یکتا.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">۲</div>
                    <h4>کارشناسی فنی و عیب‌یابی</h4>
                    <p>بررسی سخت‌افزاری توسط مهندسین مجرب ظرف ۲ الی ۳ روز کاری و اطلاع‌رسانی دقیق علت عیب به مشتری.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">۳</div>
                    <h4>تأمین قطعه و تعمیر استاندارد</h4>
                    <p>استفاده از قطعات فابریک استاندارد انبار مرکزی با ۶ ماه ضمانت قطعه تعویض‌شده و انجام تست‌های کنترل کیفیت (QC).</p>
                </div>
                <div class="step-card">
                    <div class="step-number">۴</div>
                    <h4>تست نهایی، فاکتور و تحویل</h4>
                    <p>صدور فاکتور شفاف مطابق تعرفه مصوب اتحادیه، ثبت اتمام خدمت در سامانه جامع و تحویل حضوری یا ارسال پستی ایمن.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hamta Guide Highlights -->
    <section class="section-container">
        <div class="hamta-banner">
            <div class="hamta-content">
                <span class="section-tag" style="background: rgba(255,255,255,0.15); color: #fff; border-color: rgba(255,255,255,0.3);">رجیستری و همتا</span>
                <h2>راهنمای فعال‌سازی دستگاه در سامانه همتا</h2>
                <p>
                    پس از خرید گوشی با گارانتی سام موبایل، با سیم‌کارت خود کد دستوری <strong style="color:#fde047; font-size:18px; direction:ltr; display:inline-block;">*7777#</strong> را شماره‌گیری کرده و با ارسال گزینه ۲ (فعال‌سازی)، شناسه ۱۵ رقمی IMEI و کد ۶ رقمی کارت گارانتی دستگاه خود را ثبت نمایید.
                </p>
                <div style="display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap;">
                    <a href="{{ route('mob.warranty-terms') }}" class="btn-glow" style="background: #fff; color: #0369a1; box-shadow: none;">
                        مشاهده آموزش کامل ۱۰ مرحله‌ای همتا
                    </a>
                    <a href="{{ route('mob.shipping-guide') }}" class="btn-outline" style="border-color: rgba(255,255,255,0.4); color: #fff;">
                        نکات مهم پذیرش و ارسال پستی
                    </a>
                </div>
            </div>
            <div class="hamta-code-box">
                <div class="code-title">کد دستوری سریع سامانه همتا</div>
                <div class="code-display">*7777#</div>
                <div class="code-desc">بدون نیاز به اینترنت - فعال‌سازی آنی</div>
            </div>
        </div>
    </section>

    <!-- Portal Preview Section -->
    <section class="section-container">
        <div class="glass-card portal-preview-card">
            <div class="portal-info">
                <span class="section-tag">سامانه مدیریت خدمات (ماده ۱۳)</span>
                <h2>سامانه جامع خدمات نمایندگان و مشتریان سام موبایل</h2>
                <p style="margin-bottom: 20px; font-size: 15px; color: var(--text-muted);">
                    مطابق ماده ۱۳ ضوابط اجرایی، این سامانه قابلیت ثبت پذیرش برخط، ارجاع سیستمی به تکنسین، ردیابی وضعیت لحظه‌ای پرونده، سفارش قطعات یدکی از انبار و اتمام خدمت با صدور فاکتور رسمی را فراهم نموده است.
                </p>

                <div class="portal-feature-list">
                    <div class="portal-feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>ثبت آنلاین پذیرش دستگاه همراه با IMEI و مشخصات مشتری</span>
                    </div>
                    <div class="portal-feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>سیستم ارجاع به تکنسین‌های مجرب و مدیریت واحدهای تعمیراتی</span>
                    </div>
                    <div class="portal-feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>تایم‌لاین ۶ مرحله‌ای ردیابی پرونده با کد رهگیری اختصاصی</span>
                    </div>
                    <div class="portal-feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>ماژول درخواست قطعات یدکی از انبار مرکزی سام موبایل</span>
                    </div>
                    <div class="portal-feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>صدور فاکتور قطعی خدمات و تضمین ۶ ماهه قطعات تعویض شده</span>
                    </div>
                </div>

                <div style="margin-top: 26px;">
                    <a href="{{ route('mob.service-portal') }}" class="btn-glow" style="padding: 14px 30px;">
                        ورود به پرتال سامانه مدیریت خدمات
                    </a>
                </div>
            </div>
            
            <div class="portal-mockup">
                <div class="mockup-header">
                    <span class="dot red"></span>
                    <span class="dot yellow"></span>
                    <span class="dot green"></span>
                    <span class="mockup-title">سامانه مدیریت خدمات پس از فروش - تامین کانی سام</span>
                </div>
                <div class="mockup-body">
                    <div class="mockup-stat-row">
                        <div class="mockup-stat-box">
                            <div class="num">{{ $stats['active_in_repair'] }}</div>
                            <div class="lbl">در حال اقدام</div>
                        </div>
                        <div class="mockup-stat-box">
                            <div class="num">{{ $stats['customer_satisfaction'] }}</div>
                            <div class="lbl">رضایت مشتریان</div>
                        </div>
                        <div class="mockup-stat-box">
                            <div class="num">۱۸ ماه</div>
                            <div class="lbl">دوره گارانتی</div>
                        </div>
                    </div>
                    
                    <div class="mockup-order-item">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                            <span style="font-weight:700; color:#fff;">سامسونگ S24 Ultra - پذیرش مرکزی</span>
                            <span style="font-size:11px; padding:2px 8px; border-radius:12px; background:rgba(56,189,248,0.2); color:#38bdf8;">در حال تعمیر</span>
                        </div>
                        <div style="font-size:12px; color:var(--text-muted);">کد: SAM-1403-9102 | تکنسین: مهندس کاظمی</div>
                    </div>

                    <div class="mockup-order-item">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                            <span style="font-weight:700; color:#fff;">شیائومی Note 13 Pro+ - نمایندگی اصفهان</span>
                            <span style="font-size:11px; padding:2px 8px; border-radius:12px; background:rgba(16,185,129,0.2); color:#10b981;">آماده تحویل</span>
                        </div>
                        <div style="font-size:12px; color:var(--text-muted);">کد: SAM-1403-9088 | فلش کامل و کنترل کیفی</div>
                    </div>

                    <div class="mockup-order-item">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                            <span style="font-weight:700; color:#fff;">اپل iPhone 13 - پذیرش پستی</span>
                            <span style="font-size:11px; padding:2px 8px; border-radius:12px; background:rgba(99,102,241,0.2); color:#818cf8;">تحویل شده با فاکتور</span>
                        </div>
                        <div style="font-size:12px; color:var(--text-muted);">کد: SAM-1403-8995 | تعویض ال‌سی‌دی اورجینال</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Services Grid (Survey, Complaints, Invoice) -->
    <section class="section-container" style="margin-bottom: 20px;">
        <div class="section-header">
            <span class="section-tag">پاسخگویی و شفافیت</span>
            <h2 class="section-title">خدمات آنلاین و ارتباط با مشتریان</h2>
            <p class="section-subtitle">صدای شما را می‌شنویم و در سریع‌ترین زمان ممکن پاسخگوی سوالات، نظرات و شکایات شما هستیم</p>
        </div>

        <div class="interactive-cards-grid">
            <div class="glass-card card-interactive">
                <div class="card-icon-circle icon-amber">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                </div>
                <h3>نظرسنجی و رضایت‌سنجی</h3>
                <p>ارزیابی عملکرد کادر فنی، سرعت انجام تعمیرات و کیفیت خدمات سام موبایل جهت بهبود مستمر فرآیندها.</p>
                <a href="{{ route('mob.survey') }}" class="card-link">
                    <span>تکمیل فرم نظرسنجی</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>

            <div class="glass-card card-interactive">
                <div class="card-icon-circle icon-rose">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <h3>ثبت شکایات و پیگیری</h3>
                <p>رسیدگی مستقیم واحد بازرسی و خدمات پس از فروش به شکایات طبق ماده ۳۸ ضوابط وزارت صمت حداکثر ظرف ۲ روز کاری.</p>
                <a href="{{ route('mob.complaints') }}" class="card-link">
                    <span>ثبت یا پیگیری شکایت</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>

            <div class="glass-card card-interactive">
                <div class="card-icon-circle icon-cyan">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <h3>نمونه فاکتور رسمی اتحادیه</h3>
                <p>مشاهده نمونه صورتحساب معتبر خدمات پس از فروش و تعرفه خدمات گارانتی و غیرگارانتی منطبق بر ضوابط مالیاتی.</p>
                <a href="{{ route('mob.invoice-sample') }}" class="card-link">
                    <span>مشاهده فرم فاکتور رسمی</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .hero-section {
        position: relative;
        padding: 50px 0 40px;
        text-align: center;
    }
    .hero-glow {
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 300px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.18) 0%, transparent 70%);
        filter: blur(50px);
        pointer-events: none;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: rgba(56, 189, 248, 0.12);
        border: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
    }
    .ping-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary);
        box-shadow: 0 0 10px var(--primary);
        animation: pulse 1.8s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(56, 189, 248, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(56, 189, 248, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(56, 189, 248, 0); }
    }
    .hero-title {
        font-size: 40px;
        font-weight: 900;
        line-height: 1.35;
        letter-spacing: -1px;
        color: #fff;
        margin-bottom: 16px;
    }
    .gradient-text {
        background: linear-gradient(135deg, #38bdf8 0%, #818cf8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-desc {
        font-size: 16px;
        color: var(--text-muted);
        max-width: 720px;
        margin: 0 auto 36px;
        line-height: 1.8;
    }

    /* Inquiry Card */
    .inquiry-card {
        background: rgba(15, 23, 42, 0.85);
        border: 1px solid rgba(56, 189, 248, 0.35);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 30px rgba(56, 189, 248, 0.15);
        border-radius: 24px;
        padding: 24px;
        max-width: 840px;
        margin: 0 auto 32px;
        backdrop-filter: blur(16px);
        text-align: right;
    }
    .inquiry-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding-bottom: 14px;
        flex-wrap: wrap;
    }
    .inquiry-tab {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 700;
        padding: 9px 18px;
        border-radius: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s;
    }
    .inquiry-tab:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.05);
    }
    .inquiry-tab.active {
        color: #fff;
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.25), rgba(2, 132, 199, 0.35));
        border: 1px solid rgba(56, 189, 248, 0.4);
    }
    .inquiry-panel {
        display: none;
    }
    .inquiry-panel.active {
        display: block;
    }
    .input-group {
        display: flex;
        align-items: center;
        background: rgba(6, 9, 19, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 16px;
        padding: 6px 8px 6px 6px;
        transition: all 0.25s;
    }
    .input-group:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 20px rgba(56, 189, 248, 0.35);
    }
    .input-icon {
        padding: 0 14px;
        color: var(--primary);
        display: flex;
        align-items: center;
    }
    .input-group input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        font-size: 15px;
        padding: 10px 4px;
        direction: ltr;
        text-align: right;
    }
    .input-group input::placeholder {
        color: var(--text-dim);
        direction: rtl;
        text-align: right;
    }
    .btn-inquiry-submit {
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);
        color: #fff;
        border: none;
        padding: 12px 22px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        box-shadow: 0 4px 16px rgba(56, 189, 248, 0.35);
        transition: all 0.2s;
    }
    .btn-inquiry-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(56, 189, 248, 0.5);
    }
    .inquiry-hint {
        font-size: 12.5px;
        color: var(--text-dim);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 12px;
        padding-right: 4px;
    }

    /* Result Box */
    .inquiry-result {
        margin-top: 20px;
        background: rgba(6, 9, 19, 0.95);
        border: 1px solid rgba(56, 189, 248, 0.4);
        border-radius: 16px;
        padding: 20px;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-actions-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    /* Sections */
    .section-container {
        padding: 40px 0;
    }

    /* Features Grid */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
    }
    .feature-card {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: relative;
    }
    .feature-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }
    .icon-cyan { background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); }
    .icon-indigo { background: rgba(99, 102, 241, 0.15); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.3); }
    .icon-emerald { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .icon-amber { background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); }
    .icon-rose { background: rgba(244, 63, 94, 0.15); color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.3); }

    .feature-card h3 {
        font-size: 17px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
    }
    .feature-card p {
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 16px;
        flex: 1;
    }
    .feature-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.06);
        color: var(--primary);
    }

    /* Process Steps */
    .process-wrapper {
        padding: 40px;
        background: linear-gradient(145deg, rgba(15, 23, 42, 0.8), rgba(6, 9, 19, 0.9));
    }
    .process-steps-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        position: relative;
    }
    .step-card {
        position: relative;
        padding: 22px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border-light);
        border-radius: 18px;
    }
    .step-number {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0284c7, #38bdf8);
        color: #fff;
        font-weight: 900;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
        box-shadow: 0 4px 14px rgba(56, 189, 248, 0.4);
    }
    .step-card h4 {
        font-size: 15px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
    }
    .step-card p {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.7;
    }

    /* Hamta Banner */
    .hamta-banner {
        background: linear-gradient(135deg, #0369a1 0%, #1e3a8a 50%, #312e81 100%);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 24px;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
        box-shadow: 0 20px 50px rgba(3, 105, 161, 0.3);
    }
    .hamta-content h2 {
        font-size: 26px;
        font-weight: 900;
        color: #fff;
        margin: 10px 0 12px;
    }
    .hamta-content p {
        font-size: 15px;
        color: #e0f2fe;
        line-height: 1.8;
        max-width: 680px;
    }
    .hamta-code-box {
        background: rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 24px 36px;
        text-align: center;
        flex-shrink: 0;
    }
    .code-title {
        font-size: 13px;
        color: #93c5fd;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .code-display {
        font-size: 42px;
        font-weight: 900;
        color: #fde047;
        direction: ltr;
        letter-spacing: 2px;
        line-height: 1.1;
        text-shadow: 0 0 20px rgba(253, 224, 71, 0.5);
    }
    .code-desc {
        font-size: 12px;
        color: #e2e8f0;
        margin-top: 8px;
    }

    /* Portal Preview */
    .portal-preview-card {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 40px;
        align-items: center;
        padding: 40px;
    }
    .portal-info h2 {
        font-size: 26px;
        font-weight: 900;
        color: #fff;
        margin: 10px 0 14px;
        line-height: 1.4;
    }
    .portal-feature-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .portal-feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: var(--text-main);
    }
    .portal-mockup {
        background: #090e1d;
        border: 1px solid var(--border-glow);
        border-radius: 18px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        overflow: hidden;
    }
    .mockup-header {
        background: rgba(255, 255, 255, 0.04);
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border-light);
    }
    .dot { width: 10px; height: 10px; border-radius: 50%; }
    .dot.red { background: #ef4444; }
    .dot.yellow { background: #f59e0b; }
    .dot.green { background: #10b981; }
    .mockup-title { font-size: 12px; color: var(--text-muted); margin-right: 8px; font-weight: 600; }
    .mockup-body { padding: 18px; }
    .mockup-stat-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 16px;
    }
    .mockup-stat-box {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        padding: 10px;
        text-align: center;
    }
    .mockup-stat-box .num { font-size: 18px; font-weight: 900; color: var(--primary); }
    .mockup-stat-box .lbl { font-size: 11px; color: var(--text-dim); }
    .mockup-order-item {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 10px;
    }

    /* Interactive 3 cards */
    .interactive-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .card-interactive {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .card-icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .card-interactive h3 {
        font-size: 18px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
    }
    .card-interactive p {
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 18px;
        flex: 1;
    }
    .card-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 700;
        color: var(--primary);
    }
    .card-link:hover {
        gap: 10px;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .features-grid, .process-steps-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .portal-preview-card {
            grid-template-columns: 1fr;
        }
        .hamta-banner {
            flex-direction: column;
            text-align: center;
        }
        .hamta-content p {
            margin: 0 auto;
        }
        .hamta-banner .btn-glow, .hamta-banner .btn-outline {
            justify-content: center;
        }
    }

    @media (max-width: 640px) {
        .hero-title {
            font-size: 26px;
        }
        .features-grid, .process-steps-grid, .interactive-cards-grid {
            grid-template-columns: 1fr;
        }
        .input-group {
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        .input-group input {
            width: 100%;
        }
        .btn-inquiry-submit {
            width: 100%;
            justify-content: center;
        }
        .inquiry-tab {
            flex: 1;
            justify-content: center;
            font-size: 12px;
        }
        .process-wrapper, .hamta-banner, .portal-preview-card {
            padding: 24px 16px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Tab switching
    const tabs = document.querySelectorAll('.inquiry-tab');
    const panels = document.querySelectorAll('.inquiry-panel');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));
            tab.classList.add('active');
            const target = document.getElementById(tab.getAttribute('data-tab'));
            if (target) target.classList.add('active');
            document.getElementById('inquiryResult').style.display = 'none';
        });
    });

    // Inquiry Handler
    function handleTrack(e, inputId) {
        e.preventDefault();
        const input = document.getElementById(inputId);
        const code = input.value.trim();
        const resultBox = document.getElementById('inquiryResult');
        if (!code) return;

        resultBox.style.display = 'block';
        resultBox.innerHTML = `
            <div style="text-align:center; padding: 20px; color: var(--primary);">
                <div style="font-weight:700;">در حال اتصال به سرور مرکزی سام موبایل و استعلام اطلاعات...</div>
            </div>
        `;

        fetch('{{ route("mob.track") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ code: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.found) {
                if (data.is_warranty_check) {
                    resultBox.innerHTML = `
                        <div style="border-right: 4px solid #10b981; padding-right: 14px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                                <h4 style="color:#10b981; font-weight:800; font-size:16px;">اصالت گارانتی مورد تایید است</h4>
                                <span style="font-size:12px; background:rgba(16,185,129,0.2); color:#10b981; padding:3px 10px; border-radius:12px; font-weight:700;">گارانتی معتبر ۱۸ ماهه</span>
                            </div>
                            <div style="font-size:14px; color:#fff; margin-bottom:6px;"><strong>دستگاه:</strong> ${data.data.device}</div>
                            <div style="font-size:14px; color:var(--text-muted); margin-bottom:6px;"><strong>شناسه سریال IMEI:</strong> <span style="direction:ltr; display:inline-block;">${data.data.imei}</span></div>
                            <div style="font-size:14px; color:var(--text-muted); margin-bottom:6px;"><strong>تاریخ ترخیص:</strong> ${data.data.import_clearance_date}</div>
                            <div style="font-size:14px; color:var(--text-muted); margin-bottom:12px;"><strong>تعهد پشتیبانی:</strong> ${data.data.support_term}</div>
                            <div style="padding:10px 14px; background:rgba(255,255,255,0.03); border-radius:10px; font-size:13px; color:#e2e8f0;">
                                گارانتی این دستگاه با هماهنگی سامانه جامع تجارت و سامانه جامع گارانتی ثبت گردیده و در سراسر کشور فعال می‌باشد.
                            </div>
                        </div>
                    `;
                } else {
                    const d = data.data;
                    resultBox.innerHTML = `
                        <div style="border-right: 4px solid #38bdf8; padding-right: 14px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; flex-wrap:wrap; gap:8px;">
                                <h4 style="color:#38bdf8; font-weight:800; font-size:16px;">پرونده خدماتی: ${d.tracking_code}</h4>
                                <span style="font-size:12px; background:rgba(56,189,248,0.2); color:#38bdf8; padding:3px 10px; border-radius:12px; font-weight:700;">${d.status_title}</span>
                            </div>
                            
                            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:10px; margin-bottom:14px; font-size:13.5px;">
                                <div><strong style="color:var(--text-muted);">مشتری:</strong> <span style="color:#fff;">${d.customer_name}</span></div>
                                <div><strong style="color:var(--text-muted);">مدل دستگاه:</strong> <span style="color:#fff;">${d.device}</span></div>
                                <div><strong style="color:var(--text-muted);">تاریخ پذیرش:</strong> <span style="color:#fff;">${d.reception_date}</span></div>
                                <div><strong style="color:var(--text-muted);">شعبه پذیرش:</strong> <span style="color:#fff;">${d.reception_branch}</span></div>
                                <div><strong style="color:var(--text-muted);">وضعیت گارانتی:</strong> <span style="color:#38bdf8;">${d.warranty_status}</span></div>
                                <div><strong style="color:var(--text-muted);">هزینه خدمات:</strong> <span style="color:#10b981; font-weight:700;">${d.total_cost}</span></div>
                            </div>

                            <div style="background:rgba(255,255,255,0.03); border-radius:12px; padding:12px; margin-bottom:10px; font-size:13px;">
                                <div><strong style="color:#38bdf8;">گزارش کارشناسی فنی:</strong> ${d.technician_diagnosis}</div>
                                <div style="margin-top:6px;"><strong style="color:#10b981;">اقدامات انجام‌شده:</strong> ${d.repaired_actions}</div>
                            </div>

                            <div style="font-size:12px; color:var(--text-dim); text-align:left;">
                                آخرین به‌روزرسانی سامانه: هم‌اکنون | مرکز تماس: ۰۲۱-۶۵۰۲۱۰۸۵
                            </div>
                        </div>
                    `;
                }
            } else {
                resultBox.innerHTML = `
                    <div style="color:#ef4444; padding:12px; font-size:14px; text-align:center;">
                        ${data.message || 'هیچ اطلاعاتی یافت نشد.'}
                    </div>
                `;
            }
        })
        .catch(err => {
            resultBox.innerHTML = `
                <div style="color:#ef4444; padding:12px; font-size:14px; text-align:center;">
                    خطا در برقراری ارتباط با سرور. لطفاً مجدداً تلاش نمایید.
                </div>
            `;
        });
    }
</script>
@endpush
