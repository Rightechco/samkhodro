<div class="allProfileList">
    <div class="allUserIndexList">
        <div class="allUserIndexListsUser">
            <div class="allUserIndexListsUserPic">
                <div class="pic">
                    @if(auth()->user()->profile)
                        <img src="{{auth()->user()->profile}}" alt="{{auth()->user()->name}}">
                    @else
                        <img src="/img/user.png" alt="{{auth()->user()->name}}">
                    @endif
                </div>
            </div>
            <div class="allUserIndexListsUserItem">
                <div class="allUserIndexListsUserName">{{ auth()->user()->name }}</div>
            </div>
        </div>
        <div class="allUserIndexListItems">
            <a href="/profile/personal-info">ویرایش کاربر</a>
            <a href="/profile/logout">خروج از حساب</a>
        </div>
    </div>
    <div class="allUserIndexListsItems">
        <div class="allUserIndexListsItem">
            <a href="/profile">داشبورد</a>
            @if($tab == 0)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/order">سفارشات</a>
            @if($tab == 1)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/appointment">نوبت ها</a>
            @if($tab == 3)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/like">علاقه مندی ها</a>
            @if($tab == 2)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/tickets">تیکت ها</a>
            @if($tab == 5)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
    </div>
</div>
