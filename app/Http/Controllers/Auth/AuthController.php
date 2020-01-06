<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $rootView = 'auth';

    public function login()
    {
        return view($this->rootView.'.login');
    }

    public function register()
    {
        return view($this->rootView . '.register');
    }

    public function registerStore(Request $request)
    {

        $rule = [
            'name' => 'required|max:20|unique:users',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'numeric|min:11|regex:/^1[34578][0-9]{9}$/|unique:users',
            'birthday' => 'date',
        ];
        $message = [
            'name.required' => '姓名不能为空',
            'password.required' => '密码不能为空',
            'email.required' => '邮箱不能为空',
            'name.unique' => '用户名已存在',
            'name.max' => '姓名长度不能超过20位',
            'password.min' => '密码长度小于6位',
            'password.confirmed' => '密码与重复密码不一致',
            'email.email' => '请填写正确格式的邮箱',
            'email.max' => '邮箱长度不能超过255',
            'email.unique' => '邮箱已被注册',
            'mobile.numeric' => '手机号码必须输入数字',
            'mobile.min' => '手机必输输入11位的',
            'mobile.regex' => '请输入正确格式的手机号',
            'mobile.unique' => '手机号码已存在',
            'birthday.date' => '请输入正确的时间格式，年月日格式，例如20001230',
        ];

        $this->validate($request, $rule, $message);

        $post = $request->all();
        $user = new User();
        $post['created_at'] = Carbon::now()->toDate();
        if ($post['birthday']) {
            $post['birthday'] = Carbon::parse($post['birthday'])->format('Y-m-d');
            $post['age'] = Carbon::parse($post['birthday'])->diffInYears();
            $user->age = $post['age'];
            $user->birthday = $post['birthday'];
        }

        $user->name = $post['name'];
        $user->sex = $post['sex'];
        $user->email = $post['email'];
        $user->mobile = $post['mobile'];
        $user->created_at = $post['created_at'];
        $user->password = bcrypt($post['password']);

        $user->save();
        return redirect()->back()->with(['message' => '保存成功']);
    }

    public function loginAction(Request $request)
    {
        $post = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => '登录账号必须输入',
            'email.email' => '登录账号必须是邮箱',
            'password.required' => '密码必须输入',
            'password.min' => '密码必须大于6位',
        ]);

        $user = User::where(['email' => $post['email'], 'status' => 1])->get();

        if (!$user) {
            return redirect('login')->with(['message' => '找不到该用户']);
        }
    }
}
