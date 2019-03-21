<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_user_id')->commit('发送数据用户');
            $table->string('to_user_id')->commit('接收数据用户');
            $table->string('message_data')->commit('发送的数据');
            $table->integer('message_type')->default(0)->commit('数据类型，0为文本类型，1为文件；默认为0');
            $table->timestamp('send_time')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'))->commit('数据发送时间');
            $table->rememberToken();
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
        Schema::dropIfExists('messages');
    }
}
