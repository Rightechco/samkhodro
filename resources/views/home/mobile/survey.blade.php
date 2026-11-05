@extends('home.mobile.layout')

@section('title', 'فرم نظرسنجی و ارزیابی کیفیت خدمات | سام موبایل (تامین کانی سام)')

@section('content')
<div class="container">
    <div class="page-header-card">
        <span class="section-tag">پایش مستمر کیفیت</span>
        <h1>فرم نظرسنجی و رضایت‌سنجی از خدمات سام موبایل</h1>
        <p>مطابق تبصره ۴ ماده ۱۳ ضوابط اجرایی وزارت صمت؛ نظرات شما ضامن ارتقای کیفیت و سرعت خدمات ماست</p>
    </div>

    <div class="glass-card survey-card">
        <form id="surveyForm" onsubmit="submitSurvey(event)">
            <div class="survey-section-title">۱. اطلاعات شناسایی (اختیاری)</div>
            <div class="form-grid-3">
                <div class="form-group">
                    <label>نام و نام خانوادگی</label>
                    <input type="text" name="customer_name" placeholder="اختیاری">
                </div>
                <div class="form-group">
                    <label>شماره تماس همراه</label>
                    <input type="tel" name="customer_phone" placeholder="اختیاری (جهت پیگیری)" style="direction:ltr; text-align:right;">
                </div>
                <div class="form-group">
                    <label>کد رهگیری پذیرش</label>
                    <input type="text" name="tracking_code" placeholder="مثال: SAM-1403-9102" style="direction:ltr; text-align:right;">
                </div>
            </div>

            <div class="survey-section-title" style="margin-top: 30px;">۲. ارزیابی شاخص‌های پنج‌گانه کیفیت خدمات</div>
            
            <div class="ratings-container">
                <!-- Rating 1 -->
                <div class="rating-row">
                    <div class="rating-info">
                        <h4>۱. سرعت پاسخ‌دهی و زمان انجام تعمیرات</h4>
                        <p>رعایت مهلت ۲ روزه کارشناسی فنی و تحویل به موقع دستگاه</p>
                    </div>
                    <div class="star-rating" data-field="rating_speed">
                        <span class="star active" data-val="5">&#9733;</span>
                        <span class="star active" data-val="4">&#9733;</span>
                        <span class="star active" data-val="3">&#9733;</span>
                        <span class="star active" data-val="2">&#9733;</span>
                        <span class="star active" data-val="1">&#9733;</span>
                        <input type="hidden" name="rating_speed" value="5">
                    </div>
                </div>

                <!-- Rating 2 -->
                <div class="rating-row">
                    <div class="rating-info">
                        <h4>۲. کیفیت تعمیر و عملکرد دستگاه پس از تحویل</h4>
                        <p>رفع کامل عیب اولیه و سلامت سخت‌افزاری و ظاهری گوشی</p>
                    </div>
                    <div class="star-rating" data-field="rating_quality">
                        <span class="star active" data-val="5">&#9733;</span>
                        <span class="star active" data-val="4">&#9733;</span>
                        <span class="star active" data-val="3">&#9733;</span>
                        <span class="star active" data-val="2">&#9733;</span>
                        <span class="star active" data-val="1">&#9733;</span>
                        <input type="hidden" name="rating_quality" value="5">
                    </div>
                </div>

                <!-- Rating 3 -->
                <div class="rating-row">
                    <div class="rating-info">
                        <h4>۳. شفافیت هزینه‌ها و تطابق با نرخنامه مصوب</h4>
                        <p>ارائه رایگان خدمات گارانتی یا صدور فاکتور رسمی شفاف در موارد غیرگارانتی</p>
                    </div>
                    <div class="star-rating" data-field="rating_cost">
                        <span class="star active" data-val="5">&#9733;</span>
                        <span class="star active" data-val="4">&#9733;</span>
                        <span class="star active" data-val="3">&#9733;</span>
                        <span class="star active" data-val="2">&#9733;</span>
                        <span class="star active" data-val="1">&#9733;</span>
                        <input type="hidden" name="rating_cost" value="5">
                    </div>
                </div>

                <!-- Rating 4 -->
                <div class="rating-row">
                    <div class="rating-info">
                        <h4>۴. نحوه برخورد و پاسخگویی پرسنل و کارشناسان</h4>
                        <p>احترام، راهنمایی شفاف و پاسخگویی سریع تلفنی و حضوری</p>
                    </div>
                    <div class="star-rating" data-field="rating_behavior">
                        <span class="star active" data-val="5">&#9733;</span>
                        <span class="star active" data-val="4">&#9733;</span>
                        <span class="star active" data-val="3">&#9733;</span>
                        <span class="star active" data-val="2">&#9733;</span>
                        <span class="star active" data-val="1">&#9733;</span>
                        <input type="hidden" name="rating_behavior" value="5">
                    </div>
                </div>

                <!-- Rating 5 -->
                <div class="rating-row">
                    <div class="rating-info">
                        <h4>۵. رضایت کلی شما از خدمات گارانتی سام موبایل</h4>
                        <p>میزان تمایل به پیشنهاد خدمات تامین کانی سام به دیگران</p>
                    </div>
                    <div class="star-rating" data-field="rating_overall">
                        <span class="star active" data-val="5">&#9733;</span>
                        <span class="star active" data-val="4">&#9733;</span>
                        <span class="star active" data-val="3">&#9733;</span>
                        <span class="star active" data-val="2">&#9733;</span>
                        <span class="star active" data-val="1">&#9733;</span>
                        <input type="hidden" name="rating_overall" value="5">
                    </div>
                </div>
            </div>

            <div class="survey-section-title" style="margin-top: 30px;">۳. انتقادات، پیشنهادات و نقطه نظرات شما</div>
            <div class="form-group">
                <textarea name="suggestions" rows="4" placeholder="هرگونه پیشنهاد، نقطه نظر یا تجربه‌ای که در ارتباط با شعب یا خدمات ما داشته‌اید را بیان فرمایید..."></textarea>
            </div>

            <div style="margin-top: 26px; text-align: center;">
                <button type="submit" class="btn-glow" style="padding: 14px 44px; font-size: 16px;">
                    <span>ثبت و ارسال نهایی نظرسنجی</span>
                </button>
            </div>
        </form>

        <div id="surveySuccessAlert" style="display: none; text-align: center; padding: 40px 20px;">
            <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(16,185,129,0.15); border: 2px solid #10b981; color: #10b981; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <h3 style="color: #fff; font-size: 20px; font-weight: 800; margin-bottom: 8px;">با سپاس فراوان از همراهی شما</h3>
            <p style="color: var(--text-muted); font-size: 14px; max-width: 500px; margin: 0 auto 20px;">
                نظرات و امتیازات شما با موفقیت در سامانه ارزیابی کیفیت سام موبایل ثبت گردید و در پایش عملکرد تکنسین‌ها و شعب لحاظ خواهد شد.
            </p>
            <a href="{{ route('mob.index') }}" class="btn-outline">بازگشت به صفحه اصلی</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-header-card {
        text-align: center;
        padding: 40px 20px 20px;
        margin-bottom: 20px;
    }
    .page-header-card h1 { font-size: 26px; font-weight: 900; color: #fff; margin: 12px 0 8px; }
    .page-header-card p { font-size: 14.5px; color: var(--text-muted); max-width: 680px; margin: 0 auto; }

    .survey-card {
        max-width: 860px;
        margin: 0 auto 40px;
        padding: 40px;
    }
    .survey-section-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 16px;
        position: relative;
        padding-right: 12px;
    }
    .survey-section-title::before {
        content: '';
        position: absolute;
        right: 0;
        top: 4px;
        bottom: 4px;
        width: 4px;
        background: var(--primary);
        border-radius: 4px;
    }

    .form-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .form-group label {
        font-size: 13.5px;
        font-weight: 600;
        color: #e2e8f0;
    }
    .form-group input, .form-group textarea {
        background: rgba(6, 9, 19, 0.8);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        padding: 11px 14px;
        color: #fff;
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
    }
    .form-group input:focus, .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 16px rgba(56, 189, 248, 0.25);
    }

    .ratings-container {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .rating-row {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border-light);
        border-radius: 16px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .rating-info h4 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 4px; }
    .rating-info p { font-size: 12.5px; color: var(--text-dim); }

    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        gap: 6px;
    }
    .star {
        font-size: 26px;
        color: #475569;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star:hover, .star:hover ~ .star, .star.active {
        color: #fde047;
    }

    @media (max-width: 768px) {
        .form-grid-3 { grid-template-columns: 1fr; }
        .rating-row { flex-direction: column; align-items: flex-start; gap: 12px; }
        .survey-card { padding: 24px 16px; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Star rating selection
    document.querySelectorAll('.star-rating').forEach(group => {
        const stars = group.querySelectorAll('.star');
        const hiddenInput = group.querySelector('input');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const val = parseInt(star.getAttribute('data-val'));
                hiddenInput.value = val;
                stars.forEach(s => {
                    const sVal = parseInt(s.getAttribute('data-val'));
                    if (sVal <= val) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });
    });

    function submitSurvey(e) {
        e.preventDefault();
        const formData = new FormData(document.getElementById('surveyForm'));
        const data = Object.fromEntries(formData.entries());

        fetch('{{ route("mob.survey.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                document.getElementById('surveyForm').style.display = 'none';
                document.getElementById('surveySuccessAlert').style.display = 'block';
            }
        })
        .catch(err => {
            alert('خطای اتصال به سرور.');
        });
    }
</script>
@endpush
