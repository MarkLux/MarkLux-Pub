<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    //魔术方法：修饰器，当输入了title后自动根据title生成一个slug

    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = $val;

        //检测记录有没有被写入数据库（当前请求周期）
        if(!$this->exists)
        {
            $this->attributes['slug'] = str_slug($val);
            //辅助函数，Helper里面其实就是是调用了Str::slug()；
        }
    }

    //其实这个函数没啥用..后面也取消了slug设定，改用post的id来查询
}
