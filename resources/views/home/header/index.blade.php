@php
    // بررسی امن جهت رفع قطعی خطای ۵۰۰ در صفحات داخلی
    $sections = app()->view->getSections();
    $isActive = isset($sections['active']) ? (int)$sections['active'] : 1;

    $phoneNum      = \App\Models\Setting::where('key' , 'number2')->pluck('value')->first();
    $telegramLink  = \App\Models\Setting::where('key' , 'telegram')->pluck('value')->first() ?: 'https://t.me/taminkani';
    $instagramLink = \App\Models\Setting::where('key' , 'instagram')->pluck('value')->first()
                    ?: (\App\Models\Setting::where('key' , 'insta')->pluck('value')->first() ?: 'https://instagram.com/samautomotivegroup');
    $whatsappLink  = \App\Models\Setting::where('key' , 'facebook')->pluck('value')->first();
    $baleLink      = \App\Models\Setting::where('key' , 'bale')->pluck('value')->first()
                    ?: (\App\Models\Setting::where('key' , 'ble')->pluck('value')->first() ?: 'https://ble.ir/taminkani');
    $siteLogo      = \App\Models\Setting::where('key' , 'logo')->pluck('value')->first();
    $siteTitle     = \App\Models\Setting::where('key' , 'title')->pluck('value')->first();
    $siteFavicon   = \App\Models\Setting::where('key' , 'favicon')->pluck('value')->first();

    // اصلاح ساختار آدرس فاوآیکن و پیش‌گیری قطعی از خطای ۴۰۴ در صفحات عمیق
    if (!empty($siteFavicon)) {
        $siteFavicon = trim($siteFavicon);
        if (!preg_match('~^(?:f|ht)tps?://~i', $siteFavicon) && strncmp($siteFavicon, '/', 1) !== 0) {
            $siteFavicon = '/' . $siteFavicon;
        }
    } else {
        if (!empty($siteLogo)) {
            $siteLogo = trim($siteLogo);
            if (!preg_match('~^(?:f|ht)tps?://~i', $siteLogo) && strncmp($siteLogo, '/', 1) !== 0) {
                $siteLogo = '/' . $siteLogo;
            }
            $siteFavicon = $siteLogo;
        } else {
            $siteFavicon = '/favicon.ico';
        }
    }

    // تابع تشخیص پیوندهای خارجی جهت باز شدن خودکار در تب جدید
    if (!function_exists('isExternalMenuUrl')) {
        function isExternalMenuUrl($url) {
            if (empty($url) || $url === '#' || $url === 'javascript:void(0)') return false;
            $url = trim($url);
            if (preg_match('~^(?:https?:)?//~i', $url)) {
                return true;
            }
            return false;
        }
    }
@endphp

<style>
    /* نمایش تضمینی محتوای صفحه اصلی */
    .allIndexWidgets .indexData,
    .indexData {
        opacity: 1 !important;
        visibility: visible !important;
        display: block !important;
    }

    :root {
        --hdr-bg-main: rgba(236, 242, 252, 0.96);
        --hdr-bg-top: #ffffff;
        --hdr-navy-border: rgba(30, 58, 138, 0.12);
        --hdr-accent: #2563eb;
        --hdr-accent-hover: #1d4ed8;
        --hdr-border: rgba(226, 232, 240, 0.9);
        --hdr-text: #0f172a;
        --hdr-text-muted: #64748b;
        --hdr-nav-height: 48px;
        --hdr-drawer-bg: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        --hdr-crimson: #dc2626;
        --hdr-crimson-bg: rgba(239, 68, 68, 0.08);
        --hdr-crimson-border: rgba(239, 68, 68, 0.35);
    }

    /* کانتینر اصلی هدر با هاله نوری سرمه‌ای با اوپاسیتی کنترل‌شده */
    .allHeaderHome {
        position: sticky !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 1000 !important;
        background: var(--hdr-bg-main) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        box-shadow: 0 10px 30px -10px rgba(11, 19, 41, 0.1) !important;
        border-bottom: 1px solid var(--hdr-navy-border) !important;
        direction: rtl !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        margin: 0 !important;
        padding: 0 !important;
        box-sizing: border-box !important;
    }

    /* نوار تاپ‌هدر دسکتاپ - سفید خالص جهت تمایز آشکار با نوار ناوبری */
    .allHeaderHome .top {
        background: var(--hdr-bg-top) !important;
        padding: 8px 0 !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
        font-size: 0.83rem !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .allHeaderHome .top .width {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 32px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        box-sizing: border-box !important;
        gap: 16px !important;
    }

    .top-right-badges {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        flex-shrink: 1 !important;
        min-width: 0 !important;
    }

    .top-live-pulse {
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        box-shadow: 0 0 10px #2563eb !important;
        animation: pulseLive 2s infinite !important;
        flex-shrink: 0 !important;
    }

    @keyframes pulseLive {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(37, 99, 235, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
    }

    .top-company-text {
        color: #1e293b !important;
        font-weight: 700 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        letter-spacing: -0.2px !important;
    }

    .allHeaderHome .top .left {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        flex-shrink: 0 !important;
        margin-right: auto !important;
    }

    .top-social-group {
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding-left: 10px !important;
        border-left: 1px solid #e2e8f0 !important;
    }

    .top-social-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 32px !important;
        height: 32px !important;
        border-radius: 9px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #64748b !important;
        transition: all 0.25s ease !important;
        text-decoration: none !important;
        flex-shrink: 0 !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03) !important;
    }

    .top-social-btn:hover {
        background: #eff6ff !important;
        border-color: #3b82f6 !important;
        color: #1d4ed8 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.15) !important;
    }

    .top-social-btn svg {
        width: 15px !important;
        height: 15px !important;
        fill: currentColor !important;
    }

    .premium-login-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        padding: 7px 18px !important;
        border-radius: 99px !important;
        font-size: 0.84rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.25) !important;
        white-space: nowrap !important;
        flex-shrink: 0 !important;
        position: relative !important;
        overflow: hidden !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .premium-login-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 22px rgba(37, 99, 235, 0.45) !important;
        color: #ffffff !important;
    }

    /* نوار اصلی ناوبری با تنالیته سرمه‌ای ملایم */
    .allHeaderHome .bottom {
        padding: 7px 0 !important;
        background: linear-gradient(180deg, rgba(236, 242, 252, 0.96) 0%, rgba(228, 238, 250, 0.94) 100%) !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .allHeaderHome .bottom.width {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 32px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        box-sizing: border-box !important;
        gap: 20px !important;
    }

    .allHeaderHome .bottom .right {
        display: flex !important;
        align-items: center !important;
        gap: 22px !important;
        flex-shrink: 1 !important;
        min-width: 0 !important;
        margin-right: 0 !important;
    }

    .allHeaderHome .bottom .right figure {
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
    }

    .allHeaderHome .bottom .right figure .pic img {
        height: 44px !important;
        width: auto !important;
        display: block !important;
        object-fit: contain !important;
        filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.08)) !important;
        transition: transform 0.3s ease !important;
    }

    nav {
        position: relative !important;
        min-width: 0 !important;
    }

    nav ul {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        flex-wrap: nowrap !important;
    }

    nav ul > li {
        position: relative !important;
        margin: 0 !important;
        padding: 4px 0 !important;
        flex-shrink: 0 !important;
    }

    /* آیتم‌های منو با انیمیشن زیرخط در هاور */
    .nav-uniform-link {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 5px !important;
        height: var(--hdr-nav-height) !important;
        padding: 0 14px !important;
        border-radius: 8px !important;
        background: transparent !important;
        color: #1e293b !important;
        font-weight: 700 !important;
        font-size: 0.92rem !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        position: relative !important;
        cursor: pointer !important;
        box-sizing: border-box !important;
        transition: color 0.25s ease !important;
    }

    .nav-uniform-link::after {
        content: '' !important;
        position: absolute !important;
        bottom: 5px !important;
        right: 12px !important;
        left: 12px !important;
        height: 2.5px !important;
        background: var(--hdr-accent) !important;
        border-radius: 4px !important;
        transform: scaleX(0) !important;
        transform-origin: right !important;
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    nav ul > li:hover > .nav-uniform-link,
    .nav-uniform-link:hover {
        color: var(--hdr-accent) !important;
    }

    nav ul > li:hover > .nav-uniform-link::after,
    .nav-uniform-link:hover::after {
        transform: scaleX(1) !important;
        transform-origin: right !important;
    }

    /* دکمه سامانه فروش قرمز و بولد */
    .nav-uniform-link.nav-link-red-bold {
        color: #dc2626 !important;
        font-weight: 900 !important;
        background: rgba(239, 68, 68, 0.08) !important;
        border: 1px solid rgba(239, 68, 68, 0.28) !important;
        border-radius: 10px !important;
        padding: 0 14px !important;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.12) !important;
        letter-spacing: -0.2px !important;
    }

    .nav-uniform-link.nav-link-red-bold:hover {
        color: #b91c1c !important;
        background: rgba(239, 68, 68, 0.16) !important;
        border-color: #ef4444 !important;
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.24) !important;
        transform: translateY(-1px) !important;
    }

    .nav-uniform-link.nav-link-red-bold::after {
        background: #dc2626 !important;
    }

    .red-ping-dot {
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: #ef4444 !important;
        box-shadow: 0 0 8px #ef4444 !important;
        flex-shrink: 0 !important;
        animation: pulseRedDot 1.6s infinite !important;
    }

    @keyframes pulseRedDot {
        0%, 100% { transform: scale(0.9); opacity: 0.8; }
        50% { transform: scale(1.35); opacity: 1; box-shadow: 0 0 12px #dc2626; }
    }

    .drawer-item-link.drawer-link-red-bold {
        color: #dc2626 !important;
        font-weight: 900 !important;
        gap: 8px !important;
    }

    .drawer-menu-item.is-red-highlight {
        background: #fff5f5 !important;
        border-color: #fecaca !important;
    }

    .nav-arrow-icon {
        width: 12px !important;
        height: 12px !important;
        min-width: 12px !important;
        color: #94a3b8 !important;
        transition: transform 0.25s ease, color 0.25s ease !important;
        margin-right: 1px !important;
        flex-shrink: 0 !important;
    }

    nav ul > li:hover > .nav-uniform-link .nav-arrow-icon {
        transform: rotate(180deg) !important;
        color: var(--hdr-accent) !important;
    }

    /* ساب‌منوی راست‌چین دسکتاپ */
    .underMenu {
        position: absolute !important;
        top: 100% !important;
        right: 0 !important;
        left: auto !important;
        direction: rtl !important;
        text-align: right !important;
        background: #ffffff !important;
        min-width: 270px !important;
        border-radius: 14px !important;
        padding: 8px !important;
        box-shadow: 0 20px 40px -8px rgba(15, 23, 42, 0.14), 0 0 0 1px rgba(226, 232, 240, 0.9) inset !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(12px) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        list-style: none !important;
        z-index: 1050 !important;
        margin-top: 2px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 4px !important;
        box-sizing: border-box !important;
    }

    nav ul > li:hover .underMenu {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
    }

    .underMenu li {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        direction: rtl !important;
        text-align: right !important;
        box-sizing: border-box !important;
    }

    .underMenu li a {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        text-align: right !important;
        direction: rtl !important;
        gap: 10px !important;
        padding: 10px 14px !important;
        border-radius: 10px !important;
        font-size: 0.88rem !important;
        font-weight: 700 !important;
        color: #334155 !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        background: transparent !important;
        width: 100% !important;
        box-sizing: border-box !important;
        position: relative !important;
    }

    .underMenu li a:hover {
        background: #eff6ff !important;
        color: #1d4ed8 !important;
        transform: translateX(-4px) !important;
    }

    .underMenu-item-content,
    .drawer-item-inner {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        direction: rtl !important;
        text-align: right !important;
    }

    .underMenu-dot,
    .drawer-sub-dot {
        width: 6px !important;
        height: 6px !important;
        min-width: 6px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        opacity: 0.55 !important;
        transition: all 0.2s ease !important;
        flex-shrink: 0 !important;
    }

    .underMenu li a:hover .underMenu-dot,
    .drawer-submenu li a:hover .drawer-sub-dot {
        opacity: 1 !important;
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.6) !important;
        transform: scale(1.3) !important;
    }

    /* استایل اختصاصی آخرین بخشنامه فروش جاری */
    .underMenu li a.latest-sale-notice,
    .drawer-submenu li a.latest-sale-notice {
        color: #dc2626 !important;
        font-weight: 900 !important;
        background: var(--hdr-crimson-bg) !important;
        border: 1px solid var(--hdr-crimson-border) !important;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.12) !important;
        letter-spacing: -0.2px !important;
    }

    .underMenu li a.latest-sale-notice .underMenu-dot,
    .drawer-submenu li a.latest-sale-notice .drawer-sub-dot {
        background: #dc2626 !important;
        opacity: 1 !important;
        box-shadow: 0 0 8px #ef4444 !important;
        transform: scale(1.3) !important;
    }

    .underMenu li a.latest-sale-notice:hover,
    .drawer-submenu li a.latest-sale-notice:hover {
        background: rgba(239, 68, 68, 0.15) !important;
        border-color: #ef4444 !important;
        color: #b91c1c !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.22) !important;
        transform: translateX(-5px) scale(1.01) !important;
    }

    .circular-live-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        background: #fef2f2 !important;
        border: 1px solid #fca5a5 !important;
        color: #dc2626 !important;
        padding: 2px 8px !important;
        border-radius: 99px !important;
        font-size: 0.72rem !important;
        font-weight: 800 !important;
        margin-right: auto !important;
        white-space: nowrap !important;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.15) !important;
    }

    .circular-ping {
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #ef4444 !important;
        box-shadow: 0 0 8px #ef4444 !important;
        animation: pulseCircular 1.5s infinite ease-in-out !important;
        flex-shrink: 0 !important;
    }

    @keyframes pulseCircular {
        0%, 100% { transform: scale(0.9); opacity: 0.75; }
        50% { transform: scale(1.35); opacity: 1; box-shadow: 0 0 12px #dc2626; }
    }

    /* بخش چپ هدر در دسکتاپ */
    .allHeaderHome .bottom .left {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        flex-shrink: 0 !important;
        margin-right: auto !important;
        margin-left: 0 !important;
    }

    /* کانتینر مجتمع شماره تماس و شبکه‌های اجتماعی (اینستاگرام و بله) */
    .header-phone-social-combo {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .callHeader {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        padding: 6px 14px !important;
        border-radius: 99px !important;
        color: #0f172a !important;
        font-size: 0.88rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        direction: ltr !important;
        transition: all 0.25s ease !important;
        white-space: nowrap !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04) !important;
    }

    .callHeader:hover {
        background: #f8fafc !important;
        border-color: #2563eb !important;
        color: #2563eb !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.12) !important;
    }

    .callHeader i {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 26px !important;
        height: 26px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #0284c7, #2563eb) !important;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.35) !important;
        flex-shrink: 0 !important;
    }

    .callHeader i svg {
        width: 13px !important;
        height: 13px !important;
        fill: currentColor !important;
    }

    /* دکمه‌های آیکونی اینستاگرام و بله مستقر در کنار شماره تماس */
    .hdr-inline-socials {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .hdr-social-icon {
        width: 38px !important;
        height: 38px !important;
        border-radius: 11px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        flex-shrink: 0 !important;
    }

    .hdr-social-icon svg {
        width: 18px !important;
        height: 18px !important;
        transition: transform 0.25s ease !important;
    }

    .hdr-social-icon:hover {
        transform: translateY(-2px) !important;
    }

    .hdr-social-icon:hover svg {
        transform: scale(1.1) !important;
    }

    /* استایل اختصاصی اینستاگرام */
    .hdr-social-icon.insta {
        color: #e1306c !important;
    }

    .hdr-social-icon.insta:hover {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%) !important;
        border-color: transparent !important;
        color: #ffffff !important;
        box-shadow: 0 6px 16px rgba(214, 36, 159, 0.35) !important;
    }

    /* استایل اختصاصی پیام‌رسان بله */
    .hdr-social-icon.bale {
        color: #00a693 !important;
    }

    .hdr-social-icon.bale:hover {
        background: #00a693 !important;
        border-color: #00a693 !important;
        color: #ffffff !important;
        box-shadow: 0 6px 16px rgba(0, 166, 147, 0.35) !important;
    }

    .sendHeader {
        width: 38px !important;
        height: 38px !important;
        border-radius: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        cursor: pointer !important;
        color: #475569 !important;
        transition: all 0.25s ease !important;
        flex-shrink: 0 !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03) !important;
    }

    .sendHeader:hover {
        background: #2563eb !important;
        color: #ffffff !important;
        border-color: #2563eb !important;
        transform: translateY(-1px) !important;
    }

    .sendHeader svg {
        width: 16px !important;
        height: 16px !important;
        fill: currentColor !important;
    }

    /* نوار شبکه‌های اجتماعی داخل هدر موبایل (در دسکتاپ مخفی است) */
    .mobile-social-bar {
        display: none !important;
    }

    .mobile-social-icon {
        width: 34px !important;
        height: 34px !important;
        border-radius: 9px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #475569 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03) !important;
        transition: all 0.2s ease !important;
        flex-shrink: 0 !important;
    }

    .mobile-social-icon:active {
        transform: scale(0.92) !important;
        background: #eff6ff !important;
        color: #2563eb !important;
    }

    .mobile-social-icon svg {
        width: 15px !important;
        height: 15px !important;
        fill: currentColor !important;
    }

    /* دکمه منوی موبایل */
    .resAlign {
        display: none !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 12px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #0f172a !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        flex-shrink: 0 !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        -webkit-tap-highlight-color: transparent !important;
        touch-action: manipulation !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04) !important;
    }

    .resAlign:active {
        transform: scale(0.92) !important;
        background: #eff6ff !important;
    }

    .resAlign svg {
        width: 22px !important;
        height: 22px !important;
        stroke: currentColor !important;
        stroke-width: 2.2 !important;
    }

    /* منوی کشویی موبایل (Mobile Drawer) */
    .mobile-menu-backdrop {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(15, 23, 42, 0.45) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        z-index: 99998 !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transition: opacity 0.35s ease, visibility 0.35s ease !important;
        pointer-events: none !important;
    }

    .mobile-menu-backdrop.is-open {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }

    .categoryHeaderResponsive {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 320px !important;
        max-width: 88vw !important;
        height: 100vh !important;
        background: var(--hdr-drawer-bg) !important;
        box-shadow: -15px 0 45px rgba(15, 23, 42, 0.12), inset -1px 0 0 #e2e8f0 !important;
        z-index: 99999 !important;
        transform: translateX(100%) !important;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        direction: rtl !important;
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch !important;
        box-sizing: border-box !important;
        display: flex !important;
        flex-direction: column !important;
        padding: 0 !important;
    }

    .categoryHeaderResponsive.is-open {
        transform: translateX(0) !important;
    }

    .drawer-top-bar {
        padding: 20px 22px 18px 22px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-bottom: 1px solid #e2e8f0 !important;
        background: #f8fafc !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 10 !important;
        backdrop-filter: blur(10px) !important;
    }

    .drawer-brand {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .drawer-brand img {
        height: 36px !important;
        width: auto !important;
        object-fit: contain !important;
    }

    .drawer-brand-text {
        display: flex !important;
        flex-direction: column !important;
    }

    .drawer-brand-text strong {
        color: #0f172a !important;
        font-size: 0.95rem !important;
        font-weight: 900 !important;
    }

    .drawer-brand-text span {
        color: #059669 !important;
        font-size: 0.72rem !important;
        font-weight: 700 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
    }

    .drawer-brand-text span::before {
        content: '' !important;
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #10b981 !important;
        box-shadow: 0 0 6px #10b981 !important;
    }

    .drawer-close-btn {
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #64748b !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03) !important;
    }

    .drawer-close-btn:hover,
    .drawer-close-btn:active {
        background: #fee2e2 !important;
        border-color: #fca5a5 !important;
        color: #dc2626 !important;
        transform: rotate(90deg) !important;
    }

    .drawer-close-btn svg {
        width: 18px !important;
        height: 18px !important;
        stroke: currentColor !important;
        stroke-width: 2.2 !important;
    }

    .drawer-body {
        padding: 20px 18px 30px 18px !important;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 16px !important;
    }

    .drawer-actions-box {
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
        margin-bottom: 8px !important;
    }

    .drawer-login-btn {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        padding: 13px 20px !important;
        border-radius: 14px !important;
        font-size: 0.94rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.3) !important;
    }

    .drawer-login-btn svg {
        width: 17px !important;
        height: 17px !important;
        stroke-width: 2.2 !important;
    }

    .drawer-phone-btn {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 11px 16px !important;
        border-radius: 14px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #334155 !important;
        font-size: 0.88rem !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        direction: rtl !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02) !important;
    }

    .drawer-phone-btn span.num {
        direction: ltr !important;
        font-weight: 900 !important;
        color: #2563eb !important;
    }

    .drawer-menu-list {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
    }

    .drawer-menu-item {
        position: relative !important;
        border-radius: 14px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        overflow: hidden !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02) !important;
    }

    .drawer-menu-item.is-expanded {
        background: #ffffff !important;
        border-color: #bfdbfe !important;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.08) !important;
    }

    .drawer-item-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 12px 14px !important;
    }

    .drawer-item-link {
        display: flex !important;
        align-items: center !important;
        color: #0f172a !important;
        font-size: 0.94rem !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        flex: 1 !important;
        padding: 4px 0 !important;
    }

    .drawer-chevron {
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #64748b !important;
        cursor: pointer !important;
        transition: transform 0.3s ease, color 0.3s ease !important;
        flex-shrink: 0 !important;
    }

    .drawer-chevron svg {
        width: 15px !important;
        height: 15px !important;
        stroke-width: 2.4 !important;
        transition: transform 0.3s ease !important;
    }

    .drawer-menu-item.is-expanded .drawer-chevron {
        color: #2563eb !important;
        transform: rotate(90deg) !important;
    }

    .drawer-submenu {
        display: none;
        list-style: none !important;
        margin: 0 !important;
        padding: 6px 14px 12px 14px !important;
        border-top: 1px dashed #e2e8f0 !important;
        background: #f8fafc !important;
    }

    .drawer-submenu li {
        margin: 5px 0 !important;
    }

    .drawer-submenu li a {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        direction: rtl !important;
        text-align: right !important;
        gap: 10px !important;
        padding: 9px 12px !important;
        border-radius: 8px !important;
        color: #475569 !important;
        font-size: 0.86rem !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }

    .drawer-submenu li a:hover,
    .drawer-submenu li a:active {
        color: #1d4ed8 !important;
        background: #eff6ff !important;
        transform: translateX(-4px) !important;
    }

    .drawer-submenu li a::before {
        content: '' !important;
        width: 5px !important;
        height: 5px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        opacity: 0.6 !important;
    }

    .drawer-footer {
        padding: 16px 20px 24px 20px !important;
        border-top: 1px solid #e2e8f0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 12px !important;
        background: #f8fafc !important;
    }

    .drawer-socials {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .drawer-social-btn {
        width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #64748b !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03) !important;
    }

    .drawer-social-btn:hover {
        background: #eff6ff !important;
        color: #1d4ed8 !important;
        border-color: #3b82f6 !important;
    }

    .drawer-social-btn svg {
        width: 17px !important;
        height: 17px !important;
        fill: currentColor !important;
    }

    .drawer-copy-text {
        font-size: 0.74rem !important;
        color: #64748b !important;
        text-align: center !important;
    }

    /* مودال سرچ */
    .allSearch {
        display: none;
        position: fixed !important;
        inset: 0 !important;
        background: rgba(15, 23, 42, 0.6) !important;
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        z-index: 2000 !important;
        padding: 40px 20px !important;
        box-sizing: border-box !important;
    }

    .topSearch {
        max-width: 680px;
        margin: 40px auto 20px auto;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
    }

    .topSearch label {
        flex-grow: 1;
        position: relative;
        display: flex;
        align-items: center;
        margin: 0;
    }

    .topSearch input {
        width: 100%;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #0f172a;
        padding: 14px 44px 14px 20px;
        border-radius: 14px;
        font-size: 1rem;
        outline: none;
        box-sizing: border-box;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .topSearch label i {
        position: absolute;
        right: 16px;
        color: #64748b;
        display: flex;
        align-items: center;
    }

    .topSearch label i svg {
        width: 18px;
        height: 18px;
    }

    .topSearch button {
        background: linear-gradient(135deg, #1e40af, #2563eb);
        color: #ffffff;
        border: none;
        padding: 14px 26px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
    }

    .closeSearch {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .closeSearch svg {
        width: 18px;
        height: 18px;
    }

    .allSearch ul {
        max-width: 680px;
        margin: 0 auto;
        padding: 0;
        list-style: none;
        max-height: 60vh;
        overflow-y: auto;
    }

    .allSearch ul li {
        margin-bottom: 10px;
    }

    .allSearch ul li a {
        display: block;
        padding: 14px 18px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .allSearch ul li h4 {
        margin: 0 0 4px 0;
        color: #0f172a;
        font-size: 1rem;
        font-weight: 800;
    }

    .allSearch ul li h5 {
        margin: 0 0 6px 0;
        color: #2563eb;
        font-size: 0.8rem;
        direction: ltr;
        text-align: right;
    }

    .allSearch ul li p {
        margin: 0;
        color: #64748b;
        font-size: 0.85rem;
    }

    /* واکنش‌گرایی دسکتاپ و تبلت */
    @media (max-width: 1280px) {
        .nav-uniform-link { padding: 0 10px !important; font-size: 0.88rem !important; }
        .allHeaderHome .top .width, .allHeaderHome .bottom.width { padding: 0 20px !important; }
    }

    @media (max-width: 1140px) {
        nav { display: none !important; }
        .resAlign { display: flex !important; }
        .allHeaderHome .top .left .top-social-group { display: none !important; }
    }

    /* ==========================================================================
       ریسپانسیو ویژه موبایل: چیدمان دقیق دکمه‌ها و شبکه‌ها
       ========================================================================== */
    @media (max-width: 768px) {
        .allHeaderHome .top { 
            display: none !important; 
        }

        .allHeaderHome {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        .allHeaderHome .bottom,
        .allHeaderHome .bottom.width {
            width: 100% !important;
            max-width: 100% !important;
            padding: 8px 12px !important;
            margin: 0 !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            box-sizing: border-box !important;
            gap: 6px !important;
        }

        /* لوگوی شرکت در منتهی‌الیه سمت راست */
        .allHeaderHome .bottom .right {
            margin: 0 !important;
            margin-right: 0 !important;
            margin-left: auto !important;
            padding: 0 !important;
            flex-shrink: 0 !important;
            display: flex !important;
            align-items: center !important;
        }

        .allHeaderHome .bottom .right figure .pic img {
            height: 38px !important;
            max-width: 115px !important;
        }

        /* بخش سمت چپ: تراز کامل به سمت چپ */
        .allHeaderHome .bottom .left {
            margin: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 5px !important;
            direction: ltr !important;
            flex-shrink: 0 !important;
        }

        .callHeader span.num { 
            display: none !important; 
        }

        .callHeader {
            padding: 6px !important;
            width: 34px !important;
            height: 34px !important;
            border-radius: 10px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .callHeader i {
            width: 22px !important;
            height: 22px !important;
            box-shadow: none !important;
        }

        .header-phone-social-combo {
            gap: 4px !important;
        }

        .hdr-inline-socials {
            gap: 4px !important;
        }

        .hdr-social-icon {
            width: 34px !important;
            height: 34px !important;
            border-radius: 10px !important;
        }

        .hdr-social-icon svg {
            width: 16px !important;
            height: 16px !important;
        }

        .sendHeader {
            width: 34px !important;
            height: 34px !important;
            border-radius: 10px !important;
        }

        .resAlign {
            width: 36px !important;
            height: 36px !important;
            border-radius: 10px !important;
        }

        .mobile-social-bar {
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
        }

        .mobile-social-icon {
            width: 34px !important;
            height: 34px !important;
            border-radius: 10px !important;
        }
    }
</style>

<div class="allHeaderHome {{ $isActive ? 'active' : '' }}">
    <!-- نوار بالایی هدر (تاپ هدر دسکتاپ) -->
    <div class="top">
        <div class="width">
            <div class="top-right-badges">
                <span class="top-live-pulse"></span>
                <span class="top-company-text">تامین کانی سام (گروه خودرویی سام) - وارد کننده رسمی خودروهای پلاک ملی و منطقه آزاد</span>
            </div>

            <div class="left">
                <!-- شبکه‌های اجتماعی سازمانی در تاپ‌هدر -->
                <div class="top-social-group">
                    @if(!empty($telegramLink))
                        <a href="{{$telegramLink}}" class="top-social-btn" title="تلگرام" target="_blank" rel="noopener noreferrer">
                            <svg class="icon"><use xlink:href="#telegram"></use></svg>
                        </a>
                    @endif
                    <a href="{{$instagramLink}}" class="top-social-btn" title="اینستاگرام" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    @if(!empty($whatsappLink))
                        <a href="{{$whatsappLink}}" class="top-social-btn" title="واتساپ" target="_blank" rel="noopener noreferrer">
                            <svg class="icon"><use xlink:href="#whatsapp"></use></svg>
                        </a>
                    @endif
                    <a href="{{$baleLink}}" class="top-social-btn" title="پیام‌رسان بله" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.25 2 11.5c0 2.3.85 4.41 2.3 6.06L3.08 21.2a.75.75 0 0 0 .93.93l3.86-1.23C9.35 21.6 10.65 22 12 22c5.52 0 10-4.25 10-9.5S17.52 2 12 2zm-1.5 13.5l-3.5-3.5 1.41-1.41L10.5 12.67l5.59-5.59L17.5 8.5l-7 7z"/>
                        </svg>
                    </a>
                </div>

                <a href="https://sell.taminkanisam.co.ir/" target="_blank" rel="noopener noreferrer" class="premium-login-btn" title="ورود به سامانه فروش">
                    <span>ورود به سامانه فروش</span>
                </a>
            </div>
        </div>
    </div>

    @php
        // واکشی امن تمامی پیوندهای ریشه و زیرمنوها از دیتابیس
        $dbNavLinks = \App\Models\Link::where('type', 0)->whereNull('parent_id')->with('childs')->get();

        // تعریف توالی دقیق و استانداردهای منوهای سایت
        $orderedMenuItems = [
            [
                'name'     => 'صفحه اصلی',
                'fallback' => '/',
                'match'    => ['صفحه اصلی', 'خانه', 'home'],
                'is_red'   => false,
            ],
            [
                'name'     => 'محصولات',
                'fallback' => '/products',
                'match'    => ['محصولات', 'محصول', 'خودروها', 'product'],
                'is_red'   => false,
            ],
            [
                'name'     => 'خدمات پس از فروش',
                'fallback' => '#',
                'match'    => ['خدمات پس از فروش', 'خدمات'],
                'is_red'   => false,
            ],
            [
                'name'     => 'امور مشتریان',
                'fallback' => '#',
                'match'    => ['امور مشتریان', 'مشتریان'],
                'is_red'   => false,
            ],
            [
                'name'     => 'اطلاعیه های فروش',
                'fallback' => '#',
                'match'    => ['اطلاعیه های فروش', 'اطلاعیه ها', 'بخشنامه'],
                'is_red'   => false,
            ],
            [
                'name'     => 'اخبار و اطلاعیه ها',
                'fallback' => '/blogs',
                'match'    => ['اخبار و اطلاعیه ها', 'اخبار', 'بلاگ', 'مقالات'],
                'is_red'   => false,
            ],
            [
                'name'     => 'سامانه فروش',
                'fallback' => 'https://sell.taminkanisam.co.ir/',
                'match'    => ['سامانه فروش', 'سامانه'],
                'is_red'   => true, // با رنگ قرمز و بولد
            ],
            [
                'name'     => 'درباره ما',
                'fallback' => '/page/درباره-ما',
                'match'    => ['درباره ما', 'درباره'],
                'is_red'   => false,
            ],
            [
                'name'     => 'تماس',
                'fallback' => '/contact',
                'match'    => ['تماس با ما', 'تماس'],
                'is_red'   => false,
            ],
        ];

        // تطبیق هوشمند با رکوردهای دیتابیس برای حفظ ساختار زیرمنوها و پیوندها
        $structuredNavigation = [];
        $consumedIds = [];

        foreach ($orderedMenuItems as $target) {
            $matchedRecord = null;
            foreach ($dbNavLinks as $dbLink) {
                if (in_array($dbLink->id, $consumedIds)) continue;
                foreach ($target['match'] as $kw) {
                    $nameLower = mb_strtolower($dbLink->name, 'UTF-8');
                    $kwLower   = mb_strtolower($kw, 'UTF-8');
                    if (str_contains($nameLower, $kwLower)) {
                        // جلوگیری از تداخل اطلاعیه‌های فروش با اخبار و اطلاعیه‌ها
                        if ($target['name'] === 'اطلاعیه های فروش' && str_contains($nameLower, 'اخبار')) {
                            continue;
                        }
                        if ($target['name'] === 'اخبار و اطلاعیه ها' && str_contains($nameLower, 'فروش')) {
                            continue;
                        }
                        $matchedRecord = $dbLink;
                        $consumedIds[] = $dbLink->id;
                        break 2;
                    }
                }
            }

            $childItems = $matchedRecord ? $matchedRecord->childs : collect([]);
            if ($target['name'] === 'خدمات پس از فروش') {
                $hasTireChild = $childItems->contains(function($c) {
                    return str_contains($c->name, 'لاستیک') && str_contains($c->name, 'نمایندگان');
                });
                if (!$hasTireChild) {
                    $pseudoChild = new \App\Models\Link([
                        'id' => 99991,
                        'name' => 'نمایندگان گارانتی لاستیک',
                        'slug' => '/tire-warranty-agents',
                        'parent_id' => $matchedRecord ? $matchedRecord->id : 12,
                        'type' => 0
                    ]);
                    $childItems->push($pseudoChild);
                }
            }

            $structuredNavigation[] = [
                'name'     => $target['name'],
                'slug'     => $matchedRecord ? $matchedRecord->slug : $target['fallback'],
                'is_red'   => $target['is_red'],
                'childs'   => $childItems,
                'db_id'    => $matchedRecord ? $matchedRecord->id : null,
            ];
        }
    @endphp

    <!-- نوار اصلی ناوبری با تنالیته سرمه‌ای ملایم -->
    <div class="bottom width">
        <!-- سمت راست: لوگو و ناوبری دسکتاپ با چینش دقیق درخواستی -->
        <div class="right">
            <figure>
                <a href="/" class="pic" aria-label="صفحه اصلی">
                    <img class="lazyload" 
                         src="{{ $siteLogo }}" 
                         alt="{{ $siteTitle }}">
                </a>
            </figure>

            <nav>
                <ul>
                    @if(auth()->user())
                        @if(auth()->user()->level == 2 || auth()->user()->level == 3)
                            <li>
                                <a href="/admin" class="nav-uniform-link" style="color: #2563eb !important;">
                                    <span>پنل مدیریت</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @foreach($structuredNavigation as $item)
                        @php
                            $hasChilds = !empty($item['childs']) && $item['childs']->count() > 0;
                            $isRed = $item['is_red'];
                            $isItemExternal = $isRed || isExternalMenuUrl($item['slug']);
                        @endphp
                        <li>
                            <a href="{{ $item['slug'] }}" 
                               class="nav-uniform-link {{ $isRed ? 'nav-link-red-bold' : '' }}"
                               {!! $isItemExternal ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>
                                @if($isRed)
                                    <span class="red-ping-dot"></span>
                                @endif
                                <span>{{ $item['name'] }}</span>
                                
                                @if($hasChilds)
                                    <svg class="nav-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                @endif
                            </a>

                            @if($hasChilds)
                                @php
                                    // تشخیص منحصراً منوی اطلاعیه‌های فروش و بخشنامه‌ها
                                    $isAnnouncementMenu = (str_contains($item['name'], 'اطلاعیه های فروش') || str_contains($item['name'], 'بخشنامه')) && !str_contains($item['name'], 'خدمات');
                                    $lastChild = $isAnnouncementMenu ? $item['childs']->sortByDesc('id')->first() : null;
                                    $latestCircularId = $lastChild ? $lastChild->id : null;
                                @endphp
                                <ul class="underMenu">
                                    @foreach($item['childs'] as $child)
                                        @php
                                            $isCurrentCircular = ($isAnnouncementMenu && $child->id == $latestCircularId);
                                            $isChildExternal = isExternalMenuUrl($child->slug);
                                        @endphp
                                        <li>
                                            <a href="{{ $child->slug }}" 
                                               class="{{ $isCurrentCircular ? 'latest-sale-notice' : '' }}" 
                                               title="{{ $child->name }}"
                                               {!! $isChildExternal ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>
                                                <div class="underMenu-item-content">
                                                    <span class="underMenu-dot"></span>
                                                    <span>{{ $child->name }}</span>
                                                </div>
                                                @if($isCurrentCircular)
                                                    <span class="circular-live-badge">
                                                        <span class="circular-ping"></span>
                                                        <span>بخشنامه جاری</span>
                                                    </span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <!-- سمت چپ: کلیه دکمه‌های سرچ، تماس، اینستاگرام، بله و منوی موبایل -->
        <div class="left">
            <!-- ۱. دکمه منوی کشویی موبایل -->
            <div class="resAlign" role="button" aria-label="منوی سایت" tabindex="0">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </div>

            <!-- ۲. دکمه سرچ -->
            <div class="sendHeader" title="جستجو در وب‌سایت" role="button" aria-label="جستجو">
                <i>
                    <svg class="icon"><use xlink:href="#search"></use></svg>
                </i>
            </div>

            <!-- ۳. گروه ترکیبی شماره تماس و شبکه‌های اجتماعی (اینستاگرام و بله) -->
            <div class="header-phone-social-combo">
                @if(!empty($phoneNum))
                    <a href="tel:{{$phoneNum}}" class="callHeader" title="تماس با کارشناسان">
                        <i>
                            <svg class="icon"><use xlink:href="#phone-call"></use></svg>
                        </i>
                        <span class="num">{{$phoneNum}}</span>
                    </a>
                @endif

                <div class="hdr-inline-socials">
                    <!-- دکمه اینستاگرام رسمی با آیکون اختصاصی و تضمین نمایش -->
                    <a href="{{ $instagramLink }}" class="hdr-social-icon insta" title="اینستاگرام رسمی" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>

                    <!-- دکمه پیام‌رسان بله -->
                    <a href="{{ $baleLink }}" class="hdr-social-icon bale" title="پیام‌رسان بله" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.25 2 11.5c0 2.3.85 4.41 2.3 6.06L3.08 21.2a.75.75 0 0 0 .93.93l3.86-1.23C9.35 21.6 10.65 22 12 22c5.52 0 10-4.25 10-9.5S17.52 2 12 2zm-1.5 13.5l-3.5-3.5 1.41-1.41L10.5 12.67l5.59-5.59L17.5 8.5l-7 7z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- ۴. شبکه‌های اجتماعی موبایل در منتهی‌الیه سمت چپ -->
            <div class="mobile-social-bar">
                @if(!empty($telegramLink))
                    <a href="{{$telegramLink}}" class="mobile-social-icon" title="تلگرام" target="_blank" rel="noopener noreferrer">
                        <svg class="icon"><use xlink:href="#telegram"></use></svg>
                    </a>
                @endif
                @if(!empty($whatsappLink))
                    <a href="{{$whatsappLink}}" class="mobile-social-icon" title="واتساپ" target="_blank" rel="noopener noreferrer">
                        <svg class="icon"><use xlink:href="#whatsapp"></use></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- مودال جستجو -->
    <div class="allSearch">
        <div class="topSearch">
            <label for="mainSearchInput">
                <input type="text" id="mainSearchInput" name="search" placeholder="جستجو در محصولات، خدمات، مقالات...">
                <i>
                    <svg class="icon"><use xlink:href="#search"></use></svg>
                </i>
            </label>
            <button type="button">جستجو</button>
            <i class="closeSearch" role="button" aria-label="بستن جستجو">
                <svg class="icon"><use xlink:href="#cancel"></use></svg>
            </i>
        </div>
        <ul></ul>
    </div>
</div>

<!-- بک‌دراپ شیشه‌ای پشت منوی موبایل -->
<div id="mobileMenuBackdrop" class="mobile-menu-backdrop"></div>

<!-- منوی کشویی موبایل -->
<aside id="mobileDrawerMenu" class="categoryHeaderResponsive" aria-label="منوی موبایل">
    <!-- هدر داخلی منو -->
    <div class="drawer-top-bar">
        <div class="drawer-brand">
            <img src="{{ $siteLogo }}" alt="{{ $siteTitle }}">
            <div class="drawer-brand-text">
                <strong>تامین کانی سام</strong>
                <span>گروه خودرویی سام</span>
            </div>
        </div>

        <button type="button" id="closeDrawerBtn" class="drawer-close-btn" aria-label="بستن منو">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- بدنه منوی کشویی -->
    <div class="drawer-body">
        <div class="drawer-actions-box">
            <a href="https://sell.taminkanisam.co.ir/" target="_blank" rel="noopener noreferrer" class="drawer-login-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                <span>ورود به سامانه فروش خودرو</span>
            </a>

            @if(!empty($phoneNum))
                <a href="tel:{{$phoneNum}}" class="drawer-phone-btn">
                    <span>تماس مستقیم با شرکت</span>
                    <span class="num">{{$phoneNum}}</span>
                </a>
            @endif
        </div>

        <!-- لیست آیتم‌های ناوبری موبایل -->
        <ul class="drawer-menu-list">
            @if(auth()->user())
                @if(auth()->user()->level == 2 || auth()->user()->level == 3)
                    <li class="drawer-menu-item">
                        <div class="drawer-item-header">
                            <a href="/admin" class="drawer-item-link" style="color: #2563eb !important;">
                                <span>پنل مدیریت سیستم</span>
                            </a>
                        </div>
                    </li>
                @endif
            @endif

            @foreach($structuredNavigation as $item)
                @php
                    $hasChilds = !empty($item['childs']) && $item['childs']->count() > 0;
                    $isRed = $item['is_red'];
                    $isDrawerExternal = $isRed || isExternalMenuUrl($item['slug']);
                @endphp
                <li class="drawer-menu-item {{ $isRed ? 'is-red-highlight' : '' }}">
                    <div class="drawer-item-header">
                        <a href="{{ $item['slug'] }}" 
                           class="drawer-item-link {{ $isRed ? 'drawer-link-red-bold' : '' }}"
                           {!! $isDrawerExternal ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>
                            @if($isRed)
                                <span class="red-ping-dot"></span>
                            @endif
                            <span>{{ $item['name'] }}</span>
                        </a>

                        @if($hasChilds)
                            <div class="drawer-chevron mobile-accordion-trigger" role="button" aria-label="نمایش زیرمنو">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        @endif
                    </div>

                    @if($hasChilds)
                        @php
                            $isAnnouncementDrawer = (str_contains($item['name'], 'اطلاعیه های فروش') || str_contains($item['name'], 'بخشنامه')) && !str_contains($item['name'], 'خدمات');
                            $lastChildDrawer = $isAnnouncementDrawer ? $item['childs']->sortByDesc('id')->first() : null;
                            $latestCircularDrawerId = $lastChildDrawer ? $lastChildDrawer->id : null;
                        @endphp
                        <ul class="drawer-submenu">
                            @foreach($item['childs'] as $child)
                                @php
                                    $isCurrentCircularDrawer = ($isAnnouncementDrawer && $child->id == $latestCircularDrawerId);
                                    $isDrawerChildExternal = isExternalMenuUrl($child->slug);
                                @endphp
                                <li>
                                    <a href="{{ $child->slug }}" 
                                       class="{{ $isCurrentCircularDrawer ? 'latest-sale-notice' : '' }}"
                                       {!! $isDrawerChildExternal ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>
                                        <div class="drawer-item-inner">
                                            <span class="drawer-sub-dot"></span>
                                            <span>{{ $child->name }}</span>
                                        </div>
                                        @if($isCurrentCircularDrawer)
                                            <span class="circular-live-badge">
                                                <span class="circular-ping"></span>
                                                <span>بخشنامه جاری</span>
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- فوتر منوی موبایل -->
    <div class="drawer-footer">
        <div class="drawer-socials">
            @if(!empty($telegramLink))
                <a href="{{$telegramLink}}" class="drawer-social-btn" title="تلگرام" target="_blank" rel="noopener noreferrer">
                    <svg class="icon"><use xlink:href="#telegram"></use></svg>
                </a>
            @endif
            <a href="{{$instagramLink}}" class="drawer-social-btn" title="اینستاگرام" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            </a>
            @if(!empty($whatsappLink))
                <a href="{{$whatsappLink}}" class="drawer-social-btn" title="واتساپ" target="_blank" rel="noopener noreferrer">
                    <svg class="icon"><use xlink:href="#whatsapp"></use></svg>
                </a>
            @endif
            <a href="{{$baleLink}}" class="drawer-social-btn" title="پیام‌رسان بله" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.25 2 11.5c0 2.3.85 4.41 2.3 6.06L3.08 21.2a.75.75 0 0 0 .93.93l3.86-1.23C9.35 21.6 10.65 22 12 22c5.52 0 10-4.25 10-9.5S17.52 2 12 2zm-1.5 13.5l-3.5-3.5 1.41-1.41L10.5 12.67l5.59-5.59L17.5 8.5l-7 7z"/>
                </svg>
            </a>
        </div>
        <span class="drawer-copy-text">تامین کانی سام • وارد کننده خودروهای پلاک ملی و منطقه آزاد</span>
    </div>
</aside>

<script>
    (function(){
        // انتقال دراور و لایه بک‌دراپ به انتهای بدنه صفحه جهت رفع مشکل لایه‌بندی
        function initMobileDrawerTeleport() {
            var backdrop = document.getElementById('mobileMenuBackdrop');
            var drawer = document.getElementById('mobileDrawerMenu');
            if (backdrop && backdrop.parentElement !== document.body) {
                document.body.appendChild(backdrop);
            }
            if (drawer && drawer.parentElement !== document.body) {
                document.body.appendChild(drawer);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileDrawerTeleport);
        } else {
            initMobileDrawerTeleport();
        }

        // توابع کنترل منوی موبایل
        function openMobileDrawer() {
            $('#mobileMenuBackdrop').addClass('is-open');
            $('#mobileDrawerMenu').addClass('is-open');
            $('body').css('overflow', 'hidden');
        }

        function closeMobileDrawer() {
            $('#mobileMenuBackdrop').removeClass('is-open');
            $('#mobileDrawerMenu').removeClass('is-open');
            $('body').css('overflow', '');
        }

        // اسکرول و تعاملات صفحه
        var activeH = {!! json_encode($isActive, JSON_HEX_TAG) !!};
        function handleScrollWidgets() {
            var st = $(window).scrollTop();
            var wh = $(window).height();

            if(activeH != 1){
                if(st >= 1){
                    $(".allHeaderHome").addClass('active');
                } else {
                    $(".allHeaderHome").removeClass('active');
                }
            }

            $(".allIndexWidgets .indexData").each(function(){
                var $this = $(this);
                $this.css({"opacity": "1", "visibility": "visible"});

                if (st + wh >= $this.offset().top - 100 && $this.attr('id') != 'done') {
                    $this.attr('id', 'done');

                    $this.find('.allWorkIndex .botItem').each(function(){
                        $(this).css('width', $(this).attr('data-num') + '%');
                    });

                    if($this.find('.allNumberIndex').length >= 1){
                        $this.find('.numberCount').each(function () {
                            var $counter = $(this);
                            $({ Counter: 0 }).animate({ Counter: $counter.text() }, {
                                duration: 2500,
                                easing: 'swing',
                                step: function () {
                                    $counter.text(Math.ceil(this.Counter));
                                }
                            });
                        });
                    }
                }
            });
        }

        $(window).on('scroll', handleScrollWidgets);

        $(document).ready(function(){
            $(".allIndexWidgets .indexData").css({"opacity": "1", "visibility": "visible"});
            handleScrollWidgets();

            // تضمین فعال‌سازی و لود بدون نقص فاوآیکن در تمامی صفحات
            (function ensureFavicon() {
                var iconUrl = {!! json_encode($siteFavicon, JSON_UNESCAPED_SLASHES) !!};
                if (!iconUrl) return;
                var links = document.querySelectorAll("link[rel*='icon']");
                if (links.length === 0) {
                    var l1 = document.createElement('link');
                    l1.rel = 'icon';
                    l1.type = 'image/x-icon';
                    l1.href = iconUrl;
                    document.head.appendChild(l1);

                    var l2 = document.createElement('link');
                    l2.rel = 'shortcut icon';
                    l2.type = 'image/x-icon';
                    l2.href = iconUrl;
                    document.head.appendChild(l2);

                    var l3 = document.createElement('link');
                    l3.rel = 'apple-touch-icon';
                    l3.href = iconUrl;
                    document.head.appendChild(l3);
                } else {
                    links.forEach(function(l) {
                        l.href = iconUrl;
                    });
                }
            })();

            // باز کردن منوی موبایل
            $(document).on('click', '.resAlign, #btnShowMenu, .fixedTab .resAlign', function(e){
                e.preventDefault();
                e.stopPropagation();
                openMobileDrawer();
            });

            // بستن منوی موبایل
            $(document).on('click', '#closeDrawerBtn, #mobileMenuBackdrop', function(e){
                e.preventDefault();
                closeMobileDrawer();
            });

            $(document).on('keydown', function(e) {
                if (e.key === "Escape" || e.keyCode === 27) {
                    closeMobileDrawer();
                }
            });

            // باز و بسته شدن ساب‌منوهای آکاردئونی موبایل
            $(document).on('click', '.mobile-accordion-trigger', function(e){
                e.preventDefault();
                e.stopPropagation();
                var $parentItem = $(this).closest('.drawer-menu-item');
                var $submenu = $parentItem.find('.drawer-submenu');

                $parentItem.toggleClass('is-expanded');
                $submenu.stop(true, true).slideToggle(250);
            });

            // بخش جستجو
            $('.allHeaderHome .closeSearch, .allHeaderHome .bottom .left .sendHeader').on('click', function(){
                $('.allSearch').fadeToggle(200);
                if($('.allSearch').is(':visible')){
                    $('.topSearch input').focus();
                }
            });

            $('.allHeaderHome .topSearch button').on('click', function () {
                var query = $(".allHeaderHome .topSearch input[name='search']").val();
                if(!query || query.trim() === '') return;

                $.ajax({
                    url: "/search",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'search' : query
                    },
                    success: function (data) {
                        var $ul = $('.allSearch ul');
                        $ul.empty();

                        if (data[0] && data[0].length) {
                            $.each(data[0], function(){
                                $ul.append('<li><a href="/product/'+this.slug+'"><h4>'+this.title+'</h4><h5>/product/'+this.slug+'</h5><p>'+(this.bodySeo || '')+'</p></a></li>');
                            });
                        }
                        if (data[1] && data[1].length) {
                            $.each(data[1], function(){
                                $ul.append('<li><a href="/blog/'+this.slug+'"><h4>'+this.title+'</h4><h5>/blog/'+this.slug+'</h5><p>'+(this.bodySeo || '')+'</p></a></li>');
                            });
                        }
                        if (data[2] && data[2].length) {
                            $.each(data[2], function(){
                                $ul.append('<li><a href="/page/'+this.slug+'"><h4>'+this.title+'</h4><h5>/page/'+this.slug+'</h5><p>'+(this.bodySeo || '')+'</p></a></li>');
                            });
                        }
                    }
                });
            });

            $(".allHeaderHome .topSearch input[name='search']").on('keypress', function (e) {
                if (e.which === 13) {
                    $('.allHeaderHome .topSearch button').click();
                }
            });
        });
    })();
</script>