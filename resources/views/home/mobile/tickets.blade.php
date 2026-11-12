@extends('home.mobile.layout')

@section('title', 'سامانه ثبت و پیگیری تیکت پشتیبانی | تامین کانی سام (موبایل)')
@section('meta_description', 'ارتباط مستقیم با کارشناسان فنی و پذیرش گارانتی ۱۸ ماهه تامین کانی سام (موبایل) از طریق سامانه تیکتینگ ۲۴ ساعته')

@section('content')
<div class="container" style="max-width: 1000px; margin: 0 auto; padding: 24px 16px 80px;">

    <!-- Page Header -->
    <div style="background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%); border: 1px solid #bfdbfe; border-radius: 20px; padding: 28px 24px; margin-bottom: 24px; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.05); text-align: center;">
        <span style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #1d4ed8; border: 1px solid #93c5fd; padding: 4px 14px; border-radius: 99px; font-size: 0.78rem; font-weight: 800; margin-bottom: 10px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span>پشتیبانی و تیکتینگ آنلاین ۲۴ ساعته</span>
        </span>
        <h1 style="font-size: 1.6rem; font-weight: 900; color: #0f172a; margin: 0 0 8px 0;">سامانه ارتباط برخط و پشتیبانی تیکتینگ تامین کانی سام (موبایل)</h1>
        <p style="font-size: 0.88rem; color: #475569; margin: 0; line-height: 1.6;">
            ثبت درخواست‌های فنی، استعلام گارانتی ۱۸ ماهه، پیگیری قطعات و ارتباط با شعب سراسر کشور همراه با تخصیص آنی کد رهگیری و پیامک اطلاع‌رسانی
        </p>
    </div>

    <!-- Mode Tabs: New Ticket / Track Ticket -->
    <div style="display: flex; gap: 10px; margin-bottom: 20px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 6px; box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);">
        <button type="button" id="tabBtnNewTicket" onclick="switchTicketTab('new');" style="flex: 1; padding: 12px; border-radius: 10px; border: none; font-family: inherit; font-size: 0.9rem; font-weight: 800; cursor: pointer; transition: all 0.2s; background: #2563eb; color: #ffffff;">
            ✍️ ثبت تیکت پشتیبانی جدید
        </button>
        <button type="button" id="tabBtnTrackTicket" onclick="switchTicketTab('track');" style="flex: 1; padding: 12px; border-radius: 10px; border: none; font-family: inherit; font-size: 0.9rem; font-weight: 800; cursor: pointer; transition: all 0.2s; background: transparent; color: #475569;">
            🔍 استعلام و پیگیری وضعیت تیکت
        </button>
    </div>

    <!-- 1. NEW TICKET FORM -->
    <div id="sectionNewTicket" class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; box-shadow: 0 6px 24px rgba(15, 23, 42, 0.04);">
        <form id="newTicketForm" onsubmit="submitNewTicket(event);" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">نام و نام خانوادگی *</label>
                    <input type="text" name="customer_name" required placeholder="مثال: علیرضا محمدی" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: inherit; font-size: 0.88rem; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">شماره تلفن همراه (جهت دریافت پیامک) *</label>
                    <input type="tel" name="customer_phone" required placeholder="09123456789" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: monospace; font-size: 0.95rem; text-align: left; direction: ltr; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">دپارتمان / واحد مربوطه *</label>
                    <select name="department" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: inherit; font-size: 0.88rem; box-sizing: border-box; background: #fff;">
                        <option value="واحد پذیرش و امور مشتریان">واحد پذیرش و امور مشتریان</option>
                        <option value="کارگاه تخصصی سخت‌افزار و تعمیرات">کارگاه تخصصی سخت‌افزار و تعمیرات</option>
                        <option value="واحد گارانتی ۱۸ ماهه و خدمات رسمی">واحد گارانتی ۱۸ ماهه و خدمات رسمی (ماده ۱۳)</option>
                        <option value="تامین و استعلام قطعات یدکی">تامین و استعلام قطعات یدکی اورجینال</option>
                        <option value="امور شعب و نمایندگی‌های شهرستان">امور شعب و نمایندگی‌های شهرستان</option>
                        <option value="مدیریت و بازرسی">مدیریت و بازرسی عالیه</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">اولویت بررسی</label>
                    <select name="priority" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: inherit; font-size: 0.88rem; box-sizing: border-box; background: #fff;">
                        <option value="عادی">عادی (پاسخ حداکثر ۲۴ ساعت)</option>
                        <option value="فوری">فوری (دستگاه در دست تعمیر / موارد اضطراری)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">شماره IMEI یا کد رهگیری پرونده (اختیاری)</label>
                    <input type="text" name="imei" placeholder="کد ۱۵ رقمی IMEI یا کد پرونده مانند SA-..." style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: monospace; font-size: 0.88rem; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">موضوع تیکت *</label>
                    <input type="text" name="subject" required placeholder="مثال: استعلام موجودی ال‌سی‌دی شیائومی نوت ۱۳ پرو" style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: inherit; font-size: 0.88rem; box-sizing: border-box;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">شرح پیام و درخواست شما *</label>
                <textarea name="message" rows="5" required placeholder="لطفا شرح دقیق مشکل یا سوال خود را اینجا یادداشت فرمایید..." style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: inherit; font-size: 0.88rem; line-height: 1.6; box-sizing: border-box; resize: vertical;"></textarea>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">فایل ضمیمه یا تصویر فاکتور/رسید (اختیاری)</label>
                <input type="file" name="attachment" accept="image/*,.pdf" style="font-size: 0.85rem; color: #475569;">
                <div style="font-size: 0.74rem; color: #64748b; margin-top: 4px;">فرمت‌های مجاز: JPG, PNG, PDF تا حداکثر ۵ مگابایت</div>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" id="btnSubmitTicket" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; border: none; padding: 12px 28px; border-radius: 12px; font-weight: 800; font-size: 0.95rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    <span>ارسال تیکت پشتیبانی</span>
                </button>
            </div>
        </form>
    </div>

    <!-- 2. TRACK TICKET FORM & RESULT -->
    <div id="sectionTrackTicket" class="glass-card" style="display: none; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; box-shadow: 0 6px 24px rgba(15, 23, 42, 0.04);">
        <form id="trackTicketForm" onsubmit="trackTicket(event);" style="margin-bottom: 24px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; align-items: flex-end;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">کد رهگیری تیکت (مانند TK-XXXXX) *</label>
                    <input type="text" id="trackTicketCode" required placeholder="مثال: TK-84920" style="width: 100%; padding: 11px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: monospace; font-size: 0.95rem; text-align: left; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #0f172a; margin-bottom: 6px;">شماره موبایل ثبت‌شده (اختیاری جهت تطبیق)</label>
                    <input type="tel" id="trackTicketPhone" placeholder="0912..." style="width: 100%; padding: 11px 14px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-family: monospace; font-size: 0.95rem; text-align: left; direction: ltr; box-sizing: border-box;">
                </div>
                <div>
                    <button type="submit" id="btnTrackTicket" style="width: 100%; background: #059669; color: #ffffff; border: none; padding: 12px; border-radius: 12px; font-weight: 800; font-size: 0.92rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="2" x2="16.65" y2="16.65"/></svg>
                        <span>استعلام وضعیت تیکت</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Track Result Box -->
        <div id="ticketResultBox" style="display: none; border-top: 1px solid #e2e8f0; padding-top: 20px;"></div>
    </div>

</div>

<!-- Modal: Ticket Created Success -->
<div id="ticketSuccessModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(5px); z-index: 100000; align-items: center; justify-content: center; padding: 16px;">
    <div style="background: #ffffff; border-radius: 20px; max-width: 460px; width: 100%; padding: 28px 24px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div style="width: 60px; height: 60px; border-radius: 50%; background: #ecfdf5; color: #059669; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h3 style="font-size: 1.25rem; font-weight: 900; color: #0f172a; margin: 0 0 8px 0;">تیکت شما با موفقیت ثبت شد</h3>
        <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5; margin: 0 0 18px 0;">
            کد رهگیری اختصاصی تیکت شما صادر گردید و پیامک تایید نیز به شماره همراه شما ارسال شد.
        </p>
        <div style="background: #f8fafc; border: 2px dashed #93c5fd; border-radius: 12px; padding: 12px; margin-bottom: 20px;">
            <span style="font-size: 0.78rem; color: #64748b; display: block; margin-bottom: 4px;">کد پیگیری تیکت:</span>
            <strong id="createdTicketCode" style="font-family: monospace; font-size: 1.4rem; color: #2563eb; letter-spacing: 2px;">TK-00000</strong>
        </div>
        <div style="display: flex; gap: 10px;">
            <button type="button" onclick="copyCreatedCode();" style="flex: 1; background: #f1f5f9; color: #0f172a; border: none; padding: 10px; border-radius: 10px; font-weight: 800; cursor: pointer;">📋 کپی کد</button>
            <button type="button" onclick="closeSuccessModal();" style="flex: 1; background: #2563eb; color: #fff; border: none; padding: 10px; border-radius: 10px; font-weight: 800; cursor: pointer;">متوجه شدم</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function switchTicketTab(tab) {
        const secNew = document.getElementById('sectionNewTicket');
        const secTrack = document.getElementById('sectionTrackTicket');
        const btnNew = document.getElementById('tabBtnNewTicket');
        const btnTrack = document.getElementById('tabBtnTrackTicket');

        if (tab === 'new') {
            secNew.style.display = 'block';
            secTrack.style.display = 'none';
            btnNew.style.background = '#2563eb';
            btnNew.style.color = '#ffffff';
            btnTrack.style.background = 'transparent';
            btnTrack.style.color = '#475569';
        } else {
            secNew.style.display = 'none';
            secTrack.style.display = 'block';
            btnTrack.style.background = '#059669';
            btnTrack.style.color = '#ffffff';
            btnNew.style.background = 'transparent';
            btnNew.style.color = '#475569';
        }
    }

    async function submitNewTicket(e) {
        e.preventDefault();
        const form = document.getElementById('newTicketForm');
        const btn = document.getElementById('btnSubmitTicket');
        btn.disabled = true;
        btn.innerHTML = '<span>در حال ارسال تیکت...</span>';

        const formData = new FormData(form);

        try {
            const res = await fetch('/tickets/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await res.json();
            if (data.status === 'success') {
                document.getElementById('createdTicketCode').innerText = data.tracking_code;
                document.getElementById('ticketSuccessModal').style.display = 'flex';
                form.reset();
            } else {
                alert('خطا در ثبت تیکت: ' + (data.message || 'خطای سرور'));
            }
        } catch (err) {
            alert('خطای اتصال: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg><span>ارسال تیکت پشتیبانی</span>';
        }
    }

    async function trackTicket(e) {
        e.preventDefault();
        const code = document.getElementById('trackTicketCode').value.trim();
        const phone = document.getElementById('trackTicketPhone').value.trim();
        const box = document.getElementById('ticketResultBox');
        const btn = document.getElementById('btnTrackTicket');

        btn.disabled = true;
        btn.innerHTML = '<span>در حال جستجو...</span>';

        try {
            const res = await fetch('/tickets/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ tracking_code: code, phone: phone })
            });

            const data = await res.json();
            if (data.status === 'success' && data.ticket) {
                const tk = data.ticket;
                let statusBadge = '';
                if (tk.status === 'open') {
                    statusBadge = '<span style="background:#eff6ff; color:#2563eb; padding:4px 10px; border-radius:8px; font-weight:800; font-size:0.78rem;">⏳ در انتظار بررسی کارشناس</span>';
                } else if (tk.status === 'answered') {
                    statusBadge = '<span style="background:#ecfdf5; color:#059669; padding:4px 10px; border-radius:8px; font-weight:800; font-size:0.78rem;">✓ پاسخ داده شده</span>';
                } else {
                    statusBadge = '<span style="background:#f1f5f9; color:#475569; padding:4px 10px; border-radius:8px; font-weight:800; font-size:0.78rem;">بسته شده</span>';
                }

                box.innerHTML = `
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
                            <div>
                                <span style="font-weight: 800; font-size: 1.05rem; color: #0f172a;">${tk.subject}</span>
                                <span style="font-family: monospace; color: #2563eb; font-weight: 700; margin-right: 8px;">[${tk.tracking_code}]</span>
                            </div>
                            ${statusBadge}
                        </div>
                        <div style="display: flex; gap: 14px; font-size: 0.78rem; color: #64748b; margin-bottom: 14px; flex-wrap: wrap;">
                            <span>🏢 دپارتمان: <strong>${tk.department}</strong></span>
                            <span>⚡ اولویت: <strong>${tk.priority}</strong></span>
                            <span>📅 تاریخ ثبت: <strong>${tk.shamsi_date}</strong></span>
                        </div>
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; font-size: 0.88rem; color: #334155; line-height: 1.6; margin-bottom: 14px;">
                            <strong style="color: #0f172a; display: block; margin-bottom: 6px;">متن تیکت شما:</strong>
                            ${tk.message}
                            ${tk.attachment_url ? `<div style="margin-top: 10px;"><a href="${tk.attachment_url}" target="_blank" style="color: #2563eb; font-weight: 700; font-size: 0.78rem;">📎 مشاهده فایل ضمیمه</a></div>` : ''}
                        </div>
                        ${tk.reply ? `
                            <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: 12px; padding: 14px; font-size: 0.88rem; color: #065f46; line-height: 1.6;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <strong style="color: #047857; display: flex; align-items: center; gap: 6px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        پاسخ رسمی پشتیبانی تامین کانی سام (موبایل):
                                    </strong>
                                    ${tk.shamsi_reply_date ? `<span style="font-size: 0.74rem; color: #047857;">تاریخ پاسخ: ${tk.shamsi_reply_date}</span>` : ''}
                                </div>
                                ${tk.reply}
                            </div>
                        ` : `
                            <div style="background: #eff6ff; border: 1px dashed #bfdbfe; border-radius: 12px; padding: 12px; font-size: 0.82rem; color: #1e40af;">
                                ⏳ تیکت شما در صف بررسی کارشناسان قرار دارد و به محض بررسی، پاسخ در همین صفحه درج و پیامک آن برای شما ارسال خواهد شد.
                            </div>
                        `}
                    </div>
                `;
                box.style.display = 'block';
            } else {
                box.innerHTML = `<div style="padding: 16px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px; color: #b91c1c; font-size: 0.88rem;">${data.message || 'تیکتی یافت نشد.'}</div>`;
                box.style.display = 'block';
            }
        } catch (err) {
            alert('خطای اتصال: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="2" x2="16.65" y2="16.65"/></svg><span>استعلام وضعیت تیکت</span>';
        }
    }

    function copyCreatedCode() {
        const code = document.getElementById('createdTicketCode').innerText;
        navigator.clipboard.writeText(code).then(() => {
            alert('کد رهگیری ' + code + ' کپی شد.');
        });
    }

    function closeSuccessModal() {
        document.getElementById('ticketSuccessModal').style.display = 'none';
        switchTicketTab('track');
    }
</script>
@endpush
