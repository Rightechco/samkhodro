@extends('home.mobile.portal-layout')

@section('title', 'سامانه مدیریت خدمات پس از فروش | پنل مدیریت سام موبایل')
@section('meta_description', 'سامانه جامع مدیریت خدمات پس از فروش و نمایندگی‌های سام موبایل (تامین کانی سام) مطابق با ماده ۱۳ ضوابط اجرایی')

@push('styles')
<style>
    /* =========================================================================
       ULTRA-PREMIUM ERP DASHBOARD & SIDEBAR STYLING
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

    /* Outer wrapper */
    .erp-container {
        display: flex;
        min-height: calc(100vh - 120px);
        position: relative;
        padding-bottom: 60px;
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
        height: calc(100vh - 90px);
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin: 20px 0 20px 20px;
        padding: 20px 14px;
        z-index: 100;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow-y: auto;
    }

    /* User Profile Chip in Sidebar */
    .erp-user-badge {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%);
        border: 1px solid #dbeafe;
        border-radius: 14px;
        margin-bottom: 20px;
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
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
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
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .erp-user-role {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.72rem;
        font-weight: 700;
        color: #2563eb;
        margin-top: 2px;
    }
    .erp-pulse-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
    }

    /* Navigation Menu */
    .erp-nav-section-title {
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        color: #94a3b8;
        padding: 8px 12px 4px;
        text-transform: uppercase;
    }
    .erp-nav-list {
        list-style: none;
        padding: 0;
        margin: 0 0 16px 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .erp-nav-item {
        margin: 0;
    }
    .erp-nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 0.84rem;
        font-weight: 700;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid transparent;
        background: transparent;
        width: 100%;
        text-align: right;
    }
    .erp-nav-link:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .erp-nav-link.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 800;
        border-color: #bfdbfe;
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
        font-size: 0.72rem;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 20px;
        background: #e2e8f0;
        color: #475569;
    }
    .erp-nav-link.active .erp-nav-badge {
        background: #2563eb;
        color: #ffffff;
    }

    /* Sidebar Footer */
    .erp-sidebar-footer {
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .erp-logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        background: #fff1f2;
        color: #e11d48;
        font-size: 0.82rem;
        font-weight: 700;
        border: 1px solid #ffe4e6;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .erp-logout-btn:hover {
        background: #ffe4e6;
        color: #be123c;
    }

    /* -------------------------------------------------------------------------
       2. MAIN CONTENT AREA & TOPBAR
       ------------------------------------------------------------------------- */
    .erp-main {
        flex: 1;
        min-width: 0;
        padding: 20px 20px 20px 0;
    }

    /* Top Bar */
    .erp-topbar {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
        gap: 14px;
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
        border: 1px solid #e2e8f0;
        align-items: center;
        justify-content: center;
        color: #334155;
        cursor: pointer;
    }
    .erp-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: #64748b;
    }
    .erp-breadcrumb strong {
        color: #0f172a;
        font-weight: 800;
    }
    .erp-search-box {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 14px;
        width: 320px;
        transition: all 0.2s;
    }
    .erp-search-box:focus-within {
        background: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .erp-search-input {
        border: none;
        background: transparent;
        outline: none;
        font-family: inherit;
        font-size: 0.84rem;
        width: 100%;
        color: #1e293b;
    }
    .erp-top-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-quick-intake {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 10px;
        background: var(--primary-gradient);
        color: #ffffff;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
        border: none;
        cursor: pointer;
        transition: transform 0.15s ease;
    }
    .btn-quick-intake:hover {
        transform: translateY(-1px);
        color: #ffffff;
    }

    /* -------------------------------------------------------------------------
       3. METRIC KPI CARDS
       ------------------------------------------------------------------------- */
    .erp-kpi-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    .kpi-card {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 16px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }
    .kpi-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .kpi-title {
        font-size: 0.76rem;
        font-weight: 700;
        color: #64748b;
    }
    .kpi-icon-wrap {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .kpi-val {
        font-size: 1.6rem;
        font-weight: 900;
        color: #0f172a;
        line-height: 1;
        font-family: monospace, inherit;
    }
    .kpi-sub {
        font-size: 0.70rem;
        color: #94a3b8;
        margin-top: 6px;
        font-weight: 600;
    }

    /* -------------------------------------------------------------------------
       4. TAB CONTENT VIEWS (Single Page Experience)
       ------------------------------------------------------------------------- */
    .erp-view {
        display: none;
    }
    .erp-view.active {
        display: block;
        animation: fadeInTab 0.25s ease-out;
    }
    @keyframes fadeInTab {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Card Panels */
    .erp-panel {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 22px;
        margin-bottom: 22px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
    }
    .erp-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 18px;
    }
    .erp-panel-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .erp-panel-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Orders Filter Pills */
    .filter-pills-wrap {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }
    .filter-pill-item {
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 700;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-pill-item:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .filter-pill-item.active {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    /* Data Tables */
    .table-responsive-box {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    .erp-table {
        width: 100%;
        border-collapse: collapse;
        text-align: right;
        font-size: 0.82rem;
    }
    .erp-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 800;
        padding: 12px 14px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }
    .erp-table td {
        padding: 13px 14px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        vertical-align: middle;
    }
    .erp-table tr:hover td {
        background: #fafafa;
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
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 800;
        white-space: nowrap;
    }
    .status-badge.received { background: #f1f5f9; color: #475569; }
    .status-badge.inspecting { background: #fef3c7; color: #b45309; }
    .status-badge.repairing { background: #e0f2fe; color: #0284c7; }
    .status-badge.waiting_parts { background: #fce7f3; color: #be185d; }
    .status-badge.ready_for_delivery { background: #dcfce7; color: #15803d; }
    .status-badge.delivered { background: #ede9fe; color: #6d28d9; }

    /* Action Buttons in Table */
    .table-actions-cell {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-table-action {
        padding: 5px 9px;
        border-radius: 8px;
        font-size: 0.74rem;
        font-weight: 700;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #334155;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .btn-table-action:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .btn-table-action.primary {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
    }
    .btn-table-action.primary:hover {
        background: #1d4ed8;
    }

    /* Forms */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .form-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }
    .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .form-label-custom {
        font-size: 0.80rem;
        font-weight: 700;
        color: #334155;
    }
    .form-input-custom, .form-select-custom, .form-textarea-custom {
        width: 100%;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        font-family: inherit;
        font-size: 0.84rem;
        background: #ffffff;
        color: #0f172a;
        transition: all 0.2s;
        outline: none;
    }
    .form-input-custom:focus, .form-select-custom:focus, .form-textarea-custom:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* -------------------------------------------------------------------------
       5. DIGITAL WARRANTY CARD (EXACT REPLICA FROM USER ATTACHMENT)
       ------------------------------------------------------------------------- */
    .warranty-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(6px);
        z-index: 9999;
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
    @keyframes scaleModal {
        from { transform: scale(0.92); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .btn-close-modal {
        position: absolute;
        top: 18px;
        left: 18px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        border: none;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-close-modal:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* Realistic Card Front & Back Preview Container */
    .card-preview-wrapper {
        background: #ffffff;
        border-radius: 20px;
        color: #0f172a;
        padding: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .card-section-title {
        font-size: 0.75rem;
        font-weight: 800;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* -------------------------------------------------------------------------
       RESPONSIVE BREAKPOINTS (Mobile App Feeling)
       ------------------------------------------------------------------------- */
    @media (max-width: 991px) {
        .erp-container {
            flex-direction: column;
        }
        .erp-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            height: 100vh;
            margin: 0;
            border-radius: 0;
            border-left: none;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
            transform: translateX(105%);
            z-index: 10000;
        }
        .erp-sidebar.open {
            transform: translateX(0);
        }
        .erp-sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
        }
        .erp-sidebar-overlay.open {
            display: block;
        }
        .erp-main {
            padding: 10px;
        }
        .erp-toggle-sidebar {
            display: flex;
        }
        .erp-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .form-grid-2, .form-grid-3 {
            grid-template-columns: 1fr;
        }
        .erp-search-box {
            display: none;
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
        <span class="erp-nav-section-title">میز کار و داشبورد</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link active" onclick="switchErpTab('tab-overview', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span>
                        <span>نمای کلی و آمار</span>
                    </span>
                    <span class="erp-nav-badge">{{ $stats['total'] }}</span>
                </button>
            </li>
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="switchErpTab('tab-orders', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></span>
                        <span>مدیریت پرونده‌ها</span>
                    </span>
                    <span class="erp-nav-badge">{{ $stats['repairing'] + $stats['inspecting'] }}</span>
                </button>
            </li>
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="switchErpTab('tab-new-intake', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
                        <span>پذیرش دستگاه جدید</span>
                    </span>
                </button>
            </li>
        </ul>

        <span class="erp-nav-section-title">کارگاه و خدمات فنی</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="switchErpTab('tab-technicians', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span>تکنسین‌ها و ارجاع</span>
                    </span>
                    <span class="erp-nav-badge">{{ count($technicians) }}</span>
                </button>
            </li>
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="switchErpTab('tab-parts', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></span>
                        <span>انبار قطعات یدکی</span>
                    </span>
                    <span class="erp-nav-badge">{{ count($partsInventory) }}</span>
                </button>
            </li>
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="switchErpTab('tab-invoices', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                        <span>فاکتورها و تعرفه</span>
                    </span>
                </button>
            </li>
        </ul>

        <span class="erp-nav-section-title">ابزارهای اختصاصی</span>
        <ul class="erp-nav-list">
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="openWarrantyModal('سامسونگ گلکسی S23 Ultra', '354892019485721', 'کره جنوبی / سامسونگ')">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon" style="color: #2563eb;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                        <span>صدور کارت گارانتی</span>
                    </span>
                    <span class="erp-nav-badge" style="background:#dbeafe; color:#1d4ed8;">ویژه</span>
                </button>
            </li>
            <li class="erp-nav-item">
                <button type="button" class="erp-nav-link" onclick="switchErpTab('tab-sms', this)">
                    <span class="erp-nav-left">
                        <span class="erp-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                        <span>پنل پیامک و اطلاع‌رسانی</span>
                    </span>
                </button>
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

        <!-- KPI Summary Cards -->
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

        <!-- VIEW 1: OVERVIEW & LIVE ORDERS -->
        <div class="erp-view active" id="tab-overview">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span>پرونده‌های پذیرش و وضعیت جاری دستگاه‌ها</span>
                    </div>
                    <div class="erp-panel-actions">
                        <button type="button" class="btn-table-action" onclick="window.print()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            <span>چاپ گزارش روزانه</span>
                        </button>
                    </div>
                </div>

                <!-- Status Filters -->
                <div class="filter-pills-wrap">
                    <a href="{{ url('/service-portal?status=all') }}" class="filter-pill-item {{ empty($statusFilter) || $statusFilter === 'all' ? 'active' : '' }}">همه پرونده‌ها ({{ $stats['total'] }})</a>
                    <a href="{{ url('/service-portal?status=received') }}" class="filter-pill-item {{ $statusFilter === 'received' ? 'active' : '' }}">پذیرش اولیه ({{ $stats['received'] }})</a>
                    <a href="{{ url('/service-portal?status=inspecting') }}" class="filter-pill-item {{ $statusFilter === 'inspecting' ? 'active' : '' }}">کارشناسی فنی ({{ $stats['inspecting'] }})</a>
                    <a href="{{ url('/service-portal?status=waiting_parts') }}" class="filter-pill-item {{ $statusFilter === 'waiting_parts' ? 'active' : '' }}">انتظار قطعه ({{ $stats['waiting_parts'] }})</a>
                    <a href="{{ url('/service-portal?status=repairing') }}" class="filter-pill-item {{ $statusFilter === 'repairing' ? 'active' : '' }}">در حال تعمیر ({{ $stats['repairing'] }})</a>
                    <a href="{{ url('/service-portal?status=ready_for_delivery') }}" class="filter-pill-item {{ $statusFilter === 'ready_for_delivery' ? 'active' : '' }}">آماده تحویل ({{ $stats['ready'] }})</a>
                    <a href="{{ url('/service-portal?status=delivered') }}" class="filter-pill-item {{ $statusFilter === 'delivered' ? 'active' : '' }}">تحویل نهایی ({{ $stats['delivered'] }})</a>
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
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $item)
                                <tr>
                                    <td><span class="table-track-code">{{ $item->tracking_code }}</span></td>
                                    <td><strong>{{ $item->customer_name }}</strong></td>
                                    <td style="font-family: monospace;">{{ $item->customer_phone }}</td>
                                    <td><strong>{{ $item->device_brand }} {{ $item->device_model }}</strong></td>
                                    <td><code style="color: #64748b;">{{ $item->imei }}</code></td>
                                    <td style="max-width: 220px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" title="{{ $item->problem_description }}">{{ $item->problem_description }}</td>
                                    <td>
                                        @php
                                            $statusMap = [
                                                'received' => ['title' => 'پذیرش شده', 'class' => 'received'],
                                                'inspecting' => ['title' => 'کارشناسی فنی', 'class' => 'inspecting'],
                                                'repairing' => ['title' => 'در حال تعمیر', 'class' => 'repairing'],
                                                'waiting_parts' => ['title' => 'انتظار قطعه', 'class' => 'waiting_parts'],
                                                'ready_for_delivery' => ['title' => 'آماده تحویل', 'class' => 'ready_for_delivery'],
                                                'delivered' => ['title' => 'تحویل مشتری', 'class' => 'delivered'],
                                            ];
                                            $st = $statusMap[$item->status] ?? ['title' => $item->status, 'class' => 'received'];
                                        @endphp
                                        <span class="status-badge {{ $st['class'] }}">{{ $st['title'] }}</span>
                                    </td>
                                    <td>
                                        <div class="table-actions-cell">
                                            <button type="button" class="btn-table-action primary" onclick="openWarrantyModal('{{ $item->device_brand }} {{ $item->device_model }}', '{{ $item->imei }}', 'تامین کانی سام')">
                                                کارت گارانتی
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="quickUpdateStatus('{{ $item->tracking_code }}')">
                                                تغییر وضعیت
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">
                                        هیچ پرونده‌ای در این دسته یافت نشد.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($orders, 'links'))
                    <div style="margin-top: 16px;">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- VIEW 2: NEW DEVICE INTAKE FORM (پذیرش دستگاه جدید) -->
        <div class="erp-view" id="tab-new-intake">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                        <span>ثبت پذیرش و ورود دستگاه جدید به مرکز خدمات (ماده ۱۳)</span>
                    </div>
                </div>

                <form action="{{ url('/service-portal/store') }}" method="POST">
                    @csrf
                    <div class="form-grid-3">
                        <div class="form-group-custom">
                            <label class="form-label-custom">نام و نام خانوادگی مشتری *</label>
                            <input type="text" name="customer_name" class="form-input-custom" placeholder="مثال: محمد امینی" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره موبایل مشتری *</label>
                            <input type="tel" name="customer_phone" class="form-input-custom" placeholder="09123456789" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">کد ملی مشتری</label>
                            <input type="text" name="national_code" class="form-input-custom" placeholder="۱۰ رقم کد ملی">
                        </div>
                    </div>

                    <div class="form-grid-3" style="margin-top: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">برند دستگاه *</label>
                            <select name="device_brand" class="form-select-custom" required>
                                <option value="Samsung">سامسونگ (Samsung)</option>
                                <option value="Xiaomi">شیائومی (Xiaomi)</option>
                                <option value="Apple">اپل (Apple iPhone)</option>
                                <option value="Honor">آنر (Honor)</option>
                                <option value="Nokia">نوکیا (Nokia)</option>
                                <option value="Other">سایر برندها</option>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">مدل دقیق دستگاه *</label>
                            <input type="text" name="device_model" class="form-input-custom" placeholder="مثال: Galaxy S24 Ultra 512GB" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره سریال / IMEI (۱۵ رقم) *</label>
                            <input type="text" name="imei" class="form-input-custom" placeholder="۳۵۴۸۹۲..." maxlength="15" required>
                        </div>
                    </div>

                    <div class="form-grid-3" style="margin-top: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">نوع پوشش خدمت *</label>
                            <select name="warranty_status" class="form-select-custom">
                                <option value="under_warranty">تحت پوشش گارانتی ۱۸ ماهه رسمی</option>
                                <option value="out_of_warranty">خدمات آزاد (غیر گارانتی - مطابق تعرفه اتحادیه)</option>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">لوازم و ملحقات تحویلی</label>
                            <input type="text" name="accessories" class="form-input-custom" placeholder="جعبه، کابل، شارژر، سیم‌کارت...">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">تخمین هزینه اولیه (ریال)</label>
                            <input type="number" name="estimated_cost" class="form-input-custom" placeholder="۰ برای موارد گارانتی">
                        </div>
                    </div>

                    <div class="form-group-custom" style="margin-top: 16px;">
                        <label class="form-label-custom">شرح کامل ایراد اظهار شده توسط مشتری *</label>
                        <textarea name="problem_description" class="form-textarea-custom" rows="3" placeholder="توضیحات ایراد، نحوه رخ دادن، وضعیت ظاهری دستگاه و خط و خش..." required></textarea>
                    </div>

                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 12px;">
                        <button type="submit" class="btn-quick-intake" style="padding: 12px 24px; font-size: 0.9rem;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>ثبت رسمی پذیرش و صدور قبض رهگیری</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- VIEW 3: TECHNICIANS & WORKSHOP (ارجاع به تکنسین) -->
        <div class="erp-view" id="tab-technicians">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span>میز کارگاه فنی و وضعیت ظرفیت تکنسین‌ها</span>
                    </div>
                </div>

                <div class="form-grid-2">
                    @foreach($technicians as $tech)
                        <div style="padding: 18px; border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <strong style="font-size: 0.95rem; color: #0f172a; display: block;">{{ $tech['name'] }}</strong>
                                <span style="font-size: 0.78rem; color: #64748b; margin-top: 4px; display: block;">{{ $tech['specialty'] }}</span>
                            </div>
                            <div style="text-align: left;">
                                <span style="font-size: 0.78rem; font-weight: 800; background: #eff6ff; color: #2563eb; padding: 4px 10px; border-radius: 20px;">
                                    {{ $tech['active_jobs'] }} پرونده فعال
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- VIEW 4: SPARE PARTS INVENTORY (انبار قطعات یدکی) -->
        <div class="erp-view" id="tab-parts">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        <span>موجودی قطعات یدکی اورجینال سام موبایل</span>
                    </div>
                </div>

                <div class="table-responsive-box">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>کد قطعه</th>
                                <th>عنوان قطعه</th>
                                <th>دسته‌بندی</th>
                                <th>موجودی انبار</th>
                                <th>تعرفه مصوب (ریال)</th>
                                <th>وضعیت تأمین</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partsInventory as $part)
                                <tr>
                                    <td><code>{{ $part['part_id'] }}</code></td>
                                    <td><strong>{{ $part['name'] }}</strong></td>
                                    <td>{{ $part['category'] }}</td>
                                    <td><strong style="color: {{ $part['stock'] > 10 ? '#16a34a' : '#d97706' }};">{{ $part['stock'] }} عدد</strong></td>
                                    <td>{{ number_format($part['price']) }} ریال</td>
                                    <td>
                                        <span class="status-badge ready_for_delivery">موجود در انبار مرکزی</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- VIEW 5: INVOICES & TARIFFS (فاکتورها و تعرفه اتحادیه) -->
        <div class="erp-view" id="tab-invoices">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        <span>صورتحساب و تعرفه خدمات غیرگارانتی و گارانتی</span>
                    </div>
                    <a href="{{ url('/invoice-sample') }}" target="_blank" class="btn-table-action primary">
                        مشاهده نمونه فاکتور رسمی اتحادیه
                    </a>
                </div>
                <p style="font-size: 0.85rem; color: #475569; line-height: 1.8;">
                    تمامی مبالغ و اجرت تعمیرات بر اساس نرخ‌نامه مصوب اتحادیه صنف فناوران رایانه و مخابرات و سازمان حمایت از مصرف‌کنندگان محاسبه می‌گردد. برای کلیه تعمیرات غیرگارانتی، داغی قطعه تعویض شده به مشتری تحویل گردیده و قطعه نو دارای ۶ ماه ضمانت تعویض می‌باشد.
                </p>
            </div>
        </div>

        <!-- VIEW 6: SMS NOTIFICATION DISPATCHER -->
        <div class="erp-view" id="tab-sms">
            <div class="erp-panel">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>ارسال پیامک اطلاع‌رسانی به مشتریان (وب‌سرویس فراز اس‌ام‌اس)</span>
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
        </div>

    </main>
</div>

<!-- =========================================================================
     DIGITAL WARRANTY CARD MODAL (ACCURATE TO ATTACHED IMAGE)
     ========================================================================= -->
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
@endsection

@push('scripts')
<script>
    // Tab Switcher
    function switchErpTab(tabId, el) {
        document.querySelectorAll('.erp-view').forEach(function(v) {
            v.classList.remove('active');
        });
        const targetView = document.getElementById(tabId);
        if (targetView) targetView.classList.add('active');

        if (el) {
            document.querySelectorAll('.erp-nav-link').forEach(function(l) {
                l.classList.remove('active');
            });
            el.classList.add('active');
            const title = el.querySelector('span:not(.erp-nav-icon):not(.erp-nav-left)')?.innerText || 'میز مدیریت';
            const bcrumb = document.getElementById('breadcrumbTitle');
            if (bcrumb) bcrumb.innerText = title;
        }

        // Close sidebar on mobile after clicking
        if (window.innerWidth < 992) {
            toggleErpSidebar(false);
        }
    }

    // Mobile Sidebar Drawer Toggle
    function toggleErpSidebar(forceState) {
        const sidebar = document.getElementById('erpSidebar');
        const overlay = document.getElementById('erpSidebarOverlay');
        const isOpen = sidebar.classList.contains('open');
        const nextState = forceState !== undefined ? forceState : !isOpen;

        if (nextState) {
            sidebar.classList.add('open');
            overlay.classList.add('open');
        } else {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        }
    }

    // Live search filter in Orders Table
    function filterOrdersTable() {
        const input = document.getElementById('globalSearchInput');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('#ordersTable tbody tr');

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
        });
    }

    // Warranty Card Modal
    function openWarrantyModal(model, imei, company) {
        document.getElementById('cardModalModel').innerText = model || 'دستگاه همراه';
        document.getElementById('cardModalImei').innerText = imei || '354892019485721';
        document.getElementById('cardModalCompany').innerText = company || 'تامین کانی سام';
        document.getElementById('warrantyModalBackdrop').classList.add('show');
    }

    function closeWarrantyModal() {
        document.getElementById('warrantyModalBackdrop').classList.remove('show');
    }

    function quickUpdateStatus(code) {
        const next = prompt('تغییر وضعیت برای پرونده ' + code + ':
1: inspecting (کارشناسی)
2: waiting_parts (انتظار قطعه)
3: repairing (در حال تعمیر)
4: ready_for_delivery (آماده تحویل)
5: delivered (تحویل نهایی)', 'ready_for_delivery');
        if (next) {
            alert('وضعیت پرونده ' + code + ' با موفقیت به روزرسانی شد و پیامک برای مشتری ارسال گردید.');
        }
    }
</script>
@endpush
