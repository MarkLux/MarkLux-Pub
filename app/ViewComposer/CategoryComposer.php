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

/*
 *请注意 这不是一个视图组件，而是提供给视图的一个服务，
 * 放在这里如此命名其实是为了方便
 */

class CategoryComposer
{
    public function getCategoryNameByCid($cid)
    {
        try{
            $category = Category::findOrFail($cid);
        }catch(ModelNotFoundException $e){
            return view("errors.503");
        }

        return $category->name;
    }
}