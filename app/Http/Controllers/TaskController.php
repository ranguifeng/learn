<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    //
    public function show(Request $request)
    {
        $res =  $request->ips();
        dump($res);

    }

    public function save(Request $request)
    {
        $birthday = $request->input('birth');
        if ($request->method() != 'post') {
            exit('不接受的提交方式');
        }
        if (empty($birthday)) {
            exit('生日要填写');
        }
        $name = $request->input('name');
        if (empty($name)) {
            exit('名字还是要写的！');
        }
        $sex = $request->input('sex');
        if (empty($sex)) {
            exit('性别还是要写的');
        }
        $pwd = hash('sha256', '123456');
        $obj = new Carbon($birthday);
        $insert = [
            'name' => $name,
            'sex' => $sex,
            'age' => $obj->diffInYears(),
            'password' => $pwd,
            'birthday' => $birthday,
            'created_at' => Carbon::now()->toDate()
        ];
        DB::table('users')->insert($insert);
    }
}
