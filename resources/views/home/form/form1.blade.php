@extends('home.master')

@section('title','پرسشنامه')
@section('active',1)
@section('links')
    <style>
        /* 1. Use a more-intuitive box-sizing model */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* 2. Remove default margin */
        * {
            margin: 0;
        }

        body {
            /* 3. Add accessible line-height */
            line-height: 1.5;
            /* 4. Improve text rendering */
            -webkit-font-smoothing: antialiased;
        }

        /* 5. Improve media defaults */
        img,
        picture,
        video,
        canvas,
        svg {
            display: block;
            max-width: 100%;
        }

        /* 6. Inherit fonts for form controls */
        input,
        button,
        textarea,
        select {
            font: inherit;
        }

        /* 7. Avoid text overflows */
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            overflow-wrap: break-word;
        }

        /* 8. Improve line wrapping */
        p {
            text-wrap: pretty;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            text-wrap: balance;
        }

        /*
      9. Create a root stacking context
    */
        #root,
        #__next {
            isolation: isolate;
        }
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        html,
        body {
            width: 100%;
            max-width: 100dvw;
            overflow-x: clip;
            height: 100%;
            min-height: 100dvh;
            font-family: "IRANSansWeb", sans-serif;
            background-color: #f6f4f5;
        }
        h3 {
            text-align: center;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80dvw;
            margin-inline: auto;
            margin-block: 2rem;
        }
        .card-header {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .question {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .question p {
            flex: 1;
            margin: 0;
        }
        .options {
            display: flex;
            gap: 10px;
        }
        .options label {
            cursor: pointer;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: 0.3s;
            white-space: nowrap;
        }
        .options input {
            display: none;
        }
        .options input:checked + label {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        #survey-form {
            display: flex;
            flex-direction: column;
            gap: 0;
            padding: 0px;
        }

        hr {
            margin-block: 1rem;
            border-color: #fff;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 20rem;
        }

        .card.client-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .card.client-info .card-header {
            grid-column: 1 / -1;
        }

        .card.client-info .question {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-wrapper {
            grid-column: 1 / -1;
            display: grid;
            /* grid-template-columns: repeat(4, 1fr); */
            place-content: center;

        button {
            /* grid-column: -1 / span 1; */
            min-width: 20rem;
        }
        }

        @media (width <= 768px) {
            .card {
                padding: 15px 5px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 96dvw;
                margin-inline: auto;
                margin-block: 1rem;
            }
            .question {
                flex-wrap: wrap;
                gap: 1rem;

            p {
                min-width: fit-content;
            }
        }
        .options {
            flex-wrap: wrap;
        }
        }

        @media (768px < width <= 1024px) {
            .question {
                flex-wrap: wrap;
                gap: 1rem;

            p {
                min-width: fit-content;
            }
        }
        .options {
            flex-wrap: wrap;
        }
        }
    </style>
@endsection
@section('content')
    <h3 style="margin-top: 170px">پرسشنامه اندازه گیري رضایت مشتریان از خدمات فروش</h3>
    @if (Session::has('message'))
        <div class="alert alert-blue" style="text-align: center;color: limegreen">{{ Session::get('message') }}</div>
    @endif
    <form id="survey-form" method="post" action="/form1">
        @csrf
        <input type="hidden" name="form" value="form1">
        <div class="card">
            <div class="card-header">اطلاع رسانی و پاسخ گویی</div>
            <div class="question">
                <p>
                    سوال ۱: نحوه اطلاع رسانی شرکت در مورد شرایط فروش، پیگیری خرید، زمان
                    تحویل خودرو و...
                </p>
                <div class="options">
                    <input type="radio" id="q1_opt1" name="q1" value="خیلی زیاد" />
                    <label for="q1_opt1">خیلی زیاد</label>
                    <input type="radio" id="q1_opt2" name="q1" value="زیاد" />
                    <label for="q1_opt2">زیاد</label>
                    <input type="radio" id="q1_opt3" name="q1" value="متوسط" />
                    <label for="q1_opt3">متوسط</label>
                    <input type="radio" id="q1_opt4" name="q1" value="کم" />
                    <label for="q1_opt4">کم</label>
                    <input type="radio" id="q1_opt5" name="q1" value="خیلی کم" />
                    <label for="q1_opt5">خیلی کم</label>
                    <input type="radio" id="q1_opt6" name="q1" value="نظری ندارم" />
                    <label for="q1_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>
                    سوال 2: برخورد و پاسخگویی کارکنان ستاد مرکزی و نمایندگی های فروش
                </p>
                <div class="options">
                    <input type="radio" id="q2_opt1" name="q2" value="خیلی زیاد" />
                    <label for="q2_opt1">خیلی زیاد</label>
                    <input type="radio" id="q2_opt2" name="q2" value="زیاد" />
                    <label for="q2_opt2">زیاد</label>
                    <input type="radio" id="q2_opt3" name="q2" value="متوسط" />
                    <label for="q2_opt3">متوسط</label>
                    <input type="radio" id="q2_opt4" name="q2" value="کم" />
                    <label for="q2_opt4">کم</label>
                    <input type="radio" id="q2_opt5" name="q2" value="خیلی کم" />
                    <label for="q2_opt5">خیلی کم</label>
                    <input type="radio" id="q2_opt6" name="q2" value="نظری ندارم" />
                    <label for="q2_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>
                    سوال 3: سهولت در روش های خرید خودرو (خرید اینترنتی، مراجعه به
                    نمایندگی، شرکت های لیزینگ)
                </p>
                <div class="options">
                    <input type="radio" id="q3_opt1" name="q3" value="خیلی زیاد" />
                    <label for="q3_opt1">خیلی زیاد</label>
                    <input type="radio" id="q3_opt2" name="q3" value="زیاد" />
                    <label for="q3_opt2">زیاد</label>
                    <input type="radio" id="q3_opt3" name="q3" value="متوسط" />
                    <label for="q3_opt3">متوسط</label>
                    <input type="radio" id="q3_opt4" name="q3" value="کم" />
                    <label for="q3_opt4">کم</label>
                    <input type="radio" id="q3_opt5" name="q3" value="خیلی کم" />
                    <label for="q3_opt5">خیلی کم</label>
                    <input type="radio" id="q3_opt6" name="q3" value="نظری ندارم" />
                    <label for="q3_opt6">نظری ندارم</label>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">توجه به خواسته های مشتری</div>
            <div class="question">
                <p>
                    سوال 4: تنوع روش های فروش به منظورامکان ایجاد انتخاب مناسب (نقدی،
                    لیزینگی،مشارکتی و ...)
                </p>
                <div class="options">
                    <input type="radio" id="q4_opt1" name="q4" value="خیلی زیاد" />
                    <label for="q4_opt1">خیلی زیاد</label>
                    <input type="radio" id="q4_opt2" name="q4" value="زیاد" />
                    <label for="q4_opt2">زیاد</label>
                    <input type="radio" id="q4_opt3" name="q4" value="متوسط" />
                    <label for="q4_opt3">متوسط</label>
                    <input type="radio" id="q4_opt4" name="q4" value="کم" />
                    <label for="q4_opt4">کم</label>
                    <input type="radio" id="q4_opt5" name="q4" value="خیلی کم" />
                    <label for="q4_opt5">خیلی کم</label>
                    <input type="radio" id="q4_opt6" name="q4" value="نظری ندارم" />
                    <label for="q4_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 5: تامین خواسته های خود در خصوص تیپ، رنگ، آپشن و تزئینات</p>
                <div class="options">
                    <input type="radio" id="q5_opt1" name="q5" value="خیلی زیاد" />
                    <label for="q5_opt1">خیلی زیاد</label>
                    <input type="radio" id="q5_opt2" name="q5" value="زیاد" />
                    <label for="q5_opt2">زیاد</label>
                    <input type="radio" id="q5_opt3" name="q5" value="متوسط" />
                    <label for="q5_opt3">متوسط</label>
                    <input type="radio" id="q5_opt4" name="q5" value="کم" />
                    <label for="q5_opt4">کم</label>
                    <input type="radio" id="q5_opt5" name="q5" value="خیلی کم" />
                    <label for="q5_opt5">خیلی کم</label>
                    <input type="radio" id="q5_opt6" name="q5" value="نظری ندارم" />
                    <label for="q5_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>
                    سوال 6: مطابقت خودروی تحویلی با مشخصات تعیین شده در زمان ثبت نام
                </p>
                <div class="options">
                    <input type="radio" id="q6_opt1" name="q6" value="خیلی زیاد" />
                    <label for="q6_opt1">خیلی زیاد</label>
                    <input type="radio" id="q6_opt2" name="q6" value="زیاد" />
                    <label for="q6_opt2">زیاد</label>
                    <input type="radio" id="q6_opt3" name="q6" value="متوسط" />
                    <label for="q6_opt3">متوسط</label>
                    <input type="radio" id="q6_opt4" name="q6" value="کم" />
                    <label for="q6_opt4">کم</label>
                    <input type="radio" id="q6_opt5" name="q6" value="خیلی کم" />
                    <label for="q6_opt5">خیلی کم</label>
                    <input type="radio" id="q6_opt6" name="q6" value="نظری ندارم" />
                    <label for="q6_opt6">نظری ندارم</label>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">هزینه و زمان صرف شده</div>
            <div class="question">
                <p>سوال 7: مدت زمان صرف شده جهت مراحل اداری ثبت نام</p>
                <div class="options">
                    <input type="radio" id="q7_opt1" name="q7" value="خیلی زیاد" />
                    <label for="q7_opt1">خیلی زیاد</label>
                    <input type="radio" id="q7_opt2" name="q7" value="زیاد" />
                    <label for="q7_opt2">زیاد</label>
                    <input type="radio" id="q7_opt3" name="q7" value="متوسط" />
                    <label for="q7_opt3">متوسط</label>
                    <input type="radio" id="q7_opt4" name="q7" value="کم" />
                    <label for="q7_opt4">کم</label>
                    <input type="radio" id="q7_opt5" name="q7" value="خیلی کم" />
                    <label for="q7_opt5">خیلی کم</label>
                    <input type="radio" id="q7_opt6" name="q7" value="نظری ندارم" />
                    <label for="q7_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 8: تحویل خودرو در زمان مقرر طبق قرارداد خرید</p>
                <div class="options">
                    <input type="radio" id="q8_opt1" name="q8" value="خیلی زیاد" />
                    <label for="q8_opt1">خیلی زیاد</label>
                    <input type="radio" id="q8_opt2" name="q8" value="زیاد" />
                    <label for="q8_opt2">زیاد</label>
                    <input type="radio" id="q8_opt3" name="q8" value="متوسط" />
                    <label for="q8_opt3">متوسط</label>
                    <input type="radio" id="q8_opt4" name="q8" value="کم" />
                    <label for="q8_opt4">کم</label>
                    <input type="radio" id="q8_opt5" name="q8" value="خیلی کم" />
                    <label for="q8_opt5">خیلی کم</label>
                    <input type="radio" id="q8_opt6" name="q8" value="نظری ندارم" />
                    <label for="q8_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>
                    سوال 9: آیا سود مشارکت مجموعه تخفیفات و یا خسارت دیرکرد تحویل خودرو
                    به شما تعلق گرفت؟
                </p>
                <div class="options">
                    <input type="radio" id="q9_opt1" name="q9" value="خیلی زیاد" />
                    <label for="q9_opt1">خیلی زیاد</label>
                    <input type="radio" id="q9_opt2" name="q9" value="زیاد" />
                    <label for="q9_opt2">زیاد</label>
                    <input type="radio" id="q9_opt3" name="q9" value="متوسط" />
                    <label for="q9_opt3">متوسط</label>
                    <input type="radio" id="q9_opt4" name="q9" value="کم" />
                    <label for="q9_opt4">کم</label>
                    <input type="radio" id="q9_opt5" name="q9" value="خیلی کم" />
                    <label for="q9_opt5">خیلی کم</label>
                    <input type="radio" id="q9_opt6" name="q9" value="نظری ندارم" />
                    <label for="q9_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>
                    سوال 10: دریافت سود مشارکت مجموعه تخفیفات و یا خسارت دیرکرد تحویل
                    خودرو
                </p>
                <div class="options">
                    <input type="radio" id="q10_opt1" name="q10" value="خیلی زیاد" />
                    <label for="q10_opt1">خیلی زیاد</label>
                    <input type="radio" id="q10_opt2" name="q10" value="زیاد" />
                    <label for="q10_opt2">زیاد</label>
                    <input type="radio" id="q10_opt3" name="q10" value="متوسط" />
                    <label for="q10_opt3">متوسط</label>
                    <input type="radio" id="q10_opt4" name="q10" value="کم" />
                    <label for="q10_opt4">کم</label>
                    <input type="radio" id="q10_opt5" name="q10" value="خیلی کم" />
                    <label for="q10_opt5">خیلی کم</label>
                    <input type="radio" id="q10_opt6" name="q10" value="نظری ندارم" />
                    <label for="q10_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 11: تناسب هزینه پرداختی با خودروی خریداری شده</p>
                <div class="options">
                    <input type="radio" id="q11_opt1" name="q11" value="خیلی زیاد" />
                    <label for="q11_opt1">خیلی زیاد</label>
                    <input type="radio" id="q11_opt2" name="q11" value="زیاد" />
                    <label for="q11_opt2">زیاد</label>
                    <input type="radio" id="q11_opt3" name="q11" value="متوسط" />
                    <label for="q11_opt3">متوسط</label>
                    <input type="radio" id="q11_opt4" name="q11" value="کم" />
                    <label for="q11_opt4">کم</label>
                    <input type="radio" id="q11_opt5" name="q11" value="خیلی کم" />
                    <label for="q11_opt5">خیلی کم</label>
                    <input type="radio" id="q11_opt6" name="q11" value="نظری ندارم" />
                    <label for="q11_opt6">نظری ندارم</label>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">تحویل خودرو</div>
            <div class="question">
                <p>سوال 12: سهولت دسترسی به شبکه نمایندگی های فروش</p>
                <div class="options">
                    <input type="radio" id="q12_opt1" name="q12" value="خیلی زیاد" />
                    <label for="q12_opt1">خیلی زیاد</label>
                    <input type="radio" id="q12_opt2" name="q12" value="زیاد" />
                    <label for="q12_opt2">زیاد</label>
                    <input type="radio" id="q12_opt3" name="q12" value="متوسط" />
                    <label for="q12_opt3">متوسط</label>
                    <input type="radio" id="q12_opt4" name="q12" value="کم" />
                    <label for="q12_opt4">کم</label>
                    <input type="radio" id="q12_opt5" name="q12" value="خیلی کم" />
                    <label for="q12_opt5">خیلی کم</label>
                    <input type="radio" id="q12_opt6" name="q12" value="نظری ندارم" />
                    <label for="q12_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 13: تحویل متعلقات اضافی همراه خودرو (مطابق با ضوابط)</p>
                <div class="options">
                    <input type="radio" id="q13_opt1" name="q13" value="خیلی زیاد" />
                    <label for="q13_opt1">خیلی زیاد</label>
                    <input type="radio" id="q13_opt2" name="q13" value="زیاد" />
                    <label for="q13_opt2">زیاد</label>
                    <input type="radio" id="q13_opt3" name="q13" value="متوسط" />
                    <label for="q13_opt3">متوسط</label>
                    <input type="radio" id="q13_opt4" name="q13" value="کم" />
                    <label for="q13_opt4">کم</label>
                    <input type="radio" id="q13_opt5" name="q13" value="خیلی کم" />
                    <label for="q13_opt5">خیلی کم</label>
                    <input type="radio" id="q13_opt6" name="q13" value="نظری ندارم" />
                    <label for="q13_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 14: سلامت خودروی خود (عدم ایراد) در زمان تحویل</p>
                <div class="options">
                    <input type="radio" id="q14_opt1" name="q14" value="خیلی زیاد" />
                    <label for="q14_opt1">خیلی زیاد</label>
                    <input type="radio" id="q14_opt2" name="q14" value="زیاد" />
                    <label for="q14_opt2">زیاد</label>
                    <input type="radio" id="q14_opt3" name="q14" value="متوسط" />
                    <label for="q14_opt3">متوسط</label>
                    <input type="radio" id="q14_opt4" name="q14" value="کم" />
                    <label for="q14_opt4">کم</label>
                    <input type="radio" id="q14_opt5" name="q14" value="خیلی کم" />
                    <label for="q14_opt5">خیلی کم</label>
                    <input type="radio" id="q14_opt6" name="q14" value="نظری ندارم" />
                    <label for="q14_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 15: آیا خودروی شما در زمان تحویل ایراد فنی داشته است؟</p>
                <div class="options">
                    <input type="radio" id="q15_opt1" name="q15" value="خیلی زیاد" />
                    <label for="q15_opt1">خیلی زیاد</label>
                    <input type="radio" id="q15_opt2" name="q15" value="زیاد" />
                    <label for="q15_opt2">زیاد</label>
                    <input type="radio" id="q15_opt3" name="q15" value="متوسط" />
                    <label for="q15_opt3">متوسط</label>
                    <input type="radio" id="q15_opt4" name="q15" value="کم" />
                    <label for="q15_opt4">کم</label>
                    <input type="radio" id="q15_opt5" name="q15" value="خیلی کم" />
                    <label for="q15_opt5">خیلی کم</label>
                    <input type="radio" id="q15_opt6" name="q15" value="نظری ندارم" />
                    <label for="q15_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 16: رفع ایرادات احتمالی به هنگام تحویل خودرو</p>
                <div class="options">
                    <input type="radio" id="q16_opt1" name="q16" value="خیلی زیاد" />
                    <label for="q16_opt1">خیلی زیاد</label>
                    <input type="radio" id="q16_opt2" name="q16" value="زیاد" />
                    <label for="q16_opt2">زیاد</label>
                    <input type="radio" id="q16_opt3" name="q16" value="متوسط" />
                    <label for="q16_opt3">متوسط</label>
                    <input type="radio" id="q16_opt4" name="q16" value="کم" />
                    <label for="q16_opt4">کم</label>
                    <input type="radio" id="q16_opt5" name="q16" value="خیلی کم" />
                    <label for="q16_opt5">خیلی کم</label>
                    <input type="radio" id="q16_opt6" name="q16" value="نظری ندارم" />
                    <label for="q16_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>
                    سوال 17: وضعیت ظاهری خودرو در زمان تحویل از لحاظ تمیزی و پاکیزگی
                </p>
                <div class="options">
                    <input type="radio" id="q17_opt1" name="q17" value="خیلی زیاد" />
                    <label for="q17_opt1">خیلی زیاد</label>
                    <input type="radio" id="q17_opt2" name="q17" value="زیاد" />
                    <label for="q17_opt2">زیاد</label>
                    <input type="radio" id="q17_opt3" name="q17" value="متوسط" />
                    <label for="q17_opt3">متوسط</label>
                    <input type="radio" id="q17_opt4" name="q17" value="کم" />
                    <label for="q17_opt4">کم</label>
                    <input type="radio" id="q17_opt5" name="q17" value="خیلی کم" />
                    <label for="q17_opt5">خیلی کم</label>
                    <input type="radio" id="q17_opt6" name="q17" value="نظری ندارم" />
                    <label for="q17_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>
                    سوال 18: راهنمایی و نحوه آموزش استفاده از خودرو در زمان تحویل خودرو
                </p>
                <div class="options">
                    <input type="radio" id="q18_opt1" name="q18" value="خیلی زیاد" />
                    <label for="q18_opt1">خیلی زیاد</label>
                    <input type="radio" id="q18_opt2" name="q18" value="زیاد" />
                    <label for="q18_opt2">زیاد</label>
                    <input type="radio" id="q18_opt3" name="q18" value="متوسط" />
                    <label for="q18_opt3">متوسط</label>
                    <input type="radio" id="q18_opt4" name="q18" value="کم" />
                    <label for="q18_opt4">کم</label>
                    <input type="radio" id="q18_opt5" name="q18" value="خیلی کم" />
                    <label for="q18_opt5">خیلی کم</label>
                    <input type="radio" id="q18_opt6" name="q18" value="نظری ندارم" />
                    <label for="q18_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>
                    سوال 19: نحوه تحویل مدارک خودرو (شامل سند، بیمه، دفترچه گارانتی)
                </p>
                <div class="options">
                    <input type="radio" id="q19_opt1" name="q19" value="خیلی زیاد" />
                    <label for="q19_opt1">خیلی زیاد</label>
                    <input type="radio" id="q19_opt2" name="q19" value="زیاد" />
                    <label for="q19_opt2">زیاد</label>
                    <input type="radio" id="q19_opt3" name="q19" value="متوسط" />
                    <label for="q19_opt3">متوسط</label>
                    <input type="radio" id="q19_opt4" name="q19" value="کم" />
                    <label for="q19_opt4">کم</label>
                    <input type="radio" id="q19_opt5" name="q19" value="خیلی کم" />
                    <label for="q19_opt5">خیلی کم</label>
                    <input type="radio" id="q19_opt6" name="q19" value="نظری ندارم" />
                    <label for="q19_opt6">نظری ندارم</label>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">سوالات تکمیلی</div>
            <div class="question">
                <p>
                    سوال 20: آیا تمایل به خرید مجدد از خودروهای شرکت و یا معرفی آن به
                    دوستان و آشنایان برای خرید از این شرکت را دارید؟
                </p>
                <div class="options">
                    <input type="radio" id="q20_opt1" name="q20" value="خیلی زیاد" />
                    <label for="q20_opt1">خیلی زیاد</label>
                    <input type="radio" id="q20_opt2" name="q20" value="زیاد" />
                    <label for="q20_opt2">زیاد</label>
                    <input type="radio" id="q20_opt3" name="q20" value="متوسط" />
                    <label for="q20_opt3">متوسط</label>
                    <input type="radio" id="q20_opt4" name="q20" value="کم" />
                    <label for="q20_opt4">کم</label>
                    <input type="radio" id="q20_opt5" name="q20" value="خیلی کم" />
                    <label for="q20_opt5">خیلی کم</label>
                    <input type="radio" id="q20_opt6" name="q20" value="نظری ندارم" />
                    <label for="q20_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 21: بطور کلی تا چه میزان از فرآیند فروش رضایت دارید؟</p>
                <div class="options">
                    <input type="radio" id="q21_opt1" name="q21" value="خیلی زیاد" />
                    <label for="q21_opt1">خیلی زیاد</label>
                    <input type="radio" id="q21_opt2" name="q21" value="زیاد" />
                    <label for="q21_opt2">زیاد</label>
                    <input type="radio" id="q21_opt3" name="q21" value="متوسط" />
                    <label for="q21_opt3">متوسط</label>
                    <input type="radio" id="q21_opt4" name="q21" value="کم" />
                    <label for="q21_opt4">کم</label>
                    <input type="radio" id="q21_opt5" name="q21" value="خیلی کم" />
                    <label for="q21_opt5">خیلی کم</label>
                    <input type="radio" id="q21_opt6" name="q21" value="نظری ندارم" />
                    <label for="q21_opt6">نظری ندارم</label>
                </div>
            </div>
            <hr style="margin-block: 1rem; border-color: #fff" />
            <div class="question">
                <p>سوال 22: علت خرید و انتخاب خودرو:</p>
                <div class="options">
                    <input type="radio" id="q22_opt1" name="q22" value="قیمت" />
                    <label for="q22_opt1">قیمت</label>
                    <input
                        type="radio"
                        id="q22_opt2"
                        name="q22"
                        value="اعتماد به خودروساز"
                    />
                    <label for="q22_opt2">اعتماد به خودروساز</label>
                    <input type="radio" id="q22_opt3" name="q22" value="کیفیت" />
                    <label for="q22_opt3">کیفیت</label>
                    <input
                        type="radio"
                        id="q22_opt4"
                        name="q22"
                        value="خدمات پس از فروش"
                    />
                    <label for="q22_opt4">خدمات پس از فروش</label>
                    <input type="radio" id="q22_opt5" name="q22" value="سرمایه گذاری" />
                    <label for="q22_opt5">سرمایه گذاری</label>
                    <input type="radio" id="q22_opt6" name="q22" value="سایر" />
                    <label for="q22_opt6">سایر</label>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="question">
            <textarea
                name="textarea"
                id="textarea"
                style="
                width: 100%;
                height: 8rem;
                resize: vertical;
                border: 1px solid rgba(0, 0, 0, 0.1);
                padding: 0.5rem;
                font-size: 0.9rem;
              "
                placeholder="انتقادات و پیشنهادات: "
            ></textarea>
                </div>
            </div>
        </div>
        <div class="card client-info">
            <div class="card-header">مشخصات مشتری</div>
            <form id="survey-form">
                <div class="question">
                    <p>نام و نام خانوادگی:</p>
                    <input type="text" name="full_name" value="{{ auth()->user()->name ?? '' }}"/>
                </div>
                <div class="question">
                    <p>جنسیت:</p>
                    <select name="gender">
                        <option value="">انتخاب کنید</option>
                        <option value="مرد">مرد</option>
                        <option value="زن">زن</option>
                    </select>
                </div>
                <div class="question">
                    <p>سن:</p>
                    <select name="age">
                        <option value="">انتخاب کنید</option>
                        <option value="18-30">۱۸ تا ۳۰ سال</option>
                        <option value="31-45">۳۱ تا ۴۵ سال</option>
                        <option value="46-60">۴۶ تا ۶۰ سال</option>
                        <option value="61+">۶۱ به بالا</option>
                    </select>
                </div>
                <div class="question">
                    <p>میزان تحصیلات:</p>
                    <select name="education">
                        <option value="">انتخاب کنید</option>
                        <option value="زیر دیپلم">زیر دیپلم</option>
                        <option value="دیپلم">دیپلم</option>
                        <option value="فوق دیپلم">فوق دیپلم</option>
                        <option value="لیسانس">لیسانس</option>
                        <option value="فوق لیسانس و بالاتر">فوق لیسانس و بالاتر</option>
                    </select>
                </div>
                <div class="question">
                    <p>شهر محل سکونت:</p>
                    <input type="text" name="city" />
                </div>
                <div class="question">
                    <p>تلفن تماس:</p>
                    <input type="text" name="phone" value="{{ auth()->user()->number ?? '' }}"/>
                </div>
                <div class="question">
                    <p>نوع خودرو:</p>
                    <input type="text" name="car_type" />
                </div>
                <div class="question">
                    <p>شرکت سازنده:</p>
                    <input type="text" name="car_manufacturer" />
                </div>
                <div class="question">
                    <p>تاریخ خرید خودرو:</p>
                    <input type="text" name="purchase_date" />
                </div>
                <div class="question">
                    <p>خودروی قبلی:</p>
                    <input type="text" name="previous_car" />
                </div>
                <div class="question">
                    <p>نحوه خرید خودرو:</p>
                    <select name="purchase_method">
                        <option value="">انتخاب کنید</option>
                        <option value="نقدی">خرید نقدی</option>
                        <option value="لیزینگ">خرید لیزینگی</option>
                        <option value="سایر">سایر موارد</option>
                    </select>
                </div>
                <div class="btn-wrapper">
                    <button type="submit">ارسال</button>
                </div>
                <!--  -->
            </form>
        </div>
    </form>
@endsection
    @section('script1')
        <script>

        </script>
    @endsection
