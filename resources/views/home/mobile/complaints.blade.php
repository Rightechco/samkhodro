@extends('home.mobile.layout')

@section('title', 'ثبت و پیگیری شکایات مشتریان | سام موبایل (تامین کانی سام)')

@section('content')
<div class="container">
    <div class="page-header-card">
        <span class="section-tag">پاسخگویی مستقیم بازرسی</span>
        <h1>سامانه ثبت و پیگیری شکایات مشتریان</h1>
        <p>مطابق مواد ۱۴ و ۳۸ ضوابط اجرایی وزارت صمت؛ رسیدگی مستقیم به شکایات ظرف حداکثر ۲ روز کاری توسط واحد بازرسی</p>
    </div>

    <div class="glass-card complaints-card">
        <!-- Switch between New Complaint & Tracking -->
        <div class="cmp-tabs-row">
            <button type="button" class="cmp-tab-btn active" data-target="tab-new-cmp">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>ثبت شکایت جدید</span>
            </button>
            <button type="button" class="cmp-tab-btn" data-target="tab-track-cmp">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>پیگیری شکایت ثبت‌شده با کد رهگیری</span>
            </button>
        </div>

        <!-- TAB 1: New Complaint -->
        <div class="cmp-panel active" id="tab-new-cmp">
            <form id="complaintForm" onsubmit="submitComplaint(event)">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>نام و نام خانوادگی شاکی *</label>
                        <input type="text" name="customer_name" required placeholder="مثال: رضا مرادی">
                    </div>
                    <div class="form-group">
                        <label>شماره تماس همراه (جهت ارسال پیامک نتیجه) *</label>
                        <input type="tel" name="customer_phone" required placeholder="مثال: 09123456789" style="direction:ltr; text-align:right;">
                    </div>
                </div>

                <div class="form-grid-2" style="margin-top: 14px;">
                    <div class="form-group">
                        <label>آدرس ایمیل (اختیاری)</label>
                        <input type="email" name="customer_email" placeholder="example@email.com" style="direction:ltr; text-align:right;">
                    </div>
                    <div class="form-group">
                        <label>کد رهگیری پذیرش کالا (در صورت وجود)</label>
                        <input type="text" name="service_tracking_code" placeholder="مثال: SAM-1403-9102" style="direction:ltr; text-align:right;">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label>موضوع و دسته‌بندی شکایت *</label>
                    <select name="complaint_type" required>
                        <option value="تأخیر در تعمیر و تحویل دستگاه">تأخیر در تعمیر و تحویل دستگاه (بیش از مهلت قانونی)</option>
                        <option value="کیفیت خدمات و عدم رفع کامل عیب">کیفیت خدمات و عدم رفع کامل عیب</option>
                        <option value="برخورد نامناسب پرسنل یا تکنسین">برخورد نامناسب پرسنل یا تکنسین در شعب</option>
                        <option value="مغایرت هزینه یا عدم شفافیت فاکتور">مغایرت هزینه یا عدم شفافیت صورتحساب</option>
                        <option value="آسیب فیزیکی به کالا حین تعمیرات">آسیب فیزیکی به کالا حین تعمیرات</option>
                        <option value="سایر موارد">سایر موارد</option>
                    </select>
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label>شرح کامل شکایت و توضیحات *</label>
                    <textarea name="message" rows="5" required placeholder="لطفاً شرح دقیق موضوع، تاریخ مراجعه، نام شعبه و مستندات خود را بیان فرمایید..."></textarea>
                </div>

                <div style="margin-top: 24px; display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn-glow" style="padding: 13px 38px;">
                        <span>ثبت شکایت و دریافت کد رهگیری</span>
                    </button>
                </div>
            </form>

            <div id="complaintSuccessBox" style="display: none; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 16px; padding: 24px; text-align: center; margin-top: 20px;">
                <h4 style="color: #10b981; font-size: 18px; font-weight: 800; margin-bottom: 8px;">شکایت شما با موفقیت ثبت شد</h4>
                <p style="color: var(--text-body); font-size: 14px; margin-bottom: 12px;">کد رهگیری اختصاصی شکایت شما:</p>
                <div id="issuedCmpCode" style="font-size: 24px; font-weight: 900; color: #38bdf8; font-family: monospace; letter-spacing: 1px; margin-bottom: 16px;"></div>
                <p style="font-size: 13px; color: var(--text-muted); line-height: 1.7;">
                    پرونده شما مستقیماً به واحد بازرسی و خدمات پس از فروش شرکت ارجاع گردید و حداکثر ظرف ۴۸ ساعت کاری بررسی و نتیجه از طریق تماس یا پیامک به اطلاع شما خواهد رسید.
                </p>
            </div>
        </div>

        <!-- TAB 2: Track Complaint -->
        <div class="cmp-panel" id="tab-track-cmp">
            <form onsubmit="trackComplaint(event)">
                <div class="form-group">
                    <label>کد رهگیری شکایت را وارد نمایید *</label>
                    <div style="display:flex; gap:10px;">
                        <input type="text" id="trackCmpInput" required placeholder="مثال: CMP-1403-9821" style="flex:1; direction:ltr; text-align:right;">
                        <button type="submit" class="btn-glow" style="white-space:nowrap;">
                            <span>استعلام وضعیت</span>
                        </button>
                    </div>
                </div>
            </form>

            <div id="cmpTrackResult" style="display: none; margin-top: 20px;"></div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-header-card { text-align: center; padding: 40px 20px 20px; margin-bottom: 20px; }
    .page-header-card h1 { font-size: 26px; font-weight: 900; color: var(--text-main); margin: 12px 0 8px; }
    .page-header-card p { font-size: 14.5px; color: var(--text-muted); max-width: 680px; margin: 0 auto; }

    .complaints-card { max-width: 840px; margin: 0 auto 40px; padding: 36px; }
    .cmp-tabs-row { display: flex; gap: 10px; border-bottom: 1px solid var(--border-light); padding-bottom: 16px; margin-bottom: 24px; }
    .cmp-tab-btn {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 700;
        padding: 9px 18px;
        border-radius: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .cmp-tab-btn.active {
        background: rgba(56, 189, 248, 0.15);
        color: var(--text-main);
        border: 1px solid rgba(56, 189, 248, 0.35);
    }
    .cmp-panel { display: none; }
    .cmp-panel.active { display: block; }

    .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-group { display: flex; flex-direction: column; gap: 8px; }
    .form-group label { font-size: 13.5px; font-weight: 600; color: var(--text-body); }
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

    @media (max-width: 768px) {
        .form-grid-2 { grid-template-columns: 1fr; }
        .complaints-card { padding: 22px 16px; }
    }
</style>
@endpush

@push('scripts')
<script>
    const cmpTabs = document.querySelectorAll('.cmp-tab-btn');
    const cmpPanels = document.querySelectorAll('.cmp-panel');
    cmpTabs.forEach(btn => {
        btn.addEventListener('click', () => {
            cmpTabs.forEach(b => b.classList.remove('active'));
            cmpPanels.forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(btn.getAttribute('data-target')).classList.add('active');
        });
    });

    function submitComplaint(e) {
        e.preventDefault();
        const formData = new FormData(document.getElementById('complaintForm'));
        const data = Object.fromEntries(formData.entries());

        fetch('{{ route("mob.complaints.store") }}', {
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
                document.getElementById('complaintForm').style.display = 'none';
                document.getElementById('complaintSuccessBox').style.display = 'block';
                document.getElementById('issuedCmpCode').innerText = res.tracking_code;
            }
        });
    }

    function trackComplaint(e) {
        e.preventDefault();
        const code = document.getElementById('trackCmpInput').value.trim();
        const resultBox = document.getElementById('cmpTrackResult');
        resultBox.style.display = 'block';
        resultBox.innerHTML = '<div style="color:var(--primary); text-align:center;">در حال استعلام...</div>';

        fetch('{{ route("mob.complaints.track") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ code: code })
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                const d = res.data;
                resultBox.innerHTML = `
                    <div style="background:rgba(255,255,255,0.03); border:1px solid rgba(56,189,248,0.3); border-radius:14px; padding:20px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                            <strong style="color:#fff; font-size:16px;">کد شکایت: ${d.tracking_code}</strong>
                            <span style="font-size:12px; padding:3px 10px; border-radius:12px; background:rgba(56,189,248,0.2); color:#38bdf8;">${d.status_title}</span>
                        </div>
                        <div style="font-size:13.5px; color:var(--text-muted); margin-bottom:8px;"><strong>شاکی:</strong> ${d.customer_name} | <strong>موضوع:</strong> ${d.complaint_type}</div>
                        <div style="font-size:13.5px; color:var(--text-muted); margin-bottom:12px;"><strong>تاریخ ثبت:</strong> ${d.created_at}</div>
                        <div style="background:rgba(0,0,0,0.3); padding:12px; border-radius:10px; font-size:13.5px;">
                            <strong style="color:#10b981;">نتیجه و اقدامات واحد بازرسی:</strong>
                            <div style="color:#e2e8f0; margin-top:4px;">${d.investigation_result}</div>
                        </div>
                    </div>
                `;
            } else {
                resultBox.innerHTML = `<div style="color:#ef4444; text-align:center;">${res.message}</div>`;
            }
        });
    }
</script>
@endpush
