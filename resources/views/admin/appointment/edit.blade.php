@extends('admin.master')

@section('title' , 'ویرایش نوبت')
@section('tab',27)
@section('content')
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>ویرایش سفارش</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/appointment">همه نوبت ها</a>
                    <span>/</span>
                    <a href="/admin/appointment/{{$appointment->id}}/edit">ویرایش نوبت</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <form method="post" action="/admin/appointment/{{$appointment->id}}/edit" class="allCreatePostSubject">
                    @csrf
                    @method('put')
                    <div class="allCreatePostItem">
                        <label>توضیحات :</label>
                        <input type="text" name="note" value="{{ old('note', $appointment->titleSeo) }}" placeholder="توضیحات">
                        <div id="validation-note"></div>
                    </div>
                    <div class="allCreatePostDetailItem">
                        <label>وضعیت* :</label>
                        <select name="status" id="status">
                            <option @if($appointment->status == 'wait') selected @endif value="wait">در انتظار</option>
                            <option @if($appointment->status == 'accept') selected @endif value="accept">تایید شده</option>
                            <option @if($appointment->status == 'reject') selected @endif value="reject">رد شده</option>
                        </select>
                        <div id="validation-status"></div>
                    </div>
                    <button class="button" style="margin-top: 10px" type="submit">ارسال اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script1')
    <script>

    </script>
@endsection

@section('links')
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
@endsection
