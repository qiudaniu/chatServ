<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Friends extends Model
{
    protected $fillable = [
        'user_id','my_friend_id','re_mark','defriend','add_friend_time'
    ];

    public static function addFriend($user_id,$my_friend_id)
    {
        $user1 = new User();
        DB::beginTransaction();
        try{
            //判断是否已经是好友       添加字段delete 0未删除 1删除
            $friend = Friends::where('user_id',$user_id)
                ->where('my_friend_id',$my_friend_id)
                ->where('delete','!=',1)
                ->first();
            if (! $friend){
                $friend1 = new Friends();
                $friend1 = $friend1->insertGetId([
                    'user_id' => $user_id,
                    'my_friend_id' => $my_friend_id,
                    're_mark' => $user1->find($my_friend_id)->name,
                    'add_friend_time' => date('Y-m-d H:i:s',time()),
                ]);
                $friend2 = new Friends();
                $friend2 = $friend2->insertGetId([
                    'user_id' => $my_friend_id,
                    'my_friend_id' => $user_id,
                    're_mark' => $user1->find($user_id)->name,
                    'add_friend_time' => date('Y-m-d H:i:s',time()),
                ]);
                if ($friend1 && $friend2){
                    $arr = [$friend1,$friend2];
                    //当添加好友成功后，将创建两个会话。一个是自己的会话；一个是好友的会话
                    $session = Sessions::addSession($arr);
                    if ($session == 'ok'){
                        DB::commit();
                        return 'ok';
                    }
                }
            }else{
                return 'is_friend';
            }

        }catch (\Exception $exception){
            DB::rollBack();
            return 'fail';
        }

    }

    //拉黑好友
    public static function deFriend()
    {

    }

    //删除好友
    public static function deleteFriend()
    {

    }
}
