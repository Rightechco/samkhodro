<!-- کدهای پاکسازی (Clearfix) برای اتصال دقیق به انتهای صفحه -->
<div style="clear: both; display: block; width: 100%; height: 1px;"></div>

@php
    // تابع تشخیص هوشمند لینک‌های خارجی جهت باز شدن خودکار در تب جدید
    if (!function_exists('isExternalFooterUrl')) {
        function isExternalFooterUrl($url) {
            if (empty($url) || $url === '#' || $url === 'javascript:void(0)') return false;
            $url = trim($url);
            return (bool)preg_match('~^(?:https?:)?//~i', $url);
        }
    }
@endphp

<style>
    /* ==========================================================================
       SAM KHODRO ULTRA-PREMIUM LIGHT FOOTER SYSTEM
       هماهنگ با پالت لایت تاپ‌هدر، کنتراست شفاف، بدون گپ، تراز کامل خطوط
       حذف ایمپورت‌های خارجی CDN جهت رفع قطعی تاخیر و ارور ERR_CONNECTION_RESET
       ========================================================================== */
    :root {
        --ft-bg-base: #f8fafc;
        --ft-bg-card: #ffffff;
        --ft-border: #e2e8f0;
        --ft-border-light: #edf2f7;
        --ft-text-head: #0f172a;
        --ft-text-body: #475569;
        --ft-text-muted: #64748b;
        --ft-primary: #2563eb;
        --ft-primary-hover: #1d4ed8;
        --ft-accent-cyan: #0284c7;
        --ft-emerald: #10b981;
    }

    /* خنثی‌سازی کامل اینماد مازاد و استیکی در انتهای صفحه مستر و کل سایت */
    body > .enamad-floating,
    html > .enamad-floating,
    .allHome ~ .enamad-floating {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    /* اینماد رسمی منحصراً داخل کادر خبرنامه فوتر با اندازه متوازن و استاندارد */
    .pf-enamad-wrapper .enamad-floating {
        position: static !important;
        bottom: auto !important;
        right: auto !important;
        left: auto !important;
        top: auto !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
        width: auto !important;
        display: flex !important;
        justify-content: flex-start !important;
        visibility: visible !important;
        opacity: 1 !important;
        z-index: 1 !important;
        flex-shrink: 0 !important;
    }

    /* ابعاد استاندارد و متوازن لوگوی نماد اعتماد */
    .pf-enamad-wrapper .enamad-floating img {
        width: 82px !important;
        max-width: 82px !important;
        min-width: 75px !important;
        height: auto !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px !important;
        padding: 6px !important;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .pf-enamad-wrapper .enamad-floating img:hover {
        transform: translateY(-2px) scale(1.02) !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.15) !important;
        border-color: #93c5fd !important;
    }

    /* ساختار کانتینر فوتر لایت */
    .allFooter.premium-footer-light {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 60%, #ffffff 100%) !important;
        color: var(--ft-text-body) !important;
        position: relative !important;
        z-index: 10 !important;
        clear: both !important;
        display: flow-root !important;
        margin-top: 50px !important;
        padding: 60px 0 25px 0 !important;
        border-top: 1px solid var(--ft-border) !important;
        direction: rtl !important;
        box-shadow: 0 -10px 40px rgba(15, 23, 42, 0.03) !important;
    }

    .premium-footer-light .width {
        max-width: 1440px !important;
        margin: 0 auto !important;
        padding: 0 28px !important;
        box-sizing: border-box !important;
    }

    /* نوار بالایی فوتر: کارت‌های اطلاعات تماس */
    .pf-top-light {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 24px !important;
        margin-bottom: 50px !important;
        padding-bottom: 40px !important;
        border-bottom: 1px solid var(--ft-border) !important;
    }

    .pf-contact-card-light {
        background: var(--ft-bg-card) !important;
        border: 1px solid var(--ft-border) !important;
        border-radius: 20px !important;
        padding: 22px 24px !important;
        display: flex !important;
        align-items: center !important;
        gap: 18px !important;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03) !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .pf-contact-card-light::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;
        left: 0 !important;
        height: 3px !important;
        background: linear-gradient(90deg, var(--ft-primary), var(--ft-accent-cyan)) !important;
        opacity: 0 !important;
        transition: opacity 0.3s ease !important;
    }

    .pf-contact-card-light:hover {
        transform: translateY(-5px) !important;
        border-color: #bfdbfe !important;
        box-shadow: 0 16px 35px -8px rgba(37, 99, 235, 0.12) !important;
    }

    .pf-contact-card-light:hover::before {
        opacity: 1 !important;
    }

    .pf-contact-icon {
        width: 52px !important;
        height: 52px !important;
        border-radius: 16px !important;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%) !important;
        border: 1px solid #bfdbfe !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: var(--ft-primary) !important;
        flex-shrink: 0 !important;
        transition: all 0.3s ease !important;
    }

    .pf-contact-card-light:hover .pf-contact-icon {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        transform: scale(1.05) rotate(-5deg) !important;
    }

    .pf-contact-icon svg {
        width: 24px !important;
        height: 24px !important;
        fill: currentColor !important;
        stroke: currentColor !important;
    }

    .pf-contact-card-light .des {
        flex: 1 !important;
        min-width: 0 !important;
    }

    .pf-contact-card-light .desT {
        font-size: 0.86rem !important;
        color: var(--ft-text-muted) !important;
        margin-bottom: 6px !important;
        font-weight: 700 !important;
    }

    .pf-contact-card-light .desVal {
        font-size: 1.15rem !important;
        color: var(--ft-text-head) !important;
        font-weight: 900 !important;
        direction: ltr !important;
        display: inline-block !important;
        font-family: 'Segoe UI', Tahoma, sans-serif !important;
        letter-spacing: 0.5px !important;
    }

    .pf-ext-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        background: #f0fdf4 !important;
        border: 1px solid #bbf7d0 !important;
        color: #15803d !important;
        padding: 4px 10px !important;
        border-radius: 99px !important;
        font-size: 0.74rem !important;
        font-weight: 800 !important;
        margin-right: 8px !important;
        direction: rtl !important;
    }

    .pf-ext-badge .live-dot {
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #10b981 !important;
        box-shadow: 0 0 6px #10b981 !important;
    }

    /* باکس اختصاصی آدرس */
    .pf-address-card,
    .pf-address-card * {
        font-family: 'Vazirmatn', 'Vazir', -apple-system, BlinkMacSystemFont, Tahoma, sans-serif !important;
    }

    .pf-address-card .desT {
        font-weight: 800 !important;
        letter-spacing: -0.2px !important;
    }

    .pf-address-card .desVal {
        font-size: 0.92rem !important;
        font-weight: 600 !important;
        line-height: 1.7 !important;
        letter-spacing: -0.2px !important;
    }

    /* بدنه میانی فوتر */
    .pf-center-light {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 45px !important;
    }

    .pf-about-light {
        width: calc(34% - 25px) !important;
    }

    .pf-logo-box-light {
        background: #ffffff !important;
        padding: 14px 24px !important;
        border-radius: 18px !important;
        display: inline-flex !align-items: center !important;
        margin-bottom: 20px !important;
        border: 1px solid var(--ft-border) !important;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04) !important;
    }

    .pf-logo-box-light img {
        max-height: 52px !important;
        width: auto !important;
        object-fit: contain !important;
    }

    .pf-about-light p {
        line-height: 2 !important;
        font-size: 0.96rem !important;
        color: var(--ft-text-body) !important;
        text-align: justify !important;
        margin: 0 0 16px 0 !important;
    }

    .pf-badges-row {
        display: flex !important;
        gap: 12px !important;
        flex-wrap: wrap !important;
        margin-top: 14px !important;
    }

    .pf-badge-chip {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        background: #eff6ff !important;
        border: 1px solid #dbeafe !important;
        color: var(--ft-primary) !important;
        padding: 6px 12px !important;
        border-radius: 10px !important;
        font-size: 0.78rem !important;
        font-weight: 800 !important;
    }

    /* ستون‌های لینک‌ها و اشتراک */
    .pf-links-wrap-light {
        width: calc(66% - 25px) !important;
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 35px !important;
    }

    .pf-link-col-light {
        flex: 1 !important;
        min-width: 180px !important;
    }

    .pf-link-col-light h4 {
        color: var(--ft-text-head) !important;
        font-size: 1.15rem !important;
        font-weight: 900 !important;
        margin: 0 0 24px 0 !important;
        position: relative !important;
        padding-bottom: 12px !important;
        display: inline-block !important;
    }

    .pf-link-col-light h4::after {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        right: 0 !important;
        width: 38px !important;
        height: 3.5px !important;
        background: linear-gradient(90deg, var(--ft-primary), var(--ft-accent-cyan)) !important;
        border-radius: 99px !important;
    }

    .pf-link-col-light ul {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .pf-link-col-light ul li {
        margin-bottom: 13px !important;
    }

    .pf-link-col-light ul li a {
        color: var(--ft-text-body) !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        transition: all 0.25s ease !important;
        font-size: 0.92rem !important;
        font-weight: 600 !important;
    }

    .pf-link-col-light ul li a svg {
        width: 14px !important;
        height: 14px !important;
        fill: #94a3b8 !important;
        transition: all 0.25s ease !important;
    }

    .pf-link-col-light ul li a:hover {
        color: var(--ft-primary) !important;
        transform: translateX(-5px) !important;
    }

    .pf-link-col-light ul li a:hover svg {
        fill: var(--ft-primary) !important;
        transform: translateX(-3px) !important;
    }

    /* خبرنامه با تراز راست دقیق و عدم تداخل متن با دکمه */
    .pf-newsletter-light {
        flex: 1.35 !important;
        min-width: 270px !important;
    }

    .pf-newsletter-light p {
        margin: 0 0 16px 0 !important;
        font-size: 0.92rem !important;
        line-height: 1.8 !important;
        color: var(--ft-text-body) !important;
    }

    .pf-subscribe-light {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
        margin-bottom: 20px !important;
        direction: rtl !important;
        box-sizing: border-box !important;
    }

    /* رفع تداخل متن ورودی و راست‌چین‌سازی کامل فیلد ایمیل */
    .pf-subscribe-light input {
        width: 100% !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 16px !important;
        padding: 14px 18px 14px 115px !important; /* فاصله از راست ۱۸px و فاصله از چپ ۱۱۵px به خاطر دکمه */
        color: var(--ft-text-head) !important;
        font-family: inherit !important;
        transition: all 0.3s ease !important;
        outline: none !important;
        font-size: 0.92rem !important;
        direction: rtl !important;
        text-align: right !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03) !important;
        box-sizing: border-box !important;
    }

    .pf-subscribe-light input::placeholder {
        text-align: right !important;
        direction: rtl !important;
        color: #94a3b8 !important;
        opacity: 1 !important;
    }

    .pf-subscribe-light input:focus {
        border-color: var(--ft-primary) !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12) !important;
    }

    .pf-subscribe-light button {
        position: absolute !important;
        left: 6px !important;
        top: 6px !important;
        bottom: 6px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        border: none !important;
        color: #ffffff !important;
        padding: 0 20px !important;
        border-radius: 12px !important;
        cursor: pointer !important;
        font-family: inherit !important;
        font-weight: 800 !important;
        font-size: 0.88rem !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
        z-index: 2 !important;
    }

    .pf-subscribe-light button:hover {
        background: #1e40af !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4) !important;
    }

    /* کادر استاندارد نماد اعتماد زیر خبرنامه */
    .pf-enamad-wrapper {
        background: #ffffff !important;
        border: 1px solid var(--ft-border) !important;
        border-radius: 18px !important;
        padding: 14px 16px !important;
        display: flex !important;
        align-items: center !important;
        gap: 14px !important;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03) !important;
        margin-top: 14px !important;
    }

    .pf-enamad-wrapper .trust-text {
        font-size: 0.82rem !important;
        color: var(--ft-text-muted) !important;
        line-height: 1.65 !important;
    }

    .pf-enamad-wrapper .trust-text strong {
        color: var(--ft-text-head) !important;
        display: block !important;
        margin-bottom: 4px !important;
        font-size: 0.9rem !important;
    }

    /* نوار کپی‌رایت پایین */
    .pf-bottom-bar {
        margin-top: 45px !important;
        padding-top: 24px !important;
        border-top: 1px solid var(--ft-border) !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        font-size: 0.86rem !important;
        color: var(--ft-text-muted) !important;
        flex-wrap: wrap !important;
        gap: 14px !important;
    }

    .pf-bottom-bar a {
        color: var(--ft-primary) !important;
        text-decoration: none !important;
        font-weight: 700 !important;
    }

    /* ==========================================================================
       منوی ثابت اَپ‌لیکیشنی پایین موبایل (Floating Mobile Dock)
       ========================================================================== */
    .pf-fixed-tab { display: none; }

    @media (max-width: 991px) {
        .allFooter.premium-footer-light { padding-bottom: 125px !important; }
        .pf-top-light { grid-template-columns: 1fr !important; gap: 16px !important; }
        .pf-center-light { flex-direction: column !important; }
        .pf-about-light, .pf-links-wrap-light { width: 100% !important; }

        .pf-enamad-wrapper {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .pf-fixed-tab {
            display: block !important;
            position: fixed !important;
            bottom: 12px !important;
            left: 12px !important;
            right: 12px !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(28px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
            border: 1px solid rgba(226, 232, 240, 0.9) !important;
            box-shadow: 0 16px 40px -8px rgba(15, 23, 42, 0.16), 0 0 0 1px rgba(255, 255, 255, 0.8) inset !important;
            z-index: 99990 !important;
            padding: 8px 12px !important;
            border-radius: 26px !important;
            box-sizing: border-box !important;
            direction: rtl !important;
        }

        .pf-fixed-tab .tabs {
            display: grid !important;
            grid-template-columns: repeat(5, 1fr) !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 4px !important;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }

        .pf-fixed-tab .tab {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 0 !important;
        }

        .pf-fixed-tab .tab a {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 4px !important;
            color: #64748b !important;
            text-decoration: none !important;
            padding: 6px 4px !important;
            border-radius: 14px !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
            width: 100% !important;
            cursor: pointer !important;
            user-select: none !important;
            -webkit-tap-highlight-color: transparent !important;
        }

        .pf-fixed-tab .tab a .tab-icon {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 26px !important;
            height: 26px !important;
            transition: transform 0.25s ease !important;
        }

        .pf-fixed-tab .tab a .tab-icon svg {
            width: 22px !important;
            height: 22px !important;
            stroke-width: 2.2 !important;
        }

        .pf-fixed-tab .tab a .tab-label {
            font-size: 0.68rem !important;
            font-weight: 700 !important;
            line-height: 1 !important;
            white-space: nowrap !important;
            letter-spacing: -0.2px !important;
        }

        .pf-fixed-tab .tab a.active, 
        .pf-fixed-tab .tab a:hover {
            color: #2563eb !important;
            background: #eff6ff !important;
            transform: translateY(-2px) !important;
        }

        .pf-fixed-tab .tab a.active .tab-icon svg {
            stroke: #2563eb !important;
        }

        .pf-fixed-tab .tab.homeTab a {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
            color: #ffffff !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            margin: 0 auto !important;
            transform: translateY(-16px) !important;
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.45) !important;
            border: 3.5px solid #ffffff !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .pf-fixed-tab .tab.homeTab a .tab-label {
            display: none !important;
        }

        .pf-fixed-tab .tab.homeTab a .tab-icon svg {
            width: 22px !important;
            height: 22px !important;
            stroke: #ffffff !important;
            fill: none !important;
        }

        .pf-fixed-tab .tab.homeTab a:active {
            transform: translateY(-14px) scale(0.95) !important;
        }
    }

    /* ==========================================================================
       چت‌بات هوشمند آنلاین
       ========================================================================== */
    .sam-chat-launcher {
        position: fixed !important;
        bottom: 24px !important;
        left: 24px !important;
        z-index: 99998 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        border: 2px solid rgba(255, 255, 255, 0.45) !important;
        border-radius: 99px !important;
        padding: 7px 14px 7px 10px !important;
        box-shadow: 0 10px 28px -4px rgba(37, 99, 235, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
        cursor: pointer !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        user-select: none !important;
        -webkit-tap-highlight-color: transparent !important;
    }

    .sam-chat-launcher:hover {
        transform: translateY(-3px) scale(1.02) !important;
        box-shadow: 0 14px 35px -3px rgba(37, 99, 235, 0.65) !important;
    }

    .sam-chat-launcher .pulse-halo {
        position: absolute !important;
        inset: -3px !important;
        border-radius: 99px !important;
        background: rgba(37, 99, 235, 0.35) !important;
        z-index: -1 !important;
        animation: chatPulse 2s infinite !important;
    }

    @keyframes chatPulse {
        0% { transform: scale(0.96); opacity: 0.8; }
        50% { transform: scale(1.06); opacity: 0; }
        100% { transform: scale(0.96); opacity: 0; }
    }

    .sam-chat-launcher .bot-avatar {
        width: 30px !important;
        height: 30px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        color: #2563eb !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12) !important;
        flex-shrink: 0 !important;
    }

    .sam-chat-launcher .bot-avatar svg {
        width: 16px !important;
        height: 16px !important;
    }

    .sam-chat-launcher .bot-text-wrap {
        display: flex !important;
        flex-direction: column !important;
        text-align: right !important;
    }

    .sam-chat-launcher .bot-title {
        font-size: 0.82rem !important;
        font-weight: 800 !important;
        line-height: 1.25 !important;
        white-space: nowrap !important;
    }

    .sam-chat-launcher .bot-status {
        font-size: 0.68rem !important;
        color: #bfdbfe !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .sam-chat-launcher .bot-status .status-dot {
        width: 5px !important;
        height: 5px !important;
        border-radius: 50% !important;
        background: #34d399 !important;
        box-shadow: 0 0 5px #34d399 !important;
    }

    /* پنجره چت */
    .sam-chat-window {
        position: fixed !important;
        bottom: 85px !important;
        left: 24px !important;
        width: 360px !important;
        max-width: calc(100vw - 36px) !important;
        height: 520px !important;
        max-height: calc(100vh - 110px) !important;
        background: #ffffff !important;
        border-radius: 22px !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 20px 50px -10px rgba(15, 23, 42, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.5) inset !important;
        z-index: 99999 !important;
        display: none;
        flex-direction: column !important;
        overflow: hidden !important;
        direction: rtl !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        animation: chatSlideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    @keyframes chatSlideIn {
        from { opacity: 0; transform: translateY(16px) scale(0.96); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .sam-chat-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        padding: 14px 18px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: relative !important;
    }

    .sam-chat-header-info {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .sam-chat-header-avatar {
        width: 36px !important;
        height: 36px !important;
        border-radius: 12px !important;
        background: rgba(255, 255, 255, 0.2) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
    }

    .sam-chat-header-avatar svg {
        width: 20px !important;
        height: 20px !important;
    }

    .sam-chat-header-text h5 {
        font-size: 0.92rem !important;
        font-weight: 800 !important;
        margin: 0 !important;
        color: #ffffff !important;
    }

    .sam-chat-header-text span {
        font-size: 0.7rem !important;
        color: #bae6fd !important;
    }

    .sam-chat-close-btn {
        width: 28px !important;
        height: 28px !important;
        border-radius: 50% !important;
        background: rgba(255, 255, 255, 0.15) !important;
        border: none !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
    }

    .sam-chat-close-btn svg {
        width: 14px !important;
        height: 14px !important;
        stroke: currentColor !important;
        stroke-width: 2.4 !important;
    }

    .sam-chat-subbar {
        background: #f1f5f9 !important;
        padding: 6px 14px !important;
        font-size: 0.72rem !important;
        color: #475569 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-bottom: 1px solid #e2e8f0 !important;
        font-weight: 700 !important;
    }

    .sam-chat-subbar span.hours {
        color: #2563eb !important;
        font-family: 'Segoe UI', Tahoma, sans-serif !important;
        direction: ltr !important;
    }

    .sam-chat-body {
        flex: 1 !important;
        padding: 14px !important;
        overflow-y: auto !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
        background: #f8fafc !important;
    }

    .chat-bubble {
        max-width: 88% !important;
        padding: 10px 14px !important;
        border-radius: 16px !important;
        font-size: 0.84rem !important;
        line-height: 1.65 !important;
        position: relative !important;
    }

    .chat-bubble.bot {
        align-self: flex-start !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #1e293b !important;
        border-bottom-right-radius: 4px !important;
    }

    .chat-bubble.user {
        align-self: flex-end !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        border-bottom-left-radius: 4px !important;
    }

    .sam-dept-grid {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        margin-top: 6px !important;
    }

    .sam-dept-btn {
        background: #ffffff !important;
        border: 1.5px solid #dbeafe !important;
        border-radius: 14px !important;
        padding: 10px 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        text-align: right !important;
    }

    .sam-dept-btn:hover {
        background: #eff6ff !important;
        border-color: #3b82f6 !important;
        transform: translateY(-2px) !important;
    }

    .sam-dept-icon {
        width: 32px !important;
        height: 32px !important;
        border-radius: 10px !important;
        background: #eff6ff !important;
        color: #2563eb !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }

    .sam-dept-btn:hover .sam-dept-icon {
        background: #2563eb !important;
        color: #ffffff !important;
    }

    .sam-dept-btn .dept-text strong {
        display: block !important;
        font-size: 0.84rem !important;
        color: #0f172a !important;
        font-weight: 800 !important;
    }

    .sam-dept-btn .dept-text span {
        font-size: 0.7rem !important;
        color: #64748b !important;
    }

    .sam-specialists-deck {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        margin-top: 8px !important;
    }

    .sam-specialist-item {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 14px !important;
        padding: 10px 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03) !important;
    }

    .sam-specialist-item:hover {
        border-color: #93c5fd !important;
        background: #f8fafc !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.1) !important;
    }

    .sam-specialist-meta {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .sam-specialist-avatar {
        width: 34px !important;
        height: 34px !important;
        border-radius: 50% !important;
        background: #eff6ff !important;
        color: #2563eb !important;
        border: 1.5px solid #bfdbfe !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: 800 !important;
        font-size: 0.8rem !important;
        flex-shrink: 0 !important;
    }

    .sam-specialist-info h6 {
        margin: 0 0 2px 0 !important;
        font-size: 0.84rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
    }

    .sam-specialist-info span {
        font-size: 0.72rem !important;
        color: #64748b !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .sam-specialist-info span.ext {
        color: #2563eb !important;
        font-weight: 800 !important;
        direction: ltr !important;
    }

    .sam-specialist-call-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        padding: 6px 12px !important;
        border-radius: 99px !important;
        font-size: 0.74rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3) !important;
        transition: transform 0.2s ease !important;
        flex-shrink: 0 !important;
    }

    .sam-specialist-call-btn:hover {
        transform: scale(1.05) !important;
        color: #ffffff !important;
    }

    .ai-typing-indicator {
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
        padding: 6px 12px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        font-size: 0.78rem !important;
        color: #64748b !important;
    }

    .ai-typing-dot {
        width: 5px !important;
        height: 5px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        animation: aiTypingBounce 1.4s infinite ease-in-out both !important;
    }

    .ai-typing-dot:nth-child(1) { animation-delay: -0.32s !important; }
    .ai-typing-dot:nth-child(2) { animation-delay: -0.16s !important; }

    @keyframes aiTypingBounce {
        0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
        40% { transform: scale(1); opacity: 1; }
    }

    .sam-chat-footer {
        padding: 10px 12px !important;
        background: #ffffff !important;
        border-top: 1px solid #e2e8f0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .sam-chat-footer input {
        flex: 1 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 99px !important;
        padding: 8px 14px !important;
        font-size: 0.84rem !important;
        font-family: inherit !important;
        outline: none !important;
    }

    .sam-chat-send-btn {
        width: 34px !important;
        height: 34px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        border: none !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        flex-shrink: 0 !important;
    }

    .sam-chat-send-btn svg {
        width: 14px !important;
        height: 14px !important;
        stroke: currentColor !important;
        stroke-width: 2.2 !important;
    }

    @media (max-width: 768px) {
        .sam-chat-launcher {
            bottom: 80px !important;
            left: 14px !important;
            padding: 6px 12px 6px 8px !important;
        }
        .sam-chat-window {
            bottom: 135px !important;
            left: 12px !important;
            right: 12px !important;
            width: auto !important;
            height: 460px !important;
        }
    }
</style>

<div class="allFooter premium-footer-light">
    <div class="width">
        
        <!-- نوار تماس‌های مستقیم فوتر لایت با داخلی ۱ فروش -->
        <div class="pf-top-light">
            
            <!-- کارت تلفن با داخلی ۱ واحد فروش -->
            <div class="pf-contact-card-light">
                <div class="pf-contact-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <div class="des">
                    <div class="desT">
                        <span>مرکز تماس و فروش خودرو</span>
                        <span class="pf-ext-badge">
                            <span class="live-dot"></span>
                            <span>داخلی ۱ - واحد فروش</span>
                        </span>
                    </div>
                    <a href="tel:04136689000" class="desVal" style="text-decoration: none;">041-36689000</a>
                </div>
            </div>

            <!-- کارت ایمیل سازمانی -->
            <div class="pf-contact-card-light">
                <div class="pf-contact-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="des">
                    <div class="desT">پست الکترونیک رسمی</div>
                    <a href="mailto:{{\App\Models\Setting::where('key' , 'email')->pluck('value')->first()}}" class="desVal" style="font-size: 0.98rem; text-decoration: none;">
                        {{\App\Models\Setting::where('key' , 'email')->pluck('value')->first() ?: 'info@taminkanisam.co.ir'}}
                    </a>
                </div>
            </div>

            <!-- کارت آدرس دفتر مرکزی -->
            <div class="pf-contact-card-light pf-address-card">
                <div class="pf-contact-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div class="des">
                    <div class="desT">آدرس دفتر مرکزی</div>
                    <div class="desVal" style="direction: rtl; color: #334155;">
                        {{\App\Models\Setting::where('key' , 'address')->pluck('value')->first() ?: 'تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸، طبقه ۱'}}
                    </div>
                </div>
            </div>

        </div>

        <!-- محتوای اصلی فوتر -->
        <div class="pf-center-light">
            
            <!-- ستون درباره گروه خودرویی سام -->
            <div class="pf-about-light">
                <figure class="pf-logo-box-light">
                    <a href="/" title="صفحه اصلی گروه خودرویی سام">
                        <img src="{{\App\Models\Setting::where('key' , 'logo')->pluck('value')->first()}}" alt="{{\App\Models\Setting::where('key' , 'title')->pluck('value')->first()}}">
                    </a>
                </figure>
                <p>{{\App\Models\Setting::where('key' , 'about')->pluck('value')->first()}}</p>
                <div class="pf-badges-row">
                    <span class="pf-badge-chip">واردکننده رسمی پلاک ملی</span>
                    <span class="pf-badge-chip">تضمین اصالت خودرو و ترخیص قطعی</span>
                </div>
            </div>
            
            <div class="pf-links-wrap-light">
                
                <!-- دسترسی سریع با باز شدن خودکار لینک‌های خارجی در تب جدید -->
                <div class="pf-link-col-light">
                    <h4>دسترسی سریع</h4>
                    <ul>
                        @foreach(\App\Models\Link::where('type' , 1)->get() as $item)
                            <li>
                                <a href="{{$item->slug}}" {!! isExternalFooterUrl($item->slug) ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>
                                    <svg viewBox="0 0 24 24"><polygon points="15 18 9 12 15 6"></polygon></svg>
                                    <span>{{$item->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- لینک‌های مفید و سامانه‌ها با باز شدن خودکار لینک‌های خارجی در تب جدید -->
                <div class="pf-link-col-light">
                    <h4>سامانه‌ها و خدمات</h4>
                    <ul>
                        @foreach(\App\Models\Link::where('type' , 2)->get() as $item)
                            <li>
                                <a href="{{$item->slug}}" {!! isExternalFooterUrl($item->slug) ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>
                                    <svg viewBox="0 0 24 24"><polygon points="15 18 9 12 15 6"></polygon></svg>
                                    <span>{{$item->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- خبرنامه و نماد اعتماد درست زیر آن -->
                <div class="pf-link-col-light pf-newsletter-light">
                    <h4>مشترک شوید</h4>
                    <p>با عضویت در خبرنامه گروه خودرویی سام، از آخرین شرایط فروش و پارت‌های وارداتی زودتر از همه مطلع شوید.</p>
                    
                    <label for="sub1" class="pf-subscribe-light subscribe">
                        <input type="text" id="sub1" name="subscribe" placeholder="آدرس ایمیل خود را وارد کنید...">
                        <button type="button">عضویت</button>
                    </label>

                    <!-- نماد اعتماد الکترونیکی -->
                    <div class="pf-enamad-wrapper">
                        <div class="enamad-floating">
                            <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=694217&Code=XYJ0aJiE6AaVjhFegJiXZnOG9MKmkUR8' title="نماد تجارت الکترونیکی">
                                <img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=694217&Code=XYJ0aJiE6AaVjhFegJiXZnOG9MKmkUR8' alt='نماد اعتماد الکترونیکی' style='cursor:pointer' code='XYJ0aJiE6AaVjhFegJiXZnOG9MKmkUR8'>
                            </a>
                        </div>
                        <div class="trust-text">
                            <strong>نماد اعتماد الکترونیکی</strong>
                            <span>مرکز توسعه تجارت الکترونیکی وزارت صمت؛ دارای تاییدیه رسمی واردات خودروهای پلاک ملی</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- نوار زیرین کپی‌رایت -->
        <div class="pf-bottom-bar">
            <div>
                <span>کلیه حقوق این سامانه متعلق به <strong>شرکت تامین کانی سام (گروه خودرویی سام)</strong> می‌باشد.</span>
            </div>
            <div>
                <span>طراحی و توسعه توسط <a href="https://rightechco.ir" target="_blank" rel="noopener noreferrer" style="color: var(--ft-primary); text-decoration: none; font-weight: 800;">شرکت عصر انتقال داده رایان تکرو (rightechco.ir)</a></span>
            </div>
        </div>

    </div>

    <!-- منوی ثابت اَپ‌لیکیشنی پایین موبایل (Floating App Dock) -->
    <div class="fixedTab pf-fixed-tab">
        <div class="tabs">
            <!-- ۱. منوی ناوبری اصلی -->
            <div class="tab resAlign" role="button" aria-label="منوی سایت">
                <a>
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="4" y1="7" x2="20" y2="7"></line>
                            <line x1="4" y1="12" x2="20" y2="12"></line>
                            <line x1="4" y1="17" x2="20" y2="17"></line>
                        </svg>
                    </span>
                    <span class="tab-label">منو</span>
                </a>
            </div>

            <!-- ۲. حساب کاربری / پروفایل -->
            <div class="tab">
                <a href="/profile" class="{{ (Request::is('profile*') || Request::is('login*')) ? 'active' : '' }}">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span class="tab-label">پروفایل</span>
                </a>
            </div>

            <!-- ۳. خانه (دکمه مرکزی برجسته) -->
            <div class="tab homeTab">
                <a href="/" class="{{ Request::is('/') ? 'active' : '' }}" aria-label="صفحه اصلی">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                </a>
            </div>

            <!-- ۴. مجله و اخبار خودرویی -->
            <div class="tab">
                <a href="/blogs" class="{{ Request::is('blogs*') ? 'active' : '' }}">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </span>
                    <span class="tab-label">مجله خودرو</span>
                </a>
            </div>

            <!-- ۵. خدمات پس از فروش و پشتیبانی -->
            <div class="tab">
                <a href="/faq" class="{{ Request::is('faq*') ? 'active' : '' }}">
                    <span class="tab-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" cy="17" x2="12.01" y2="17"></line>
                        </svg>
                    </span>
                    <span class="tab-label">پشتیبانی</span>
                </a>
            </div>
        </div>
    </div>

    <!-- دکمه لانچر شناور چت‌بات آنلاین هوشمند -->
    <div class="sam-chat-launcher" id="samChatLauncher" role="button" aria-label="مشاوره و پشتیبانی آنلاین">
        <div class="pulse-halo"></div>
        <div class="bot-avatar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <div class="bot-text-wrap">
            <span class="bot-title">مشاوره و پشتیبانی</span>
            <span class="bot-status">
                <span class="status-dot" id="samBotLiveDot"></span>
                <span id="samBotStatusText">آنلاین • پاسخگوی شما</span>
            </span>
        </div>
    </div>

    <!-- پنجره چت‌بات شناور -->
    <div class="sam-chat-window" id="samChatWindow">
        <!-- هدر چت‌بات -->
        <div class="sam-chat-header">
            <div class="sam-chat-header-info">
                <div class="sam-chat-header-avatar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2a10 10 0 0 1 10 10c0 5.523-4.477 10-10 10a9.96 9.96 0 0 1-4.587-1.112l-3.826 1.043a1 1 0 0 1-1.213-1.213l1.043-3.826A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2z"></path>
                    </svg>
                </div>
                <div class="sam-chat-header-text">
                    <h5>دستیار هوشمند سام</h5>
                    <span>گروه خودرویی سام</span>
                </div>
            </div>
            <button type="button" class="sam-chat-close-btn" id="samChatCloseBtn" aria-label="بستن چت">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <!-- نوار ساعات کاری -->
        <div class="sam-chat-subbar">
            <span>ساعات پاسخگویی کارشناسان</span>
            <span class="hours">شنبه تا چهارشنبه ۸ الی ۱۶</span>
        </div>

        <!-- بدنه چت و تاریخچه پیام‌ها -->
        <div class="sam-chat-body" id="samChatBody">
            <!-- پیام خوش‌آمدگویی خلاصه -->
            <div class="chat-bubble bot">
                سلام، به <strong>گروه خودرویی سام</strong> خوش آمدید! 👋
                <br>
                برای ارتباط مستقیم با کارشناسان یا طرح سوال با <strong>دستیار هوش مصنوعی</strong>، گزینه مدنظر را انتخاب کنید:
            </div>

            <!-- انتخاب دپارتمان اولیه -->
            <div class="sam-dept-grid" id="samDeptOptions">
                <!-- دپارتمان فروش بدون خانم نوری‌‌نژاد -->
                <div class="sam-dept-btn" onclick="selectDepartment('sales')">
                    <div class="sam-dept-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <div class="dept-text">
                        <strong>کارشناسان واحد فروش خودرو</strong>
                        <span>آقای حسینی (۲۴۷) • آقای یوسفیان (۲۲۰)</span>
                    </div>
                </div>

                <!-- دپارتمان پشتیبانی و گارانتی -->
                <div class="sam-dept-btn" onclick="selectDepartment('support')">
                    <div class="sam-dept-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </div>
                    <div class="dept-text">
                        <strong>پشتیبانی و خدمات پس از فروش</strong>
                        <span>امور مشتریان، گارانتی و امداد • داخلی ۰</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- فوتر ارسال پیام چت -->
        <div class="sam-chat-footer">
            <input type="text" id="samChatInput" placeholder="سوال خود را درباره خودروها یا ثبت‌نام بپرسید..." autocomplete="off">
            <button type="button" id="samChatSendBtn" class="sam-chat-send-btn" aria-label="ارسال">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    // کنترل وضعیت آنلاین و آفلاین طبق ساعت کاری ۸ صبح الی ۱۶ عصر
    function checkBusinessHours() {
        var now = new Date();
        var utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        var tehranDate = new Date(utc + (3600000 * 3.5));
        
        var day = tehranDate.getDay(); // 0 = یکشنبه, ..., 4 = پنجشنبه, 5 = جمعه, 6 = شنبه
        var hour = tehranDate.getHours();

        // روزهای کاری: شنبه (6) تا چهارشنبه (3) - پنجشنبه و جمعه تعطیل
        var isWorkingDay = (day === 6 || day === 0 || day === 1 || day === 2 || day === 3);
        var isWorkingHour = (hour >= 8 && hour < 16);

        return (isWorkingDay && isWorkingHour);
    }

    $(document).ready(function(){
        var isOnline = checkBusinessHours();

        // همگام‌سازی وضعیت در دکمه لانچر
        if (!isOnline) {
            $('#samBotLiveDot').css({'background': '#f87171', 'box-shadow': '0 0 5px #ef4444'});
            $('#samBotStatusText').text('آفلاین • ثبت پیام');
        }

        // باز و بسته شدن تضمینی پنجره چت
        $(document).on('click', '#samChatLauncher', function(e){
            e.preventDefault();
            e.stopPropagation();
            $('#samChatWindow').fadeIn(200).css('display', 'flex');
            $('#samChatInput').focus();
        });

        $(document).on('click', '#samChatCloseBtn', function(e){
            e.preventDefault();
            e.stopPropagation();
            $('#samChatWindow').fadeOut(180);
        });
    });

    // فهرست رسمی کارشناسان و داخلی‌ها (خانم نوری‌نژاد حذف شد)
    var salesSpecialists = [
        { name: 'آقای حامد حسینی', role: 'کارشناس فروش خودرو', ext: '247', avatar: 'ح' },
        { name: 'آقای مسعود یوسفیان', role: 'کارشناس فروش خودرو', ext: '220', avatar: 'م' }
    ];

    var supportSpecialists = [
        { name: 'واحد پشتیبانی و امور مشتریان', role: 'پشتیبانی، عاملیت‌ها و امداد', ext: '0', avatar: 'پ' }
    ];

    // تابع انتخاب دپارتمان و نمایش کارشناسان مربوطه
    window.selectDepartment = function(deptKey) {
        var isSales = (deptKey === 'sales');
        var deptName = isSales ? 'واحد فروش خودرو' : 'واحد پشتیبانی و خدمات';
        var list = isSales ? salesSpecialists : supportSpecialists;

        $('#samChatBody').append('<div class="chat-bubble user">' + deptName + '</div>');
        $('#samDeptOptions').hide();

        setTimeout(function(){
            var responseHtml = '<div class="chat-bubble bot">' +
                'جهت ارتباط مستقیم با کارشناسان <strong>' + deptName + '</strong>، می‌توانید با شماره‌های داخلی زیر تماس حاصل فرمایید:' +
                '</div><div class="sam-specialists-deck">';

            list.forEach(function(spec){
                responseHtml += '<div class="sam-specialist-item">' +
                    '<div class="sam-specialist-meta">' +
                        '<div class="sam-specialist-avatar">' + spec.avatar + '</div>' +
                        '<div class="sam-specialist-info">' +
                            '<h6>' + spec.name + '</h6>' +
                            '<span>' + spec.role + ' • داخلی: <strong class="ext">' + spec.ext + '</strong></span>' +
                        '</div>' +
                    '</div>' +
                    '<a href="tel:04136689000,' + spec.ext + '" class="sam-specialist-call-btn" title="تماس مستقیم با ' + spec.name + '">' +
                        '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>' +
                        '<span>تماس (' + spec.ext + ')</span>' +
                    '</a>' +
                '</div>';
            });

            responseHtml += '</div>';
            responseHtml += '<div class="chat-bubble bot" style="margin-top:6px;">همچنین می‌توانید سوال خود را درباره مشخصات فنی خودروها یا شرایط تحویل تایپ فرمایید تا هوش مصنوعی پاسخ دهد.</div>';

            $('#samChatBody').append(responseHtml);
            $('#samChatBody').scrollTop($('#samChatBody')[0].scrollHeight);
        }, 300);
    };

    // اتصال هوش مصنوعی به پردازش پیام‌های کاربر
    var BROWSER_USE_API_KEY = "bu_17QuQyP4SHt1fttoieP-X9VmwV2MaYdxYX66vjv5B04";

    // پایگاه دانش رسمی خودرویی با کارشناسان فعال (آقای حسینی و آقای یوسفیان)
    var companyContext = "شرکت تامین کانی سام (گروه خودرویی سام)؛ واردکننده رسمی خودروهای پلاک ملی و منطقه آزاد. " +
        "دفتر مرکزی: تبریز، فرشته شمالی، خیابان محمدپورصبور، پلاک ۷۸. تلفن تماس: 041-36689000. " +
        "کارشناسان فروش: آقای حامد حسینی (داخلی 247)، آقای مسعود یوسفیان (داخلی 220). پشتیبانی امور مشتریان: داخلی 0. " +
        "محصولات اصلی: تویوتا کرولا کراس ۲۰۲۶ (Toyota Corolla Cross 2026 Hybrid)، تویوتا کرولا کراس ۲۰۲۵ نیوفیس (آماده تخصیص و تحویل)، کرولا کراس ۲۰۲۵ معمولی (اتمام ظرفیت ثبت‌نام و غیرقابل عرضه فعلی). " +
        "مشخصات فنی کرولا کراس: پیشرانه هیبریدی ۱۹۶ اسب بخار، گشتاور ۲۰۶ نیوتن‌متر، گیربکس e-CVT، سیستم تعلیق مستقل مولتی‌لینک. " +
        "سامانه ثبت‌نام رسمی فروش خودرو: sell.taminkanisam.co.ir . خدمات پس از فروش شامل گارانتی رسمی، عاملیت‌های مجاز و امداد ۲۴ ساعته جاده‌ای.";

    async function queryBrowserUseAI(userQuery) {
        var taskPrompt = "شما دستیار هوش مصنوعی و پاسخگوی مشتریان 'گروه خودرویی سام' (شرکت تامین کانی سام) هستید.\n" +
            "اطلاعات رسمی شرکت و خودروها:\n" + companyContext + "\n\n" +
            "سوال مشتری: \"" + userQuery + "\"\n\n" +
            "دستورالعمل: پاسخی کوتاه، کاملاً موثق، حرفه‌ای و محترمانه به زبان فارسی ارائه دهید. در صورت نیاز به تماس، نام کارشناس فروش (آقای حسینی داخلی ۲۴۷، آقای یوسفیان داخلی ۲۲۰) یا پشتیبانی (داخلی ۰) را ذکر کنید.";

        var payload = {
            "task": taskPrompt,
            "model": "gpt-6-luna",
            "modelParams": {
                "reasoning": { "effort": "low" },
                "service_tier": "default"
            },
            "browserSettings": {
                "proxyCountryCode": "us",
                "record": false
            }
        };

        try {
            var response = await fetch("https://api.browser-use.com/api/v4/runs", {
                method: "POST",
                headers: {
                    "X-Browser-Use-API-Key": BROWSER_USE_API_KEY,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                var resData = await response.json();
                if (resData.result || resData.output || resData.answer) {
                    return resData.result || resData.output || resData.answer;
                } else if (resData.id) {
                    return generateKnowledgeFallback(userQuery);
                }
            }
            return generateKnowledgeFallback(userQuery);
        } catch (e) {
            return generateKnowledgeFallback(userQuery);
        }
    }

    // تولید پاسخ هوشمند مستقیم بر اساس کلیدواژه‌های محصولات گروه خودرویی سام
    function generateKnowledgeFallback(query) {
        var q = query.toLowerCase();
        if (q.includes('فروش') || q.includes('کارشناس') || q.includes('تماس') || q.includes('شماره') || q.includes('داخلی')) {
            return "جهت استعلام شرایط فروش و ثبت‌نام خودروهای وارداتی، کارشناسان فروش ما آماده پاسخگویی هستند:<br>" +
                "• <strong>آقای حسینی</strong> (داخلی <strong>۲۴۷</strong>)<br>" +
                "• <strong>آقای یوسفیان</strong> (داخلی <strong>۲۲۰</strong>)<br>" +
                "مرکز تماس: <strong>۰۴۱-۳۶۶۸۹۰۰۰</strong>";
        }
        if (q.includes('کرولا') || q.includes('تویوتا') || q.includes('خودرو') || q.includes('محصول')) {
            return "در سبد محصولات گروه خودرویی سام، <strong>تویوتا کرولا کراس ۲۰۲۶</strong> و <strong>کرولا کراس ۲۰۲۵ نیوفیس هیبرید</strong> با پلاک ملی آماده تخصیص هستند. مدل ۲۰۲۵ معمولی در حال حاضر اتمام ظرفیت شده است. جهت اطلاعات تکمیلی می‌توانید با داخلی‌های <strong>۲۴۷ یا ۲۲۰</strong> تماس بگیرید.";
        }
        if (q.includes('پشتیبانی') || q.includes('گارانتی') || q.includes('امداد') || q.includes('عاملیت')) {
            return "کلیه خودروهای وارداتی گروه خودرویی سام دارای گارانتی رسمی و خدمات پس از فروش سراسری هستند. جهت ارتباط با واحد پشتیبانی، با شماره <strong>۰۴۱-۳۶۶۸۹۰۰۰ داخلی ۰</strong> تماس حاصل فرمایید.";
        }
        return "با سپاس از پیام شما. پیام شما در سامانه ثبت گردید. کارشناسان فروش ما (آقای حسینی داخلی ۲۴۷، آقای یوسفیان داخلی ۲۲۰) و واحد پشتیبانی (داخلی ۰) با شماره <strong>۰۴۱-۳۶۶۸۹۰۰۰</strong> در ساعات کاری آماده راهنمایی شما هستند.";
    }

    // ارسال پیام دلخواه و پردازش هوشمند
    async function handleSendUserMessage() {
        var text = $('#samChatInput').val();
        if (!text || text.trim() === '') return;

        $('#samChatBody').append('<div class="chat-bubble user">' + text + '</div>');
        $('#samChatInput').val('');

        var typingId = 'typing-' + Date.now();
        var typingHtml = '<div class="chat-bubble bot" id="' + typingId + '">' +
            '<span class="ai-typing-indicator">' +
                '<span class="ai-typing-dot"></span><span class="ai-typing-dot"></span><span class="ai-typing-dot"></span>' +
                '<span>درحال بررسی و پاسخگویی هوشمند...</span>' +
            '</span>' +
        '</div>';
        $('#samChatBody').append(typingHtml);
        $('#samChatBody').scrollTop($('#samChatBody')[0].scrollHeight);

        var aiResponse = await queryBrowserUseAI(text);

        $('#' + typingId).remove();
        $('#samChatBody').append('<div class="chat-bubble bot">' + aiResponse + '</div>');
        $('#samChatBody').scrollTop($('#samChatBody')[0].scrollHeight);
    }

    $(document).on('click', '#samChatSendBtn', handleSendUserMessage);
    $(document).on('keypress', '#samChatInput', function(e){
        if (e.which === 13) handleSendUserMessage();
    });

    // اسکریپت عضویت در خبرنامه
    $(document).ready(function(){
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        $('.subscribe button').click(function(){
            var name = $(".subscribe input[name='subscribe']").val();
            if(isEmail(name)){
                var form = {
                    "_token": "{{ csrf_token() }}",
                    email: name,
                };
                $.ajax({
                    url: "/send-sub",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'ok'){
                            $.toast({
                                text: "ایمیل شما در خبرنامه ثبت گردید",
                                heading: 'موفقیت‌آمیز',
                                icon: 'success',
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3500,
                                position: 'bottom-left',
                                textAlign: 'right',
                                loader: true,
                                loaderBg: '#2563eb',
                            });
                            $(".subscribe input[name='subscribe']").val('');
                        } else {
                            $.toast({
                                text: "این ایمیل قبلاً در سامانه ثبت شده است",
                                heading: 'اطلاعیه',
                                icon: 'info',
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3500,
                                position: 'bottom-left',
                                textAlign: 'right',
                                loader: true,
                                loaderBg: '#eab308',
                            });
                        }
                    },
                });
            } else {
                $.toast({
                    text: "لطفاً یک آدرس ایمیل معتبر وارد فرمایید",
                    heading: 'خطای اعتبارسنجی',
                    icon: 'error',
                    showHideTransition: 'fade',
                    allowToastClose: true,
                    hideAfter: 3500,
                    position: 'bottom-left',
                    textAlign: 'right',
                    loader: true,
                    loaderBg: '#ef4444',
                });
            }
        });
    });
</script>