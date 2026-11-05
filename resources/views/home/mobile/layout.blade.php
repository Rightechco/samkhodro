<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'سام موبایل | خدمات پس از فروش و گارانتی رسمی تامین کانی سام')</title>
    <meta name="description" content="@yield('meta_description', 'سامانه رسمی خدمات پس از فروش، گارانتی ۱۸ ماهه تلفن همراه و تبلت شرکت تامین کانی سام (سام موبایل). استعلام اصالت، رهگیری تعمیرات، منشور حقوق مشتریان و ثبت آنلاین خدمت مطابق ضوابط وزارت صمت.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #060913;
            --bg-card: rgba(15, 23, 42, 0.75);
            --bg-card-hover: rgba(30, 41, 59, 0.85);
            --border-glow: rgba(56, 189, 248, 0.25);
            --border-light: rgba(255, 255, 255, 0.08);
            --primary: #38bdf8;
            --primary-glow: rgba(56, 189, 248, 0.4);
            --primary-dark: #0284c7;
            --accent-cyan: #06b6d4;
            --accent-indigo: #6366f1;
            --accent-emerald: #10b981;
            --accent-amber: #f59e0b;
            --accent-rose: #f43f5e;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
            --radius-lg: 20px;
            --radius-md: 14px;
            --radius-sm: 8px;
            --font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, Tahoma, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: var(--font-family);
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            line-height: 1.7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 15% 10%, rgba(56, 189, 248, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 85% 65%, rgba(99, 102, 241, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 50% 90%, rgba(16, 185, 129, 0.08) 0%, transparent 40%);
            background-attachment: fixed;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        /* Container */
        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Top Announcement Bar */
        .top-notice-bar {
            background: linear-gradient(90deg, #0369a1, #1d4ed8, #4338ca);
            color: #fff;
            padding: 7px 15px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .top-notice-badge {
            background: rgba(255, 255, 255, 0.22);
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
        }
        .top-notice-link {
            color: #bae6fd;
            text-decoration: underline;
            font-weight: 700;
        }

        /* Header Navigation */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 999;
            background: rgba(6, 9, 19, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 78px;
            gap: 16px;
        }

        /* Brand Logo */
        .header-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .brand-logo-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: linear-gradient(135deg, #0284c7, #38bdf8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.45);
            flex-shrink: 0;
        }
        .brand-text h1, .brand-text .title {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: -0.5px;
            color: #fff;
            line-height: 1.2;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .brand-text .badge-pro {
            font-size: 11px;
            font-weight: 800;
            background: rgba(56, 189, 248, 0.15);
            color: var(--primary);
            border: 1px solid rgba(56, 189, 248, 0.3);
            padding: 2px 8px;
            border-radius: 6px;
        }
        .brand-text p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* Desktop Nav */
        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-item-link {
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .nav-item-link:hover, .nav-item-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.06);
        }
        .nav-item-link.highlight {
            color: var(--primary);
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.25);
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-portal-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(2, 132, 199, 0.35);
            border: 1px solid rgba(56, 189, 248, 0.3);
            transition: all 0.25s;
        }
        .btn-portal-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(56, 189, 248, 0.5);
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }
        .btn-back-main {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            border: 1px solid var(--border-light);
            padding: 9px 14px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.03);
        }
        .btn-back-main:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Mobile Menu Toggle */
        .mobile-toggle-btn {
            display: none;
            background: transparent;
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 10px;
            color: #fff;
            cursor: pointer;
        }

        /* Mobile Drawer */
        .mobile-drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
            z-index: 10000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .mobile-drawer-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .mobile-drawer-menu {
            position: fixed;
            top: 0;
            right: -320px;
            width: 300px;
            height: 100%;
            background: #090e1d;
            border-left: 1px solid var(--border-light);
            z-index: 10001;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow-y: auto;
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .mobile-drawer-overlay.open .mobile-drawer-menu {
            right: 0;
        }
        .drawer-close-btn {
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.06);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Main Content wrapper */
        .main-wrapper {
            flex: 1;
            padding: 30px 0 60px;
        }

        /* Cards & Components */
        .glass-card {
            background: var(--bg-card);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-lg);
            padding: 28px;
            transition: all 0.3s;
        }
        .glass-card:hover {
            border-color: rgba(56, 189, 248, 0.35);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            background: rgba(56, 189, 248, 0.12);
            color: var(--primary);
            border: 1px solid rgba(56, 189, 248, 0.25);
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .section-title {
            font-size: 28px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
        }
        .section-subtitle {
            font-size: 15px;
            color: var(--text-muted);
            max-width: 650px;
            margin: 0 auto;
        }

        /* Buttons */
        .btn-glow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);
            color: #fff;
            border: none;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(56, 189, 248, 0.35);
            transition: all 0.25s;
        }
        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(56, 189, 248, 0.5);
        }
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
            border: 1px solid var(--border-light);
            cursor: pointer;
            transition: all 0.25s;
        }
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.09);
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* Footer */
        .site-footer {
            background: #04060c;
            border-top: 1px solid var(--border-light);
            padding: 50px 0 24px;
            color: var(--text-muted);
            margin-top: auto;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1.2fr 1.2fr 1.5fr;
            gap: 36px;
            margin-bottom: 40px;
        }
        .footer-col h4 {
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 18px;
            position: relative;
            padding-bottom: 8px;
        }
        .footer-col h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 36px;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
        }
        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .footer-links a {
            font-size: 14px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .footer-links a:hover {
            color: var(--primary);
            transform: translateX(-4px);
        }
        .footer-bottom {
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .desktop-nav {
                display: none;
            }
            .mobile-toggle-btn {
                display: flex;
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .header-inner {
                height: 70px;
            }
            .brand-text h1, .brand-text .title {
                font-size: 17px;
            }
            .section-title {
                font-size: 22px;
            }
            .glass-card {
                padding: 20px;
            }
            .btn-back-main span {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-notice-bar">
        <span class="top-notice-badge">ضوابط وزارت صمت</span>
        <span>سامانه جامع خدمات پس از فروش و گارانتی رسمی ۱۸ ماهه تلفن همراه و تبلت شرکت تامین کانی سام (سام موبایل)</span>
        <a href="{{ route('mob.regulations') }}" class="top-notice-link">مشاهده ابلاغیه ماده ۱۳</a>
    </div>

    <!-- Header Navigation -->
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <!-- Brand -->
                <a href="{{ route('mob.index') }}" class="header-brand">
                    <div class="brand-logo-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                            <path d="M12 18h.01"/>
                        </svg>
                    </div>
                    <div class="brand-text">
                        <div class="title">
                            سام موبایل
                            <span class="badge-pro">گارانتی ۱۸ ماهه</span>
                        </div>
                        <p>خدمات پس از فروش شرکت تامین کانی سام</p>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="desktop-nav">
                    <a href="{{ route('mob.index') }}" class="nav-item-link {{ request()->routeIs('mob.index') ? 'active' : '' }}">صفحه اصلی</a>
                    <a href="{{ route('mob.service-portal') }}" class="nav-item-link highlight {{ request()->routeIs('mob.service-portal') ? 'active' : '' }}">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <rect width="18" height="18" x="3" y="3" rx="2"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                        سامانه مدیریت خدمات
                    </a>
                    <a href="{{ route('mob.warranty-terms') }}" class="nav-item-link {{ request()->routeIs('mob.warranty-terms') ? 'active' : '' }}">شرایط گارانتی</a>
                    <a href="{{ route('mob.customer-rights') }}" class="nav-item-link {{ request()->routeIs('mob.customer-rights') ? 'active' : '' }}">منشور حقوق مشتریان</a>
                    <a href="{{ route('mob.invoice-sample') }}" class="nav-item-link {{ request()->routeIs('mob.invoice-sample') ? 'active' : '' }}">نمونه فاکتور</a>
                    <a href="{{ route('mob.survey') }}" class="nav-item-link {{ request()->routeIs('mob.survey') ? 'active' : '' }}">نظرسنجی</a>
                    <a href="{{ route('mob.complaints') }}" class="nav-item-link {{ request()->routeIs('mob.complaints') ? 'active' : '' }}">شکایات</a>
                    <a href="{{ route('mob.shipping-guide') }}" class="nav-item-link {{ request()->routeIs('mob.shipping-guide') ? 'active' : '' }}">پذیرش پستی</a>
                </nav>

                <!-- Actions -->
                <div class="header-actions">
                    <a href="https://taminkanisam.co.ir" class="btn-back-main" title="بازگشت به وبسایت اصلی تامین کانی سام">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                        <span>سایت اصلی تامین کانی سام</span>
                    </a>

                    <a href="{{ route('mob.service-portal') }}" class="btn-portal-action">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <span>پرتال خدمات</span>
                    </a>

                    <button type="button" class="mobile-toggle-btn" id="mobileMenuBtn" aria-label="منو">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="4" x2="20" y1="12" y2="12"/>
                            <line x1="4" x2="20" y1="6" y2="6"/>
                            <line x1="4" x2="20" y1="18" y2="18"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Overlay -->
    <div class="mobile-drawer-overlay" id="drawerOverlay">
        <div class="mobile-drawer-menu">
            <button type="button" class="drawer-close-btn" id="drawerCloseBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" x2="6" y1="6" y2="18"/>
                    <line x1="6" x2="18" y1="6" y2="18"/>
                </svg>
            </button>

            <div style="border-bottom: 1px solid var(--border-light); padding-bottom: 16px;">
                <div style="font-weight: 800; font-size: 18px; color: #fff;">سام موبایل</div>
                <div style="font-size: 12px; color: var(--text-muted);">پرتال خدمات پس از فروش و گارانتی</div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <a href="{{ route('mob.index') }}" class="nav-item-link">صفحه اصلی</a>
                <a href="{{ route('mob.service-portal') }}" class="nav-item-link highlight">سامانه مدیریت خدمات (ماده ۱۳)</a>
                <a href="{{ route('mob.warranty-terms') }}" class="nav-item-link">شرایط گارانتی و سامانه همتا</a>
                <a href="{{ route('mob.customer-rights') }}" class="nav-item-link">منشور حقوق مشتریان</a>
                <a href="{{ route('mob.invoice-sample') }}" class="nav-item-link">نمونه فاکتور رسمی و تعرفه</a>
                <a href="{{ route('mob.survey') }}" class="nav-item-link">فرم نظرسنجی و رضایت‌سنجی</a>
                <a href="{{ route('mob.complaints') }}" class="nav-item-link">ثبت و پیگیری شکایات</a>
                <a href="{{ route('mob.shipping-guide') }}" class="nav-item-link">نکات پذیرش و ارسال پستی</a>
                <a href="{{ route('mob.regulations') }}" class="nav-item-link">ضوابط اجرایی وزارت صمت</a>
            </div>

            <div style="margin-top: auto; padding-top: 16px; border-top: 1px solid var(--border-light);">
                <a href="https://taminkanisam.co.ir" class="btn-back-main" style="width: 100%; justify-content: center;">
                    ورود به سایت اصلی تامین کانی سام
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-wrapper">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Col 1 -->
                <div class="footer-col">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                        <div class="brand-logo-icon" style="width: 36px; height: 36px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                                <path d="M12 18h.01"/>
                            </svg>
                        </div>
                        <span style="font-weight: 800; font-size: 18px; color: #fff;">سام موبایل</span>
                    </div>
                    <p style="font-size: 13.5px; line-height: 1.8; margin-bottom: 16px;">
                        شرکت بازرگانی تامین کانی سام؛ ارائه دهنده خدمات پس از فروش، گارانتی ۱۸ ماهه معتبر تلفن همراه و تبلت با بهره‌گیری از تجهیزات استاندارد، قطعات فابریک و تکنسین‌های مجرب، مطابق ضوابط اجرایی وزارت صنعت، معدن و تجارت.
                    </p>
                    <div style="display: flex; gap: 10px; font-size: 13px;">
                        <span style="color: var(--primary); font-weight: 700;">شماره ثبت:</span> ۵۸۹۸۲۱
                    </div>
                </div>

                <!-- Col 2 -->
                <div class="footer-col">
                    <h4>دسترسی سریع</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('mob.service-portal') }}">سامانه مدیریت خدمات (برای نمایندگان)</a></li>
                        <li><a href="{{ route('mob.warranty-terms') }}">شرایط و ضوابط ۱۸ ماهه گارانتی</a></li>
                        <li><a href="{{ route('mob.customer-rights') }}">منشور حقوق مصرف‌کنندگان</a></li>
                        <li><a href="{{ route('mob.shipping-guide') }}">راهنمای پذیرش حضوری و پستی</a></li>
                        <li><a href="{{ route('mob.invoice-sample') }}">نمونه فاکتور رسمی و تعرفه اتحادیه</a></li>
                    </ul>
                </div>

                <!-- Col 3 -->
                <div class="footer-col">
                    <h4>نظارت و شکایات</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('mob.complaints') }}">ثبت آنلاین شکایات و پیگیری</a></li>
                        <li><a href="{{ route('mob.survey') }}">نظرسنجی کیفیت خدمات و پرسنل</a></li>
                        <li><a href="{{ route('mob.regulations') }}">متن کامل ضوابط اجرایی وزارت صمت</a></li>
                        <li><a href="https://irangs.ir" target="_blank" rel="noopener">سامانه جامع گارانتی کشور (ایران گارانتی)</a></li>
                        <li><a href="https://ntsw.ir" target="_blank" rel="noopener">سامانه جامع تجارت ایران</a></li>
                    </ul>
                </div>

                <!-- Col 4 -->
                <div class="footer-col">
                    <h4>مرکز تماس و نشانی</h4>
                    <div style="display: flex; flex-direction: column; gap: 12px; font-size: 13.5px;">
                        <div>
                            <span style="color: #fff; font-weight: 700;">تلفن دفتر مرکزی:</span>
                            <div style="color: var(--primary); font-weight: 800; font-size: 16px; margin-top: 2px;">۰۲۱-۶۵۰۲۱۰۸۵ / ۰۲۱-۸۸۹۹۰۰۲۱</div>
                        </div>
                        <div>
                            <span style="color: #fff; font-weight: 700;">ایمیل پشتیبانی:</span>
                            <div>info@taminkanisam.co.ir</div>
                        </div>
                        <div>
                            <span style="color: #fff; font-weight: 700;">نشانی مرکز خدمات:</span>
                            <div>تهران، میدان فردوسی، مرکز تجارت جهانی، طبقه ۵، واحد ۵۱۵</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div>
                    کلیه حقوق مادی و معنوی این سامانه متعلق به <strong>شرکت تامین کانی سام (سام موبایل)</strong> می‌باشد.
                </div>
                <div style="color: var(--text-dim);">
                    طراحی و پیاده‌سازی منطبق بر ماده ۱۳ ضوابط اجرایی خدمات پس از فروش
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const drawerOverlay = document.getElementById('drawerOverlay');
        const drawerCloseBtn = document.getElementById('drawerCloseBtn');

        if (mobileMenuBtn && drawerOverlay) {
            mobileMenuBtn.addEventListener('click', () => {
                drawerOverlay.classList.add('open');
            });
            if (drawerCloseBtn) {
                drawerCloseBtn.addEventListener('click', () => {
                    drawerOverlay.classList.remove('open');
                });
            }
            drawerOverlay.addEventListener('click', (e) => {
                if (e.target === drawerOverlay) {
                    drawerOverlay.classList.remove('open');
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
