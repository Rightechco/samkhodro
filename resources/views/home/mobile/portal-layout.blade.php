<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'سامانه مدیریت خدمات پس از فروش | سام موبایل')</title>

    <!-- Vazirmatn Font CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --portal-bg: #f8fafc;
            --portal-surface: #ffffff;
            --portal-border: #e2e8f0;
            --portal-primary: #2563eb;
            --portal-primary-hover: #1d4ed8;
            --portal-primary-light: #eff6ff;
            --portal-emerald: #10b981;
            --portal-emerald-light: #ecfdf5;
            --portal-amber: #f59e0b;
            --portal-amber-light: #fffbeb;
            --portal-text-main: #0f172a;
            --portal-text-body: #334155;
            --portal-text-muted: #64748b;
            --portal-sidebar-w: 275px;
            --portal-radius: 16px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--portal-bg);
            color: var(--portal-text-body);
            direction: rtl;
            text-align: right;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* ---------------------------------------------------------------------
           PORTAL DEDICATED TOPBAR
           --------------------------------------------------------------------- */
        .portal-topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--portal-border);
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
            height: 70px;
        }
        .portal-topbar-inner {
            max-width: 1720px; width: 100%;
            margin: 0 auto;
            padding: 0 24px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .portal-topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .portal-drawer-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f1f5f9;
            border: 1px solid var(--portal-border);
            color: var(--portal-text-main);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .portal-drawer-toggle:hover {
            background: #e2e8f0;
        }

        .portal-logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .portal-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);
            flex-shrink: 0;
        }
        .portal-logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }
        .portal-logo-title {
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--portal-text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .portal-system-tag {
            font-size: 0.68rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 99px;
            background: var(--portal-primary-light);
            color: var(--portal-primary);
            border: 1px solid #bfdbfe;
        }
        .portal-logo-sub {
            font-size: 0.74rem;
            color: var(--portal-text-muted);
            font-weight: 600;
        }

        .portal-topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Hotline Pill */
        .portal-hotline-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid var(--portal-border);
            font-size: 0.80rem;
            font-weight: 700;
            color: var(--portal-text-body);
            transition: all 0.2s;
        }
        .portal-hotline-pill:hover {
            border-color: var(--portal-primary);
            color: var(--portal-primary);
        }

        /* View Public Site button */
        .btn-view-site {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--portal-text-muted);
            transition: all 0.2s;
        }
        .btn-view-site:hover {
            background: #f8fafc;
            color: var(--portal-text-main);
            border-color: #94a3b8;
        }

        /* User Chip */
        .portal-user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 12px 5px 6px;
            border-radius: 12px;
            background: #f1f5f9;
            border: 1px solid var(--portal-border);
        }
        .portal-avatar-small {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--portal-primary);
            color: #ffffff;
            font-weight: 800;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .portal-user-chip-name {
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--portal-text-main);
            max-width: 140px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-topbar-logout {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #fff1f2;
            border: 1px solid #ffe4e6;
            color: #e11d48;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-topbar-logout:hover {
            background: #ffe4e6;
            color: #be123c;
        }

        /* ---------------------------------------------------------------------
           PORTAL BODY WRAPPER & SIDEBAR
           --------------------------------------------------------------------- */
        .portal-wrapper {
            flex: 1;
            max-width: 1720px; width: 100%;
            width: 100%;
            margin: 0 auto;
            padding: 20px 24px 40px;
            display: flex;
            gap: 24px;
            position: relative;
        }

        .portal-sidebar {
            width: var(--portal-sidebar-w);
            background: var(--portal-surface);
            border: 1px solid var(--portal-border);
            border-radius: var(--portal-radius);
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.02);
            padding: 20px 14px;
            height: fit-content;
            position: sticky;
            top: 90px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 900;
        }

        /* Sidebar Profile Card */
        .portal-profile-card {
            padding: 14px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
            border: 1px solid #dbeafe;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .portal-profile-avatar {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            font-size: 1.15rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            flex-shrink: 0;
        }
        .portal-profile-info {
            overflow: hidden;
        }
        .portal-profile-name {
            font-size: 0.90rem;
            font-weight: 800;
            color: var(--portal-text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .portal-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.70rem;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 99px;
            margin-top: 3px;
        }
        .role-super { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .role-agent { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .role-tech { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .role-customer { background: #ede9fe; color: #6d28d9; border: 1px solid #ddd6fe; }

        .portal-pulse-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
        }

        /* Sidebar Navigation Groups */
        .portal-nav-section-title {
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: var(--portal-text-muted);
            padding: 8px 12px 3px;
            text-transform: uppercase;
        }
        .portal-sidebar-nav {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 12px;
        }
        .portal-nav-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 0.84rem;
            font-weight: 700;
            color: var(--portal-text-body);
            background: transparent;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: right;
            font-family: inherit;
        }
        .portal-nav-btn:hover {
            background: #f1f5f9;
            color: var(--portal-text-main);
        }
        .portal-nav-btn.active {
            background: var(--portal-primary-light);
            color: var(--portal-primary);
            border-color: #bfdbfe;
            font-weight: 800;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
        }
        .portal-nav-btn-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .portal-nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: currentColor;
        }
        .portal-nav-pill {
            font-size: 0.70rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 99px;
            background: #e2e8f0;
            color: var(--portal-text-muted);
        }
        .portal-nav-btn.active .portal-nav-pill {
            background: var(--portal-primary);
            color: #ffffff;
        }

        .portal-sidebar-footer {
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid var(--portal-border);
        }

        /* ---------------------------------------------------------------------
           MAIN CONTENT CONTAINER
           --------------------------------------------------------------------- */
        .portal-main {
            flex: 1;
            min-width: 0;
        }

        /* ---------------------------------------------------------------------
           PORTAL DEDICATED FOOTER
           --------------------------------------------------------------------- */
        .portal-footer {
            background: var(--portal-surface);
            border-top: 1px solid var(--portal-border);
            padding: 24px;
            margin-top: auto;
        }
        .portal-footer-inner {
            max-width: 1720px; width: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 0.78rem;
            color: var(--portal-text-muted);
        }
        .portal-footer-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .portal-footer-info strong {
            color: var(--portal-text-main);
            font-size: 0.84rem;
        }
        .portal-footer-meta {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .portal-status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--portal-emerald);
            font-weight: 700;
        }

        /* ---------------------------------------------------------------------
           RESPONSIVE MOBILE BREAKPOINTS
           --------------------------------------------------------------------- */
        @media (max-width: 991px) {
            .portal-topbar-inner {
                padding: 0 16px;
                height: 60px;
            }
            .portal-drawer-toggle {
                display: flex;
            }
            .portal-hotline-pill, .btn-view-site {
                display: none;
            }
            .portal-logo-title {
                font-size: 1.0rem;
            }
            .portal-logo-icon {
                width: 36px;
                height: 36px;
                border-radius: 10px;
            }
            .portal-wrapper {
                padding: 12px 10px 40px;
                display: block;
            }
            .portal-sidebar {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                height: 100vh;
                margin: 0;
                border-radius: 0;
                border: none;
                box-shadow: -10px 0 30px rgba(15, 23, 42, 0.2);
                transform: translateX(105%);
                z-index: 10000;
                overflow-y: auto;
            }
            .portal-sidebar.open {
                transform: translateX(0);
            }
            .portal-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(4px);
                z-index: 9999;
                display: none;
            }
            .portal-backdrop.open {
                display: block;
            }
            .portal-footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    
        /* =========================================================================
           ENTERPRISE MASTER FORM & INPUT DESIGN SYSTEM (ULTRA-PREMIUM LIGHT THEME)
           ========================================================================= */
        .erp-form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 24px 28px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
            margin-bottom: 22px;
            transition: all 0.25s ease;
        }
        .erp-form-card:hover {
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.06);
            border-color: #cbd5e1;
        }
        .erp-form-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f1f5f9;
        }
        .erp-form-card-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .erp-form-card-badge {
            font-size: 0.72rem;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 99px;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }
        .erp-form-card-desc {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: -12px;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        /* Form Group & Labels */
        .erp-form-group, .form-group-custom {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
            position: relative;
        }
        .erp-form-label, .form-label-custom {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.84rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .erp-form-label .req, .form-label-custom .req {
            color: #ef4444;
            font-weight: 800;
        }
        .erp-form-label-hint {
            font-size: 0.72rem;
            color: #94a3b8;
            font-weight: 500;
            margin-right: auto;
        }

        /* Standardized Form Inputs */
        .erp-form-input, .form-input-custom, 
        .erp-form-select, .form-select-custom, 
        .erp-form-textarea {
            width: 100% !important;
            height: 48px;
            padding: 0 16px;
            font-family: inherit;
            font-size: 0.92rem;
            font-weight: 500;
            color: #0f172a;
            background-color: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            box-sizing: border-box;
            outline: none;
        }
        .erp-form-textarea {
            height: auto !important;
            min-height: 110px;
            padding: 12px 16px;
            line-height: 1.7;
            resize: vertical;
        }
        .erp-form-input::placeholder, .form-input-custom::placeholder, .erp-form-textarea::placeholder {
            color: #94a3b8;
            font-size: 0.86rem;
            font-weight: 400;
        }
        .erp-form-input:hover, .form-input-custom:hover, 
        .erp-form-select:hover, .form-select-custom:hover, 
        .erp-form-textarea:hover {
            border-color: #94a3b8;
            background-color: #fafbfc;
        }
        .erp-form-input:focus, .form-input-custom:focus, 
        .erp-form-select:focus, .form-select-custom:focus, 
        .erp-form-textarea:focus {
            border-color: #2563eb !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14) !important;
        }

        /* Input with prefix/suffix icons */
        .erp-input-icon-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .erp-input-icon-wrap svg {
            position: absolute;
            right: 14px;
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.2s;
        }
        .erp-input-icon-wrap input {
            padding-right: 44px !important;
        }
        .erp-input-icon-wrap:focus-within svg {
            color: #2563eb;
        }

        /* Multi-column Grid Layouts */
        .form-grid-3, .erp-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
        .form-grid-2, .erp-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .erp-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }
        @media (max-width: 1024px) {
            .form-grid-3, .erp-grid-3 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .erp-grid-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 768px) {
            .form-grid-3, .erp-grid-3, .form-grid-2, .erp-grid-2, .erp-grid-4 {
                grid-template-columns: 1fr;
            }
        }

        /* Interactive Brand Chips */
        .erp-brand-chips {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }
        .erp-brand-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            font-size: 0.84rem;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }
        .erp-brand-chip:hover {
            border-color: #2563eb;
            background: #eff6ff;
            color: #2563eb;
        }
        .erp-brand-chip.active {
            background: #2563eb;
            color: #ffffff;
            border-color: #1d4ed8;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        /* Checkbox & Radio Chips */
        .erp-tag-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .erp-tag-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 99px;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s;
        }
        .erp-tag-chip.active, .erp-tag-chip input:checked + span {
            background: #dbeafe;
            color: #1d4ed8;
            border-color: #93c5fd;
        }

        /* Spare Parts HD Gallery Cards */
        .parts-grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .part-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .part-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.1);
            border-color: #93c5fd;
        }
        .part-card-img-wrap {
            position: relative;
            height: 190px;
            background: #f8fafc;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }
        .part-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .part-card:hover .part-card-img {
            transform: scale(1.06);
        }
        .part-card-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .part-card-shelf {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 0.68rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 8px;
            background: rgba(15, 23, 42, 0.85);
            color: #ffffff;
        }
        .part-card-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .part-card-category {
            font-size: 0.72rem;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 6px;
        }
        .part-card-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.5;
            margin-bottom: 8px;
        }
        .part-card-sku {
            font-size: 0.72rem;
            color: #64748b;
            font-family: monospace;
            margin-bottom: 12px;
        }
        .part-card-footer {
            margin-top: auto;
            border-top: 1px solid #f1f5f9;
            padding-top: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .part-card-price {
            font-size: 1.05rem;
            font-weight: 900;
            color: #2563eb;
        }

        /* Live Intake Receipt Preview */
        .intake-receipt-live {
            background: #ffffff;
            border: 2px dashed #93c5fd;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.05);
            position: sticky;
            top: 90px;
        }
        .intake-receipt-header {
            text-align: center;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 16px;
        }
        .intake-receipt-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.82rem;
            padding: 8px 0;
            border-bottom: 1px solid #f8fafc;
        }
        .intake-receipt-label {
            color: #64748b;
            font-weight: 600;
        }
        .intake-receipt-val {
            color: #0f172a;
            font-weight: 800;
        }
    
    </style>
    @stack('styles')
</head>
<body>

    <!-- Backdrop for Mobile Sidebar -->
    <div class="portal-backdrop" id="portalBackdrop" onclick="togglePortalSidebar(false)"></div>

    <!-- 1. DEDICATED TOPBAR -->
    <header class="portal-topbar">
        <div class="portal-topbar-inner">
            <div class="portal-topbar-right">
                <button type="button" class="portal-drawer-toggle" onclick="togglePortalSidebar()" title="منوی سامانه">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <a href="{{ url('/service-portal') }}" class="portal-logo-area">
                    <div class="portal-logo-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    </div>
                    <div class="portal-logo-text">
                        <span class="portal-logo-title">
                            سام موبایل
                            <span class="portal-system-tag">سامانه مدیریت خدمات</span>
                        </span>
                        <span class="portal-logo-sub">شرکت تامین کانی سام | گارانتی رسمی ۱۸ ماهه</span>
                    </div>
                </a>
            </div>

            <div class="portal-topbar-left">
                <a href="tel:04136689000" class="portal-hotline-pill">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>مرکز تماس: ۰۴۱-۳۶۶۸۹۰۰۰</span>
                </a>

                <a href="{{ url('/') }}" class="btn-view-site">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    <span>سایت اصلی</span>
                </a>

                @php
                    $u = Auth::check() ? Auth::user() : null;
                    $userName = $u ? $u->name : (session('mob_user_name') ?: 'کاربر گرامی');
                    $userLvl = $u ? (int)$u->level : (session('mob_level') !== null ? (int)session('mob_level') : 0);
                    $roleTitle = 'مشتری گرامی';
                    $roleClass = 'role-customer';
                    if ($userLvl >= 3) {
                        $roleTitle = 'مدیر ارشد سامانه';
                        $roleClass = 'role-super';
                    } elseif ($userLvl == 2) {
                        $roleTitle = 'کارشناس پذیرش و تحویل';
                        $roleClass = 'role-agent';
                    } elseif ($userLvl == 1) {
                        $roleTitle = 'تکنسین فنی';
                        $roleClass = 'role-tech';
                    }
                @endphp
                <div class="portal-user-chip">
                    <div class="portal-avatar-small">{{ mb_substr($userName, 0, 1) }}</div>
                    <div style="display: flex; flex-direction: column;">
                        <span class="portal-user-chip-name">{{ $userName }}</span>
                        <span class="portal-role-badge {{ $roleClass }}">
                            <span class="portal-pulse-dot"></span>
                            {{ $roleTitle }}
                        </span>
                    </div>
                </div>

                <a href="{{ url('/logout') }}" class="btn-topbar-logout" title="خروج از سامانه">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- 2. MAIN WORKSPACE -->
    <div class="portal-wrapper">
        @yield('content')
    </div>

    <!-- 3. DEDICATED FOOTER -->
    <footer class="portal-footer">
        <div class="portal-footer-inner">
            <div class="portal-footer-info">
                <strong>سامانه یکپارچه مدیریت خدمات پس از فروش و نمایندگی‌های سام موبایل</strong>
                <span>شرکت تامین کانی سام (سهامی خاص) - انطباق کامل با ماده ۱۳ ضوابط اجرایی سازمان حمایت از حقوق مصرف‌کنندگان</span>
                <span>نشانی: تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸ | مرکز تماس: ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)</span>
            </div>
            <div class="portal-footer-meta">
                <span class="portal-status-indicator">
                    <span class="portal-pulse-dot"></span>
                    <span>سرور ابری فعال و پایدار</span>
                </span>
                <span>نسخه سامانه: ERP v2.6.4</span>
            </div>
        </div>
    </footer>

    <script>
        function togglePortalSidebar(force) {
            const sb = document.querySelector('.portal-sidebar') || document.querySelector('.erp-sidebar') || document.querySelector('.user-sidebar');
            const bd = document.getElementById('portalBackdrop');
            if (!sb) return;
            const open = force !== undefined ? force : !sb.classList.contains('open');
            if (open) {
                sb.classList.add('open');
                if (bd) bd.classList.add('open');
            } else {
                sb.classList.remove('open');
                if (bd) bd.classList.remove('open');
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
