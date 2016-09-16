<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use League\CommonMark\CommonMarkConverter;

class BlogController extends Controller
{
    //获取最新的10条博文,显示到首页上去
    public function index()
    {
        $out = Post::take(10)->orderBy('updated_at','desc')->get();

        return view('index',[
            'test'=>$out
        ]);
    }

    public function showAll()
    {
        $posts = Post::paginate(10);
        //查询构造器的分页方法，返回了一个分页类对象，内置了方便的方法，好用到飞起

        return view('blog.all',['posts' => $posts]);
    }

    public function showSingle($id)
    {
        //用了composer的autoload，虽然讲道理在框架里应该是用sp绑定一下比较合理
        $parser = new CommonMarkConverter(['html_input' => 'escape']);

        try{
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $e)
        {
            return view("errors.404");
        }

        return view('blog.single',[
            'post' => $post,
            'content' => $parser->convertToHtml($post->content)
        ]);
    }

    public function addNew(Request $request)
    {
        $rules = [
            'title' => 'required',
            'postContent' => 'required'
        ];

        $message = [
            'required' => ':attribute 不能为空'
        ];

        $this->validate($request,$rules,$message);

        $post = new Post;

        $post->title = $request->title;
        $post->content = $request->postContent;

        $post->save();

        return view('admin.add_new',['update' => 1]);
    }

    public function getUpdate($id)
    {
        try{
            $post =  Post::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            return view("errors.404");
        }

        return view("admin.update",[
            'post' => $post
        ]);
    }

    public function postUpdate(Request $request,$id)
    {
        try{
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return view('errors.503');
        }



        $rules = [
            'title' => 'required',
            'postContent' => 'required'
        ];

        $message = [
            'required' => ':attribute 不能为空'
        ];

        $this->validate($request,$rules,$message);

        $post->title = $request->title;
        $post->content = $request->postContent;

        $post->save();

        return view('admin.update',[
            'update' => 1,
            'post' => $post
        ]);
    }

    public function deletePost($id)
    {
        try{
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return view("errors.404");
        }

        $post->delete();

        return view('admin.deleted');
    }
}
