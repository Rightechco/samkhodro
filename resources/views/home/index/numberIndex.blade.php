<div class="allNumberIndex width">
    <div class="title">
        <h3>{{$data['title']}}</h3>
        <p>{{$data['description']}}</p>
    </div>
    <ul>
        <li>
            <h4>
                <span>+</span>
                <span class="numberCount">{{\App\Models\User::where('level' , 0)->where('contact', 0)->count()}}</span>
            </h4>
            <h5>مشتریان ما</h5>
        </li>
        <li>
            <h4>
                <span>+</span>
                <span class="numberCount">{{\App\Models\Product::count()}}</span>
            </h4>
            <h5>محصولات ما</h5>
        </li>
        <li>
            <h4>
                <span>+</span>
                <span class="numberCount">{{\App\Models\Ticket::count()}}</span>
            </h4>
            <h5>پرسش و پاسخ</h5>
        </li>
    </ul>
</div>
