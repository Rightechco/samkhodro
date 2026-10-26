<!-- کدهای پاکسازی (Clearfix) برای اتصال دقیق به انتهای صفحه -->
<div style="clear: both; display: block; width: 100%; height: 1px;"></div>

<style>
    /* ایمپورت فونت رسمی وزیر جهت اعمال اختصاصی روی باکس آدرس و المان‌های مدنظر */
    @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css');

    /* ==========================================================================
       SAM KHODRO ULTRA-PREMIUM LIGHT FOOTER SYSTEM
       هماهنگ با پالت لایت تاپ‌هدر، کنتراست شفاف، بدون گپ، تراز کامل خطوط
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

    /* اینماد رسمی منحصراً داخل کادر خبرنامه فوتر */
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
    }

    .pf-enamad-wrapper .enamad-floating img {
        width: 95px !important;
        height: auto !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 14px !important;
        padding: 8px !important;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .pf-enamad-wrapper .enamad-floating img:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15) !important;
        border-color: #bfdbfe !important;
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

    /* باکس اختصاصی آدرس با فونت تضمینی وزیر */
    .pf-address-card,
    .pf-address-card * {
        font-family: 'Vazirmatn', 'Vazir', Tahoma, sans-serif !important;
    }

    .pf-address-card .desT {
        font-family: 'Vazirmatn', 'Vazir', Tahoma, sans-serif !important;
        font-weight: 800 !important;
        letter-spacing: -0.2px !important;
    }

    .pf-address-card .desVal {
        font-family: 'Vazirmatn', 'Vazir', Tahoma, sans-serif !important;
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
        display: inline-flex !important;
        align-items: center !important;
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

    /* خبرنامه و باکس اینماد در پایین آن */
    .pf-newsletter-light {
        flex: 1.3 !important;
        min-width: 260px !important;
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
    }

    .pf-subscribe-light input {
        width: 100% !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 16px !important;
        padding: 14px 115px 14px 18px !important;
        color: var(--ft-text-head) !important;
        font-family: inherit !important;
        transition: all 0.3s ease !important;
        outline: none !important;
        font-size: 0.92rem !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03) !important;
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
    }

    .pf-subscribe-light button:hover {
        background: #1e40af !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4) !important;
    }

    /* کادر نماد اعتماد زیر خبرنامه */
    .pf-enamad-wrapper {
        background: #ffffff !important;
        border: 1px solid var(--ft-border) !important;
        border-radius: 18px !important;
        padding: 16px !important;
        display: flex !important;
        align-items: center !important;
        gap: 16px !important;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03) !important;
        margin-top: 14px !important;
    }

    .pf-enamad-wrapper .trust-text {
        font-size: 0.82rem !important;
        color: var(--ft-text-muted) !important;
        line-height: 1.6 !important;
    }

    .pf-enamad-wrapper .trust-text strong {
        color: var(--ft-text-head) !important;
        display: block !important;
        margin-bottom: 2px !important;
        font-size: 0.86rem !important;
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
       منوی ثابت اَپ‌لیکیشنی پایین موبایل (Ultra-Luxury Mobile Floating Dock)
       طراحی داک معلق، چیدمان ۵گانه فوق‌العاده متقارن، لیبل‌های خوانا و تراز هماهنگ
       ========================================================================== */
    .pf-fixed-tab { display: none; }

    @media (max-width: 991px) {
        .allFooter.premium-footer-light { padding-bottom: 125px !important; }
        .pf-top-light { grid-template-columns: 1fr !important; gap: 16px !important; }
        .pf-center-light { flex-direction: column !important; }
        .pf-about-light, .pf-links-wrap-light { width: 100% !important; }

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

        /* دکمه برجسته خانه در مرکز داک */
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
       INTELLIGENT FLOATING CHATBOT (SAM KHODRO VIP ASSISTANT)
       چت‌بات هوشمند شناور با دپارتمان‌های فروش و پشتیبانی و هندلینگ آفلاین
       ========================================================================== */
    .sam-chat-launcher {
        position: fixed !important;
        bottom: 28px !important;
        left: 28px !important;
        z-index: 99998 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        border: 2px solid rgba(255, 255, 255, 0.4) !important;
        border-radius: 99px !important;
        padding: 10px 18px 10px 12px !important;
        box-shadow: 0 12px 35px -5px rgba(37, 99, 235, 0.55), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
        cursor: pointer !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        user-select: none !important;
        -webkit-tap-highlight-color: transparent !important;
    }

    .sam-chat-launcher:hover {
        transform: translateY(-4px) scale(1.03) !important;
        box-shadow: 0 18px 45px -4px rgba(37, 99, 235, 0.7) !important;
    }

    .sam-chat-launcher .pulse-halo {
        position: absolute !important;
        inset: -4px !important;
        border-radius: 99px !important;
        background: rgba(37, 99, 235, 0.4) !important;
        z-index: -1 !important;
        animation: chatPulse 2s infinite !important;
    }

    @keyframes chatPulse {
        0% { transform: scale(0.96); opacity: 0.8; }
        50% { transform: scale(1.08); opacity: 0; }
        100% { transform: scale(0.96); opacity: 0; }
    }

    .sam-chat-launcher .bot-avatar {
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        color: #2563eb !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15) !important;
        flex-shrink: 0 !important;
    }

    .sam-chat-launcher .bot-avatar svg {
        width: 20px !important;
        height: 20px !important;
    }

    .sam-chat-launcher .bot-text-wrap {
        display: flex !important;
        flex-direction: column !important;
        text-align: right !important;
    }

    .sam-chat-launcher .bot-title {
        font-size: 0.88rem !important;
        font-weight: 900 !important;
        line-height: 1.3 !important;
        white-space: nowrap !important;
    }

    .sam-chat-launcher .bot-status {
        font-size: 0.72rem !important;
        color: #bfdbfe !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
    }

    .sam-chat-launcher .bot-status .status-dot {
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #34d399 !important;
        box-shadow: 0 0 6px #34d399 !important;
    }

    /* کادر چت شناور */
    .sam-chat-window {
        position: fixed !important;
        bottom: 95px !important;
        left: 28px !important;
        width: 375px !important;
        max-width: calc(100vw - 40px) !important;
        height: 560px !important;
        max-height: calc(100vh - 120px) !important;
        background: #ffffff !important;
        border-radius: 26px !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 25px 60px -10px rgba(15, 23, 42, 0.22), 0 0 0 1px rgba(255, 255, 255, 0.5) inset !important;
        z-index: 99999 !important;
        display: none;
        flex-direction: column !important;
        overflow: hidden !important;
        direction: rtl !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        animation: chatSlideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    @keyframes chatSlideIn {
        from { opacity: 0; transform: translateY(20px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* هدر چت‌بات */
    .sam-chat-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        padding: 18px 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: relative !important;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25) !important;
    }

    .sam-chat-header-info {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .sam-chat-header-avatar {
        width: 44px !important;
        height: 44px !important;
        border-radius: 14px !important;
        background: rgba(255, 255, 255, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
    }

    .sam-chat-header-avatar svg {
        width: 24px !important;
        height: 24px !important;
    }

    .sam-chat-header-text h5 {
        font-size: 0.98rem !important;
        font-weight: 900 !important;
        margin: 0 0 4px 0 !important;
        color: #ffffff !important;
    }

    .sam-chat-header-text span {
        font-size: 0.74rem !important;
        color: #bae6fd !important;
        display: flex !important;
        align-items: center !important;
        gap: 5px !important;
    }

    .sam-chat-close-btn {
        width: 32px !important;
        height: 32px !important;
        border-radius: 50% !important;
        background: rgba(255, 255, 255, 0.15) !important;
        border: none !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: background 0.2s ease !important;
    }

    .sam-chat-close-btn:hover {
        background: rgba(255, 255, 255, 0.3) !important;
    }

    .sam-chat-close-btn svg {
        width: 16px !important;
        height: 16px !important;
        stroke: currentColor !important;
        stroke-width: 2.5 !important;
    }

    /* نوار ساعات کاری و تایمر زنده داخل هدر چت */
    .sam-chat-subbar {
        background: #f1f5f9 !important;
        padding: 8px 16px !important;
        font-size: 0.76rem !important;
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

    /* بدنه پیام‌ها */
    .sam-chat-body {
        flex: 1 !important;
        padding: 16px !important;
        overflow-y: auto !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 14px !important;
        background: #f8fafc !important;
    }

    .chat-bubble {
        max-width: 86% !important;
        padding: 12px 16px !important;
        border-radius: 18px !important;
        font-size: 0.88rem !important;
        line-height: 1.7 !important;
        position: relative !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04) !important;
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

    /* دکمه‌های دپارتمان‌ها */
    .sam-dept-grid {
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
        margin-top: 8px !important;
    }

    .sam-dept-btn {
        background: #ffffff !important;
        border: 1.5px solid #dbeafe !important;
        border-radius: 16px !important;
        padding: 12px 14px !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        text-align: right !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.04) !important;
    }

    .sam-dept-btn:hover {
        background: #eff6ff !important;
        border-color: #3b82f6 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.12) !important;
    }

    .sam-dept-icon {
        width: 38px !important;
        height: 38px !important;
        border-radius: 12px !important;
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
        font-size: 0.9rem !important;
        color: #0f172a !important;
        font-weight: 800 !important;
    }

    .sam-dept-btn .dept-text span {
        font-size: 0.74rem !important;
        color: #64748b !important;
    }

    /* کارت اطلاعات اپراتور در حالت آفلاین یا پاسخگویی */
    .sam-operator-card {
        background: #ffffff !important;
        border: 1.5px dashed #cbd5e1 !important;
        border-radius: 18px !important;
        padding: 16px !important;
        margin-top: 6px !important;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05) !important;
    }

    .sam-operator-card.is-offline {
        border-color: #fca5a5 !important;
        background: #fffbfb !important;
    }

    .sam-operator-header {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        margin-bottom: 12px !important;
        padding-bottom: 10px !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .sam-operator-avatar {
        width: 42px !important;
        height: 42px !important;
        border-radius: 50% !important;
        background: #eff6ff !important;
        border: 2px solid #3b82f6 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #2563eb !important;
        font-weight: 900 !important;
        font-size: 0.95rem !important;
    }

    .sam-operator-name h6 {
        margin: 0 !important;
        font-size: 0.92rem !important;
        color: #0f172a !important;
        font-weight: 900 !important;
    }

    .sam-operator-name span {
        font-size: 0.76rem !important;
        color: #64748b !important;
    }

    .sam-operator-detail-row {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        margin-bottom: 8px !important;
        font-size: 0.82rem !important;
    }

    .sam-operator-detail-row span.label {
        color: #64748b !important;
    }

    .sam-operator-detail-row span.val {
        color: #0f172a !important;
        font-weight: 800 !important;
        direction: ltr !important;
        font-family: 'Segoe UI', Tahoma, sans-serif !important;
    }

    .sam-operator-call-btn {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: linear-gradient(135deg, #15803d 0%, #16a34a 100%) !important;
        color: #ffffff !important;
        padding: 10px !important;
        border-radius: 12px !important;
        font-size: 0.88rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        margin-top: 12px !important;
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3) !important;
        transition: all 0.25s ease !important;
    }

    .sam-operator-call-btn:hover {
        background: #166534 !important;
        transform: translateY(-1px) !important;
        color: #ffffff !important;
    }

    /* فوتر چت‌بات و فیلد ارسال */
    .sam-chat-footer {
        padding: 12px 14px !important;
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
        padding: 10px 16px !important;
        font-size: 0.88rem !important;
        font-family: inherit !important;
        outline: none !important;
        transition: border-color 0.25s ease !important;
    }

    .sam-chat-footer input:focus {
        border-color: #2563eb !important;
    }

    .sam-chat-send-btn {
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        border: none !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        flex-shrink: 0 !important;
    }

    .sam-chat-send-btn:hover {
        background: #1d4ed8 !important;
        transform: scale(1.06) !important;
    }

    .sam-chat-send-btn svg {
        width: 16px !important;
        height: 16px !important;
        stroke: currentColor !important;
        stroke-width: 2.2 !important;
    }

    @media (max-width: 768px) {
        .sam-chat-launcher {
            bottom: 85px !important;
            left: 18px !important;
            padding: 8px 14px 8px 10px !important;
        }
        .sam-chat-window {
            bottom: 145px !important;
            left: 14px !important;
            right: 14px !important;
            width: auto !important;
            height: 480px !important;
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
            
            <!-- ستون درباره سام خودرو -->
            <div class="pf-about-light">
                <figure class="pf-logo-box-light">
                    <a href="/" title="صفحه اصلی سام خودرو">
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
                
                <!-- دسترسی سریع -->
                <div class="pf-link-col-light">
                    <h4>دسترسی سریع</h4>
                    <ul>
                        @foreach(\App\Models\Link::where('type' , 1)->get() as $item)
                            <li>
                                <a href="{{$item->slug}}">
                                    <svg viewBox="0 0 24 24"><polygon points="15 18 9 12 15 6"></polygon></svg>
                                    <span>{{$item->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- لینک‌های مفید و سامانه‌ها -->
                <div class="pf-link-col-light">
                    <h4>سامانه‌ها و خدمات</h4>
                    <ul>
                        @foreach(\App\Models\Link::where('type' , 2)->get() as $item)
                            <li>
                                <a href="{{$item->slug}}">
                                    <svg viewBox="0 0 24 24"><polygon points="15 18 9 12 15 6"></polygon></svg>
                                    <span>{{$item->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- خبرنامه و نماد اعتماد درست زیر آن بدون استیکی بودن -->
                <div class="pf-link-col-light pf-newsletter-light">
                    <h4>مشترک شوید</h4>
                    <p>با عضویت در خبرنامه سام خودرو، از آخرین پارت‌های وارداتی و شرایط فروش زودتر از همه مطلع شوید.</p>
                    
                    <label for="sub1" class="pf-subscribe-light subscribe">
                        <input type="text" id="sub1" name="subscribe" placeholder="آدرس ایمیل خود را وارد کنید...">
                        <button type="button">عضویت</button>
                    </label>

                    <!-- نماد اعتماد الکترونیکی (جایگزین شده مستقیماً زیر مشترک شوید - بدون استیکی بودن) -->
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
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </span>
                    <span class="tab-label">پشتیبانی</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     INTELLIGENT VIP CHATBOT (سامانه گفتگوی هوشمند سام خودرو)
     ========================================================================== -->
<!-- دکمه شناور پرمیوم باز کردن چت‌بات -->
<div id="samChatLauncher" class="sam-chat-launcher" role="button" aria-label="گفتگو با کارشناسان">
    <div class="pulse-halo"></div>
    <div class="bot-avatar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
    </div>
    <div class="bot-text-wrap">
        <span class="bot-title">مشاوره و پشتیبانی سام خودرو</span>
        <span class="bot-status">
            <span class="status-dot" id="samBotLiveDot"></span>
            <span id="samBotStatusText">آنلاین • پاسخگوی شما هستیم</span>
        </span>
    </div>
</div>

<!-- پنجره چت هوشمند -->
<div id="samChatWindow" class="sam-chat-window">
    <!-- هدر چت -->
    <div class="sam-chat-header">
        <div class="sam-chat-header-info">
            <div class="sam-chat-header-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
            </div>
            <div class="sam-chat-header-text">
                <h5>دستیار هوشمند سام خودرو</h5>
                <span id="samHeaderLiveStatus">واحد فروش و خدمات پس از فروش</span>
            </div>
        </div>
        <button type="button" id="samChatCloseBtn" class="sam-chat-close-btn" aria-label="بستن چت">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- نوار وضعیت و ساعات کاری -->
    <div class="sam-chat-subbar">
        <span>ساعت کاری رسمی شرکت:</span>
        <span class="hours">شنبه تا چهارشنبه ۰۸:۰۰ الی ۱۶:۰۰</span>
    </div>

    <!-- بدنه چت و تاریخچه پیام‌ها -->
    <div class="sam-chat-body" id="samChatBody">
        <!-- پیام خوش‌آمدگویی هوشمند -->
        <div class="chat-bubble bot">
            سلام، به مجموعه خودرویی <strong>تامین کانی سام (سام خودرو)</strong> خوش آمدید! 👋
            <br>
            جهت تسریع در پاسخگویی، لطفاً دپارتمان مدنظر خود را انتخاب فرمایید:
        </div>

        <!-- انتخاب دپارتمان اولیه -->
        <div class="sam-dept-grid" id="samDeptOptions">
            <!-- دپارتمان فروش -->
            <div class="sam-dept-btn" onclick="selectDepartment('sales')">
                <div class="sam-dept-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                <div class="dept-text">
                    <strong>دپارتمان فروش خودروهای وارداتی</strong>
                    <span>مشاوره خرید، شرایط ثبت‌نام و قیمت روز • داخلی ۱</span>
                </div>
            </div>

            <!-- دپارتمان پشتیبانی و گارانتی -->
            <div class="sam-dept-btn" onclick="selectDepartment('support')">
                <div class="sam-dept-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
                <div class="dept-text">
                    <strong>دپارتمان خدمات پس از فروش و پشتیبانی</strong>
                    <span>گارانتی، عاملیت‌ها و امداد جاده‌ای سراسری</span>
                </div>
            </div>
        </div>
    </div>

    <!-- فوتر ارسال پیام چت -->
    <div class="sam-chat-footer">
        <input type="text" id="samChatInput" placeholder="پیام خود را بنویسید..." autocomplete="off">
        <button type="button" id="samChatSendBtn" class="sam-chat-send-btn" aria-label="ارسال">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
        </button>
    </div>
</div>

<script>
    // کنترل وضعیت آنلاین و آفلاین طبق ساعت کاری ۸ صبح الی ۱۶ عصر
    function checkBusinessHours() {
        var now = new Date();
        var tehranOffset = 3.5 * 60; // دقیقه
        var utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        var tehranDate = new Date(utc + (3600000 * 3.5));
        
        var day = tehranDate.getDay(); // 0 = یکشنبه, ..., 4 = پنجشنبه, 5 = جمعه, 6 = شنبه
        var hour = tehranDate.getHours();

        // روزهای کاری: شنبه (6) تا چهارشنبه (3) - پنجشنبه و جمعه تعطیل
        var isWorkingDay = (day === 6 || day === 0 || day === 1 || day === 2 || day === 3);
        var isWorkingHour = (hour >= 8 && hour < 16);

        return (isWorkingDay && isWorkingHour);
    }

    var isOnline = checkBusinessHours();

    // همگام‌سازی وضعیت در دکمه لانچر
    if (!isOnline) {
        $('#samBotLiveDot').css({'background': '#f87171', 'box-shadow': '0 0 6px #ef4444'});
        $('#samBotStatusText').text('پاسخگویی سریع • ثبت درخواست');
    }

    // باز و بسته شدن پنجره چت
    $('#samChatLauncher').on('click', function(){
        $('#samChatWindow').fadeIn(250).css('display', 'flex');
        $('#samChatInput').focus();
    });

    $('#samChatCloseBtn').on('click', function(){
        $('#samChatWindow').fadeOut(200);
    });

    // تابع انتخاب دپارتمان
    window.selectDepartment = function(deptKey) {
        var deptName = deptKey === 'sales' ? 'دپارتمان فروش خودروهای وارداتی' : 'دپارتمان خدمات پس از فروش و پشتیبانی';
        var operatorName = deptKey === 'sales' ? 'مهندس علیزاده' : 'مهندس محمدی';
        var operatorRole = deptKey === 'sales' ? 'کارشناس ارشد فروش و تخصیص خودرو' : 'مسئول امور مشتریان و خدمات فنی';
        var internalExt = deptKey === 'sales' ? 'داخلی ۱' : 'داخلی ۲ و خدمات';
        var phone = '041-36689000';

        // درج پیام کاربر
        $('#samChatBody').append('<div class="chat-bubble user">' + deptName + '</div>');
        $('#samDeptOptions').hide();

        setTimeout(function(){
            if (isOnline) {
                // وضعیت آنلاین
                var responseHtml = '<div class="chat-bubble bot">' +
                    'شما به <strong>' + deptName + '</strong> متصل شدید. ' + operatorName + ' هم‌اکنون آنلاین و پاسخگوی شما است.' +
                    '</div>' +
                    '<div class="sam-operator-card">' +
                        '<div class="sam-operator-header">' +
                            '<div class="sam-operator-avatar">' + operatorName.charAt(5) + '</div>' +
                            '<div class="sam-operator-name">' +
                                '<h6>' + operatorName + ' <span style="color:#10b981;">(آنلاین)</span></h6>' +
                                '<span>' + operatorRole + '</span>' +
                            '</div>' +
                        '</div>' +
                        '<div class="sam-operator-detail-row">' +
                            '<span class="label">شماره مستقیم:</span>' +
                            '<span class="val">' + phone + '</span>' +
                        '</div>' +
                        '<div class="sam-operator-detail-row">' +
                            '<span class="label">واحد ارتباطی:</span>' +
                            '<span class="val" style="color:#2563eb;">' + internalExt + '</span>' +
                        '</div>' +
                        '<div class="sam-operator-detail-row">' +
                            '<span class="label">ساعت کاری:</span>' +
                            '<span class="val">۰۸:۰۰ الی ۱۶:۰۰</span>' +
                        '</div>' +
                        '<a href="tel:04136689000" class="sam-operator-call-btn">' +
                            '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>' +
                            '<span>تماس تلفنی با ' + internalExt + '</span>' +
                        '</a>' +
                    '</div>' +
                    '<div class="chat-bubble bot" style="margin-top:6px;">می‌توانید پیام یا سوال خود را اینجا تایپ کنید تا بلافاصله بررسی شود:</div>';
                
                $('#samChatBody').append(responseHtml);
            } else {
                // وضعیت آفلاین
                var offlineHtml = '<div class="chat-bubble bot">' +
                    'در حال حاضر خارج از ساعات کاری رسمی شرکت قرار داریم. اطلاعات ارتباط مستقیم با اپراتور این واحد به شرح زیر است:' +
                    '</div>' +
                    '<div class="sam-operator-card is-offline">' +
                        '<div class="sam-operator-header">' +
                            '<div class="sam-operator-avatar" style="border-color:#ef4444; color:#ef4444;">' + operatorName.charAt(5) + '</div>' +
                            '<div class="sam-operator-name">' +
                                '<h6>' + operatorName + ' <span style="color:#ef4444; font-size:0.75rem;">(آفلاین)</span></h6>' +
                                '<span>' + operatorRole + '</span>' +
                            '</div>' +
                        '</div>' +
                        '<div class="sam-operator-detail-row">' +
                            '<span class="label">شماره دفتر مرکزی:</span>' +
                            '<span class="val">' + phone + '</span>' +
                        '</div>' +
                        '<div class="sam-operator-detail-row">' +
                            '<span class="label">کد داخلی اختصاصی:</span>' +
                            '<span class="val" style="color:#2563eb; font-weight:900;">' + internalExt + '</span>' +
                        '</div>' +
                        '<div class="sam-operator-detail-row">' +
                            '<span class="label">ساعات پاسخگویی حضوری و تلفنی:</span>' +
                            '<span class="val">۰۸:۰۰ صبح الی ۱۶:۰۰ عصر</span>' +
                        '</div>' +
                        '<a href="tel:04136689000" class="sam-operator-call-btn" style="background: linear-gradient(135deg, #1e40af, #2563eb);">' +
                            '<span>تماس در ساعت کاری با ' + internalExt + '</span>' +
                        '</a>' +
                    '</div>' +
                    '<div class="chat-bubble bot" style="margin-top:6px;">لطفاً نام و شماره همراه خود را ارسال کنید تا در اولین ساعات کاری با شما تماس گرفته شود.</div>';
                
                $('#samChatBody').append(offlineHtml);
            }

            $('#samChatBody').scrollTop($('#samChatBody')[0].scrollHeight);
        }, 400);
    };

    // ارسال پیام دلخواه
    function handleSendUserMessage() {
        var text = $('#samChatInput').val();
        if (!text || text.trim() === '') return;

        $('#samChatBody').append('<div class="chat-bubble user">' + text + '</div>');
        $('#samChatInput').val('');
        $('#samChatBody').scrollTop($('#samChatBody')[0].scrollHeight);

        setTimeout(function(){
            var reply = 'پیام شما دریافت شد. در صورت نیاز به بررسی فوری، کارشناسان واحد فروش با شماره تماس <strong>۰۴۱-۳۶۶۸۹۰۰۰ داخلی ۱</strong> در ساعات ۸ الی ۱۶ آماده پاسخگویی هستند.';
            $('#samChatBody').append('<div class="chat-bubble bot">' + reply + '</div>');
            $('#samChatBody').scrollTop($('#samChatBody')[0].scrollHeight);
        }, 700);
    }

    $('#samChatSendBtn').on('click', handleSendUserMessage);
    $('#samChatInput').on('keypress', function(e){
        if (e.which === 13) handleSendUserMessage();
    });

    // اسکریپت عضویت در خبرنامه و ارسال پیام تماس
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