<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('group_id');
            $table->char('group_name')->default('群聊')->commit('群聊名称');
            $table->integer('group_number')->default(0)->commit('群聊人数。默认为0，查询到如果为0可以将群聊设置为解散');
            $table->smallInteger('is_dissolution')->default(0)->commit('群聊是否解散');
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
        Schema::dropIfExists('groups');
    }
}
