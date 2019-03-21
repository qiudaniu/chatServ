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
        .image-input > input
        {
            display: none;
        }
    </style>
    @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="main">
            <div class="main-left">
                <div class="main-left-img">
                    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552156926711&di=4be383b64e02c10412c605c75161d2da&imgtype=0&src=http%3A%2F%2Fpic.qiantucdn.com%2F58pic%2F17%2F73%2F57%2F24v58PICpyg_1024.png" height="30" width="30">
                </div>
                <div class="main-left-chat-list">
                    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552156926711&di=4be383b64e02c10412c605c75161d2da&imgtype=0&src=http%3A%2F%2Fpic.qiantucdn.com%2F58pic%2F17%2F73%2F57%2F24v58PICpyg_1024.png"
                         height="20" width="20" onclick="sessionList()">
                </div>
                <div class="main-left-friend-list">
                    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552156926711&di=4be383b64e02c10412c605c75161d2da&imgtype=0&src=http%3A%2F%2Fpic.qiantucdn.com%2F58pic%2F17%2F73%2F57%2F24v58PICpyg_1024.png"
                         height="20" width="20" onclick="friendList()">
                </div>
            </div>

            <div class="main-middle">
                <div class="search-main">
                    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552156926711&di=4be383b64e02c10412c605c75161d2da&imgtype=0&src=http%3A%2F%2Fpic.qiantucdn.com%2F58pic%2F17%2F73%2F57%2F24v58PICpyg_1024.png" class="search-img">
                    <input type="text" name="search" class="search-text" placeholder="搜索" />
                    <input type="submit" name="search-submit" class="search-submit">
                </div>
                <div style="display: block" id="session">
                    <div class="session-list">
                        <div class="session-list-img">
                            <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                 height="40px" width="40px">
                        </div>
                        <div class="session-list-body">
                            <div class="session-list-name">
                                邱立峰
                            </div>
                            <div class="session-list-message">
                                hello world
                            </div>
                        </div>

                        <div class="session-list-time">
                            14:15
                        </div>

                    </div>
                    <div class="session-list">
                        <div class="session-list-img">
                            <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                 height="40px" width="40px">
                        </div>
                        <div class="session-list-body">
                            <div class="session-list-name">
                                邱立峰
                            </div>
                            <div class="session-list-message">
                                hello world
                            </div>
                        </div>

                        <div class="session-list-time">
                            14:15
                        </div>

                    </div>

                </div>
                <div style="display: none;" id="friend" class="friend-list">
                    <div class="friend-head">
                        <div style="height: 20px;width: 100%;margin-left: 20px">
                            <span><h6>新的朋友</h6></span>
                        </div>
                        <div onmouseover="this.className='change_new_friend'" onmouseout="this.className='new_friend'" class="new_friend" onclick="display_friend_list()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">新的朋友</span>
                        </div>
                    </div>
                    <div class="friend-body">
                        <div style="height: 20px;width: 100%;margin-left: 20px;">
                            <span><h6>群聊</h6></span>
                        </div>
                        <div onmouseover="this.className='change_group'" onmouseout="this.className='my_group'" class="my_group" onclick="display_friend_list()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">群聊</span>
                        </div>
                        <div onmouseover="this.className='change_group'" onmouseout="this.className='my_group'" class="my_group" onclick="display_friend_list()">
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

                        <div onmouseover="this.className='change_group'" onmouseout="this.className='my_group'" class="my_group" onclick="display_friend_list()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">好友1</span>
                        </div>
                        <div onmouseover="this.className='change_group'" onmouseout="this.className='my_group'" class="my_group" onclick="display_friend_list()">
                            <div class="session-list-img">
                                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                                     height="30px" width="30px">
                            </div>
                            <span class="add_word">好友2</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main-right">
                <div class="chat-header">
                    <h4 class="friend-name">女朋友</h4>
                </div>
                <div class="chat-body">
                    <div class="body-friend">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552207666873&di=3ec7658b5ea67262a3f4c580e2186d43&imgtype=0&src=http%3A%2F%2Fwww.zhuobufan.com%2FUserFiles%2FAlbum%2F17%2F01_12%2F8425d949-328c-414f-8fb3-deeb5d166fd0.jpg"
                             class="friend-detail">
                        <div class="message">
                            nihao
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
        </div>
    </div>
</div>
@endsection
<script>
    window.onload=function (){
        var order=document.getElementsByClassName("session-list");
        order[0].style="background-color:#f4f7eb";
        for(i=0;i<order.length;i++) {//遍历处理，对于每个块都有onclick函数

            order[i].onclick = function () {
                alert(1);
                for(i=0;i<order.length;i++){//在点击事件中再加载一个遍历，当点击事件触发时，先让其他元素的颜色保持不变
                    order[i].style="background-color:aliceblue";
                }
                this.style="background-color:#f4f7eb";//为什么要用this，而不是orderLi[i]，要点击的事件块发生颜色变化，同时上一步使得其他的块颜色保持不变，这就让上一次点击变化<br>//的颜色恢复到原来的颜色
            }

        }
    }
    /*ws = new WebSocket("ws://127.0.0.1:8282");
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
//                        alert('ok');
                    },
                    error : function ($data) {
                        alert("fail"+$data);
                    }

                });
                break;
            default:
                break;
        }
    };*/

    //关闭gatewayworker 时触发onclose函数
    ws.onclose = function () {
        alert('连接关闭了');
    };
    function outData() {
        var message = $("#send-data").val();
        $.ajax({
            type: 'POST',
            url: "/message",
//            contentType: "application/json",//如果想以json格式把数据提交到后台的话，这个必须有，否则只会当做表单提交
            data: {"user_id": 2 , "data": {"type":"text","message":message}},//JSON.stringify()必须有,否则只会当做表单的格式提交
//            dataType: "json",//期待返回的数据类型
            /*headers : {
                'X-CSRF-TOKEN' : $('meta[name = "_token"]').attr('content')
            },*/
            success: function (data) {
                alert("success:" + data);
            },
            error: function (data) {
                alert("error" + data.data);
            }
});
    }
    function sendFile() {

        var $file = document.getElementById("file-input").value;
//        alert($file);
    }
    function sessionList() {
        document.getElementById("session").style.display = 'block';
        document.getElementById("friend").style.display = 'none';
    }

    function friendList() {
        document.getElementById("friend").style.display = 'block';
        document.getElementById("session").style.display = 'none';
    }

    function display_friend_list() {
        alert(1);
    }

    /*function writeObj(obj){
        var description = "";
        for(var i in obj){
            var property=obj[i];
            description+=i+" = "+property+"\n";
        }
        alert(description);
    }*/
</script>
