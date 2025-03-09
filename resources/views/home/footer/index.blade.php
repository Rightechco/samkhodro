<div class="allFooter">
    <div class="width">
        <div class="topFooter">
            <div class="option">
                <i>
                    <svg class="icon">
                        <use xlink:href="#phone-call"></use>
                    </svg>
                </i>
                <div class="des">
                    <div class="desT">تماس ما</div>
                    {{\App\Models\Setting::where('key' , 'number2')->pluck('value')->first()}}
                </div>
            </div>
            <div class="option">
                <i>
                    <svg class="icon">
                        <use xlink:href="#email"></use>
                    </svg>
                </i>
                <div class="des">
                    <div class="desT">ایمیل ما</div>
                    {{\App\Models\Setting::where('key' , 'email')->pluck('value')->first()}}
                </div>
            </div>
            <div class="option">
                <i>
                    <svg class="icon">
                        <use xlink:href="#location"></use>
                    </svg>
                </i>
                <div class="des">
                    <div class="desT">آدرس ما</div>
                    {{\App\Models\Setting::where('key' , 'address')->pluck('value')->first()}}
                </div>
            </div>
        </div>
        <div class="centerFooter">
            <div class="right">
                <figure class="pic">
                    <a href="/">
                        <img src="{{\App\Models\Setting::where('key' , 'logo')->pluck('value')->first()}}" alt="{{\App\Models\Setting::where('key' , 'title')->pluck('value')->first()}}">
                    </a>
                </figure>
                <p>{{\App\Models\Setting::where('key' , 'about')->pluck('value')->first()}}</p>
            </div>
            <div class="left">
                <div class="item">
                    <h4>دسترسی سریع</h4>
                    <ul>
                        @foreach(\App\Models\Link::where('type' , 1)->get() as $item)
                            <li>
                                <a href="{{$item->slug}}">
                                    <i>
                                        <svg class="icon">
                                            <use xlink:href="#left"></use>
                                        </svg>
                                    </i>
                                    {{$item->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="item">
                    <h4>لینک های مفید</h4>
                    <ul>
                        @foreach(\App\Models\Link::where('type' , 2)->get() as $item)
                            <li>
                                <a href="{{$item->slug}}">
                                    <i>
                                        <svg class="icon">
                                            <use xlink:href="#left"></use>
                                        </svg>
                                    </i>
                                    {{$item->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="item">
                    <h4>مشترک شوید</h4>
                    <p>در خبرنامه ما ثبت نام کنید</p>
                    <label for="sub1" class="subscribe">
                        <input type="text" id="sub1" name="subscribe" placeholder="ایمیل خود را وارد کنید ...">
                        <button>ثبت</button>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="fixedTab">
        <div class="tabs">
            <div class="rightTab">
                <div class="tab resAlign">
                    <a>
                        <i>
                            <svg class="icon">
                                <use xlink:href="#align"></use>
                            </svg>
                        </i>
                    </a>
                </div>
                <div class="tab">
                    @if(Request::is('profile*') || Request::is('login*'))
                        <a href="/profile" class="active">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#user"></use>
                                </svg>
                            </i>
                        </a>
                    @else
                        <a href="/profile">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#user"></use>
                                </svg>
                            </i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="tab homeTab">
                <a href="/">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#home2"></use>
                        </svg>
                    </i>
                </a>
            </div>
            <div class="leftTab">
                <div class="tab">
                    @if(Request::is('blogs'))
                        <a href="/blogs" class="active">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#blog"></use>
                                </svg>
                            </i>
                        </a>
                    @else
                        <a href="/blogs">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#blog"></use>
                                </svg>
                            </i>
                        </a>
                    @endif
                </div>
                <div class="tab">
                    @if(Request::is('faq'))
                        <a href="/faq" class="active">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#ticket"></use>
                                </svg>
                            </i>
                        </a>
                    @else
                        <a href="/faq">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#ticket"></use>
                                </svg>
                            </i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        $('.subscribe button').click(function(){
            var name = $(".subscribe input[name='subscribe']").val();
            if(isEmail(name)){
                var form = {
                    "_token": "{{ csrf_token() }}",
                    email:name,
                };
                $.ajax({
                    url: "/send-sub",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'ok'){
                            $.toast({
                                text: "ایمیل شما ثبت شد", // Text that is to be shown in the toast
                                heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $(".subscribe input[name='subscribe']").val('');
                        }else{
                            $.toast({
                                text: "ایمیل قبلا ثبت شده بود", // Text that is to be shown in the toast
                                heading: 'دقت کنید', // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                    },
                });
            }else{
                $.toast({
                    text: "ایمیل اشتباه است", // Text that is to be shown in the toast
                    heading: 'دقت کنید', // Optional heading to be shown on the toast
                    icon: 'error', // Type of toast icon
                    showHideTransition: 'fade', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',
                    loader: true,
                    loaderBg: '#c60000',
                });
            }
        })
        $('.allContactIndex .left button').click(function(e){
            var title = $(".allContactIndex .left input[name='title']").val();
            var number = $(".allContactIndex .left input[name='number']").val();
            var body = $(".allContactIndex .left textarea[name='body']").val();
            var form = {
                "_token": "{{ csrf_token() }}",
                title:title,
                number:number,
                body:body,
            };
            $.ajax({
                url: "/send-contact",
                type: "post",
                data: form,
                success: function (data) {
                    $.toast({
                        text: "درخواست شما ثبت شد", // Text that is to be shown in the toast
                        heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                    });
                },
            });
        })
    })
</script>
