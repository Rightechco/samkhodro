<div class="allHeaderPanel" style="background: {{\App\Models\Setting::where('key' , 'headerColor')->pluck('value')->first()}}">
    <div class="right">
        <i class="alignIcon">
            <svg class="icon">
                <use xlink:href="#align"></use>
            </svg>
        </i>
        <label>
            <input type="search" placeholder="جستجو ...">
            <i>
                <svg class="icon">
                    <use xlink:href="#search"></use>
                </svg>
            </i>
        </label>
    </div>
    <div class="left">
        <a class="noteLeft" href="/admin/customer" data_count="مشتریان">
            <i>
                <svg class="icon">
                    <use xlink:href="#customer"></use>
                </svg>
            </i>
            <span>{{number_format(\App\Models\User::where('contact',0)->where('level',0)->count())}}</span>
        </a>
        <a class="noteLeft" href="/admin/product" data_count="محصولات">
            <i>
                <svg class="icon">
                    <use xlink:href="#luggage-cart"></use>
                </svg>
            </i>
            <span>{{number_format(\App\Models\Product::count())}}</span>
        </a>
        <div class="user">
            <div class="pic" id="userPic" aria-haspopup="true">
                <img src="/img/user.png">
            </div>
            <ul id="showUser">
                <li>
                    <div class="picUser">
                        <img src="/img/user.png" alt="$page.userData.name">
                    </div>
                    <div class="infoUser">
                        <span>{{auth()->user()->name}}</span>
                    </div>
                </li>
                <li>
                    <a href="/profile">
                        پنل کاربری
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@section('script1')
    <script>
        $(document).ready(function(){
            var res = 0;
            $('.allHeaderPanel #showUser').hide();
            $('.allHeaderPanel #userPic').click(function (){
                $('.allHeaderPanel #showUser').toggle(50);
            })
            if(window.innerWidth <= 700){
                res = 1;
                $(".allPanel").animate({"margin": "6rem 1rem 1rem 1rem"},300);
                $(".allHeaderPanel").animate({"padding-right": "1rem"},300);
                $(".allSideBar").animate({"right": "-20rem"},50);
            }
            if(window.innerWidth > 700) {
                $('.allHeaderPanel .alignIcon').click(function () {
                    if (res == 0) {
                        $(".allPanel").animate({"margin": "6rem 1rem 1rem 1rem"}, 300);
                        $(".allHeaderPanel").animate({"padding-right": "1rem"}, 300);
                        res = 1;
                        $(".allSideBar").animate({"right": "-20rem"}, 50);
                    } else {
                        $(".allPanel").animate({"margin": "6rem 18rem 1rem 1rem"}, 300);
                        $(".allHeaderPanel").animate({"padding-right": "18rem"}, 300);
                        $(".allSideBar").animate({"right": "0"}, 50);
                        res = 0;
                    }
                })
            }
            else{
                $('.allHeaderPanel .alignIcon').click(function () {
                    if (res == 0) {
                        $(".allPanel").animate({"margin": "6rem 1rem 1rem 1rem"}, 300);
                        $(".allHeaderPanel").animate({"padding-right": "1rem"}, 300);
                        res = 1;
                        $(".allSideBar").animate({"right": "-20rem"}, 50);
                    } else {
                        $(".allHeaderPanel").animate({"padding-right": "18rem"}, 300);
                        $(".allSideBar").animate({"right": "0"}, 50);
                        res = 0;
                    }
                })
            }
        })
    </script>
@endsection
