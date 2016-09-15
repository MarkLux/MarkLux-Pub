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
            'required' => ':attribute 不能为空'
        ];

        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ];

        $this->validate($request,$rules,$message);

        if(Auth::attempt(['email' => $email,'password' => $password]))
        {
            return redirect()->intended('/');
        }
        else
        {
            return view('auth.login')
                ->withErrors(['用户名或密码错误']);
        }
    }
}