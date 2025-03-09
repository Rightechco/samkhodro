@extends('admin.master')

@section('title' , 'تیکت ها')
@section('tab' , 5)
@section('content')
    <div class="allTicketIndex">
        @if (\Session::has('message'))
            <div class="success">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTickets">
            <div class="container clearfix">
                <div class="people-list" id="people-list">
                    <div class="userInfo">
                        <div class="pic">
                            @if($user->profile)
                                <img src="{{$user->profile}}" alt="{{$user->name}}">
                            @else
                                <img src="/img/user.png" alt="{{$user->name}}">
                            @endif
                            <h4>{{$user->name}}</h4>
                        </div>
                        <i id="addTickets">
                            <svg class="icon">
                                <use xlink:href="#addComment"></use>
                            </svg>
                        </i>
                    </div>
                    <div class="search">
                        <input type="text" placeholder="جستجو..." />
                    </div>
                    <div class="ticketGroups">
                        <div class="ticketGroup active" id="all">همه تیکت ها</div>
                        <div class="ticketGroup" id="open">تیکت باز</div>
                        <div class="ticketGroup" id="close">بسته شده</div>
                    </div>
                    <ul class="list">
                        @foreach($tickets as $item)
                            <li class="clearfix" id="{{$item->id}}">
                                @if($user->id != $item->user->id)
                                    @if($item->user->profile)
                                        <img src="{{$item->user->profile}}" alt="{{$item->user->name}}">
                                    @else
                                        <img src="/img/user.png" alt="{{$item->user->name}}">
                                    @endif
                                @else
                                    @if($item->catch->profile)
                                        <img src="{{$item->catch->profile}}" alt="{{$item->catch->name}}">
                                    @else
                                        <img src="/img/user.png" alt="{{$item->catch->name}}">
                                    @endif
                                @endif
                                <div class="about">
                                    <div class="name">
                                        @if($user->id != $item->user->id)
                                            {{$item->user->name}}
                                        @else
                                            {{$item->catch->name}}
                                        @endif
                                        @if(count($item->tickets) >= 1)
                                            <span>({{$item->tickets[0]->created_at}})</span>
                                        @else
                                            <span>({{$item->created_at}})</span>
                                        @endif
                                    </div>
                                    @if(count($item->tickets) >= 1)
                                        <p>{{$item->tickets[0]->body}}</p>
                                    @else
                                        <p>{{$item->body}}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <img src="" />
                        <div class="chat-about">
                            <div class="chat-with"></div>
                            <div class="chat-num-messages"></div>
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul></ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="messageData">
                            <textarea name="body" placeholder ="متن خود را وارد کنید..."></textarea>
                            <span id="btnFileTicket" style="display:none;">یک فایل آماده وجود دارد</span>
                        </div>
                        <div class="chatButtons">
                            <button class="sendTicket">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#sendTicket"></use>
                                    </svg>
                                </i>
                                ارسال
                            </button>
                            <button class="btnFile">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#add-document"></use>
                                    </svg>
                                </i>
                                پیوست فایل
                            </button>
                            <button class="closeTicket">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#closed"></use>
                                    </svg>
                                </i>
                                بستن تیکت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="addField" style="display:none;">
                <form action="/admin/ticket/create" class="createFilled" method="post">
                    @csrf
                    <div class="allCreatePostSubject">
                        <div class="allCreatePostItem">
                            <label>عنوان* :</label>
                            <input type="text" name="title" placeholder="عنوان را وارد کنید">
                            @error('title')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>کاربر :</label>
                            <select name="catch_id">
                                @foreach($users as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('catch_id')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>توضیحات :</label>
                            <textarea name="body" placeholder="توضیحات را وارد کنید"></textarea>
                            @error('body')
                            <div class="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sendGallery">
                            <div class="getImageItem">
                                <span id="imageTooltip">پیوست را وارد کنید</span>
                            </div>
                        </div>
                        <div class="buttonSend">
                            <button class="button" type="submit">ارسال اطلاعات</button>
                            <button class="btnClose">انصراف</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="sendFiles" style="display:none;">
            <div class="sendPos">
                <div class="sendGallery">
                    <div class="getImageItem">
                        <span id="imageTooltip">پیوست را وارد کنید</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="filemanager" style="display:none;">
            @include('admin.filemanager')
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).mouseup(function(e)
        {
            var container = $(".sendFiles");

            if (container.is(e.target) && container.has(e.target).length === 0)
            {
                container.hide();
            }
        });
        $(document).ready(function(){
            var ticket = '';
            var user = {!! json_encode($user, JSON_HEX_TAG) !!};
            var tickets = {!! json_encode($tickets, JSON_HEX_TAG) !!};
            var myUser = {!! json_encode(auth()->user(), JSON_HEX_TAG) !!};
            $('.btnFile').click(function (){
                $('.sendFiles').toggle();
            })
            $('.sendGallery').click(function (){
                $('.filemanager').toggle();
            })
            $('#addTickets').click(function () {
                $('.allTickets .container').hide();
                $('.allTickets .addField').show();
            })
            $('.container .search input').on('keyup',function () {
                var val = $.trim(this.value);
                $('.allTickets .container #people-list ul').children('li').remove();
                if (val) {
                    val = val.toLowerCase();
                    $.each(tickets, function(_,data) {
                        if (data.title.toLowerCase().indexOf(val) != -1) {
                            getTickets(data);
                        }
                    });
                }else{
                    $.each(tickets, function() {
                        getTickets(this,'stop');
                    });
                }
            })
            $('.ticketGroups div').click(function (){
                $('.ticketGroups').children('div').attr('class' , 'ticketGroup');
                $(this).attr('class' , 'ticketGroup active');
                $('.allTickets .container #people-list ul').children('li').remove();
                if(this.id == 'all'){
                    $.each(tickets, function() {
                        getTickets(this,'stop');
                    });
                }
                if(this.id == 'close'){
                    $.each(tickets, function(_,data) {
                        var myData = data.status.toString()
                        if (myData.indexOf(0) != -1) {
                            getTickets(data,'stop');
                        }
                    });
                }
                if(this.id == 'open'){
                    $.each(tickets, function(_,data) {
                        var myData = data.status.toString()
                        if (myData.toLowerCase().indexOf(1) != -1) {
                            getTickets(data,'stop');
                        }
                    });
                }
            })
            $('.chat-message .sendTicket').click(function (){
                var form = {
                    "_token": "{{ csrf_token() }}",
                    parent:ticket,
                    file_id:$(".sendFiles input[name='image']").val(),
                    user_id:myUser.id,
                    catch_id:user.id,
                    body:$('.chat-message textarea').val(),
                    title:'پاسخ تیکت',
                };
                $.ajax({
                    url: '/admin/ticket/create',
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.chat-message textarea').val('');
                        $('.chat .chat-history ul').children('li').remove();
                        $('.chat .chat-history ul').append(
                            '<li class="clearfix">'+
                            '<div class="message-data '+(data.user.id != user.id ? 'align-left' : '')+'">'+
                            '<span class="message-data-name" >'+data.user.name+'</span>'+
                            '<span class="message-data-time" >('+data.created_at+')</span>'+
                            '</div>'+
                            '<div class="message ' + (data.user.id != user.id ? 'other-message float-left' : 'my-message') + '">' + data.body.replace(/\n/g, '<br>')+
                            (data.image != null ? '<a download href="'+data.image.url+'"><i><svg class="icon"><use xlink:href="#files"></use></svg></i></a>' : '') +
                            '</div></li>'
                        );
                        if(data.tickets.length >= 1) {
                            $.each(data.tickets, function () {
                                $('.chat .chat-history ul').append(
                                    '<li class="clearfix">' +
                                    '<div class="message-data ' + (this.user.id != user.id ? 'align-left' : '') + '">' +
                                    '<span class="message-data-name">' + this.user.name + '</span>' +
                                    '<span class="message-data-time" >('+this.created_at+')</span>'+
                                    '</div>' +
                                    '<div class="message ' + (this.user.id != user.id ? 'other-message float-left' : 'my-message') + '">' + this.body.replace(/\n/g, '<br>')+
                                    (this.image != null ? '<a download href="'+this.image.url+'"><i><svg class="icon"><use xlink:href="#files"></use></svg></i></a>' : '') +
                                    '</div></li>'
                                );
                            })
                        }
                        $('.chat .chat-history').animate({ scrollTop: $('.chat .chat-history ul').height() }, 1000);
                    },
                    error: function (xhr) {
                        alert('متن خود را وارد کنید.')
                    }
                });
            })
            $(document).on('click','.people-list ul li',function () {
                ticket = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    ticket:ticket,
                    user:user.id,
                };
                $.ajax({
                    url: '/admin/ticket/get-ticket',
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.chat .chat-history ul').children('li').remove();
                        if(data.user.id != user.id){
                            if(data.user.profile){
                                $('.chat-header img').attr('src',data.user.profile);
                            }else{
                                $('.chat-header img').attr('src','/img/user.png');
                            }
                        }else{
                            if(data.catch.profile){
                                $('.chat-header img').attr('src',data.catch.profile);
                            }else{
                                $('.chat-header img').attr('src','/img/user.png');
                            }
                        }
                        $('.chat-header .chat-with').text('گفتگو با ' + data.catch.name);
                        $('.chat-header .chat-num-messages').text((parseInt(data.tickets.length)+1) + ' پیام ارسال شده');
                        $('.chat .chat-history ul').append(
                            '<li class="clearfix">'+
                            '<div class="message-data '+(data.user.id != user.id ? 'align-left' : '')+'">'+
                                '<span class="message-data-name" >'+data.user.name+'</span>'+
                                '<span class="message-data-time" >('+data.created_at+')</span>'+
                            '</div>'+
                            '<div class="message ' + (data.user.id != user.id ? 'other-message float-left' : 'my-message') + '">' + data.body.replace(/\n/g, '<br>')+
                            (data.image != null ? '<a download href="'+data.image.url+'"><i><svg class="icon"><use xlink:href="#files"></use></svg></i></a>' : '') +
                            '</div></li>'
                        );
                        if(data.tickets.length >= 1) {
                            $.each(data.tickets, function () {
                                $('.chat .chat-history ul').append(
                                    '<li class="clearfix">' +
                                    '<div class="message-data ' + (this.user.id != user.id ? 'align-left' : '') + '">' +
                                    '<span class="message-data-name">' + this.user.name + '</span>' +
                                    '<span class="message-data-time" >('+this.created_at+')</span>'+
                                    '</div>' +
                                    '<div class="message ' + (this.user.id != user.id ? 'other-message float-left' : 'my-message') + '">' + this.body.replace(/\n/g, '<br>')+
                                    (this.image != null ? '<a download href="'+this.image.url+'"><i><svg class="icon"><use xlink:href="#files"></use></svg></i></a>' : '') +
                                    '</div></li>'
                                );
                            })
                        }
                        $('.chat .chat-history').animate({ scrollTop: $('.chat .chat-history ul').height() }, 1000);
                        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
                        if(data.status == 0){
                            $('.chat .chat-message').hide();
                        }else{
                            $('.chat .chat-message').show();
                        }
                    },
                });
            })
            $('.closeTicket').on('click', function(){
                Swal.fire({
                    title: 'از بستن تیکت مطمئن هستید؟',
                    text: "امکان ارسال پیام مجدد وجود نخواهد داشت",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بستن تیکت',
                    cancelButtonText: 'انصراف',
                    confirmButtonColor: '#30d633',
                    cancelButtonColor: '#d33',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = {
                            "_token": "{{ csrf_token() }}",
                            ticket:ticket,
                            catch_id:user.id,
                        };
                        $.ajax({
                            type:'POST',
                            url: `/admin/ticket/close`,
                            data: form,
                            success: (response) => {
                                $('.chat .chat-message').hide();
                                Swal.fire(
                                    'بسته شد!',
                                    'تیکت انتخاب شده بسته شد',
                                    'success'
                                )
                            },
                        });
                    } else {
                        result.dismiss == Swal.DismissReason.cancel
                    }
                })
            })
            $('.btnClose').on('click', function(e){
                e.preventDefault();
                $('.allTickets .container').show();
                $('.allTickets .addField').hide();
            })
            var getTickets = function(data,stop){
                if(!stop){
                    $('.allTickets .container #people-list ul').children('li').remove();
                }
                $('.allTickets .container #people-list ul').append(
                    '<li class="clearfix" id="'+data.id+'">'+
                    (user.id != data.user.id
                            ?
                            (data.user.profile
                                ?
                                '<img src="'+data.user.profile+'" alt="'+data.user.name+'">'
                                :
                                '<img src="/img/user.png" alt="'+data.user.name+'">')
                            :
                            (data.catch.profile
                                ?
                                '<img src="'+data.catch.profile+'" alt="'+data.catch.name+'">'
                                :
                                '<img src="/img/user.png" alt="'+data.catch.name+'">')
                    )+
                    '<div class="about">'+
                    '<div class="name">'+
                    (user.id != data.user.id
                        ?
                        data.user.name
                        :
                        data.catch.name)+
                    (data.tickets.length >= 1
                        ?
                        '<span>('+data.tickets[0].created_at+')</span>'
                        :
                        '<span>('+data.created_at+')</span>')+
                    '</div>'+
                    (data.tickets.length >= 1
                            ?
                            '<p>'+data.tickets[0].body+'</p>'
                            :
                            '<p>'+data.body+'</p>'
                    )+
                    '</div></li>'
                );
            }
        })
    </script>
@endsection


@section('links')
    <script src="/js/sweetalert.min.js"></script>
@endsection
