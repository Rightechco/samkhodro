@extends('home.master')

@section('active' , 1)
@section('title' , $title . ' - ')
@section('links')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jalalidatepicker.min.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="allProfileIndex width">
        @include('profile.list' , ['tab' => $tab])
        <div class="profileIndexLike">
            <label>{{$title}}</label>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>زمان</th>
                    <th>وضعیت</th>
                    <th>یادداشت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td style="direction: ltr">{{ verta($item->time)->format('Y-n-j H:i') }}</td>
                            <td><span class="span badge-{{ $item->classStatus() }}">{{ $item->nameStatus() }}</span></td>
                            <td>{{ $item->note }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box" style="margin-top: 20px">
                <h2>ثبت درخواست جدید</h2>
                <form action="newAppointment" method="post">
                    @csrf
                    @if(!isset(auth()->user()->number))
                        <div class="filledItem">
                            <label>شماره موبایل* :</label>
                            <input type="text" name="number" placeholder="شماره موبایل">
                            @error('number')
                            <div class="alert-danger" style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="filledItem">
                        <label>تاریخ* :</label>
                        <input data-jdp name="date" type="text" id="date"
                               class="form-control" value="{{ old('date') ?? null }}">
                        @error('date')
                        <div class="alert-danger" style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>ساعت* :</label>
                        <div class="input-group">
                            <input id="timepicker3" type="text" class="form-control" name="time" style="height: 39.2px">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                            </div>
                        </div>
                        @error('time')
                        <div class="alert-danger" style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                    <button>ثبت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script1')
    <script src="{{ asset('js/jalalidatepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch();
        $("#timepicker3").timepicker({
            minuteStep: 15,
            showMeridian: !1,
            icons: {
                up: "mdi mdi-chevron-up",
                down: "mdi mdi-chevron-down"
            }
        })
    </script>
@endsection
