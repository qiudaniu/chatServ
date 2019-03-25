<?php
/**
 * 自定义错误代码
 *
 *
 * 101 好友id为空
 * 102 发送数据为空
 *
 * 201 加好友成功
 * 202 加好友失败
 * 203 已经是好友
 * 204 加好友未知错误
 * 205 返回好友列表
 *
 *
 *
 * 301 用户发送信息，保存到数据库失败
 * 302 用户登录时更新登录状态错误
 *
 * 501 服务器错误
 * */

namespace App\Http\Controllers;

use App\Friends;
use App\message;
use App\Sessions;
use App\User;
use Illuminate\Http\Request;
use GatewayClient\Gateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function __construct()
    {
        Gateway::$registerAddress = '127.0.0.1:1238';
    }

    /**
     * 将client_id 与 user_id 进行绑定
     * @param $client_id
     * @param $user_id
     */
    public function bind(Request $request)
    {
        Gateway::bindUid($request->client_id, Auth::id());
    }

    public function message(Request $request)
    {
        // 发送的数据类型是json格式。
//        $client_id = Redis::get('client_id_' . Auth::id());
//        $this->bind($client_id, Auth::id());

//        $requestData = json_decode($request->getContent());

//        $requestBody = file_get_contents('php://input');
        //$requestData 按照对象来获取属性
//        exit(var_export($request->data));
        $user_id = empty($request->user_id) ? '' : $request->user_id;
        if (!$user_id) {
            return $this->responseMsg('好友id不能为空', 101);
        }
        $data = empty($request->data) ? '' : $request->data;
        if (!$data) {
            return $this->responseMsg('发送数据不能为空', 102);
        }
        //$user_id指的是好友在用户表中的id。接收消息的用户id
//        $this->bind(Redis::get('client_id_'.Auth::id()),Auth::id());
//        return ;
        /*if (Auth::check()){
            exit(var_export(Gateway::getClientIdByUid(1)));
        }*/

        //保存发送给好友的消息，并将消息发送给好友
        $this->receiveData($user_id, $data);

//        return $isONline;
        return $this->success();

    }

    /**
     *   user_id     接收数据用户id
     *   data        数据
     */
    private function receiveData($user_id, $data)
    {
        // 判断用户是否在线。1） 数据库中字段login_status 。 2） 通过gateway::isUidOnline 判断用户是否在线
        /*
         * 1 保存数据到数据库
         * 2 发送数据给目标用户
         * */
//        exit(var_export($data->type));
        $message = new message();

        $arr = $message->saveData($user_id,$data);
        if (! $arr['id']){
            return $this->responseMsg('数据库错误',301);
        }

        $isUidOnline = Gateway::isUidOnline($user_id);

        $user = User::find($user_id);
        if ($user->login_status == 0 || $isUidOnline == 0){
            return $this->responseMsg('对方没有上线，不能发送消息',103);
        }

        //发送消息给好友
        $sendData = json_encode($arr['data']);
        //sendToUid 中的 data 是一个字符串，所以要将数据转换成json数据
        Gateway::sendToUid($user_id,$sendData);

    }

    //加好友
    public function addFriend(Request $request)
    {
        $user = User::findUserForPhone($request->add_friend);
        if ($user){
            $friend = Friends::addFriend(Auth::id(),$user->id);
            if ($friend == 'ok'){
                return $this->responseMsg('添加好友成功',201);
            }elseif ($friend == 'fail'){
                return $this->responseMsg('添加好友失败',202);
            }elseif ($friend == 'is_friend'){
                return $this->responseMsg('已经是好友',203);
            }else{
                return $this->responseMsg('添加好友未知错误',204);
            }
        }
    }

    //返回会话列表.携带所有的聊天记录
    public function sessionList()
    {
        $list = Sessions::join('friends','sessions.friend_id','=','friends.friend_id')
            ->where('sessions.status','=',0)
            ->where('friends.user_id',Auth::id())
            ->select('')
            ->get();
    }
    //返回好友列表
    public function friendList()
    {
        $list = Friends::leftJoin('users','friends.my_friend_id','=','users.id')
            ->where('user_id',Auth::id())
            ->where('delete','=',0)
            ->select('users.pic_url','friends.user_id','friends.my_friend_id','friends.re_mark')
            ->get();
        return $this->responseData($list,'好友列表',205);
    }
}
