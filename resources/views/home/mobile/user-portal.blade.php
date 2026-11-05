@extends('home.mobile.layout')

@section('title', 'پنل اختصاصی مشتریان سام موبایل | سامانه خدمات')
@section('meta_description', 'پنل کاربری مشتریان سام موبایل جهت ثبت دستگاه جدید، پیگیری وضعیت تعمیر، مشاهده تایم‌لاین زنده و فاکتور رسمی اتحادیه.')

@push('styles')
<style>
    .user-portal-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 36px 20px 60px;
    }

    /* User Profile Bar */
    .user-profile-header {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        padding: 28px 32px;
        margin-bottom: 28px;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    .user-info-area {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .user-avatar-circle {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        font-size: 1.5rem;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border-primary);
    }
    .user-name-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .verified-sms-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--accent-emerald-light);
        color: var(--accent-emerald);
        font-size: 0.76rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: var(--radius-pill);
    }
    .user-phone-sub {
        font-size: 0.86rem;
        color: var(--text-muted);
        font-family: monospace;
        margin-top: 4px;
    }
    .user-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-user-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: var(--radius-md);
        font-size: 0.84rem;
        font-weight: 700;
        transition: all 0.2s;
    }
    .btn-user-logout {
        background: var(--bg-subtle);
        color: var(--accent-rose);
        border: 1px solid var(--border-light);
    }
    .btn-user-logout:hover {
        background: var(--accent-rose-light);
        border-color: var(--accent-rose);
    }
    .btn-switch-admin {
        background: var(--primary-light);
        color: var(--primary);
        border: 1px solid var(--border-primary);
    }

    /* Quick Stats Grid */
    .user-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }
    .user-stat-card {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: var(--shadow-sm);
    }
    .user-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .user-stat-val {
        font-size: 1.55rem;
        font-weight: 900;
        color: var(--text-main);
        line-height: 1.2;
    }
    .user-stat-lbl {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    /* Tabs Bar */
    .user-nav-tabs {
        display: flex;
        gap: 8px;
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        padding: 6px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-sm);
        overflow-x: auto;
    }
    .user-tab-btn {
        flex: 1;
        padding: 12px 18px;
        border-radius: 10px;
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        white-space: nowrap;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .user-tab-btn:hover {
        color: var(--primary);
        background: var(--bg-subtle);
    }
    .user-tab-btn.active {
        background: var(--primary);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
    }

    .user-tab-panel {
        display: none;
    }
    .user-tab-panel.active {
        display: block;
    }

    /* Device Card List */
    .device-order-card {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        padding: 26px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
    }
    .device-order-card:hover {
        border-color: var(--border-primary);
        box-shadow: var(--shadow-md);
    }
    .device-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        border-bottom: 1px solid var(--border-light);
        padding-bottom: 16px;
        margin-bottom: 18px;
    }
    .device-name-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-main);
    }
    .order-code-badge {
        font-family: monospace;
        font-weight: 800;
        background: var(--primary-light);
        color: var(--primary);
        padding: 4px 12px;
        border-radius: var(--radius-sm);
        font-size: 0.88rem;
    }
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: var(--radius-pill);
        font-size: 0.78rem;
        font-weight: 700;
    }

    /* 5-Stage Stepper */
    .user-stepper-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 24px 0 18px;
        position: relative;
    }
    .user-stepper-row::before {
        content: '';
        position: absolute;
        top: 18px;
        left: 36px;
        right: 36px;
        height: 3px;
        background: var(--border-light);
        z-index: 1;
    }
    .user-stepper-node {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        flex: 1;
        text-align: center;
    }
    .user-stepper-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid var(--border-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.82rem;
        color: var(--text-muted);
    }
    .user-stepper-node.done .user-stepper-circle {
        background: var(--accent-emerald);
        border-color: var(--accent-emerald);
        color: #ffffff;
    }
    .user-stepper-node.active .user-stepper-circle {
        background: var(--primary);
        border-color: var(--primary);
        color: #ffffff;
        box-shadow: 0 0 0 4px var(--primary-light);
    }
    .user-stepper-title {
        font-size: 0.76rem;
        font-weight: 700;
        color: var(--text-main);
    }

    .device-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        background: var(--bg-subtle);
        border-radius: var(--radius-md);
        padding: 16px;
        margin-top: 16px;
    }
    .device-info-cell-lbl {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 2px;
    }
    .device-info-cell-val {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-main);
    }

    /* Form Card */
    .form-box-card {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        padding: 32px;
        box-shadow: var(--shadow-sm);
    }
    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 16px;
    }
    .form-row-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 16px;
    }
    .custom-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-body);
        margin-bottom: 6px;
    }
    .custom-input, .custom-select, .custom-textarea {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        background: #ffffff;
        border: 1.5px solid var(--border-light);
        border-radius: var(--radius-md);
        font-size: 0.92rem;
        color: var(--text-main);
        outline: none;
        transition: all 0.2s;
    }
    .custom-textarea {
        height: 100px;
        padding: 12px 14px;
        resize: vertical;
    }
    .custom-input:focus, .custom-select:focus, .custom-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    /* Invoices Table */
    .invoices-table-wrap {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        overflow-x: auto;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: right;
        font-size: 0.88rem;
        white-space: nowrap;
    }
    .custom-table th {
        background: var(--bg-subtle);
        padding: 14px 18px;
        color: var(--text-muted);
        font-weight: 700;
        border-bottom: 1px solid var(--border-light);
    }
    .custom-table td {
        padding: 14px 18px;
        border-bottom: 1px solid var(--border-light);
        color: var(--text-body);
    }

    @media (max-width: 991px) {
        .user-stats-grid { grid-template-columns: repeat(2, 1fr); }
        .form-row-3, .form-row-2 { grid-template-columns: 1fr; }
        .device-info-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 640px) {
        .user-stats-grid { grid-template-columns: 1fr; }
        .user-stepper-title { font-size: 0.68rem; }
    }
</style>
@endpush

@section('content')
<div class="user-portal-container">

    <!-- Flash message -->
    @if(session('success'))
        <div style="background: var(--accent-emerald-light); border: 1px solid var(--accent-emerald); color: var(--accent-emerald); padding: 14px 18px; border-radius: var(--radius-md); font-weight: 700; margin-bottom: 24px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- User Profile Header -->
    <div class="user-profile-header">
        <div class="user-info-area">
            <div class="user-avatar-circle">
                {{ mb_substr($user ? $user->name : 'ک', 0, 1) }}
            </div>
            <div>
                <h2 class="user-name-title">
                    <span>{{ $user ? $user->name : 'کاربر سام موبایل' }}</span>
                    <span class="verified-sms-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>تایید پیامکی هویت</span>
                    </span>
                </h2>
                <div class="user-phone-sub">شماره همراه تایید شده: {{ $userPhone }}</div>
            </div>
        </div>

        <div class="user-header-actions">
            <a href="{{ route('mob.admin-portal') }}" class="btn-user-action btn-switch-admin" title="سوئیچ به پنل ادمین جهت تست">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                <span>نمایش پنل ادمین (تست)</span>
            </a>
            <a href="{{ route('mob.logout') }}" class="btn-user-action btn-user-logout">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                <span>خروج از حساب</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="user-stats-grid">
        <div class="user-stat-card">
            <div class="user-stat-icon" style="background: #eff6ff; color: #2563eb;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
            </div>
            <div>
                <div class="user-stat-val">{{ $stats['total'] }}</div>
                <div class="user-stat-lbl">کل دستگاه‌های ثبت‌شده</div>
            </div>
        </div>
        <div class="user-stat-card">
            <div class="user-stat-icon" style="background: #fffbeb; color: #d97706;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div>
                <div class="user-stat-val">{{ $stats['repairing'] }}</div>
                <div class="user-stat-lbl">در حال بررسی و تعمیر</div>
            </div>
        </div>
        <div class="user-stat-card">
            <div class="user-stat-icon" style="background: #ecfdf5; color: #059669;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div>
                <div class="user-stat-val">{{ $stats['ready'] }}</div>
                <div class="user-stat-lbl">آماده ترخیص / تحویل</div>
            </div>
        </div>
        <div class="user-stat-card">
            <div class="user-stat-icon" style="background: #f5f3ff; color: #7c3aed;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <div>
                <div class="user-stat-val">{{ $stats['delivered'] }}</div>
                <div class="user-stat-lbl">تحویل داده شده / اتمام</div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="user-nav-tabs">
        <button type="button" class="user-tab-btn active" id="tabDevicesBtn" onclick="switchUserTab('devices')">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
            <span>دستگاه‌های من و پیگیری زنده</span>
        </button>
        <button type="button" class="user-tab-btn" id="tabNewOrderBtn" onclick="switchUserTab('newOrder')">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>ثبت پذیرش دستگاه جدید</span>
        </button>
        <button type="button" class="user-tab-btn" id="tabInvoicesBtn" onclick="switchUserTab('invoices')">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span>فاکتورهای رسمی من</span>
        </button>
        <button type="button" class="user-tab-btn" id="tabSupportBtn" onclick="switchUserTab('support')">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span>پیام به کارشناس فنی</span>
        </button>
    </div>

    <!-- TAB 1: My Devices & Tracking -->
    <div class="user-tab-panel active" id="panelDevices">
        @forelse($myOrders as $order)
            @php
                $statusMap = [
                    'received' => ['label' => 'پذیرش اولیه شده', 'color' => '#0284c7', 'bg' => '#e0f2fe', 'step' => 1],
                    'inspecting' => ['label' => 'در حال کارشناسی فنی', 'color' => '#d97706', 'bg' => '#fef3c7', 'step' => 2],
                    'repairing' => ['label' => 'در حال تعمیر تخصصی', 'color' => '#2563eb', 'bg' => '#eff6ff', 'step' => 3],
                    'waiting_parts' => ['label' => 'در انتظار تامین قطعه', 'color' => '#d97706', 'bg' => '#fef3c7', 'step' => 3],
                    'ready_for_delivery' => ['label' => 'آماده تحویل / ترخیص', 'color' => '#059669', 'bg' => '#ecfdf5', 'step' => 4],
                    'delivered' => ['label' => 'تحویل داده شد (اتمام خدمت)', 'color' => '#059669', 'bg' => '#ecfdf5', 'step' => 5],
                    'cancelled' => ['label' => 'لغو شده', 'color' => '#e11d48', 'bg' => '#ffe4e6', 'step' => 0],
                ];
                $st = $statusMap[$order->status] ?? ['label' => $order->status, 'color' => '#64748b', 'bg' => '#f1f5f9', 'step' => 1];
            @endphp
            <div class="device-order-card">
                <div class="device-card-header">
                    <div>
                        <span class="order-code-badge">{{ $order->tracking_code }}</span>
                        <span class="device-name-title" style="margin-right: 10px;">{{ $order->device_brand }} {{ $order->device_model }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="status-pill" style="background: {{ $st['bg'] }}; color: {{ $st['color'] }};">
                            ● {{ $st['label'] }}
                        </span>
                        @if($order->is_under_warranty)
                            <span class="status-pill" style="background: #ecfdf5; color: #059669;">
                                گارانتی ۱۸ ماهه طلایی
                            </span>
                        @else
                            <span class="status-pill" style="background: #f1f5f9; color: #475569;">
                                خارج از گارانتی (تعرفه اتحادیه)
                            </span>
                        @endif
                    </div>
                </div>

                <!-- 5-Stage Stepper -->
                <div class="user-stepper-row">
                    <div class="user-stepper-node {{ $st['step'] >= 1 ? 'done' : '' }} {{ $st['step'] == 1 ? 'active' : '' }}">
                        <div class="user-stepper-circle">{{ $st['step'] > 1 ? '✓' : '۱' }}</div>
                        <div class="user-stepper-title">پذیرش اولیه</div>
                    </div>
                    <div class="user-stepper-node {{ $st['step'] >= 2 ? 'done' : '' }} {{ $st['step'] == 2 ? 'active' : '' }}">
                        <div class="user-stepper-circle">{{ $st['step'] > 2 ? '✓' : '۲' }}</div>
                        <div class="user-stepper-title">کارشناسی فنی</div>
                    </div>
                    <div class="user-stepper-node {{ $st['step'] >= 3 ? 'done' : '' }} {{ $st['step'] == 3 ? 'active' : '' }}">
                        <div class="user-stepper-circle">{{ $st['step'] > 3 ? '✓' : '۳' }}</div>
                        <div class="user-stepper-title">تعمیر / تامین قطعه</div>
                    </div>
                    <div class="user-stepper-node {{ $st['step'] >= 4 ? 'done' : '' }} {{ $st['step'] == 4 ? 'active' : '' }}">
                        <div class="user-stepper-circle">{{ $st['step'] > 4 ? '✓' : '۴' }}</div>
                        <div class="user-stepper-title">کنترل کیفی QC</div>
                    </div>
                    <div class="user-stepper-node {{ $st['step'] >= 5 ? 'done' : '' }} {{ $st['step'] == 5 ? 'active' : '' }}">
                        <div class="user-stepper-circle">{{ $st['step'] >= 5 ? '✓' : '۵' }}</div>
                        <div class="user-stepper-title">آماده ترخیص</div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="device-info-grid">
                    <div>
                        <div class="device-info-cell-lbl">شناسه IMEI</div>
                        <div class="device-info-cell-val" style="font-family: monospace;">{{ $order->imei }}</div>
                    </div>
                    <div>
                        <div class="device-info-cell-lbl">کارشناس فنی مسئول</div>
                        <div class="device-info-cell-val">{{ $order->assigned_technician ?: 'در صف ارجاع' }}</div>
                    </div>
                    <div>
                        <div class="device-info-cell-lbl">تاریخ تخمینی تکمیل</div>
                        <div class="device-info-cell-val">{{ $order->estimated_completion_date ?: 'اعلام ظرف ۴۸ ساعت' }}</div>
                    </div>
                    <div>
                        <div class="device-info-cell-lbl">هزینه نهایی خدمت</div>
                        <div class="device-info-cell-val" style="color: {{ $order->is_under_warranty ? '#059669' : '#0f172a' }};">
                            {{ $order->is_under_warranty ? 'رایگان (تحت گارانتی)' : number_format($order->total_cost) . ' ریال' }}
                        </div>
                    </div>
                </div>

                @if($order->technician_notes)
                    <div style="margin-top: 14px; background: #ffffff; border: 1px dashed var(--border-light); padding: 12px 14px; border-radius: var(--radius-sm); font-size: 0.85rem; color: var(--text-body);">
                        <strong>گزارش کارشناس فنی:</strong> {{ $order->technician_notes }}
                    </div>
                @endif

                <div style="margin-top: 16px; display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--border-light); padding-top: 12px;">
                    <button type="button" class="btn-light-primary" style="padding: 8px 18px; font-size: 0.84rem;" onclick="openWarrantyCardModal({
                        model: '{{ $order->device_brand }} {{ $order->device_model }}',
                        imei: '{{ $order->imei }}',
                        country: 'وارداتی رسمی (اصلی)',
                        startDate: '{{ $order->warranty_start_date ?: date('Y/m/d') }}',
                        maker: '{{ $order->device_brand }}'
                    })">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        <span>مشاهده و چاپ کارت گارانتی رسمی</span>
                    </button>
                </div>
            </div>
        @empty
            <div style="background: #ffffff; border: 1px dashed var(--border-light); padding: 48px; border-radius: var(--radius-lg); text-align: center;">
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 16px;">تاکنون دستگاهی به نام شما ثبت نشده است.</p>
                <button type="button" class="btn-light-primary" onclick="switchUserTab('newOrder')">
                    <span>ثبت اولین پذیرش دستگاه</span>
                </button>
            </div>
        @endforelse
    </div>

    <!-- TAB 2: Register New Device Intake -->
    <div class="user-tab-panel" id="panelNewOrder">
        <div class="form-box-card">
            <div style="margin-bottom: 24px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); margin-bottom: 6px;">ثبت درخواست پذیرش دستگاه جدید (ماده ۱۳)</h3>
                <p style="font-size: 0.86rem; color: var(--text-muted);">اطلاعات دستگاه خود را تکمیل نمایید تا کد رهگیری آنلاین و پیامک پذیرش خدمت صادر گردد.</p>
            </div>

            <form action="{{ route('mob.user.store-order') }}" method="POST">
                @csrf
                <div class="form-row-3">
                    <div>
                        <label class="custom-label">برند دستگاه <span style="color: red;">*</span></label>
                        <select name="device_brand" class="custom-select" required>
                            <option value="سامسونگ">سامسونگ (Samsung)</option>
                            <option value="شیائومی">شیائومی (Xiaomi)</option>
                            <option value="اپل">اپل (Apple)</option>
                            <option value="هواوی">هواوی (Huawei)</option>
                            <option value="آنر">آنر (Honor)</option>
                            <option value="سایر">سایر برندها</option>
                        </select>
                    </div>
                    <div>
                        <label class="custom-label">مدل دقیق دستگاه <span style="color: red;">*</span></label>
                        <input type="text" name="device_model" class="custom-input" placeholder="مثال: Galaxy S24 Ultra یا Xiaomi 14" required>
                    </div>
                    <div>
                        <label class="custom-label">کد ۱۵ رقمی IMEI دستگاه <span style="color: red;">*</span></label>
                        <input type="text" name="imei" class="custom-input" placeholder="شماره‌گیری *#06# روی گوشی" maxlength="16" style="direction: ltr; font-family: monospace;" required>
                    </div>
                </div>

                <div class="form-row-3">
                    <div>
                        <label class="custom-label">شماره سریال (Serial Number)</label>
                        <input type="text" name="serial_number" class="custom-input" placeholder="مندرج بر روی جعبه دستگاه" style="direction: ltr;">
                    </div>
                    <div>
                        <label class="custom-label">رنگ دستگاه</label>
                        <input type="text" name="color" class="custom-input" placeholder="مثال: مشکی تیتانیوم">
                    </div>
                    <div>
                        <label class="custom-label">وضعیت ظاهری و بدنه</label>
                        <input type="text" name="physical_condition" class="custom-input" placeholder="سالم بدون خط و خش / دارای ضربه">
                    </div>
                </div>

                <div class="form-row-2">
                    <div>
                        <label class="custom-label">روش تحویل دستگاه <span style="color: red;">*</span></label>
                        <select name="intake_type" class="custom-select" required>
                            <option value="in_person">تحویل حضوری در دفتر خدمات پس از فروش</option>
                            <option value="postal">ارسال از طریق پست پیشتاز با بیمه کامل (رایگان در گارانتی)</option>
                        </select>
                    </div>
                    <div>
                        <label class="custom-label">کد رهگیری پستی مرسوله (در صورت ارسال پستی)</label>
                        <input type="text" name="postal_tracking_code" class="custom-input" placeholder="بارکد ۲۴ رقمی پست پیشتاز" style="direction: ltr;">
                    </div>
                </div>

                <div style="margin-bottom: 18px;">
                    <label class="custom-label">شرح دقیق ایرادات فنی و اظهارات مشتری <span style="color: red;">*</span></label>
                    <textarea name="reported_issues" class="custom-textarea" placeholder="نقص فنی دقیق دستگاه را شرح دهید (مثلاً خاموش شدن هنگام بازی، عدم شارژ، پرش تصویر، شکستگی تاچ و...)" required></textarea>
                </div>

                <div class="form-row-2">
                    <div>
                        <label class="custom-label">استان و شهر سکونت</label>
                        <input type="text" name="customer_city" class="custom-input" placeholder="تهران / اصفهان / شیراز و...">
                    </div>
                    <div>
                        <label class="custom-label">آدرس کامل پستی جهت بازگشت دستگاه</label>
                        <input type="text" name="customer_address" class="custom-input" placeholder="خیابان، پلاک، واحد، کدپستی">
                    </div>
                </div>

                <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-light-primary" style="padding: 12px 36px;">
                        <span>ثبت رسمی درخواست پذیرش</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TAB 3: Official Invoices -->
    <div class="user-tab-panel" id="panelInvoices">
        <div class="invoices-table-wrap">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>شماره فاکتور</th>
                        <th>دستگاه</th>
                        <th>کد رهگیری</th>
                        <th>تاریخ صدور</th>
                        <th>هزینه قطعات</th>
                        <th>اجرت مصوب</th>
                        <th>مبلغ نهایی</th>
                        <th>وضعیت تسویه</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myOrders as $order)
                        <tr>
                            <td style="font-family: monospace; font-weight: 700;">{{ $order->invoice_number ?: 'INV-' . $order->tracking_code }}</td>
                            <td>{{ $order->device_brand }} {{ $order->device_model }}</td>
                            <td style="font-family: monospace;">{{ $order->tracking_code }}</td>
                            <td>{{ $order->invoice_date ?: date('Y/m/d') }}</td>
                            <td>{{ number_format($order->parts_cost) }} ریال</td>
                            <td>{{ number_format($order->labor_cost) }} ریال</td>
                            <td style="font-weight: 800; color: {{ $order->is_under_warranty ? '#059669' : '#0f172a' }};">
                                {{ $order->is_under_warranty ? '۰ ریال (معاف گارانتی)' : number_format($order->total_cost) . ' ریال' }}
                            </td>
                            <td>
                                @if($order->is_under_warranty || $order->is_paid)
                                    <span style="color: #059669; font-weight: 700;">✓ تسویه شده</span>
                                @else
                                    <span style="color: #d97706; font-weight: 700;">در انتظار پرداخت</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('mob.invoice-sample') }}" target="_blank" style="color: var(--primary); font-weight: 700;">
                                    مشاهده فاکتور رسمی
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 30px; color: var(--text-muted);">فاکتوری ثبت نشده است.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- TAB 4: Support & Tickets -->
    <div class="user-tab-panel" id="panelSupport">
        <div class="form-box-card" style="margin-bottom: 24px;">
            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-main); margin-bottom: 16px;">ارسال پیام مستقیم به کارشناس فنی</h3>
            <form action="{{ route('mob.user.send-ticket') }}" method="POST">
                @csrf
                <div class="form-row-2">
                    <div>
                        <label class="custom-label">دستگاه مربوطه (کد رهگیری)</label>
                        <select name="tracking_code" class="custom-select" required>
                            @foreach($myOrders as $ord)
                                <option value="{{ $ord->tracking_code }}">{{ $ord->tracking_code }} - {{ $ord->device_brand }} {{ $ord->device_model }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="custom-label">موضوع پیام</label>
                        <input type="text" name="subject" class="custom-input" placeholder="استعلام زمان تحویل / اضافه کردن ایراد" required>
                    </div>
                </div>
                <div style="margin-bottom: 16px;">
                    <label class="custom-label">متن پیام شما</label>
                    <textarea name="message" class="custom-textarea" placeholder="متن پیام خود را برای کارشناس بنویسید..." required></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-light-primary">
                        <span>ارسال پیام</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Ticket History -->
        @if($myTickets->isNotEmpty())
            <div class="form-box-card">
                <h4 style="font-size: 1rem; font-weight: 800; margin-bottom: 14px;">پیام‌های پیشین شما</h4>
                @foreach($myTickets as $t)
                    <div style="background: var(--bg-subtle); border-radius: var(--radius-md); padding: 16px; margin-bottom: 12px;">
                        <div style="display: flex; justify-content: space-between; font-size: 0.82rem; color: var(--text-muted); margin-bottom: 6px;">
                            <strong>{{ $t->subject }} (دستگاه: {{ $t->tracking_code }})</strong>
                            <span>{{ $t->created_at }}</span>
                        </div>
                        <p style="font-size: 0.88rem; color: var(--text-body); margin-bottom: 8px;">{{ $t->message }}</p>
                        @if($t->reply)
                            <div style="background: #ffffff; border-right: 3px solid var(--primary); padding: 10px 14px; border-radius: 6px; font-size: 0.84rem; color: var(--text-main);">
                                <strong>پاسخ کارشناس سام موبایل:</strong> {{ $t->reply }}
                            </div>
                        @else
                            <span style="font-size: 0.76rem; color: var(--accent-amber); font-weight: 700;">در صف پاسخگویی کارشناس</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@include('home.mobile.warranty-card-modal')
@endsection

@push('scripts')
<script>
    function switchUserTab(tab) {
        const tabs = ['devices', 'newOrder', 'invoices', 'support'];
        tabs.forEach(t => {
            const btn = document.getElementById('tab' + t.charAt(0).toUpperCase() + t.slice(1) + 'Btn');
            const panel = document.getElementById('panel' + t.charAt(0).toUpperCase() + t.slice(1));
            if (btn && panel) {
                if (t === tab) {
                    btn.classList.add('active');
                    panel.classList.add('active');
                } else {
                    btn.classList.remove('active');
                    panel.classList.remove('active');
                }
            }
        });
    }
</script>
@endpush
