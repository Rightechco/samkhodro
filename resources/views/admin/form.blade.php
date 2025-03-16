@extends('admin.master')

@section('title' , 'همه پرسش نامه ها')
@section('tab',28)
@section('content')
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
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allData">
            <table class="contact1">
                <tr>
                    <th><h4>کاربر</h4></th>
                    <th><h4>موبایل</h4></th>
                    <th><h4>فرم</h4></th>
                    <th><h4>تاریخ</h4></th>
                    <th><h4>مشاهده</h4></th>
                </tr>
                @foreach($forms as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->mobile}}</td>
                        <td>{{$item->formID}}</td>
                        <td style="direction: ltr">{{verta($item->created_at)->format('Y-n-j H:i')}}</td>
                        <td><a class="span badge-success" href="/admin/form/seeRes/{{$item->id}}">مشاهده</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $forms->links('admin.paginate') }}
    </div>
@endsection

@section('scripts3')

@endsection
