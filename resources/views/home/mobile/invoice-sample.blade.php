@extends('home.mobile.layout')

@section('title', 'نرخ تعرفه خدمات غیر گارانتی و فاکتور رسمی | تامین کانی سام (موبایل)')

@section('content')
<div class="container" style="max-width: 1400px; margin: 0 auto; padding: 20px 16px 80px;">

    <!-- Page Header Card -->
    <div class="page-header-card" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border: 1px solid #e2e8f0; border-radius: 20px; padding: 32px 28px; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04); margin-bottom: 28px; text-align: center;">
        <span class="section-tag" style="display: inline-block; background: #eff6ff; color: #2563eb; font-weight: 800; font-size: 0.82rem; padding: 4px 14px; border-radius: 99px; margin-bottom: 12px; border: 1px solid #dbeafe;">
            ⚖️ شفافیت مالی و مصوبات قانونی وزارت صمت
        </span>
        <h1 style="font-size: 1.7rem; font-weight: 900; color: #0f172a; margin-bottom: 10px; line-height: 1.4;">
            نرخ تعرفه خدمات غیر گارانتی و صورتحساب رسمی خدمات
        </h1>
        <p style="font-size: 0.94rem; color: #64748b; max-width: 880px; margin: 0 auto 20px; line-height: 1.8;">
            مطابق با مصوبات کارگروه نرخ‌گذاری اتحادیه دستگاه‌های مخابراتی، ارتباطی و لوازم جانبی شهرستان تهران (مصوب سال ۱۴۰۵) و ماده ۱۶ ضوابط اجرایی خدمات پس از فروش تلفن همراه
        </p>

        <!-- View Tabs -->
        <div class="tariff-tab-switcher" style="display: inline-flex; background: #f1f5f9; padding: 5px; border-radius: 14px; gap: 6px; flex-wrap: wrap; justify-content: center;">
            <button type="button" class="tab-btn active" id="btnTabTariff" onclick="switchTariffView('tariff')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                <span>نرخ تعرفه خدمات غیر گارانتی</span>
            </button>
            <button type="button" class="tab-btn" id="btnTabInvoice" onclick="switchTariffView('invoice')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                <span>نمونه صورتحساب رسمی فروش کالا و خدمات (ماده ۱۶)</span>
            </button>
        </div>

        <div style="margin-top: 18px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
            <button type="button" class="btn-glow" onclick="window.print()" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #fff; border: none; padding: 10px 20px; border-radius: 12px; font-weight: 800; font-size: 0.88rem; cursor: pointer; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                <span>چاپ یا ذخیره سند رسمی (PDF)</span>
            </button>
            <a href="{{ url('/complaints') }}" class="btn-secondary-action" style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #334155; border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 12px; font-weight: 700; font-size: 0.88rem; text-decoration: none;">
                <span>ثبت مغایرت تعرفه و شکایت</span>
            </a>
        </div>
    </div>


    <!-- ===================================================================
         VIEW 1: OFFICIAL UNION TARIFF SHEET (عیناً منطبق با تصویر ابلاغیه)
         =================================================================== -->
    <div id="viewUnionTariff" class="tariff-view-block" style="display: block;">

        <!-- Interactive Fee Estimator Card -->
        <div class="calculator-card" style="background: #ffffff; border: 1px solid #dbeafe; border-radius: 18px; padding: 22px 24px; margin-bottom: 24px; box-shadow: 0 4px 16px rgba(37, 99, 235, 0.05);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="14" x2="16" y2="18"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/></svg>
                </div>
                <div>
                    <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0;">محاسبه‌گر آنلاین نرخ تعرفه خدمات غیر گارانتی بر اساس ارزش گوشی</h3>
                    <p style="font-size: 0.80rem; color: #64748b; margin: 2px 0 0;">قیمت گوشی و نوع خدمت مورد نظر را انتخاب کنید تا نرخ قطعی مصوب اتحادیه نمایش داده شود.</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px; align-items: flex-end;">
                <div>
                    <label style="display: block; font-size: 0.82rem; font-weight: 800; color: #334155; margin-bottom: 6px;">رنج ارزش روز گوشی (میلیون تومان):</label>
                    <select id="calcPriceTier" class="calc-select" onchange="calculateTariffFee()" style="width: 100%; height: 44px; border: 1px solid #cbd5e1; border-radius: 10px; padding: 0 12px; font-family: inherit; font-size: 0.88rem; background: #f8fafc; font-weight: 700;">
                        <option value="0">۰ تا ۱۰ میلیون تومان (اقتصادی)</option>
                        <option value="1">۱۰ تا ۳۰ میلیون تومان (میان‌رده)</option>
                        <option value="2">۳۰ تا ۶۰ میلیون تومان (میان‌رده رو به بالا)</option>
                        <option value="3" selected>۶۰ تا ۱۰۰ میلیون تومان (بالارده)</option>
                        <option value="4">۱۰۰ تا ۲۰۰ میلیون تومان (پرچمدار)</option>
                        <option value="5">۲۰۰ تا ۳۰۰ میلیون تومان (پرچمدار پلاس)</option>
                        <option value="6">۳۰۰ تا ۳۵۰ میلیون تومان (اولترا و خاص)</option>
                        <option value="7">۳۵۰ تا ۵۰۰ میلیون تومان (لوکس)</option>
                        <option value="8">۵۰۰ میلیون تومان به بالا (فوق لوکس)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 0.82rem; font-weight: 800; color: #334155; margin-bottom: 6px;">نوع خدمت یا تعمیرات مورد نیاز:</label>
                    <select id="calcServiceRow" class="calc-select" onchange="calculateTariffFee()" style="width: 100%; height: 44px; border: 1px solid #cbd5e1; border-radius: 10px; padding: 0 12px; font-family: inherit; font-size: 0.88rem; background: #f8fafc; font-weight: 700;">
                        <option value="0">۱. نصب سیستم عامل (فلش و نرم‌افزار جانبی)</option>
                        <option value="1">۲. رفع عیوب تخصصی نرم‌افزاری</option>
                        <option value="2">۳. تعمیرات سخت‌افزاری سطح یک (دوربین، فلت، باطری، مادربورد و...)</option>
                        <option value="3" selected>۴. تعویض تاچ و ال‌سی‌دی - تعویض قاب</option>
                        <option value="4">۵. تعمیرات سخت‌افزاری سطح دو (کلیه قطعات و آی‌سی غیرچسبی)</option>
                        <option value="5">۶. تعمیر و تعویض قطعات الکترونیکی (CPU، هارد و آی‌سی‌های چسبی)</option>
                        <option value="6">۷. تعویض طبقات برد (سوآپ) یک طبقه</option>
                        <option value="7">۸. تعویض طبقات برد (سوآپ) دو طبقه</option>
                    </select>
                </div>

                <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid #bfdbfe; border-radius: 12px; padding: 10px 16px; text-align: center;">
                    <div style="font-size: 0.74rem; font-weight: 700; color: #1e40af;">سقف اجرت مصوب اتحادیه (تومان):</div>
                    <div id="calcResultDisplay" style="font-size: 1.25rem; font-weight: 900; color: #1d4ed8; margin-top: 2px;">۲,۵۰۰,۰۰۰ تومان</div>
                </div>
            </div>
        </div>

        <!-- Official Tariff Document Paper -->
        <div class="official-tariff-paper" id="tariffArea" style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 16px; padding: 36px 32px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); margin-bottom: 24px;">

            <!-- Official Letterhead Header -->
            <div class="tariff-header" style="display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #0f172a; padding-bottom: 20px; margin-bottom: 20px; gap: 16px;">
                <!-- Right Emblem -->
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 120px;">
                    <div style="width: 72px; height: 72px; border-radius: 50%; border: 2px solid #0284c7; padding: 3px; display: flex; align-items: center; justify-content: center; background: #f0f9ff; margin-bottom: 4px;">
                        <svg width="46" height="46" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="46" fill="none" stroke="#0284c7" stroke-width="4"/>
                            <path d="M35 70 A25 25 0 0 1 70 35" fill="none" stroke="#0284c7" stroke-width="5" stroke-linecap="round"/>
                            <rect x="42" y="38" width="18" height="32" rx="4" fill="#0284c7"/>
                            <path d="M51 20 L51 34" stroke="#e11d48" stroke-width="4" stroke-linecap="round"/>
                            <circle cx="51" cy="18" r="4" fill="#e11d48"/>
                        </svg>
                    </div>
                    <span style="font-size: 0.65rem; font-weight: 800; color: #475569;">تاسیس ۱۳۸۴</span>
                </div>

                <!-- Center Title -->
                <div style="text-align: center; flex: 1;">
                    <div style="display: inline-block; border-bottom: 2px solid #0284c7; padding-bottom: 4px; margin-bottom: 8px;">
                        <h2 style="font-size: 1.45rem; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; margin: 0;">
                            اتحادیه دستگاه‌های مخابراتی، ارتباطی و لوازم جانبی تهران
                        </h2>
                    </div>
                    <div style="font-size: 0.88rem; font-weight: 800; color: #2563eb;">
                        کارگروه رسمی نرخ‌گذاری و نظارت بر خدمات پس از فروش تلفن همراه
                    </div>
                </div>

                <!-- Left Emblem -->
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 120px;">
                    <div style="width: 72px; height: 72px; border-radius: 50%; border: 2px solid #0284c7; padding: 3px; display: flex; align-items: center; justify-content: center; background: #f0f9ff; margin-bottom: 4px;">
                        <svg width="46" height="46" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="46" fill="none" stroke="#0284c7" stroke-width="4"/>
                            <path d="M30 40 Q50 15 70 40" fill="none" stroke="#0284c7" stroke-width="4"/>
                            <path d="M22 55 Q50 10 78 55" fill="none" stroke="#0284c7" stroke-width="4"/>
                            <line x1="50" y1="40" x2="50" y2="82" stroke="#0f172a" stroke-width="5"/>
                            <polygon points="50,30 44,42 56,42" fill="#e11d48"/>
                        </svg>
                    </div>
                    <span style="font-size: 0.65rem; font-weight: 800; color: #475569;">سامانه نظارتی صمت</span>
                </div>
            </div>

            <!-- Official Preamble Notice (متن بخشنامه عیناً مانند تصویر) -->
            <div class="tariff-preamble" style="background: #f8fafc; border-right: 4px solid #2563eb; border-radius: 8px; padding: 14px 18px; margin-bottom: 22px; font-size: 0.86rem; color: #1e293b; line-height: 1.9; text-align: justify;">
                <p style="margin: 0 0 8px;">
                    <strong>با احترام،</strong> تعرفه ارائه‌کنندگان خدمات و تعمیرات گوشی‌های تلفن همراه که به تصویب هیئت‌مدیره رسیده، جهت اجراء ابلاغ می‌گردد. مسئولان محترم واحد صنفی ضمن رعایت دقیق، آن را در معرض دید مشتریان نصب نمایند.
                </p>
                <p style="margin: 0; color: #b91c1c; font-weight: 700;">
                    <span style="background: #fee2e2; padding: 2px 8px; border-radius: 4px; margin-left: 6px;">توجه:</span>
                    خدمات تعمیرات گوشی تلفن همراه مستلزم داشتن پروانه کسب معتبر صادر شده از این اتحادیه در رسته مربوطه بوده و واحدهای صنفی که پروانه کسب آنان فاقد مضمون فوق‌الذکر در ستون رسته واحد صنفی می‌باشد مجاز به این امر نمی‌باشند.
                </p>
                <div style="margin-top: 8px; font-weight: 800; color: #0f172a; display: flex; justify-content: space-between; flex-wrap: wrap;">
                    <span>جدول رسمی نرخ تعرفه خدمات غیر گارانتی (بر اساس مصوبات کارگروه نرخ‌گذاری صنف مخابرات سال ۱۴۰۵)</span>
                    <span style="color: #2563eb;">(نرخ‌ها به تومان می‌باشد)</span>
                </div>
            </div>

            <!-- MATRIX TARIFF TABLE (Full 8 Rows x 10 Columns) -->
            <div class="table-responsive" style="overflow-x: auto; margin-bottom: 24px; border: 1px solid #cbd5e1; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                <table class="tariff-matrix-table" style="width: 100%; border-collapse: collapse; text-align: center; font-size: 0.81rem; min-width: 1100px;">
                    <thead>
                        <tr style="background: #0f172a; color: #ffffff;">
                            <th rowspan="2" style="padding: 14px 12px; border: 1px solid #334155; font-weight: 900; font-size: 0.86rem; min-width: 270px; text-align: right;">
                                شرح خدمات و تعمیرات
                            </th>
                            <th colspan="9" style="padding: 10px 8px; border: 1px solid #334155; font-weight: 900; font-size: 0.88rem; background: #1e293b; color: #60a5fa;">
                                شرح ارزش و قیمت گوشی (میلیون تومان)
                            </th>
                        </tr>
                        <tr style="background: #1e293b; color: #f1f5f9; font-weight: 800;">
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 82px;">۰ - ۱۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 82px;">۱۰ - ۳۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 82px;">۳۰ - ۶۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 86px;">۶۰ - ۱۰۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 90px;">۱۰۰ - ۲۰۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 96px;">۲۰۰ - ۳۰۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 96px;">۳۰۰ - ۳۵۰</th>
                            <th style="padding: 10px 6px; border: 1px solid #334155; min-width: 98px;">۳۵۰ - ۵۰۰</th>
                            <th style="padding: 10px 8px; border: 1px solid #334155; min-width: 115px; background: #0f172a; color: #fbbf24;">۵۰۰ به بالا</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr style="background: #ffffff;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#ffffff'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                نصب سیستم عامل (فلش و نرم‌افزار جانبی)
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۴۵۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۶۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۹۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۲۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۸۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۰/۶ درصد ارزش کالا</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr style="background: #f8fafc;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                رفع عیوب تخصصی نرم‌افزاری
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۶۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۲۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۸۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۰/۷ درصد ارزش کالا</td>
                        </tr>

                        <!-- Row 3 -->
                        <tr style="background: #ffffff;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#ffffff'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right; line-height: 1.6;">
                                تعمیرات سخت‌افزاری سطح یک قطعات <span style="font-weight: 500; font-size: 0.74rem; color: #64748b;">(دوربین، کپسول گوشی، میکروفن، بازر، فلت و...) تعویض مادربورد، تعویض باطری، تعویض انواع کانکتور و سرویس سخت‌افزاری (شامل باز و بست و رفع ایراد)</span>
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۲۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۸۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۶,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۷,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۰/۹ درصد ارزش کالا</td>
                        </tr>

                        <!-- Row 4 -->
                        <tr style="background: #f8fafc;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                تعویض تاچ و ال‌سی‌دی - تعویض قاب
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۸۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۲۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۸۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۷,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۹,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۲ درصد ارزش کالا</td>
                        </tr>

                        <!-- Row 5 -->
                        <tr style="background: #ffffff;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#ffffff'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                تعمیرات سخت‌افزاری سطح دو <span style="font-weight: 500; font-size: 0.74rem; color: #64748b;">(شامل کلیه قطعات الکترونیک و آی‌سی غیرچسبی)</span>
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱,۲۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۴,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۷,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۴,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۶,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲۰,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۴ درصد ارزش کالا</td>
                        </tr>

                        <!-- Row 6 -->
                        <tr style="background: #f8fafc;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                تعمیر و تعویض قطعات الکترونیکی <span style="font-weight: 500; font-size: 0.74rem; color: #64748b;">(شامل CPU، هارد و کلیه آی‌سی‌های چسبی)</span>
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۴,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۰,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲۲,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۲۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۵ درصد ارزش کالا</td>
                        </tr>

                        <!-- Row 7 -->
                        <tr style="background: #ffffff;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#ffffff'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                تعویض طبقات برد (سوآپ) یک طبقه
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۷,۵۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۰,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۶,۰۰۰,۰۰۰</td>
                            <td style="padding: 8px 4px; border: 1px solid #e2e8f0; font-size: 0.76rem; font-weight: 700; color: #334155; line-height: 1.4;">
                                ۲۵,۰۰۰,۰۰۰ <span style="font-size:0.68rem; color:#64748b;">(پایین)</span><br>۱۵,۰۰۰,۰۰۰ <span style="font-size:0.68rem; color:#64748b;">(بالا)</span>
                            </td>
                            <td style="padding: 8px 4px; border: 1px solid #e2e8f0; font-size: 0.76rem; font-weight: 700; color: #334155; line-height: 1.4;">
                                ۳۵,۰۰۰,۰۰۰ <span style="font-size:0.68rem; color:#64748b;">(پایین)</span><br>۳۰,۰۰۰,۰۰۰ <span style="font-size:0.68rem; color:#64748b;">(بالا)</span>
                            </td>
                            <td style="padding: 8px 4px; border: 1px solid #e2e8f0; font-size: 0.76rem; font-weight: 800; color: #1e40af; background: #eff6ff; line-height: 1.4;">
                                ۷٪ کالا <span style="font-size:0.68rem; color:#64748b;">(پایین)</span><br>۶٪ کالا <span style="font-size:0.68rem; color:#64748b;">(بالا)</span>
                            </td>
                        </tr>

                        <!-- Row 8 -->
                        <tr style="background: #f8fafc;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            <td style="padding: 12px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">
                                تعویض طبقات برد (سوآپ) دو طبقه
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۸,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۱۲,۰۰۰,۰۰۰</td>
                            <td style="padding: 8px 4px; border: 1px solid #e2e8f0; font-size: 0.74rem; font-weight: 700; color: #334155; line-height: 1.3;">
                                ۱۶,۰۰۰,۰۰۰<br><span style="font-size: 0.64rem; color: #2563eb; font-weight: 600;">(IC charge-OVP تامین کانی سام (موبایل) و برندهای تحت پوشش)</span>
                            </td>
                            <td style="padding: 8px 4px; border: 1px solid #e2e8f0; font-size: 0.74rem; font-weight: 700; color: #334155; line-height: 1.3;">
                                ۲۵,۰۰۰,۰۰۰<br><span style="font-size: 0.64rem; color: #2563eb; font-weight: 600;">(IC charge-OVP تامین کانی سام (موبایل) و برندهای تحت پوشش)</span>
                            </td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۳۰,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 6px; border: 1px solid #e2e8f0; font-weight: 700; color: #334155;">۴۵,۰۰۰,۰۰۰</td>
                            <td style="padding: 10px 8px; border: 1px solid #e2e8f0; font-weight: 800; color: #1e40af; background: #eff6ff;">۹ درصد ارزش کالا</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- OFFICIAL FOOTNOTES (تبصره‌های قانونی ۷ گانه مصوب اتحادیه عیناً) -->
            <div class="tariff-footnotes" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px 24px; margin-bottom: 24px;">
                <h4 style="font-size: 0.96rem; font-weight: 900; color: #0f172a; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span>تبصره‌ها و ضوابط اجرایی الزامی مصوب اتحادیه دستگاه‌های مخابراتی</span>
                </h4>

                <div style="display: flex; flex-direction: column; gap: 10px; font-size: 0.85rem; color: #334155; line-height: 1.8;">
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۱ :</span>
                        <span>ارائه رسید تعمیرات در هنگام پذیرش و درج کلیه اطلاعات گوشی در آن الزامی است.</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۲ :</span>
                        <span>ارائه فاکتور به مشتری و درج هزینه‌های دریافتی مربوط به قطعه و اجرت به تفکیک الزامی است.</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۳ :</span>
                        <span>در موارد خاص توافق کتبی طرفین ملاک خواهد بود.</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۴ :</span>
                        <span>قبل از انجام تعمیرات، قیمت کل تعمیر دستگاه، با احتساب قیمت قطعه توسط مسئول واحد صنفی اعلام گردد.</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۵ :</span>
                        <span>در صورت نیاز به چندین خدمات سخت‌افزاری در سطح یک تنها یک نرخ (بالاترین نرخ) محاسبه می‌گردد و در صورت ارائه تعمیرات سخت‌افزاری در سطح دو و در کنار سطح یک هزینه جداگانه محاسبه و دریافت می‌گردد.</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۶ :</span>
                        <span>سود فروش قطعه ۹ درصد جداگانه محاسبه خواهد شد.</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-weight: 900; color: #2563eb; white-space: nowrap;">تبصره ۷ :</span>
                        <span>اجرت رفع ارور قطعات ۱۰ درصد از قیمت قطعه می‌باشد که به قیمت اجرت تعویض اضافه می‌گردد.</span>
                    </div>
                </div>
            </div>

            <!-- Union Secretariat Footer (عیناً مانند پانویس تصویر) -->
            <div class="tariff-doc-footer" style="border-top: 2px solid #0f172a; padding-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; font-size: 0.82rem; color: #475569;">
                <div>
                    <strong>تهران — جمهوری، حافظ، بعد از بورس، خیابان حسنی، پلاک ۱۸</strong>
                </div>
                <div style="direction: ltr; display: flex; gap: 16px; font-family: monospace; font-size: 0.84rem; font-weight: 700;">
                    <span><strong>تلفن:</strong> ۶۶۷۶۳۰۱۷-۶۶۷۶۳۰۳۵</span>
                    <span><strong>فکس:</strong> ۶۶۷۶۳۰۱۰</span>
                    <span><strong>سایت:</strong> <a href="https://www.ttu.ir" target="_blank" style="color: #2563eb; text-decoration: underline;">www.ttu.ir</a></span>
                </div>
            </div>

        </div>
    </div>


    <!-- ===================================================================
         VIEW 2: OFFICIAL PRINTABLE INVOICE (نمونه صورتحساب رسمی استاندارد ماده ۱۶)
         =================================================================== -->
    <div id="viewOfficialInvoice" class="tariff-view-block" style="display: none;">
        <!-- Official Printable Invoice -->
        <div class="invoice-paper" id="invoiceArea" style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 16px; padding: 32px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); margin-bottom: 24px;">
            <!-- Invoice Header -->
            <div class="inv-header">
                <div class="inv-header-right">
                    <div class="inv-logo-text">
                        <h2>شرکت تامین کانی سام</h2>
                        <span>واحد خدمات پس از فروش و گارانتی رسمی تامین کانی سام (موبایل)</span>
                    </div>
                </div>

                <div class="inv-header-center">
                    <h1 class="inv-title">صورتحساب فروش کالا و خدمات</h1>
                    <div class="inv-subtitle">مطابق با ماده ۱۶ ضوابط اجرایی خدمات پس از فروش</div>
                </div>

                <div class="inv-header-left">
                    <div class="inv-meta-row"><span>شماره سریال:</span> <strong>SAM-1403-9102</strong></div>
                    <div class="inv-meta-row"><span>تاریخ صدور:</span> <strong>۱۴۰۳/۰۸/۱۵</strong></div>
                    <div class="inv-meta-row"><span>شناسه یکتای مالیاتی:</span> <strong>A9102-TK77-9821</strong></div>
                </div>
            </div>

            <!-- Seller Info Box -->
            <div class="inv-box" style="margin-top: 14px;">
                <div class="inv-box-title">مشخصات فروشنده / ارائه‌دهنده خدمت</div>
                <div class="inv-grid-4">
                    <div><span>نام شخص حقوقی:</span> <strong>شرکت تامین کانی سام</strong></div>
                    <div><span>شماره اقتصادی:</span> <strong>۴۱۱۶۸۹۸۲۱۵۴۲</strong></div>
                    <div><span>شناسه ملی:</span> <strong>۱۴۰۰۹۲۱۷۰۰۹</strong></div>
                    <div><span>شماره ثبت:</span> <strong>۵۸۹۸۲۱</strong></div>
                </div>
                <div class="inv-grid-3" style="margin-top: 6px;">
                    <div><span>استان و شهرستان:</span> <strong>آذربایجان شرقی - تبریز</strong></div>
                    <div><span>کد پستی ۱۰ رقمی:</span> <strong>۵۱۵۷۹۷۴۷۱۱</strong></div>
                    <div><span>تلفن تماس:</span> <strong>۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)</strong></div>
                </div>
                <div style="margin-top: 6px; font-size: 12.5px;">
                    <span>نشانی کامل:</span> <strong>تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</strong>
                </div>
            </div>

            <!-- Buyer Info Box -->
            <div class="inv-box" style="margin-top: 10px;">
                <div class="inv-box-title">مشخصات خریدار / متقاضی خدمت</div>
                <div class="inv-grid-4">
                    <div><span>نام شخص حقیقی/حقوقی:</span> <strong>علیرضا اسماعیلی</strong></div>
                    <div><span>کد ملی / شناسه ملی:</span> <strong>۰۰۱۲۳۴۵۶۷۸</strong></div>
                    <div><span>شماره تلفن همراه:</span> <strong>۰۹۱۲۳۴۵۶۷۸۹</strong></div>
                    <div><span>کد رهگیری پذیرش:</span> <strong>SAM-1403-9102</strong></div>
                </div>
                <div class="inv-grid-3" style="margin-top: 6px;">
                    <div><span>استان و شهرستان:</span> <strong>تهران - تهران</strong></div>
                    <div><span>مدل دستگاه:</span> <strong>Galaxy S24 Ultra 512GB</strong></div>
                    <div><span>شناسه IMEI:</span> <strong>۳۵۹۴۸۳۱۱۰۲۹۴۸۱۲</strong></div>
                </div>
                <div style="margin-top: 6px; font-size: 12.5px;">
                    <span>نشانی:</span> <strong>تهران، خیابان جمهوری، تقاطع حافظ، پاساژ چارسو</strong>
                </div>
            </div>

            <!-- Items Table -->
            <div class="inv-table-wrap" style="margin-top: 10px; overflow-x: auto;">
                <table class="inv-table" style="width: 100%; border-collapse: collapse; min-width: 850px;">
                    <thead>
                        <tr>
                            <th style="width: 35px;">ردیف</th>
                            <th style="width: 85px;">کد کالا/خدمت</th>
                            <th>شرح کالا یا خدمت ارائه‌شده</th>
                            <th style="width: 45px;">تعداد</th>
                            <th style="width: 50px;">واحد</th>
                            <th style="width: 105px;">مبلغ واحد (ریال)</th>
                            <th style="width: 110px;">مبلغ کل (ریال)</th>
                            <th style="width: 90px;">تخفیف (ریال)</th>
                            <th style="width: 95px;">مالیات و عوارض</th>
                            <th style="width: 120px;">مبلغ نهایی (ریال)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center;">۱</td>
                            <td>SRV-01</td>
                            <td>تعویض تاچ و ال‌سی‌دی اورجینال شرکتی مطابق استاندارد کارخانه</td>
                            <td style="text-align:center;">۱</td>
                            <td style="text-align:center;">عدد</td>
                            <td>۱۸,۵۰۰,۰۰۰</td>
                            <td>۱۸,۵۰۰,۰۰۰</td>
                            <td>۰</td>
                            <td>۱,۸۵۰,۰۰۰</td>
                            <td>۲۰,۳۵۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">۲</td>
                            <td>WGE-04</td>
                            <td>اجرت تعویض تاچ و ال‌سی‌دی طبق نرخ‌نامه مصوب سال ۱۴۰۵ اتحادیه صنف مخابرات</td>
                            <td style="text-align:center;">۱</td>
                            <td style="text-align:center;">خدمت</td>
                            <td>۲۵,۰۰۰,۰۰۰</td>
                            <td>۲۵,۰۰۰,۰۰۰</td>
                            <td>۵,۰۰۰,۰۰۰</td>
                            <td>۲,۰۰۰,۰۰۰</td>
                            <td>۲۲,۰۰۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">۳</td>
                            <td>PRT-99</td>
                            <td>پک عایق ضدآب استاندارد IP68 و چسب مخصوص فابریک</td>
                            <td style="text-align:center;">۱</td>
                            <td style="text-align:center;">دست</td>
                            <td>۱,۲۰۰,۰۰۰</td>
                            <td>۱,۲۰۰,۰۰۰</td>
                            <td>۰</td>
                            <td>۱۲۰,۰۰۰</td>
                            <td>۱,۳۲۰,۰۰۰</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary & Tax Section -->
            <div class="inv-summary-grid" style="margin-top: 10px;">
                <div class="inv-summary-notes">
                    <div style="font-weight: 800; color: #0f172a; margin-bottom: 4px;">توضیحات و شرایط گارانتی قطعه:</div>
                    <p style="margin: 0; font-size: 11.5px; color: #475569; line-height: 1.7;">
                        ۱. قطعه تعویض شده فوق دارای ۶ ماه گارانتی تعویض کتبی تامین کانی سام (موبایل) می‌باشد.<br>
                        ۲. داغی قطعه مستهلک تعویض شده به مشتری محترم تحویل داده شد.<br>
                        ۳. دستگاه در حضور مشتری تست کامل گردید و با سلامت ۱۰۰٪ تحویل شد.
                    </p>
                </div>
                <div class="inv-summary-totals">
                    <div class="total-row"><span>جمع کل ناخالص:</span> <strong>۴۴,۷۰۰,۰۰۰ ریال</strong></div>
                    <div class="total-row"><span>مجموع تخفیفات:</span> <strong>۵,۰۰۰,۰۰۰ ریال</strong></div>
                    <div class="total-row"><span>مالیات و عوارض ارزش افزوده (۱۰٪):</span> <strong>۳,۹۷۰,۰۰۰ ریال</strong></div>
                    <div class="total-row grand"><span>مبلغ قابل پرداخت:</span> <strong>۴۳,۶۷۰,۰۰۰ ریال</strong></div>
                    <div style="font-size: 11px; color: #0284c7; margin-top: 6px; font-weight: 700; text-align: left;">
                        معادل چهار میلیون و سیصد و شصت و هفت هزار تومان
                    </div>
                </div>
            </div>

            <!-- Signatures & Stamp -->
            <div class="inv-signatures-row" style="margin-top: 18px;">
                <div class="sign-col">
                    <div class="sign-title">مهر و امضای کارشناس فنی / پذیرش:</div>
                    <div class="sign-space"></div>
                    <div class="digital-stamp">
                        تامین کانی سام<br>
                        خدمات پس از فروش<br>
                        گارانتی سام
                    </div>
                </div>
                <div class="sign-col">
                    <div class="sign-title">مهر و امضای مدیر شعبه / پذیرش مرکزی:</div>
                    <div class="sign-space"></div>
                </div>
                <div class="sign-col">
                    <div class="sign-title">امضای متقاضی / مشتری:</div>
                    <div class="sign-space"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
    /* Tab switcher button styles */
    .tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: #475569;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: inherit;
    }
    .tab-btn:hover {
        color: #0f172a;
        background: rgba(255, 255, 255, 0.7);
    }
    .tab-btn.active {
        background: #ffffff;
        color: #2563eb;
        font-weight: 900;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
    }

    /* Matrix Table responsive styling */
    .tariff-matrix-table th, .tariff-matrix-table td {
        border-color: #cbd5e1;
    }

    /* Print styling */
    @media print {
        body { background: #fff !important; }
        .site-header, .site-footer, .top-notice-bar, .page-header-card, .calculator-card, .tariff-tab-switcher, .btn-glow, .btn-secondary-action {
            display: none !important;
        }
        .container { padding: 0 !important; max-width: 100% !important; margin: 0 !important; }
        .official-tariff-paper, .invoice-paper {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        .tariff-view-block { display: block !important; }
    }

    /* Invoice paper internal styling */
    .inv-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #0f172a; padding-bottom: 14px; }
    .inv-logo-text h2 { font-size: 1.15rem; font-weight: 900; color: #0f172a; margin: 0; }
    .inv-logo-text span { font-size: 0.78rem; color: #64748b; }
    .inv-title { font-size: 1.35rem; font-weight: 900; color: #0284c7; text-align: center; margin: 0; }
    .inv-subtitle { font-size: 0.78rem; color: #475569; text-align: center; }
    .inv-meta-row { font-size: 0.78rem; color: #475569; display: flex; justify-content: flex-end; gap: 6px; }
    .inv-box { border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 14px; font-size: 0.80rem; }
    .inv-box-title { font-weight: 900; color: #0f172a; margin-bottom: 6px; font-size: 0.85rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 4px; }
    .inv-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; }
    .inv-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
    .inv-table { border: 1px solid #cbd5e1; font-size: 0.78rem; }
    .inv-table th { background: #f1f5f9; color: #0f172a; font-weight: 800; border: 1px solid #cbd5e1; padding: 8px 6px; text-align: right; }
    .inv-table td { border: 1px solid #cbd5e1; padding: 7px 6px; color: #334155; }
    .inv-summary-grid { display: grid; grid-template-columns: 1.3fr 1fr; gap: 14px; }
    .inv-summary-notes { border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 14px; }
    .inv-summary-totals { border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 14px; }
    .total-row { display: flex; justify-content: space-between; font-size: 0.80rem; padding: 3px 0; }
    .total-row.grand { font-size: 0.95rem; font-weight: 900; color: #0284c7; border-top: 1px solid #e2e8f0; margin-top: 4px; padding-top: 6px; }
    .inv-signatures-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px; }
    .sign-col { text-align: center; }
    .sign-title { font-weight: 700; font-size: 0.78rem; color: #475569; }
    .sign-space { height: 40px; }
    .digital-stamp { border: 2px dashed #0284c7; color: #0284c7; border-radius: 50%; width: 75px; height: 75px; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 10px; font-weight: 800; line-height: 1.3; transform: rotate(-10deg); background: rgba(2, 132, 199, 0.04); }

    @media (max-width: 800px) {
        .inv-grid-4, .inv-grid-3, .inv-summary-grid, .inv-signatures-row { grid-template-columns: 1fr; }
        .inv-header { flex-direction: column; text-align: center; gap: 10px; }
        .inv-header-left { text-align: center; justify-content: center; }
        .official-tariff-paper, .invoice-paper { padding: 18px 12px !important; }
        .tariff-header { flex-direction: column; text-align: center; }
        .tariff-doc-footer { flex-direction: column; text-align: center; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Exact Matrix Data (Rows x Price Tiers)
    const TARIFF_DATA = [
        // Row 0: نصب سیستم عامل
        ['۳۰۰,۰۰۰', '۴۵۰,۰۰۰', '۶۰۰,۰۰۰', '۹۰۰,۰۰۰', '۱,۲۰۰,۰۰۰', '۱,۸۰۰,۰۰۰', '۲,۵۰۰,۰۰۰', '۳,۵۰۰,۰۰۰', '۰/۶ درصد ارزش کالا'],
        // Row 1: رفع عیوب تخصصی نرم افزاری
        ['۵۰۰,۰۰۰', '۶۰۰,۰۰۰', '۱,۰۰۰,۰۰۰', '۱,۲۰۰,۰۰۰', '۱,۸۰۰,۰۰۰', '۲,۵۰۰,۰۰۰', '۳,۵۰۰,۰۰۰', '۵,۰۰۰,۰۰۰', '۰/۷ درصد ارزش کالا'],
        // Row 2: تعمیرات سخت افزاری سطح یک
        ['۵۰۰,۰۰۰', '۱,۰۰۰,۰۰۰', '۱,۲۰۰,۰۰۰', '۱,۸۰۰,۰۰۰', '۲,۵۰۰,۰۰۰', '۳,۵۰۰,۰۰۰', '۶,۰۰۰,۰۰۰', '۷,۰۰۰,۰۰۰', '۰/۹ درصد ارزش کالا'],
        // Row 3: تعویض تاچ و ال سی دی
        ['۸۰۰,۰۰۰', '۱,۲۰۰,۰۰۰', '۱,۸۰۰,۰۰۰', '۲,۵۰۰,۰۰۰', '۳,۰۰۰,۰۰۰', '۵,۰۰۰,۰۰۰', '۷,۰۰۰,۰۰۰', '۹,۰۰۰,۰۰۰', '۲ درصد ارزش کالا'],
        // Row 4: تعمیرات سخت افزاری سطح دو
        ['۱,۲۰۰,۰۰۰', '۲,۰۰۰,۰۰۰', '۳,۰۰۰,۰۰۰', '۴,۰۰۰,۰۰۰', '۷,۰۰۰,۰۰۰', '۱۴,۰۰۰,۰۰۰', '۱۶,۰۰۰,۰۰۰', '۲۰,۰۰۰,۰۰۰', '۴ درصد ارزش کالا'],
        // Row 5: قطعات الکترونیکی (CPU و هارد)
        ['۲,۰۰۰,۰۰۰', '۳,۵۰۰,۰۰۰', '۴,۵۰۰,۰۰۰', '۵,۰۰۰,۰۰۰', '۱۰,۰۰۰,۰۰۰', '۱۵,۰۰۰,۰۰۰', '۲۲,۰۰۰,۰۰۰', '۲۵,۰۰۰,۰۰۰', '۵ درصد ارزش کالا'],
        // Row 6: سوآپ یک طبقه
        ['—', '—', '۵,۰۰۰,۰۰۰', '۷,۵۰۰,۰۰۰', '۱۰,۰۰۰,۰۰۰', '۱۶,۰۰۰,۰۰۰', '۲۵,۰۰۰,۰۰۰ (پایین) / ۱۵,۰۰۰,۰۰۰ (بالا)', '۳۵,۰۰۰,۰۰۰ (پایین) / ۳۰,۰۰۰,۰۰۰ (بالا)', '۷٪ (پایین) / ۶٪ (بالا)'],
        // Row 7: سوآپ دو طبقه
        ['—', '—', '۸,۰۰۰,۰۰۰', '۱۲,۰۰۰,۰۰۰', '۱۶,۰۰۰,۰۰۰ (IC charge-OVP تامین کانی سام (موبایل))', '۲۵,۰۰۰,۰۰۰ (IC charge-OVP تامین کانی سام (موبایل))', '۳۰,۰۰۰,۰۰۰', '۴۵,۰۰۰,۰۰۰', '۹ درصد ارزش کالا']
    ];

    function calculateTariffFee() {
        const tier = parseInt(document.getElementById('calcPriceTier').value);
        const row = parseInt(document.getElementById('calcServiceRow').value);
        const val = TARIFF_DATA[row][tier];
        const disp = document.getElementById('calcResultDisplay');
        if (val === '—') {
            disp.innerText = 'غیرقابل انجام / خارج از دامنه این رده قیمت';
            disp.style.fontSize = '0.92rem';
        } else {
            disp.innerText = val + (val.includes('درصد') || val.includes('٪') ? '' : ' تومان');
            disp.style.fontSize = '1.25rem';
        }
    }

    function switchTariffView(view) {
        const tariffDiv = document.getElementById('viewUnionTariff');
        const invDiv = document.getElementById('viewOfficialInvoice');
        const btnTariff = document.getElementById('btnTabTariff');
        const btnInv = document.getElementById('btnTabInvoice');

        if (view === 'tariff') {
            tariffDiv.style.display = 'block';
            invDiv.style.display = 'none';
            btnTariff.classList.add('active');
            btnInv.classList.remove('active');
        } else {
            tariffDiv.style.display = 'none';
            invDiv.style.display = 'block';
            btnTariff.classList.remove('active');
            btnInv.classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);
        if (params.get('tab') === 'invoice') {
            switchTariffView('invoice');
        } else {
            switchTariffView('tariff');
        }
        calculateTariffFee();
    });
</script>
@endpush
@endsection
