@extends('home.mobile.layout')

@section('title', 'سامانه مدیریت خدمات پس از فروش | سام موبایل (تامین کانی سام)')

@section('content')
<div class="container">
    <!-- Portal Header Banner -->
    <div class="portal-header-card">
        <div class="portal-title-area">
            <div class="portal-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>مطابق با ماده ۱۳ ضوابط اجرایی خدمات پس از فروش</span>
            </div>
            <h1>سامانه مدیریت خدمات پس از فروش (برای نمایندگان و شعب)</h1>
            <p>سیستم یکپارچه ثبت پذیرش، ارجاع، ردیابی آنلاین، سفارش قطعات از انبار مرکزی و صدور فاکتور نهایی</p>
        </div>

        <div class="portal-stats-bar">
            <div class="portal-stat-pill">
                <span class="num">{{ $stats['total'] }}</span>
                <span class="lbl">کل پرونده‌ها</span>
            </div>
            <div class="portal-stat-pill">
                <span class="num" style="color:#f59e0b;">{{ $stats['repairing'] + $stats['inspecting'] }}</span>
                <span class="lbl">در دست اقدام</span>
            </div>
            <div class="portal-stat-pill">
                <span class="num" style="color:#38bdf8;">{{ $stats['waiting_parts'] }}</span>
                <span class="lbl">در انتظار قطعه</span>
            </div>
            <div class="portal-stat-pill">
                <span class="num" style="color:#10b981;">{{ $stats['ready'] }}</span>
                <span class="lbl">آماده تحویل</span>
            </div>
            <div class="portal-stat-pill">
                <span class="num" style="color:#818cf8;">{{ $stats['delivered'] }}</span>
                <span class="lbl">تحویل شده</span>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs for the 5 Modules -->
    <div class="portal-nav-tabs">
        <button type="button" class="portal-tab-btn active" data-tab="tab-list">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>۱. ردیابی و مدیریت پرونده‌ها</span>
        </button>
        <button type="button" class="portal-tab-btn" data-tab="tab-new">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>۲. ثبت پذیرش جدید</span>
        </button>
        <button type="button" class="portal-tab-btn" data-tab="tab-referral">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
            <span>۳. ارجاع و تخصیص تکنسین</span>
        </button>
        <button type="button" class="portal-tab-btn" data-tab="tab-parts">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            <span>۴. سفارش قطعات از انبار</span>
        </button>
        <button type="button" class="portal-tab-btn" data-tab="tab-complete">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>۵. اتمام خدمت و صدور فاکتور</span>
        </button>
    </div>

    <!-- MODULE 1: Tracking & List of Orders -->
    <div class="portal-view-panel active" id="tab-list">
        <!-- Status Filter Pills -->
        <div class="filter-pills-row">
            <a href="{{ route('mob.service-portal', ['status' => 'all']) }}" class="filter-pill {{ empty($statusFilter) || $statusFilter === 'all' ? 'active' : '' }}">همه پرونده‌ها ({{ $stats['total'] }})</a>
            <a href="{{ route('mob.service-portal', ['status' => 'received']) }}" class="filter-pill {{ $statusFilter === 'received' ? 'active' : '' }}">پذیرش شده ({{ $stats['received'] }})</a>
            <a href="{{ route('mob.service-portal', ['status' => 'inspecting']) }}" class="filter-pill {{ $statusFilter === 'inspecting' ? 'active' : '' }}">در حال کارشناسی ({{ $stats['inspecting'] }})</a>
            <a href="{{ route('mob.service-portal', ['status' => 'waiting_parts']) }}" class="filter-pill {{ $statusFilter === 'waiting_parts' ? 'active' : '' }}">در انتظار قطعه ({{ $stats['waiting_parts'] }})</a>
            <a href="{{ route('mob.service-portal', ['status' => 'repairing']) }}" class="filter-pill {{ $statusFilter === 'repairing' ? 'active' : '' }}">در حال تعمیر ({{ $stats['repairing'] }})</a>
            <a href="{{ route('mob.service-portal', ['status' => 'ready_for_delivery']) }}" class="filter-pill {{ $statusFilter === 'ready_for_delivery' ? 'active' : '' }}">آماده تحویل ({{ $stats['ready'] }})</a>
            <a href="{{ route('mob.service-portal', ['status' => 'delivered']) }}" class="filter-pill {{ $statusFilter === 'delivered' ? 'active' : '' }}">تحویل داده شده ({{ $stats['delivered'] }})</a>
        </div>

        <!-- Orders Table / Grid -->
        <div class="orders-table-wrapper">
            <table class="portal-table">
                <thead>
                    <tr>
                        <th>کد پیگیری</th>
                        <th>نام مشتری</th>
                        <th>دستگاه و مدل</th>
                        <th>شناسه IMEI</th>
                        <th>وضعیت گارانتی</th>
                        <th>مرحله و وضعیت پرونده</th>
                        <th>تکنسین / واحد</th>
                        <th>تاریخ پذیرش</th>
                        <th>اقدامات سریع</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $item)
                        @php
                            $badgeClass = 'status-received';
                            $title = 'پذیرش شده';
                            if ($item->status === 'inspecting') { $badgeClass = 'status-inspecting'; $title = 'در حال کارشناسی'; }
                            elseif ($item->status === 'waiting_parts') { $badgeClass = 'status-parts'; $title = 'در انتظار قطعه'; }
                            elseif ($item->status === 'repairing') { $badgeClass = 'status-repairing'; $title = 'در حال تعمیر'; }
                            elseif ($item->status === 'ready_for_delivery') { $badgeClass = 'status-ready'; $title = 'آماده تحویل'; }
                            elseif ($item->status === 'delivered') { $badgeClass = 'status-delivered'; $title = 'تحویل داده شده'; }
                        @endphp
                        <tr>
                            <td>
                                <strong class="order-code">{{ $item->tracking_code }}</strong>
                                <div style="font-size:11px; color:var(--text-dim);">{{ $item->reception_branch }}</div>
                            </td>
                            <td>
                                <div style="font-weight:700; color:#fff;">{{ $item->customer_name }}</div>
                                <div style="font-size:12px; color:var(--text-muted); direction:ltr; text-align:right;">{{ $item->customer_phone }}</div>
                            </td>
                            <td>
                                <div style="font-weight:600; color:#e2e8f0;">{{ $item->device_brand }}</div>
                                <div style="font-size:12px; color:var(--text-muted);">{{ $item->device_model }}</div>
                            </td>
                            <td>
                                <span class="imei-tag">{{ $item->imei }}</span>
                            </td>
                            <td>
                                @if($item->warranty_status === 'in_warranty')
                                    <span class="warranty-badge valid">دارای گارانتی ۱۸ ماهه</span>
                                @else
                                    <span class="warranty-badge invalid">خارج از گارانتی</span>
                                @endif
                            </td>
                            <td>
                                <span class="portal-status-badge {{ $badgeClass }}">{{ $title }}</span>
                            </td>
                            <td>
                                <div style="color:#fff; font-size:13px; font-weight:600;">{{ $item->assigned_technician ?? 'تخصیص نیافته' }}</div>
                                <div style="font-size:11px; color:var(--text-dim);">{{ $item->assigned_department }}</div>
                            </td>
                            <td>
                                <span style="font-size:12.5px; color:var(--text-muted);">
                                    {{ function_exists('verta') ? verta($item->reception_date)->format('Y/m/d') : date('Y-m-d', strtotime($item->reception_date)) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btn-group">
                                    <button type="button" class="btn-table-action" onclick="showOrderDetails({{ json_encode($item) }})" title="مشاهده پرونده و صدور قبض">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                    <button type="button" class="btn-table-action action-refer" onclick="openReferralModal({{ $item->id }}, '{{ $item->tracking_code }}', '{{ $item->status }}')" title="ارجاع یا تغییر وضعیت">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                    </button>
                                    <button type="button" class="btn-table-action action-part" onclick="openPartModal({{ $item->id }}, '{{ $item->tracking_code }}')" title="سفارش قطعه از انبار">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center; padding: 40px; color:var(--text-muted);">
                                هیچ پرونده‌ای در این وضعیت یافت نشد.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div style="margin-top: 20px; display:flex; justify-content:center;">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <!-- MODULE 2: New Reception Intake Form -->
    <div class="portal-view-panel" id="tab-new">
        <div class="glass-card form-panel-card">
            <div class="panel-card-header">
                <div class="header-icon icon-cyan">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </div>
                <div>
                    <h2>ثبت آنلاین پذیرش دستگاه (صدور رسید رسمی پذیرش)</h2>
                    <p>ورود اطلاعات هویتی مشتری، شناسه دستگاه و عیوب اعلامی جهت صدور کد رهگیری سیستمی</p>
                </div>
            </div>

            <form id="newReceptionForm" onsubmit="submitReception(event)">
                <div class="form-section-title">۱. اطلاعات مشتری و تحویل‌دهنده</div>
                <div class="form-grid-3">
                    <div class="form-group">
                        <label>نام و نام خانوادگی مشتری *</label>
                        <input type="text" name="customer_name" required placeholder="مثال: محمدرضا کمالی">
                    </div>
                    <div class="form-group">
                        <label>شماره تماس همراه *</label>
                        <input type="tel" name="customer_phone" required placeholder="مثال: 09123456789" style="direction:ltr; text-align:right;">
                    </div>
                    <div class="form-group">
                        <label>کد ملی مشتری</label>
                        <input type="text" name="customer_national_code" placeholder="۱۰ رقم کد ملی" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label>استان</label>
                        <input type="text" name="customer_province" value="تهران">
                    </div>
                    <div class="form-group">
                        <label>شهرستان</label>
                        <input type="text" name="customer_city" value="تهران">
                    </div>
                    <div class="form-group">
                        <label>شعبه پذیرنده</label>
                        <select name="reception_branch">
                            <option value="دفتر مرکزی تهران">دفتر مرکزی تهران (میدان فردوسی)</option>
                            <option value="نمایندگی تبریز">نمایندگی تبریز</option>
                            <option value="نمایندگی اصفهان">نمایندگی اصفهان</option>
                            <option value="نمایندگی مشهد">نمایندگی مشهد</option>
                            <option value="نمایندگی شیراز">نمایندگی شیراز</option>
                            <option value="پذیرش پستی سراسر کشور">پذیرش پستی سراسر کشور</option>
                        </select>
                    </div>
                </div>

                <div class="form-section-title" style="margin-top: 24px;">۲. مشخصات دستگاه و پوشش گارانتی</div>
                <div class="form-grid-3">
                    <div class="form-group">
                        <label>برند دستگاه *</label>
                        <select name="device_brand" required>
                            <option value="سامسونگ (Samsung)">سامسونگ (Samsung)</option>
                            <option value="شیائومی (Xiaomi)">شیائومی (Xiaomi)</option>
                            <option value="اپل (Apple)">اپل (Apple)</option>
                            <option value="آنر (Honor)">آنر (Honor)</option>
                            <option value="موتورولا (Motorola)">موتورولا (Motorola)</option>
                            <option value="سایر برندها">سایر برندها</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>مدل دقیق دستگاه *</label>
                        <input type="text" name="device_model" required placeholder="مثال: Galaxy S24 Ultra یا Note 13">
                    </div>
                    <div class="form-group">
                        <label>رنگ دستگاه</label>
                        <input type="text" name="device_color" placeholder="مثال: مشکی تیتانیوم">
                    </div>
                    <div class="form-group">
                        <label>شناسه سریال IMEI (۱۵ رقم) *</label>
                        <input type="text" name="imei" required placeholder="۳۵۹۴۸۳۱۱۰..." maxlength="20" style="direction:ltr; text-align:right;">
                    </div>
                    <div class="form-group">
                        <label>شماره سریال کارتن (Serial No)</label>
                        <input type="text" name="serial_number" placeholder="اختیاری" style="direction:ltr; text-align:right;">
                    </div>
                    <div class="form-group">
                        <label>وضعیت گارانتی دستگاه *</label>
                        <select name="warranty_status" required>
                            <option value="in_warranty">تحت پوشش گارانتی ۱۸ ماهه سام موبایل (رایگان)</option>
                            <option value="out_of_warranty">خارج از دوره گارانتی / ابطال گارانتی (با اخذ هزینه)</option>
                        </select>
                    </div>
                </div>

                <div class="form-section-title" style="margin-top: 24px;">۳. شرح ایرادات اظهارشده و وضعیت فیزیکی</div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>شرح دقیق مشکل از زبان مشتری *</label>
                        <textarea name="problem_description" rows="3" required placeholder="علت مراجعه، چگونگی بروز عیب و توضیحات مشتری را به صورت کامل شرح دهید..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>وضعیت ظاهری دستگاه (خط و خش، ضربه و...)</label>
                        <textarea name="appearance_condition" rows="3" placeholder="بررسی دقیق بدنه، شیشه دوربین و ال‌سی‌دی (مثال: دارای خط و خش جزیی در قاب پشت، بدون شکستگی)..."></textarea>
                    </div>
                </div>

                <div class="form-grid-2" style="margin-top: 14px;">
                    <div class="form-group">
                        <label>اقلام همراه تحویلی</label>
                        <input type="text" name="accessories_included" placeholder="مثال: جعبه دستگاه + کارت گارانتی (کابل، شارژر و سیم‌کارت تحویل گرفته نشد)">
                    </div>
                    <div class="form-group">
                        <label>ارجاع اولیه به واحد فنی</label>
                        <select name="assigned_department">
                            <option value="بخش سخت‌افزار و تعویض قطعه">بخش سخت‌افزار و تعویض قطعه</option>
                            <option value="بخش نرم‌افزار، پروگرم و فلش">بخش نرم‌افزار، پروگرم و فلش</option>
                            <option value="بخش مادربرد و آی‌سی">بخش مادربرد و آی‌سی</option>
                            <option value="بخش کنترل کیفیت (QC)">بخش کنترل کیفیت (QC)</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top: 30px; display:flex; justify-content:flex-end; gap:12px;">
                    <button type="submit" class="btn-glow" style="padding: 14px 36px;">
                        <span>ثبت قطعی پذیرش و صدور رسید رسمی</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODULE 3: Referral & Assignment Info -->
    <div class="portal-view-panel" id="tab-referral">
        <div class="glass-card form-panel-card">
            <div class="panel-card-header">
                <div class="header-icon icon-indigo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                </div>
                <div>
                    <h2>ارجاع و گردش کار پرونده‌ها (ماده ۱۳ ضوابط صمت)</h2>
                    <p>تخصیص هوشمند پرونده به تکنسین، ثبت نتایج کارشناسی عیب و به‌روزرسانی لحظه‌ای وضعیت</p>
                </div>
            </div>

            <div class="guide-box">
                <p>
                    <strong>راهنما:</strong> برای ارجاع یا تغییر وضعیت هر پرونده، در تب «۱. ردیابی و مدیریت پرونده‌ها» بر روی آیکون ارجاع 
                    <span style="display:inline-flex; vertical-align:middle; padding:3px; background:rgba(99,102,241,0.2); border-radius:6px; color:#818cf8;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </span>
                    کلیک نمایید تا پنجره تغییر وضعیت، تخصیص تکنسین و ثبت دستور کار فنی باز شود.
                </p>
            </div>

            <div class="workflow-steps-display">
                <div class="wf-step">
                    <div class="wf-dot">۱</div>
                    <div class="wf-title">پذیرش اولیه</div>
                    <div class="wf-desc">صدور رسید و کد پیگیری</div>
                </div>
                <div class="wf-step">
                    <div class="wf-dot">۲</div>
                    <div class="wf-title">کارشناسی و عیب‌یابی</div>
                    <div class="wf-desc">بررسی فنی ظرف ۲ روز کاری</div>
                </div>
                <div class="wf-step">
                    <div class="wf-dot">۳</div>
                    <div class="wf-title">تأمین قطعه و تعمیر</div>
                    <div class="wf-desc">سفارش قطعه اورجینال از انبار</div>
                </div>
                <div class="wf-step">
                    <div class="wf-dot">۴</div>
                    <div class="wf-title">کنترل کیفی (QC)</div>
                    <div class="wf-desc">تست کامل کارکرد قطعات</div>
                </div>
                <div class="wf-step">
                    <div class="wf-dot">۵</div>
                    <div class="wf-title">صدور فاکتور و ترخیص</div>
                    <div class="wf-desc">تحویل کالا با ضمانت ۶ ماهه</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODULE 4: Spare Parts Orders from Central Inventory -->
    <div class="portal-view-panel" id="tab-parts">
        <div class="glass-card form-panel-card">
            <div class="panel-card-header">
                <div class="header-icon icon-emerald">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
                <div>
                    <h2>سفارش قطعات یدکی از انبار مرکزی سام موبایل</h2>
                    <p>تأمین قطعات اورجینال دارای استاندارد ملی و کارخانه‌ای با گارانتی ۶ ماهه</p>
                </div>
            </div>

            <div class="parts-catalog-grid">
                <div class="part-item-box">
                    <div class="part-name">تاچ و ال‌سی‌دی اورجینال روکاری Galaxy S24 Ultra</div>
                    <div class="part-no">پارت نامبر: GH96-16281A</div>
                    <div class="part-price">۱۴,۵۰۰,۰۰۰ تومان</div>
                    <div class="part-stock in-stock">موجود در انبار مرکزی تهران (۱۵ عدد)</div>
                </div>
                <div class="part-item-box">
                    <div class="part-name">باتری اورجینال شرکتی Redmi Note 13 Pro+</div>
                    <div class="part-no">پارت نامبر: BN5J-ORIGINAL</div>
                    <div class="part-price">۱,۴۵۰,۰۰۰ تومان</div>
                    <div class="part-stock in-stock">موجود در انبار مرکزی تهران (۴۲ عدد)</div>
                </div>
                <div class="part-item-box">
                    <div class="part-name">فلت شارژ و میکروفن iPhone 13</div>
                    <div class="part-no">پارت نامبر: APL-IP13-FLX-CHG</div>
                    <div class="part-price">۱,۸۵۰,۰۰۰ تومان</div>
                    <div class="part-stock in-stock">موجود در انبار مرکزی تهران (۲۸ عدد)</div>
                </div>
                <div class="part-item-box">
                    <div class="part-name">ماژول دوربین اصلی ۶۴ مگاپیکسل گلکسی A54</div>
                    <div class="part-no">پارت نامبر: GH96-CAM-A54</div>
                    <div class="part-price">۲,۹۰۰,۰۰۰ تومان</div>
                    <div class="part-stock in-stock">موجود در انبار مرکزی تهران (۱۹ عدد)</div>
                </div>
            </div>

            <div style="margin-top: 24px; text-align: center; color: var(--text-muted); font-size: 13.5px;">
                جهت ثبت سفارش قطعه برای هر پرونده، در جدول پرونده‌ها بر روی دکمه جعبه قطعات کلیک فرمایید تا هزینه و پارت‌نامبر قطعه به صورت برخط در فاکتور پرونده درج گردد.
            </div>
        </div>
    </div>

    <!-- MODULE 5: Complete & Invoice Sample -->
    <div class="portal-view-panel" id="tab-complete">
        <div class="glass-card form-panel-card">
            <div class="panel-card-header">
                <div class="header-icon icon-amber">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div>
                    <h2>اتمام خدمت، صدور فاکتور قطعی و گواهی ضمانت ۶ ماهه</h2>
                    <p>مطابق ماده ۱۶ ضوابط اجرایی: صدور صورتحساب دقیق شامل قطعات، اجرت، عیوب و تضمین خدمت</p>
                </div>
            </div>

            <div class="invoice-summary-banner">
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                    <div>
                        <h3 style="color:#fff; font-size:18px; margin-bottom:4px;">صدور صورتحساب خدمات مطابق الگوی رسمی اتحادیه و دارایی</h3>
                        <p style="color:var(--text-muted); font-size:13.5px;">کلیه قطعات تعویض شده و خدمات فنی ارائه‌شده تا ۶ ماه دارای ضمانت تعویض مجدد می‌باشند.</p>
                    </div>
                    <a href="{{ route('mob.invoice-sample') }}" class="btn-glow" target="_blank">
                        <span>مشاهده فرم نمونه فاکتور رسمی</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Referral & Status Modal -->
<div class="modal-overlay" id="referralModal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3>ارجاع و به‌روزرسانی پرونده <span id="modalOrderCode" style="color:var(--primary);"></span></h3>
            <button type="button" class="modal-close-btn" onclick="closeModal('referralModal')">&times;</button>
        </div>
        <form id="referralForm" onsubmit="submitReferral(event)">
            <input type="hidden" id="modalOrderId" name="order_id">
            <div class="form-group">
                <label>مرحله و وضعیت پرونده *</label>
                <select id="modalStatus" name="status" required>
                    <option value="received">پذیرش اولیه</option>
                    <option value="inspecting">در حال کارشناسی و عیب‌یابی فنی</option>
                    <option value="waiting_parts">در انتظار تأمین قطعه اورجینال از انبار</option>
                    <option value="repairing">در حال تعمیر توسط تکنسین</option>
                    <option value="qc_testing">کنترل کیفیت (QC) و تست نهایی</option>
                    <option value="ready_for_delivery">آماده تحویل به مشتری</option>
                    <option value="delivered">تحویل داده شده</option>
                    <option value="rejected">عدم تایید / ابطال گارانتی</option>
                </select>
            </div>
            <div class="form-group">
                <label>تکنسین مسئول پرونده</label>
                <input type="text" id="modalTechnician" name="assigned_technician" placeholder="مثال: مهندس کاظمی">
            </div>
            <div class="form-group">
                <label>واحد ارجاع شونده</label>
                <input type="text" id="modalDepartment" name="assigned_department" placeholder="بخش سخت‌افزار">
            </div>
            <div class="form-group">
                <label>تشخیص عیب توسط کارشناس (تبصره ۵ ماده ۱۳)</label>
                <textarea id="modalDiagnosis" name="technician_diagnosis" rows="2" placeholder="گزارش دقیق عیب مشاهده‌شده..."></textarea>
            </div>
            <div class="form-group">
                <label>اقدامات تعمیراتی انجام شده</label>
                <textarea id="modalActions" name="repaired_actions" rows="2" placeholder="شرح خدمات انجام شده..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('referralModal')">انصراف</button>
                <button type="submit" class="btn-glow">ذخیره تغییرات سیستمی</button>
            </div>
        </form>
    </div>
</div>

<!-- Order Details & Reception Slip Modal -->
<div class="modal-overlay" id="detailsModal">
    <div class="modal-dialog" style="max-width: 680px;">
        <div class="modal-header">
            <h3>قبض رسمی پذیرش دستگاه <span id="detailOrderCode" style="color:var(--primary);"></span></h3>
            <button type="button" class="modal-close-btn" onclick="closeModal('detailsModal')">&times;</button>
        </div>
        <div class="modal-body" id="slipContent">
            <!-- Rendered by JS -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-outline" onclick="closeModal('detailsModal')">بستن</button>
            <button type="button" class="btn-glow" onclick="window.print()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                <span>چاپ قبض پذیرش</span>
            </button>
        </div>
    </div>
</div>

<!-- Spare Part Order Modal -->
<div class="modal-overlay" id="partModal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3>درخواست قطعه از انبار برای پرونده <span id="partOrderCode" style="color:var(--primary);"></span></h3>
            <button type="button" class="modal-close-btn" onclick="closeModal('partModal')">&times;</button>
        </div>
        <form id="orderPartForm" onsubmit="submitPartOrder(event)">
            <input type="hidden" id="partOrderId" name="order_id">
            <div class="form-group">
                <label>نام قطعه یدکی مورد نیاز *</label>
                <input type="text" id="partName" name="part_name" required placeholder="مثال: تاچ و ال‌سی‌دی اورجینال روکاری">
            </div>
            <div class="form-group">
                <label>پارت نامبر قطعه (Part Number)</label>
                <input type="text" id="partNo" name="part_no" placeholder="مثال: GH96-16281A" style="direction:ltr; text-align:right;">
            </div>
            <div class="form-group">
                <label>هزینه قطعه (تومان) *</label>
                <input type="number" id="partCost" name="cost" required placeholder="مثال: 1850000">
                <small style="color:var(--text-dim); display:block; margin-top:4px;">در صورت داشتن گارانتی فعال، هزینه قطعه برای مشتری صفر لحاظ خواهد شد.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('partModal')">انصراف</button>
                <button type="submit" class="btn-glow">ثبت سفارش در انبار مرکزی</button>
            </div>
        </form>
    </div>
</div>
@include('home.mobile.warranty-card-modal')
@endsection

@push('styles')
<style>
    .portal-header-card {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 24px;
        padding: 32px;
        margin-bottom: 26px;
        box-shadow: var(--shadow-sm);
    }
    .portal-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        background: rgba(56, 189, 248, 0.15);
        color: var(--primary);
        border: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .portal-title-area h1 {
        font-size: 26px;
        font-weight: 900;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .portal-title-area p {
        font-size: 14px;
        color: var(--text-muted);
    }
    .portal-stats-bar {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--border-light);
    }
    .portal-stat-pill {
        background: var(--bg-subtle);
        border: 1px solid var(--border-light);
        border-radius: 14px;
        padding: 12px;
        text-align: center;
    }
    .portal-stat-pill .num {
        font-size: 22px;
        font-weight: 900;
        color: var(--text-main);
        display: block;
        line-height: 1.2;
    }
    .portal-stat-pill .lbl {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
    }

    /* Tabs */
    .portal-nav-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
        overflow-x: auto;
        padding-bottom: 6px;
    }
    .portal-tab-btn {
        background: #ffffff;
        border: 1px solid var(--border-light);
        color: var(--text-muted);
        padding: 12px 20px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        transition: all 0.2s;
    }
    .portal-tab-btn:hover {
        color: var(--text-main);
        background: var(--bg-subtle);
    }
    .portal-tab-btn.active {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.25), rgba(2, 132, 199, 0.35));
        border-color: rgba(56, 189, 248, 0.5);
        color: var(--text-main);
        box-shadow: 0 4px 18px rgba(56, 189, 248, 0.2);
    }

    .portal-view-panel {
        display: none;
        animation: fadeIn 0.25s ease;
    }
    .portal-view-panel.active {
        display: block;
    }

    /* Filter Pills */
    .filter-pills-row {
        display: flex;
        gap: 8px;
        margin-bottom: 18px;
        overflow-x: auto;
        padding-bottom: 4px;
    }
    .filter-pill {
        padding: 7px 14px;
        border-radius: 10px;
        background: var(--bg-subtle);
        border: 1px solid var(--border-light);
        color: var(--text-muted);
        font-size: 12.5px;
        font-weight: 600;
        white-space: nowrap;
    }
    .filter-pill.active, .filter-pill:hover {
        background: rgba(56, 189, 248, 0.15);
        border-color: rgba(56, 189, 248, 0.35);
        color: var(--text-main);
    }

    /* Table */
    .orders-table-wrapper {
        background: var(--bg-card);
        border: 1px solid var(--border-light);
        border-radius: 20px;
        overflow-x: auto;
        backdrop-filter: blur(12px);
    }
    .portal-table {
        width: 100%;
        border-collapse: collapse;
        text-align: right;
        font-size: 13.5px;
        white-space: nowrap;
    }
    .portal-table th {
        background: var(--bg-subtle);
        padding: 14px 16px;
        color: var(--text-muted);
        font-weight: 700;
        border-bottom: 1px solid var(--border-light);
    }
    .portal-table td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        vertical-align: middle;
    }
    .portal-table tr:hover {
        background: #f8fafc;
    }
    .order-code {
        color: #38bdf8;
        font-family: monospace;
        font-size: 14px;
    }
    .imei-tag {
        font-family: monospace;
        background: rgba(255, 255, 255, 0.05);
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 12px;
        color: var(--text-body);
    }
    .warranty-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 12px;
    }
    .warranty-badge.valid { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .warranty-badge.invalid { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }

    .portal-status-badge {
        font-size: 11.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 12px;
        display: inline-block;
    }
    .status-received { background: rgba(148, 163, 184, 0.15); color: #cbd5e1; }
    .status-inspecting { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
    .status-parts { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }
    .status-repairing { background: rgba(129, 140, 248, 0.15); color: #818cf8; }
    .status-ready { background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.4); }
    .status-delivered { background: rgba(99, 102, 241, 0.2); color: #a5b4fc; }

    .action-btn-group {
        display: flex;
        gap: 6px;
    }
    .btn-table-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-light);
        color: var(--text-main);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-table-action:hover {
        background: rgba(56, 189, 248, 0.2);
        border-color: #38bdf8;
        color: #38bdf8;
    }
    .btn-table-action.action-refer:hover {
        background: rgba(99, 102, 241, 0.2);
        border-color: #818cf8;
        color: #818cf8;
    }
    .btn-table-action.action-part:hover {
        background: rgba(16, 185, 129, 0.2);
        border-color: #10b981;
        color: #10b981;
    }

    /* Forms */
    .form-panel-card {
        padding: 36px;
    }
    .panel-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
        border-bottom: 1px solid var(--border-light);
        padding-bottom: 20px;
    }
    .header-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .panel-card-header h2 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-main);
    }
    .panel-card-header p {
        font-size: 13.5px;
        color: var(--text-muted);
    }
    .form-section-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 16px;
        position: relative;
        padding-right: 12px;
    }
    .form-section-title::before {
        content: '';
        position: absolute;
        right: 0;
        top: 4px;
        bottom: 4px;
        width: 4px;
        background: var(--primary);
        border-radius: 4px;
    }
    .form-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }
    .form-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .form-group label {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--text-body);
    }
    .form-group input, .form-group select, .form-group textarea {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 12px;
        padding: 11px 14px;
        color: var(--text-main);
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 16px rgba(56, 189, 248, 0.25);
    }
    .guide-box {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 24px;
        color: var(--text-body);
        font-size: 14px;
    }

    /* Workflow steps */
    .workflow-steps-display {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-top: 24px;
    }
    .wf-step {
        background: #f8fafc;
        border: 1px solid var(--border-light);
        border-radius: 14px;
        padding: 16px;
        text-align: center;
    }
    .wf-dot {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--primary);
        color: #000;
        font-weight: 900;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }
    .wf-title { font-weight: 700; color: var(--text-main); font-size: 13.5px; margin-bottom: 4px; }
    .wf-desc { font-size: 11.5px; color: var(--text-dim); }

    /* Parts catalog */
    .parts-catalog-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
    .part-item-box {
        background: var(--bg-subtle);
        border: 1px solid var(--border-light);
        border-radius: 16px;
        padding: 20px;
    }
    .part-name { font-weight: 800; font-size: 15px; color: var(--text-main); margin-bottom: 6px; }
    .part-no { font-family: monospace; font-size: 12px; color: var(--text-dim); margin-bottom: 8px; }
    .part-price { font-size: 16px; font-weight: 800; color: #10b981; margin-bottom: 6px; }
    .part-stock { font-size: 12px; font-weight: 600; }
    .part-stock.in-stock { color: #38bdf8; }

    /* Modals */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(8px);
        z-index: 10005;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-overlay.open {
        display: flex;
    }
    .modal-dialog {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 22px;
        width: 100%;
        max-width: 550px;
        padding: 28px;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.7);
        max-height: 90vh;
        overflow-y: auto;
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border-light);
        padding-bottom: 14px;
    }
    .modal-header h3 { font-size: 17px; font-weight: 800; color: var(--text-main); }
    .modal-close-btn { background: none; border: none; font-size: 24px; color: var(--text-muted); cursor: pointer; }
    .modal-close-btn:hover { color: var(--text-main); }
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 22px;
        border-top: 1px solid var(--border-light);
        padding-top: 16px;
    }

    @media (max-width: 900px) {
        .portal-stats-bar { grid-template-columns: repeat(3, 1fr); }
        .form-grid-3 { grid-template-columns: 1fr; }
        .form-grid-2 { grid-template-columns: 1fr; }
        .workflow-steps-display { grid-template-columns: 1fr; }
        .parts-catalog-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Tab switching
    const tabBtns = document.querySelectorAll('.portal-tab-btn');
    const viewPanels = document.querySelectorAll('.portal-view-panel');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            viewPanels.forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            const target = document.getElementById(btn.getAttribute('data-tab'));
            if (target) target.classList.add('active');
        });
    });

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    // 1. Submit New Reception
    function submitReception(e) {
        e.preventDefault();
        const form = document.getElementById('newReceptionForm');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        fetch('{{ route("mob.portal.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert(`پذیرش با موفقیت ثبت شد!\nکد رهگیری اختصاصی: ${res.tracking_code}\nرسید رسمی برای مشتری صادر گردید.`);
                window.location.reload();
            } else {
                alert(res.message || 'خطا در ثبت پذیرش');
            }
        })
        .catch(err => {
            alert('خطای ارتباط با سرور.');
        });
    }

    // 2. Open Referral Modal
    function openReferralModal(orderId, orderCode, currentStatus) {
        document.getElementById('modalOrderId').value = orderId;
        document.getElementById('modalOrderCode').innerText = orderCode;
        document.getElementById('modalStatus').value = currentStatus;
        document.getElementById('referralModal').classList.add('open');
    }

    function submitReferral(e) {
        e.preventDefault();
        const orderId = document.getElementById('modalOrderId').value;
        const formData = new FormData(document.getElementById('referralForm'));
        const data = Object.fromEntries(formData.entries());

        fetch(`{{ url('mob/service-portal') }}/${orderId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert('تغییر وضعیت و ارجاع پرونده با موفقیت ذخیره گردید.');
                window.location.reload();
            } else {
                alert(res.message || 'خطا');
            }
        });
    }

    // 3. Open Part Modal
    function openPartModal(orderId, orderCode) {
        document.getElementById('partOrderId').value = orderId;
        document.getElementById('partOrderCode').innerText = orderCode;
        document.getElementById('partModal').classList.add('open');
    }

    function submitPartOrder(e) {
        e.preventDefault();
        const orderId = document.getElementById('partOrderId').value;
        const formData = new FormData(document.getElementById('orderPartForm'));
        const data = Object.fromEntries(formData.entries());

        fetch(`{{ url('mob/service-portal') }}/${orderId}/order-part`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'خطا');
            }
        });
    }

    // 4. Show Details & Reception Slip
    function showOrderDetails(order) {
        document.getElementById('detailOrderCode').innerText = order.tracking_code;
        const body = document.getElementById('slipContent');
        body.innerHTML = `
            <div style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:20px; font-size:13.5px;">
                <div style="text-align:center; margin-bottom:16px; border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:12px;">
                    <h4 style="color:#fff; font-size:16px; font-weight:800;">رسید پذیرش خدمات پس از فروش سام موبایل</h4>
                    <div style="font-size:12px; color:var(--text-muted);">شرکت بازرگانی تامین کانی سام | شعبه: ${order.reception_branch}</div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:14px;">
                    <div><strong>کد رهگیری:</strong> <span style="color:#38bdf8;">${order.tracking_code}</span></div>
                    <div><strong>تاریخ پذیرش:</strong> ${order.reception_date}</div>
                    <div><strong>نام مشتری:</strong> ${order.customer_name}</div>
                    <div><strong>تلفن:</strong> ${order.customer_phone}</div>
                    <div><strong>دستگاه:</strong> ${order.device_brand} ${order.device_model}</div>
                    <div><strong>شناسه IMEI:</strong> ${order.imei}</div>
                    <div><strong>پوشش گارانتی:</strong> ${order.warranty_status === 'in_warranty' ? 'دارای گارانتی ۱۸ ماهه' : 'خارج از گارانتی'}</div>
                    <div><strong>وضعیت پرونده:</strong> <span style="color:#10b981;">${order.status}</span></div>
                </div>

                <div style="margin-bottom:12px;">
                    <strong>ایراد اعلامی مشتری:</strong>
                    <div style="color:#cbd5e1; background:rgba(0,0,0,0.25); padding:8px; border-radius:8px; margin-top:4px;">${order.problem_description}</div>
                </div>

                <div style="margin-bottom:12px;">
                    <strong>وضعیت ظاهری و اقلام همراه:</strong>
                    <div style="color:var(--text-muted);">${order.appearance_condition || 'سالم'} | اقلام: ${order.accessories_included || 'دستگاه تک'}</div>
                </div>

                <div style="border-top:1px dashed rgba(255,255,255,0.15); padding-top:10px; font-size:11.5px; color:var(--text-dim); line-height:1.6;">
                    * ارائه این رسید یا کارت ملی هنگام تحویل دستگاه الزامی است.<br>
                    * قطعات تعویض شده تا ۶ ماه شامل ضمانت رسمی سام موبایل می‌باشند.<br>
                    * پیگیری برخط وضعیت تعمیر در آدرس: mob.taminkanisam.co.ir
                </div>
            </div>
        `;
        document.getElementById('detailsModal').classList.add('open');
    }
</script>
@endpush
