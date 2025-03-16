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

        /* hr {
          margin-block: 1rem;
          border-color: #fff;
        } */

        hr {
            height: 1px;
            border: none;
            background: none;
            box-shadow: 0 1px 0px #dedee1;
            margin-block: 1rem;
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
    <h3 style="margin-top: 170px">پرسش نامه اندازه گیری رضایت مشتریان از خدمات پس از فروش</h3>
    <form id="survey-form" method="post" action="/form2">
        @csrf
        <input type="hidden" name="form" value="form2">
        <div class="card">
            <div class="card-header">اطلاع رسانی و پاسخ گویی</div>
            <div class="question">
                <p>سوال ۱: آیا شما از سیستم نوبت دهی نمایندگان استفاده کرده اید؟</p>
                <div class="options">
                    <input type="radio" id="q1_opt1" name="q1" value="بله" />
                    <label for="q1_opt1">بله</label>
                    <input type="radio" id="q1_opt2" name="q1" value="خیر" />
                    <label for="q1_opt2">خیر</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>سوال 2: میزان رضایت شما از نحوه نوبت دهی چقدر است؟</p>
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
                    سوال 3: تا چه میزان از مدت زمانی که برای پذیرش خودروی خود صرف نموده
                    آید ، رضایت دارید؟
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
            <hr />
            <div class="question">
                <p>
                    سوال 4: میزان رضایت مندی شما از ثبت ایرادات مطرح شده در زمان پذیرش
                    توسط پذیرشگر چقدر است؟
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
            <hr />
            <div class="question">
                <p>
                    سوال 5: از مدت زمان تعمیر و تحویل خودروی خود تا چه میزان رضایت
                    دارید؟
                </p>
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
            <hr />
            <div class="question">
                <p>سوال 6: خودرو رو چه زمانی به شما تحویل داده اند؟</p>
                <div class="options">
                    <input type="radio" id="q6_opt1" name="q6" value="همان روز" />
                    <label for="q6_opt1">همان روز</label>
                    <input type="radio" id="q6_opt2" name="q6" value="فردا" />
                    <label for="q6_opt2">فردا</label>
                    <input type="radio" id="q6_opt3" name="q6" value="چند روز بعد" />
                    <label for="q6_opt3">چند روز بعد</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>سوال 7: آیا تمام عیوب را برطرف کرده بودند؟</p>
                <div class="options">
                    <input type="radio" id="q7_opt1" name="q7" value="بله" />
                    <label for="q7_opt1">بله</label>
                    <input type="radio" id="q7_opt2" name="q7" value="خیر" />
                    <label for="q7_opt2">خیر</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>
                    سوال 8: از نحوه ارایه سرویس های ادواری این نمایندگی تا چه میزان
                    رضایت دارید؟
                </p>
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
            <hr />
            <div class="question">
                <p>
                    سوال 9: میزان رضایت شما از کیفیت تعمیرات ارائه شده توسط این نمایندگی
                    چقدر است؟
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
            <hr />
            <div class="question">
                <p>سوال 10: برای تعمیر خودرویتان قطعه ای نیاز بود؟</p>
                <div class="options">
                    <input type="radio" id="q10_opt1" name="q10" value="بله" />
                    <label for="q10_opt1">بله</label>
                    <input type="radio" id="q10_opt2" name="q10" value="خیر" />
                    <label for="q10_opt2">خیر</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>
                    سوال 11: از تامین به موقع قطعات مورد نیاز در تعمیر خودرو خود تا چه
                    میزان رضایت دارید؟
                </p>
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
            <hr />
            <div class="question">
                <p>سوال 12: آیا صورتحساب تعمیرات ( فاکتور) برای شما ارائه شد؟</p>
                <div class="options">
                    <input type="radio" id="q12_opt1" name="q12" value="بله" />
                    <label for="q12_opt1">بله</label>
                    <input type="radio" id="q12_opt2" name="q12" value="خیر" />
                    <label for="q12_opt2">خیر</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>
                    سوال 13: آیا در این مراجعه هزینه ای بابت خدمات ارائه شده پرداخت
                    نمودید ؟
                </p>
                <div class="options">
                    <input type="radio" id="q13_opt1" name="q13" value="بله" />
                    <label for="q13_opt1">بله</label>
                    <input type="radio" id="q13_opt2" name="q13" value="خیر" />
                    <label for="q13_opt2">خیر</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>سوال 14: هزینه پرداختی برای کدام مورد بود؟</p>
                <div class="options">
                    <input type="radio" id="q14_opt1" name="q14" value="اجرت" />
                    <label for="q14_opt1">اجرت</label>
                    <input type="radio" id="q14_opt2" name="q14" value="تعویض قطعات" />
                    <label for="q14_opt2">تعویض قطعات</label>
                    <input type="radio" id="q14_opt3" name="q14" value="هردو" />
                    <label for="q14_opt3">هردو</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>
                    سوال 15: از هزینه پرداختی برای ( قطعه ، اجرت ) برای خدمات انجام شده
                    تا چه میزان رضایت دارید؟
                </p>
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
            <hr />
            <div class="question">
                <p>
                    سوال 16: از توضیحات ارائه شده هنگام ترخیص خودرو و در خصوص کارهای
                    انجام شده و قطعات تعویضی تا چه میزان رضایت دارید؟
                </p>
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
            <hr />
            <div class="question">
                <p>
                    سوال 17: از رفتار و برخورد پرسنل تعمیرگاه تا چه میزان رضایت دارید؟
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
            <hr />
            <div class="question">
                <p>
                    سوال 18: آیا در سه ماه گذشته به نمایندگی مراجعه نموده اید که
                    نمایندگی از پذیرش خودروی شما جلوگیری کند؟
                </p>
                <div class="options">
                    <input type="radio" id="q18_opt1" name="q18" value="بله" />
                    <label for="q18_opt1">بله</label>
                    <input type="radio" id="q18_opt2" name="q18" value="خیر" />
                    <label for="q18_opt2">خیر</label>
                </div>
            </div>
            <hr />
            <div class="question">
                <p>سوال 19: از سهولت دسترسی به نمایندگی این شرکت چقدر رضایت دارید؟</p>
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
            <hr />
            <div class="question">
                <p>
                    سوال 20: به طور کلی تا چه میزان از خدمات پس از فروش ارائه شده رضایت
                    دارید؟
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
            <hr />
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
                    <p>وضعیت خرید خودرو:</p>
                    <select name="purchase_method">
                        <option value="">انتخاب کنید</option>
                        <option value="گارانتی">گارانتی</option>
                        <option value="وارانتی">وارانتی</option>
                    </select>
                </div>
                <div class="btn-wrapper">
                    <button type="submit">ارسال</button>
                </div>
            </form>
        </div>
    </form>
@endsection
    @section('script1')
        <script>

        </script>
    @endsection
