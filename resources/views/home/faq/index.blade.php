@extends('home.master')

@section('active' , 1)
@section('title' , 'سوالات متداول - ')
@section('content')
    <main class="allFaqIndex">
        <div class="faqBlock width">
            @if (\Session::has('message'))
                <div class="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="success">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            <section class="questions">
                <h1>سوالات متداول</h1>
                @foreach($asks as $item)
                    <div class="questionIndex">
                        <div class="title">
                            <h3>{{$item->title}}</h3>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#down"></use>
                                </svg>
                            </i>
                        </div>
                        <div class="description">
                            <p>{!! $item->body !!}</p>
                        </div>
                    </div>
                @endforeach
                <h5>سوال خودتان را در سوالات متداول پیدا نکردید؟</h5>
                <div class="ticketButtons" id="buttonQuestion">
                    <button>ارسال درخواست</button>
                </div>
            </section>
            <section class="tickets">
                <h3>ارسال درخواست</h3>
                <form method="post" action="/send-contact">
                    @csrf
                    <input type="hidden" name="redirect" value="/faq">
                    <div class="items">
                        <div class="item">
                            <label for="title">عنوان درخواست*</label>
                            <input type="text" name="title" required id="title" placeholder="عنوان درخواست را وارد کنید">
                        </div>
                        <div class="item">
                            <label for="number">شماره تماس*</label>
                            <input type="text" name="number" required id="number" placeholder="شماره تماس را وارد کنید">
                        </div>
                    </div>
                    <div class="item">
                        <label for="body">درخواست*</label>
                        <textarea name="body" id="body" required placeholder="درخواست را وارد کنید"></textarea>
                    </div>
                    <div class="ticketButtons">
                        <button>ارسال درخواست</button>
                        <h4>انصراف</h4>
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection

@section('script1')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("این فیلد اجباری است");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
            var elements2 = document.getElementsByTagName("TEXTAREA");
            for (i = 0; i < elements2.length; i++) {
                elements2[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("این فیلد اجباری است");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
        })
        $(document).ready(function(){
            $('.questions .questionIndex').on('click',function(){
                $.each($('.description') , function(){
                    $(this).hide();
                })
                $(this.lastElementChild).toggle();
            })
            $('.questions #buttonQuestion button').on('click',function(){
                $('.questions').toggle();
                $('.tickets').toggle();
            })
            $('.tickets .ticketButtons h4').on('click',function(){
                $('.questions').toggle();
                $('.tickets').toggle();
            })
        })
    </script>
@endsection
