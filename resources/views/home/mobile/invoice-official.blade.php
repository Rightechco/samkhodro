@extends('home.mobile.layout')

@section('title', 'صورتحساب رسمی فروش کالا و خدمات (ماده ۱۶) | تامین کانی سام (موبایل)')
@section('meta_description', 'صورتحساب رسمی فروش کالا و خدمات شرکت تامین کانی سام مطابق با ماده ۱۶ ضوابط اجرایی خدمات پس از فروش و نرخ مصوب اتحادیه دستگاه‌های مخابراتی سال ۱۴۰۵')

@section('content')
<div class="invoice-page-container">

    <!-- Action Toolbar (Hidden in Print) -->
    <div class="invoice-toolbar no-print">
        <div class="toolbar-inner">
            <div class="toolbar-info">
                <span class="badge-status {{ $invData['is_under_warranty'] ? 'badge-warranty' : 'badge-tariff' }}">
                    {{ $invData['is_under_warranty'] ? '🛡️ مشمول گارانتی ۱۸ ماهه رسمی' : '⚖️ مطابق با نرخ تعرفه خدمات غیر گارانتی سال ۱۴۰۵' }}
                </span>
                <h2 style="font-size: 1.15rem; font-weight: 900; margin: 4px 0 0; color: #0f172a;">
                    صورتحساب رسمی پرونده: <span style="color: #2563eb; font-family: monospace;">{{ $invData['tracking_code'] }}</span>
                </h2>
            </div>
            <div class="toolbar-actions">
                <button type="button" class="btn-action print-btn" onclick="window.print()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                    <span>چاپ صورتحساب رسمی (A4) / PDF</span>
                </button>
                <a href="{{ url('/survey') }}?tracking_code={{ $invData['tracking_code'] }}" target="_blank" class="btn-action survey-btn" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <span>ثبت نظرسنجی و امتیاز</span>
                </a>
                <a href="{{ url('/complaints') }}?tracking_code={{ $invData['tracking_code'] }}" target="_blank" class="btn-action complaint-btn" style="background: #ffe4e6; color: #9f1239; border: 1px solid #fecdd3;">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span>ثبت شکایت / مغایرت</span>
                </a>
                <a href="{{ url('/tariff') }}" target="_blank" class="btn-action tariff-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                    <span>نرخ تعرفه اتحادیه</span>
                </a>
                <a href="{{ url('/user-portal') }}?tab=my-invoices" class="btn-action back-btn">
                    <span>بازگشت به پنل</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Official Invoice A4 Sheet -->
    <div class="invoice-sheet" id="officialInvoiceSheet">

        <!-- Top Header -->
        <div class="inv-header">
            <div class="inv-header-right">
                <div class="inv-logo-box">
                    <div class="logo-symbol">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <h1 class="inv-company-name">شرکت تامین کانی سام</h1>
                        <span class="inv-company-sub">واحد خدمات پس از فروش و گارانتی رسمی تامین کانی سام (موبایل)</span>
                    </div>
                </div>
            </div>

            <div class="inv-header-center">
                <h2 class="inv-main-title">صورتحساب فروش کالا و خدمات</h2>
                <div class="inv-law-badge">موضوع ماده ۱۶ ضوابط اجرایی خدمات پس از فروش و نرخ مصوب اتحادیه</div>
                <div class="inv-doc-type">نسخه رسمی مشتری و حسابداری</div>
            </div>

            <div class="inv-header-left">
                <div class="meta-row"><span>شماره سریال صورتحساب:</span> <strong>{{ $invData['invoice_number'] }}</strong></div>
                <div class="meta-row"><span>تاریخ صدور:</span> <strong>{{ $invData['invoice_date_fa'] }}</strong></div>
                <div class="meta-row"><span>شناسه یکتای مالیاتی:</span> <strong style="font-family: monospace; letter-spacing: 1px;">{{ $invData['tax_id'] }}</strong></div>
                <div class="meta-row"><span>کد رهگیری سامانه:</span> <strong style="color: #2563eb; font-family: monospace;">{{ $invData['tracking_code'] }}</strong></div>
            </div>
        </div>

        <!-- Section 1: Seller Info -->
        <div class="inv-box seller-box">
            <div class="inv-box-title">مشخصات فروشنده / ارائه‌دهنده خدمت</div>
            <div class="inv-grid-4">
                <div><span>نام شخص حقوقی:</span> <strong>شرکت تامین کانی سام (سهامی خاص)</strong></div>
                <div><span>شناسه ملی:</span> <strong>۱۴۰۰۹۲۱۷۰۰۹</strong></div>
                <div><span>شماره اقتصادی:</span> <strong>۴۱۱۶۸۹۸۲۱۵۴۲</strong></div>
                <div><span>شماره ثبت:</span> <strong>۵۸۹۸۲۱</strong></div>
            </div>
            <div class="inv-grid-3" style="margin-top: 5px;">
                <div><span>استان و شهرستان:</span> <strong>آذربایجان شرقی - تبریز</strong></div>
                <div><span>کد پستی ۱۰ رقمی:</span> <strong>۵۱۵۷۹۷۴۷۱۱</strong></div>
                <div><span>تلفن تماس:</span> <strong>۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱) / ۰۲۱-۹۱۰۷۱۰۱</strong></div>
            </div>
            <div class="inv-address-line" style="margin-top: 5px;">
                <span>نشانی اقامتگاه قانونی:</span> <strong>تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</strong>
            </div>
        </div>

        <!-- Section 2: Buyer Info -->
        <div class="inv-box buyer-box">
            <div class="inv-box-title">مشخصات خریدار / متقاضی خدمت</div>
            <div class="inv-grid-4">
                <div><span>نام خریدار / متقاضی:</span> <strong>{{ $invData['customer_name'] }}</strong></div>
                <div><span>شماره ملی / شناسه ملی:</span> <strong>{{ $invData['customer_national_code'] }}</strong></div>
                <div><span>شماره تلفن همراه:</span> <strong style="direction: ltr; display: inline-block;">{{ $invData['customer_phone'] }}</strong></div>
                <div><span>کد پستی ۱۰ رقمی:</span> <strong>{{ $invData['customer_postal_code'] }}</strong></div>
            </div>
            <div class="inv-grid-3" style="margin-top: 5px;">
                <div><span>استان و شهرستان:</span> <strong>{{ $invData['customer_province'] }} - {{ $invData['customer_city'] }}</strong></div>
                <div><span>مدل دقیق دستگاه:</span> <strong>{{ $invData['device_brand'] }} {{ $invData['device_model'] }}</strong></div>
                <div><span>شناسه بین‌المللی IMEI:</span> <strong style="font-family: monospace; letter-spacing: 1px;">{{ $invData['imei'] }}</strong></div>
            </div>
            <div class="inv-address-line" style="margin-top: 5px;">
                <span>نشانی محل استقرار / تحویل:</span> <strong>{{ $invData['customer_address'] }}</strong>
            </div>
        </div>

        <!-- Section 3: Items Table -->
        <div class="inv-table-wrap">
            <table class="inv-table">
                <thead>
                    <tr>
                        <th style="width: 32px; text-align: center;">ردیف</th>
                        <th style="width: 85px;">کد کالا/خدمت</th>
                        <th>شرح کالا یا خدمت ارائه‌شده</th>
                        <th style="width: 45px; text-align: center;">تعداد</th>
                        <th style="width: 50px; text-align: center;">واحد</th>
                        <th style="width: 105px; text-align: left;">مبلغ واحد (ریال)</th>
                        <th style="width: 115px; text-align: left;">مبلغ کل (ریال)</th>
                        <th style="width: 95px; text-align: left;">تخفیف (ریال)</th>
                        <th style="width: 95px; text-align: left;">مالیات و عوارض</th>
                        <th style="width: 120px; text-align: left;">مبلغ نهایی (ریال)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invData['items'] as $index => $item)
                        <tr>
                            <td style="text-align: center; font-weight: 700;">{{ $index + 1 }}</td>
                            <td style="font-family: monospace; font-size: 0.76rem; color: #475569;">{{ $item['code'] }}</td>
                            <td>
                                <div style="font-weight: 800; color: #0f172a;">{{ $item['title'] }}</div>
                                @if(!empty($item['description']))
                                    <div style="font-size: 0.72rem; color: #64748b; margin-top: 2px;">{{ $item['description'] }}</div>
                                @endif
                            </td>
                            <td style="text-align: center; font-weight: 700;">{{ $item['qty'] }}</td>
                            <td style="text-align: center; font-size: 0.78rem;">{{ $item['unit'] }}</td>
                            <td style="text-align: left; font-family: monospace;">{{ number_format($item['unit_price']) }}</td>
                            <td style="text-align: left; font-family: monospace; font-weight: 700;">{{ number_format($item['total_price']) }}</td>
                            <td style="text-align: left; font-family: monospace; color: #b91c1c;">{{ number_format($item['discount']) }}</td>
                            <td style="text-align: left; font-family: monospace;">{{ number_format($item['vat']) }}</td>
                            <td style="text-align: left; font-family: monospace; font-weight: 800; color: #0f172a;">{{ number_format($item['final_price']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="inv-table-subtotal-row">
                        <td colspan="6" style="text-align: right; font-weight: 800;">جمع کل ارقام جدول:</td>
                        <td style="text-align: left; font-family: monospace; font-weight: 800;">{{ number_format($invData['sum_total_price']) }}</td>
                        <td style="text-align: left; font-family: monospace; font-weight: 800; color: #b91c1c;">{{ number_format($invData['total_discount']) }}</td>
                        <td style="text-align: left; font-family: monospace; font-weight: 800;">{{ number_format($invData['vat_amount']) }}</td>
                        <td style="text-align: left; font-family: monospace; font-weight: 900; color: #2563eb;">{{ number_format($invData['final_payable']) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Section 4 & 5: Summary and Settlement -->
        <div class="inv-summary-container">
            <div class="inv-notes-box">
                <div class="box-title">توضیحات و ضمانت رسمی خدمات پس از فروش:</div>
                <ul class="inv-terms-list">
                    <li><strong>ضمانت ۶ ماهه:</strong> کلیه قطعات تعویض شده و خدمات فنی انجام‌شده فوق مطابق با تبصره ۵ ماده ۹ و ماده ۱۶ ضوابط اجرایی خدمات پس از فروش دارای ۶ ماه گارانتی تعویض کتبی تامین کانی سام (موبایل) می‌باشد.</li>
                    <li><strong>تحویل داغی:</strong> داغی قطعه مستهلک تعویض شده به مشتری محترم تحویل داده شد.</li>
                    <li><strong>تست کنترل کیفی (QC):</strong> دستگاه در حضور کارشناس با آزمون‌های استاندارد ۵ گانه سلامت سنجیده شد و با کارکرد ۱۰۰٪ تحویل گردید.</li>
                    <li><strong>شفافیت تعرفه:</strong> این صورتحساب دقیقاً مطابق با نرخ تعرفه خدمات غیر گارانتی مصوب سال ۱۴۰۵ کارگروه نرخ‌گذاری اتحادیه دستگاه‌های مخابراتی تهران تنظیم گردیده است.</li>
                </ul>

                <div class="payment-type-row">
                    <span style="font-weight: 800; margin-left: 12px;">شرایط و نحوه فروش:</span>
                    <label class="check-item"><input type="checkbox" checked disabled> <span>نقدی / پرداخت الکترونیک برخط</span></label>
                    <label class="check-item" style="margin-right: 20px;"><input type="checkbox" disabled> <span>غیرنقدی / اعتباری</span></label>
                </div>
            </div>

            <div class="inv-totals-box">
                <div class="total-line">
                    <span>جمع کل ناخالص:</span>
                    <strong>{{ number_format($invData['gross_total']) }} ریال</strong>
                </div>
                <div class="total-line discount-line">
                    <span>مجموع کسورات و تخفیف‌ها:</span>
                    <strong>{{ number_format($invData['total_discount']) }} ریال</strong>
                </div>
                <div class="total-line">
                    <span>مالیات و عوارض ارزش افزوده (۱۰٪):</span>
                    <strong>{{ number_format($invData['vat_amount']) }} ریال</strong>
                </div>
                <div class="total-line grand-line">
                    <span>مبلغ کل قابل پرداخت:</span>
                    <strong>{{ number_format($invData['final_payable']) }} ریال</strong>
                </div>
                <div class="words-line">
                    <span>مبلغ به حروف:</span>
                    <strong>{{ $invData['payable_words'] }}</strong>
                </div>

                @if($invData['is_under_warranty'])
                    <div class="warranty-free-stamp">
                        🛡️ تحت پوشش ۱۰۰٪ گارانتی ۱۸ ماهه رسمی سام سرویس - هزینه پرداختی مشتری: صفر ریال
                    </div>
                @endif
            </div>
        </div>

        <!-- Section: Customer Care & Complaint Channels (Articles 14 & 38) -->
        <div class="inv-feedback-card no-print">
            <div class="feedback-card-inner">
                <div class="feedback-card-text">
                    <div class="feedback-card-title">
                        <span>⚖️ سامانه تکریم ارباب‌رجوع و رسیدگی به شکایات مشتریان (مواد ۱۴ و ۳۸ ضوابط اجرایی):</span>
                    </div>
                    <div class="feedback-card-desc">
                        چنانچه در خصوص کیفیت خدمات، قطعات تعویضی، رفتار پرسنل یا مبالغ صورتحساب، نظر، پیشنهاد یا اعتراضی دارید، از طریق پیوندهای زیر ثبت فرمایید. اطلاعات پرونده <strong>{{ $invData['tracking_code'] }}</strong> به طور خودکار واکشی می‌شود.
                    </div>
                </div>
                <div class="feedback-card-actions">
                    <a href="{{ url('/survey') }}?tracking_code={{ $invData['tracking_code'] }}" target="_blank" class="btn-sheet-survey">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <span>ثبت نظرسنجی و امتیاز به خدمت</span>
                    </a>
                    <a href="{{ url('/complaints') }}?tracking_code={{ $invData['tracking_code'] }}" target="_blank" class="btn-sheet-complaint">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>ثبت شکایت / مغایرت در صورتحساب</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section 6: Official Signatures, Stamp & QR -->
        <div class="inv-footer-signatures">
            <div class="sign-column">
                <div class="sign-label">مهر و امضای کارشناس فنی پذیرش:</div>
                <div class="sign-placeholder">
                    <div class="tech-sign-name">{{ $invData['assigned_technician'] }}</div>
                </div>
            </div>

            <div class="sign-column center-stamp">
                <div class="sign-label">مهر دیجیتال رسمی شرکت:</div>
                <div class="official-seal">
                    <div class="seal-inner">
                        <div class="seal-header">شرکت تامین کانی سام</div>
                        <div class="seal-badge">گارانتی و خدمات پس از فروش</div>
                        <div class="seal-number">شماره ثبت: ۵۸۹۸۲۱</div>
                        <div class="seal-status">✓ تایید رسمی حسابداری</div>
                    </div>
                </div>
            </div>

            <div class="sign-column">
                <div class="sign-label">مهر و امضای خریدار / متقاضی:</div>
                <div class="sign-placeholder">
                    <div class="cust-sign-notice">کالا و خدمت با سلامت کامل دریافت گردید</div>
                </div>
            </div>

            <div class="sign-column qr-column">
                <div class="qr-box">
                    <div class="qr-dummy">
                        <!-- Standard Verification Barcode & QR representation -->
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#0f172a" stroke-width="1.8"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/><rect x="18" y="14" width="3" height="3"/><rect x="14" y="18" width="3" height="3"/><rect x="18" y="18" width="3" height="3"/></svg>
                    </div>
                    <span style="font-size: 0.68rem; color: #64748b; font-family: monospace;">استعلام اصالت سند</span>
                </div>
            </div>
        </div>

        <!-- Bottom Official Notice -->
        <div class="inv-bottom-legal">
            <div>نشانی پرتال استعلام رسمی: <strong>https://mob.taminkanisam.co.ir/invoice/{{ $invData['tracking_code'] }}</strong></div>
            <div>صدور مطابق با ماده ۱۳ و ماده ۱۶ ضوابط اجرایی حمایت از حقوق مصرف‌کنندگان تلفن همراه</div>
        </div>

    </div>

</div>

@push('styles')
<style>
    /* Page Layout */
    .invoice-page-container {
        max-width: 1050px;
        margin: 0 auto;
        padding: 24px 16px 80px;
        font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Action Toolbar */
    .invoice-toolbar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 18px 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
    }
    .toolbar-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }
    .badge-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 0.78rem;
        font-weight: 800;
    }
    .badge-warranty {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .badge-tariff {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .toolbar-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.85rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
    }
    .print-btn {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }
    .print-btn:hover { background: #1d4ed8; }
    .tariff-btn {
        background: #f8fafc;
        color: #334155;
        border: 1px solid #cbd5e1;
    }
    .tariff-btn:hover { background: #f1f5f9; }
    .back-btn {
        background: #ffffff;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    /* Official A4 Invoice Sheet */
    .invoice-sheet {
        background: #ffffff;
        border: 2px solid #0f172a;
        border-radius: 8px;
        padding: 26px 30px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
        color: #0f172a;
        line-height: 1.5;
    }

    /* Header */
    .inv-header {
        display: grid;
        grid-template-columns: 1fr 1.3fr 1fr;
        align-items: center;
        border-bottom: 2px solid #0f172a;
        padding-bottom: 14px;
        margin-bottom: 12px;
        gap: 12px;
    }
    .inv-logo-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .inv-company-name {
        font-size: 1.15rem;
        font-weight: 900;
        margin: 0;
        color: #0f172a;
    }
    .inv-company-sub {
        font-size: 0.74rem;
        color: #64748b;
        display: block;
        margin-top: 2px;
    }
    .inv-header-center {
        text-align: center;
    }
    .inv-main-title {
        font-size: 1.35rem;
        font-weight: 900;
        color: #0284c7;
        margin: 0 0 4px;
    }
    .inv-law-badge {
        font-size: 0.74rem;
        color: #334155;
        font-weight: 700;
    }
    .inv-doc-type {
        font-size: 0.68rem;
        color: #64748b;
        margin-top: 2px;
    }
    .inv-header-left {
        text-align: left;
    }
    .meta-row {
        font-size: 0.76rem;
        color: #334155;
        display: flex;
        justify-content: flex-end;
        gap: 6px;
        margin-bottom: 2px;
    }

    /* Boxes */
    .inv-box {
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 8px 12px;
        margin-bottom: 8px;
        font-size: 0.78rem;
        background: #ffffff;
    }
    .inv-box-title {
        font-weight: 900;
        color: #0f172a;
        font-size: 0.82rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 4px;
        margin-bottom: 6px;
    }
    .inv-grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 6px;
    }
    .inv-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
    }
    .inv-address-line {
        font-size: 0.78rem;
        color: #334155;
    }

    /* Items Table */
    .inv-table-wrap {
        margin-bottom: 10px;
        overflow-x: auto;
    }
    .inv-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.78rem;
        border: 1px solid #cbd5e1;
    }
    .inv-table th {
        background: #f1f5f9;
        color: #0f172a;
        font-weight: 900;
        border: 1px solid #cbd5e1;
        padding: 7px 6px;
        text-align: right;
    }
    .inv-table td {
        border: 1px solid #cbd5e1;
        padding: 7px 6px;
        color: #1e293b;
    }
    .inv-table-subtotal-row td {
        background: #f8fafc;
        border-top: 2px solid #94a3b8;
        padding: 8px 6px;
    }

    /* Summary & Settlement */
    .inv-summary-container {
        display: grid;
        grid-template-columns: 1.35fr 1fr;
        gap: 10px;
        margin-bottom: 12px;
    }
    .inv-notes-box {
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 0.76rem;
    }
    .box-title {
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }
    .inv-terms-list {
        padding-right: 18px;
        margin: 0 0 10px;
        line-height: 1.7;
        color: #334155;
    }
    .payment-type-row {
        display: flex;
        align-items: center;
        border-top: 1px solid #f1f5f9;
        padding-top: 8px;
        font-size: 0.78rem;
    }
    .check-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-weight: 700;
    }
    .inv-totals-box {
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 10px 14px;
        background: #fafafa;
    }
    .total-line {
        display: flex;
        justify-content: space-between;
        font-size: 0.80rem;
        padding: 4px 0;
        color: #334155;
    }
    .discount-line {
        color: #b91c1c;
    }
    .grand-line {
        font-size: 0.98rem;
        font-weight: 900;
        color: #0284c7;
        border-top: 2px solid #cbd5e1;
        padding-top: 8px;
        margin-top: 6px;
    }
    .words-line {
        font-size: 0.78rem;
        color: #0369a1;
        font-weight: 800;
        margin-top: 6px;
        text-align: left;
        line-height: 1.4;
    }
    .warranty-free-stamp {
        margin-top: 8px;
        padding: 6px 10px;
        background: #ecfdf5;
        border: 1px dashed #10b981;
        color: #047857;
        font-size: 0.75rem;
        font-weight: 800;
        border-radius: 6px;
        text-align: center;
    }

    /* Signatures & Seal */
    .inv-footer-signatures {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 80px;
        gap: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 12px;
        align-items: center;
    }
    .sign-column {
        text-align: center;
    }
    .sign-label {
        font-size: 0.76rem;
        font-weight: 800;
        color: #334155;
        margin-bottom: 8px;
    }
    .sign-placeholder {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tech-sign-name {
        font-size: 0.82rem;
        font-weight: 700;
        color: #1e3a8a;
    }
    .cust-sign-notice {
        font-size: 0.72rem;
        color: #94a3b8;
    }
    .official-seal {
        display: inline-block;
        border: 2px solid #2563eb;
        border-radius: 12px;
        padding: 4px 10px;
        background: rgba(37, 99, 235, 0.04);
        transform: rotate(-2deg);
    }
    .seal-inner {
        text-align: center;
        line-height: 1.3;
    }
    .seal-header {
        font-weight: 900;
        font-size: 0.74rem;
        color: #1e40af;
    }
    .seal-badge {
        font-size: 0.68rem;
        color: #2563eb;
        font-weight: 700;
    }
    .seal-number {
        font-size: 0.62rem;
        color: #64748b;
    }
    .seal-status {
        font-size: 0.66rem;
        font-weight: 800;
        color: #059669;
        margin-top: 2px;
    }
    .qr-column {
        text-align: center;
    }
    .qr-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
    }

    /* In-Sheet Feedback & Complaints Banner */
    .inv-feedback-card {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 12px;
    }
    .feedback-card-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .feedback-card-title {
        font-weight: 800;
        font-size: 0.82rem;
        color: #0f172a;
        margin-bottom: 3px;
    }
    .feedback-card-desc {
        font-size: 0.74rem;
        color: #475569;
        line-height: 1.6;
        max-width: 620px;
    }
    .feedback-card-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .btn-sheet-survey {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        border-radius: 8px;
        font-weight: 800;
        font-size: 0.78rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-sheet-survey:hover { background: #fde68a; }
    .btn-sheet-complaint {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: #ffe4e6;
        color: #9f1239;
        border: 1px solid #fecdd3;
        border-radius: 8px;
        font-weight: 800;
        font-size: 0.78rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-sheet-complaint:hover { background: #fecdd3; }

    /* Legal Footer */
    .inv-bottom-legal {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px dotted #cbd5e1;
        font-size: 0.68rem;
        color: #64748b;
    }

    /* ========================================================
       PRINT MEDIA QUERY (Exact Clean A4 Sheet)
       ======================================================== */
    @media print {
        @page {
            size: A4 portrait;
            margin: 10mm 10mm 10mm 10mm;
        }
        body {
            background: #ffffff !important;
            color: #000000 !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 11pt !important;
        }
        .no-print,
        .site-header,
        .site-footer,
        .native-bottom-bar,
        .mobile-drawer-overlay,
        .mobile-drawer {
            display: none !important;
        }
        .invoice-page-container {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .invoice-sheet {
            box-shadow: none !important;
            border: 2px solid #000000 !important;
            border-radius: 0 !important;
            padding: 12px 16px !important;
            width: 100% !important;
        }
        .inv-table th {
            background: #f1f5f9 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    @media (max-width: 768px) {
        .inv-header {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .inv-header-left {
            text-align: center;
        }
        .meta-row {
            justify-content: center;
        }
        .inv-grid-4, .inv-grid-3 {
            grid-template-columns: 1fr;
        }
        .inv-summary-container {
            grid-template-columns: 1fr;
        }
        .inv-footer-signatures {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
@endsection
