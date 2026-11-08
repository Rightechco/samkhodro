@extends('home.mobile.layout')

@section('title', 'ورود و ثبت‌نام سامانه خدمات سام موبایل | تایید پیامکی')
@section('meta_description', 'ورود و ثبت‌نام در سامانه مدیریت خدمات و پیگیری تعمیرات سام موبایل (تامین کانی سام) با رمز یکبار مصرف پیامکی (OTP).')

@push('styles')
<style>
    .auth-page-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: radial-gradient(circle at 50% 20%, #eff6ff 0%, #f8fafc 100%);
    }
    .auth-card {
        width: 100%;
        max-width: 480px;
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 24px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        padding: 36px 32px;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 28px;
    }
    .auth-logo-box {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        box-shadow: var(--shadow-glow);
    }
    .auth-title {
        font-size: 1.45rem;
        font-weight: 900;
        color: var(--text-main);
        margin-bottom: 6px;
    }
    .auth-subtitle {
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Tabs */
    .auth-tabs {
        display: flex;
        background: var(--bg-subtle);
        border-radius: var(--radius-md);
        padding: 4px;
        margin-bottom: 24px;
    }
    .auth-tab-btn {
        flex: 1;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-muted);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: transparent;
        border: none;
    }
    .auth-tab-btn.active {
        background: #ffffff;
        color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .auth-pane {
        display: none;
    }
    .auth-pane.active {
        display: block;
    }

    /* Forms */
    .auth-form-group {
        margin-bottom: 18px;
    }
    .auth-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-body);
        margin-bottom: 8px;
    }
    .auth-input-wrap {
        position: relative;
    }
    .auth-input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-dim);
    }
    .auth-input {
        width: 100%;
        height: 48px;
        padding: 0 42px 0 14px;
        background: #ffffff;
        border: 1.5px solid var(--border-light);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-main);
        transition: all 0.2s ease;
        direction: ltr;
        text-align: right;
    }
    .auth-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
        outline: none;
    }

    .auth-btn-submit {
        width: 100%;
        height: 48px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        transition: all 0.25s ease;
        cursor: pointer;
        border: none;
        margin-top: 22px;
    }
    .auth-btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    /* OTP Step 2 */
    .otp-code-inputs {
        display: flex;
        gap: 8px;
        justify-content: center;
        direction: ltr;
        margin: 16px 0;
    }
    .otp-single-digit {
        width: 44px;
        height: 52px;
        border: 1.5px solid var(--border-light);
        border-radius: var(--radius-md);
        text-align: center;
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
        background: #ffffff;
        outline: none;
        transition: all 0.2s ease;
    }
    .otp-single-digit:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .otp-timer-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 14px;
    }
    .resend-link {
        color: var(--primary);
        font-weight: 700;
        cursor: pointer;
        border: none;
        background: none;
    }
    .resend-link:disabled {
        color: var(--text-dim);
        cursor: not-allowed;
    }

    /* Security badge notice */
    .auth-security-notice {
        margin-top: 24px;
        padding: 14px 16px;
        border-radius: var(--radius-md);
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .auth-security-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .auth-security-text {
        font-size: 0.78rem;
        color: #64748b;
        line-height: 1.6;
    }
    .auth-security-text strong {
        color: #1e293b;
        display: block;
        margin-bottom: 2px;
    }
</style>
@endpush

@section('content')
<div class="auth-page-container">
    <div class="auth-card">
        <!-- Logo & Title -->
        <div class="auth-header">
            <div class="auth-logo-box">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
            </div>
            <h1 class="auth-title">ورود به سامانه خدمات</h1>
            <p class="auth-subtitle">سامانه یکپارچه مدیریت خدمات و پیگیری تعمیرات سام موبایل (تامین کانی سام)</p>
        </div>

        <!-- Mode Tabs -->
        <div class="auth-tabs">
            <button type="button" class="auth-tab-btn active" id="tabOtpBtn" onclick="switchAuthTab('otp')">
                تایید پیامکی (OTP)
            </button>
            <button type="button" class="auth-tab-btn" id="tabPassBtn" onclick="switchAuthTab('pass')">
                ورود با رمز عبور
            </button>
        </div>

        <!-- Alert Message Container -->
        <div id="authAlert" style="display: none; padding: 12px 14px; border-radius: var(--radius-md); font-size: 0.85rem; font-weight: 600; margin-bottom: 16px;"></div>

        <!-- Tab 1: SMS OTP Mode -->
        <div class="auth-pane active" id="paneOtp">
            <!-- Step 1: Input Phone -->
            <div id="otpStep1">
                <form id="formSendOtp" onsubmit="handleSendOtp(event)">
                    <div class="auth-form-group">
                        <label class="auth-label">شماره تلفن همراه</label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <input type="tel" id="inputPhone" class="auth-input" placeholder="09121234567" maxlength="11" required>
                        </div>
                        <span style="font-size: 0.76rem; color: var(--text-muted); margin-top: 4px; display: block;">کد تایید به این شماره پیامک خواهد شد.</span>
                    </div>

                    <button type="submit" class="auth-btn-submit" id="btnSendOtp">
                        <span>ارسال کد تایید پیامکی</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </form>
            </div>

            <!-- Step 2: Input OTP Code -->
            <div id="otpStep2" style="display: none;">
                <form id="formVerifyOtp" onsubmit="handleVerifyOtp(event)">
                    <div class="auth-form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label class="auth-label">کد تایید پیامک شده</label>
                            <button type="button" onclick="backToStep1()" style="font-size: 0.78rem; color: var(--primary); background: none; border: none; font-weight: 700; cursor: pointer;">ویرایش شماره</button>
                        </div>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="text" id="inputOtpCode" class="auth-input" placeholder="مثال: 12345" maxlength="6" style="letter-spacing: 6px; font-size: 1.25rem; font-weight: 800; text-align: center;" required>
                        </div>
                    </div>

                    <div class="otp-timer-row">
                        <span id="timerText">زمان باقی‌مانده: <strong id="timerSec">120</strong> ثانیه</span>
                        <button type="button" class="resend-link" id="btnResend" onclick="handleResendOtp()" disabled>ارسال مجدد کد</button>
                    </div>

                    <button type="submit" class="auth-btn-submit" id="btnVerifyOtp">
                        <span>ورود به سامانه</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Tab 2: Password Mode (Admins & Technicians) -->
        <div class="auth-pane" id="panePass">
            <form id="formPasswordLogin" onsubmit="handlePasswordLogin(event)">
                <div class="auth-form-group">
                    <label class="auth-label">نام کاربری یا شماره همراه</label>
                    <div class="auth-input-wrap">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <input type="text" id="inputUsername" class="auth-input" placeholder="شماره موبایل یا ایمیل" required>
                    </div>
                </div>

                <div class="auth-form-group">
                    <label class="auth-label">کلمه عبور</label>
                    <div class="auth-input-wrap">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input type="password" id="inputPassword" class="auth-input" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="auth-btn-submit" id="btnPassLogin">
                    <span>ورود به پنل مدیریت</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
            </form>
        </div>

        <!-- Security & Legal Notice -->
        <div class="auth-security-notice">
            <div class="auth-security-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="auth-security-text">
                <strong>سامانه رسمی خدمات پس از فروش سام موبایل</strong>
                ورود ایمن مطابق با ماده ۱۳ ضوابط اجرایی خدمات و استانداردهای سازمان حمایت از حقوق مصرف‌کنندگان
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentPhone = '';
    let timerInterval = null;
    let secondsLeft = 120;

    function showAlert(msg, isSuccess = false) {
        const alertBox = document.getElementById('authAlert');
        alertBox.style.display = 'block';
        alertBox.innerText = msg;
        if (isSuccess) {
            alertBox.style.background = 'var(--accent-emerald-light)';
            alertBox.style.color = 'var(--accent-emerald)';
            alertBox.style.border = '1px solid var(--accent-emerald)';
        } else {
            alertBox.style.background = 'var(--accent-rose-light)';
            alertBox.style.color = 'var(--accent-rose)';
            alertBox.style.border = '1px solid var(--accent-rose)';
        }
    }

    function switchAuthTab(tab) {
        document.getElementById('authAlert').style.display = 'none';
        const tabOtpBtn = document.getElementById('tabOtpBtn');
        const tabPassBtn = document.getElementById('tabPassBtn');
        const paneOtp = document.getElementById('paneOtp');
        const panePass = document.getElementById('panePass');

        if (tab === 'otp') {
            tabOtpBtn.classList.add('active');
            tabPassBtn.classList.remove('active');
            paneOtp.classList.add('active');
            panePass.classList.remove('active');
        } else {
            tabPassBtn.classList.add('active');
            tabOtpBtn.classList.remove('active');
            panePass.classList.add('active');
            paneOtp.classList.remove('active');
        }
    }

    function startTimer() {
        clearInterval(timerInterval);
        secondsLeft = 120;
        const timerSec = document.getElementById('timerSec');
        const btnResend = document.getElementById('btnResend');
        btnResend.disabled = true;

        timerInterval = setInterval(() => {
            secondsLeft--;
            timerSec.innerText = secondsLeft;
            if (secondsLeft <= 0) {
                clearInterval(timerInterval);
                btnResend.disabled = false;
            }
        }, 1000);
    }

    function backToStep1() {
        document.getElementById('otpStep1').style.display = 'block';
        document.getElementById('otpStep2').style.display = 'none';
        clearInterval(timerInterval);
    }

    // Step 1: Send OTP
    async function handleSendOtp(e) {
        e.preventDefault();
        const phone = document.getElementById('inputPhone').value.trim();
        if (!phone.startsWith('09') || phone.length !== 11) {
            showAlert('شماره تلفن همراه باید ۱۱ رقم و با 09 آغاز شود.');
            return;
        }

        currentPhone = phone;
        const btn = document.getElementById('btnSendOtp');
        btn.disabled = true;
        btn.innerHTML = '<span>در حال ارسال پیامک...</span>';

        try {
            const res = await fetch("{{ route('mob.login.send-otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ phone: phone })
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                showAlert(data.message + (data.debug_code ? ' (کد تستی: ' + data.debug_code + ')' : ''), true);
                document.getElementById('otpStep1').style.display = 'none';
                document.getElementById('otpStep2').style.display = 'block';
                if (data.debug_code) {
                    document.getElementById('inputOtpCode').value = data.debug_code;
                }
                startTimer();
            } else {
                showAlert(data.message || 'خطا در ارسال پیامک.');
            }
        } catch (err) {
            showAlert('خطای ارتباط با سرور.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<span>ارسال کد تایید پیامکی</span>';
        }
    }

    // Step 2: Verify OTP
    async function handleVerifyOtp(e) {
        e.preventDefault();
        const code = document.getElementById('inputOtpCode').value.trim();
        if (!code || code.length < 5) {
            showAlert('لطفاً کد تایید را کامل وارد نمایید.');
            return;
        }

        const btn = document.getElementById('btnVerifyOtp');
        btn.disabled = true;
        btn.innerHTML = '<span>در حال اعتبارسنجی...</span>';

        try {
            const res = await fetch("{{ route('mob.login.verify-otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ phone: currentPhone, code: code })
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                showAlert(data.message, true);
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 400);
            } else {
                showAlert(data.message || 'کد تایید اشتباه است.');
                btn.disabled = false;
                btn.innerHTML = '<span>ورود به سامانه</span>';
            }
        } catch (err) {
            showAlert('خطای ارتباط با سرور.');
            btn.disabled = false;
            btn.innerHTML = '<span>ورود به سامانه</span>';
        }
    }

    function handleResendOtp() {
        document.getElementById('inputPhone').value = currentPhone;
        handleSendOtp(new Event('submit'));
    }

    // Password Login
    async function handlePasswordLogin(e) {
        e.preventDefault();
        const u = document.getElementById('inputUsername').value.trim();
        const p = document.getElementById('inputPassword').value;

        const btn = document.getElementById('btnPassLogin');
        btn.disabled = true;
        btn.innerHTML = '<span>در حال بررسی...</span>';

        try {
            const res = await fetch("{{ route('mob.login.password') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ username: u, password: p })
            });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                showAlert('ورود موفقیت‌آمیز بود.', true);
                window.location.href = data.redirect;
            } else {
                showAlert(data.message || 'اطلاعات ورود نادرست است.');
                btn.disabled = false;
                btn.innerHTML = '<span>ورود به پنل مدیریت</span>';
            }
        } catch (err) {
            showAlert('خطای برقراری ارتباط.');
            btn.disabled = false;
            btn.innerHTML = '<span>ورود به پنل مدیریت</span>';
        }
    }


</script>
@endpush
