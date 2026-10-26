@extends('home.master')

@section('active' , \App\Models\Widget::where('status' , 1)->orderBy('number')->pluck('name')->first() == 'cover' ? 0 : 1)

@section('content')
<style>
    /* ==========================================================================
       SAM KHODRO ULTRA-LUXURY SHOWROOM & AUTOMOTIVE ECOSYSTEM (HYPER-PREMIUM DARK)
       سیستم طراحی یکپارچه هایپرلوکس، متالیک تیتانیوم، بدون گپ، بدون خطای سینتکس
       ========================================================================== */
    :root {
        /* پالت رنگی متعادل، روشن‌تر و زنده (سرمه‌ای اگزکیوتیو، اسلیت و متالیک) */
        --sam-obsidian: #0b1329;
        --sam-bg-darkest: #0e172a;
        --sam-bg-base: #111c38;
        --sam-bg-surface: #182647;
        --sam-bg-card: rgba(23, 37, 68, 0.76);
        --sam-bg-card-hover: rgba(30, 48, 88, 0.92);
        
        /* هایلایت‌های نئونی و رفلکس‌های تیتانیومی */
        --sam-primary: #2563eb;
        --sam-primary-light: #3b82f6;
        --sam-primary-glow: rgba(37, 99, 235, 0.45);
        --sam-cyan: #06b6d4;
        --sam-cyan-glow: rgba(6, 182, 212, 0.4);
        --sam-emerald: #10b981;
        --sam-crimson: #ef4444;
        
        /* رنگ متون و لایه‌های خوانایی */
        --sam-text-main: #f8fafc;
        --sam-text-muted: #94a3b8;
        --sam-text-dim: #64748b;
        
        /* حاشیه‌ها، شیشه‌های تاریک و سایه‌ها */
        --sam-border-glass: rgba(255, 255, 255, 0.12);
        --sam-border-hover: rgba(59, 130, 246, 0.55);
        --sam-radius-sm: 12px;
        --sam-radius-md: 18px;
        --sam-radius-lg: 24px;
        --sam-radius-xl: 30px;
        --sam-shadow-card: 0 20px 45px -15px rgba(0, 0, 0, 0.55);
        --sam-shadow-hover: 0 30px 65px -12px rgba(37, 99, 235, 0.35);
        --sam-transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* لغو کامل رفتارهای تحمیلی تمام‌صفحه و اسنپ اسکرول برای روانی ۱۰۰٪ */
    html, body, .allHome, .allIndexWidgets {
        scroll-snap-type: none !important;
        height: auto !important;
        min-height: auto !important;
        scroll-behavior: smooth !important;
    }

    body {
        background-color: var(--sam-bg-darkest) !important;
        color: var(--sam-text-main) !important;
        overflow-x: hidden !important;
    }

    /* لغو تبدیل خودکار ارقام به فارسی در بخش کاور و محصولات */
    .cover-section,
    .cover-section *,
    .hero-section,
    .hero-section *,
    .product-section,
    .product-section *,
    .allCoversIndex,
    .allCoversIndex *,
    .allProductIndex,
    .allProductIndex * {
        font-feature-settings: "ss01" 0, "ss02" 0, "kern" 1 !important;
        font-variant-numeric: lining-nums tabular-nums !important;
    }

    /* کانتینر اصلی ویجت‌ها با نورپردازی محیطی بازتر و بدون تیرگی زننده */
    .allIndexWidgets {
        position: relative !important;
        background: radial-gradient(circle at 50% 0%, #1e3a8a 0%, #172554 28%, #0f172a 70%, #0b1329 100%) !important;
        min-height: 100vh !important;
        height: auto !important;
        overflow: hidden !important;
        z-index: 1 !important;
        display: block !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* هاله‌های نوری شناور در بک‌گراند */
    .allIndexWidgets::before {
        content: '' !important;
        position: absolute !important;
        top: 6% !important;
        left: -10% !important;
        width: 800px !important;
        height: 800px !important;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.22) 0%, transparent 70%) !important;
        border-radius: 50% !important;
        pointer-events: none !important;
        z-index: 0 !important;
        filter: blur(45px) !important;
    }

    .allIndexWidgets::after {
        content: '' !important;
        position: absolute !important;
        top: 45% !important;
        right: -8% !important;
        width: 900px !important;
        height: 900px !important;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.16) 0%, transparent 70%) !important;
        border-radius: 50% !important;
        pointer-events: none !important;
        z-index: 0 !important;
        filter: blur(55px) !important;
    }

    /* تنظیمات ساختاری بخش‌ها - حذف کامل هرگونه فاصله نوک‌مدادی یا خالی */
    .allIndexWidgets .indexData,
    .indexData {
        position: relative !important;
        width: 100% !important;
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
        scroll-snap-align: none !important;
        padding: 30px 0 !important;
        margin: 0 !important;
        clear: both !important;
        display: block !important;
        z-index: 2 !important;
        box-sizing: border-box !important;
    }

    /* بخش کاور و اسلایدر هیرو و محصولات: بدون هیچ پدینگ اضافه و اتصال کامل به بالا */
    .indexData.cover-section,
    .indexData.hero-section,
    .indexData.product-section,
    #cover,
    #product {
        padding: 0 !important;
        margin: 0 !important;
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
    }

    .cover-section .allCoversIndex,
    .hero-section .allCoversIndex {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
        height: auto !important;
        min-height: 0 !important;
    }

    .product-section .allProductIndex {
        padding-top: 0 !important;
        margin-top: 0 !important;
        height: auto !important;
        min-height: 0 !important;
    }

    .indexData::after, .width::after {
        content: "" !important;
        display: table !important;
        clear: both !important;
    }

    /* سئو و ساختار تیتر مخفی */
    .seoTag {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        border: 0 !important;
    }

    /* استایل عناوین تمامی بخش‌ها با گرادیان نقره‌ای متالیک و خط تاکید */
    .hp-title-box {
        text-align: center !important;
        margin: 0 auto 34px auto !important;
        width: 100% !important;
        position: relative !important;
        z-index: 3 !important;
        padding: 0 16px !important;
        box-sizing: border-box !important;
    }

    .hp-section-pill {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: rgba(37, 99, 235, 0.12) !important;
        border: 1px solid rgba(59, 130, 246, 0.35) !important;
        color: #38bdf8 !important;
        padding: 6px 20px !important;
        border-radius: 99px !important;
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        margin-bottom: 14px !important;
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        box-shadow: 0 0 20px rgba(37, 99, 235, 0.2) !important;
    }

    .hp-section-pill .pulse-dot {
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        background: var(--sam-cyan) !important;
        box-shadow: 0 0 10px var(--sam-cyan) !important;
        animation: samPulseLive 1.8s infinite ease-in-out !important;
    }

    @keyframes samPulseLive {
        0%, 100% { transform: scale(0.9); opacity: 0.8; box-shadow: 0 0 8px var(--sam-cyan); }
        50% { transform: scale(1.35); opacity: 1; box-shadow: 0 0 18px #38bdf8; }
    }

    .hp-title-box h3 {
        font-size: 2.2rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin: 0 0 14px 0 !important;
        position: relative !important;
        display: inline-block !important;
        letter-spacing: -0.6px !important;
        background: linear-gradient(135deg, #ffffff 40%, #cbd5e1 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        line-height: 1.35 !important;
    }

    .hp-title-box h3::after {
        content: '' !important;
        position: absolute !important;
        bottom: -10px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 75px !important;
        height: 3.5px !important;
        background: linear-gradient(90deg, var(--sam-cyan), var(--sam-primary), #8b5cf6) !important;
        border-radius: 99px !important;
        box-shadow: 0 0 18px var(--sam-primary-glow) !important;
    }

    .hp-title-box p {
        font-size: 1.02rem !important;
        color: var(--sam-text-muted) !important;
        max-width: 680px !important;
        margin: 18px auto 0 auto !important;
        line-height: 1.9 !important;
    }

    /* مهار کامل سایز ساعت‌ها و آیکون‌های آماری و جلوگیری از کشیده شدن */
    .allNumberIndex,
    .allOptionIndex {
        position: relative !important;
        width: 100% !important;
        padding: 30px 0 !important;
    }

    .allNumberIndex svg,
    .allOptionIndex svg,
    .allNumberIndex img,
    .allOptionIndex img,
    .allNumberIndex .item i svg,
    .allOptionIndex .item i svg {
        max-width: 50px !important;
        max-height: 50px !important;
        width: 50px !important;
        height: 50px !important;
        display: inline-block !important;
        margin: 0 auto 14px auto !important;
        color: #38bdf8 !important;
        fill: currentColor !important;
        stroke: currentColor !important;
        flex-shrink: 0 !important;
        filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.45)) !important;
    }

    .allNumberIndex .item,
    .allOptionIndex .item {
        background: var(--sam-bg-card) !important;
        border: 1px solid var(--sam-border-glass) !important;
        border-radius: var(--sam-radius-lg) !important;
        padding: 28px 22px !important;
        text-align: center !important;
        backdrop-filter: blur(18px) saturate(160%) !important;
        -webkit-backdrop-filter: blur(18px) saturate(160%) !important;
        transition: var(--sam-transition) !important;
        margin-bottom: 20px !important;
        box-shadow: var(--sam-shadow-card) !important;
    }

    .allNumberIndex .item:hover,
    .allOptionIndex .item:hover {
        transform: translateY(-8px) !important;
        border-color: var(--sam-border-hover) !important;
        box-shadow: var(--sam-shadow-hover) !important;
        background: var(--sam-bg-card-hover) !important;
    }

    .allNumberIndex .numberCount,
    .allNumberIndex h4,
    .allOptionIndex h4,
    .allNumberIndex h5,
    .allOptionIndex h5 {
        color: #ffffff !important;
        font-weight: 900 !important;
        margin-top: 6px !important;
    }

    .allNumberIndex .numberCount {
        font-size: 2.2rem !important;
        color: #38bdf8 !important;
        font-family: 'Segoe UI', Tahoma, sans-serif !important;
    }

    /* استایل جامع شوروم خودروها با کارت‌های لایت و سفید متالیک */
    .hp-products-lists {
        width: 100% !important;
        position: relative !important;
    }

    .allProductIndex .hp-product-card {
        position: relative !important;
        background: #ffffff !important;
        border-radius: var(--sam-radius-lg) !important;
        border: 1px solid rgba(226, 232, 240, 0.95) !important;
        box-shadow: 0 20px 45px -12px rgba(0, 0, 0, 0.42), 0 0 0 1px rgba(255, 255, 255, 0.8) inset !important;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease, border-color 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        margin: 10px 8px 24px 8px !important;
        isolation: isolate !important;
        height: 100% !important;
    }

    .allProductIndex .hp-product-card:hover {
        transform: translateY(-8px) scale(1.01) !important;
        background: #ffffff !important;
        border-color: #93c5fd !important;
        box-shadow: 0 32px 70px -15px rgba(0, 0, 0, 0.65), 0 0 35px rgba(37, 99, 235, 0.25) !important;
    }

    .allProductIndex .hp-product-pic {
        height: 250px !important;
        width: 100% !important;
        position: relative !important;
        overflow: hidden !important;
        background: radial-gradient(circle at 50% 65%, #ffffff 0%, #f1f5f9 65%, #e2e8f0 100%) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 16px 20px !important;
        box-sizing: border-box !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .allProductIndex .hp-product-pic img {
        width: auto !important;
        height: auto !important;
        max-width: 100% !important;
        max-height: 100% !important;
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

    /* پداستال نوری کف استیج استودیویی لایت */
    .hp-turntable-disc {
        position: absolute !important;
        bottom: 16px !important;
        width: 78% !important;
        height: 24px !important;
        background: radial-gradient(ellipse at center, rgba(37, 99, 235, 0.3) 0%, rgba(6, 182, 212, 0.15) 50%, transparent 75%) !important;
        border-radius: 50% !important;
        filter: blur(5px) !important;
        transform: scaleY(0.4) !important;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
        pointer-events: none !important;
        z-index: 1 !important;
    }

    .allProductIndex .hp-product-card:hover .hp-turntable-disc {
        width: 88% !important;
        height: 32px !important;
        background: radial-gradient(ellipse at center, rgba(37, 99, 235, 0.5) 0%, rgba(6, 182, 212, 0.3) 50%, transparent 80%) !important;
        filter: blur(7px) !important;
    }

    /* استایل اختصاصی برای خودروی غیرقابل عرضه (کرولا کراس 2025) - تصویر بدون مات شدن و شفاف */
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
        letter-spacing: -0.2px !important;
    }

    /* کارت‌های هایپرلوکس خدمات واردات و تشریفات خودرویی */
    .allServiceIndex {
        position: relative !important;
        width: 100% !important;
        padding: 35px 0 25px 0 !important;
        background: transparent !important;
        direction: rtl !important;
        isolation: isolate !important;
    }

    .allServiceIndex .slider-service {
        padding: 10px 0 25px 0 !important;
        position: relative !important;
    }

    .hp-service-item {
        position: relative !important;
        height: 460px !important;
        border-radius: 26px !important;
        overflow: hidden !important;
        background: #080d1a !important;
        border: 1px solid rgba(255, 255, 255, 0.09) !important;
        box-shadow: 0 25px 50px -15px rgba(0, 0, 0, 0.85), 0 0 0 1px rgba(255, 255, 255, 0.04) inset !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s ease, border-color 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: flex-end !important;
        isolation: isolate !important;
        margin: 10px 6px 24px 6px !important;
    }

    .hp-service-bg {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        z-index: -2 !important;
        filter: brightness(0.62) contrast(1.15) !important;
        transform: scale(1.01);
        transition: transform 1s cubic-bezier(0.16, 1, 0.3, 1), filter 0.8s ease !important;
    }

    .hp-service-overlay {
        position: absolute !important;
        inset: 0 !important;
        z-index: -1 !important;
        background: linear-gradient(180deg, rgba(3, 7, 18, 0.15) 0%, rgba(6, 11, 23, 0.55) 45%, rgba(4, 8, 18, 0.94) 82%, #040712 100%) !important;
        transition: opacity 0.5s ease !important;
    }

    .hp-service-top-bar {
        position: absolute !important;
        top: 22px !important;
        right: 22px !important;
        left: 22px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        z-index: 2 !important;
    }

    .hp-service-badge {
        background: rgba(10, 16, 31, 0.8) !important;
        backdrop-filter: blur(14px) !important;
        border: 1px solid rgba(56, 189, 248, 0.35) !important;
        color: #38bdf8 !important;
        font-size: 0.78rem !important;
        font-weight: 800 !important;
        padding: 5px 14px !important;
        border-radius: 99px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5) !important;
    }

    .hp-service-badge .pulse-point {
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #06b6d4 !important;
        box-shadow: 0 0 8px #06b6d4 !important;
    }

    .hp-service-icon-circle {
        width: 48px !important;
        height: 48px !important;
        border-radius: 16px !important;
        background: rgba(15, 23, 42, 0.75) !important;
        backdrop-filter: blur(14px) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #38bdf8 !important;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4) !important;
    }

    .hp-service-icon-circle svg {
        width: 22px !important;
        height: 22px !important;
        stroke-width: 2.2 !important;
    }

    .hp-service-content {
        position: relative !important;
        z-index: 2 !important;
        padding: 32px 28px 26px 28px !important;
        transform: translateY(12px) !important;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .hp-service-content h4 {
        font-size: 1.45rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin: 0 0 12px 0 !important;
        line-height: 1.35 !important;
        letter-spacing: -0.4px !important;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8) !important;
        transition: color 0.3s ease !important;
    }

    .hp-service-content p {
        font-size: 0.94rem !important;
        color: #94a3b8 !important;
        line-height: 1.85 !important;
        margin: 0 0 20px 0 !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.7) !important;
    }

    .hp-service-action {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        font-weight: 800 !important;
        font-size: 0.9rem !important;
        padding: 10px 22px !important;
        border-radius: 99px !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45) !important;
        text-decoration: none !important;
        opacity: 0.85 !important;
        transform: translateY(6px) !important;
        transition: all 0.45s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .hp-service-action svg {
        width: 15px !important;
        height: 15px !important;
        stroke-width: 2.5 !important;
        transition: transform 0.3s ease !important;
    }

    .hp-service-item:hover {
        transform: translateY(-12px) scale(1.015) !important;
        border-color: rgba(59, 130, 246, 0.6) !important;
        box-shadow: 0 35px 70px -15px rgba(0, 0, 0, 0.95), 0 0 35px rgba(37, 99, 235, 0.35) !important;
    }

    .hp-service-item:hover .hp-service-bg {
        transform: scale(1.1) !important;
        filter: brightness(0.52) contrast(1.25) !important;
    }

    .hp-service-item:hover .hp-service-icon-circle {
        background: #2563eb !important;
        border-color: #60a5fa !important;
        color: #ffffff !important;
        box-shadow: 0 0 25px rgba(37, 99, 235, 0.8) !important;
        transform: rotate(-15deg) scale(1.08) !important;
    }

    .hp-service-item:hover .hp-service-content {
        transform: translateY(0) !important;
    }

    .hp-service-item:hover .hp-service-content h4 {
        color: #93c5fd !important;
    }

    .hp-service-item:hover .hp-service-content p {
        color: #cbd5e1 !important;
        -webkit-line-clamp: 3 !important;
    }

    .hp-service-item:hover .hp-service-action {
        opacity: 1 !important;
        transform: translateY(0) !important;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.7) !important;
    }

    .hp-service-item:hover .hp-service-action svg {
        transform: translateX(-5px) !important;
    }

    /* کارت‌های مجله و اخبار خودرویی (Light Luxury Contrast) */
    .allBlogIndex {
        position: relative !important;
        width: 100% !important;
        padding: 40px 0 35px 0 !important;
        direction: rtl !important;
        isolation: isolate !important;
    }

    .allBlogIndex .slider-blogs {
        padding: 10px 0 25px 0 !important;
        position: relative !important;
    }

    .hp-blog-card,
    .hp-blog-card-light {
        background: #ffffff !important;
        border-radius: 24px !important;
        overflow: hidden !important;
        box-shadow: 0 20px 45px -12px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(255, 255, 255, 0.8) inset !important;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease, border-color 0.4s ease !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        margin: 10px 6px 24px 6px !important;
        display: flex !important;
        flex-direction: column !important;
        text-decoration: none !important;
        position: relative !important;
        isolation: isolate !important;
    }

    .hp-blog-card:hover,
    .hp-blog-card-light:hover {
        transform: translateY(-8px) !important;
        background: #ffffff !important;
        border-color: #93c5fd !important;
        box-shadow: 0 30px 65px -15px rgba(0, 0, 0, 0.65), 0 0 35px rgba(37, 99, 235, 0.25) !important;
    }

    .hp-blog-pic {
        height: 220px !important;
        position: relative !important;
        overflow: hidden !important;
        background: #0f172a !important;
    }

    .hp-blog-pic img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .hp-blog-card:hover .hp-blog-pic img,
    .hp-blog-card-light:hover .hp-blog-pic img {
        transform: scale(1.08) !important;
    }

    .hp-blog-info {
        padding: 24px !important;
        background: #ffffff !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important;
        justify-content: space-between !important;
    }

    .hp-blog-title {
        font-size: 1.15rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        margin: 0 0 16px 0 !important;
        line-height: 1.6 !important;
        min-height: 52px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        transition: color 0.3s ease !important;
    }

    .hp-blog-card:hover .hp-blog-title,
    .hp-blog-card-light:hover .hp-blog-title {
        color: #2563eb !important;
    }

    .hp-view-more-cta {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        padding: 13px 36px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 50%, #0284c7 100%) !important;
        color: #ffffff !important;
        border-radius: 99px !important;
        font-weight: 800 !important;
        font-size: 0.96rem !important;
        text-decoration: none !important;
        box-shadow: 0 10px 25px -4px rgba(37, 99, 235, 0.55) !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .hp-view-more-cta:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 16px 35px -2px rgba(37, 99, 235, 0.75) !important;
        color: #ffffff !important;
    }

    /* بخش توانمندی‌های اختصاصی واردات و لجستیک */
    .hp-work-wrapper {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 40px !important;
        align-items: center !important;
        background: var(--sam-bg-card) !important;
        padding: 45px !important;
        border-radius: 28px !important;
        box-shadow: var(--sam-shadow-card) !important;
        border: 1px solid var(--sam-border-glass) !important;
        backdrop-filter: blur(16px) !important;
    }

    .hp-work-right h3 {
        font-size: 2.1rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin-bottom: 20px !important;
        line-height: 1.35 !important;
    }

    .hp-work-right p {
        color: var(--sam-text-muted) !important;
        line-height: 1.95 !important;
        font-size: 1.02rem !important;
    }

    .hp-work-list {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }

    .hp-work-list li {
        margin-bottom: 24px !important;
    }

    .hp-work-list .top {
        display: flex !important;
        justify-content: space-between !important;
        margin-bottom: 10px !important;
        font-weight: 800 !important;
        color: #ffffff !important;
        font-size: 1rem !important;
    }

    .hp-work-list .top span:last-child {
        color: #60a5fa !important;
        background: rgba(37, 99, 235, 0.15) !important;
        padding: 4px 14px !important;
        border-radius: 12px !important;
        font-size: 0.9rem !important;
        border: 1px solid rgba(59, 130, 246, 0.25) !important;
    }

    .hp-work-list .bot {
        width: 100% !important;
        height: 10px !important;
        background: rgba(15, 23, 42, 0.8) !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.04) !important;
    }

    .hp-work-list .botItem {
        height: 100% !important;
        background: linear-gradient(90deg, #06b6d4, #2563eb) !important;
        border-radius: 12px !important;
        transition: width 1.5s cubic-bezier(0.22, 1, 0.36, 1) !important;
        box-shadow: 0 0 12px var(--sam-primary-glow) !important;
    }

    /* کارت‌های نظرات متقاضیان و مشتریان */
    .hp-comment-card {
        background: var(--sam-bg-card) !important;
        border-radius: var(--sam-radius-lg) !important;
        padding: 35px !important;
        box-shadow: var(--sam-shadow-card) !important;
        display: flex !important;
        gap: 24px !important;
        align-items: center !important;
        border: 1px solid var(--sam-border-glass) !important;
        position: relative !important;
        margin-bottom: 20px !important;
        transition: var(--sam-transition) !important;
        backdrop-filter: blur(14px) !important;
    }

    .hp-comment-card:hover {
        transform: translateY(-6px) !important;
        border-color: var(--sam-border-hover) !important;
    }

    .hp-comment-pic {
        width: 80px !important;
        height: 80px !important;
        border-radius: 50% !important;
        overflow: hidden !important;
        flex-shrink: 0 !important;
        border: 2px solid #3b82f6 !important;
        box-shadow: 0 0 15px var(--sam-primary-glow) !important;
        z-index: 2 !important;
    }

    .hp-comment-text p {
        font-size: 1rem !important;
        color: var(--sam-text-muted) !important;
        line-height: 1.85 !important;
        margin-bottom: 14px !important;
        font-style: italic !important;
    }

    .hp-comment-user h5 {
        font-size: 1.15rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin: 0 !important;
    }

    .hp-comment-user span {
        font-size: 0.9rem !important;
        color: #60a5fa !important;
        font-weight: 700 !important;
        margin-right: 8px !important;
    }

    /* کارت‌های معرفی مدیران و کارشناسان گروه خودرویی سام */
    .hp-team-card {
        background: var(--sam-bg-card) !important;
        border-radius: var(--sam-radius-lg) !important;
        padding: 35px 20px !important;
        text-align: center !important;
        box-shadow: var(--sam-shadow-card) !important;
        transition: var(--sam-transition) !important;
        border: 1px solid var(--sam-border-glass) !important;
        margin-bottom: 20px !important;
        backdrop-filter: blur(14px) !important;
    }

    .hp-team-card:hover {
        transform: translateY(-8px) !important;
        border-color: var(--sam-border-hover) !important;
        box-shadow: var(--sam-shadow-hover) !important;
    }

    .hp-team-pic {
        width: 120px !important;
        height: 120px !important;
        margin: 0 auto 20px auto !important;
        border-radius: 50% !important;
        overflow: hidden !important;
        border: 3px solid rgba(59, 130, 246, 0.5) !important;
        box-shadow: 0 0 20px var(--sam-primary-glow) !important;
    }

    .hp-team-card h4 {
        font-size: 1.25rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin-bottom: 8px !important;
    }

    .hp-team-card h5 {
        font-size: 0.92rem !important;
        color: #60a5fa !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }

    /* دکمه‌های ناوبری اسلایدرها (Owl Carousel Buttons) */
    .owl-theme .owl-nav [class*=owl-] {
        background: rgba(18, 27, 47, 0.75) !important;
        border: 1px solid var(--sam-border-glass) !important;
        color: #ffffff !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border-radius: 50% !important;
        width: 48px !important;
        height: 48px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: var(--sam-transition) !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4) !important;
    }

    .owl-theme .owl-nav [class*=owl-]:hover {
        background: var(--sam-primary) !important;
        border-color: var(--sam-primary-light) !important;
        box-shadow: 0 0 20px var(--sam-primary-glow) !important;
        transform: scale(1.08) !important;
    }

    .owl-carousel.is-centered .owl-stage {
        display: flex !important;
        justify-content: center !important;
        margin: 0 auto !important;
    }
    .owl-carousel.is-centered .owl-item {
        float: none !important;
    }

    /* بهینه‌سازی‌های واکنش‌گرا برای صفحات موبایل و تبلت */
    @media (max-width: 1200px) {
        .hp-title-box h3 { font-size: 2rem !important; }
        .hp-work-wrapper { padding: 35px 25px !important; }
    }

    @media (max-width: 991px) {
        .hp-title-box h3 { font-size: 1.85rem !important; }
        .hp-service-item { height: 390px !important; }
        .hp-work-wrapper { padding: 30px 20px !important; gap: 25px !important; }
        .hp-comment-card { flex-direction: column !important; text-align: center !important; padding: 25px 18px !important; }

        .indexData.cover-section,
        .indexData.hero-section,
        .indexData.product-section,
        #cover,
        #product {
            padding: 0 !important;
            margin: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .product-section .allProductIndex {
            padding-top: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .product-section .hp-title-wrapper {
            margin-top: 8px !important;
            margin-bottom: 18px !important;
        }
    }

    @media (max-width: 768px) {
        .indexData { padding: 20px 0 !important; }
        
        /* اتصال صفر پیکسلی هیرو و محصولات در موبایل */
        .indexData.cover-section,
        .indexData.hero-section,
        .indexData.product-section,
        #cover,
        #product { 
            padding: 0 !important; 
            margin: 0 !important; 
            height: auto !important;
            min-height: 0 !important;
            max-height: none !important;
        }

        .cover-section .allCoversIndex,
        .hero-section .allCoversIndex {
            height: auto !important;
            min-height: 0 !important;
            max-height: none !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .cover-section .allCoversIndex .showroom-single-row-deck,
        .hero-section .allCoversIndex .showroom-single-row-deck {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .cover-section .allCoversIndex .showroom-single-row-deck .width,
        .hero-section .allCoversIndex .showroom-single-row-deck .width {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .product-section .allProductIndex {
            padding-top: 0 !important;
            padding-bottom: 18px !important;
            margin-top: 0 !important;
            height: auto !important;
            min-height: 0 !important;
            max-height: none !important;
        }

        .product-section .allProductIndex .showroom-fullwidth-wrapper {
            padding-top: 0 !important;
            margin-top: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .product-section .allProductIndex .hp-title-wrapper,
        .product-section .hp-title-box {
            margin-top: 8px !important;
            margin-bottom: 14px !important;
            padding-top: 0 !important;
        }

        .product-section .hp-title-box h3 {
            margin: 0 0 6px 0 !important;
            font-size: 1.42rem !important;
        }

        .hp-title-box { margin-bottom: 24px !important; }
        .hp-title-box h3 { font-size: 1.5rem !important; }
        .allNumberIndex .item, .allOptionIndex .item { padding: 20px 14px !important; }
        .allNumberIndex .numberCount { font-size: 1.8rem !important;
    }
</style>

<div class="allIndexWidgets">
    <h1 class="seoTag">{{\App\Models\Setting::where('key' , 'h1Seo')->pluck('value')->first()}}</h1>

    {{-- رندر هوشمند و ترتیبی ویجت‌ها بدون هیچ گپ یا فاصله مازاد بین هیرو و محصولات --}}
    @foreach($widget as $item)
        @if($item['name'] == 'cover')
            <div class="indexData hero-section" style="padding: 0 !important; margin: 0 !important; overflow: hidden; clear: both; width: 100%; height: auto !important; min-height: auto !important;">
                @include('home.index.coverIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'product')
            <div class="indexData product-section" style="padding: 0 !important; margin: 0 !important; clear: both; width: 100%; height: auto !important; min-height: auto !important;">
                @include('home.index.productIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'service')
            <div class="indexData">
                @include('home.index.serviceIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'option')
            <div class="indexData">
                @include('home.index.numberIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'ability')
            <div class="indexData">
                @include('home.index.workIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'team')
            <div class="indexData">
                @include('home.index.teamIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'blog')
            <div class="indexData">
                @include('home.index.blogIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'comment')
            <div class="indexData">
                @include('home.index.commentIndex',['data' => $item])
            </div>
        @endif

        @if($item['name'] == 'sendReq')
            <div class="indexData">
                @include('home.index.contactIndex')
            </div>
        @endif
    @endforeach

    @if($popUp == 1)
        @include('home.index.popUp',[
            'imagePopUp' => $imagePopUp,
            'descriptionPopUp' => $descriptionPopUp,
            'buttonPopUp' => $buttonPopUp,
            'titlePopUp' => $titlePopUp,
            'addressPopUp' => $addressPopUp,
            'popUpStatus' => $popUpStatus
        ])
    @endif
</div>
@endsection

@section('myMeta')
    {!! \App\Models\Setting::where('key' , 'metaSeo')->pluck('value')->first() !!}
@endsection

@section('links')
    <link rel="stylesheet" href="/css/owl.carousel.min.css"/>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
@endsection

@section('script1')
<script>
    // تابع تبدیل ارقام فارسی و عربی به ارقام شکیل انگلیسی با استایل تراز
    function enforceEnglishNumbers(element) {
        const walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
        const nodesToReplace = [];
        let node;
        while (node = walker.nextNode()) {
            if (/[۰-۹٠-٩0-9]/.test(node.nodeValue)) {
                if(node.parentNode && !['SCRIPT', 'STYLE', 'NOSCRIPT'].includes(node.parentNode.tagName)) {
                    nodesToReplace.push(node);
                }
            }
        }

        const persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
        const arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
        const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        nodesToReplace.forEach(n => {
            let text = n.nodeValue;
            for (let i = 0; i < 10; i++) {
                text = text.replace(persianNumbers[i], englishNumbers[i]).replace(arabicNumbers[i], englishNumbers[i]);
            }
            
            const parts = text.split(/([\d.,]+)/);
            const fragment = document.createDocumentFragment();
            let hasNumber = false;
            
            parts.forEach(part => {
                if (/^[\d.,]+$/.test(part) && /\d/.test(part)) {
                    const span = document.createElement('span');
                    span.style.fontFamily = "'Segoe UI', Tahoma, Arial, sans-serif";
                    span.style.direction = "ltr";
                    span.style.display = "inline-block";
                    span.textContent = part;
                    fragment.appendChild(span);
                    hasNumber = true;
                } else if (part) {
                    fragment.appendChild(document.createTextNode(part));
                }
            });
            
            if (hasNumber) {
                n.parentNode.replaceChild(fragment, n);
            } else {
                n.nodeValue = text;
            }
        });
    }

    // تابع وسط‌چین‌سازی هوشمند کاروسل‌ها
    function checkCenteredOwl() {
        $('.owl-carousel').each(function() {
            var total = $(this).find('.owl-item').length;
            var active = $(this).find('.owl-item.active').length;
            if (total > 0 && total <= active) {
                $(this).addClass('is-centered');
            } else {
                $(this).removeClass('is-centered');
            }
        });
    }

    $(document).ready(function(){
        $('.indexData').each(function() {
            enforceEnglishNumbers(this);
        });

        // کانفیگ اسلایدر هیرو کاور
        var coverItemsCount = $('.slider-cover .allCoverIndex').length;
        if ($('.slider-cover').length && !$('.slider-cover').hasClass('owl-loaded')) {
            $('.slider-cover').owlCarousel({
                loop: coverItemsCount > 1,
                rtl: true,
                touchDrag: true,
                lazyLoad: false,
                autoplay: coverItemsCount > 1,
                autoplayTimeout: 5500,
                items: 1,
                nav: coverItemsCount > 1,
                dots: coverItemsCount > 1,
                margin: 0,
                smartSpeed: 750,
            });
        }

        // کانفیگ اسلایدر خودروها / محصولات (دقیقاً ۳ کارت در نمایشگرهای بزرگ)
        if ($('.slider-products').length && !$('.slider-products').hasClass('owl-loaded')) {
            $('.slider-products').owlCarousel({
                loop: false,
                rtl: true,
                touchDrag: true,
                lazyLoad: true,
                nav: true,
                responsive:{
                    0:{ margin: 18, items: 1 },
                    768:{ margin: 22, items: 2 },
                    1100:{ margin: 28, items: 3 },
                    1400:{ margin: 30, items: 3 }
                }
            });
        }

        // کانفیگ اسلایدر خدمات واردات خودرو
        if ($('.slider-service').length && !$('.slider-service').hasClass('owl-loaded')) {
            $('.slider-service').owlCarousel({
                loop: false,
                rtl: true,
                touchDrag: true,
                lazyLoad: true,
                nav: true,
                margin: 28,
                responsive:{
                    0:{ items: 1 },
                    768:{ items: 2 },
                    1100:{ items: 3 }
                }
            });
        }

        // کانفیگ اسلایدر مقالات تخصصی
        if ($('.slider-blogs').length && !$('.slider-blogs').hasClass('owl-loaded')) {
            $('.slider-blogs').owlCarousel({
                loop: false,
                rtl: true,
                touchDrag: true,
                lazyLoad: true,
                nav: true,
                margin: 28,
                responsive:{
                    0:{ items: 1 },
                    600:{ items: 2 },
                    1000:{ items: 3 },
                    1200:{ items: 4 }
                }
            });
        }

        // کانفیگ اسلایدر نظرات مشتریان
        if ($('.slider-comment').length && !$('.slider-comment').hasClass('owl-loaded')) {
            $('.slider-comment').owlCarousel({
                loop: false,
                rtl: true,
                touchDrag: true,
                lazyLoad: true,
                autoplay: true,
                autoplayTimeout: 5000,
                nav: true,
                margin: 28,
                responsive:{
                    0:{ items: 1 },
                    800:{ items: 2 }
                }
            });
        }

        // کانفیگ اسلایدر اعضای تیم
        if ($('.slider-team').length && !$('.slider-team').hasClass('owl-loaded')) {
            $('.slider-team').owlCarousel({
                loop: false,
                rtl: true,
                touchDrag: true,
                lazyLoad: true,
                nav: true,
                margin: 28,
                responsive:{
                    0:{ items: 1 },
                    600:{ items: 2 },
                    1000:{ items: 3 },
                    1200:{ items: 4 }
                }
            });
        }

        // انیمیشن نوارهای پیشرفت توانمندی‌ها
        setTimeout(function() {
            $('.botItem').each(function(){
                $(this).css('width', $(this).attr('data-num') + '%');
            });
        }, 500);

        setTimeout(checkCenteredOwl, 500);
        $(window).resize(function() {
            setTimeout(checkCenteredOwl, 300);
        });
        $(document).on('initialized.owl.carousel changed.owl.carousel resized.owl.carousel refreshed.owl.carousel', function() {
            setTimeout(checkCenteredOwl, 150);
        });
    });
</script>
@endsection