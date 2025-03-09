@extends('admin.master')

@section('title' , 'آمارگیری مشتریان بالقوه')
@section('tab' , 12)
@section('content')
    <div class="allCustomer allCost">
        <div class="detailProjectIndex">
            <div class="timeDetails">
                <div class="timeDetailsRight">
                    <h4>
                        مجموع مشتریان
                        <span>{{$allUsers}} مشتری</span>
                    </h4>
                    <div class="timeDetailFills">
                        <div style="width : 100%" class="timeDetailFill"></div>
                    </div>
                </div>
                <div class="timeDetailsLeft">
                    <div class="timeDetail">
                        <h4>تعداد مشتریان دارای تراکنش موفق امروز :</h4>
                        <h5>{{$todayTransaction}}</h5>
                    </div>
                    <div class="timeDetail">
                        <h4>تعداد مشتریان دارای تراکنش موفق دیروز :</h4>
                        <h5>{{$yesTransaction}}</h5>
                    </div>
                </div>
            </div>
            <div class="widgetItems">
                <div class="widgetItem">
                    <h4>تعداد مشتریان امروز</h4>
                    <p>{{$todayUsers}} مشتری</p>
                </div>
                <div class="widgetItem">
                    <h4>تعداد مشتریان دیروز</h4>
                    <p>{{$yesUsers}} مشتری</p>
                </div>
                <div class="widgetItem">
                    <h4>تعداد مشتریان این هفته</h4>
                    <p>{{$weekUsers}} مشتری</p>
                </div>
                <div class="widgetItem">
                    <h4>تعداد مشتریان این ماه</h4>
                    <p>{{$monthUsers}} مشتری</p>
                </div>
                <div class="widgetItem">
                    <h4>تعداد مشتریان امسال</h4>
                    <p>{{$yearUsers}} مشتری</p>
                </div>
            </div>
            <div class="workChart">
                <div class="topItemsLeft">
                    <div>
                        <h4>آمار مشتریان ماهانه</h4>
                        <canvas id="myChart3" style="position: relative; height:1vh; width:1vw"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var userReports = {!! json_encode($userReports, JSON_HEX_TAG) !!};
            const data3 = {
                labels: [
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
                ],
                datasets: [{
                    label: 'آمار مشتریان ماهانه',
                    data: userReports,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            };
            const config3 = {
                type: 'bar',
                data: data3,
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 10,
                                    family: 'irsans'
                                },
                            }
                        }
                    }
                }
            };
            new Chart(
                document.getElementById('myChart3'),
                config3
            );
        })
    </script>
@endsection

@section('links')
    <script src="/js/chart.js"></script>
@endsection
