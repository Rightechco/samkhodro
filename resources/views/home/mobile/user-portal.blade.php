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

@section('title', 'پنل کاربری و پیگیری آنلاین خدمات | سام موبایل')
@section('header_title', 'میز کاربری مشتریان')

@php
    $activeTab = request()->query('tab', 'my-devices');
    if (!str_starts_with($activeTab, 'tab-')) {
        $activeTab = 'tab-' . $activeTab;
    }
    
    // محاسبه درصد تکمیل پروفایل
    $completionScore = 20; // شماره موبایل همیشه هست
    if ($user) {
        if (!empty($user->name) && $user->name !== 'کاربر سام موبایل') $completionScore += 15;
        if (!empty($user->email) && !str_contains($user->email, '@taminkanisam.co.ir')) $completionScore += 15;
        if (!empty($user->national_code)) $completionScore += 15;
        if (!empty($user->phone_landline)) $completionScore += 10;
        if (!empty($user->address)) $completionScore += 15;
        if (!empty($user->device_brand)) $completionScore += 10;
    }
    $completionScore = min(100, $completionScore);
@endphp

@push('styles')
<style>
    /* =========================================================================
       ULTRA-PREMIUM USER & CUSTOMER PORTAL THEME (DESKTOP & MOBILE FIRST-CLASS)
       ========================================================================= */
    :root {
        --user-bg: #f8fafc;
        --user-card-bg: #ffffff;
        --user-border: #e2e8f0;
        --user-border-focus: #3b82f6;
        --user-primary: #2563eb;
        --user-primary-dark: #1d4ed8;
        --user-primary-light: #eff6ff;
        --user-primary-border: #bfdbfe;
        --user-emerald: #10b981;
        --user-emerald-light: #ecfdf5;
        --user-amber: #f59e0b;
        --user-amber-light: #fffbeb;
        --user-rose: #f43f5e;
        --user-rose-light: #fff1f2;
        --user-text-main: #0f172a;
        --user-text-body: #334155;
        --user-text-muted: #64748b;
        --user-radius-lg: 20px;
        --user-radius-md: 14px;
        --user-radius-sm: 10px;
        --user-shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.04);
        --user-shadow-md: 0 8px 24px rgba(15, 23, 42, 0.05);
        --user-shadow-lg: 0 16px 40px rgba(15, 23, 42, 0.08);
    }

    body {
        background-color: var(--user-bg);
        color: var(--user-text-body);
        font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Container & Layout Architecture */
    .user-container {
        display: flex !important;
        flex-direction: row !important;
        align-items: flex-start !important;
        gap: 24px !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 auto !important;
        position: relative !important;
        box-sizing: border-box !important;
        min-height: calc(100vh - 160px);
    }

    /* 1. SIDEBAR (DESKTOP) */
    .user-sidebar {
        width: 290px !important;
        min-width: 290px !important;
        max-width: 290px !important;
        flex-shrink: 0 !important;
        position: sticky !important;
        top: 85px !important;
        background: #ffffff !important;
        border: 1px solid var(--user-border) !important;
        border-radius: var(--user-radius-lg) !important;
        padding: 20px 16px !important;
        box-shadow: var(--user-shadow-sm) !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        box-sizing: border-box !important;
        z-index: 100 !important;
    }

    /* Customer Profile Card in Sidebar */
    .customer-profile-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 12px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
        border-radius: var(--user-radius-md);
        margin-bottom: 14px;
        position: relative;
    }
    .customer-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        flex-shrink: 0;
    }
    .customer-meta {
        flex: 1;
        min-width: 0;
    }
    .customer-name {
        font-size: 0.92rem;
        font-weight: 900;
        color: var(--user-text-main);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .customer-phone {
        font-size: 0.76rem;
        color: #2563eb;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 3px;
        direction: ltr;
        text-align: right;
    }
    .customer-phone svg {
        color: #10b981;
    }

    /* Navigation List */
    .user-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .user-nav-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 12px 14px;
        border-radius: var(--user-radius-md);
        font-size: 0.86rem;
        font-weight: 700;
        color: var(--user-text-body);
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        text-align: right;
        text-decoration: none;
        box-sizing: border-box;
    }
    .user-nav-btn:hover {
        background: #f1f5f9;
        color: var(--user-text-main);
    }
    .user-nav-btn.active {
        background: #eff6ff !important;
        color: #1d4ed8 !important;
        border-color: #bfdbfe !important;
        font-weight: 900 !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08) !important;
    }
    .user-nav-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .user-nav-icon {
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: inherit;
    }
    .user-nav-badge {
        font-size: 0.70rem;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 99px;
        background: #e2e8f0;
        color: #475569;
    }
    .user-nav-btn.active .user-nav-badge {
        background: #2563eb;
        color: #ffffff;
    }

    /* 2. MAIN CONTENT AREA */
    .user-main {
        flex: 1 1 0% !important;
        min-width: 0 !important;
        width: auto !important;
        max-width: 100% !important;
        padding: 0 !important;
        box-sizing: border-box !important;
    }

    /* View Tab Content Block */
    .user-view {
        display: none;
    }
    .user-view.active {
        display: block !important;
        animation: fadeInTab 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes fadeInTab {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Standard Card / Panel */
    .user-panel {
        background: var(--user-card-bg);
        border: 1px solid var(--user-border);
        border-radius: var(--user-radius-lg);
        padding: 24px 26px;
        box-shadow: var(--user-shadow-sm);
        margin-bottom: 22px;
        transition: box-shadow 0.25s ease, border-color 0.25s ease;
        box-sizing: border-box;
    }
    .user-panel:hover {
        border-color: #cbd5e1;
        box-shadow: var(--user-shadow-md);
    }
    .user-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        padding-bottom: 18px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 18px;
    }
    .user-panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.05rem;
        font-weight: 900;
        color: var(--user-text-main);
    }

    /* Stepper / Timeline */
    .timeline-stepper {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: relative !important;
        margin: 24px 0 22px !important;
        padding: 0 10px !important;
    }
    .timeline-stepper::before {
        content: '' !important;
        position: absolute !important;
        top: 20px !important;
        left: 28px !important;
        right: 28px !important;
        height: 3px !important;
        background: #e2e8f0 !important;
        z-index: 1 !important;
    }
    .step-node {
        position: relative !important;
        z-index: 2 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        gap: 8px !important;
        flex: 1 !important;
    }
    .step-circle {
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        border: 2.5px solid #cbd5e1 !important;
        color: #64748b !important;
        font-weight: 800 !important;
        font-size: 0.95rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04) !important;
    }
    .step-label {
        font-size: 0.76rem !important;
        font-weight: 700 !important;
        color: #64748b !important;
        white-space: nowrap !important;
    }
    .step-node.completed .step-circle {
        background: #10b981 !important;
        border-color: #10b981 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
    }
    .step-node.completed .step-label {
        color: #059669 !important;
        font-weight: 800 !important;
    }
    .step-node.active .step-circle {
        background: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2), 0 4px 14px rgba(37, 99, 235, 0.35) !important;
        animation: pulseStep 2s infinite !important;
    }
    .step-node.active .step-label {
        color: #1d4ed8 !important;
        font-weight: 900 !important;
    }
    @keyframes pulseStep {
        0%, 100% { box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2), 0 4px 14px rgba(37, 99, 235, 0.35); }
        50% { box-shadow: 0 0 0 8px rgba(37, 99, 235, 0.1), 0 4px 18px rgba(37, 99, 235, 0.45); }
    }

    /* Action Buttons */
    .btn-table-action {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        padding: 9px 18px !important;
        border-radius: var(--user-radius-sm) !important;
        font-size: 0.84rem !important;
        font-weight: 800 !important;
        font-family: inherit !important;
        cursor: pointer !important;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        border: none !important;
        text-decoration: none !important;
    }
    .btn-table-action.primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25) !important;
    }
    .btn-table-action.primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35) !important;
    }
    .btn-table-action.outline {
        background: #ffffff !important;
        color: #2563eb !important;
        border: 1.5px solid #bfdbfe !important;
    }
    .btn-table-action.outline:hover {
        background: #eff6ff !important;
        border-color: #2563eb !important;
    }

    /* Form Fields Standard */
    .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 7px;
        margin-bottom: 16px;
    }
    .form-label-custom {
        font-size: 0.84rem;
        font-weight: 800;
        color: var(--user-text-main);
    }
    .form-input-custom, .form-select-custom, .form-textarea-custom {
        width: 100%;
        height: 48px;
        padding: 0 16px;
        border: 1.5px solid var(--user-border);
        border-radius: var(--user-radius-md);
        font-family: inherit;
        font-size: 0.90rem;
        color: var(--user-text-main);
        background: #ffffff;
        outline: none;
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .form-textarea-custom {
        height: auto;
        padding: 12px 16px;
        resize: vertical;
    }
    .form-input-custom:focus, .form-select-custom:focus, .form-textarea-custom:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    /* Tables */
    .table-responsive-box {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: var(--user-radius-md);
        border: 1px solid var(--user-border);
    }
    .erp-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.84rem;
        text-align: right;
    }
    .erp-table th {
        background: #f8fafc;
        padding: 12px 14px;
        font-weight: 800;
        color: #475569;
        border-bottom: 1px solid var(--user-border);
    }
    .erp-table td {
        padding: 14px;
        border-bottom: 1px solid #f1f5f9;
        color: var(--user-text-body);
    }
    .table-track-code {
        font-family: monospace;
        font-weight: 800;
        color: #2563eb;
    }
    .table-status-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 0.74rem;
        font-weight: 800;
    }
    .st-ready_for_delivery { background: #ecfdf5; color: #059669; }
    .st-inspecting { background: #eff6ff; color: #2563eb; }

    /* Profile Completion Progress Card */
    .profile-hero-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: var(--user-radius-lg);
        padding: 24px 28px;
        color: #ffffff;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        box-shadow: var(--user-shadow-md);
    }
    .profile-hero-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .profile-avatar-big {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        font-weight: 900;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
    }
    .profile-progress-wrap {
        min-width: 260px;
        max-width: 320px;
        flex: 1;
    }
    .progress-bar-bg {
        width: 100%;
        height: 8px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 99px;
        overflow: hidden;
        margin-top: 8px;
    }
    .progress-bar-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, #10b981, #38bdf8);
        transition: width 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Onboarding Modal */
    .onboarding-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(8px);
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .onboarding-modal-card {
        background: #ffffff;
        border-radius: 24px;
        max-width: 580px;
        width: 100%;
        padding: 30px 28px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        border: 1px solid #e2e8f0;
        animation: scaleModal 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-sizing: border-box;
    }
    @keyframes scaleModal {
        from { transform: scale(0.92); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .onboarding-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    .onboarding-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .onboarding-title {
        font-size: 1.15rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
    }
    .onboarding-subtitle {
        font-size: 0.82rem;
        color: #64748b;
        margin-top: 4px;
        line-height: 1.6;
    }
    .onboarding-notice {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.78rem;
        color: #475569;
        line-height: 1.7;
        margin-top: 14px;
    }

    /* Mobile Sticky Bottom Nav */
    .user-mobile-nav {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100vw;
        max-width: 100vw;
        height: calc(64px + env(safe-area-inset-bottom, 0px));
        padding: 0 8px env(safe-area-inset-bottom, 0px) 8px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-top: 1px solid #e2e8f0;
        box-shadow: 0 -4px 20px rgba(15, 23, 42, 0.08);
        z-index: 99990;
        align-items: center;
        justify-content: space-around;
        box-sizing: border-box;
    }
    .user-bottom-nav-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        color: #64748b;
        font-size: 0.70rem;
        font-weight: 700;
        height: 56px;
        border: none;
        background: transparent;
        cursor: pointer;
        position: relative;
        text-decoration: none;
    }
    .user-bottom-nav-item.active {
        color: #2563eb !important;
        font-weight: 900 !important;
    }
    .user-bottom-nav-item.active::before {
        content: '';
        position: absolute;
        top: 2px;
        width: 18px;
        height: 3px;
        border-radius: 99px;
        background: #2563eb;
    }
    .user-sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 99998;
        display: none;
    }

    /* =========================================================================
       RESPONSIVE BREAKPOINTS (MOBILE & TABLET ADAPTATION)
       ========================================================================= */
    @media (max-width: 991px) {
        .user-container {
            flex-direction: column !important;
            padding-bottom: 95px !important;
            gap: 16px !important;
        }
        .user-sidebar {
            display: none !important;
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 300px !important;
            max-width: 85vw !important;
            height: 100vh !important;
            border-radius: 0 !important;
            border: none !important;
            border-left: 1px solid #e2e8f0 !important;
            z-index: 100000 !important;
            overflow-y: auto !important;
            background: #ffffff !important;
            transform: translateX(110%) !important;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .user-sidebar.open {
            display: flex !important;
            transform: translateX(0) !important;
            box-shadow: -15px 0 40px rgba(15, 23, 42, 0.3) !important;
        }
        .user-sidebar-overlay.open {
            display: block !important;
        }
        .user-mobile-nav {
            display: flex !important;
        }
        .user-panel {
            padding: 18px 16px !important;
            border-radius: 16px !important;
        }
        .timeline-stepper {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 14px !important;
            padding-right: 14px !important;
        }
        .timeline-stepper::before {
            top: 20px !important;
            bottom: 20px !important;
            right: 28px !important;
            left: auto !important;
            width: 3px !important;
            height: auto !important;
        }
        .step-node {
            flex-direction: row !important;
            gap: 12px !important;
            text-align: right !important;
        }
        .step-label {
            font-size: 0.82rem !important;
        }
    }
</style>
@endpush

@section('content')
<div class="user-container">

    <!-- Mobile Drawer Overlay -->
    <div class="user-sidebar-overlay" id="userSidebarOverlay" onclick="toggleUserSidebar(false)"></div>

    <!-- 1. CUSTOMER SIDEBAR -->
    <aside class="user-sidebar" id="userSidebar">
        <!-- Customer Profile Card -->
        <div class="customer-profile-card">
            <div class="customer-avatar">
                {{ mb_substr($user ? $user->name : 'ص', 0, 1) }}
            </div>
            <div class="customer-meta">
                <div class="customer-name">{{ $user ? $user->name : 'مشتری گرامی سام موبایل' }}</div>
                <div class="customer-phone">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>{{ $userPhone }}</span>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <ul class="user-nav-list">
            <li>
                <a href="{{ url('/user-portal') }}?tab=my-devices" class="user-nav-btn {{ $activeTab === 'tab-my-devices' ? 'active' : '' }}" data-tab="tab-my-devices" onclick="switchUserTab('tab-my-devices', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></span>
                        <span class="user-nav-title">دستگاه‌ها و پیگیری آنلاین</span>
                    </span>
                    <span class="user-nav-badge">{{ $stats['total'] }}</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/user-portal') }}?tab=new-request" class="user-nav-btn {{ $activeTab === 'tab-new-request' ? 'active' : '' }}" data-tab="tab-new-request" onclick="switchUserTab('tab-new-request', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
                        <span class="user-nav-title">ثبت پذیرش دستگاه جدید</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ url('/user-portal') }}?tab=warranty-card" class="user-nav-btn {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" data-tab="tab-warranty-card" onclick="switchUserTab('tab-warranty-card', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                        <span class="user-nav-title">کارت گارانتی دیجیتال</span>
                    </span>
                    <span class="user-nav-badge" style="background:#eff6ff; color:#2563eb;">۱۸ ماهه</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/user-portal') }}?tab=my-invoices" class="user-nav-btn {{ $activeTab === 'tab-my-invoices' ? 'active' : '' }}" data-tab="tab-my-invoices" onclick="switchUserTab('tab-my-invoices', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                        <span class="user-nav-title">صورت‌حساب و فاکتورها</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ url('/user-portal') }}?tab=my-tickets" class="user-nav-btn {{ $activeTab === 'tab-my-tickets' ? 'active' : '' }}" data-tab="tab-my-tickets" onclick="switchUserTab('tab-my-tickets', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                        <span class="user-nav-title">پشتیبانی و تیکت‌ها</span>
                    </span>
                    <span class="user-nav-badge">{{ $myTickets->count() }}</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/user-portal') }}?tab=profile" class="user-nav-btn {{ $activeTab === 'tab-profile' ? 'active' : '' }}" data-tab="tab-profile" onclick="switchUserTab('tab-profile', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                        <span class="user-nav-title">پروفایل و اطلاعات من</span>
                    </span>
                    <span class="user-nav-badge" style="{{ $completionScore >= 80 ? 'background:#ecfdf5; color:#059669;' : 'background:#fffbeb; color:#b45309;' }}">
                        {{ $completionScore }}٪
                    </span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- 2. MAIN USER CONTENT -->
    <main class="user-main" id="userMain">

        <!-- ===================================================================
             PAGE 1: MY DEVICES (tab-my-devices)
             =================================================================== -->
        <div class="user-view {{ $activeTab === 'tab-my-devices' ? 'active' : '' }}" id="tab-my-devices" data-title="دستگاه‌ها و پیگیری آنلاین">
            @forelse($myOrders as $order)
                <div class="user-panel">
                    <div class="user-panel-header">
                        <div>
                            <strong style="font-size: 1.15rem; color: #0f172a;">{{ $order->device_brand }} {{ $order->device_model }}</strong>
                            <div style="font-size: 0.80rem; color: #64748b; margin-top: 5px;">
                                کد رهگیری: <span style="font-family: monospace; font-weight: 800; color: #2563eb;">{{ $order->tracking_code }}</span> | 
                                شماره سریال (IMEI): <span style="font-family: monospace; font-weight: 700; color: #334155;">{{ $order->imei }}</span>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn-table-action primary" onclick="openWarrantyCardView('{{ $order->device_brand }} {{ $order->device_model }}', '{{ $order->imei }}')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                <span>مشاهده کارت گارانتی ۱۸ ماهه</span>
                            </button>
                        </div>
                    </div>

                    <!-- 5-Stage Stepper -->
                    @php
                        $stOrder = ['received' => 1, 'inspecting' => 2, 'waiting_parts' => 3, 'repairing' => 3, 'ready_for_delivery' => 4, 'delivered' => 5];
                        $curStep = $stOrder[$order->status] ?? 1;
                    @endphp
                    <div class="timeline-stepper">
                        <div class="step-node {{ $curStep >= 1 ? ($curStep > 1 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">{{ $curStep > 1 ? '✓' : '۱' }}</div>
                            <span class="step-label">پذیرش اولیه</span>
                        </div>
                        <div class="step-node {{ $curStep >= 2 ? ($curStep > 2 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">{{ $curStep > 2 ? '✓' : '۲' }}</div>
                            <span class="step-label">کارشناسی فنی</span>
                        </div>
                        <div class="step-node {{ $curStep >= 3 ? ($curStep > 3 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">{{ $curStep > 3 ? '✓' : '۳' }}</div>
                            <span class="step-label">تأمین قطعه و تعمیر</span>
                        </div>
                        <div class="step-node {{ $curStep >= 4 ? ($curStep > 4 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">{{ $curStep > 4 ? '✓' : '۴' }}</div>
                            <span class="step-label">کنترل کیفی و آماده</span>
                        </div>
                        <div class="step-node {{ $curStep >= 5 ? 'completed active' : '' }}">
                            <div class="step-circle">{{ $curStep >= 5 ? '✓' : '۵' }}</div>
                            <span class="step-label">تحویل نهایی</span>
                        </div>
                    </div>

                    <!-- Order Details Summary -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px 18px; font-size: 0.84rem; line-height: 1.8;">
                        <div style="margin-bottom: 4px;">
                            <strong style="color: #0f172a;">شرح ایراد اظهار شده:</strong> {{ $order->problem_description ?? ($order->reported_issues ?? 'نیاز به بررسی تخصصی') }}
                        </div>
                        @if(!empty($order->technician_report ?? ($order->technician_diagnosis ?? null)))
                            <div style="color: #0284c7; margin-bottom: 4px;">
                                <strong>گزارش کارشناسی کارگاه:</strong> {{ $order->technician_report ?? ($order->technician_diagnosis ?? 'در دست بررسی کارشناسی') }}
                            </div>
                        @endif
                        <div style="color: #64748b; font-size: 0.78rem; display: flex; align-items: center; gap: 6px; margin-top: 6px;">
                            <span>وضعیت پوشش:</span>
                            <span style="font-weight: 800; color: {{ ($order->warranty_status == 'under_warranty' || !empty($order->is_under_warranty)) ? '#059669' : '#b45309' }};">
                                {{ ($order->warranty_status == 'under_warranty' || !empty($order->is_under_warranty)) ? 'تحت پوشش گارانتی ۱۸ ماهه رسمی سام موبایل' : 'خدمات آزاد مطابق نرخ تعرفه خدمات غیر گارانتی' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="user-panel" style="text-align: center; padding: 48px 20px;">
                    <div style="width: 64px; height: 64px; border-radius: 50%; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.8rem;">📱</div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 8px;">هنوز دستگاهی با شماره شما ثبت نشده است</h3>
                    <p style="color: #64748b; font-size: 0.86rem; margin-bottom: 20px; max-width: 450px; margin-left: auto; margin-right: auto;">می‌توانید دستگاه تلفن همراه خود را برای پذیرش و ارسال به کارگاه مرکزی ثبت فرمایید.</p>
                    <button type="button" class="btn-table-action primary" onclick="switchUserTab('tab-new-request')">
                        + ثبت دستگاه جدید برای پذیرش
                    </button>
                </div>
            @endforelse
        </div>

        <!-- ===================================================================
             PAGE 2: NEW REPAIR REQUEST (tab-new-request)
             =================================================================== -->
        <div class="user-view {{ $activeTab === 'tab-new-request' ? 'active' : '' }}" id="tab-new-request" data-title="ثبت پذیرش دستگاه جدید">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                        <span>ثبت درخواست پذیرش و تعمیر دستگاه جدید</span>
                    </div>
                </div>

                <form action="{{ url('/user-portal/store-order') }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">برند دستگاه تلفن همراه *</label>
                            <select name="device_brand" class="form-select-custom" required>
                                <option value="Samsung" {{ ($user && $user->device_brand == 'Samsung') ? 'selected' : '' }}>سامسونگ (Samsung)</option>
                                <option value="Apple" {{ ($user && $user->device_brand == 'Apple') ? 'selected' : '' }}>اپل (Apple iPhone)</option>
                                <option value="Xiaomi" {{ ($user && $user->device_brand == 'Xiaomi') ? 'selected' : '' }}>شیائومی (Xiaomi / Poco)</option>
                                <option value="Honor" {{ ($user && $user->device_brand == 'Honor') ? 'selected' : '' }}>آنر (Honor)</option>
                                <option value="Huawei" {{ ($user && $user->device_brand == 'Huawei') ? 'selected' : '' }}>هواوی (Huawei)</option>
                                <option value="Other">سایر برندها</option>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">مدل دقیق دستگاه *</label>
                            <input type="text" name="device_model" class="form-input-custom" value="{{ $user ? $user->device_model : '' }}" placeholder="مثال: Galaxy S24 Ultra یا iPhone 15 Pro" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 10px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره سریال ۱۵ رقمی (IMEI) دستگاه *</label>
                            <input type="text" name="imei" class="form-input-custom" placeholder="برای مشاهده *#06# را شماره‌گیری کنید" maxlength="16" style="direction: ltr;" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">وضعیت گارانتی</label>
                            <select name="warranty_status" class="form-select-custom">
                                <option value="under_warranty">دارای گارانتی ۱۸ ماهه رسمی سام موبایل</option>
                                <option value="out_of_warranty">تعمیر آزاد غیرگارانتی (طبق تعرفه مصوب اتحادیه)</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 10px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">نحوه تحویل کالا به مرکز خدمات *</label>
                            <select name="intake_type" class="form-select-custom" required>
                                <option value="in_person">مراجعه حضوری به نزدیک‌ترین شعبه یا نمایندگی</option>
                                <option value="postal">ارسال با پست پیشتاز یا پیک اختصاصی شرکت</option>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">رنگ و لوازم جانبی همراه</label>
                            <input type="text" name="color" class="form-input-custom" placeholder="مثال: مشکی - همراه با جعبه و شارژر">
                        </div>
                    </div>

                    <div class="form-group-custom" style="margin-top: 10px;">
                        <label class="form-label-custom">شرح کامل ایراد و مشکل فنی دستگاه *</label>
                        <textarea name="reported_issues" class="form-textarea-custom" rows="3" placeholder="توضیح دهید دستگاه چه علائمی دارد (مثال: تصویر نمی‌دهد، ضربه به صفحه، شارژ نمی‌شود...)" required></textarea>
                    </div>

                    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-table-action primary" style="padding: 12px 28px; font-size: 0.90rem;">
                            ارسال درخواست پذیرش و دریافت کد رهگیری آنی
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 3: DIGITAL WARRANTY CARD (tab-warranty-card)
             =================================================================== -->
        <div class="user-view {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" id="tab-warranty-card" data-title="کارت گارانتی دیجیتال">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>کارت گارانتی دیجیتال ۱۸ ماهه رسمی (تامین کانی سام)</span>
                    </div>
                    <div>
                        <button type="button" class="btn-table-action primary" onclick="window.print()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            <span>چاپ و دریافت PDF رسمی</span>
                        </button>
                    </div>
                </div>

                @php
                    $firstOrder = $myOrders->first();
                @endphp

                <div style="max-width: 640px; margin: 0 auto;">
                    <!-- Front Side Card -->
                    <div class="official-card-front" style="background: linear-gradient(135deg, #021a3f 0%, #08336d 45%, #05418c 70%, #031c44 100%); border-radius: 20px; padding: 22px 24px; color: #ffffff; margin-bottom: 20px; border: 2px solid rgba(59, 130, 246, 0.4); box-shadow: 0 16px 36px rgba(2, 26, 63, 0.35); position: relative; overflow: hidden; min-height: 240px; display: flex; flex-direction: column; justify-content: space-between;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2;">
                            <div style="border-right: 3.5px solid #60a5fa; padding-right: 12px;">
                                <span style="font-size: 1.3rem; font-weight: 900; display: block; line-height: 1.2; letter-spacing: -0.5px; color: #ffffff;">کارت گارانتی رسمی</span>
                                <span style="font-size: 0.86rem; font-weight: 800; color: #93c5fd; display: block;">تلفن همراه و تجهیزات ارتباطی</span>
                            </div>
                            <div style="text-align: right; line-height: 1.2;">
                                <span style="font-size: 0.90rem; font-weight: 900; color: #ffffff; display: block;">تامین کانی سام</span>
                                <span style="font-size: 0.65rem; color: #93c5fd; letter-spacing: 0.5px; display: block;">Taminkanisam Co.</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px; align-items: center; margin: 16px 0; position: relative; z-index: 2;">
                            <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
                                <div style="background: rgba(255, 255, 255, 0.10); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.20); border-radius: 12px; padding: 10px 14px; display: flex; align-items: center; gap: 12px;">
                                    <div style="flex: 1;">
                                        <div style="display: inline-block; background: #ffffff; color: #021a3f; font-size: 0.68rem; font-weight: 900; padding: 2px 8px; border-radius: 99px; margin-bottom: 3px;">شناسه هوشمند استعلام</div>
                                        <div style="font-size: 0.72rem; color: #e2e8f0; line-height: 1.5;">برای استعلام آنلاین وضعیت گارانتی در سامانه جامع خدمات، بارکد را اسکن فرمایید.</div>
                                    </div>
                                    <div style="width: 58px; height: 58px; background: #ffffff; border-radius: 8px; padding: 3px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=52x52&data=https://mob.taminkanisam.co.ir/track?imei={{ $firstOrder ? $firstOrder->imei : '' }}" alt="QR" style="width: 52px; height: 52px; display: block;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; border-top: 1px solid rgba(255, 255, 255, 0.15); padding-top: 10px;">
                            <span style="font-size: 0.78rem; font-weight: 800; color: #60a5fa;">گارانتی ۱۸ ماهه معتبر سراسری</span>
                            <span style="font-size: 0.72rem; color: #cbd5e1;">انطباق با ماده ۱۳ ضوابط صمت</span>
                        </div>
                    </div>

                    <!-- Back Side Card Details -->
                    <div class="official-card-back" style="background: #ffffff; border: 2px solid #cbd5e1; border-radius: 20px; padding: 20px 22px; color: #0f172a; box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08); position: relative;">
                        <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 14px;">
                                <span style="font-size: 0.78rem; color: #475569; font-weight: 700;">برند و مدل کالا:</span>
                                <span style="font-size: 0.84rem; font-weight: 900; color: #0f172a;">{{ $firstOrder ? ($firstOrder->device_brand . ' ' . $firstOrder->device_model) : 'Apple iPhone 13 128GB' }}</span>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 14px;">
                                <span style="font-size: 0.78rem; color: #475569; font-weight: 700;">شماره سریال ۱۵ رقمی (IMEI):</span>
                                <span style="font-size: 0.84rem; font-weight: 900; font-family: monospace; color: #1d4ed8; direction: ltr;">{{ $firstOrder ? $firstOrder->imei : '352849109263746' }}</span>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 14px;">
                                <span style="font-size: 0.78rem; color: #475569; font-weight: 700;">تاریخ آغاز پوشش و اعتبار:</span>
                                <span style="font-size: 0.84rem; font-weight: 900; color: #059669;">{{ shamsi($firstOrder->warranty_start_date ?? ($firstOrder->created_at ?? now()), 'Y/m/d') }} (۱۸ ماه فعال)</span>
                            </div>
                        </div>

                        <div style="background: #021a3f; color: #ffffff; border-radius: 12px; padding: 12px 16px; font-size: 0.72rem; line-height: 1.8;">
                            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                                <span style="font-weight: 800; color: #93c5fd;">📞 مرکز تماس: ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)</span>
                                <span>🌐 وب‌سایت: mob.taminkanisam.co.ir</span>
                            </div>
                            <div style="border-top: 1px solid rgba(255,255,255,0.15); margin-top: 6px; padding-top: 6px; color: #cbd5e1;">
                                📍 نشانی مرکزی: تبریز، فرشته شمالی، خیابان محمدپورصبور، پلاک ۷۸ - شرکت تامین کانی سام
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 4: MY INVOICES (tab-my-invoices)
             =================================================================== -->
        <div class="user-view {{ $activeTab === 'tab-my-invoices' ? 'active' : '' }}" id="tab-my-invoices" data-title="صورت‌حساب و فاکتورها">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        <span>صورت‌حساب‌های رسمی و هزینه‌های خدمات</span>
                    </div>
                    <div>
                        <a href="{{ url('/invoice-sample') }}" target="_blank" class="btn-table-action primary">
                            <span>نرخ تعرفه خدمات غیر گارانتی</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                        </a>
                    </div>
                </div>

                <div class="table-responsive-box">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>شماره فاکتور</th>
                                <th>دستگاه مربوطه</th>
                                <th>تاریخ صدور</th>
                                <th>هزینه قطعات</th>
                                <th>اجرت خدمات</th>
                                <th>مبلغ کل</th>
                                <th>وضعیت پرداخت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myOrders as $invOrder)
                                <tr>
                                    <td><span class="table-track-code">{{ $invOrder->invoice_number ?? ('INV-' . $invOrder->tracking_code) }}</span></td>
                                    <td><strong>{{ $invOrder->device_brand }} {{ $invOrder->device_model }}</strong></td>
                                    <td>{{ shamsi($invOrder->invoice_date ?? ($invOrder->created_at ?? now()), 'Y/m/d') }}</td>
                                    <td>{{ number_format($invOrder->parts_cost ?? 0) }} ریال</td>
                                    <td>{{ number_format($invOrder->labor_cost ?? ($invOrder->wage_cost ?? 0)) }} ریال</td>
                                    <td><strong style="color: #2563eb;">{{ number_format($invOrder->total_cost ?? 0) }} ریال</strong></td>
                                    <td>
                                        @if(!empty($invOrder->is_paid) || !empty($invOrder->is_under_warranty))
                                            <span class="table-status-pill st-ready_for_delivery">تسویه / تحت پوشش گارانتی</span>
                                        @else
                                            <span class="table-status-pill st-inspecting">در انتظار پرداخت</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/invoice-sample') }}" target="_blank" class="btn-table-action outline" style="padding: 6px 12px; font-size: 0.78rem;">
                                            مشاهده فاکتور
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 28px; color: #94a3b8;">
                                        تاکنون صورت‌حساب مالی برای حساب کاربری شما صادر نشده است.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 5: MY TICKETS (tab-my-tickets)
             =================================================================== -->
        <div class="user-view {{ $activeTab === 'tab-my-tickets' ? 'active' : '' }}" id="tab-my-tickets" data-title="پشتیبانی و تیکت‌ها">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>ثبت و پیگیری تیکت‌های پشتیبانی ۲۴ ساعته</span>
                    </div>
                </div>

                <!-- New Ticket Form -->
                <form action="{{ url('/user-portal/send-ticket') }}" method="POST" style="margin-bottom: 24px; padding: 20px; border-radius: var(--user-radius-md); background: #f8fafc; border: 1px solid var(--user-border);">
                    @csrf
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 14px;">
                        <div>
                            <label class="form-label-custom">موضوع یا عنوان تیکت *</label>
                            <input type="text" name="subject" class="form-input-custom" placeholder="مثال: سوال در مورد زمان ترخیص دستگاه یا هزینه قطعه" required>
                        </div>
                        <div>
                            <label class="form-label-custom">اولویت رسیدگی</label>
                            <select name="priority" class="form-select-custom">
                                <option value="normal">عادی (رسیدگی ظرف ۲۴ ساعت)</option>
                                <option value="urgent">فوری و اولویت‌دار</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 14px;">
                        <label class="form-label-custom">شرح پیام یا سوال شما *</label>
                        <textarea name="message" class="form-textarea-custom" rows="3" placeholder="متن پیام خود را به دقت بنویسید..." required></textarea>
                    </div>
                    <div style="margin-top: 16px; text-align: left;">
                        <button type="submit" class="btn-table-action primary" style="padding: 10px 24px;">
                            ارسال تیکت به کارشناس پشتیبانی
                        </button>
                    </div>
                </form>

                <!-- Ticket History -->
                <div class="table-responsive-box">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>موضوع تیکت</th>
                                <th>تاریخ ثبت</th>
                                <th>وضعیت</th>
                                <th>پاسخ کارشناس</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myTickets as $t)
                                <tr>
                                    <td><code>#{{ $t->id }}</code></td>
                                    <td><strong>{{ $t->subject }}</strong></td>
                                    <td>{{ shamsi($t->created_at) }}</td>
                                    <td>
                                        <span class="table-status-pill {{ $t->status == 'open' ? 'st-inspecting' : 'st-ready_for_delivery' }}">
                                            {{ $t->status == 'open' ? 'در حال بررسی پشتیبان' : 'پاسخ داده شد' }}
                                        </span>
                                    </td>
                                    <td>{{ $t->reply ?? 'در دست بررسی توسط واحد پشتیبانی' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #94a3b8; padding: 24px;">
                                        تیکتی در سابقه حساب شما یافت نشد.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ===================================================================
             PAGE 6: USER PROFILE & IDENTITY DETAILS (tab-profile)
             =================================================================== -->
        <div class="user-view {{ $activeTab === 'tab-profile' ? 'active' : '' }}" id="tab-profile" data-title="پروفایل و اطلاعات من">
            <!-- Profile Hero Meter Card -->
            <div class="profile-hero-card">
                <div class="profile-hero-left">
                    <div class="profile-avatar-big">
                        {{ mb_substr($user ? $user->name : 'ص', 0, 1) }}
                    </div>
                    <div>
                        <div style="font-size: 1.25rem; font-weight: 900; margin-bottom: 4px;">
                            {{ $user ? $user->name : 'مشتری گرامی سام موبایل' }}
                        </div>
                        <div style="font-size: 0.82rem; color: #93c5fd; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <span style="background: rgba(59, 130, 246, 0.25); padding: 2px 10px; border-radius: 99px; border: 1px solid rgba(147, 197, 253, 0.3);">
                                📱 تلفن: {{ $userPhone }}
                            </span>
                            @if(!empty($user->device_brand))
                                <span style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 2px 10px; border-radius: 99px;">
                                    برند: {{ $user->device_brand }} {{ $user->device_model }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="profile-progress-wrap">
                    <div style="display: flex; justify-content: space-between; font-size: 0.82rem; font-weight: 800;">
                        <span>میزان تکمیل پروفایل:</span>
                        <span style="color: #38bdf8;">{{ $completionScore }}٪</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: {{ $completionScore }}%;"></div>
                    </div>
                </div>
            </div>

            <!-- Profile Edit Form -->
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span>ویرایش مشخصات فردی، هویتی و نشانی پستی</span>
                    </div>
                </div>

                <form id="userProfileForm" onsubmit="handleProfileUpdate(event)">
                    @csrf

                    <!-- Section 1: مشخصات هویتی -->
                    <div style="font-size: 0.90rem; font-weight: 900; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #2563eb;"></span>
                        <span>۱. مشخصات هویتی و تماس</span>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">نام و نام خانوادگی *</label>
                            <input type="text" name="name" class="form-input-custom" value="{{ $user ? $user->name : '' }}" placeholder="نام و نام خانوادگی خود را بنویسید" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره تلفن همراه (تایید شده با پیامک)</label>
                            <input type="text" class="form-input-custom" value="{{ $userPhone }}" readonly style="background: #f1f5f9; color: #64748b; direction: ltr;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">کد ملی ۱۰ رقمی</label>
                            <input type="text" name="national_code" class="form-input-custom" value="{{ $user ? $user->national_code : '' }}" placeholder="مثال: 1370001234" maxlength="10" style="direction: ltr;">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره تلفن ثابت (با پیش‌شماره)</label>
                            <input type="text" name="phone_landline" class="form-input-custom" value="{{ $user ? $user->phone_landline : '' }}" placeholder="مثال: 041-33334444" style="direction: ltr;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">آدرس ایمیل *</label>
                            <input type="email" name="email" class="form-input-custom" value="{{ $user && !str_contains($user->email, '@taminkanisam.co.ir') ? $user->email : '' }}" placeholder="name@example.com" style="direction: ltr;" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">برند دستگاه تلفن همراه</label>
                            <select name="device_brand" class="form-select-custom">
                                <option value="">-- انتخاب برند --</option>
                                <option value="Samsung" {{ ($user && $user->device_brand == 'Samsung') ? 'selected' : '' }}>سامسونگ (Samsung)</option>
                                <option value="Apple" {{ ($user && $user->device_brand == 'Apple') ? 'selected' : '' }}>اپل (Apple iPhone)</option>
                                <option value="Xiaomi" {{ ($user && $user->device_brand == 'Xiaomi') ? 'selected' : '' }}>شیائومی (Xiaomi / Poco)</option>
                                <option value="Honor" {{ ($user && $user->device_brand == 'Honor') ? 'selected' : '' }}>آنر (Honor)</option>
                                <option value="Huawei" {{ ($user && $user->device_brand == 'Huawei') ? 'selected' : '' }}>هواوی (Huawei)</option>
                                <option value="Other" {{ ($user && $user->device_brand == 'Other') ? 'selected' : '' }}>سایر برندها</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section 2: نشانی پستی -->
                    <div style="font-size: 0.90rem; font-weight: 900; color: #0f172a; margin: 24px 0 12px; display: flex; align-items: center; gap: 6px; border-top: 1px solid #f1f5f9; padding-top: 18px;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></span>
                        <span>۲. نشانی پستی دقیق (جهت ارسال و تحویل کالا با پیک یا پست)</span>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">استان</label>
                            <input type="text" name="state" class="form-input-custom" value="{{ $user ? ($user->state ?: 'آذربایجان شرقی') : 'آذربایجان شرقی' }}" placeholder="مثال: آذربایجان شرقی یا تهران">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">شهر</label>
                            <input type="text" name="city" class="form-input-custom" value="{{ $user ? ($user->city ?: 'تبریز') : 'تبریز' }}" placeholder="مثال: تبریز">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">کد پستی ۱۰ رقمی</label>
                            <input type="text" name="postal" class="form-input-custom" value="{{ $user ? $user->postal : '' }}" placeholder="مثال: 5157912345" maxlength="10" style="direction: ltr;">
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">نشانی پستی دقیق (خیابان، کوچه، پلاک، زنگ)</label>
                        <textarea name="address" class="form-textarea-custom" rows="2" placeholder="آدرس دقیق برای ارسال دستگاه پس از تعمیر...">{{ $user ? $user->address : '' }}</textarea>
                    </div>

                    <!-- Section 3: رمز عبور -->
                    <div style="font-size: 0.90rem; font-weight: 900; color: #0f172a; margin: 24px 0 12px; display: flex; align-items: center; gap: 6px; border-top: 1px solid #f1f5f9; padding-top: 18px;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #f59e0b;"></span>
                        <span>۳. تنظیم کلمه عبور اختصاصی (جهت ورود بدون نیاز به پیامک)</span>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">کلمه عبور جدید (اختیاری)</label>
                            <input type="password" name="new_password" class="form-input-custom" placeholder="حداقل ۴ کاراکتر">
                        </div>
                    </div>

                    <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-table-action primary" id="btnSaveProfile" style="padding: 12px 32px; font-size: 0.92rem;">
                            ذخیره و به‌روزرسانی اطلاعات حساب
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</div>

<!-- =========================================================================
     SMART FIRST-TIME ONBOARDING MODAL
     ========================================================================= -->
@if(!empty($isFirstLogin))
<div class="onboarding-modal-backdrop" id="onboardingModal">
    <div class="onboarding-modal-card">
        <div class="onboarding-header">
            <div class="onboarding-icon">🎉</div>
            <div>
                <h3 class="onboarding-title">خوش آمدید! تکمیل اطلاعات اولیه کاربری</h3>
                <p class="onboarding-subtitle">جهت فعال‌سازی خدمات گارانتی و پیگیری آنلاین پرونده‌ها، لطفاً اطلاعات اولیه خود را تایید نمایید.</p>
            </div>
        </div>

        <form id="onboardingForm" onsubmit="handleOnboardingSubmit(event)">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
                <div class="form-group-custom">
                    <label class="form-label-custom">نام و نام خانوادگی *</label>
                    <input type="text" name="name" class="form-input-custom" value="{{ $user ? $user->name : '' }}" placeholder="مثال: صابر ناصری" required>
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">شماره همراه (تایید شده)</label>
                    <input type="text" class="form-input-custom" value="{{ $userPhone }}" readonly style="background:#f1f5f9; color:#64748b; direction:ltr;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-top: 6px;">
                <div class="form-group-custom">
                    <label class="form-label-custom">آدرس ایمیل *</label>
                    <input type="email" name="email" class="form-input-custom" value="{{ $user && !str_contains($user->email, '@taminkanisam.co.ir') ? $user->email : '' }}" placeholder="name@example.com" required style="direction:ltr;">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">نوع / برند دستگاه تلفن همراه *</label>
                    <select name="device_brand" class="form-select-custom" required>
                        <option value="">-- انتخاب برند گوشی --</option>
                        <option value="Samsung" {{ ($user && $user->device_brand == 'Samsung') ? 'selected' : '' }}>سامسونگ (Samsung)</option>
                        <option value="Apple" {{ ($user && $user->device_brand == 'Apple') ? 'selected' : '' }}>اپل (Apple iPhone)</option>
                        <option value="Xiaomi" {{ ($user && $user->device_brand == 'Xiaomi') ? 'selected' : '' }}>شیائومی (Xiaomi / Poco)</option>
                        <option value="Huawei" {{ ($user && $user->device_brand == 'Huawei') ? 'selected' : '' }}>هواوی (Huawei)</option>
                        <option value="Honor" {{ ($user && $user->device_brand == 'Honor') ? 'selected' : '' }}>آنر (Honor)</option>
                        <option value="Other">سایر برندها</option>
                    </select>
                </div>
            </div>

            <div class="onboarding-notice">
                ℹ️ <strong>نکته:</strong> اطلاعات تکمیلی شامل کد ملی، شماره تلفن ثابت و آدرس پستی را می‌توانید در هر زمان از منوی «پروفایل من» تکمیل فرمایید.
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-table-action primary" id="btnSubmitOnboarding" style="padding: 12px 28px; font-size: 0.92rem;">
                    تایید و شروع استفاده از سامانه
                </button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- Mobile Sticky Bottom Navigation -->
<nav class="user-mobile-nav" id="userMobileNav">
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-my-devices' ? 'active' : '' }}" onclick="switchUserTab('tab-my-devices', this, event)" data-tab="tab-my-devices">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
        <span>دستگاه‌ها</span>
    </button>
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-new-request' ? 'active' : '' }}" onclick="switchUserTab('tab-new-request', this, event)" data-tab="tab-new-request">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></div>
        <span>پذیرش جدید</span>
    </button>
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" onclick="switchUserTab('tab-warranty-card', this, event)" data-tab="tab-warranty-card">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <span>کارت گارانتی</span>
    </button>
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-profile' ? 'active' : '' }}" onclick="switchUserTab('tab-profile', this, event)" data-tab="tab-profile">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <span>پروفایل من</span>
    </button>
    <button type="button" class="user-bottom-nav-item" onclick="toggleUserSidebar(true)">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg></div>
        <span>منوی کامل</span>
    </button>
</nav>

@endsection

@push('scripts')
<script>
    function switchUserTab(tabId, el, ev) {
        if (ev) ev.preventDefault();
        if (!tabId.startsWith('tab-')) tabId = 'tab-' + tabId;

        document.querySelectorAll('.user-view').forEach(function(v) {
            v.classList.remove('active');
            v.style.display = 'none';
        });

        const target = document.getElementById(tabId);
        if (target) {
            target.classList.add('active');
            target.style.display = 'block';
        }

        document.querySelectorAll('.user-nav-btn').forEach(function(b) {
            b.classList.remove('active');
            if (b.getAttribute('data-tab') === tabId) {
                b.classList.add('active');
            }
        });
        if (el && el.classList.contains('user-nav-btn')) el.classList.add('active');

        // Highlight mobile bottom nav items
        document.querySelectorAll('.user-bottom-nav-item').forEach(function(item) {
            item.classList.remove('active');
            if (item.getAttribute('data-tab') === tabId) {
                item.classList.add('active');
            }
        });
        if (el && el.classList.contains('user-bottom-nav-item')) el.classList.add('active');

        const title = el?.querySelector('.user-nav-title')?.innerText || target?.getAttribute('data-title') || 'پنل کاربری';
        const bcrumb = document.getElementById('userBreadcrumbTitle');
        if (bcrumb) bcrumb.innerText = title;

        const slug = tabId.replace('tab-', '');
        const newUrl = window.location.pathname + '?tab=' + slug;
        if (window.history.pushState) {
            window.history.pushState({ tab: slug }, '', newUrl);
        }

        if (window.innerWidth < 992) {
            toggleUserSidebar(false);
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.addEventListener('popstate', function() {
        const params = new URLSearchParams(window.location.search);
        const tab = params.get('tab') || 'my-devices';
        const activeBtn = document.querySelector(`.user-nav-btn[data-tab="tab-${tab}"]`);
        switchUserTab(tab, activeBtn, null);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);
        const tab = params.get('tab') || 'my-devices';
        const activeBtn = document.querySelector(`.user-nav-btn[data-tab="tab-${tab}"]`);
        switchUserTab(tab, activeBtn, null);
    });

    function toggleUserSidebar(forceState) {
        const sidebar = document.getElementById('userSidebar');
        const overlay = document.getElementById('userSidebarOverlay');
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

    function openWarrantyCardView(model, imei) {
        switchUserTab('tab-warranty-card');
    }

    // Ajax Profile Update
    async function handleProfileUpdate(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSaveProfile');
        btn.disabled = true;
        btn.innerText = 'در حال ذخیره‌سازی...';

        const form = document.getElementById('userProfileForm');
        const formData = new FormData(form);

        try {
            const res = await fetch("{{ route('mob.user.profile.save') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message || 'اطلاعات با موفقیت ذخیره شد.');
                window.location.reload();
            } else {
                alert(data.message || 'خطایی در ذخیره‌سازی رخ داد.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'ذخیره و به‌روزرسانی اطلاعات حساب';
        }
    }

    // Ajax Onboarding Submit
    async function handleOnboardingSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitOnboarding');
        btn.disabled = true;
        btn.innerText = 'در حال ثبت...';

        const form = document.getElementById('onboardingForm');
        const formData = new FormData(form);

        try {
            const res = await fetch("{{ route('mob.user.onboarding') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                alert(data.message || 'ثبت‌نام با موفقیت تکمیل شد!');
                const modal = document.getElementById('onboardingModal');
                if (modal) modal.style.display = 'none';
                window.location.reload();
            } else {
                alert(data.message || 'خطایی در ثبت اطلاعات اولیه رخ داد.');
            }
        } catch (err) {
            alert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'تایید و شروع استفاده از سامانه';
        }
    }
</script>
@endpush
