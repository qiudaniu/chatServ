<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class message extends Model
{
    protected $fillable = ['from_user_id','to_user_id','message_type','send_time','message_data','to_session_id'];


    public function saveData($session_id,$to_session_id,$data)
    {
        $user_id = Sessions::join('friends','sessions.friend_id','=','friends.friend_id')
            ->select('friends.my_friend_id')
            ->where('sessions.session_id',$session_id)
            ->first();
        //$data 一个数组
        $send_time = date('Y-m-d H:i:s',time());
//        $send_time = $data['send_time'] ? $data['send_time'] : date('Y-m-d H:i:s',time());
        $resultData = [
            'session_id' => $session_id,
            'to_session_id' =>$to_session_id,
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
                $resultData['message_data'] = $data['path'];
                //如果是文件传输，就将文件路径path存到数据库中。
                break;
            default:
                return '数据类型错误';
        }

//        exit(var_export($resultData));
        $id = $this->insertGetId($resultData);

        switch ($resultData['message_type'])
        {
            case 0:
                $resultData['type'] = 'text';
                break;
            case 1:
                $resultData['type'] = 'file';
                $resultData['fileName'] = iconv('gbk','utf-8',$data['fileName']);
                $resultData['size'] = $data['size'];
                break;
            default :
                break;
        }
        $arr = [
            'id' => $id,
            'data' => $resultData,
            'my_friend_id' => $user_id->my_friend_id,
        ];
        return $arr;

    }

    public function updateNotRead($message_id)
    {
        $this->where('id',$message_id)->update(['is_read'=>1]);
    }
}
