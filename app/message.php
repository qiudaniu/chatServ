<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class message extends Model
{
    protected $fillable = ['from_user_id','to_user_id','message_type','send_time','message_data'];


    public function saveData($session_id,$data)
    {
        $user_id = Sessions::join('friends','sessions.friend_id','=','friends.friend_id')
            ->select('friends.user_id')
            ->where('sessions.session_id',$session_id)
            ->first();
        //$data 一个数组
        $send_time = date('Y-m-d H:i:s',time());
//        $send_time = $data['send_time'] ? $data['send_time'] : date('Y-m-d H:i:s',time());
        $resultData = [
            'session_id' => $session_id,
            'send_time' => $send_time,
        ];
        switch ($data['type'])
        {
            case 'text':
                $resultData['message_type'] = 0;
                $resultData['message_data'] = $data['message'];
                break;
            case 'file':
                $resultData['message_type'] = 1;
                //如果是文件传输，就将文件路径path存到数据库中。
                break;
            default:
                return '数据类型错误';
        }

//        exit(var_export($resultData));
        $id = $this->insertGetId($resultData);

        $arr = [
            'type' => 'send',
            'id' => $id,
            'data' => $resultData,
            'user_id' => $user_id->user_id,
        ];
        return $arr;

    }
}
