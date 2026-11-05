@extends('home.mobile.layout')

@section('title', 'سام موبایل | خدمات پس از فروش و گارانتی رسمی ۱۸ ماهه تامین کانی سام')
@section('meta_description', 'سامانه رسمی خدمات پس از فروش، گارانتی ۱۸ ماهه تلفن همراه و تبلت شرکت تامین کانی سام (سام موبایل). استعلام اصالت، رهگیری آنلاین تعمیرات، منشور حقوق مشتریان و ثبت خدمت مطابق ماده ۱۳ وزارت صمت.')

@push('styles')
<style>
    /* ========================================================
       HERO SECTION - LIGHT & AIRY
       ======================================================== */
    .hero-section {
        position: relative;
        padding: 56px 20px 48px;
        background: radial-gradient(circle at 50% 10%, #eff6ff 0%, #f8fafc 100%);
        border-bottom: 1px solid var(--border-light);
        overflow: hidden;
    }
    .hero-inner {
        max-width: 1100px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 2;
    }
    .hero-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        border: 1px solid var(--border-primary);
        padding: 6px 18px;
        border-radius: var(--radius-pill);
        font-size: 0.86rem;
        font-weight: 700;
        color: var(--primary);
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.08);
        margin-bottom: 20px;
    }
    .hero-main-title {
        font-size: 2.45rem;
        font-weight: 900;
        color: var(--text-main);
        letter-spacing: -0.025em;
        line-height: 1.35;
        margin-bottom: 16px;
    }
    .hero-main-title span {
        color: var(--primary);
    }
    .hero-lead-text {
        font-size: 1.08rem;
        color: var(--text-body);
        max-width: 780px;
        margin: 0 auto 36px;
        line-height: 1.85;
    }

    /* ========================================================
       CENTRAL INTERACTIVE INQUIRY BOX (IMEI & REPAIR LOOKUP)
       ======================================================== */
    .inquiry-card-container {
        max-width: 820px;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 24px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        text-align: right;
    }
    .inquiry-tabs-header {
        display: flex;
        background: var(--bg-subtle);
        border-bottom: 1px solid var(--border-light);
    }
    .inquiry-tab-btn {
        flex: 1;
        padding: 16px 20px;
        font-weight: 700;
        font-size: 0.96rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s ease;
        border-bottom: 3px solid transparent;
        background: transparent;
    }
    .inquiry-tab-btn:hover {
        color: var(--primary);
    }
    .inquiry-tab-btn.active {
        color: var(--primary);
        background: #ffffff;
        border-bottom-color: var(--primary);
    }
    .inquiry-tab-pane {
        display: none;
        padding: 32px 30px;
    }
    .inquiry-tab-pane.active {
        display: block;
    }
    
    .inquiry-form-group {
        display: flex;
        gap: 12px;
        margin-bottom: 14px;
    }
    .inquiry-input-wrap {
        position: relative;
        flex: 1;
    }
    .inquiry-input-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-dim);
    }
    .inquiry-text-input {
        width: 100%;
        height: 52px;
        padding: 0 46px 0 16px;
        background: #ffffff;
        border: 1.5px solid var(--border-light);
        border-radius: var(--radius-md);
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        transition: all 0.2s ease;
        direction: ltr;
        text-align: right;
    }
    .inquiry-text-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-light);
        outline: none;
    }
    .inquiry-submit-btn {
        height: 52px;
        padding: 0 28px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 0.96rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        transition: all 0.25s ease;
        flex-shrink: 0;
    }
    .inquiry-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }
    .inquiry-helper-text {
        font-size: 0.84rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
        line-height: 1.6;
    }
    .inquiry-code-tag {
        font-family: monospace !important;
        background: var(--bg-subtle);
        border: 1px solid var(--border-light);
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 700;
        color: var(--primary);
        direction: ltr;
        display: inline-block;
    }

    /* Results Card */
    .inquiry-result-box {
        margin-top: 24px;
        padding: 22px;
        border-radius: var(--radius-md);
        background: var(--bg-subtle);
        border: 1px solid var(--border-light);
        display: none;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .result-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 14px;
    }
    .result-grid-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 10px;
    }
    .result-info-item {
        background: #ffffff;
        border: 1px solid var(--border-light);
        padding: 12px 14px;
        border-radius: var(--radius-sm);
    }
    .result-info-label {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 4px;
    }
    .result-info-value {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--text-main);
    }

    /* Timeline Stepper for Repairs */
    .stepper-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        position: relative;
    }
    .stepper-timeline::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 30px;
        right: 30px;
        height: 3px;
        background: var(--border-light);
        z-index: 1;
    }
    .stepper-step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-align: center;
        flex: 1;
    }
    .stepper-step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid var(--border-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--text-muted);
        transition: all 0.2s ease;
    }
    .stepper-step.completed .stepper-step-circle {
        background: var(--accent-emerald);
        border-color: var(--accent-emerald);
        color: #ffffff;
    }
    .stepper-step.current .stepper-step-circle {
        background: var(--primary);
        border-color: var(--primary);
        color: #ffffff;
        box-shadow: 0 0 0 4px var(--primary-light);
    }
    .stepper-step-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-main);
    }
    .stepper-step-desc {
        font-size: 0.7rem;
        color: var(--text-muted);
    }

    /* ========================================================
       SECTIONS
       ======================================================== */
    .content-section {
        padding: 64px 20px;
    }
    .content-section.section-alt {
        background: #ffffff;
        border-top: 1px solid var(--border-light);
        border-bottom: 1px solid var(--border-light);
    }
    .section-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    /* 6 Warranty Pillars Grid */
    .warranty-features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .warranty-feat-card {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        padding: 28px 24px;
        transition: all 0.25s ease;
        position: relative;
        box-shadow: var(--shadow-sm);
    }
    .warranty-feat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--border-primary);
    }
    .warranty-feat-icon-box {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.4rem;
    }
    .warranty-feat-title {
        font-size: 1.12rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 10px;
    }
    .warranty-feat-desc {
        font-size: 0.88rem;
        color: var(--text-body);
        line-height: 1.8;
    }

    /* Service Workflow 5 Steps */
    .workflow-steps-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
    }
    .workflow-step-card {
        background: var(--bg-card);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        padding: 24px 18px;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
    }
    .workflow-step-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }
    .workflow-step-num {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        font-weight: 800;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .workflow-step-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .workflow-step-text {
        font-size: 0.8rem;
        color: var(--text-muted);
        line-height: 1.65;
    }

    /* Article 13 ERP Banner */
    .erp-banner-card {
        background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
        border-radius: 24px;
        padding: 44px 40px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
        box-shadow: 0 16px 36px -8px rgba(30, 58, 138, 0.4);
    }
    .erp-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        padding: 5px 14px;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 14px;
    }
    .erp-title {
        font-size: 1.7rem;
        font-weight: 900;
        line-height: 1.4;
        margin-bottom: 12px;
    }
    .erp-desc {
        font-size: 0.95rem;
        opacity: 0.9;
        line-height: 1.8;
        max-width: 650px;
    }
    .erp-btn {
        background: #ffffff;
        color: #1e3a8a !important;
        padding: 13px 28px;
        border-radius: var(--radius-md);
        font-weight: 800;
        font-size: 0.96rem;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.25s ease;
        flex-shrink: 0;
    }
    .erp-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 26px rgba(0, 0, 0, 0.25);
    }

    /* Hamta Quick Guide 4 Steps */
    .hamta-box-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    .hamta-step-item {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        padding: 20px 18px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }
    .hamta-step-badge {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        background: var(--primary-light);
        color: var(--primary);
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Rights & Void Split */
    .rights-void-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }
    .clean-list-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 14px;
        font-size: 0.88rem;
        color: var(--text-body);
        line-height: 1.7;
    }

    @media (max-width: 991px) {
        .hero-main-title { font-size: 1.85rem; }
        .inquiry-form-group { flex-direction: column; }
        .warranty-features-grid { grid-template-columns: 1fr; }
        .workflow-steps-grid { grid-template-columns: 1fr 1fr; }
        .erp-banner-card { flex-direction: column; text-align: center; }
        .hamta-box-grid { grid-template-columns: 1fr 1fr; }
        .rights-void-grid { grid-template-columns: 1fr; }
        .result-grid-info { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .workflow-steps-grid { grid-template-columns: 1fr; }
        .hamta-box-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<!-- ========================================================
     HERO SECTION
     ======================================================== -->
<section class="hero-section">
    <div class="hero-inner">
        <div class="hero-badge-pill">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>گارانتی معتبر ۱۸ ماهه و خدمات پس از فروش رسمی</span>
        </div>

        <h1 class="hero-main-title">
            سامانه خدمات پس از فروش و گارانتی <span>سام موبایل</span>
        </h1>
        <p class="hero-lead-text">
            وابسته به شرکت <strong>تامین کانی سام</strong> | مجری رسمی ضوابط اجرایی ماده ۱۳ و تبصره ۵ ماده ۲۸ سازمان حمایت از مصرف‌کنندگان و تولیدکنندگان و وزارت صنعت، معدن و تجارت.
        </p>

        <!-- Central Interactive Inquiry Card -->
        <div class="inquiry-card-container" id="inquiry-section">
            <div class="inquiry-tabs-header">
                <button type="button" class="inquiry-tab-btn active" id="tabBtnImei" onclick="switchInquiryTab('imei')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    <span>استعلام اصالت و گارانتی (IMEI)</span>
                </button>
                <button type="button" class="inquiry-tab-btn" id="tabBtnRepair" onclick="switchInquiryTab('repair')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    <span>پیگیری آنلاین وضعیت تعمیرات</span>
                </button>
            </div>

            <!-- Tab 1: IMEI Inquiry -->
            <div class="inquiry-tab-pane active" id="paneImei">
                <form id="imeiSearchForm" onsubmit="handleImeiSearch(event)">
                    <div class="inquiry-form-group">
                        <div class="inquiry-input-wrap">
                            <span class="inquiry-input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </span>
                            <input type="text" id="imeiInput" class="inquiry-text-input" placeholder="شماره سریال یا کد ۱۵ رقمی IMEI را وارد کنید..." maxlength="16" required>
                        </div>
                        <button type="submit" class="inquiry-submit-btn" id="imeiSubmitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            <span>استعلام گارانتی</span>
                        </button>
                    </div>
                </form>
                <div class="inquiry-helper-text">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>برای دریافت کد ۱۵ رقمی IMEI دستگاه خود، کد دستوری <span class="inquiry-code-tag">*#06#</span> را در شماره‌گیر تلفن همراه شماره‌گیری نمایید.</span>
                </div>

                <!-- Result Box for IMEI -->
                <div class="inquiry-result-box" id="imeiResultBox">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <span class="result-status-badge" style="background: var(--accent-emerald-light); color: var(--accent-emerald);">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>گارانتی رسمی فعال است (۱۸ ماهه سام موبایل)</span>
                            </span>
                            <h4 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main);" id="imeiDeviceName">Samsung Galaxy S24 Ultra 5G (256GB)</h4>
                        </div>
                        <span style="font-size: 0.84rem; color: var(--text-muted); font-family: monospace;" id="imeiEchoCode">IMEI: 359123456789012</span>
                    </div>

                    <div class="result-grid-info">
                        <div class="result-info-item">
                            <div class="result-info-label">تاریخ ترخیص و شروع گارانتی</div>
                            <div class="result-info-value" id="imeiStartDate">۱۴۰۳/۰۴/۱۵</div>
                        </div>
                        <div class="result-info-item">
                            <div class="result-info-label">تاریخ پایان دوره ۱۸ ماهه</div>
                            <div class="result-info-value" id="imeiEndDate" style="color: var(--primary);">۱۴۰۴/۱۰/۱۵</div>
                        </div>
                        <div class="result-info-item">
                            <div class="result-info-label">وضعیت اصالت و سامانه همتا</div>
                            <div class="result-info-value" style="color: var(--accent-emerald);">واردات رسمی / قانونی</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Repair Tracking -->
            <div class="inquiry-tab-pane" id="paneRepair">
                <form id="repairSearchForm" onsubmit="handleRepairSearch(event)">
                    <div class="inquiry-form-group">
                        <div class="inquiry-input-wrap">
                            <span class="inquiry-input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                            </span>
                            <input type="text" id="repairInput" class="inquiry-text-input" placeholder="شماره قبض پذیرش (مثال: SAM-1002) یا شماره موبایل..." required>
                        </div>
                        <button type="submit" class="inquiry-submit-btn" id="repairSubmitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <span>پیگیری وضعیت</span>
                        </button>
                    </div>
                </form>
                <div class="inquiry-helper-text">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>کد رهگیری پذیرش در زمان تحویل حضوری یا ثبت در سامانه پیامک شده است.</span>
                </div>

                <!-- Result Box for Repair Tracking -->
                <div class="inquiry-result-box" id="repairResultBox">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 16px;">
                        <div>
                            <span class="result-status-badge" style="background: var(--primary-light); color: var(--primary);" id="repairStatusBadge">
                                در حال تعمیر تخصصی
                            </span>
                            <h4 style="font-size: 1.05rem; font-weight: 800; color: var(--text-main);" id="repairDeviceTitle">Xiaomi 13T Pro (کد پذیرش: SAM-1002)</h4>
                        </div>
                        <span style="font-size: 0.84rem; color: var(--text-muted);" id="repairCustomerName">مشتری: علی اکبری</span>
                    </div>

                    <!-- 5 Steps Stepper -->
                    <div class="stepper-timeline">
                        <div class="stepper-step completed">
                            <div class="stepper-step-circle">✓</div>
                            <div class="stepper-step-title">پذیرش</div>
                            <div class="stepper-step-desc">ثبت دستگاه</div>
                        </div>
                        <div class="stepper-step completed">
                            <div class="stepper-step-circle">✓</div>
                            <div class="stepper-step-title">ارجاع فنی</div>
                            <div class="stepper-step-desc">تخصیص کارشناس</div>
                        </div>
                        <div class="stepper-step current">
                            <div class="stepper-step-circle">۳</div>
                            <div class="stepper-step-title">تعمیر / قطعه</div>
                            <div class="stepper-step-desc">در حال اقدام</div>
                        </div>
                        <div class="stepper-step">
                            <div class="stepper-step-circle">۴</div>
                            <div class="stepper-step-title">کنترل QC</div>
                            <div class="stepper-step-desc">تست کیفیت</div>
                        </div>
                        <div class="stepper-step">
                            <div class="stepper-step-circle">۵</div>
                            <div class="stepper-step-title">تحویل / پست</div>
                            <div class="stepper-step-desc">آماده ترخیص</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================================================
     OFFICIAL WARRANTY CARD SHOWCASE
     ======================================================== -->
<section class="content-section" style="padding: 40px 20px 20px;">
    <div class="section-container">
        <div style="background: linear-gradient(135deg, #0b2b68, #081d45); border-radius: 28px; padding: 40px 36px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 32px; box-shadow: 0 16px 40px rgba(11, 43, 104, 0.35);">
            <div style="flex: 1; min-width: 300px;">
                <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(8px); padding: 4px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; margin-bottom: 14px;">
                    🛡️ ضمانت ۱۸ ماهه معتبر شرکتی
                </div>
                <h3 style="font-size: 1.65rem; font-weight: 900; line-height: 1.4; margin-bottom: 12px;">کارت رسمی گارانتی گوشی همراه تامین کانی سام</h3>
                <p style="font-size: 0.92rem; opacity: 0.9; line-height: 1.8; margin-bottom: 20px;">
                    هر دستگاه وارداتی دارای کارت گارانتی فیزیکی با کد اختصاصی و QR کد فعال‌سازی است. پس از ثبت دستگاه در پنل کاربری، کارت گارانتی دیجیتال با مشخصات کامل دستگاه، تاریخ ترخیص و شناسه IMEI صادر می‌گردد.
                </p>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('mob.login') }}" class="btn-light-primary" style="background: #ffffff; color: #081d45 !important;">
                        <span>ورود به پنل و صدور کارت</span>
                    </a>
                    <a href="{{ url('/warranty-terms') }}" class="btn-light-outline" style="background: transparent; color: #ffffff !important; border-color: rgba(255,255,255,0.3);">
                        <span>شرایط و استعلام گارانتی</span>
                    </a>
                </div>
            </div>
            <div style="max-width: 380px; width: 100%; text-align: center;">
                <img src="/assets/images/mobile/warranty-card.jpg" alt="کارت گارانتی رسمی گوشی همراه تامین کانی سام" style="width: 100%; border-radius: 18px; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.4); border: 2px solid rgba(255, 255, 255, 0.2); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>
    </div>
</section>


<!-- ========================================================
     6 GOLDEN WARRANTY PILLARS (EXACT PDF & MIDIA HAMRAH)
     ======================================================== -->
<section class="content-section">
    <div class="section-container">
        <div class="section-header-block">
            <span class="section-tag-pill">مزایای انحصاری</span>
            <h2 class="section-title-main">مزایای گارانتی سام موبایل (تامین کانی سام)</h2>
            <p class="section-subtitle-lead">
                تمامی خدمات پس از فروش ما مطابق منشور حقوق مصرف‌کنندگان، ضوابط اجرایی ماده ۱۳ و تبصره ۵ ماده ۲۸ وزارت صنعت، معدن و تجارت ارائه می‌گردد.
            </p>
        </div>

        <div class="warranty-features-grid">
            <!-- 1. دستگاه امانی -->
            <div class="warranty-feat-card">
                <div class="warranty-feat-icon-box" style="background: #eff6ff; color: #2563eb;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                </div>
                <h3 class="warranty-feat-title">امکان ارائه دستگاه امانی موقت</h3>
                <p class="warranty-feat-desc">
                    چنانچه زمان انتظار برای بررسی و تعمیر گوشی بیش از <strong>۳ ساعت</strong> به طول بینجامد، بنا به درخواست مشتری یک دستگاه تلفن همراه به صورت امانی تا زمان تکمیل خدمت تحویل می‌گردد.
                </p>
            </div>

            <!-- 2. افزایش دوره گارانتی -->
            <div class="warranty-feat-card">
                <div class="warranty-feat-icon-box" style="background: #ecfdf5; color: #059669;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <h3 class="warranty-feat-title">افزایش دوره گارانتی به ازای تأخیر</h3>
                <p class="warranty-feat-desc">
                    در صورتی که تعمیر دستگاه به علت تاخیر در تامین قطعات بیش از <strong>۱۵ روز کاری</strong> زمان ببرد، روزهای مازاد عیناً به مدت زمان گارانتی گوشی موبایل افزوده خواهد شد.
                </p>
            </div>

            <!-- 3. امکان تعویض دستگاه نو -->
            <div class="warranty-feat-card">
                <div class="warranty-feat-icon-box" style="background: #fffbeb; color: #d97706;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                </div>
                <h3 class="warranty-feat-title">امکان تعویض دستگاه نو یا عودت وجه</h3>
                <p class="warranty-feat-desc">
                    چنانچه پس از کارشناسی فنی مهندسین شرکت، دستگاه غیرقابل تعمیر تشخیص داده شود یا عیب مشخصی برای بار سوم تکرار گردد، شرکت موظف به تعویض دستگاه یا عودت وجه بر اساس فاکتور خرید است.
                </p>
            </div>

            <!-- 4. ضمانت ۶ ماهه تعمیرات -->
            <div class="warranty-feat-card">
                <div class="warranty-feat-icon-box" style="background: #f5f3ff; color: #7c3aed;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="warranty-feat-title">ضمانت ۶ ماهه خدمات و قطعات</h3>
                <p class="warranty-feat-desc">
                    کلیه خدمات فنی ارائه‌شده و قطعات تعویض‌شده در مراکز خدمات سام موبایل تا <strong>۶ ماه</strong> شامل ضمانت کتبی شرکتی می‌باشند (حتی پس از اتمام گارانتی اولیه دستگاه).
                </p>
            </div>

            <!-- 5. ارسال پستی رایگان -->
            <div class="warranty-feat-card">
                <div class="warranty-feat-icon-box" style="background: #e0f2fe; color: #0284c7;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                <h3 class="warranty-feat-title">پست پیشتاز رایگان سراسری</h3>
                <p class="warranty-feat-desc">
                    مشتریان گرامی از تمام ۳۱ استان و کلیه شهرستان‌ها می‌توانند دستگاه خود را از طریق پست پیشتاز با بیمه کامل و به صورت رایگان در بازه گارانتی ارسال نمایند.
                </p>
            </div>

            <!-- 6. تامین قطعات ۵ ساله -->
            <div class="warranty-feat-card">
                <div class="warranty-feat-icon-box" style="background: #fff1f2; color: #e11d48;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
                <h3 class="warranty-feat-title">پشتیبانی و تأمین قطعات تا ۵ سال</h3>
                <p class="warranty-feat-desc">
                    شرکت تامین کانی سام متعهد به تامین قطعات اصلی و ارائه خدمات پس از فروش برای کلیه مدل‌های عرضه شده تا <strong>۵ سال</strong> از تاریخ فروش رسمی می‌باشد.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     ARTICLE 13 ERP PORTAL BANNER
     ======================================================== -->
<section class="content-section" style="padding-top: 0;">
    <div class="section-container">
        <div class="erp-banner-card">
            <div>
                <span class="erp-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>مطابق ماده ۱۳ ضوابط اجرایی وزارت صمت</span>
                </span>
                <h2 class="erp-title">سامانه جامع مدیریت خدمات نمایندگان و کارشناسان</h2>
                <p class="erp-desc">
                    سامانه نرم‌افزاری یکپارچه سام موبایل با قابلیت‌های پنجگانه الزامی: <strong>ثبت پذیرش اولیه، ارجاع هوشمند به تکنسین، ردیابی آنلاین وضعیت، سفارش‌گذاری متمرکز قطعات، و اتمام خدمت با صدور فاکتور رسمی اتحادیه</strong>.
                </p>
            </div>
            <a href="{{ url('/service-portal') }}" class="erp-btn">
                <span>ورود به سامانه خدمات</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ========================================================
     5 STEPS SERVICE WORKFLOW
     ======================================================== -->
<section class="content-section section-alt">
    <div class="section-container">
        <div class="section-header-block">
            <span class="section-tag-pill">فرآیند شفاف</span>
            <h2 class="section-title-main">مراحل گام‌به‌گام دریافت خدمات و ترخیص کالا</h2>
            <p class="section-subtitle-lead">
                آشنایی با گردش کار استاندارد پذیرش تا تحویل کالا در مرکز خدمات سام موبایل
            </p>
        </div>

        <div class="workflow-steps-grid">
            <div class="workflow-step-card">
                <div class="workflow-step-num">۱</div>
                <h4 class="workflow-step-title">پذیرش و تست اولیه</h4>
                <p class="workflow-step-text">تحویل حضوری در شعبه یا ارسال پستی به همراه کپی کارت ملی و شرح دقیق ایراد.</p>
            </div>
            <div class="workflow-step-card">
                <div class="workflow-step-num">۲</div>
                <h4 class="workflow-step-title">ثبت و صدور رسید</h4>
                <p class="workflow-step-text">ثبت در سامانه ماده ۱۳ و صدور قبض رسمی با کد رهگیری منحصر‌به‌فرد.</p>
            </div>
            <div class="workflow-step-card">
                <div class="workflow-step-num">۳</div>
                <h4 class="workflow-step-title">کارشناسی و اعلام هزینه</h4>
                <p class="workflow-step-text">بررسی فنی توسط مهندسین؛ اعلام هزینه مصوب پیش از شروع تعمیر برای موارد غیرگارانتی.</p>
            </div>
            <div class="workflow-step-card">
                <div class="workflow-step-num">۴</div>
                <h4 class="workflow-step-title">تعمیر تخصصی و QC</h4>
                <p class="workflow-step-text">استفاده از قطعات اصلی شرکتی و کنترل کیفیت چندمرحله‌ای قبل از ترخیص.</p>
            </div>
            <div class="workflow-step-card">
                <div class="workflow-step-num">۵</div>
                <h4 class="workflow-step-title">تحویل / ارسال پستی</h4>
                <p class="workflow-step-text">تحویل به مشتری با صدور فاکتور رسمی و گارانتی ۶ ماهه خدمات یا ارسال بیمه‌شده.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     HAMTA ACTIVATION GUIDE
     ======================================================== -->
<section class="content-section">
    <div class="section-container">
        <div class="section-header-block">
            <span class="section-tag-pill">راهنمای رجیستری</span>
            <h2 class="section-title-main">راهنمای فعال‌سازی دستگاه در سامانه همتا (*7777#)</h2>
            <p class="section-subtitle-lead">
                طبق ضوابط کشوری، خریداران محترم باید بلافاصله پس از خرید گوشی، آن را با سیم‌کارت خود فعال‌سازی نمایند.
            </p>
        </div>

        <div class="hamta-box-grid">
            <div class="hamta-step-item">
                <div class="hamta-step-badge">۱</div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">شماره‌گیری کد دستوری</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.6;">شماره‌گیری کد <span class="inquiry-code-tag">*7777#</span> در تلفن همراه و ارسال کلید تماس.</p>
                </div>
            </div>
            <div class="hamta-step-item">
                <div class="hamta-step-badge">۲</div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">انتخاب گزینه فعال‌سازی</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.6;">ارسال عدد ۲ جهت انتخاب گزینه «فعال‌سازی دستگاه نو» در منوی همتا.</p>
                </div>
            </div>
            <div class="hamta-step-item">
                <div class="hamta-step-badge">۳</div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">ثبت شناسه IMEI</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.6;">وارد نمودن کد ۱۵ رقمی شناسه IMEI دستگاه مندرج بر روی جعبه یا کارت گارانتی.</p>
                </div>
            </div>
            <div class="hamta-step-item">
                <div class="hamta-step-badge">۴</div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">کد فعال‌سازی ۶ رقمی</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.6;">ورود کد فعال‌سازی و دریافت پیامک تایید رسمی ثبت در شبکه از سرشماره HAMTA.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     CUSTOMER RIGHTS & IMPORTANT TIPS SPLIT
     ======================================================== -->
<section class="content-section section-alt">
    <div class="section-container">
        <div class="rights-void-grid">
            <!-- Left: Customer Rights Highlights -->
            <div class="light-card" style="padding: 32px 28px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <div style="width: 40px; height: 40px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--text-main);">اصول کلیدی منشور حقوق مشتریان</h3>
                </div>

                <div class="clean-list-item">
                    <span style="color: var(--accent-emerald); font-weight: 800;">✓</span>
                    <span><strong>عدم دریافت وجه:</strong> بابت کلیه نواقص و ایرادات سخت‌افزاری مشمول گارانتی ۱۸ ماهه هیچگونه هزینه‌ای از مشتری دریافت نمی‌شود.</span>
                </div>
                <div class="clean-list-item">
                    <span style="color: var(--accent-emerald); font-weight: 800;">✓</span>
                    <span><strong>تبصره ۵ ماده ۲۸:</strong> چنانچه دستگاه تا ۶ ماه پس از ترخیص فعال نگردد، گارانتی ۱۸ ماهه به صورت خودکار آغاز خواهد شد.</span>
                </div>
                <div class="clean-list-item">
                    <span style="color: var(--accent-emerald); font-weight: 800;">✓</span>
                    <span><strong>اعلام هزینه قبل از اقدام:</strong> حدود هزینه تعمیرات غیرگارانتی باید کتباً یا پیامکی به تایید خریدار برسد.</span>
                </div>
                <div class="clean-list-item">
                    <span style="color: var(--accent-emerald); font-weight: 800;">✓</span>
                    <span><strong>صدور فاکتور رسمی:</strong> ارائه فاکتور معتبر تفکیک‌شده قطعه و دستمزد الزامی است.</span>
                </div>

                <div style="margin-top: 24px;">
                    <a href="{{ url('/customer-rights') }}" class="btn-light-outline" style="width: 100%;">
                        <span>مطالعه کامل منشور حقوق مشتریان</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right: Important Tips Before Sending -->
            <div class="light-card" style="padding: 32px 28px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <div style="width: 40px; height: 40px; border-radius: var(--radius-sm); background: var(--accent-amber-light); color: var(--accent-amber); display: flex; align-items: center; justify-content: center;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--text-main);">نکات ضروری قبل از تحویل یا ارسال دستگاه</h3>
                </div>

                <div class="clean-list-item">
                    <span style="color: var(--accent-amber); font-weight: 800;">!</span>
                    <span><strong>پشتیبان‌گیری (بک‌آپ):</strong> حفظ اطلاعات شخصی بر عهده مشتری است. حتماً قبل از تحویل از اطلاعات خود بک‌آپ بگیرید.</span>
                </div>
                <div class="clean-list-item">
                    <span style="color: var(--accent-amber); font-weight: 800;">!</span>
                    <span><strong>خروج از اکانت‌ها:</strong> کلیه حساب‌های کاربری (Apple ID, Samsung Account, Google Account, Mi Account) باید خارج و قفل صفحه برداشته شود.</span>
                </div>
                <div class="clean-list-item">
                    <span style="color: var(--accent-amber); font-weight: 800;">!</span>
                    <span><strong>عدم ارسال لوازم جانبی:</strong> از ارسال قاب، گلس، سیم‌کارت و کارت حافظه خودداری فرمایید؛ شرکت مسئولیتی در قبال آنها ندارد.</span>
                </div>
                <div class="clean-list-item">
                    <span style="color: var(--accent-amber); font-weight: 800;">!</span>
                    <span><strong>مدارک داخل جعبه:</strong> کپی کارت ملی، شرح ایراد، شماره تماس و فاکتور خرید در کارتن دستگاه قرار داده شود.</span>
                </div>

                <div style="margin-top: 24px;">
                    <a href="{{ url('/shipping-guide') }}" class="btn-light-outline" style="width: 100%;">
                        <span>راهنمای ۱۳ گانه پذیرش و ارسال پستی</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     CONTACT, COMPLAINTS & SURVEY CALLOUT
     ======================================================== -->
<section class="content-section">
    <div class="section-container">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            <!-- Complaints -->
            <div class="light-card" style="padding: 28px; text-align: center;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: var(--accent-rose-light); color: var(--accent-rose); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <h4 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 8px;">سامانه ثبت شکایات</h4>
                <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 18px;">رسیدگی سریع توسط واحد بازرسی و پشتیبانی ظرف حداکثر ۴۸ ساعت کاری با صدور کد پیگیری.</p>
                <a href="{{ url('/complaints') }}" class="btn-light-outline" style="width: 100%;">ثبت شکایت آنلاین</a>
            </div>

            <!-- Survey -->
            <div class="light-card" style="padding: 28px; text-align: center;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: var(--accent-emerald-light); color: var(--accent-emerald); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <h4 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 8px;">نظرسنجی کیفیت خدمات</h4>
                <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 18px;">دیدگاه شما کیفیت خدمات ما را می‌سازد. ارزیابی نحوه پاسخگویی و سرعت تعمیر کارشناسان.</p>
                <a href="{{ url('/survey') }}" class="btn-light-outline" style="width: 100%;">شرکت در نظرسنجی</a>
            </div>

            <!-- Invoice Sample -->
            <div class="light-card" style="padding: 28px; text-align: center;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h4 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 8px;">نمونه فاکتور رسمی اتحادیه</h4>
                <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 18px;">مشاهده نمونه فرمت استاندارد فاکتور گارانتی و غیرگارانتی منطبق بر تعرفه مصوب اتحادیه.</p>
                <a href="{{ url('/invoice-sample') }}" class="btn-light-outline" style="width: 100%;">مشاهده نمونه فاکتور</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function switchInquiryTab(tab) {
        const btnImei = document.getElementById('tabBtnImei');
        const btnRepair = document.getElementById('tabBtnRepair');
        const paneImei = document.getElementById('paneImei');
        const paneRepair = document.getElementById('paneRepair');

        if (tab === 'imei') {
            btnImei.classList.add('active');
            btnRepair.classList.remove('active');
            paneImei.classList.add('active');
            paneRepair.classList.remove('active');
        } else {
            btnRepair.classList.add('active');
            btnImei.classList.remove('active');
            paneRepair.classList.add('active');
            paneImei.classList.remove('active');
        }
    }

    function handleImeiSearch(e) {
        e.preventDefault();
        const input = document.getElementById('imeiInput').value.trim();
        if (!input) return;

        const btn = document.getElementById('imeiSubmitBtn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span>در حال بررسی...</span>';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;

            const box = document.getElementById('imeiResultBox');
            box.style.display = 'block';
            document.getElementById('imeiEchoCode').innerText = 'IMEI: ' + input;

            // Scroll gently to result
            box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 500);
    }

    function handleRepairSearch(e) {
        e.preventDefault();
        const input = document.getElementById('repairInput').value.trim();
        if (!input) return;

        const btn = document.getElementById('repairSubmitBtn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span>در حال جستجو...</span>';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;

            const box = document.getElementById('repairResultBox');
            box.style.display = 'block';
            document.getElementById('repairDeviceTitle').innerText = 'دستگاه رهگیری شده: (کد ' + input + ')';

            // Scroll gently to result
            box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 500);
    }
</script>
@endpush
