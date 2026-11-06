@extends('home.mobile.portal-layout')

@section('title', 'پنل کاربری و پیگیری آنلاین خدمات | سام موبایل')
@section('header_title', 'میز کاربری مشتریان')

@php
    $activeTab = request()->query('tab', 'my-devices');
    if (!str_starts_with($activeTab, 'tab-')) {
        $activeTab = 'tab-' . $activeTab;
    }
@endphp

@push('styles')
<style>
    /* =========================================================================
       CUSTOMER PORTAL (100% PURE LIGHT THEME & APP EXPERIENCE)
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

    /* 1. CUSTOMER SIDEBAR */
    .user-sidebar {
        width: var(--sidebar-w);
        background: #ffffff;
        border-left: 1px solid var(--card-border);
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        margin: 12px;
        padding: 16px;
        position: sticky;
        top: 80px;
        height: fit-content;
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 100;
    }

    .customer-profile-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
        border-radius: 14px;
        margin-bottom: 16px;
    }
    .customer-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--primary-gradient);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.15rem;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        flex-shrink: 0;
    }
    .customer-name {
        font-size: 0.88rem;
        font-weight: 800;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .customer-phone {
        font-size: 0.72rem;
        color: #2563eb;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 2px;
    }

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
        width: 100%;
        padding: 11px 14px;
        border-radius: 12px;
        font-size: 0.84rem;
        font-weight: 700;
        color: #475569;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
        text-align: right;
        text-decoration: none;
    }
    .user-nav-btn:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
    .user-nav-btn.active {
        background: #eff6ff;
        color: #1d4ed8;
        border-color: #bfdbfe;
        font-weight: 800;
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
        flex: 1;
        padding: 16px 20px 40px;
        min-width: 0;
    }
    .user-topbar {
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
    .user-drawer-toggle {
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

    /* Views */
    .user-view {
        display: none;
        animation: fadeInView 0.25s ease-out forwards;
    }
    .user-view.active {
        display: block;
    }

    .user-panel {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.02);
    }
    .user-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        margin-bottom: 16px;
        border-bottom: 1px solid var(--card-border);
    }
    .user-panel-title {
        font-size: 1.02rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
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
            border-left: none;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
            transform: translateX(105%);
            z-index: 10000;
            overflow-y: auto;
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
        .user-drawer-toggle {
            display: flex;
        }
    }

    @media (max-width: 991px) {
        .user-topbar {
            display: none !important;
        }
        .user-container {
            flex-direction: column !important;
            padding-bottom: 110px !important;
        }
        .user-sidebar {
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
            transform: translateX(100%) !important;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s ease !important;
        }
        .user-sidebar.open {
            display: flex !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: translateX(0) !important;
        }
        .user-mobile-nav {
            display: flex !important;
        }
    }

    /* User Mobile Sticky Bottom Navigation */
    .user-mobile-nav {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100vw;
        max-width: 100vw;
        height: calc(64px + env(safe-area-inset-bottom, 0px));
        padding: 0 10px env(safe-area-inset-bottom, 0px) 10px;
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-top: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 -4px 20px rgba(15, 23, 42, 0.08);
        z-index: 99990;
        align-items: center;
        justify-content: space-around;
        direction: rtl;
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
        -webkit-tap-highlight-color: transparent;
    }
    .user-bottom-nav-item.active {
        color: #2563eb !important;
        font-weight: 900 !important;
    }
    .user-bottom-nav-item.active::before {
        content: '';
        position: absolute;
        top: 3px;
        width: 16px;
        height: 3px;
        border-radius: 99px;
        background: #2563eb;
    }

    </style>
@endpush

@section('content')
<div class="user-container">

    <!-- Mobile Drawer Overlay -->
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

        <!-- Navigation Links -->
        <ul class="user-nav-list">
            <li>
                <a href="{{ url('/user-portal') }}?tab=my-devices" class="user-nav-btn {{ $activeTab === 'tab-my-devices' ? 'active' : '' }}" data-tab="tab-my-devices" onclick="switchUserTab('tab-my-devices', this, event)">
                    <span class="user-nav-left">
                        <span class="user-nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></span>
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
                        <span class="user-nav-icon" style="color: #2563eb;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                        <span class="user-nav-title">کارت گارانتی دیجیتال</span>
                    </span>
                    <span class="user-nav-badge" style="background:#dbeafe; color:#1d4ed8;">۱۸ ماهه</span>
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
                    @if(count($myTickets) > 0)
                        <span class="user-nav-badge">{{ count($myTickets) }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <div style="margin-top: 24px; padding-top: 14px; border-top: 1px solid var(--card-border);">
            <a href="{{ url('/logout') }}" class="erp-logout-btn" style="text-decoration:none;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                <span>خروج از حساب</span>
            </a>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT -->
    <main class="user-main">
        <!-- Topbar -->
        <header class="user-topbar">
            <div style="display: flex; align-items: center; gap: 10px;">
                <button type="button" class="user-drawer-toggle" onclick="toggleUserSidebar()" title="منو">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div class="erp-breadcrumb">
                    <span>سام موبایل</span>
                    <span>/</span>
                    <span>ناحیه کاربری</span>
                    <span>/</span>
                    <strong id="userBreadcrumbTitle">دستگاه‌ها و پیگیری آنلاین</strong>
                </div>
            </div>

            <div style="display: flex; gap: 8px;">
                <button type="button" class="btn-quick-intake" onclick="switchUserTab('tab-new-request')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>ثبت پذیرش جدید</span>
                </button>
            </div>
        </header>

        <!-- PAGE 1: MY DEVICES (tab-my-devices) -->
        <div class="user-view {{ $activeTab === 'tab-my-devices' ? 'active' : '' }}" id="tab-my-devices" data-title="دستگاه‌ها و پیگیری آنلاین">
            <div class="user-panel-wrapper" id="tab-my-devices">
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
                        @if(!empty($order->technician_report ?? ($order->technician_diagnosis ?? null)))
                            <div style="color: #0284c7; margin-bottom: 4px;">
                                <strong>گزارش کارشناسی کارگاه:</strong> {{ $order->technician_report ?? ($order->technician_diagnosis ?? 'در دست بررسی کارشناسی') }}
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
        </div>

        <!-- PAGE 2: NEW REQUEST (tab-new-request) -->
        <div class="user-view {{ $activeTab === 'tab-new-request' ? 'active' : '' }}" id="tab-new-request" data-title="ثبت پذیرش دستگاه جدید">
            <div class="user-panel-wrapper" id="tab-new-request">
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
        </div>

        <!-- PAGE 3: DEDICATED WARRANTY CARD (tab-warranty-card) -->
        <div class="user-view {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" id="tab-warranty-card" data-title="کارت گارانتی دیجیتال">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>کارت گارانتی ۱۸ ماهه رسمی شما (صادره توسط تامین کانی سام)</span>
                    </div>
                    <div class="erp-panel-actions">
                        <button type="button" class="btn-quick-intake" onclick="window.print()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            <span>چاپ و ذخیره کارت</span>
                        </button>
                    </div>
                </div>

                @php
                    $firstOrder = $myOrders->first();
                @endphp

                <div style="max-width: 620px; margin: 0 auto;">
                    <!-- Front Card -->
                    <div class="official-card-front" style="background: linear-gradient(135deg, #021a3f 0%, #08336d 45%, #05418c 70%, #031c44 100%); border-radius: 20px; padding: 18px 20px; color: #ffffff; margin-bottom: 18px; border: 2px solid rgba(59, 130, 246, 0.4); box-shadow: 0 16px 36px rgba(2, 26, 63, 0.35); position: relative; overflow: hidden; min-height: 230px; display: flex; flex-direction: column; justify-content: space-between;">
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
                                        <div style="font-size: 0.68rem; color: #e2e8f0; line-height: 1.4;">برای استعلام اصالت و گارانتی رسمی، کد QR را اسکن فرمایید.</div>
                                    </div>
                                    <div style="width: 58px; height: 58px; background: #ffffff; border-radius: 8px; padding: 3px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=52x52&data=https://mob.taminkanisam.co.ir/track?imei={{ $firstOrder ? $firstOrder->imei : '' }}" alt="QR" style="width: 52px; height: 52px; display: block;">
                                    </div>
                                </div>

                                <div style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 8px 12px;">
                                    <div style="display: inline-block; background: #38bdf8; color: #021a3f; font-size: 0.64rem; font-weight: 900; padding: 2px 8px; border-radius: 99px; margin-bottom: 3px;">شرایط گارانتی</div>
                                    <div style="font-size: 0.68rem; color: #cbd5e1; line-height: 1.4;">این دستگاه به مدت ۱۸ ماه دارای گارانتی رسمی شرکت تامین کانی سام می‌باشد.</div>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; border-top: 1px solid rgba(255, 255, 255, 0.12); padding-top: 8px;">
                                <span style="font-size: 0.74rem; font-weight: 800; color: #60a5fa; letter-spacing: 0.5px;">انتخاب هوشمندانه...</span>
                                <span style="font-size: 0.65rem; color: #cbd5e1;">ضمانت اصالت و سلامت قطعات</span>
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
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;">{{ $firstOrder ? ($firstOrder->device_brand . ' ' . $firstOrder->device_model) : 'Samsung Galaxy S23 Ultra' }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۳. شماره سریال کالا (IMEI):</span>
                                        <span style="font-size: 0.74rem; font-weight: 900; font-family: monospace; color: #1d4ed8; direction: ltr;">{{ $firstOrder ? $firstOrder->imei : '354892019485721' }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۴. تاریخ شروع گارانتی:</span>
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;">{{ $firstOrder->warranty_start_date ?? ($firstOrder->reception_date ?? ($firstOrder->created_at ?? '۱۴۰۳/۰۸/۱۵')) }} (۱۸ ماه)</span>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 10px;">
                                        <span style="font-size: 0.70rem; color: #475569; font-weight: 700;">۵. نام شرکت سازنده کالا:</span>
                                        <span style="font-size: 0.72rem; font-weight: 900; color: #0f172a;">شرکت تامین کانی سام (سهامی خاص)</span>
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

        <!-- PAGE 4: MY INVOICES (tab-my-invoices) -->
        <div class="user-view {{ $activeTab === 'tab-my-invoices' ? 'active' : '' }}" id="tab-my-invoices" data-title="صورت‌حساب و فاکتورها">
            <div class="user-panel">
                <div class="user-panel-header">
                    <div class="user-panel-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        <span>صورت‌حساب‌های رسمی و هزینه‌های خدمات</span>
                    </div>
                    <div class="erp-panel-actions">
                        <a href="{{ url('/invoice-sample') }}" target="_blank" class="btn-table-action" style="background:#2563eb; color:#ffffff; border-color:#1d4ed8;">
                            نمونه فاکتور رسمی صمت &larr;
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
                                    <td>{{ $invOrder->invoice_date ?? ($invOrder->reception_date ?? substr($invOrder->created_at, 0, 10)) }}</td>
                                    <td>{{ number_format($invOrder->parts_cost) }} ریال</td>
                                    <td>{{ number_format($invOrder->wage_cost ?? ($invOrder->labor_cost ?? 0)) }} ریال</td>
                                    <td><strong style="color: #2563eb;">{{ number_format($invOrder->total_cost) }} ریال</strong></td>
                                    <td>
                                        @if($invOrder->is_paid)
                                            <span class="table-status-pill st-ready_for_delivery">تسویه‌شده / گارانتی</span>
                                        @else
                                            <span class="table-status-pill st-inspecting">در انتظار پرداخت</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/invoice-sample') }}" target="_blank" class="btn-table-action">
                                            مشاهده فاکتور
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 24px; color: #94a3b8;">
                                        تاکنون فاکتوری برای حساب کاربری شما صادر نشده است.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- PAGE 5: MY TICKETS (tab-my-tickets) -->
        <div class="user-view {{ $activeTab === 'tab-my-tickets' ? 'active' : '' }}" id="tab-my-tickets" data-title="پشتیبانی و تیکت‌ها">
            <div class="user-panel-wrapper" id="tab-my-tickets">
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
        </div>

    </main>
</div>

<!-- =========================================================================
     DIGITAL WARRANTY CARD MODAL (ACCURATE TO ATTACHED IMAGE)
     ========================================================================= -->



<!-- User Portal Mobile Sticky Bottom Bar -->
<nav class="user-mobile-nav" id="userMobileNav">
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-my-devices' ? 'active' : '' }}" onclick="switchUserTab('tab-my-devices', this, event)" data-tab="tab-my-devices">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
        <span>دستگاه‌ها</span>
    </button>
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-warranty-card' ? 'active' : '' }}" onclick="switchUserTab('tab-warranty-card', this, event)" data-tab="tab-warranty-card">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <span>کارت گارانتی</span>
    </button>
    <div class="admin-nav-center">
        <button type="button" class="admin-center-btn" onclick="switchUserTab('tab-new-request', this, event)" data-tab="tab-new-request" title="ثبت پذیرش جدید">
            <div class="admin-center-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.6"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
            <span class="admin-center-label">پذیرش جدید</span>
        </button>
    </div>
    <button type="button" class="user-bottom-nav-item {{ $activeTab === 'tab-my-invoices' ? 'active' : '' }}" onclick="switchUserTab('tab-my-invoices', this, event)" data-tab="tab-my-invoices">
        <div class="user-nav-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
        <span>فاکتورها</span>
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

    function closeWarrantyCardView() {
        switchUserTab('tab-my-devices');
    }
</script>
@endpush
