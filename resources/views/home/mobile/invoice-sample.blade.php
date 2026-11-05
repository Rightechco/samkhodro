@extends('home.mobile.layout')

@section('title', 'نمونه فاکتور رسمی هزینه خدمات و کالا مطابق تعرفه اتحادیه | سام موبایل')

@section('content')
<div class="container">
    <div class="page-header-card">
        <span class="section-tag">شفافیت مالی و تعرفه</span>
        <h1>نمونه فاکتور رسمی هزینه خدمات پس از فروش و قطعات</h1>
        <p>مطابق ماده ۱۶ ضوابط اجرایی وزارت صمت و فرمت استاندارد سازمان امور مالیاتی و اتحادیه صنف دستگاه‌های مخابراتی</p>
        <div style="margin-top: 18px;">
            <button type="button" class="btn-glow" onclick="window.print()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                <span>چاپ یا ذخیره فاکتور رسمی (PDF)</span>
            </button>
        </div>
    </div>

    <!-- Official Printable Invoice (Exact recreation of PDF Page 20) -->
    <div class="invoice-paper" id="invoiceArea">
        <!-- Invoice Header -->
        <div class="inv-header">
            <div class="inv-header-right">
                <div class="inv-logo-text">
                    <h2>شرکت تامین کانی سام</h2>
                    <span>واحد خدمات پس از فروش و گارانتی سام موبایل</span>
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
        <div class="inv-box">
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
        <div class="inv-table-wrap" style="margin-top: 10px;">
            <table class="inv-table">
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
                        <td>
                            <strong>کارشناسی فنی، عیب‌یابی و رفع قطعی پورت شارژ (تحت پوشش گارانتی ۱۸ ماهه)</strong>
                            <div style="font-size:11px; color:#555;">با تضمین ۶ ماهه خدمات ارائه شده طبق ماده ۹ ضوابط اجرایی</div>
                        </td>
                        <td style="text-align:center;">۱</td>
                        <td style="text-align:center;">خدمت</td>
                        <td style="text-align:left;">۴,۵۰۰,۰۰۰</td>
                        <td style="text-align:left;">۴,۵۰۰,۰۰۰</td>
                        <td style="text-align:left;">۴,۵۰۰,۰۰۰</td>
                        <td style="text-align:left;">۰</td>
                        <td style="text-align:left; font-weight:700;">۰ (رایگان)</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">۲</td>
                        <td>PRT-982</td>
                        <td>
                            <strong>فلت شارژ و سوکت Type-C اورجینال فابریک Galaxy S24 Ultra</strong>
                            <div style="font-size:11px; color:#555;">پارت نامبر: GH96-16281A با ۶ ماه ضمانت قطعه تعویض‌شده</div>
                        </td>
                        <td style="text-align:center;">۱</td>
                        <td style="text-align:center;">عدد</td>
                        <td style="text-align:left;">۱۸,۵۰۰,۰۰۰</td>
                        <td style="text-align:left;">۱۸,۵۰۰,۰۰۰</td>
                        <td style="text-align:left;">۱۸,۵۰۰,۰۰۰</td>
                        <td style="text-align:left;">۰</td>
                        <td style="text-align:left; font-weight:700;">۰ (رایگان)</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">۳</td>
                        <td>QC-04</td>
                        <td>
                            <strong>تست کنترل کیفی (QC)، تست سلامت باتری و آزمون شارژ سریع ۴۵ وات</strong>
                            <div style="font-size:11px; color:#555;">بررسی استاندارد مدار شارژ و سنسورهای حرارتی</div>
                        </td>
                        <td style="text-align:center;">۱</td>
                        <td style="text-align:center;">مورد</td>
                        <td style="text-align:left;">۱,۲۰۰,۰۰۰</td>
                        <td style="text-align:left;">۱,۲۰۰,۰۰۰</td>
                        <td style="text-align:left;">۱,۲۰۰,۰۰۰</td>
                        <td style="text-align:left;">۰</td>
                        <td style="text-align:left; font-weight:700;">۰ (رایگان)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Invoice Totals & Summary -->
        <div class="inv-summary-grid">
            <div class="inv-notes">
                <div style="font-weight:700; margin-bottom: 4px;">توضیحات و تعهدات قانونی:</div>
                <ul style="padding-right: 16px; margin: 0; font-size: 11.5px; line-height: 1.7; color: #444;">
                    <li>دستگاه فوق تحت پوشش گارانتی ۱۸ ماهه رسمی شرکت تامین کانی سام بوده و تمامی هزینه‌ها شامل ۱۰۰٪ تخفیف پوشش گارانتی لحاظ گردید.</li>
                    <li>کلیه خدمات و قطعات تعویض شده به مدت ۶ ماه از تاریخ این فاکتور دارای ضمانت تعویض و رفع عیب مجدد می‌باشند (ماده ۱۶ ضوابط صمت).</li>
                    <li>در صورت تکرار عیب در دوره گارانتی، دستگاه مشمول تعویض با کالای آکبند خواهد بود.</li>
                </ul>
            </div>

            <div class="inv-totals-table">
                <div class="inv-total-row"><span>جمع کل مبلغ خدمات و کالا:</span> <strong>۲۴,۲۰۰,۰۰۰ ریال</strong></div>
                <div class="inv-total-row"><span>تخفیف پوشش گارانتی ۱۸ ماهه:</span> <strong style="color:#0284c7;">۲۴,۲۰۰,۰۰۰ ریال</strong></div>
                <div class="inv-total-row"><span>مالیات بر ارزش افزوده (۱۰٪):</span> <strong>۰ ریال</strong></div>
                <div class="inv-total-row final-row">
                    <span>مبلغ قابل پرداخت:</span> 
                    <strong style="color:#10b981; font-size:16px;">۰ ریال (رایگان)</strong>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px; font-size: 12px; font-weight:700; padding: 6px 12px; background: #f1f5f9; border-radius: 6px;">
            <span>مبلغ به حروف:</span> صفر ریال (خدمات رایگان مشمول گارانتی رسمی تامین کانی سام)
        </div>

        <!-- Signatures Box -->
        <div class="inv-signatures-row">
            <div class="sign-box">
                <div class="sign-title">شرایط و نحوه تسویه:</div>
                <div style="font-size: 12px; margin-top: 6px;">
                    <label><input type="checkbox" checked disabled> تحت پوشش گارانتی</label> &nbsp;&nbsp;
                    <label><input type="checkbox" disabled> نقدی</label> &nbsp;&nbsp;
                    <label><input type="checkbox" disabled> اعتباری</label>
                </div>
            </div>

            <div class="sign-box">
                <div class="sign-title">مهر و امضاء مشتری / تحویل‌گیرنده:</div>
                <div class="sign-space"></div>
            </div>

            <div class="sign-box">
                <div class="sign-title">مهر و امضاء امور خدمات پس از فروش:</div>
                <div class="sign-space" style="position: relative;">
                    <div class="digital-stamp">
                        شرکت تامین کانی سام<br>
                        واحد خدمات و گارانتی<br>
                        تایید شد
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-header-card {
        text-align: center;
        padding: 40px 20px 20px;
        margin-bottom: 20px;
    }
    .page-header-card h1 {
        font-size: 26px;
        font-weight: 900;
        color: var(--text-main);
        margin: 12px 0 8px;
    }
    .page-header-card p {
        font-size: 14.5px;
        color: var(--text-muted);
        max-width: 700px;
        margin: 0 auto;
    }

    /* Printable Paper Style */
    .invoice-paper {
        background: #ffffff;
        color: #1e293b;
        border-radius: 16px;
        padding: 36px 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        max-width: 1050px;
        margin: 0 auto 40px;
        border: 1px solid #cbd5e1;
        font-size: 13px;
        line-height: 1.5;
    }

    .inv-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #0f172a;
        padding-bottom: 16px;
        margin-bottom: 14px;
    }
    .inv-logo-text h2 {
        font-size: 19px;
        font-weight: 900;
        color: #0f172a;
        margin: 0 0 2px;
    }
    .inv-logo-text span {
        font-size: 12px;
        color: #64748b;
    }
    .inv-header-center {
        text-align: center;
    }
    .inv-title {
        font-size: 20px;
        font-weight: 900;
        color: #0284c7;
        margin: 0 0 4px;
    }
    .inv-subtitle {
        font-size: 11.5px;
        color: #64748b;
    }
    .inv-header-left {
        font-size: 12px;
        text-align: left;
        line-height: 1.7;
    }
    .inv-meta-row strong {
        font-family: monospace;
        color: #0f172a;
    }

    .inv-box {
        border: 1px solid #94a3b8;
        border-radius: 8px;
        padding: 10px 14px;
        position: relative;
    }
    .inv-box-title {
        position: absolute;
        top: -10px;
        right: 14px;
        background: #fff;
        padding: 0 8px;
        font-weight: 800;
        font-size: 12px;
        color: #0284c7;
    }
    .inv-grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }
    .inv-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }
    .inv-box span { color: #64748b; font-size: 11.5px; }
    .inv-box strong { color: #0f172a; font-size: 12.5px; }

    /* Table */
    .inv-table-wrap {
        border: 1px solid #94a3b8;
        border-radius: 8px;
        overflow: hidden;
    }
    .inv-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }
    .inv-table th {
        background: #f1f5f9;
        color: #0f172a;
        padding: 8px;
        font-weight: 800;
        border: 1px solid #cbd5e1;
        text-align: center;
    }
    .inv-table td {
        padding: 8px;
        border: 1px solid #cbd5e1;
        color: #1e293b;
        vertical-align: middle;
    }

    .inv-summary-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 14px;
        margin-top: 10px;
    }
    .inv-notes {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 14px;
    }
    .inv-totals-table {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 14px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .inv-total-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
    }
    .inv-total-row.final-row {
        border-top: 1px solid #cbd5e1;
        padding-top: 6px;
        font-weight: 800;
    }

    .inv-signatures-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 14px;
    }
    .sign-box {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
    }
    .sign-title { font-weight: 700; font-size: 11.5px; color: #475569; }
    .sign-space { height: 60px; }
    .digital-stamp {
        border: 2px dashed #0284c7;
        color: #0284c7;
        border-radius: 50%;
        width: 75px;
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 10px;
        font-weight: 800;
        line-height: 1.3;
        transform: rotate(-10deg);
        background: rgba(2, 132, 199, 0.04);
    }

    @media print {
        body { background: #fff !important; }
        .site-header, .site-footer, .top-notice-bar, .page-header-card { display: none !important; }
        .invoice-paper { box-shadow: none !important; border: none !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }
    }

    @media (max-width: 800px) {
        .inv-grid-4, .inv-grid-3, .inv-summary-grid, .inv-signatures-row {
            grid-template-columns: 1fr;
        }
        .inv-header {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        .inv-header-left {
            text-align: center;
        }
        .invoice-paper {
            padding: 20px 14px;
            overflow-x: auto;
        }
    }
</style>
@endpush
