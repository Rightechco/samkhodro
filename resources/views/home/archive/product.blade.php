@extends('home.master')

@section('active', 1)
@section('title', ($name ?? 'محصولات') . ' - گروه خودرویی سام')

@section('content')
<style>
    /* ==========================================================================
       SAM AUTOMOTIVE GROUP - ULTRA-PREMIUM NATIVE SHOWROOM ARCHIVE
       فونت کاملاً هماهنگ با قالب اصلی سایت | نوار شناور برندها در سمت راست
       عناوین انگلیسی کامل و ارقام ۱۰۰٪ لاتین | هدر کاملاً استیکی
       ========================================================================== */
    :root {
        --sh-bg-main: #f1f5f9;
        --sh-card-bg: #ffffff;
        --sh-card-sub: #f8fafc;
        --sh-spec-bg: #f8fafc;
        --sh-spec-border: #e2e8f0;
        --sh-spec-hover: #edf2f7;
        --sh-primary-teal: #0d9488;
        --sh-primary-teal-hover: #0f766e;
        --sh-primary-teal-glow: rgba(13, 148, 136, 0.35);
        --sh-primary-blue: #2563eb;
        --sh-text-title: #0f172a;
        --sh-text-body: #334155;
        --sh-text-muted: #64748b;
        --sh-border-light: #e2e8f0;
        --sh-radius-card: 26px;
        --sh-radius-spec: 12px;
    }

    /* تضمین ۱۰۰٪ استیکی بودن کامل هدر در این صفحه */
    .allHeaderHome {
        position: sticky !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 9999 !important;
        box-shadow: 0 10px 30px -10px rgba(11, 19, 41, 0.15) !important;
    }

    /* هماهنگی کامل فونت با قالب اصلی بدون تحمیل فونت وزیر */
    .allProductArchive,
    .allProductArchive * {
        font-family: inherit;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
        box-sizing: border-box !important;
        font-feature-settings: "ss01" 0, "ss02" 0, "kern" 1 !important;
        font-variant-numeric: lining-nums tabular-nums !important;
    }

    /* کلاس اختصاصی برای نمایش بدون تغییر و LTR متون و اعداد انگلیسی */
    .allProductArchive .latin-text,
    .allProductArchive .sh-car-title-en,
    .allProductArchive .sh-spec-val,
    .allProductArchive .sh-model-year-badge,
    .allProductArchive .sh-model-badge-logo {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Tahoma, Arial, sans-serif !important;
        direction: ltr !important;
        display: inline-block !important;
        font-variant-numeric: lining-nums tabular-nums !important;
        unicode-bidi: embed !important;
    }

    .allProductArchive {
        background-color: var(--sh-bg-main) !important;
        min-height: 100vh !important;
        padding: 40px 0 90px 0 !important;
        direction: rtl !important;
        position: relative !important;
        overflow-x: hidden !important;
    }

    .allProductArchive .container-archive {
        max-width: 1440px !important;
        width: 100% !important;
        margin: 0 auto !important;
        padding: 0 24px !important;
        position: relative !important;
    }

    /* ==========================================================================
       نوار شناور برندها در سمت راست دسکتاپ (Right-Side Floating Brand Dock)
       هدایت کامل از چپ به راست با استایل پرمیوم و شیشه‌ای
       ========================================================================== */
    .sh-floating-brand-bar {
        position: fixed !important;
        right: 20px !important;
        left: auto !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        background: rgba(15, 23, 42, 0.94) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-radius: 34px !important;
        padding: 16px 10px !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 16px !important;
        z-index: 9990 !important;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.3) !important;
    }

    .sh-floating-brand-item {
        width: 46px !important;
        height: 46px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #94a3b8 !important;
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        position: relative !important;
    }

    .sh-floating-brand-item:hover,
    .sh-floating-brand-item.active {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.18) !important;
        transform: scale(1.15) !important;
    }

    .sh-floating-brand-item svg {
        width: 24px !important;
        height: 24px !important;
        fill: currentColor !important;
    }

    /* تولتیپ در سمت چپ دکمه‌های شناور سمت راست */
    .sh-floating-brand-item span.tooltip {
        position: absolute !important;
        left: 58px !important;
        right: auto !important;
        background: #0f172a !important;
        color: #ffffff !important;
        padding: 6px 14px !important;
        border-radius: 10px !important;
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        white-space: nowrap !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.2s ease, transform 0.2s ease !important;
        transform: translateX(-8px) !important;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .sh-floating-brand-item:hover span.tooltip {
        opacity: 1 !important;
        transform: translateX(0) !important;
    }

    /* هدر بالای صفحه آرشیو */
    .sh-archive-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 35px !important;
        padding-bottom: 20px !important;
        border-bottom: 1px solid var(--sh-border-light) !important;
        flex-wrap: wrap !important;
        gap: 16px !important;
    }

    .sh-breadcrumb {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 0.95rem !important;
        color: var(--sh-text-muted) !important;
        font-weight: 700 !important;
    }

    .sh-breadcrumb a {
        color: var(--sh-text-muted) !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }

    .sh-breadcrumb a:hover {
        color: var(--sh-primary-blue) !important;
    }

    .sh-breadcrumb span.current {
        color: var(--sh-text-title) !important;
        font-weight: 900 !important;
    }

    /* کانتینر کارت‌ها */
    .productLists {
        display: flex !important;
        flex-direction: column !important;
        gap: 40px !important;
        width: 100% !important;
        margin-bottom: 40px !important;
    }

    /* کارت عریض دو ستونه هر خودرو */
    .sh-showcase-card {
        background: var(--sh-card-bg) !important;
        border-radius: var(--sh-radius-card) !important;
        border: 1px solid var(--sh-border-light) !important;
        box-shadow: 
            0 24px 50px -12px rgba(15, 23, 42, 0.08),
            0 0 0 1px rgba(255, 255, 255, 0.9) inset !important;
        padding: 38px 42px !important;
        display: flex !important;
        gap: 42px !important;
        position: relative !important;
        overflow: hidden !important;
        transition: box-shadow 0.4s ease, transform 0.4s ease !important;
    }

    .sh-showcase-card:hover {
        box-shadow: 
            0 32px 75px -15px rgba(15, 23, 42, 0.14),
            0 0 0 1.5px rgba(13, 148, 136, 0.35) inset !important;
    }

    /* ستون اطلاعات و مشخصات فنی (راست در RTL) */
    .sh-col-details {
        flex: 1.1 !important;
        min-width: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    .sh-top-meta-row {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 16px !important;
    }

    .sh-model-badge-logo {
        font-size: 1.85rem !important;
        font-weight: 900 !important;
        letter-spacing: 1.2px !important;
        color: #0f172a !important;
        text-transform: uppercase !important;
        line-height: 1 !important;
    }

    .sh-model-year-badge {
        font-size: 1.35rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        background: #f1f5f9 !important;
        padding: 4px 14px !important;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
    }

    .sh-titles-stack {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        margin: 0 0 16px 0 !important;
    }

    .sh-car-title {
        font-size: 1.65rem !important;
        font-weight: 900 !important;
        color: var(--sh-text-title) !important;
        margin: 0 !important;
        line-height: 1.45 !important;
        letter-spacing: -0.4px !important;
    }

    /* عنوان کامل انگلیسی با ارقام ۱۰۰٪ لاتین و چینش LTR متوازن */
    .sh-car-title-en {
        font-size: 1.12rem !important;
        font-weight: 800 !important;
        color: #2563eb !important;
        letter-spacing: 0.4px !important;
        direction: ltr !important;
        text-align: right !important;
        margin-top: 2px !important;
        display: block !important;
    }

    .sh-car-desc {
        font-size: 0.96rem !important;
        line-height: 1.95 !important;
        color: var(--sh-text-body) !important;
        margin: 0 0 24px 0 !important;
        text-align: justify !important;
        font-weight: 500 !important;
    }

    /* جدول مشخصات فنی */
    .sh-specs-list {
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        margin-bottom: 28px !important;
    }

    .sh-spec-row {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        background: var(--sh-spec-bg) !important;
        border: 1px solid var(--sh-spec-border) !important;
        border-radius: var(--sh-radius-spec) !important;
        padding: 10px 18px !important;
        transition: background 0.2s ease, border-color 0.2s ease !important;
    }

    .sh-spec-row:hover {
        background: var(--sh-spec-hover) !important;
        border-color: #cbd5e1 !important;
    }

    .sh-spec-key {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        font-size: 0.88rem !important;
        color: #64748b !important;
        font-weight: 700 !important;
    }

    .sh-spec-icon {
        width: 20px !important;
        height: 20px !important;
        color: #0d9488 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .sh-spec-icon svg {
        width: 100% !important;
        height: 100% !important;
        stroke: currentColor !important;
        stroke-width: 2.2 !important;
    }

    .sh-spec-val {
        font-size: 0.94rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
    }

    /* دکمه تمام‌عرض فیروزه‌ای */
    .sh-btn-action {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        width: 100% !important;
        background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%) !important;
        color: #ffffff !important;
        font-size: 1.05rem !important;
        font-weight: 800 !important;
        padding: 16px 24px !important;
        border-radius: 16px !important;
        text-decoration: none !important;
        border: none !important;
        cursor: pointer !important;
        box-shadow: 0 10px 25px rgba(13, 148, 136, 0.35) !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .sh-btn-action:hover {
        background: linear-gradient(135deg, #115e59 0%, #0f766e 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 14px 32px rgba(13, 148, 136, 0.45) !important;
        color: #ffffff !important;
    }

    .sh-btn-action svg {
        width: 18px !important;
        height: 18px !important;
        stroke-width: 2.5 !important;
        transition: transform 0.25s ease !important;
    }

    .sh-btn-action:hover svg {
        transform: translateX(-5px) !important;
    }

    .sh-showcase-card.is-unavailable .sh-btn-action {
        background: #ef4444 !important;
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.3) !important;
        cursor: not-allowed !important;
    }

    /* ==========================================================================
       گالری استودیویی تصاویر هایپرلوکس (Ultra-Luxury Studio Showcase Gallery)
       ========================================================================== */
    .sh-col-gallery {
        flex: 1.35 !important;
        min-width: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    /* استیج اصلی عکس بزرگ */
    .sh-stage-large-box {
        width: 100% !important;
        height: 395px !important;
        position: relative !important;
        border-radius: 22px !important;
        background: radial-gradient(circle at 50% 62%, #ffffff 0%, #f1f5f9 68%, #e2e8f0 100%) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 24px !important;
        border: 1px solid var(--sh-border-light) !important;
        overflow: hidden !important;
        touch-action: pan-y !important;
        user-select: none !important;
        -webkit-user-select: none !important;
        box-shadow: inset 0 2px 10px rgba(15, 23, 42, 0.03) !important;
    }

    /* دیسک نورانی کف استودیوی عکاسی */
    .sh-stage-turntable-glow {
        position: absolute;
        bottom: 22px;
        width: 75%;
        height: 28px;
        border-radius: 50%;
        background: radial-gradient(ellipse at center, rgba(13, 148, 136, 0.22) 0%, rgba(37, 99, 235, 0.12) 40%, transparent 75%);
        filter: blur(8px);
        pointer-events: none;
        z-index: 1;
        transition: transform 0.5s ease;
    }

    .sh-stage-large-box:hover .sh-stage-turntable-glow {
        transform: scale(1.1);
    }

    .sh-stage-large-box img.sh-active-main-image {
        max-width: 100% !important;
        max-height: 100% !important;
        width: auto !important;
        height: auto !important;
        object-fit: contain !important;
        position: relative !important;
        z-index: 2 !important;
        filter: drop-shadow(0 20px 32px rgba(15, 23, 42, 0.18)) !important;
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .sh-stage-large-box:hover img.sh-active-main-image {
        transform: scale(1.04) translateY(-3px) !important;
    }

    /* نشان برند خودرو در گوشه بالا سمت راست استیج با لوگوی واقعی */
    .sh-stage-brand-pill {
        position: absolute !important;
        top: 18px !important;
        right: 18px !important;
        left: auto !important;
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        padding: 6px 14px 6px 16px !important;
        border-radius: 99px !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08) !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        z-index: 5 !important;
        direction: rtl !important;
    }

    .sh-stage-brand-pill .brand-icon-wrap {
        width: 20px !important;
        height: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }

    .sh-stage-brand-pill .brand-icon-wrap svg {
        width: 100% !important;
        height: 100% !important;
        fill: currentColor !important;
    }

    .sh-stage-brand-pill span {
        font-size: 0.78rem !important;
        font-weight: 900 !important;
        letter-spacing: 0.5px !important;
        color: #0f172a !important;
        font-family: 'Segoe UI', Roboto, sans-serif !important;
    }

    /* برچسب وضعیت در سمت چپ استیج */
    .sh-stage-floating-badge {
        position: absolute !important;
        top: 18px !important;
        left: 18px !important;
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        padding: 6px 14px !important;
        border-radius: 99px !important;
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06) !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        z-index: 5 !important;
    }

    .sh-stage-floating-badge .dot {
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: #10b981 !important;
        box-shadow: 0 0 8px #10b981 !important;
    }

    .sh-stage-floating-badge.unavailable {
        background: #fef2f2 !important;
        border-color: #fca5a5 !important;
        color: #dc2626 !important;
    }

    .sh-stage-floating-badge.unavailable .dot {
        background: #ef4444 !important;
        box-shadow: 0 0 8px #ef4444 !important;
    }

    /* شمارنده داینامیک تصاویر در پایین استیج */
    .sh-stage-counter-pill {
        position: absolute !important;
        bottom: 18px !important;
        left: 18px !important;
        background: rgba(15, 23, 42, 0.82) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        color: #ffffff !important;
        padding: 5px 12px !important;
        border-radius: 99px !important;
        font-size: 0.78rem !important;
        font-weight: 800 !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
        z-index: 5 !important;
        direction: ltr !important;
        letter-spacing: 0.5px !important;
    }

    /* فلش‌های ناوبری سریع در دو طرف استیج */
    .sh-stage-arrow {
        position: absolute !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        background: rgba(255, 255, 255, 0.9) !important;
        backdrop-filter: blur(8px) !important;
        border: 1px solid #cbd5e1 !important;
        color: #0f172a !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        z-index: 6 !important;
        opacity: 0 !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12) !important;
    }

    .sh-stage-large-box:hover .sh-stage-arrow {
        opacity: 1 !important;
    }

    .sh-stage-arrow:hover {
        background: #0d9488 !important;
        color: #ffffff !important;
        border-color: #0d9488 !important;
        transform: translateY(-50%) scale(1.1) !important;
    }

    .sh-stage-arrow.prev { right: 14px !important; }
    .sh-stage-arrow.next { left: 14px !important; }

    .sh-stage-arrow svg {
        width: 18px !important;
        height: 18px !important;
        stroke-width: 2.5 !important;
    }

    /* نوار اسکرول بندانگشتی‌ها (Thumbnails Strip) */
    .sh-thumbnails-strip {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        margin-top: 16px !important;
        width: 100% !important;
        overflow-x: auto !important;
        padding: 4px 2px 8px 2px !important;
        scrollbar-width: thin !important;
        scroll-snap-type: x mandatory !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .sh-thumbnails-strip::-webkit-scrollbar {
        height: 4px;
    }

    .sh-thumbnails-strip::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 99px;
    }

    .sh-thumb-btn {
        flex: 1 !important;
        min-width: 82px !important;
        height: 74px !important;
        border-radius: 14px !important;
        border: 2px solid var(--sh-border-light) !important;
        background: #ffffff !important;
        padding: 4px !important;
        cursor: pointer !important;
        overflow: hidden !important;
        position: relative !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        scroll-snap-align: start !important;
        -webkit-tap-highlight-color: transparent !important;
    }

    .sh-thumb-btn img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 9px !important;
        transition: transform 0.3s ease !important;
    }

    .sh-thumb-btn:hover {
        border-color: #94a3b8 !important;
        transform: translateY(-3px) !important;
    }

    .sh-thumb-btn.is-active {
        border-color: var(--sh-primary-teal) !important;
        box-shadow: 0 0 0 3px var(--sh-primary-teal-glow) !important;
        transform: scale(1.02) !important;
    }

    .sh-thumb-btn.is-active::after {
        content: '' !important;
        position: absolute !important;
        bottom: 2px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 14px !important;
        height: 3px !important;
        background: var(--sh-primary-teal) !important;
        border-radius: 99px !important;
    }

    /* باکس توضیحات دسته در انتهای صفحه */
    .sh-archive-desc-box {
        background: #ffffff !important;
        border-radius: 22px !important;
        border: 1px solid var(--sh-border-light) !important;
        padding: 30px 36px !important;
        margin-top: 35px !important;
        box-shadow: 0 6px 22px rgba(15, 23, 42, 0.04) !important;
    }

    .sh-archive-desc-box h3 {
        font-size: 1.3rem !important;
        font-weight: 900 !important;
        color: var(--sh-text-title) !important;
        margin: 0 0 12px 0 !important;
    }

    .sh-archive-desc-box p {
        font-size: 0.98rem !important;
        line-height: 2 !important;
        color: var(--sh-text-body) !important;
        margin: 0 !important;
    }

    /* ==========================================================================
       ریسپانسیو ویژه موبایل با حس اپلیکیشن نیتیو (Mobile Native UX)
       ========================================================================== */
    @media (max-width: 1200px) {
        .sh-floating-brand-bar {
            display: none !important;
        }
    }

    @media (max-width: 1140px) {
        .sh-showcase-card {
            flex-direction: column-reverse !important;
            padding: 28px !important;
            gap: 28px !important;
        }

        .sh-stage-large-box {
            height: 330px !important;
        }
    }

    @media (max-width: 768px) {
        .allProductArchive {
            padding: 16px 0 60px 0 !important;
        }

        .allProductArchive .container-archive {
            padding: 0 14px !important;
        }

        .sh-archive-header {
            margin-bottom: 20px !important;
            padding-bottom: 14px !important;
        }

        .sh-showcase-card {
            padding: 18px !important;
            border-radius: 22px !important;
            gap: 20px !important;
            margin-bottom: 24px !important;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.06) !important;
        }

        .sh-stage-large-box {
            height: 225px !important;
            padding: 14px !important;
            border-radius: 18px !important;
        }

        .sh-stage-arrow {
            opacity: 0.8 !important;
            width: 32px !important;
            height: 32px !important;
        }

        .sh-stage-arrow.prev { right: 8px !important; }
        .sh-stage-arrow.next { left: 8px !important; }

        .sh-stage-brand-pill {
            top: 12px !important;
            right: 12px !important;
            padding: 4px 10px 4px 12px !important;
        }

        .sh-stage-brand-pill span {
            font-size: 0.72rem !important;
        }

        .sh-stage-floating-badge {
            top: 12px !important;
            left: 12px !important;
            padding: 4px 10px !important;
            font-size: 0.74rem !important;
        }

        .sh-stage-counter-pill {
            bottom: 12px !important;
            left: 12px !important;
            font-size: 0.72rem !important;
            padding: 3px 9px !important;
        }

        .sh-thumbnails-strip {
            gap: 8px !important;
            margin-top: 12px !important;
            padding-bottom: 4px !important;
        }

        .sh-thumb-btn {
            height: 58px !important;
            min-width: 64px !important;
            border-radius: 12px !important;
            border-width: 1.5px !important;
        }

        .sh-model-badge-logo {
            font-size: 1.5rem !important;
        }

        .sh-model-year-badge {
            font-size: 1.15rem !important;
            padding: 3px 10px !important;
        }

        .sh-car-title {
            font-size: 1.3rem !important;
        }

        .sh-car-title-en {
            font-size: 0.95rem !important;
        }

        .sh-car-desc {
            font-size: 0.9rem !important;
            line-height: 1.85 !important;
            margin-bottom: 18px !important;
        }

        .sh-specs-list {
            gap: 6px !important;
            margin-bottom: 20px !important;
        }

        .sh-spec-row {
            padding: 8px 12px !important;
            border-radius: 10px !important;
        }

        .sh-spec-key {
            font-size: 0.8rem !important;
            gap: 6px !important;
        }

        .sh-spec-val {
            font-size: 0.86rem !important;
        }

        .sh-btn-action {
            padding: 14px 20px !important;
            font-size: 0.98rem !important;
            border-radius: 14px !important;
        }
    }
</style>

<!-- نوار شناور برندها در سمت راست دسکتاپ -->
<aside class="sh-floating-brand-bar" aria-label="برندهای خودرو">
    <a href="#brand-toyota" class="sh-floating-brand-item active" title="تویوتا (Toyota)">
        <svg viewBox="0 0 24 24"><path d="M12 2C5.373 2 0 5.86 0 10.627c0 4.155 4.093 7.643 9.878 8.496l-.504-1.744C4.69 16.435 1.5 13.784 1.5 10.627c0-4.08 4.707-7.39 10.5-7.39s10.5 3.31 10.5 7.39c0 3.157-3.19 5.808-7.874 6.752l-.504 1.744C19.907 18.27 24 14.782 24 10.627 24 5.86 18.627 2 12 2zm0 2.378c-2.484 0-4.73 1.579-4.73 4.24 0 3.125 2.08 6.516 4.73 8.513 2.65-1.997 4.73-5.388 4.73-8.513 0-2.661-2.246-4.24-4.73-4.24zm0 1.34c1.772 0 3.385 1.228 3.385 2.9 0 2.525-1.873 5.576-3.385 7.276-1.512-1.7-3.385-4.751-3.385-7.276 0-1.672 1.613-2.9 3.385-2.9zm0 1.562c-4.062 0-7.511 1.521-8.828 3.702 1.317 2.181 4.766 3.702 8.828 3.702s7.511-1.521 8.828-3.702C20.511 8.8 17.062 7.28 12 7.28zm0 1.297c3.011 0 5.81.999 7.316 2.405-1.506 1.406-4.305 2.405-7.316 2.405s-5.81-.999-7.316-2.405C6.19 9.576 8.989 8.577 12 8.577z"/></svg>
        <span class="tooltip">تویوتا (Toyota)</span>
    </a>
    <a href="#brand-kia" class="sh-floating-brand-item" title="کیا (KIA)">
        <svg viewBox="0 0 24 24"><path d="M12 2C5.373 2 0 6.477 0 12s5.373 10 12 10 12-4.477 12-10S18.627 2 12 2zm5.3 12.2h-2.3l-1.4-3.3-1.4 3.3H10l-1.6-4.2h2.2l.6 1.9.7-1.9h2.5l-.8 2.1 1.6 2.1zm-10.6 0H4.5V7.8h2.2v6.4z"/></svg>
        <span class="tooltip">کیا (KIA)</span>
    </a>
    <a href="#brand-nissan" class="sh-floating-brand-item" title="نیسان (Nissan)">
        <svg viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 2c4.418 0 8 3.582 8 8 0 1.846-.628 3.548-1.687 4.903H5.687C4.628 15.548 4 13.846 4 12c0-4.418 3.582-8 8-8zm-8 7.5h16v1H4v-1zm1.687 2.5h12.626C17.26 18.775 14.808 20 12 20s-5.26-1.225-6.313-4z"/></svg>
        <span class="tooltip">نیسان (Nissan)</span>
    </a>
    <a href="#brand-hyundai" class="sh-floating-brand-item" title="هیوندای (Hyundai)">
        <svg viewBox="0 0 24 24"><path d="M12 2C5.373 2 0 6.477 0 12s5.373 10 12 10 12-4.477 12-10S18.627 2 12 2zm5.1 14.6c-.9.9-3.4 1.5-5.1 1.5s-4.2-.6-5.1-1.5c-1-1-1.3-3.7-.8-6.9.3-2.4 1.3-4.7 3-4.7 1.3 0 2 1.5 3 3.7.9-2.2 1.7-3.7 3-3.7 1.7 0 2.7 2.3 3 4.7.5 3.2.2 5.9-.9 6.9z"/></svg>
        <span class="tooltip">هیوندای (Hyundai)</span>
    </a>
</aside>

<div class="allProductArchive">
    <div class="container-archive">
        
        <!-- هدر بالای صفحه آرشیو -->
        <header class="sh-archive-header">
            <nav class="sh-breadcrumb" aria-label="مسیر صفحه">
                <a href="/">صفحه اصلی</a>
                <span>/</span>
                <span>محصولات</span>
                <span>/</span>
                <span class="current">{{ $name ?? 'همه محصولات' }}</span>
            </nav>
        </header>

        @php
            // تبدیل ارقام به لاتین
            if (!function_exists('archiveToLatinDigits')) {
                function archiveToLatinDigits($str) {
                    if (empty($str)) return $str;
                    $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
                    $ar = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
                    $en = ['0','1','2','3','4','5','6','7','8','9'];
                    return str_replace($fa, $en, str_replace($ar, $en, (string)$str));
                }
            }

            /* واکشی ایمن محصولات */
            if (!isset($products) || (is_countable($products) && count($products) === 0)) {
                $products = \App\Models\Product::orderBy('id', 'desc')->get();
            }

            /**
             * هلپر هوشمند تشخیص برند خودرو و لوگوی رسمی
             */
            if (!function_exists('getOfficialArchiveBrandProfile')) {
                function getOfficialArchiveBrandProfile($title) {
                    $t = mb_strtolower($title ?? '', 'UTF-8');
                    
                    if (str_contains($t, 'تویوتا') || str_contains($t, 'toyota') || str_contains($t, 'کرولا') || str_contains($t, 'corolla')) {
                        return [
                            'name' => 'TOYOTA',
                            'color' => '#eb0a1e',
                            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C5.373 2 0 5.86 0 10.627c0 4.155 4.093 7.643 9.878 8.496l-.504-1.744C4.69 16.435 1.5 13.784 1.5 10.627c0-4.08 4.707-7.39 10.5-7.39s10.5 3.31 10.5 7.39c0 3.157-3.19 5.808-7.874 6.752l-.504 1.744C19.907 18.27 24 14.782 24 10.627 24 5.86 18.627 2 12 2zm0 2.378c-2.484 0-4.73 1.579-4.73 4.24 0 3.125 2.08 6.516 4.73 8.513 2.65-1.997 4.73-5.388 4.73-8.513 0-2.661-2.246-4.24-4.73-4.24zm0 1.34c1.772 0 3.385 1.228 3.385 2.9 0 2.525-1.873 5.576-3.385 7.276-1.512-1.7-3.385-4.751-3.385-7.276 0-1.672 1.613-2.9 3.385-2.9zm0 1.562c-4.062 0-7.511 1.521-8.828 3.702 1.317 2.181 4.766 3.702 8.828 3.702s7.511-1.521 8.828-3.702C20.511 8.8 17.062 7.28 12 7.28zm0 1.297c3.011 0 5.81.999 7.316 2.405-1.506 1.406-4.305 2.405-7.316 2.405s-5.81-.999-7.316-2.405C6.19 9.576 8.989 8.577 12 8.577z"/></svg>'
                        ];
                    }

                    if (str_contains($t, 'هیوندای') || str_contains($t, 'hyundai')) {
                        return [
                            'name' => 'HYUNDAI',
                            'color' => '#002c5f',
                            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C5.373 2 0 6.477 0 12s5.373 10 12 10 12-4.477 12-10S18.627 2 12 2zm5.1 14.6c-.9.9-3.4 1.5-5.1 1.5s-4.2-.6-5.1-1.5c-1-1-1.3-3.7-.8-6.9.3-2.4 1.3-4.7 3-4.7 1.3 0 2 1.5 3 3.7.9-2.2 1.7-3.7 3-3.7 1.7 0 2.7 2.3 3 4.7.5 3.2.2 5.9-.9 6.9z"/></svg>'
                        ];
                    }

                    if (str_contains($t, 'کیا') || str_contains($t, 'kia')) {
                        return [
                            'name' => 'KIA',
                            'color' => '#05141f',
                            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C5.373 2 0 6.477 0 12s5.373 10 12 10 12-4.477 12-10S18.627 2 12 2zm5.3 12.2h-2.3l-1.4-3.3-1.4 3.3H10l-1.6-4.2h2.2l.6 1.9.7-1.9h2.5l-.8 2.1 1.6 2.1zm-10.6 0H4.5V7.8h2.2v6.4z"/></svg>'
                        ];
                    }

                    if (str_contains($t, 'نیسان') || str_contains($t, 'nissan')) {
                        return [
                            'name' => 'NISSAN',
                            'color' => '#c3002f',
                            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 2c4.418 0 8 3.582 8 8 0 1.846-.628 3.548-1.687 4.903H5.687C4.628 15.548 4 13.846 4 12c0-4.418 3.582-8 8-8zm-8 7.5h16v1H4v-1zm1.687 2.5h12.626C17.26 18.775 14.808 20 12 20s-5.26-1.225-6.313-4z"/></svg>'
                        ];
                    }

                    return [
                        'name' => 'SAM KHODRO',
                        'color' => '#2563eb',
                        'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>'
                    ];
                }
            }

            /**
             * استخراج عنوان کامل استاندارد انگلیسی محصولات با فرمت دقیق بین‌المللی و اعداد لاتین
             * نمونه: Toyota Corolla Cross Hybrid 2026
             */
            if (!function_exists('getAutomotiveArchiveEnglishTitle')) {
                function getAutomotiveArchiveEnglishTitle($title) {
                    $t = mb_strtolower($title ?? '', 'UTF-8');
                    $is2026    = str_contains($t, '2026') || str_contains($t, '۲۰۲۶');
                    $isNewFace = str_contains($t, 'نیوفیس') || str_contains($t, 'new face');
                    $is2025    = str_contains($t, '2025') || str_contains($t, '۲۰۲۵');

                    // خانواده تویوتا کرولا کراس
                    if (str_contains($t, 'کرولا') || str_contains($t, 'corolla')) {
                        if ($is2026) {
                            return 'Toyota Corolla Cross Hybrid 2026';
                        }
                        if ($isNewFace) {
                            return 'Toyota Corolla Cross Hybrid 2025 (New Face)';
                        }
                        if ($is2025) {
                            return 'Toyota Corolla Cross Hybrid 2025';
                        }
                        return 'Toyota Corolla Cross Hybrid 2026';
                    }

                    // کیا
                    if (str_contains($t, 'ev5') || str_contains($t, 'کیا') || str_contains($t, 'kia')) {
                        return 'KIA EV5 Electric 2025';
                    }

                    // نیسان
                    if (str_contains($t, 'سیلفی') || str_contains($t, 'sylphy') || str_contains($t, 'نیسان') || str_contains($t, 'nissan')) {
                        return 'Nissan Sylphy e-POWER 2025';
                    }

                    // هیوندای
                    if (str_contains($t, 'توسان') || str_contains($t, 'tucson')) {
                        return 'Hyundai Tucson Hybrid 2025';
                    }
                    if (str_contains($t, 'النترا') || str_contains($t, 'elantra')) {
                        return 'Hyundai Elantra 2025';
                    }

                    $cleaned = str_replace(
                        ['تویوتا', 'کرولا کراس', 'هیبرید', 'نیوفیس', 'کیا', 'نیسان', 'هیوندای'],
                        ['Toyota', 'Corolla Cross', 'Hybrid', 'New Face', 'KIA', 'Nissan', 'Hyundai'],
                        $title
                    );
                    return archiveToLatinDigits(trim($cleaned));
                }
            }

            /**
             * تابع مشخصات کاتالوگی با ارقام قطعی لاتین
             */
            if (!function_exists('getShowroomCarSpecs')) {
                function getShowroomCarSpecs($title) {
                    $t = mb_strtolower($title ?? '', 'UTF-8');

                    if (str_contains($t, 'کرولا کراس') || str_contains($t, 'corolla cross')) {
                        return [
                            'modelBadge' => 'COROLLA CROSS',
                            'year'       => str_contains($t, '2026') || str_contains($t, '۲۰۲۶') ? '2026' : '2025',
                            'headline'   => 'تویوتا کرولا کراس، اوج اصالت و فناوری هیبرید ژاپن با پلاک ملی',
                            'specs'      => [
                                ['label' => 'ابعاد (طول × عرض × ارتفاع)', 'val' => '4.460 × 1.825 × 1.620 m'],
                                ['label' => 'فاصله محورها (mm)', 'val' => '2640 mm'],
                                ['label' => 'حداکثر قدرت پیشرانه هیبرید (hp)', 'val' => '196 hp'],
                                ['label' => 'حداکثر گشتاور ترکیبی (N.m)', 'val' => '206 N.m'],
                                ['label' => 'نوع جعبه‌دنده', 'val' => 'e-CVT اتوماتیک هوشمند'],
                                ['label' => 'سیستم تعلیق جلو و عقب', 'val' => 'مک‌فرسون / مولتی‌لینک مستقل']
                            ]
                        ];
                    }

                    if (str_contains($t, 'ev5') || str_contains($t, 'kia') || str_contains($t, 'کیا')) {
                        return [
                            'modelBadge' => 'EV5',
                            'year'       => '2025',
                            'headline'   => 'کیا EV5، طراحی آینده‌نگر با خطوط جسورانه و استانداردهای جدید در کلاس خودروهای روز',
                            'specs'      => [
                                ['label' => 'ابعاد (طول × عرض × ارتفاع)', 'val' => '1.715 × 1.875 × 4.615 m'],
                                ['label' => 'فاصله محورها (mm)', 'val' => '2750 mm'],
                                ['label' => 'حداکثر قدرت (hp)', 'val' => '215 hp'],
                                ['label' => 'حداکثر گشتاور (N.m)', 'val' => '310 N.m'],
                                ['label' => 'نوع گیربکس', 'val' => 'اتوماتیک هوشمند تک‌سرعته'],
                                ['label' => 'سیستم تعلیق', 'val' => 'مک‌فرسون / مولتی‌لینک']
                            ]
                        ];
                    }

                    if (str_contains($t, 'نیسان') || str_contains($t, 'nissan') || str_contains($t, 'سیلفی') || str_contains($t, 'sylphy')) {
                        return [
                            'modelBadge' => 'NISSAN SYLPHY',
                            'year'       => '2025',
                            'headline'   => 'نیسان سیلفی، تلفیق هوشمندانه رانندگی لوکس شهری با فناوری پیشرفته e-POWER ژاپن',
                            'specs'      => [
                                ['label' => 'ابعاد (طول × عرض × ارتفاع)', 'val' => '4.652 × 1.815 × 1.450 m'],
                                ['label' => 'فاصله محورها (mm)', 'val' => '2712 mm'],
                                ['label' => 'حداکثر قدرت (hp)', 'val' => '136 hp'],
                                ['label' => 'حداکثر گشتاور (N.m)', 'val' => '300 N.m'],
                                ['label' => 'سیستم انتقال قدرت', 'val' => 'تک‌سرعته الکتریکی Direct Drive'],
                                ['label' => 'سیستم تعلیق', 'val' => 'مک‌فرسون / تورشن بیم']
                            ]
                        ];
                    }

                    return [
                        'modelBadge' => 'SAM GROUP',
                        'year'       => '2026',
                        'headline'   => 'طراحی پیشرو، ایمنی پنج ستاره بین‌المللی و مهندسی روز خودروهای وارداتی',
                        'specs'      => [
                            ['label' => 'ابعاد (طول × عرض × ارتفاع)', 'val' => '1.715 × 1.875 × 4.615 m'],
                            ['label' => 'فاصله محورها (mm)', 'val' => '2750 mm'],
                            ['label' => 'حداکثر قدرت (hp)', 'val' => '215 hp'],
                            ['label' => 'حداکثر گشتاور (N.m)', 'val' => '310 N.m'],
                            ['label' => 'نوع گیربکس', 'val' => 'اتوماتیک هوشمند نسل جدید'],
                            ['label' => 'سیستم تعلیق', 'val' => 'مک‌فرسون / مولتی‌لینک']
                        ]
                    ];
                }
            }
        @endphp

        <!-- کانتینر اصلی لیست کارت‌ها -->
        <main class="productArchive">
            <div class="productLists">
                @forelse($products as $car)
                    @php
                        $cleanTitle = archiveToLatinDigits($car->title);
                        $englishTitle = getAutomotiveArchiveEnglishTitle($car->title);
                        $brandInfo = getOfficialArchiveBrandProfile($car->title);
                        
                        $tLower = mb_strtolower($car->title ?? '', 'UTF-8');
                        $isNewFace = str_contains($tLower, 'نیوفیس') || str_contains($tLower, 'new face');
                        $is2026    = str_contains($tLower, '2026') || str_contains($tLower, '۲۰۲۶');
                        $is2025    = str_contains($tLower, '2025') || str_contains($tLower, '۲۰۲۵');

                        // خودروی غیرقابل عرضه
                        $isUnavailable = ($car->id == 8) || ($is2025 && !$isNewFace && !$is2026);
                        
                        $specData = getShowroomCarSpecs($cleanTitle);
                        $stageId = 'stage-car-img-' . $car->id;
                        $counterId = 'stage-counter-' . $car->id;

                        // استخراج تصاویر
                        $mainImg = '/img/404Image.png';
                        $galleryImgs = [];

                        if (!empty($car->image)) {
                            if (is_array($car->image)) {
                                $galleryImgs = $car->image;
                                $mainImg = reset($car->image);
                            } elseif (is_string($car->image)) {
                                $trimmed = trim($car->image);
                                if (strncmp($trimmed, '[', 1) === 0 || strncmp($trimmed, '{', 1) === 0) {
                                    $decoded = json_decode($trimmed, true);
                                    if (is_array($decoded) && !empty($decoded)) {
                                        $galleryImgs = array_values($decoded);
                                        $mainImg = $galleryImgs[0];
                                    } else {
                                        $mainImg = $trimmed;
                                        $galleryImgs[] = $trimmed;
                                    }
                                } else {
                                    $mainImg = $trimmed;
                                    $galleryImgs[] = $trimmed;
                                }
                            }
                        }

                        if (count($galleryImgs) < 4) {
                            $sampleAngles = [
                                $mainImg,
                                '/upload/image/2026/1/1788952935.jpg',
                                '/upload/image/2026/1/1788953246.jpg',
                                '/upload/image/2026/1/1789914108.png'
                            ];
                            foreach ($sampleAngles as $sample) {
                                if (!in_array($sample, $galleryImgs)) {
                                    $galleryImgs[] = $sample;
                                }
                                if (count($galleryImgs) >= 4) break;
                            }
                        }
                        $totalImgCount = count($galleryImgs);
                    @endphp

                    <!-- کارت دو ستونه هایپرلوکس -->
                    <article class="sh-showcase-card {{ $isUnavailable ? 'is-unavailable' : '' }}" id="product-{{ $car->id }}">
                        
                        <!-- ستون راست: اطلاعات و مشخصات فنی -->
                        <div class="sh-col-details">
                            <div>
                                <div class="sh-top-meta-row">
                                    <span class="sh-model-badge-logo">{{ $specData['modelBadge'] }}</span>
                                    <span class="sh-model-year-badge">{{ $specData['year'] }}</span>
                                </div>

                                <!-- عناوین فارسی و انگلیسی کامل با اعداد ۱۰۰٪ لاتین -->
                                <div class="sh-titles-stack">
                                    <h2 class="sh-car-title">{{ $cleanTitle }}</h2>
                                    <span class="sh-car-title-en">{{ $englishTitle }}</span>
                                </div>

                                <p class="sh-car-desc">
                                    {{ archiveToLatinDigits(!empty($car->bodySeo) ? $car->bodySeo : (!empty($car->body) ? mb_substr(strip_tags($car->body), 0, 160, 'UTF-8') . '...' : $specData['headline'])) }}
                                </p>

                                <div class="sh-specs-list">
                                    @foreach($specData['specs'] as $spec)
                                        <div class="sh-spec-row">
                                            <span class="sh-spec-val">{{ archiveToLatinDigits($spec['val']) }}</span>
                                            <div class="sh-spec-key">
                                                <span>{{ $spec['label'] }}</span>
                                                <span class="sh-spec-icon">
                                                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if($isUnavailable)
                                <button type="button" class="sh-btn-action" disabled>
                                    <span>غیرقابل عرضه (اتمام ظرفیت ثبت‌نام)</span>
                                </button>
                            @else
                                <a href="/product/{{ $car->slug }}" class="sh-btn-action" title="مشاهده مشخصات کامل {{ $car->title }}">
                                    <span>مشاهده بیشتر</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                </a>
                            @endif
                        </div>

                        <!-- ستون چپ: استیج عکس بزرگ و گالری تعاملی پیشرفته -->
                        <div class="sh-col-gallery">
                            <div class="sh-stage-large-box" data-gallery-target="{{ $stageId }}">
                                <!-- دیسک نوری استودیو زیر خودرو -->
                                <div class="sh-stage-turntable-glow"></div>

                                <!-- نشان رسمی برند در منتهی‌الیه سمت راست با وکتور اصلی -->
                                <div class="sh-stage-brand-pill" title="{{ $brandInfo['name'] }}">
                                    <div class="brand-icon-wrap" style="color: {{ $brandInfo['color'] }};">
                                        {!! $brandInfo['svg'] !!}
                                    </div>
                                    <span>{{ $brandInfo['name'] }}</span>
                                </div>

                                <!-- برچسب وضعیت خودرو در سمت چپ -->
                                @if($isUnavailable)
                                    <div class="sh-stage-floating-badge unavailable">
                                        <span class="dot"></span>
                                        <span>غیرقابل عرضه</span>
                                    </div>
                                @else
                                    <div class="sh-stage-floating-badge">
                                        <span class="dot"></span>
                                        <span>پلاک ملی • آماده واگذاری</span>
                                    </div>
                                @endif

                                <!-- شمارنده عکس فعال -->
                                <div class="sh-stage-counter-pill" id="{{ $counterId }}">
                                    <span class="cur">1</span>
                                    <span>/</span>
                                    <span class="total">{{ $totalImgCount }}</span>
                                </div>

                                <!-- فلش‌های ناوبری قبلی و بعدی -->
                                <button type="button" class="sh-stage-arrow prev" data-dir="prev" aria-label="عکس قبلی">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </button>
                                <button type="button" class="sh-stage-arrow next" data-dir="next" aria-label="عکس بعدی">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                </button>

                                <img class="sh-active-main-image" 
                                     id="{{ $stageId }}" 
                                     src="{{ $mainImg }}" 
                                     alt="{{ $car->titleSeo ?? $car->title }}" 
                                     onerror="this.onerror=null; this.src='/img/404Image.png';">
                            </div>

                            <!-- نوار تصاویر بندانگشتی زاویه‌های خودرو با تعویض آنی عکس -->
                            <div class="sh-thumbnails-strip" data-stage-target="{{ $stageId }}" data-counter-target="{{ $counterId }}">
                                @foreach($galleryImgs as $thumbIdx => $thumbUrl)
                                    <button type="button" 
                                            class="sh-thumb-btn {{ $thumbIdx === 0 ? 'is-active' : '' }}" 
                                            data-idx="{{ $thumbIdx + 1 }}"
                                            data-img-src="{{ $thumbUrl }}">
                                        <img src="{{ $thumbUrl }}" alt="زاویه {{ $thumbIdx + 1 }}" onerror="this.onerror=null; this.src='/img/404Image.png';">
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </article>
                @empty
                    <div style="background:#ffffff; border-radius:24px; padding:60px 20px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
                        <h3 style="color:#0f172a; font-weight:900;">خودرویی در این دسته‌بندی یافت نشد</h3>
                        <p style="color:#64748b; margin-top:10px;">به زودی محصولات جدید وارداتی گروه خودرویی سام به این بخش اضافه خواهد شد.</p>
                    </div>
                @endforelse
            </div>
        </main>

        <!-- توضیحات دسته در پایین صفحه -->
        @if(!empty($body))
            <div class="sh-archive-desc-box">
                <h3>درباره {{ $name ?? 'محصولات گروه خودرویی سام' }}</h3>
                <p>{{ $body }}</p>
            </div>
        @endif

    </div>
</div>
@endsection

@section('script1')
<script>
    $(document).ready(function(){
        // تعویض روان تصویر با کلیک روی بندانگشتی‌ها
        function switchCarImage($btn) {
            var $strip = $btn.closest('.sh-thumbnails-strip');
            var stageTargetId = $strip.attr('data-stage-target');
            var counterTargetId = $strip.attr('data-counter-target');
            var newSrc = $btn.attr('data-img-src');
            var idx = $btn.attr('data-idx') || '1';
            var $stageImg = $('#' + stageTargetId);

            if ($stageImg.length && newSrc) {
                $strip.find('.sh-thumb-btn').removeClass('is-active');
                $btn.addClass('is-active');

                // به‌روزرسانی شمارنده
                if (counterTargetId) {
                    $('#' + counterTargetId).find('.cur').text(idx);
                }

                var btnEl = $btn[0];
                var stripEl = $strip[0];
                if (btnEl && stripEl) {
                    stripEl.scrollTo({
                        left: btnEl.offsetLeft - (stripEl.clientWidth / 2) + (btnEl.clientWidth / 2),
                        behavior: 'smooth'
                    });
                }

                $stageImg.css({ 'opacity': '0', 'transform': 'scale(0.95)' });
                setTimeout(function(){
                    $stageImg.attr('src', newSrc);
                    $stageImg.css({ 'opacity': '1', 'transform': 'scale(1)' });
                }, 160);
            }
        }

        $(document).on('click', '.sh-thumb-btn', function(){
            switchCarImage($(this));
        });

        // کلیک روی فلش‌های قبلی و بعدی استیج
        $(document).on('click', '.sh-stage-arrow', function(e){
            e.stopPropagation();
            var dir = $(this).attr('data-dir');
            var $stage = $(this).closest('.sh-stage-large-box');
            var stageTargetId = $stage.attr('data-gallery-target');
            var $strip = $('.sh-thumbnails-strip[data-stage-target="' + stageTargetId + '"]');
            var $activeThumb = $strip.find('.sh-thumb-btn.is-active');
            var $targetThumb = null;

            if (dir === 'next') {
                $targetThumb = $activeThumb.next('.sh-thumb-btn');
                if (!$targetThumb.length) $targetThumb = $strip.find('.sh-thumb-btn').first();
            } else {
                $targetThumb = $activeThumb.prev('.sh-thumb-btn');
                if (!$targetThumb.length) $targetThumb = $strip.find('.sh-thumb-btn').last();
            }

            if ($targetThumb && $targetThumb.length) {
                switchCarImage($targetThumb);
            }
        });

        // پشتیبانی از سوایپ لمسی نیتیو (Touch Swipe Gestures) روی استیج در موبایل
        var touchStartX = 0;
        var touchEndX = 0;

        $('.sh-stage-large-box').on('touchstart', function(e){
            touchStartX = e.originalEvent.changedTouches[0].screenX;
        });

        $('.sh-stage-large-box').on('touchend', function(e){
            touchEndX = e.originalEvent.changedTouches[0].screenX;
            handleStageSwipe($(this));
        });

        function handleStageSwipe($stage) {
            var diff = touchEndX - touchStartX;
            if (Math.abs(diff) > 40) {
                var stageTargetId = $stage.attr('data-gallery-target');
                var $strip = $('.sh-thumbnails-strip[data-stage-target="' + stageTargetId + '"]');
                var $activeThumb = $strip.find('.sh-thumb-btn.is-active');
                var $targetThumb = null;

                if (diff < 0) {
                    $targetThumb = $activeThumb.next('.sh-thumb-btn');
                    if (!$targetThumb.length) $targetThumb = $strip.find('.sh-thumb-btn').first();
                } else {
                    $targetThumb = $activeThumb.prev('.sh-thumb-btn');
                    if (!$targetThumb.length) $targetThumb = $strip.find('.sh-thumb-btn').last();
                }

                if ($targetThumb && $targetThumb.length) {
                    switchCarImage($targetThumb);
                }
            }
        }
    });
</script>
@endsection