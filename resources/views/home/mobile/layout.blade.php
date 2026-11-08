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
    html, body {
        overflow-x: hidden !important;
        max-width: 100vw !important;
        width: 100% !important;
        position: relative !important;
    }
    
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
            overflow-x: hidden !important;
            width: 100% !important;
            max-width: 100vw !important;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-body);
            line-height: 1.75;
            direction: rtl;
            text-align: right;
            overflow-x: hidden !important;
            width: 100% !important;
            max-width: 100vw !important;
            font-size: 15px;
            position: relative;
            padding-bottom: 0;
            -webkit-font-smoothing: antialiased;
        }

        @media (max-width: 991px) {
            body {
                /* Safe bottom space for native app floating tab bar */
                padding-bottom: calc(78px + env(safe-area-inset-bottom, 0px)) !important;
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
        @media (max-width: 991px) {
            .top-announcement-bar {
                display: none !important; /* Eliminate mobile blowout and provide native app look */
            }
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

        
        .nav-item-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.86rem;
            font-weight: 700;
            color: var(--text-body);
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
            line-height: 1;
        }
        .nav-item-link:hover,
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
            .site-header {
                box-shadow: 0 2px 16px rgba(15, 23, 42, 0.05) !important;
                background: rgba(255, 255, 255, 0.94) !important;
                backdrop-filter: blur(20px) !important;
                -webkit-backdrop-filter: blur(20px) !important;
            }
            
            .brand-logo-area {
                gap: 8px !important;
            }
            .brand-icon-box {
                width: 36px !important;
                height: 36px !important;
                border-radius: 10px !important;
            }
            .brand-icon-box svg {
                width: 20px !important;
                height: 20px !important;
            }
            .brand-titles {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 6px !important;
            }
            .brand-name {
                font-size: 1.05rem !important;
            }
            .brand-sub {
                display: none !important;
            }
            .brand-app-badge {
                display: inline-flex !important;
                align-items: center !important;
                gap: 3px !important;
                font-size: 0.68rem !important;
                font-weight: 800 !important;
                color: #059669 !important;
                background: #ecfdf5 !important;
                border: 1px solid #a7f3d0 !important;
                padding: 1px 7px !important;
                border-radius: 99px !important;
            }
            .nav-single-line {
                display: none !important;
            }
            .btn-track-quick {
                display: none !important;
            }
            .header-actions {
                gap: 8px !important;
            }
            .mobile-quick-auth-btn {
                display: inline-flex !important;
                align-items: center !important;
                gap: 5px !important;
                padding: 6px 12px !important;
                border-radius: var(--radius-pill) !important;
                font-size: 0.78rem !important;
                font-weight: 700 !important;
                background: linear-gradient(135deg, #eff6ff, #dbeafe) !important;
                color: #1d4ed8 !important;
                border: 1px solid #bfdbfe !important;
                text-decoration: none !important;
            }
            .mobile-menu-toggle {
                display: flex !important;
                width: 38px !important;
                height: 38px !important;
                border-radius: 10px !important;
                background: #f1f5f9 !important;
                border: 1px solid #e2e8f0 !important;
            }
            .mobile-menu-toggle:active {
                transform: scale(0.92);
            }
        }
        @media (min-width: 992px) {
            .brand-app-badge {
                display: none !important;
            }
            .mobile-quick-auth-btn {
                display: none !important;
            }
        }

        /* ========================================================
           MOBILE DRAWER (FOR SMARTPHONES) - ULTRA-PREMIUM NATIVE SHEET
           ======================================================== */
        .mobile-drawer-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            background: rgba(15, 23, 42, 0.65) !important;
            backdrop-filter: blur(6px) !important;
            -webkit-backdrop-filter: blur(6px) !important;
            z-index: 1050 !important;
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
            transition: opacity 0.3s ease, visibility 0.3s ease !important;
        }
        .mobile-drawer-overlay.active {
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
        }
        .mobile-drawer {
            position: fixed !important;
            top: 0 !important;
            right: -360px !important;
            left: auto !important;
            bottom: 0 !important;
            width: 320px !important;
            max-width: 86vw !important;
            background: #ffffff !important;
            z-index: 1060 !important;
            transform: none !important;
            display: flex !important;
            flex-direction: column !important;
            box-shadow: -15px 0 45px rgba(15, 23, 42, 0.2) !important;
            direction: rtl !important;
            text-align: right !important;
            visibility: hidden !important;
            pointer-events: none !important;
            opacity: 0 !important;
            transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease, visibility 0.35s !important;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            overflow: hidden;
        }
        .mobile-drawer.active {
            right: 0 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            opacity: 1 !important;
        }
        .drawer-header {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 16px 18px !important;
            border-bottom: 1px solid var(--border-light) !important;
            direction: rtl !important;
            text-align: right !important;
            background: #f8fafc !important;
        }
        .drawer-close {
            width: 36px !important;
            height: 36px !important;
            border-radius: 50% !important;
            background: #ffffff !important;
            border: 1px solid var(--border-light) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: var(--text-muted) !important;
            cursor: pointer !important;
            transition: all 0.2s;
        }
        .drawer-close:active {
            transform: scale(0.9);
            background: #f1f5f9;
        }
        .drawer-body-scroll {
            list-style: none !important;
            padding: 14px 14px 24px 14px !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 6px !important;
            direction: rtl !important;
            text-align: right !important;
        }
        .drawer-section-heading {
            font-size: 0.74rem !important;
            font-weight: 800 !important;
            color: #94a3b8 !important;
            text-transform: uppercase !important;
            padding: 10px 8px 4px 8px !important;
            letter-spacing: 0.5px !important;
        }
        .drawer-nav-item {
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }
        .drawer-nav-link {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 10px 12px !important;
            border-radius: 12px !important;
            color: #334155 !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
            direction: rtl !important;
            text-align: right !important;
            width: 100% !important;
            box-sizing: border-box !important;
            text-decoration: none !important;
        }
        .drawer-link-inner {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }
        .drawer-link-icon {
            width: 32px !important;
            height: 32px !important;
            border-radius: 9px !important;
            background: #f1f5f9 !important;
            color: #475569 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            transition: all 0.2s ease !important;
        }
        .drawer-link-arrow {
            color: #cbd5e1 !important;
            display: flex !important;
            align-items: center !important;
        }
        .drawer-nav-link:hover, .drawer-nav-link.active {
            background: #eff6ff !important;
            color: #1d4ed8 !important;
        }
        .drawer-nav-link:hover .drawer-link-icon, .drawer-nav-link.active .drawer-link-icon {
            background: #2563eb !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
        }
        .drawer-nav-link:hover .drawer-link-arrow, .drawer-nav-link.active .drawer-link-arrow {
            color: #2563eb !important;
            transform: translateX(-3px) !important;
        }
        .drawer-nav-link:active {
            transform: scale(0.98);
        }
        .drawer-user-card {
            background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%) !important;
            border: 1px solid #bfdbfe !important;
            border-radius: 14px !important;
            padding: 12px 14px !important;
            margin-bottom: 8px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            text-decoration: none !important;
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
           ULTRA-PREMIUM NATIVE APP BOTTOM BAR (iOS / ANDROID FEEL)
           ======================================================== */
        .native-bottom-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: calc(64px + env(safe-area-inset-bottom, 0px));
            padding: 0 8px env(safe-area-inset-bottom, 0px) 8px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-top: 1px solid rgba(226, 232, 240, 0.85);
            box-shadow: 0 -4px 25px rgba(15, 23, 42, 0.07);
            z-index: 1040;
            align-items: center;
            justify-content: space-around;
            direction: rtl;
        }

        .native-tab-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            color: #64748b;
            font-size: 0.72rem;
            font-weight: 600;
            height: 56px;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            border-radius: 12px;
            -webkit-tap-highlight-color: transparent;
        }

        .native-tab-item:active {
            transform: scale(0.92);
        }

        .native-tab-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .native-tab-item.active {
            color: #2563eb !important;
            font-weight: 800 !important;
        }

        .native-tab-item.active .native-tab-icon {
            transform: translateY(-2px);
            color: #2563eb !important;
        }

        .native-tab-item.active::before {
            content: '';
            position: absolute;
            top: 4px;
            width: 16px;
            height: 3px;
            border-radius: 99px;
            background: #2563eb;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.4);
        }

        /* Center Elevated Hero Action Button (App Experience) */
        .native-tab-center {
            position: relative;
            top: -15px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .native-center-btn {
            width: 58px !important;
            height: 58px !important;
            min-width: 58px !important;
            min-height: 58px !important;
            max-width: 58px !important;
            max-height: 58px !important;
            border-radius: 50% !important;
            aspect-ratio: 1 / 1 !important;
            flex-shrink: 0 !important;
            background: linear-gradient(145deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%) !important;
            color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 10px 25px -4px rgba(29, 78, 216, 0.52), 0 0 0 4px #ffffff, 0 0 0 6px rgba(37, 99, 235, 0.15) !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .native-center-btn::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 10px;
            right: 10px;
            height: 44%;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.45) 0%, rgba(255, 255, 255, 0.05) 100%);
            border-radius: 50px 50px 0 0;
            pointer-events: none;
        }

        .native-tab-center:active .native-center-btn,
        .native-center-btn:active {
            transform: scale(0.92);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.4), 0 0 0 4px #ffffff !important;
        }

        .native-center-label {
            font-size: 0.69rem;
            font-weight: 800;
            color: #1e3a8a;
            margin-top: 4px;
            white-space: nowrap;
            line-height: 1.2;
        }

        @media (max-width: 991px) {
            .native-bottom-bar {
                display: flex !important;
            }
        }
            .glass-card {
            background: #ffffff !important;
            border: 1px solid var(--border-light) !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03) !important;
            color: var(--text-body) !important;
        }

        .header-inner {
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 20px;
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        /* Desktop Dropdown Navbar */
        .nav-single-line {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: nowrap;
            white-space: nowrap;
        }
        .nav-mini-badge {
            font-size: 0.65rem;
            font-weight: 800;
            padding: 1px 6px;
            border-radius: 99px;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid #bfdbfe;
            margin-right: 4px;
        }
        .nav-dropdown {
            position: relative;
            display: inline-flex;
            align-items: center;
        }
        .nav-dropdown-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.86rem;
            font-weight: 700;
            color: var(--text-body);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            font-family: inherit;
        }
        .nav-dropdown-btn:hover,
        .nav-dropdown:hover .nav-dropdown-btn,
        .nav-dropdown-btn.active {
            color: var(--primary);
            background: var(--primary-light);
        }
        .nav-dropdown-btn svg {
            transition: transform 0.25s ease;
            color: var(--text-muted);
        }
        .nav-dropdown:hover .nav-dropdown-btn svg {
            transform: rotate(180deg);
            color: var(--primary);
        }
        .nav-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 240px;
            background: #ffffff;
            border: 1px solid var(--border-light);
            border-radius: 14px;
            box-shadow: 0 14px 38px rgba(15, 23, 42, 0.12);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .nav-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 700;
            color: var(--text-body);
            text-decoration: none;
            transition: all 0.18s ease;
            white-space: nowrap;
        }
        .nav-dropdown-item:hover,
        .nav-dropdown-item.active {
            background: var(--primary-light);
            color: var(--primary);
        }
        .nav-dropdown-item svg {
            color: var(--primary);
            flex-shrink: 0;
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
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['phone'] ?? '04136689000') }}" class="top-info-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>مرکز تماس: {{ $siteSettings['support_phone'] ?? '۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)' }}</span>
                </a>
                <span class="top-info-item" style="opacity: 0.8;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span>{{ $siteSettings['work_hours'] ?? 'شنبه تا چهارشنبه: ۸:۳۰ الی ۱۷:۰۰' }}</span>
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
                    <span class="brand-app-badge">✓ گارانتی رسمی</span>
                    <span class="brand-sub">خدمات پس از فروش تامین کانی سام</span>
                </div>
            </a>

            <!-- Ultra-Premium Desktop Navigation with Dropdowns (100% Responsive) -->
            <nav class="nav-single-line">
                <a href="{{ url('/') }}" class="nav-item-link {{ request()->is('/') || request()->is('mob') ? 'active' : '' }}">
                    <span>صفحه اصلی</span>
                </a>
                <a href="{{ url('/#inquiry-section') }}" class="nav-item-link">
                    <span>استعلام اصالت (IMEI)</span>
                </a>
                <a href="{{ url('/service-portal') }}" class="nav-item-link {{ request()->is('*service-portal*') || request()->is('*user-portal*') || request()->is('*admin-portal*') ? 'active' : '' }}">
                    <span>سامانه مدیریت خدمات</span>
                    <span class="nav-mini-badge">ماده ۱۳</span>
                </a>

                <!-- Dropdown 1: خدمات و تعرفه‌ها -->
                <div class="nav-dropdown">
                    <button type="button" class="nav-dropdown-btn {{ request()->is('*invoice-sample*') || request()->is('*warranty-terms*') || request()->is('*shipping-guide*') ? 'active' : '' }}">
                        <span>خدمات و تعرفه‌ها</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="nav-dropdown-menu">
                        <a href="{{ url('/invoice-sample') }}" class="nav-dropdown-item {{ request()->is('*invoice-sample*') || request()->is('*tariff*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            <span>نرخ‌نامه و تعرفه مصوب اتحادیه (۱۴۰۵)</span>
                            <span class="nav-mini-badge" style="background:#eff6ff; color:#2563eb; font-size:0.65rem;">ابلاغیه رسمی</span>
                        </a>
                        <a href="{{ url('/invoice-sample') }}?tab=invoice" class="nav-dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            <span>نمونه صورتحساب رسمی (ماده ۱۶)</span>
                        </a>
                        <a href="{{ url('/warranty-terms') }}" class="nav-dropdown-item {{ request()->is('*warranty-terms*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span>شرایط گارانتی ۱۸ ماهه</span>
                        </a>
                        <a href="{{ url('/shipping-guide') }}" class="nav-dropdown-item {{ request()->is('*shipping-guide*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                            <span>راهنمای پذیرش و ارسال کالا</span>
                        </a>
                        <a href="{{ url('/representatives') }}" class="nav-dropdown-item {{ request()->is('*representatives*') || request()->is('*agencies*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                            <span>لیست نمایندگان رسمی تلفن همراه</span>
                            <span class="nav-mini-badge" style="background:#ecfdf5; color:#059669; font-size:0.65rem;">۶ شعبه</span>
                        </a>
                    </div>
                </div>

                <!-- Dropdown 2: منشور و ضوابط -->
                <div class="nav-dropdown">
                    <button type="button" class="nav-dropdown-btn {{ request()->is('*customer-rights*') || request()->is('*regulations*') ? 'active' : '' }}">
                        <span>منشور و ضوابط</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="nav-dropdown-menu">
                        <a href="{{ url('/customer-rights') }}" class="nav-dropdown-item {{ request()->is('*customer-rights*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <span>منشور حقوق مشتریان</span>
                        </a>
                        <a href="{{ url('/regulations') }}" class="nav-dropdown-item {{ request()->is('*regulations*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            <span>ضوابط صمت (ماده ۱۳)</span>
                        </a>
                    </div>
                </div>

                <!-- Dropdown 3: ارتباط و شکایات -->
                <div class="nav-dropdown">
                    <button type="button" class="nav-dropdown-btn {{ request()->is('*complaints*') || request()->is('*survey*') ? 'active' : '' }}">
                        <span>شکایات و نظرسنجی</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="nav-dropdown-menu">
                        <a href="{{ url('/complaints') }}" class="nav-dropdown-item {{ request()->is('*complaints*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            <span>ثبت شکایات و بازرسی</span>
                        </a>
                        <a href="{{ url('/survey') }}" class="nav-dropdown-item {{ request()->is('*survey*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span>نظرسنجی رضایت مشتری</span>
                        </a>
                        <a href="{{ url('/tickets') }}" class="nav-dropdown-item {{ request()->is('*tickets*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            <span>ثبت و پیگیری تیکت پشتیبانی</span>
                            <span class="nav-mini-badge" style="background:#eff6ff; color:#2563eb; font-size:0.65rem;">۲۴ ساعته</span>
                        </a>
                    </div>
                </div>

                <a href="{{ url('/contact') }}" class="nav-item-link {{ request()->is('*contact*') ? 'active' : '' }}">
                    <span>تماس با ما</span>
                </a>

                {{-- آیتم‌های داینامیک سفارشی جدید (فقط صفحات جدید مدیریت شده در CMS) --}}
                @php
                    $excludedWords = ['درباره', 'وبلاگ', 'بلاگ', 'about', 'blog', 'اصلی', 'استعلام', 'پیگیری', 'گارانتی', 'منشور', 'ارسال', 'فاکتور', 'نظرسنجی', 'شکایت', 'تماس', 'نمایندگان', 'تیکت', 'قوانین', 'تعرفه'];
                    $excludedUrls = ['/', '/#inquiry-section', '#inquiry-section', '/service-portal', '/invoice-sample', '/warranty-terms', '/shipping-guide', '/customer-rights', '/regulations', '/complaints', '/survey', '/blog', '/about', '/contact', '/track', 'track', '/representatives', 'representatives', '/agencies', 'agencies', '/tickets', 'tickets'];
                @endphp
                @if(isset($headerMenuItems) && count($headerMenuItems) > 0)
                    @foreach($headerMenuItems as $navItem)
                        @php
                            $cUrl = '/' . ltrim($navItem->url, '/');
                            $isExcluded = in_array($cUrl, $excludedUrls) || in_array($navItem->url, $excludedUrls);
                            if (!$isExcluded) {
                                foreach ($excludedWords as $ew) {
                                    if (mb_stripos($navItem->title, $ew) !== false || mb_stripos($navItem->url, $ew) !== false) {
                                        $isExcluded = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        @if(!$isExcluded)
                            <a href="{{ url($navItem->url) }}" class="nav-item-link" target="{{ $navItem->target ?? '_self' }}">
                                <span>{{ $navItem->title }}</span>
                                @if(!empty($navItem->badge))
                                    <span class="nav-mini-badge" style="background: #eff6ff; color: #2563eb; font-size: 0.68rem; padding: 1px 6px; border-radius: 8px; margin-right: 4px;">{{ $navItem->badge }}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                @endif
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                @if(Auth::check() || session('mob_user_id'))
                    <a href="{{ (Auth::check() && Auth::user()->level >= 2) || session('mob_role') === 'admin' ? route('mob.admin-portal') : route('mob.user-portal') }}" class="btn-track-quick" style="background: linear-gradient(135deg, #059669, #047857);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span>{{ Auth::check() ? Auth::user()->name : (session('mob_user_name') ?: 'پنل کاربری') }}</span>
                    </a>
                    <a href="{{ (Auth::check() && Auth::user()->level >= 2) || session('mob_role') === 'admin' ? route('mob.admin-portal') : route('mob.user-portal') }}" class="mobile-quick-auth-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span>پنل</span>
                    </a>
                @else
                    <a href="{{ url('/login') }}" class="btn-track-quick" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        <span>ورود / ثبت‌نام پیامکی</span>
                    </a>
                    <a href="{{ url('/login') }}" class="mobile-quick-auth-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        <span>ورود</span>
                    </a>
                @endif

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
        <!-- Drawer Header -->
        <div class="drawer-header">
            <div class="brand-logo-area">
                <div class="brand-icon-box" style="width: 36px; height: 36px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span class="brand-name" style="font-size: 1.05rem;">سام موبایل</span>
                    <span style="font-size: 0.72rem; color: #059669; font-weight: 700;">گارانتی ۱۸ ماهه رسمی</span>
                </div>
            </div>
            <button class="drawer-close" id="closeMobileDrawerBtn" aria-label="بستن منو">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <!-- Drawer Body -->
        <div class="drawer-body-scroll">
            <!-- User Status Card -->
            @if(Auth::check() || session('mob_user_id'))
                <a href="{{ (Auth::check() && Auth::user()->level >= 2) || session('mob_role') === 'admin' ? route('mob.admin-portal') : route('mob.user-portal') }}" class="drawer-user-card">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 38px; height: 38px; border-radius: 50%; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 800;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 0.88rem; font-weight: 800; color: #1e3a8a;">{{ Auth::check() ? Auth::user()->name : (session('mob_user_name') ?: 'کاربر گرامی') }}</div>
                            <div style="font-size: 0.74rem; color: #059669; font-weight: 700;">● حساب کاربری فعال</div>
                        </div>
                    </div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: #2563eb;">ورود به پنل ›</span>
                </a>
            @else
                <a href="{{ url('/login') }}" class="drawer-user-card">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 38px; height: 38px; border-radius: 50%; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 0.88rem; font-weight: 800; color: #1e3a8a;">ورود یا ثبت‌نام پیامکی</div>
                            <div style="font-size: 0.72rem; color: #64748b;">فعال‌سازی گارانتی و پیگیری تعمیر</div>
                        </div>
                    </div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: #2563eb;">ورود ›</span>
                </a>
            @endif

            <!-- Section 1: Services -->
            <div class="drawer-section-heading">سامانه‌ها و خدمات</div>
            <a href="{{ url('/') }}" class="drawer-nav-link {{ request()->is('/') || request()->is('mob') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </span>
                    <span>صفحه اصلی</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/#inquiry-section') }}" class="drawer-nav-link">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </span>
                    <span>استعلام اصالت و گارانتی (IMEI)</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/service-portal') }}" class="drawer-nav-link {{ request()->is('*service-portal*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon" style="background: #eff6ff; color: #2563eb;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </span>
                    <span>سامانه مدیریت خدمات (ماده ۱۳)</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <!-- Section 2: Warranty & Regulations -->
            <div class="drawer-section-heading">قوانین و شفافیت</div>
            <a href="{{ url('/warranty-terms') }}" class="drawer-nav-link {{ request()->is('*warranty-terms*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </span>
                    <span>شرایط گارانتی ۱۸ ماهه</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/customer-rights') }}" class="drawer-nav-link {{ request()->is('*customer-rights*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                    </span>
                    <span>منشور حقوق مشتریان</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/shipping-guide') }}" class="drawer-nav-link {{ request()->is('*shipping-guide*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </span>
                    <span>راهنمای پذیرش و ارسال پستی</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/invoice-sample') }}" class="drawer-nav-link {{ request()->is('*invoice-sample*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </span>
                    <span>نمونه فاکتور رسمی اتحادیه</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <!-- Section 3: Feedback & Support -->
            <div class="drawer-section-heading">پشتیبانی و نظارت</div>
            <a href="{{ url('/complaints') }}" class="drawer-nav-link {{ request()->is('*complaints*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </span>
                    <span>ثبت و پیگیری شکایات</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/survey') }}" class="drawer-nav-link {{ request()->is('*survey*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </span>
                    <span>نظرسنجی کیفیت خدمت</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            <a href="{{ url('/regulations') }}" class="drawer-nav-link {{ request()->is('*regulations*') ? 'active' : '' }}">
                <div class="drawer-link-inner">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </span>
                    <span>ضوابط اجرایی وزارت صمت</span>
                </div>
                <span class="drawer-link-arrow">‹</span>
            </a>

            @if(isset($headerMenuItems) && count($headerMenuItems) > 0)
                @foreach($headerMenuItems as $navItem)
                    <a href="{{ url($navItem->url) }}" class="drawer-nav-link" target="{{ $navItem->target ?? '_self' }}">
                        <div class="drawer-link-inner">
                            <span class="drawer-link-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                            </span>
                            <span>{{ $navItem->title }}</span>
                            @if(!empty($navItem->badge))
                                <span style="font-size: 0.68rem; background: #eff6ff; color: #2563eb; padding: 1px 6px; border-radius: 6px; margin-right: 6px;">{{ $navItem->badge }}</span>
                            @endif
                        </div>
                        <span class="drawer-link-arrow">‹</span>
                    </a>
                @endforeach
            @endif

            <!-- Footer shortcut -->
            <div style="margin-top: 14px; padding-top: 12px; border-top: 1px solid var(--border-light);">
                <a href="https://taminkanisam.co.ir" class="drawer-nav-link" style="color: #2563eb; background: #eff6ff;">
                    <div class="drawer-link-inner">
                        <span class="drawer-link-icon" style="background: #2563eb; color: #ffffff;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
                        </span>
                        <span style="font-weight: 700;">سایت اصلی تامین کانی سام</span>
                    </div>
                    <span class="drawer-link-arrow" style="color: #2563eb;">‹</span>
                </a>
            </div>
        </div>
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
                    {{ $siteSettings['footer_about'] ?? 'سام موبایل، مرکز تخصصی خدمات پس از فروش و گارانتی رسمی ۱۸ ماهه تلفن‌های همراه و تجهیزات هوشمند وارداتی شرکت تامین کانی سام. متعهد به رعایت دقیق ضوابط اجرایی ماده ۱۳ و تبصره ۵ ماده ۲۸ سازمان حمایت از مصرف‌کنندگان و تولیدکنندگان و مصوبات وزارت صنعت، معدن و تجارت.' }}
                </p>
                <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px;">
                    <span style="font-size: 0.76rem; background: var(--bg-subtle); border: 1px solid var(--border-light); padding: 4px 10px; border-radius: var(--radius-pill); font-weight: 600; color: var(--text-muted);">ضمانت اصالت قطعات</span>
                    <span style="font-size: 0.76rem; background: var(--bg-subtle); border: 1px solid var(--border-light); padding: 4px 10px; border-radius: var(--radius-pill); font-weight: 600; color: var(--text-muted);">پشتیبانی ۵ ساله</span>
                </div>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <a href="{{ url('/about') }}" style="font-size: 0.8rem; background: #ffffff; border: 1.5px solid #bfdbfe; padding: 6px 14px; border-radius: var(--radius-pill); font-weight: 800; color: #1d4ed8; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(37,99,235,0.08);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <span>درباره تامین کانی سام</span>
                    </a>
                    <a href="{{ url('/blog') }}" style="font-size: 0.8rem; background: #ffffff; border: 1.5px solid #a7f3d0; padding: 6px 14px; border-radius: var(--radius-pill); font-weight: 800; color: #047857; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(5,150,105,0.08);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        <span>وبلاگ تخصصی صمت</span>
                    </a>
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
                    <li><a href="{{ url('/blog') }}" style="font-weight: 700; color: #2563eb;">وبلاگ و آموزش‌های تخصصی</a></li>
                    <li><a href="{{ url('/about') }}" style="font-weight: 700; color: #2563eb;">معرفی و درباره شرکت</a></li>
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
                    <li><a href="{{ $siteSettings['trust_hamta_url'] ?? 'https://hamta.ntsw.ir' }}" target="_blank" rel="noopener">سامانه همتا (*7777#)</a></li>
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
                        <span>{{ $siteSettings['address'] ?? 'تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸' }}</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <span>تلفن تماس: <strong>{{ $siteSettings['support_phone'] ?? '۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)' }}</strong></span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <span>ایمیل: {{ $siteSettings['email'] ?? 'info@taminkanisam.co.ir' }}</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <span>ساعات کاری: {{ $siteSettings['work_hours'] ?? 'شنبه تا چهارشنبه ۸:۳۰ تا ۱۷:۰۰' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Trust seals area -->
        <div style="background: #f8fafc; border-top: 1px solid var(--border-light); padding: 18px 24px; text-align: center;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap;">
                <a href="{{ $siteSettings['trust_enamad_url'] ?? 'https://trustseal.enamad.ir/?id=taminkanisam' }}" target="_blank" rel="noopener" style="text-decoration: none; display: flex; align-items: center; gap: 8px; background: #ffffff; padding: 8px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <span style="font-size: 1.3rem;">🏛️</span>
                    <div style="text-align: right;">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #0f172a;">اینماد ۵ ستاره</div>
                        <div style="font-size: 0.68rem; color: #64748b;">تجارت الکترونیکی</div>
                    </div>
                </a>
                <a href="{{ $siteSettings['trust_samandehi_url'] ?? 'https://logo.samandehi.ir/verify.aspx?id=taminkanisam' }}" target="_blank" rel="noopener" style="text-decoration: none; display: flex; align-items: center; gap: 8px; background: #ffffff; padding: 8px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <span style="font-size: 1.3rem;">🛡️</span>
                    <div style="text-align: right;">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #0f172a;">نشان ساماندهی</div>
                        <div style="font-size: 0.68rem; color: #64748b;">فرهنگ و ارشاد اسلامی</div>
                    </div>
                </a>
                <div style="display: flex; align-items: center; gap: 8px; background: #ffffff; padding: 8px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <span style="font-size: 1.3rem;">📜</span>
                    <div style="text-align: right;">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #0f172a;">پروانه کسب اتحادیه</div>
                        <div style="font-size: 0.68rem; color: #64748b;">{{ $siteSettings['trust_union_license'] ?? 'صنف فناوران تبریز' }}</div>
                    </div>
                </div>
                <a href="{{ $siteSettings['trust_hamta_url'] ?? 'https://hamta.ntsw.ir' }}" target="_blank" rel="noopener" style="text-decoration: none; display: flex; align-items: center; gap: 8px; background: #ffffff; padding: 8px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <span style="font-size: 1.3rem;">📱</span>
                    <div style="text-align: right;">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #0f172a;">سامانه همتا</div>
                        <div style="font-size: 0.68rem; color: #64748b;">اصالت شناسه IMEI</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom-bar">
            <div class="footer-bottom-inner">
                <div>
                    {{ $siteSettings['footer_copyright'] ?? 'کلیه حقوق مادی و معنوی متعلق به سام موبایل (شرکت تامین کانی سام) می‌باشد.' }}
                </div>
                <div style="display: flex; gap: 16px;">
                    <span>پشتیبانی فنی: شرکت تامین کانی سام</span>
                    <span>ضوابط ماده ۱۳ سازمان حمایت</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Ultra-Premium Native Sticky App Bottom Bar -->
    <nav class="native-bottom-bar" aria-label="ناوبری اصلی">
        <!-- 1. Home -->
        <a href="{{ url('/') }}" class="native-tab-item {{ request()->is('/') || request()->is('mob') ? 'active' : '' }}">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </span>
            <span>صفحه اصلی</span>
        </a>

        <!-- 2. IMEI Inquiry -->
        <a href="{{ url('/#inquiry-section') }}" class="native-tab-item">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
            <span>استعلام اصالت</span>
        </a>

        <!-- 3. CENTER HERO: Service Management -->
        <a href="{{ url('/service-portal') }}" class="native-tab-item native-tab-center {{ request()->is('*service-portal*') ? 'active' : '' }}" title="سامانه ثبت و پیگیری خدمت">
            <div class="native-center-btn">
                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </div>
            <span class="native-center-label">سامانه خدمات</span>
        </a>

        <!-- 4. Warranty Terms -->
        <a href="{{ url('/warranty-terms') }}" class="native-tab-item {{ request()->is('*warranty-terms*') ? 'active' : '' }}">
            <span class="native-tab-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </span>
            <span>شرایط گارانتی</span>
        </a>

        <!-- 5. User Account / Login -->
        @if(Auth::check() || session('mob_user_id'))
            <a href="{{ (Auth::check() && Auth::user()->level >= 2) || session('mob_role') === 'admin' ? route('mob.admin-portal') : route('mob.user-portal') }}" class="native-tab-item {{ request()->is('*portal*') ? 'active' : '' }}">
                <span class="native-tab-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </span>
                <span>حساب من</span>
            </a>
        @else
            <a href="{{ url('/login') }}" class="native-tab-item {{ request()->is('*login*') ? 'active' : '' }}">
                <span class="native-tab-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                </span>
                <span>ورود / پنل</span>
            </a>
        @endif
    </nav>
    <!-- Drawer Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var openDrawerBtn = document.getElementById('openMobileDrawerBtn');
            var closeDrawerBtn = document.getElementById('closeMobileDrawerBtn');
            var mobileDrawer = document.getElementById('mobileDrawer');
            var mobileOverlay = document.getElementById('mobileDrawerOverlay');

            // Explicitly force closed on initial page load
            if (mobileDrawer) mobileDrawer.classList.remove('active');
            if (mobileOverlay) mobileOverlay.classList.remove('active');

            function openDrawer() {
                if (mobileDrawer) mobileDrawer.classList.add('active');
                if (mobileOverlay) mobileOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                if (mobileDrawer) mobileDrawer.classList.remove('active');
                if (mobileOverlay) mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            if (openDrawerBtn) openDrawerBtn.addEventListener('click', openDrawer);
            if (closeDrawerBtn) closeDrawerBtn.addEventListener('click', closeDrawer);
            if (mobileOverlay) mobileOverlay.addEventListener('click', closeDrawer);
        });
    </script>
    @stack('scripts')
</body>
</html>
