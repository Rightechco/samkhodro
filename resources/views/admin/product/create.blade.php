@extends('admin.master')

@section('title' , 'افزودن محصول')
@section('tab' , 11)
@section('content')
    <div class="allCustomer">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>افزودن محصول</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/product">همه محصول ها</a>
                    <span>/</span>
                    <a href="/admin/product/create">افزودن محصول</a>
                </div>
            </div>
            <form action="/admin/product/create" method="post" class="allCreatePostData">
                @csrf
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>عنوان* :</label>
                            <input type="text" name="title" placeholder="عنوان را وارد کنید">
                            @error('title')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>sku* :</label>
                            <input type="text" name="sku" placeholder="sku">
                            @error('sku')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>مبلغ* :</label>
                            <input type="text" name="price" placeholder="مبلغ">
                            @error('price')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>تعداد* :</label>
                            <input type="text" name="count" placeholder="تعداد">
                            @error('count')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیح سئو :</label>
                        <textarea placeholder="توضیح را وارد کنید" name="bodySeo"></textarea>
                        <div id="validation-bodySeo"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیحات کامل :</label>
                        <textarea placeholder="توضیح را وارد کنید" name="body"></textarea>
                        <div id="validation-body"></div>
                    </div>
                    <div class="addImageButton">برای افزودن تصویر کلیک کنید</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                        </div>
                    </div>
                    <button class="button" type="submit">ارسال اطلاعات</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            جزئیات
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>عنوان سئو :</label>
                                <input type="text" name="titleSeo" placeholder="عنوان را وارد کنید">
                                @error('titleSeo')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>کیورد سئو :</label>
                                <input type="text" name="keywordSeo" placeholder="کیورد">
                                @error('keywordSeo')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>alt تصویر :</label>
                                <input type="text" name="imageAlt" placeholder="alt را وارد کنید">
                                @error('title')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>پیوند (slug) :</label>
                                <input type="text" name="slug" placeholder="slug">
                                @error('slug')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>دسته بندی :</label>
                                <select class="cat-multiple" name="cat[]" multiple="multiple">
                                    @foreach($cats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="filemanager" style="display:none;">
            @include('admin.filemanager')
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            $("textarea[name='body']").ckeditor();
            $('.cat-multiple').select2({
                placeholder: 'دسته بندی را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('.filemanager').hide();
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
        })
    </script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <script src="/js/select2.min.js"></script>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
@endsection
