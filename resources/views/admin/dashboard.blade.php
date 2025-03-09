@extends('admin.master')

@section('title' , 'داشبورد')
@section('tab' , 0)
@section('content')
    <div class="allDashboard">
        <div class="widgets">
            <div class="widget">
                <h3>ثبت نام امروز</h3>
                <h4>{{number_format($todayUser)}}</h4>
            </div>
            <div class="widget">
                <h3>تعداد کاربران</h3>
                <h4>{{number_format($allUser)}}</h4>
            </div>
            <div class="widget">
                <h3>تعداد محصولات</h3>
                <h4>{{number_format($allProduct)}}</h4>
            </div>
            <div class="widget">
                <h3>تعداد بلاگ ها</h3>
                <h4>{{number_format($allNews)}}</h4>
            </div>
            <div class="widget">
                <h3>تعداد بازدید ها</h3>
                <h4>{{$allView}}</h4>
            </div>
            <div class="widget">
                <h3>بازدید امروز</h3>
                <h4>{{$todayView}}</h4>
            </div>
            <div class="widget">
                <h3>علاقه مندی ها</h3>
                <h4>{{number_format($allComment)}}</h4>
            </div>
            <div class="widget">
                <h3>درخواست های تماس</h3>
                <h4>{{number_format($allDemand)}}</h4>
            </div>
        </div>
        <div class="charts">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        var farvardinPay = {!! json_encode($farvardinPay, JSON_HEX_TAG) !!};
        var ordibeheshtPay = {!! json_encode($ordibeheshtPay, JSON_HEX_TAG) !!};
        var khordadPay = {!! json_encode($khordadPay, JSON_HEX_TAG) !!};
        var tirPay = {!! json_encode($tirPay, JSON_HEX_TAG) !!};
        var mordadPay = {!! json_encode($mordadPay, JSON_HEX_TAG) !!};
        var shahrivarPay = {!! json_encode($shahrivarPay, JSON_HEX_TAG) !!};
        var mehrPay = {!! json_encode($mehrPay, JSON_HEX_TAG) !!};
        var abanPay = {!! json_encode($abanPay, JSON_HEX_TAG) !!};
        var azarPay = {!! json_encode($azarPay, JSON_HEX_TAG) !!};
        var deyPay = {!! json_encode($deyPay, JSON_HEX_TAG) !!};
        var bahmanPay = {!! json_encode($bahmanPay, JSON_HEX_TAG) !!};
        var esfandPay = {!! json_encode($esfandPay, JSON_HEX_TAG) !!};
        const labels = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'ثبت نام کاربران',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    farvardinPay,
                    ordibeheshtPay,
                    khordadPay,
                    tirPay,
                    mordadPay,
                    shahrivarPay,
                    mehrPay,
                    abanPay,
                    azarPay,
                    deyPay,
                    bahmanPay,
                    esfandPay,
                ],
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                family: 'irsans'
                            },
                        }
                    }
                }
            }
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection

@section('links')
    <script src="/js/chart.js"></script>
@endsection
