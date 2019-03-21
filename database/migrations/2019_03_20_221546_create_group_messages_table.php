<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->increments('group_message_id');
            $table->integer('message_type')->default(0)->commit('数据类型，0为文本类型，1为文件；默认为0');
            $table->string('message_data')->commit('发送的数据');
            $table->timestamp('send_time')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'))->commit('数据发送时间');
            $table->integer('user_group_id')->commit('用户群聊id');
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
        Schema::dropIfExists('group_messages');
    }
}
