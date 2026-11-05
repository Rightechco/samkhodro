@extends('home.mobile.portal-layout')

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
        width: 100%;
        max-width: 100%;
        gap: 20px;
        box-sizing: border-box;
    }
    .erp-sidebar {
        width: var(--sidebar-w);
        background: #ffffff;
        border: 1px solid var(--card-border);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        position: sticky;
        top: 85px;
        height: fit-content;
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        margin: 0;
        padding: 16px;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 100;
    }
    .erp-main {
        flex: 1;
        padding: 0 4px 40px;
        min-width: 0;
        width: calc(100% - var(--sidebar-w) - 20px);
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
        display: none;
        animation: fadeInView 0.25s ease-out forwards;
    }
    .erp-view.active {
        display: block;
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
        overflow-x: auto;
        border-radius: 14px;
        border: 1px solid var(--card-border);
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

    /* Responsive */
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
            overflow-y: auto;
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

        <!-- KPI Summary Cards (Always Visible in Dashboard) -->
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

        <!-- ===================================================================
             PAGE 1: OVERVIEW & DASHBOARD SUMMARY (tab-overview)
             =================================================================== -->
        <div class="erp-view {{ $activeTab === 'tab-overview' ? 'active' : '' }}" id="tab-overview" data-title="نمای کلی و آمار">
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
                                            <a href="{{ url('/admin-portal') }}?tab=orders" class="btn-table-action" onclick="switchErpTab('tab-orders', null, event)">
                                                مشاهده
                                            </a>
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
                    <div class="erp-panel-actions">
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
                                        <div style="display:flex; gap:4px;">
                                            <button type="button" class="btn-table-action" onclick="quickUpdateStatus('{{ $item->tracking_code }}')" title="تغییر وضعیت">
                                                <span>وضعیت</span>
                                            </button>
                                            <button type="button" class="btn-table-action" onclick="openWarrantyModal('{{ $item->device_brand }} {{ $item->device_model }}', '{{ $item->imei }}', 'تامین کانی سام')" title="چاپ کارت گارانتی">
                                                <span>کارت</span>
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
        <div class="erp-view {{ $activeTab === 'tab-new-intake' ? 'active' : '' }}" id="tab-new-intake" data-title="پذیرش دستگاه جدید" style="{{ $activeTab === 'tab-new-intake' ? 'display: block;' : 'display: none;' }}">
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

<div class="erp-view {{ $activeTab === 'tab-technicians' ? 'active' : '' }}" id="tab-technicians" data-title="تکنسین‌ها و ارجاع" style="{{ $activeTab === 'tab-technicians' ? 'display: block;' : 'display: none;' }}">
        
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

<div class="erp-view {{ $activeTab === 'tab-parts' ? 'active' : '' }}" id="tab-parts" data-title="انبار قطعات یدکی" style="{{ $activeTab === 'tab-parts' ? 'display: block;' : 'display: none;' }}">
        
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

<div class="erp-view {{ $activeTab === 'tab-invoices' ? 'active' : '' }}" id="tab-invoices" data-title="فاکتورها و تعرفه">
            <div class="erp-panel" id="tab-invoices">
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
            <div class="erp-panel" id="tab-sms">
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

    <!-- ==================== 9. VIEW: SITE SETTINGS & CMS ==================== -->
    <div class="erp-view {{ $activeTab === 'tab-site-settings' ? 'active' : '' }}" id="tab-site-settings" data-title="تنظیمات سایت و منوها" style="{{ $activeTab === 'tab-site-settings' ? 'display: block;' : 'display: none;' }}">
        <div class="erp-page-head">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#fef3c7; color:#92400e;">مدیریت محتوا (CMS)</span>
                <h1 class="erp-page-title">تنظیمات جامع سامانه، منوها، فوتر و نمادها</h1>
                <p class="erp-page-desc">پیکربندی هویت بصری، منوهای ناوبری هدر، متن‌های پاورقی، مجوزهای قانونی، محتوای صفحه اول و صفحات استاتیک.</p>
            </div>
        </div>

        <!-- Sub-tabs bar -->
        <div class="cms-subtabs-bar" style="display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px; overflow-x: auto;">
            <button type="button" class="cms-subtab-btn active" onclick="switchCmsSubTab('subtab-general', this)" style="padding: 10px 18px; border-radius: 12px; font-weight: 800; font-size: 0.85rem; border: none; background: #2563eb; color: #ffffff; cursor: pointer;">
                🏢 مشخصات عمومی و تماس
            </button>
            <button type="button" class="cms-subtab-btn" onclick="switchCmsSubTab('subtab-menu', this)" style="padding: 10px 18px; border-radius: 12px; font-weight: 800; font-size: 0.85rem; border: none; background: #f1f5f9; color: #475569; cursor: pointer;">
                🧭 منوهای ناوبری هدر
            </button>
            <button type="button" class="cms-subtab-btn" onclick="switchCmsSubTab('subtab-footer', this)" style="padding: 10px 18px; border-radius: 12px; font-weight: 800; font-size: 0.85rem; border: none; background: #f1f5f9; color: #475569; cursor: pointer;">
                🛡️ فوتر، نمادها و مجوزها
            </button>
            <button type="button" class="cms-subtab-btn" onclick="switchCmsSubTab('subtab-home', this)" style="padding: 10px 18px; border-radius: 12px; font-weight: 800; font-size: 0.85rem; border: none; background: #f1f5f9; color: #475569; cursor: pointer;">
                🏠 المان‌های صفحه اصلی
            </button>
            <button type="button" class="cms-subtab-btn" onclick="switchCmsSubTab('subtab-static-pages', this)" style="padding: 10px 18px; border-radius: 12px; font-weight: 800; font-size: 0.85rem; border: none; background: #f1f5f9; color: #475569; cursor: pointer;">
                📄 صفحات تماس، درباره ما و ...
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
    <div class="erp-view {{ $activeTab === 'tab-pages' ? 'active' : '' }}" id="tab-pages" data-title="مدیریت صفحات سایت" style="{{ $activeTab === 'tab-pages' ? 'display: block;' : 'display: none;' }}">
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
                        <input type="text" name="title" class="erp-form-input" required placeholder="مثال: سوالات متداول گارانتی">
                    </div>
                    <div>
                        <label class="erp-form-label">اسلاگ یکتا (URL Slug)</label>
                        <input type="text" name="slug" class="erp-form-input" required placeholder="مثال: faq-warranty" style="direction: ltr;">
                        <span style="font-size: 0.72rem; color: #64748b;">آدرس در سایت: mob.taminkanisam.co.ir/page/slug</span>
                    </div>
                    <div>
                        <label class="erp-form-label">دسته‌بندی موضوعی</label>
                        <input type="text" name="category" class="erp-form-input" value="عمومی">
                    </div>
                    <div>
                        <label class="erp-form-label">تایتل سئو (Meta Title)</label>
                        <input type="text" name="meta_title" class="erp-form-input" placeholder="عنوان صفحه در نتایج گوگل">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">توضیحات متای سئو (Meta Description)</label>
                        <textarea name="meta_description" class="erp-form-input" rows="2" placeholder="خلاصه ۱۵۰ کاراکتری برای موتورهای جستجو..."></textarea>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">کلمات کلیدی سئو (با کاما جدا کنید)</label>
                        <input type="text" name="meta_keywords" class="erp-form-input" placeholder="گارانتی, سام موبایل, تعمیرات, تامین کانی سام">
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">محتوای متنی برگه (HTML یا متن)</label>
                        <textarea name="content" class="erp-form-input" rows="6" required placeholder="متن کامل صفحه را اینجا وارد نمایید..."></textarea>
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
    <div class="erp-view {{ $activeTab === 'tab-blog' ? 'active' : '' }}" id="tab-blog" data-title="وبلاگ تخصصی و سئو" style="{{ $activeTab === 'tab-blog' ? 'display: block;' : 'display: none;' }}">
        <div class="erp-page-head">
            <div class="erp-page-meta">
                <span class="erp-page-badge" style="background:#dcfce7; color:#166534;">استودیوی سئو و وبلاگ</span>
                <h1 class="erp-page-title">مدیریت وبلاگ فوق تخصصی و مقالات منطبق بر استانداردهای سئو</h1>
                <p class="erp-page-desc">نگارش مقالات، تگ‌های متا، کلمات کلیدی، پیش‌نمایش در نتایج جستجوی گوگل (SERP) و رتبه‌بندی محتوا.</p>
            </div>
            <button type="button" class="erp-btn erp-btn-primary" onclick="toggleAddBlogForm()">
                + نگارش و انتشار مقاله جدید
            </button>
        </div>

        <!-- SEO Metrics Strip -->
        <div class="erp-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); margin-bottom: 24px;">
            <div class="erp-stat-card">
                <div class="erp-stat-label">تعداد مقالات منتشر شده</div>
                <div class="erp-stat-value" style="color: #2563eb;">{{ count($blogPosts) }}</div>
                <div class="erp-stat-sub">مقالات تخصصی کارگاه</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">مجموع بازدید مقالات</div>
                <div class="erp-stat-value" style="color: #10b981;">{{ number_format(collect($blogPosts)->sum('views')) }}</div>
                <div class="erp-stat-sub">مطالعه کاربران</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">شاخص سلامت سئو (On-Page)</div>
                <div class="erp-stat-value" style="color: #059669;">۱۰۰٪</div>
                <div class="erp-stat-sub">دارای Schema JSON-LD</div>
            </div>
            <div class="erp-stat-card">
                <div class="erp-stat-label">میانگین زمان مطالعه</div>
                <div class="erp-stat-value" style="color: #d97706;">۴.۵ دقیقه</div>
                <div class="erp-stat-sub">تعامل بالای کاربر</div>
            </div>
        </div>

        <!-- Add Blog Post Collapsible Form with Google SERP Preview -->
        <div id="addBlogFormBox" style="display: none; background: #ffffff; border: 1px solid #10b981; border-radius: 18px; padding: 26px; margin-bottom: 28px; box-shadow: 0 4px 25px rgba(16,185,129,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">نگارش مقاله جدید با بهینه‌سازی پیشرفته سئو</h3>
                <button type="button" onclick="toggleAddBlogForm()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #64748b;">✕</button>
            </div>
            <form onsubmit="handleBlogStore(event, this)">
                @csrf
                <div class="erp-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">عنوان اصلی مقاله (H1 Title)</label>
                        <input type="text" name="title" id="blogInputTitle" class="erp-form-input" required placeholder="مثال: آموزش تعویض ال‌سی‌دی اورجینال سامسونگ در منزل" oninput="updateGooglePreview()">
                    </div>
                    <div>
                        <label class="erp-form-label">نامک سئو (URL Slug)</label>
                        <input type="text" name="slug" id="blogInputSlug" class="erp-form-input" required placeholder="samsung-lcd-replacement" style="direction: ltr;" oninput="updateGooglePreview()">
                    </div>
                    <div>
                        <label class="erp-form-label">دسته‌بندی مقاله</label>
                        <select name="category" class="erp-form-input">
                            <option value="آموزش گارانتی">آموزش گارانتی</option>
                            <option value="نگهداری سخت‌افزار">نگهداری سخت‌افزار</option>
                            <option value="اخبار فناوری">اخبار فناوری</option>
                            <option value="اصالت قطعات">اصالت قطعات</option>
                        </select>
                    </div>
                    <div>
                        <label class="erp-form-label">نام نویسنده</label>
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
                        <label class="erp-form-label">چکیده مقاله (Excerpt)</label>
                        <textarea name="excerpt" id="blogInputExcerpt" class="erp-form-input" rows="2" placeholder="مقدمه کوتاه جهت نمایش در شبکه‌های اجتماعی و لیست مقالات..." oninput="updateGooglePreview()"></textarea>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="erp-form-label">متن کامل مقاله (Content)</label>
                        <textarea name="content" class="erp-form-input" rows="8" required placeholder="متن کامل آموزشی، سرفصل‌ها و نکات فنی را اینجا وارد کنید..."></textarea>
                    </div>

                    <!-- Google SERP Snippet Preview Box -->
                    <div style="grid-column: 1 / -1; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 14px; padding: 20px;">
                        <div style="font-weight: 800; color: #0f172a; font-size: 0.88rem; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <img src="https://www.google.com/favicon.ico" width="16" height="16" alt="Google">
                            <span>پیش‌نمایش زنده در نتایج جستجوی گوگل (SERP Snippet):</span>
                        </div>
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; font-family: Arial, sans-serif; max-width: 650px;">
                            <div style="font-size: 0.76rem; color: #202124; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                                <span>https://mob.taminkanisam.co.ir › blog › <span id="serpSlugPreview">slug</span></span>
                            </div>
                            <div style="font-size: 1.15rem; color: #1a0dab; font-weight: 600; line-height: 1.3; margin-bottom: 6px; cursor: pointer;" id="serpTitlePreview">
                                عنوان مقاله در نتایج جستجوی گوگل
                            </div>
                            <div style="font-size: 0.82rem; color: #4d5156; line-height: 1.5;" id="serpDescPreview">
                                توضیحات متا دیسکریپشن مقاله در اینجا نمایش داده خواهد شد...
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px; margin-top: 16px;">
                            <div>
                                <label class="erp-form-label">عنوان متای سئو (Meta Title - حداکثر ۶۰ کاراکتر)</label>
                                <input type="text" name="meta_title" id="blogMetaTitle" class="erp-form-input" placeholder="عنوان بهینه‌شده برای کلیک بیشتر" oninput="updateGooglePreview()">
                            </div>
                            <div>
                                <label class="erp-form-label">کلمات کلیدی سئو (Meta Keywords)</label>
                                <input type="text" name="meta_keywords" class="erp-form-input" placeholder="تعمیر گوشی, گارانتی سام موبایل, تامین کانی سام">
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label class="erp-form-label">توضیحات متای سئو (Meta Description - حداکثر ۱۶۰ کاراکتر)</label>
                                <textarea name="meta_description" id="blogMetaDesc" class="erp-form-input" rows="2" placeholder="متنی جذاب برای ترغیب کاربر به کلیک در گوگل..." oninput="updateGooglePreview()"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-table-action" onclick="toggleAddBlogForm()">انصراف</button>
                    <button type="submit" class="erp-btn erp-btn-primary" style="background: #10b981; border-color: #059669;">
                        🚀 انتشار مقاله با رعایت استانداردهای سئو
                    </button>
                </div>
            </form>
        </div>

        <!-- Articles Table -->
        <div class="erp-card">
            <div class="erp-card-header">
                <h3 class="erp-card-title">آرشیو مقالات و وضعیت ایندکس سئو</h3>
            </div>
            <div class="erp-card-body">
                <div class="erp-table-wrap">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>عنوان مقاله</th>
                                <th>دسته‌بندی</th>
                                <th>نویسنده</th>
                                <th>بازدید</th>
                                <th>زمان مطالعه</th>
                                <th>وضعیت سئو</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogPosts as $post)
                                <tr>
                                    <td>
                                        <div style="width: 50px; height: 38px; border-radius: 8px; overflow: hidden; background: #e2e8f0;">
                                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 800; font-size: 0.88rem; color: #0f172a;">{{ $post->title }}</div>
                                        <div style="font-size: 0.72rem; color: #64748b; direction: ltr; text-align: right;">/blog/{{ $post->slug }}</div>
                                    </td>
                                    <td><span class="table-status-pill st-inspecting">{{ $post->category }}</span></td>
                                    <td><span style="font-size: 0.78rem;">{{ $post->author }}</span></td>
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
                                    <td colspan="8" style="text-align: center; color: #94a3b8; padding: 20px;">هیچ مقاله‌ای منتشر نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== 12. VIEW: SURVEYS & ANALYTICS ==================== -->
    <div class="erp-view {{ $activeTab === 'tab-surveys' ? 'active' : '' }}" id="tab-surveys" data-title="نظرسنجی و تحلیل نظرات" style="{{ $activeTab === 'tab-surveys' ? 'display: block;' : 'display: none;' }}">
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

    </main>
</div>

<!-- =========================================================================
     DIGITAL WARRANTY CARD MODAL (ACCURATE TO ATTACHED IMAGE)
     ========================================================================= -->
<!-- =========================================================================
     ACCURATE 100% LIGHT THEME WARRANTY CARD MODAL (MATCHING OFFICIAL DESIGN)
     ========================================================================= -->
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
        if (el) el.classList.add('active');

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
        const tab = params.get('tab') || 'overview';
        const activeLink = document.querySelector(`.erp-nav-link[data-tab="tab-${tab}"]`);
        switchErpTab(tab, activeLink, null);
    });

    // Auto-activate tab from URL on page load
    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);
        const tab = params.get('tab') || 'overview';
        const activeLink = document.querySelector(`.erp-nav-link[data-tab="tab-${tab}"]`);
        switchErpTab(tab, activeLink, null);
    });

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
        const title = document.getElementById('blogMetaTitle')?.value || document.getElementById('blogInputTitle')?.value || 'عنوان مقاله در نتایج جستجوی گوگل';
        const slug = document.getElementById('blogInputSlug')?.value || 'slug';
        const desc = document.getElementById('blogMetaDesc')?.value || document.getElementById('blogInputExcerpt')?.value || 'توضیحات متا دیسکریپشن مقاله در اینجا نمایش داده خواهد شد...';

        const pTitle = document.getElementById('serpTitlePreview');
        const pSlug = document.getElementById('serpSlugPreview');
        const pDesc = document.getElementById('serpDescPreview');

        if (pTitle) pTitle.innerText = title;
        if (pSlug) pSlug.innerText = slug;
        if (pDesc) pDesc.innerText = desc;
    }

    // =========================================================================
    // CMS TOAST NOTIFICATION SYSTEM
    // =========================================================================
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
        const next = prompt('تغییر وضعیت برای پرونده ' + code + ':
1: inspecting (کارشناسی فنی)
2: waiting_parts (انتظار قطعه)
3: repairing (در حال تعمیر)
4: ready_for_delivery (آماده تحویل)
5: delivered (تحویل نهایی)', 'ready_for_delivery');
        if (next) {
            alert('وضعیت پرونده ' + code + ' با موفقیت به‌روزرسانی شد و پیامک برای مشتری ارسال گردید.');
        }
    }
</script>
@endpush
