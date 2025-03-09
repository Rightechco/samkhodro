@extends('admin.master')

@section('title' , 'دسته بندی')
@section('tab' , 23)
@section('content')
    <div class="allNote">
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTables">
            <div>
                <div class="allData">
                    <table>
                        <tr>
                            <th>نام</th>
                            <th>نوع</th>
                            <th>زمان ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($categories as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if($item->type == 4)
                                        محصول
                                    @else
                                        بلاگ
                                    @endif
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="buttons">
                                        @if(auth()->user()->can('تاکسونامی') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                        @endif
                                        @if(auth()->user()->can('تاکسونامی') || auth()->user()->level == 3)
                                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $categories->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/category" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>نام*</label>
                        <input type="text" name="name" placeholder="نام را وارد کنید">
                        @error('name')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>پیوند (slug)*</label>
                        <input type="text" name="slug" placeholder="پیوند (slug) را وارد کنید">
                        @error('slug')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>نوع</label>
                        <select name="type">
                            <option value="4" selected>محصول</option>
                            <option value="5">بلاگ</option>
                        </select>
                        @error('type')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>توضیحات</label>
                        <textarea name="body" placeholder="توضیحات را وارد کنید"></textarea>
                    </div>
                    <div class="filledItem">
                        <label>عنوان سئو</label>
                        <input type="text" name="nameSeo" placeholder="عنوان را وارد کنید">
                        @error('nameSeo')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>کلمات کلیدی</label>
                        <input name="keyword" placeholder="با , جدا کنید"/>
                        @error('keyword')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>توضیحات سئو</label>
                        <textarea name="bodySeo" placeholder="توضیحات را وارد کنید"></textarea>
                        @error('bodySeo')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="addImageButton">برای افزودن تصویر کلیک کنید</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                        </div>
                    </div>
                    <div class="buttonForm">
                        <button type="submit">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف دسته بندی مطمئن هستید؟</div>
                <p>با حذف دسته بندی اطلاعات دسته بندی به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
    </div>
    <div class="filemanager">
        @include('admin.filemanager')
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.popUp').hide();
            $('.filemanager').hide();
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/category/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    note:post,
                };
                $.ajax({
                    url: '/admin/category/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/category/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/category/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='name']").val('');
                                $("input[name='slug']").val('');
                                $("input[name='nameSeo']").val('');
                                $("input[name='keyword']").val('');
                                $("textarea[name='body']").val('');
                                $("textarea[name='bodySeo']").val('');
                                $("input[name='image']").val('');
                                $("select[name='type']").val(0);
                                $('.getImageItem .getImagePic').remove()
                            })
                        )
                        $("input[name='name']").val(data.name);
                        $("input[name='slug']").val(data.slug);
                        $("input[name='nameSeo']").val(data.nameSeo);
                        $("input[name='keyword']").val(data.keyword);
                        $("textarea[name='body']").val(data.body);
                        $("textarea[name='bodySeo']").val(data.bodySeo);
                        $("select[name='type']").val(data.type);
                        $('.getImageItem').append(
                            $('<div class="getImagePic"><input type="hidden" name="image" value="'+data.image+'"><i><svg class="deleteImg"><use xlink:href="#trash"></use></svg></i><img src="'+data.image+'"></div>')
                                .on('click' , '.deleteImg',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                        $("input[name='image']").val(data.image);
                    },
                });
            })
        })
    </script>
@endsection

