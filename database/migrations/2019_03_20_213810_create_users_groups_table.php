<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->commit('用户id');
            $table->integer('group_id')->commit('群聊id');
            $table->smallInteger('quit')->default(0)->commit('是否退出了群聊。默认为0未退出，1是退出');
            $table->smallInteger('is_read')->default(0)->commit('是否读了群消息。默认是0已读,1是未读');
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
        Schema::dropIfExists('users_groups');
    }
}
