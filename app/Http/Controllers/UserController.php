<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 16-9-10
 * Time: 下午4:37
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Auth;


class UserController extends Controller
{
    public function login(Request $request)
    {


        $email = $request->email;
        $password = $request->password;

        $message =[
            'required' => ':attribute 不能为空',
            'min' => '密码长度太短',
            'email' => '邮件地址格式有误'
        ];

        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ];

        $this->validate($request,$rules,$message);

        $isRemember = $request->remember;//记住我选项

        if(Auth::attempt(['email' => $email,'password' => $password],$isRemember))
        {
            return redirect()->intended('/');
        }
        else
        {
            return view('auth.login')
                ->withErrors(['用户名或密码错误']);
        }
    }

    public function register(Request $request)
    {
        $message = [
            'required' => ':attribute 不能为空',
            'unique' => ':attribute 已经存在',
            'confirmed' => '两次输入不一致',
            'min' => '密码长度太短',
            'max' => ':attribute 长度超过限制（255）'
        ];

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];

        $this->validate($request,$rules,$message);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        //注册成功后直接自动让用户登陆

        Auth::login($user);

        return redirect("/profile");
    }
}