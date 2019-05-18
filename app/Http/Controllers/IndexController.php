<?php
/**
 * 自定义错误代码
 *
 *
 * 101 好友id为空
 * 102 发送数据为空
 * 103 好友不在线，将消息数据保存到数据库中
 *
 * 201 发送好友申请
 * 202 加好友成功
 * 203 加好友失败
 * 204 已经是好友
 * 205 加好友未知错误
 * 206 返回好友列表
 * 207 返回会话列表
 * 208 没有此用户
 * 209 拒绝加好友
 * 210 用户不在线
 * 211 登录时获取未读消息
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
    public $test;
    public function __construct(Request $request)
    {
        Gateway::$registerAddress = '127.0.0.1:1238';
//        $this->bind($request->client_id);
        $this->test = 1;
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
        $session_id = empty($request->session_id) ? '' : $request->session_id;
        if (!$session_id) {
            return $this->responseMsg('会话id不能为空', 101);
        }
        $to_session_id = empty($request->to_session_id) ? '' : $request->to_session_id;
        if (!$to_session_id) {
            return $this->responseMsg('会话id不能为空', 101);
        }
        $data = empty($request->data) ? '' : $request->data;
        if (!$data) {
            return $this->responseMsg('发送数据不能为空', 102);
        }

        //保存发送给好友的消息，并将消息发送给好友
        $this->receiveData($session_id,$to_session_id, $data);

        return $this->success();

    }

    /**
     *   session_id     发送数据用户会话id
     *   to_session_id  接收数据用户会话id
     *   data           数据
     */
    private function receiveData($session_id,$to_session_id, $data)
    {
        // 判断用户是否在线。1） 数据库中字段login_status 。 2） 通过gateway::isUidOnline 判断用户是否在线
        /*
         * 1 保存数据到数据库
         * 2 发送数据给目标用户
         * */
//        exit(var_export($data->type));
        $message = new message();

        $arr = $message->saveData($session_id,$to_session_id,$data);
        if (! $arr['id']){
            return $this->responseMsg('数据库错误',301);
        }

        $this->sendMessage($arr,$session_id);
        $message->updateNotRead($arr['id']);

    }

    private function sendMessage($arr,$session_id)
    {
        $this->checkUserOnline($arr['my_friend_id'],$session_id);
        //发送消息给好友
        $sendData = json_encode($arr['data']);
        //sendToUid 中的 data 是一个字符串，所以要将数据转换成json数据
        Gateway::sendToUid($arr['my_friend_id'],$sendData);
    }

    //验证用户是否在线
    private function checkUserOnline($my_friend_id,$session_id)
    {
        $isUidOnline = Gateway::isUidOnline($my_friend_id);

        $user = User::find($my_friend_id);
        if ($user->login_status == 0 || $isUidOnline == 0){
            message::where('session_id',$session_id)->update(['is_read'=>0]);
            return $this->responseMsg('好友暂时未上线，上线后将第一时间发送消息给好友',103);
        }

    }
    //发送加好友请求
    public function sendAddFriendRequest(Request $request)
    {
        $user = User::findUserForPhone($request->add_friend);
        if ($user){
            //当用户存在。发送添加好友请求，如果好友通过后，添加成功；不通过，添加失败
            $re_mark = User::where('id',Auth::id())->select('id','name','pic_url','login_status')->first();
            $data = json_encode([
                'type'=>'add_friend_request',
                'message'=> $re_mark['name'].'请求添加为好友',
                'pic_url' => $re_mark['pic_url'],
                'form_user_id' => Auth::id(),
            ]);
            /*if ($re_mark['login_status'] == 0){
                return $this->responseMsg('用户不在线，请确认用户上线后再添加为好友',210);
            }*/
            Gateway::sendToUid($user->id,$data);
            return $this->responseMsg('好友请求已发送，等待好友回复',201);
        }
        return $this->responseMsg('查无此用户，请确认后重试',208);
    }

    //好友通过后，双方添加为好友。
    public function addFriend(Request $request)
    {
        switch ($request->status) {
            case 1:
                $friend = Friends::addFriend(Auth::id(), $request->from_user_id);
                if ($friend == 'ok') {
                    return $this->responseMsg('添加好友成功', 202);
                } elseif ($friend == 'fail') {
                    return $this->responseMsg('添加好友失败', 203);
                } elseif ($friend == 'is_friend') {
                    return $this->responseMsg('已经是好友', 204);
                } else {
                    return $this->responseMsg('添加好友未知错误', 205);
                }
                break;
            case 2:
                return $this->responseMsg('对方拒绝加好友', 209);
                break;
            default:
                break;
        }
    }

    //返回会话列表.携带所有的聊天记录
    public function sessionList()
    {
        $list = Sessions::leftjoin('friends','sessions.friend_id','=','friends.friend_id')
            ->leftJoin('users','friends.user_id','=','users.id')
            ->where('sessions.status','=',0)
            ->where('friends.defriend','=',0)
            ->where('friends.user_id',Auth::id())
            ->select('friends.friend_id','friends.my_friend_id','friends.re_mark','sessions.session_id','users.pic_url') //,'messages.*'
            ->get();
        foreach ($list as $key=>$value){
            $list[$key]['to_session_id'] = Sessions::join('friends','sessions.friend_id','friends.friend_id')
                ->where('friends.user_id',$list[$key]['my_friend_id'])
                ->where('friends.my_friend_id',Auth::id())
                ->select('session_id')
                ->get();
            $list[$key]['message'] = message::wherein('to_session_id',[$list[$key]['session_id'],$list[$key]['to_session_id'][0]['session_id']])
                ->get();
        }

        return $this->responseData($list,'会话列表',207);
    }
    //返回好友列表
    public function friendList()
    {
        $list = Friends::leftJoin('users','friends.my_friend_id','=','users.id')
            ->where('user_id',Auth::id())
            ->where('delete','=',0)
            ->select('users.pic_url','friends.user_id','friends.my_friend_id','friends.re_mark')
            ->get();
        return $this->responseData($list,'好友列表',206);
    }

    //接收文件和图片
    public function receiveFile(Request $request)
    {
        /*header("Content-type: text/html; charset=utf-8");
        $file = $_FILES['file'];
        if ($file['error'] === 0){
            $file['name'] = mb_convert_encoding($file['name'],'GBK','utf8');
            move_uploaded_file($file['tmp_name'],public_path().'/'.$file['name']);
            return $this->responseMsg('文件发送成功',212);
        }*/
        $file=$request->file('file');
        $session_id = $request->session_id ? $request->session_id : '';
        $to_session_id = $request->session_id ? $request->to_session_id : '';
        $ext = $file->getClientOriginalExtension();
        $extArr = ['jpg','jpeg','png'];
        $filename=$file->getClientOriginalName();
        $filename = iconv('utf-8', 'gbk', $filename);
        $newPath = '/fileUpload/'.date('Y-m-d',time());
        $path = public_path().$newPath;
        $fileSize = $file->getClientSize();
        if (! is_dir($path))
        {
            mkdir($path,0777,true);
        }
        $realFilePath = str_random(10).date('His',time()).'_'.$filename;
        $file->move($path,$realFilePath);
        if (in_array($ext,$extArr))
        {
            $message = '图片';
        }else{
            $message = '文件';
        }
        $data = [
            'path' => $newPath.'/'.iconv('gbk','utf-8',$realFilePath),
            'type' => 'file',
            'fileName' => $filename,
            'size' => $fileSize,
        ];
        $this->receiveData($session_id,$to_session_id,$data);
        return $this->responseMsg($message,212);
    }

    //当登录时返回所有未读消息
    public function notRead()
    {
        $user_id = Auth::id();
        $data = message::join('sessions','messages.session_id','=','sessions.session_id')
            ->join('friends','sessions.friend_id','=','friends.friend_id')
            ->where('friends.user_id','=',$user_id)
            ->where('is_read','=',1)
            ->select('messages.id','messages.session_id','messages.send_time','messages.message_type','messages.message_data','friends.my_friend_id')
            ->get();
        foreach ($data as $key=>$value)
        {
            $data[$key]['type'] = 'send';
            Gateway::sendToUid($data[$key]['my_friend_id'],json_encode($data[$key]));
            message::where('id',$data[$key]['id'])
                ->update(['is_read'=>0]);
        }
        return $this->responseMsg('获取未读消息',211);
    }

    public function profile(Request $request)
    {
        /*$username = $request->username ? $request->username : '';
        $phone = $request->phone ? $request->phone : '';
        $email = $request->email ? $request->email : '';
        $pic_url = $request->file('pic_url') ? $request->file('pic_url')  : '';*/
        $data = $request->all();
        unset($data['s']);
//        $ext = $data['pic_url']->getClientOriginalExtension();
//        return $this->responseMsg($ext,213);
        if ($data['pic_url'] === 'undefined') $data['pic_url'] = '';
        else{
            $filename=$data['pic_url']->getClientOriginalName();
            $newPath = '/fileUpload/'.date('Y-m-d',time());
            $path = public_path().$newPath;
            if (! is_dir($path))
            {
                mkdir($path,0777,true);
            }
            $realFilePath = str_random(10).date('His',time()).'_'.$filename;
            $data['pic_url']->move($path,$realFilePath);
            $data['pic_url'] = $newPath.'/'.$realFilePath;
        }
        $data = array_filter($data);
        $user = User::where('id',Auth::id())->update($data);
        if (! $user)
        {
            return $this->responseMsg("修改失败",213);
        }
        return $this->responseMsg("修改成功",213);
    }
}
