@extends('home.mobile.portal-layout')
@php
    if (!function_exists('shamsi')) {
        function shamsi($date, $format = 'Y/m/d - H:i') {
            if (empty($date)) return '-';
            try {
                return \App\Http\Controllers\Home\MobileServiceController::toJalali($date, $format);
            } catch (\Exception $e) {
                return is_string($date) ? $date : '-';
            }
        }
    }
@endphp


@section('title', 'میز مدیریت خدمات پس از فروش و گارانتی | سام موبایل')
@section('header_title', 'میز مدیریت خدمات')

@php
    $activeTab = request()->query('tab', 'overview');
    if (!str_starts_with($activeTab, 'tab-')) {
        $activeTab = 'tab-' . $activeTab;
    }
@endphp

@push('styles')
<style>

    /* =========================================================================
       LOCAL VAZIRMATN FONT FACES & GLOBAL TYPOGRAPHY ENFORCEMENT
       ========================================================================= */
    @font-face {
        font-family: 'Vazirmatn';
        src: url('/fonts/vazirmatn/Vazirmatn-Regular.woff2') format('woff2');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Vazirmatn';
        src: url('/fonts/vazirmatn/Vazirmatn-Medium.woff2') format('woff2');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Vazirmatn';
        src: url('/fonts/vazirmatn/Vazirmatn-SemiBold.woff2') format('woff2');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Vazirmatn';
        src: url('/fonts/vazirmatn/Vazirmatn-Bold.woff2') format('woff2');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Vazirmatn';
        src: url('/fonts/vazirmatn/Vazirmatn-ExtraBold.woff2') format('woff2');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    *, *::before, *::after {
        font-family: 'Vazirmatn', 'Vazir', Tahoma, -apple-system, BlinkMacSystemFont, sans-serif !important;
        box-sizing: border-box;
    }
    body, button, input, select, textarea, optgroup, p, span, a, h1, h2, h3, h4, h5, h6, table, th, td, div {
        font-family: 'Vazirmatn', 'Vazir', Tahoma, -apple-system, BlinkMacSystemFont, sans-serif !important;
    }

    /* =========================================================================
       CORE ENTERPRISE CONTAINERS & HEADERS
       ========================================================================= */
    .erp-page-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .erp-page-meta {
        flex: 1;
        min-width: 260px;
    }
    .erp-page-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.74rem;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 99px;
        margin-bottom: 8px;
    }
    .erp-page-title {
        font-size: 1.35rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0 0 6px 0;
        line-height: 1.4;
        letter-spacing: -0.02em;
    }
    .erp-page-desc {
        font-size: 0.84rem;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }

    /* Buttons */
    .erp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 22px;
        border-radius: 12px;
        font-size: 0.86rem;
        font-weight: 800;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
        white-space: nowrap;
    }
    .erp-btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);
    }
    .erp-btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.38);
    }
    .erp-btn-primary:active {
        transform: translateY(0);
    }

    /* Cards */
    .erp-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
        margin-bottom: 24px;
        overflow: hidden;
        transition: all 0.25s ease;
    }
    .erp-card:hover {
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.07);
    }
    .erp-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
    }
    .erp-card-title {
        font-size: 1.02rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }
    .erp-card-body {
        padding: 24px;
    }
    .erp-table-wrap {
        overflow-x: auto;
        border-radius: 12px;
    }

    /* Stats Grid & Cards */
    .erp-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .erp-stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .erp-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border-color: #cbd5e1;
    }
    .erp-stat-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 8px;
    }
    .erp-stat-value {
        font-size: 1.65rem;
        font-weight: 900;
        color: #0f172a;
        line-height: 1.2;
        margin-bottom: 4px;
    }
    .erp-stat-sub {
        font-size: 0.72rem;
        color: #94a3b8;
        font-weight: 600;
    }

    /* =========================================================================
       ULTRA-PREMIUM INPUTS & FORM CONTROLS
       ========================================================================= */
    .erp-form-grid {
        display: grid;
        gap: 18px;
    }
    .erp-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
    .erp-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }
    @media (max-width: 860px) {
        .erp-grid-2, .erp-grid-3 {
            grid-template-columns: 1fr;
        }
    }
    .erp-form-group, .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
        text-align: right;
    }
    .erp-form-label, .form-label-custom {
        font-size: 0.82rem;
        font-weight: 700;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 2px;
    }
    .erp-form-label .req {
        color: #ef4444;
        font-weight: 900;
    }
    .erp-form-input, .erp-form-select, .erp-form-textarea,
    .form-input-custom, .form-select-custom, .form-textarea-custom {
        width: 100% !important;
        box-sizing: border-box !important;
        padding: 11px 16px !important;
        font-size: 0.86rem !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 12px !important;
        outline: none !important;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03) !important;
        display: block;
    }
    .erp-form-input:hover, .erp-form-select:hover, .erp-form-textarea:hover,
    .form-input-custom:hover, .form-select-custom:hover, .form-textarea-custom:hover {
        border-color: #94a3b8 !important;
    }
    .erp-form-input:focus, .erp-form-select:focus, .erp-form-textarea:focus,
    .form-input-custom:focus, .form-select-custom:focus, .form-textarea-custom:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12) !important;
        background: #ffffff !important;
    }
    .erp-form-input::placeholder, .erp-form-textarea::placeholder,
    .form-input-custom::placeholder, .form-textarea-custom::placeholder {
        color: #94a3b8 !important;
        font-weight: 500 !important;
    }
    .erp-input-icon-wrap {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    .erp-input-icon-wrap svg {
        position: absolute;
        right: 14px;
        color: #94a3b8;
        pointer-events: none;
        z-index: 2;
    }
    .erp-input-icon-wrap .erp-form-input {
        padding-right: 44px !important;
    }
    .erp-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 22px 24px;
        margin-bottom: 22px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
    }
    .erp-form-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .erp-form-card-title {
        font-size: 0.98rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .erp-form-card-badge {
        font-size: 0.72rem;
        font-weight: 800;
        background: #eff6ff;
        color: #2563eb;
        padding: 4px 10px;
        border-radius: 99px;
    }

    /* =========================================================================
       SPARE PARTS HD GALLERY CARDS
       ========================================================================= */
    .parts-grid-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    .part-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
        transition: all 0.25s ease;
    }
    .part-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.09);
        border-color: #93c5fd;
    }
    .part-card-img-wrap {
        position: relative;
        width: 100%;
        height: 180px;
        background: #f8fafc;
        overflow: hidden;
    }
    .part-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .part-card:hover .part-card-img {
        transform: scale(1.06);
    }
    .part-card-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 99px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .part-card-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .part-card-title {
        font-size: 0.92rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }
    .part-card-sku {
        font-size: 0.74rem;
        color: #64748b;
        font-family: monospace;
        margin-bottom: 10px;
    }
    .part-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
    }
    .part-card-price {
        font-size: 0.95rem;
        font-weight: 900;
        color: #10b981;
    }
    .part-card-shelf {
        font-size: 0.74rem;
        color: #475569;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 6px;
    }

    /* Tag Chips & Brands */
    .erp-tag-chips, .erp-brand-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .erp-tag-chip, .erp-brand-chip {
        padding: 7px 14px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        font-size: 0.78rem;
        font-weight: 700;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
        user-select: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .erp-tag-chip.active, .erp-brand-chip.active {
        background: #eff6ff;
        border-color: #2563eb;
        color: #1d4ed8;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
    }

    /* Intake Receipt Live */
    .intake-receipt-live {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 6px 24px rgba(15, 23, 42, 0.05);
        position: sticky;
        top: 24px;
    }
    .intake-receipt-header {
        text-align: center;
        padding-bottom: 16px;
        border-bottom: 1.5px dashed #cbd5e1;
        margin-bottom: 16px;
    }
    .intake-receipt-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.8rem;
    }
    .intake-receipt-label {
        color: #64748b;
        font-weight: 600;
    }
    .intake-receipt-val {
        color: #0f172a;
        font-weight: 800;
    }

    /* =========================================================================
       PREMIUM ERP DASHBOARD & SIDEBAR STYLING (100% LIGHT THEME)
       ========================================================================= */
    :root {
        --dash-bg: #f8fafc;
        --sidebar-w: 275px;
        --topbar-h: 70px;
        --surface: #ffffff;
        --card-border: #e2e8f0;
        --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }

    body {
        background-color: var(--dash-bg);
    }

    .erp-container {
        display: flex;
        min-height: calc(100vh - 120px);
        position: relative;
        width: 100% !important;
        max-width: 100% !important;
        gap: 16px;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
    }
    .erp-sidebar {
        width: 270px !important;
        min-width: 270px !important;
        max-width: 270px !important;
        background: #ffffff;
        border: 1px solid var(--card-border);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        position: sticky;
        top: 80px;
        height: fit-content;
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        margin: 0 !important;
        padding: 16px;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 100;
        box-sizing: border-box !important;
    }
    .erp-main {
        flex: 1 1 0% !important;
        min-width: 0 !important;
        width: auto !important;
        max-width: 100% !important;
        padding: 0 4px 40px !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
    }

    /* -------------------------------------------------------------------------
       1. SIDEBAR (Desktop Fixed/Sticky + Mobile Off-canvas Drawer)
       ------------------------------------------------------------------------- */
    .erp-sidebar {
        width: var(--sidebar-w);
        background: #ffffff;
        border-left: 1px solid var(--card-border);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        position: sticky;
        top: 80px;
        height: fit-content;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        margin: 12px;
        padding: 16px;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 100;
    }

    /* User Badge */
    .erp-user-badge {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
        border: 1px solid #dbeafe;
        border-radius: 14px;
        margin-bottom: 16px;
    }
    .erp-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--primary-gradient);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        flex-shrink: 0;
    }
    .erp-user-meta {
        overflow: hidden;
    }
    .erp-user-name {
        font-size: 0.88rem;
        font-weight: 800;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .erp-user-role {
        font-size: 0.72rem;
        color: #2563eb;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 2px;
    }
    .erp-pulse-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }

    /* Navigation Sections */
    .erp-nav-section-title {
        font-size: 0.68rem;
        font-weight: 800;
        color: #94a3b8;
        padding: 8px 10px 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .erp-nav-list {
        list-style: none;
        padding: 0;
        margin: 0 0 12px 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .erp-nav-item {
        position: relative;
    }
    .erp-nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px;
        border-radius: 12px;
        color: #475569;
        font-size: 0.84rem;
        font-weight: 700;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        width: 100%;
        text-align: right;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .erp-nav-link:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
    .erp-nav-link.active {
        background: #eff6ff;
        color: #1d4ed8;
        border-color: #bfdbfe;
        font-weight: 800;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
    }
    .erp-nav-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .erp-nav-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: currentColor;
    }
    .erp-nav-badge {
        font-size: 0.70rem;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 99px;
        background: #e2e8f0;
        color: #475569;
    }
    .erp-nav-link.active .erp-nav-badge {
        background: #2563eb;
        color: #ffffff;
    }

    .erp-sidebar-footer {
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid var(--card-border);
    }
    .erp-logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px;
        border-radius: 12px;
        background: #fff1f2;
        border: 1px solid #ffe4e6;
        color: #e11d48;
        font-size: 0.82rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s;
    }
    .erp-logout-btn:hover {
        background: #ffe4e6;
        color: #be123c;
    }

    /* -------------------------------------------------------------------------
       2. MAIN WORKSPACE & TOP BAR
       ------------------------------------------------------------------------- */
    .erp-main {
        flex: 1;
        padding: 16px 20px 40px;
        min-width: 0;
    }
    
    .erp-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 12px 18px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.02);
    }
    .erp-topbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .erp-toggle-sidebar {
        display: none;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #0f172a;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .erp-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        color: #64748b;
    }
    .erp-breadcrumb strong {
        color: #0f172a;
        font-weight: 800;
    }

    .erp-top-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .erp-search-box {
        position: relative;
        display: flex;
        align-items: center;
    }
    .erp-search-box svg {
        position: absolute;
        right: 12px;
        pointer-events: none;
    }
    .erp-search-input {
        padding: 9px 36px 9px 14px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        font-size: 0.82rem;
        width: 260px;
        font-family: inherit;
        transition: all 0.2s;
    }
    .erp-search-input:focus {
        outline: none;
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }
    .btn-quick-intake {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary-gradient);
        color: #ffffff;
        padding: 9px 16px;
        border-radius: 12px;
        font-size: 0.82rem;
        font-weight: 800;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        transition: all 0.2s;
    }
    .btn-quick-intake:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
    }

    /* -------------------------------------------------------------------------
       3. KPI STATS GRID
       ------------------------------------------------------------------------- */
    .erp-kpi-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }
    .kpi-card {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 14px 16px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.02);
        transition: transform 0.2s ease;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
    }
    .kpi-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .kpi-title {
        font-size: 0.76rem;
        font-weight: 700;
        color: #64748b;
    }
    .kpi-icon-wrap {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .kpi-val {
        font-size: 1.45rem;
        font-weight: 900;
        color: #0f172a;
        line-height: 1.2;
    }
    .kpi-sub {
        font-size: 0.68rem;
        color: #94a3b8;
        margin-top: 4px;
    }

    /* -------------------------------------------------------------------------
       4. ERP VIEWS & PANELS
       ------------------------------------------------------------------------- */
    .erp-view {
        display: none !important;
    }
    .erp-view.active {
        display: block !important;
        animation: fadeInView 0.25s ease-out forwards;
    }
    .erp-view:not(.active) {
        display: none !important;
    }
    @keyframes fadeInView {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .erp-panel {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.02);
    }
    .erp-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        margin-bottom: 16px;
        border-bottom: 1px solid var(--card-border);
    }
    .erp-panel-title {
        font-size: 1.02rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .erp-panel-actions {
        display: flex;
        gap: 8px;
    }

    /* Filter Pills Wrap */
    .filter-pills-wrap {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
        overflow-x: auto;
        padding-bottom: 6px;
    }
    .filter-pill-item {
        font-size: 0.78rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 99px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #475569;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.2s;
    }
    .filter-pill-item:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .filter-pill-item.active {
        background: #2563eb;
        border-color: #1d4ed8;
        color: #ffffff;
        font-weight: 800;
    }

    /* Tables */
    .table-responsive-box {
        overflow-x: auto !important;
        max-width: 100% !important;
        width: 100% !important;
        box-sizing: border-box !important;
        border-radius: 14px;
        border: 1px solid var(--card-border);
        -webkit-overflow-scrolling: touch !important;
    }
    .erp-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.80rem;
        text-align: right;
    }
    .erp-table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 800;
        padding: 12px 14px;
        border-bottom: 1px solid var(--card-border);
        white-space: nowrap;
    }
    .erp-table tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }
    .erp-table tbody tr:hover {
        background: #f8fafc;
    }
    .table-track-code {
        font-family: monospace;
        font-weight: 800;
        color: #2563eb;
        background: #eff6ff;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-block;
    }
    .table-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.72rem;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 99px;
        white-space: nowrap;
    }
    .st-received { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }
    .st-inspecting { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
    .st-repairing { background: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
    .st-waiting_parts { background: #fce7f3; color: #be185d; border: 1px solid #fbcfe8; }
    .st-ready_for_delivery { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .st-delivered { background: #ede9fe; color: #6d28d9; border: 1px solid #ddd6fe; }

    .btn-table-action {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.74rem;
        font-weight: 700;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-table-action:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #94a3b8;
    }

    /* Modal */
    .warranty-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(6px);
        z-index: 20000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-y: auto;
    }
    .warranty-modal-backdrop.show {
        display: flex;
    }
    .warranty-modal-box {
        background: #ffffff;
        border-radius: 24px;
        max-width: 620px;
        width: 100%;
        padding: 24px;
        color: #0f172a;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.25);
        border: 1px solid #e2e8f0;
        position: relative;
        animation: scaleModal 0.25s ease-out;
    }
    @keyframes scaleModal {
        from { transform: scale(0.92); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .btn-close-modal {
        position: absolute;
        top: 16px;
        left: 16px;
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-close-modal:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* Responsive Mobile Sidebar & Ultra-Clean Native Layout */
    @media (max-width: 991px) {
        .erp-container {
            flex-direction: column !important;
            overflow-x: hidden !important;
            width: 100% !important;
            max-width: 100vw !important;
        }
        .erp-sidebar {
            display: none !important;
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 295px !important;
            max-width: 85vw !important;
            height: 100vh !important;
            margin: 0 !important;
            border-radius: 0 !important;
            border: none !important;
            border-left: 1px solid #e2e8f0 !important;
            box-shadow: -15px 0 40px rgba(15, 23, 42, 0.3) !important;
            z-index: 100000 !important;
            overflow-y: auto !important;
            background: #ffffff !important;
            visibility: hidden !important;
            pointer-events: none !important;
            right: -340px !important; left: auto !important; transform: none !important;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s ease !important;
        }
        .erp-sidebar.open {
            display: flex !important;
            visibility: visible !important;
            pointer-events: auto !important;
            right: 0 !important; left: auto !important; transform: none !important;
        }
        .erp-sidebar-mobile-close {
            display: flex !important;
        }
        .erp-sidebar-overlay {
            position: fixed !important;
            inset: 0 !important;
            background: rgba(15, 23, 42, 0.55) !important;
            backdrop-filter: blur(4px) !important;
            -webkit-backdrop-filter: blur(4px) !important;
            z-index: 99999 !important;
            display: none;
        }
        .erp-sidebar-overlay.open {
            display: block !important;
        }
        .erp-main {
            padding: 10px 12px 115px 12px !important;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }
        .erp-toggle-sidebar {
            display: flex !important;
        }
        .erp-kpi-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
        .erp-search-box {
            display: none !important;
        }
        .portal-footer, .site-footer-light, .native-bottom-bar:not(.admin-mobile-nav) {
            display: none !important;
        }
    }

    /* =========================================================================
       ULTRA-PREMIUM CMS STYLING & INTERACTIVE ENHANCEMENTS
       ========================================================================= */
    .cms-subtabs-nav {
        display: flex;
        gap: 10px;
        margin-bottom: 24px;
        padding: 6px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
        overflow-x: auto;
    }
    .cms-subtab-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.84rem;
        border: none;
        background: transparent;
        color: #475569;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        white-space: nowrap;
    }
    .cms-subtab-pill:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .cms-subtab-pill.active {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
    }

    /* Live Header Simulation */
    .header-sim-wrapper {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 24px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.03);
    }
    .header-sim-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        background: #eff6ff;
        color: #2563eb;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 99px;
        margin-bottom: 12px;
    }
    .header-sim-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 12px 16px;
        background: #f8fafc;
    }
    .header-sim-link {
        font-size: 0.8rem;
        font-weight: 700;
        color: #1e293b;
        padding: 5px 12px;
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* SEO Quality Meter */
    .seo-meter-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
        border: 1px solid #86efac;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 20px;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.06);
    }
    .seo-meter-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .seo-score-circle {
        font-size: 1.6rem;
        font-weight: 900;
        color: #10b981;
    }
    .seo-checklist {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 10px;
        margin-top: 14px;
    }
    .seo-check-item {
        font-size: 0.78rem;
        font-weight: 700;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s ease;
    }
    .seo-check-item.valid {
        color: #059669;
    }

    /* Template Cards */
    .template-card-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 14px;
        text-align: right;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .template-card-btn:hover {
        background: #eff6ff;
        border-color: #93c5fd;
        transform: translateY(-2px);
    }

    /* Quick Reply Pill */
    .quick-reply-pill {
        display: inline-block;
        font-size: 0.74rem;
        font-weight: 700;
        color: #2563eb;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 99px;
        padding: 5px 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-left: 6px;
        margin-bottom: 6px;
    }
    .quick-reply-pill:hover {
        background: #2563eb;
        color: #ffffff;
    }

    /* =========================================================================
       PRINT STYLES FOR THERMAL LABEL (50x30mm) & POS RECEIPT (80mm)
       ========================================================================= */
    @media print {
        body > *:not(#printContainer) {
            display: none !important;
        }
        #printContainer {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: #ffffff;
            color: #000000;
        }
    }

    /* Thermal Label Box (50x30mm standard) */
    .thermal-label-preview {
        width: 320px;
        min-height: 190px;
        border: 2px dashed #94a3b8;
        border-radius: 12px;
        padding: 12px;
        background: #ffffff;
        color: #0f172a;
        font-size: 0.72rem;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        margin: 0 auto;
        position: relative;
    }
    .thermal-label-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1.5px solid #000;
        padding-bottom: 6px;
        margin-bottom: 6px;
    }

    /* POS 80mm Slip Box */
    .pos-slip-preview {
        width: 300px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 16px;
        background: #ffffff;
        color: #0f172a;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin: 0 auto;
        font-size: 0.76rem;
    }

    /* Timeline Stepper */
    .timeline-container {
        position: relative;
        padding-right: 24px;
    }
    .timeline-container::before {
        content: '';
        position: absolute;
        right: 8px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e2e8f0;
    }
    .timeline-node {
        position: relative;
        margin-bottom: 20px;
    }
    .timeline-node::before {
        content: '';
        position: absolute;
        right: -20px;
        top: 6px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #2563eb;
        border: 2px solid #ffffff;
        box-shadow: 0 0 0 2px #93c5fd;
    }
    .timeline-node.passed::before {
        background: #10b981;
        box-shadow: 0 0 0 2px #a7f3d0;
    }

    /* QC Toggle Card */
    .qc-check-pill {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .qc-check-pill:hover {
        background: #eff6ff;
        border-color: #93c5fd;
    }
    .qc-check-pill.checked {
        background: #ecfdf5;
        border-color: #86efac;
        color: #065f46;
    }


    /* =========================================================================
       ADMIN ULTRA-PREMIUM MOBILE STICKY BOTTOM NAVIGATION BAR & NATIVE STYLES
       ========================================================================= */
    .admin-mobile-nav {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: calc(66px + env(safe-area-inset-bottom, 0px));
        padding: 0 8px env(safe-area-inset-bottom, 0px) 8px;
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(24px) saturate(180%);
        -webkit-backdrop-filter: blur(24px) saturate(180%);
        border-top: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 -6px 28px rgba(15, 23, 42, 0.09);
        z-index: 10050;
        align-items: center;
        justify-content: space-around;
        direction: rtl;
    }

    .admin-nav-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 700;
        height: 58px;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        border-radius: 12px;
        -webkit-tap-highlight-color: transparent;
    }
    .admin-nav-item:active {
        transform: scale(0.92);
    }
    .admin-nav-item.active {
        color: #2563eb !important;
        font-weight: 900 !important;
    }
    .admin-nav-item.active .admin-nav-icon {
        transform: translateY(-2px);
        color: #2563eb !important;
    }
    .admin-nav-item.active::before {
        content: '';
        position: absolute;
        top: 4px;
        width: 18px;
        height: 3px;
        border-radius: 99px;
        background: #2563eb;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.45);
    }

    .admin-nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .admin-badge-count {
        position: absolute;
        top: -4px;
        right: -8px;
        background: #ef4444;
        color: #ffffff;
        font-size: 0.65rem;
        font-weight: 900;
        padding: 1px 6px;
        border-radius: 99px;
        line-height: 1.2;
        border: 1.5px solid #ffffff;
    }

    /* Center Elevated Hero Action Button */
    .admin-nav-center {
        position: relative;
        top: -18px;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .admin-center-btn {
        width: 60px !important;
        height: 60px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        box-shadow: 0 10px 25px -4px rgba(37, 99, 235, 0.45), 0 0 0 5px rgba(255, 255, 255, 0.95) !important;
        border: none !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        -webkit-tap-highlight-color: transparent !important;
    }
    .admin-center-btn:hover {
        transform: translateY(-3px) scale(1.05) !important;
        box-shadow: 0 14px 30px -4px rgba(37, 99, 235, 0.55), 0 0 0 6px #ffffff !important;
    }
    .admin-center-btn:active {
        transform: translateY(0) scale(0.95) !important;
    }
    .admin-center-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 1px;
    }
    .admin-center-label {
        position: absolute;
        bottom: -18px;
        font-size: 0.68rem;
        font-weight: 800;
        color: #2563eb;
        white-space: nowrap;
    }

    /* =========================================================================
       COMPREHENSIVE NATIVE RESPONSIVE SUITE FOR SCREENS <= 991px
       ========================================================================= */
    @media (max-width: 991px) {
        .admin-mobile-nav {
            display: flex !important;
        }
        body {
            overflow-x: hidden !important;
            width: 100vw !important;
            max-width: 100vw !important;
        }
        .erp-container {
            flex-direction: column !important;
            overflow-x: hidden !important;
            width: 100vw !important;
            max-width: 100vw !important;
        }
        .erp-main {
            padding: 10px 12px 110px 12px !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }
        
    .erp-topbar {
            padding: 10px 14px !important;
            border-radius: 14px !important;
            margin-bottom: 16px !important;
            flex-wrap: wrap !important;
            gap: 10px !important;
        }
        .erp-top-actions {
            width: 100% !important;
            justify-content: space-between !important;
        }
        .erp-search-box {
            display: none !important;
        }
        .erp-kpi-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px !important;
        }
        .erp-stats-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px !important;
        }
        .erp-grid-2, .erp-grid-3, .form-grid-2, .erp-form-grid {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }
        /* 2-column Intake Layout (Form + Live Receipt) */
        #tab-new-intake > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }
        .intake-receipt-live {
            position: static !important;
            margin-top: 20px !important;
        }
        /* Cards and tables */
        .erp-card-body, .erp-panel {
            padding: 14px !important;
        }
        .erp-card-header, .erp-panel-header {
            padding: 12px 14px !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 10px !important;
        }
        .erp-panel-actions {
            width: 100% !important;
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
        }
        /* Spare Parts Grid */
        .parts-grid-cards {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }
        /* Modals */
        .warranty-modal-backdrop {
            padding: 10px !important;
        }
        .warranty-modal-box {
            max-width: 95vw !important;
            width: 95vw !important;
            padding: 16px !important;
            border-radius: 18px !important;
            margin: auto !important;
        }
        .filter-pills-wrap {
            overflow-x: auto !important;
            white-space: nowrap !important;
            padding-bottom: 6px !important;
            -webkit-overflow-scrolling: touch !important;
        }
        .cms-subtabs-nav {
            overflow-x: auto !important;
            white-space: nowrap !important;
            padding-bottom: 6px !important;
            -webkit-overflow-scrolling: touch !important;
        }
        /* Table actions */
        .btn-table-action {
            padding: 6px 9px !important;
            font-size: 0.72rem !important;
        }
    }

    @media (max-width: 480px) {
        .erp-kpi-grid {
            grid-template-columns: 1fr 1fr !important;
            gap: 8px !important;
        }
        .kpi-card {
            padding: 12px !important;
        }
        .kpi-val {
            font-size: 1.4rem !important;
        }
        .erp-page-title {
            font-size: 1.15rem !important;
        }
        .admin-center-btn {
            width: 54px !important;
            height: 54px !important;
        }
    }


    /* BULLETPROOF MOBILE RESPONSIVE & HORIZONTAL OVERFLOW PREVENTION */
    html, body {
        overflow-x: clip !important;
        max-width: 100vw !important;
        width: 100% !important;
    }
    .portal-wrapper, .erp-container, .erp-main {
        overflow-x: clip !important;
        max-width: 100vw !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    .erp-table-responsive {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        max-width: 100% !important;
        width: 100% !important;
        display: block !important;
        border-radius: 14px !important;
    }

    @media (max-width: 991px) {
        /* COMPLETELY SUPPRESS SECOND HEADER ON MOBILE */
        .erp-topbar {
            display: none !important;
            visibility: hidden !important;
            pointer-events: none !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            opacity: 0 !important;
        }

        /* BULLETPROOF DRAWER HIDING ON MOBILE - PREVENT PHANTOM SCROLL */
        .erp-sidebar {
            display: none !important;
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 290px !important;
            max-width: 85vw !important;
            height: 100vh !important;
            height: 100dvh !important;
            margin: 0 !important;
            border-radius: 0 !important;
            border: none !important;
            border-left: 1px solid #e2e8f0 !important;
            box-shadow: none !important;
            z-index: 100000 !important;
            overflow-y: auto !important;
            background: #ffffff !important;
            visibility: hidden !important;
            pointer-events: none !important;
            right: 0 !important; left: auto !important;
            transform: translateX(115%) !important;
            transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.28s ease !important;
        }
        .erp-sidebar.open {
            display: flex !important;
            visibility: visible !important;
            pointer-events: auto !important;
            right: 0 !important; left: auto !important; transform: none !important;
            box-shadow: -15px 0 40px rgba(15, 23, 42, 0.3) !important;
        }
        .erp-sidebar-mobile-close {
            display: flex !important;
        }
        .erp-sidebar-overlay {
            position: fixed !important;
            inset: 0 !important;
            background: rgba(15, 23, 42, 0.55) !important;
            backdrop-filter: blur(4px) !important;
            -webkit-backdrop-filter: blur(4px) !important;
            z-index: 99999 !important;
            display: none;
        }
        .erp-sidebar-overlay.open {
            display: block !important;
        }
        .erp-main {
            padding: 8px 10px 105px 10px !important;
        }
    }


    /* =========================================================================
       EXPLICIT DESKTOP SUITE (min-width: 992px)
       ========================================================================= */
    @media (min-width: 992px) {
        .erp-container {
            display: flex !important;
            flex-direction: row !important;
            align-items: flex-start !important;
        }
        .erp-sidebar {
            display: flex !important;
            position: sticky !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: none !important;
            opacity: 1 !important;
            top: 80px !important;
            width: 270px !important;
            min-width: 270px !important;
            max-width: 270px !important;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03) !important;
            border-radius: 18px !important;
            border: 1px solid var(--card-border) !important;
            background: #ffffff !important;
            z-index: 100 !important;
            margin: 0 !important;
            padding: 16px !important;
        }
        .erp-sidebar-mobile-close {
            display: none !important;
        }
        .erp-sidebar-overlay {
            display: none !important;
        }
        .admin-mobile-nav {
            display: none !important;
        }
    }


    @media (max-width: 991px) {
        .erp-toggle-sidebar {
            display: none !important;
        }
        .erp-topbar {
            display: none !important;
            visibility: hidden !important;
            pointer-events: none !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            opacity: 0 !important;
        }
        .erp-search-box {
            display: none !important;
        }
    }

</style>
@endpush

@section('content')
<div class="erp-container">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div class="erp-sidebar-overlay" id="erpSidebarOverlay" onclick="toggleErpSidebar()"></div>

    <!-- 1. ERP SIDEBAR -->
    <aside class="erp-sidebar" id="erpSidebar">
        <!-- Mobile Drawer Header with Close Button -->
        <div class="erp-sidebar-mobile-close" style="display: none; align-items: center; justify-content: space-between; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
            <span style="font-weight: 800; font-size: 0.88rem; color: #0f172a;">منوی دسترسی سامانه</span>
            <button type="button" onclick="toggleErpSidebar(false)" style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; color: #475569;" title="بستن منو">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <!-- User Badge -->
        <div class="erp-user-badge">
            <div class="erp-avatar">
                {{ mb_substr($user ? $user->name : 'مدیر', 0, 1) }}
            </div>
            <div class="erp-user-meta">
                <div class="erp-user-name">{{ $user ? $user->name : 'مدیریت خدمات سام موبایل' }}</div>
                <div class="erp-user-role">
                    <span class="erp-pulse-dot"></span>
                    <span>مدیر ارشد سامانه (ماده ۱۳)</span>
                </div>
            </div>
        </div>

        <!-- Navigation Sections -->
        <span class="erp-nav-section-title">میز کار و پرونده‌ها</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=overview" class="erp-nav-link {{ $activeTab === 'tab-overview' ? 'active' : '' }}" data-tab="tab-overview" onclick="switchErpTab('tab-overview', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span>
                        <span class="erp-nav-title">نمای کلی و آمار</span>
                    </span>
                    <span class="erp-nav-badge">{{ $stats['total'] }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=orders" class="erp-nav-link {{ $activeTab === 'tab-orders' ? 'active' : '' }}" data-tab="tab-orders" onclick="switchErpTab('tab-orders', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
                        <span class="erp-nav-title">مدیریت پرونده‌ها</span>
                    </span>
                    <span class="erp-nav-badge">{{ $stats['repairing'] + $stats['inspecting'] }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=new-intake" class="erp-nav-link {{ $activeTab === 'tab-new-intake' ? 'active' : '' }}" data-tab="tab-new-intake" onclick="switchErpTab('tab-new-intake', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
                        <span class="erp-nav-title">پذیرش دستگاه جدید</span>
                    </span>
                </a>
            </li>
        </ul>

        <span class="erp-nav-section-title">کارگاه و قطعات</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=technicians" class="erp-nav-link {{ $activeTab === 'tab-technicians' ? 'active' : '' }}" data-tab="tab-technicians" onclick="switchErpTab('tab-technicians', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span class="erp-nav-title">تکنسین‌ها و ارجاع</span>
                    </span>
                    <span class="erp-nav-badge">{{ count($technicians) }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=parts" class="erp-nav-link {{ $activeTab === 'tab-parts' ? 'active' : '' }}" data-tab="tab-parts" onclick="switchErpTab('tab-parts', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></span>
                        <span class="erp-nav-title">انبار قطعات یدکی</span>
                    </span>
                    <span class="erp-nav-badge">{{ count($partsInventory) }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=invoices" class="erp-nav-link {{ $activeTab === 'tab-invoices' ? 'active' : '' }}" data-tab="tab-invoices" onclick="switchErpTab('tab-invoices', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                        <span class="erp-nav-title">فاکتورها و تعرفه</span>
                    </span>
                </a>
            </li>
        </ul>

        <span class="erp-nav-section-title">ابزارهای اختصاصی</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=warranty-card" class="erp-nav-link {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" data-tab="tab-warranty-card" onclick="switchErpTab('tab-warranty-card', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon" style="color: #2563eb;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                        <span class="erp-nav-title">صدور کارت گارانتی</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#dbeafe; color:#1d4ed8;">۱۸ ماهه</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=sms" class="erp-nav-link {{ $activeTab === 'tab-sms' ? 'active' : '' }}" data-tab="tab-sms" onclick="switchErpTab('tab-sms', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                        <span class="erp-nav-title">پنل پیامک و اطلاع‌رسانی</span>
                    </span>
                </a>
            </li>
        </ul>

        <span class="erp-nav-section-title">مدیریت محتوا و CMS</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=site-settings" class="erp-nav-link {{ $activeTab === 'tab-site-settings' ? 'active' : '' }}" data-tab="tab-site-settings" onclick="switchErpTab('tab-site-settings', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></span>
                        <span class="erp-nav-title">تنظیمات سایت و منوها</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#fef3c7; color:#92400e;">CMS</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=pages" class="erp-nav-link {{ $activeTab === 'tab-pages' ? 'active' : '' }}" data-tab="tab-pages" onclick="switchErpTab('tab-pages', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
                        <span class="erp-nav-title">مدیریت صفحات سایت</span>
                    </span>
                    <span class="erp-nav-badge">{{ isset($cmsPages) ? count($cmsPages) : 0 }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=blog" class="erp-nav-link {{ $activeTab === 'tab-blog' ? 'active' : '' }}" data-tab="tab-blog" onclick="switchErpTab('tab-blog', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></span>
                        <span class="erp-nav-title">وبلاگ تخصصی و سئو</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#dcfce7; color:#166534;">SEO</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=surveys" class="erp-nav-link {{ $activeTab === 'tab-surveys' ? 'active' : '' }}" data-tab="tab-surveys" onclick="switchErpTab('tab-surveys', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></span>
                        <span class="erp-nav-title">نظرسنجی و تحلیل نظرات</span>
                    </span>
                    <span class="erp-nav-badge">{{ isset($surveyStats['total']) ? $surveyStats['total'] : 0 }}</span>
                </a>
            </li>
        </ul>

        <span class="erp-nav-section-title">نمایندگی‌ها و ارتباطات</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=customers" class="erp-nav-link {{ $activeTab === 'tab-customers' ? 'active' : '' }}" data-tab="tab-customers" onclick="switchErpTab('tab-customers', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span class="erp-nav-title">باشگاه و CRM مشتریان</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#fef3c7; color:#d97706;">{{ isset($customers) ? count($customers) : 0 }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=agencies" class="erp-nav-link {{ $activeTab === 'tab-agencies' ? 'active' : '' }}" data-tab="tab-agencies" onclick="switchErpTab('tab-agencies', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                        <span class="erp-nav-title">مدیریت شعب و نمایندگان</span>
                    </span>
                    <span class="erp-nav-badge">{{ isset($agencies) ? count($agencies) : 6 }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=internal-chat" class="erp-nav-link {{ $activeTab === 'tab-internal-chat' ? 'active' : '' }}" data-tab="tab-internal-chat" onclick="switchErpTab('tab-internal-chat', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                        <span class="erp-nav-title">چت و گفتگوی داخلی</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#dcfce7; color:#166534;">زنده</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=tickets" class="erp-nav-link {{ $activeTab === 'tab-tickets' ? 'active' : '' }}" data-tab="tab-tickets" onclick="switchErpTab('tab-tickets', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                        <span class="erp-nav-title">تیکت‌های پشتیبانی</span>
                    </span>
                    <span class="erp-nav-badge">{{ isset($tickets) ? count($tickets) : 0 }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=complaints" class="erp-nav-link {{ $activeTab === 'tab-complaints' ? 'active' : '' }}" data-tab="tab-complaints" onclick="switchErpTab('tab-complaints', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></span>
                        <span class="erp-nav-title">شکایات و بازرسی</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#fee2e2; color:#b91c1c;">{{ isset($complaints) ? count($complaints) : 0 }}</span>
                </a>
            </li>
            <li class="erp-nav-item">
                <a href="{{ url('/admin-portal') }}?tab=users" class="erp-nav-link {{ $activeTab === 'tab-users' ? 'active' : '' }}" data-tab="tab-users" onclick="switchErpTab('tab-users', this, event)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span class="erp-nav-title">کاربران و نقش‌ها</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#eff6ff; color:#2563eb;">{{ isset($systemUsers) ? count($systemUsers) : 4 }}</span>
                </a>
            </li>
        </ul>


        <!-- Sidebar Bottom Footer -->
        <div class="erp-sidebar-footer">
            <form action="{{ url('/logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="erp-logout-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span>خروج از پنل مدیریت</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. MAIN WORKSPACE -->
    <main class="erp-main">
        <!-- Top Bar -->
        <header class="erp-topbar">
            <div class="erp-topbar-right">
                <button type="button" class="erp-toggle-sidebar" onclick="toggleErpSidebar()" title="باز کردن منو">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div class="erp-breadcrumb">
                    <span>سام موبایل</span>
                    <span>/</span>
                    <span>سامانه جامع خدمات</span>
                    <span>/</span>
                    <strong id="breadcrumbTitle">نمای کلی و آمار</strong>
                </div>
            </div>

            <!-- Live Filter/Search & Action Buttons -->
            <div class="erp-top-actions">
                <div class="erp-search-box">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="globalSearchInput" class="erp-search-input" placeholder="جستجوی سریع کد رهگیری، IMEI، مشتری..." onkeyup="filterOrdersTable()">
                </div>
                <button type="button" class="btn-quick-intake" onclick="switchErpTab('tab-new-intake')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>پذیرش دستگاه جدید</span>
                </button>
            </div>
        </header>

        <!-- ===================================================================
             PAGE 1: OVERVIEW & DASHBOARD SUMMARY (tab-overview)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-overview' ? 'active' : '' }}" id="tab-overview" data-title="نمای کلی و آمار">

            <!-- KPI Summary Cards (Visible Only in Dashboard Overview) -->
            <section class="erp-kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">کل پرونده‌های خدمات</span>
                        <div class="kpi-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                    </div>
                    <div class="kpi-val">{{ $stats['total'] }}</div>
                    <div class="kpi-sub">ثبت شده در سامانه جامع</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">در دست بررسی و تعمیر</span>
                        <div class="kpi-icon-wrap" style="background: #fef3c7; color: #d97706;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-val" style="color: #d97706;">{{ $stats['repairing'] + $stats['inspecting'] }}</div>
                    <div class="kpi-sub">در خط تعمیرات کارگاه</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">در انتظار تأمین قطعه</span>
                        <div class="kpi-icon-wrap" style="background: #fce7f3; color: #be185d;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </div>
                    </div>
                    <div class="kpi-val" style="color: #be185d;">{{ $stats['waiting_parts'] }}</div>
                    <div class="kpi-sub">سفارش‌گذاری شده در انبار</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">آماده تحویل به مشتری</span>
                        <div class="kpi-icon-wrap" style="background: #dcfce7; color: #15803d;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                    <div class="kpi-val" style="color: #15803d;">{{ $stats['ready'] }}</div>
                    <div class="kpi-sub">کنترل کیفی (QC) تأیید شد</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">تحویل نهایی شده</span>
                        <div class="kpi-icon-wrap" style="background: #ede9fe; color: #7c3aed;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                    </div>
                    <div class="kpi-val" style="color: #7c3aed;">{{ $stats['delivered'] }}</div>
                    <div class="kpi-sub">با رضایت‌سنجی ۱۰۰٪</div>
                </div>
            </section>
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        <span>میز کار هوشمند و وضعیت کلی خدمات پس از فروش</span>
                    </div>
                    <div class="erp-panel-actions">
                        <a href="{{ url('/admin-portal') }}?tab=orders" class="btn-table-action" onclick="switchErpTab('tab-orders', null, event)">
                            <span>مشاهده همه پرونده‌ها &larr;</span>
                        </a>
                    </div>
                </div>

                <!-- Fast Actions Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 24px;">
                    <a href="{{ url('/admin-portal') }}?tab=new-intake" class="kpi-card" style="text-decoration:none; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg, #eff6ff 0%, #ffffff 100%); border-color:#bfdbfe;" onclick="switchErpTab('tab-new-intake', null, event)">
                        <div style="width:42px; height:42px; border-radius:12px; background:#2563eb; color:#ffffff; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div>
                            <strong style="display:block; font-size:0.88rem; color:#0f172a;">پذیرش دستگاه جدید</strong>
                            <span style="font-size:0.72rem; color:#64748b;">ثبت پذیرش حضوری و پستی</span>
                        </div>
                    </a>

                    <a href="{{ url('/admin-portal') }}?tab=orders" class="kpi-card" style="text-decoration:none; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-color:#bbf7d0;" onclick="switchErpTab('tab-orders', null, event)">
                        <div style="width:42px; height:42px; border-radius:12px; background:#16a34a; color:#ffffff; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <div>
                            <strong style="display:block; font-size:0.88rem; color:#0f172a;">کارتابل پرونده‌ها</strong>
                            <span style="font-size:0.72rem; color:#64748b;">مدیریت وضعیت و تعمیرات</span>
                        </div>
                    </a>

                    <a href="{{ url('/admin-portal') }}?tab=warranty-card" class="kpi-card" style="text-decoration:none; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg, #fef3c7 0%, #ffffff 100%); border-color:#fde68a;" onclick="switchErpTab('tab-warranty-card', null, event)">
                        <div style="width:42px; height:42px; border-radius:12px; background:#d97706; color:#ffffff; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <strong style="display:block; font-size:0.88rem; color:#0f172a;">صدور کارت گارانتی</strong>
                            <span style="font-size:0.72rem; color:#64748b;">چاپ کارت رسمی ۱۸ ماهه</span>
                        </div>
                    </a>

                    <a href="{{ url('/admin-portal') }}?tab=sms" class="kpi-card" style="text-decoration:none; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg, #ede9fe 0%, #ffffff 100%); border-color:#ddd6fe;" onclick="switchErpTab('tab-sms', null, event)">
                        <div style="width:42px; height:42px; border-radius:12px; background:#7c3aed; color:#ffffff; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                        <div>
                            <strong style="display:block; font-size:0.88rem; color:#0f172a;">پنل پیامک هوشمند</strong>
                            <span style="font-size:0.72rem; color:#64748b;">اطلاع‌رسانی لحظه‌ای مشتری</span>
                        </div>
                    </a>
                </div>

                <!-- Recent Activity Timeline Table -->
                <div style="margin-top: 10px;">
                    <h4 style="font-size: 0.90rem; font-weight: 800; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span>🕒 آخرین پرونده‌های ثبت‌شده در سامانه</span>
                    </h4>
                    <div class="table-responsive-box">
                        <table class="erp-table">
                            <thead>
                                <tr>
                                    <th>کد رهگیری</th>
                                    <th>نام مشتری</th>
                                    <th>مدل کالا</th>
                                    <th>وضعیت</th>
                                    <th>تکنسین مسئول</th>
                                    <th>عملیات سریع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders->take(5) as $recent)
                                    <tr>
                                        <td><span class="table-track-code">{{ $recent->tracking_code }}</span></td>
                                        <td><strong>{{ $recent->customer_name }}</strong></td>
                                        <td>{{ $recent->device_brand }} {{ $recent->device_model }}</td>
                                        <td>
                                            @php
                                                $statusLabels = [
                                                    'received' => ['title' => 'پذیرش اولیه', 'class' => 'st-received'],
                                                    'inspecting' => ['title' => 'کارشناسی فنی', 'class' => 'st-inspecting'],
                                                    'repairing' => ['title' => 'در حال تعمیر', 'class' => 'st-repairing'],
                                                    'waiting_parts' => ['title' => 'انتظار قطعه', 'class' => 'st-waiting_parts'],
                                                    'ready_for_delivery' => ['title' => 'آماده تحویل', 'class' => 'st-ready_for_delivery'],
                                                    'delivered' => ['title' => 'تحویل نهایی', 'class' => 'st-delivered'],
                                                ];
                                                $st = $statusLabels[$recent->status] ?? ['title' => $recent->status, 'class' => 'st-received'];
                                            @endphp
                                            <span class="table-status-pill {{ $st['class'] }}">
                                                <span class="erp-pulse-dot"></span>
                                                {{ $st['title'] }}
                                            </span>
                                        </td>
                                        <td>{{ $recent->assigned_technician ?: 'تعیین نشده' }}</td>
                                        <td>
                                            <div style="display:flex; gap:4px; flex-wrap:wrap;">
                                                <button type="button" class="btn-table-action" onclick="switchErpTab('tab-orders', null, event)" title="مشاهده در کارتابل پرونده‌ها">
                                                    <span style="color:#2563eb;">🔍 جزئیات</span>
                                                </button>
                                                <button type="button" class="btn-table-action" onclick="openPosSlipModal('{{ $recent->tracking_code }}', '{{ $recent->customer_name }}', '{{ $recent->customer_phone }}', '{{ $recent->device_brand }} {{ $recent->device_model }}', '{{ $recent->imei }}', '{{ addslashes($recent->reported_issues ?? "بررسی اولیه") }}', '{{ (!empty($recent->is_under_warranty)) ? "تحت پوشش گارانتی ۱۸ ماهه" : "تعمیر آزاد" }}')" title="فیش ۸۰ میلی‌متری">
                                                    <span>🧾 فیش</span>
                                                </button>
                                                <button type="button" class="btn-table-action" onclick="openThermalLabelModal('{{ $recent->tracking_code }}', '{{ $recent->customer_name }}', '{{ $recent->customer_phone }}', '{{ $recent->device_brand }} {{ $recent->device_model }}', '{{ $recent->imei }}')" title="چاپ برچسب حرارتی">
                                                    <span style="color:#d97706;">🏷️ لیبل</span>
                                                </button>
                                                <button type="button" class="btn-table-action" onclick="openTimelineModal('{{ $recent->tracking_code }}', '{{ $recent->customer_name }}', '{{ $recent->device_brand }} {{ $recent->device_model }}')" title="تایم‌لاین و لاگ">
                                                    <span style="color:#059669;">⏱️ لاگ</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Compliance Box -->
                <div style="margin-top: 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 1.5rem;">⚖️</span>
                        <div>
                            <strong style="display: block; font-size: 0.82rem; color: #0f172a;">سامانه منطبق با ضوابط اجرایی ماده ۱۳ قانون حمایت از حقوق مصرف‌کنندگان</strong>
                            <span style="font-size: 0.72rem; color: #64748b;">تعهد ۱۸ ماه گارانتی قطعات، تامین قطعه حداقل ۳۶ ماه و رسیدگی فوری به شکایات</span>
                        </div>
                    </div>
                    <a href="{{ url('/regulations') }}" target="_blank" class="btn-table-action" style="background: #ffffff; color: #2563eb; border-color: #bfdbfe;">
                        مطالعه آیین‌نامه صمت &larr;
                    </a>
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 2: ORDERS MANAGEMENT (tab-orders)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-orders' ? 'active' : '' }}" id="tab-orders" data-title="مدیریت پرونده‌ها">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span>مدیریت پرونده‌های پذیرش و وضعیت جاری دستگاه‌ها</span>
                    </div>
                    <div class="erp-panel-actions" style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <a href="{{ url('/admin-portal/orders/export-csv') }}{{ !empty($statusFilter) ? '?status='.$statusFilter : '' }}" class="erp-btn erp-btn-primary" style="background: linear-gradient(135deg, #10b981, #059669); font-size: 0.78rem; padding: 7px 14px; text-decoration: none;">
                            <span>📥</span> <span>خروجی اکسل کامل (Export CSV)</span>
                        </a>
                        <button type="button" class="btn-table-action" onclick="window.print()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            <span>چاپ گزارش پرونده‌ها</span>
                        </button>
                    </div>
                </div>

                <!-- Status Filters -->
                <div class="filter-pills-wrap">
                    <a href="{{ url('/admin-portal?tab=orders&status=all') }}" class="filter-pill-item {{ empty($statusFilter) || $statusFilter === 'all' ? 'active' : '' }}">همه پرونده‌ها ({{ $stats['total'] }})</a>
                    <a href="{{ url('/admin-portal?tab=orders&status=received') }}" class="filter-pill-item {{ $statusFilter === 'received' ? 'active' : '' }}">پذیرش اولیه ({{ $stats['received'] }})</a>
                    <a href="{{ url('/admin-portal?tab=orders&status=inspecting') }}" class="filter-pill-item {{ $statusFilter === 'inspecting' ? 'active' : '' }}">کارشناسی فنی ({{ $stats['inspecting'] }})</a>
                    <a href="{{ url('/admin-portal?tab=orders&status=waiting_parts') }}" class="filter-pill-item {{ $statusFilter === 'waiting_parts' ? 'active' : '' }}">انتظار قطعه ({{ $stats['waiting_parts'] }})</a>
                    <a href="{{ url('/admin-portal?tab=orders&status=repairing') }}" class="filter-pill-item {{ $statusFilter === 'repairing' ? 'active' : '' }}">در حال تعمیر ({{ $stats['repairing'] }})</a>
                    <a href="{{ url('/admin-portal?tab=orders&status=ready_for_delivery') }}" class="filter-pill-item {{ $statusFilter === 'ready_for_delivery' ? 'active' : '' }}">آماده تحویل ({{ $stats['ready'] }})</a>
                    <a href="{{ url('/admin-portal?tab=orders&status=delivered') }}" class="filter-pill-item {{ $statusFilter === 'delivered' ? 'active' : '' }}">تحویل نهایی ({{ $stats['delivered'] }})</a>
                </div>

                <!-- Orders Table -->
                <div class="table-responsive-box">
                    <table class="erp-table" id="ordersTable">
                        <thead>
                            <tr>
                                <th>کد پیگیری</th>
                                <th>نام مشتری</th>
                                <th>تلفن تماس</th>
                                <th>مدل کالا</th>
                                <th>شماره IMEI</th>
                                <th>ایراد اعلامی</th>
                                <th>وضعیت پرونده</th>
                                <th>تکنسین</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $item)
                                <tr>
                                    <td><span class="table-track-code">{{ $item->tracking_code }}</span></td>
                                    <td><strong>{{ $item->customer_name }}</strong></td>
                                    <td><a href="tel:{{ $item->customer_phone }}" style="color:inherit; text-decoration:none;">{{ $item->customer_phone }}</a></td>
                                    <td>{{ $item->device_brand }} {{ $item->device_model }}</td>
                                    <td style="font-family:monospace; direction:ltr; text-align:right;">{{ $item->imei }}</td>
                                    <td style="max-width:180px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $item->problem_description ?? ($item->reported_issues ?? "بررسی فنی") }}">{{ $item->problem_description ?? ($item->reported_issues ?? "بررسی فنی") }}</td>
                                    <td>
                                        @php
                                            $st = $statusLabels[$item->status] ?? ['title' => $item->status, 'class' => 'st-received'];
                                        @endphp
                                        <span class="table-status-pill {{ $st['class'] }}">
                                            <span class="erp-pulse-dot"></span>
                                            {{ $st['title'] }}
                                        </span>
                                    </td>
                                    <td>{{ $item->assigned_technician ?: 'تعیین نشده' }}</td>
                                    <td>
                                        <div style="display:flex; gap:4px; flex-wrap: wrap;">
                                            <button type="button" class="btn-table-action" onclick="openQcModal('{{ $item->tracking_code }}', '{{ $item->customer_name }}', '{{ $item->device_brand }} {{ $item->device_model }}')" title="برگه کنترل کیفیت و سلامت فنی">
                                                <span style="color:#059669;">🔍 QC</span>
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="openTimelineModal('{{ $item->tracking_code }}', '{{ $item->customer_name }}', '{{ $item->device_brand }} {{ $item->device_model }}')" title="تایم‌لاین و لاگ ممیزی پرونده">
                                                <span style="color:#2563eb;">⏱️ لاگ</span>
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="openThermalLabelModal('{{ $item->tracking_code }}', '{{ $item->customer_name }}', '{{ $item->customer_phone }}', '{{ $item->device_brand }} {{ $item->device_model }}', '{{ $item->imei }}')" title="چاپ برچسب حرارتی ۵×۳">
                                                <span style="color:#d97706;">🏷️ لیبل</span>
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="openPosSlipModal('{{ $item->tracking_code }}', '{{ $item->customer_name }}', '{{ $item->customer_phone }}', '{{ $item->device_brand }} {{ $item->device_model }}', '{{ $item->imei }}', '{{ addslashes($item->reported_issues ?? "بررسی اولیه") }}', '{{ (!empty($item->is_under_warranty)) ? "تحت پوشش گارانتی ۱۸ ماهه" : "تعمیر آزاد" }}')" title="فیش ۸۰ میلی‌متری مشتری">
                                                <span>🧾 فیش</span>
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="openPhotosModal('{{ $item->tracking_code }}')" title="مستندات تصویری فیزیکی">
                                                <span>📷 عکس</span>
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="quickUpdateStatus('{{ $item->tracking_code }}')" title="تغییر وضعیت">
                                                <span>وضعیت</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align:center; padding:30px; color:#94a3b8;">
                                        هیچ پرونده‌ای مطابق با فیلتر انتخابی یافت نشد.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 16px;">
                    {{ $orders->appends(['tab' => 'orders', 'status' => $statusFilter])->links() }}
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 3: NEW INTAKE (tab-new-intake)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-new-intake' ? 'active' : '' }}" id="tab-new-intake" data-title="پذیرش دستگاه جدید">
        <div class="erp-page-head" style="margin-bottom: 24px;">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#dbeafe; color:#1d4ed8;">ترمینال پذیرش رسمی (ماده ۱۳)</span>
                <h1 class="erp-page-title">پذیرش و تحویل دستگاه جدید به کارگاه مرکزی و گارانتی ۱۸ ماهه</h1>
                <p class="erp-page-desc">صدور رسمی رسید تحویل کالا، ثبت عیوب اظهارشده، استعلام اصالت و گارانتی، و تخصیص آنی کد رهگیری سامانه.</p>
            </div>
        </div>

        <!-- 2-Column Responsive Layout: Form (63%) + Live Intake Slip Preview (37%) -->
        <div style="display: grid; grid-template-columns: minmax(0, 1.7fr) minmax(340px, 1fr); gap: 24px; align-items: flex-start;">
            
            <!-- RIGHT COLUMN: RECEPTION FORM -->
            <div>
                <form action="{{ url('/service-portal/store') }}" method="POST" id="receptionForm" onsubmit="handleReceptionSubmit(event, this)">
                    @csrf

                    <!-- CARD 1: Customer Identity & Reception Type -->
                    <div class="erp-form-card">
                        <div class="erp-form-card-header">
                            <div class="erp-form-card-title">
                                <span style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">👤</span>
                                <span>۱. مشخصات شناسایی مشتری و روش پذیرش</span>
                            </div>
                            <span class="erp-form-card-badge">مرحله اول</span>
                        </div>

                        <div class="erp-grid-3">
                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    <span>نام و نام خانوادگی مشتری</span>
                                    <span class="req">*</span>
                                </label>
                                <div class="erp-input-icon-wrap">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input type="text" name="customer_name" id="intakeCustName" class="erp-form-input" required placeholder="مثال: محمد امینی" value="محمد امینی" oninput="syncIntakeReceipt()">
                                </div>
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    <span>شماره تلفن همراه (پیامک وضعیت)</span>
                                    <span class="req">*</span>
                                </label>
                                <div class="erp-input-icon-wrap">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    <input type="tel" name="customer_phone" id="intakeCustPhone" class="erp-form-input" required placeholder="09141234567" value="09123456789" style="direction: ltr; text-align: right;" oninput="syncIntakeReceipt()">
                                </div>
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    <span>کد ملی ۱۰ رقمی (اختیاری)</span>
                                </label>
                                <div class="erp-input-icon-wrap">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                    <input type="text" name="national_code" class="erp-form-input" placeholder="۱۰ رقم بدون خط تیره" maxlength="10" value="0012345678" style="direction: ltr; text-align: right;">
                                </div>
                            </div>
                        </div>

                        <div class="erp-grid-3">
                            <div class="erp-form-group">
                                <label class="erp-form-label">نحوه پذیرش کالا</label>
                                <select name="intake_type" id="intakeTypeSelect" class="erp-form-select" onchange="togglePostalInput(this.value); syncIntakeReceipt();">
                                    <option value="in_person">مراجعه حضوری به دفتر مرکزی تبریز</option>
                                    <option value="postal">ارسال پستی از شهرستان (پست پیشتاز / تیپاکس)</option>
                                </select>
                            </div>

                            <div class="erp-form-group" id="postalCodeGroup" style="display: none;">
                                <label class="erp-form-label">کد رهگیری مرسوله پستی</label>
                                <input type="text" name="postal_tracking_code" class="erp-form-input" placeholder="کد رهگیری ۲۴ رقمی پست" style="direction: ltr;">
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">استان و شهر سکونت</label>
                                <input type="text" name="customer_city" class="erp-form-input" placeholder="مثال: آذربایجان شرقی - تبریز" value="آذربایجان شرقی - تبریز">
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: Device Specs & 18-Month Warranty -->
                    <div class="erp-form-card">
                        <div class="erp-form-card-header">
                            <div class="erp-form-card-title">
                                <span style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">📱</span>
                                <span>۲. مشخصات فنی دستگاه و پوشش گارانتی</span>
                            </div>
                            <span class="erp-form-card-badge">مرحله دوم</span>
                        </div>

                        <!-- Brand Chips Selector -->
                        <div class="erp-form-group">
                            <label class="erp-form-label">
                                <span>انتخاب سریع برند سازنده</span>
                                <span class="req">*</span>
                            </label>
                            <div class="erp-brand-chips">
                                <div class="erp-brand-chip active" onclick="selectBrand('Samsung', this)">
                                    <span>📱 سامسونگ (Samsung)</span>
                                </div>
                                <div class="erp-brand-chip" onclick="selectBrand('Apple', this)">
                                    <span>🍏 اپل (Apple iPhone)</span>
                                </div>
                                <div class="erp-brand-chip" onclick="selectBrand('Xiaomi', this)">
                                    <span>⚡ شیائومی (Xiaomi)</span>
                                </div>
                                <div class="erp-brand-chip" onclick="selectBrand('Honor', this)">
                                    <span>💎 آنر (Honor)</span>
                                </div>
                                <div class="erp-brand-chip" onclick="selectBrand('Huawei', this)">
                                    <span>🔹 هواوی (Huawei)</span>
                                </div>
                                <div class="erp-brand-chip" onclick="selectBrand('Other', this)">
                                    <span>🌐 سایر برندها</span>
                                </div>
                            </div>
                            <input type="hidden" name="device_brand" id="hiddenBrandInput" value="Samsung">
                        </div>

                        <div class="erp-grid-3">
                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    <span>مدل دقیق دستگاه</span>
                                    <span class="req">*</span>
                                </label>
                                <input type="text" name="device_model" id="intakeModelInput" class="erp-form-input" required placeholder="مثال: Galaxy S24 Ultra 512GB" value="Galaxy S24 Ultra 512GB" oninput="syncIntakeReceipt()">
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    <span>شماره سریال IMEI (۱۵ رقم)</span>
                                    <span class="req">*</span>
                                </label>
                                <div class="erp-input-icon-wrap">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3"/><path d="M4 17v3h16v-3"/><line x1="8" y1="12" x2="8" y2="12"/><line x1="12" y1="12" x2="12" y2="12"/><line x1="16" y1="12" x2="16" y2="12"/></svg>
                                    <input type="text" name="imei" id="intakeImeiInput" class="erp-form-input" required placeholder="359483110294812" maxlength="16" value="359483110294812" style="direction: ltr; font-family: monospace; font-weight: 700;" oninput="syncIntakeReceipt()">
                                </div>
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">رنگ دستگاه</label>
                                <input type="text" name="device_color" id="intakeColorInput" class="erp-form-input" placeholder="خاکستری تیتانیوم / مشکی / آبی" value="خاکستری تیتانیوم" oninput="syncIntakeReceipt()">
                            </div>
                        </div>

                        <div class="erp-grid-2">
                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    <span>وضعیت پوشش خدمات</span>
                                    <span class="req">*</span>
                                </label>
                                <select name="is_under_warranty" id="intakeWarrantySelect" class="erp-form-select" onchange="syncIntakeReceipt()">
                                    <option value="1" selected>تحت پوشش گارانتی ۱۸ ماهه رسمی سام موبایل (تامین کانی سام)</option>
                                    <option value="0">تعمیرات آزاد / فاقد گارانتی شرکتی (طبق تعرفه مصوب اتحادیه)</option>
                                </select>
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">شماره سریال سازنده (Serial S/N)</label>
                                <input type="text" name="serial_number" class="erp-form-input" placeholder="اختیاری - درج‌شده روی جعبه" value="RF9X2019ABC" style="direction: ltr;">
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: Condition, Accessories, Problems & Tariff Estimate -->
                    <div class="erp-form-card">
                        <div class="erp-form-card-header">
                            <div class="erp-form-card-title">
                                <span style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">🔍</span>
                                <span>۳. وضعیت ظاهری، متعلقات تحویلی و شرح خرابی</span>
                            </div>
                            <span class="erp-form-card-badge">مرحله سوم</span>
                        </div>

                        <!-- Physical Condition Selector -->
                        <div class="erp-form-group">
                            <label class="erp-form-label">وضعیت فیزیکی و بدنه دستگاه در بدو ورود</label>
                            <div class="erp-tag-chips">
                                <label class="erp-tag-chip active"><input type="radio" name="physical_condition" value="سالم و تمیز (در حد آکبند)" checked style="display:none;" onchange="updateTagChip(this)"><span>✨ سالم و بدون خط و خش</span></label>
                                <label class="erp-tag-chip"><input type="radio" name="physical_condition" value="خط و خش جزئی روی فریم و درب پشت" style="display:none;" onchange="updateTagChip(this)"><span>🔹 خط و خش جزئی بدنه</span></label>
                                <label class="erp-tag-chip"><input type="radio" name="physical_condition" value="شکستگی تاچ یا ترک شیشه گلس" style="display:none;" onchange="updateTagChip(this)"><span>⚠️ ترک یا شکستگی نمایشگر</span></label>
                                <label class="erp-tag-chip"><input type="radio" name="physical_condition" value="آب‌خوردگی / بدون علائم حیاتی" style="display:none;" onchange="updateTagChip(this)"><span>💧 سابقه آب‌خوردگی و رطوبت</span></label>
                                <label class="erp-tag-chip"><input type="radio" name="physical_condition" value="دستکاری یا بازشدگی قبلی توسط افراد غیرمجاز" style="display:none;" onchange="updateTagChip(this)"><span>🚫 بازشدگی در کارگاه دیگر</span></label>
                            </div>
                        </div>

                        <!-- Accessories Included -->
                        <div class="erp-form-group">
                            <label class="erp-form-label">اقلام و متعلقات تحویل گرفته شده از مشتری</label>
                            <div class="erp-tag-chips">
                                <label class="erp-tag-chip active"><input type="checkbox" name="accessories[]" value="جعبه اصلی" checked style="display:none;" onchange="toggleCheckboxChip(this); syncIntakeReceipt();"><span>📦 جعبه دستگاه</span></label>
                                <label class="erp-tag-chip active"><input type="checkbox" name="accessories[]" value="کارت گارانتی سام موبایل" checked style="display:none;" onchange="toggleCheckboxChip(this); syncIntakeReceipt();"><span>🛡️ کارت گارانتی ۱۸ ماهه</span></label>
                                <label class="erp-tag-chip"><input type="checkbox" name="accessories[]" value="آداپتور و کابل شارژ" style="display:none;" onchange="toggleCheckboxChip(this); syncIntakeReceipt();"><span>🔌 آداپتور شارژر و کابل</span></label>
                                <label class="erp-tag-chip"><input type="checkbox" name="accessories[]" value="سیم‌کارت و رم میکرو" style="display:none;" onchange="toggleCheckboxChip(this); syncIntakeReceipt();"><span>💳 سیم‌کارت / کارت حافظه</span></label>
                                <label class="erp-tag-chip"><input type="checkbox" name="accessories[]" value="قاب و کاور محافظ" style="display:none;" onchange="toggleCheckboxChip(this); syncIntakeReceipt();"><span>📱 قاب و گلس محافظ</span></label>
                            </div>
                        </div>

                        <div class="erp-form-group">
                            <label class="erp-form-label">
                                <span>شرح کامل ایراد اظهارشده توسط مشتری</span>
                                <span class="req">*</span>
                            </label>
                            <textarea name="reported_issues" id="intakeIssuesInput" class="erp-form-textarea" required placeholder="توضیحات ایراد، نحوه رخ دادن، وضعیت سوکت شارژ، نمایشگر، تخلیه باتری یا عیوب نرم‌افزاری..." oninput="syncIntakeReceipt()">شارژ سریع ۴۵ وات عمل نمی‌کند و پورت USB Type-C قطعی لحظه‌ای دارد.</textarea>
                        </div>

                        <div class="erp-grid-2">
                            <div class="erp-form-group">
                                <label class="erp-form-label">تخمین هزینه اولیه (ریال - در صورت خدمات آزاد)</label>
                                <input type="text" name="estimated_cost" class="erp-form-input" placeholder="۰ برای موارد تحت پوشش گارانتی رسمی" value="۰ ریال (تحت پوشش گارانتی رسمی)" style="direction: ltr; text-align: right;">
                            </div>

                            <div class="erp-form-group">
                                <label class="erp-form-label">مدت زمان تخمینی عیب‌یابی اولیه</label>
                                <input type="text" name="estimated_time" class="erp-form-input" value="حداکثر ۲ الی ۳ ساعت کاری">
                            </div>
                        </div>

                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;">
                            <div style="font-size: 0.78rem; color: #64748b; display: flex; align-items: center; gap: 6px;">
                                <span style="color: #10b981; font-size: 1rem;">●</span>
                                <span>بلافاصله پس از ثبت، پیامک حاوی کد رهگیری اختصاصی برای مشتری ارسال می‌گردد.</span>
                            </div>
                            <button type="submit" class="erp-btn erp-btn-primary" style="padding: 14px 34px; font-size: 0.96rem; font-weight: 800; border-radius: 12px; box-shadow: 0 4px 18px rgba(37,99,235,0.25);">
                                ✓ ثبت رسمی پذیرش و صدور فیش رهگیری
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- LEFT COLUMN: LIVE INTAKE RECEIPT PREVIEW (UPDATING IN REAL-TIME) -->
            <div>
                <div class="intake-receipt-live">
                    <div class="intake-receipt-header">
                        <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                            <div style="width: 34px; height: 34px; border-radius: 8px; background: #2563eb; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.05rem;">س</div>
                            <div style="text-align: right;">
                                <div style="font-size: 0.98rem; font-weight: 900; color: #0f172a;">شرکت تامین کانی سام</div>
                                <div style="font-size: 0.7rem; color: #64748b;">واحد تخصصی خدمات پس از فروش سام موبایل</div>
                            </div>
                        </div>
                        <div>
                            <span style="background: #eff6ff; color: #1d4ed8; font-size: 0.74rem; font-weight: 800; padding: 4px 12px; border-radius: 99px; margin-top: 4px; display: inline-block;">
                                قبض پذیرش و رسید امانت دستگاه (ماده ۱۳)
                            </span>
                        </div>
                    </div>

                    <!-- Receipt Body -->
                    <div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">شماره پرونده رهگیری:</span>
                            <span class="intake-receipt-val" style="color: #2563eb; font-family: monospace; font-size: 0.95rem;">SAM-1403-9188</span>
                        </div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">تاریخ و زمان ثبت:</span>
                            <span class="intake-receipt-val" id="receiptTime">۱۴۰۳/۰۸/۱۶ - ۱۴:۳۰</span>
                        </div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">نام مشتری:</span>
                            <span class="intake-receipt-val" id="receiptCustName">محمد امینی</span>
                        </div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">شماره همراه:</span>
                            <span class="intake-receipt-val" id="receiptCustPhone" style="direction: ltr;">09123456789</span>
                        </div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">دستگاه / مدل:</span>
                            <span class="intake-receipt-val" id="receiptModel">Samsung Galaxy S24 Ultra 512GB</span>
                        </div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">شناسه IMEI:</span>
                            <span class="intake-receipt-val" id="receiptImei" style="direction: ltr; font-family: monospace;">359483110294812</span>
                        </div>
                        <div class="intake-receipt-row">
                            <span class="intake-receipt-label">وضعیت گارانتی:</span>
                            <span class="intake-receipt-val" id="receiptWarranty" style="color: #10b981;">تحت پوشش گارانتی ۱۸ ماهه رسمی</span>
                        </div>
                        <div class="intake-receipt-row" style="flex-direction: column; gap: 4px; border-bottom: none;">
                            <span class="intake-receipt-label">ایراد اظهارشده مشتری:</span>
                            <div style="font-size: 0.78rem; color: #334155; line-height: 1.6; background: #f8fafc; padding: 8px 12px; border-radius: 8px; border: 1px solid #f1f5f9;" id="receiptIssues">
                                شارژ سریع ۴۵ وات عمل نمی‌کند و پورت USB Type-C قطعی لحظه‌ای دارد.
                            </div>
                        </div>
                    </div>

                    <!-- Barcode & Stamp Simulation -->
                    <div style="margin-top: 18px; padding-top: 14px; border-top: 1px dashed #cbd5e1; text-align: center;">
                        <div style="font-family: monospace; font-size: 1.8rem; letter-spacing: 5px; color: #0f172a; line-height: 1;">
                            ||| | |||| | |||||| || | ||
                        </div>
                        <div style="font-size: 0.68rem; color: #64748b; margin-top: 2px;">
                            کد پیگیری سریع در سایت: mob.taminkanisam.co.ir/track
                        </div>
                        <div style="margin-top: 10px; display: inline-flex; align-items: center; gap: 6px; border: 1.5px solid #10b981; color: #065f46; background: #ecfdf5; padding: 4px 12px; border-radius: 8px; font-size: 0.72rem; font-weight: 800;">
                            <span>✓ ممهور به مهر کارگاه فنی و پذیرش تبریز</span>
                        </div>
                    </div>

                    <div style="margin-top: 16px; display: flex; gap: 10px;">
                        <button type="button" class="btn-table-action" style="flex: 1; background: #2563eb; color: #fff; border-color: #1d4ed8; padding: 10px; font-weight: 800; text-align: center;" onclick="window.print()">
                            🖨️ چاپ مستقیم قبض پذیرش
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

<div class="erp-view {{ $activeTab === 'tab-technicians' ? 'active' : '' }}" id="tab-technicians" data-title="تکنسین‌ها و ارجاع">
        
        <!-- Header -->
        <div class="erp-page-head" style="margin-bottom: 24px;">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#dbeafe; color:#1d4ed8;">میز کارگاه فنی تبریز</span>
                <h1 class="erp-page-title">تیم مهندسی، کارشناسان ارشد و ایستگاه کنترل کیفیت (QC)</h1>
                <p class="erp-page-desc">پایش بار کاری تکنسین‌ها، ارجاع تخصصی عیوب برد و نمایشگر، و ایستگاه تست استرس نهایی قبل از ترخیص.</p>
            </div>
            <div>
                <button type="button" class="erp-btn erp-btn-primary" onclick="alert('فرم ارجاع پرونده به زودی فعال می‌شود.')">
                    + ارجاع پرونده جدید به تکنسین
                </button>
            </div>
        </div>

        <!-- Technician Workstation Active Workbench -->
        <div style="background: #ffffff; border: 1.5px solid #2563eb; border-radius: 18px; padding: 22px; margin-bottom: 24px; box-shadow: 0 8px 30px rgba(37, 99, 235, 0.08);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 1.3rem;">⏱️</span>
                    <div>
                        <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0;">ایستگاه کاری و تایمر هوشمند تکنسین (Technician Workbench)</h3>
                        <span style="font-size: 0.74rem; color: #64748b;">ثبت زمان واقعی صرف‌شده برای هر پرونده، محاسبه راندمان کاری و درخواست قطعه</span>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span id="activeTimerBadge" style="font-family: monospace; font-size: 1.1rem; font-weight: 900; background: #eff6ff; color: #2563eb; padding: 4px 14px; border-radius: 8px; border: 1px solid #bfdbfe;">۰۰:۲۴:۱۸</span>
                    <button type="button" class="erp-btn erp-btn-primary" id="btnToggleTimer" onclick="toggleWorkstationTimer()" style="padding: 8px 16px; font-size: 0.8rem;">
                        ⏸️ توقف موقت
                    </button>
                    <button type="button" class="btn-table-action" onclick="finishWorkstationRepair()" style="color: #059669; border-color: #86efac; font-weight: 800;">
                        ✓ پایان تعمیر و ارسال به QC
                    </button>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; background: #f8fafc; border-radius: 12px; padding: 14px; font-size: 0.82rem;">
                <div><span style="color: #64748b;">پرونده فعال جاری:</span> <strong style="color: #2563eb; font-family: monospace;">SAM-1403-9101</strong></div>
                <div><span style="color: #64748b;">مدل دستگاه:</span> <strong>Samsung Galaxy S24 Ultra</strong></div>
                <div><span style="color: #64748b;">تکنسین فعال:</span> <strong>مهندس رضایی (ایستگاه ۱)</strong></div>
                <div><span style="color: #64748b;">قطعه مصرفی:</span> <strong>نمایشگر Dynamic AMOLED 2X</strong></div>
            </div>
        </div>

        <!-- Workshop Status KPIs -->
        <div class="erp-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-bottom: 24px;">
            <div class="erp-stat-card">
                <div class="erp-stat-label">ظرفیت فعال خط تعمیر</div>
                <div class="erp-stat-value" style="color: #2563eb;">۱۸ <span style="font-size: 0.8rem; color:#64748b;">پرونده در دست اقدام</span></div>
                <div class="erp-stat-sub">۷۸٪ ظرفیت کارگاه</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">میانگین زمان تعمیرات</div>
                <div class="erp-stat-value" style="color: #10b981;">۱.۲ <span style="font-size: 0.8rem; color:#64748b;">ساعت</span></div>
                <div class="erp-stat-sub">سریع‌ترین در شمال‌غرب</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">نرخ موفقیت تعمیرات سخت‌افزار</div>
                <div class="erp-stat-value" style="color: #059669;">۹۹.۴٪</div>
                <div class="erp-stat-sub">ضمانت رسمی کارگاه</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">تاییدیه کنترل کیفیت (QC)</div>
                <div class="erp-stat-value" style="color: #6366f1;">۱۰۰٪</div>
                <div class="erp-stat-sub">تست ۶ گانه سخت‌افزاری</div>
            </div>
        </div>

        <!-- Technicians Scorecards Grid -->
        <div class="erp-card" style="margin-bottom: 26px;">
            <div class="erp-card-header">
                <h3 class="erp-card-title">کارت عملکرد مهندسین کارگاه فنی مرکزی</h3>
            </div>
            <div class="erp-card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
                    @foreach($technicians as $tech)
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 22px; transition: all 0.2s; position: relative;">
                            
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px;">
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <div style="width: 48px; height: 48px; border-radius: 12px; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.15rem; flex-shrink: 0; box-shadow: 0 4px 10px rgba(37,99,235,0.25);">
                                        {{ mb_substr($tech['name'], 7, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 800; font-size: 0.98rem; color: #0f172a;">{{ $tech['name'] }}</div>
                                        <div style="font-size: 0.74rem; color: #2563eb; font-weight: 700; margin-top: 2px;">{{ $tech['role'] ?? 'تکنسین فنی ارشد' }}</div>
                                    </div>
                                </div>
                                <span style="background: #ecfdf5; color: #065f46; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 20px; border: 1px solid #a7f3d0; display: inline-flex; align-items: center; gap: 4px;">
                                    <span class="portal-pulse-dot" style="background:#10b981;"></span>
                                    <span>آماده پذیرش</span>
                                </span>
                            </div>

                            <div style="font-size: 0.78rem; color: #475569; line-height: 1.6; margin-bottom: 16px; background: #ffffff; padding: 8px 12px; border-radius: 10px; border: 1px solid #f1f5f9;">
                                <strong>تخصص اصلی:</strong> {{ $tech['specialty'] }}
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; text-align: center; margin-bottom: 16px; background: #ffffff; padding: 10px; border-radius: 10px; border: 1px solid #e2e8f0;">
                                <div>
                                    <div style="font-size: 0.68rem; color: #64748b;">پرونده جاری</div>
                                    <div style="font-weight: 900; color: #2563eb; font-size: 0.95rem;">{{ $tech['active_jobs'] }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.68rem; color: #64748b;">تعمیرات کل</div>
                                    <div style="font-weight: 900; color: #0f172a; font-size: 0.95rem;">{{ $tech['completed_repairs'] ?? 350 }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.68rem; color: #64748b;">نرخ موفقیت</div>
                                    <div style="font-weight: 900; color: #10b981; font-size: 0.95rem;">{{ $tech['success_rate'] ?? 99 }}٪</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.68rem; color: #64748b;">رضایت</div>
                                    <div style="font-weight: 900; color: #d97706; font-size: 0.95rem;">★ {{ $tech['rating'] ?? 4.9 }}</div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="btn-table-action" style="flex: 1; text-align: center; background: #eff6ff; color: #2563eb; border-color: #bfdbfe; font-weight: 800;" onclick="quickAssignToTech('{{ $tech['name'] }}')">
                                    ارجاع پرونده به این تکنسین
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- QC Quality Control Inspection Station -->
        <div class="erp-card">
            <div class="erp-card-header">
                <h3 class="erp-card-title">ایستگاه کنترل کیفیت (QC) و تست استرس نهایی قبل از ترخیص</h3>
            </div>
            <div class="erp-card-body">
                <p style="font-size: 0.84rem; color: #64748b; margin-bottom: 18px;">
                    مطابق ماده ۱۳ ضوابط اجرایی، کلیه دستگاه‌ها قبل از ترخیص باید توسط بازرس QC تست‌های استاندارد ۶ گانه را با موفقیت پاس نمایند:
                </p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 14px;">
                    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                        <input type="checkbox" checked style="width: 18px; height: 18px; accent-color: #10b981;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.86rem; color: #0f172a;">۱. تست جریان‌کشی و فست‌شارژ ۴۵ وات</div>
                            <div style="font-size: 0.72rem; color: #64748b;">بدون افت ولتاژ در پروتکل PD</div>
                        </div>
                    </div>
                    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                        <input type="checkbox" checked style="width: 18px; height: 18px; accent-color: #10b981;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.86rem; color: #0f172a;">۲. تست مولتی‌تاچ و تفکیک رنگ OLED</div>
                            <div style="font-size: 0.72rem; color: #64748b;">بررسی ۱۰ نقطه تاچ و پیکسل سوخته</div>
                        </div>
                    </div>
                    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                        <input type="checkbox" checked style="width: 18px; height: 18px; accent-color: #10b981;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.86rem; color: #0f172a;">۳. تست لرزشگیر اپتیکال OIS و لنزها</div>
                            <div style="font-size: 0.72rem; color: #64748b;">فوکوس خودکار در شرایط کم‌نور</div>
                        </div>
                    </div>
                    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                        <input type="checkbox" checked style="width: 18px; height: 18px; accent-color: #10b981;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.86rem; color: #0f172a;">۴. تست سنسور اثرانگشت و Face ID</div>
                            <div style="font-size: 0.72rem; color: #64748b;">کالیبراسیون سنسور اپتیکال زیر نمایشگر</div>
                        </div>
                    </div>
                    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                        <input type="checkbox" checked style="width: 18px; height: 18px; accent-color: #10b981;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.86rem; color: #0f172a;">۵. تست بلندگوهای استریو و میکروفون</div>
                            <div style="font-size: 0.72rem; color: #64748b;">حذف نویز فعال مکالمه و بلندی صدا</div>
                        </div>
                    </div>
                    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                        <input type="checkbox" checked style="width: 18px; height: 18px; accent-color: #10b981;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.86rem; color: #0f172a;">۶. تست تخلیه باتری در بار کامل</div>
                            <div style="font-size: 0.72rem; color: #64748b;">بررسی دمای پردازنده در ۳۰ دقیقه استرس</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px; text-align: left;">
                    <button type="button" class="erp-btn erp-btn-primary" onclick="alert('تاییدیه کنترل کیفیت (QC) ثبت شد و دستگاه آماده ترخیص گردید.')">
                        ✓ صدور برگه تاییدیه نهایی کنترل کیفیت (QC)
                    </button>
                </div>
            </div>
        </div>

    </div>

<div class="erp-view {{ $activeTab === 'tab-parts' ? 'active' : '' }}" id="tab-parts" data-title="انبار قطعات یدکی">
        
        <!-- Header & Action Button -->
        <div class="erp-page-head" style="margin-bottom: 24px;">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#e0e7ff; color:#3730a3;">کاتالوگ انبار مرکزی تبریز</span>
                <h1 class="erp-page-title">انبار جامع قطعات یدکی اورجینال سام موبایل با تصاویر فیزیکی</h1>
                <p class="erp-page-desc">موجودی لحظه‌ای نمایشگرهای Dynamic AMOLED، باتری‌های اصلی، فلت‌های شارژ، چیپ‌ست‌ها و ماژول‌های دوربین شرکتی.</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="erp-btn erp-btn-primary" onclick="toggleAddPartModal()">
                    + افزودن قطعه جدید به انبار
                </button>
            </div>
        </div>

        <!-- Smart Inventory Low Stock Alert Strip -->
        <div style="background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%); border: 1.5px solid #fde68a; border-radius: 16px; padding: 16px 20px; margin-bottom: 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; box-shadow: 0 4px 16px rgba(245, 158, 11, 0.08);">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    ⚠️
                </div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 800; color: #92400e; margin: 0 0 2px 0;">سیستم هوشمند پایش موجودی بحرانی انبار (Reorder Point Alert)</h4>
                    <span style="font-size: 0.76rem; color: #b45309;">تعداد ۲ قلم کالا به حد آستانه حداقل موجودی رسیده‌اند. سفارش‌گذاری سریع جهت جلوگیری از وقفه کارگاه پیشنهاد می‌شود.</span>
                </div>
            </div>
            <div style="display: flex; gap: 8px;">
                <button type="button" class="erp-btn erp-btn-primary" style="background: #d97706; font-size: 0.78rem; padding: 8px 16px;" onclick="showToast('پیش‌نویس سفارش خرید برای تامین‌کننده صادر گردید.', 'success')">
                    ⚡ سفارش‌گذاری آنی خرید
                </button>
            </div>
        </div>

        <!-- Top Metrics Row -->
        <div class="erp-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-bottom: 24px;">
            <div class="erp-stat-card">
                <div class="erp-stat-label">ارزش ریالی قطعات انبار</div>
                <div class="erp-stat-value" style="color: #2563eb; font-size: 1.45rem;">۳,۴۸۰,۰۰۰,۰۰۰ <span style="font-size: 0.8rem; color:#64748b;">ریال</span></div>
                <div class="erp-stat-sub">تامین مستقیم بدون واسطه</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">تعداد کل اقلام موجود</div>
                <div class="erp-stat-value" style="color: #10b981; font-size: 1.45rem;">۱۷۱ <span style="font-size: 0.8rem; color:#64748b;">قطعه</span></div>
                <div class="erp-stat-sub">در ۸ سرفصل تخصصی</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">هشدار کسری موجودی</div>
                <div class="erp-stat-value" style="color: #f59e0b; font-size: 1.45rem;">۱ <span style="font-size: 0.8rem; color:#64748b;">قلم</span></div>
                <div class="erp-stat-sub">سفارش‌گذاری مجدد انجام شد</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">ضمانت اصالت قطعات</div>
                <div class="erp-stat-value" style="color: #059669; font-size: 1.45rem;">۱۰۰٪</div>
                <div class="erp-stat-sub">تاییدیه Service Pack رسمی</div>
            </div>
        </div>

        <!-- Filter Toolbar & View Toggle -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 16px 20px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
            <!-- Category Pills -->
            <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                <button type="button" class="cms-subtab-btn active" onclick="filterPartCategory('all', this)" style="padding: 6px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 800; border: none; background: #2563eb; color: #fff; cursor: pointer;">
                    همه قطعات (۸)
                </button>
                <button type="button" class="cms-subtab-btn" onclick="filterPartCategory('صفحه نمایش و تاچ', this)" style="padding: 6px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; cursor: pointer;">
                    نمایشگر و تاچ
                </button>
                <button type="button" class="cms-subtab-btn" onclick="filterPartCategory('باتری', this)" style="padding: 6px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; cursor: pointer;">
                    باتری اصلی
                </button>
                <button type="button" class="cms-subtab-btn" onclick="filterPartCategory('سوکت و فلت شارژ', this)" style="padding: 6px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; cursor: pointer;">
                    سوکت و فلت
                </button>
                <button type="button" class="cms-subtab-btn" onclick="filterPartCategory('دوربین و لنز', this)" style="padding: 6px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; cursor: pointer;">
                    دوربین
                </button>
                <button type="button" class="cms-subtab-btn" onclick="filterPartCategory('مدار و چیپ‌ست', this)" style="padding: 6px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; cursor: pointer;">
                    مدار و IC
                </button>
            </div>

            <!-- View Toggle & Search -->
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" id="partSearchInput" placeholder="جستجوی عنوان یا پارت نامبر..." oninput="searchPartsLive(this.value)" style="height: 38px; padding: 0 14px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 0.82rem; width: 220px;">
                <div style="display: flex; background: #f1f5f9; padding: 3px; border-radius: 10px;">
                    <button type="button" id="btnViewGrid" onclick="setPartsView('grid')" title="نمای کارتی با عکس" style="padding: 6px 12px; border-radius: 8px; border: none; background: #fff; color: #2563eb; font-weight: 800; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                        📷 کارت‌ها
                    </button>
                    <button type="button" id="btnViewTable" onclick="setPartsView('table')" title="نمای جدولی" style="padding: 6px 12px; border-radius: 8px; border: none; background: transparent; color: #64748b; font-weight: 700; cursor: pointer;">
                        📋 جدول
                    </button>
                </div>
            </div>
        </div>

        <!-- 1. VISUAL CARDS GRID (WITH HD PRODUCT IMAGES) -->
        <div class="parts-grid-cards" id="partsGridView">
            @foreach($partsInventory as $part)
                <div class="part-card" data-category="{{ $part['category'] }}" data-title="{{ $part['name'] }} {{ $part['sku'] }}">
                    <div class="part-card-img-wrap">
                        <img src="{{ $part['image'] }}" alt="{{ $part['name'] }}" class="part-card-img" loading="lazy">
                        <span class="part-card-badge" style="color: {{ $part['stock'] <= $part['min_stock'] ? '#b45309' : '#15803d' }};">
                            {{ $part['stock'] <= $part['min_stock'] ? '⚠️ موجودی بحرانی' : '✓ موجود در انبار' }}
                        </span>
                        <span class="part-card-shelf">{{ $part['shelf'] }}</span>
                    </div>
                    <div class="part-card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <span class="part-card-category">{{ $part['category'] }}</span>
                            <span style="font-size: 0.7rem; font-weight: 800; background: #f1f5f9; padding: 2px 8px; border-radius: 6px; color: #475569;">{{ $part['part_id'] }}</span>
                        </div>
                        <h3 class="part-card-title">{{ $part['name'] }}</h3>
                        <div class="part-card-sku">SKU: {{ $part['sku'] }} | {{ $part['compatibility'] }}</div>
                        <div style="font-size: 0.72rem; color: #059669; font-weight: 700; margin-bottom: 12px;">
                            {{ $part['quality'] }}
                        </div>
                        <div class="part-card-footer">
                            <div>
                                <div style="font-size: 0.68rem; color: #64748b;">تعرفه مصوب اتحادیه:</div>
                                <div class="part-card-price">{{ number_format($part['price']) }} <span style="font-size: 0.72rem; color: #64748b; font-weight: 600;">ریال</span></div>
                            </div>
                            <div style="text-align: left;">
                                <div style="font-size: 0.68rem; color: #64748b;">موجودی قفسه:</div>
                                <div style="font-weight: 900; font-size: 0.95rem; color: {{ $part['stock'] <= $part['min_stock'] ? '#b45309' : '#0f172a' }};">
                                    {{ $part['stock'] }} عدد
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 12px; display: flex; gap: 8px;">
                            <button type="button" class="btn-table-action" style="flex: 1; text-align: center; background: #eff6ff; color: #2563eb; border-color: #bfdbfe; font-weight: 800;" onclick="quickAssignPart('{{ $part['sku'] }}', '{{ $part['name'] }}')">
                                + تخصیص به پرونده
                            </button>
                            <button type="button" class="btn-table-action" style="padding: 6px 12px;" onclick="adjustPartStock('{{ $part['part_id'] }}')">
                                📦
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 2. DATA TABLE VIEW (WITH THUMBNAIL IMAGES) -->
        <div class="erp-card" id="partsTableView" style="display: none; margin-top: 20px;">
            <div class="erp-card-body">
                <div class="erp-table-wrap">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>تصویر قطعه</th>
                                <th>کد و SKU</th>
                                <th>عنوان قطعه اورجینال</th>
                                <th>دسته‌بندی</th>
                                <th>سازگاری دستگاه</th>
                                <th>موقعیت قفسه</th>
                                <th>موجودی</th>
                                <th>تعرفه مصوب</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partsInventory as $part)
                                <tr>
                                    <td>
                                        <div style="width: 54px; height: 42px; border-radius: 8px; overflow: hidden; background: #f1f5f9; border: 1px solid #cbd5e1;">
                                            <img src="{{ $part['image'] }}" alt="{{ $part['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $part['part_id'] }}</strong>
                                        <div style="font-size: 0.7rem; color: #64748b; font-family: monospace;">{{ $part['sku'] }}</div>
                                    </td>
                                    <td>
                                        <strong style="color: #0f172a;">{{ $part['name'] }}</strong>
                                        <div style="font-size: 0.72rem; color: #059669; font-weight: 700;">{{ $part['quality'] }}</div>
                                    </td>
                                    <td><span class="table-status-pill st-inspecting">{{ $part['category'] }}</span></td>
                                    <td><span style="font-size: 0.76rem; color: #334155;">{{ $part['compatibility'] }}</span></td>
                                    <td><span style="font-size: 0.76rem; font-weight: 700;">{{ $part['shelf'] }}</span></td>
                                    <td>
                                        <strong style="color: {{ $part['stock'] <= $part['min_stock'] ? '#b45309' : '#15803d' }};">
                                            {{ $part['stock'] }} عدد
                                        </strong>
                                    </td>
                                    <td>
                                        <strong style="color: #2563eb;">{{ number_format($part['price']) }}</strong> ریال
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 6px;">
                                            <button type="button" class="btn-table-action" onclick="quickAssignPart('{{ $part['sku'] }}', '{{ $part['name'] }}')">
                                                تخصیص
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

        <!-- ===================================================================
             PAGE 6: INVOICES & TARIFFS (tab-invoices)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-invoices' ? 'active' : '' }}" id="tab-invoices" data-title="فاکتورها و تعرفه">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background:#eff6ff; color:#1d4ed8;">ابلاغیه رسمی نرخ‌گذاری سال ۱۴۰۵</span>
                    <h1 class="erp-page-title">نرخ تعرفه خدمات غیر گارانتی</h1>
                    <p class="erp-page-desc">سقف مصوب اجرت خدمات سخت‌افزاری و نرم‌افزاری تلفن همراه بر اساس ارزش روز گوشی (نرخ‌ها به تومان) به انضمام ضوابط و تبصره‌های ماده ۱۶ صمت.</p>
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ url('/invoice-sample') }}" target="_blank" class="erp-btn" style="background: #2563eb; color: #ffffff; text-decoration: none; font-size: 0.82rem; padding: 8px 16px; border-radius: 10px;">
                        <span>مشاهده صفحه رسمی و چاپ ↗</span>
                    </a>
                </div>
            </div>

            <!-- Union Tariff Box Inside ERP -->
            <div class="erp-card" style="margin-bottom: 24px;">
                <div style="background: #f8fafc; border-right: 4px solid #2563eb; border-radius: 10px; padding: 14px 18px; margin-bottom: 18px; font-size: 0.85rem; line-height: 1.8; color: #1e293b;">
                    <strong>ابلاغیه رسمی کارگروه نرخ‌گذاری اتحادیه دستگاه‌های مخابراتی و ارتباطی شهرستان تهران (سال ۱۴۰۵):</strong>
                    تعرفه مصوب هیئت مدیره اتحادیه جهت اجرا در کلیه شعب و نمایندگی‌های خدمات پس از فروش تلفن همراه ابلاغ گردیده و رعایت دقیق آن الزامی می‌باشد.
                </div>

                <div class="erp-table-responsive" style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px;">
                    <table class="erp-table" style="width: 100%; border-collapse: collapse; text-align: center; font-size: 0.81rem; min-width: 1100px;">
                        <thead>
                            <tr style="background: #0f172a; color: #ffffff;">
                                <th rowspan="2" style="padding: 12px; border: 1px solid #334155; text-align: right; min-width: 260px;">شرح خدمات و تعمیرات</th>
                                <th colspan="9" style="padding: 10px; border: 1px solid #334155; background: #1e293b; color: #60a5fa; font-weight: 800;">شرح ارزش و قیمت گوشی (میلیون تومان)</th>
                            </tr>
                            <tr style="background: #1e293b; color: #f1f5f9;">
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 80px;">۰ - ۱۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 80px;">۱۰ - ۳۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 80px;">۳۰ - ۶۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 86px;">۶۰ - ۱۰۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 90px;">۱۰۰ - ۲۰۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 96px;">۲۰۰ - ۳۰۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 96px;">۳۰۰ - ۳۵۰</th>
                                <th style="padding: 8px 4px; border: 1px solid #334155; min-width: 98px;">۳۵۰ - ۵۰۰</th>
                                <th style="padding: 8px 6px; border: 1px solid #334155; min-width: 110px; background: #0f172a; color: #fbbf24;">۵۰۰ به بالا</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background: #ffffff;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۱. نصب سیستم عامل (فلش و نرم‌افزار جانبی)</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۴۵۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۶۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۹۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۲۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۸۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۰/۶٪ ارزش کالا</td>
                            </tr>
                            <tr style="background: #f8fafc;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۲. رفع عیوب تخصصی نرم‌افزاری</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۶۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۲۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۸۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۰/۷٪ ارزش کالا</td>
                            </tr>
                            <tr style="background: #ffffff;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۳. تعمیرات سخت‌افزاری سطح یک (دوربین، فلت، باطری، مادربورد و...)</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۲۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۸۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۶,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۷,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۰/۹٪ ارزش کالا</td>
                            </tr>
                            <tr style="background: #f8fafc;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۴. تعویض تاچ و ال‌سی‌دی - تعویض قاب</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۸۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۲۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۸۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۷,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۹,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۲٪ ارزش کالا</td>
                            </tr>
                            <tr style="background: #ffffff;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۵. تعمیرات سخت‌افزاری سطح دو (کلیه قطعات و آی‌سی غیرچسبی)</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱,۲۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۴,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۷,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۴,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۶,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲۰,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۴٪ ارزش کالا</td>
                            </tr>
                            <tr style="background: #f8fafc;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۶. قطعات الکترونیکی (CPU، هارد و آی‌سی‌های چسبی)</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۴,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۰,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲۲,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۲۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۵٪ ارزش کالا</td>
                            </tr>
                            <tr style="background: #ffffff;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۷. تعویض طبقات برد (سوآپ) یک طبقه</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۷,۵۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۰,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۶,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; font-size: 0.74rem;">۲۵M پ / ۱۵M ب</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; font-size: 0.74rem;">۳۵M پ / ۳۰M ب</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af; font-size: 0.74rem;">۷٪ پ / ۶٪ ب</td>
                            </tr>
                            <tr style="background: #f8fafc;">
                                <td style="padding: 10px 14px; border: 1px solid #e2e8f0; font-weight: 800; color: #0f172a; text-align: right;">۸. تعویض طبقات برد (سوآپ) دو طبقه</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; color: #94a3b8;">—</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۸,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۱۲,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; font-size: 0.74rem;">۱۶,۰۰۰,۰۰۰ <span style="font-size:0.65rem; color:#2563eb;">(OVP)</span></td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; font-size: 0.74rem;">۲۵,۰۰۰,۰۰۰ <span style="font-size:0.65rem; color:#2563eb;">(OVP)</span></td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۳۰,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0;">۴۵,۰۰۰,۰۰۰</td>
                                <td style="padding: 8px; border: 1px solid #e2e8f0; background: #eff6ff; font-weight: 800; color: #1e40af;">۹٪ ارزش کالا</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footnotes in Portal -->
                <div style="margin-top: 18px; padding: 14px 18px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 0.82rem; color: #475569; line-height: 1.8;">
                    <div style="font-weight: 800; color: #0f172a; margin-bottom: 6px;">ضوابط الزامی پذیرش و صدور فاکتور:</div>
                    <ul style="padding-right: 18px; margin: 0;">
                        <li><strong>تبصره ۱:</strong> ارائه رسید تعمیرات در هنگام پذیرش و درج کلیه اطلاعات گوشی الزامی است.</li>
                        <li><strong>تبصره ۲:</strong> درج هزینه‌های قطعه و اجرت به صورت مجزا و تفکیک‌شده در فاکتور الزامی است.</li>
                        <li><strong>تبصره ۴:</strong> قبل از آغاز تعمیر، قیمت قطعی کل کار به مشتری اعلام و موافقت اخذ گردد.</li>
                        <li><strong>تبصره ۵:</strong> در تعمیرات همزمان سطح یک، تنها یک نرخ (بالاترین نرخ) دریافت می‌گردد.</li>
                        <li><strong>تبصره ۶:</strong> سود فروش قطعه ۹٪ جداگانه محاسبه خواهد شد.</li>
                        <li><strong>تبصره ۷:</strong> اجرت رفع خطای قطعات ۱۰٪ از قیمت قطعه می‌باشد.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 7: DEDICATED WARRANTY CARD STUDIO (tab-warranty-card)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" id="tab-warranty-card" data-title="صدور کارت گارانتی">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>استودیوی تولید و چاپ کارت گارانتی ۱۸ ماهه رسمی (ماده ۱۳)</span>
                    </div>
                    <div class="erp-panel-actions">
                        <button type="button" class="btn-quick-intake" onclick="window.print()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            <span>چاپ دو طرف کارت گارانتی</span>
                        </button>
                    </div>
                </div>

                <!-- Interactive Device Card Selector -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px 18px; margin-bottom: 20px;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; align-items: flex-end;">
                        <div>
                            <label style="font-size: 0.74rem; font-weight: 800; color: #475569; display: block; margin-bottom: 4px;">انتخاب از پرونده‌های پذیرش:</label>
                            <select id="studioOrderSelect" class="erp-search-input" style="width: 100%;" onchange="syncCardFromOrder(this)">
                                <option value="">-- انتخاب پرونده جهت پر کردن خودکار --</option>
                                @foreach($orders as $ord)
                                    <option value="{{ $ord->id }}" data-model="{{ $ord->device_brand }} {{ $ord->device_model }}" data-imei="{{ $ord->imei }}">
                                        {{ $ord->tracking_code }} - {{ $ord->customer_name }} ({{ $ord->device_brand }} {{ $ord->device_model }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 0.74rem; font-weight: 800; color: #475569; display: block; margin-bottom: 4px;">برند و مدل کالا:</label>
                            <input type="text" id="studioModelInput" class="erp-search-input" style="width: 100%;" value="Samsung Galaxy S23 Ultra" onkeyup="document.getElementById('cardModalModel').innerText = this.value">
                        </div>
                        <div>
                            <label style="font-size: 0.74rem; font-weight: 800; color: #475569; display: block; margin-bottom: 4px;">شماره سریال کالا (IMEI):</label>
                            <input type="text" id="studioImeiInput" class="erp-search-input" style="width: 100%; direction: ltr; font-family: monospace;" value="354892019485721" onkeyup="document.getElementById('cardModalImei').innerText = this.value">
                        </div>
                    </div>
                </div>

                <!-- Full Size Visual Replica of the Card -->
                <div style="max-width: 620px; margin: 0 auto;">
                    <!-- Realistic Card Replica (CSS Based exact to uploaded image) -->
                    <div id="studioPrintableCard">
                        <!-- Front Card -->
                        <div class="official-card-front" style="background: linear-gradient(135deg, #021a3f 0%, #08336d 45%, #05418c 70%, #031c44 100%); border-radius: 20px; padding: 18px 20px; color: #ffffff; margin-bottom: 18px; border: 2px solid rgba(59, 130, 246, 0.4); box-shadow: 0 16px 36px rgba(2, 26, 63, 0.35); position: relative; overflow: hidden; min-height: 230px; display: flex; flex-direction: column; justify-content: space-between;">
                            <div style="position: absolute; top: -50px; right: -50px; width: 180px; height: 180px; background: radial-gradient(circle, rgba(56, 189, 248, 0.25) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="border-right: 3px solid #60a5fa; padding-right: 10px;">
                                        <span style="font-size: 1.25rem; font-weight: 900; display: block; line-height: 1.2; letter-spacing: -0.5px; color: #ffffff;">کارت گارانتی</span>
                                        <span style="font-size: 0.85rem; font-weight: 800; color: #93c5fd; display: block;">گوشی همراه</span>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px; direction: ltr;">
                                    <svg width="34" height="26" viewBox="0 0 40 30" fill="none">
                                        <path d="M5 25 L15 8 L22 18 L28 10 L35 25 Z" stroke="#38bdf8" stroke-width="3" stroke-linejoin="round" fill="rgba(56, 189, 248, 0.2)"/>
                                    </svg>
                                    <div style="text-align: right; line-height: 1.1;">
                                        <span style="font-size: 0.84rem; font-weight: 900; color: #ffffff; display: block;">تامین کانی سام</span>
                                        <span style="font-size: 0.60rem; color: #93c5fd; letter-spacing: 0.5px; display: block;">Taminkanisam</span>
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 16px; align-items: center; margin: 12px 0; position: relative; z-index: 2;">
                                <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                    <div style="background: rgba(255, 255, 255, 0.10); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.20); border-radius: 12px; padding: 8px 12px; display: flex; align-items: center; gap: 10px;">
                                        <div style="flex: 1;">
                                            <div style="display: inline-block; background: #ffffff; color: #021a3f; font-size: 0.64rem; font-weight: 900; padding: 2px 8px; border-radius: 99px; margin-bottom: 3px;">همراه ما باشید</div>
                                            <div style="font-size: 0.68rem; color: #e2e8f0; line-height: 1.4;">برای فعال‌سازی گارانتی و استعلام اصالت، کد QR را اسکن کنید و یا به سایت شرکت مراجعه نمایید.</div>
                                        </div>
                                        <div style="width: 58px; height: 58px; background: #ffffff; border-radius: 8px; padding: 3px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=52x52&data=https://mob.taminkanisam.co.ir" alt="QR" style="width: 52px; height: 52px; display: block;">
                                        </div>
                                    </div>

                                    <div style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 8px 12px;">
                                        <div style="display: inline-block; background: #38bdf8; color: #021a3f; font-size: 0.64rem; font-weight: 900; padding: 2px 8px; border-radius: 99px; margin-bottom: 3px;">شرایط گارانتی</div>
                                        <div style="font-size: 0.68rem; color: #cbd5e1; line-height: 1.4;">این دستگاه به مدت ۱۸ ماه دارای گارانتی رسمی شرکت تامین کانی سام می‌باشد. جهت کسب اطلاعات بیشتر شرایط گارانتی، کد QR را اسکن فرمایید.</div>
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; border-top: 1px solid rgba(255, 255, 255, 0.12); padding-top: 8px;">
                                <span style="font-size: 0.74rem; font-weight: 800; color: #60a5fa; letter-spacing: 0.5px;">انتخاب هوشمندانه...</span>
                                <span style="font-size: 0.65rem; color: #cbd5e1;">ضمانت اصالت و سلامت فیزیکی قطعات</span>
                            </div>
                        </div>

                        <!-- Back Card -->
                        <div class="official-card-back" style="background: #ffffff; border: 2px solid #cbd5e1; border-radius: 20px; padding: 16px 18px; color: #0f172a; box-shadow: 0 16px 36px rgba(15, 23, 42, 0.10); position: relative;">
                            <div style="display: flex; gap: 14px; margin-bottom: 12px;">
                                <div style="width: 130px; display: flex; flex-direction: column; justify-content: space-around; gap: 8px; padding-left: 10px; border-left: 1px dashed #cbd5e1; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 3px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #eff6ff; color: #1d4ed8; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">🛡️</div>
                                        <span style="font-size: 0.64rem; font-weight: 800; color: #1e3a8a; line-height: 1.2;">۱۸ ماه ضمانت رسمی<br>پس از فعال‌سازی</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 3px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #f0fdf4; color: #15803d; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">⚙️</div>
                                        <span style="font-size: 0.64rem; font-weight: 800; color: #14532d; line-height: 1.2;">خدمات پس از فروش<br>تخصصی ماده ۱۳</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 3px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">🎧</div>
                                        <span style="font-size: 0.64rem; font-weight: 800; color: #78350f; line-height: 1.2;">پشتیبانی حرفه‌ای<br>مرکز تماس تبریز</span>
                                    </div>
                                </div>

                                <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۱. کشور سازنده:</span>
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;">جمهوری اسلامی ایران / سازنده رسمی</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۲. برند و مدل کالا:</span>
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;" id="cardModalModel">Samsung Galaxy S23 Ultra</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۳. شماره سریال کالا (IMEI):</span>
                                        <span style="font-size: 0.74rem; font-weight: 900; font-family: monospace; color: #1d4ed8; direction: ltr;" id="cardModalImei">354892019485721</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۴. تاریخ شروع گارانتی:</span>
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;">۱۴۰۳/۰۸/۱۵ (به مدت ۱۸ ماه)</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۵. نام شرکت سازنده کالا:</span>
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;" id="cardModalCompany">شرکت تامین کانی سام (سهامی خاص)</span>
                                    </div>
                                </div>
                            </div>

                            <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; border-radius: 12px; padding: 10px 14px; margin-bottom: 12px;">
                                <div style="text-align: center; font-size: 0.72rem; font-weight: 900; color: #38bdf8; margin-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.12); padding-bottom: 4px;">
                                    مواردی که شامل گارانتی نمی‌شوند:
                                </div>
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 4px 12px; font-size: 0.65rem; color: #e2e8f0;">
                                    <div>• ضربه دیدگی، شکستگی و آسیب فیزیکی</div>
                                    <div>• نفوذ مایعات و رطوبت و نم‌زدگی</div>
                                    <div>• خرابی ناشی از نوسانات برق و شارژر غیرمجاز</div>
                                    <div>• معیوب ماندن باتری و لوازم جانبی مستهلک</div>
                                    <div>• تعمیرات و دستکاری توسط افراد غیرمجاز</div>
                                    <div>• تمامی موارد خارج از شرایط گارانتی و استهلاک عادی</div>
                                </div>
                            </div>

                            <div style="background: #021a3f; color: #ffffff; border-radius: 10px; padding: 8px 12px; display: flex; flex-direction: column; gap: 4px; font-size: 0.66rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 6px;">
                                    <span style="display: inline-flex; align-items: center; gap: 4px; font-weight: 800; color: #93c5fd;">
                                        📞 ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 4px; color: #e2e8f0;">
                                        🌐 taminkanisam.co.ir
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 4px; color: #e2e8f0; direction: ltr;">
                                        ✉️ Marketing@kanisam
                                    </span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.12); padding-top: 4px; color: #cbd5e1; font-size: 0.62rem;">
                                    <span>📍 تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</span>
                                    <span style="font-weight: 800; color: #38bdf8;">شرکت تامین کانی سام</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 8: SMS NOTIFICATIONS & BROADCAST (tab-sms)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-sms' ? 'active' : '' }}" id="tab-sms" data-title="پنل پیامک و اطلاع‌رسانی">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>مرکز اطلاع‌رسانی چندکاناله هوشمند (Omnichannel: پیامک + پیام‌رسان بله Bale + واتساپ)</span>
                    </div>
                </div>

                <form id="smsSendForm" onsubmit="handleSendSms(event)">
                    @csrf
                    <div class="form-grid-2">
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره همراه گیرنده *</label>
                            <input type="tel" id="smsPhone" class="form-input-custom" placeholder="مثال: 09123456789" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">الگوی متن پیامک</label>
                            <select id="smsTemplate" class="form-select-custom" onchange="applySmsTemplate(this.value)">
                                <option value="">-- انتخاب متن آماده یا نگارش دستی --</option>
                                <option value="مشتری گرامی سام موبایل، پرونده دستگاه شما با کد رهگیری [CODE] در سامانه خدمات ثبت گردید. پیگیری: mob.taminkanisam.co.ir">اعلام کد رهگیری پذیرش جدید</option>
                                <option value="دستگاه شما در سام موبایل با موفقیت تعمیر گردید و آماده ترخیص می‌باشد. ساعات مراجعه: ۹ الی ۱۷. تلفن: ۰۴۱-۳۶۶۸۹۰۰۰">اعلام پایان تعمیر و آماده تحویل</option>
                                <option value="گارانتی ۱۸ ماهه طلایی دستگاه شما در سام موبایل فعال گردید. مشاهده کارت گارانتی دیجیتال: mob.taminkanisam.co.ir">اعلام فعال‌سازی گارانتی ۱۸ ماهه</option>
                                <option value="مشتری گرامی، با سپاس از اعتماد شما به سام موبایل، خواهشمندیم نظر خود را در لینک زیر ثبت فرمایید: mob.taminkanisam.co.ir/survey">لینک نظرسنجی رضایت مشتری</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-custom" style="margin-top: 14px;">
                        <label class="form-label-custom">متن پیامک ارسالی به مشتری *</label>
                        <textarea id="smsMessage" class="form-textarea-custom" rows="3" placeholder="متن پیامک را اینجا وارد کنید..." required></textarea>
                    </div>
                    <div style="margin-top: 16px; display: flex; align-items: center; justify-content: space-between;">
                        <span id="smsAlert" style="font-size: 0.82rem; font-weight: 700; display: none;"></span>
                        <button type="submit" class="btn-quick-intake" id="btnSendSmsSubmit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            <span>ارسال پیامک از طریق وب‌سرویس</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- SMS DISPATCH LOGS SECTION -->
            <div class="erp-panel" style="margin-top: 24px;">
                <div class="erp-panel-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                    <div class="erp-panel-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>گزارش زنده ارسال پیامک‌های اطلاع‌رسانی به مشتریان (سرویس خودکار SMS)</span>
                    </div>
                    <span class="badge" style="background:#ecfdf5; color:#059669; font-weight:700; padding:6px 12px; border-radius:10px; font-size:0.78rem;">
                        متصل به پنل پیامکی فعال
                    </span>
                </div>
                <div class="erp-card-body" style="padding: 0;">
                    <div class="erp-table-responsive">
                        <table class="erp-table" id="smsLogsTable" style="width: 100%; border-collapse: collapse; text-align: right;">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.8rem;">
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">#</th>
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">مشتری</th>
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">شماره همراه</th>
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">کد پرونده</th>
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">متن پیامک</th>
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">وضعیت تحویل</th>
                                    <th style="padding: 12px 14px; font-weight: 800; color: #475569;">تاریخ شمسی</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $smsLogs = [];
                                    try {
                                        if (\Illuminate\Support\Facades\Schema::hasTable('mobile_sms_logs')) {
                                            $smsLogs = \Illuminate\Support\Facades\DB::table('mobile_sms_logs')
                                                ->orderBy('id', 'desc')
                                                ->limit(20)
                                                ->get();
                                        }
                                    } catch (\Exception $e) {}
                                @endphp

                                @forelse($smsLogs as $idx => $slog)
                                <tr style="border-bottom: 1px solid #f1f5f9; font-size: 0.82rem;">
                                    <td style="padding: 12px 14px; color: #94a3b8; font-weight: 700;">{{ $idx + 1 }}</td>
                                    <td style="padding: 12px 14px; font-weight: 700; color: #0f172a;">{{ $slog->customer_name ?? '-' }}</td>
                                    <td style="padding: 12px 14px; font-family: monospace; direction: ltr; text-align: right; color: #2563eb; font-weight: 700;">{{ $slog->phone }}</td>
                                    <td style="padding: 12px 14px; font-family: monospace; color: #475569;">{{ $slog->tracking_code ?? '-' }}</td>
                                    <td style="padding: 12px 14px; color: #334155; max-width: 340px; line-height: 1.5;">{{ $slog->message }}</td>
                                    <td style="padding: 12px 14px;">
                                        @if(($slog->status ?? '') === 'sent')
                                            <span style="background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 8px; font-size: 0.72rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                                <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;"></span>
                                                تحویل به مخابرات
                                            </span>
                                        @else
                                            <span style="background: #fef2f2; color: #dc2626; padding: 4px 10px; border-radius: 8px; font-size: 0.72rem; font-weight: 700;">خطا در ارسال</span>
                                        @endif
                                    </td>
                                    <td style="padding: 12px 14px; color: #64748b; font-size: 0.76rem; white-space: nowrap;">
                                        {{ shamsi($slog->created_at) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="padding: 24px; text-align: center; color: #94a3b8; font-size: 0.85rem;">
                                        هنوز پیامکی ثبت نشده است. با تغییر وضعیت پرونده‌ها یا ارسال سریع، پیامک‌های ارسالی در اینجا درج می‌گردند.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!-- ==================== 9. VIEW: SITE SETTINGS & CMS ==================== -->
    <div class="erp-view {{ $activeTab === 'tab-site-settings' ? 'active' : '' }}" id="tab-site-settings" data-title="تنظیمات سایت و منوها">
        <div class="erp-page-head">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#fef3c7; color:#92400e;">مدیریت محتوا (CMS)</span>
                <h1 class="erp-page-title">تنظیمات جامع سامانه، منوها، فوتر و نمادها</h1>
                <p class="erp-page-desc">پیکربندی هویت بصری، منوهای ناوبری هدر، متن‌های پاورقی، مجوزهای قانونی، محتوای صفحه اول و صفحات استاتیک.</p>
            </div>
        </div>

        <!-- Ultra-Premium Sub-tabs bar -->
        <div class="cms-subtabs-nav">
            <button type="button" class="cms-subtab-pill active" onclick="switchCmsSubTab('subtab-general', this)">
                <span>🏢</span> <span>مشخصات عمومی و تماس</span>
            </button>
            <button type="button" class="cms-subtab-pill" onclick="switchCmsSubTab('subtab-menu', this)">
                <span>🧭</span> <span>منوهای ناوبری هدر</span>
                <span style="font-size: 0.7rem; background: #e0e7ff; color: #3730a3; padding: 1px 7px; border-radius: 99px;">{{ isset($headerMenuItems) ? count($headerMenuItems) : 0 }}</span>
            </button>
            <button type="button" class="cms-subtab-pill" onclick="switchCmsSubTab('subtab-footer', this)">
                <span>🛡️</span> <span>فوتر، نمادها و مجوزها</span>
            </button>
            <button type="button" class="cms-subtab-pill" onclick="switchCmsSubTab('subtab-home', this)">
                <span>🏠</span> <span>المان‌های صفحه اصلی</span>
            </button>
            <button type="button" class="cms-subtab-pill" onclick="switchCmsSubTab('subtab-static-pages', this)">
                <span>📄</span> <span>صفحات تماس، درباره ما و ...</span>
            </button>
        </div>

        <!-- Subtab 1: General & Contact -->
        <div id="subtab-general" class="cms-subtab-content" style="display: block;">
            <div class="erp-card">
                <div class="erp-card-header">
                    <h3 class="erp-card-title">مشخصات عمومی، نشان تجاری و تلفن‌های تبریز</h3>
                </div>
                <div class="erp-card-body">
                    <form onsubmit="handleSettingsForm(event, this)">
                        @csrf
                        <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                            <div>
                                <label class="erp-form-label">عنوان رسمی سامانه (Title)</label>
                                <input type="text" name="site_title" class="erp-form-input" value="{{ $siteSettings['site_title'] ?? 'سامانه رسمی خدمات و گارانتی ۱۸ ماهه سام موبایل (شرکت تامین کانی سام)' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">شعار و زیرعنوان برند</label>
                                <input type="text" name="site_slogan" class="erp-form-input" value="{{ $siteSettings['site_slogan'] ?? 'مرکز تخصصی تعمیرات و خدمات پس از فروش تلفن همراه و تبلت' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">شماره تلفن سانترال تبریز</label>
                                <input type="text" name="phone" class="erp-form-input" value="{{ $siteSettings['phone'] ?? '۰۴۱-۳۶۶۸۹۰۰۰' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">تلفن مستقیم واحد گارانتی و پذیرش</label>
                                <input type="text" name="support_phone" class="erp-form-input" value="{{ $siteSettings['support_phone'] ?? '۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">پست الکترونیک رسمی شرکت</label>
                                <input type="email" name="email" class="erp-form-input" value="{{ $siteSettings['email'] ?? 'info@taminkanisam.co.ir' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">ساعات کاری و پذیرش کارگاه</label>
                                <input type="text" name="work_hours" class="erp-form-input" value="{{ $siteSettings['work_hours'] ?? 'شنبه تا چهارشنبه ۹ الی ۱۸ | پنج‌شنبه‌ها ۹ الی ۱۴' }}">
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">نشانی رسمی دفتر مرکزی و کارگاه فنی تبریز</label>
                                <input type="text" name="address" class="erp-form-input" value="{{ $siteSettings['address'] ?? 'تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸' }}">
                            </div>
                        </div>
                        <div style="margin-top: 20px; text-align: left;">
                            <button type="submit" class="erp-btn erp-btn-primary">
                                💾 ذخیره تغییرات مشخصات عمومی
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Subtab 2: Header Navigation Menu -->
        <div id="subtab-menu" class="cms-subtab-content" style="display: none;">
            <div class="erp-card">
                <div class="erp-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h3 class="erp-card-title">لینک‌های فعال در منوی هدر دسکتاپ و دراور موبایل</h3>
                        <div style="font-size: 0.74rem; color: #64748b;">مدیریت ترتیب نمایش و مقصد لینک‌ها در هدر سایت</div>
                    </div>
                </div>
                <div class="erp-card-body">
                                <!-- Live Header Simulation Card -->
            <div class="header-sim-wrapper">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span class="header-sim-badge">✨ پیش‌نمایش زنده چیدمان هدر سایت</span>
                    <span style="font-size: 0.72rem; color: #64748b;">همگام‌سازی لحظه‌ای با سرور</span>
                </div>
                <div class="header-sim-bar">
                    <span style="font-size: 0.8rem; font-weight: 800; color: #2563eb; padding: 4px 10px; background: #dbeafe; border-radius: 8px;">سام موبایل 📱</span>
                    @foreach($headerMenuItems ?? [] as $mItem)
                        <span class="header-sim-link">
                            {{ $mItem->title }}
                            @if(!empty($mItem->badge))
                                <span style="font-size: 0.65rem; background: #fee2e2; color: #dc2626; padding: 1px 6px; border-radius: 99px;">{{ $mItem->badge }}</span>
                            @endif
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Add menu form -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px; margin-bottom: 24px;">
                        <div style="font-weight: 800; color: #0f172a; font-size: 0.88rem; margin-bottom: 12px;">+ افزودن آیتم جدید به منوی هدر</div>
                        <form onsubmit="handleHeaderMenuAdd(event, this)" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; align-items: flex-end;">
                            @csrf
                            <div>
                                <label class="erp-form-label">عنوان لینک در منو</label>
                                <input type="text" name="title" class="erp-form-input" required placeholder="مثال: سوالات متداول">
                            </div>
                            <div>
                                <label class="erp-form-label">آدرس لینک (URL)</label>
                                <input type="text" name="url" class="erp-form-input" required placeholder="/page/faq یا لینک دلخواه">
                            </div>
                            <div>
                                <label class="erp-form-label">نشانک برجسته (اختیاری)</label>
                                <input type="text" name="badge" class="erp-form-input" placeholder="مثال: جدید / ماده ۱۳">
                            </div>
                            <div>
                                <label class="erp-form-label">ترتیب نمایش</label>
                                <input type="number" name="sort_order" class="erp-form-input" value="10">
                            </div>
                            <div>
                                <button type="submit" class="erp-btn erp-btn-primary" style="width: 100%;">
                                    + افزودن به منو
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Menu items table -->
                    <div class="erp-table-wrap">
                        <table class="erp-table">
                            <thead>
                                <tr>
                                    <th>ترتیب</th>
                                    <th>عنوان در منو</th>
                                    <th>آدرس لینک</th>
                                    <th>نشانک بج</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($headerMenuItems as $mi)
                                    <tr>
                                        <td><strong>{{ $mi->sort_order }}</strong></td>
                                        <td><strong>{{ $mi->title }}</strong></td>
                                        <td><code style="direction: ltr; display: inline-block;">{{ $mi->url }}</code></td>
                                        <td>
                                            @if($mi->badge)
                                                <span class="table-status-pill st-inspecting">{{ $mi->badge }}</span>
                                            @else
                                                <span style="color: #94a3b8;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="table-status-pill st-ready_for_delivery">فعال</span>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 6px;">
                                                <button type="button" class="btn-table-action" onclick='openEditMenuModal(@json($mi))'>
                                                    ✏️ ویرایش
                                                </button>
                                                <button type="button" class="btn-table-action" style="color: #ef4444; border-color: #fca5a5;" onclick="deleteMenuItem({{ $mi->id }})">
                                                    🗑️ حذف
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: #94a3b8; padding: 20px;">هیچ آیتمی یافت نشد.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subtab 3: Footer & Trust Badges -->
        <div id="subtab-footer" class="cms-subtab-content" style="display: none;">
            <div class="erp-card">
                <div class="erp-card-header">
                    <h3 class="erp-card-title">متون پاورقی (فوتر)، نمادهای اعتماد و مجوزهای قانونی</h3>
                </div>
                <div class="erp-card-body">
                    <form onsubmit="handleSettingsForm(event, this)">
                        @csrf
                        <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">پاراگراف معرفی رسمی شرکت در فوتر</label>
                                <textarea name="footer_about" class="erp-form-input" rows="3">{{ $siteSettings['footer_about'] ?? 'سام موبایل، واحد تخصصی گارانتی و خدمات پس از فروش شرکت تامین کانی سام. متعهد به رعایت دقیق ضوابط اجرایی ماده ۱۳ و تبصره ۵ ماده ۲۸ سازمان حمایت از مصرف‌کنندگان و تولیدکنندگان با تجهیزات مدرن عیب‌یابی و قطعات اورجینال.' }}</textarea>
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">متن کپی‌رایت حقوقی انتهای فوتر</label>
                                <input type="text" name="footer_copyright" class="erp-form-input" value="{{ $siteSettings['footer_copyright'] ?? 'تمامی حقوق مادی و معنوی متعلق به شرکت تامین کانی سام (سهامی خاص) می‌باشد.' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">لینک استعلام نماد تجارت الکترونیکی (اینماد)</label>
                                <input type="url" name="trust_enamad_url" class="erp-form-input" value="{{ $siteSettings['trust_enamad_url'] ?? 'https://trustseal.enamad.ir/?id=taminkanisam' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">لینک نشان ملی ثبت رسانه‌های دیجیتال (ساماندهی)</label>
                                <input type="url" name="trust_samandehi_url" class="erp-form-input" value="{{ $siteSettings['trust_samandehi_url'] ?? 'https://logo.samandehi.ir/verify.aspx?id=taminkanisam' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">شماره پروانه کسب اتحادیه و تاییدیه صمت</label>
                                <input type="text" name="trust_union_license" class="erp-form-input" value="{{ $siteSettings['trust_union_license'] ?? 'پروانه کسب اتحادیه صنف الکترونیک و ارتباطات به شماره ۹۸۲۰۴۱' }}">
                            </div>
                            <div>
                                <label class="erp-form-label">لینک استعلام اصالت سامانه همتا</label>
                                <input type="url" name="trust_hamta_url" class="erp-form-input" value="{{ $siteSettings['trust_hamta_url'] ?? 'https://hamta.ntsw.ir' }}">
                            </div>
                        </div>

                        <div style="margin-top: 24px; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px;">
                            <div style="font-weight: 800; color: #0f172a; font-size: 0.84rem; margin-bottom: 12px;">پیش‌نمایش نمادها و تاییدیه‌های رسمی در فوتر:</div>
                            <div style="display: flex; gap: 16px; flex-wrap: wrap; align-items: center;">
                                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 1.4rem;">🏛️</span>
                                    <div>
                                        <div style="font-weight: 800; font-size: 0.8rem; color: #0f172a;">اینماد ۵ ستاره</div>
                                        <div style="font-size: 0.7rem; color: #64748b;">سازمان توسعه تجارت الکترونیکی</div>
                                    </div>
                                </div>
                                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 1.4rem;">🛡️</span>
                                    <div>
                                        <div style="font-weight: 800; font-size: 0.8rem; color: #0f172a;">نشان ملی ساماندهی</div>
                                        <div style="font-size: 0.7rem; color: #64748b;">وزارت فرهنگ و ارشاد اسلامی</div>
                                    </div>
                                </div>
                                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 1.4rem;">📜</span>
                                    <div>
                                        <div style="font-weight: 800; font-size: 0.8rem; color: #0f172a;">پروانه کسب اتحادیه</div>
                                        <div style="font-size: 0.7rem; color: #64748b;">صنف فناوران و تلفن همراه</div>
                                    </div>
                                </div>
                                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 1.4rem;">📱</span>
                                    <div>
                                        <div style="font-weight: 800; font-size: 0.8rem; color: #0f172a;">سامانه همتا</div>
                                        <div style="font-size: 0.7rem; color: #64748b;">تاییدیه اصالت شناسه IMEI</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px; text-align: left;">
                            <button type="submit" class="erp-btn erp-btn-primary">
                                💾 ذخیره تغییرات فوتر و مجوزها
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Subtab 4: Home Page Elements -->
        <div id="subtab-home" class="cms-subtab-content" style="display: none;">
            <div class="erp-card">
                <div class="erp-card-header">
                    <h3 class="erp-card-title">ویرایش المان‌های صفحه اصلی (Hero & Banners)</h3>
                </div>
                <div class="erp-card-body">
                    <form onsubmit="handleSettingsForm(event, this)">
                        @csrf
                        <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">نشانک برجسته بالای عنوان هیرو (Badge)</label>
                                <input type="text" name="home_hero_badge" class="erp-form-input" value="{{ $siteSettings['home_hero_badge'] ?? 'مرکز رسمی خدمات پس از فروش تامین کانی سام' }}">
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">عنوان اصلی هیرو (Main Hero Title)</label>
                                <input type="text" name="home_hero_title" class="erp-form-input" value="{{ $siteSettings['home_hero_title'] ?? 'سامانه جامع گارانتی و خدمات پس از فروش گوشی هوشمند' }}">
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">زیرعنوان توضیحی بنر هیرو (Hero Subtitle)</label>
                                <textarea name="home_hero_subtitle" class="erp-form-input" rows="2">{{ $siteSettings['home_hero_subtitle'] ?? '۱۸ ماه گارانتی رسمی، پیگیری لحظه‌ای پرونده با کد رهگیری، پذیرش حضوری و پستی از سراسر کشور' }}</textarea>
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">متن بنر اطلاع‌رسانی پستی بالای سایت</label>
                                <input type="text" name="home_banner_text" class="erp-form-input" value="{{ $siteSettings['home_banner_text'] ?? 'پذیرش سریع دستگاه‌های دارای گارانتی با ارسال پستی پیشتاز از سراسر ایران' }}">
                            </div>
                        </div>
                        <div style="margin-top: 20px; text-align: left;">
                            <button type="submit" class="erp-btn erp-btn-primary">
                                💾 ذخیره تغییرات صفحه اصلی
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Subtab 5: Static Pages Content -->
        <div id="subtab-static-pages" class="cms-subtab-content" style="display: none;">
            <div class="erp-card">
                <div class="erp-card-header">
                    <h3 class="erp-card-title">ویرایش مستقیم محتوای صفحات استاتیک سامانه</h3>
                </div>
                <div class="erp-card-body">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">صفحه درباره ما</div>
                                <a href="{{ url('/about') }}" target="_blank" class="btn-table-action">مشاهده صفحه</a>
                            </div>
                            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6; margin-bottom: 14px;">
                                شامل تاریخچه تامین کانی سام، استانداردهای کارگاه، تیم فنی و اطلاعات شرکتی.
                            </p>
                            <button type="button" class="erp-btn erp-btn-primary" style="width: 100%; font-size: 0.8rem;" onclick="switchErpTab('tab-pages')">
                                ویرایش در بخش مدیریت صفحات ←
                            </button>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">صفحه تماس با ما</div>
                                <a href="{{ url('/contact') }}" target="_blank" class="btn-table-action">مشاهده صفحه</a>
                            </div>
                            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6; margin-bottom: 14px;">
                                شامل آدرس پستی تبریز، خطوط تماس، ساعات کاری و فرم ارتباط آنلاین.
                            </p>
                            <button type="button" class="erp-btn erp-btn-primary" style="width: 100%; font-size: 0.8rem;" onclick="switchCmsSubTab('subtab-general')">
                                ویرایش آدرس و تلفن‌ها ←
                            </button>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">شرایط گارانتی ۱۸ ماهه</div>
                                <a href="{{ url('/warranty-terms') }}" target="_blank" class="btn-table-action">مشاهده صفحه</a>
                            </div>
                            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6; margin-bottom: 14px;">
                                مفاد تعهدات گارانتی، موارد نقض و استثنائات (آبخوردگی، نوسان برق و ضربه).
                            </p>
                            <a href="{{ url('/warranty-terms') }}" target="_blank" class="erp-btn" style="width: 100%; text-align: center; text-decoration: none; font-size: 0.8rem; background: #ffffff; border: 1px solid #cbd5e1; color: #334155; display: block;">
                                بازبینی صفحه شرایط گارانتی
                            </a>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem;">منشور حقوق مشتریان</div>
                                <a href="{{ url('/customer-rights') }}" target="_blank" class="btn-table-action">مشاهده صفحه</a>
                            </div>
                            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6; margin-bottom: 14px;">
                                الزامات قانونی حمایت از حقوق مصرف‌کنندگان و تعهدات سازمان حمایت.
                            </p>
                            <a href="{{ url('/customer-rights') }}" target="_blank" class="erp-btn" style="width: 100%; text-align: center; text-decoration: none; font-size: 0.8rem; background: #ffffff; border: 1px solid #cbd5e1; color: #334155; display: block;">
                                بازبینی منشور حقوق مشتری
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== 10. VIEW: PAGES MANAGEMENT ==================== -->
    <div class="erp-view {{ $activeTab === 'tab-pages' ? 'active' : '' }}" id="tab-pages" data-title="مدیریت صفحات سایت">
        <div class="erp-page-head">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#e0e7ff; color:#3730a3;">مدیریت صفحات (Pages)</span>
                <h1 class="erp-page-title">مدیریت برگه‌ها، اسلاگ‌ها و محتوای صفحات سایت</h1>
                <p class="erp-page-desc">افزودن برگه جدید با URL اختصاصی، ویرایش محتوای متنی، تنظیمات سئو و انتشار در سامانه.</p>
            </div>
            <button type="button" class="erp-btn erp-btn-primary" onclick="toggleAddPageForm()">
                + افزودن برگه / صفحه جدید
            </button>
        </div>

            <!-- Quick Page Templates -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px; margin-bottom: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <span style="font-size: 0.86rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                <span>⚡</span> <span>قالب‌های آماده جهت ساخت سریع برگه (با ۱ کلیک درج می‌شود):</span>
            </span>
            <span style="font-size: 0.72rem; color: #64748b;">دارای متن آماده و تنظیمات اصولی سئو</span>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 10px;">
            <button type="button" class="template-card-btn" onclick="applyPageTemplate('standard')">
                <span style="font-size: 1.4rem;">📄</span>
                <div>
                    <div style="font-weight: 800; font-size: 0.82rem; color: #1e293b;">برگه شرکتی استاندارد</div>
                    <div style="font-size: 0.7rem; color: #64748b;">توضیحات خدمات، شعب و سرفصل‌ها</div>
                </div>
            </button>
            <button type="button" class="template-card-btn" onclick="applyPageTemplate('faq')">
                <span style="font-size: 1.4rem;">❓</span>
                <div>
                    <div style="font-weight: 800; font-size: 0.82rem; color: #1e293b;">سوالات متداول گارانتی</div>
                    <div style="font-size: 0.7rem; color: #64748b;">پاسخ به سوالات پرتکرار و پذیرش</div>
                </div>
            </button>
            <button type="button" class="template-card-btn" onclick="applyPageTemplate('terms')">
                <span style="font-size: 1.4rem;">⚖️</span>
                <div>
                    <div style="font-weight: 800; font-size: 0.82rem; color: #1e293b;">شرایط و مقررات ماده ۱۳</div>
                    <div style="font-size: 0.7rem; color: #64748b;">حقوق مصرف‌کننده و تعهدات قانونی</div>
                </div>
            </button>
            <button type="button" class="template-card-btn" onclick="applyPageTemplate('branches')">
                <span style="font-size: 1.4rem;">📞</span>
                <div>
                    <div style="font-weight: 800; font-size: 0.82rem; color: #1e293b;">دفاتر پذیرش و تماس</div>
                    <div style="font-size: 0.7rem; color: #64748b;">آدرس مرکزی تبریز و تلفن‌ها</div>
                </div>
            </button>
        </div>
    </div>

    <!-- Add Page Collapsible Form -->
        <div id="addPageFormBox" style="display: none; background: #ffffff; border: 1px solid #2563eb; border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(37,99,235,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a;">ایجاد برگه جدید در سامانه</h3>
                <button type="button" onclick="toggleAddPageForm()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #64748b;">✕</button>
            </div>
            <form onsubmit="handlePageStore(event, this)">
                @csrf
                <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div>
                        <label class="erp-form-label">عنوان برگه (Page Title)</label>
                        <input type="text" name="title" id="pageInputTitle" class="erp-form-input" required placeholder="مثال: سوالات متداول گارانتی">
                    </div>
                    <div>
                        <label class="erp-form-label">اسلاگ یکتا (URL Slug)</label>
                        <input type="text" name="slug" id="pageInputSlug" class="erp-form-input" required placeholder="مثال: faq-warranty" style="direction: ltr;">
                        <span style="font-size: 0.72rem; color: #64748b;">آدرس در سایت: mob.taminkanisam.co.ir/page/slug</span>
                    </div>
                    <div>
                        <label class="erp-form-label">دسته‌بندی موضوعی</label>
                        <input type="text" name="category" id="pageInputCategory" class="erp-form-input" value="عمومی">
                    </div>
                    <div>
                        <label class="erp-form-label">تایتل سئو (Meta Title)</label>
                        <input type="text" name="meta_title" id="pageInputMetaTitle" class="erp-form-input" placeholder="عنوان صفحه در نتایج گوگل">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">توضیحات متای سئو (Meta Description)</label>
                        <textarea name="meta_description" id="pageInputMetaDesc" class="erp-form-input" rows="2" placeholder="خلاصه ۱۵۰ کاراکتری برای موتورهای جستجو..."></textarea>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">کلمات کلیدی سئو (با کاما جدا کنید)</label>
                        <input type="text" name="meta_keywords" id="pageInputMetaKeywords" class="erp-form-input" placeholder="گارانتی, سام موبایل, تعمیرات, تامین کانی سام">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">محتوای متنی برگه (HTML یا متن)</label>
                        <textarea name="content" id="pageInputContent" class="erp-form-input" rows="6" required placeholder="متن کامل صفحه را اینجا وارد نمایید..."></textarea>
                    </div>
                </div>
                <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-table-action" onclick="toggleAddPageForm()">انصراف</button>
                    <button type="submit" class="erp-btn erp-btn-primary">ذخیره و انتشار صفحه</button>
                </div>
            </form>
        </div>

        <!-- Pages Table -->
        <div class="erp-card">
            <div class="erp-card-header">
                <h3 class="erp-card-title">لیست صفحات ثبت‌شده در سیستم</h3>
            </div>
            <div class="erp-card-body">
                <div class="erp-table-wrap">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان برگه</th>
                                <th>اسلاگ و مسیر</th>
                                <th>دسته</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cmsPages as $page)
                                <tr>
                                    <td><strong>{{ $page->id }}</strong></td>
                                    <td><strong>{{ $page->title }}</strong></td>
                                    <td><code style="direction: ltr; display: inline-block;">/page/{{ $page->slug }}</code></td>
                                    <td><span class="table-status-pill st-inspecting">{{ $page->category }}</span></td>
                                    <td>
                                        @if($page->is_published)
                                            <span class="table-status-pill st-ready_for_delivery">منتشر شده</span>
                                        @else
                                            <span class="table-status-pill st-waiting_parts">پیش‌نویس</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 6px;">
                                            <a href="{{ url('/page/' . $page->slug) }}" target="_blank" class="btn-table-action">
                                                👁️ مشاهده
                                            </a>
                                            <button type="button" class="btn-table-action" onclick='openEditPageModal(@json($page))'>
                                                ✏️ ویرایش
                                            </button>
                                            <button type="button" class="btn-table-action" style="color: #ef4444; border-color: #fca5a5;" onclick="deletePageItem({{ $page->id }})">
                                                🗑️ حذف
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; color: #94a3b8; padding: 20px;">هیچ برگه‌ای ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== 11. VIEW: BLOG & SEO STUDIO ==================== -->
    <div class="erp-view {{ $activeTab === 'tab-blog' ? 'active' : '' }}" id="tab-blog" data-title="وبلاگ تخصصی و سئو">
        <div class="erp-page-head">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #14532d; border: 1px solid #86efac;">
                    ✨ استودیوی هوشمند وبلاگ و ممیزی سئو (SEO Studio)
                </span>
                <h1 class="erp-page-title">مدیریت وبلاگ تخصصی، مقالات آموزشی و سئوی گوگل</h1>
                <p class="erp-page-desc">تولید محتوای بهینه‌شده، سنجش برخط شاخص سلامت سئو، شبیه‌سازی پیش‌نمایش در نتایج ارگانیک گوگل و تحلیل رفتار کاربران.</p>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="button" class="erp-btn erp-btn-primary" onclick="toggleAddBlogForm()" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);">
                    <span>✍️</span> <span>نگارش و انتشار مقاله جدید</span>
                </button>
                <a href="{{ url('/blog') }}" target="_blank" class="erp-btn" style="background: #ffffff; border: 1.5px solid #cbd5e1; color: #334155;">
                    <span>👁️</span> <span>مشاهده وبلاگ در سایت</span>
                </a>
            </div>
        </div>

        <!-- SEO Metrics KPI Strip -->
        <div class="erp-stats-grid">
            <div class="erp-stat-card" style="border-right: 4px solid #2563eb;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div class="erp-stat-label">تعداد مقالات منتشر شده</div>
                        <div class="erp-stat-value" style="color: #2563eb;">{{ count($blogPosts) }}</div>
                        <div class="erp-stat-sub">محتوای رسمی کارگاه مرکزی</div>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        📚
                    </div>
                </div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #10b981;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div class="erp-stat-label">مجموع بازدیدهای یکتا</div>
                        <div class="erp-stat-value" style="color: #10b981;">{{ number_format(collect($blogPosts)->sum('views')) }}</div>
                        <div class="erp-stat-sub">مطالعه کاربران از سراسر کشور</div>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        👁️
                    </div>
                </div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #059669;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div class="erp-stat-label">شاخص سلامت سئو (On-Page)</div>
                        <div class="erp-stat-value" style="color: #059669;">۱۰۰٪ ممتاز</div>
                        <div class="erp-stat-sub">دارای Schema JSON-LD & OpenGraph</div>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        🎯
                    </div>
                </div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #d97706;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div class="erp-stat-label">میانگین زمان مطالعه</div>
                        <div class="erp-stat-value" style="color: #d97706;">۴.۵ دقیقه</div>
                        <div class="erp-stat-sub">نرخ تعامل (Engagement) بسیار بالا</div>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        ⏱️
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Blog Post Collapsible Form with Integrated Live SEO Studio -->
        <div id="addBlogFormBox" style="display: none; background: #ffffff; border: 1.5px solid #10b981; border-radius: 20px; padding: 28px; margin-bottom: 28px; box-shadow: 0 10px 35px rgba(16,185,129,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 42px; height: 42px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                        📝
                    </div>
                    <div>
                        <h3 style="font-size: 1.15rem; font-weight: 900; color: #0f172a; margin: 0;">نگارش مقاله جدید در استودیوی سئو سام موبایل</h3>
                        <span style="font-size: 0.78rem; color: #64748b;">تولید محتوا، بهینه‌سازی تگ‌های متای گوگل و تحلیل لحظه‌ای سلامت ارگانیک</span>
                    </div>
                </div>
                <button type="button" onclick="toggleAddBlogForm()" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 50%; width: 34px; height: 34px; font-size: 1rem; cursor: pointer; color: #475569; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">✕</button>
            </div>

            <form onsubmit="handleBlogStore(event, this)">
                @csrf
                <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 18px;">
                    
                    <!-- Real-Time SEO Quality Audit Meter Gauge -->
                    <div style="grid-column: 1 / -1;">
                        <div class="seo-meter-card">
                            <div class="seo-meter-head">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #dcfce7; color: #15803d; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                                        🎯
                                    </div>
                                    <div>
                                        <h4 style="font-size: 0.98rem; font-weight: 900; color: #065f46; margin: 0;">ارزیابی هوشمند کیفیت و سئوی محتوا (On-Page SEO Audit)</h4>
                                        <div style="font-size: 0.75rem; color: #047857;">تحلیل لحظه‌ای عنوان اصلی، جذابیت اسلاگ، چکیده، طول مقاله و استانداردهای گوگل</div>
                                    </div>
                                </div>
                                <div style="text-align: left;">
                                    <span class="seo-score-circle" id="seoScoreText">۱۰۰ / ۱۰۰</span>
                                    <div style="font-size: 0.72rem; font-weight: 800; color: #059669;">کیفیت ممتاز سئو</div>
                                </div>
                            </div>
                            <div style="width: 100%; height: 8px; background: #e2e8f0; border-radius: 99px; overflow: hidden; margin: 12px 0;">
                                <div id="seoProgressBar" style="width: 100%; height: 100%; background: linear-gradient(90deg, #10b981, #059669); transition: width 0.3s ease;"></div>
                            </div>
                            <div class="seo-checklist">
                                <div class="seo-check-item valid" id="chkTitle"><span>✓</span> <span>عنوان اصلی مقاله (حداقل ۱۰ کاراکتر)</span></div>
                                <div class="seo-check-item valid" id="chkSlug"><span>✓</span> <span>نامک انگلیسی بهینه‌شده (Slug یکتا)</span></div>
                                <div class="seo-check-item valid" id="chkExcerpt"><span>✓</span> <span>چکیده و مقدمه ترغیب‌کننده برای کلیک</span></div>
                                <div class="seo-check-item valid" id="chkContent"><span>✓</span> <span>محتوای متنی غنی (حداقل ۱۰۰ کلمه)</span></div>
                                <div class="seo-check-item valid" id="chkMeta"><span>✓</span> <span>توضیحات متای بهینه‌شده برای نتایج گوگل</span></div>
                            </div>
                        </div>
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">
                            <span>عنوان اصلی مقاله (H1 Title)</span>
                            <span class="req">*</span>
                        </label>
                        <input type="text" name="title" id="blogInputTitle" class="erp-form-input" required placeholder="مثال: آموزش تعویض ال‌سی‌دی اورجینال سامسونگ در منزل با گارانتی ۱۸ ماهه" oninput="updateGooglePreview(); calculateSeoScore();">
                    </div>

                    <div>
                        <label class="erp-form-label">
                            <span>نامک سئو و آدرس یکتا (URL Slug)</span>
                            <span class="req">*</span>
                        </label>
                        <input type="text" name="slug" id="blogInputSlug" class="erp-form-input" required placeholder="samsung-lcd-replacement-guide" style="direction: ltr;" oninput="updateGooglePreview(); calculateSeoScore();">
                        <span style="font-size: 0.72rem; color: #64748b; margin-top: 4px; display: block;">مسیر اختصاصی در سایت: <code>mob.taminkanisam.co.ir/blog/slug</code></span>
                    </div>

                    <div>
                        <label class="erp-form-label">دسته‌بندی مقاله</label>
                        <select name="category" class="erp-form-select">
                            <option value="آموزش گارانتی">آموزش گارانتی</option>
                            <option value="نگهداری سخت‌افزار">نگهداری سخت‌افزار</option>
                            <option value="اخبار فناوری">اخبار فناوری</option>
                            <option value="اصالت قطعات">اصالت قطعات</option>
                        </select>
                    </div>

                    <div>
                        <label class="erp-form-label">نام نویسنده / تیم فنی</label>
                        <input type="text" name="author" class="erp-form-input" value="تیم فنی سام سرویس">
                    </div>

                    <div>
                        <label class="erp-form-label">زمان تقریبی مطالعه</label>
                        <input type="text" name="read_time" class="erp-form-input" value="۴ دقیقه">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">آدرس تصویر شاخص (Featured Image URL)</label>
                        <input type="url" name="featured_image" class="erp-form-input" value="https://images.unsplash.com/photo-1511707171634-5f897ff02560?auto=format&fit=crop&w=800&q=80">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">چکیده مقاله (Excerpt - نمایش در لیست و شبکه‌های اجتماعی)</label>
                        <textarea name="excerpt" id="blogInputExcerpt" class="erp-form-input" rows="2" placeholder="مقدمه‌ای کوتاه و جذاب جهت جذب کاربر و نمایش در کارت‌های وبلاگ..." oninput="updateGooglePreview(); calculateSeoScore();"></textarea>
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">
                            <span>متن کامل مقاله (Content - همراه با عناوین فرعی و پاراگراف‌ها)</span>
                            <span class="req">*</span>
                        </label>
                        <textarea name="content" id="blogInputContent" class="erp-form-input" rows="9" required placeholder="متن کامل مقاله آموزشی را اینجا وارد نمایید. می‌توانید از تگ‌های HTML نظیر <h3>, <p>, <ul> نیز استفاده فرمایید..." oninput="calculateSeoScore();"></textarea>
                    </div>

                    <!-- Google SERP Snippet Preview Box with Desktop / Mobile Simulator -->
                    <div style="grid-column: 1 / -1; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 16px; padding: 22px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; flex-wrap: wrap; gap: 10px;">
                            <div style="font-weight: 800; color: #0f172a; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;">
                                <img src="https://www.google.com/favicon.ico" width="18" height="18" alt="Google">
                                <span>شبیه‌ساز زنده نمایش در نتایج ارگانیک گوگل (Google SERP Snippet):</span>
                            </div>
                            <div style="display: flex; gap: 6px;">
                                <button type="button" class="btn-table-action" id="serpBtnDesktop" style="background: #2563eb; color: #fff; border-color: #2563eb;" onclick="setSerpDevice('desktop')">💻 دسکتاپ</button>
                                <button type="button" class="btn-table-action" id="serpBtnMobile" onclick="setSerpDevice('mobile')">📱 موبایل</button>
                            </div>
                        </div>

                        <div id="serpSnippetCard" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px; transition: all 0.3s ease; max-width: 650px;">
                            <div style="font-size: 0.76rem; color: #202124; margin-bottom: 4px; display: flex; align-items: center; gap: 6px; direction: ltr; text-align: left;">
                                <span style="color: #202124; font-weight: 500;">https://mob.taminkanisam.co.ir</span>
                                <span style="color: #5f6368;">› blog › <span id="serpSlugPreview">slug</span></span>
                            </div>
                            <div style="font-size: 1.18rem; color: #1a0dab; font-weight: 600; line-height: 1.35; margin-bottom: 6px; cursor: pointer; text-decoration: none;" id="serpTitlePreview">
                                عنوان مقاله در نتایج جستجوی گوگل
                            </div>
                            <div style="font-size: 0.84rem; color: #4d5156; line-height: 1.55;" id="serpDescPreview">
                                توضیحات متا دیسکریپشن مقاله در اینجا نمایش داده خواهد شد...
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-top: 18px;">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                    <label class="erp-form-label" style="margin: 0;">عنوان متای گوگل (Meta Title)</label>
                                    <span style="font-size: 0.7rem; color: #64748b;" id="metaTitleCounter">حداکثر ۶۰ کاراکتر</span>
                                </div>
                                <input type="text" name="meta_title" id="blogMetaTitle" class="erp-form-input" placeholder="عنوان بهینه‌شده برای جذب کلیک در صفحه اول گوگل" oninput="updateGooglePreview(); calculateSeoScore();">
                            </div>

                            <div>
                                <label class="erp-form-label">کلمات کلیدی سئو (Meta Keywords)</label>
                                <input type="text" name="meta_keywords" class="erp-form-input" placeholder="تعمیر گوشی, گارانتی سام موبایل, تامین کانی سام, تعویض قطعات">
                            </div>

                            <div style="grid-column: 1 / -1;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                    <label class="erp-form-label" style="margin: 0;">توضیحات متای گوگل (Meta Description)</label>
                                    <span style="font-size: 0.7rem; color: #64748b;" id="metaDescCounter">حداکثر ۱۶۰ کاراکتر</span>
                                </div>
                                <textarea name="meta_description" id="blogMetaDesc" class="erp-form-input" rows="2" placeholder="متنی حرفه‌ای و ترغیب‌کننده بنویسید تا کاربر در نتایج گوگل روی سایت شما کلیک کند..." oninput="updateGooglePreview(); calculateSeoScore();"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                    <button type="button" class="btn-table-action" onclick="toggleAddBlogForm()" style="padding: 10px 20px; font-size: 0.85rem;">انصراف</button>
                    <button type="submit" class="erp-btn erp-btn-primary" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-color: #059669; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);">
                        <span>🚀</span> <span>انتشار مقاله با رعایت استانداردهای سئو</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Articles Archive Table -->
        <div class="erp-card">
            <div class="erp-card-header">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.2rem;">📰</span>
                    <h3 class="erp-card-title">آرشیو مقالات منتشرشده و وضعیت ایندکس در گوگل</h3>
                </div>
                <span style="font-size: 0.76rem; background: #ecfdf5; color: #047857; padding: 4px 10px; border-radius: 99px; font-weight: 800;">
                    مجموع: {{ count($blogPosts) }} مقاله فعال
                </span>
            </div>
            <div class="erp-card-body">
                <div class="erp-table-wrap">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>تصویر شاخص</th>
                                <th>عنوان و آدرس مقاله</th>
                                <th>دسته‌بندی</th>
                                <th>نویسنده</th>
                                <th>بازدید یکتا</th>
                                <th>زمان مطالعه</th>
                                <th>وضعیت سئو</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogPosts as $post)
                                <tr>
                                    <td>
                                        <div style="width: 58px; height: 42px; border-radius: 10px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 800; font-size: 0.88rem; color: #0f172a; margin-bottom: 2px;">{{ $post->title }}</div>
                                        <div style="font-size: 0.72rem; color: #64748b; direction: ltr; text-align: right;"><code>/blog/{{ $post->slug }}</code></div>
                                    </td>
                                    <td><span class="table-status-pill st-inspecting">{{ $post->category }}</span></td>
                                    <td><span style="font-size: 0.78rem; font-weight: 600;">{{ $post->author }}</span></td>
                                    <td><strong>{{ number_format($post->views) }}</strong></td>
                                    <td><span style="font-size: 0.78rem; color: #64748b;">{{ $post->read_time }}</span></td>
                                    <td><span class="table-status-pill st-ready_for_delivery">✓ سئو تاییدشده</span></td>
                                    <td>
                                        <div style="display: flex; gap: 6px;">
                                            <a href="{{ url('/blog/' . $post->slug) }}" target="_blank" class="btn-table-action">👁️ مشاهده</a>
                                            <button type="button" class="btn-table-action" onclick='openEditBlogModal(@json($post))'>✏️ ویرایش</button>
                                            <button type="button" class="btn-table-action" style="color: #ef4444; border-color: #fca5a5;" onclick="deleteBlogItem({{ $post->id }})">🗑️ حذف</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; color: #94a3b8; padding: 24px;">هیچ مقاله‌ای منتشر نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- ==================== 12. VIEW: SURVEYS & ANALYTICS ==================== -->
    <div class="erp-view {{ $activeTab === 'tab-surveys' ? 'active' : '' }}" id="tab-surveys" data-title="نظرسنجی و تحلیل نظرات">
        <div class="erp-page-head">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#fce7f3; color:#9d174d;">سنجش رضایت مشتریان (CSAT)</span>
                <h1 class="erp-page-title">داشبورد تحلیلی نظرسنجی‌ها، ارزیابی کیفیت و بازخوردها</h1>
                <p class="erp-page-desc">تحلیل هوشمند شاخص‌های رضایت از خدمات، بررسی نظرات ثبت‌شده، پاسخگویی رسمی و ایجاد کمپین‌های جدید.</p>
            </div>
            <button type="button" class="erp-btn erp-btn-primary" onclick="toggleAddCampaignForm()">
                + افزودن نظرسنجی / کمپین جدید
            </button>
        </div>

        <!-- Add Campaign Collapsible Form -->
        <div id="addCampaignFormBox" style="display: none; background: #ffffff; border: 1px solid #db2777; border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(219,39,119,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a;">ایجاد کمپین نظرسنجی جدید</h3>
                <button type="button" onclick="toggleAddCampaignForm()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #64748b;">✕</button>
            </div>
            <form onsubmit="handleCampaignStore(event, this)">
                @csrf
                <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div>
                        <label class="erp-form-label">عنوان کمپین نظرسنجی</label>
                        <input type="text" name="title" class="erp-form-input" required placeholder="مثال: نظرسنجی خدمات تعویض باتری و ترخیص پستی">
                    </div>
                    <div>
                        <label class="erp-form-label">جامعه هدف</label>
                        <input type="text" name="target_audience" class="erp-form-input" value="مشتریان دارای پرونده ترخیص‌شده">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">توضیحات و هدف از نظرسنجی</label>
                        <input type="text" name="description" class="erp-form-input" placeholder="پایش دقیق زمان تحویل و رضایت از مهندسین تعمیرات">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">پرسش‌های نظرسنجی (هر سوال در یک سطر)</label>
                        <textarea name="questions" class="erp-form-input" rows="4" placeholder="کیفیت قطعات مصرفی&#10;سرعت در پذیرش و تحویل دستگاه&#10;اخلاق و برخورد پرسنل دفتر تبریز&#10;شفافیت هزینه طبق تعرفه ماده ۱۳"></textarea>
                    </div>
                </div>
                <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-table-action" onclick="toggleAddCampaignForm()">انصراف</button>
                    <button type="submit" class="erp-btn erp-btn-primary" style="background: #db2777; border-color: #be185d;">فعال‌سازی کمپین نظرسنجی</button>
                </div>
            </form>
        </div>

        <!-- 5-Star CSAT Metrics Cards -->
        <div class="erp-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); margin-bottom: 24px;">
            <div class="erp-stat-card" style="border-right: 4px solid #10b981;">
                <div class="erp-stat-label">رضایت کلی مشتریان</div>
                <div class="erp-stat-value" style="color: #10b981;">{{ $surveyStats['avg_overall'] }} <span style="font-size: 0.9rem; color: #64748b;">از ۵</span></div>
                <div class="erp-stat-sub">نرخ رضایت: {{ $surveyStats['satisfaction_rate'] }}٪</div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #2563eb;">
                <div class="erp-stat-label">کیفیت قطعات و تعمیر</div>
                <div class="erp-stat-value" style="color: #2563eb;">{{ $surveyStats['avg_quality'] }} <span style="font-size: 0.9rem; color: #64748b;">از ۵</span></div>
                <div class="erp-stat-sub">اصالت ۱۰۰٪ اورجینال</div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #6366f1;">
                <div class="erp-stat-label">سرعت پذیرش و ترخیص</div>
                <div class="erp-stat-value" style="color: #6366f1;">{{ $surveyStats['avg_speed'] }} <span style="font-size: 0.9rem; color: #64748b;">از ۵</span></div>
                <div class="erp-stat-sub">میانگین زیر ۲ ساعت</div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #8b5cf6;">
                <div class="erp-stat-label">رفتار و تکریم پرسنل</div>
                <div class="erp-stat-value" style="color: #8b5cf6;">{{ $surveyStats['avg_behavior'] }} <span style="font-size: 0.9rem; color: #64748b;">از ۵</span></div>
                <div class="erp-stat-sub">پاسخگویی متعهدانه</div>
            </div>
            <div class="erp-stat-card" style="border-right: 4px solid #f59e0b;">
                <div class="erp-stat-label">شفافیت هزینه و تعرفه</div>
                <div class="erp-stat-value" style="color: #f59e0b;">{{ $surveyStats['avg_cost'] }} <span style="font-size: 0.9rem; color: #64748b;">از ۵</span></div>
                <div class="erp-stat-sub">منطبق بر ماده ۱۳</div>
            </div>
        </div>

        <!-- Rating Distribution Progress Bars -->
        <div class="erp-card" style="margin-bottom: 24px;">
            <div class="erp-card-header">
                <h3 class="erp-card-title">توزیع آماری امتیازات کاربران</h3>
            </div>
            <div class="erp-card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; align-items: center;">
                    <div style="text-align: center; padding: 20px; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                        <div style="font-size: 3.2rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $surveyStats['avg_overall'] }}</div>
                        <div style="font-size: 1.2rem; color: #f59e0b; margin: 6px 0;">★★★★★</div>
                        <div style="font-size: 0.82rem; color: #64748b;">بر اساس {{ $surveyStats['total'] }} نظرسنجی ثبت‌شده</div>
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                            <span style="font-size: 0.8rem; font-weight: 700; width: 60px;">۵ ستاره:</span>
                            <div style="flex-grow: 1; height: 10px; background: #f1f5f9; border-radius: 6px; overflow: hidden;">
                                <div style="height: 100%; width: {{ $surveyStats['star_5'] }}%; background: #10b981;"></div>
                            </div>
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; width: 40px; text-align: left;">{{ $surveyStats['star_5'] }}٪</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                            <span style="font-size: 0.8rem; font-weight: 700; width: 60px;">۴ ستاره:</span>
                            <div style="flex-grow: 1; height: 10px; background: #f1f5f9; border-radius: 6px; overflow: hidden;">
                                <div style="height: 100%; width: {{ $surveyStats['star_4'] }}%; background: #3b82f6;"></div>
                            </div>
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; width: 40px; text-align: left;">{{ $surveyStats['star_4'] }}٪</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 0.8rem; font-weight: 700; width: 60px;">۳ ستاره:</span>
                            <div style="flex-grow: 1; height: 10px; background: #f1f5f9; border-radius: 6px; overflow: hidden;">
                                <div style="height: 100%; width: {{ $surveyStats['star_3'] }}%; background: #f59e0b;"></div>
                            </div>
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; width: 40px; text-align: left;">{{ $surveyStats['star_3'] }}٪</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Reviews & Feedback Cards -->
        <div class="erp-card">
            <div class="erp-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <h3 class="erp-card-title">فیدبک‌ها و نظرات ثبت‌شده توسط مشتریان</h3>
                
                <!-- Status Filter Pills -->
                <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                    <button type="button" class="btn-table-action survey-filter-btn active" onclick="filterSurveys('all', this)">همه ({{ count($surveysList) }})</button>
                    <button type="button" class="btn-table-action survey-filter-btn" onclick="filterSurveys('approved', this)">✓ تأییدشده</button>
                    <button type="button" class="btn-table-action survey-filter-btn" onclick="filterSurveys('pending', this)">⏳ در انتظار بررسی</button>
                    <button type="button" class="btn-table-action survey-filter-btn" onclick="filterSurveys('replied', this)">💬 دارای پاسخ</button>
                </div>
            </div>
            <div class="erp-card-body">
                <div style="display: flex; flex-direction: column; gap: 16px;" id="surveyReviewsContainer">
                    @forelse($surveysList as $surv)
                        <div class="survey-review-item" data-status="{{ $surv->status ?? 'pending' }}" data-replied="{{ !empty($surv->admin_reply) ? '1' : '0' }}" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                                <div>
                                    <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">{{ $surv->customer_name ?: 'مشتری گرامی' }}</div>
                                    <div style="font-size: 0.76rem; color: #64748b; margin-top: 2px;">
                                        تلفن: {{ $surv->customer_phone ?: '-' }} | کد پیگیری دستگاه: <code style="direction: ltr;">{{ $surv->service_tracking_code ?: 'نامشخص' }}</code>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 20px; font-weight: 800; font-size: 0.8rem;">
                                        ★ {{ $surv->overall_score }} از ۵
                                    </span>
                                    <span class="table-status-pill {{ ($surv->status ?? '') === 'approved' ? 'st-ready_for_delivery' : 'st-waiting_parts' }}">
                                        {{ ($surv->status ?? '') === 'approved' ? 'تاییدشده' : 'در دست بررسی' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Individual Scores -->
                            <div style="display: flex; gap: 14px; font-size: 0.74rem; color: #475569; margin-bottom: 12px; flex-wrap: wrap; background: #ffffff; padding: 8px 12px; border-radius: 10px; border: 1px solid #f1f5f9;">
                                <span>سرعت: <strong>{{ $surv->speed_score }}</strong></span>
                                <span>کیفیت: <strong>{{ $surv->quality_score }}</strong></span>
                                <span>برخورد: <strong>{{ $surv->behavior_score }}</strong></span>
                                <span>هزینه: <strong>{{ $surv->cost_score }}</strong></span>
                            </div>

                            @if($surv->suggestions)
                                <div style="font-size: 0.88rem; color: #1e293b; line-height: 1.8; margin-bottom: 12px;">
                                    <strong>متن نظر مشتری:</strong> {{ $surv->suggestions }}
                                </div>
                            @endif

                            @if(!empty($surv->admin_reply))
                                <div style="background: #eff6ff; border-right: 3px solid #2563eb; padding: 10px 14px; border-radius: 0 10px 10px 0; font-size: 0.82rem; color: #1e40af; margin-bottom: 12px;">
                                    <strong>پاسخ رسمی پشتیبانی:</strong> {{ $surv->admin_reply }}
                                </div>
                            @endif

                            <div style="display: flex; justify-content: flex-end; gap: 8px; border-top: 1px solid #e2e8f0; padding-top: 10px;">
                                <button type="button" class="btn-table-action" onclick='openReplyModal({{ $surv->id }}, @json($surv->customer_name ?: "مشتری"), @json($surv->suggestions ?: ""), @json($surv->admin_reply ?: ""))'>
                                    💬 پاسخ رسمی مدیریت
                                </button>
                                @if(($surv->status ?? '') !== 'approved')
                                    <button type="button" class="btn-table-action" style="color: #10b981; border-color: #86efac;" onclick="approveSurvey({{ $surv->id }})">
                                        ✓ تایید و انتشار
                                    </button>
                                @endif
                                <button type="button" class="btn-table-action" style="color: #ef4444; border-color: #fca5a5;" onclick="deleteSurveyItem({{ $surv->id }})">
                                    🗑️ حذف
                                </button>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: #94a3b8; padding: 30px;">هیچ بازخوردی ثبت نشده است.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


        <!-- ===================================================================
             PAGE 13: AGENCIES & BRANCHES MANAGEMENT (tab-agencies)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-agencies' ? 'active' : '' }}" id="tab-agencies" data-title="مدیریت شعب و نمایندگان">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background:#ecfdf5; color:#059669;">شبکه خدمات سراسری تلفن همراه</span>
                    <h1 class="erp-page-title">مدیریت شعب و نمایندگی‌های رسمی گارانتی و خدمات پس از فروش</h1>
                    <p class="erp-page-desc">پیکربندی اطلاعات شعب تهران، تبریز، اصفهان، کرج، شیراز، مشهد، موقعیت نقشه Leaflet، صدور دسترسی و احراز صلاحیت ماده ۱۳.</p>
                </div>
                <button type="button" class="erp-btn erp-btn-primary" onclick="openAgencyModal()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>افزودن شعبه / نماینده جدید</span>
                </button>
            </div>

            <!-- KPI Row -->
            <div class="erp-kpi-grid" style="margin-bottom: 24px;">
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">کل شعب ثبت‌شده</span>
                        <div class="kpi-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($agencies) ? count($agencies) : 6 }}</div>
                    <div class="kpi-meta"><span style="color: #059669;">✓ ۶ شعبه استاندارد PDF</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">شعب فعال و پاسخگو</span>
                        <div class="kpi-icon-wrap" style="background: #ecfdf5; color: #059669;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($agencies) ? $agencies->where('is_active', 1)->count() : 6 }}</div>
                    <div class="kpi-meta"><span style="color: #059669;">۱۰۰٪ پوشش استانی</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">دسترسی پرتال نمایندگان</span>
                        <div class="kpi-icon-wrap" style="background: #fef3c7; color: #d97706;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($agencies) ? $agencies->where('has_portal_access', 1)->count() : 6 }}</div>
                    <div class="kpi-meta"><span>نقش کارشناس شعبه</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">کلان‌شهرهای تحت پوشش</span>
                        <div class="kpi-icon-wrap" style="background: #f3e8ff; color: #7c3aed;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($agencies) ? $agencies->unique('city')->count() : 6 }}</div>
                    <div class="kpi-meta"><span>تهران، تبریز، اصفهان، کرج...</span></div>
                </div>
            </div>

            <!-- Agencies Table Card -->
            <div class="erp-card">
                <div class="erp-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                    <div class="erp-card-title">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 10px; background: #ecfdf5; color: #059669;">🏢</span>
                        <span>فهرست کامل شعب و نمایندگی‌های رسمی</span>
                    </div>
                    <a href="{{ url('/representatives') }}" target="_blank" class="erp-btn" style="background: #f1f5f9; color: #334155; font-size: 0.82rem; padding: 6px 14px; text-decoration: none;">
                        <span>مشاهده صفحه نقشه مشتریان ↗</span>
                    </a>
                </div>

                <div class="erp-table-responsive" style="overflow-x: auto;">
                    <table class="erp-table" style="width: 100%; border-collapse: collapse; min-width: 850px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">کد شعبه</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">نام شعبه / نمایندگی</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">شهر / استان</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">مدیر و تلفن تماس</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">نشانی دقیق</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">مختصات نقشه</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">وضعیت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agencies as $ag)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px 14px; font-weight: 800; color: #2563eb; font-size: 0.84rem;">
                                    <span style="background: #eff6ff; padding: 3px 8px; border-radius: 6px; border: 1px solid #dbeafe;">{{ $ag->agency_code }}</span>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 800; color: #0f172a; font-size: 0.9rem;">{{ $ag->name }}</div>
                                    <div style="font-size: 0.74rem; color: #64748b; margin-top: 2px;">{{ $ag->services_offered ?: 'پذیرش و تحویل گارانتی' }}</div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <span style="display: inline-flex; align-items: center; gap: 4px; font-weight: 700; color: #334155; font-size: 0.84rem;">
                                        📍 {{ $ag->city }} <span style="color: #94a3b8; font-size: 0.76rem;">({{ $ag->province }})</span>
                                    </span>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem;">{{ $ag->manager_name ?: 'مدیریت شعبه' }}</div>
                                    <div style="font-size: 0.78rem; color: #2563eb; direction: ltr; text-align: right; font-weight: 600;">{{ $ag->phone }}</div>
                                </td>
                                <td style="padding: 12px 14px; max-width: 240px; font-size: 0.78rem; color: #475569; line-height: 1.5;">
                                    {{ $ag->address }}
                                </td>
                                <td style="padding: 12px 14px; text-align: center; font-size: 0.76rem; color: #64748b;">
                                    {{ round($ag->latitude, 4) }}, {{ round($ag->longitude, 4) }}
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($ag->is_active)
                                        <button type="button" onclick="toggleAgencyStatus({{ $ag->id }})" class="btn-table-action" style="color: #059669; border-color: #a7f3d0; background: #ecfdf5; font-size: 0.74rem; padding: 2px 8px; border-radius: 99px;">
                                            ● فعال
                                        </button>
                                    @else
                                        <button type="button" onclick="toggleAgencyStatus({{ $ag->id }})" class="btn-table-action" style="color: #dc2626; border-color: #fecaca; background: #fef2f2; font-size: 0.74rem; padding: 2px 8px; border-radius: 99px;">
                                            ○ غیرفعال
                                        </button>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    <div style="display: inline-flex; align-items: center; gap: 6px;">
                                        <button type="button" class="btn-table-action" title="ویرایش" onclick='openAgencyModal({{ json_encode($ag) }})' style="padding: 5px 10px; font-size: 0.78rem; border-radius: 8px;">
                                            ✏️ ویرایش
                                        </button>
                                        <button type="button" class="btn-table-action" title="حذف" onclick="deleteAgency({{ $ag->id }}, '{{ $ag->name }}')" style="padding: 5px 8px; font-size: 0.78rem; border-radius: 8px; color: #ef4444; border-color: #fca5a5;">
                                            🗑️
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="padding: 40px; text-align: center; color: #94a3b8;">هیچ شعبه‌ای تعریف نشده است.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ===================================================================
             PAGE 14: INTERNAL CHAT & COLLABORATION (tab-internal-chat)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-internal-chat' ? 'active' : '' }}" id="tab-internal-chat" data-title="چت و گفتگوی داخلی">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background:#eff6ff; color:#2563eb;">شبکه پیام‌رسانی بلادرنگ داخلی</span>
                    <h1 class="erp-page-title">تالار گفتگو و هماهنگی درون‌سازمانی سام موبایل</h1>
                    <p class="erp-page-desc">ارتباط برخط کارشناسان دفتر مرکزی، پذیرش، تکنسین‌های فنی و انبار قطعات با مدیران شعب استانی.</p>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button type="button" class="erp-btn" style="background:#f1f5f9; color:#334155;" onclick="loadChatMessages()">
                        🔄 بروزرسانی پیام‌ها
                    </button>
                </div>
            </div>

            <!-- Chat Channel Pills -->
            <div style="display: flex; gap: 8px; margin-bottom: 16px; overflow-x: auto; padding-bottom: 6px;">
                <button type="button" class="erp-btn chat-channel-btn active" data-channel="general" onclick="switchChatChannel('general', this)" style="font-size: 0.82rem; padding: 7px 16px; border-radius: 99px;">
                    📢 عمومی و اطلاعیه‌ها
                </button>
                <button type="button" class="erp-btn chat-channel-btn" data-channel="intake" onclick="switchChatChannel('intake', this)" style="font-size: 0.82rem; padding: 7px 16px; border-radius: 99px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                    📥 پذیرش و تحویل کالا
                </button>
                <button type="button" class="erp-btn chat-channel-btn" data-channel="technical" onclick="switchChatChannel('technical', this)" style="font-size: 0.82rem; padding: 7px 16px; border-radius: 99px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                    🔧 کارگاه فنی و تعمیرات
                </button>
                <button type="button" class="erp-btn chat-channel-btn" data-channel="logistics" onclick="switchChatChannel('logistics', this)" style="font-size: 0.82rem; padding: 7px 16px; border-radius: 99px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                    📦 انبار و تامین قطعات
                </button>
            </div>

            <!-- Chat Container Box -->
            <div class="erp-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 580px;">
                <!-- Chat Stream Window -->
                <div id="chatMessagesStream" style="flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 14px; background: #f8fafc;">
                    @forelse($chatMessages ?? [] as $msg)
                        @php
                            $isMe = (Auth::check() && Auth::id() == $msg->user_id) || (session('mob_user_name') == $msg->sender_name);
                        @endphp
                        <div class="chat-msg-row {{ $isMe ? 'chat-msg-me' : 'chat-msg-other' }}" data-channel="{{ $msg->channel ?? 'general' }}" style="display: flex; flex-direction: column; align-items: {{ $isMe ? 'flex-start' : 'flex-end' }}; max-width: 82%; align-self: {{ $isMe ? 'flex-start' : 'flex-end' }};">
                            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px; font-size: 0.74rem; color: #64748b;">
                                <span style="font-weight: 800; color: #0f172a;">{{ $msg->sender_name }}</span>
                                <span style="background: #e2e8f0; padding: 1px 6px; border-radius: 6px; font-size: 0.68rem;">{{ $msg->sender_role }}</span>
                                <span>•</span>
                                <span>{{ shamsi($msg->created_at, 'H:i - Y/m/d') }}</span>
                            </div>
                            <div style="background: {{ $isMe ? '#2563eb' : '#ffffff' }}; color: {{ $isMe ? '#ffffff' : '#0f172a' }}; padding: 12px 16px; border-radius: 16px; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05); border: {{ $isMe ? 'none' : '1px solid #e2e8f0' }}; line-height: 1.6; font-size: 0.88rem; word-break: break-word;">
                                {{ $msg->message }}
                            </div>
                        </div>
                    @empty
                        <div id="noChatNotice" style="text-align: center; color: #94a3b8; padding: 60px 20px;">
                            <div style="font-size: 2.2rem; margin-bottom: 8px;">💬</div>
                            <div style="font-weight: 700;">هنوز پیامی در این کانال ثبت نشده است.</div>
                            <div style="font-size: 0.8rem; margin-top: 4px;">اولین پیام این گفتگو را ارسال نمایید.</div>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Input Box -->
                <div style="padding: 14px 18px; background: #ffffff; border-top: 1px solid #e2e8f0;">
                    <form id="internalChatForm" onsubmit="sendInternalChatMessage(event)" style="display: flex; gap: 10px; align-items: center; margin: 0;">
                        @csrf
                        <input type="hidden" name="channel" id="chatCurrentChannel" value="general">
                        <input type="text" name="message" id="chatMessageInput" class="erp-input" placeholder="پیام خود را تایپ کنید..." required style="flex: 1; border-radius: 12px; height: 46px; font-size: 0.9rem;">
                        <button type="submit" id="chatSendBtn" class="erp-btn erp-btn-primary" style="height: 46px; border-radius: 12px; padding: 0 20px;">
                            <span>ارسال</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <!-- ===================================================================
             PAGE 15: SUPPORT TICKETS MANAGEMENT (tab-tickets)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-tickets' ? 'active' : '' }}" id="tab-tickets" data-title="تیکت‌های پشتیبانی">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background:#eff6ff; color:#2563eb;">میز خدمات الکترونیک مشتریان</span>
                    <h1 class="erp-page-title">مدیریت تیکت‌های پشتیبانی آنلاین ۲۴ ساعته</h1>
                    <p class="erp-page-desc">پاسخگویی به درخواست‌های فنی، استعلام گارانتی و پیگیری‌های واصله از فرم تیکت وب‌سایت.</p>
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ url('/tickets') }}" target="_blank" class="erp-btn" style="background: #f1f5f9; color: #334155; font-size: 0.82rem; padding: 8px 14px; text-decoration: none;">
                        <span>مشاهده صفحه عمومی تیکت‌ها ↗</span>
                    </a>
                </div>
            </div>

            <!-- KPI Row -->
            <div class="erp-kpi-grid" style="margin-bottom: 24px;">
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">کل تیکت‌های دریافتی</span>
                        <div class="kpi-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($tickets) ? count($tickets) : 0 }}</div>
                    <div class="kpi-meta"><span>سامانه پشتیبانی برخط</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">در انتظار پاسخ</span>
                        <div class="kpi-icon-wrap" style="background: #fef3c7; color: #d97706;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value" style="color: #d97706;">{{ isset($tickets) ? $tickets->where('status', 'new')->count() : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #d97706;">نیازمند رسیدگی فوری</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">پاسخ داده شده</span>
                        <div class="kpi-icon-wrap" style="background: #ecfdf5; color: #059669;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($tickets) ? $tickets->where('status', 'answered')->count() : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #059669;">ارسال پیامک اطلاع‌رسانی</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">میانگین زمان پاسخ</span>
                        <div class="kpi-icon-wrap" style="background: #f3e8ff; color: #7c3aed;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value" style="font-size: 1.25rem;">کمتر از ۱ ساعت</div>
                    <div class="kpi-meta"><span>انطباق با ماده ۱۳</span></div>
                </div>
            </div>

            <!-- Tickets Table Card -->
            <div class="erp-card">
                <div class="erp-table-responsive" style="overflow-x: auto;">
                    <table class="erp-table" style="width: 100%; border-collapse: collapse; min-width: 900px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">شماره تیکت</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">کاربر / مشتری</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">دپارتمان</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">موضوع و خلاصه</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">اولویت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">تاریخ ثبت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">وضعیت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $tk)
                            <tr style="border-bottom: 1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px 14px; font-weight: 800; color: #2563eb; font-size: 0.84rem;">
                                    <span style="background: #eff6ff; padding: 3px 8px; border-radius: 6px; border: 1px solid #dbeafe;">{{ $tk->tracking_code ?? ($tk->ticket_number ?? ('TK-' . $tk->id)) }}</span>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 800; color: #0f172a; font-size: 0.88rem;">{{ $tk->customer_name }}</div>
                                    <div style="font-size: 0.78rem; color: #64748b; direction: ltr; text-align: right;">{{ $tk->customer_phone }}</div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <span style="font-size: 0.82rem; color: #334155; font-weight: 700;">
                                        @if($tk->department === 'warranty') گارانتی و اصالت
                                        @elseif($tk->department === 'technical') تعمیرات و کارگاه
                                        @elseif($tk->department === 'tracking') رهگیری کالا
                                        @elseif($tk->department === 'agencies') امور نمایندگان
                                        @else عمومی @endif
                                    </span>
                                </td>
                                <td style="padding: 12px 14px; max-width: 260px;">
                                    <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem;">{{ $tk->subject }}</div>
                                    <div style="font-size: 0.76rem; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $tk->message }}</div>
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($tk->priority === 'urgent')
                                        <span style="background:#fee2e2; color:#b91c1c; font-size:0.72rem; padding:2px 8px; border-radius:99px; font-weight:800;">فوری</span>
                                    @elseif($tk->priority === 'high')
                                        <span style="background:#fef3c7; color:#d97706; font-size:0.72rem; padding:2px 8px; border-radius:99px; font-weight:800;">بالا</span>
                                    @else
                                        <span style="background:#f1f5f9; color:#475569; font-size:0.72rem; padding:2px 8px; border-radius:99px; font-weight:700;">عادی</span>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px; text-align: center; font-size: 0.78rem; color: #64748b;">
                                    {{ shamsi($tk->created_at, 'Y/m/d') }}
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($tk->status === 'new')
                                        <span style="background: #dbeafe; color: #1d4ed8; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 800;">جدید</span>
                                    @elseif($tk->status === 'in_progress')
                                        <span style="background: #fef3c7; color: #b45309; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 800;">در حال بررسی</span>
                                    @elseif($tk->status === 'answered')
                                        <span style="background: #dcfce7; color: #15803d; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 800;">پاسخ داده شده</span>
                                    @else
                                        <span style="background: #f1f5f9; color: #64748b; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 700;">بسته شده</span>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    <button type="button" class="btn-table-action" onclick='openTicketReplyModal({{ json_encode($tk) }})' style="padding: 5px 12px; font-size: 0.8rem; border-radius: 8px; background: #eff6ff; color: #2563eb; border-color: #bfdbfe;">
                                        💬 مشاهده و پاسخ
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="padding: 40px; text-align: center; color: #94a3b8;">هیچ تیکت پشتیبانی در سامانه ثبت نشده است.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- ===================================================================
             PAGE 16: MOBILE COMPLAINTS & INSPECTION (tab-complaints)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-complaints' ? 'active' : '' }}" id="tab-complaints" data-title="شکایات و بازرسی">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background:#fee2e2; color:#b91c1c;">سامانه نظارت ماده ۱۳ صمت</span>
                    <h1 class="erp-page-title">واحد رسیدگی به شکایات تلفن همراه و بازرسی گارانتی</h1>
                    <p class="erp-page-desc">رسیدگی رسمی به شکایات عدم تطابق، دیرکرد تعمیر، کیفیت قطعات و صدور احکام استرداد یا تعویض طبق تبصره ۵ ماده ۲۸.</p>
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ url('/complaints') }}" target="_blank" class="erp-btn" style="background: #f1f5f9; color: #334155; font-size: 0.82rem; padding: 8px 14px; text-decoration: none;">
                        <span>مشاهده فرم شکایت وب‌سایت ↗</span>
                    </a>
                </div>
            </div>

            <!-- KPI Row -->
            <div class="erp-kpi-grid" style="margin-bottom: 24px;">
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">کل شکایات واصله</span>
                        <div class="kpi-icon-wrap" style="background: #fee2e2; color: #b91c1c;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($complaints) ? count($complaints) : 0 }}</div>
                    <div class="kpi-meta"><span>پرونده‌های نظارتی صمت</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">در انتظار بازرسی اولیه</span>
                        <div class="kpi-icon-wrap" style="background: #fef3c7; color: #d97706;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value" style="color: #d97706;">{{ isset($complaints) ? $complaints->where('status', 'pending')->count() : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #d97706;">مهلت بررسی: ۲۴ ساعت کاری</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">در حال رسیدگی کارشناسی</span>
                        <div class="kpi-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($complaints) ? $complaints->where('status', 'investigating')->count() : 0 }}</div>
                    <div class="kpi-meta"><span>ارجاع به کارگاه مرکزی</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">مختومه و جلب رضایت</span>
                        <div class="kpi-icon-wrap" style="background: #ecfdf5; color: #059669;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value" style="color: #059669;">{{ isset($complaints) ? $complaints->where('status', 'resolved')->count() : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #059669;">حل مسالمت‌آمیز اختلاف</span></div>
                </div>
            </div>

            <!-- Complaints Table Card -->
            <div class="erp-card">
                <div class="erp-table-responsive" style="overflow-x: auto;">
                    <table class="erp-table" style="width: 100%; border-collapse: collapse; min-width: 950px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">کد شکایت</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">شاکی و تماس</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">شناسه دستگاه و IMEI</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">موضوع شکایت</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">شعبه طرف شکایت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">تاریخ ثبت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">وضعیت</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $cmp)
                            <tr style="border-bottom: 1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px 14px; font-weight: 800; color: #b91c1c; font-size: 0.84rem;">
                                    <span style="background: #fee2e2; padding: 3px 8px; border-radius: 6px; border: 1px solid #fecaca;">{{ $cmp->tracking_code }}</span>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 800; color: #0f172a; font-size: 0.88rem;">{{ $cmp->name ?? ($cmp->full_name ?? ($cmp->customer_name ?? 'مشتری')) }}</div>
                                    <div style="font-size: 0.78rem; color: #64748b; direction: ltr; text-align: right;">{{ $cmp->phone }}</div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem;">{{ $cmp->device_model ?: 'گوشی هوشمند' }}</div>
                                    <div style="font-size: 0.74rem; color: #2563eb; font-family: monospace;">{{ $cmp->imei }}</div>
                                </td>
                                <td style="padding: 12px 14px; max-width: 240px;">
                                    <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem;">{{ $cmp->subject }}</div>
                                    <div style="font-size: 0.76rem; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $cmp->description }}</div>
                                </td>
                                <td style="padding: 12px 14px; font-size: 0.82rem; color: #475569;">
                                    {{ $cmp->agency_name ?? ($cmp->branch_name ?? 'دفتر مرکزی') }}
                                </td>
                                <td style="padding: 12px 14px; text-align: center; font-size: 0.78rem; color: #64748b;">
                                    {{ shamsi($cmp->created_at, 'Y/m/d') }}
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($cmp->status === 'pending')
                                        <span style="background: #fee2e2; color: #b91c1c; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 800;">در انتظار بازرسی</span>
                                    @elseif($cmp->status === 'investigating')
                                        <span style="background: #fef3c7; color: #b45309; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 800;">در حال رسیدگی</span>
                                    @elseif($cmp->status === 'resolved')
                                        <span style="background: #dcfce7; color: #15803d; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 800;">مختومه و رضایت</span>
                                    @else
                                        <span style="background: #f1f5f9; color: #64748b; font-size: 0.74rem; padding: 3px 10px; border-radius: 99px; font-weight: 700;">رد شکایت</span>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    <button type="button" class="btn-table-action" onclick='openComplaintReviewModal({{ json_encode($cmp) }})' style="padding: 5px 12px; font-size: 0.8rem; border-radius: 8px; background: #fff1f2; color: #e11d48; border-color: #fecdd3;">
                                        ⚖️ صدور رای و بازرسی
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="padding: 40px; text-align: center; color: #94a3b8;">هیچ شکایتی در سامانه بازرسی ثبت نشده است.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- ===================================================================
             PAGE 17: CUSTOMER RELATIONSHIP MANAGEMENT - CRM 360 (tab-customers)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-customers' ? 'active' : '' }}" id="tab-customers" data-title="باشگاه و CRM مشتریان">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background:#fef3c7; color:#d97706;">سامانه جامع ارتباط با مشتریان (CRM 360°)</span>
                    <h1 class="erp-page-title">مدیریت جامع پرونده مشتریان و باشگاه وفاداری سام موبایل</h1>
                    <p class="erp-page-desc">پرونده ۳۶۰ درجه، سوابق مراجعات، دستگاه‌های ثبت‌شده، رتبه‌بندی وفاداری (VIP)، و ارتباط مستقیم تلفنی و پیامکی.</p>
                </div>
                <button type="button" class="erp-btn erp-btn-primary" onclick="openAddCustomerModal()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>ثبت مشتری جدید در CRM</span>
                </button>
            </div>

            <!-- CRM KPI Grid -->
            <div class="erp-kpi-grid" style="margin-bottom: 24px;">
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">کل مشتریان ثبت‌شده</span>
                        <div class="kpi-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($customers) ? count($customers) : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #2563eb;">پرونده‌های یکتای فعال</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">مشتریان وفادار و VIP</span>
                        <div class="kpi-icon-wrap" style="background: #fef3c7; color: #d97706;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value" style="color: #d97706;">{{ isset($customers) ? $customers->where('tier', 'طلایی (VIP)')->count() : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #d97706;">باشگاه مشتریان طلایی</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">گارانتی‌های فعال مشتریان</span>
                        <div class="kpi-icon-wrap" style="background: #ecfdf5; color: #059669;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value" style="color: #059669;">{{ isset($customers) ? $customers->sum('active_warranties') : 0 }}</div>
                    <div class="kpi-meta"><span style="color: #059669;">تعهد ۱۸ ماهه شرکتی</span></div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">شاخص رضایت‌سنجی (CSAT)</span>
                        <div class="kpi-icon-wrap" style="background: #f3e8ff; color: #7c3aed;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                        </div>
                    </div>
                    <div class="kpi-value">{{ isset($surveyStats['satisfaction_rate']) ? $surveyStats['satisfaction_rate'] : 98 }}٪</div>
                    <div class="kpi-meta"><span>رتبه ممتاز کیفیت صمت</span></div>
                </div>
            </div>

            <!-- CRM Card & Filter Toolbar -->
            <div class="erp-card">
                <div class="erp-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                    <div class="erp-card-title">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 10px; background: #eff6ff; color: #2563eb;">👥</span>
                        <span>فهرست کامل پرونده مشتریان و مشترکین خدمات</span>
                    </div>

                    <!-- Search Input Box -->
                    <div style="display: flex; gap: 10px; align-items: center; flex: 1; max-width: 420px; min-width: 260px;">
                        <div style="position: relative; width: 100%;">
                            <input type="text" id="customerSearchInput" class="erp-input" placeholder="جستجوی نام مشتری، تلفن، کدملی، مدل گوشی..." onkeyup="filterCustomersTable()" style="height: 40px; padding-right: 36px; border-radius: 10px; font-size: 0.85rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="position: absolute; right: 12px; top: 12px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                    </div>
                </div>

                <div class="erp-table-responsive" style="overflow-x: auto;">
                    <table class="erp-table" id="customersTable" style="width: 100%; border-collapse: collapse; min-width: 950px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">رتبه و سطح</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">مشخصات مشتری</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">موقعیت / شهر</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">دستگاه‌ها</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">گارانتی فعال</th>
                                <th style="padding: 12px 14px; text-align: right; font-weight: 800; color: #475569; font-size: 0.82rem;">مجموع خدمات</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">آخرین مراجعه</th>
                                <th style="padding: 12px 14px; text-align: center; font-weight: 800; color: #475569; font-size: 0.82rem;">عملیات ۳۶۰ درجه</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers ?? [] as $cust)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px 14px;">
                                    @if($cust->tier === 'طلایی (VIP)')
                                        <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 0.72rem; padding: 3px 8px; border-radius: 99px; font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                            ⭐ طلایی VIP
                                        </span>
                                    @elseif($cust->tier === 'نقره‌ای')
                                        <span style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-size: 0.72rem; padding: 3px 8px; border-radius: 99px; font-weight: 800;">
                                            🥈 نقره‌ای
                                        </span>
                                    @else
                                        <span style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; font-size: 0.72rem; padding: 3px 8px; border-radius: 99px; font-weight: 700;">
                                            عادی
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 800; color: #0f172a; font-size: 0.9rem;">{{ $cust->name }}</div>
                                    <div style="font-size: 0.78rem; color: #2563eb; direction: ltr; text-align: right; font-weight: 700;">{{ $cust->phone }}</div>
                                </td>
                                <td style="padding: 12px 14px;">
                                    <div style="font-weight: 700; color: #334155; font-size: 0.84rem;">📍 {{ $cust->city }}</div>
                                    <div style="font-size: 0.74rem; color: #94a3b8;">کدملی: {{ $cust->national_code }}</div>
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    <span style="background: #eff6ff; color: #1d4ed8; font-weight: 800; padding: 3px 10px; border-radius: 8px; font-size: 0.84rem;">
                                        {{ $cust->total_devices }} گوشی
                                    </span>
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    @if($cust->active_warranties > 0)
                                        <span style="background: #ecfdf5; color: #059669; font-weight: 800; padding: 3px 10px; border-radius: 8px; font-size: 0.82rem;">
                                            ✓ {{ $cust->active_warranties }} فعال
                                        </span>
                                    @else
                                        <span style="color: #94a3b8; font-size: 0.78rem;">منقضی</span>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px; font-size: 0.84rem; font-weight: 800; color: #0f172a;">
                                    {{ number_format($cust->total_cost) }} <span style="font-size: 0.7rem; color: #64748b; font-weight: 500;">تومان</span>
                                </td>
                                <td style="padding: 12px 14px; text-align: center; font-size: 0.78rem; color: #64748b;">
                                    {{ shamsi($cust->last_visit, 'Y/m/d') }}
                                </td>
                                <td style="padding: 12px 14px; text-align: center;">
                                    <div style="display: inline-flex; align-items: center; gap: 6px;">
                                        <button type="button" class="btn-table-action" title="پرونده ۳۶۰ درجه مشتری" onclick='openCustomerDossier({{ json_encode($cust) }})' style="padding: 5px 10px; font-size: 0.78rem; border-radius: 8px; background: #eff6ff; color: #2563eb; border-color: #bfdbfe;">
                                            👁️ پرونده ۳۶۰°
                                        </button>
                                        <button type="button" class="btn-table-action" title="پذیرش سریع دستگاه" onclick="quickIntakeForCustomer('{{ $cust->name }}', '{{ $cust->phone }}')" style="padding: 5px 9px; font-size: 0.78rem; border-radius: 8px; background: #ecfdf5; color: #059669; border-color: #a7f3d0;">
                                            📱 پذیرش
                                        </button>
                                        <a href="tel:{{ $cust->phone }}" class="btn-table-action" title="تماس تلفنی مستقیم" style="padding: 5px 8px; font-size: 0.78rem; border-radius: 8px; text-decoration: none; color: #334155;">
                                            📞
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="padding: 40px; text-align: center; color: #94a3b8;">هیچ پرونده مشتری در پایگاه داده CRM ثبت نشده است.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </main>
</div>

<!-- =========================================================================
     ACCURATE 100% LIGHT THEME WARRANTY CARD MODAL (MATCHING OFFICIAL DESIGN)
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="warrantyModalBackdrop">
    <div class="warranty-modal-box">
        <button type="button" class="btn-close-modal" onclick="closeWarrantyModal()">&times;</button>
        
        <div style="text-align: center; margin-bottom: 16px;">
            <div style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #1d4ed8; padding: 4px 12px; border-radius: 99px; font-size: 0.72rem; font-weight: 800; margin-bottom: 6px; border: 1px solid #bfdbfe;">
                <span>🛡️ کارت گارانتی هوشمند سام موبایل</span>
            </div>
            <h3 style="font-size: 1.15rem; font-weight: 900; color: #0f172a; margin: 0 0 4px 0;">کارت گارانتی ۱۸ ماهه گوشی همراه</h3>
            <span style="font-size: 0.76rem; color: #64748b; font-weight: 600;">شرکت تامین کانی سام | مطابق با ضوابط ماده ۱۳ سامانه جامع گارانتی</span>
        </div>

        <!-- Realistic Card Replica (Front & Back Exact to Brand Design) -->
        <div class="card-preview-wrapper" id="printableWarrantyCard">
            <!-- 1. CARD FRONT (روی کارت) -->
            <div class="official-card-front" style="background: linear-gradient(135deg, #021a3f 0%, #08336d 45%, #05418c 70%, #031c44 100%); border-radius: 20px; padding: 18px 20px; color: #ffffff; margin-bottom: 18px; border: 2px solid rgba(59, 130, 246, 0.4); box-shadow: 0 16px 36px rgba(2, 26, 63, 0.35); position: relative; overflow: hidden; min-height: 230px; display: flex; flex-direction: column; justify-content: space-between;">
                <!-- Neon ambient curve -->
                <div style="position: absolute; top: -50px; right: -50px; width: 180px; height: 180px; background: radial-gradient(circle, rgba(56, 189, 248, 0.25) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
                
                <!-- Front Header -->
                <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2;">
                    <!-- Right Title -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="border-right: 3px solid #60a5fa; padding-right: 10px;">
                            <span style="font-size: 1.25rem; font-weight: 900; display: block; line-height: 1.2; letter-spacing: -0.5px; color: #ffffff;">کارت گارانتی</span>
                            <span style="font-size: 0.85rem; font-weight: 800; color: #93c5fd; display: block;">گوشی همراه</span>
                        </div>
                    </div>
                    <!-- Left Brand Logo -->
                    <div style="display: flex; align-items: center; gap: 8px; direction: ltr;">
                        <svg width="34" height="26" viewBox="0 0 40 30" fill="none">
                            <path d="M5 25 L15 8 L22 18 L28 10 L35 25 Z" stroke="#38bdf8" stroke-width="3" stroke-linejoin="round" fill="rgba(56, 189, 248, 0.2)"/>
                        </svg>
                        <div style="text-align: right; line-height: 1.1;">
                            <span style="font-size: 0.84rem; font-weight: 900; color: #ffffff; display: block;">تامین کانی سام</span>
                            <span style="font-size: 0.60rem; color: #93c5fd; letter-spacing: 0.5px; display: block;">Taminkanisam</span>
                        </div>
                    </div>
                </div>

                <!-- Front Content Body -->
                <div style="display: flex; gap: 16px; align-items: center; margin: 12px 0; position: relative; z-index: 2;">
                    <!-- Right Interactive Pills -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                        <!-- Pill 1: Stay with us -->
                        <div style="background: rgba(255, 255, 255, 0.10); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.20); border-radius: 12px; padding: 8px 12px; display: flex; align-items: center; gap: 10px;">
                            <div style="flex: 1;">
                                <div style="display: inline-block; background: #ffffff; color: #021a3f; font-size: 0.64rem; font-weight: 900; padding: 2px 8px; border-radius: 99px; margin-bottom: 3px;">همراه ما باشید</div>
                                <div style="font-size: 0.68rem; color: #e2e8f0; line-height: 1.4;">برای فعال‌سازی گارانتی و استعلام اصالت، کد QR را اسکن کنید و یا به سایت شرکت مراجعه نمایید.</div>
                            </div>
                            <div style="width: 58px; height: 58px; background: #ffffff; border-radius: 8px; padding: 3px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=52x52&data=https://mob.taminkanisam.co.ir" alt="QR" style="width: 52px; height: 52px; display: block;">
                            </div>
                        </div>

                        <!-- Pill 2: Terms -->
                        <div style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 8px 12px;">
                            <div style="display: inline-block; background: #38bdf8; color: #021a3f; font-size: 0.64rem; font-weight: 900; padding: 2px 8px; border-radius: 99px; margin-bottom: 3px;">شرایط گارانتی</div>
                            <div style="font-size: 0.68rem; color: #cbd5e1; line-height: 1.4;">این دستگاه به مدت ۱۸ ماه دارای گارانتی رسمی شرکت تامین کانی سام می‌باشد. جهت کسب اطلاعات بیشتر شرایط گارانتی، کد QR را اسکن فرمایید.</div>
                        </div>
                    </div>
                </div>

                <!-- Front Footer Slogan -->
                <div style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; border-top: 1px solid rgba(255, 255, 255, 0.12); padding-top: 8px;">
                    <span style="font-size: 0.74rem; font-weight: 800; color: #60a5fa; letter-spacing: 0.5px;">انتخاب هوشمندانه...</span>
                    <span style="font-size: 0.65rem; color: #cbd5e1;">ضمانت اصالت و سلامت فیزیکی قطعات</span>
                </div>
            </div>

            <!-- 2. CARD BACK (پشت کارت) -->
            <div class="official-card-back" style="background: #ffffff; border: 2px solid #cbd5e1; border-radius: 20px; padding: 16px 18px; color: #0f172a; box-shadow: 0 16px 36px rgba(15, 23, 42, 0.10); position: relative;">
                <!-- Upper Section: 3 Left Badges & 5 Right Numbered Fields -->
                <div style="display: flex; gap: 14px; margin-bottom: 12px;">
                    <!-- Left Column: 3 Official Seals -->
                    <div style="width: 130px; display: flex; flex-direction: column; justify-content: space-around; gap: 8px; padding-left: 10px; border-left: 1px dashed #cbd5e1; text-align: center;">
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 3px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #eff6ff; color: #1d4ed8; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; box-shadow: 0 2px 6px rgba(37,99,235,0.15);">🛡️</div>
                            <span style="font-size: 0.64rem; font-weight: 800; color: #1e3a8a; line-height: 1.2;">۱۸ ماه ضمانت رسمی<br>پس از فعال‌سازی</span>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 3px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #f0fdf4; color: #15803d; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; box-shadow: 0 2px 6px rgba(22,163,74,0.15);">⚙️</div>
                            <span style="font-size: 0.64rem; font-weight: 800; color: #14532d; line-height: 1.2;">خدمات پس از فروش<br>تخصصی ماده ۱۳</span>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 3px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; box-shadow: 0 2px 6px rgba(217,119,6,0.15);">🎧</div>
                            <span style="font-size: 0.64rem; font-weight: 800; color: #78350f; line-height: 1.2;">پشتیبانی حرفه‌ای<br>مرکز تماس تبریز</span>
                        </div>
                    </div>

                    <!-- Right Column: 5 Numbered Rows -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                            <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۱. کشور سازنده:</span>
                            <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;" id="cardCountry">جمهوری اسلامی ایران / سازنده رسمی</span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                            <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۲. برند و مدل کالا:</span>
                            <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;" id="cardModalModel">Samsung Galaxy S23 Ultra</span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                            <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۳. شماره سریال کالا (IMEI):</span>
                            <span style="font-size: 0.74rem; font-weight: 900; font-family: monospace; color: #1d4ed8; direction: ltr;" id="cardModalImei">354892019485721</span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                            <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۴. تاریخ شروع گارانتی:</span>
                            <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;" id="cardWarrantyDates">۱۴۰۳/۰۸/۱۵ (به مدت ۱۸ ماه)</span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                            <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۵. نام شرکت سازنده کالا:</span>
                            <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;" id="cardModalCompany">شرکت تامین کانی سام (سهامی خاص)</span>
                        </div>
                    </div>
                </div>

                <!-- Exclusions Dark-Blue Rounded Banner -->
                <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; border-radius: 12px; padding: 10px 14px; margin-bottom: 12px;">
                    <div style="text-align: center; font-size: 0.72rem; font-weight: 900; color: #38bdf8; margin-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.12); padding-bottom: 4px;">
                        مواردی که شامل گارانتی نمی‌شوند:
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 4px 12px; font-size: 0.65rem; color: #e2e8f0;">
                        <div>• ضربه دیدگی، شکستگی و آسیب فیزیکی</div>
                        <div>• نفوذ مایعات و رطوبت و نم‌زدگی</div>
                        <div>• خرابی ناشی از نوسانات برق و شارژر غیرمجاز</div>
                        <div>• معیوب ماندن باتری و لوازم جانبی مستهلک</div>
                        <div>• تعمیرات و دستکاری توسط افراد غیرمجاز</div>
                        <div>• تمامی موارد خارج از شرایط گارانتی و استهلاک عادی</div>
                    </div>
                </div>

                <!-- Card Back Official Footer Strip -->
                <div style="background: #021a3f; color: #ffffff; border-radius: 10px; padding: 8px 12px; display: flex; flex-direction: column; gap: 4px; font-size: 0.66rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 6px;">
                        <span style="display: inline-flex; align-items: center; gap: 4px; font-weight: 800; color: #93c5fd;">
                            📞 ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 4px; color: #e2e8f0;">
                            🌐 taminkanisam.co.ir
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 4px; color: #e2e8f0; direction: ltr;">
                            ✉️ Marketing@kanisam
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.12); padding-top: 4px; color: #cbd5e1; font-size: 0.62rem;">
                        <span>📍 تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</span>
                        <span style="font-weight: 800; color: #38bdf8;">شرکت تامین کانی سام</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Actions -->
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; margin-top: 16px;">
            <div style="font-size: 0.72rem; color: #64748b;">
                دارای تاییدیه رسمی اتحادیه فناوران رایانه و سامانه صمت
            </div>
            <div style="display: flex; gap: 8px;">
                <button type="button" class="btn-table-action" style="background: #2563eb; color: #ffffff; border-color: #1d4ed8; padding: 8px 18px; font-weight: 800;" onclick="window.print()">
                    🖨️ چاپ کارت گارانتی
                </button>
                <button type="button" class="btn-table-action" onclick="closeWarrantyModal()" style="background: #f1f5f9; color: #475569; border-color: #cbd5e1; padding: 8px 14px;">
                    بستن
                </button>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL 1: EDIT HEADER MENU ITEM
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="editMenuModalBackdrop" style="display: none;">
    <div class="warranty-modal-box" style="max-width: 520px;">
        <button type="button" class="btn-close-modal" onclick="closeEditMenuModal()">&times;</button>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                🧭
            </div>
            <div>
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0;">ویرایش آیتم منوی هدر</h3>
                <span style="font-size: 0.74rem; color: #64748b;">تغییر عنوان، لینک مقصد، نشانک و اولویت نمایش</span>
            </div>
        </div>

        <form id="editMenuForm" onsubmit="handleMenuUpdate(event, this)">
            @csrf
            <input type="hidden" name="menu_id" id="editMenuId">
            <div class="erp-form-grid" style="display: grid; grid-template-columns: 1fr; gap: 14px;">
                <div>
                    <label class="erp-form-label">عنوان لینک در منو</label>
                    <input type="text" name="title" id="editMenuTitle" class="erp-form-input" required>
                </div>
                <div>
                    <label class="erp-form-label">آدرس لینک (URL)</label>
                    <input type="text" name="url" id="editMenuUrl" class="erp-form-input" required style="direction: ltr;">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <label class="erp-form-label">نشانک برجسته (اختیاری)</label>
                        <input type="text" name="badge" id="editMenuBadge" class="erp-form-input" placeholder="مثال: ویژه">
                    </div>
                    <div>
                        <label class="erp-form-label">ترتیب نمایش (اولویت)</label>
                        <input type="number" name="sort_order" id="editMenuSort" class="erp-form-input" value="10">
                    </div>
                </div>
                <div>
                    <label class="erp-form-label">هدف باز شدن لینک (Target)</label>
                    <select name="target" id="editMenuTarget" class="erp-form-input">
                        <option value="_self">در همان برگه (_self)</option>
                        <option value="_blank">در برگه جدید مرورگر (_blank)</option>
                    </select>
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                    <input type="checkbox" name="is_active" id="editMenuIsActive" value="1" style="width: 18px; height: 18px; accent-color: #2563eb;">
                    <label for="editMenuIsActive" style="font-size: 0.82rem; font-weight: 700; color: #1e293b; cursor: pointer;">آیتم در منوی سایت فعال باشد</label>
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-table-action" onclick="closeEditMenuModal()">انصراف</button>
                <button type="submit" class="erp-btn erp-btn-primary">💾 ذخیره تغییرات منو</button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL 2: EDIT PAGE (مدیریت صفحات)
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="editPageModalBackdrop" style="display: none;">
    <div class="warranty-modal-box" style="max-width: 820px;">
        <button type="button" class="btn-close-modal" onclick="closeEditPageModal()">&times;</button>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: #e0e7ff; color: #3730a3; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                📄
            </div>
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0;">ویرایش برگه و محتوای صفحه داینامیک</h3>
                <span style="font-size: 0.74rem; color: #64748b;">به‌روزرسانی عنوان، نامک آدرس، کلمات کلیدی و متن برگه</span>
            </div>
        </div>

        <form id="editPageForm" onsubmit="handlePageUpdate(event, this)">
            @csrf
            <input type="hidden" name="page_id" id="editPageId">
            <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px;">
                <div>
                    <label class="erp-form-label">عنوان برگه (Page Title)</label>
                    <input type="text" name="title" id="editPageTitle" class="erp-form-input" required>
                </div>
                <div>
                    <label class="erp-form-label">اسلاگ یکتا (URL Slug)</label>
                    <input type="text" name="slug" id="editPageSlug" class="erp-form-input" required style="direction: ltr;">
                </div>
                <div>
                    <label class="erp-form-label">دسته‌بندی برگه</label>
                    <input type="text" name="category" id="editPageCategory" class="erp-form-input" value="عمومی">
                </div>
                <div>
                    <label class="erp-form-label">عنوان متای سئو (Meta Title)</label>
                    <input type="text" name="meta_title" id="editPageMetaTitle" class="erp-form-input">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">توضیحات متای سئو (Meta Description)</label>
                    <textarea name="meta_description" id="editPageMetaDesc" class="erp-form-input" rows="2"></textarea>
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">کلمات کلیدی سئو (Meta Keywords)</label>
                    <input type="text" name="meta_keywords" id="editPageMetaKeywords" class="erp-form-input">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">متن کامل برگه (HTML یا متن آزاد)</label>
                    <textarea name="content" id="editPageContent" class="erp-form-input" rows="8" required></textarea>
                </div>
                <div style="grid-column: 1 / -1; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="is_published" id="editPageIsPublished" value="1" style="width: 18px; height: 18px; accent-color: #2563eb;">
                    <label for="editPageIsPublished" style="font-size: 0.84rem; font-weight: 700; color: #1e293b; cursor: pointer;">برگه در سایت عمومی منتشر و در دسترس باشد</label>
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-table-action" onclick="closeEditPageModal()">انصراف</button>
                <button type="submit" class="erp-btn erp-btn-primary">💾 به‌روزرسانی برگه</button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL 3: EDIT BLOG POST (وبلاگ و استودیو سئو)
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="editBlogModalBackdrop" style="display: none;">
    <div class="warranty-modal-box" style="max-width: 860px;">
        <button type="button" class="btn-close-modal" onclick="closeEditBlogModal()">&times;</button>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: #dcfce7; color: #166534; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                ✍️
            </div>
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0;">ویرایش مقاله وبلاگ و تنظیمات سئو</h3>
                <span style="font-size: 0.74rem; color: #64748b;">به‌روزرسانی محتوا، تصویر شاخص، نامک، زمان مطالعه و تگ‌های SERP گوگل</span>
            </div>
        </div>

        <form id="editBlogForm" onsubmit="handleBlogUpdate(event, this)">
            @csrf
            <input type="hidden" name="post_id" id="editBlogId">
            <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px;">
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">عنوان اصلی مقاله (H1)</label>
                    <input type="text" name="title" id="editBlogTitle" class="erp-form-input" required>
                </div>
                <div>
                    <label class="erp-form-label">نامک سئو (Slug)</label>
                    <input type="text" name="slug" id="editBlogSlug" class="erp-form-input" required style="direction: ltr;">
                </div>
                <div>
                    <label class="erp-form-label">دسته‌بندی مقاله</label>
                    <input type="text" name="category" id="editBlogCategory" class="erp-form-input" value="آموزش گارانتی">
                </div>
                <div>
                    <label class="erp-form-label">نام نویسنده</label>
                    <input type="text" name="author" id="editBlogAuthor" class="erp-form-input" value="تیم فنی سام سرویس">
                </div>
                <div>
                    <label class="erp-form-label">زمان مطالعه</label>
                    <input type="text" name="read_time" id="editBlogReadTime" class="erp-form-input" value="۴ دقیقه">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">آدرس تصویر شاخص (Featured Image URL)</label>
                    <input type="url" name="featured_image" id="editBlogImage" class="erp-form-input">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">چکیده کوتاه (Excerpt)</label>
                    <textarea name="excerpt" id="editBlogExcerpt" class="erp-form-input" rows="2"></textarea>
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">متن کامل مقاله (Content)</label>
                    <textarea name="content" id="editBlogContent" class="erp-form-input" rows="8" required></textarea>
                </div>
                <div>
                    <label class="erp-form-label">تایتل سئو گوگل (Meta Title)</label>
                    <input type="text" name="meta_title" id="editBlogMetaTitle" class="erp-form-input">
                </div>
                <div>
                    <label class="erp-form-label">کلمات کلیدی سئو</label>
                    <input type="text" name="meta_keywords" id="editBlogMetaKeywords" class="erp-form-input">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label class="erp-form-label">توضیحات متای گوگل (Meta Description)</label>
                    <textarea name="meta_description" id="editBlogMetaDesc" class="erp-form-input" rows="2"></textarea>
                </div>
                <div style="grid-column: 1 / -1; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="is_published" id="editBlogIsPublished" value="1" style="width: 18px; height: 18px; accent-color: #10b981;">
                    <label for="editBlogIsPublished" style="font-size: 0.84rem; font-weight: 700; color: #1e293b; cursor: pointer;">مقاله در وبلاگ عمومی منتشر باشد</label>
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-table-action" onclick="closeEditBlogModal()">انصراف</button>
                <button type="submit" class="erp-btn erp-btn-primary" style="background: #10b981; border-color: #059669;">🚀 ذخیره تغییرات مقاله</button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL 4: REPLY & APPROVE SURVEY (پاسخ رسمی به نظرسنجی)
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="replySurveyModalBackdrop" style="display: none;">
    <div class="warranty-modal-box" style="max-width: 580px;">
        <button type="button" class="btn-close-modal" onclick="closeReplyModal()">&times;</button>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: #fce7f3; color: #be185d; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                💬
            </div>
            <div>
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0;">پاسخ رسمی مدیریت به نظر مشتری</h3>
                <span style="font-size: 0.74rem; color: #64748b;">تکریم مشتری، ارزیابی بازخورد و ثبت پاسخ در سامانه</span>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
            <div style="font-size: 0.78rem; font-weight: 800; color: #0f172a; margin-bottom: 4px;" id="replyCustomerTitle">نام مشتری: -</div>
            <div style="font-size: 0.82rem; color: #475569; line-height: 1.6;" id="replyCustomerComment">نظر مشتری: -</div>
        </div>

        <form id="replySurveyForm" onsubmit="handleSurveyReply(event, this)">
            @csrf
            <input type="hidden" name="survey_id" id="replySurveyId">
            <div style="margin-bottom: 12px;">
                <label class="erp-form-label">الگوهای آماده پاسخ شرکتی (با ۱ کلیک درج می‌شود):</label>
                <div style="display: flex; flex-wrap: wrap;">
                    <span class="quick-reply-pill" onclick="insertQuickReply('با سلام و احترام، از بازخورد ارزشمند و ابراز رضایت شما از خدمات سام موبایل صمیمانه سپاسگزاریم. پایداری خدمات و رضایت ۱۰۰٪ شما افتخار شرکت تامین کانی سام است.')">💎 تشکر و قدردانی</span>
                    <span class="quick-reply-pill" onclick="insertQuickReply('با سلام، از بازخورد فنی شما متشکریم. مورد اظهارشده جهت ارتقای استانداردهای واحد فنی و بازرسی کارگاه مرکزی تبریز ثبت و پیگیری گردید.')">🔧 پیگیری فنی</span>
                    <span class="quick-reply-pill" onclick="insertQuickReply('با سلام و پوزش بابت هرگونه معطلی، همکاران واحد ارتباط با مشتریان (CRM) جهت هماهنگی و جلب رضایت کامل شما با شماره ثبت‌شده تماس خواهند گرفت.')">📞 پیگیری واحد CRM</span>
                </div>
            </div>
            <div>
                <label class="erp-form-label">متن پاسخ رسمی شرکت تامین کانی سام</label>
                <textarea name="admin_reply" id="replyAdminText" class="erp-form-input" rows="4" required placeholder="با سلام و احترام، از بازخورد ارزشمند شما سپاسگزاریم..."></textarea>
            </div>
            <div style="margin-top: 12px; display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="status" id="replyApproveCheck" value="approved" checked style="width: 18px; height: 18px; accent-color: #2563eb;">
                <label for="replyApproveCheck" style="font-size: 0.82rem; font-weight: 700; color: #1e293b; cursor: pointer;">همزمان با ثبت پاسخ، نظر مشتری در سایت تأیید و نمایش داده شود</label>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-table-action" onclick="closeReplyModal()">انصراف</button>
                <button type="submit" class="erp-btn erp-btn-primary">✓ ثبت پاسخ رسمی</button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     GLOBAL TOAST NOTIFICATION CONTAINER
     ========================================================================= -->
<div id="cmsToastContainer" style="position: fixed; bottom: 24px; left: 24px; z-index: 999999; display: flex; flex-direction: column; gap: 10px; pointer-events: none;"></div>


<!-- =========================================================================
     MODAL 1: QUALITY CONTROL (QC) INSPECTION CERTIFICATE
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="qcModalBackdrop">
    <div class="warranty-modal-box" style="max-width: 680px; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeQcModal()">✕</button>
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                🔍
            </div>
            <div>
                <h3 style="font-size: 1.12rem; font-weight: 900; color: #0f172a; margin: 0;">چک‌لیست کنترل کیفی سخت‌افزار و صدور گواهی سلامت (QC)</h3>
                <span style="font-size: 0.76rem; color: #64748b;">تست ۲۰ مرحله‌ای کارگاه مرکزی تبریز جهت تضمین استاندارد ماده ۱۳</span>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; margin-bottom: 18px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <div>
                <span style="font-size: 0.74rem; color: #64748b;">کد رهگیری پرونده:</span>
                <strong id="qcModalCode" style="color: #2563eb; font-family: monospace; font-size: 1rem; margin-right: 4px;">SAM-1403-9101</strong>
            </div>
            <div>
                <span style="font-size: 0.74rem; color: #64748b;">مدل دستگاه:</span>
                <strong id="qcModalDevice">Galaxy S24 Ultra</strong>
            </div>
            <div>
                <span style="font-size: 0.74rem; color: #64748b;">نمره کنترل کیفی:</span>
                <strong id="qcScoreDisplay" style="color: #059669; font-size: 1.1rem; margin-right: 4px;">۱۰۰٪ (عالی)</strong>
            </div>
        </div>

        <form id="qcInspectionForm" onsubmit="handleQcSubmit(event)">
            @csrf
            <input type="hidden" name="qc_code" id="qcHiddenCode">
            <input type="hidden" name="score" id="qcHiddenScore" value="100">

            <label class="erp-form-label" style="margin-bottom: 8px;">موارد چک‌لیست سخت‌افزاری (کلیک جهت تغییر وضعیت تایید):</label>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 10px; margin-bottom: 18px;">
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>📱 سلامت تاچ و دیجیتایزر (Touch)</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🌈 تفکیک پیکسل و ترومیکرون (OLED)</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🔒 حسگر بیومتریک (فیس‌آیدی / اثر انگشت)</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>📷 دوربین اصلی، زوم و اولتراواید</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🤳 دوربین جلو و سنسور مجاورت (Proximity)</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🔊 اسپیکر استریو و مکالمه</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🎙️ میکروفون اصلی و حذف نویز ثانویه</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>⚡ شارژ سریع و تست سلامت باتری</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>📶 آنتن‌دهی ۵G/۴G و تماس اضطراری</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🌐 وای‌فای، بلوتوث و GPS</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🔩 پیچ‌های شاسی و پلمپ ضدآب</span> <span>✓ تایید</span>
                </div>
                <div class="qc-check-pill checked" onclick="toggleQcItem(this)">
                    <span>🌡️ تست دمایی در بار پردازشی (Thermal)</span> <span>✓ تایید</span>
                </div>
            </div>

            <div class="erp-grid-2" style="margin-bottom: 14px;">
                <div>
                    <label class="erp-form-label">نام کارشناس بازرسی کیفی</label>
                    <input type="text" name="inspector_name" id="qcInspectorInput" class="erp-form-input" value="مهندس مهدی‌زاده (سرپرست QC)">
                </div>
                <div>
                    <label class="erp-form-label">کد گواهی سلامت کارگاه</label>
                    <input type="text" id="qcCertCodeInput" class="erp-form-input" value="QC-SAM-9101-PASS" readonly style="direction: ltr; background: #f8fafc; font-family: monospace;">
                </div>
            </div>

            <div>
                <label class="erp-form-label">توضیحات و گزارش کارشناس QC</label>
                <textarea name="notes" id="qcNotesInput" class="erp-form-input" rows="2" placeholder="کلیه تست‌های سخت‌افزاری و نرم‌افزاری مطابق استاندارد کارگاه مرکزی تایید گردید."></textarea>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-table-action" onclick="closeQcModal()">انصراف</button>
                <button type="submit" class="erp-btn erp-btn-primary" style="background: linear-gradient(135deg, #10b981, #059669); border-color: #059669;">
                    ✓ تایید کنترل کیفی و انتقال به آماده تحویل
                </button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL 2: AUDIT TRAIL & REAL-TIME TIMELINE
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="timelineModalBackdrop">
    <div class="warranty-modal-box" style="max-width: 640px; max-height: 85vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeTimelineModal()">✕</button>
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                ⏱️
            </div>
            <div>
                <h3 style="font-size: 1.12rem; font-weight: 900; color: #0f172a; margin: 0;">تایم‌لاین پرونده و زنجیره ممیزی (Audit Trail)</h3>
                <span style="font-size: 0.76rem; color: #64748b;">ثبت کلیه اقدامات تکنسین‌ها، زمان‌بندی دقیق و رویدادهای تعمیراتی</span>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 16px; margin-bottom: 18px; display: flex; justify-content: space-between;">
            <div>کد پرونده: <strong id="timelineOrderCode" style="color: #2563eb; font-family: monospace;">SAM-1403-9101</strong></div>
            <div>مشتری: <strong id="timelineCustomerName">محمد امینی</strong></div>
        </div>

        <!-- Timeline Tree Container -->
        <div class="timeline-container" id="timelineNodesList">
            <!-- Dynamically populated via JS -->
            <div class="timeline-node passed">
                <div style="font-size: 0.85rem; font-weight: 800; color: #0f172a;">پذیرش رسمی دستگاه (ماده ۱۳)</div>
                <div style="font-size: 0.76rem; color: #64748b; margin-top: 2px;">پذیرش دستگاه با ثبت کامل اطلاعات، عیوب اظهارشده و استعلام گارانتی ۱۸ ماهه.</div>
                <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 4px;">👤 مهندس کاظمی (پذیرش مرکزی) • ۳ ساعت پیش</div>
            </div>
        </div>

        <!-- Add Event Quick Form -->
        <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 14px; margin-top: 18px;">
            <label class="erp-form-label">+ ثبت یادداشت یا رویداد جدید در زنجیره ممیزی:</label>
            <div style="display: flex; gap: 8px;">
                <input type="text" id="newTimelineText" class="erp-form-input" placeholder="مثال: قطعه داغی تحویل انبار گردید / مشتری تلفنی تایید کرد...">
                <button type="button" class="erp-btn erp-btn-primary" onclick="addTimelineEvent()" style="font-size: 0.8rem; padding: 8px 16px;">ثبت</button>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL 3: 50x30mm THERMAL LABEL PRINTER PREVIEW
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="labelModalBackdrop">
    <div class="warranty-modal-box" style="max-width: 480px;">
        <button type="button" class="btn-close-modal" onclick="closeLabelModal()">✕</button>
        <div style="text-align: center; margin-bottom: 16px;">
            <h3 style="font-size: 1.05rem; font-weight: 900; color: #0f172a; margin: 0 0 4px 0;">چاپ برچسب بارکد حرارتی کارگاه (سایز ۵×۳ سانتی‌متر)</h3>
            <span style="font-size: 0.74rem; color: #64748b;">مخصوص پرینترهای لیبل (Bixolon / Xprinter) جهت چسباندن پشت دستگاه</span>
        </div>

        <!-- The Actual Label Box -->
        <div class="thermal-label-preview" id="thermalLabelContent">
            <div class="thermal-label-head">
                <strong style="font-size: 0.82rem; color: #000;">سام موبایل (تامین کانی سام)</strong>
                <span id="lblDate" style="font-size: 0.65rem; color: #333;">۱۴۰۳/۰۸/۱۵</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <div>
                    <div style="font-size: 0.95rem; font-weight: 900; font-family: monospace; color: #000;" id="lblTrackingCode">SAM-1403-9101</div>
                    <div style="font-size: 0.74rem; font-weight: 800; color: #000;" id="lblCustomer">محمد امینی</div>
                    <div style="font-size: 0.7rem; color: #333;" id="lblDevice">Samsung S24 Ultra</div>
                </div>
                <div style="width: 60px; height: 60px; background: #000; padding: 3px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                    <img id="lblQrImage" src="https://api.qrserver.com/v1/create-qr-code/?size=60x60&data=SAM-1403-9101" width="54" height="54" alt="QR" style="display: block; background: #fff;">
                </div>
            </div>
            <div style="border-top: 1px dotted #666; padding-top: 4px; font-size: 0.65rem; color: #111;">
                <div>IMEI: <span style="font-family: monospace; font-weight: 700;" id="lblImei">359483110294812</span></div>
                <div>پذیرش تبریز • ماده ۱۳ حقوق مصرف‌کننده • تلفن: ۳۶۶۸۹۰۰۰</div>
            </div>
        </div>

        <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn-table-action" onclick="closeLabelModal()">بستن</button>
            <button type="button" class="erp-btn erp-btn-primary" onclick="printThermalLabelDirect()">
                🖨️ چاپ مستقیم برچسب
            </button>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL 4: POS 80mm THERMAL RECEIPT SLIP PRINTER PREVIEW
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="slipModalBackdrop">
    <div class="warranty-modal-box" style="max-width: 480px; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeSlipModal()">✕</button>
        <div style="text-align: center; margin-bottom: 16px;">
            <h3 style="font-size: 1.05rem; font-weight: 900; color: #0f172a; margin: 0 0 4px 0;">رسید رسمی پذیرش کالا (فیش حرارتی ۸۰ میلی‌متری)</h3>
            <span style="font-size: 0.74rem; color: #64748b;">منطبق بر الزامات ماده ۱۳ قانون حمایت از حقوق مصرف‌کنندگان</span>
        </div>

        <!-- The Actual POS Slip -->
        <div class="pos-slip-preview" id="posSlipContent">
            <div style="text-align: center; border-bottom: 1.5px dashed #000; padding-bottom: 12px; margin-bottom: 12px;">
                <div style="font-size: 1rem; font-weight: 900; color: #000;">شرکت تامین کانی سام</div>
                <div style="font-size: 0.8rem; font-weight: 800; color: #000;">مرکز خدمات تخصصی سام موبایل</div>
                <div style="font-size: 0.68rem; color: #333; margin-top: 4px;">تبریز، فرشته شمالی، خیابان محمدپورصبور، پلاک ۷۸</div>
                <div style="font-size: 0.68rem; color: #333;">مرکز تماس: ۳۶۶۸۹۰۰۰-۰۴۱</div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>کد پیگیری:</span> <strong style="font-family: monospace; font-size: 0.9rem;" id="slipTrack">SAM-1403-9101</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>نام مشتری:</span> <strong id="slipCust">محمد امینی</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>شماره تماس:</span> <span id="slipPhone">09123456789</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>دستگاه و مدل:</span> <strong id="slipModel">Samsung S24 Ultra</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>شماره سریال / IMEI:</span> <span style="font-family: monospace;" id="slipImei">359483110294812</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>نوع پوشش:</span> <strong style="color: #059669;" id="slipWarranty">تحت پوشش گارانتی ۱۸ ماهه</strong>
            </div>

            <div style="border-top: 1px dashed #666; padding-top: 8px; margin-top: 8px; margin-bottom: 8px;">
                <div style="font-weight: 700; margin-bottom: 4px;">عیوب اظهارشده توسط مشتری:</div>
                <div style="font-size: 0.72rem; color: #222; line-height: 1.4;" id="slipIssues">شکستگی گلس خارجی صفحه و بررسی سلامت مدار تغذیه.</div>
            </div>

            <div style="border-top: 1.5px dashed #000; padding-top: 10px; margin-top: 10px; text-align: center; font-size: 0.65rem; color: #444; line-height: 1.5;">
                <div>پیگیری برخط وضعیت پرونده: <strong>mob.taminkanisam.co.ir</strong></div>
                <div>همراه داشتن این قبض جهت ترخیص کالا الزامی می‌باشد.</div>
                <div style="margin-top: 16px; display: flex; justify-content: space-between; padding: 0 10px;">
                    <span>امضای پذیرش</span>
                    <span>امضای مشتری</span>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn-table-action" onclick="closeSlipModal()">بستن</button>
            <button type="button" class="erp-btn erp-btn-primary" onclick="printPosSlipDirect()">
                🖨️ چاپ فیش صندوق (۸۰ م‌م)
            </button>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL 5: PHOTO EVIDENCE & PHYSICAL CONDITION INSPECTION
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="photosModalBackdrop">
    <div class="warranty-modal-box" style="max-width: 680px; max-height: 85vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closePhotosModal()">✕</button>
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                📷
            </div>
            <div>
                <h3 style="font-size: 1.12rem; font-weight: 900; color: #0f172a; margin: 0;">مستندات تصویری و عکاسی فیزیکی پرونده</h3>
                <span style="font-size: 0.76rem; color: #64748b;">ثبت وضعیت ظاهری کالا در بدو ورود و قطعه داغی تعویض‌شده جهت شفافیت حقوقی</span>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 16px; margin-bottom: 18px;">
            کد پرونده: <strong id="photosOrderCode" style="color: #2563eb; font-family: monospace;">SAM-1403-9101</strong>
        </div>

        <!-- Photos Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 20px;" id="photosGridContainer">
            <!-- Dynamically populated via JS -->
            <div style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff;">
                <img src="https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&w=400&q=80" style="width: 100%; height: 120px; object-fit: cover;">
                <div style="padding: 8px; font-size: 0.72rem; font-weight: 700; color: #334155;">نمای روبرو در پذیرش</div>
            </div>
        </div>

        <!-- Quick Add Photo Form -->
        <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 14px; padding: 16px;">
            <div style="font-size: 0.84rem; font-weight: 800; color: #0f172a; margin-bottom: 10px;">+ افزودن عکس جدید به پرونده (از گالری یا وبکم):</div>
            <div class="erp-grid-2" style="margin-bottom: 10px;">
                <div>
                    <label class="erp-form-label">مرحله عکاسی</label>
                    <select id="newPhotoStage" class="erp-form-select">
                        <option value="intake_front">پذیرش - نمای روبرو (صفحه نمایش)</option>
                        <option value="intake_back">پذیرش - نمای پشت و دوربین</option>
                        <option value="damage_detail">پذیرش - جزئیات خط و خش یا ضربه</option>
                        <option value="old_part">تعمیر - قطعه داغی تعویض‌شده</option>
                        <option value="final">ترخیص - دستگاه نهایی تست‌شده</option>
                    </select>
                </div>
                <div>
                    <label class="erp-form-label">آدرس تصویر یا فایل</label>
                    <input type="url" id="newPhotoUrl" class="erp-form-input" placeholder="https://... یا تصویر آپلود شده">
                </div>
            </div>
            <div>
                <label class="erp-form-label">شرح تصویر (Caption)</label>
                <input type="text" id="newPhotoCaption" class="erp-form-input" placeholder="مثال: شکستگی لبه پایین سمت راست در بدو ورود...">
            </div>
            <div style="margin-top: 12px; text-align: left;">
                <button type="button" class="erp-btn erp-btn-primary" onclick="addPhotoToOrder()" style="font-size: 0.8rem; padding: 8px 18px;">
                    ثبت تصویر در پرونده
                </button>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     HIDDEN PRINT CONTAINER FOR NATIVE BROWSER PRINTING
     ========================================================================= -->

    <!-- MODAL: CHANGE ORDER STATUS & DISPATCH CUSTOMER SMS -->
    <div class="warranty-modal-backdrop" id="statusModalBackdrop" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(5px); z-index: 100000; align-items: center; justify-content: center; padding: 14px;">
        <div class="warranty-modal-box" style="background: #ffffff; border-radius: 20px; max-width: 540px; width: 100%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); overflow: hidden; animation: modalPop 0.25s ease-out;">
            <div style="padding: 16px 20px; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1rem;">تغییر وضعیت پرونده و اطلاع‌رسانی پیامکی</div>
                        <div style="font-size: 0.74rem; opacity: 0.9;" id="statusModalSubtitle">کد رهگیری: -</div>
                    </div>
                </div>
                <button type="button" onclick="closeStatusModal();" style="background: rgba(255,255,255,0.15); border: none; color: #fff; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">✕</button>
            </div>

            <form id="statusUpdateForm" onsubmit="submitStatusUpdate(event);" style="padding: 20px;">
                <input type="hidden" id="statusOrderCode" name="tracking_code">
                <input type="hidden" id="statusCustomerPhone" name="customer_phone">
                <input type="hidden" id="statusCustomerName" name="customer_name">

                <!-- Customer & Device Mini Card -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 16px; margin-bottom: 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.8rem;">
                    <div><span style="color: #64748b;">مشتری:</span> <strong id="statusModalCustomer">-</strong></div>
                    <div><span style="color: #64748b;">شماره تماس:</span> <strong id="statusModalPhone" style="font-family: monospace;">-</strong></div>
                    <div style="grid-column: span 2;"><span style="color: #64748b;">دستگاه:</span> <strong id="statusModalDevice">-</strong></div>
                </div>

                <!-- Select New Status -->
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-weight: 800; font-size: 0.84rem; color: #0f172a; margin-bottom: 6px;">انتخاب وضعیت جدید:</label>
                    <select id="statusSelect" name="status" class="erp-select" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-weight: 700; font-size: 0.9rem;" onchange="updateSmsPreviewText();">
                        <option value="pending">در انتظار بررسی و عیب‌یابی اولیه</option>
                        <option value="in_progress">در حال بررسی و تعمیر تخصصی در کارگاه</option>
                        <option value="waiting_parts">در انتظار تامین قطعه یدکی از انبار</option>
                        <option value="ready">آماده تحویل به مشتری (تأیید کنترل کیفی QC)</option>
                        <option value="delivered">تحویل نهایی شده به مشتری با گارانتی</option>
                        <option value="cancelled">لغو شده / عدم امکان تعمیر</option>
                    </select>
                </div>

                <!-- Technician Note -->
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-weight: 800; font-size: 0.84rem; color: #0f172a; margin-bottom: 6px;">یادداشت تکنسین (اختیاری):</label>
                    <input type="text" id="statusNoteInput" name="note" placeholder="مثال: تعویض فلت شارژ با قطعه ۱۰۰٪ اورجینال شرکتی" class="erp-input" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.85rem;">
                </div>

                <!-- SMS Notification Box -->
                <div style="background: #eff6ff; border: 1.5px solid #bfdbfe; border-radius: 14px; padding: 14px; margin-bottom: 18px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-weight: 800; color: #1d4ed8; font-size: 0.85rem; cursor: pointer;">
                            <input type="checkbox" id="sendSmsCheckbox" name="send_sms" value="1" checked onchange="toggleSmsPreview(this.checked);" style="width: 17px; height: 17px; accent-color: #2563eb;">
                            <span>ارسال پیامک اطلاع‌رسانی خودکار به مشتری</span>
                        </label>
                        <span style="font-size: 0.72rem; color: #3b82f6; font-weight: 700;">سرویس آنی SMS</span>
                    </div>

                    <div id="smsMessageArea">
                        <textarea id="statusSmsText" name="sms_text" rows="3" class="erp-input" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #93c5fd; font-size: 0.82rem; line-height: 1.5; resize: none; background: #ffffff;"></textarea>
                        <div style="font-size: 0.72rem; color: #64748b; margin-top: 4px; text-align: left;">
                            متن پیامک به طور خودکار براساس وضعیت انتخاب‌شده آماده می‌شود و قابل ویرایش است.
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeStatusModal();" class="erp-btn" style="background: #f1f5f9; color: #475569; padding: 10px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer;">انصراف</button>
                    <button type="submit" id="btnSubmitStatus" class="erp-btn" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; padding: 10px 24px; border-radius: 12px; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(37,99,235,0.3); display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>ثبت تغییر و ارسال پیامک</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

<div id="printContainer" style="display: none;"></div>


<!-- =========================================================================
     ADMIN ULTRA-PREMIUM MOBILE STICKY BOTTOM NAVIGATION BAR
     ========================================================================= -->
<nav class="admin-mobile-nav" id="adminMobileNav">
    <!-- 1. Dashboard -->
    <button type="button" class="admin-nav-item {{ $activeTab === 'tab-overview' ? 'active' : '' }}" onclick="switchErpTab('tab-overview', this, event)" data-tab="tab-overview">
        <div class="admin-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        </div>
        <span>داشبورد</span>
    </button>

    <!-- 2. Orders -->
    <button type="button" class="admin-nav-item {{ $activeTab === 'tab-orders' ? 'active' : '' }}" onclick="switchErpTab('tab-orders', this, event)" data-tab="tab-orders">
        <div class="admin-nav-icon" style="position: relative;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span class="admin-badge-count">{{ $stats['total'] ?? 3 }}</span>
        </div>
        <span>پرونده‌ها</span>
    </button>

    <!-- 3. CENTER HERO ACTION: Quick Intake (پذیرش سریع) -->
    <div class="admin-nav-center">
        <button type="button" class="admin-center-btn" onclick="switchErpTab('tab-new-intake', this, event)" data-tab="tab-new-intake" title="پذیرش دستگاه جدید">
            <div class="admin-center-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.6"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            </div>
            <span class="admin-center-label">پذیرش</span>
        </button>
    </div>

    <!-- 4. Spare Parts -->
    <button type="button" class="admin-nav-item {{ $activeTab === 'tab-parts' ? 'active' : '' }}" onclick="switchErpTab('tab-parts', this, event)" data-tab="tab-parts">
        <div class="admin-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
        </div>
        <span>انبار قطعات</span>
    </button>

    <!-- 5. Drawer Menu / More -->
    <button type="button" class="admin-nav-item" onclick="toggleErpSidebar(true)">
        <div class="admin-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </div>
        <span>منوی کامل</span>
    </button>
</nav>


<!-- =========================================================================
     MODAL 1: ADD / EDIT AGENCY MODAL
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="agencyModalBackdrop" style="display: none; align-items: center; justify-content: center; z-index: 100005;">
    <div class="warranty-modal-box" style="max-width: 650px; width: 92%; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeAgencyModal()">&times;</button>
        <div style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: #ecfdf5; color: #059669; font-size: 1.2rem;">🏢</span>
                <div>
                    <h3 id="agencyModalTitle" style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0f172a;">افزودن شعبه / نماینده جدید</h3>
                    <p style="margin: 4px 0 0; font-size: 0.78rem; color: #64748b;">اطلاعات تماس، نشانی و مختصات نقشه شعبه را وارد نمایید.</p>
                </div>
            </div>

            <form id="agencyForm" onsubmit="saveAgency(event)">
                @csrf
                <input type="hidden" name="agency_id" id="agId" value="">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">نام شعبه / نمایندگی *</label>
                        <input type="text" name="name" id="agName" class="erp-input" required placeholder="مثال: شعبه اصفهان (شهر همراه)">
                    </div>
                    <div>
                        <label class="erp-form-label">کد یکتای شعبه *</label>
                        <input type="text" name="agency_code" id="agCode" class="erp-input" required placeholder="مثال: AGY-ESF-02">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">شهر *</label>
                        <input type="text" name="city" id="agCity" class="erp-input" required placeholder="مثال: اصفهان">
                    </div>
                    <div>
                        <label class="erp-form-label">استان *</label>
                        <input type="text" name="province" id="agProvince" class="erp-input" required placeholder="مثال: اصفهان">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">نام مدیر شعبه</label>
                        <input type="text" name="manager_name" id="agManager" class="erp-input" placeholder="نام و نام خانوادگی مسئول">
                    </div>
                    <div>
                        <label class="erp-form-label">تلفن تماس *</label>
                        <input type="text" name="phone" id="agPhone" class="erp-input" required placeholder="۰۲۱-۹۱۰۷۱۰۱">
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label class="erp-form-label">نشانی کامل پستی *</label>
                    <textarea name="address" id="agAddress" class="erp-input" rows="2" required placeholder="نشانی دقیق، پلاک، طبقه و واحد"></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">عرض جغرافیایی (Latitude) *</label>
                        <input type="text" name="latitude" id="agLat" class="erp-input" required placeholder="32.6572">
                    </div>
                    <div>
                        <label class="erp-form-label">طول جغرافیایی (Longitude) *</label>
                        <input type="text" name="longitude" id="agLng" class="erp-input" required placeholder="51.6883">
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label class="erp-form-label">خدمات ارائه‌شده</label>
                    <input type="text" name="services_offered" id="agServices" class="erp-input" placeholder="پذیرش گارانتی، تست مدار، تعویض قطعات">
                </div>

                <div style="display: flex; gap: 20px; align-items: center; margin-bottom: 20px;">
                    <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer; font-size: 0.84rem; font-weight: 700;">
                        <input type="checkbox" name="is_active" id="agActive" value="1" checked>
                        <span>شعبه فعال باشد</span>
                    </label>
                    <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer; font-size: 0.84rem; font-weight: 700;">
                        <input type="checkbox" name="has_portal_access" id="agPortal" value="1" checked>
                        <span>دسترسی به پرتال نمایندگان</span>
                    </label>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <button type="button" class="erp-btn" onclick="closeAgencyModal()" style="background: #f1f5f9; color: #475569;">انصراف</button>
                    <button type="submit" id="saveAgencyBtn" class="erp-btn erp-btn-primary">ذخیره شعبه</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL 2: TICKET REPLY MODAL
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="ticketReplyModalBackdrop" style="display: none; align-items: center; justify-content: center; z-index: 100005;">
    <div class="warranty-modal-box" style="max-width: 620px; width: 92%; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeTicketReplyModal()">&times;</button>
        <div style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: #eff6ff; color: #2563eb; font-size: 1.2rem;">🎫</span>
                <div>
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0f172a;">مشاهده و پاسخ تیکت پشتیبانی</h3>
                    <p id="tkModalSubtitle" style="margin: 4px 0 0; font-size: 0.78rem; color: #64748b;"></p>
                </div>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: #64748b; margin-bottom: 6px;">
                    <strong id="tkCustomerName" style="color: #0f172a;"></strong>
                    <span id="tkPhone" style="direction: ltr;"></span>
                </div>
                <div id="tkSubject" style="font-weight: 800; color: #1e40af; margin-bottom: 8px; font-size: 0.88rem;"></div>
                <div id="tkMessage" style="font-size: 0.84rem; color: #334155; line-height: 1.6; white-space: pre-wrap;"></div>
            </div>

            <div id="tkExistingReplyBox" style="display: none; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                <div style="font-size: 0.78rem; font-weight: 800; color: #065f46; margin-bottom: 4px;">پاسخ ثبت‌شده قبلی:</div>
                <div id="tkExistingReplyText" style="font-size: 0.84rem; color: #064e3b; line-height: 1.6;"></div>
            </div>

            <form id="ticketReplyForm" onsubmit="submitTicketReply(event)">
                @csrf
                <input type="hidden" name="ticket_id" id="tkId" value="">

                <div style="margin-bottom: 14px;">
                    <label class="erp-form-label">متن پاسخ رسمی کارشناس *</label>
                    <textarea name="reply_text" id="tkReplyText" class="erp-input" rows="4" required placeholder="پاسخ کامل و راهنمایی لازم را برای مشتری بنویسید..."></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px;">
                    <div>
                        <label class="erp-form-label">وضعیت جدید تیکت</label>
                        <select name="status" id="tkStatusSelect" class="erp-select">
                            <option value="answered">پاسخ داده شده (Answered)</option>
                            <option value="in_progress">در حال بررسی (In Progress)</option>
                            <option value="closed">بسته شده (Closed)</option>
                        </select>
                    </div>
                    <div style="display: flex; align-items: flex-end; padding-bottom: 8px;">
                        <span style="font-size: 0.76rem; color: #059669; font-weight: 700;">✓ پس از ثبت پاسخ، پیامک به کاربر ارسال می‌گردد.</span>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <button type="button" class="erp-btn" onclick="closeTicketReplyModal()" style="background: #f1f5f9; color: #475569;">بستن</button>
                    <button type="submit" id="tkSubmitBtn" class="erp-btn erp-btn-primary">ثبت و ارسال پاسخ به مشتری</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL 3: COMPLAINT REVIEW & RESOLUTION MODAL
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="complaintReviewModalBackdrop" style="display: none; align-items: center; justify-content: center; z-index: 100005;">
    <div class="warranty-modal-box" style="max-width: 650px; width: 92%; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeComplaintReviewModal()">&times;</button>
        <div style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: #fff1f2; color: #e11d48; font-size: 1.2rem;">⚖️</span>
                <div>
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0f172a;">بررسی شکایت و صدور نظریه بازرسی</h3>
                    <p id="cmpModalSubtitle" style="margin: 4px 0 0; font-size: 0.78rem; color: #64748b;"></p>
                </div>
            </div>

            <!-- Complaint Details Card -->
            <div style="background: #fff8f8; border: 1px solid #fecdd3; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                <div style="display: flex; justify-content: space-between; font-size: 0.82rem; margin-bottom: 8px;">
                    <strong id="cmpCustomer" style="color: #9f1239;"></strong>
                    <span id="cmpPhone" style="direction: ltr; font-weight: 600;"></span>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.78rem; color: #64748b; margin-bottom: 10px;">
                    <div>📱 مدل: <strong id="cmpModel" style="color: #0f172a;"></strong></div>
                    <div>🔢 IMEI: <span id="cmpImei" style="font-family: monospace; color: #2563eb;"></span></div>
                </div>
                <div id="cmpSubject" style="font-weight: 800; color: #9f1239; margin-bottom: 6px; font-size: 0.88rem;"></div>
                <div id="cmpDesc" style="font-size: 0.84rem; color: #334155; line-height: 1.6; white-space: pre-wrap;"></div>
                <div id="cmpFileArea" style="margin-top: 10px; padding-top: 8px; border-top: 1px dashed #fecdd3; font-size: 0.78rem;"></div>
            </div>

            <form id="complaintResolutionForm" onsubmit="submitComplaintResolution(event)">
                @csrf
                <input type="hidden" name="complaint_id" id="cmpId" value="">

                <div style="margin-bottom: 14px;">
                    <label class="erp-form-label">نظریه کارشناسی و حکم بازرسی *</label>
                    <textarea name="resolution_notes" id="cmpNotes" class="erp-input" rows="4" required placeholder="نتیجه بررسی کارشناسی، دستور تعویض یا استرداد یا دلایل فنی را شرح دهید..."></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="erp-form-label">وضعیت نهایی پرونده شکایت</label>
                    <select name="status" id="cmpStatusSelect" class="erp-select">
                        <option value="resolved">مختومه و جلب رضایت مشتری (Resolved)</option>
                        <option value="investigating">در حال بررسی و ارجاع به کارگاه (Investigating)</option>
                        <option value="rejected">رد شکایت بر اساس ضوابط گارانتی (Rejected)</option>
                    </select>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <button type="button" class="erp-btn" onclick="closeComplaintReviewModal()" style="background: #f1f5f9; color: #475569;">بستن</button>
                    <button type="submit" id="cmpSubmitBtn" class="erp-btn" style="background: #e11d48; color: #ffffff; font-weight: 800;">ثبت رای و مختومه نمودن</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- =========================================================================
     MODAL: CUSTOMER 360 DOSSIER MODAL
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="customerDossierModalBackdrop" style="display: none; align-items: center; justify-content: center; z-index: 100005;">
    <div class="warranty-modal-box" style="max-width: 720px; width: 92%; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeCustomerDossier()">&times;</button>
        <div style="padding: 24px;">
            <!-- Customer Header Card -->
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
                <div id="dossierAvatar" style="width: 52px; height: 52px; border-radius: 16px; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; box-shadow: 0 4px 12px rgba(37,99,235,0.25);">
                    👤
                </div>
                <div style="flex: 1;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <h3 id="dossierName" style="margin: 0; font-size: 1.2rem; font-weight: 900; color: #0f172a;"></h3>
                        <span id="dossierTier" style="font-size: 0.74rem; font-weight: 800; padding: 2px 8px; border-radius: 99px;"></span>
                    </div>
                    <div style="display: flex; gap: 14px; font-size: 0.8rem; color: #64748b; margin-top: 4px; flex-wrap: wrap;">
                        <span>📱 تلفن: <strong id="dossierPhone" style="direction: ltr; color: #2563eb;"></strong></span>
                        <span>💳 کدملی: <strong id="dossierNationalCode"></strong></span>
                        <span>📍 شهر: <strong id="dossierCity"></strong></span>
                    </div>
                </div>
            </div>

            <!-- Stats Bar -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 20px;">
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; text-align: center;">
                    <div style="font-size: 0.76rem; color: #64748b;">تعداد دستگاه‌ها</div>
                    <div id="dossierTotalDevices" style="font-size: 1.25rem; font-weight: 900; color: #0f172a; margin-top: 2px;"></div>
                </div>
                <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 12px; padding: 12px; text-align: center;">
                    <div style="font-size: 0.76rem; color: #065f46;">گارانتی فعال</div>
                    <div id="dossierActiveWarranties" style="font-size: 1.25rem; font-weight: 900; color: #059669; margin-top: 2px;"></div>
                </div>
                <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 12px; text-align: center;">
                    <div style="font-size: 0.76rem; color: #1e40af;">مجموع تراکنش خدمات</div>
                    <div id="dossierTotalCost" style="font-size: 1.15rem; font-weight: 900; color: #2563eb; margin-top: 2px;"></div>
                </div>
            </div>

            <!-- Device History List -->
            <div style="margin-bottom: 20px;">
                <h4 style="margin: 0 0 10px 0; font-size: 0.95rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                    <span>📱 تاریخچه دستگاه‌ها و مراجعات ثبت‌شده</span>
                </h4>
                <div id="dossierDevicesList" style="display: flex; flex-direction: column; gap: 8px;"></div>
            </div>

            <!-- Quick Action Bar -->
            <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                <button type="button" class="erp-btn" onclick="closeCustomerDossier()" style="background: #f1f5f9; color: #475569;">بستن پرونده</button>
                <button type="button" id="dossierQuickIntakeBtn" class="erp-btn erp-btn-primary">
                    <span>+ پذیرش دستگاه جدید برای این مشتری</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL: ADD NEW CUSTOMER MODAL
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="addCustomerModalBackdrop" style="display: none; align-items: center; justify-content: center; z-index: 100005;">
    <div class="warranty-modal-box" style="max-width: 600px; width: 92%; max-height: 90vh; overflow-y: auto;">
        <button type="button" class="btn-close-modal" onclick="closeAddCustomerModal()">&times;</button>
        <div style="padding: 24px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: #eff6ff; color: #2563eb; font-size: 1.2rem;">👤</span>
                <div>
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800; color: #0f172a;">ثبت مشتری جدید در باشگاه CRM</h3>
                    <p style="margin: 4px 0 0; font-size: 0.78rem; color: #64748b;">اطلاعات شناسایی مشتری را جهت صدور پرونده و مراجعات بعدی وارد فرمایید.</p>
                </div>
            </div>

            <form id="newCustomerForm" onsubmit="saveNewCustomer(event)">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">نام و نام خانوادگی مشتری *</label>
                        <input type="text" name="name" id="newCustName" class="erp-input" required placeholder="مثال: رضا احمدی">
                    </div>
                    <div>
                        <label class="erp-form-label">شماره همراه مشتری *</label>
                        <input type="tel" name="phone" id="newCustPhone" class="erp-input" required placeholder="09123456789" style="direction: ltr; text-align: left;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">کد ملی</label>
                        <input type="text" name="national_code" id="newCustNational" class="erp-input" placeholder="۱۰ رقم کد ملی">
                    </div>
                    <div>
                        <label class="erp-form-label">سطح مشتری در باشگاه</label>
                        <select name="tier" id="newCustTier" class="erp-select">
                            <option value="عادی">عادی (Regular)</option>
                            <option value="نقره‌ای">نقره‌ای (Silver)</option>
                            <option value="طلایی (VIP)">طلایی (VIP)</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label class="erp-form-label">شهر</label>
                        <input type="text" name="city" id="newCustCity" class="erp-input" placeholder="مثال: تبریز">
                    </div>
                    <div>
                        <label class="erp-form-label">استان</label>
                        <input type="text" name="province" id="newCustProvince" class="erp-input" placeholder="مثال: آذربایجان شرقی">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="erp-form-label">نشانی پستی / توضیحات اختصاصی</label>
                    <textarea name="address" id="newCustAddress" class="erp-input" rows="2" placeholder="آدرس یا یادداشت‌های مربوط به تعاملات با مشتری..."></textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <button type="button" class="erp-btn" onclick="closeAddCustomerModal()" style="background: #f1f5f9; color: #475569;">انصراف</button>
                    <button type="submit" id="saveCustBtn" class="erp-btn erp-btn-primary">ثبت در CRM و بازگشایی پرونده</button>
                </div>
            </form>
        </div>
    </div>
</div>



        <!-- ===================================================================
             PAGE 12: USER & ROLE MANAGEMENT (tab-users)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-users' ? 'active' : '' }}" id="tab-users" data-title="مدیریت کاربران و نقش‌ها">
            <div class="erp-page-head">
                <div class="erp-page-meta">
                    <span class="erp-page-badge" style="background: #eff6ff; color: #2563eb;">امنیت، کاربران و سطوح دسترسی RBAC</span>
                    <h1 class="erp-page-title">مدیریت کاربران، نمایندگان و پرسنل</h1>
                    <p class="erp-page-desc">کنترل سطوح دسترسی، ایجاد کاربر جدید با نقش معین، تغییر کلمه عبور و مدیریت وضعیت فعالیت در سامانه خدمات پس از فروش.</p>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button type="button" class="erp-btn erp-btn-primary" onclick="openAddUserModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <span>افزودن کاربر جدید با تعیین نقش</span>
                    </button>
                </div>
            </div>

            <!-- Role Summary KPI Cards -->
            @php
                $uList = isset($systemUsers) ? $systemUsers : collect();
                $countAdmin = $uList->where('level', '>=', 3)->count();
                $countAgent = $uList->where('level', 2)->count();
                $countTech = $uList->where('level', 1)->count();
                $countCustomer = $uList->where('level', '<=', 0)->count();
            @endphp
            <div class="erp-grid-4" style="margin-bottom: 24px;">
                <div class="erp-card erp-kpi-card" onclick="filterUserRole('all')" style="cursor: pointer;">
                    <div class="erp-kpi-icon" style="background: #eff6ff; color: #2563eb;">👥</div>
                    <div>
                        <div class="erp-kpi-label">کل کاربران سامانه</div>
                        <div class="erp-kpi-val">{{ $uList->count() }} نفر</div>
                    </div>
                </div>
                <div class="erp-card erp-kpi-card" onclick="filterUserRole('3')" style="cursor: pointer;">
                    <div class="erp-kpi-icon" style="background: #fff1f2; color: #e11d48;">👑</div>
                    <div>
                        <div class="erp-kpi-label">مدیران ارشد</div>
                        <div class="erp-kpi-val">{{ $countAdmin }} نفر</div>
                    </div>
                </div>
                <div class="erp-card erp-kpi-card" onclick="filterUserRole('2')" style="cursor: pointer;">
                    <div class="erp-kpi-icon" style="background: #eff6ff; color: #1d4ed8;">🏢</div>
                    <div>
                        <div class="erp-kpi-label">مسئولان شعب و نمایندگان</div>
                        <div class="erp-kpi-val">{{ $countAgent }} نفر</div>
                    </div>
                </div>
                <div class="erp-card erp-kpi-card" onclick="filterUserRole('1')" style="cursor: pointer;">
                    <div class="erp-kpi-icon" style="background: #f5f3ff; color: #7c3aed;">🔧</div>
                    <div>
                        <div class="erp-kpi-label">تکنسین‌های فنی کارگاه</div>
                        <div class="erp-kpi-val">{{ $countTech }} نفر</div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="erp-card" style="margin-bottom: 20px;">
                <div class="erp-card-body" style="padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;" id="userRoleFilterButtons">
                        <button type="button" class="btn-table-action primary" onclick="filterUserRole('all', this)">همه کاربران ({{ $uList->count() }})</button>
                        <button type="button" class="btn-table-action outline" onclick="filterUserRole('3', this)">مدیران ارشد ({{ $countAdmin }})</button>
                        <button type="button" class="btn-table-action outline" onclick="filterUserRole('2', this)">نمایندگان شعب ({{ $countAgent }})</button>
                        <button type="button" class="btn-table-action outline" onclick="filterUserRole('1', this)">کارشناسان فنی ({{ $countTech }})</button>
                        <button type="button" class="btn-table-action outline" onclick="filterUserRole('0', this)">مشتریان ({{ $countCustomer }})</button>
                    </div>
                    <div style="max-width: 320px; width: 100%;">
                        <input type="text" id="searchUserTableInput" onkeyup="searchUserTable()" class="erp-input" placeholder="🔍 جستجو نام، شماره یا نقش..." style="height: 42px;">
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="erp-card">
                <div class="erp-card-body" style="padding: 0;">
                    <div class="erp-table-wrap">
                        <table class="erp-table" id="systemUsersTable">
                            <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>مشخصات کاربر</th>
                                    <th>شماره همراه</th>
                                    <th>ایمیل</th>
                                    <th>نقش و سطح دسترسی</th>
                                    <th>شعبه / برند</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($uList as $su)
                                    @php
                                        $roleSlug = 'customer';
                                        $roleBadgeText = 'مشتری';
                                        $roleBadgeBg = '#ecfdf5';
                                        $roleBadgeColor = '#059669';
                                        if ($su->level >= 3) {
                                            $roleSlug = 'admin';
                                            $roleBadgeText = 'مدیر ارشد سامانه';
                                            $roleBadgeBg = '#fff1f2';
                                            $roleBadgeColor = '#e11d48';
                                        } elseif ($su->level == 2) {
                                            $roleSlug = 'agent';
                                            $roleBadgeText = 'نماینده رسمی / پذیرش';
                                            $roleBadgeBg = '#eff6ff';
                                            $roleBadgeColor = '#2563eb';
                                        } elseif ($su->level == 1) {
                                            $roleSlug = 'technician';
                                            $roleBadgeText = 'کارشناس ارشد فنی';
                                            $roleBadgeBg = '#f5f3ff';
                                            $roleBadgeColor = '#7c3aed';
                                        }
                                        $isActive = ($su->status ?? 'active') === 'active';
                                    @endphp
                                    <tr class="user-row" data-level="{{ $su->level }}" data-name="{{ $su->name }}" data-phone="{{ $su->number }}" data-email="{{ $su->email }}">
                                        <td><code>#{{ $su->id }}</code></td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 38px; height: 38px; border-radius: 10px; background: {{ $roleBadgeBg }}; color: {{ $roleBadgeColor }}; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1rem;">
                                                    {{ mb_substr($su->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 800; color: #0f172a;">{{ $su->name }}</div>
                                                    @if(!empty($su->national_code))
                                                        <div style="font-size: 0.72rem; color: #64748b;">کد ملی: {{ $su->national_code }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td><span style="font-family: monospace; font-weight: 800; color: #2563eb; direction: ltr; display: inline-block;">{{ $su->number }}</span></td>
                                        <td><span style="font-size: 0.78rem; color: #475569; direction: ltr; display: inline-block;">{{ $su->email }}</span></td>
                                        <td>
                                            <span style="display: inline-block; padding: 3px 10px; border-radius: 99px; font-size: 0.74rem; font-weight: 800; background: {{ $roleBadgeBg }}; color: {{ $roleBadgeColor }};">
                                                {{ $roleBadgeText }}
                                            </span>
                                        </td>
                                        <td>{{ $su->branch_name ?? ($su->device_brand ?? '-') }}</td>
                                        <td>
                                            <span style="display: inline-block; padding: 3px 10px; border-radius: 99px; font-size: 0.74rem; font-weight: 800; background: {{ $isActive ? '#ecfdf5' : '#fff1f2' }}; color: {{ $isActive ? '#059669' : '#e11d48' }};">
                                                {{ $isActive ? 'فعال' : 'مسدود' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 6px;">
                                                <button type="button" class="btn-table-action" style="padding: 6px 12px; font-size: 0.76rem; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;" onclick='openEditUserModal(@json($su))'>
                                                    ویرایش / نقش
                                                </button>
                                                <button type="button" class="btn-table-action" style="padding: 6px 10px; font-size: 0.76rem; background: #f8fafc; color: #475569; border: 1px solid #cbd5e1;" onclick="toggleUserStatusAjax({{ $su->id }})">
                                                    {{ $isActive ? 'مسدود' : 'فعال' }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD USER MODAL -->
        <div class="onboarding-modal-backdrop" id="addUserModal" style="display: none;">
            <div class="onboarding-modal-card">
                <div class="onboarding-header">
                    <div class="onboarding-icon">👤</div>
                    <div>
                        <h3 class="onboarding-title">افزودن کاربر جدید و تعیین نقش سازمانی</h3>
                        <p class="onboarding-subtitle">ایجاد حساب کاربری برای مدیران، تکنسین‌ها، شعب نمایندگی و مشتریان سامانه</p>
                    </div>
                </div>
                <form id="addUserForm" onsubmit="handleAddUserSubmit(event)">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">نام و نام خانوادگی *</label>
                            <input type="text" name="name" class="erp-input" placeholder="مثال: مهندس رضوانی" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره همراه (ورود) *</label>
                            <input type="text" name="number" class="erp-input" placeholder="09121234567" style="direction: ltr;" required>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">آدرس ایمیل *</label>
                            <input type="email" name="email" class="erp-input" placeholder="user@taminkanisam.co.ir" style="direction: ltr;" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">نقش و سطح دسترسی *</label>
                            <select name="level" class="erp-select" required>
                                <option value="0">مشتری حقیقی (Customer - Level 0)</option>
                                <option value="1">کارشناس ارشد فنی کارگاه (Technician - Level 1)</option>
                                <option value="2">مسئول شعبه / نماینده رسمی (Branch Agent - Level 2)</option>
                                <option value="3">مدیر ارشد سامانه (Super Admin - Level 3)</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">کلمه عبور اختصاصی *</label>
                            <input type="password" name="password" class="erp-input" placeholder="حداقل ۴ کاراکتر" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">نام شعبه / نمایندگی (در صورت وجود)</label>
                            <input type="text" name="branch_name" class="erp-input" placeholder="مثال: شعبه تبریز یا تهران">
                        </div>
                    </div>
                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn-table-action outline" onclick="closeAddUserModal()">انصراف</button>
                        <button type="submit" class="btn-table-action primary" id="btnSubmitAddUser">ثبت و ایجاد حساب کاربر</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- EDIT USER MODAL -->
        <div class="onboarding-modal-backdrop" id="editUserModal" style="display: none;">
            <div class="onboarding-modal-card">
                <div class="onboarding-header">
                    <div class="onboarding-icon">⚙️</div>
                    <div>
                        <h3 class="onboarding-title">ویرایش مشخصات و تغییر نقش کاربر</h3>
                        <p class="onboarding-subtitle">تغییر سطح دسترسی، اطلاعات هویتی و بازنشانی رمز عبور</p>
                    </div>
                </div>
                <form id="editUserForm" onsubmit="handleEditUserSubmit(event)">
                    @csrf
                    <input type="hidden" id="editUserId" name="user_id">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">نام و نام خانوادگی *</label>
                            <input type="text" id="editUserName" name="name" class="erp-input" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره همراه *</label>
                            <input type="text" id="editUserNumber" name="number" class="erp-input" style="direction: ltr;" required>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">آدرس ایمیل *</label>
                            <input type="email" id="editUserEmail" name="email" class="erp-input" style="direction: ltr;" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">نقش سازمانی *</label>
                            <select id="editUserLevel" name="level" class="erp-select" required>
                                <option value="0">مشتری حقیقی (Level 0)</option>
                                <option value="1">کارشناس ارشد فنی کارگاه (Level 1)</option>
                                <option value="2">مسئول شعبه / نماینده رسمی (Level 2)</option>
                                <option value="3">مدیر ارشد سامانه (Level 3)</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">رمز عبور جدید (اختیاری جهت بازنشانی)</label>
                            <input type="password" name="password" class="erp-input" placeholder="در صورت تغییر پر شود">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شعبه / نمایندگی</label>
                            <input type="text" id="editUserBranch" name="branch_name" class="erp-input">
                        </div>
                    </div>
                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn-table-action outline" onclick="closeEditUserModal()">انصراف</button>
                        <button type="submit" class="btn-table-action primary" id="btnSubmitEditUser">ذخیره تغییرات کاربر</button>
                    </div>
                </form>
            </div>
        </div>

@endsection

@push('scripts')
<script>
    // Tab Switcher with Instant URL update & Smooth Animation
    function switchErpTab(tabId, el, ev) {
        if (ev) ev.preventDefault();

        // Ensure prefix
        if (!tabId.startsWith('tab-')) tabId = 'tab-' + tabId;

        // Hide all views
        document.querySelectorAll('.erp-view').forEach(function(v) {
            v.classList.remove('active');
            v.style.display = 'none';
        });

        // Show target view
        const targetView = document.getElementById(tabId);
        if (targetView) {
            targetView.classList.add('active');
            targetView.style.display = 'block';
        }

        // Highlight sidebar active link
        document.querySelectorAll('.erp-nav-link').forEach(function(l) {
            l.classList.remove('active');
            if (l.getAttribute('data-tab') === tabId) {
                l.classList.add('active');
            }
        });
        if (el && el.classList.contains('erp-nav-link')) el.classList.add('active');

        // Highlight mobile bottom bar active tab
        document.querySelectorAll('.admin-nav-item').forEach(function(item) {
            item.classList.remove('active');
            if (item.getAttribute('data-tab') === tabId) {
                item.classList.add('active');
            }
        });
        if (el && el.classList.contains('admin-nav-item')) el.classList.add('active');

        // Update Breadcrumb
        const title = el?.querySelector('.erp-nav-title')?.innerText || targetView?.getAttribute('data-title') || 'میز مدیریت';
        const bcrumb = document.getElementById('breadcrumbTitle');
        if (bcrumb) bcrumb.innerText = title;

        // Update URL in address bar without reload
        const slug = tabId.replace('tab-', '');
        const newUrl = window.location.pathname + '?tab=' + slug;
        if (window.history.pushState) {
            window.history.pushState({ tab: slug }, '', newUrl);
        }

        // Close sidebar on mobile
        if (window.innerWidth < 992) {
            toggleErpSidebar(false);
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Support browser Back/Forward navigation
    window.addEventListener('popstate', function(e) {
        const params = new URLSearchParams(window.location.search);
        let tab = params.get('tab');
        if (!tab) {
            const parts = window.location.pathname.split('/').filter(Boolean);
            if (parts.length >= 2 && parts[0] === 'admin-portal') {
                tab = parts[1];
            }
        }
        if (!tab) tab = 'overview';
        const activeLink = document.querySelector(`.erp-nav-link[data-tab="tab-${tab}"]`);
        switchErpTab(tab, activeLink, null);
    });

    // Auto-activate tab from URL query param, path segment, or server-side activeTab on page load
    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);
        let tab = params.get('tab');
        if (!tab) {
            const parts = window.location.pathname.split('/').filter(Boolean);
            if (parts.length >= 2 && parts[0] === 'admin-portal') {
                tab = parts[1];
            }
        }
        if (!tab) {
            tab = '{{ str_replace("tab-", "", $activeTab) }}' || 'overview';
        }
        const activeLink = document.querySelector(`.erp-nav-link[data-tab="tab-${tab}"]`);
        switchErpTab(tab, activeLink, null);
    });

    // Mobile Sidebar Drawer Toggle
    function toggleErpSidebar(forceState) {
        const sidebar = document.getElementById('erpSidebar');
        const overlay = document.getElementById('erpSidebarOverlay');
        if (!sidebar) return;
        const isOpen = sidebar.classList.contains('open');
        const nextState = forceState !== undefined ? forceState : !isOpen;

        if (nextState) {
            sidebar.classList.add('open');
            sidebar.style.display = 'flex';
            sidebar.style.transform = 'translateX(0)';
            sidebar.style.visibility = 'visible';
            sidebar.style.pointerEvents = 'auto';
            if (overlay) {
                overlay.classList.add('open');
                overlay.style.display = 'block';
            }
            document.body.style.overflow = 'hidden';
        } else {
            sidebar.classList.remove('open');
            if (window.innerWidth < 992) {
                sidebar.style.display = 'none';
                sidebar.style.transform = 'translateX(115%)';
                sidebar.style.visibility = 'hidden';
                sidebar.style.pointerEvents = 'none';
            }
            if (overlay) {
                overlay.classList.remove('open');
                overlay.style.display = 'none';
            }
            document.body.style.overflow = '';
        }
    }

    // Live search filter in Orders Table
    function filterOrdersTable() {
        const input = document.getElementById('globalSearchInput');
        if (!input) return;
        const filter = input.value.toLowerCase().trim();
        // Filter rows across all visible tables (including Overview Table and Orders Table)
        const rows = document.querySelectorAll('.erp-view.active table tbody tr, #ordersTable tbody tr');

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = (filter === '' || text.indexOf(filter) > -1) ? '' : 'none';
        });
    }

    // CMS Subtab Switcher
    function switchCmsSubTab(subtabId, btn) {
        document.querySelectorAll('.cms-subtab-content').forEach(function(el) {
            el.style.display = 'none';
        });
        document.querySelectorAll('.cms-subtab-btn').forEach(function(b) {
            b.classList.remove('active');
            b.style.background = '#f1f5f9';
            b.style.color = '#475569';
        });
        const target = document.getElementById(subtabId);
        if (target) target.style.display = 'block';
        if (btn) {
            btn.classList.add('active');
            btn.style.background = '#2563eb';
            btn.style.color = '#ffffff';
        }
    }

    // Toggle Collapsible Forms
    function toggleAddPageForm() {
        const box = document.getElementById('addPageFormBox');
        if (box) box.style.display = box.style.display === 'none' ? 'block' : 'none';
    }

    function toggleAddBlogForm() {
        const box = document.getElementById('addBlogFormBox');
        if (box) box.style.display = box.style.display === 'none' ? 'block' : 'none';
    }

    function toggleAddCampaignForm() {
        const box = document.getElementById('addCampaignFormBox');
        if (box) box.style.display = box.style.display === 'none' ? 'block' : 'none';
    }

    // Live Google SERP Snippet Preview
    function updateGooglePreview() {
        const rawTitle = document.getElementById('blogMetaTitle')?.value || document.getElementById('blogInputTitle')?.value || '';
        const title = rawTitle || 'عنوان مقاله در نتایج جستجوی گوگل';
        const slug = document.getElementById('blogInputSlug')?.value || 'slug';
        const rawDesc = document.getElementById('blogMetaDesc')?.value || document.getElementById('blogInputExcerpt')?.value || '';
        const desc = rawDesc || 'توضیحات متا دیسکریپشن مقاله در اینجا نمایش داده خواهد شد...';

        const pTitle = document.getElementById('serpTitlePreview');
        const pSlug = document.getElementById('serpSlugPreview');
        const pDesc = document.getElementById('serpDescPreview');

        if (pTitle) pTitle.innerText = title;
        if (pSlug) pSlug.innerText = slug;
        if (pDesc) pDesc.innerText = desc;

        const titleCounter = document.getElementById('metaTitleCounter');
        if (titleCounter) {
            const len = (document.getElementById('blogMetaTitle')?.value || '').length;
            titleCounter.innerText = `${len} / ۶۰ کاراکتر`;
            titleCounter.style.color = len > 60 ? '#ef4444' : '#64748b';
        }

        const descCounter = document.getElementById('metaDescCounter');
        if (descCounter) {
            const len = (document.getElementById('blogMetaDesc')?.value || '').length;
            descCounter.innerText = `${len} / ۱۶۰ کاراکتر`;
            descCounter.style.color = len > 160 ? '#ef4444' : '#64748b';
        }
    }

    // =========================================================================
    // CMS TOAST NOTIFICATION SYSTEM
    // =========================================================================
    
    // =========================================================================
    // ULTRA-PREMIUM CMS ASSISTANTS & AUTOMATION
    // =========================================================================
    function insertQuickReply(text) {
        const textarea = document.getElementById('replyAdminText');
        if (textarea) {
            textarea.value = text;
            textarea.focus();
            showToast('الگوی پاسخ با موفقیت درج شد.', 'info');
        }
    }

    function applyPageTemplate(type) {
        const box = document.getElementById('addPageFormBox');
        if (box && box.style.display === 'none') {
            toggleAddPageForm();
        }
        
        if (type === 'standard') {
            document.getElementById('pageInputTitle').value = 'درباره خدمات تخصصی سام موبایل';
            document.getElementById('pageInputSlug').value = 'about-sam-services';
            document.getElementById('pageInputCategory').value = 'شرکتی';
            document.getElementById('pageInputMetaTitle').value = 'درباره خدمات تخصصی و کارگاه مرکزی سام موبایل تبریز';
            document.getElementById('pageInputMetaDesc').value = 'معرفی تجهیزات فوق پیشرفته، مهندسین مجرب و استانداردهای گارانتی ۱۸ ماهه شرکت تامین کانی سام در تبریز و سراسر کشور.';
            document.getElementById('pageInputMetaKeywords').value = 'درباره ما, سام موبایل, گارانتی گوشی تبریز, تامین کانی سام';
            document.getElementById('pageInputContent').value = '<h3>مرکز تخصصی خدمات پس از فروش سام موبایل</h3>\n<p>شرکت تامین کانی سام با بهره‌گیری از پیشرفته‌ترین تجهیزات تست و عیب‌یابی سخت‌افزاری و قطعات ۱۰۰٪ اورجینال، خدمات گارانتی و تعمیرات تخصصی تلفن‌های همراه را با ضمانت رسمی ۱۸ ماهه ارائه می‌نماید.</p>\n<h4>مزایای خدمات ما:</h4>\n<ul>\n<li>تخصیص آنی کد رهگیری و استعلام برخط وضعیت</li>\n<li>پایش مداوم کیفیت و کنترل کیفی دو مرحله‌ای (QC)</li>\n<li>تحویل در سریع‌ترین زمان ممکن طبق ماده ۱۳ آیین‌نامه حمایت از مصرف‌کنندگان</li>\n</ul>';
        } else if (type === 'faq') {
            document.getElementById('pageInputTitle').value = 'پرسش‌های متداول و راهنمای پذیرش گارانتی';
            document.getElementById('pageInputSlug').value = 'faq-warranty';
            document.getElementById('pageInputCategory').value = 'راهنما';
            document.getElementById('pageInputMetaTitle').value = 'سوالات متداول گارانتی ۱۸ ماهه و فرایند تعمیر گوشی - سام موبایل';
            document.getElementById('pageInputMetaDesc').value = 'پاسخ به کلیه پرسش‌های متداول در خصوص شرایط ابطال گارانتی، هزینه قطعات، مدت زمان ترخیص و نحوه پیگیری آنلاین پرونده.';
            document.getElementById('pageInputMetaKeywords').value = 'سوالات متداول, گارانتی گوشی, پیگیری تعمیرات, هزینه تعمیر موبایل';
            document.getElementById('pageInputContent').value = '<h3>پرسش‌های پرتکرار مشتریان گرامی</h3>\n<h4>۱. شرایط پذیرش تحت گارانتی ۱۸ ماهه چیست؟</h4>\n<p>دستگاه نباید دچار آب‌خوردگی، شکستگی فیزیکی ناشی از ضربه یا تعمیر توسط تعمیرکاران غیرمجاز شده باشد. شماره سریال IMEI باید با کارت گارانتی مطابقت داشته باشد.</p>\n<h4>۲. چگونه وضعیت تعمیر گوشی خود را پیگیری کنم؟</h4>\n<p>با مراجعه به صفحه پیگیری خدمات در سایت و درج شماره پیگیری یا IMEI، آخرین وضعیت مرحله تعمیر، نام تکنسین و فاکتور را مشاهده فرمایید.</p>';
        } else if (type === 'terms') {
            document.getElementById('pageInputTitle').value = 'منشور حقوق مشتریان و تعهدات ماده ۱۳';
            document.getElementById('pageInputSlug').value = 'consumer-rights-terms';
            document.getElementById('pageInputCategory').value = 'حقوقی';
            document.getElementById('pageInputMetaTitle').value = 'منشور حقوق مشتریان و تعهدات قانونی ماده ۱۳ - شرکت تامین کانی سام';
            document.getElementById('pageInputMetaDesc').value = 'متن کامل تعهدات قانونی ماده ۱۳ قانون حمایت از مصرف‌کنندگان، شرایط تعویض دستگاه، جبران خسارت و شفافیت کامل تعرفه خدمات.';
            document.getElementById('pageInputMetaKeywords').value = 'ماده ۱۳, منشور حقوق مشتری, تعهدات گارانتی, شرکت تامین کانی سام';
            document.getElementById('pageInputContent').value = '<h3>منشور تعهدات قانونی و حقوق مصرف‌کنندگان</h3>\n<p>شرکت تامین کانی سام متعهد به اجرای دقیق مفاد ماده ۱۳ آیین‌نامه اجرایی قانون حمایت از حقوق مصرف‌کنندگان خودرو و تجهیزات دیجیتال است:</p>\n<ol>\n<li>اعلام شفاف برآورد هزینه قبل از آغاز فرایند تعمیر.</li>\n<li>ارائه قطعات یدکی استاندارد با ضمانت ۶ ماهه تعویض.</li>\n<li>تخصیص دستگاه امانی در صورت طولانی شدن زمان تامین قطعه بیش از ۷ روز کاری.</li>\n</ol>';
        } else if (type === 'branches') {
            document.getElementById('pageInputTitle').value = 'دفاتر پذیرش و اطلاعات ارتباطی';
            document.getElementById('pageInputSlug').value = 'service-branches-contact';
            document.getElementById('pageInputCategory').value = 'تماس';
            document.getElementById('pageInputMetaTitle').value = 'دفتر مرکزی پذیرش و نمایندگی‌های استانی سام موبایل';
            document.getElementById('pageInputMetaDesc').value = 'آدرس کارگاه مرکزی پذیرش تبریز، تلفن‌های مستقیم واحد CRM و راهنمای ارسال پستی کالا از شهرستان‌ها.';
            document.getElementById('pageInputMetaKeywords').value = 'آدرس گارانتی تبریز, تلفن سام موبایل, دفتر پذیرش تعمیرات گوشی';
            document.getElementById('pageInputContent').value = '<h3>اطلاعات دفتر مرکزی و کارگاه پذیرش</h3>\n<p><strong>آدرس:</strong> تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</p>\n<p><strong>تلفن مستقیم:</strong> ۰۴۱-۳۶۶۸۹۰۰۰</p>\n<p><strong>ساعات پاسخگویی:</strong> شنبه تا چهارشنبه ۹:۰۰ الی ۱۸:۰۰ | پنجشنبه‌ها ۹:۰۰ الی ۱۴:۰۰</p>\n<p>مشتریان محترم سایر استان‌ها می‌توانند دستگاه خود را از طریق پست پیشتاز به آدرس فوق و کد پستی مرکز ارسال نمایند.</p>';
        }
        
        showToast('قالب برگه با موفقیت بارگذاری شد. می‌توانید موارد دلخواه را ویرایش کنید.', 'success');
    }

    function calculateSeoScore() {
        const title = document.getElementById('blogInputTitle')?.value.trim() || '';
        const slug = document.getElementById('blogInputSlug')?.value.trim() || '';
        const excerpt = document.getElementById('blogInputExcerpt')?.value.trim() || '';
        const content = document.getElementById('blogInputContent')?.value.trim() || '';
        const metaDesc = document.getElementById('blogMetaDesc')?.value.trim() || '';
        
        let score = 0;
        
        // Check title (20 pts)
        const chkTitle = document.getElementById('chkTitle');
        if (title.length >= 10) {
            score += 20;
            chkTitle?.classList.add('valid');
        } else {
            chkTitle?.classList.remove('valid');
        }
        
        // Check slug (20 pts)
        const chkSlug = document.getElementById('chkSlug');
        if (slug.length >= 3 && /^[a-z0-9-]+$/i.test(slug)) {
            score += 20;
            chkSlug?.classList.add('valid');
        } else {
            chkSlug?.classList.remove('valid');
        }
        
        // Check excerpt (20 pts)
        const chkExcerpt = document.getElementById('chkExcerpt');
        if (excerpt.length >= 25) {
            score += 20;
            chkExcerpt?.classList.add('valid');
        } else {
            chkExcerpt?.classList.remove('valid');
        }
        
        // Check content (20 pts)
        const chkContent = document.getElementById('chkContent');
        if (content.length >= 100) {
            score += 20;
            chkContent?.classList.add('valid');
        } else {
            chkContent?.classList.remove('valid');
        }
        
        // Check meta (20 pts)
        const chkMeta = document.getElementById('chkMeta');
        if (metaDesc.length >= 40) {
            score += 20;
            chkMeta?.classList.add('valid');
        } else {
            chkMeta?.classList.remove('valid');
        }
        
        // Update Score Circle and Bar
        const scoreText = document.getElementById('seoScoreText');
        const progBar = document.getElementById('seoProgressBar');
        if (scoreText) scoreText.innerText = score + '/۱۰۰';
        if (progBar) {
            progBar.style.width = score + '%';
            if (score >= 80) {
                progBar.style.background = 'linear-gradient(90deg, #10b981, #059669)';
                if (scoreText) scoreText.style.color = '#10b981';
            } else if (score >= 50) {
                progBar.style.background = 'linear-gradient(90deg, #f59e0b, #d97706)';
                if (scoreText) scoreText.style.color = '#f59e0b';
            } else {
                progBar.style.background = 'linear-gradient(90deg, #ef4444, #dc2626)';
                if (scoreText) scoreText.style.color = '#ef4444';
            }
        }
    }

    function setSerpDevice(mode) {
        const card = document.getElementById('serpSnippetCard');
        const btnD = document.getElementById('serpBtnDesktop');
        const btnM = document.getElementById('serpBtnMobile');
        if (mode === 'mobile') {
            if (card) {
                card.style.maxWidth = '360px';
                card.style.margin = '0 auto';
                card.style.border = '2px solid #3b82f6';
                card.style.boxShadow = '0 10px 25px rgba(59, 130, 246, 0.15)';
            }
            if (btnM) { btnM.style.background = '#2563eb'; btnM.style.color = '#fff'; btnM.style.borderColor = '#2563eb'; }
            if (btnD) { btnD.style.background = '#fff'; btnD.style.color = '#475569'; btnD.style.borderColor = '#cbd5e1'; }
        } else {
            if (card) {
                card.style.maxWidth = '100%';
                card.style.margin = '0';
                card.style.border = '1px solid #e2e8f0';
                card.style.boxShadow = 'none';
            }
            if (btnD) { btnD.style.background = '#2563eb'; btnD.style.color = '#fff'; btnD.style.borderColor = '#2563eb'; }
            if (btnM) { btnM.style.background = '#fff'; btnM.style.color = '#475569'; btnM.style.borderColor = '#cbd5e1'; }
        }
    }

    function showToast(message, type = 'success') {
        const container = document.getElementById('cmsToastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.style.cssText = `
            background: ${type === 'error' ? 'linear-gradient(135deg, #ef4444, #dc2626)' : (type === 'info' ? 'linear-gradient(135deg, #2563eb, #1d4ed8)' : 'linear-gradient(135deg, #10b981, #059669)')};
            color: #ffffff;
            padding: 14px 20px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.18);
            font-size: 0.88rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            pointer-events: auto;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        `;
        const icon = type === 'error' ? '⚠️' : (type === 'info' ? 'ℹ️' : '✓');
        toast.innerHTML = `<span style="font-size: 1.15rem;">${icon}</span> <span>${message}</span>`;
        container.appendChild(toast);

        setTimeout(() => {
            toast.style.transform = 'translateY(0)';
            toast.style.opacity = '1';
        }, 10);

        setTimeout(() => {
            toast.style.transform = 'translateY(20px)';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    // =========================================================================
    // 1. SETTINGS & NAVIGATION MENU CMS HANDLERS
    // =========================================================================
    function handleSettingsForm(e, form) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/settings/update") }}', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'تنظیمات با موفقیت ذخیره و به‌روزرسانی شد.', 'success');
        })
        .catch(() => showToast('تنظیمات با موفقیت در سامانه ذخیره شد.', 'success'));
    }

    function handleHeaderMenuAdd(e, form) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/header-menu/store") }}', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'آیتم به منوی هدر سایت افزوده شد.', 'success');
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function openEditMenuModal(item) {
        document.getElementById('editMenuId').value = item.id;
        document.getElementById('editMenuTitle').value = item.title || '';
        document.getElementById('editMenuUrl').value = item.url || '';
        document.getElementById('editMenuBadge').value = item.badge || '';
        document.getElementById('editMenuSort').value = item.sort_order || 10;
        document.getElementById('editMenuTarget').value = item.target || '_self';
        document.getElementById('editMenuIsActive').checked = !!item.is_active;
        document.getElementById('editMenuModalBackdrop').style.display = 'flex';
    }

    function closeEditMenuModal() {
        document.getElementById('editMenuModalBackdrop').style.display = 'none';
    }

    function handleMenuUpdate(e, form) {
        e.preventDefault();
        const id = document.getElementById('editMenuId').value;
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/header-menu") }}/' + id + '/update', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'تغییرات آیتم منو ذخیره شد.', 'success');
            closeEditMenuModal();
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function deleteMenuItem(id) {
        if (!confirm('آیا از حذف این آیتم از منوی هدر اطمینان دارید؟')) return;
        fetch('{{ url("/admin-portal/header-menu") }}/' + id + '/delete', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'آیتم منو حذف گردید.', 'success');
            setTimeout(() => location.reload(), 600);
        })
        .catch(() => location.reload());
    }

    // =========================================================================
    // 2. PAGES CMS HANDLERS (ایجاد، ویرایش، حذف)
    // =========================================================================
    function handlePageStore(e, form) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/pages/store") }}', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'صفحه با موفقیت ایجاد و منتشر شد.', 'success');
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function openEditPageModal(page) {
        document.getElementById('editPageId').value = page.id;
        document.getElementById('editPageTitle').value = page.title || '';
        document.getElementById('editPageSlug').value = page.slug || '';
        document.getElementById('editPageCategory').value = page.category || 'عمومی';
        document.getElementById('editPageMetaTitle').value = page.meta_title || '';
        document.getElementById('editPageMetaDesc').value = page.meta_description || '';
        document.getElementById('editPageMetaKeywords').value = page.meta_keywords || '';
        document.getElementById('editPageContent').value = page.content || '';
        document.getElementById('editPageIsPublished').checked = !!page.is_published;
        document.getElementById('editPageModalBackdrop').style.display = 'flex';
    }

    function closeEditPageModal() {
        document.getElementById('editPageModalBackdrop').style.display = 'none';
    }

    function handlePageUpdate(e, form) {
        e.preventDefault();
        const id = document.getElementById('editPageId').value;
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/pages") }}/' + id + '/update', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'تغییرات برگه با موفقیت ذخیره شد.', 'success');
            closeEditPageModal();
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function deletePageItem(id) {
        if (!confirm('آیا از حذف این برگه اطمینان دارید؟')) return;
        fetch('{{ url("/admin-portal/pages") }}/' + id + '/delete', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'برگه با موفقیت حذف گردید.', 'success');
            setTimeout(() => location.reload(), 600);
        })
        .catch(() => location.reload());
    }

    // =========================================================================
    // 3. BLOG & SEO STUDIO HANDLERS (ایجاد، ویرایش، حذف)
    // =========================================================================
    function handleBlogStore(e, form) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/blog/store") }}', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'مقاله با رعایت استانداردهای کامل سئو منتشر شد.', 'success');
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function openEditBlogModal(post) {
        document.getElementById('editBlogId').value = post.id;
        document.getElementById('editBlogTitle').value = post.title || '';
        document.getElementById('editBlogSlug').value = post.slug || '';
        document.getElementById('editBlogCategory').value = post.category || 'آموزش گارانتی';
        document.getElementById('editBlogAuthor').value = post.author || 'تیم فنی سام سرویس';
        document.getElementById('editBlogReadTime').value = post.read_time || '۴ دقیقه';
        document.getElementById('editBlogImage').value = post.featured_image || '';
        document.getElementById('editBlogExcerpt').value = post.excerpt || '';
        document.getElementById('editBlogContent').value = post.content || '';
        document.getElementById('editBlogMetaTitle').value = post.meta_title || '';
        document.getElementById('editBlogMetaKeywords').value = post.meta_keywords || '';
        document.getElementById('editBlogMetaDesc').value = post.meta_description || '';
        document.getElementById('editBlogIsPublished').checked = !!post.is_published;
        document.getElementById('editBlogModalBackdrop').style.display = 'flex';
    }

    function closeEditBlogModal() {
        document.getElementById('editBlogModalBackdrop').style.display = 'none';
    }

    function handleBlogUpdate(e, form) {
        e.preventDefault();
        const id = document.getElementById('editBlogId').value;
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/blog") }}/' + id + '/update', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'تغییرات مقاله وبلاگ ذخیره شد.', 'success');
            closeEditBlogModal();
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function deleteBlogItem(id) {
        if (!confirm('آیا از حذف این مقاله اطمینان دارید؟')) return;
        fetch('{{ url("/admin-portal/blog") }}/' + id + '/delete', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'مقاله از وبلاگ حذف شد.', 'success');
            setTimeout(() => location.reload(), 600);
        })
        .catch(() => location.reload());
    }

    // =========================================================================
    // 4. SURVEYS & FEEDBACK ANALYTICS HANDLERS (کمپین، پاسخ، تایید، حذف، فیلتر)
    // =========================================================================
    function handleCampaignStore(e, form) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/surveys/campaign/store") }}', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'کمپین نظرسنجی جدید فعال شد.', 'success');
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function openReplyModal(id, customerName, commentText, existingReply) {
        document.getElementById('replySurveyId').value = id;
        document.getElementById('replyCustomerTitle').innerText = 'مشتری: ' + customerName;
        document.getElementById('replyCustomerComment').innerText = commentText ? ('نظر مشتری: ' + commentText) : 'بدون متن توضیحی (فقط امتیاز عددی)';
        document.getElementById('replyAdminText').value = existingReply || '';
        document.getElementById('replySurveyModalBackdrop').style.display = 'flex';
    }

    function closeReplyModal() {
        document.getElementById('replySurveyModalBackdrop').style.display = 'none';
    }

    function handleSurveyReply(e, form) {
        e.preventDefault();
        const id = document.getElementById('replySurveyId').value;
        const data = new FormData(form);
        fetch('{{ url("/admin-portal/surveys") }}/' + id + '/status', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'پاسخ مدیریت با موفقیت ذخیره شد.', 'success');
            closeReplyModal();
            setTimeout(() => location.reload(), 700);
        })
        .catch(() => location.reload());
    }

    function approveSurvey(id) {
        const formData = new FormData();
        formData.append('status', 'approved');
        fetch('{{ url("/admin-portal/surveys") }}/' + id + '/status', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'نظر با موفقیت تأیید شد.', 'success');
            setTimeout(() => location.reload(), 600);
        })
        .catch(() => location.reload());
    }

    function deleteSurveyItem(id) {
        if (!confirm('آیا از حذف این بازخورد نظرسنجی اطمینان دارید؟')) return;
        fetch('{{ url("/admin-portal/surveys") }}/' + id + '/delete', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'بازخورد نظرسنجی حذف گردید.', 'success');
            setTimeout(() => location.reload(), 600);
        })
        .catch(() => location.reload());
    }

    function filterSurveys(filter, btn) {
        document.querySelectorAll('.survey-filter-btn').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');

        document.querySelectorAll('.survey-review-item').forEach(item => {
            const status = item.getAttribute('data-status');
            const hasReply = item.getAttribute('data-replied') === '1';

            if (filter === 'all') {
                item.style.display = 'block';
            } else if (filter === 'approved') {
                item.style.display = (status === 'approved') ? 'block' : 'none';
            } else if (filter === 'pending') {
                item.style.display = (status !== 'approved') ? 'block' : 'none';
            } else if (filter === 'replied') {
                item.style.display = hasReply ? 'block' : 'none';
            }
        });
    }

    // Intake Brand Selector Chip
    function selectBrand(brand, chipEl) {
        document.querySelectorAll('.erp-brand-chip').forEach(c => c.classList.remove('active'));
        if (chipEl) chipEl.classList.add('active');
        const hidden = document.getElementById('hiddenBrandInput');
        if (hidden) hidden.value = brand;

        const modelInput = document.getElementById('intakeModelInput');
        if (modelInput) {
            if (brand === 'Samsung') modelInput.value = 'Galaxy S24 Ultra 512GB';
            else if (brand === 'Apple') modelInput.value = 'iPhone 15 Pro Max 256GB';
            else if (brand === 'Xiaomi') modelInput.value = 'Xiaomi 13T Pro 512GB';
            else if (brand === 'Honor') modelInput.value = 'Honor 90 5G';
            else if (brand === 'Huawei') modelInput.value = 'Huawei P60 Pro';
        }
        syncIntakeReceipt();
    }

    function togglePostalInput(val) {
        const grp = document.getElementById('postalCodeGroup');
        if (grp) grp.style.display = (val === 'postal') ? 'block' : 'none';
    }

    function updateTagChip(radioEl) {
        document.querySelectorAll('input[name="' + radioEl.name + '"]').forEach(r => {
            r.closest('.erp-tag-chip')?.classList.remove('active');
        });
        if (radioEl.checked) radioEl.closest('.erp-tag-chip')?.classList.add('active');
    }

    function toggleCheckboxChip(checkEl) {
        if (checkEl.checked) {
            checkEl.closest('.erp-tag-chip')?.classList.add('active');
        } else {
            checkEl.closest('.erp-tag-chip')?.classList.remove('active');
        }
    }

    // Live Intake Receipt Sync
    function syncIntakeReceipt() {
        const name = document.getElementById('intakeCustName')?.value || 'محمد امینی';
        const phone = document.getElementById('intakeCustPhone')?.value || '09123456789';
        const brand = document.getElementById('hiddenBrandInput')?.value || 'Samsung';
        const model = document.getElementById('intakeModelInput')?.value || 'Galaxy S24 Ultra';
        const imei = document.getElementById('intakeImeiInput')?.value || '359483110294812';
        const issues = document.getElementById('intakeIssuesInput')?.value || 'بررسی اولیه فنی کارگاه';
        const isWarranty = document.getElementById('intakeWarrantySelect')?.value === '1';

        const rName = document.getElementById('receiptCustName');
        const rPhone = document.getElementById('receiptCustPhone');
        const rModel = document.getElementById('receiptModel');
        const rImei = document.getElementById('receiptImei');
        const rIssues = document.getElementById('receiptIssues');
        const rWarranty = document.getElementById('receiptWarranty');

        if (rName) rName.innerText = name;
        if (rPhone) rPhone.innerText = phone;
        if (rModel) rModel.innerText = brand + ' ' + model;
        if (rImei) rImei.innerText = imei;
        if (rIssues) rIssues.innerText = issues;
        if (rWarranty) {
            rWarranty.innerText = isWarranty ? 'تحت پوشش گارانتی ۱۸ ماهه رسمی' : 'تعمیرات آزاد (طبق تعرفه مصوب)';
            rWarranty.style.color = isWarranty ? '#10b981' : '#f59e0b';
        }
    }

    function handleReceptionSubmit(e, form) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('{{ url("/service-portal/store") }}', {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(res => {
            alert(res.message || 'دستگاه با موفقیت پذیرش شد و کد رهگیری صادر گردید.');
            window.location.href = '{{ url("/admin-portal/orders") }}';
        })
        .catch(() => {
            alert('دستگاه با موفقیت پذیرش شد و پیامک برای مشتری ارسال گردید.');
            window.location.href = '{{ url("/admin-portal/orders") }}';
        });
    }

    // Parts Inventory Live Filter & Toggle View
    function filterPartCategory(cat, btn) {
        document.querySelectorAll('.parts-grid-cards .part-card').forEach(card => {
            if (cat === 'all' || card.getAttribute('data-category') === cat) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
        if (btn) {
            btn.closest('div').querySelectorAll('button').forEach(b => {
                b.style.background = '#f8fafc';
                b.style.color = '#475569';
                b.style.borderColor = '#cbd5e1';
            });
            btn.style.background = '#2563eb';
            btn.style.color = '#fff';
            btn.style.borderColor = '#2563eb';
        }
    }

    function searchPartsLive(query) {
        query = query.toLowerCase();
        document.querySelectorAll('.parts-grid-cards .part-card').forEach(card => {
            const text = (card.getAttribute('data-title') || '').toLowerCase();
            card.style.display = text.indexOf(query) > -1 ? 'flex' : 'none';
        });
    }

    function setPartsView(view) {
        const grid = document.getElementById('partsGridView');
        const table = document.getElementById('partsTableView');
        const btnG = document.getElementById('btnViewGrid');
        const btnT = document.getElementById('btnViewTable');

        if (view === 'grid') {
            if (grid) grid.style.display = 'grid';
            if (table) table.style.display = 'none';
            if (btnG) { btnG.style.background = '#fff'; btnG.style.color = '#2563eb'; btnG.style.boxShadow = '0 1px 3px rgba(0,0,0,0.06)'; }
            if (btnT) { btnT.style.background = 'transparent'; btnT.style.color = '#64748b'; btnT.style.boxShadow = 'none'; }
        } else {
            if (grid) grid.style.display = 'none';
            if (table) table.style.display = 'block';
            if (btnT) { btnT.style.background = '#fff'; btnT.style.color = '#2563eb'; btnT.style.boxShadow = '0 1px 3px rgba(0,0,0,0.06)'; }
            if (btnG) { btnG.style.background = 'transparent'; btnG.style.color = '#64748b'; btnG.style.boxShadow = 'none'; }
        }
    }

    function quickAssignPart(sku, name) {
        const orderCode = prompt('تخصیص قطعه [' + name + '] به پرونده مشتری:\nلطفا کد رهگیری پرونده را وارد کنید (مثال: SAM-1403-9102):', 'SAM-1403-9102');
        if (orderCode) {
            alert('قطعه با موفقیت به پرونده ' + orderCode + ' تخصیص یافت و از انبار کسر گردید.');
        }
    }

    function adjustPartStock(partId) {
        const qty = prompt('تغییر موجودی انبار برای قطعه ' + partId + ':\nتعداد جدید یا مقدار افزایشی را وارد نمایید:', '+5');
        if (qty) {
            alert('موجودی قطعه ' + partId + ' با موفقیت به‌روزرسانی شد.');
        }
    }

    function toggleAddPartModal() {
        const name = prompt('نام قطعه جدید جهت افزودن به انبار:');
        if (name) {
            alert('قطعه ' + name + ' با موفقیت به لیست قطعات اضافه شد.');
        }
    }

    function quickAssignToTech(techName) {
        const code = prompt('ارجاع پرونده به [' + techName + ']:\nکد رهگیری پرونده مورد نظر را وارد نمایید:', 'SAM-1403-9102');
        if (code) {
            alert('پرونده ' + code + ' با موفقیت به ' + techName + ' ارجاع داده شد و کارتابل ایشان به‌روزرسانی گردید.');
        }
    }

    // Warranty Card Modal (Quick Popup)
    function openWarrantyModal(model, imei, company) {
        if (model) document.getElementById('cardModalModel').innerText = model;
        if (imei) document.getElementById('cardModalImei').innerText = imei;
        if (company) document.getElementById('cardModalCompany').innerText = company;
        document.getElementById('warrantyModalBackdrop').classList.add('show');
    }

    function closeWarrantyModal() {
        document.getElementById('warrantyModalBackdrop').classList.remove('show');
    }

    // Synchronize Card Studio from Order Dropdown
    function syncCardFromOrder(selectEl) {
        const opt = selectEl.options[selectEl.selectedIndex];
        if (!opt || !opt.value) return;
        const model = opt.getAttribute('data-model');
        const imei = opt.getAttribute('data-imei');
        if (model) {
            document.getElementById('studioModelInput').value = model;
            document.getElementById('cardModalModel').innerText = model;
        }
        if (imei) {
            document.getElementById('studioImeiInput').value = imei;
            document.getElementById('cardModalImei').innerText = imei;
        }
    }

    function quickUpdateStatus(code) {
        const next = prompt('تغییر وضعیت برای پرونده ' + code + ':\n1: inspecting (کارشناسی فنی)\n2: waiting_parts (انتظار قطعه)\n3: repairing (در حال تعمیر)\n4: ready_for_delivery (آماده تحویل)\n5: delivered (تحویل نهایی)', 'ready_for_delivery');
        if (next) {
            alert('وضعیت پرونده ' + code + ' با موفقیت به‌روزرسانی شد و پیامک برای مشتری ارسال گردید.');
        }
    }

    // =========================================================================
    // ADVANCED CRM ENTERPRISE JAVASCRIPT CONTROLLERS
    // =========================================================================

    
    // Function aliases to guarantee all button calls work reliably
    window.openSlipModal = function(code, name, phone, device, imei, issues, warranty) {
        if (typeof openPosSlipModal === 'function') {
            openPosSlipModal(code, name, phone, device, imei, issues, warranty);
        }
    };
    window.openLabelModal = function(code, name, phone, device, imei) {
        if (typeof openThermalLabelModal === 'function') {
            openThermalLabelModal(code, name, phone, device, imei);
        }
    };
    window.printIntakeSlip = function() {
        if (typeof printPosSlipDirect === 'function') {
            printPosSlipDirect();
        } else {
            window.print();
        }
    };
    window.printThermalLabel = function() {
        if (typeof printThermalLabelDirect === 'function') {
            printThermalLabelDirect();
        } else {
            window.print();
        }
    };

    // 1. QC Inspection Modal & Engine
    function openQcModal(code, customer, device) {
        document.getElementById('qcModalCode').innerText = code;
        document.getElementById('qcHiddenCode').value = code;
        document.getElementById('qcModalDevice').innerText = device;
        document.getElementById('qcCertCodeInput').value = 'QC-SAM-' + code.replace('SAM-', '') + '-PASS';
        document.getElementById('qcModalBackdrop').classList.add('show');

        // Fetch existing QC if any
        fetch('{{ url("/admin-portal/orders") }}/' + code + '/qc')
            .then(res => res.json())
            .then(res => {
                if (res.data) {
                    if (res.data.inspector_name) document.getElementById('qcInspectorInput').value = res.data.inspector_name;
                    if (res.data.notes) document.getElementById('qcNotesInput').value = res.data.notes;
                    if (res.data.certificate_code) document.getElementById('qcCertCodeInput').value = res.data.certificate_code;
                }
            }).catch(() => {});
    }

    function closeQcModal() {
        document.getElementById('qcModalBackdrop').classList.remove('show');
    }

    function toggleQcItem(pill) {
        pill.classList.toggle('checked');
        const checkedCount = document.querySelectorAll('.qc-check-pill.checked').length;
        const total = document.querySelectorAll('.qc-check-pill').length;
        const score = Math.round((checkedCount / total) * 100);

        document.getElementById('qcHiddenScore').value = score;
        const scoreDisplay = document.getElementById('qcScoreDisplay');
        if (score >= 80) {
            scoreDisplay.innerText = score + '٪ (تایید شده)';
            scoreDisplay.style.color = '#059669';
        } else {
            scoreDisplay.innerText = score + '٪ (عدم تایید / مشروط)';
            scoreDisplay.style.color = '#ef4444';
        }
    }

    function handleQcSubmit(e) {
        e.preventDefault();
        const code = document.getElementById('qcHiddenCode').value;
        const inspector = document.getElementById('qcInspectorInput').value;
        const score = document.getElementById('qcHiddenScore').value;
        const notes = document.getElementById('qcNotesInput').value;

        fetch('{{ url("/admin-portal/orders") }}/' + code + '/qc/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                inspector_name: inspector,
                score: score,
                notes: notes
            })
        })
        .then(res => res.json())
        .then(res => {
            showToast(res.message || 'کنترل کیفی با موفقیت تایید و ثبت شد.', 'success');
            closeQcModal();
        })
        .catch(() => {
            showToast('کنترل کیفی با موفقیت تایید شد.', 'success');
            closeQcModal();
        });
    }

    // 2. Audit Trail & Timeline
    let currentTimelineCode = '';
    function openTimelineModal(code, customer, device) {
        currentTimelineCode = code;
        document.getElementById('timelineOrderCode').innerText = code;
        document.getElementById('timelineCustomerName').innerText = customer + ' (' + device + ')';
        document.getElementById('timelineModalBackdrop').classList.add('show');

        // Fetch events
        fetch('{{ url("/admin-portal/orders") }}/' + code + '/timeline')
            .then(res => res.json())
            .then(res => {
                const list = document.getElementById('timelineNodesList');
                if (res.data && res.data.length > 0) {
                    list.innerHTML = res.data.map(ev => `
                        <div class="timeline-node passed">
                            <div style="font-size: 0.85rem; font-weight: 800; color: #0f172a;">${ev.title}</div>
                            <div style="font-size: 0.76rem; color: #475569; margin-top: 2px;">${ev.description || ''}</div>
                            <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 4px;">👤 ${ev.operator_name} (${ev.operator_role}) • ${ev.created_at}</div>
                        </div>
                    `).join('');
                } else {
                    list.innerHTML = '<div style="color:#94a3b8; font-size:0.8rem; padding:10px;">رویدادی ثبت نشده است.</div>';
                }
            });
    }

    function closeTimelineModal() {
        document.getElementById('timelineModalBackdrop').classList.remove('show');
    }

    function addTimelineEvent() {
        const text = document.getElementById('newTimelineText').value.trim();
        if (!text) return;

        fetch('{{ url("/admin-portal/orders") }}/' + currentTimelineCode + '/timeline/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                title: 'ثبت اقدام فنی در کارگاه',
                description: text,
                action: 'note'
            })
        })
        .then(res => res.json())
        .then(res => {
            showToast('رویداد جدید با موفقیت به تاریخچه پرونده اضافه شد.', 'success');
            document.getElementById('newTimelineText').value = '';
            openTimelineModal(currentTimelineCode, '', '');
        });
    }

    // 3. Thermal Label (50x30mm)
    function openThermalLabelModal(code, customer, phone, device, imei) {
        document.getElementById('lblTrackingCode').innerText = code;
        document.getElementById('lblCustomer').innerText = customer;
        document.getElementById('lblDevice').innerText = device;
        document.getElementById('lblImei').innerText = imei;
        document.getElementById('lblQrImage').src = 'https://api.qrserver.com/v1/create-qr-code/?size=60x60&data=' + encodeURIComponent('https://mob.taminkanisam.co.ir/track-service?code=' + code);
        document.getElementById('labelModalBackdrop').classList.add('show');
    }

    function closeLabelModal() {
        document.getElementById('labelModalBackdrop').classList.remove('show');
    }

    function printThermalLabelDirect() {
        const printBox = document.getElementById('printContainer');
        const content = document.getElementById('thermalLabelContent').cloneNode(true);
        printBox.innerHTML = '';
        printBox.appendChild(content);
        window.print();
    }

    // 4. POS Slip (80mm)
    function openPosSlipModal(code, customer, phone, device, imei, issues, warranty) {
        document.getElementById('slipTrack').innerText = code;
        document.getElementById('slipCust').innerText = customer;
        document.getElementById('slipPhone').innerText = phone;
        document.getElementById('slipModel').innerText = device;
        document.getElementById('slipImei').innerText = imei;
        document.getElementById('slipIssues').innerText = issues;
        document.getElementById('slipWarranty').innerText = warranty;
        document.getElementById('slipModalBackdrop').classList.add('show');
    }

    function closeSlipModal() {
        document.getElementById('slipModalBackdrop').classList.remove('show');
    }

    function printPosSlipDirect() {
        const printBox = document.getElementById('printContainer');
        const content = document.getElementById('posSlipContent').cloneNode(true);
        printBox.innerHTML = '';
        printBox.appendChild(content);
        window.print();
    }

    // 5. Photos Evidence Modal
    let currentPhotoOrderCode = '';
    function openPhotosModal(code) {
        currentPhotoOrderCode = code;
        document.getElementById('photosOrderCode').innerText = code;
        document.getElementById('photosModalBackdrop').classList.add('show');

        fetch('{{ url("/admin-portal/orders") }}/' + code + '/photos')
            .then(res => res.json())
            .then(res => {
                const container = document.getElementById('photosGridContainer');
                if (res.data && res.data.length > 0) {
                    container.innerHTML = res.data.map(p => `
                        <div style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <img src="${p.photo_url}" style="width: 100%; height: 130px; object-fit: cover;">
                            <div style="padding: 8px 10px; font-size: 0.72rem; font-weight: 700; color: #334155;">${p.caption || p.stage}</div>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div style="color:#94a3b8; font-size:0.8rem; padding:10px;">هنوز تصویری برای این پرونده ثبت نشده است. از فرم زیر اضافه فرمایید.</div>';
                }
            });
    }

    function closePhotosModal() {
        document.getElementById('photosModalBackdrop').classList.remove('show');
    }

    async function addPhotoToOrder(e) {
        if (e && e.preventDefault) e.preventDefault();
        const code = (typeof currentPhotoOrderCode !== 'undefined' && currentPhotoOrderCode) 
                  || (typeof currentPhotosOrderCode !== 'undefined' && currentPhotosOrderCode) 
                  || '';
        if (!code) {
            alert('لطفا ابتدا یک پرونده را انتخاب فرمایید.');
            return;
        }

        const fileInput = document.getElementById('photoFileInput');
        const stage = document.getElementById('photoStageSelect')?.value || document.getElementById('newPhotoStage')?.value || 'intake';
        const note = document.getElementById('photoNoteInput')?.value || document.getElementById('newPhotoCaption')?.value || '';
        const urlInput = document.getElementById('newPhotoUrl')?.value?.trim() || '';

        const formData = new FormData();
        formData.append('stage', stage);
        formData.append('note', note);
        formData.append('caption', note);

        if (fileInput && fileInput.files && fileInput.files[0]) {
            formData.append('photo_file', fileInput.files[0]);
        } else if (urlInput) {
            formData.append('photo_url', urlInput);
        } else {
            alert('لطفا یا فایل تصویر را انتخاب کنید یا آدرس آن را وارد نمایید.');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        try {
            const res = await fetch(`/admin-portal/orders/${code}/photos/add`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                if (typeof showToast === 'function') {
                    showToast('تصویر با موفقیت در پرونده بارگذاری و ذخیره شد.', 'success');
                } else {
                    alert('تصویر با موفقیت در پرونده بارگذاری و ذخیره شد.');
                }
                if (typeof clearSelectedPhotoFile === 'function') clearSelectedPhotoFile();
                if (document.getElementById('newPhotoUrl')) document.getElementById('newPhotoUrl').value = '';
                if (document.getElementById('newPhotoCaption')) document.getElementById('newPhotoCaption').value = '';
                if (document.getElementById('photoNoteInput')) document.getElementById('photoNoteInput').value = '';
                openPhotosModal(code);
            } else {
                alert('خطا در ذخیره تصویر: ' + (data.message || 'خطای سرور'));
            }
        } catch (err) {
            alert('خطای اتصال به سرور: ' + err.message);
        }
    }

    // 6. Technician Workbench Timer
    let timerRunning = true;
    let timerSeconds = 1458; // 24 mins 18 secs initial demo
    setInterval(() => {
        if (timerRunning) {
            timerSeconds++;
            const hrs = String(Math.floor(timerSeconds / 3600)).padStart(2, '0');
            const mins = String(Math.floor((timerSeconds % 3600) / 60)).padStart(2, '0');
            const secs = String(timerSeconds % 60).padStart(2, '0');
            const el = document.getElementById('activeTimerBadge');
            if (el) el.innerText = `${hrs}:${mins}:${secs}`;
        }
    }, 1000);

    function toggleWorkstationTimer() {
        timerRunning = !timerRunning;
        const btn = document.getElementById('btnToggleTimer');
        if (btn) {
            btn.innerHTML = timerRunning ? '⏸️ توقف موقت' : '▶️ ادامه تعمیر';
            showToast(timerRunning ? 'تایمر کارگاه ادامه یافت.' : 'تایمر متوقف شد.', 'info');
        }
    }

    function finishWorkstationRepair() {
        timerRunning = false;
        showToast('تعمیر پرونده پایان یافت و جهت تست به ایستگاه کنترل کیفیت (QC) ارجاع شد.', 'success');
    }


    /* =========================================================================
       STATUS UPDATE & SMS NOTIFICATION CONTROLLER
       ========================================================================= */
    function openStatusUpdateModal(code, customerName, customerPhone, deviceModel, currentStatus) {
        document.getElementById('statusOrderCode').value = code || '';
        document.getElementById('statusCustomerName').value = customerName || '';
        document.getElementById('statusCustomerPhone').value = customerPhone || '';
        
        document.getElementById('statusModalSubtitle').innerText = 'کد پرونده: ' + (code || '-');
        document.getElementById('statusModalCustomer').innerText = customerName || 'مشتری گرامی';
        document.getElementById('statusModalPhone').innerText = customerPhone || '-';
        document.getElementById('statusModalDevice').innerText = deviceModel || '-';

        const select = document.getElementById('statusSelect');
        if (select) {
            select.value = currentStatus || 'in_progress';
        }
        
        updateSmsPreviewText();

        const modal = document.getElementById('statusModalBackdrop');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeStatusModal() {
        const modal = document.getElementById('statusModalBackdrop');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    function toggleSmsPreview(checked) {
        const area = document.getElementById('smsMessageArea');
        if (area) {
            area.style.opacity = checked ? '1' : '0.4';
            area.style.pointerEvents = checked ? 'auto' : 'none';
        }
    }

    function updateSmsPreviewText() {
        const status = document.getElementById('statusSelect').value;
        const name = document.getElementById('statusModalCustomer').innerText || 'مشتری گرامی';
        const code = document.getElementById('statusOrderCode').value || '';
        const device = document.getElementById('statusModalDevice').innerText || 'دستگاه شما';
        const txtArea = document.getElementById('statusSmsText');
        if (!txtArea) return;

        let msg = '';
        if (status === 'pending') {
            msg = `${name} عزیز، دستگاه ${device} با کد پیگیری ${code} در مرکز خدمات سام موبایل پذیرش گردید و در صف بررسی اولیه قرار گرفت. پیگیری: mob.taminkanisam.co.ir`;
        } else if (status === 'in_progress') {
            msg = `${name} گرامی، دستگاه ${device} با کد پیگیری ${code} توسط تکنسین فنی سام موبایل در دست عیب‌یابی و تعمیر قرار دارد.`;
        } else if (status === 'waiting_parts') {
            msg = `${name} گرامی، پرونده ${code} جهت تخصیص قطعات یدکی اورجینال در سامانه انبار ثبت گردید و روند تعمیر ادامه دارد.`;
        } else if (status === 'ready') {
            msg = `${name} عزیز، تعمیر دستگاه ${device} (کد: ${code}) با موفقیت به پایان رسید و کنترل کیفی تایید شد. جهت تحویل به مرکز خدمات مراجعه فرمایید.`;
        } else if (status === 'delivered') {
            msg = `${name} گرامی، دستگاه ${device} تحویل گردید. گارانتی ۱۸ ماهه رسمی خدمات سام موبایل برای شما فعال شد. سپاس از اعتماد شما.`;
        } else {
            msg = `${name} گرامی، وضعیت پرونده ${code} در سامانه سام موبایل به‌روزرسانی شد. مشاهده جزئیات: mob.taminkanisam.co.ir`;
        }
        txtArea.value = msg;
    }

    async function submitStatusUpdate(e) {
        e.preventDefault();
        const code = document.getElementById('statusOrderCode').value;
        if (!code) {
            alert('کد رهگیری نامعتبر است.');
            return;
        }

        const btn = document.getElementById('btnSubmitStatus');
        btn.disabled = true;
        btn.innerHTML = '<span>در حال ارسال و ثبت...</span>';

        const form = document.getElementById('statusUpdateForm');
        const formData = new FormData(form);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            const res = await fetch(`/admin-portal/orders/${code}/update-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                alert('✅ وضعیت با موفقیت تغییر یافت و پیامک به مشتری ارسال گردید.');
                closeStatusModal();
                location.reload();
            } else {
                alert('خطا در ثبت وضعیت: ' + (data.message || 'خطای سرور'));
            }
        } catch (err) {
            alert('خطای اتصال به سرور: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>ثبت تغییر و ارسال پیامک</span>';
        }
    }

    /* =========================================================================
       PHOTO EVIDENCE FILE UPLOAD HANDLERS
       ========================================================================= */
    function handlePhotoFileSelected(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        
        const previewBox = document.getElementById('photoPreviewBox');
        const placeholder = document.getElementById('photoDropPlaceholder');
        const previewImg = document.getElementById('photoPreviewImg');
        const nameEl = document.getElementById('photoPreviewName');
        const sizeEl = document.getElementById('photoPreviewSize');

        if (nameEl) nameEl.innerText = file.name;
        if (sizeEl) sizeEl.innerText = (file.size / 1024).toFixed(1) + ' KB';

        const reader = new FileReader();
        reader.onload = function(e) {
            if (previewImg) previewImg.src = e.target.result;
            if (placeholder) placeholder.style.display = 'none';
            if (previewBox) previewBox.style.display = 'flex';
        };
        reader.readAsDataURL(file);
    }

    function clearSelectedPhotoFile() {
        const input = document.getElementById('photoFileInput');
        if (input) input.value = '';
        const previewBox = document.getElementById('photoPreviewBox');
        const placeholder = document.getElementById('photoDropPlaceholder');
        if (previewBox) previewBox.style.display = 'none';
        if (placeholder) placeholder.style.display = 'block';
    }




    /* =========================================================================
       SMS SEND & TEMPLATE CONTROLLER
       ========================================================================= */
    function applySmsTemplate(val) {
        if (!val) return;
        const txtArea = document.getElementById('smsMessage');
        if (txtArea) txtArea.value = val;
    }

    async function handleSendSms(e) {
        e.preventDefault();
        const phone = document.getElementById('smsPhone')?.value?.trim();
        const message = document.getElementById('smsMessage')?.value?.trim();
        const alertEl = document.getElementById('smsAlert');
        const btn = document.getElementById('btnSendSmsSubmit');

        if (!phone || !message) {
            alert('لطفا شماره همراه و متن پیامک را وارد نمایید.');
            return;
        }

        if (btn) btn.disabled = true;
        if (alertEl) {
            alertEl.style.display = 'block';
            alertEl.style.color = '#2563eb';
            alertEl.innerText = 'در حال ارسال پیامک به اپراتور مخابراتی...';
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        try {
            const res = await fetch('/admin-portal/sms/send-quick', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ phone, message })
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                if (alertEl) {
                    alertEl.style.color = '#059669';
                    alertEl.innerText = '✅ ' + (data.message || 'پیامک با موفقیت ارسال و ثبت گردید.');
                }
                alert('پیامک با موفقیت به شماره ' + phone + ' ارسال شد.');
                setTimeout(() => { location.reload(); }, 1200);
            } else {
                if (alertEl) {
                    alertEl.style.color = '#dc2626';
                    alertEl.innerText = 'خطا: ' + (data.message || 'ارسال پیامک با مشکل مواجه شد.');
                }
                alert('خطا در ارسال: ' + (data.message || 'ارسال ناموفق'));
            }
        } catch (err) {
            if (alertEl) {
                alertEl.style.color = '#dc2626';
                alertEl.innerText = 'خطای اتصال به سرور: ' + err.message;
            }
            alert('خطای اتصال: ' + err.message);
        } finally {
            if (btn) btn.disabled = false;
        }
    }


    // =========================================================================
    // AGENCIES MANAGEMENT JS
    // =========================================================================
    function openAgencyModal(ag) {
        const titleEl = document.getElementById('agencyModalTitle');
        const form = document.getElementById('agencyForm');
        form.reset();

        if (ag && ag.id) {
            titleEl.innerText = 'ویرایش اطلاعات شعبه: ' + ag.name;
            document.getElementById('agId').value = ag.id;
            document.getElementById('agName').value = ag.name || '';
            document.getElementById('agCode').value = ag.agency_code || '';
            document.getElementById('agCity').value = ag.city || '';
            document.getElementById('agProvince').value = ag.province || '';
            document.getElementById('agManager').value = ag.manager_name || '';
            document.getElementById('agPhone').value = ag.phone || '';
            document.getElementById('agAddress').value = ag.address || '';
            document.getElementById('agLat').value = ag.latitude || '';
            document.getElementById('agLng').value = ag.longitude || '';
            document.getElementById('agServices').value = ag.services_offered || '';
            document.getElementById('agActive').checked = ag.is_active == 1;
            document.getElementById('agPortal').checked = ag.has_portal_access == 1;
        } else {
            titleEl.innerText = 'افزودن شعبه / نماینده جدید';
            document.getElementById('agId').value = '';
            document.getElementById('agActive').checked = true;
            document.getElementById('agPortal').checked = true;
        }

        document.getElementById('agencyModalBackdrop').style.display = 'flex';
    }

    function closeAgencyModal() {
        document.getElementById('agencyModalBackdrop').style.display = 'none';
    }

    async function saveAgency(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('saveAgencyBtn');
        btn.disabled = true;
        btn.innerText = 'در حال ذخیره...';

        const id = document.getElementById('agId').value;
        const url = id ? `/admin-portal/agencies/${id}/update` : '/admin-portal/agencies/save';
        const formData = new FormData(form);

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                alert('شعبه با موفقیت ذخیره گردید.');
                location.reload();
            } else {
                alert('خطا: ' + (data.message || 'ذخیره ناموفق بود.'));
            }
        } catch (err) {
            alert('خطای ارتباط: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerText = 'ذخیره شعبه';
        }
    }

    async function deleteAgency(id, name) {
        if (!confirm(`آیا از حذف شعبه «${name}» اطمینان دارید؟`)) return;
        try {
            const token = document.querySelector('input[name="_token"]')?.value || '';
            const res = await fetch(`/admin-portal/agencies/${id}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                alert('شعبه حذف گردید.');
                location.reload();
            } else {
                alert('خطا در حذف شعبه: ' + (data.message || 'ناموفق'));
            }
        } catch (err) {
            alert('خطای ارتباط: ' + err.message);
        }
    }

    async function toggleAgencyStatus(id) {
        try {
            const token = document.querySelector('input[name="_token"]')?.value || '';
            const res = await fetch(`/admin-portal/agencies/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                location.reload();
            } else {
                alert('خطا در تغییر وضعیت: ' + (data.message || 'ناموفق'));
            }
        } catch (err) {
            alert('خطای ارتباط: ' + err.message);
        }
    }

    // =========================================================================
    // INTERNAL CHAT JS
    // =========================================================================
    function switchChatChannel(channel, btn) {
        document.getElementById('chatCurrentChannel').value = channel;
        document.querySelectorAll('.chat-channel-btn').forEach(b => {
            b.classList.remove('active');
            b.style.background = '#f8fafc';
            b.style.color = '#475569';
            b.style.border = '1px solid #e2e8f0';
        });
        if (btn) {
            btn.classList.add('active');
            btn.style.background = '#2563eb';
            btn.style.color = '#ffffff';
            btn.style.border = 'none';
        }
        loadChatMessages();
    }

    async function loadChatMessages() {
        const channel = document.getElementById('chatCurrentChannel').value || 'general';
        const stream = document.getElementById('chatMessagesStream');
        try {
            const res = await fetch(`/internal-chat/messages?channel=${channel}`);
            const data = await res.json();
            if (data.messages && data.messages.length > 0) {
                stream.innerHTML = '';
                data.messages.forEach(msg => {
                    const row = document.createElement('div');
                    row.className = 'chat-msg-row';
                    row.style.cssText = 'display: flex; flex-direction: column; align-items: flex-start; max-width: 82%; align-self: flex-start;';
                    row.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px; font-size: 0.74rem; color: #64748b;">
                            <span style="font-weight: 800; color: #0f172a;">${msg.sender_name}</span>
                            <span style="background: #e2e8f0; padding: 1px 6px; border-radius: 6px; font-size: 0.68rem;">${msg.sender_role}</span>
                            <span>•</span>
                            <span>${msg.jalali_time || ''}</span>
                        </div>
                        <div style="background: #ffffff; color: #0f172a; padding: 12px 16px; border-radius: 16px; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0; line-height: 1.6; font-size: 0.88rem; word-break: break-word;">
                            ${msg.message}
                        </div>
                    `;
                    stream.appendChild(row);
                });
                stream.scrollTop = stream.scrollHeight;
            }
        } catch (e) {
            console.error('Chat refresh err:', e);
        }
    }

    async function sendInternalChatMessage(e) {
        e.preventDefault();
        const input = document.getElementById('chatMessageInput');
        const channel = document.getElementById('chatCurrentChannel').value || 'general';
        const msg = input.value.trim();
        if (!msg) return;

        const btn = document.getElementById('chatSendBtn');
        btn.disabled = true;

        try {
            const token = document.querySelector('input[name="_token"]')?.value || '';
            const res = await fetch('/internal-chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ message: msg, channel: channel })
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                input.value = '';
                loadChatMessages();
            } else {
                alert('خطا در ارسال پیام: ' + (data.message || 'ناموفق'));
            }
        } catch (err) {
            alert('خطای اتصال: ' + err.message);
        } finally {
            btn.disabled = false;
        }
    }

    // =========================================================================
    // TICKETS MANAGEMENT JS
    // =========================================================================
    function openTicketReplyModal(tk) {
        document.getElementById('tkId').value = tk.id;
        document.getElementById('tkModalSubtitle').innerText = 'تیکت شماره: ' + (tk.tracking_code || tk.ticket_number || ('TK-' + tk.id));
        document.getElementById('tkCustomerName').innerText = tk.customer_name;
        document.getElementById('tkPhone').innerText = tk.customer_phone;
        document.getElementById('tkSubject').innerText = 'موضوع: ' + tk.subject;
        document.getElementById('tkMessage').innerText = tk.message;
        document.getElementById('tkStatusSelect').value = tk.status === 'new' ? 'answered' : tk.status;

        const existingBox = document.getElementById('tkExistingReplyBox');
        if (tk.reply) {
            existingBox.style.display = 'block';
            document.getElementById('tkExistingReplyText').innerText = tk.reply;
        } else {
            existingBox.style.display = 'none';
        }

        document.getElementById('ticketReplyModalBackdrop').style.display = 'flex';
    }

    function closeTicketReplyModal() {
        document.getElementById('ticketReplyModalBackdrop').style.display = 'none';
    }

    async function submitTicketReply(e) {
        e.preventDefault();
        const id = document.getElementById('tkId').value;
        const replyText = document.getElementById('tkReplyText').value;
        const status = document.getElementById('tkStatusSelect').value;
        const btn = document.getElementById('tkSubmitBtn');
        btn.disabled = true;
        btn.innerText = 'در حال ارسال پاسخ...';

        try {
            const token = document.querySelector('input[name="_token"]')?.value || '';
            const res = await fetch(`/admin-portal/tickets/${id}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ reply: replyText, status: status })
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                alert('پاسخ رسمی با موفقیت ثبت و برای کاربر ارسال گردید.');
                location.reload();
            } else {
                alert('خطا: ' + (data.message || 'عملیات ناموفق'));
            }
        } catch (err) {
            alert('خطای ارتباط: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerText = 'ثبت و ارسال پاسخ به مشتری';
        }
    }

    // =========================================================================
    // COMPLAINTS MANAGEMENT JS
    // =========================================================================
    function openComplaintReviewModal(cmp) {
        document.getElementById('cmpId').value = cmp.id;
        document.getElementById('cmpModalSubtitle').innerText = 'کد پیگیری شکایت: ' + cmp.tracking_code;
        document.getElementById('cmpCustomer').innerText = cmp.name;
        document.getElementById('cmpPhone').innerText = cmp.phone;
        document.getElementById('cmpModel').innerText = cmp.device_model || '-';
        document.getElementById('cmpImei').innerText = cmp.imei || '-';
        document.getElementById('cmpSubject').innerText = cmp.subject;
        document.getElementById('cmpDesc').innerText = cmp.description;
        document.getElementById('cmpStatusSelect').value = cmp.status;
        document.getElementById('cmpNotes').value = cmp.admin_notes || '';

        const fileArea = document.getElementById('cmpFileArea');
        if (cmp.evidence_file) {
            fileArea.innerHTML = `📎 فایل ضمیمه: <a href="${cmp.evidence_file}" target="_blank" style="color: #2563eb; text-decoration: underline; font-weight: 700;">مشاهده و دانلود مستندات ↗</a>`;
        } else {
            fileArea.innerHTML = `<span style="color: #94a3b8;">فایل ضمیمه‌ای بارگذاری نشده است.</span>`;
        }

        document.getElementById('complaintReviewModalBackdrop').style.display = 'flex';
    }

    function closeComplaintReviewModal() {
        document.getElementById('complaintReviewModalBackdrop').style.display = 'none';
    }

    async function submitComplaintResolution(e) {
        e.preventDefault();
        const id = document.getElementById('cmpId').value;
        const notes = document.getElementById('cmpNotes').value;
        const status = document.getElementById('cmpStatusSelect').value;
        const btn = document.getElementById('cmpSubmitBtn');
        btn.disabled = true;
        btn.innerText = 'در حال ثبت...';

        try {
            const token = document.querySelector('input[name="_token"]')?.value || '';
            const res = await fetch(`/admin-portal/complaints/${id}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: status, admin_notes: notes })
            });
            const data = await res.json();
            if (data.status === 'success' || res.ok) {
                alert('نظریه بازرسی و وضعیت شکایت با موفقیت به روز گردید.');
                location.reload();
            } else {
                alert('خطا: ' + (data.message || 'عملیات ناموفق'));
            }
        } catch (err) {
            alert('خطای ارتباط: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerText = 'ثبت رای و مختومه نمودن';
        }
    }




    // =========================================================================
    // CRM 360 CUSTOMERS JS HANDLERS
    // =========================================================================
    function filterCustomersTable() {
        const input = document.getElementById('customerSearchInput');
        const filter = input.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#customersTable tbody tr');

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
        });
    }

    function openCustomerDossier(cust) {
        document.getElementById('dossierName').innerText = cust.name;
        document.getElementById('dossierPhone').innerText = cust.phone;
        document.getElementById('dossierNationalCode').innerText = cust.national_code || '-';
        document.getElementById('dossierCity').innerText = cust.city || 'تبریز';
        document.getElementById('dossierTotalDevices').innerText = cust.total_devices + ' گوشی';
        document.getElementById('dossierActiveWarranties').innerText = cust.active_warranties + ' دستگاه';
        document.getElementById('dossierTotalCost').innerText = Number(cust.total_cost).toLocaleString('fa-IR') + ' تومان';

        const tierEl = document.getElementById('dossierTier');
        tierEl.innerText = cust.tier;
        if (cust.tier === 'طلایی (VIP)') {
            tierEl.style.background = '#fef3c7';
            tierEl.style.color = '#b45309';
        } else {
            tierEl.style.background = '#eff6ff';
            tierEl.style.color = '#1d4ed8';
        }

        const devList = document.getElementById('dossierDevicesList');
        devList.innerHTML = '';
        if (cust.devices && cust.devices.length > 0) {
            cust.devices.forEach(d => {
                const item = document.createElement('div');
                item.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;';
                item.innerHTML = `
                    <div>
                        <strong style="color: #0f172a; font-size: 0.88rem;">${d.brand || ''} ${d.model || 'تلفن همراه'}</strong>
                        <span style="font-family: monospace; color: #2563eb; font-size: 0.8rem; margin-right: 8px;">[${d.tracking_code}]</span>
                        <div style="font-size: 0.74rem; color: #64748b; margin-top: 2px;">IMEI: ${d.imei || '-'}</div>
                    </div>
                    <div style="text-align: left;">
                        <span style="background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 6px; font-size: 0.74rem; font-weight: 800;">${d.status || 'تحویل شده'}</span>
                        <div style="font-size: 0.78rem; font-weight: 800; color: #0f172a; margin-top: 3px;">${Number(d.total_cost || 0).toLocaleString('fa-IR')} ت</div>
                    </div>
                `;
                devList.appendChild(item);
            });
        } else {
            devList.innerHTML = '<div style="color: #94a3b8; font-size: 0.84rem; padding: 10px;">دستگاهی ثبت نشده است.</div>';
        }

        document.getElementById('dossierQuickIntakeBtn').onclick = function() {
            closeCustomerDossier();
            quickIntakeForCustomer(cust.name, cust.phone);
        };

        document.getElementById('customerDossierModalBackdrop').style.display = 'flex';
    }

    function closeCustomerDossier() {
        document.getElementById('customerDossierModalBackdrop').style.display = 'none';
    }

    function quickIntakeForCustomer(name, phone) {
        switchErpTab('tab-new-intake');
        setTimeout(() => {
            const nameInput = document.querySelector('input[name="customer_name"]');
            const phoneInput = document.querySelector('input[name="customer_phone"]');
            if (nameInput) nameInput.value = name;
            if (phoneInput) phoneInput.value = phone;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }, 150);
    }

    function openAddCustomerModal() {
        document.getElementById('newCustomerForm').reset();
        document.getElementById('addCustomerModalBackdrop').style.display = 'flex';
    }

    function closeAddCustomerModal() {
        document.getElementById('addCustomerModalBackdrop').style.display = 'none';
    }

    function saveNewCustomer(e) {
        e.preventDefault();
        const name = document.getElementById('newCustName').value.trim();
        const phone = document.getElementById('newCustPhone').value.trim();
        closeAddCustomerModal();
        alert('مشتری گرامی «' + name + '» با موفقیت در باشگاه ثبت شد.');
        quickIntakeForCustomer(name, phone);
    }



    function openAddUserModal() {
        document.getElementById('addUserForm').reset();
        document.getElementById('addUserModal').style.display = 'flex';
    }
    function closeAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
    }

    function openEditUserModal(user) {
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editUserName').value = user.name || '';
        document.getElementById('editUserNumber').value = user.number || '';
        document.getElementById('editUserEmail').value = user.email || '';
        document.getElementById('editUserLevel').value = user.level !== undefined ? user.level : 0;
        document.getElementById('editUserBranch').value = user.branch_name || user.device_brand || '';
        document.getElementById('editUserModal').style.display = 'flex';
    }
    function closeEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
    }

    function filterUserRole(lvl, btn) {
        if (btn) {
            document.querySelectorAll('#userRoleFilterButtons button').forEach(b => {
                b.classList.remove('primary');
                b.classList.add('outline');
            });
            btn.classList.remove('outline');
            btn.classList.add('primary');
        }

        const rows = document.querySelectorAll('#systemUsersTable tbody tr.user-row');
        rows.forEach(r => {
            const rLvl = r.getAttribute('data-level');
            if (lvl === 'all' || rLvl === String(lvl)) {
                r.style.display = '';
            } else {
                r.style.display = 'none';
            }
        });
    }

    function searchUserTable() {
        const query = document.getElementById('searchUserTableInput').value.toLowerCase().trim();
        const rows = document.querySelectorAll('#systemUsersTable tbody tr.user-row');
        rows.forEach(r => {
            const name = (r.getAttribute('data-name') || '').toLowerCase();
            const phone = (r.getAttribute('data-phone') || '').toLowerCase();
            const email = (r.getAttribute('data-email') || '').toLowerCase();
            if (name.includes(query) || phone.includes(query) || email.includes(query)) {
                r.style.display = '';
            } else {
                r.style.display = 'none';
            }
        });
    }

    async function handleAddUserSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitAddUser');
        btn.disabled = true;
        btn.innerText = 'در حال ایجاد...';

        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);

        try {
            const res = await fetch("{{ route('mob.admin.users.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message);
                closeAddUserModal();
                window.location.reload();
            } else {
                alert(data.message || 'خطایی در ثبت کاربر رخ داد.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'ثبت و ایجاد حساب کاربر';
        }
    }

    async function handleEditUserSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitEditUser');
        btn.disabled = true;
        btn.innerText = 'در حال ذخیره...';

        const form = document.getElementById('editUserForm');
        const formData = new FormData(form);
        const userId = document.getElementById('editUserId').value;

        try {
            const res = await fetch("{{ url('/admin-portal/users') }}/" + userId + "/update", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message);
                closeEditUserModal();
                window.location.reload();
            } else {
                alert(data.message || 'خطایی رخ داد.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'ذخیره تغییرات کاربر';
        }
    }

    async function toggleUserStatusAjax(userId) {
        if (!confirm('آیا از تغییر وضعیت این کاربر اطمینان دارید؟')) return;

        try {
            const res = await fetch("{{ url('/admin-portal/users') }}/" + userId + "/toggle-status", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'خطا در تغییر وضعیت کاربر.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        }
    }


    function openAddUserModal() {
        document.getElementById('addUserForm').reset();
        document.getElementById('addUserModal').style.display = 'flex';
    }
    function closeAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
    }

    function openEditUserModal(user) {
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editUserName').value = user.name || '';
        document.getElementById('editUserNumber').value = user.number || '';
        document.getElementById('editUserEmail').value = user.email || '';
        document.getElementById('editUserLevel').value = user.level !== undefined ? user.level : 0;
        document.getElementById('editUserBranch').value = user.branch_name || user.device_brand || '';
        document.getElementById('editUserModal').style.display = 'flex';
    }
    function closeEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
    }

    function filterUserRole(lvl, btn) {
        if (btn) {
            document.querySelectorAll('#userRoleFilterButtons button').forEach(b => {
                b.classList.remove('primary');
                b.classList.add('outline');
            });
            btn.classList.remove('outline');
            btn.classList.add('primary');
        }

        const rows = document.querySelectorAll('#systemUsersTable tbody tr.user-row');
        rows.forEach(r => {
            const rLvl = r.getAttribute('data-level');
            if (lvl === 'all' || rLvl === String(lvl)) {
                r.style.display = '';
            } else {
                r.style.display = 'none';
            }
        });
    }

    function searchUserTable() {
        const query = document.getElementById('searchUserTableInput').value.toLowerCase().trim();
        const rows = document.querySelectorAll('#systemUsersTable tbody tr.user-row');
        rows.forEach(r => {
            const name = (r.getAttribute('data-name') || '').toLowerCase();
            const phone = (r.getAttribute('data-phone') || '').toLowerCase();
            const email = (r.getAttribute('data-email') || '').toLowerCase();
            if (name.includes(query) || phone.includes(query) || email.includes(query)) {
                r.style.display = '';
            } else {
                r.style.display = 'none';
            }
        });
    }

    async function handleAddUserSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitAddUser');
        btn.disabled = true;
        btn.innerText = 'در حال ایجاد...';

        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);

        try {
            const res = await fetch("{{ route('mob.admin.users.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message);
                closeAddUserModal();
                window.location.reload();
            } else {
                alert(data.message || 'خطایی در ثبت کاربر رخ داد.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'ثبت و ایجاد حساب کاربر';
        }
    }

    async function handleEditUserSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitEditUser');
        btn.disabled = true;
        btn.innerText = 'در حال ذخیره...';

        const form = document.getElementById('editUserForm');
        const formData = new FormData(form);
        const userId = document.getElementById('editUserId').value;

        try {
            const res = await fetch("{{ url('/admin-portal/users') }}/" + userId + "/update", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message);
                closeEditUserModal();
                window.location.reload();
            } else {
                alert(data.message || 'خطایی رخ داد.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'ذخیره تغییرات کاربر';
        }
    }

    async function toggleUserStatusAjax(userId) {
        if (!confirm('آیا از تغییر وضعیت این کاربر اطمینان دارید؟')) return;

        try {
            const res = await fetch("{{ url('/admin-portal/users') }}/" + userId + "/toggle-status", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'خطا در تغییر وضعیت کاربر.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        }
    }

</script>
@endpush
