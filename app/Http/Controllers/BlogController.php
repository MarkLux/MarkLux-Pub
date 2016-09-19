<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $posts = Post::orderBy('updated_at','desc')->paginate(10);
        //查询构造器的分页方法，返回了一个分页类对象，内置了方便的方法，好用到飞起

        return view('blog.list',[
            'posts' => $posts,
            'categoryName' => '全部'
        ]);
    }

    public function showByCategory($cid)
    {
        //先检查cid的合理性
        try{
            $category = Category::findOrFail($cid);
        }catch (ModelNotFoundException $e) {
//            return view("errors.404");

            echo $cid;
        }

        $posts = Post::where('cid','=',$cid)->orderBy('updated_at','desc')->paginate(10);

        return view('blog.list',[
            'posts' => $posts,
            'categoryName' => $category->name
        ]);
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
        $post->cid = $request->cid;

        $post->save();

        return redirect('/admin/posts/add-new?update=1');
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

        return redirect('admin/posts/update/'.$id."?update=1");
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
