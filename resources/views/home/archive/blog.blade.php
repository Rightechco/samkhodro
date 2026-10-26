@extends('home.master')

@section('active', 1)
@section('title', ($name ?? 'مجله خودرو و مقالات تخصصی') . ' - گروه خودرویی سام')

@section('content')
<style>
    /* ==========================================================================
       SAM AUTOMOTIVE GROUP - ULTRA-PREMIUM EDITORIAL BLOG & ARCHIVE SYSTEM
       فونت هماهنگ با قالب اصلی | ضد خطای سرور | هدر ۱۰۰٪ استیکی
       ========================================================================== */
    :root {
        --bl-bg-main: #f8fafc;
        --bl-bg-card: #ffffff;
        --bl-text-title: #0f172a;
        --bl-text-body: #334155;
        --bl-text-muted: #64748b;
        --bl-primary-blue: #2563eb;
        --bl-primary-dark: #1e40af;
        --bl-accent-cyan: #0284c7;
        --bl-accent-teal: #0d9488;
        --bl-border: #e2e8f0;
        --bl-border-hover: #cbd5e1;
        --bl-radius-card: 22px;
        --bl-radius-pill: 99px;
    }

    /* تضمین ۱۰۰٪ استیکی بودن هدر سایت */
    .allHeaderHome {
        position: sticky !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 9999 !important;
        box-shadow: 0 10px 30px -10px rgba(11, 19, 41, 0.12) !important;
    }

    /* هماهنگی کامل فونت با صفحه اصلی قالب */
    .allBlogArchive,
    .allBlogArchive * {
        font-family: inherit;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
        box-sizing: border-box !important;
        font-feature-settings: "ss01" 0, "ss02" 0, "kern" 1 !important;
        font-variant-numeric: lining-nums tabular-nums !important;
    }

    .allBlogArchive .latin-num {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Tahoma, sans-serif !important;
        direction: ltr !important;
        display: inline-block !important;
        font-variant-numeric: lining-nums tabular-nums !important;
        unicode-bidi: embed !important;
    }

    .allBlogArchive {
        background-color: var(--bl-bg-main) !important;
        min-height: 100vh !important;
        padding: 35px 0 90px 0 !important;
        direction: rtl !important;
        position: relative !important;
        overflow-x: hidden !important;
    }

    .allBlogArchive .container-blog {
        max-width: 1440px !important;
        width: 100% !important;
        margin: 0 auto !important;
        padding: 0 28px !important;
        position: relative !important;
    }

    /* هدر بالای صفحه و مسیر ناوبری */
    .bl-archive-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 30px !important;
        padding-bottom: 20px !important;
        border-bottom: 1px solid var(--bl-border) !important;
        flex-wrap: wrap !important;
        gap: 16px !important;
    }

    .bl-breadcrumb {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 0.92rem !important;
        color: var(--bl-text-muted) !important;
        font-weight: 700 !important;
    }

    .bl-breadcrumb a {
        color: var(--bl-text-muted) !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }

    .bl-breadcrumb a:hover {
        color: var(--bl-primary-blue) !important;
    }

    .bl-breadcrumb span.current {
        color: var(--bl-text-title) !important;
        font-weight: 900 !important;
    }

    .bl-header-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        background: #ffffff !important;
        border: 1px solid var(--bl-border) !important;
        padding: 6px 16px !important;
        border-radius: var(--bl-radius-pill) !important;
        font-size: 0.84rem !important;
        font-weight: 800 !important;
        color: var(--bl-text-body) !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04) !important;
    }

    .bl-header-badge .live-dot {
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: #10b981 !important;
        box-shadow: 0 0 8px #10b981 !important;
    }

    /* هیرو بنر ویژه اولین مقاله */
    .bl-featured-hero {
        background: #ffffff !important;
        border: 1px solid var(--bl-border) !important;
        border-radius: var(--bl-radius-card) !important;
        padding: 24px !important;
        display: grid !important;
        grid-template-columns: 1.2fr 1fr !important;
        gap: 36px !important;
        align-items: center !important;
        margin-bottom: 45px !important;
        box-shadow: 0 16px 40px -10px rgba(15, 23, 42, 0.06) !important;
        text-decoration: none !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .bl-featured-hero:hover {
        transform: translateY(-4px) !important;
        border-color: #bfdbfe !important;
        box-shadow: 0 24px 50px -10px rgba(37, 99, 235, 0.12) !important;
    }

    .bl-hero-pic-box {
        position: relative !important;
        height: 380px !important;
        width: 100% !important;
        border-radius: 18px !important;
        overflow: hidden !important;
        background: #0f172a !important;
    }

    .bl-hero-pic-box img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .bl-featured-hero:hover .bl-hero-pic-box img {
        transform: scale(1.05) !important;
    }

    .bl-hero-badge-tag {
        position: absolute !important;
        top: 16px !important;
        right: 16px !important;
        background: rgba(15, 23, 42, 0.85) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        color: #38bdf8 !important;
        padding: 6px 14px !important;
        border-radius: 99px !important;
        font-size: 0.78rem !important;
        font-weight: 800 !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
    }

    .bl-hero-content {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
    }

    .bl-meta-row {
        display: flex !important;
        align-items: center !important;
        gap: 16px !important;
        color: var(--bl-text-muted) !important;
        font-size: 0.82rem !important;
        font-weight: 700 !important;
        margin-bottom: 14px !important;
    }

    .bl-meta-item {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .bl-meta-item svg {
        width: 15px !important;
        height: 15px !important;
        stroke: currentColor !important;
        stroke-width: 2 !important;
    }

    .bl-hero-title {
        font-size: 1.85rem !important;
        font-weight: 900 !important;
        color: var(--bl-text-title) !important;
        line-height: 1.5 !important;
        margin: 0 0 16px 0 !important;
        transition: color 0.25s ease !important;
    }

    .bl-featured-hero:hover .bl-hero-title {
        color: var(--bl-primary-blue) !important;
    }

    .bl-hero-desc {
        font-size: 0.98rem !important;
        line-height: 2 !important;
        color: var(--bl-text-body) !important;
        margin: 0 0 24px 0 !important;
        text-align: justify !important;
    }

    .bl-hero-cta {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        background: linear-gradient(135deg, var(--bl-primary-dark) 0%, var(--bl-primary-blue) 100%) !important;
        color: #ffffff !important;
        padding: 12px 24px !important;
        border-radius: 14px !important;
        font-size: 0.94rem !important;
        font-weight: 800 !important;
        width: fit-content !important;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3) !important;
        transition: all 0.3s ease !important;
    }

    .bl-featured-hero:hover .bl-hero-cta {
        transform: translateX(-4px) !important;
        box-shadow: 0 12px 26px rgba(37, 99, 235, 0.45) !important;
    }

    .bl-hero-cta svg {
        width: 16px !important;
        height: 16px !important;
        stroke-width: 2.5 !important;
        transition: transform 0.25s ease !important;
    }

    .bl-featured-hero:hover .bl-hero-cta svg {
        transform: translateX(-4px) !important;
    }

    /* شبکه کامل مقالات (بدون سایدبار پیشنهادات) */
    .bl-articles-grid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 30px !important;
        width: 100% !important;
        margin-bottom: 50px !important;
    }

    /* کارت مجله پرمیوم */
    .bl-card-article {
        background: var(--bl-bg-card) !important;
        border-radius: var(--bl-radius-card) !important;
        border: 1px solid var(--bl-border) !important;
        box-shadow: 0 10px 30px -8px rgba(15, 23, 42, 0.05) !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        text-decoration: none !important;
        position: relative !important;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .bl-card-article:hover {
        transform: translateY(-8px) !important;
        border-color: #93c5fd !important;
        box-shadow: 0 20px 45px -10px rgba(37, 99, 235, 0.12) !important;
    }

    .bl-card-pic-wrapper {
        position: relative !important;
        width: 100% !important;
        height: 230px !important;
        overflow: hidden !important;
        background: #0f172a !important;
    }

    .bl-card-pic-wrapper img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .bl-card-article:hover .bl-card-pic-wrapper img {
        transform: scale(1.08) !important;
    }

    .bl-card-tag {
        position: absolute !important;
        top: 14px !important;
        right: 14px !important;
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        color: var(--bl-primary-blue) !important;
        font-size: 0.74rem !important;
        font-weight: 800 !important;
        padding: 5px 12px !important;
        border-radius: var(--bl-radius-pill) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06) !important;
    }

    .bl-card-body {
        padding: 22px 24px !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important;
        justify-content: space-between !important;
    }

    .bl-card-date-row {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 12px !important;
        font-size: 0.78rem !important;
        color: var(--bl-text-muted) !important;
        font-weight: 700 !important;
    }

    .bl-card-title {
        font-size: 1.18rem !important;
        font-weight: 900 !important;
        color: var(--bl-text-title) !important;
        line-height: 1.6 !important;
        margin: 0 0 12px 0 !important;
        min-height: 56px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        transition: color 0.25s ease !important;
    }

    .bl-card-article:hover .bl-card-title {
        color: var(--bl-primary-blue) !important;
    }

    .bl-card-excerpt {
        font-size: 0.9rem !important;
        line-height: 1.85 !important;
        color: var(--bl-text-body) !important;
        margin: 0 0 20px 0 !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 3 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        text-align: justify !important;
    }

    .bl-card-footer {
        padding-top: 14px !important;
        border-top: 1px dashed var(--bl-border) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .bl-read-more-text {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        color: var(--bl-primary-blue) !important;
        font-size: 0.88rem !important;
        font-weight: 800 !important;
        transition: gap 0.25s ease !important;
    }

    .bl-card-article:hover .bl-read-more-text {
        gap: 10px !important;
        color: var(--bl-primary-dark) !important;
    }

    .bl-read-more-text svg {
        width: 15px !important;
        height: 15px !important;
        stroke-width: 2.5 !important;
        transition: transform 0.25s ease !important;
    }

    .bl-card-article:hover .bl-read-more-text svg {
        transform: translateX(-4px) !important;
    }

    .bl-reading-time {
        font-size: 0.76rem !important;
        color: var(--bl-text-muted) !important;
        background: #f1f5f9 !important;
        padding: 4px 10px !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
    }

    /* صفحه‌بندی پرمیوم */
    .bl-pagination-wrap {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 40px 0 20px 0 !important;
    }

    .bl-pagination-wrap .pagination {
        display: inline-flex !important;
        gap: 6px !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .bl-pagination-wrap .pagination li a,
    .bl-pagination-wrap .pagination li span {
        padding: 8px 16px !important;
        border-radius: 12px !important;
        border: 1px solid var(--bl-border) !important;
        background: #ffffff !important;
        color: var(--bl-text-title) !important;
        font-weight: 800 !important;
        font-size: 0.9rem !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }

    .bl-pagination-wrap .pagination li.active span,
    .bl-pagination-wrap .pagination li a:hover {
        background: var(--bl-primary-blue) !important;
        color: #ffffff !important;
        border-color: var(--bl-primary-blue) !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
    }

    /* باکس توضیحات دسته در انتهای صفحه */
    .bl-archive-desc-box {
        background: #ffffff !important;
        border-radius: var(--bl-radius-card) !important;
        border: 1px solid var(--bl-border) !important;
        padding: 32px 36px !important;
        margin-top: 40px !important;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04) !important;
    }

    .bl-archive-desc-box h1 {
        font-size: 1.45rem !important;
        font-weight: 900 !important;
        color: var(--bl-text-title) !important;
        margin: 0 0 14px 0 !important;
    }

    .bl-archive-desc-box p {
        font-size: 0.98rem !important;
        line-height: 2 !important;
        color: var(--bl-text-body) !important;
        margin: 0 !important;
        text-align: justify !important;
    }

    /* واکنش‌گرایی تبلت و موبایل */
    @media (max-width: 1200px) {
        .bl-articles-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 24px !important;
        }

        .bl-featured-hero {
            grid-template-columns: 1fr !important;
            gap: 24px !important;
        }

        .bl-hero-pic-box {
            height: 300px !important;
        }
    }

    @media (max-width: 768px) {
        .allBlogArchive {
            padding: 16px 0 60px 0 !important;
        }

        .allBlogArchive .container-blog {
            padding: 0 14px !important;
        }

        .bl-archive-header {
            margin-bottom: 20px !important;
            padding-bottom: 14px !important;
        }

        .bl-featured-hero {
            padding: 16px !important;
            border-radius: 18px !important;
            margin-bottom: 28px !important;
        }

        .bl-hero-pic-box {
            height: 210px !important;
            border-radius: 14px !important;
        }

        .bl-hero-title {
            font-size: 1.3rem !important;
        }

        .bl-hero-desc {
            font-size: 0.9rem !important;
            line-height: 1.85 !important;
            margin-bottom: 16px !important;
        }

        .bl-articles-grid {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }

        .bl-card-article {
            border-radius: 18px !important;
        }

        .bl-card-pic-wrapper {
            height: 200px !important;
        }

        .bl-card-body {
            padding: 18px !important;
        }

        .bl-card-title {
            font-size: 1.05rem !important;
            min-height: auto !important;
        }

        .bl-archive-desc-box {
            padding: 20px 18px !important;
            border-radius: 18px !important;
        }
    }
</style>

@php
    // تبدیل امن ارقام به لاتین
    $blogToLatin = function($str) {
        if (empty($str)) return '';
        $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $ar = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($fa, $en, str_replace($ar, $en, (string)$str));
    };

    // استخراج کاملاً ایمن تاریخ بدون خطای سرور
    $formatBlogDate = function($date) use ($blogToLatin) {
        if (empty($date)) return 'به‌روزرسانی اخیر';
        if (function_exists('jdate')) {
            try {
                return $blogToLatin(jdate($date)->format('Y/m/d'));
            } catch (\Throwable $e) {}
        }
        if (function_exists('verta')) {
            try {
                return $blogToLatin(verta($date)->format('Y/m/d'));
            } catch (\Throwable $e) {}
        }
        try {
            if ($date instanceof \DateTimeInterface) {
                return $blogToLatin($date->format('Y/m/d'));
            }
            if (is_string($date)) {
                return $blogToLatin(substr($date, 0, 10));
            }
        } catch (\Throwable $e) {}
        return $blogToLatin((string)$date);
    };

    // استخراج امن آدرس تصویر
    $resolveBlogImg = function($img) {
        if (empty($img)) return '/img/404Image.png';
        if (is_array($img)) return reset($img) ?: '/img/404Image.png';
        if (is_string($img)) {
            $trimmed = trim($img);
            if (strncmp($trimmed, '[', 1) === 0 || strncmp($trimmed, '{', 1) === 0) {
                $decoded = json_decode($trimmed, true);
                if (is_array($decoded) && !empty($decoded)) {
                    return reset($decoded) ?: '/img/404Image.png';
                }
            }
            return $trimmed;
        }
        return '/img/404Image.png';
    };

    // دستیابی امن به فیلدها چه در آبجکت مدل و چه در آرایه
    $getProp = function($item, $key, $default = '') {
        if (is_object($item)) return $item->{$key} ?? $default;
        if (is_array($item)) return $item[$key] ?? $default;
        return $default;
    };

    // باز کردن امن لیست مقالات بدون متدهای وابسته که خطای ۵۰۰ ایجاد می‌کردند
    $articles = [];
    if (isset($blogs)) {
        if (is_object($blogs) && method_exists($blogs, 'items')) {
            $articles = $blogs->items();
        } elseif (is_object($blogs) && method_exists($blogs, 'all')) {
            $articles = $blogs->all();
        } elseif (is_array($blogs)) {
            $articles = array_values($blogs);
        } elseif (is_iterable($blogs)) {
            $articles = iterator_to_array($blogs);
        }
    }

    $featuredArticle = !empty($articles) ? $articles[0] : null;
    $remainingArticles = count($articles) > 1 ? array_slice($articles, 1) : [];
@endphp

<div class="allBlogArchive">
    <div class="container-blog">

        <!-- هدر بالای صفحه آرشیو مقالات -->
        <header class="bl-archive-header">
            <nav class="bl-breadcrumb" aria-label="مسیر صفحه">
                <a href="/">صفحه اصلی</a>
                <span>/</span>
                <span>مجله تخصصی</span>
                <span>/</span>
                <span class="current">{{ $name ?? 'مقالات و اخبار خودرویی' }}</span>
            </nav>

            <div class="bl-header-badge">
                <span class="live-dot"></span>
                <span>آرشیو تحلیلی و تخصصی خودرو</span>
            </div>
        </header>

        @if($featuredArticle)
            @php
                $heroTitle = $blogToLatin($getProp($featuredArticle, 'title', 'مقاله تخصصی خودرو'));
                $heroSlug = $getProp($featuredArticle, 'slug', '#');
                $heroImgRaw = $getProp($featuredArticle, 'image', '');
                $heroImg = $resolveBlogImg($heroImgRaw);
                $heroAlt = $getProp($featuredArticle, 'imageAlt', $heroTitle);
                $heroTitleSeo = $getProp($featuredArticle, 'titleSeo', $heroTitle);

                $rawBodySeo = $getProp($featuredArticle, 'bodySeo');
                $rawBody = $getProp($featuredArticle, 'body');
                $heroDesc = !empty($rawBodySeo) 
                            ? $rawBodySeo 
                            : (!empty($rawBody) ? mb_substr(strip_tags((string)$rawBody), 0, 220, 'UTF-8') . '...' : 'بررسی تخصصی و آخرین تحولات واردات خودروهای پلاک ملی توسط گروه خودرویی سام...');
                $heroDate = $formatBlogDate($getProp($featuredArticle, 'created_at'));
            @endphp
            <article>
                <a href="/blog/{{ $heroSlug }}" class="bl-featured-hero" title="{{ $heroTitleSeo }}">
                    <div class="bl-hero-pic-box">
                        <span class="bl-hero-badge-tag">مقاله منتخب تحریریه</span>
                        <img class="lazyload" 
                             src="/img/404Image.png" 
                             data-src="{{ $heroImg }}" 
                             alt="{{ $heroAlt }}"
                             onerror="this.onerror=null; this.src='/img/404Image.png';">
                    </div>
                    <div class="bl-hero-content">
                        <div class="bl-meta-row">
                            <span class="bl-meta-item">
                                <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span class="latin-num">{{ $heroDate }}</span>
                            </span>
                            <span class="bl-meta-item">
                                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                <span>زمان مطالعه: <strong class="latin-num">5</strong> دقیقه</span>
                            </span>
                        </div>
                        <h2 class="bl-hero-title">{{ $heroTitle }}</h2>
                        <p class="bl-hero-desc">{{ $blogToLatin($heroDesc) }}</p>
                        <div class="bl-hero-cta">
                            <span>مطالعه مقاله کامل</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </article>
        @endif

        <main class="bl-articles-section">
            <div class="bl-articles-grid">
                @forelse($remainingArticles as $item)
                    @php
                        $cardTitle = $blogToLatin($getProp($item, 'title', 'تحلیل و مقاله خودرویی'));
                        $cardSlug = $getProp($item, 'slug', '#');
                        $cardImgRaw = $getProp($item, 'image', '');
                        $cardImg = $resolveBlogImg($cardImgRaw);
                        $cardAlt = $getProp($item, 'imageAlt', $cardTitle);
                        $cardTitleSeo = $getProp($item, 'titleSeo', $cardTitle);

                        $rawCardBodySeo = $getProp($item, 'bodySeo');
                        $rawCardBody = $getProp($item, 'body');
                        $cardExcerpt = !empty($rawCardBodySeo) 
                                      ? $rawCardBodySeo 
                                      : (!empty($rawCardBody) ? mb_substr(strip_tags((string)$rawCardBody), 0, 140, 'UTF-8') . '...' : 'تحلیل و بررسی آخرین اخبار صنعت خودرو...');
                        $cardDate = $formatBlogDate($getProp($item, 'created_at'));
                    @endphp
                    <article>
                        <a href="/blog/{{ $cardSlug }}" class="bl-card-article" title="{{ $cardTitleSeo }}">
                            <div class="bl-card-pic-wrapper">
                                <span class="bl-card-tag">مجله سام خودرو</span>
                                <img class="lazyload" 
                                     src="/img/404Image.png" 
                                     data-src="{{ $cardImg }}" 
                                     alt="{{ $cardAlt }}"
                                     onerror="this.onerror=null; this.src='/img/404Image.png';">
                            </div>

                            <div class="bl-card-body">
                                <div>
                                    <div class="bl-card-date-row">
                                        <span class="latin-num">{{ $cardDate }}</span>
                                        <span class="bl-reading-time"><strong class="latin-num">4</strong> دقیقه</span>
                                    </div>
                                    <h3 class="bl-card-title">{{ $cardTitle }}</h3>
                                    <p class="bl-card-excerpt">{{ $blogToLatin($cardExcerpt) }}</p>
                                </div>

                                <div class="bl-card-footer">
                                    <span class="bl-read-more-text">
                                        <span>ادامه مطلب</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                            <polyline points="12 19 5 12 12 5"></polyline>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    @if(!$featuredArticle)
                        <div style="grid-column: 1 / -1; background:#ffffff; border-radius:24px; padding:60px 20px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.04); border: 1px solid var(--bl-border);">
                            <h3 style="color:#0f172a; font-weight:900;">مقاله‌ای در این بخش یافت نشد</h3>
                            <p style="color:#64748b; margin-top:10px;">به زودی مقالات و تحلیل‌های تخصصی خودرویی به این بخش اضافه خواهد شد.</p>
                        </div>
                    @endif
                @endforelse
            </div>
        </main>

        @if(isset($blogs) && is_object($blogs) && method_exists($blogs, 'links'))
            <div class="bl-pagination-wrap">
                {{ $blogs->links() }}
            </div>
        @endif

        @if(!empty($body) || !empty($name))
            <div class="bl-archive-desc-box">
                <h1>{{ $name ?? 'مجله خودرویی و پایگاه دانش گروه خودرویی سام' }}</h1>
                @if(!empty($body))
                    <p>{{ $body }}</p>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection