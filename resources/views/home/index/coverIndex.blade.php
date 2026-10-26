<style>
    /* ==========================================================================
       SAM KHODRO ULTRA-LUXURY SHOWROOM HERO SLIDER (CINEMATIC HYPER-CAR EDITION)
       طراحی سینمایی هایپرکار | اعداد تضمینی لاتین | حذف پلاک ملی و منطقه آزاد
       ========================================================================== */
    :root {
        --sl-obsidian: #040711;
        --sl-surface: rgba(13, 20, 36, 0.78);
        --sl-surface-hover: rgba(18, 29, 54, 0.92);
        --sl-primary: #2563eb;
        --sl-primary-glow: rgba(37, 99, 235, 0.45);
        --sl-cyan: #06b6d4;
        --sl-cyan-glow: rgba(6, 182, 212, 0.4);
        --sl-border-glass: rgba(255, 255, 255, 0.09);
        --sl-border-glow: rgba(59, 130, 246, 0.4);
        --sl-text-primary: #f8fafc;
        --sl-text-secondary: #94a3b8;
    }

    /* تضمین ۱۰۰٪ نمایش کلیه اعداد به صورت لاتین/انگلیسی در تمام اجزای اسلایدر و باکس متنی */
    .allCoversIndex,
    .allCoversIndex * {
        font-feature-settings: "ss01" 0, "ss02" 0, "kern" 1 !important;
        font-variant-numeric: lining-nums tabular-nums !important;
    }

    .allCoversIndex .latin-number,
    .allCoversIndex .hud-slide-counter,
    .allCoversIndex .hud-slide-counter *,
    .allCoversIndex #hudCurrentSlideIndex {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Arial, sans-serif !important;
        direction: ltr !important;
        display: inline-block !important;
        font-variant-numeric: lining-nums tabular-nums !important;
        font-feature-settings: "ss01" 0, "ss02" 0, "cv01" 0 !important;
        unicode-bidi: embed !important;
    }

    .allCoversIndex .hud-car-name {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, 'Vazirmatn', Tahoma, sans-serif !important;
        font-variant-numeric: lining-nums tabular-nums !important;
        font-feature-settings: "ss01" 0, "ss02" 0 !important;
    }

    .allCoversIndex {
        position: relative !important;
        width: 100% !important;
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        direction: rtl !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
        display: flex !important;
        flex-direction: column !important;
        border: none !important;
        isolation: isolate;
    }

    /* نویز و خطوط سینمایی افقی بسیار ظریف */
    .allCoversIndex::before {
        content: '';
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(ellipse at 80% 0%, rgba(37, 99, 235, 0.15) 0%, transparent 60%),
            radial-gradient(ellipse at 20% 100%, rgba(6, 182, 212, 0.08) 0%, transparent 60%);
        pointer-events: none;
        z-index: 1;
    }

    /* استیج اصلی اسلایدر با ابعاد متوازن دسکتاپ و تمام‌عرض */
    .allCoversIndex .slider-cover-stage {
        position: relative !important;
        width: 100% !important;
        height: 560px !important;
        display: block !important;
        overflow: hidden !important;
        padding: 0 !important;
        margin: 0 !important;
        background: transparent !important;
        z-index: 2;
    }

    .allCoversIndex .slider-cover {
        height: 100% !important;
        width: 100% !important;
        position: relative !important;
        display: block !important;
    }

    .allCoversIndex .slider-cover .owl-stage-outer,
    .allCoversIndex .slider-cover .owl-stage,
    .allCoversIndex .slider-cover .owl-item {
        height: 100% !important;
    }

    .allCoversIndex .slider-cover .owl-stage {
        display: flex !important;
    }

    .allCoversIndex .slider-cover .owl-item {
        flex-shrink: 0 !important;
    }

    /* استایل هر کارت اسلاید */
    .allCoverIndex {
        position: relative !important;
        width: 100% !important;
        height: 100% !important;
        display: block !important;
        padding: 0 !important;
        margin: 0 !important;
        background: #020611 !important;
        overflow: hidden !important;
    }

    .allCoverIndex .car-stage-link {
        display: block !important;
        width: 100% !important;
        height: 100% !important;
        text-decoration: none !important;
        position: relative !important;
    }

    /* بنر خودرو: شفافیت بالا، وضوح طبیعی و حذف کامل لرزش */
    .allCoverIndex .car-stage-image {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
        display: block !important;
        filter: brightness(1.02) contrast(1.02) !important;
        transform: none !important;
        transition: none !important;
    }

    .allCoverIndex:hover .car-stage-image {
        transform: none !important;
        filter: brightness(1.02) contrast(1.02) !important;
    }

    /* فید ملایم و نرم پایین اسلایدر */
    .allCoversIndex .slider-bottom-fade {
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 80px !important;
        background: linear-gradient(180deg, 
            transparent 0%, 
            rgba(15, 23, 42, 0.2) 40%, 
            rgba(15, 23, 42, 0.65) 100%
        ) !important;
        pointer-events: none !important;
        z-index: 5 !important;
    }

    /* خط اسکن نئونی در بالای تصویر */
    .allCoversIndex .slider-top-glow {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        height: 2px !important;
        background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.6), rgba(37, 99, 235, 0.8), transparent) !important;
        z-index: 6 !important;
        pointer-events: none !important;
    }

    /* ==========================================================================
       کنسول شناور HUD (باکس متنی)
       ========================================================================== */
    .allCoversIndex .showroom-single-row-deck {
        position: relative !important;
        width: 100% !important;
        z-index: 10 !important;
        background: transparent !important;
        padding: 0 0 16px 0 !important;
        box-sizing: border-box !important;
        border: none !important;
    }

    .allCoversIndex .showroom-single-row-deck .width {
        max-width: 1440px !important;
        width: 100% !important;
        margin: -40px auto 0 auto !important;
        padding: 0 28px !important;
        box-sizing: border-box !important;
        position: relative !important;
        z-index: 12 !important;
    }

    .allCoversIndex .hud-single-row-strip {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 24px !important;
        background: var(--sl-surface) !important;
        backdrop-filter: blur(28px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
        padding: 20px 32px !important;
        border-radius: 22px !important;
        box-shadow: 
            0 25px 60px -15px rgba(0, 0, 0, 0.85),
            0 0 0 1px var(--sl-border-glass) inset,
            0 1px 0 0 rgba(255, 255, 255, 0.15) inset !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        overflow: hidden !important;
    }

    .allCoversIndex .hud-single-row-strip:hover {
        background: var(--sl-surface-hover) !important;
        box-shadow: 
            0 30px 70px -15px rgba(0, 0, 0, 0.95),
            0 0 0 1px var(--sl-border-glow) inset,
            0 0 35px rgba(37, 99, 235, 0.25) !important;
    }

    /* نوار زمان‌سنج زیر کنسول */
    .hud-progress-track {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: rgba(255, 255, 255, 0.05);
        overflow: hidden;
    }

    .hud-progress-bar {
        width: 0%;
        height: 100%;
        background: linear-gradient(90deg, var(--sl-cyan), #3b82f6);
        box-shadow: 0 0 12px var(--sl-cyan-glow);
        transition: width 0.1s linear;
    }

    /* مشخصات خودرو و تله‌متری سمت راست */
    .allCoversIndex .hud-title-unit {
        flex: 1 !important;
        min-width: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
    }

    .allCoversIndex .hud-meta-row {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        margin-bottom: 6px !important;
        flex-wrap: wrap !important;
    }

    .allCoversIndex .hud-live-tag {
        display: inline-flex !important;
        align-items: center !important;
        gap: 7px !important;
        color: #38bdf8 !important;
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        background: rgba(56, 189, 248, 0.12) !important;
        border: 1px solid rgba(56, 189, 248, 0.25) !important;
        padding: 4px 12px !important;
        border-radius: 99px !important;
        letter-spacing: -0.2px !important;
    }

    .allCoversIndex .hud-pulse-dot {
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: #10b981 !important;
        box-shadow: 0 0 10px #10b981 !important;
        animation: pulseLiveDot 1.8s infinite ease-in-out !important;
    }

    @keyframes pulseLiveDot {
        0%, 100% { transform: scale(0.9); opacity: 0.7; }
        50% { transform: scale(1.3); opacity: 1; box-shadow: 0 0 14px #10b981; }
    }

    /* شمارنده داینامیک اسلاید کاملاً لاتین */
    .hud-slide-counter {
        display: inline-flex !important;
        align-items: center !important;
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Tahoma, sans-serif !important;
        direction: ltr !important;
        font-size: 0.85rem !important;
        font-weight: 800 !important;
        color: var(--sl-text-secondary) !important;
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid var(--sl-border-glass) !important;
        padding: 4px 10px !important;
        border-radius: 8px !important;
        letter-spacing: 1px !important;
    }

    .hud-slide-counter strong,
    .hud-slide-counter span {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Tahoma, sans-serif !important;
        font-weight: 900 !important;
    }

    .allCoversIndex .hud-car-name {
        font-size: 1.55rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin: 0 !important;
        line-height: 1.35 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        letter-spacing: -0.4px !important;
        background: linear-gradient(135deg, #ffffff 40%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s ease !important;
    }

    /* سمت چپ: دکمه‌های پرمیوم اکشن و کنترل اسلایدر */
    .allCoversIndex .hud-actions-unit {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        flex-shrink: 0 !important;
    }

    .allCoversIndex .hud-action-primary {
        position: relative !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 50%, #0284c7 100%) !important;
        color: #ffffff !important;
        padding: 13px 26px !important;
        border-radius: 14px !important;
        font-size: 0.94rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        box-shadow: 0 10px 25px -4px rgba(37, 99, 235, 0.55), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
        white-space: nowrap !important;
        border: none !important;
        overflow: hidden !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .allCoversIndex .hud-action-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 60%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        transform: skewX(-20deg);
        transition: 0.6s ease;
    }

    .allCoversIndex .hud-action-primary:hover::before {
        left: 140%;
    }

    .allCoversIndex .hud-action-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 14px 35px -2px rgba(37, 99, 235, 0.75) !important;
        color: #ffffff !important;
    }

    .allCoversIndex .hud-action-primary svg {
        width: 17px !important;
        height: 17px !important;
        stroke-width: 2.4 !important;
        transition: transform 0.25s ease !important;
    }

    .allCoversIndex .hud-action-primary:hover svg {
        transform: translateX(-4px) !important;
    }

    .allCoversIndex .hud-action-secondary {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: rgba(255, 255, 255, 0.06) !important;
        color: #f8fafc !important;
        padding: 13px 22px !important;
        border-radius: 14px !important;
        font-size: 0.94rem !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        border: 1px solid var(--sl-border-glass) !important;
        white-space: nowrap !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        transition: all 0.25s ease !important;
    }

    .allCoversIndex .hud-action-secondary:hover {
        background: rgba(255, 255, 255, 0.14) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3) !important;
    }

    .allCoversIndex .hud-action-secondary svg {
        width: 16px !important;
        height: 16px !important;
        opacity: 0.8;
    }

    /* دکمه‌های ناوبری اسلایدر */
    .allCoversIndex .slider-cover .owl-nav {
        position: absolute !important;
        top: 45% !important;
        left: 28px !important;
        right: 28px !important;
        transform: translateY(-50%) !important;
        display: flex !important;
        justify-content: space-between !important;
        pointer-events: none !important;
        z-index: 8 !important;
    }

    .allCoversIndex .slider-cover .owl-nav button.owl-prev,
    .allCoversIndex .slider-cover .owl-nav button.owl-next {
        pointer-events: auto !important;
        width: 50px !important;
        height: 50px !important;
        border-radius: 50% !important;
        background: rgba(11, 17, 32, 0.6) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border: 1px solid var(--sl-border-glass) !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5) !important;
    }

    .allCoversIndex .slider-cover .owl-nav button.owl-prev:hover,
    .allCoversIndex .slider-cover .owl-nav button.owl-next:hover {
        background: var(--sl-primary) !important;
        border-color: #60a5fa !important;
        box-shadow: 0 0 25px var(--sl-primary-glow) !important;
        transform: scale(1.1) !important;
    }

    /* نشانگرهای نقطه‌ای */
    .allCoversIndex .slider-cover .owl-dots {
        position: absolute !important;
        bottom: 55px !important;
        left: 0 !important;
        right: 0 !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 8px !important;
        z-index: 8 !important;
    }

    .allCoversIndex .slider-cover .owl-dots .owl-dot span {
        width: 9px !important;
        height: 9px !important;
        background: rgba(255, 255, 255, 0.3) !important;
        border-radius: 99px !important;
        display: block !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .allCoversIndex .slider-cover .owl-dots .owl-dot.active span {
        width: 32px !important;
        background: linear-gradient(90deg, var(--sl-cyan), #38bdf8) !important;
        box-shadow: 0 0 14px rgba(56, 189, 248, 0.8) !important;
    }

    /* ریسپانسیو موبایل و تبلت */
    @media (max-width: 1200px) {
        .allCoversIndex .slider-cover-stage { height: 480px !important; }
        .allCoversIndex .showroom-single-row-deck .width { margin-top: -30px !important; }
    }

    @media (max-width: 991px) {
        .allCoversIndex .slider-cover-stage { height: 400px !important; }
        .allCoversIndex .hud-car-name { font-size: 1.3rem !important; }
    }

    @media (max-width: 768px) {
        .allCoversIndex {
            height: auto !important;
            min-height: 0 !important;
            max-height: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .allCoversIndex .slider-cover-stage {
            height: auto !important;
            aspect-ratio: 16 / 9.5 !important;
            min-height: 220px !important;
            max-height: 280px !important;
        }

        .allCoverIndex {
            height: 100% !important;
            aspect-ratio: 16 / 9.5 !important;
            min-height: 220px !important;
            max-height: 280px !important;
        }

        .allCoversIndex .slider-bottom-fade { height: 50px !important; }

        .allCoversIndex .showroom-single-row-deck {
            padding: 4px 0 6px 0 !important;
            margin: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .allCoversIndex .showroom-single-row-deck .width {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding: 0 14px !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .allCoversIndex .hud-single-row-strip {
            flex-direction: column !important;
            align-items: stretch !important;
            padding: 16px !important;
            gap: 14px !important;
            border-radius: 18px !important;
        }

        .allCoversIndex .hud-title-unit { text-align: center !important; }
        .allCoversIndex .hud-meta-row { justify-content: center !important; }
        .allCoversIndex .hud-car-name { font-size: 1.18rem !important; white-space: normal !important; }

        .allCoversIndex .hud-actions-unit {
            width: 100% !important;
            display: flex !important;
            gap: 10px !important;
        }

        .allCoversIndex .hud-action-primary,
        .allCoversIndex .hud-action-secondary {
            flex: 1 !important;
            padding: 12px 10px !important;
            font-size: 0.88rem !important;
        }

        .allCoversIndex .slider-cover .owl-nav { display: none !important; }
        .allCoversIndex .slider-cover .owl-dots { bottom: 25px !important; }
    }
</style>

@php
    // تبدیل قطعی ارقام فارسی و عربی به ارقام انگلیسی/لاتین
    if (!function_exists('coverToLatinDigits')) {
        function coverToLatinDigits($str) {
            if (empty($str)) return $str;
            $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
            $ar = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
            $en = ['0','1','2','3','4','5','6','7','8','9'];
            return str_replace($fa, $en, str_replace($ar, $en, (string)$str));
        }
    }

    // فرمت‌بندی هوشمند اعداد با تگ مجزا جهت تضمین عدم تبدیل به فونت فارسی
    if (!function_exists('coverFormatLatinNumbersHtml')) {
        function coverFormatLatinNumbersHtml($str) {
            if (empty($str)) return '';
            $clean = coverToLatinDigits($str);
            return preg_replace('/(\d+)/', '<span class="latin-number">$1</span>', $clean);
        }
    }

    $slides = [];

    // استخراج امن اسلایدها
    if (is_object($data)) {
        if (!empty($data->post) && count($data->post)) {
            $slides = $data->post;
        } elseif (!empty($data->slider) && count($data->slider)) {
            $slides = $data->slider;
        } elseif (!empty($data->cover) && count($data->cover)) {
            $slides = $data->cover;
        } elseif (!empty($data->ads2) && count($data->ads2)) {
            $slides = $data->ads2;
        }
    }

    if (empty($slides)) {
        if (!empty($data['post']) && (is_countable($data['post']) ? count($data['post']) : true)) {
            $slides = $data['post'];
        } elseif (!empty($data['slider']) && (is_countable($data['slider']) ? count($data['slider']) : true)) {
            $slides = $data['slider'];
        } elseif (!empty($data['cover']) && (is_countable($data['cover']) ? count($data['cover']) : true)) {
            $slides = $data['cover'];
        } elseif (!empty($data['ads2']) && (is_countable($data['ads2']) ? count($data['ads2']) : true)) {
            $slides = $data['ads2'];
        } elseif (is_iterable($data)) {
            $slides = $data;
        }
    }

    if (empty($slides) || count($slides) == 0) {
        if (class_exists('\App\Models\Slider')) {
            $slides = \App\Models\Slider::where('status', 1)->get();
            if ($slides->isEmpty()) {
                $slides = \App\Models\Slider::all();
            }
        }
    }
    if (empty($slides) || count($slides) == 0) {
        if (class_exists('\App\Models\Cover')) {
            $slides = \App\Models\Cover::all();
        }
    }

    $firstTitle = 'تویوتا کرولا کراس هیبرید نیوفیس';
    $firstLink  = '#';
    $totalCount = !empty($slides) && is_countable($slides) ? count($slides) : 1;

    if (!empty($slides) && (is_countable($slides) ? count($slides) : true)) {
        $firstItem = is_object($slides) && method_exists($slides, 'first') ? $slides->first() : (is_array($slides) ? reset($slides) : null);
        if ($firstItem) {
            $firstTitle = is_object($firstItem) ? ($firstItem->title ?? ($firstItem->name ?? $firstTitle)) : ($firstItem['title'] ?? ($firstItem['name'] ?? $firstTitle));
            $firstLink  = is_object($firstItem) ? ($firstItem->address ?? ($firstItem->link ?? ($firstItem->url ?? '#'))) : ($firstItem['address'] ?? ($firstItem['link'] ?? ($firstItem['url'] ?? '#')));
        }
    }
    $firstTitle = coverToLatinDigits($firstTitle);
@endphp

<div class="allCoversIndex">
    <!-- خط اسکن نورانی سقف اسلایدر -->
    <div class="slider-top-glow"></div>

    <!-- استیج اصلی اسلایدر تمام عرض -->
    <div class="slider-cover-stage">
        <div class="slider-cover owl-carousel owl-theme">
            @foreach($slides as $index => $item)
                @php
                    $title   = '';
                    $rawImg  = '';
                    $link    = '#';

                    if (is_object($item)) {
                        $title   = $item->title ?? ($item->name ?? ($item->titleSeo ?? 'تویوتا کرولا کراس هیبرید نیوفیس'));
                        $rawImg  = $item->image ?? ($item->pic ?? ($item->file ?? ($item->cover ?? ($item->img ?? ''))));
                        $link    = $item->address ?? ($item->link ?? ($item->url ?? ($item->slug ? '/product/'.$item->slug : '#')));
                    } elseif (is_array($item)) {
                        $title   = $item['title'] ?? ($item['name'] ?? ($item['titleSeo'] ?? 'تویوتا کرولا کراس هیبرید نیوفیس'));
                        $rawImg  = $item['image'] ?? ($item['pic'] ?? ($item['file'] ?? ($item['cover'] ?? ($item['img'] ?? ''))));
                        $link    = $item['address'] ?? ($item['link'] ?? ($item['url'] ?? '#'));
                    }

                    // تبدیل قطعی اعداد عنوان خودرو به لاتین
                    $title = coverToLatinDigits($title);

                    $coverImg = '';
                    if (is_array($rawImg)) {
                        $coverImg = reset($rawImg);
                    } elseif (is_string($rawImg) && !empty($rawImg)) {
                        $trimmed = trim($rawImg);
                        if ((strncmp($trimmed, '[', 1) === 0 && substr($trimmed, -1) === ']') || 
                            (strncmp($trimmed, '{', 1) === 0 && substr($trimmed, -1) === '}')) {
                            $decoded = json_decode($trimmed, true);
                            if (is_array($decoded)) {
                                $coverImg = reset($decoded);
                            } else {
                                $coverImg = $trimmed;
                            }
                        } else {
                            $coverImg = $trimmed;
                        }
                    }

                    if (!empty($coverImg) && is_string($coverImg)) {
                        $coverImg = str_replace(['"', "'", '\\'], ['', '', '/'], trim($coverImg));
                        if (!preg_match('~^(?:f|ht)tps?://~i', $coverImg) && strncmp($coverImg, '/', 1) !== 0) {
                            $coverImg = '/' . $coverImg;
                        }
                    }

                    if (empty($coverImg)) {
                        $coverImg = '/img/404Image.png';
                    }
                @endphp

                <div class="allCoverIndex" 
                     data-slide-index="{{ $index + 1 }}" 
                     data-slide-total="{{ $totalCount }}"
                     data-slide-url="{{ $link }}"
                     data-slide-title="{{ $title }}">
                    <a href="{{ $link }}" class="car-stage-link" title="{{ $title }}">
                        <img class="car-stage-image" 
                             src="{{ $coverImg }}" 
                             alt="{{ $title }}" 
                             loading="eager"
                             onerror="this.onerror=null; this.src='/img/404Image.png';">
                    </a>
                </div>
            @endforeach
        </div>

        <!-- فید پایین اسلایدر -->
        <div class="slider-bottom-fade"></div>
    </div>

    <!-- کنسول شیشه‌ای لوکس شناور زیر اسلایدر (باکس متنی) -->
    <div class="showroom-single-row-deck">
        <div class="width">
            <div class="hud-single-row-strip">
                <!-- نوار تایمر Autoplay -->
                <div class="hud-progress-track">
                    <div class="hud-progress-bar" id="hudSlideProgressBar"></div>
                </div>

                <!-- سمت راست: تله‌متری، بج برند و مدل خودرو با اعداد تضمینی لاتین -->
                <div class="hud-title-unit">
                    <div class="hud-meta-row">
                        <!-- حذف متن پلاک ملی و منطقه آزاد بنا به درخواست -->
                        <div class="hud-live-tag">
                            <span class="hud-pulse-dot"></span>
                            <span>گروه خودرویی سام</span>
                        </div>

                        <!-- شمارنده کاملاً لاتین -->
                        <div class="hud-slide-counter">
                            <span id="hudCurrentSlideIndex" class="latin-number">01</span>
                            <span style="opacity: 0.4; margin: 0 4px;">/</span>
                            <span class="latin-number">{{ str_pad($totalCount, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>

                    <h3 class="hud-car-name" id="hudDynamicCarTitle">{!! coverFormatLatinNumbersHtml($firstTitle) !!}</h3>
                </div>

                <!-- سمت چپ: دکمه‌های اکشن -->
                <div class="hud-actions-unit">
                    <a href="{{ $firstLink }}" id="hudSyncActionBtn" class="hud-action-primary" title="مشاهده مشخصات فنی و جزئیات خودرو">
                        <span>مشخصات فنی</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>

                    <a href="https://sell.taminkanisam.co.ir/" target="_blank" rel="noopener noreferrer" class="hud-action-secondary" title="ورود به سامانه فروش آنلاین خودرو">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                        <span>سامانه فروش</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        var autoplayTimeout = 5500;
        var progressInterval = null;

        // تبدیل تضمینی ارقام به لاتین در جاوااسکریپت
        function forceLatinNums(str) {
            if (!str) return '';
            return String(str)
                .replace(/[۰-۹]/g, function(d) { return String.fromCharCode(d.charCodeAt(0) - 1728); })
                .replace(/[٠-٩]/g, function(d) { return String.fromCharCode(d.charCodeAt(0) - 1584); });
        }

        // احاطه کردن ارقام با تگ اختصاصی لاتین برای جلوگیری از تبدیل توسط فونت‌های فارسی
        function formatTitleHtmlWithLatinNums(str) {
            if (!str) return '';
            var clean = forceLatinNums(str);
            return clean.replace(/(\d+)/g, '<span class="latin-number">$1</span>');
        }

        function startProgressBar() {
            var $bar = $('#hudSlideProgressBar');
            $bar.stop().css('width', '0%');
            var start = Date.now();

            if (progressInterval) clearInterval(progressInterval);
            progressInterval = setInterval(function(){
                var elapsed = Date.now() - start;
                var pct = Math.min((elapsed / autoplayTimeout) * 100, 100);
                $bar.css('width', pct + '%');
                if (pct >= 100) {
                    clearInterval(progressInterval);
                }
            }, 50);
        }

        function syncHudSlideInfo() {
            var $activeSlide = $('.slider-cover .owl-item.active .allCoverIndex');
            if (!$activeSlide.length) {
                $activeSlide = $('.slider-cover .allCoverIndex').first();
            }
            if ($activeSlide.length) {
                var rawTitle = $activeSlide.attr('data-slide-title') || '';
                var url = $activeSlide.attr('data-slide-url');
                var index = forceLatinNums($activeSlide.attr('data-slide-index') || '1');

                // به‌روزرسانی شمارنده با ارقام لاتین
                $('#hudCurrentSlideIndex').text(String(index).padStart(2, '0'));

                // ترنزیشن نرم عنوان با فرمت لاتین اعداد
                if (rawTitle && rawTitle.trim() !== '') {
                    var formattedTitle = formatTitleHtmlWithLatinNums(rawTitle);
                    var $carTitle = $('#hudDynamicCarTitle');
                    if ($carTitle.text().trim() !== forceLatinNums(rawTitle).trim()) {
                        $carTitle.css({
                            'opacity': '0',
                            'transform': 'translateY(6px)'
                        });
                        setTimeout(function(){
                            $carTitle.html(formattedTitle).css({
                                'opacity': '1',
                                'transform': 'translateY(0)'
                            });
                        }, 140);
                    }
                }

                // به‌روزرسانی پیوند دکمه مشخصات فنی
                if (url && url !== '#' && url !== '') {
                    $('#hudSyncActionBtn').attr('href', url);
                }
            }

            startProgressBar();
        }

        $(document).ready(function(){
            var $slider = $('.slider-cover');
            if ($slider.length && !$slider.hasClass('owl-loaded')) {
                var count = $slider.find('.allCoverIndex').length;
                $slider.owlCarousel({
                    loop: count > 1,
                    rtl: true,
                    touchDrag: true,
                    autoplay: count > 1,
                    autoplayTimeout: autoplayTimeout,
                    items: 1,
                    nav: count > 1,
                    dots: count > 1,
                    margin: 0,
                    smartSpeed: 750,
                });
            }

            $('.slider-cover').on('translated.owl.carousel changed.owl.carousel initialized.owl.carousel', function() {
                setTimeout(syncHudSlideInfo, 40);
            });

            setTimeout(syncHudSlideInfo, 100);
        });
    })();
</script>