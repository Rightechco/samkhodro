<style>
    /* ==========================================================================
       SAM KHODRO ULTRA-LUXURY CRISP LIGHT SHOWROOM CARDS
       طراحی تماماً لایت، سفید متالیک و با کنتراست فوق‌العاده در تضاد با بک‌گراند دارک
       ========================================================================== */
    :root {
        --sh-light-card-bg: #ffffff;
        --sh-light-card-sub: #f8fafc;
        --sh-light-border: #e2e8f0;
        --sh-light-border-hover: #93c5fd;
        --sh-light-text-dark: #0f172a;
        --sh-light-text-body: #334155;
        --sh-light-text-muted: #64748b;
        --sh-light-primary: #2563eb;
        --sh-light-primary-dark: #1d4ed8;
    }

    /* تضمین نمایش ۱۰۰٪ لاتین تمامی ارقام، قیمت‌ها و کدهای مدل در بخش محصولات */
    .allProductIndex,
    .allProductIndex * {
        font-feature-settings: "ss01" 0, "ss02" 0, "kern" 1 !important;
        font-variant-numeric: lining-nums tabular-nums !important;
    }

    .allProductIndex {
        position: relative !important;
        width: 100% !important;
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        display: block !important;
        direction: rtl !important;
        isolation: isolate !important;
        background: transparent !important;
        padding: 0 0 45px 0 !important;
        margin: 0 !important;
        box-sizing: border-box !important;
        clear: both !important;
        overflow: hidden !important;
        border: none !important;
    }

    /* نویز و خطوط لیزری کف سالن نمایشگاه */
    .allProductIndex::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: 
            linear-gradient(to top, rgba(7, 10, 19, 0.95) 0%, transparent 100%),
            repeating-linear-gradient(90deg, rgba(37, 99, 235, 0.03) 0px, rgba(37, 99, 235, 0.03) 1px, transparent 1px, transparent 60px);
        transform: perspective(600px) rotateX(65deg);
        transform-origin: bottom center;
        pointer-events: none;
        z-index: 0;
    }

    /* هاله نور کبالت سقف نمایشگاه */
    .allProductIndex::after {
        content: '';
        position: absolute;
        top: -10%;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        height: 350px;
        background: radial-gradient(ellipse at center, rgba(37, 99, 235, 0.18) 0%, rgba(6, 182, 212, 0.05) 40%, transparent 70%);
        filter: blur(50px);
        pointer-events: none;
        z-index: 0;
    }

    .allProductIndex .showroom-fullwidth-wrapper {
        width: 100% !important;
        max-width: 1540px !important;
        margin: 0 auto !important;
        padding: 0 24px !important;
        box-sizing: border-box !important;
        position: relative !important;
        z-index: 2 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
    }

    /* هدر بخش محصولات */
    .allProductIndex .hp-title-wrapper {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        margin: 10px auto 26px auto !important;
        position: relative !important;
        padding: 0 16px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .allProductIndex .hp-title-box h3 {
        font-size: 2.2rem !important;
        font-weight: 900 !important;
        margin: 0 !important;
        letter-spacing: -0.6px !important;
        position: relative !important;
        display: inline-block !important;
        line-height: 1.3 !important;
        text-align: center !important;
        background: linear-gradient(135deg, #ffffff 40%, #cbd5e1 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }

    .allProductIndex .hp-title-box h3::after {
        content: '' !important;
        position: absolute !important;
        bottom: -9px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 75px !important;
        height: 3.5px !important;
        background: linear-gradient(90deg, #06b6d4, #2563eb, #8b5cf6) !important;
        border-radius: 99px !important;
        box-shadow: 0 0 20px rgba(37, 99, 235, 0.7) !important;
    }

    /* ==========================================================================
       کارت‌های لایت هایپرلوکس (Crisp Light Luxury Product Cards)
       ========================================================================== */
    .hp-products-lists {
        width: 100% !important;
        position: relative !important;
    }

    .allProductIndex .hp-product-card {
        position: relative !important;
        background: #ffffff !important;
        border-radius: 24px !important;
        border: 1px solid rgba(226, 232, 240, 0.95) !important;
        box-shadow: 
            0 20px 45px -12px rgba(0, 0, 0, 0.42),
            0 0 0 1px rgba(255, 255, 255, 0.8) inset !important;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease, border-color 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        margin: 10px 8px 24px 8px !important;
        isolation: isolate !important;
    }

    .allProductIndex .hp-product-card:hover {
        transform: translateY(-8px) scale(1.01) !important;
        background: #ffffff !important;
        border-color: #93c5fd !important;
        box-shadow: 
            0 32px 70px -15px rgba(0, 0, 0, 0.65),
            0 0 35px rgba(37, 99, 235, 0.25) !important;
    }

    .allProductIndex .hp-product-card a {
        text-decoration: none !important;
        color: inherit !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        position: relative !important;
    }

    /* واتر‌مارک هولوگرافیک وکتور برند در پس‌زمینه کارت */
    .hp-card-brand-watermark {
        position: absolute !important;
        top: 20px !important;
        left: -20px !important;
        width: 170px !important;
        height: 170px !important;
        opacity: 0.04 !important;
        pointer-events: none !important;
        z-index: 1 !important;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .hp-card-brand-watermark svg {
        width: 100% !important;
        height: 100% !important;
        fill: #2563eb !important;
    }

    .allProductIndex .hp-product-card:hover .hp-card-brand-watermark {
        opacity: 0.08 !important;
        transform: scale(1.15) rotate(-6deg) !important;
    }

    /* ==========================================================================
       استیج استودیویی لایت تصویر خودرو (Studio Light Turntable Stage)
       ========================================================================== */
    .allProductIndex .hp-product-pic {
        height: 250px !important;
        width: 100% !important;
        position: relative !important;
        overflow: hidden !important;
        background: radial-gradient(circle at 50% 65%, #ffffff 0%, #f1f5f9 65%, #e2e8f0 100%) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 22px !important;
        box-sizing: border-box !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    /* دیسک بیضی نوری کف استیج خودرو */
    .hp-turntable-disc {
        position: absolute;
        bottom: 16px;
        width: 78%;
        height: 24px;
        background: radial-gradient(ellipse at center, rgba(37, 99, 235, 0.3) 0%, rgba(6, 182, 212, 0.15) 50%, transparent 75%);
        border-radius: 50%;
        filter: blur(5px);
        transform: scaleY(0.4);
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: none;
        z-index: 1;
    }

    .allProductIndex .hp-product-card:hover .hp-turntable-disc {
        width: 88%;
        height: 32px;
        background: radial-gradient(ellipse at center, rgba(37, 99, 235, 0.5) 0%, rgba(6, 182, 212, 0.3) 50%, transparent 80%);
        filter: blur(7px);
    }

    .allProductIndex .hp-product-pic img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
        position: relative !important;
        z-index: 2 !important;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1), filter 0.8s ease !important;
        filter: drop-shadow(0 14px 24px rgba(15, 23, 42, 0.2)) brightness(1.02) !important;
    }

    .allProductIndex .hp-product-card:hover .hp-product-pic img {
        transform: scale(1.07) translateY(-4px) !important;
        filter: drop-shadow(0 20px 30px rgba(15, 23, 42, 0.3)) brightness(1.05) !important;
    }

    /* برچسب شیشه‌ای سفید برند خودرو */
    .hp-brand-logo-pill {
        position: absolute !important;
        top: 14px !important;
        right: 14px !important;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        color: #0f172a !important;
        padding: 6px 14px !important;
        border-radius: 99px !important;
        border: 1px solid #cbd5e1 !important;
        z-index: 4 !important;
        display: flex !important;
        align-items: center !important;
        gap: 7px !important;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08) !important;
        transition: all 0.35s ease !important;
    }

    .hp-brand-logo-pill svg {
        width: 16px !important;
        height: 16px !important;
        fill: #2563eb !important;
        flex-shrink: 0 !important;
    }

    .hp-brand-logo-pill span {
        font-size: 0.76rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.4px !important;
    }

    /* ==========================================================================
       استایل لایت خودروی غیرقابل عرضه (کرولا کراس 2025)
       تصویر بدون ماتی و کاملا شفاف - نمایش لایه شیشه‌ای منحصراً در هاور
       ========================================================================== */
    .hp-product-card.is-unavailable .hp-product-pic img {
        filter: drop-shadow(0 14px 24px rgba(15, 23, 42, 0.2)) brightness(1.02) !important;
        opacity: 1 !important;
    }

    .hp-unavailable-glass-hover {
        position: absolute !important;
        inset: 0 !important;
        background: rgba(15, 23, 42, 0.78) !important;
        backdrop-filter: blur(8px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(8px) saturate(180%) !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        z-index: 5 !important;
        padding: 20px !important;
        text-align: center !important;
    }

    .allProductIndex .hp-product-card.is-unavailable:hover .hp-unavailable-glass-hover {
        opacity: 1 !important;
        visibility: visible !important;
    }

    .hp-unavailable-glass-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        background: rgba(239, 68, 68, 0.18) !important;
        border: 1px solid rgba(248, 113, 113, 0.6) !important;
        color: #fca5a5 !important;
        padding: 10px 22px !important;
        border-radius: 99px !important;
        font-size: 0.92rem !important;
        font-weight: 900 !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35) !important;
        transform: translateY(10px) !important;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        letter-spacing: -0.2px !important;
    }

    .allProductIndex .hp-product-card.is-unavailable:hover .hp-unavailable-glass-badge {
        transform: translateY(0) !important;
    }

    .hp-unavailable-glass-badge .red-pulse-dot {
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        background: #ef4444 !important;
        box-shadow: 0 0 10px #ef4444 !important;
        animation: showroomPulse 1.4s infinite !important;
    }

    .hp-unavailable-glass-sub {
        font-size: 0.82rem !important;
        color: #e2e8f0 !important;
        margin: 0 !important;
        font-weight: 700 !important;
        transform: translateY(8px) !important;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1) 0.05s !important;
    }

    .allProductIndex .hp-product-card.is-unavailable:hover .hp-unavailable-glass-sub {
        transform: translateY(0) !important;
    }

    /* ==========================================================================
       لایه هاور تمام‌شیشه‌ای روی خودرو (Glass Cockpit Hover)
       ========================================================================== */
    .hp-card-glass-hover {
        position: absolute !important;
        inset: 0 !important;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.94) 0%, rgba(241, 245, 249, 0.96) 100%) !important;
        backdrop-filter: blur(8px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(8px) saturate(180%) !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 14px !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        z-index: 3 !important;
        padding: 24px !important;
        text-align: center !important;
    }

    .allProductIndex .hp-product-card:not(.is-unavailable):hover .hp-card-glass-hover {
        opacity: 1 !important;
        visibility: visible !important;
    }

    .hp-hover-brand-large {
        width: 58px !important;
        height: 58px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        border: 1px solid #bfdbfe !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.18) !important;
        transform: scale(0.6) translateY(15px) !important;
        transition: all 0.45s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    }

    .hp-hover-brand-large svg {
        width: 32px !important;
        height: 32px !important;
        fill: #2563eb !important;
    }

    .allProductIndex .hp-product-card:hover .hp-hover-brand-large {
        transform: scale(1) translateY(0) !important;
    }

    .hp-hover-cta {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        font-weight: 800 !important;
        font-size: 0.86rem !important;
        padding: 10px 22px !important;
        border-radius: 99px !important;
        box-shadow: 0 8px 22px rgba(37, 99, 235, 0.35) !important;
        transform: translateY(12px) !important;
        transition: all 0.45s cubic-bezier(0.34, 1.56, 0.64, 1) 0.05s !important;
    }

    .allProductIndex .hp-product-card:hover .hp-hover-cta {
        transform: translateY(0) !important;
    }

    /* ==========================================================================
       بدنه محتوایی لایت و مشخصات فنی خودرو
       ========================================================================== */
    .allProductIndex .hp-product-info {
        padding: 24px !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important;
        justify-content: space-between !important;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%) !important;
        position: relative !important;
        z-index: 2 !important;
    }

    .allProductIndex .hp-product-meta {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 14px !important;
        padding-bottom: 14px !important;
        border-bottom: 1px dashed #e2e8f0 !important;
        gap: 8px !important;
    }

    .allProductIndex .hp-product-meta .category-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-size: 0.82rem !important;
        font-weight: 700 !important;
        color: #475569 !important;
        background: #f1f5f9 !important;
        border: 1px solid #e2e8f0 !important;
        padding: 4px 10px !important;
        border-radius: 8px !important;
    }

    .allProductIndex .hp-product-meta .category-badge svg {
        width: 14px !important;
        height: 14px !important;
        color: #2563eb !important;
    }

    /* سیستم نمایش قیمت خودرو */
    .allProductIndex .hp-product-price-box {
        display: inline-flex !important;
        align-items: baseline !important;
        gap: 5px !important;
        direction: rtl !important;
    }

    .allProductIndex .hp-product-price-box .price-num {
        font-size: 1.25rem !important;
        color: #0f172a !important;
        font-weight: 900 !important;
        font-family: 'Segoe UI', Tahoma, sans-serif !important;
        direction: ltr !important;
        letter-spacing: -0.4px !important;
    }

    .allProductIndex .hp-product-price-box .price-unit {
        font-size: 0.78rem !important;
        color: #64748b !important;
        font-weight: 700 !important;
    }

    .allProductIndex .hp-product-price-box.contact-needed {
        color: #1d4ed8 !important;
        font-size: 0.86rem !important;
        font-weight: 800 !important;
        background: #eff6ff !important;
        padding: 5px 12px !important;
        border-radius: 8px !important;
        border: 1px solid #bfdbfe !important;
    }

    /* عنوان خودرو با رنگ تیره و تغییر به آبی در هاور */
    .allProductIndex .hp-product-title {
        font-size: 1.18rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        line-height: 1.55 !important;
        margin: 0 0 18px 0 !important;
        min-height: 54px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        transition: color 0.3s ease !important;
    }

    .allProductIndex .hp-product-card:hover .hp-product-title {
        color: #2563eb !important;
    }

    /* فوتر کارت محصول */
    .allProductIndex .hp-product-footer {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding-top: 16px !important;
        border-top: 1px solid #f1f5f9 !important;
    }

    .allProductIndex .hp-stock-badge {
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        color: #1d4ed8 !important;
        background: #eff6ff !important;
        border: 1px solid #bfdbfe !important;
        padding: 5px 12px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .allProductIndex .hp-stock-badge::before {
        content: '' !important;
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #2563eb !important;
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.6) !important;
    }

    .allProductIndex .hp-product-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-size: 0.92rem !important;
        font-weight: 800 !important;
        color: #2563eb !important;
        transition: all 0.3s ease !important;
    }

    .allProductIndex .hp-product-btn svg {
        width: 17px !important;
        height: 17px !important;
        stroke-width: 2.5 !important;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    }

    .allProductIndex .hp-product-card:hover .hp-product-btn {
        color: #1d4ed8 !important;
    }

    .allProductIndex .hp-product-card:hover .hp-product-btn svg {
        transform: translateX(-6px) !important;
    }

    /* فلش‌های ناوبری اسلایدر محصولات */
    .allProductIndex .slider-products.owl-theme .owl-nav {
        margin-top: 26px !important;
        display: flex !important;
        justify-content: center !important;
        gap: 14px !important;
    }

    .allProductIndex .slider-products.owl-theme .owl-nav [class*='owl-'] {
        width: 48px !important;
        height: 48px !important;
        border-radius: 50% !important;
        background: rgba(14, 22, 39, 0.85) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        padding: 0 !important;
        font-size: 1.3rem !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6) !important;
    }

    .allProductIndex .slider-products.owl-theme .owl-nav [class*='owl-']:hover {
        background: #2563eb !important;
        border-color: #60a5fa !important;
        box-shadow: 0 0 25px rgba(37, 99, 235, 0.7) !important;
        transform: translateY(-3px) scale(1.05) !important;
    }

    /* نقاط اسلایدر محصولات */
    .allProductIndex .slider-products.owl-theme .owl-dots {
        margin-top: 22px !important;
        display: flex !important;
        justify-content: center !important;
        gap: 8px !important;
    }

    .allProductIndex .slider-products.owl-theme .owl-dots .owl-dot span {
        width: 8px !important;
        height: 8px !important;
        background: rgba(255, 255, 255, 0.25) !important;
        border-radius: 99px !important;
        transition: all 0.3s ease !important;
    }

    .allProductIndex .slider-products.owl-theme .owl-dots .owl-dot.active span {
        width: 32px !important;
        background: linear-gradient(90deg, #06b6d4, #3b82f6) !important;
        box-shadow: 0 0 14px rgba(6, 182, 212, 0.9) !important;
    }

    /* ریسپانسیو ویژه موبایل و تبلت */
    @media (max-width: 991px) {
        .allProductIndex {
            padding: 30px 0 !important;
        }

        .allProductIndex .showroom-fullwidth-wrapper {
            padding: 0 20px !important;
        }

        .allProductIndex .hp-title-box h3 {
            font-size: 1.85rem !important;
        }
    }

    @media (max-width: 768px) {
        .allProductIndex {
            padding: 6px 0 20px 0 !important;
            margin: 0 !important;
            height: auto !important;
            min-height: 0 !important;
            max-height: none !important;
        }

        .allProductIndex .showroom-fullwidth-wrapper {
            padding: 0 14px !important;
            margin: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .allProductIndex .hp-title-wrapper {
            margin: 0 auto 14px auto !important;
            padding: 0 10px !important;
        }

        .allProductIndex .hp-title-box h3 {
            font-size: 1.42rem !important;
            margin-bottom: 8px !important;
        }

        .allProductIndex .hp-product-pic {
            height: 210px !important;
            padding: 16px !important;
        }

        .allProductIndex .hp-product-info {
            padding: 18px !important;
        }

        .allProductIndex .hp-product-title {
            font-size: 1.05rem !important;
            min-height: 48px !important;
        }
    }
</style>

@php
    // تابع کمکی تبدیل ارقام فارسی به لاتین برای محصولات
    if (!function_exists('prodToLatinDigits')) {
        function prodToLatinDigits($str) {
            if (empty($str)) return $str;
            $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
            $ar = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
            $en = ['0','1','2','3','4','5','6','7','8','9'];
            return str_replace($fa, $en, str_replace($ar, $en, (string)$str));
        }
    }

    /**
     * هلپر هوشمند تشخیص برند خودرو از عنوان محصول و ارائه نام و نشانگر SVG استاندارد
     */
    if (!function_exists('getAutomotiveBrandDetails')) {
        function getAutomotiveBrandDetails($title) {
            $t = mb_strtolower($title, 'UTF-8');
            
            if (str_contains($t, 'تویوتا') || str_contains($t, 'toyota')) {
                return [
                    'name' => 'TOYOTA',
                    // لوگوی رسمی و دقیق سه‌بیضی بین‌المللی تویوتا
                    'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.766c-6.627 0-12 3.655-12 8.164 0 3.738 3.702 6.896 9.176 7.854l-.448-1.57c-4.469-.877-7.464-3.328-7.464-6.284 0-3.834 4.793-6.942 10.736-6.942 5.943 0 10.736 3.108 10.736 6.942 0 2.956-2.995 5.407-7.464 6.284l-.448 1.57c5.474-.958 9.176-4.116 9.176-7.854 0-4.509-5.373-8.164-12-8.164zm0 2.213c-2.316 0-4.417 1.487-4.417 3.992 0 2.943 1.942 6.136 4.417 8.016 2.475-1.88 4.417-5.073 4.417-8.016 0-2.505-2.101-3.992-4.417-3.992zm0 1.258c1.654 0 3.159 1.157 3.159 2.734 0 2.378-1.748 5.251-3.159 6.852-1.411-1.601-3.159-4.474-3.159-6.852 0-1.577 1.505-2.734 3.159-2.734zm0 1.47c-3.791 0-7.009 1.432-8.238 3.486 1.229 2.054 4.447 3.486 8.238 3.486 3.791 0 7.009-1.432 8.238-3.486-1.229-2.054-4.447-3.486-8.238-3.486zm0 1.221c2.81 0 5.422.958 6.828 2.265-1.406 1.307-4.018 2.265-6.828 2.265-2.81 0-5.422-.958-6.828-2.265 1.406-1.307 4.018-2.265 6.828-2.265z"/></svg>'
                ];
            }
            if (str_contains($t, 'هیوندای') || str_contains($t, 'hyundai')) {
                return [
                    'name' => 'HYUNDAI',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.8 14.5c-.8.8-3.2 1.5-4.8 1.5s-4-.7-4.8-1.5c-1-1-1.2-3.5-.8-6.5.3-2.3 1.2-4.5 2.8-4.5 1.2 0 1.9 1.4 2.8 3.5.9-2.1 1.6-3.5 2.8-3.5 1.6 0 2.5 2.2 2.8 4.5.4 3 .2 5.5-.8 6.5z"/></svg>'
                ];
            }
            if (str_contains($t, 'کیا') || str_contains($t, 'kia')) {
                return [
                    'name' => 'KIA',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 12h-2.2l-1.3-3.2-1.3 3.2H10l-1.5-4h2.1l.6 1.8.7-1.8h2.4l-.8 2 1.5 2zm-10 0H5V8h2v6z"/></svg>'
                ];
            }
            if (str_contains($t, 'بنز') || str_contains($t, 'مرسدس') || str_contains($t, 'benz') || str_contains($t, 'mercedes')) {
                return [
                    'name' => 'MERCEDES',
                    'svg' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 3v9m0 0l7.8 4.5M12 12l-7.8 4.5" stroke="currentColor" stroke-width="1.8"/></svg>'
                ];
            }
            if (str_contains($t, 'بی ام و') || str_contains($t, 'ب ام و') || str_contains($t, 'bmw')) {
                return [
                    'name' => 'BMW',
                    'svg' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 2a10 10 0 0 0-10 10h10V2zm0 10H2a10 10 0 0 0 10 10V12zm10-10a10 10 0 0 0-10 10h10V2zm-10 10v10a10 10 0 0 0 10-10H12z"/></svg>'
                ];
            }
            if (str_contains($t, 'پورشه') || str_contains($t, 'porsche')) {
                return [
                    'name' => 'PORSCHE',
                    'svg' => '<svg viewBox="0 0 24 24"><path d="M12 2L4 5v6c0 5.55 3.84 10.74 8 12 4.16-1.26 8-6.45 8-12V5l-8-3zm0 4a3 3 0 0 1 3 3c0 2-3 5-3 5s-3-3-3-5a3 3 0 0 1 3-3z"/></svg>'
                ];
            }
            if (str_contains($t, 'هوندا') || str_contains($t, 'honda')) {
                return [
                    'name' => 'HONDA',
                    'svg' => '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="4" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M7 6v12m10-12v12M7 12h10" stroke="currentColor" stroke-width="2"/></svg>'
                ];
            }
            if (str_contains($t, 'لکسوس') || str_contains($t, 'lexus')) {
                return [
                    'name' => 'LEXUS',
                    'svg' => '<svg viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="10" ry="7" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M7 8v7h9" stroke="currentColor" stroke-width="2"/></svg>'
                ];
            }
            if (str_contains($t, 'نیسان') || str_contains($t, 'nissan')) {
                return [
                    'name' => 'NISSAN',
                    'svg' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><rect x="2" y="10" width="20" height="4" rx="1" fill="currentColor"/></svg>'
                ];
            }

            // فال‌بک لوکس پیش‌فرض (سام خودرو - نشان سوپرکار)
            return [
                'name' => 'SAM KHODRO',
                'svg' => '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>'
            ];
        }
    }
@endphp

<div class="allProductIndex">
    <div class="showroom-fullwidth-wrapper">
        
        <!-- باکس هدر بخش و تیتر اختصاصی و پرمیوم -->
        <div class="hp-title-wrapper hp-title-box">
            <h3>خودروهای جدید و قابل عرضه</h3>
        </div>

        <!-- ریل اسلایدر کاروسل کارت‌های محصولات لایت پرمیوم (دقیقاً ۳ کارت در نمایشگر) -->
        <div class="hp-products-lists">
            @foreach($data['post'] as $item)
                @php
                    // مرتب‌سازی دقیق کارت‌ها: در چیدمان RTL اسلایدر، المان اول در سمت راست و المان سوم در سمت چپ قرار می‌گیرد
                    // بنابراین وزن‌دهی به صورت: ۱. کرولا کراس ۲۰۲۵ (راست)، ۲. کرولا کراس ۲۰۲۵ نیوفیس (وسط)، ۳. کرولا کراس ۲۰۲۶ (چپ)
                    $orderedProducts = collect($item['product'])->sortBy(function($car) {
                        $t = mb_strtolower($car->title ?? '', 'UTF-8');
                        $isNewFace = str_contains($t, 'نیوفیس') || str_contains($t, 'new face');
                        $is2026    = str_contains($t, '2026') || str_contains($t, '۲۰۲۶');
                        $is2025    = str_contains($t, '2025') || str_contains($t, '۲۰۲۵');

                        if ($car->id == 8 || ($is2025 && !$isNewFace && !$is2026)) {
                            return 1; // سمت راست (کرولا کراس 2025 غیرقابل عرضه)
                        }
                        if ($isNewFace) {
                            return 2; // وسط (2025 نیوفیس)
                        }
                        if ($is2026) {
                            return 3; // سمت چپ (اولین کارت سمت چپ: 2026)
                        }
                        return 4;
                    })->values();
                @endphp

                <div class="lists cat{{$item->id}}">
                    <div class="slider-products owl-carousel owl-theme">
                        @foreach($orderedProducts as $val)
                            @php
                                $imgSrc = $val->image ? (is_array(json_decode($val->image)) ? json_decode($val->image)[0] : $val->image) : '/img/404Image.png';
                                $categoryName = $val->category()->pluck('name')->first() ?? $item->name;
                                $cleanTitle = prodToLatinDigits($val->title);
                                $brandInfo = getAutomotiveBrandDetails($cleanTitle);
                                
                                $tLower = mb_strtolower($val->title ?? '', 'UTF-8');
                                $isNewFace = str_contains($tLower, 'نیوفیس') || str_contains($tLower, 'new face');
                                $is2026    = str_contains($tLower, '2026') || str_contains($tLower, '۲۰۲۶');
                                $is2025    = str_contains($tLower, '2025') || str_contains($tLower, '۲۰۲۵');

                                // خودروی غیر قابل عرضه منحصراً کرولا کراس 2025 معمولی (شناسه 8 یا بدون نیوفیس/2026) است
                                $isUnavailable = ($val->id == 8) || ($is2025 && !$isNewFace && !$is2026);
                            @endphp

                            <article class="hp-product-card {{ $isUnavailable ? 'is-unavailable' : '' }}">
                                <a href="{{ $isUnavailable ? 'javascript:void(0)' : '/product/'.$val->slug }}" title="{{$cleanTitle}}" {!! $isUnavailable ? 'style="cursor: default;"' : '' !!}>
                                    
                                    <!-- واتر‌مارک هولوگرافیک وکتور برند در پس‌زمینه کارت -->
                                    <div class="hp-card-brand-watermark">
                                        {!! $brandInfo['svg'] !!}
                                    </div>

                                    <!-- استیج استودیویی لایت خودرو -->
                                    <div class="hp-product-pic">
                                        <!-- دیسک نوری کف استیج (Showroom Turntable) -->
                                        <div class="hp-turntable-disc"></div>

                                        <!-- لوگوی رسمی برند خودرو در گوشه بالا راست -->
                                        <div class="hp-brand-logo-pill" title="برند سازنده">
                                            {!! $brandInfo['svg'] !!}
                                            <span>{{ $brandInfo['name'] }}</span>
                                        </div>

                                        <!-- تصویر کامل خودرو با کنتراست شفاف و بدون ماتی -->
                                        <img class="owl-lazy lazyload" 
                                             src="{{$imgSrc}}" 
                                             data-src="{{$imgSrc}}" 
                                             alt="{{$val->titleSeo ?? $cleanTitle}}"
                                             onerror="this.onerror=null; this.src='/img/404Image.png';">

                                        @if($isUnavailable)
                                            <!-- هاور شیشه‌ای لوکس منحصراً برای کرولا کراس 2025 (تصویر در حالت عادی کاملاً واضح و شفاف است) -->
                                            <div class="hp-unavailable-glass-hover">
                                                <div class="hp-unavailable-glass-badge">
                                                    <span class="red-pulse-dot"></span>
                                                    <span>غیر قابل عرضه</span>
                                                </div>
                                                <p class="hp-unavailable-glass-sub">اتمام ظرفیت ثبت‌نام در این دوره واردات</p>
                                            </div>
                                        @else
                                            <!-- لایه هاور تمام‌شیشه‌ای با دکمه بررسی سریع برای سایر خودروهای فعال -->
                                            <div class="hp-card-glass-hover">
                                                <div class="hp-hover-brand-large">
                                                    {!! $brandInfo['svg'] !!}
                                                </div>
                                                <div class="hp-hover-cta">
                                                    <span>مشاهده مشخصات و ثبت درخواست</span>
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                                        <polyline points="12 19 5 12 12 5"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- مشخصات قیمت، دسته‌بندی و عنوان خودرو در پنل سفید -->
                                    <div class="hp-product-info">
                                        <div class="hp-product-meta">
                                            <div class="category-badge">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polygon points="12 8 8 12 12 16 16 12 12 8"></polygon>
                                                </svg>
                                                <span>{{$categoryName}}</span>
                                            </div>

                                            @if($isUnavailable)
                                                <div class="hp-product-price-box" style="color: #dc2626 !important; font-size: 0.88rem; font-weight: 800;">
                                                    <span>غیر قابل عرضه</span>
                                                </div>
                                            @elseif(!empty($val->priceF) && $val->priceF > 0)
                                                <div class="hp-product-price-box">
                                                    <span class="price-num">{{prodToLatinDigits(number_format($val->priceF))}}</span>
                                                    <span class="price-unit">تومان</span>
                                                </div>
                                            @else
                                                <div class="hp-product-price-box contact-needed">
                                                    <span>به زودی</span>
                                                </div>
                                            @endif
                                        </div>

                                        <h4 class="hp-product-title">{{$cleanTitle}}</h4>

                                        <!-- فوتر کارت: وضعیت تخصیص و لینک مشخصات فنی -->
                                        <div class="hp-product-footer">
                                            @if($isUnavailable)
                                                <span class="hp-stock-badge" style="background: #fef2f2 !important; color: #dc2626 !important; border-color: #fca5a5 !important;">عدم امکان ثبت‌نام</span>
                                                <div class="hp-product-btn" style="color: #94a3b8 !important;">
                                                    <span>بسته شده</span>
                                                </div>
                                            @else
                                                <span class="hp-stock-badge">آماده تخصیص و تحویل</span>
                                                <div class="hp-product-btn">
                                                    <span>مشخصات فنی</span>
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                                        <polyline points="12 19 5 12 12 5"></polyline>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
</div>