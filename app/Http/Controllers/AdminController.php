<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 16-9-16
 * Time: 下午4:35
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\Post;

class AdminController extends  Controller
{
    public function showList()
    {
        $posts = Post::paginate(10);

        return view('admin.list',['posts' => $posts]);
    }
}