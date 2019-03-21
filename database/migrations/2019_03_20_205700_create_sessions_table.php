<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('session_id');
            $table->smallInteger('status')->default(0)->commit('当前会话是否被删除，默认未删除0，1为删除');
            $table->timestamp('session_time')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'))->commit('会话产生的时间');
            $table->integer('friend_id')->nullable()->commit('好友表的id.如果是群聊会话，将这个字段置为0');
            $table->integer('user_group_id')->nullable()->commit('用户群聊表id.如果是好友会话，将这个字段置为0');
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
        Schema::dropIfExists('sessions');
    }
}
