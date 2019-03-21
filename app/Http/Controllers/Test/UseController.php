<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use GatewayClient\Gateway;

class UseController extends Controller
{
    public function test()
    {
        $arr = [
//            'client_id' => Redis::get('client_id'),
            'user_id' => Auth::id(),
            'data' => [
                'type' => 'text',
                'message' => 'hello world'
            ]
        ];
        return json_encode($arr);
    }

    public function test_two(Request $request)
    {
        exit($request);
    }
}
