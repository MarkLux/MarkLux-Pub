<?php

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 16-9-15
 * Time: 下午5:19
 */

namespace App\ViewComposer;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Auth;//facade

class UserComposer
{

    public function compose(View $view)
    {
        //一定要先检查用户实例是否存在，否则传入空数据直接导致视图bug
        if(Auth::check())
        {
            $user = Auth::user();
            $view->with('loginStatus',Auth::check());
            $view->with('isUserAdmin',$user->is_admin);
            $view->with('userId',$user->id);
            $view->with('userName',$user->name);
        }
        else
        {
            $view->with('loginStatus',0);
        }
    }
}