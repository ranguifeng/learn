<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('姓名');
            $table->string('mobile',20)->nullable()->comment('手机');
            $table->tinyInteger('sex')->default(0)->comment('性别 0保密 1男 2女');
            $table->integer('age')->default(0)->comment('年龄');
            $table->string('birthday', 20)->nullable()->comment('生日');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('状态');
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
        Schema::drop('users');
    }
}
