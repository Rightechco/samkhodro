@extends('admin.master')

@section('title' , 'ویرایش سفارش')
@section('tab',26)
@section('content')
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>ویرایش سفارش</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/order">همه سفارش ها</a>
                    <span>/</span>
                    <a href="/admin/order/{{$order->id}}/edit">ویرایش سفارش</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <form method="post" action="/admin/order/{{$order->id}}/edit" class="allCreatePostSubject">
                    @csrf
                    @method('put')
                    <div class="allCreatePostItem">
                        <label>توضیحات :</label>
                        <input type="text" name="note" value="{{ old('note', $order->titleSeo) }}" placeholder="توضیحات">
                        <div id="validation-note"></div>
                    </div>
                    <div class="allCreatePostDetailItem">
                        <label>وضعیت* :</label>
                        <select name="status" id="status">
                            <option @if($order->status == 'wait') selected @endif value="wait">در انتظار</option>
                            <option @if($order->status == 'accept') selected @endif value="accept">تایید شده</option>
                            <option @if($order->status == 'reject') selected @endif value="reject">رد شده</option>
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
