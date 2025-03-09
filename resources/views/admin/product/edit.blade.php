@extends('admin.master')

@section('title' , 'ویرایش ' . $products->title)
@section('tab' , 11)
@section('content')
    <div class="allCustomer">
        <div class="allCreatePost">
            <form action="/admin/product/{{$products->id}}/edit" method="post" class="allCreatePostData">
                @csrf
                {{ method_field('PUT') }}
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>عنوان* :</label>
                            <input type="text" value="{{$products->title}}" name="title" placeholder="عنوان را وارد کنید">
                            @error('title')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>sku* :</label>
                            <input type="text" value="{{$products->sku}}" name="sku" placeholder="sku">
                            @error('sku')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItems">
                        <div class="allCreatePostItem">
                            <label>مبلغ* :</label>
                            <input type="text" value="{{$products->price}}" name="price" placeholder="مبلغ">
                            @error('price')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>تعداد* :</label>
                            <input type="text" value="{{$products->count}}" name="count" placeholder="تعداد">
                            @error('count')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیح سئو :</label>
                        <textarea placeholder="توضیح را وارد کنید" name="bodySeo">{{$products->bodySeo}}</textarea>
                        <div id="validation-bodySeo"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیحات کامل :</label>
                        <textarea placeholder="توضیح را وارد کنید" name="body">{{$products->body}}</textarea>
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
                                <input type="text" value="{{$products->titleSeo}}" name="titleSeo" placeholder="عنوان را وارد کنید">
                                @error('title')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>کیورد سئو :</label>
                                <input type="text" value="{{$products->keywordSeo}}" name="keywordSeo" placeholder="کیورد">
                                @error('sku')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>alt تصویر :</label>
                                <input type="text" value="{{$products->imageAlt}}" name="imageAlt" placeholder="alt را وارد کنید">
                                @error('title')
                                <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>پیوند (slug) :</label>
                                <input type="text" name="slug" value="{{$products->slug}}" placeholder="slug">
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
            var products = {!! $products->toJson() !!};
            var taxes = [];
            var cats = [];
            if(products.category){
                $.each(products.category,function(){
                    cats.push(this.id);
                });
                $('.cat-multiple').val(cats);
            }
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
            if(products.image){
                $('.getImageItem').append(
                    $('<div class="getImagePic"><input type="hidden" name="image" value="'+products.image+'"><i><svg class="deleteImg"><use xlink:href="#trash"></use></svg></i><img src="'+products.image+'"></div>')
                        .on('click' , '.deleteImg',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
                $("input[name='image']").val(products.image);
            }
        })
    </script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <script src="/js/select2.min.js"></script>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
@endsection
