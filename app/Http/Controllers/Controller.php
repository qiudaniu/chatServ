<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //返回数据json格式
    public function responseData($data,$message,$code)
    {
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
        return json_encode($result);
    }

    //返回成功的json数据
    public function success()
    {
        $data = [
            'code' => 200,
            'message' => 'ok'
        ];
        return json_encode($data);
    }

    //返回json数据格式的错误信息
    public function responseMsg($message,$code)
    {
        $errorArr = [
            'code' => $code,
            'message' => $message
        ];
        return json_encode($errorArr);
    }
}
