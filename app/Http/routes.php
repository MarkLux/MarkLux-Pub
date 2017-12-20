<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'BlogController@index');

Route::get('/friend-links','BlogController@getFriendLinks');

Route::get('/calendar','HLController@index');

Route::get('/blog','BlogController@showAll');

Route::get('/blog/category/{id}','BlogController@showByCategory');

Route::get('/blog/{id}','BlogController@showSingle');

// 认证路由...
Route::get('/login', function(){
    return view('auth.login');
});
Route::post('/login', 'UserController@login');

Route::get('/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('/register', function(){
    return view('auth.register');
});
Route::post('/register', 'UserController@register');

Route::group(['middleware' => 'auth'],function (){
    Route::get('/profile',function(){
        return view('profile');
    });

    Route::post('/blog/{id}','BlogController@addComment');

    Route::post('blog/delete-comment/{id}','BlogController@deleteComment');
});

Route::group(['middleware' => 'admin','prefix' => 'admin'],function(){
    Route::get('/',function(){
        return view('admin.panel');
    });
    Route::get('/posts/add-new','AdminController@showAddPost');
    Route::post('/posts/add-new','BlogController@AddNew');
    Route::get('/posts/update/{id}','AdminController@showUpdatePost');
    Route::post('/posts/update/{id}','BlogController@postUpdate');
    Route::get('/posts/delete/{id}','BlogController@deletePost');
    Route::get('/posts/category/{cid}','AdminController@showPostListByCid');
    Route::get('/posts','AdminController@showPostList');

    Route::get('/categories','CategoryController@index');
    Route::post('/categories','CategoryController@addNew');
    Route::delete('/categories/{id}','CategoryController@del');
    Route::post('/categories/{id}','CategoryController@update');
});

Route::post('/power-builder/submit',[
    'middleware' => 'cors',
    'uses' => 'PowerBuilderFormController@submit'
]);
Route::get('/power-builder/result','PowerBuilderFormController@getResult');