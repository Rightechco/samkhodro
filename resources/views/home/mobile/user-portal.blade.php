@extends('home.mobile.portal-layout')

@section('title', 'پنل اختصاصی مشتریان سام موبایل | سامانه خدمات و گارانتی')
@section('meta_description', 'میز کار و پنل کاربری مشتریان سام موبایل جهت پیگیری آنلاین وضعیت تعمیر دستگاه، مشاهده کارت گارانتی دیجیتال و ثبت درخواست‌های جدید')

@push('styles')
<style>
    /* =========================================================================
       CUSTOMER PORTAL WITH MODERN SIDEBAR & APP EXPERIENCE
       ========================================================================= */
    :root {
        --user-bg: #f8fafc;
        --sidebar-w: 270px;
        --card-border: #e2e8f0;
        --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }

    body {
        background-color: var(--user-bg);
    }

    .user-container {
        display: flex;
        min-height: calc(100vh - 120px);
        position: relative;
        padding-bottom: 60px;
    }

    /* -------------------------------------------------------------------------
       1. CUSTOMER SIDEBAR
       ------------------------------------------------------------------------- */
    .user-sidebar {
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

    /* Profile Badge */
    .customer-profile-card {
        padding: 14px;
        background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
        border: 1px solid #bbf7d0;
        border-radius: 14px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .customer-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        flex-shrink: 0;
    }
    .customer-name {
        font-size: 0.88rem;
        font-weight: 800;
        color: #0f172a;
    }
    .customer-phone {
        font-size: 0.74rem;
        color: #059669;
        font-weight: 700;
        font-family: monospace;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 2px;
    }

    /* Navigation */
    .user-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .user-nav-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 14px;
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
    .user-nav-btn:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
    .user-nav-btn.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 800;
        border-color: #bfdbfe;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
    }
    .user-nav-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .user-nav-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .user-nav-badge {
        font-size: 0.72rem;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 20px;
        background: #e2e8f0;
        color: #475569;
    }
    .user-nav-btn.active .user-nav-badge {
        background: #2563eb;
        color: #ffffff;
    }

    .user-sidebar-bottom {
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }
    .btn-user-logout {
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
        transition: all 0.2s;
    }
    .btn-user-logout:hover {
        background: #ffe4e6;
    }

    /* -------------------------------------------------------------------------
       2. MAIN WORKSPACE
       ------------------------------------------------------------------------- */
    .user-main {
        flex: 1;
        min-width: 0;
        padding: 20px 20px 20px 0;
    }

    /* Top Bar */
    .user-topbar {
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
    .user-toggle-sidebar {
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
    .user-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: #64748b;
    }
    .user-breadcrumb strong {
        color: #0f172a;
        font-weight: 800;
    }

    /* KPI Summary Cards */
    .user-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    .u-kpi-card {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
    }
    .u-kpi-val {
        font-size: 1.5rem;
        font-weight: 900;
        color: #0f172a;
        font-family: monospace;
    }
    .u-kpi-lbl {
        font-size: 0.74rem;
        color: #64748b;
        font-weight: 700;
        margin-top: 4px;
    }

    /* Tab Panels */
    .user-view {
        display: none;
    }
    .user-view.active {
        display: block;
        animation: fadeInTab 0.25s ease-out;
    }

    .user-panel {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 22px;
        margin-bottom: 22px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
    }
    .user-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 18px;
    }
    .user-panel-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* 5-Stage Stepper */
    .timeline-stepper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        margin: 26px 10px 22px;
    }
    .timeline-stepper::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 30px;
        right: 30px;
        height: 3px;
        background: #e2e8f0;
        z-index: 1;
    }
    .step-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        gap: 8px;
        text-align: center;
        flex: 1;
    }
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 800;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: all 0.2s;
    }
    .step-node.active .step-circle {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
        box-shadow: 0 0 0 5px rgba(37, 99, 235, 0.15);
    }
    .step-node.completed .step-circle {
        background: #10b981;
        border-color: #10b981;
        color: #ffffff;
    }
    .step-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
    }
    .step-node.active .step-label {
        color: #2563eb;
        font-weight: 800;
    }

    /* Warranty Card Replica Modal (Exact to User Attachment) */
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
        background: #0b192c;
        border-radius: 24px;
        max-width: 580px;
        width: 100%;
        padding: 24px;
        color: #ffffff;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.15);
        position: relative;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .user-container {
            flex-direction: column;
        }
        .user-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            height: 100vh;
            margin: 0;
            border-radius: 0;
            transform: translateX(105%);
            z-index: 10000;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
        }
        .user-sidebar.open {
            transform: translateX(0);
        }
        .user-sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
        }
        .user-sidebar-overlay.open {
            display: block;
        }
        .user-main {
            padding: 10px;
        }
        .user-toggle-sidebar {
            display: flex;
        }
        .user-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .timeline-stepper {
            overflow-x: auto;
            padding-bottom: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="user-container">

    <!-- Mobile Backdrop -->
    <div class="user-sidebar-overlay" id="userSidebarOverlay" onclick="toggleUserSidebar()"></div>

    <!-- 1. CUSTOMER SIDEBAR -->
    <aside class="user-sidebar" id="userSidebar">
        <!-- Customer Profile Card -->
        <div class="customer-profile-card">
            <div class="customer-avatar">
                {{ mb_substr($user ? $user->name : 'مشتری', 0, 1) }}
            </div>
            <div>
                <div class="customer-name">{{ $user ? $user->name : 'مشتری گرامی سام موبایل' }}</div>
                <div class="customer-phone">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>{{ $userPhone }}</span>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <ul class="user-nav-list">
            <li>
                <button type="button" class="user-nav-btn active" onclick="switchUserTab('tab-my-devices', this)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></span>
                        <span>دستگاه‌ها و پیگیری آنلاین</span>
                    </span>
                    <span class="user-nav-badge">{{ $stats['total'] }}</span>
                </button>
            </li>
            <li>
                <button type="button" class="user-nav-btn" onclick="switchUserTab('tab-new-request', this)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
                        <span>ثبت پذیرش دستگاه جدید</span>
                    </span>
                </button>
            </li>
            <li>
                <button type="button" class="user-nav-btn" onclick="openWarrantyCardView()">
                    <span class="user-nav-left">
                        <span class="user-nav-icon" style="color: #2563eb;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                        <span>کارت گارانتی دیجیتال</span>
                    </span>
                    <span class="user-nav-badge" style="background:#dbeafe; color:#1d4ed8;">۱۸ ماهه</span>
                </button>
            </li>
            <li>
                <button type="button" class="user-nav-btn" onclick="switchUserTab('tab-my-tickets', this)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                        <span>تیکت‌ها و پشتیبانی</span>
                    </span>
                    <span class="user-nav-badge">{{ count($myTickets) }}</span>
                </button>
            </li>
            <li>
                <a href="{{ url('/invoice-sample') }}" target="_blank" class="user-nav-btn">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                        <span>نمونه فاکتور رسمی اتحادیه</span>
                    </span>
                </a>
            </li>
        </ul>

        <!-- Bottom Logout -->
        <div class="user-sidebar-bottom">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-user-logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span>خروج از حساب کاربری</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT -->
    <main class="user-main">
        <!-- Top Bar -->
        <div class="user-topbar">
            <div style="display: flex; align-items: center; gap: 12px;">
                <button type="button" class="user-toggle-sidebar" onclick="toggleUserSidebar()" title="باز کردن منو">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div class="user-breadcrumb">
                    <span>سام موبایل</span>
                    <span>/</span>
                    <span>سامانه خدمات</span>
                    <span>/</span>
                    <strong id="userBreadcrumbTitle">دستگاه‌های من و پیگیری آنلاین</strong>
                </div>
            </div>

            <div>
                <button type="button" class="btn-table-action primary" onclick="switchUserTab('tab-new-request')">
                    + ثبت دستگاه جدید
                </button>
            </div>
        </div>

        <!-- KPI Summary Cards -->
        <div class="user-kpi-grid">
            <div class="u-kpi-card">
                <div class="u-kpi-val">{{ $stats['total'] }}</div>
                <div class="u-kpi-lbl">کل پرونده‌های شما</div>
            </div>
            <div class="u-kpi-card">
                <div class="u-kpi-val" style="color: #d97706;">{{ $stats['repairing'] }}</div>
                <div class="u-kpi-lbl">در حال تعمیر در کارگاه</div>
            </div>
            <div class="u-kpi-card">
                <div class="u-kpi-val" style="color: #16a34a;">{{ $stats['ready'] }}</div>
                <div class="u-kpi-lbl">آماده تحویل و ترخیص</div>
            </div>
            <div class="u-kpi-card">
                <div class="u-kpi-val" style="color: #7c3aed;">{{ $stats['delivered'] }}</div>
                <div class="u-kpi-lbl">تحویل نهایی شده</div>
            </div>
        </div>

        <!-- VIEW 1: MY DEVICES & TRACKING -->
        <div class="user-view active" id="tab-my-devices">
            @forelse($myOrders as $order)
                <div class="user-panel">
                    <div class="user-panel-header">
                        <div>
                            <strong style="font-size: 1.1rem; color: #0f172a;">{{ $order->device_brand }} {{ $order->device_model }}</strong>
                            <div style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">
                                کد رهگیری: <span style="font-family: monospace; font-weight: 800; color: #2563eb;">{{ $order->tracking_code }}</span> | 
                                شماره سریال (IMEI): <span style="font-family: monospace;">{{ $order->imei }}</span>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn-table-action primary" onclick="openWarrantyCardView('{{ $order->device_brand }} {{ $order->device_model }}', '{{ $order->imei }}')">
                                مشاهده کارت گارانتی ۱۸ ماهه
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
                            <div class="step-circle">۱</div>
                            <span class="step-label">پذیرش اولیه</span>
                        </div>
                        <div class="step-node {{ $curStep >= 2 ? ($curStep > 2 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">۲</div>
                            <span class="step-label">کارشناسی فنی</span>
                        </div>
                        <div class="step-node {{ $curStep >= 3 ? ($curStep > 3 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">۳</div>
                            <span class="step-label">تأمین قطعه و تعمیر</span>
                        </div>
                        <div class="step-node {{ $curStep >= 4 ? ($curStep > 4 ? 'completed' : 'active') : '' }}">
                            <div class="step-circle">۴</div>
                            <span class="step-label">کنترل کیفی و آماده</span>
                        </div>
                        <div class="step-node {{ $curStep >= 5 ? 'completed active' : '' }}">
                            <div class="step-circle">۵</div>
                            <span class="step-label">تحویل نهایی</span>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; font-size: 0.82rem; line-height: 1.8;">
                        <div style="margin-bottom: 4px;">
                            <strong>شرح ایراد اظهار شده:</strong> {{ $order->problem_description }}
                        </div>
                        @if(!empty($order->technician_report))
                            <div style="color: #0284c7; margin-bottom: 4px;">
                                <strong>گزارش کارشناسی کارگاه:</strong> {{ $order->technician_report }}
                            </div>
                        @endif
                        <div style="color: #64748b; font-size: 0.74rem;">
                            وضعیت پوشش: {{ $order->warranty_status == 'under_warranty' ? 'تحت پوشش گارانتی ۱۸ ماهه رسمی سام موبایل' : 'خدمات آزاد مطابق تعرفه مصوب اتحادیه' }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="user-panel" style="text-align: center; padding: 40px;">
                    <p style="color: #64748b; margin-bottom: 16px;">هنوز دستگاهی با شماره تلفن شما در سامانه ثبت نشده است.</p>
                    <button type="button" class="btn-table-action primary" onclick="switchUserTab('tab-new-request')">
                        ثبت اولین دستگاه برای دریافت خدمات
                    </button>
                </div>
            @endforelse
        </div>

        <!-- VIEW 2: SUBMIT NEW REPAIR REQUEST -->
        <div class="user-view" id="tab-new-request">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                        <span>ثبت درخواست پذیرش دستگاه جدید</span>
                    </div>
                </div>

                <form action="{{ url('/user-portal/store-order') }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">برند دستگاه *</label>
                            <select name="device_brand" class="form-select-custom" required>
                                <option value="Samsung">سامسونگ (Samsung)</option>
                                <option value="Xiaomi">شیائومی (Xiaomi)</option>
                                <option value="Apple">اپل (iPhone)</option>
                                <option value="Honor">آنر (Honor)</option>
                                <option value="Other">سایر برندها</option>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">مدل دقیق دستگاه *</label>
                            <input type="text" name="device_model" class="form-input-custom" placeholder="مثال: Galaxy S23 Ultra" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 16px;">
                        <div class="form-group-custom">
                            <label class="form-label-custom">شماره سریال (IMEI) دستگاه *</label>
                            <input type="text" name="imei" class="form-input-custom" placeholder="۱۵ رقم سریال" maxlength="15" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">وضعیت گارانتی</label>
                            <select name="warranty_status" class="form-select-custom">
                                <option value="under_warranty">دارای گارانتی ۱۸ ماهه سام موبایل</option>
                                <option value="out_of_warranty">تعمیر آزاد غیرگارانتی</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-custom" style="margin-top: 16px;">
                        <label class="form-label-custom">شرح کامل ایراد دستگاه *</label>
                        <textarea name="problem_description" class="form-textarea-custom" rows="3" placeholder="توضیح دهید دستگاه چه مشکلی دارد..." required></textarea>
                    </div>

                    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-table-action primary" style="padding: 12px 24px; font-size: 0.9rem;">
                            ارسال درخواست و دریافت کد رهگیری
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- VIEW 3: TICKETS -->
        <div class="user-view" id="tab-my-tickets">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>تیکت‌ها و مکاتبات پشتیبانی فنی</span>
                    </div>
                </div>

                <!-- New Ticket Form -->
                <form action="{{ url('/user-portal/send-ticket') }}" method="POST" style="margin-bottom: 24px; padding: 18px; border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0;">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div>
                            <label class="form-label-custom">موضوع تیکت *</label>
                            <input type="text" name="subject" class="form-input-custom" placeholder="مثال: سوال درباره زمان ترخیص دستگاه" required>
                        </div>
                        <div>
                            <label class="form-label-custom">اولویت</label>
                            <select name="priority" class="form-select-custom">
                                <option value="normal">عادی</option>
                                <option value="urgent">فوری</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 12px;">
                        <label class="form-label-custom">متن پیام *</label>
                        <textarea name="message" class="form-textarea-custom" rows="3" placeholder="پیام خود را به کارشناسان پشتیبانی بنویسید..." required></textarea>
                    </div>
                    <div style="margin-top: 14px; text-align: left;">
                        <button type="submit" class="btn-table-action primary">
                            ارسال تیکت به پشتیبانی
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myTickets as $t)
                                <tr>
                                    <td><code>#{{ $t->id }}</code></td>
                                    <td><strong>{{ $t->subject }}</strong></td>
                                    <td>{{ $t->created_at }}</td>
                                    <td>
                                        <span class="status-badge {{ $t->status == 'open' ? 'repairing' : 'ready_for_delivery' }}">
                                            {{ $t->status == 'open' ? 'در انتظار بررسی پشتیبان' : 'پاسخ داده شده' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #94a3b8; padding: 24px;">
                                        تیکتی یافت نشد.
                                    </td>
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
     DIGITAL WARRANTY CARD MODAL (ACCURATE TO ATTACHED IMAGE)
     ========================================================================= -->
<div class="warranty-modal-backdrop" id="userWarrantyModal">
    <div class="warranty-modal-box">
        <button type="button" class="btn-close-modal" onclick="closeWarrantyCardView()">&times;</button>
        
        <div style="text-align: center; margin-bottom: 14px;">
            <h3 style="font-size: 1.1rem; font-weight: 800; color: #ffffff; margin-bottom: 4px;">کارت گارانتی دیجیتال گوشی همراه</h3>
            <span style="font-size: 0.74rem; color: #94a3b8;">شرکت تامین کانی سام | گارانتی رسمی ۱۸ ماهه</span>
        </div>

        <!-- Realistic Card Replica (CSS Based) -->
        <div class="card-preview-wrapper" id="printableUserCard">
            <!-- Card Front -->
            <div style="background: linear-gradient(135deg, #021b44 0%, #0a3875 50%, #03204e 100%); border-radius: 16px; padding: 18px; color: #ffffff; margin-bottom: 16px; border: 1px solid rgba(255,255,255,0.15); position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.15); padding-bottom: 10px; margin-bottom: 12px;">
                    <div>
                        <strong style="font-size: 1.05rem; display: block; font-weight: 900;">کارت گارانتی گوشی همراه</strong>
                        <span style="font-size: 0.70rem; color: #93c5fd;">سام موبایل (تامین کانی سام)</span>
                    </div>
                    <div style="background: rgba(255,255,255,0.12); padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 800;">
                        ۱۸ ماه ضمانت طلایی
                    </div>
                </div>

                <div style="display: flex; gap: 14px; align-items: center;">
                    <div style="flex: 1; font-size: 0.78rem; line-height: 1.8;">
                        <p style="margin: 0 0 6px 0; color: #e2e8f0;">
                            <strong>همراه ما باشید:</strong> برای استعلام اصالت و شرایط گارانتی کد QR را اسکن کنید.
                        </p>
                        <p style="margin: 0; color: #cbd5e1; font-size: 0.72rem;">
                            <strong>شرایط گارانتی:</strong> این دستگاه به مدت ۱۸ ماه دارای گارانتی رسمی شرکت تامین کانی سام می‌باشد.
                        </p>
                    </div>
                    <div style="width: 80px; height: 80px; background: #ffffff; border-radius: 10px; padding: 4px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=72x72&data=https://mob.taminkanisam.co.ir" alt="QR" style="width: 72px; height: 72px; display: block;">
                    </div>
                </div>
                <div style="margin-top: 10px; font-size: 0.70rem; color: #60a5fa; font-weight: 800;">
                    انتخاب هوشمندانه...
                </div>
            </div>

            <!-- Card Back -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 16px; padding: 16px; color: #0f172a;">
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 6px; text-align: center; margin-bottom: 14px;">
                    <div style="background: #eff6ff; padding: 6px; border-radius: 8px; font-size: 0.68rem; font-weight: 800; color: #1d4ed8;">
                        🛡️ ۱۸ ماه ضمانت رسمی
                    </div>
                    <div style="background: #eff6ff; padding: 6px; border-radius: 8px; font-size: 0.68rem; font-weight: 800; color: #1d4ed8;">
                        ⚙️ خدمات پس از فروش
                    </div>
                    <div style="background: #eff6ff; padding: 6px; border-radius: 8px; font-size: 0.68rem; font-weight: 800; color: #1d4ed8;">
                        🎧 پشتیبانی حرفه‌ای
                    </div>
                </div>

                <table style="width: 100%; font-size: 0.74rem; border-collapse: collapse; margin-bottom: 12px;">
                    <tr>
                        <td style="padding: 4px; color: #64748b; width: 38%;">۱. برند و مدل کالا:</td>
                        <td style="padding: 4px; font-weight: 800;" id="userCardModel">Samsung Galaxy S23 Ultra</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; color: #64748b;">۲. شماره سریال (IMEI):</td>
                        <td style="padding: 4px; font-weight: 800; font-family: monospace;" id="userCardImei">354892019485721</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; color: #64748b;">۳. شرکت گارانتی کننده:</td>
                        <td style="padding: 4px; font-weight: 800;">تامین کانی سام (سام موبایل)</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; color: #64748b;">۴. مدت زمان گارانتی:</td>
                        <td style="padding: 4px; font-weight: 800;">۱۸ ماه کامل پس از فعال‌سازی</td>
                    </tr>
                </table>

                <div style="background: #0b192c; color: #ffffff; border-radius: 8px; padding: 8px 10px; font-size: 0.64rem; line-height: 1.6; margin-bottom: 10px;">
                    <strong style="color: #60a5fa; display: block; margin-bottom: 2px;">مواردی که شامل گارانتی نمی‌شوند:</strong>
                    ضربه دیدگی و شکستگی • نفوذ مایعات و رطوبت • تعمیرات توسط افراد غیرمجاز • خرابی ناشی از نوسانات برق • معیوب ماندن باتری در اثر لوازم جانبی غیراستاندارد
                </div>

                <div style="background: #021b44; color: #ffffff; border-radius: 8px; padding: 8px; font-size: 0.62rem; display: flex; flex-direction: column; gap: 4px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>📞 مرکز تماس: ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)</span>
                        <span>🌐 taminkanisam.co.ir</span>
                        <span>✉️ Marketing@kanisam</span>
                    </div>
                    <div style="color: #cbd5e1; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 3px;">
                        📍 تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 16px; display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn-table-action primary" onclick="window.print()">
                <span>چاپ کارت گارانتی</span>
            </button>
            <button type="button" class="btn-table-action" onclick="closeWarrantyCardView()" style="background:#334155; color:#ffffff; border-color:#475569;">
                بستن
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function switchUserTab(tabId, el) {
        document.querySelectorAll('.user-view').forEach(function(v) {
            v.classList.remove('active');
        });
        const target = document.getElementById(tabId);
        if (target) target.classList.add('active');

        if (el) {
            document.querySelectorAll('.user-nav-btn').forEach(function(b) {
                b.classList.remove('active');
            });
            el.classList.add('active');
            const title = el.querySelector('span:not(.user-nav-icon):not(.user-nav-left)')?.innerText || 'پنل کاربری';
            const bcrumb = document.getElementById('userBreadcrumbTitle');
            if (bcrumb) bcrumb.innerText = title;
        }

        if (window.innerWidth < 992) {
            toggleUserSidebar(false);
        }
    }

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
        if (model) document.getElementById('userCardModel').innerText = model;
        if (imei) document.getElementById('userCardImei').innerText = imei;
        document.getElementById('userWarrantyModal').classList.add('show');
    }

    function closeWarrantyCardView() {
        document.getElementById('userWarrantyModal').classList.remove('show');
    }
</script>
@endpush
