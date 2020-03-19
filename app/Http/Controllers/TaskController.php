<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        dump(Carbon::today()->toDateString());
    }


    public function vp()
    {
        //测试代码
        $password_list = array(
            "12dakedegss@#$", //含有123
            "dhdgafe98Dsw<", //合法
            "dedeRTdxbnvmaded",//没有数字
            "Ygd%s", //长度不够
            "你好YHDde092+",//非法字符
            "123Yhd345de#s",//含有123
            "GHJhj45%￥2sde",//三连GHJ
            "a^&*()_dmin78E%nihao",//含有admin
            "1Qw~!\_-’‘？、。，",
            "1Qw@#$%^&*()[]{}",
            "1Qw|:\"<>?,./;“”」",
            "1Qw「【】·`《》￥…；：",
            "Emicnet@?",
            "Emicnet@π1",
            "你好Emicnet1@",
            "Pdmin1+891",
        );

        foreach ($password_list as $password) {
            try {
                HelpPassword::validate($password);
            } catch (PasswordException $exception) {
                echo "$password is failed:".$exception->getMessage()."<br/>";
                continue;
            }
            echo $password."验证通过！"."<br/>";
        }


    }


}
