@extends('layouts.app')
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

@section('style')
    <style>
        .main{
            width: 770px;
            height: 520px;
            margin: 0 auto;
            border: 1px solid;
        }
        .main-left{
            width: 60px;
            height: 100%;
            border: 1px solid;
            background-color: #2e3436;
            float: left;
        }
        .main-left-img{
            margin-top: 20px;
            margin-left: 15px;
        }
        .main-left-chat-list{
            margin-top: 30px;
            margin-left: 20px;
        }
        .main-left-friend-list{
            margin-top: 30px;
            margin-left: 20px;
        }
        .main-left-add-friend{
            margin-top: 20px;
            margin-left: 10px;
        }








        .main-middle{
            width: 250px;
            height: 100%;
            border: 1px solid;
            float: left;
        }
        .search-main{
            width: 100%;
            height: 65px;
            /*margin: 30px;*/
            border: 1px solid;
            background-color: #666666;
        }
        .search-img{
            float: left;
            width: 20px;
            height: 28px;
            margin-top: 25px;
            margin-left: 10px;
        }
        .search-text{
            float: left;
            margin-top: 25px;
            width: 170px;
        }
        .search-submit{
            float: left;
            /*width: 20px;*/
            margin-top: 25px;
        }
        .session-list{
            width: 100%;
            height: 65px;
            border: 0 solid;
            float: left;
        }
        .session-list-img{
            margin: 15px;
            height: 40px;
            width: 40px;
            float: left;
        }
        .session-list-body{
            float: left;
        }
        .session-list-name{
            margin-top: 15px;
        }
        .session-list-message{
            margin-top: 1px;
        }
        .session-list-time{
            margin-top: 15px;
            float: right;
            margin-right: 10px;
        }
        .friend-head{
            width: 100%;
            height: 80px;
        }
        .friend-body{
            width: 100%;
        }
        .new_friend{
            width: 100%;
            height: 50px;
        }
        .change_new_friend{
            width: 100%;
            height: 50px;
            background-color: #fff2db;
        }
        .add_word{
            float: left;
            margin-top: 20px;
            font-weight: bold;
        }
        .my_group{
            width: 100%;
            height: 50px;
            float: left;
        }
        .change_group{
            width: 100%;
            height: 50px;
            background-color: #fff2db;
            float: left;
        }
        .friend-footer{
            width: 100%;
        }



        .add-friend-detail{
            width: 100%;
            height: 80px;
        }
        .add-friend-img{
            margin-top: 20px;
            margin-left: 90px;
            height: 50px;
            width: 50px;
            float: left;
        }
        .add-friend-word{
            float: left;
            margin-top: 25px;
            margin-left: 10px;
            font-weight: bold;
        }
        .main-right{
            float: left;
            width: 458px;
            height: 100%;
            border: 1px solid;
        }
        .chat-header{
            height: 65px;
            width: 100%;
            border: 1px solid;
            background-color: #f4f7eb;
        }
        .friend-name{
            margin-top: 30px;
            margin-left: 30px;
        }
        .chat-body{
            height: 310px;
            width: 100%;
            border: 1px solid;
            overflow-y: auto;
        }
        .body-friend{
            height: 10px;
            width: 100%;
            /*margin-top: 30px;*/
        }
        .friend-detail{
            height: 30px;
            width: 30px;
            margin-top: 30px;
            margin-left: 35px;
        }
        .message:before{
            top:0;
            left:0;
        }
        .chat-footer{
            height: 141px;
            width: 100%;
            border: 1px solid;
        }
        .image-input > input {
            display: none;
        }

        /*聊天框样式*/
        .chat-left{
            width: 437px;
            /*height: 60px;*/
        }
        .div1 {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 75px;
            max-width: 140px;
            background: #dce7ff;
            position: relative;
            padding: 5px;
            word-wrap: break-word;
            word-break: break-all;
        }
        .div1:before {
            content: "";
            width: 0;
            height: 0;
            right: 100%;
            top: 8px;
            position: absolute;
            border: 5px solid transparent;
            border-right: 8px solid #dce7ff;
        }
        .div2 {
            margin-top: 10px;
            margin-left: 228px;
            max-width: 140px;
            background: #70e055;
            position: relative;
            padding: 5px;
            word-wrap: break-word;
            word-break: break-all;
        }
        .div2:before {
            content: "";
            width: 0;
            height: 0;
            left: 100%;
            top: 8px;
            position: absolute;
            border: 5px solid transparent;
            border-left: 8px solid #70e055;
        }
        .div1-file {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 75px;
            max-width: 180px;
            /*height: 80px;*/
            background: #dce7ff;
            position: relative;
            word-wrap: break-word;
            word-break: break-all;
        }
        .div1-file:before {
            content: "";
            width: 0;
            height: 0;
            right: 100%;
            top: 8px;
            position: absolute;
            border: 5px solid transparent;
            border-right: 8px solid #dce7ff;
        }
        .div2-file {
            margin-top: 10px;
            margin-left: 188px;
            max-width: 180px;
            background: #dce7ff;
            position: relative;
            padding: 5px;
            word-wrap: break-word;
            word-break: break-all;
        }
        .div2-file:before {
            content: "";
            width: 0;
            height: 0;
            left: 100%;
            top: 8px;
            position: absolute;
            border: 5px solid transparent;
            border-left: 8px solid #dce7ff;
        }
        .chat-img-left{
            margin-top: 0;
            width: 40px;
            height: 40px;
            margin-left: 25px;
            float: left;
        }
        .chat-img-right{
            margin-top: 0;
            width: 40px;
            height: 40px;
            margin-right: 15px;
            float: right;
        }
        .file-detail{
            padding:10px;
        }
        .file-detail-filename{

        }
        .file-detail-size{

        }
    </style>
    @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="main">
            {{--左边部分--}}
            <div class="main-left">
                <div class="main-left-img">
                    <img data-toggle="modal" data-target="#Modal" src="{{Auth::user()->pic_url}}" height="30" width="30">
                </div>
                <div class="main-left-chat-list">
                    <img src="http://qiudaniu.top/images/chat_list.jpg"
                         height="20" width="20" onclick="sessionList()">
                </div>
                <div class="main-left-friend-list">
                    <img src="http://qiudaniu.top/images/friend_list.jpg"
                         height="20" width="20" onclick="friendList()">
                </div>
                <div class="main-left-add-friend">
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                        +
                    </button>
                </div>
            </div>
            {{--弹出框--}}
            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                修改个人信息
                            </h4>
                        </div>
                        <div class="modal-body">
                            <label for="name">
                                用户名
                                <input type="text" name="name" id="name" />
                            </label>
                            <label for="phone">
                                电话号码
                                <input type="text" name="phone" id="phone" />
                            </label>
                            <label for="email">
                                邮箱
                                <input type="text" name="email" id="email" />
                            </label>
                            <label for="pic_url">
                                头像
                                <input type="file" name="pic_url" id="pic_url" />
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                            <button type="button" class="btn btn-primary" onclick="updateProfile()">
                                修改
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
            {{--弹出框--}}
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                添加好友
                            </h4>
                        </div>
                        <div class="modal-body">
                            <label for="add_friend">
                                好友电话号码：
                                <input type="text" name="add_friend" id="add_friend" />
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                            <button type="button" class="btn btn-primary" onclick="sendAddFriendRequest()">
                                提交更改
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>

            {{--中间部分--}}
            <div class="main-middle">
                {{--搜索框--}}
                <div class="search-main">
                    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552156926711&di=4be383b64e02c10412c605c75161d2da&imgtype=0&src=http%3A%2F%2Fpic.qiantucdn.com%2F58pic%2F17%2F73%2F57%2F24v58PICpyg_1024.png" class="search-img">
                    <input type="text" name="search" class="search-text" placeholder="搜索" />
                    <input type="submit" name="search-submit" class="search-submit" value="提交">
                </div>
                {{--会话列表--}}
                <div style="display: block" id="session">


                </div>
                {{--好友列表--}}
                <div style="display: none;" id="friend">
                    <div class="friend-head">
                        <div style="height: 20px;width: 100%;margin-left: 20px">
                            <span><h6>新的朋友</h6></span>
                        </div>
                        <div onmouseover="this.className='change_new_friend'" onmouseout="this.className='new_friend'" class="new_friend" onclick="show_friend_list()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">新的朋友</span>
                            <div id="new_request" style="display: none"><span style="background-color: red">.</span></div>
                        </div>
                    </div>
                    <div class="friend-body">
                        <div style="height: 20px;width: 100%;margin-left: 20px;">
                            <span><h6>群聊</h6></span>
                        </div>
                        <div onmouseover="this.className='change_group'" onmouseout="this.className='my_group'" class="my_group" onclick="group_detail()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">群聊</span>
                        </div>
                        <div onmouseover="this.className='change_group'" onmouseout="this.className='my_group'" class="my_group" onclick="group_detail()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">群聊</span>
                        </div>
                    </div>
                    <div class="friend-footer">
                        <div style="height: 20px;width: 100%;margin-left: 20px;margin-bottom: 10px; float: left">
                            <span><h6>好友</h6></span>
                        </div>

                        <div id="friend_list">

                        </div>
                    </div>

                </div>
            </div>
            {{--聊天框详情--}}
            <div style="display: block;" id="chat_detail" class="main-right">

            </div>
            {{--添加好友--}}
            <div style="display: none;" id="add_friend_detail" class="main-right">
                <div class="chat-header">
                    <h4 class="friend-name">新的朋友</h4>
                </div>
                <div id="add_friend_detail_list">

                </div>
            </div>
            {{--群聊详情--}}
            <div style="display: none;" id="group_detail" class="main-right">
                <div class="chat-header">
                    <h4 class="friend-name">女朋友</h4>
                </div>
                <div class="chat-body">
                    <div class="body-friend">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                             class="friend-detail">
                        <div class="message">
                            群聊
                        </div>
                    </div>
                    <div class="body-me">

                    </div>
                </div>
                <div class="chat-footer">
                    <div class="tool">
                        {{--发送文件 聊天记录 {{url('test')}}--}}
                        {{--<form action="{{url('test')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}--}}
                        <div class="image-input">
                            <label for="file-input">
                                <img src="{{asset('images/file.jpg')}}" height="30px" width="30px">
                            </label>
                            <input id="file-input" type="file" name="file" onclick="sendFile()">
                        </div>
                        <textarea rows="3" cols="62" id="send-data">

                        </textarea>
                        {{--点击发送时，1 将数据发送到后端 2 将数据呈现在内容body中 type="submit" name="submit" value="发送"--}}
                        <input style="float: right" type="button" value="发送" onclick="outData()" >
                        {{--</form>--}}


                    </div>
                </div>
            </div>
            {{--好友详情--}}
            <div style="display: none;" id="friend_detail" class="main-right">
                <div class="chat-header">
                    <h4 class="friend-name" id="friend_chat"></h4>
                </div>
                <div class="chat-body">
                    <div class="body-friend">

                    </div>
                    <div class="body-me">

                    </div>
                </div>
                <div class="chat-footer">
                    <div class="tool">
                        {{--发送文件 聊天记录 {{url('test')}}--}}
                        {{--<form action="{{url('test')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}--}}
                        <div class="image-input">
                            <label for="file-input">
                                <img src="{{asset('images/file.jpg')}}" height="30px" width="30px">
                            </label>
                            <input id="file-input" type="file" name="file">
                        </div>
                        <textarea rows="3" cols="62" id="send-data">

                            </textarea>
                        {{--点击发送时，1 将数据发送到后端 2 将数据呈现在内容body中 type="submit" name="submit" value="发送"--}}
                        <input style="float: right" type="button" value="发送" onclick="outData()" >
                        {{--</form>--}}


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>

    //获取元素长度
    function getTextWidth(str) {
        var width;
        var html = document.createElement('span');
        html.innerText = str;
        html.className = 'getTextWidth';
        document.querySelector('body').appendChild(html);
        width = document.querySelector('.getTextWidth').offsetWidth;
        document.querySelector('.getTextWidth').remove();
        return width;
    }

    function addFriend(id){
        var vs = $('select  option:selected').val();
        //回复加好友请求
        $.ajax({
            type:'post',
            url:'/addFriend',
            data:{'status':vs,'from_user_id':id},
            headers : {
                'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
            },
            success:function ($e) {
                console.log($e);
            },
            error:function ($e) {
                alert('fail'+$e);
            }
        });
    }

    //获取会话列表
    function getSession() {
        $.ajax({
            type:'GET',
            url: "/getSessionList",
            success:function($e){
                var obj = JSON.parse($e);
                if (obj.code === 207){
                    var str = '';
                    var dataArr = obj.data;
                    for(var i=0,len=dataArr.length ; i<len ; i++){
                        var arr = dataArr[i]['message'];
                        if (Array.isArray(arr) && arr.length === 0)
                        {
                            arr = 0;
                        }else {
                            //转义双引号
                            arr=JSON.stringify(arr).replace(/"/g,'&quot;');
//                        arr.replace(/\"/g,'&quot;');
                        }
                        str += '<div class="session-list" id="session_'+dataArr[i]['session_id']+'" onclick="show_chat_detail(this,'+arr+')">'+
                            '<input type="hidden" name="from_session_id" value="'+dataArr[i]['session_id']+'">'+
                            '<input type="hidden" name="to_session_id" value="'+dataArr[i]['to_session_id'][0]['session_id']+'">'+
                            '<div class="session-list-img">'+
                            '<img src="'+dataArr[i]['pic_url']+'" height="40px" width="40px">'+
                            '</div>'+
                            '<div class="session-list-body">'+
                            '<div class="session-list-name">'+
                            dataArr[i]['re_mark']+
                            '</div>'+
                            '<div class="session-list-message">'+
                            dataArr[i]['re_mark']+
                            '</div>'+
                            '</div>'+
                            '<div class="session-list-time">'+
                            '14:15'+
                            '</div>'+
                            '</div>';
                    }
                    if(str)
                    {
                        document.getElementById("session").innerHTML = str;
                    }

                }
            }
        });
    }
    function getFriend() {
        //获取好友列表
        $.ajax({
            type:'GET',
            url: "/getFriendList",
            success : function ($e) {
                var obj = JSON.parse($e);
                if (obj.code === 206){
                    var str = '';
                    var dataArr = obj.data;
                    for(var i=0,len=dataArr.length ; i<len ; i++){
                        str += '<div onmouseover="this.className=\'change_group\'" onmouseout="this.className=\'my_group\'" class="my_group" onclick="friend_detail(this)">' +
                            '<div class="session-list-img">' +
                            '<img src="'+dataArr[0]['pic_url']+'" height="30px" width="30px">' +
                            '</div>' +
                            '<span class="add_word">' + dataArr[i]['re_mark'] + '</span>' +
                            '<input type="hidden" name="my_friend_id" value="'+dataArr[i]['my_friend_id']+'">'+
                            '</div>';
                    }
                    if(str)
                    {
                        document.getElementById('friend_list').innerHTML = str;
                    }
                }
            }

        });
    }
    window.onload=function (){
        getSession();
        getFriend();
        var order=document.getElementsByClassName("session-list");
        if(order.length !== 0)
        {
            order[0].style="background-color:#f4f7eb";
        }

        var div1 = document.getElementsByClassName("div1");
        for (var idiv1 = 0; idiv1 < div1.length; idiv1++) {
            if (getTextWidth(div1[idiv1].innerText) < 140) {
                div1[idiv1].style.maxWidth = getTextWidth(div1[idiv1].innerText) + 12 + 'px';
            }
        }
        var div2 = document.getElementsByClassName("div2");
        for (var i = 0; i < div2.length; i++) {
            if (getTextWidth(div2[i].innerText) < 140) {
                div2[i].style.maxWidth = getTextWidth(div2[i].innerText) + 10 + 'px';
                div2[i].style.marginLeft = 376 - getTextWidth(div2[i].innerText) + 'px';
            }
        }
    };
    ws = new WebSocket("ws://127.0.0.1:8282");
    ws.onmessage = function($e){
        $data = JSON.parse($e.data);
        switch ($data.type){
            case 'ping' :
//                alert($data.type);
                break;
            case 'bind' :
                //连接了socket，返回client_id后去ajax发起请求去绑定client_id 与 uid
                $.ajax({
                    type : 'post',
                    url : '/bind',
                    data : {'client_id':$data.client_id},
                    //            dataType :"json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function($data){
//                        alert('ok');`
                    },
                    error : function ($data) {
                        alert("fail"+$data);
                    }

                });
                break;
            case 'add_friend_request':
                document.getElementById('friend').style.display = 'block';
                document.getElementById('session').style.display = 'none';
                document.getElementById('new_request').style.display = 'block';
                var str = '';
                str += '<div class="add-friend-detail">' +
                    '                <div class="add-friend-img">' +
                    '                <img src="'+$data.pic_url+'"' +
                    '                height="50px" width="50px">' +
                    '                </div>' +
                    '                <span class="add-friend-word"><h4>'+$data.message+'</h4></span>' +
                    '            <div id="select_status" style="margin-top: 35px;margin-left: 50px;float: left">' +
                    // '                <input type="hidden" id="from_user_id" name="from_user_id" value="'+$data.from_user_id+'">' +
                    '                <select onchange="addFriend('+$data.form_user_id+')" name="status">' +
                    '                <option value="">请选择</option>' +
                    '                <option value="1">同意</option>' +
                    '                <option value="2">拒绝</option>' +
                    '                </select>' +
                    '                </div>' +
                    '                </div>';
                document.getElementById("add_friend_detail_list").innerHTML = str;
                break;
            case 'text':
                $("#session_"+$data['to_session_id']).trigger("click");
                var chat_body = document.getElementById("chat_body");
                //创建chat-left class div  1级
                var chat_left = document.createElement("div");
                chat_left.className = "chat-left";
                chat_body.appendChild(chat_left);
                //创建chat-img-right class div 以及 div2 class div 2级
                var chat_img_left = document.createElement("div");
                chat_img_left.className = "chat-img-left";
                chat_left.appendChild(chat_img_left);
                //在"chat-img-right 下创建img 标签
                var img = document.createElement("img");
                img.style.height = "35px";
                img.style.width = "35px";
                img.src = "{{Auth::user()->pic_url}}";
                chat_img_left.appendChild(img);
                var div11 = document.createElement("div");
                var content = document.createTextNode($data['message_data']);
                div11.className = "div1";
                div11.appendChild(content);
                chat_left.appendChild(div11);
                Calculation("div1");
                getSession();
                break;
            case 'file':
                $("#session_"+$data['to_session_id']).trigger("click");
                //发送文件成功 将文件样式输出到屏幕上  带两个数据 一个是文件名，一个是文件大小
                var chat_body_receive = document.getElementById("chat_body");
                //创建chat-left class div  1级
                var chat_left_receive = document.createElement("div");
                chat_left_receive.className = "chat-left";
                chat_body_receive.appendChild(chat_left_receive);
                //创建chat-img-right class div 以及 div2 class div 2级
                var chat_img_left_receive = document.createElement("div");
                chat_img_left_receive.className = "chat-img-left";
                chat_left_receive.appendChild(chat_img_left_receive);
                //在"chat-img-right 下创建img 标签
                var img_receive = document.createElement("img");
                img_receive.style.height = "35px";
                img_receive.style.width = "35px";
                img_receive.src = "{{Auth::user()->pic_url}}";
                chat_img_left_receive.appendChild(img_receive);
                //div1-file
                var div1_file = document.createElement("div");
                div1_file.className = "div1-file";
                chat_left_receive.appendChild(div1_file);
                //file_detail
                var file_detail_receive = document.createElement("div");
                file_detail_receive.className = "file-detail";
                div1_file.appendChild(file_detail_receive);
                //文件名
                var fileName = document.createElement("span");
                var filename = document.createTextNode($data['fileName']);
                fileName.appendChild(filename);
                file_detail_receive.appendChild(filename);
                //文件大小
                var fileSizeAll = document.createElement("div");
                var sizeSpan = document.createElement("span");
                var filesize = document.createTextNode($data['size']+"KB");
                sizeSpan.appendChild(filesize);
                var sizeLink = document.createElement("a");
                sizeLink.setAttribute('href',$data['message_data']);
                sizeLink.setAttribute('download',$data['fileName']);
                sizeLink.setAttribute('style',"float:right");
                var link = document.createTextNode("下载");
                sizeLink.appendChild(link);
                fileSizeAll.appendChild(sizeSpan);
                fileSizeAll.appendChild(sizeLink);
                file_detail_receive.appendChild(fileSizeAll);
                break;
            default:
                break;
        }
    };

    //关闭gatewayworker 时触发onclose函数
    ws.onclose = function () {
        alert('连接关闭了');
    };
    function outData(session_id,to_session_id) {
        var message = $("#send-data").val();
        $.ajax({
            type: 'POST',
            url: "/message",
//            contentType: "application/json",//如果想以json格式把数据提交到后台的话，这个必须有，否则只会当做表单提交
            data: {"session_id": session_id , "to_session_id":to_session_id , "data": {"type":"text","message":message}},//JSON.stringify()必须有,否则只会当做表单的格式提交
//            dataType: "json",//期待返回的数据类型
            /*headers : {
                'X-CSRF-TOKEN' : $('meta[name = "_token"]').attr('content')
            },*/
            success: function () {
                $("#send-data").val('');
                var chat_body = document.getElementById("chat_body");
                //创建chat-left class div  1级
                var chat_left = document.createElement("div");
                chat_left.className = "chat-left";
                chat_body.appendChild(chat_left);
                //创建chat-img-right class div 以及 div2 class div 2级
                var chat_img_right = document.createElement("div");
                chat_img_right.className = "chat-img-right";
                chat_left.appendChild(chat_img_right);
                //在"chat-img-right 下创建img 标签
                var img = document.createElement("img");
                img.style.height = "35px";
                img.style.width = "35px";
                img.src = "{{Auth::user()->pic_url}}";
                chat_img_right.appendChild(img);
                var div11 = document.createElement("div");
                var content = document.createTextNode(message);
                div11.className = "div2";
                div11.appendChild(content);
                chat_left.appendChild(div11);
                Calculation("div2");
            },
            error: function (data) {
                alert("error" + data.data);
            }
        });
    }
    function Calculation(index) {
        var div1 = document.getElementsByClassName(index);
        for (var idiv1 = 0; idiv1 < div1.length; idiv1++) {
            if (getTextWidth(div1[idiv1].innerText) < 140) {
                div1[idiv1].style.maxWidth = getTextWidth(div1[idiv1].innerText) + 12 + 'px';
                if(index === "div2")
                {
                    div1[idiv1].style.marginLeft = 355 -getTextWidth(div1[idiv1].innerText)+'px';
                }
            }
        }
    }
    function sessionList() {
        document.getElementById("session").style.display = 'block';
        document.getElementById("friend").style.display = 'none';
    }

    function friendList() {
        document.getElementById("friend").style.display = 'block';
        document.getElementById("session").style.display = 'none';
    }

    function show_chat_detail(obj,message) {
        document.getElementById("chat_detail").style.display = 'block';
        document.getElementById("add_friend_detail").style.display = 'none';
        document.getElementById("group_detail").style.display = 'none';
        document.getElementById("friend_detail").style.display = 'none';
        var order=document.getElementsByClassName("session-list");
        if(order.length != 0)
        {
            for(j=0;j<order.length;j++){//在点击事件中再加载一个遍历，当点击事件触发时，先让其他元素的颜色保持不变
                order[j].style="background-color:aliceblue";
            }
            obj.style="background-color:#f4f7eb";//为什么要用this，而不是orderLi[i]，要点击的事件块发生颜色变化，同时上一步使得其他的块颜色保持不变，这就让上一次点击变化<br>//的颜色恢复到原来的颜色
        }
        var str = '';
        str += '<div class="chat-header">'+
            '<h4 class="friend-name">'+obj.getElementsByClassName("session-list-name")[0].innerHTML+'</h4>'+
            '</div>'+
            '<div class="chat-body" id="chat_body">';
        if (message !== [])
        {
            for (var i=0, len = message.length; i<len;i++)
            {
                if (obj.getElementsByTagName("input")[0].value != message[i]['session_id']) {
                    if (message[i]['message_type'] == 1)
                    {
                        var arr = message[i]['message_data'].split('_');
                        var filename = arr[arr.length-1];
                        str +='<div class="chat-left">'+
                            '<div class="chat-img-left">'+
                            '<img height="35px" width="35px" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3402452885,2340606435&fm=173&app=49&f=JPEG?w=640&h=463&s=D43371DA5E62049C48683419030080C4">'+
                            '</div>'+
                            '<div class="div1-file">'+
                            '<div class="file-detail">'+
                            filename+
                            '<div>'+
                            '<span>KB</span>'+
                            '<a style="float: right;" href="'+message[i]['message_data']+'" download="'+filename+'">下载</a>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
                    }else{
                        str +='<div class="chat-left">'+
                            '<div class="chat-img-left">'+
                            '<img height="35px" width="35px" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3402452885,2340606435&fm=173&app=49&f=JPEG?w=640&h=463&s=D43371DA5E62049C48683419030080C4">'+
                            '</div>'+
                            '<div class="div1">'+message[i]['message_data']+'</div>'+
                            '</div>';
                    }
                }
                else {
                    if (message[i]['message_type'] == 1)
                    {
                        var arr = message[i]['message_data'].split('_');
                        var filename = arr[arr.length - 1];
                        str += '<div class="chat-left">' +
                            '<div class="chat-img-right">' +
                            '<img height="35px" width="35px" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3402452885,2340606435&fm=173&app=49&f=JPEG?w=640&h=463&s=D43371DA5E62049C48683419030080C4">' +
                            '</div>' +
                            '<div class="div2-file">' +
                            '<div class="file-detail">' +
                            filename +
                            '<div>' +
                            '<span>KB</span>' +
                            '<a style="float: right;" href="' + message[i]['message_data'] + '" download="' + filename + '">下载</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    } else {
                        str += '<div class="chat-left">' +
                            '<div class="chat-img-right">' +
                            '<img height="35px" width="35px" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3402452885,2340606435&fm=173&app=49&f=JPEG?w=640&h=463&s=D43371DA5E62049C48683419030080C4">' +
                            '</div>' +
                            '<div class="div2">' + message[i]['message_data'] + '</div>' +
                            '</div>';
                    }

                }
            }
        }
        str +=' </div>'+
            '<div class="chat-footer">'+
            '<div class="tool">'+
            '<div class="image-input">'+
            '<label for="file_input">'+
            '<img src="{{asset('images/file.jpg')}}" height="30px" width="30px">'+
            '</label>'+
            '<input id="file_input" type="file" name="file" onchange="fileLoad(this,'+obj.getElementsByTagName("input")[0].value+','+obj.getElementsByTagName("input")[1].value+')">'+
            '</div>'+
            '<textarea rows="3" cols="62" id="send-data">'+
            '</textarea>'+
            '<input style="float: right" type="button" value="发送" onclick="outData('+obj.getElementsByTagName("input")[0].value+','+obj.getElementsByTagName("input")[1].value+')" >'+
            '</div>'+
            '</div>';
        if(str)
        {
            document.getElementById("chat_detail").innerHTML = str;
            Calculation("div1");
            Calculation("div2");
        }
    }

    function show_friend_list() {
        document.getElementById("chat_detail").style.display = 'none';
        document.getElementById("add_friend_detail").style.display = 'block';
        document.getElementById("group_detail").style.display = 'none';
        document.getElementById("friend_detail").style.display = 'none';
        document.getElementById('new_request').style.display = 'none';
    }

    function group_detail() {
        document.getElementById("chat_detail").style.display = 'none';
        document.getElementById("add_friend_detail").style.display = 'none';
        document.getElementById("group_detail").style.display = 'block';
        document.getElementById("friend_detail").style.display = 'none';
    }

    function friend_detail(obj) {
        document.getElementById("chat_detail").style.display = 'none';
        document.getElementById("add_friend_detail").style.display = 'none';
        document.getElementById("group_detail").style.display = 'none';
        document.getElementById("friend_detail").style.display = 'block';
        document.getElementsByClassName("friend-name")[3]['innerHTML'] = obj.getElementsByClassName("add_word")[0]['innerHTML'];
        document.getElementById("friend").style.display = 'none';
        document.getElementById("session").style.display = 'block';

    }

    function updateProfile(){
        var name = $("#name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var pic_url = $("#pic_url")[0].files[0];
        var formFile = new FormData();
        formFile.append("name",name);
        formFile.append("phone", phone);//加入文件对象
        formFile.append("email", email);//加入文件对象
        formFile.append("pic_url", pic_url); //加入文件对象
        $.ajax({
            type:'POST',
            url:'/profile',
            data:formFile,
            headers : {
                'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
            },
            processData :false, // 不处理发送的数据，因为data值是Formdata对象，不需要对数据做处理
            contentType :false, // 不设置Content-type请求头
            success: function (data) {
                var $data = JSON.parse(data);
                alert($data.message);
//                console.log(data);
            },
            error: function (data) {
                var $data = JSON.parse(data);
                alert($data.message);
            }
        });
    }

    //发送加好友申请
    function sendAddFriendRequest() {
        var phone = $("#add_friend").val();
        $.ajax({
            type:'POST',
            url:'/sendAddFriendRequest',
            data:{'add_friend':phone},
//            dataType:'json',
            headers : {
                'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
            },
            success: function (data) {
                var obj = JSON.parse(data);
                // console.log(obj);
                if (obj.code === 201 || obj.code === 208 || obj.code ===210) {
                    alert(obj.message);
                    var str = '';
                    var dataArr = obj.data;
                    console.log(dataArr);
                    for(var i=0,len=dataArr.length ; i<len ; i++){
                        str += '<div class="session-list" onclick="show_chat_detail()">'+
                            '<div class="session-list-img">'+
                            '<img src="'+dataArr[i]['pic_url']+'" height="40px" width="40px">'+
                            '</div>'+
                            '<div class="session-list-body">'+
                            '<div class="session-list-name">'+
                            dataArr[i]['re_mark']+
                            '</div>'+
                            '<div class="session-list-message">'+
                            dataArr[i]['re_mark']+
                            '</div>'+
                            '</div>'+
                            '<div class="session-list-time">'+
                            '14:15'+
                            '</div>'+
                            '</div>';
                    }
                    document.getElementById("add_friend_detail").innerHTML = str;
                }
            },
            error: function (data) {
                console.log(data);
                alert("error" + data.data);
            }
        });
    }
    //③创建fileLoad方法用来上传文件
    function fileLoad(ele,session_id,to_session_id){
        //④创建一个formData对象
        var formData = new FormData();
        //⑤获取传入元素的val
        var name = $(ele).val();
        //⑥获取files
        var files = $(ele)[0].files[0];
        //⑦将name 和 files 添加到formData中，键值对形式
        formData.append("file", files);
//        formData.append("name", name);
        formData.append("session_id", session_id);
        formData.append("to_session_id", to_session_id);
        $.ajax({
            url: "receiveFile",
            type: 'POST',
            data: formData,
            processData: false,// ⑧告诉jQuery不要去处理发送的数据
            contentType: false, // ⑨告诉jQuery不要去设置Content-Type请求头
            headers : {
                'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
            },
            /*beforeSend: function () {
                //⑩发送之前的动作
                alert("我还没开始发送呢");
            },*/
            success: function (responseStr) {
                console.log(responseStr);
                var str = JSON.parse(responseStr);
                if (str.message === '图片')
                {
                    alert('ok');
                }
                else
                {
                    //发送文件成功 将文件样式输出到屏幕上  带两个数据 一个是文件名，一个是文件大小
                    var chat_body = document.getElementById("chat_body");
                    //创建chat-left class div  1级
                    var chat_left = document.createElement("div");
                    chat_left.className = "chat-left";
                    chat_body.appendChild(chat_left);
                    //创建chat-img-right class div 以及 div2 class div 2级
                    var chat_img_right = document.createElement("div");
                    chat_img_right.className = "chat-img-right";
                    chat_left.appendChild(chat_img_right);
                    //在"chat-img-right 下创建img 标签
                    var img = document.createElement("img");
                    img.style.height = "35px";
                    img.style.width = "35px";
                    img.src = "{{Auth::user()->pic_url}}";
                    chat_img_right.appendChild(img);
                    //div2-file
                    var div2_file = document.createElement("div");
                    div2_file.className = "div2-file";
                    chat_left.appendChild(div2_file);
                    //file_detail
                    var file_detail = document.createElement("div");
                    file_detail.className = "file-detail";
                    div2_file.appendChild(file_detail);
                    //文件名
                    var fileName = document.createElement("span");
                    var filename = document.createTextNode(files['name']);
                    fileName.appendChild(filename);
                    file_detail.appendChild(filename);
                    //文件大小
                    var fileSizeAll = document.createElement("div");
                    var sizeSpan = document.createElement("span");
                    var filesize = document.createTextNode(files['size']+"KB");
                    sizeSpan.appendChild(filesize);
                    /*var sizeLink = document.createElement("a");
                    sizeLink.setAttribute('href',name);
                    var link = document.createTextNode("查看");
                    sizeLink.appendChild(link);*/
                    fileSizeAll.appendChild(sizeSpan);
//                    fileSizeAll.appendChild(sizeLink);
                    file_detail.appendChild(fileSizeAll);
                }
            }
            ,
            error : function (responseStr) {
                //12出错后的动作
                alert("出错啦");
            }
        });
    }
</script>
