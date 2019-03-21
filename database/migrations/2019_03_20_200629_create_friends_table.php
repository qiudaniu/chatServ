<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('friend_id');
            $table->integer('user_id')->commit('当前登录的id');
            $table->integer('my_friend_id')->commit('好友id');
            $table->char('re_mark')->nullable()->commit('好友备注');
            $table->smallInteger('defriend')->default(0)->commit('拉黑好友，默认没有拉黑0，1拉黑了。拉黑了不将消息推送给自己');
            $table->timestamp('add_friend_time')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'))->commit('添加好友的时间');
//            $table->integer('session_id')->nullable()->commit('会话id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
