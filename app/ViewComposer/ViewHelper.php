<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 16-9-19
 * Time: 上午11:04
 */

namespace App\ViewComposer;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use League\CommonMark\CommonMarkConverter;

/*
 *请注意 这不是一个视图组件，而是提供给视图的一个服务类，
 * 放在这里如此命名其实是为了方便
 */

class ViewHelper
{
    //提供把cid转换为分类名称的服务
    public function getCategoryNameByCid($cid)
    {
        try{
            $category = Category::findOrFail($cid);
        }catch(ModelNotFoundException $e){
            return view("errors.503");
        }

        return $category->name;
    }

    //提供根据id来提取出用户模型的服务
    public function getUser($id)
    {
        try{
            $user = User::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            return view("errors.503");
        }

        return $user;
    }

    //生成文章摘要
    public function cutArticle($data,$cut=0,$str="....")
    {
	
        $parser = new CommonMarkConverter(['html_input' => 'escape']);

        $data = $parser->convertToHtml($data);

        $data=strip_tags($data);//去除html标记
        $pattern = "/&[a-zA-Z]+;/";//去除特殊符号
        $data=preg_replace($pattern,'',$data);
        if(!is_numeric($cut))
            return $data;
        if($cut>0)
            $data=mb_strimwidth($data,0,$cut,$str);
        return $data;
	
    }
}
