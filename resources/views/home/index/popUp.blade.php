<style>
    /* متغیرهای رنگی و پایه‌ای */
    :root {
        --popup-primary: #2563eb;
        --popup-primary-hover: #1d4ed8;
        --popup-text-main: #0f172a;
        --popup-text-muted: #64748b;
        --popup-bg: #ffffff;
        --popup-radius: 26px;
        --popup-font: inherit; 
    }

    /* لایه تاریک پس‌زمینه (Overlay) */
    .premium-popup-overlay {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(15, 23, 42, 0.72);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2147483647 !important;
        font-family: var(--popup-font);
        direction: rtl;
        opacity: 0;
        animation: popupFadeIn 0.35s ease forwards;
        padding: 20px;
        box-sizing: border-box;
    }

    /* کارت اصلی پاپ‌آپ */
    .premium-popup-card {
        background: var(--popup-bg);
        width: 100%;
        max-width: 440px;
        border-radius: var(--popup-radius);
        overflow: hidden;
        box-shadow: 0 30px 60px -12px rgba(15, 23, 42, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        position: relative;
        transform: scale(0.92) translateY(24px);
        opacity: 0;
        animation: popupScaleUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards;
    }

    /* دکمه بستن (ضربدر) */
    .popup-close-btn {
        position: absolute;
        top: 18px;
        left: 18px; 
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(226, 232, 240, 0.8);
        width: 38px;
        height: 38px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 20;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #475569;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .popup-close-btn:hover {
        background: #ef4444;
        color: #ffffff; 
        border-color: #ef4444;
        transform: rotate(90deg) scale(1.08);
        box-shadow: 0 8px 18px rgba(239, 68, 68, 0.3);
    }

    /* بخش تصویر */
    .popup-image-wrapper {
        width: 100%;
        height: 230px;
        overflow: hidden;
        position: relative;
        background: #f1f5f9;
    }

    .popup-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .premium-popup-card:hover .popup-image {
        transform: scale(1.06); 
    }

    .popup-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 90px;
        background: linear-gradient(to top, var(--popup-bg) 20%, rgba(255, 255, 255, 0.8) 60%, transparent);
    }

    /* بخش محتوای متنی */
    .popup-content {
        padding: 0 34px 34px 34px;
        text-align: center;
        margin-top: -18px;
        position: relative;
        z-index: 5;
    }

    /* عنوان لاتین */
    .popup-title {
        font-size: 1.45rem;
        font-weight: 900;
        color: var(--popup-text-main);
        margin: 0 0 6px 0;
        line-height: 1.4;
        letter-spacing: -0.3px;
        text-align: center;
        direction: ltr;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* زیرعنوان فارسی */
    .popup-subtitle {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--popup-primary);
        margin: 0 0 12px 0;
        line-height: 1.5;
        text-align: center;
        direction: rtl;
    }

    .popup-description {
        font-size: 0.96rem;
        color: var(--popup-text-muted);
        line-height: 1.7;
        margin-bottom: 24px;
        text-align: center;
    }

    /* بخش ویژگی‌ها (Features) */
    .popup-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-bottom: 28px;
    }

    .feature-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.84rem;
        color: var(--popup-text-main);
        font-weight: 700;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        cursor: default;
    }

    .feature-tag:hover {
        border-color: var(--popup-primary);
        color: var(--popup-primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.12);
        background: #ffffff;
    }

    .feature-tag svg {
        width: 16px;
        height: 16px;
        color: var(--popup-primary);
        transition: transform 0.3s ease;
    }

    .feature-tag:hover svg {
        transform: scale(1.15);
    }

    /* استایل دکمه کال تو اکشن */
    .popup-btn-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: white !important;
        padding: 16px 26px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 800;
        font-size: 1.05rem;
        transition: all 0.35s ease;
        width: 100%;
        border: none;
        cursor: pointer;
        box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.45);
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
    }

    .popup-btn-primary::after {
        content: '';
        position: absolute;
        top: 0;
        left: -120%;
        width: 60%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
        transform: skewX(-25deg);
        transition: all 0.75s ease;
    }

    .popup-btn-primary:hover::after {
        left: 160%;
    }

    .popup-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 30px -6px rgba(37, 99, 235, 0.6);
    }

    .popup-btn-primary svg {
        transition: transform 0.3s ease;
    }

    .popup-btn-primary:hover svg {
        transform: translateX(-6px);
    }

    /* کلاس انیمیشن خروج */
    .premium-popup-overlay.closing {
        animation: popupFadeOut 0.28s ease forwards;
    }
    .premium-popup-overlay.closing .premium-popup-card {
        animation: popupScaleDown 0.28s ease forwards;
    }

    /* کی‌فریم‌ها */
    @keyframes popupFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes popupScaleUp {
        from { opacity: 0; transform: scale(0.92) translateY(24px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes popupFadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    @keyframes popupScaleDown {
        from { opacity: 1; transform: scale(1) translateY(0); }
        to { opacity: 0; transform: scale(0.94) translateY(12px); }
    }

    /* ریسپانسیو */
    @media (max-width: 480px) {
        .popup-content { padding: 0 20px 24px 20px; }
        .popup-title { font-size: 1.25rem; }
        .popup-subtitle { font-size: 1.05rem; }
        .popup-image-wrapper { height: 180px; }
        .feature-tag { font-size: 0.8rem; padding: 6px 12px; }
    }
</style>

<div id="premium-popup-container" class="premium-popup-overlay">
    <div class="premium-popup-card">
        <!-- دکمه بستن پاپ‌آپ -->
        <button type="button" class="popup-close-btn" onclick="closePremiumPopup()" aria-label="بستن">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- تصویر پاپ‌آپ -->
        <div class="popup-image-wrapper">
            <img src="{{$imagePopUp}}" alt="Toyota Corolla Cross 2026" class="popup-image">
            <div class="popup-image-overlay"></div>
        </div>
        
        <!-- محتوای متنی و دکمه‌ها -->
        <div class="popup-content">
            <!-- نام انگلیسی با اعداد لاتین و وسط‌چین -->
            <h3 class="popup-title">Toyota Corolla Cross 2026</h3>
            
            <!-- عنوان فارسی زیر نام انگلیسی -->
            <h4 class="popup-subtitle">آغاز فروش تویوتا کرولا کراس 2026</h4>

            <!-- متن توضیحات از متغیر بلید -->
            <p class="popup-description">{{ $descriptionPopUp }}</p>

            <div class="popup-features">
                <div class="feature-tag">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>بالاترین کیفیت</span>
                </div>
                
                <div class="feature-tag">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    <span>ضمانت و پشتیبانی</span>
                </div>

                <div class="feature-tag">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>مشاوره تخصصی رایگان</span>
                </div>
            </div>
            
            <div class="popup-actions">
                @if($addressPopUp && $addressPopUp != '/')
                    <a href="{{$addressPopUp}}" target="_blank" class="popup-btn-primary" onclick="closePremiumPopup()">
                        <span>{{$buttonPopUp}}</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                @else
                    <button type="button" class="popup-btn-primary" onclick="closePremiumPopup()">
                        <span>{{$buttonPopUp}}</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        function teleportPopup() {
            const popup = document.getElementById('premium-popup-container');
            if (popup && popup.parentElement !== document.body) {
                document.body.appendChild(popup);
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', teleportPopup);
        } else {
            teleportPopup();
        }
    })();

    function closePremiumPopup() {
        const popup = document.getElementById('premium-popup-container');
        if (popup) {
            popup.classList.add('closing');
            setTimeout(() => {
                popup.style.display = 'none';
            }, 280);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const popupOverlay = document.getElementById('premium-popup-container');
        if (popupOverlay) {
            popupOverlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    closePremiumPopup();
                }
            });
        }
    });
</script>