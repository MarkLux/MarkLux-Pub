<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 16-9-19
 * Time: 上午11:54
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try{
            $categories = Category::all();

            if($categories == null)
                throw new ModelNotFoundException();

        }catch (ModelNotFoundException $e){
            return view('errors.503');
        }

        $update = $request->input('update',0);
        $pos = $request->input('pos',1);

        return view('admin.category',[
            'categories' => $categories,
            'update' => $update,
            'pos' => $pos
        ]);
    }

    public function update(Request $request,$cid)
    {
        try{
            $category = Category::findOrFail($cid);
        }catch (ModelNotFoundException $e) {
            return false;
        }

        $rules = [
            'name' => 'required|unique:categories'
        ];

        $message = [
            'required' => '您还没有填写内容',
            'unique' => '此分类已经存在'
        ];

        $this->validate($request,$rules,$message);//bug

        $category->name = $request->name;
        $category->save();

        return redirect('/admin/categories?update=1&pos=2');
    }

    public function del($cid)
    {
        //删除某个分类时，把原来从属于该分类的博文cid全改为1（未分类）

        try{
            $category = Category::findOrFail($cid);
        }catch (ModelNotFoundException $e) {
            return false;
        }

        $posts = Post::where("cid","=",$cid)->get();

        foreach ($posts as $post)
        {
            $post->cid = 1;//1为未分类的cid
            $post->save();
        }

        $category->delete();

        return redirect('/admin/categories?update=1&pos=2');
    }

    public function addNew(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories'
        ];

        $message = [
            'required' => '您还没有填写内容',
            'unique' => '此分类已经存在'
        ];

        $this->validate($request,$rules,$message);
        $category = new Category;
        $category->name = $request->name;

        $category->save();
        return redirect('/admin/categories?update=1&pos=1');
    }
}