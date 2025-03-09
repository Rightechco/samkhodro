@extends('admin.master')

@section('title' , 'خدمات')
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
                            <th>توضیح</th>
                            <th>زمان ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($abilities as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->body}}</td>
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
                {{ $abilities->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/service" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>عنوان*</label>
                        <input type="text" name="name" placeholder="عنوان را وارد کنید">
                        @error('name')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>توضیح*</label>
                        <textarea name="body" placeholder="توضیح را وارد کنید"></textarea>
                        @error('body')
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
                <div class="title">آیا از حذف سرویس مطمئن هستید؟</div>
                <p>با حذف سرویس اطلاعات سرویس به طور کامل حذف میشوند</p>
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
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/service/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                $('.getImageItem .getImagePic').remove();
                $("input[name='name']").val('');
                $("input[name='image']").val('');
                $("textarea[name='body']").val('');
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    service:post,
                };
                $.ajax({
                    url: "/admin/service/" + post + "/edit",
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/service/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/service/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='name']").val('');
                                $("input[name='image']").val('');
                                $("textarea[name='body']").val('');
                                $('.getImageItem .getImagePic').remove()
                            })
                        )
                        $("input[name='name']").val(data.name);
                        $("textarea[name='body']").val(data.body);
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
