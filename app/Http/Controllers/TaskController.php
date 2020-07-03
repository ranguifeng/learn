<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Music;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    protected $viewRoot = 'task';

    const REASON_PERSONAL_HOLIDAY_HJ = 301;
    const REASON_PERSONAL_HOLIDAY_NXJ = 302;
    const REASON_PERSONAL_HOLIDAY_SJ = 303;
    const REASON_PERSONAL_HOLIDAY_CJ = 304;
    const REASON_PERSONAL_HOLIDAY_BJ = 305;

    const REASON_PERSONAL_HOLIDAY_TQJ = 306;
    const REASON_PERSONAL_HOLIDAY_PCJ = 307;
    const REASON_PERSONAL_HOLIDAY_SHJ = 308;
    const REASON_PERSONAL_HOLIDAY_CJJ = 309;
    const REASON_PERSONAL_HOLIDAY_CCWC = 310;

    const REASON_PERSONAL_HOLIDAY_QT = 399;

    public function index(Request $request)
    {

        $date = Carbon::now();

        $list = (object)[
            ['name'=>'支付宝','money'=>'10'],
            ['name'=>'微信','money'=>'10.3'],
        ];
        $res = collect($list)->sum('money');//20.3
        $reason = 399;

        $leaveTypes = static::getPersonalHolidayDictionary();

        $leaveType = Arr::get($leaveTypes, $reason, $reason);

        $mobile = 13510111021;
        $mobile = substr_replace($mobile,'****', 3,4);
        dump($mobile);


        return view("{$this->viewRoot}.task")->with(compact('date'));
    }


    /**
     *
     * @return array
     */
    public static function getPersonalHolidayDictionary(){
        return [
            static::REASON_PERSONAL_HOLIDAY_HJ => "婚假",
            static::REASON_PERSONAL_HOLIDAY_NXJ => "年休假",
            static::REASON_PERSONAL_HOLIDAY_SJ => "事假",
            static::REASON_PERSONAL_HOLIDAY_CJJ => "产假",
            static::REASON_PERSONAL_HOLIDAY_BJ => "病假",
            static::REASON_PERSONAL_HOLIDAY_TQJ => "探亲假",
            static::REASON_PERSONAL_HOLIDAY_PCJ => "陪产假",
            static::REASON_PERSONAL_HOLIDAY_SHJ => "丧假",
            static::REASON_PERSONAL_HOLIDAY_CJJ => "产检假",
            static::REASON_PERSONAL_HOLIDAY_CCWC => "出差或外出",
            static::REASON_PERSONAL_HOLIDAY_QT => "其他",
        ];
    }

    public function test()
    {



    }

    public function test1()
    {
        DB::connection()->enableQueryLog();

        Music::take(5)->get();
        dump(DB::getQueryLog());

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
