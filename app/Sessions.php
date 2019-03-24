<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $fillable = [
        //会话是否被删除。会话产生的时间。好友列表的id。群聊列表id
        'status','session_time','friend_id','user_group_id',
    ];

    //好友会话 群聊会话 参数是好友列表id或者群聊列表id is_friend判断是好友还是群聊 好友=0，群聊=1
    public static function addSession($friend_id,$is_friend=0)
    {
        $session = new Sessions();
        //当前是好友会话
        if ($is_friend == 0){
            if (! is_array($friend_id)){
                return '参数是一个数组';
            }
            $session1 =$session->insertGetId([
                'session_time' => date('Y-m-d H:i:s',time()),
                'friend_id' => $friend_id[0],
            ]);
            $session2 =$session->insertGetId([
                'session_time' => date('Y-m-d H:i:s',time()),
                'friend_id' => $friend_id[1],
            ]);
            if ($session1 && $session2){
                return 'ok';
            }else{
                return 'fail';
            }
        }elseif ($is_friend == 1){
            //是一个群聊会话
        }
    }
}
