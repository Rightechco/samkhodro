@extends('admin.master')

@section('title' , 'همه پرسش نامه ها')
@section('tab',28)
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
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
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

        }

        .card.client-info .card-header {
            grid-column: 1 / -1;
        }

        .card.client-info .question {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 30%;
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
    @php
    $json = json_decode($form->json);
    @endphp
    <div class="allLicence">
        <div class="topLicenceIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/form">همه پرسش نامه ها</a>
            </div>
            <div class="allTopTableItem">
            </div>
        </div>
        @if($form->formID == 'form1')
            <div class="card">
                <div class="card-header">اطلاع رسانی و پاسخ گویی</div>
                <div class="question">
                    <p>
                        سوال ۱: نحوه اطلاع رسانی شرکت در مورد شرایط فروش، پیگیری خرید، زمان
                        تحویل خودرو و...
                    </p>
                    <div class="options">
                        <input type="radio" id="q1_opt1" name="q1" @if($json->q1 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q1_opt1">خیلی زیاد</label>
                        <input type="radio" id="q1_opt2" name="q1" @if($json->q1 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q1_opt2">زیاد</label>
                        <input type="radio" id="q1_opt3" name="q1" @if($json->q1 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q1_opt3">متوسط</label>
                        <input type="radio" id="q1_opt4" name="q1" @if($json->q1 == 'کم') checked @endif value="کم" />
                        <label for="q1_opt4">کم</label>
                        <input type="radio" id="q1_opt5" name="q1" @if($json->q1 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q1_opt5">خیلی کم</label>
                        <input type="radio" id="q1_opt6" name="q1" @if($json->q1 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q1_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>
                        سوال 2: برخورد و پاسخگویی کارکنان ستاد مرکزی و نمایندگی های فروش
                    </p>
                    <div class="options">
                        <input type="radio" id="q2_opt1" name="q2" @if($json->q2 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q2_opt1">خیلی زیاد</label>
                        <input type="radio" id="q2_opt2" name="q2" @if($json->q2 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q2_opt2">زیاد</label>
                        <input type="radio" id="q2_opt3" name="q2" @if($json->q2 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q2_opt3">متوسط</label>
                        <input type="radio" id="q2_opt4" name="q2" @if($json->q2 == 'کم') checked @endif value="کم" />
                        <label for="q2_opt4">کم</label>
                        <input type="radio" id="q2_opt5" name="q2" @if($json->q2 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q2_opt5">خیلی کم</label>
                        <input type="radio" id="q2_opt6" name="q2" @if($json->q2 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q3_opt1" name="q3" @if($json->q3 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q3_opt1">خیلی زیاد</label>
                        <input type="radio" id="q3_opt2" name="q3" @if($json->q3 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q3_opt2">زیاد</label>
                        <input type="radio" id="q3_opt3" name="q3" @if($json->q3 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q3_opt3">متوسط</label>
                        <input type="radio" id="q3_opt4" name="q3" @if($json->q3 == 'کم') checked @endif value="کم" />
                        <label for="q3_opt4">کم</label>
                        <input type="radio" id="q3_opt5" name="q3" @if($json->q3 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q3_opt5">خیلی کم</label>
                        <input type="radio" id="q3_opt6" name="q3" @if($json->q3 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q4_opt1" name="q4" @if($json->q4 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q4_opt1">خیلی زیاد</label>
                        <input type="radio" id="q4_opt2" name="q4" @if($json->q4 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q4_opt2">زیاد</label>
                        <input type="radio" id="q4_opt3" name="q4" @if($json->q4 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q4_opt3">متوسط</label>
                        <input type="radio" id="q4_opt4" name="q4" @if($json->q4 == 'کم') checked @endif value="کم" />
                        <label for="q4_opt4">کم</label>
                        <input type="radio" id="q4_opt5" name="q4" @if($json->q4 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q4_opt5">خیلی کم</label>
                        <input type="radio" id="q4_opt6" name="q4" @if($json->q4 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q4_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 5: تامین خواسته های خود در خصوص تیپ، رنگ، آپشن و تزئینات</p>
                    <div class="options">
                        <input type="radio" id="q5_opt1" name="q5" @if($json->q5 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q5_opt1">خیلی زیاد</label>
                        <input type="radio" id="q5_opt2" name="q5" @if($json->q5 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q5_opt2">زیاد</label>
                        <input type="radio" id="q5_opt3" name="q5" @if($json->q5 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q5_opt3">متوسط</label>
                        <input type="radio" id="q5_opt4" name="q5" @if($json->q5 == 'کم') checked @endif value="کم" />
                        <label for="q5_opt4">کم</label>
                        <input type="radio" id="q5_opt5" name="q5" @if($json->q5 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q5_opt5">خیلی کم</label>
                        <input type="radio" id="q5_opt6" name="q5" @if($json->q5 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q5_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>
                        سوال 6: مطابقت خودروی تحویلی با مشخصات تعیین شده در زمان ثبت نام
                    </p>
                    <div class="options">
                        <input type="radio" id="q6_opt1" name="q6" @if($json->q6 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q6_opt1">خیلی زیاد</label>
                        <input type="radio" id="q6_opt2" name="q6" @if($json->q6 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q6_opt2">زیاد</label>
                        <input type="radio" id="q6_opt3" name="q6" @if($json->q6 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q6_opt3">متوسط</label>
                        <input type="radio" id="q6_opt4" name="q6" @if($json->q6 == 'کم') checked @endif value="کم" />
                        <label for="q6_opt4">کم</label>
                        <input type="radio" id="q6_opt5" name="q6" @if($json->q6 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q6_opt5">خیلی کم</label>
                        <input type="radio" id="q6_opt6" name="q6" @if($json->q6 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q6_opt6">نظری ندارم</label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">هزینه و زمان صرف شده</div>
                <div class="question">
                    <p>سوال 7: مدت زمان صرف شده جهت مراحل اداری ثبت نام</p>
                    <div class="options">
                        <input type="radio" id="q7_opt1" name="q7" @if($json->q7 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q7_opt1">خیلی زیاد</label>
                        <input type="radio" id="q7_opt2" name="q7" @if($json->q7 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q7_opt2">زیاد</label>
                        <input type="radio" id="q7_opt3" name="q7" @if($json->q7 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q7_opt3">متوسط</label>
                        <input type="radio" id="q7_opt4" name="q7" @if($json->q7 == 'کم') checked @endif value="کم" />
                        <label for="q7_opt4">کم</label>
                        <input type="radio" id="q7_opt5" name="q7" @if($json->q7 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q7_opt5">خیلی کم</label>
                        <input type="radio" id="q7_opt6" name="q7" @if($json->q7 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q7_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 8: تحویل خودرو در زمان مقرر طبق قرارداد خرید</p>
                    <div class="options">
                        <input type="radio" id="q8_opt1" name="q8" @if($json->q8 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q8_opt1">خیلی زیاد</label>
                        <input type="radio" id="q8_opt2" name="q8" @if($json->q8 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q8_opt2">زیاد</label>
                        <input type="radio" id="q8_opt3" name="q8" @if($json->q8 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q8_opt3">متوسط</label>
                        <input type="radio" id="q8_opt4" name="q8" @if($json->q8 == 'کم') checked @endif value="کم" />
                        <label for="q8_opt4">کم</label>
                        <input type="radio" id="q8_opt5" name="q8" @if($json->q8 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q8_opt5">خیلی کم</label>
                        <input type="radio" id="q8_opt6" name="q8" @if($json->q8 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q9_opt1" name="q9" @if($json->q9 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q9_opt1">خیلی زیاد</label>
                        <input type="radio" id="q9_opt2" name="q9" @if($json->q9 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q9_opt2">زیاد</label>
                        <input type="radio" id="q9_opt3" name="q9" @if($json->q9 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q9_opt3">متوسط</label>
                        <input type="radio" id="q9_opt4" name="q9" @if($json->q9 == 'کم') checked @endif value="کم" />
                        <label for="q9_opt4">کم</label>
                        <input type="radio" id="q9_opt5" name="q9" @if($json->q9 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q9_opt5">خیلی کم</label>
                        <input type="radio" id="q9_opt6" name="q9" @if($json->q9 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q10_opt1" name="q10" @if($json->q10 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q10_opt1">خیلی زیاد</label>
                        <input type="radio" id="q10_opt2" name="q10" @if($json->q10 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q10_opt2">زیاد</label>
                        <input type="radio" id="q10_opt3" name="q10" @if($json->q10 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q10_opt3">متوسط</label>
                        <input type="radio" id="q10_opt4" name="q10" @if($json->q10 == 'کم') checked @endif value="کم" />
                        <label for="q10_opt4">کم</label>
                        <input type="radio" id="q10_opt5" name="q10" @if($json->q10 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q10_opt5">خیلی کم</label>
                        <input type="radio" id="q10_opt6" name="q10" @if($json->q10 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q10_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 11: تناسب هزینه پرداختی با خودروی خریداری شده</p>
                    <div class="options">
                        <input type="radio" id="q11_opt1" name="q11" @if($json->q11 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q11_opt1">خیلی زیاد</label>
                        <input type="radio" id="q11_opt2" name="q11" @if($json->q11 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q11_opt2">زیاد</label>
                        <input type="radio" id="q11_opt3" name="q11" @if($json->q11 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q11_opt3">متوسط</label>
                        <input type="radio" id="q11_opt4" name="q11" @if($json->q11 == 'کم') checked @endif value="کم" />
                        <label for="q11_opt4">کم</label>
                        <input type="radio" id="q11_opt5" name="q11" @if($json->q11 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q11_opt5">خیلی کم</label>
                        <input type="radio" id="q11_opt6" name="q11" @if($json->q11 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q11_opt6">نظری ندارم</label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">تحویل خودرو</div>
                <div class="question">
                    <p>سوال 12: سهولت دسترسی به شبکه نمایندگی های فروش</p>
                    <div class="options">
                        <input type="radio" id="q12_opt1" name="q12" @if($json->q12 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q12_opt1">خیلی زیاد</label>
                        <input type="radio" id="q12_opt2" name="q12" @if($json->q12 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q12_opt2">زیاد</label>
                        <input type="radio" id="q12_opt3" name="q12" @if($json->q12 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q12_opt3">متوسط</label>
                        <input type="radio" id="q12_opt4" name="q12" @if($json->q12 == 'کم') checked @endif value="کم" />
                        <label for="q12_opt4">کم</label>
                        <input type="radio" id="q12_opt5" name="q12" @if($json->q12 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q12_opt5">خیلی کم</label>
                        <input type="radio" id="q12_opt6" name="q12" @if($json->q12 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q12_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 13: تحویل متعلقات اضافی همراه خودرو (مطابق با ضوابط)</p>
                    <div class="options">
                        <input type="radio" id="q13_opt1" name="q13" @if($json->q13 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q13_opt1">خیلی زیاد</label>
                        <input type="radio" id="q13_opt2" name="q13" @if($json->q13 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q13_opt2">زیاد</label>
                        <input type="radio" id="q13_opt3" name="q13" @if($json->q13 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q13_opt3">متوسط</label>
                        <input type="radio" id="q13_opt4" name="q13" @if($json->q13 == 'کم') checked @endif value="کم" />
                        <label for="q13_opt4">کم</label>
                        <input type="radio" id="q13_opt5" name="q13" @if($json->q13 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q13_opt5">خیلی کم</label>
                        <input type="radio" id="q13_opt6" name="q13" @if($json->q13 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q13_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 14: سلامت خودروی خود (عدم ایراد) در زمان تحویل</p>
                    <div class="options">
                        <input type="radio" id="q14_opt1" name="q14" @if($json->q14 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q14_opt1">خیلی زیاد</label>
                        <input type="radio" id="q14_opt2" name="q14" @if($json->q14 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q14_opt2">زیاد</label>
                        <input type="radio" id="q14_opt3" name="q14" @if($json->q14 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q14_opt3">متوسط</label>
                        <input type="radio" id="q14_opt4" name="q14" @if($json->q14 == 'کم') checked @endif value="کم" />
                        <label for="q14_opt4">کم</label>
                        <input type="radio" id="q14_opt5" name="q14" @if($json->q14 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q14_opt5">خیلی کم</label>
                        <input type="radio" id="q14_opt6" name="q14" @if($json->q14 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q14_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 15: آیا خودروی شما در زمان تحویل ایراد فنی داشته است؟</p>
                    <div class="options">
                        <input type="radio" id="q15_opt1" name="q15" @if($json->q15 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q15_opt1">خیلی زیاد</label>
                        <input type="radio" id="q15_opt2" name="q15" @if($json->q15 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q15_opt2">زیاد</label>
                        <input type="radio" id="q15_opt3" name="q15" @if($json->q15 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q15_opt3">متوسط</label>
                        <input type="radio" id="q15_opt4" name="q15" @if($json->q15 == 'کم') checked @endif value="کم" />
                        <label for="q15_opt4">کم</label>
                        <input type="radio" id="q15_opt5" name="q15" @if($json->q15 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q15_opt5">خیلی کم</label>
                        <input type="radio" id="q15_opt6" name="q15" @if($json->q15 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q15_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 16: رفع ایرادات احتمالی به هنگام تحویل خودرو</p>
                    <div class="options">
                        <input type="radio" id="q16_opt1" name="q16" @if($json->q16 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q16_opt1">خیلی زیاد</label>
                        <input type="radio" id="q16_opt2" name="q16" @if($json->q16 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q16_opt2">زیاد</label>
                        <input type="radio" id="q16_opt3" name="q16" @if($json->q16 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q16_opt3">متوسط</label>
                        <input type="radio" id="q16_opt4" name="q16" @if($json->q16 == 'کم') checked @endif value="کم" />
                        <label for="q16_opt4">کم</label>
                        <input type="radio" id="q16_opt5" name="q16" @if($json->q16 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q16_opt5">خیلی کم</label>
                        <input type="radio" id="q16_opt6" name="q16" @if($json->q16 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q16_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>
                        سوال 17: وضعیت ظاهری خودرو در زمان تحویل از لحاظ تمیزی و پاکیزگی
                    </p>
                    <div class="options">
                        <input type="radio" id="q17_opt1" name="q17" @if($json->q17 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q17_opt1">خیلی زیاد</label>
                        <input type="radio" id="q17_opt2" name="q17" @if($json->q17 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q17_opt2">زیاد</label>
                        <input type="radio" id="q17_opt3" name="q17" @if($json->q17 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q17_opt3">متوسط</label>
                        <input type="radio" id="q17_opt4" name="q17" @if($json->q17 == 'کم') checked @endif value="کم" />
                        <label for="q17_opt4">کم</label>
                        <input type="radio" id="q17_opt5" name="q17" @if($json->q17 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q17_opt5">خیلی کم</label>
                        <input type="radio" id="q17_opt6" name="q17" @if($json->q17 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q17_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>
                        سوال 18: راهنمایی و نحوه آموزش استفاده از خودرو در زمان تحویل خودرو
                    </p>
                    <div class="options">
                        <input type="radio" id="q18_opt1" name="q18" @if($json->q18 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q18_opt1">خیلی زیاد</label>
                        <input type="radio" id="q18_opt2" name="q18" @if($json->q18 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q18_opt2">زیاد</label>
                        <input type="radio" id="q18_opt3" name="q18" @if($json->q18 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q18_opt3">متوسط</label>
                        <input type="radio" id="q18_opt4" name="q18" @if($json->q18 == 'کم') checked @endif value="کم" />
                        <label for="q18_opt4">کم</label>
                        <input type="radio" id="q18_opt5" name="q18" @if($json->q18 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q18_opt5">خیلی کم</label>
                        <input type="radio" id="q18_opt6" name="q18" @if($json->q18 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q18_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>
                        سوال 19: نحوه تحویل مدارک خودرو (شامل سند، بیمه، دفترچه گارانتی)
                    </p>
                    <div class="options">
                        <input type="radio" id="q19_opt1" name="q19" @if($json->q19 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q19_opt1">خیلی زیاد</label>
                        <input type="radio" id="q19_opt2" name="q19" @if($json->q19 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q19_opt2">زیاد</label>
                        <input type="radio" id="q19_opt3" name="q19" @if($json->q19 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q19_opt3">متوسط</label>
                        <input type="radio" id="q19_opt4" name="q19" @if($json->q19 == 'کم') checked @endif value="کم" />
                        <label for="q19_opt4">کم</label>
                        <input type="radio" id="q19_opt5" name="q19" @if($json->q19 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q19_opt5">خیلی کم</label>
                        <input type="radio" id="q19_opt6" name="q19" @if($json->q19 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q20_opt1" name="q20" @if($json->q20 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q20_opt1">خیلی زیاد</label>
                        <input type="radio" id="q20_opt2" name="q20" @if($json->q20 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q20_opt2">زیاد</label>
                        <input type="radio" id="q20_opt3" name="q20" @if($json->q20 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q20_opt3">متوسط</label>
                        <input type="radio" id="q20_opt4" name="q20" @if($json->q20 == 'کم') checked @endif value="کم" />
                        <label for="q20_opt4">کم</label>
                        <input type="radio" id="q20_opt5" name="q20" @if($json->q20 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q20_opt5">خیلی کم</label>
                        <input type="radio" id="q20_opt6" name="q20" @if($json->q20 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q20_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 21: بطور کلی تا چه میزان از فرآیند فروش رضایت دارید؟</p>
                    <div class="options">
                        <input type="radio" id="q21_opt1" name="q21" @if($json->q21 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q21_opt1">خیلی زیاد</label>
                        <input type="radio" id="q21_opt2" name="q21" @if($json->q21 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q21_opt2">زیاد</label>
                        <input type="radio" id="q21_opt3" name="q21" @if($json->q21 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q21_opt3">متوسط</label>
                        <input type="radio" id="q21_opt4" name="q21" @if($json->q21 == 'کم') checked @endif value="کم" />
                        <label for="q21_opt4">کم</label>
                        <input type="radio" id="q21_opt5" name="q21" @if($json->q21 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q21_opt5">خیلی کم</label>
                        <input type="radio" id="q21_opt6" name="q21" @if($json->q21 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q21_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr style="margin-block: 1rem; border-color: #fff" />
                <div class="question">
                    <p>سوال 22: علت خرید و انتخاب خودرو:</p>
                    <div class="options">
                        <input type="radio" id="q22_opt1" name="q22" @if($json->q22 == 'قیمت') checked @endif value="قیمت" />
                        <label for="q22_opt1">قیمت</label>
                        <input type="radio" id="q22_opt2" name="q22" @if($json->q22 == 'اعتماد به خودروساز') checked @endif value="اعتماد به خودروساز"/>
                        <label for="q22_opt2">اعتماد به خودروساز</label>
                        <input type="radio" id="q22_opt3" name="q22" @if($json->q22 == 'کیفیت') checked @endif value="کیفیت" />
                        <label for="q22_opt3">کیفیت</label>
                        <input type="radio" id="q22_opt4" name="q22" @if($json->q22 == 'خدمات پس از فروش') checked @endif value="خدمات پس از فروش"/>
                        <label for="q22_opt4">خدمات پس از فروش</label>
                        <input type="radio" id="q22_opt5" name="q22" @if($json->q22 == 'سرمایه گذاری') checked @endif value="سرمایه گذاری" />
                        <label for="q22_opt5">سرمایه گذاری</label>
                        <input type="radio" id="q22_opt6" name="q22" @if($json->q22 == 'سایر') checked @endif value="سایر" />
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
            >{{ $json->textarea ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card client-info">
                <div class="card-header">مشخصات مشتری</div>
                <form id="survey-form">
                    <div class="question">
                        <p>نام و نام خانوادگی:</p>
                        <input type="text" name="full_name" value="{{ $json->full_name ?? '' }}"/>
                    </div>
                    <div class="question">
                        <p>جنسیت:</p>
                        <select name="gender">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->gender == 'مرد') selected @endif value="مرد">مرد</option>
                            <option @if($json->gender == 'زن') selected @endif value="زن">زن</option>
                        </select>
                    </div>
                    <div class="question">
                        <p>سن:</p>
                        <select name="age">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->age == '18-30') selected @endif value="18-30">۱۸ تا ۳۰ سال</option>
                            <option @if($json->age == '31-45') selected @endif value="31-45">۳۱ تا ۴۵ سال</option>
                            <option @if($json->age == '46-60') selected @endif value="46-60">۴۶ تا ۶۰ سال</option>
                            <option @if($json->age == '61+') selected @endif value="61+">۶۱ به بالا</option>
                        </select>
                    </div>
                    <div class="question">
                        <p>میزان تحصیلات:</p>
                        <select name="education">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->education == 'زیر دیپلم') selected @endif value="زیر دیپلم">زیر دیپلم</option>
                            <option @if($json->education == 'دیپلم') selected @endif value="دیپلم">دیپلم</option>
                            <option @if($json->education == 'فوق دیپلم') selected @endif value="فوق دیپلم">فوق دیپلم</option>
                            <option @if($json->education == 'لیسانس') selected @endif value="لیسانس">لیسانس</option>
                            <option @if($json->education == 'فوق لیسانس و بالاتر') selected @endif value="فوق لیسانس و بالاتر">فوق لیسانس و بالاتر</option>
                        </select>
                    </div>
                    <div class="question">
                        <p>شهر محل سکونت:</p>
                        <input type="text" name="city" value="{{ $json->city ?? '' }}"/>
                    </div>
                    <div class="question">
                        <p>تلفن تماس:</p>
                        <input type="text" name="phone" value="{{ $json->phone ?? '' }}"/>
                    </div>
                    <div class="question">
                        <p>نوع خودرو:</p>
                        <input type="text" name="car_type" value="{{ $json->car_type }}" />
                    </div>
                    <div class="question">
                        <p>شرکت سازنده:</p>
                        <input type="text" name="car_manufacturer" value="{{ $json->car_manufacturer }}"/>
                    </div>
                    <div class="question">
                        <p>تاریخ خرید خودرو:</p>
                        <input type="text" name="purchase_date" value="{{ $json->purchase_date }}"/>
                    </div>
                    <div class="question">
                        <p>خودروی قبلی:</p>
                        <input type="text" name="previous_car" value="{{ $json->previous_car }}" />
                    </div>
                    <div class="question">
                        <p>نحوه خرید خودرو:</p>
                        <select name="purchase_method">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->purchase_method == 'نقدی') selected @endif value="نقدی">خرید نقدی</option>
                            <option @if($json->purchase_method == 'لیزینگ') selected @endif value="لیزینگ">خرید لیزینگی</option>
                            <option @if($json->purchase_method == 'سایر') selected @endif value="سایر">سایر موارد</option>
                        </select>
                    </div>
                    <!--  -->
                </form>
            </div>
        @elseif($form->formID == 'form2')
            <div class="card">
                <div class="card-header">اطلاع رسانی و پاسخ گویی</div>
                <div class="question">
                    <p>سوال ۱: آیا شما از سیستم نوبت دهی نمایندگان استفاده کرده اید؟</p>
                    <div class="options">
                        <input type="radio" id="q1_opt1" name="q1" @if($json->q1 == 'بله') checked @endif value="بله" />
                        <label for="q1_opt1">بله</label>
                        <input type="radio" id="q1_opt2" name="q1" @if($json->q1 == 'خیر') checked @endif value="خیر" />
                        <label for="q1_opt2">خیر</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 2: میزان رضایت شما از نحوه نوبت دهی چقدر است؟</p>
                    <div class="options">
                        <input type="radio" id="q2_opt1" name="q2" @if($json->q2 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q2_opt1">خیلی زیاد</label>
                        <input type="radio" id="q2_opt2" name="q2" @if($json->q2 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q2_opt2">زیاد</label>
                        <input type="radio" id="q2_opt3" name="q2" @if($json->q2 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q2_opt3">متوسط</label>
                        <input type="radio" id="q2_opt4" name="q2" @if($json->q2 == 'کم') checked @endif value="کم" />
                        <label for="q2_opt4">کم</label>
                        <input type="radio" id="q2_opt5" name="q2" @if($json->q2 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q2_opt5">خیلی کم</label>
                        <input type="radio" id="q2_opt6" name="q2" @if($json->q2 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q3_opt1" name="q3" @if($json->q3 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q3_opt1">خیلی زیاد</label>
                        <input type="radio" id="q3_opt2" name="q3" @if($json->q3 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q3_opt2">زیاد</label>
                        <input type="radio" id="q3_opt3" name="q3" @if($json->q3 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q3_opt3">متوسط</label>
                        <input type="radio" id="q3_opt4" name="q3" @if($json->q3 == 'کم') checked @endif value="کم" />
                        <label for="q3_opt4">کم</label>
                        <input type="radio" id="q3_opt5" name="q3" @if($json->q3 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q3_opt5">خیلی کم</label>
                        <input type="radio" id="q3_opt6" name="q3" @if($json->q3 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q4_opt1" name="q4" @if($json->q4 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q4_opt1">خیلی زیاد</label>
                        <input type="radio" id="q4_opt2" name="q4" @if($json->q4 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q4_opt2">زیاد</label>
                        <input type="radio" id="q4_opt3" name="q4" @if($json->q4 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q4_opt3">متوسط</label>
                        <input type="radio" id="q4_opt4" name="q4" @if($json->q4 == 'کم') checked @endif value="کم" />
                        <label for="q4_opt4">کم</label>
                        <input type="radio" id="q4_opt5" name="q4" @if($json->q4 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q4_opt5">خیلی کم</label>
                        <input type="radio" id="q4_opt6" name="q4" @if($json->q4 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q5_opt1" name="q5" @if($json->q5 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q5_opt1">خیلی زیاد</label>
                        <input type="radio" id="q5_opt2" name="q5" @if($json->q5 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q5_opt2">زیاد</label>
                        <input type="radio" id="q5_opt3" name="q5" @if($json->q5 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q5_opt3">متوسط</label>
                        <input type="radio" id="q5_opt4" name="q5" @if($json->q5 == 'کم') checked @endif value="کم" />
                        <label for="q5_opt4">کم</label>
                        <input type="radio" id="q5_opt5" name="q5" @if($json->q5 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q5_opt5">خیلی کم</label>
                        <input type="radio" id="q5_opt6" name="q5" @if($json->q5 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q5_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 6: خودرو رو چه زمانی به شما تحویل داده اند؟</p>
                    <div class="options">
                        <input type="radio" id="q6_opt1" name="q6" @if($json->q6 == 'همان روز') checked @endif value="همان روز" />
                        <label for="q6_opt1">همان روز</label>
                        <input type="radio" id="q6_opt2" name="q6" @if($json->q6 == 'فردا') checked @endif value="فردا" />
                        <label for="q6_opt2">فردا</label>
                        <input type="radio" id="q6_opt3" name="q6" @if($json->q6 == 'چند روز بعد') checked @endif value="چند روز بعد" />
                        <label for="q6_opt3">چند روز بعد</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 7: آیا تمام عیوب را برطرف کرده بودند؟</p>
                    <div class="options">
                        <input type="radio" id="q7_opt1" name="q7" @if($json->q7 == 'بله') checked @endif value="بله" />
                        <label for="q7_opt1">بله</label>
                        <input type="radio" id="q7_opt2" name="q7" @if($json->q7 == 'خیر') checked @endif value="خیر" />
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
                        <input type="radio" id="q8_opt1" name="q8" @if($json->q8 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q8_opt1">خیلی زیاد</label>
                        <input type="radio" id="q8_opt2" name="q8" @if($json->q8 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q8_opt2">زیاد</label>
                        <input type="radio" id="q8_opt3" name="q8" @if($json->q8 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q8_opt3">متوسط</label>
                        <input type="radio" id="q8_opt4" name="q8" @if($json->q8 == 'کم') checked @endif value="کم" />
                        <label for="q8_opt4">کم</label>
                        <input type="radio" id="q8_opt5" name="q8" @if($json->q8 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q8_opt5">خیلی کم</label>
                        <input type="radio" id="q8_opt6" name="q8" @if($json->q8 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q9_opt1" name="q9" @if($json->q9 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q9_opt1">خیلی زیاد</label>
                        <input type="radio" id="q9_opt2" name="q9" @if($json->q9 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q9_opt2">زیاد</label>
                        <input type="radio" id="q9_opt3" name="q9" @if($json->q9 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q9_opt3">متوسط</label>
                        <input type="radio" id="q9_opt4" name="q9" @if($json->q9 == 'کم') checked @endif value="کم" />
                        <label for="q9_opt4">کم</label>
                        <input type="radio" id="q9_opt5" name="q9" @if($json->q9 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q9_opt5">خیلی کم</label>
                        <input type="radio" id="q9_opt6" name="q9" @if($json->q9 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q9_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 10: برای تعمیر خودرویتان قطعه ای نیاز بود؟</p>
                    <div class="options">
                        <input type="radio" id="q10_opt1" name="q10" @if($json->q10 == 'بله') checked @endif value="بله" />
                        <label for="q10_opt1">بله</label>
                        <input type="radio" id="q10_opt2" name="q10" @if($json->q10 == 'خیر') checked @endif value="خیر" />
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
                        <input type="radio" id="q11_opt1" name="q11" @if($json->q11 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q11_opt1">خیلی زیاد</label>
                        <input type="radio" id="q11_opt2" name="q11" @if($json->q11 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q11_opt2">زیاد</label>
                        <input type="radio" id="q11_opt3" name="q11" @if($json->q11 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q11_opt3">متوسط</label>
                        <input type="radio" id="q11_opt4" name="q11" @if($json->q11 == 'کم') checked @endif value="کم" />
                        <label for="q11_opt4">کم</label>
                        <input type="radio" id="q11_opt5" name="q11" @if($json->q11 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q11_opt5">خیلی کم</label>
                        <input type="radio" id="q11_opt6" name="q11" @if($json->q11 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q11_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 12: آیا صورتحساب تعمیرات ( فاکتور) برای شما ارائه شد؟</p>
                    <div class="options">
                        <input type="radio" id="q12_opt1" name="q12" @if($json->q12 == 'بله') checked @endif value="بله" />
                        <label for="q12_opt1">بله</label>
                        <input type="radio" id="q12_opt2" name="q12" @if($json->q12 == 'خیر') checked @endif value="خیر" />
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
                        <input type="radio" id="q13_opt1" name="q13" @if($json->q13 == 'بله') checked @endif value="بله" />
                        <label for="q13_opt1">بله</label>
                        <input type="radio" id="q13_opt2" name="q13" @if($json->q13 == 'خیر') checked @endif value="خیر" />
                        <label for="q13_opt2">خیر</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 14: هزینه پرداختی برای کدام مورد بود؟</p>
                    <div class="options">
                        <input type="radio" id="q14_opt1" name="q14" @if($json->q14 == 'اجرت') checked @endif value="اجرت" />
                        <label for="q14_opt1">اجرت</label>
                        <input type="radio" id="q14_opt2" name="q14" @if($json->q14 == 'تعویض قطعات') checked @endif value="تعویض قطعات" />
                        <label for="q14_opt2">تعویض قطعات</label>
                        <input type="radio" id="q14_opt3" name="q14" @if($json->q14 == 'هردو') checked @endif value="هردو" />
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
                        <input type="radio" id="q15_opt1" name="q15" @if($json->q15 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q15_opt1">خیلی زیاد</label>
                        <input type="radio" id="q15_opt2" name="q15" @if($json->q15 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q15_opt2">زیاد</label>
                        <input type="radio" id="q15_opt3" name="q15" @if($json->q15 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q15_opt3">متوسط</label>
                        <input type="radio" id="q15_opt4" name="q15" @if($json->q15 == 'کم') checked @endif value="کم" />
                        <label for="q15_opt4">کم</label>
                        <input type="radio" id="q15_opt5" name="q15" @if($json->q15 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q15_opt5">خیلی کم</label>
                        <input type="radio" id="q15_opt6" name="q15" @if($json->q15 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q16_opt1" name="q16" @if($json->q16 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q16_opt1">خیلی زیاد</label>
                        <input type="radio" id="q16_opt2" name="q16" @if($json->q16 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q16_opt2">زیاد</label>
                        <input type="radio" id="q16_opt3" name="q16" @if($json->q16 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q16_opt3">متوسط</label>
                        <input type="radio" id="q16_opt4" name="q16" @if($json->q16 == 'کم') checked @endif value="کم" />
                        <label for="q16_opt4">کم</label>
                        <input type="radio" id="q16_opt5" name="q16" @if($json->q16 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q16_opt5">خیلی کم</label>
                        <input type="radio" id="q16_opt6" name="q16" @if($json->q16 == 'نظری ندارم') checked @endif value="نظری ندارم" />
                        <label for="q16_opt6">نظری ندارم</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>
                        سوال 17: از رفتار و برخورد پرسنل تعمیرگاه تا چه میزان رضایت دارید؟
                    </p>
                    <div class="options">
                        <input type="radio" id="q17_opt1" name="q17" @if($json->q17 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q17_opt1">خیلی زیاد</label>
                        <input type="radio" id="q17_opt2" name="q17" @if($json->q17 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q17_opt2">زیاد</label>
                        <input type="radio" id="q17_opt3" name="q17" @if($json->q17 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q17_opt3">متوسط</label>
                        <input type="radio" id="q17_opt4" name="q17" @if($json->q17 == 'کم') checked @endif value="کم" />
                        <label for="q17_opt4">کم</label>
                        <input type="radio" id="q17_opt5" name="q17" @if($json->q17 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q17_opt5">خیلی کم</label>
                        <input type="radio" id="q17_opt6" name="q17" @if($json->q17 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q18_opt1" name="q18" @if($json->q18 == 'بله') checked @endif value="بله" />
                        <label for="q18_opt1">بله</label>
                        <input type="radio" id="q18_opt2" name="q18" @if($json->q18 == 'خیر') checked @endif value="خیر" />
                        <label for="q18_opt2">خیر</label>
                    </div>
                </div>
                <hr />
                <div class="question">
                    <p>سوال 19: از سهولت دسترسی به نمایندگی این شرکت چقدر رضایت دارید؟</p>
                    <div class="options">
                        <input type="radio" id="q19_opt1" name="q19" @if($json->q19 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q19_opt1">خیلی زیاد</label>
                        <input type="radio" id="q19_opt2" name="q19" @if($json->q19 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q19_opt2">زیاد</label>
                        <input type="radio" id="q19_opt3" name="q19" @if($json->q19 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q19_opt3">متوسط</label>
                        <input type="radio" id="q19_opt4" name="q19" @if($json->q19 == 'کم') checked @endif value="کم" />
                        <label for="q19_opt4">کم</label>
                        <input type="radio" id="q19_opt5" name="q19" @if($json->q19 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q19_opt5">خیلی کم</label>
                        <input type="radio" id="q19_opt6" name="q19" @if($json->q19 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
                        <input type="radio" id="q20_opt1" name="q20" @if($json->q20 == 'خیلی زیاد') checked @endif value="خیلی زیاد" />
                        <label for="q20_opt1">خیلی زیاد</label>
                        <input type="radio" id="q20_opt2" name="q20" @if($json->q20 == 'زیاد') checked @endif value="زیاد" />
                        <label for="q20_opt2">زیاد</label>
                        <input type="radio" id="q20_opt3" name="q20" @if($json->q20 == 'متوسط') checked @endif value="متوسط" />
                        <label for="q20_opt3">متوسط</label>
                        <input type="radio" id="q20_opt4" name="q20" @if($json->q20 == 'کم') checked @endif value="کم" />
                        <label for="q20_opt4">کم</label>
                        <input type="radio" id="q20_opt5" name="q20" @if($json->q20 == 'خیلی کم') checked @endif value="خیلی کم" />
                        <label for="q20_opt5">خیلی کم</label>
                        <input type="radio" id="q20_opt6" name="q20" @if($json->q20 == 'نظری ندارم') checked @endif value="نظری ندارم" />
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
          >{{ $json->textarea }}</textarea>
                </div>
            </div>

            <div class="card client-info">
                <div class="card-header">مشخصات مشتری</div>
                <form id="survey-form">
                    <div class="question">
                        <p>نام و نام خانوادگی:</p>
                        <input type="text" name="full_name" value="{{ $json->full_name ?? '' }}"/>
                    </div>
                    <div class="question">
                        <p>جنسیت:</p>
                        <select name="gender">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->gender == 'مرد') selected @endif value="مرد">مرد</option>
                            <option @if($json->gender == 'زن') selected @endif value="زن">زن</option>
                        </select>
                    </div>
                    <div class="question">
                        <p>سن:</p>
                        <select name="age">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->age == '18-30') selected @endif value="18-30">۱۸ تا ۳۰ سال</option>
                            <option @if($json->age == '31-45') selected @endif value="31-45">۳۱ تا ۴۵ سال</option>
                            <option @if($json->age == '46-60') selected @endif value="46-60">۴۶ تا ۶۰ سال</option>
                            <option @if($json->age == '61+') selected @endif value="61+">۶۱ به بالا</option>
                        </select>
                    </div>
                    <div class="question">
                        <p>میزان تحصیلات:</p>
                        <select name="education">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->education == 'زیر دیپلم') selected @endif value="زیر دیپلم">زیر دیپلم</option>
                            <option @if($json->education == 'دیپلم') selected @endif value="دیپلم">دیپلم</option>
                            <option @if($json->education == 'فوق دیپلم') selected @endif value="فوق دیپلم">فوق دیپلم</option>
                            <option @if($json->education == 'لیسانس') selected @endif value="لیسانس">لیسانس</option>
                            <option @if($json->education == 'فوق لیسانس و بالاتر') selected @endif value="فوق لیسانس و بالاتر">فوق لیسانس و بالاتر</option>
                        </select>
                    </div>
                    <div class="question">
                        <p>شهر محل سکونت:</p>
                        <input type="text" name="city" value="{{ $json->city ?? '' }}"/>
                    </div>
                    <div class="question">
                        <p>تلفن تماس:</p>
                        <input type="text" name="phone" value="{{ $json->phone ?? '' }}"/>
                    </div>
                    <div class="question">
                        <p>نوع خودرو:</p>
                        <input type="text" name="car_type" value="{{ $json->car_type }}" />
                    </div>
                    <div class="question">
                        <p>شرکت سازنده:</p>
                        <input type="text" name="car_manufacturer" value="{{ $json->car_manufacturer }}"/>
                    </div>
                    <div class="question">
                        <p>تاریخ خرید خودرو:</p>
                        <input type="text" name="purchase_date" value="{{ $json->purchase_date }}"/>
                    </div>
                    <div class="question">
                        <p>وضعیت خرید خودرو:</p>
                        <select name="purchase_method">
                            <option value="">انتخاب کنید</option>
                            <option @if($json->purchase_method == 'گارانتی') selected @endif value="گارانتی">گارانتی</option>
                            <option @if($json->purchase_method == 'وارانتی') selected @endif value="وارانتی">وارانتی</option>
                        </select>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection

@section('scripts3')

@endsection
