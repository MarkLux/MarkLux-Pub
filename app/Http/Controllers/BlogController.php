<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use League\CommonMark\CommonMarkConverter;
use Auth;
use Gate;
use Prophecy\Exception\Prediction\NoCallsException;

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

    public function showSingle(Request $request,$id)
    {
        //用了composer的autoload，虽然讲道理在框架里应该是用sp绑定一下比较合理
        $parser = new CommonMarkConverter(['html_input' => 'escape']);

        try{
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $e)
        {
            return view("errors.404");
        }

        $comments = Comment::where('pid','=',$id)->get();

        $update = $request->input('update',0);


        return view('blog.single',[
            'post' => $post,
            'content' => $parser->convertToHtml($post->content),
            'comments' => $comments,
            'update' => $update
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
        $post->cid = $request->cid;

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

    public function addComment(Request $request,$id)
    {
        try{
            $post = Post::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return view("errors.503");
        }

        $rules = [
            'comment' => 'required|max:1024'
        ];

        $message = [
            'required' => '内容不能为空',
            'max' => '长度过长！'
        ];

        $user = Auth::user();

        $this->validate($request,$rules,$message);

        $comment = new Comment;

        $comment->content = $request->comment;
        $comment->pid = $id;
        $comment->uid = $user->id;

        $comment->save();

        return redirect('/blog/'.$id.'?update=1');
    }

    public function deleteComment(Request $request,$id)
    {
        try{
            $comment = Comment::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return view("errors.404");
        }

        if(Gate::denies('delete-comment',$comment))
            return view('errors.503');

        $comment->delete();

        return redirect('/blog/'.$request->bid.'?update=1');
    }
}
