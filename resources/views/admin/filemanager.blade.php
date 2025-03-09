<div class="allFileManagers">
    <div class="fileManagers">
        <div class="closeFile">
            <svg class="icon">
                <use xlink:href="#cancel"></use>
            </svg>
        </div>
        <div class="tabs">
            <div class="tab" id="showImageContainer">نمایش تصاویر</div>
            <div class="tab" id="addImageContainer">افزودن تصویر</div>
        </div>
        <div class="allImages">
            <ul id="images"></ul>
        </div>
        <form method="post" id="upload-image-form" enctype="multipart/form-data">
            @csrf
            <div class="sendImage">
                <input type="file" id="post_cover" class="dropify" name="image"/>
            </div>
            <button type="submit" id="upload-image">آپلود</button>
        </form>
    </div>
</div>

@section('scripts4')
<script>
    $(document).ready(function(){
        $('#upload-image-form').hide();
        $('#showImageContainer').attr('class' , 'tab active');
        $('.closeFile').click(function(){
            $('.filemanager').toggle();
        });
        $('#addImageContainer').click(function (){
            $('#upload-image-form').toggle();
            $('#addImageContainer').attr('class' , 'tab active');
            $('#showImageContainer').attr('class' , 'tab');
            $('.allImages').toggle();
        });
        $('#showImageContainer').click(function (){
            $('#showImageContainer').attr('class' , 'tab active');
            $('#addImageContainer').attr('class' , 'tab');
            $('#upload-image-form').toggle();
            $('.allImages').toggle();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url: `/admin/get-image`,
            contentType: false,
            processData: false,
            success: (response) => {
                $.each(response,function(){
                    $('.allFileManagers #images').append(
                        $('<li><img id="'+this.id+'" src="'+this.url+'" alt=""></li>')
                        .click(function(){
                            $('.filemanager').hide();
                            $('.sendGallery #imageTooltip').hide();
                            $('.messageData #btnFileTicket').show();
                            if($('.multiFiles').length == 0){
                                $('.sendGallery .getImageItem').children('.getImagePic').remove();
                                $('.sendGallery .getImageItem').append(
                                    $('<div class="getImagePic"><input type="hidden" name="image" value="'+this.lastChild.id+'"><i class="deleteImg"><svg><use xlink:href="#trash"></use></svg></i><img src="'+this.lastChild.src+'"></div>')
                                        .on('click' , '.deleteImg',function(ss){
                                            $('.filemanager').show();
                                            $('.sendGallery #imageTooltip').show();
                                            $('.messageData #btnFileTicket').hide();
                                            ss.currentTarget.parentElement.remove();
                                        })
                                );
                            }else{
                                $('.sendGallery .getImageItem').append(
                                    $('<div class="getImagePic"><input type="hidden" name="image[]" value="'+this.lastChild.id+'"><i class="deleteImg"><svg><use xlink:href="#trash"></use></svg></i><img src="'+this.lastChild.src+'"></div>')
                                        .on('click' , '.deleteImg',function(ss){
                                            $('.filemanager').show();
                                            ss.currentTarget.parentElement.remove();
                                        })
                                );
                            }
                        })
                    );
                });
            },
        });

        $('.allFileManagers #upload-image-form').submit(function(e) {
            $('#upload-image-form #upload-image').text('صبر کنید ...');
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: `/admin/upload-image`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    $('#upload-image-form #upload-image').text('آپلود');
                    $.toast({
                        text: "فایل اضافه شد", // Text that is to be shown in the toast
                        heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                    });
                    if($('.multiFiles').length == 0){
                        $('.sendGallery .getImageItem').children('.getImagePic').remove();
                        $('.sendGallery .getImageItem').append(
                            $('<div class="getImagePic"><input type="hidden" name="image" value="'+response.id+'"><i class="deleteImg"><svg><use xlink:href="#trash"></use></svg></i><img src="'+response.url+'"></div>')
                                .on('click' , '.deleteImg',function(ss){
                                    ss.currentTarget.parentElement.remove();
                                    $('.filemanager').show();
                                    $('.sendGallery #imageTooltip').show();
                                    $('.messageData #btnFileTicket').hide();
                                })
                        );
                    }else{
                        $('.sendGallery .getImageItem').append(
                            $('<div class="getImagePic"><input type="hidden" name="image[]" value="'+response.id+'"><i class="deleteImg"><svg><use xlink:href="#trash"></use></svg></i><img src="'+response.url+'"></div>')
                                .on('click' , '.deleteImg',function(ss){
                                    $('.filemanager').show();
                                    ss.currentTarget.parentElement.remove();
                                })
                        );
                    }
                    $('.filemanager').hide();
                    $('.sendGallery #imageTooltip').hide();
                },
                error: function(response){
                    $('.allFileManagers #upload-image-form #upload-image').text('آپلود');
                    $('.allFileManagers #image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });

        $('.dropify').dropify({
            messages: {
                default: "بکشید و رها کنید یا برای انتخاب کلیک کنید.",
                replace: "برای جایگزین کردن تصویر بکشید و رها کنید.",
                remove: "حذف تصویر",
                error: "خطایی به وجود آمده است. دوباره تلاش کنید.",
            }
        });
    })
</script>
@endsection

@section('links2')
    <link rel="stylesheet" href="/css/dropify.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/dropify.min.js"></script>
@endsection
