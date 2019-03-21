<?php
/**
 * 自定义错误代码
 *
 *
 * 101 好友id为空
 * 102 发送数据为空
 * 103 好友不在线
 *
 *
 *
 * 301 用户发送信息，保存到数据库失败
 * 302 用户登录时更新登录状态错误
 *
 * 501 服务器错误
 * */

namespace App\Http\Controllers;

use App\message;
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
        exit(var_export($request->data));
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
}
