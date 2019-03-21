<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function store(Request $request)
    {
        return $request->all();
    }
}
