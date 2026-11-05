<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'سام موبایل | خدمات پس از فروش و گارانتی رسمی ۱۸ ماهه تامین کانی سام')</title>
    <meta name="description" content="@yield('meta_description', 'سامانه رسمی خدمات پس از فروش، گارانتی ۱۸ ماهه تلفن همراه و تبلت شرکت تامین کانی سام (سام موبایل). استعلام اصالت، رهگیری آنلاین تعمیرات، منشور حقوق مشتریان و ثبت خدمت مطابق ضوابط ماده ۱۳ وزارت صمت.')">

    <!-- Fonts: Local Vazirmatn + CDN Fallback -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ========================================================
           LOCAL VAZIRMATN FONT FACES
           ======================================================== */
        @font-face {
            font-family: 'Vazirmatn';
            src: url('/fonts/vazirmatn/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Vazirmatn';
            src: url('/fonts/vazirmatn/Vazirmatn-Medium.woff2') format('woff2');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Vazirmatn';
            src: url('/fonts/vazirmatn/Vazirmatn-SemiBold.woff2') format('woff2');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Vazirmatn';
            src: url('/fonts/vazirmatn/Vazirmatn-Bold.woff2') format('woff2');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Vazirmatn';
            src: url('/fonts/vazirmatn/Vazirmatn-ExtraBold.woff2') format('woff2');
            font-weight: 800;
            font-style: normal;
            font-display: swap;
        }

        /* ========================================================
           LIGHT THEME ROOT VARIABLES - ULTRA PREMIUM & CRISP
           ======================================================== */
        :root {
            --bg-main: #f8fafc;
            --bg-subtle: #f1f5f9;
            --bg-card: #ffffff;
            --bg-card-hover: #f8fafc;
            --bg-card-alt: #f8fafc;
            
            --border-light: #e2e8f0;
            --border-hover: #cbd5e1;
            --border-primary: #bfdbfe;
            --border-glow: rgba(37, 99, 235, 0.25);
            
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --primary-glow: rgba(37, 99, 235, 0.15);
            
            --accent-cyan: #0284c7;
            --accent-indigo: #4f46e5;
            --accent-emerald: #059669;
            --accent-emerald-light: #ecfdf5;
            --accent-amber: #d97706;
            --accent-amber-light: #fffbeb;
            --accent-rose: #e11d48;
            --accent-rose-light: #fff1f2;
            
            --text-main: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --text-dim: #94a3b8;
            
            --shadow-sm: 0 1px 3px 0 rgba(15, 23, 42, 0.05);
            --shadow-md: 0 4px 12px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.04);
            --shadow-lg: 0 12px 28px -6px rgba(15, 23, 42, 0.08), 0 4px 10px -3px rgba(15, 23, 42, 0.04);
            --shadow-glow: 0 10px 30px -5px rgba(37, 99, 235, 0.25);
            
            --radius-lg: 18px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --radius-pill: 9999px;
            
            --font-family: 'Vazirmatn', Vazir, -apple-system, BlinkMacSystemFont, Tahoma, sans-serif;
        }

        /* Reset & Base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: var(--font-family) !important;
            -webkit-tap-highlight-color: transparent;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-body);
            line-height: 1.75;
            direction: rtl;
            text-align: right;
            overflow-x: hidden;
            font-size: 15px;
            /* Extra bottom padding on mobile so content is never covered by native sticky footer */
            padding-bottom: 0;
        }

        @media (max-width: 991px) {
            body {
                padding-bottom: 74px;
            }
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        button {
            border: none;
            outline: none;
            background: none;
            cursor: pointer;
            font-family: inherit;
        }

        /* ========================================================
           TOP ANNOUNCEMENT BAR (LIGHT THEME)
           ======================================================== */
        .top-announcement-bar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-light);
            font-size: 0.82rem;
            color: var(--text-muted);
            padding: 6px 0;
        }
        .top-announcement-inner {
            max-width: 1360px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .top-badge-live {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-emerald-light);
            color: var(--accent-emerald);
            padding: 2px 10px;
            border-radius: var(--radius-pill);
            font-size: 0.76rem;
            font-weight: 700;
        }
        .top-badge-live::before {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent-emerald);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);
            animation: pulse-live 2s infinite;
        }
        @keyframes pulse-live {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.15); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .top-info-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .top-info-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
        }
        .top-info-item:hover {
            color: var(--primary);
        }

        /* ========================================================
           MAIN HEADER & SINGLE-LINE NAVBAR (LIGHT ULTRA PREMIUM)
           ======================================================== */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 1020;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
        }
        .header-inner {
            max-width: 1360px;
            margin: 0 auto;
            padding: 0 20px;
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        
        /* Logo */
        .brand-logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }
        .brand-icon-box {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: var(--shadow-glow);
            flex-shrink: 0;
        }
        .brand-titles {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }
        .brand-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }
        .brand-sub {
            font-size: 0.76rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Single-line Navigation Menu */
        .nav-single-line {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 4px 0;
        }
        .nav-single-line::-webkit-scrollbar {
            display: none;
        }
        .nav-item-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 13px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-body);
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .nav-item-link:hover {
            color: var(--primary);
            background: var(--primary-light);
        }
        .nav-item-link.active {
            color: var(--primary);
            background: var(--primary-light);
            font-weight: 700;
        }

        /* Header CTA Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .btn-track-quick {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff !important;
            padding: 9px 18px;
            border-radius: var(--radius-pill);
            font-size: 0.88rem;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            transition: all 0.25s ease;
        }
        .btn-track-quick:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            color: #ffffff;
        }
        .btn-car-portal {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--bg-subtle);
            color: var(--text-body);
            border: 1px solid var(--border-light);
            padding: 8px 14px;
            border-radius: var(--radius-pill);
            font-size: 0.84rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-car-portal:hover {
            background: #ffffff;
            border-color: var(--border-hover);
            color: var(--text-main);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            width: 42px;
            height: 42px;
            border-radius: var(--radius-md);
            background: var(--bg-subtle);
            border: 1px solid var(--border-light);
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }

        @media (max-width: 1120px) {
            .btn-car-portal {
                display: none;
            }
        }
        @media (max-width: 991px) {
            .nav-single-line {
                display: none;
            }
            .btn-track-quick {
                display: none;
            }
            .mobile-menu-toggle {
                display: flex;
            }
        }

        /* ========================================================
           MOBILE DRAWER (FOR SMARTPHONES)
           ======================================================== */
        .mobile-drawer-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .mobile-drawer-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .mobile-drawer {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 310px;
            max-width: 85vw;
            background: #ffffff;
            z-index: 1060;
            transform: translateX(100%);
            transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            box-shadow: -10px 0 30px rgba(15, 23, 42, 0.15);
        }
        .mobile-drawer.active {
            transform: translateX(0);
        }
        .drawer-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-light);
        }
        .drawer-close {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            background: var(--bg-subtle);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
        }
        .drawer-nav-list {
            list-style: none;
            padding: 16px;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .drawer-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-md);
            color: var(--text-body);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .drawer-nav-link:hover, .drawer-nav-link.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        /* ========================================================
           GLOBAL LIGHT THEME COMMON COMPONENTS
           ======================================================== */
        .main-wrapper {
            min-height: calc(100vh - 450px);
        }

        .light-card {
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
        }
        .light-card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--border-hover);
        }

        .section-header-block {
            text-align: center;
            margin-bottom: 36px;
        }
        .section-tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--border-primary);
            padding: 4px 14px;
            border-radius: var(--radius-pill);
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .section-title-main {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }
        .section-subtitle-lead {
            font-size: 0.98rem;
            color: var(--text-muted);
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Buttons */
        .btn-light-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff !important;
            padding: 11px 24px;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.94rem;
            box-shadow: var(--shadow-glow);
            transition: all 0.25s ease;
        }
        .btn-light-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
            color: #ffffff;
        }

        .btn-light-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #ffffff;
            color: var(--text-body) !important;
            border: 1px solid var(--border-light);
            padding: 11px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.94rem;
            transition: all 0.2s ease;
        }
        .btn-light-outline:hover {
            background: var(--bg-subtle);
            border-color: var(--border-hover);
            color: var(--text-main) !important;
        }

        /* ========================================================
           ULTRA-PREMIUM LIGHT FOOTER
           ======================================================== */
        .site-footer-light {
            background: #ffffff;
            border-top: 1px solid var(--border-light);
            margin-top: 60px;
            position: relative;
        }
        .footer-top-strip {
            background: var(--bg-subtle);
            border-bottom: 1px solid var(--border-light);
            padding: 24px 0;
        }
        .footer-features-grid {
            max-width: 1360px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        .footer-feat-item {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .footer-feat-icon {
            width: 46px;
            height: 46px;
            border-radius: var(--radius-md);
            background: #ffffff;
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }
        .footer-feat-title {
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--text-main);
            margin-bottom: 2px;
        }
        .footer-feat-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .footer-main-area {
            max-width: 1360px;
            margin: 0 auto;
            padding: 48px 20px 36px;
            display: grid;
            grid-template-columns: 2fr 1.2fr 1.2fr 1.6fr;
            gap: 40px;
        }
        .footer-col-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-col-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 32px;
            height: 3px;
            background: var(--primary);
            border-radius: var(--radius-pill);
        }
        .footer-about-text {
            color: var(--text-body);
            font-size: 0.88rem;
            line-height: 1.85;
            margin-bottom: 18px;
        }
        .footer-contact-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.88rem;
            color: var(--text-body);
        }
        .footer-contact-icon {
            color: var(--primary);
            margin-top: 3px;
            flex-shrink: 0;
        }

        .footer-links-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .footer-links-list a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            color: var(--text-body);
            transition: all 0.2s;
        }
        .footer-links-list a:hover {
            color: var(--primary);
            transform: translateX(-4px);
        }

        .footer-bottom-bar {
            border-top: 1px solid var(--border-light);
            background: var(--bg-subtle);
            padding: 18px 20px;
        }
        .footer-bottom-inner {
            max-width: 1360px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        @media (max-width: 991px) {
            .footer-features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .footer-main-area {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 640px) {
            .footer-features-grid {
                grid-template-columns: 1fr;
            }
            .footer-main-area {
                grid-template-columns: 1fr;
            }
            .footer-bottom-inner {
                flex-direction: column;
                text-align: center;
            }
        }

        /* ========================================================
           STICKY NATIVE BOTTOM BAR (APP-LIKE FOR MOBILE)
           ======================================================== */
        .native-bottom-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid var(--border-light);
            box-shadow: 0 -4px 20px rgba(15, 23, 42, 0.08);
            z-index: 1040;
            padding: 0 8px;
            align-items: center;
            justify-content: space-around;
        }
        .native-tab-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: var(--text-muted);
            font-size: 0.72rem;
            font-weight: 600;
            height: 100%;
            transition: all 0.2s ease;
            position: relative;
        }
        .native-tab-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }
        .native-tab-item.active, .native-tab-item:hover {
            color: var(--primary);
        }
        .native-tab-item.active .native-tab-icon {
            transform: translateY(-2px);
        }
        .native-tab-item.active::after {
            content: '';
            position: absolute;
            top: 0;
            width: 24px;
            height: 3px;
            background: var(--primary);
            border-radius: var(--radius-pill);
        }

        @media (max-width: 991px) {
            .native-bottom-bar {
                display: flex;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-announcement-bar">
        <div class="top-announcement-inner">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span class="top-badge-live">پاسخگویی آنلاین</span>
                <span>سامانه رسمی خدمات پس از فروش و گارانتی ۱۸ ماهه سام موبایل (تامین کانی سام)</span>
            </div>
            <div class="top-info-links">
                <a href="tel:02165021085" class="top-info-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>مرکز تماس: ۰۲۱-۶۵۰۲۱۰۸۵</span>
                </a>
                <span class="top-info-item" style="opacity: 0.8;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span>شنبه تا چهارشنبه: ۸:۳۰ الی ۱۷:۰۰</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Main Header Navbar -->
    <header class="site-header">
        <div class="header-inner">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-logo-area">
                <div class="brand-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                </div>
                <div class="brand-titles">
                    <span class="brand-name">سام موبایل</span>
                    <span class="brand-sub">خدمات پس از فروش تامین کانی سام</span>
                </div>
            </a>

            <!-- Single-Line Clean Navigation Menu -->
            <nav class="nav-single-line">
                <a href="{{ url('/') }}" class="nav-item-link {{ request()->is('/') || request()->is('mob') ? 'active' : '' }}">
                    <span>صفحه اصلی</span>
                </a>
                <a href="{{ url('/#inquiry-section') }}" class="nav-item-link">
                    <span>استعلام گارانتی (IMEI)</span>
                </a>
                <a href="{{ url('/service-portal') }}" class="nav-item-link {{ request()->is('*service-portal*') ? 'active' : '' }}">
                    <span>سامانه مدیریت خدمات (ماده ۱۳)</span>
                </a>
                <a href="{{ url('/warranty-terms') }}" class="nav-item-link {{ request()->is('*warranty-terms*') ? 'active' : '' }}">
                    <span>شرایط گارانتی ۱۸ ماهه</span>
                </a>
                <a href="{{ url('/customer-rights') }}" class="nav-item-link {{ request()->is('*customer-rights*') ? 'active' : '' }}">
                    <span>منشور حقوق مشتریان</span>
                </a>
                <a href="{{ url('/shipping-guide') }}" class="nav-item-link {{ request()->is('*shipping-guide*') ? 'active' : '' }}">
                    <span>راهنمای پذیرش و ارسال</span>
                </a>
                <a href="{{ url('/invoice-sample') }}" class="nav-item-link {{ request()->is('*invoice-sample*') ? 'active' : '' }}">
                    <span>تعرفه و فاکتور رسمی</span>
                </a>
                <a href="{{ url('/complaints') }}" class="nav-item-link {{ request()->is('*complaints*') ? 'active' : '' }}">
                    <span>ثبت شکایات</span>
                </a>
                <a href="{{ url('/survey') }}" class="nav-item-link {{ request()->is('*survey*') ? 'active' : '' }}">
                    <span>نظرسنجی</span>
                </a>
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                <a href="{{ url('/#inquiry-section') }}" class="btn-track-quick">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span>پیگیری آنلاین</span>
                </a>
                <a href="https://taminkanisam.co.ir" class="btn-car-portal">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
                    <span>سایت خودرو</span>
                </a>
                <button type="button" class="mobile-menu-toggle" id="openMobileDrawerBtn" aria-label="منو">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <div class="brand-logo-area">
                <div class="brand-icon-box" style="width: 36px; height: 36px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                </div>
                <span class="brand-name" style="font-size: 1.1rem;">سام موبایل</span>
            </div>
            <button class="drawer-close" id="closeMobileDrawerBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <ul class="drawer-nav-list">
            <li><a href="{{ url('/') }}" class="drawer-nav-link {{ request()->is('/') || request()->is('mob') ? 'active' : '' }}">صفحه اصلی</a></li>
            <li><a href="{{ url('/#inquiry-section') }}" class="drawer-nav-link">استعلام گارانتی و اصالت (IMEI)</a></li>
            <li><a href="{{ url('/service-portal') }}" class="drawer-nav-link {{ request()->is('*service-portal*') ? 'active' : '' }}">سامانه مدیریت خدمات (ماده ۱۳)</a></li>
            <li><a href="{{ url('/warranty-terms') }}" class="drawer-nav-link {{ request()->is('*warranty-terms*') ? 'active' : '' }}">شرایط گارانتی ۱۸ ماهه</a></li>
            <li><a href="{{ url('/customer-rights') }}" class="drawer-nav-link {{ request()->is('*customer-rights*') ? 'active' : '' }}">منشور حقوق مشتریان</a></li>
            <li><a href="{{ url('/shipping-guide') }}" class="drawer-nav-link {{ request()->is('*shipping-guide*') ? 'active' : '' }}">راهنمای پذیرش و ارسال پستی</a></li>
            <li><a href="{{ url('/invoice-sample') }}" class="drawer-nav-link {{ request()->is('*invoice-sample*') ? 'active' : '' }}">نمونه فاکتور رسمی اتحادیه</a></li>
            <li><a href="{{ url('/complaints') }}" class="drawer-nav-link {{ request()->is('*complaints*') ? 'active' : '' }}">ثبت و پیگیری شکایات</a></li>
            <li><a href="{{ url('/survey') }}" class="drawer-nav-link {{ request()->is('*survey*') ? 'active' : '' }}">نظرسنجی کیفیت خدمت</a></li>
            <li><a href="{{ url('/regulations') }}" class="drawer-nav-link {{ request()->is('*regulations*') ? 'active' : '' }}">ضوابط اجرایی وزارت صمت</a></li>
            <li style="margin-top: 10px; border-top: 1px solid var(--border-light); padding-top: 10px;">
                <a href="https://taminkanisam.co.ir" class="drawer-nav-link" style="color: var(--primary);">
                    <span>بازگشت به سایت خودرو</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="main-wrapper">
        @yield('content')
    </main>

    <!-- Ultra-Premium Light Footer -->
    <footer class="site-footer-light">
        <!-- Footer Top Strip with 4 Key Pillars -->
        <div class="footer-top-strip">
            <div class="footer-features-grid">
                <div class="footer-feat-item">
                    <div class="footer-feat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <div class="footer-feat-title">۱۸ ماه گارانتی شرکتی</div>
                        <div class="footer-feat-desc">پوشش قطعات و بردهای اصلی</div>
                    </div>
                </div>
                <div class="footer-feat-item">
                    <div class="footer-feat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <div>
                        <div class="footer-feat-title">ارائه دستگاه امانی</div>
                        <div class="footer-feat-desc">در صورت انتظار بیش از ۳ ساعت</div>
                    </div>
                </div>
                <div class="footer-feat-item">
                    <div class="footer-feat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <div>
                        <div class="footer-feat-title">پست پیشتاز سراسری</div>
                        <div class="footer-feat-desc">ارسال رایگان از تمام استان‌ها</div>
                    </div>
                </div>
                <div class="footer-feat-item">
                    <div class="footer-feat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <div>
                        <div class="footer-feat-title">فاکتور رسمی اتحادیه</div>
                        <div class="footer-feat-desc">شفافیت کامل مطابق ماده ۱۳</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Main Columns -->
        <div class="footer-main-area">
            <!-- Col 1: About -->
            <div>
                <div class="brand-logo-area" style="margin-bottom: 16px;">
                    <div class="brand-icon-box" style="width: 38px; height: 38px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    </div>
                    <div class="brand-titles">
                        <span class="brand-name" style="font-size: 1.15rem;">سام موبایل</span>
                        <span class="brand-sub">شرکت تامین کانی سام</span>
                    </div>
                </div>
                <p class="footer-about-text">
                    سام موبایل، مرکز تخصصی خدمات پس از فروش و گارانتی رسمی ۱۸ ماهه تلفن‌های همراه و تجهیزات هوشمند وارداتی شرکت تامین کانی سام. متعهد به رعایت دقیق ضوابط اجرایی ماده ۱۳ و تبصره ۵ ماده ۲۸ سازمان حمایت از مصرف‌کنندگان و تولیدکنندگان و مصوبات وزارت صنعت، معدن و تجارت.
                </p>
                <div style="display: flex; gap: 8px;">
                    <span style="font-size: 0.76rem; background: var(--bg-subtle); border: 1px solid var(--border-light); padding: 4px 10px; border-radius: var(--radius-pill); font-weight: 600; color: var(--text-muted);">ضمانت اصالت قطعات</span>
                    <span style="font-size: 0.76rem; background: var(--bg-subtle); border: 1px solid var(--border-light); padding: 4px 10px; border-radius: var(--radius-pill); font-weight: 600; color: var(--text-muted);">پشتیبانی ۵ ساله</span>
                </div>
            </div>

            <!-- Col 2: Services -->
            <div>
                <h4 class="footer-col-title">خدمات الکترونیک</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ url('/#inquiry-section') }}">استعلام گارانتی و اصالت (IMEI)</a></li>
                    <li><a href="{{ url('/service-portal') }}">سامانه مدیریت خدمات (ماده ۱۳)</a></li>
                    <li><a href="{{ url('/#inquiry-section') }}">پیگیری آنلاین تعمیرات</a></li>
                    <li><a href="{{ url('/invoice-sample') }}">نمونه فاکتور رسمی اتحادیه</a></li>
                    <li><a href="{{ url('/customer-rights') }}">منشور حقوق مشتریان</a></li>
                    <li><a href="{{ url('/survey') }}">نظرسنجی کیفیت خدمات</a></li>
                </ul>
            </div>

            <!-- Col 3: Rules & Systems -->
            <div>
                <h4 class="footer-col-title">راهنماها و قوانین</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ url('/warranty-terms') }}">شرایط گارانتی و موارد ابطال</a></li>
                    <li><a href="{{ url('/shipping-guide') }}">نکات مهم ارسال پستی دستگاه</a></li>
                    <li><a href="{{ url('/complaints') }}">ثبت و پیگیری شکایات</a></li>
                    <li><a href="{{ url('/regulations') }}">ضوابط اجرایی وزارت صمت</a></li>
                    <li><a href="https://hamta.ntsw.ir" target="_blank" rel="noopener">سامانه همتا (*7777#)</a></li>
                    <li><a href="https://irangs.ir" target="_blank" rel="noopener">سامانه جامع گارانتی</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & Info -->
            <div>
                <h4 class="footer-col-title">ارتباط با مرکز خدمات</h4>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <span>تهران، میدان فردوسی، مرکز تجارت جهانی، ورودی اداری، طبقه ۵، واحد ۵۱۵</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <span>تلفن تماس: <strong>۰۲۱-۶۵۰۲۱۰۸۵</strong></span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <span>ایمیل: info@taminkanisam.co.ir</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <span>ساعات کاری: شنبه تا چهارشنبه ۸:۳۰ تا ۱۷:۰۰</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom-bar">
            <div class="footer-bottom-inner">
                <div>
                    کلیه حقوق مادی و معنوی متعلق به <strong>سام موبایل (شرکت تامین کانی سام)</strong> می‌باشد.
                </div>
                <div style="display: flex; gap: 16px;">
                    <span>پشتیبانی فنی: شرکت تامین کانی سام</span>
                    <span>ضوابط ماده ۱۳ سازمان حمایت</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Native Sticky Bottom Bar for Mobile Phones (App Experience) -->
    <nav class="native-bottom-bar" aria-label="ناوبری سریع موبایل">
        <a href="{{ url('/') }}" class="native-tab-item {{ request()->is('/') || request()->is('mob') ? 'active' : '' }}">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </span>
            <span>صفحه اصلی</span>
        </a>
        <a href="{{ url('/#inquiry-section') }}" class="native-tab-item">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
            <span>استعلام IMEI</span>
        </a>
        <a href="{{ url('/service-portal') }}" class="native-tab-item {{ request()->is('*service-portal*') ? 'active' : '' }}">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </span>
            <span>سامانه خدمات</span>
        </a>
        <a href="{{ url('/warranty-terms') }}" class="native-tab-item {{ request()->is('*warranty-terms*') ? 'active' : '' }}">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </span>
            <span>شرایط گارانتی</span>
        </a>
        <a href="tel:02165021085" class="native-tab-item">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </span>
            <span>تماس فوری</span>
        </a>
    </nav>

    <!-- Drawer Script -->
    <script>
        const openDrawerBtn = document.getElementById('openMobileDrawerBtn');
        const closeDrawerBtn = document.getElementById('closeMobileDrawerBtn');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const mobileOverlay = document.getElementById('mobileDrawerOverlay');

        function openDrawer() {
            mobileDrawer.classList.add('active');
            mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            mobileDrawer.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (openDrawerBtn) openDrawerBtn.addEventListener('click', openDrawer);
        if (closeDrawerBtn) closeDrawerBtn.addEventListener('click', closeDrawer);
        if (mobileOverlay) mobileOverlay.addEventListener('click', closeDrawer);
    </script>
    @stack('scripts')
</body>
</html>
