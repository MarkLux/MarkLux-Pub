<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 16-9-16
 * Time: 下午4:35
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class AdminController extends  Controller
{
    public function showPostList()
    {
        $posts = Post::paginate(10);

        return view('admin.post_list',['posts' => $posts]);
    }

    public function showPostListByCid($cid)
    {
        try{
            $category = Category::findOrFail($cid);
        }catch (ModelNotFoundException $e) {
            return view('errors.404');
        }

        $posts = Post::where('cid','=',$cid)->paginate(10);

        return view('admin.post_list',[
            'posts' => $posts,
            'categoryName' => $category->name
        ]);
    }

    public function showAddPost(Request $request)
    {
        $categories = Category::orderBy('id')->get();

        $update = $request->input('update',0);

        return view('admin.add_new',[
            'categories'=>$categories,
            'update' => $update
        ]);
    }

    public function showUpdatePost(Request $request,$id)
    {
        try{
            $post =  Post::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            return view("errors.404");
        }

        $categories = Category::orderBy('id')->get();

        $update = $request->input('update',0);

        return view('admin.update',[
            'categories'=>$categories,
            'update' => $update,
            'post' => $post
        ]);
    }

}