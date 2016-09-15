<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use League\CommonMark\CommonMarkConverter;
    use Auth;

class BlogController extends Controller
{
    //获取最新的10条博文
    public function index()
    {
        $out = Post::take(10)->get();

        return view('test',[
            'test'=>$out
        ]);
    }

    public function show($id)
    {
        $parser = new CommonMarkConverter(['html_input' => 'escape']);

        $item = Post::find($id);

        return view('post',[
            'item' => $item,
            'content' => $parser->convertToHtml($item->content)
        ]);
    }

    public function add()
    {
        
    }
}
